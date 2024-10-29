<?php
global $fielddaySetting;
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

$link = wp_sprintf('<a href="%s" target="_blank">ActivityHub</a>', 'https://activityhub.com');
?>
<div class="km_register_wrap ">
    <?php do_action('km_before_registerpage');?>
    <div class="register_row">
        <div class="km_50 social_login_wrap">
            <div class="km_logo"><img src="<?php echo fieldday_URL ?>/assets/img/icon-big.png">
                <p>Your account is managed and powered by <?php echo $link; ?></p>
            </div>
            <div class="km_facebook_wrap">
                <a href="<?php echo fieldday()->engine->getFacebookAuthUrl($params); ?>" id="km_facebook_login" class="km_button">
                    <i class="fa fa-facebook"></i><?php _e('Register with Facebook', 'fieldday');?>
                </a>
            </div>
            <div class="km_google_wrap">
                <a href="<?php echo fieldday()->engine->getGooglekAuthUrl($params); ?>" id="km_google_login" class="km_button">
                    <i class="fa fa-google-plus"></i><?php _e('Register with Google', 'fieldday');?>
                </a>
            </div>
            <hr class="login_page_divider"></hr>
            <div class="km_signup_wrap">
                <?php _e("Already have an account?", 'fieldday');?> <a href="<?php echo add_query_arg(['action' => 'km_login']); ?>" class="km_button_default km_signup_btn"><?php _e('Login Here!', 'fieldday');?></a>
            </div>
            <div class="km_ajax_signup_wrap km_hidden km_signup_wrap">
                <?php _e("Already have an account?", 'fieldday');?> <a href="#" <?php echo isset($Registerparams) ? $Registerparams : ''; ?> onclick="return fieldday.showLoginForm(this, event);" class="km_button_default km_signup_btn"><?php _e('Login Here!', 'fieldday');?></a>
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
            <h4><?php _e('Sign Up Manually', 'fieldday');?></h4>
            <form id="km_register_form" class="km_register_form" action="#" method="post">
                <input type="hidden" name="action" value="km_register_new">
                <div class="km_col_12 km_field_wrap required_field">
                    <label for="Fullname"><?php _e('Full Name', 'fieldday');?></label>
                    <i class="fa fa-user-circle km_user_icon" aria-hidden="true"></i>
                    <input type="text" class="km_input"    pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true,1500);"    data-parsley-whitespace="trim"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  name="user-register-name" placeholder="Full Name"  data-parsley-group="register" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap required_field">
                    <label for="email"><?php _e('Email', 'fieldday');?></label>
                    <i class="fa fa-envelope-o km_user_icon" aria-hidden="true"></i>
                    <input type="email" data-parsley-whitespace="trim" class="km_input" name="user-register-email" placeholder="Email Address" data-parsley-group="register"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,100);"     data-parsley-required-message="Required" data-parsley-type-message="Invalid Email" required />
                </div>
                <!-- <div class="km_col_12 km_field_wrap">
                    <label for="password"><?php _e('Password', 'fieldday');?></label>
                    <i class="fa fa-unlock-alt km_user_icon" aria-hidden="true"></i>
                    <input type="password" class="km_input" name="user-register-password" placeholder="******" data-parsley-minlength="6" data-parsley-minlength-message = "Too Short (Min 6)" data-parsley-group="register" data-parsley-required-message="Required" required />
                    <i class="fa fa-eye-slash km_password_icon" id="togglePassword"></i>
                </div> -->
                <div class="km_col_12 km_field_wrap km_phone_input required_field">
                        <label for="phone_no"><?php _e('Phone No', 'fieldday');?></label>
                        <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                        <input type="hidden" name="user-phone-number" class="phone_number" value="<?php $this->getValue('phone', $KmUser);?>">
                        <!--
                        <input type="tel" class="km_phone_field km_input" id="user_phone" placeholder="Phone Number" data-parsley-minlength="12" oninput="fieldday.changePhoneInputPattern();" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-minlength-message="Phone should contain 10 characters"  data-parsley-whitespace="trim"  data-parsley-required-message="Required" data-parsley-type-message="Only Numbers" data-parsley-group="register" required />-->
                        <input type="tel"  class="km_phone_field km_input" id="user_phone" placeholder="Phone Number"  data-parsley-whitespace="trim"  data-parsley-required-message="Required" data-parsley-type-message="Only Numbers" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <?php fieldday()->engine->googleRecaptcha();?>
                </div>
                <!-- <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="#" onclick="return fieldday.register(this, event);" id="signup-submit" class="km_button km_primary_bg km_btn"><?php //_e("Sign Up", 'fieldday'); ?></a>
                </div> -->
                <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="#" onclick="return fieldday.register(this, event);" id="signup-submit" class="km_button km_primary_bg km_btn  km_btn_i_wrapper">
                    <i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>
                    <?php _e("Continue", 'fieldday');?>
                </a>
                </div>
                <div class="km_col_12 accept-privacy"><?php _e("By continuing, you accept the Terms of Use and Privacy Policy", 'fieldday');?></div>
            </form><!-- end user-access-form -->
        </div>
    </div>


</div>
