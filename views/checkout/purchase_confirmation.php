<div id="<?php echo $step['name']; ?>" class="<?php echo $step['classes']; ?>">
    <h2 class="km_progress_header km_primary_color"><?php echo $step['label']; ?></h2>
    <div class="km_order_confirmation_text km_progress_confirmation">
        <div class="km_row">
        <div class="km_cart_payment_sec km_col_6">

                <div class="km_price_breakdown">
                    <h3 class="km_primary_color"><?php _e('Purchase Detail', 'fieldday');?></h3>
                    <div class="km_tab km_checkout_conf_pricedetail">

                    </div>
                </div>
            </div></div>
        <hr class="km_hrline km_hrline_mt_40" />
        <div class="km_row">
        <div class="km_cart_payment_sec km_col_6">

            <div class="km_column_wrap km_payment_column">
                <h3 class="km_heading km_primary_color"><?php _e('Payment Details', 'fieldday');?></h3>
                <?php if ($KmUser): ?>
                    <?php $paymentMethods = fieldday()->api->getSavedCards();?>
                    <?php foreach ($paymentMethods->data as $key => $paymentMethod): ?>
                        <label class="km_radio_wrap km_radio_wrap_care">
                            <span class="km_radio_text">
                                <div class="credit-card-last4">
                                    <?php echo $paymentMethod->cardLast4; ?>
                                </div>
                            </span>
                            <input class="km_payment_option" <?php echo $paymentMethod->isDefault ? 'checked' : ''; ?> type="radio" value="<?php echo $paymentMethod->_id; ?>" name="cardId">
                            <span class="km_radio"></span>
                        </label>
                    <?php endforeach;?>
                    <?php if ($paymentMethods->data): ?>
                        <label class="km_radio_wrap km_radio_wrap_care">
                            <span class="km_radio_text">
                                <div class="cradit_debit_card">
                                    <?php _e("Credit/Debit Card");?>
                                </div>
                            </span>
                            <input class="km_payment_option km_enable_cardoption" value="" type="radio">
                            <span class="km_radio"></span>
                        </label>
                    <?php endif;?>
                <?php endif;?>
                <div class="km_payment_wrap <?php echo $KmUser && $paymentMethods->data ? 'km_hidden' : ''; ?>">
                    <div class="km_col_8 km_field_wrap field_card_number">
                        <label for="km_card_number"><?php _e('Card Number', 'fieldday');?></label>
                        <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="<?php echo $step['name']; ?>"  required="" />
                        <div class="km_card_type"></div>
                    </div>
                    <div class="km_col_4 km_field_wrap field_card_cvv">
                        <label for="km_cvv_code"><?php _e('CVV Code', 'fieldday');?></label>
                        <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="<?php echo $step['name']; ?>" data-parsley-required-message="Required"  required=""   />
                    </div>
                    <div class="km_col_12 km_field_wrap field_card_holdername">
                        <label for="km_card_holder_name"><?php _e('Card Holder Name', 'fieldday');?></label>
                        <input type="text"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="<?php echo $step['name']; ?>" required="" />
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp">
                        <label><?php _e('Exp.Month', 'fieldday');?></label>
                        <div class="km_custom_dropdown">
                            <select id='km_expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="<?php echo $step['name']; ?>" required="" >
                                <option value='' selected>Select</option>
                                <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                                <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp_year">
                        <label><?php _e('Exp.Year', 'fieldday');?></label>
                        <div class="km_custom_dropdown">
                            <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="<?php echo $step['name']; ?>" data-parsley-required-message="Required"  required=""  >
                                <option value=''>Select</option>
                                <?php
for ($i = date('Y'); $i <= date('Y') + 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}?>
                            </select>
                        </div>
                    </div>
                    <?php if ($KmUser): ?>
                        <div class="km_col_6 km_field_wrap">
                            <label class='km_checkbox_wrap'>
                                <span><?php _e("Save this card")?></span>
                                <input name="saveCard" type="checkbox" <?php echo $this->getCardSaveOptions($step['name']); ?> class="km_provider_terms km_checkboxteam">
                                <span class="km_checkbox"></span>
                            </label>
                        </div>
                    <?php endif;?>
                <h3 class="km_heading km_primary_color"><?php _e('Billing Address', 'fieldday');?></h3>
                <div class="km_billing_wrap">
                    <div class="km_col_12 km_field_wrap">
                            <input type="text" class="km_input km_addr_city" name="paymentAddress[city]" placeholder="Enter Location" id="address_autocomplete" data-parsley-required-message="Required" data-parsley-group="<?php //echo $step['name']; ?>"  required=""/>
                    </div></div>
                </div>
            </div>
         <div class="km_cardinfo_text km_payment_column">
            <?php print apply_filters('km_savecard_infotext', __('<b>Save This Card</b> is required when selecting a payment option that will see future automated withdrawals, such as Installments.', 'fieldday'));?>
        </div>
    </div>

        </div>

        <hr class="km_hrline" />
        <div class="km_row">
            <div class="km_col_6">
                <div class="km_term_condition">
                    <label class='km_checkbox_wrap'>
                        <span><?php print wp_sprintf("%s <a class='km_provider_terms_display' href=''>%s</a>", __("I've read and accept the", 'fieldday'), __("terms & conditions", 'fieldday'));?></span>
                        <input required="required" name="km_terms_condition" data-parsley-required-message="Please accept terms & conditions" data-parsley-group="<?php echo $step['name']; ?>" type="checkbox" class="km_provider_terms km_checkboxteam" required="required">
                        <span class="km_checkbox"></span>
                    </label>
                    <div class="km_hidden">
                        <?php print $this->getProviderTerms($step['name']);?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="km_btn_wrap">
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_color  km_transparent_bg" onclick="return fieldday.PrevStep();"><?php $this->displayText('atc_prev_btn');?></a>
        <a href="javascript:void(0);" id="km_checkout_buy_button_pc" class="km_next_step km_btn km_primary_bg  km_btn_i_wrapper" data-group="<?php echo $step['name']; ?>" onclick="return fieldday.process_purchase(this, event);">
        <i class="km_btn_i_cls km_hidden fa fa-circle-o-notch fa-spin"></i>
        <?php _e("Place Your Order", 'fieldday');?>
    </a>
    </div>
</div>