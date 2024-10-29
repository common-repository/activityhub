<?php
$recaptcha = fieldday()->engine->googleRecaptcha('', true);
global $fielddaySetting;
$vendor = array_key_exists('siteName', $fielddaySetting) ? $fielddaySetting['siteName'] : null;
?>
<div class="km_partyform_wrap">
    <div class="email_login_wrap">
            <h4><?php _e('Inquire about this party', 'fieldday');?></h4>
            <h5><?php _e('Please use this form to inquire about party. We will respond within 24 to 48 hours.', 'fieldday');?></h5>
            <div class="km_col_12 km_success_message"></div>
            <form id="km_party_form" class="km_party_form" action="#" method="post">
                <!-- <input type="hidden" name="action" value="km_contactform"/> -->
                <div class="km_col_12 km_field_wrap">
                    <label>Your Name<span class="km_asterisk">*</span></label>
                    <input type="text"     oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"   pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  class="km_input" name="cont_name" placeholder=""  data-parsley-group="km_party" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <label>Your Email<span class="km_asterisk">*</span></label>
                    <input type="email"  data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-type-message="Invalid Email"  class="km_input" name="cont_email" placeholder=""  data-parsley-group="km_party" data-parsley-type-message="Invalid Email" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <label>Phone<span class="km_asterisk">*</span></label>
                    <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                    <input type="hidden" name="users-countrycode" class="users_countrycode" value="<?php echo $kmGetCountryCode = fieldday()->engine->kmGetCountryCode(); ?>">
                    <input type="text" value="" name="personal_phone" id="p_phone" data-parsley-group="km_party" class="km_phone_field km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Phone" required=""  data-parsley-minlength-message="Phone should contain 10 characters"/>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <label>Locations<span class="km_asterisk">*</span></label>
                    <select name="cont_locations" data-parsley-group="km_party" data-parsley-required-message="Required" required>
                        <option value="">Select Location</option>
                        <option value="Offsite Location">Offsite Location</option>
                        <option value="<?php echo $vendor; ?>"><?php echo $vendor; ?></option>
                    </select>
                </div>
                <div class="km_col_12 km_field_wrap">
                   <label> When is your party planned for?<span class="km_asterisk">*</span> <span class="km_field_indicate">(We will try our best to accommodate)</span></label>
                   <input type="text" class="km_input km_date_field" name="cont_date" data-parsley-group="km_party" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                   <label>Estimated headcount<span class="km_asterisk">*</span></label>
                   <input type="text"     oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"    class="km_input" name="cont_estimate" data-parsley-group="km_party" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <label>Add-ons/Special Requests<span class="km_asterisk">*</span></label>
                    <textarea class="km_input"    oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,2000);"
                     name="cont_message" rows="3" data-parsley-group="km_party" data-parsley-required-message="Required" required=""></textarea>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <?php echo $recaptcha; ?>
                </div>
                <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="javascript:;" id="partyform-submit" name="partyform-submit" class="km_button km_btn km_primary_bg"><?php _e('Submit', 'fieldday');?></a>
                </div>
            </form><!-- end user-access-form -->
        </div>
</div>