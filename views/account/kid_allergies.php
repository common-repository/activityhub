<h3><?php _e('ALLERGIES', 'fieldday');?></h3>
<form class="km_kids_forms km_kids_allergies km_kids_allergies_form" id="km_profile_kids_form" action="" method="post">
    <input type="hidden" value="<?php echo $kidId; ?>" name="kidId">
    <div class="km_profile_kid_med_form km_medical_form_wrap km_health_concern_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsEnvironmentAllergies'); ?></h2>
        <?php $disabled = $this->getValue('none', $kid_environment_allergies, false) ? 'disabled' : '';?>
        <ul>
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_environment_allergies, false) ? 'true' : 'false'; ?>" name="forms[environmentAllergies][none]"/>
                    <input class="km_noform" id="ena-allergies-none" <?php $this->km_display_pop_checked($kid_environment_allergies, 'none');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Latex', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabled; ?> id="ena-latex" <?php $this->km_display_pop_checked($kid_environment_allergies, 'latex');?> name="forms[environmentAllergies][latex]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Alcohol Rub', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabled; ?> id="ena-alcohol-rub" <?php $this->km_display_pop_checked($kid_environment_allergies, 'alcoholRub');?> name="forms[environmentAllergies][alcoholRub]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Grass', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabled; ?> id="ena-grass" <?php $this->km_display_pop_checked($kid_environment_allergies, 'grass');?> name="forms[environmentAllergies][grass]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Seasonal', 'fieldday');?>
                    <input class="kid-form-checkbox" <?php echo $disabled; ?> id="ena-seasonal" <?php $this->km_display_pop_checked($kid_environment_allergies, 'seasonal');?> name="forms[environmentAllergies][seasonal]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Cats', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="ena-cats" <?php $this->km_display_pop_checked($kid_environment_allergies, 'cats');?> name="forms[environmentAllergies][cats]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Dogs', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="ena-dogs" <?php $this->km_display_pop_checked($kid_environment_allergies, 'dogs');?> name="forms[environmentAllergies][dogs]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Insect Stings', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="ena-insectStings" <?php $this->km_display_pop_checked($kid_environment_allergies, 'insectStings');?> name="forms[environmentAllergies][insectStings]" type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Plants', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="ena-plants" <?php $this->km_display_pop_checked($kid_environment_allergies, 'plants');?> name="forms[environmentAllergies][plants]" type="checkbox">
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
                            <label for="ena-additionalSpecifics"><?php _e('Additional Specifics', 'fieldday');?></label>
                            <input type="text" class="km_input" name="forms[environmentAllergies][additionalSpecifics]" value="<?php $this->getvalue('additionalSpecifics', $kid_environment_allergies);?>" id="ena-additionalSpecifics" />
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>

        </ul>
    </div>

    <div class="km_profile_kid_med_form km_medical_form_wrap km_health_concern_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsFoodAllergies'); ?></h2>
        <?php $default = $this->getValue('none', $kid_food_allergies, false) ? 'disabled' : "";?>
        <ul>
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_food_allergies, false) ? 'true' : 'false'; ?>" name="forms[foodAllergies][none]"/>
                    <input class="km_noform" class="styled-checkbox green-checkbox  kid-form-checkbox none-checkbox" id="food-allergies-none" <?php $this->km_display_pop_checked($kid_food_allergies, 'none');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Nuts', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-nuts" name="forms[foodAllergies][nuts]" <?php $this->km_display_pop_checked($kid_food_allergies, 'nuts');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Milk', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-milk" name="forms[foodAllergies][milk]" <?php $this->km_display_pop_checked($kid_food_allergies, 'milk');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Cheese', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-cheese" name="forms[foodAllergies][cheese]" <?php $this->km_display_pop_checked($kid_food_allergies, 'cheese');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Eggs', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-eggs" name="forms[foodAllergies][eggs]" <?php $this->km_display_pop_checked($kid_food_allergies, 'eggs');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Wheat', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-wheat" name="forms[foodAllergies][wheat]" <?php $this->km_display_pop_checked($kid_food_allergies, 'wheat');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Soy', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="food-soy" name="forms[foodAllergies][soy]" <?php $this->km_display_pop_checked($kid_food_allergies, 'soy');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_12 km_field_wrap">
                <?php $food_additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_food_allergies, false);?>
                <label class="km_checkbox_wrap <?php echo $disabeld; ?>">
                    <?php _e('Other', 'fieldday');?>
                    <input class="km_hasextra_form kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_food_allergies, 'additionalSpecifics');?> <?php echo $disabeld; ?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $food_additionalSpecifics ? "" : 'km_hidden' ?>">
                    <div class="km_col_12 km_field_wrap">
                        <fieldset class="full">
                            <label for="food-additionalSpecifics"><?php _e('Additional Specifics', 'fieldday');?></label>
                            <input class="km_input" type="text" name="forms[foodAllergies][additionalSpecifics]" value="<?php echo $food_additionalSpecifics; ?>" id="food-additionalSpecifics<?php echo $kidNumber; ?>" />
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>

        </ul>
    </div>


    <div class="km_profile_kid_med_form km_medical_form_wrap km_health_concern_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsDietRestricts'); ?></h2>
        <?php $disabled = $this->getValue('none', $kid_dietRestricts, false) ? 'disabled' : '';?>
        <ul class="">
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_dietRestricts, false) ? 'true' : 'false'; ?>" name="forms[dietRestricts][none]"/>
                    <input class="km_noform" id="diet-restricts-none" <?php $this->km_display_pop_checked($kid_dietRestricts, 'none');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Vegeterian', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="dtr-vegeterian" name="forms[dietRestricts][vegetarian]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'vegetarian');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('No Pork', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="dtr-noPork" name="forms[dietRestricts][noPork]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'noPork');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Vegan', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="dtr-vegan" name="forms[dietRestricts][vegan]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'vegan');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Lactose Intolerant', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="dtr-lactoseIntolerant" name="forms[dietRestricts][lactoseIntolerant]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'lactoseIntolerant');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $disabled; ?>">
                    <?php _e('Celiac Disease', 'fieldday');?>
                    <input <?php echo $disabled; ?> class="kid-form-checkbox" id="dtr-celiacDisease" name="forms[dietRestricts][celiacDisease]" <?php $this->km_display_pop_checked($kid_dietRestricts, 'celiacDisease');?> type="checkbox">
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
                            <input class="km_input kid-form-checkbox" type="text" name="forms[dietRestricts][additionalSpecifics]" value="<?php echo $additionalSpecifics; ?>" id="dtr-additionalSpecifics<?php echo $kidNumber; ?>" />
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>
        </ul>
    </div>

    <div class="km_profile_kid_med_form km_medical_form_wrap km_health_concern_form">
        <h2 class="form_title km_primary_bg"><?php echo $this->MedicalFormLable('kidsMedicationAllergies'); ?></h2>
        <?php $default = $this->getValue('none', $kid_medication_allregies, false) ? "disabled" : '';?>
        <ul>
            <li class="km_col_12 km_field_wrap">
                <label class="km_checkbox_wrap km_noform_wrap">
                    <?php _e('None', 'fieldday');?>
                    <input type="hidden" class="km_hidden_noform_field" value="<?php echo $this->getValue('none', $kid_medication_allregies, false) ? 'true' : 'false'; ?>" name="forms[medicationAllergies][none]"/>
                    <input class="km_noform" id="medicationAllergies-none" <?php $this->km_display_pop_checked($kid_medication_allregies, 'none');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
        </ul>
        <ul>
            <li class="km_col_4 km_field_wrap">
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Penicillin', 'fieldday');?>
                    <input <?php echo $default; ?> class="styled-checkbox green-checkbox  kid-form-checkbox" id="medA-penicillin" name="forms[medicationAllergies][penicillin]" <?php $this->km_display_pop_checked($kid_medication_allregies, 'penicillin');?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
            </li>
            <li class="km_col_12 km_field_wrap">
                <?php $med_additionalSpecifics = $this->getvalue('additionalSpecifics', $kid_medication_allregies, false);?>
                <label class="km_checkbox_wrap <?php echo $default; ?>">
                    <?php _e('Other', 'fieldday');?>
                    <input class="km_hasextra_form   kid-form-checkbox" id="sym-extr-other-checkbox<?php echo $kidNumber; ?>" <?php $this->km_display_pop_checked($kid_medication_allregies, 'additionalSpecifics');?> <?php echo $default; ?> type="checkbox">
                    <span class="km_checkbox"></span>
                </label>
                <div class="related_checkbox_fields <?php echo $med_additionalSpecifics ? "" : 'km_hidden' ?>">
                    <div class="km_col_12 km_field_wrap">
                        <fieldset class="full">
                            <label for="medA-additionalSpecifics"><?php _e('Additional Specifics', 'fieldday');?></label>
                            <input type="text" class="km_input" name="forms[medicationAllergies][additionalSpecifics]" value="<?php echo $med_additionalSpecifics; ?>" id="medA-additionalSpecifics"/>
                        </fieldset>
                    </div>
                </div><!-- end related-checkbox-field -->
            </li>


        </ul>
    </div>

    <div class="km_col_12 km_btn_wrap">
        <a class="km_btn km_save_kidform km_btn_primary km_primary_bg"><?php _e('Save', 'fieldday');?></a>
    </div>
</form>