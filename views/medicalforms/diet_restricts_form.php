<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-diet-restricts="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseDietRestricts<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelkidAllergies<?php echo $kidNumber; ?>">
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_dietRestricts, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][none]"/>
            <?php $disabeld = $this->getValue('none', $kid_dietRestricts, false) ? 'disabled' : '';?>
            <ul class="">
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" id="diet-restricts-none<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_dietRestricts, 'none');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Vegeterian', 'fieldday');?>
                        <input class="kid-form-checkbox" id="dtr-vegeterian<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][vegetarian]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'vegetarian');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('No Pork', 'fieldday');?>
                        <input class="kid-form-checkbox" id="dtr-noPork<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][noPork]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'noPork');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Vegan', 'fieldday');?>
                        <input class="kid-form-checkbox" id="dtr-vegan<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][vegan]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'vegan');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Lactose Intolerant', 'fieldday');?>
                        <input class="kid-form-checkbox" id="dtr-lactoseIntolerant<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][lactoseIntolerant]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'lactoseIntolerant');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Celiac Disease', 'fieldday');?>
                        <input class="kid-form-checkbox" id="dtr-celiacDisease<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][celiacDisease]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'celiacDisease');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_dietRestricts, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_dietRestricts, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="dtr-additionalSpecifics<?php echo $kidNumber; ?>"><?php _e('Additional Specifics', 'fieldday');?></label>
                                <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][dietRestricts][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="dtr-additionalSpecifics<?php echo $kidNumber; ?>" />
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>


            </ul>
        </div>
    </div>
</div>