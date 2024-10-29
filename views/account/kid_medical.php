<h3><?php _e('MEDICAL', 'fieldday');?></h3>
<form class="km_kids_forms km_kids_medical km_kids_medical_form" id="km_profile_kids_form" action="" method="post">
    <input type="hidden" value="<?php echo $kidId; ?>" name="kidId">
    <!-- kid health concern form -->
    <div class="km_profile_kid_med_form km_medical_form_wrap km_health_concern_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsHealthConcerns'); ?></h2>
        <?php $disabeld = $this->getValue('none', $kid_heathConcerns, false) ? 'disabled' : '';?>
        <ul>
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_heathConcerns, false) ? 'true' : 'false'; ?>" name="forms[healthConcerns][none]"/>
                    <input <?php $this->km_display_pop_checked($kid_heathConcerns, 'none');?> class="km_noform" id="health-c-none" type="checkbox" >
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('ADD', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-add" name="forms[healthConcerns][add]"  <?php $this->km_display_pop_checked($kid_heathConcerns, 'add');?>  type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('On Medication For ADD', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-onMedicationForAdd" name="forms[healthConcerns][onMedicationForAdd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'onMedicationForAdd');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('ADHD', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-adhd" name="forms[healthConcerns][adhd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'adhd');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('On Medication For ADHD', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-onMedicationForAdhd" name="forms[healthConcerns][onMedicationForAdhd]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'onMedicationForAdhd');?> type="checkbox">

                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Emotional Problem', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-emotionalProblems" name="forms[healthConcerns][emotionalProblems]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'emotionalProblems');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Behavior Problems', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-behaviorProblems" name="forms[healthConcerns][behaviorProblems]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'behaviorProblems');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Heart Desease or Defect', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-heartDeseaseOrDefect" name="forms[healthConcerns][heartDeseaseOrDefect]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'heartDeseaseOrDefect');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Headaches or Migrations', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-headachesOrMigrations" name="forms[healthConcerns][headachesOrMigrations]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'headachesOrMigrations');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Concussion or Head Injury', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-concussionOrHeadInjury" name="forms[healthConcerns][concussionOrHeadInjury]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'concussionOrHeadInjury');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Eczema or Psoriasis', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-eczemaOrPsoriasis" name="forms[healthConcerns][eczemaOrPsoriasis]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'eczemaOrPsoriasis');?>  type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Eyeglasses', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="health-c-eyeglasses" name="forms[healthConcerns][eyeglasses]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'eyeglasses');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Sprains or Fractures or Dislocations', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="health-c-sprainsOrFracturesOrDislocations" name="forms[healthConcerns][sprainsOrFracturesOrDislocations]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'sprainsOrFracturesOrDislocations');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Major Surgery or Illness', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="health-c-majorSurgeryOrIllness" name="forms[healthConcerns][majorSurgeryOrIllness]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'majorSurgeryOrIllness');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Heat Stroke or Exhaustion', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-heatStrokeOrExhaustion" name="forms[healthConcerns][heatStrokeOrExhaustion]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'heatStrokeOrExhaustion');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Seizures or Epilepsy', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-seizuresOrEpilepsy" name="forms[healthConcerns][seizuresOrEpilepsy]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'seizuresOrEpilepsy');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Diabetes Type 1', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-diabetesType1" name="forms[healthConcerns][diabetesType1]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'diabetesType1');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Diabetes Type 2', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-diabetesType2" name="forms[healthConcerns][diabetesType2]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'diabetesType2');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Insulin', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-insulin" name="forms[healthConcerns][insulin]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'insulin');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Hearing Loss', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="health-c-hearingLoss" name="forms[healthConcerns][hearingLoss]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'hearingLoss');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Vision Loss', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabeld; ?> id="health-c-visionLoss" name="forms[healthConcerns][visionLoss]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'visionLoss');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Contagious Disease', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="health-c-contagiousDisease" name="forms[healthConcerns][contagiousDisease]" <?php $this->km_display_pop_checked($kid_heathConcerns, 'contagiousDisease');?> type="checkbox">
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
                    <input class="km_hasextra_form  kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_heathConcerns, 'additionalSpecifics');?> <?php $this->km_display_pop_checked($kid_heathConcerns, 'otherSkinCondition');?> <?php echo $disabeld; ?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $additionalSpecifics || $otherSkinCondition ? "" : 'km_hidden' ?>">
                    <div class="km_col_12 km_field_wrap">
                        <fieldset class="full">
                        <!-- <label class="km_checkbox_wrap <?php //echo $disabeld; ?>"> -->
                            <label for="health-c-otherSkinCondition">
                                <?php _e('Other Skin Condition', 'fieldday');?>
                            </label>
                            <input type="text" class="km_input" name="forms[healthConcerns][otherSkinCondition]" value="<?php echo $otherSkinCondition; ?>" id="health-c-otherSkinCondition" />
                        </fieldset>
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <fieldset class="full">
                            <label for="health-c-additionalSpecifics">
                                <?php _e('Additional Specifics', 'fieldday');?>
                            </label>
                            <input type="text" class="km_input" name="forms[healthConcerns][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="health-c-additionalSpecifics" />
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>
        </ul>
    </div>
    <!-- kid health concern form end-->

    <!-- kid Treatments form -->
    <div class="km_profile_kid_med_form km_medical_form_wrap">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsTreatments'); ?></h2>
        <?php $disabeld = $this->getValue('none', $kid_treatments, false) ? 'disabled' : '';?>
        <ul class="km_row km_treatment_listing">
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_treatments, false) ? 'true' : 'false'; ?>" name="forms[treatments][none]"/>
                    <input class="km_noform" class="styled-checkbox green-checkbox  kid-form-checkbox none-checkbox" id="trts-none" <?php $this->km_display_pop_checked($kid_treatments, 'none');?> type="checkbox" >
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul class="km_mt_0">
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('EPI Any Symptoms', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="trts-epiAnySymptoms" name="forms[treatments][epiAnySymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'epiAnySymptoms');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('EPI Severe Symptoms', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="trts-epiSevereSymptoms" name="forms[treatments][epiSevereSymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'epiSevereSymptoms');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Antihistamine Mild Symptoms', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="trts-antihistamineMildSymptoms" name="forms[treatments][antihistamineMildSymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'antihistamineMildSymptoms');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <?php
$epiNoSymptoms = $this->getvalue('epiNoSymptoms', $kid_treatments, false);
$hasValue = ($this->getvalue('dosage', $epiNoSymptoms, false) || $this->getvalue('dosage', $epiNoSymptoms, false)) ? true : false;
?>
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('EPI No Symptoms', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="km_hasextra_form kid-form-checkbox" <?php echo $hasValue ? 'checked' : ""; ?> id="trts-epiNoSymptoms" type="checkbox" >
                    <span class="km_checkbox"></span>
                </label>
                <div class="<?php echo $disabeld; ?> related_checkbox_fields <?php echo $hasValue ? '' : "km_hidden"; ?>">
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][epiNoSymptoms][epiMedication]" value="<?php $this->getvalue('epiMedication', $epiNoSymptoms);?>" id="trts-epiNoSymptoms-epiMedication" placeholder="EPI Medication" />
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][epiNoSymptoms][dosage]" value="<?php $this->getvalue('dosage', $epiNoSymptoms);?>" placeholder="Dosage" />
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>

            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Antihistamine Severe Symptoms', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="km_hasextra_form kid-form-checkbox" <?php $this->km_display_pop_checked($this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false), 'medication');
$this->km_display_pop_checked($this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false), 'dosage');?> id="trts-antihistamineSevereSymptoms"  type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $hasValue ? '' : "km_hidden"; ?>">
                    <?php $systems = $this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false);?>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][antihistamineSevereSymptoms][medication]" value="<?php $this->getvalue('medication', $systems);?>" id="trts-antihistamineSevereSymptoms-epiMedication" placeholder="Medication" />
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][antihistamineSevereSymptoms][dosage]" value="<?php $this->getvalue('dosage', $systems);?>" id="trts-antihistamineSevereSymptoms-dosage" placeholder="Dosage" />
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Other Medication', 'fieldday');?>
                    <input <?php echo $disabeld; ?> class="km_hasextra_form kid-form-checkbox" id="trts-otherMedication" <?php $this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'dosage');
$this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'medication');
$this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'medication');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $hasValue ? '' : "km_hidden"; ?>">
                    <?php $otherMedication = $this->getvalue('otherMedication', $kid_treatments, false);?>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][otherMedication][detail]" value="<?php $this->getvalue('detail', $otherMedication);?>"  id="trts-otherMedication-detail" placeholder="Detail" />
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][otherMedication][medication]" value="<?php $this->getvalue('medication', $otherMedication);?>"  id="trts-otherMedication-medication" placeholder="Medication" />
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <input class="km_input" type="text" name="forms[treatments][otherMedication][dosage]" value="<?php $this->getvalue('dosage', $otherMedication);?>"  id="trts-otherMedication-dosage" placeholder="Dosage" />
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>
            <li class="km_col_12 km_field_wrap">
                <?php $treatment_additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_treatments, false);?>
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Other', 'fieldday');?>
                    <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_treatments, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $treatment_additionalSpecifics ? "" : 'km_hidden' ?>">
                    <div class="km_col_12 km_field_wrap">
                        <fieldset class="full">
                            <label for="trts-additionalSpecifics">
                                <?php _e('Additional Specifics', 'fieldday');?>
                            </label>
                            <input class="km_input" type="text" name="forms[treatments][additionalSpecifics]" value="<?php echo $treatment_additionalSpecifics; ?>" id="trts-additionalSpecifics" />
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>

        </ul>
    </div>
    <!-- kid Treatments form end-->

    <!-- kid Symptoms form -->
    <div class="km_profile_kid_med_form km_medical_form_wrap km_symptoms_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsSymptoms'); ?></h2>
        <?php $disabeld = $this->getValue('none', $kid_symptoms, false) ? 'disabled' : '';?>
        <div class="km_col_12">
            <ul >
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>
                        <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_symptoms, false) ? 'true' : 'false'; ?>" name="forms[symptoms][none]"/>
                        <input class="km_noform" id="sym-extr-none" name="forms[symptoms][none]" <?php $this->km_display_pop_checked($kid_symptoms, 'none');?> type="checkbox" >
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="km_row">
            <div class="km_col_6">
                <ul>
                    <h3><?php _e('Extremely Reactive', 'fieldday');?></h3>
                    <?php $extremelyReactive = $this->getValue('extremelyReactive', $kid_symptoms, false);?>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Lung', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-lung" name="forms[symptoms][extremelyReactive][lung]" <?php $this->km_display_pop_checked($extremelyReactive, 'lung');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Mouth', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-mouth" name="forms[symptoms][extremelyReactive][mouth]" <?php $this->km_display_pop_checked($extremelyReactive, 'mouth');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Heart', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-heart" name="forms[symptoms][extremelyReactive][heart]" <?php $this->km_display_pop_checked($extremelyReactive, 'heart');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Skin', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-skin" name="forms[symptoms][extremelyReactive][skin]" <?php $this->km_display_pop_checked($extremelyReactive, 'skin');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Throat', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-throat" name="forms[symptoms][extremelyReactive][throat]" <?php $this->km_display_pop_checked($extremelyReactive, 'throat');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Degestive', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="sym-extr-digestive" name="forms[symptoms][extremelyReactive][digestive]" <?php $this->km_display_pop_checked($extremelyReactive, 'digestive');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_12 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Other', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox" <?php $this->km_display_pop_checked($extremelyReactive, 'other');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                        <div class="related_checkbox_fields <?php echo $this->getvalue('other', $extremelyReactive, false) ? '' : "km_hidden"; ?>">
                            <div class="km_col_12 km_field_wrap">
                                <input type="text" class="km_input" name="forms[symptoms][extremelyReactive][other]" value="<?php $this->getvalue('other', $extremelyReactive);?>" id="sym-extr-other" placeholder="Describe here" />
                            </div>
                        </div><!-- end related-checkbox-field -->
                    </li>
                </ul>
            </div>
            <div class="km_col_6">
                <?php $mildSymptoms = $this->getValue('mildSymptoms', $kid_symptoms, false);?>

                <ul>
                    <h3><?php _e('Mild Symptoms', 'fieldday');?></h3>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Mild Nausea', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="mild-sym-mildNausea" name="forms[symptoms][mildSymptoms][mildNausea]" <?php $this->km_display_pop_checked($mildSymptoms, 'mildNausea');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Mouth', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="mild-sym-mouth" name="forms[symptoms][mildSymptoms][mouth]" <?php $this->km_display_pop_checked($mildSymptoms, 'mouth');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_4 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Skin', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="kid-form-checkbox" id="mild-sym-skin" name="forms[symptoms][mildSymptoms][skin]" <?php $this->km_display_pop_checked($mildSymptoms, 'skin');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                    </li>
                    <li class="km_col_12 km_field_wrap">
                        <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                            <?php _e('Other', 'fieldday');?>
                            <input <?php echo $disabeld; ?> class="km_hasextra_form kid-form-checkbox"  id="mild-sym-other-checkbox" value="" <?php $this->km_display_pop_checked($mildSymptoms, 'other');?> type="checkbox">
                            <span class="km_checkbox"></span>
                        </label>
                        <div class="related_checkbox_fields <?php echo $this->getvalue('other', $mildSymptoms, false) ? '' : 'km_hidden'; ?>">
                            <div class="km_col_12 km_field_wrap">
                                <input class="km_input" type="text" name="forms[symptoms][mildSymptoms][other]" id="mild-sym-other" value="<?php $this->getvalue('other', $mildSymptoms);?>"  placeholder="Describe here" />
                            </div>
                        </div><!-- end related-checkbox-field -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- kid Symptoms form end -->
    <div class="km_col_12 km_btn_wrap">
        <a class="km_btn km_save_kidform km_btn_primary km_primary_bg"><?php _e('Save', 'fieldday');?></a>
    </div>
</form>