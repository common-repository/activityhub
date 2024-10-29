<form id="km_newphone_form" method="post">
    <input type="hidden" name="access_token" value="<?php echo $user->data->accessToken; ?>" id="km_access_token" class="km_access_token"/>
    <input type="hidden" name="user_id" value="<?php echo $user->data->_id; ?>" id="km_user_id" class="km_user_id"/>
    <div class="km_updatephone_wrap">
        <div class="verify_text_wrap km_update_phone km_field_wrap km_col_12">
            <p><?php _e("For your security, we want to make sure it's really you. We will send a text message with a 4 digit verification code that you'll need to enter on the next screen.", 'fieldday');?></p>
            <fieldset>
                <input type="hidden" name="new_user_country" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                <input type="tel" placeholder="Phone number" class="km_phone_field km_input"  id="update_phone" name="new_user_phone" placeholder="Phone Number" data-parsley-group="newphone_update"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-required-message="Required" data-parsley-type-message="Only Numbers" data-parsley-group="register" required />
            </fieldset>
        </div>
        <div class="km_col_12 km_btn_wrap km_field_wrap">
            <a href="#" id="km_verify_submit" onclick="fieldday.updatePhone(this, event);" name="sign-submit" class="km_button km_login_button km_primary_bg km_btn">
                <?php _e('Next', 'fieldday');?>
            </a>
        </div>
    </div>
</form>