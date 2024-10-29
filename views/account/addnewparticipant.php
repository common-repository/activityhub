<?php
$skillLevelOption = $sessionInfo->skillLevelOption;
?>
<form class="km_form_kid_add" method="post" name="form-kid-add" id="km_form_kid_add" enctype="multipart/form-data">
<div data-participant-text="<?php $this->displayText('km_kid_text');?>" class="km_single_kid_wrap">
    <!-- <span title="<?php //_e("Click here to remove participant!", 'fieldday'); ?>" class="km_delete_participant <?php //echo $counter == 1 ? 'disabled' : ''; ?>"><i class="fa fa-trash"></i></span> -->
    <div class="km_atc_single_kid km_kids_fields_wrap km_add_new_participant_form_extrr">
        <!-- <div class="km_kidform_header">
            <h3><?php //print wp_sprintf("%s %d", $this->displayText('km_kid_text', false), $counter); ?></h3>
        </div>
        <input type="hidden" name="ATC[kids][<?php //echo $counter; ?>][_id]" value="<?php //echo $kidId; ?>" >-->
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('First Name', 'fieldday');?></label>
                <input type="text"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   name="firstName" class="km_input" data-parsley-group="new_kid_create" data-parsley-required-message="Required" id="new_kid_first_name" required="">
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Last Name', 'fieldday');?></label>
                <input type="text"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   class="km_input" name="lastName" data-parsley-group="new_kid_create" data-parsley-required-message="Required" id="new_kid_first_name" required="">
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Known As', 'fieldday');?></label>
                <input type="text"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   class="km_input" name="knownAs" id="new_kid_first_name">
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Gender', 'fieldday');?></label>
                <div class="km_gender_wrap">
                         <select data-name="school" name="gender" class="km_input ">
                             <option value="">-select gender-</option>
                             <option value="male"><?php _e('Male', 'fieldday');?></option>
                             <option value="female"><?php _e('Female', 'fieldday');?></option>
                         </select>
                     </div>
            </fieldset>
        </div>
        <?php
if ($skillLevelOption == 'grade') {
    $gradefrom = $sessionInfo->gradeRange->from ?? $sessionInfo->activityId->gradeRange->from;
    $gradeto = $sessionInfo->gradeRange->to ?? $sessionInfo->activityId->gradeRange->to;
    $Grades = $this->KidsGradesOptions($gradefrom, $gradeto);
    ?>
                <div class="km_col_4 km_field_wrap">
                    <fieldset class="">
                        <label><?php _e('Grade', 'fieldday');?></label>
                        <select data-name="school" name="grade" class="km_input km_select" data-parsley-group="new_kid_create" data-parsley-required-message="Required"  required="">
                            <option value="">- select -</option>
                            <?php
foreach ($Grades as $grade) {?>
                                    <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                <?php }
    ?>

                        </select>
                    </fieldset>
                </div>
            <?php } else {?>
                <div class="km_col_4 km_field_wrap">
                    <fieldset class="">
                        <label><?php _e('Date of Birth', 'fieldday');?></label>
                        <?php $this->fielddayDateField(['name' => "dob"], null, $sessionInfo);?>
                    </fieldset>
                </div>
            <?php }?>

        <div class="km_col_4 km_field_wrap km_field_school_select">
            <label><?php _e('School', 'fieldday');?></label>
            <select data-name="school" onchange="fieldday.getSchoolData(this,event, 'grade', 'track');" name="school" class="km_input km_select fieldday_select">
                <option value="">-select school-</option>
                <?php $this->displaySchools($this->getValue('school', $school, false));?>
            </select>
        </div>
        <div class="km_row">
                <div class='km_school_grades'></div>
                <div class='km_school_tracks'></div>
        </div>

    </div>
    <div class="km_field_wrap km_row km_col_12 km_add_kid_buttons"><a href="" class="km_add_participant_cancel km_btn km_primary_color km_transparent_bg">Cancel</a><a href='' class='km_add_participant km_btn km_btn_green km_primary_bg'>Save</a></div>
</div>
</form>