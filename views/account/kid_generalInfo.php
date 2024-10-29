<h3><?php _e('GENERAL INFORMATION', 'fieldday');?></h3>
<form id ="km_kid_profile_update" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="<?php $this->getValue('_id', $profile);?>" name="id"/>
    <div class="km_row">
        <div class="km_col_2 km_profile_pic_wrap">
            <div class="profile-pic-upload">
                <div class="image-preview">
                    <div id="image-preview-inner" class="image-preview-inner">
                        <?php print $this->getfielddayKidDP($profile);?>
                    </div>
                </div>

                <label for="ParentPicUpload">
                    <input type="file" id="ParentPicUpload" class="picUpload" name="kidProfilePic" onchange=" fieldday.readURL(this);">
                    <span><?php _e('Change Picture', 'fieldday')?></span>
                </label>
            </div>
        </div>

        <div class="km_col_10 km_profile_fields km_kids_fields_wrap">
            <div class="km_col_4 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('First Name', 'fieldday');?></label>
                    <input type="text" data-name="firstName" value="<?php $this->getValue('firstName', $profile);?>" name="firstName" class="km_input" data-parsley-group="update_kid" data-parsley-required-message="Required"  required=""/>
                </fieldset>
            </div>
            <div class="km_col_4 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Last Name', 'fieldday');?></label>
                    <input type="text" data-name="lastName" name="lastName" value="<?php $this->getValue('lastName', $profile);?>" class="km_input" data-parsley-group="update_kid" data-parsley-required-message="Required"  required=""/>
                </fieldset>
            </div>
            <div class="km_col_4 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Known As', 'fieldday');?></label>
                    <input type="text" data-name="knownAs" name="knownAs" value="<?php $this->getValue('knownAs', $profile);?>" class="km_input"/>
                </fieldset>
            </div>
            <div class="km_col_4 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Gender', 'fieldday');?></label>
                    <div class="km_gender_wrap">
                        <div class="km_custom_toggle_wrapper km_input ">
                            <div class="km_gender">
                                <label class="km_radio_wrap">
                                    <span><?php _e('Male', 'fieldday');?></span>
                                    <input data-name="gender" <?php echo $this->getValue('gender', $profile, false) == 'male' ? 'checked' : ''; ?> id="gender-male" class="toggle km_kid_gender" name="gender" value="male" type="radio">
                                    <span class="km_radio"></span>
                                </label>
                            </div>
                            <div class="km_gender">
                                <label class="km_radio_wrap">
                                    <span><?php _e('Female', 'fieldday');?></span>
                                    <input data-name="gender" <?php echo $this->getValue('gender', $profile, false) == 'female' ? 'checked' : ''; ?> id="gender-female" class="toggle km_kid_gender" name="gender" value="female" type="radio">
                                    <span class="km_radio"></span>
                                </label>
                            </div>
                        </div><!-- end custom-radio-wrapper -->
                    </div>
                </fieldset>
            </div>
            <div class="km_col_4 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Date of Birth', 'fieldday');?></label>
                    <?php $this->fielddayDateField(['name' => "dob"], $this->getValue('dob', $profile, false), []);?>
                </fieldset>
            </div>
            <div class="km_col_4 km_field_wrap km_field_school_select">
                <fieldset class="">
                    <label><?php _e('School', 'fieldday');?></label>
                    <select data-name="school" onchange="fieldday.getSchoolData(this,event, 'grade', 'track');" name="school" class="km_input km_select fieldday_select">
                        <option value="">-select school-</option>
                        <?php $this->displaySchools($this->getValue('school', $profile, false));?>
                    </select>
                </fieldset>
            </div>
            <?php if ($gradeselected = $this->getValue('grade', $profile, false)): ?>
                <div class='km_col_4 km_field_wrap km_school_grades'>
                    <fieldset class="">
                        <label><?php _e('Grade', 'fieldday');?></label>
                        <select data-name="grade" class="km_input" name="grade">
                            <?php
foreach ($this->getValue('grades', $profile->school, false) as $key => $grade):
    $selected = ($grade == $gradeselected) ? "selected" : "";
    print wp_sprintf('<option %s value="%s">%s</option>', $selected, $grade, $grade);
endforeach;
?>
                        </select>
                    </fieldset>
                </div>
            <?php endif;?>
            <?php if ($trackselected = $this->getValue('track', $profile, false)): ?>
                <div class='km_col_4 km_field_wrap km_school_tracks'>
                    <fieldset class="">
                        <label><?php _e('Track', 'fieldday');?></label>
                        <select data-name="track" class="km_input" name="track">
                            <?php
foreach ($this->getValue('tracks', $profile->school, false) as $key => $track):
    $selected = ($track == $trackselected) ? "selected" : "";
    print wp_sprintf('<option %s value="%s">%s</option>', $selected, $track, str_replace('track_', '', $track));
endforeach;
?>
                        </select>
                    </fieldset>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="km_col_12 km_field_wrap km_center_align_btns_nw">
        <a href="<?php echo (isset($permalink)) ? add_query_arg('action', 'kidsinfo', $permalink) : remove_query_arg('id'); ?>" class="km_btn btn--green km_primary_color  km_transparent_bg" id="km_back_to_kids"><?php _e('Back to Kids', 'fieldday');?></a>
        <a href="#" id="km_update_profile" class="km_btn km_update_profile km_primary_bg"><?php _e('Save', 'fieldday');?></a>
    </div>
</form>
<?php
//DOCTORS
$km_kid_id = $_REQUEST['id'];
$kidId = filter_var($km_kid_id, FILTER_SANITIZE_STRING);
$kidData = fieldday()->api->GetKidDetail($kidId);
$page = 'account/kid_doctors';
if ($kidData->statusCode !== 200) {
    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
} else {
    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'doctor_info' => $kidData->data->doctors]);
}
echo $content;

//MEDICAL
$page = 'account/kid_medical';
if ($kidData->statusCode !== 200) {
    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
} else {
    //print_r($kidData);
    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'kid_heathConcerns' => $kidData->data->healthConcerns, 'kid_treatments' => $kidData->data->treatments, 'kid_symptoms' => $kidData->data->symptoms]);
}
echo $content;

//ALLERGIES
$page = 'account/kid_allergies';
if ($kidData->statusCode !== 200) {
    $content = wp_sprintf("<div class='fieldday-message km_alert_error'>%s</div>", $kidData->message);
} else {
    $content = fieldday()->engine->getView($page, ['kidId' => $kidId, 'kid_environment_allergies' => $kidData->data->environmentAllergies, 'kid_food_allergies' => $kidData->data->foodAllergies, 'kid_dietRestricts' => $kidData->data->dietRestricts, 'kid_medication_allregies' => $kidData->data->medicationAllergies]);
}
echo $content;
?>