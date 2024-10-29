<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-medical-treatment="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseTreatments<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelmedical<?php echo $kidNumber; ?>">
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_treatments, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][treatments][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_treatments, false) ? 'disabled' : '';?>
            <ul class="">
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" class="styled-checkbox green-checkbox  kid-form-checkbox none-checkbox" id="trts-none<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_treatments, 'none');?> type="checkbox" >
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('EPI Any Symptoms', 'fieldday');?>
                        <input class="kid-form-checkbox" id="trts-epiAnySymptoms<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][treatments][epiAnySymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'epiAnySymptoms');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('EPI Severe Symptoms', 'fieldday');?>
                        <input class="kid-form-checkbox" id="trts-epiSevereSymptoms<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][treatments][epiSevereSymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'epiSevereSymptoms');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Antihistamine Mild Symptoms', 'fieldday');?>
                        <input class="kid-form-checkbox" id="trts-antihistamineMildSymptoms<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][treatments][antihistamineMildSymptoms]" <?php $this->km_display_pop_checked($kid_treatments, 'antihistamineMildSymptoms');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('EPI No Symptoms', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" <?php $this->km_display_pop_checked($this->getvalue('epiNoSymptoms', $kid_treatments, false), 'dosage');
$this->km_display_pop_checked($this->getvalue('epiNoSymptoms', $kid_treatments, false), 'epiMedication')?> id="trts-epiNoSymptoms<?php echo $kidNumber; ?>" <?php echo $disabeld; ?> type="checkbox" >
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields km_hidden">
                        <?php $epiNoSymptoms = $this->getvalue('epiNoSymptoms', $kid_treatments, false);?>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][epiNoSymptoms][epiMedication]" value="<?php $this->getvalue('epiMedication', $epiNoSymptoms);?>" id="trts-epiNoSymptoms-epiMedication" placeholder="EPI Medication" />
                        </div>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][epiNoSymptoms][dosage]" value="<?php $this->getvalue('dosage', $epiNoSymptoms);?>" placeholder="Dosage" />
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>

                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Antihistamine Severe Symptoms', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" <?php $this->km_display_pop_checked($this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false), 'medication');
$this->km_display_pop_checked($this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false), 'dosage');?> id="trts-antihistamineSevereSymptoms<?php echo $kidNumber; ?>" <?php echo $disabeld; ?>  type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields km_hidden">
                        <?php $systems = $this->getvalue('antihistamineSevereSymptoms', $kid_treatments, false);?>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][antihistamineSevereSymptoms][medication]" value="<?php $this->getvalue('medication', $systems);?>" id="trts-antihistamineSevereSymptoms-epiMedication<?php echo $kidNumber; ?>" placeholder="Medication" />
                        </div>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][antihistamineSevereSymptoms][dosage]" value="<?php $this->getvalue('dosage', $systems);?>" id="trts-antihistamineSevereSymptoms-dosage<?php echo $kidNumber; ?>" placeholder="Dosage" />
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other Medication', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="trts-otherMedication<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'dosage');
$this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'medication');
$this->km_display_pop_checked($this->getvalue('otherMedication', $kid_treatments, false), 'medication');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields km_hidden">
                        <?php $otherMedication = $this->getvalue('otherMedication', $kid_treatments, false);?>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][otherMedication][detail]" value="<?php $this->getvalue('detail', $otherMedication);?>"  id="trts-otherMedication-detail<?php echo $kidNumber; ?>" placeholder="Detail" />
                        </div>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][otherMedication][medication]" value="<?php $this->getvalue('medication', $otherMedication);?>"  id="trts-otherMedication-medication<?php echo $kidNumber; ?>" placeholder="Medication" />
                        </div>
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][otherMedication][dosage]" value="<?php $this->getvalue('dosage', $otherMedication);?>"  id="trts-otherMedication-dosage<?php echo $kidNumber; ?>" placeholder="Dosage" />
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_treatments, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_treatments, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="dtr-additionalSpecifics<?php echo $kidNumber; ?>"><?php _e('Additional Specifics', 'fieldday');?></label>
                                <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][treatments][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="trts-additionalSpecifics<?php echo $kidNumber; ?>" />
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
            </ul>
        </div>
    </div>
</div>