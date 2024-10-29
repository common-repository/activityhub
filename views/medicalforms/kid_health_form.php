<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-medical-health="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseHealthConcerns<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelmedical<?php echo $kidNumber; ?>">
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_heathConcerns, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_heathConcerns, false) ? 'disabled' : '';?>
            <ul>
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input <?php $this->km_display_pop_checked($kid_heathConcerns, 'none');?> class="km_noform" id="health-c-none<?php echo $kidNumber; ?>" type="checkbox" >
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('ADD', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-add<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][add]"  <?php $this->km_display_pop_checked($kid_heathConcerns, 'add');?>  type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('On Medication For ADD', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-onMedicationForAdd<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][onMedicationForAdd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'onMedicationForAdd');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('ADHD', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-adhd<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][adhd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'adhd');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('On Medication For ADHD', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-onMedicationForAdhd<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][onMedicationForAdhd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'onMedicationForAdhd');?> type="checkbox">

                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Emotional Problem', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-emotionalProblems<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][emotionalProblems]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'emotionalProblems');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Behavior Problems', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-behaviorProblems<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][behaviorProblems]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'behaviorProblems');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Heart Desease or Defect', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-heartDeseaseOrDefect<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][heartDeseaseOrDefect]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'heartDeseaseOrDefect');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Headaches or Migrations', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-headachesOrMigrations<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][headachesOrMigrations]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'headachesOrMigrations');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Concussion or Head Injury', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-concussionOrHeadInjury<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][concussionOrHeadInjury]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'concussionOrHeadInjury');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Eczema or Psoriasis', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-eczemaOrPsoriasis<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][eczemaOrPsoriasis]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'eczemaOrPsoriasis');?>  type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Eyeglasses', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-eyeglasses<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][eyeglasses]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'eyeglasses');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Sprains or Fractures or Dislocations', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-sprainsOrFracturesOrDislocations<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][sprainsOrFracturesOrDislocations]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'sprainsOrFracturesOrDislocations');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Major Surgery or Illness', 'fieldday');?>
                        <input class="" id="health-c-majorSurgeryOrIllness<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][majorSurgeryOrIllness]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'majorSurgeryOrIllness');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Heat Stroke or Exhaustion', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-heatStrokeOrExhaustion<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][heatStrokeOrExhaustion]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'heatStrokeOrExhaustion');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Seizures or Epilepsy', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-seizuresOrEpilepsy<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][seizuresOrEpilepsy]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'seizuresOrEpilepsy');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Diabetes Type 1', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-diabetesType1<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][diabetesType1]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'diabetesType1');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Diabetes Type 2', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-diabetesType2<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][diabetesType2]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'diabetesType2');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Insulin', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-insulin<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][insulin]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'insulin');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Hearing Loss', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-hearingLoss<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][hearingLoss]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'hearingLoss');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Vision Loss', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-visionLoss<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][visionLoss]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'visionLoss');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Contagious Disease', 'fieldday');?>
                        <input class="kid-form-checkbox" id="health-c-contagiousDisease<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][contagiousDisease]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'contagiousDisease');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php
$additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_heathConcerns, false);
$otherSkinCondition = $this->getvalue('otherSkinCondition', $kid_heathConcerns, false);
?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_heathConcerns, 'additionalSpecifics');?> <?php $this->km_display_pop_checked($kid_heathConcerns, 'otherSkinCondition');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics || $otherSkinCondition ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="health-c-otherSkinCondition">
                                    <?php _e('Other Conditions', 'fieldday');?>
                                </label>
                                <input type="text" class="km_input" name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][otherSkinCondition]" value="<?php echo $otherSkinCondition; ?>" id="health-c-otherSkinCondition" />
                            </fieldset>
                        </div>
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="health-c-additionalSpecifics">
                                    <?php _e('Additional Specifics', 'fieldday');?>
                                </label>
                                <input type="text" class="km_input" name="kids[<?php echo $kidNumber; ?>][forms][healthConcerns][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="health-c-additionalSpecifics" />
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
            </ul>
        </div>
    </div>
</div>