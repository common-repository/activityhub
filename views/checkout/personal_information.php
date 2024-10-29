<?php
/*
 * Display user personal information for purchase step
 *
 * @param $KmUser Logged in user data
 * @param $step current step information
 *
 */
?>
<div id="<?php echo $step['name']; ?>" class="<?php echo $step['classes']; ?>">
    <h2 class="km_progress_header km_primary_color"><?php echo $step['label']; ?></h2>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label><?php _e('Full Name', 'fieldday')?></label>
            <input type="text"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail'])) {echo $_SESSION['Gpersonal_detail']['fullname'];} else { $this->getValue('name', $KmUser);}?>" name="parent[name]" class="km_input" data-parsley-group="<?php echo $step['name']; ?>" data-parsley-required-message="Required"  required=""/>
        </fieldset>
    </div>

    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label><?php _e('Email', 'fieldday');?></label>
            <input type="email"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"  value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail'])) {echo $_SESSION['Gpersonal_detail']['guestEmail'];} else { $this->getValue('email', $KmUser);}?>" name="parent[guestEmail]" id="parentEmail" data-parsley-group="<?php echo $step['name']; ?>" class="km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Email" required=""/>
        </fieldset>
    </div>

    <div class="km_col_4 km_field_wrap km_field_gender">
        <fieldset class="">
            <label for="profile-gender"><?php _e('Gender', 'fieldday');?></label>
            <div class="km_custom_dropdown">
                <select id="parentgenderStatus" name="parent[gender]" class="km_input" data-parsley-group="<?php echo $step['name']; ?>">
                    <option value="" ><?php _e('Select', 'fieldday');?></option>
                    <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'male' ? 'selected' : ''; ?> value="male"><?php _e('Male', 'fieldday');?></option>
                    <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'female' ? 'selected' : ''; ?> value="female"><?php _e('Female', 'fieldday');?></option>
                </select>
            </div><!-- end custom-radio-wrapper -->
        </fieldset>
    </div>

    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="profile-phone-number"><?php _e('Phone Number', 'fieldday');?></label>
            <input type="hidden" name="parent[countryCode]" class="country_code" value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail'])) {echo $_SESSION['Gpersonal_detail']['phonecode'];} else { $this->getValue('countryCode', $KmUser, false) ? $this->getValue('countryCode', $KmUser, false) : 1; } ?>">
            <input type="hidden" name="parent[phone]" class="phone_number" value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail'])) {echo str_replace(' ', '', $_SESSION['Gpersonal_detail']['phone']);} else { $this->getValue('phone', $KmUser);}?>">

            <input type="hidden"   name="users-countrycode" class="users_countrycode" value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail']['countrycode'])) {echo $_SESSION['Gpersonal_detail']['countrycode'];} else {echo $kmGetCountryCode = fieldday()->engine->kmGetCountryCode();}?>">

            <input id="parent_phone" name="phonenumber" value="<?php if (!$kmUser && isset($_SESSION['Gpersonal_detail'])) {echo $_SESSION['Gpersonal_detail']['phone'];} else { echo $this->getValue('phone', $KmUser); /*echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode();*/}?>" data-parsley-group="<?php echo $step['name']; ?>" class="km_phone_field km_input" data-parsley-required-message="Required"  required="" type="tel"  data-parsley-minlength-message="Phone should contain 10 characters">
        </fieldset>
    </div>

    <div class="km_col_4 km_field_wrap">
        <fieldset class=" select-wrapper">
            <label for="parentMaritalStatus"><?php _e('Marital Status', 'fieldday');?></label>
            <div class="km_custom_dropdown">
                <select id="parentMaritalStatus" name="parent[maritalStatus]" class="km_input" data-parsley-group="<?php echo $step['name']; ?>">
                    <option value="" ><?php _e('Select', 'fieldday');?></option>
                    <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'single' ? 'selected' : ''; ?> value="single"><?php _e('Single', 'fieldday');?></option>
                    <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'married' ? 'selected' : ''; ?> value="married"><?php _e('Married', 'fieldday');?></option>
                </select>
            </div>
        </fieldset>
    </div>
    <div class="km_btn_wrap">
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_bg" data-group="<?php echo $step['name']; ?>" onclick="return fieldday.process_personal_info(this, event);"><?php _e('Next', 'fieldday');?></a>
    </div>
</div>