<?php
if (!$captcha) {$captcha = '';}
if (!$phoneID) {$phoneID = 'parentPhone';}
if (!$Heading) {$Heading = 'Request a Demo';}
if (!$SubHeading) {$SubHeading = 'Please use this form to reach out to us. We will respond within 24 to 48 hours.';}
if (!$btnText) {$btnText = 'Submit';}
$recaptcha = fieldday()->engine->googleRecaptcha($captcha, true);
?>
<div class="km_contactform_wrap">
    <div class="email_login_wrap">
            <!-- <h4><?php //_e($Heading, 'fieldday'); ?></h4>
            <h5><?php //_e($SubHeading, 'fieldday'); ?></h5> -->
            <div class="km_col_12 km_contact_message"></div>
            <form id="km_contact_form" class="km_contact_form" action="#" method="post">
                <!-- <input type="hidden" name="action" value="km_contactform"/> -->
                <div class="km_col_12 km_field_wrap">
                    <input type="text" class="km_input"      oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"     data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."   name="cont_name" placeholder="First Name*"  data-parsley-group="km_contact" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <input type="text" class="km_input"     oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"      data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."   name="cont_lname" placeholder="Last Name*" data-parsley-group="km_contact" data-parsley-required-message="Required" required/>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <input type="text" class="km_input"      oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"    name="cont_businessname" placeholder="Business Name*" data-parsley-group="km_contact" data-parsley-required-message="Required" required/>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <input type="email"   data-parsley-type="email" data-parsley-trigger="keyup"
                    data-parsley-type-message="Invalid Email"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,100);"     class="km_input" name="cont_email" placeholder="Email Address*"  data-parsley-group="km_contact" data-parsley-type-message="Invalid Email" data-parsley-required-message="Required" required />
                </div>
                <div class="km_col_12 km_field_wrap">
                    <input type="url" class="km_input" name="cont_website" placeholder="Website*" data-parsley-pattern="/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/" data-parsley-group="km_contact" data-parsley-required-message="Required" required/>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                    <input type="hidden" name="users-countrycode" class="users_countrycode" value="<?php echo $kmGetCountryCode = fieldday()->engine->kmGetCountryCode(); ?>">
                    <input type="text" value=""  placeholder="Phone*" name="personal_phone" id="<?php echo $phoneID; ?>" data-parsley-group="km_contact" class="km_phone_field km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Phone" required=""  data-parsley-minlength-message="Phone should contain 10 characters"/>
                </div>
                <div class="km_col_12 km_field_wrap">
                    <?php echo $recaptcha; //fieldday()->engine->googleRecaptcha($captcha);                                                                 ?>
                </div>
                <div  class="km_col_12 km_field_wrap km_btn_wrap">
                    <a href="javascript:;" id="demo-submit" name="demo-submit" class="km_button km_btn km_primary_bg"><?php _e($btnText, 'fieldday');?></a>
                </div>
            </form><!-- end user-access-form -->
        </div>
</div>