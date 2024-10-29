<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-food-allergy="available">
    <span class="med_form_error"><?php print apply_filters('fieldday_medical_form_error', __('Please select any option. Select none if not applicable'));?></span>
    <div id="collapseFoodAllergies<?php echo $kidNumber; ?>" class="" aria-labelledby="headingOne" data-parent="#process_info-modelkidAllergies<?php echo $kidNumber; ?>">
        <?php $disabeld = $this->getValue('none', $kid_food_allergies, false) ? 'disabled' : '';?>
        <div class="km_modal_medfor_wrap">
            <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_food_allergies, false) ? 'true' : 'false'; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][none]"/>
            <ul>
                <li class="km_col_12 km_field_wrap">
                    <label class="km_checkbox_wrap km_noform_wrap">
                        <?php _e('None', 'fieldday');?>

                        <input class="km_noform" class="styled-checkbox green-checkbox  kid-form-checkbox none-checkbox" id="food-allergies-none<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_food_allergies, 'none');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
            </ul>
            <ul>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Nuts', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-nuts<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][nuts]" <?php $this->km_display_pop_checked($kid_food_allergies, 'nuts');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Milk', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-milk<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][milk]" <?php $this->km_display_pop_checked($kid_food_allergies, 'milk');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Cheese', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-cheese<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][cheese]" <?php $this->km_display_pop_checked($kid_food_allergies, 'cheese');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Eggs', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-eggs<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][eggs]" <?php $this->km_display_pop_checked($kid_food_allergies, 'eggs');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Wheat', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-wheat<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][wheat]" <?php $this->km_display_pop_checked($kid_food_allergies, 'wheat');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_4 km_field_wrap">
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Soy', 'fieldday');?>
                        <input class="styled-checkbox green-checkbox  kid-form-checkbox" <?php echo $disabeld; ?> id="food-soy<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][soy]" <?php $this->km_display_pop_checked($kid_food_allergies, 'soy');?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                </li>
                <li class="km_col_12 km_field_wrap">
                    <?php $additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_food_allergies, false);?>
                    <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                        <?php _e('Other', 'fieldday');?>
                        <input class="km_hasextra_form" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_food_allergies, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="related_checkbox_fields <?php echo $additionalSpecifics ? "" : 'km_hidden' ?>">
                        <div class="km_col_12 km_field_wrap">
                            <fieldset class="full">
                                <label for="food-additionalSpecifics<?php echo $kidNumber; ?>"><?php _e('Additional Specifics', 'fieldday');?></label>
                                <input class="km_input" type="text" name="kids[<?php echo $kidNumber; ?>][forms][foodAllergies][additionalSpecifics]" value="<?php $this->getvalue('additionalSpecifics', $kid_food_allergies);?>" id="food-additionalSpecifics<?php echo $kidNumber; ?>" />
                            </fieldset>
                        </div>
                    </div><!-- end related-checkbox-field -->
                </li>

            </ul>
        </div>
    </div>
</div>