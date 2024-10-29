<?php
$skillLevelOption = $sessionInfo->skillLevelOption;
?>

<div data-participant-text="<?php $this->displayText('km_kid_text');?>" class="km_single_kid_wrap">
    <span title="<?php _e("Click here to remove participant!", 'fieldday');?>" class="km_delete_participant <?php echo $counter == 1 ? 'disabled' : ''; ?>"><i class="fa fa-trash"></i></span>
    <div class="km_atc_single_kid km_kids_fields_wrap  km_add_new_participant_form_extrr">
        <div class="km_kidform_header">
            <h3><?php print wp_sprintf("%s %d", $this->displayText('km_kid_text', false), $counter);?></h3>
        </div>
        <input type="hidden" name="ATC[kids][<?php echo $counter; ?>][_id]" value="<?php echo $kidId; ?>" >
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('First Name', 'fieldday');?></label>
                <input type="text"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"   data-parsley-type="alphanum" data-parsley-trigger="keyup"   data-parsley-type-message="No special character allowed."  autocomplete="off" data-name="firstName" value="<?php $this->getValue('firstName', $profile);?>" name="ATC[kids][<?php echo $counter; ?>][firstName]" class="km_input" data-parsley-group="atc_field" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Last Name', 'fieldday');?></label>
                <input type="text"    oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"   data-parsley-type="alphanum" data-parsley-trigger="keyup"  data-parsley-type-message="No special character allowed."  autocomplete="off" data-name="lastName" name="ATC[kids][<?php echo $counter; ?>][lastName]" value="<?php $this->getValue('lastName', $profile);?>" class="km_input" data-parsley-group="atc_field" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Known As', 'fieldday');?></label>
                <input type="text"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"   data-parsley-type="alphanum" data-parsley-trigger="keyup"  data-parsley-type-message="No special character allowed."  autocomplete="off" data-name="knownAs" name="ATC[kids][<?php echo $counter; ?>][knownAs]" value="<?php $this->getValue('knownAs', $profile);?>" class="km_input"/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="">
                <label><?php _e('Gender', 'fieldday');?></label>
                <select  data-parsley-type="alphanum"   data-parsley-type-message="Invalid"  data-name="school" name="ATC[kids][<?php echo $counter; ?>][gender]" class="km_input km_select fieldday_select">
                    <option value="">- select -</option>
                    <option <?php echo $this->getValue('gender', $profile, false) == 'male' ? 'selected' : ''; ?> value="male"><?php _e('Male', 'fieldday');?></option>
                    <option <?php echo $this->getValue('gender', $profile, false) == 'female' ? 'selected' : ''; ?> value="female"><?php _e('Female', 'fieldday');?></option>
                </select>
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
                        <select data-name="school" name="ATC[kids][<?php echo $counter; ?>][grade]" class="km_input km_select fieldday_select" data-parsley-group="atc_field" data-parsley-required-message="Required"  required="">
                            <option value="">- select -</option>
                            <?php
foreach ($Grades as $grade) {?>
                                <option <?php echo $this->getValue('grade', $profile, false) == $grade ? 'selected' : ''; ?> value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                <?php }
    ?>

                        </select>
                    </fieldset>
                </div>
                <div class="km_col_4 km_field_wrap km_field_school_select">
                    <label><?php _e('School', 'fieldday');?></label>
                    <select data-name="school" onchange="fieldday.getSchoolData(this,event, 'grade', 'track');" name="ATC[kids][<?php echo $counter; ?>][school]" class="km_input km_select fieldday_select">
                        <option value="">-select school-</option>
                        <?php $this->displaySchools($this->getValue('school', $school, false));?>
                    </select>
                </div>
            <?php } else {?>
                <div class="km_col_4 km_field_wrap">
                    <fieldset class="">
                        <label><?php _e('Date of Birth', 'fieldday');?></label>
                        <?php
$this->fielddayDateField(['name' => "ATC[kids][{$counter}][dob]", 'value' => $this->getValue('dob', $profile, false)], $this->getValue('dob', $profile, false), $sessionInfo);?>
                    </fieldset>
                </div>
            <?php }?>

    </div>
</div>