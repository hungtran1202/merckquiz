<?php
/**
 * Template name: Lost Password
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
merckquiz_redirectIsLogged();

$lostPass = isset($_REQUEST['checkemail']) ? $_REQUEST['checkemail'] : '';
$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : '';
?>
<div class="c-content-login-form"
     style="background: url(<?php echo _NP_TEMPLATE_URL . '/assets/base/img/content/backgrounds/bg-43.jpg' ?>) no-repeat center; background-size: cover; padding: 20px 0">
    <div class="modal-dialog">
        <div class="modal-content" style="margin: 0;">
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Lost Password', _NP_TEXT_DOMAIN) ?></h3>

                <p><?php echo __("Let's make today a great day!", _NP_TEXT_DOMAIN)?></p>
                <?php
                if ($lostPass == 'false') {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo __('There is no user registered with that email address.', _NP_TEXT_DOMAIN)?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($lostPass == 'confirm') {
                    ?>
                    <div class="alert alert-success">
                        <?php echo __('Check your email for the confirmation link.', _NP_TEXT_DOMAIN)?>
                    </div>
                    <?php
                }
                ?>
                <form name="lostpasswordform" id="lostpasswordform" action="<?php echo site_url('/wp-login.php?action=lostpassword')?>"  method="post">
                    <div class="form-group">
                        <label for="user_login" class="hide"><?php echo __('Email *', _NP_TEXT_DOMAIN)?></label>
                        <input name="user_login" type="email" class="form-control input-lg c-square" id="user_login"
                               placeholder="<?php echo __('Email *', _NP_TEXT_DOMAIN)?>"></div>
                    <div class="form-group">
                        <button name="wp-submit" id="wp-submit" type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">
                            <?php echo __('Submit', _NP_TEXT_DOMAIN)?>
                        </button>
                        <a href="<?php echo site_url('/login')?>" class="c-btn-forgot"
                           data-dismiss="modal"><?php echo __('Back To Login', _NP_TEXT_DOMAIN)?></a>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account"><?php echo __("Don't Have An Account Yet", _NP_TEXT_DOMAIN)?> ?</span>
                <a href="<?php echo site_url('/sign-up')?>" data-toggle="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
