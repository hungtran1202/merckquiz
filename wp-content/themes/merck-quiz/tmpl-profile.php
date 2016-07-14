<?php
/**
 * Template name: Profile
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
if(!is_user_logged_in()){
    wp_redirect(site_url('/login'));
    exit();
}
$userMeta = get_user_meta(get_current_user_id());
$phone=get_field('phone', 'user_'.get_current_user_id());
$name = _wp_get_current_user()->display_name;
?>

<div class="c-content-login-form"
     style="background: url(<?php echo _NP_TEMPLATE_URL . '/assets/base/img/content/backgrounds/bg-43.jpg' ?>) no-repeat center; background-size: cover; padding: 20px 0">
    <div class="modal-dialog">
        <div class="modal-content" style="margin: 0;">
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Change Profile', _NP_TEXT_DOMAIN) ?></h3>
                <?php
                if ($login == 'failed') {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo __('Error. Please contact admin.', _NP_TEXT_DOMAIN)?>.
                    </div>
                    <?php
                }
                ?>
                <div class="message-signup alert hidden"></div>
                <form class="form-change-profile" name="change-profile" action="" method="post">
                    <div class="form-group">
                        <label for="signup-fullname" class="hide"><?php echo __('Fullname *', _NP_TEXT_DOMAIN)?></label>
                        <input name="fullname" type="text" class="form-control input-lg c-square" id="signup-fullname"
                               value="<?php echo $name?>" placeholder="<?php echo __('Fullname *', _NP_TEXT_DOMAIN)?>" >
                    </div>
                    <div class="form-group">
                        <label for="signup-phone" class="hide"><?php echo __('Phone', _NP_TEXT_DOMAIN)?></label>
                        <input name="phone" type="tel" class="form-control input-lg c-square" id="signup-phone" value="<?php echo $phone?>"
                               placeholder="<?php echo __('Phone', _NP_TEXT_DOMAIN)?>" >
                    </div>
                    <div class="form-group">
                        <button name="wp-submit" id="wp-submit" type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square btn-change-password">
                            <?php echo __('Submit', _NP_TEXT_DOMAIN) ?>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
