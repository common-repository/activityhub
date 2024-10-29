<div class="km_profile_update_wrapper">
<h3><?php _e('Personal Information', 'fieldday');?></h3>
<form id ="profile_update" method="POST" enctype="multipart/form-data">
    <div class="km_row">
        <div class="km_col_2 km_profile_pic_wrap">
            <div class="profile-pic-upload">
                <div class="image-preview">
                    <div id="image-preview-inner" class="image-preview-inner">
                        <?php print $this->getfielddayUserDP();?>
                    </div>
                </div>

                <label for="ParentPicUpload">
                    <input type="file" id="ParentPicUpload" class="picUpload" name="ParentPicUpload" onchange=" fieldday.readURL(this);">
                    <span class="km_primary_color  km_transparent_bg"><?php _e('Change Picture', 'fieldday')?></span>
                </label>
            </div>
        </div>

        <div class="km_col_10 km_profile_fields">

            <div class="km_row">
                <div class="km_col_6 km_field_wrap">
                    <label><?php _e('Full Name', 'fieldday')?></label>
                    <input type="text"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  value="<?php $this->getValue('name', $KmUser);?>" name="name" value="" class="km_input" data-parsley-group="profile_fields" data-parsley-required-message="Required"  required=""/>
                </div>
                <div class="km_col_6 km_field_wrap">
                    <label><?php _e('Email', 'fieldday');?></label>
                    <input type="email" oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,100);"   value="<?php $this->getValue('email', $KmUser);?>" name="email" value="" id="parentEmail"  class="km_input"  disabled>
                </div>
            </div>

            <div class="km_row">
                <div class="km_col_4 km_field_wrap km_field_gender">
                    <label for="profile-gender"><?php _e('Gender', 'fieldday');?></label>
                    <div class="km_custom_toggle_wrapper km_input km_profile_updt_gender">
                        <div class="km_gender">
                            <label class="km_radio_wrap">
                                <span><?php _e('Male', 'fieldday');?></span>
                                <input <?php echo $this->getValue('gender', $KmUser, false) == 'male' ? 'checked' : ''; ?> id="gender-male" class="toggle" name="gender" value="male" type="radio">
                                <span class="km_radio"></span>
                            </label>
                        </div>
                        <div class="km_gender">
                            <label class="km_radio_wrap">
                                <span><?php _e('Female', 'fieldday');?></span>
                                <input <?php echo $this->getValue('gender', $KmUser, false) == 'female' ? 'checked' : ''; ?> id="gender-female" class="toggle" name="gender" value="female" type="radio">
                                <span class="km_radio"></span>
                            </label>
                        </div>
                    </div><!-- end custom-radio-wrapper -->
                </div>
                <div class="km_col_4 km_field_wrap">
                    <label for="profile-phone-number"><?php _e('Phone Number', 'fieldday');?></label>
                    <input type="hidden" class="country_code" value="<?php echo $this->getValue('countryCode', $KmUser, false) ? $this->getValue('countryCode', $KmUser, false) : 1; ?>">
                    <input id="home" value="<?php $this->getValue('phone', $KmUser);?>" class="km_phone_field km_input" name="phone" type="tel" disabled>
                </div>
                <div class="km_col_4 km_field_wrap">
                    <label for="parentMaritalStatus"><?php _e('Marital Status', 'fieldday');?></label>
                    <div class="km_custom_dropdown">
                        <select id="parentMaritalStatus" name="maritalStatus" class="km_input" data-parsley-group="profile_fields" data-parsley-required-message="Required"  required="">
                            <option value="" ><?php _e('Select', 'fieldday');?></option>
                            <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'single' ? 'selected' : ''; ?> value="single"><?php _e('Single', 'fieldday');?></option>
                            <option <?php echo $this->getValue('maritalStatus', $KmUser, false) == 'married' ? 'selected' : ''; ?> value="married"><?php _e('Married', 'fieldday');?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="km_col_12 km_field_wrap">
                <a href="#" id="update-user-submit" onclick="return fieldday.updateParent(this, event);" name="update-user-submit" class="km_button km_primary_bg"><?php _e('Save', 'fieldday');?></a>
            </div>
        </div>
    </div>
</form>
</div>