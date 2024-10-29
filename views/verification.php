<div class="km_varification_col">
    <form id="km_verification_form" class="km_verification_form">
        <input type="hidden" name="access_token" value="<?php echo $user->data->accessToken; ?>" id="km_access_token" class="km_access_token"/>
        
        <input type="hidden" name="user_id" value="<?php echo $user->data->_id; ?>" id="km_user_id" class="km_user_id"/>
        <input type="hidden" name="user_phone_code" value="<?php echo $user->data->countryCode; ?>" id="km_user_id" class="km_user_phone_code"/>
        <input type="hidden" name="user_phone" value="<?php echo $user->data->phone; ?>" id="km_user_id" class="km_user_phone"/>
        <div class="km_otp_verification_wrap">
            <p class="km_verification_text">
                <?php print apply_filters("fieldday_verification_text", __("Let's make sure it's really you. We've sent a message with fresh verification code. Please use the boxes below to submit the verification code.", 'fieldday')); ?>
            </p>

            <div class="km_verification_type km_verification_via_email">
                <label class="km_radio_wrap">
                    <span><?php print apply_filters('fieldday_verification_title_email', __('Verification Code via email on ', 'fieldday')); ?><span class="km_secondary_color"><?php echo $this->emailMasking($user->data->email); ?></span></span>
                    <input id="km_code_email" class="toggle km_verify_code_type" name="km_verify_code_type" value="email" type="radio">
                    <span class="km_radio"></span>
                </label>
		<div class="km_verifcatio_hl_txt km_hidden">
                    <p>
			<?php _e("Didn't get the Email?", 'fieldday'); ?>
			<a id="resend_otp" onclick="return fieldday.resendOtp(this, event);" class="resend_otp disabled" href="#">
                            <?php print apply_filters('fieldday_verification_resend_text_email', __('Resend Code to my email address', 'fieldday')); ?>
                        </a>
                        <span class="otp_timer"></span>
                    </p>
                </div>
            </div>
            <div class="km_verification_type km_verification_via_sms">
                <label class="km_radio_wrap">
                    <span><?php print apply_filters('fieldday_verification_title_sms', __('Verification Code via SMS on ', 'fieldday')); ?> <?php echo $this->ccMasking($user->data->phone); ?> </span>
                    <input checked="" id="km_code_email" class="toggle km_verify_code_type" name="km_verify_code_type" value="sms" type="radio">
                    <span class="km_radio"></span>
                </label>
		<div class="km_verifcatio_hl_txt">
                    <p><?php _e("Didn't get the SMS message?", 'fieldday'); ?>
                        <a id="resend_otp" onclick="return fieldday.resendOtp(this, event);" class="resend_otp disabled" href="#">
                            <?php print apply_filters('fieldday_verification_resend_text_sms', __('Resend Code to my phone', 'fieldday')); ?>
                        </a>
                        <span class="otp_timer"></span>
                    </p>
                </div>
            </div>
            <div class="verify_text_wrap">
                <input type="text" name="otp[]" class="km_otp_number" maxlength="1"/>
                <input type="text" name="otp[]" class="km_otp_number" maxlength="1"/>
                <input type="text" name="otp[]" class="km_otp_number" maxlength="1"/>
                <input type="text" name="otp[]" class="km_otp_number" maxlength="1"/>
            </div>
            <span class="otp_number_error"></span>
            <div class="km_btn_wrap">
                <a href="#" id="km_verify_submit" onclick="fieldday.verifyOtp(this, event);" name="sign-submit" class="km_button km_login_button km_primary_bg km_btn_i_wrapper">
                <i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>
                <?php _e('verify', 'fieldday'); ?>
                </a>
            </div>
        </div>
    </form>
</div>
