<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-medical-allergy="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseMedicationAllergies<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelkidAllergies' . $kidNumber . '">
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_medication_allregies, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][medicationAllergies][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_medication_allregies, false) ? 'disabled' : '';?>
            <ul>
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" id="medicationAllergies-none<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_medication_allregies, 'none');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Penicillin', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="medA-penicillin<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][medicationAllergies][penicillin]" <?php $this->km_display_pop_checked($kid_medication_allregies, 'penicillin');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_medication_allregies, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_medication_allregies, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="medA-additionalSpecifics<?php echo $kidNumber; ?>"><?php _e('Additional Specifics', 'fieldday');?></label>
                                <input type="text" class="km_input" name="kids[<?php echo $kidNumber; ?>][forms][medicationAllergies][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="medA-additionalSpecifics<?php echo $kidNumber; ?>"/>
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
            </ul>
        </div>
    </div>
</div>