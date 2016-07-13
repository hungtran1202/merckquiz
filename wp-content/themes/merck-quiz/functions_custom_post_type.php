<?php
/**
 * Created by PhpStorm.
 * User: lacphan
 * Date: 2/19/16
 * Time: 2:12 PM
 */

/*
 * check plugin enpii core active
 * plugin active, you cant use class NpWP
 */
if(defined('_ENPII_CORE')) {
    if (!function_exists('enpii_custom_post_type_init')) {
        /**
         * Register a job post type.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_post_type
         * @param $postType
         * @param $slug
         * @param pluralName
         * @param $singularName
         * @param $textDomain
         * @param $menuPosition
         */
        function enpii_custom_post_type_init()
        {

            $postType = "question";
            $slug = "question";
            $pluralName = "Questions";
            $singularName = "Question";
        NpWp::registerPostType($postType, $slug, $pluralName, $singularName,10);

        }
    }
    /*
     * Create custom post type, using:
     * add_action( 'init', 'enpii_custom_post_type_init' )
     */
    add_action('init', 'enpii_custom_post_type_init');

    /*
     * register Taxonomy
     */

    if (!function_exists('template_custom_taxonomy')) {

        function template_custom_taxonomy()
        {
            $taxonomy = "questionnaire";
            $slugTaxonomy = "questionnaire";
            $postType = "question";
            $pluralName = "Questionnaires";
            $singularName = "Questionnaire";
        NpWp::registerTaxonomy($taxonomy, $slugTaxonomy, $postType, $pluralName, $singularName);
        }

    }
    /*
     * register Taxonomy for custom post type, using:
     * add_action('init', 'template_custom_taxonomy')
     */
    add_action('init', 'template_custom_taxonomy', 0);


    if (!function_exists('merckquiz_contest_init')) {
        /**
         * Register a job post type.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_post_type
         * @param $postType
         * @param $slug
         * @param pluralName
         * @param $singularName
         * @param $textDomain
         * @param $menuPosition
         */
        function merckquiz_contest_init()
        {
            $postType = "contest-session";
            $slug = "contest-session";
            $pluralName = "Contests Session";
            $singularName = "Contest Session";
            NpWp::registerPostType($postType, $slug, $pluralName, $singularName,11);

        }
    }
    /*
     * Create custom post type, using:
     * add_action( 'init', 'enpii_custom_post_type_init' )
     */
    add_action('init', 'merckquiz_contest_init');
}
?>
<?php remove_role( 'subscriber' ); ?>
<?php remove_role( 'editor' ); ?>
<?php remove_role( 'contributor' ); ?>
<?php remove_role( 'author' ); ?>

<?php
function merckquiz_addFilterQuestion() {
    global $typenow;
    $post_type = 'question'; // change HERE
    $taxonomy = 'questionnaire'; // change HERE
    if ($typenow == $post_type) {
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => false,
            'hide_empty' => true,
        ));
    };
}

add_action('restrict_manage_posts', 'merckquiz_addFilterQuestion');

function merckquiz_queryFilterQuestion($query) {
    global $pagenow;
    $post_type = 'question'; // change HERE
    $taxonomy = 'questionnaire'; // change HERE
    $q_vars = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}

add_filter('parse_query', 'merckquiz_queryFilterQuestion');

function merckquiz_addFilterContest() {
    global $typenow;
    $post_type = 'contest-session'; // change HERE
    $taxonomy = 'questionnaire'; // change HERE
    if ($typenow == $post_type) {
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => false,
            'hide_empty' => true,
        ));
    };
}

add_action('restrict_manage_posts', 'merckquiz_addFilterContest');

function merckquiz_queryFilterContest($query) {
    global $pagenow;
    $post_type = 'contest-session'; // change HERE
    $taxonomy = 'questionnaire'; // change HERE
    $q_vars = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}

add_filter('parse_query', 'merckquiz_queryFilterContest');

// Filter by user

function add_author_filter_to_posts_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'contest-session'){

        //get a listing of all users that are 'author' or above
        $user_args = array(
            'show_option_all'   => 'All Users',
            'orderby'           => 'display_name',
            'order'             => 'ASC',
            'name'              => 'author',
//            'who'               => 'authors',
            'include_selected'  => false
        );

        //determine if we have selected a user to be filtered by already
        if(isset($_GET['aurthor_admin_filter'])){
            //set the selected value to the value of the author
            $user_args['selected'] = (int)sanitize_text_field($_GET['aurthor_admin_filter']);
        }

        //display the users as a drop down
        wp_dropdown_users($user_args);
    }

}
add_action('restrict_manage_posts','add_author_filter_to_posts_administration');

add_filter('post_row_actions','my_action_row', 10, 2);

function my_action_row($actions, $post){
    //check for your post type
    if ($post->post_type =="contest-session"){
        $pdf=get_field('pdf',$post->ID);
        /*do you stuff here
        you can unset to remove actions
        and to add actions ex:
        $actions['in_google'] = '<a href="http://www.google.com/?q='.get_permalink($post->ID).'">check if indexed</a>';
        */
        $actions['report'] = '<a target="_blank" href="'.$pdf.'">'.__('Download Report', _NP_TEXT_DOMAIN).'</a>';
    }
    return $actions;
}




