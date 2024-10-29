<?php
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
$location = $session->siteLocationId->name;
?>
<form action="" method="post" id="km_add_to_cart_form"   class="km_add_to_cart_package_copy">
    <input type="hidden" class="package_id" name="ATC[package_id]" id="km_atc_package_id" value="<?php echo $package->_id; ?>">
    <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $sessionid; ?>">
    <input type="hidden" name="ATC[stripeToken]" class="stripe_token" value="null">
    <input type="hidden" name="ATC[paymentmethod]" class="paymentMethod" value="card">

    <div class="km_atc_header">
        <h3><?php print $session->name; ?></h3>
    </div>
    <div class="km_newparticipant_form">

    </div>
    <div class="km_row">
        <div class="km_col_5">
            <div class="km_session_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
                <div class="km_package_session_img">
                        <?php $this->displaySessionThumb($session); ?>
                </div> 
                <h3 style="" class="km_session_name_heading"><?php echo $session->name; ?></h3>  
                <div class="km_age">
                    <span class="session_age_group"><?php print wp_sprintf("%d - %d yrs", $agefrom, $ageto) ?></span>
                </div>
                <div class="km_date_time">
                    <div class="km_location_session_section">
                        <i class="fa fa-map-marker"></i>
                        <span class="km_location_session_details"><?php echo $location; ?></span>
                    </div>
                </div>


            </div>
        </div>
        <div class="km_col_7">
            <div class="km_col_12 km_field_wrap km_atc_participants">
                <?php print $this->fielddayCartParticipants($cartItem); ?>
            </div>
            <div class="recommendedclassPackages km_field_wrap "></div>
            <div class="km_about_package km_field_wrap ">
                <div class="km_col_12 km_field_wrap km_atc_paymentoptions required_field">
                    <div class="km_field_wrap ">
                        <h3 class="km_heading_wrap  "><?php _e('About Class Packages') ?></h3>
                        <span class="km_package_description">
                            <?php echo $package->description; ?>
                        </span>
                    </div>
                </div>    
            </div>
        </div>
    </div>    
    
    <div class="km_col_12 km_field_wrap km_atc_paymentoptions required_field">
    <!-- <div class="km_package_price"><h4><?php //_e('Payment: ', 'fieldday');  ?><span><?php //echo $price;  ?></span></h4></div> -->
        <div class="km_row package_payment_section">
            
            <!-- Card detail -->
            <div class="km_col_7 km_package_card km_merchandise_card">
                    <h3 class="km_heading_wrap  "><?php _e('Payment Details', 'fieldday'); ?> </h3>
                    <div class="km_card">
                        <?php $paymentMethods = fieldday()->api->getSavedCards(); ?>
                        <?php foreach ($paymentMethods->data as $key => $paymentMethod) : ?>
                            <label class="km_radio_wrap km_radio_wrap_care">
                                <span class="km_radio_text">
                                    <div class="credit-card-last4">
                                        <?php echo $paymentMethod->cardLast4; ?>
                                    </div>
                                </span>
                                <input class="km_payment_option" <?php echo $paymentMethod->isDefault ? 'checked' : ''; ?> type="radio" value="<?php echo $paymentMethod->_id; ?>" name="cardId">
                                <span class="km_radio"></span>
                            </label>
                        <?php endforeach; ?>
                        <?php if ($paymentMethods->data): ?>
                            <label class="km_radio_wrap km_radio_wrap_care">
                                <span class="km_radio_text">
                                    <div class="cradit_debit_card">
                                        <?php _e("Credit/Debit Card"); ?>
                                    </div>
                                </span>
                                <input class="km_payment_option km_enable_cardoption" value="" type="radio">
                                <span class="km_radio"></span>
                            </label>
                        <?php endif; ?>    
                </div>
                <div class="km_payment_wrap <?php echo $KmUser && $paymentMethods->data ? 'km_hidden' : ''; ?>">
                    <div class="km_col_8 km_field_wrap field_card_number">
                        <fieldset>
                            <label for="card-number"><?php _e('Card Number', 'fieldday'); ?></label>
                            <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  required="" />
                            <div id="card-type2" class="km_card_type"></div>
                        </fieldset>
                    </div>
                    <div class="km_col_4 km_field_wrap field_card_cvv">
                        <fieldset class="">
                            <label for="cvv-code"><?php _e('CVV Code', 'fieldday'); ?></label>
                            <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="merchandise_field" data-parsley-required-message="Required"  required=""   />
                        </fieldset>
                    </div>
                    <div class="km_col_12 km_field_wrap field_card_holdername">
                        <fieldset>
                            <label for="card-holder-name"><?php _e('Card Holder Name', 'fieldday'); ?></label>
                            <input type="text" id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="merchandise_field" required="" />
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp">
                        <fieldset>
                            <label><?php _e('Exp.Month', 'fieldday'); ?></label>
                            <div class="km_custom_dropdown">
                                <select id='expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="merchandise_field" required="" >
                                    <option value='' selected>Select</option>
                                    <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                                        <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp_year">
                        <fieldset>
                            <label><?php _e('Exp.Year', 'fieldday'); ?></label>
                            <div class="km_custom_dropdown">
                                <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="merchandise_field" data-parsley-required-message="Required"  required=""  >
                                    <option value=''>Select</option>
                                    <?php
                                    for ($i = date('Y'); $i <= date('Y') + 30; $i++)
                                    {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp_year">
                        <label class='km_checkbox_wrap'>
                            <span><?php _e("Save Card") ?></span>
                            <input name="ATC[savecard]" value="true" disabled checked="checked" type="checkbox" class="km_checkboxteam savecardcheck">
                            <span class="km_checkbox"></span> 
                        </label>    
                    </div>
                    <div class="km_col_12 km_field_wrap field_card_exp_year">
                        <span class="km_save_card_info">Save This Card is required when selecting a payment option that will see future automated withdrawals, such as Installments.</span>
                    </div>
                </div>
            </div>  
            <!-- Card detail //////////// -->
            <!-- Session detail -->
        </div>
        <div class="store_json" data-json=""></div>
    </div>
</form>
<div class="thank-you-section" style="display: none;">
<?php print $content = fieldday()->engine->getView('checkout/thanks'); ?>
</div>