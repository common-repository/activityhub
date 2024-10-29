<?php
$params = [];
if (isset($sessionId) && $sessionId) {
    $params[] = $sessionId;
}
if (isset($tagId) && $tagId) {
    $params[] = $tagId;
}
if (isset($sessionDate) && $sessionDate) {
    $params[] = $sessionDate;
}
if (isset($offerId) && $offerId) {
    $params = [null, null, null];
    $params[] = $offerId;
}
if (isset($packageId) && $packageId) {
    //$params = [null, null, null];
    $params[] = $packageId;
}
if (isset($_REQUEST['sessionfeatured'])) {
    $sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
    $session_date = filter_input(INPUT_POST, 'session_date', FILTER_SANITIZE_STRING);
    $isGuest = filter_input(INPUT_POST, 'isGuest', FILTER_SANITIZE_STRING);
    $params[] = $sessionfeatured;
}
$link = wp_sprintf('<a href="%s" target="_blank">ActivityHub</a>', 'https://activityhub.com');
?>
<div class="km_login_wrap">
    <?php do_action('km_before_loginpage');?>
    <div class="login_row">
        <div class="km_50 social_login_wrap">
            <div class="km_logo"><img src="<?php echo fieldday_URL ?>/assets/img/icon-big.png">
                <p>Your account is managed and powered by <?php echo $link; ?></p>
            </div>
            <div class="km_facebook_wrap">
                <a href="<?php echo fieldday()->engine->getFacebookAuthUrl($params); ?>" id="km_facebook_login" class="km_button km_btn">
                    <i class="fa fa-facebook"></i><?php _e('Login with Facebook', 'fieldday');?>
                </a>
            </div>
            <div class="km_google_wrap">
                <a href="<?php echo fieldday()->engine->getGooglekAuthUrl($params); ?>" id="km_google_login" class="km_button km_btn">
                    <i class="fa fa-google-plus"></i><?php _e('Login with Google', 'fieldday');?>
                </a>
            </div>
            <hr class="login_page_divider"></hr>
            <div class="km_signup_wrap">
                <?php _e("Don't have an account?", 'fieldday');?> <a href="<?php echo add_query_arg(['action' => 'km_register']); ?>" class="km_button_default km_signup_btn"><?php _e('Sign Up Now!', 'fieldday');?></a>
            </div>
            <div class="km_ajax_signup_wrap km_hidden km_signup_wrap">
                <?php _e("Don't have an account?", 'fieldday');?> <a href="#" <?php echo isset($Registerparams) ? $Registerparams : ''; ?> onclick="return fieldday.showRegisterForm(this, event);" class="km_button_default km_ajax_signup km_signup_btn"><?php _e('Sign Up Now!', 'fieldday');?></a>
            </div>
            <?php if (isset($sessionId) && $sessionId): ?>
                <?php $Registerparams = wp_sprintf("data-session-id='%s' data-tag-id='%s' data-session-date='%s'", $sessionId, $tagId, $sessionDate);?>
                <div class="km_guest_login_wrap">
                    <h4><?php _e('Guest Checkout', 'fieldday');?></h4>
                    <p><?php _e('Proceed without account. Some discounts and coupons might not work.', 'fieldday');?></p>
                    <a href="JavaScript:void(0);" <?php $this->sessionRegister($sessionId, $tagId, $sessionDate, true);?> id="guest-continue" class="km_button_default km_guest_login">
                        <?php _e('Continue as a Guest', 'fieldday');?>
                    </a>
                </div>
            <?php endif;?>
            <?php if (isset($offerId) && $offerId): ?>
                <?php $Registerparams = wp_sprintf("data-offer-id='%s'", $offerId);?>
                <input type="hidden" id="login_form_offerId" value="<?php echo $offerId; ?>">
                <div class="km_guest_login_wrap">
                    <h4><?php _e('Guest Checkout', 'fieldday');?></h4>
                    <p><?php _e('Proceed without account. Some discounts and coupons might not work.', 'fieldday');?></p>
                    <a href="JavaScript:void(0);" <?php $this->merchandiseRegister($offerId, $offername, true);?> id="guest-continue" class="km_button_default km_guest_login">
                        <?php _e('Continue as a Guest', 'fieldday');?>
                    </a>
                </div>
            <?php endif;?>
        </div>
        <div class="login_page_divider"><span><?php _e('OR', 'fieldday');?></span></div>
        <div class="km_50 email_login_wrap">
            <h4><?php _e('Sign in Manually', 'fieldday');?></h4>
            <form id="km_login_form" class="km_login_form" action="#" method="post">
                <input type="hidden" name="action" value="km_login_new"/>
                <input type="hidden" name="sessionfeatured" value="<?php echo $sessionfeatured; ?>"/>
                <input type="hidden" name="sessionDate" value="<?php echo $session_date; ?>"/>
                <?php if (isset($packageId)) {?>
                        <input type="hidden" name="packageId" value="<?php echo $packageId; ?>"/>
                <?php }?>
                <?php if (isset($isGuest)) {?>
                <input type="hidden" name="isGuest" value="true"/>
                <?php } else {?>
                <input type="hidden" name="redirect_url" value="<?php echo isset($redirect) ? $redirect : ''; ?>"/>
                <?php }?>
                <div class="km_col_12 km_field_wrap">
                    <i class="fa fa-user-circle km_user_icon" aria-hidden="true"></i>
                    <input type="email"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,100);"     class="km_input" name="user_name" placeholder="Email Address"  data-parsley-group="km_login" data-parsley-type-message="Invalid Email" data-parsley-required-message="Required" required />
                </div>
                <!-- <div class="km_col_12 km_field_wrap">
                    <i class="fa fa-unlock-alt km_user_icon" aria-hidden="true"></i>
                    <input type="password" class="km_input" name="user_password" placeholder="******"  data-parsley-group="km_login" data-parsley-required-message="Required" required />
                     <i class="fa fa-eye-slash km_password_icon" id="togglePassword"></i>
                </div> -->
                <div class="km_col_12 km_field_wrap">
                    <?php fieldday()->engine->googleRecaptcha();?>
                </div>
                <!-- <div class="km_col_12 km_field_wrap password-remeber">
                    <input name="user-remember-me" class="styled-checkbox" id="user-remember-me" type="checkbox">
                    <label for="user-remember-me"><?php //_e('Remember Me', 'fieldday'); ?></label>
                    <a href="javascript:void(0);" class="km_button_default km_forget_pwd" onclick="return fieldday.showForgetPassword(this, event);"><?php //_e('Forget Password', 'fieldday'); ?></a>
                </div> -->
                <!-- <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="#" id="login-submit" onclick="return fieldday.login(this, event);" name="login-submit" class="km_button km_btn km_primary_bg"><?php //_e('Login', 'fieldday'); ?></a>
                </div> -->
                <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="#" id="login-continue" onclick="return fieldday.login(this, event);" name="login-continue" class="km_button km_btn km_primary_bg km_btn_i_wrapper">
                        <i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>
                    <?php _e('Continue', 'fieldday');?></a>
                </div>
            </form><!-- end user-access-form -->
        </div>
    </div>
</div>
