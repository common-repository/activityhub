<div id="<?php echo $step['name']; ?>" class="<?php echo $step['classes']; ?>">
    <h2 class="km_progress_header km_primary_color"><?php echo $step['label']; ?></h2>
    <div class="km_session_cart">
        <div id="km_checkoutcart_detail" class="km_column_wrap km_col_12">

        </div>
        <div class="km_col_6">
                <div class="km_authorized">
                    <div class="km_col_12">
                    <h3 class="km_heading km_primary_color"><?php _e('Authorized To Pick Up', 'fieldday');?></h3>
                        <div class="km_default_authpickup">

                        </div>
                    </div>
                    <div class="km_col_12 km_field_wrap km_fa_pickup">
                        <span><?php print apply_filters('fieldday_authpickup_text', __("Do you wish to have family member or friend do the pickup?", 'fieldday'));?></span>
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <label for="km_name"><?php _e('Name', 'fieldday');?></label>
                        <input type="text"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"   name="authPickUps[0][name]" data-parsley-group="<?php echo $step['name']; ?>" class="km_input">
                    </div>
                    <div class="km_col_12 km_field_wrap">
                        <label for="km_name"><?php _e('Phone Number', 'fieldday');?></label>
                        <input type="hidden" name="authPickUps[0][countryCode]" class="country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                        <input type="hidden" name="authPickUps[0][phone]" class="phone_number" value="">
                        <input data-parsley-group="<?php echo $step['name']; ?>" class="km_input km_phone_field" id="pur_phone" type="tel"  data-parsley-minlength-message="Phone should contain 10 characters">
                    </div>
                </div>
        </div>

    </div>
    <div class="km_btn_wrap">
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_color  km_transparent_bg"  onclick="return fieldday.PrevStep();"><?php $this->displayText('atc_prev_btn');?></a>
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_bg" data-group="<?php echo $step['name']; ?>" onclick="return fieldday.process_purchaseDetail(this, event);"><?php $this->displayText('atc_next_btn');?></a>
    </div>

</div>