<?php
/**
 * Template name: Login
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
merckquiz_redirectIsLogged();
$checkemail = isset($_REQUEST['checkemail']) ? $_REQUEST['checkemail'] : '';
$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : '';
?>
<div class="c-content-login-form"
     style="background: url(<?php echo _NP_TEMPLATE_URL . '/assets/base/img/content/backgrounds/bg-43.jpg' ?>) no-repeat center; background-size: cover; padding: 20px 0">
    <div class="modal-dialog">
        <div class="modal-content" style="margin: 0;">
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Login', _NP_TEXT_DOMAIN) ?></h3>

                <p><?php echo __("Let's make today a great day!", _NP_TEXT_DOMAIN)?></p>
                <?php
                if ($login == 'failed') {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo __('The email address or password you entered is incorrect', _NP_TEXT_DOMAIN)?>.
                    </div>
                    <?php
                }
                ?>
                <form name="loginform" id="loginform" action="<?php echo site_url('/wp-login.php') ?>" method="post">
                    <div class="form-group">
                        <label for="user_login" class="hide"><?php echo __('Username/Email', _NP_TEXT_DOMAIN)?></label>
                        <input name="log" type="text" class="form-control input-lg c-square" id="user_login"
                               placeholder="<?php echo __('Username/Email', _NP_TEXT_DOMAIN)?>">
                    </div>
                    <div class="form-group">
                        <label for="user_pass" class="hide"><?php echo __('Password', _NP_TEXT_DOMAIN)?></label>
                        <input name="pwd" type="password" class="form-control input-lg c-square" id="user_pass"
                               placeholder="<?php echo __('Password', _NP_TEXT_DOMAIN)?>"></div>
                    <div class="form-group">
                        <div class="c-checkbox">
                            <input name="rememberme" type="checkbox" id="rememberme" class="c-check" value="forever">
                            <label for="rememberme" class="c-font-thin c-font-17">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span><?php echo __('Remember Me', _NP_TEXT_DOMAIN)?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button name="wp-submit" id="wp-submit" type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login
                        </button>
                        <a href="<?php echo site_url('/lost-password')?>"
                           data-dismiss="modal" class="c-btn-forgot"><?php echo __('Forgot Your Password ?', _NP_TEXT_DOMAIN)?></a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account"><?php echo __("Don't Have An Account Yet", _NP_TEXT_DOMAIN)?> ?</span>
                <a href="<?php echo site_url('/sign-up')?>" data-toggle="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup"><?php echo __('Signup!', _NP_TEXT_DOMAIN)?></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
