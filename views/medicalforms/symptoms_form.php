<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-medical-symptoms="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseSymptoms<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelmedical<?php echo $kidNumber; ?>">
        <div class="km_modal_medfor_wrap">
            <ul>
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" id="sym-extr-none<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][none]" <?php $this->km_display_pop_checked($kid_symptoms, 'none');?> type="checkbox" >
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_symptoms, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_symptoms, false) ? 'disabled' : '';?>
            <span class="km_medicalform_heading">
                <?php _e('Mild Symptoms', 'fieldday');?>
            </span>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Lung', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-lung<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][lung]" <?php $this->km_display_pop_checked($extremelyReactive, 'lung');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Mouth', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-mouth<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][mouth]" <?php $this->km_display_pop_checked($extremelyReactive, 'mouth');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Heart', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-heart<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][heart]" <?php $this->km_display_pop_checked($extremelyReactive, 'heart');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Skin', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-skin<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][skin]" <?php $this->km_display_pop_checked($extremelyReactive, 'skin');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Throat', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-throat<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][throat]" <?php $this->km_display_pop_checked($extremelyReactive, 'throat');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Degestive', 'fieldday');?>
                        <input class="kid-form-checkbox" id="sym-extr-digestive<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][digestive]" <?php $this->km_display_pop_checked($extremelyReactive, 'digestive');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $other = $this->getvalue('other', $extremelyReactive, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($extremelyReactive, 'other');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $other ? "" : 'km_hidden'; ?>">
                        <div class="km_col_12 km_field_wrap">
                            <input type="text" class="km_input" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][extremelyReactive][other]" value="<?php echo $other; ?>" id="sym-extr-other<?php echo $kidNumber; ?>" placeholder="Describe here" />
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
            </ul>
            <span class="km_medicalform_heading">
                <?php _e('Extremely Reactive', 'fieldday');?>
            </span>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Mild Nausea', 'fieldday');?>
                        <input class="kid-form-checkbox" id="mild-sym-mildNausea<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][mildSymptoms][mildNausea]" <?php $this->km_display_pop_checked($mildSymptoms, 'mildNausea');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Mouth', 'fieldday');?>
                        <input class="kid-form-checkbox" id="mild-sym-mouth<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][mildSymptoms][mouth]" <?php $this->km_display_pop_checked($mildSymptoms, 'mouth');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Skin', 'fieldday');?>
                        <input class="kid-form-checkbox" id="mild-sym-skin<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][mildSymptoms][skin]" <?php $this->km_display_pop_checked($mildSymptoms, 'skin');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $mildSymptomsother = $this->getvalue('other', $mildSymptoms, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="mild-sym-other-checkbox<?php echo $kidNumber; ?>" value="" <?php $this->km_display_pop_checked($mildSymptoms, 'other');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php $mildSymptomsother ? "" : "km_hidden";?>">
                        <div class="km_col_12 km_field_wrap">
                            <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][symptoms][mildSymptoms][other]" id="mild-sym-other<?php echo $kidNumber; ?>" value="<?php echo $mildSymptomsother; ?>"  placeholder="Describe here" />
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>
            </ul>
        </div>
    </div>
</div>