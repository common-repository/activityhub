<div class="km_varification_col">
    <form id="km_verification_form" class="km_verification_form">
        <input type="hidden" name="access_token" value="<?php echo $user->data->accessToken; ?>" id="km_access_token" class="km_access_token"/>

        <input type="hidden" name="login_token" value="<?php echo $user->data->loginToken; ?>" id="km_login_token" class="km_login_token"/>
        <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user->data->_id; ?>" id="km_user_id" class="km_user_id"/>
        <input type="hidden" name="user_phone_code" value="<?php echo $user->data->countryCode; ?>" id="km_user_id" class="km_user_phone_code"/>
        <input type="hidden" name="user_phone" value="<?php echo $user->data->phone; ?>" id="km_user_id" class="km_user_phone"/>
        <div class="km_otp_verification_wrap">
            <p class="km_verification_text">
                <?php 
                if($is_registered){
                   $mobile_checked = 'checked';
                }else{
                    $gmail_checked = 'checked';
                }
                if($actionp){
                    print apply_filters("fieldday_verification_text", __("Let's make sure it's really you. We've sent a message with fresh verification code. Please use the boxes below to submit the verification code.", 'fieldday'));
                } else {
                    print apply_filters("fieldday_login_verification_text", __("Hi there! We're so glad to have found your <a class='km_secondary_color' style='font-weight:600;' href='https://activityhub.com'>ActivityHub account</a>. Just to make sure everything is secure, we've sent you a fresh verification code. Simply enter the code in the boxes provided and we'll get you all set up. Welcome back!", 'fieldday'));
                }
                ?>
            </p>
            <div class="km_verification_type km_verification_via_email">
                <label class="km_radio_wrap">
                    <span><?php print apply_filters('fieldday_verification_title_email', __('Verification Code via email on ', 'fieldday')); ?><span class="km_secondary_color"><?php echo $user->data->maskedEmail; ?></span></span>
                    <input <?php echo $gmail_checked; ?>  id="km_code_email" data-email="true" class="toggle km_verify_code_type" name="km_verify_code_type" value="email" type="radio">
                    <span class="km_radio"></span>
                </label>
		        <div class="km_verifcatio_hl_txt km_hidden">
                    <p>
    			        <?php _e("Didn't get the Email?", 'fieldday'); ?>
    			        <a id="resend_otp" data-email="true" onclick="return fieldday.LoginresendOtp(this, event);" class="resend_otp disabled" href="#">
                            <?php print apply_filters('fieldday_verification_resend_text_email', __('Resend Code to my email address', 'fieldday')); ?>
                        </a>
                        <span class="otp_timer"></span>
                    </p>
                </div>
            </div>
            <div class="km_verification_type km_verification_via_sms">
                <label class="km_radio_wrap">
                    <span><?php print apply_filters('fieldday_verification_title_sms', __('Verification Code via SMS on ', 'fieldday')); ?> <?php echo $user->data->maskedPhone; ?> </span>
                    <input <?php echo $mobile_checked; ?>   data-email="false" id="km_code_email" class="toggle km_verify_code_type" name="km_verify_code_type" value="sms" type="radio">
                    <span class="km_radio"></span>
                </label>
		        <div class="km_verifcatio_hl_txt">
                    <p><?php _e("Didn't get the SMS message?", 'fieldday'); ?>
                        <a id="resend_otp" data-email="false" onclick="return fieldday.LoginresendOtp(this, event);" class="resend_otp disabled" href="#">
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
                <a href="#" id="km_verify_submit" onclick="fieldday.LoginverifyOTP(this, event);" name="sign-submit" class="km_button km_login_button km_primary_bg km_btn_i_wrapper">
                <i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>
                <?php _e('verify', 'fieldday'); ?>
                </a>
            </div>
        </div>
    </form>
</div>