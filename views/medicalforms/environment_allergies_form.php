<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-environment-allergy="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseEnvironmentAllergies<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelkidAllergies' . $kidNumber . '">
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_environment_allergies, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_environment_allergies, false) ? 'disabled' : '';?>
            <ul>
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" id="ena-allergies-none<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'none');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Latex', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-latex<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'latex');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][latex]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Alcohol Rub', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-alcohol-rub<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'alcoholRub');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][alcoholRub]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Grass', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-grass<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'grass');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][grass]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Seasonal', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-seasonal<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'seasonal');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][seasonal]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Cats', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-cats<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'cats');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][cats]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Dogs', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-dogs<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'dogs');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][dogs]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Insect Stings', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-insectStings<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'insectStings');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][insectStings]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Plants', 'fieldday');?>
                        <input class="kid-form-checkbox" id="ena-plants<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'plants');?> name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][plants]" <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_environment_allergies, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_environment_allergies, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="ena-additionalSpecifics<?php echo $kidNumber; ?>"><?php _e('Additional Specifics', 'fieldday');?></label>
                                <input type="text" class="km_input" name="kids[<?php echo $kidNumber; ?>][forms][environmentAllergies][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="ena-additionalSpecifics<?php echo $kidNumber; ?>" />
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>

            </ul>
        </div>
    </div>
</div>