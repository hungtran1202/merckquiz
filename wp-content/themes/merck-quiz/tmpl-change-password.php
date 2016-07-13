<?php
/**
 * Template name: Change Password
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
?>

<div class="c-content-login-form"
     style="background: url(<?php echo _NP_TEMPLATE_URL . '/assets/base/img/content/backgrounds/bg-43.jpg' ?>) no-repeat center; background-size: cover; padding: 20px 0">
    <div class="modal-dialog">
        <div class="modal-content" style="margin: 0;">
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Change Password', _NP_TEXT_DOMAIN) ?></h3>
                <?php
                if ($login == 'failed') {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo __('The email address or password you entered is incorrect', _NP_TEXT_DOMAIN)?>.
                    </div>
                    <?php
                }
                ?>
                <div class="message-signup alert hidden"></div>
                <form class="form-change-password" name="change-password" action="" method="post">
                    <div class="form-group">
                        <label for="old-password" class="hide"><?php echo __('Old Password *', _NP_TEXT_DOMAIN)?></label>
                        <input name="oldPassword" type="password" minlength="6" class="form-control input-lg c-square " id="old-password"
                               placeholder="<?php echo __('Old Password *', _NP_TEXT_DOMAIN)?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="hide"><?php echo __('New Password *', _NP_TEXT_DOMAIN)?></label>
                        <input name="password" type="password" minlength="6" class="form-control input-lg c-square newPassword" id="password"
                               placeholder="<?php echo __('New Password *', _NP_TEXT_DOMAIN)?>">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword" class="hide"><?php echo __('Confirm New Password', _NP_TEXT_DOMAIN)?></label>
                        <input name="confirmPassword" type="password" class="form-control input-lg c-square confirmPassword" id="confirmPassword"
                               placeholder="<?php echo __('Confirm New Password *', _NP_TEXT_DOMAIN)?>">
                        <div id="message-confirm" class="message-confirm *"></div>
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
