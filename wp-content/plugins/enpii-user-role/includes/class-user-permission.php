<?php
/**
 * Created by PhpStorm.
 * User: lacphan
 * Date: 2/18/16
 * Time: 11:35 AM
 */
namespace Enpii\UserPermission;

class UserPermission {
    public function __construct()
    {
        $this->pluginInit();
    }

    protected function pluginInit() {
        add_filter('editable_roles', array($this, 'excludeUserRole' ),100 );
        add_action('pre_user_query',array($this,'excludePreUserQuery'),100);
        add_filter('user_has_cap', array($this, 'denyEditAdmin'), 10, 3);
        add_filter('load-users.php',array($this,'denyDeleteAdmin'),100);
        add_action('admin_head' , array($this,'hideFilterAdministrator'));
    }

    /**
     * Function hide role Administrator if user is not Administrator
     * @param $roles
     * @return mixed
     */
    public function excludeUserRole($roles) {
        if (current_user_can('administrator')) {
           return $roles;
        }
        if (isset($roles['administrator'])) {
            unset($roles['administrator']);
        }
        return $roles;
    }

    /**
     * Function for hide administrator user group
     * @param $user_search
     */
    public function excludePreUserQuery($user_search) {
        $user = wp_get_current_user();
        if ( $user->roles[0] != 'administrator' ) {
            global $wpdb;
            $user_search->query_where =
                str_replace('WHERE 1=1',
                    "WHERE 1=1 AND {$wpdb->users}.ID IN (
                     SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta
                        WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                        AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')",
                    $user_search->query_where
                );

        }
    }

    /**
     * Function for prevent edit admin
     * @param $allCaps
     * @return mixed
     */
    public function denyEditAdmin($allCaps) {
        $userKeys = array('user_id', 'user');
        foreach ($userKeys as $userKey) {
            $accessDeny = false;
            $userID = $this->getRequestVar($userKey, 'get');
            if (empty($userID)) {
                break;
            }
            if ($userID == 1) {  // built-in WordPress Admin
                $accessDeny = true;
            } else {
                if($this->getUserRoleByID($userID) == 'administrator'){
                    $accessDeny = true;
                }
            }
            if ($accessDeny) {
                unset($allCaps['edit_users']);
            }
            break;
        }
        return $allCaps;
    }

    /**
     * Function for prevent delete administrator
     * @param $actions
     * @return mixed
     */
    public function denyDeleteAdmin($actions) {
        if(isset($_REQUEST['user'])) {
            $userID = $_REQUEST['user'];
            $accessDeny = false;
            if($this->getUserRoleByID($userID) == 'administrator'){
                $accessDeny = true;
            }
            if ($accessDeny) {
                wp_die('You do not have permission to delete this user.');
            }
        }

        return $actions;
    }

    public function getRequestVar($var_name, $request_type = 'request', $var_type = 'string') {

        $result = 0;
        if ($request_type == 'get') {
            if (isset($_GET[$var_name])) {
                $result = $_GET[$var_name];
            }
        } else if ($request_type == 'post') {
            if (isset($_POST[$var_name])) {
                if ($var_type != 'checkbox') {
                    $result = $_POST[$var_name];
                } else {
                    $result = 1;
                }
            }
        } else {
            if (isset($_REQUEST[$var_name])) {
                $result = $_REQUEST[$var_name];
            }
        }

        if ($result) {
            if ($var_type == 'int' && !is_numeric($result)) {
                $result = 0;
            }
            if ($var_type != 'int') {
                $result = esc_attr($result);
            }
        }

        return $result;
    }

    /**
     * Function for get user role by ID
     * @param $userID
     * @return mixed
     */
    public function getUserRoleByID($userID) {
        $user = get_user_by( 'id', $userID );
        $userObject = get_object_vars( $user );
        $userRole = $userObject['roles'][0];
        return $userRole;
    }

    /**
     * Hide administrator filer
     */
    function hideFilterAdministrator(){
        if ( !current_user_can('administrator') ){
            ?>
            <script type='text/javascript' >
                jQuery(document).ready(function(){
                    var admin_count;
                    var total_count;
                    var filerSub  = jQuery(".subsubsub");
                    filerSub.find('li').find("a:contains(Administrator)").each(function(){
                        admin_count = jQuery(this).children('.count').text();
                        admin_count = admin_count.substring(1, admin_count.length - 1);
                    });
                    filerSub.find('li').find("a:contains(Administrator)").parent().remove();
                    filerSub.find('li').find("a:contains(All)").each(function(){
                        total_count = jQuery(this).children('.count').text();
                        total_count = total_count.substring(1, total_count.length - 1) - admin_count;
                        jQuery(this).children('.count').text('('+total_count+')');
                    });
                    jQuery("#users").find("tr").find(".administrator").parent().parent().remove();
                });
            </script>
            <?php
        }
    }
}