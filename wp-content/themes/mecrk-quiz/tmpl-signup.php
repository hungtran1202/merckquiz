<?php
/**
 * Template name: Sign Up
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
$lostPass = isset($_REQUEST['checkemail']) ? $_REQUEST['checkemail'] : '';
$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : '';
?>
<div class="c-content-login-form"
     style="background: url(<?php echo _NP_TEMPLATE_URL . '/assets/base/img/content/backgrounds/bg-43.jpg' ?>) no-repeat center; background-size: cover; padding: 20px 0">
    <div class="modal-dialog">
        <div class="modal-content" style="margin: 0;">
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Sign Up', _NP_TEXT_DOMAIN) ?></h3>

                <p><?php echo __("Let's make today a great day!", _NP_TEXT_DOMAIN)?></p>

                <div class="message-signup alert hidden"></div>
                <form name="signup" id="signup2" method="post" class="signup">
                    <div class="form-group">
                        <label for="email" class="hide">Email *</label>
                        <input name="email" type="email" class="form-control input-lg c-square" id="email"
                               placeholder="Email *" >
                    </div>
                    <div class="form-group">
                        <label for="signup-username" class="hide"><?php echo __('Username *', _NP_TEXT_DOMAIN)?></label>
                        <input name="username" type="text" class="form-control input-lg c-square username" id="signup-username"
                               placeholder="<?php echo __('Username *', _NP_TEXT_DOMAIN)?>" >
                    </div>
                    <div class="form-group">
                        <label for="signup-fullname" class="hide"><?php echo __('Fullname *', _NP_TEXT_DOMAIN)?></label>
                        <input name="fullname" type="text" class="form-control input-lg c-square" id="signup-fullname"
                               placeholder="<?php echo __('Fullname *', _NP_TEXT_DOMAIN)?>" >
                    </div>
                    <div class="form-group">
                        <label for="signup-phone" class="hide"><?php echo __('Phone', _NP_TEXT_DOMAIN)?></label>
                        <input name="phone" type="tel" class="form-control input-lg c-square" id="signup-phone"
                               placeholder="<?php echo __('Phone', _NP_TEXT_DOMAIN)?>" >
                    </div>
                    <div class="form-group">
                        <label for="password" class="hide"><?php echo __('Password *', _NP_TEXT_DOMAIN)?></label>
                        <input name="password" type="password" minlength="6" class="form-control input-lg c-square password" id="password"
                               placeholder="<?php echo __('Password *', _NP_TEXT_DOMAIN)?>">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword" class="hide"><?php echo __('Confirm Password', _NP_TEXT_DOMAIN)?></label>
                        <input name="confirmPassword" type="password" class="form-control input-lg c-square confirmPassword" id="confirmPassword"
                               placeholder="<?php echo __('Confirm Password *', _NP_TEXT_DOMAIN)?>">
                        <div id="message-confirm" class="message-confirm *"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login btn-signup">
                            <?php echo __('Signup', _NP_TEXT_DOMAIN)?>
                        </button>
                        <a href="<?php echo site_url('/login')?>" class="c-btn-forgot"
                           data-dismiss="modal"><?php echo __('Go To Login', _NP_TEXT_DOMAIN)?></a>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account"><?php echo __("Forgot password?", _NP_TEXT_DOMAIN)?></span>
                <a href="<?php echo site_url('/lost-password')?>" data-toggle="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup"><?php echo __('Reset Password')?></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
