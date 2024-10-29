<?php
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
$sessionPrice = $session->price;
$sessionPriceRange = $session->activityId->priceRange;
$sessionPriceRangeto = isset($sessionPriceRange->to) ? $sessionPriceRange->to : null;
$location = $session->siteLocationId->name;
$location_state = $session->siteLocationId->state;
$location_country = $session->siteLocationId->country;
$location_link = "https://www.google.com/maps/place/".$location.",+".$location_state.",+".$location_country;
?>
<form action="" method="post" id="km_add_to_cart_form"  class="km_add_to_cart_package">
    <input type="hidden" class="package_id" name="ATC[package_id]" id="km_atc_package_id" value="<?php echo $package->_id; ?>">
    <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $sessionid; ?>">
    <input type="hidden" name="ATC[stripeToken]" class="stripe_token" value="null">
    <input type="hidden" name="ATC[paymentmethod]" class="paymentMethod" value="card">
    <div class="km_newparticipant_form">
    </div>
    <div class="km_row km_package_wrapper">
        <div class="km_col_5">
            <div class="km_package_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
            <div class="km_package_session_img km_no_payment_info">
                <?php $this->displaySessionThumb($session); ?>
            </div>
            <div class="km_row km_common_div km_no_payment_info">
                <div class="km_age km_no_payment_info km_col_4">
                    <i class="fa fa-<?php echo $icon; ?> km_primary_color" aria-hidden="true"></i>
                    <span class="package_price"><?php 
                        print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
                    ?>    
                    </span>
                </div>
                <div class="km_location_package_section km_no_payment_info km_col_8">
                    <i class="fa fa-map-marker km_primary_color"></i>
                    <span class="km_location_session_details">
                    <a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a></span>
                </div>
            </div>
            <div class="km_date_time km_common_div km_package_datet">
                <div class="km_date_p02">
                    <div class="km_date_p">
                        <i class="fa fa-calendar km_primary_color" aria-hidden="true"></i>
                        <span class="km_session_month"></span>
                    </div>
                    <div class="km_date_p">
                        <span class="km_session_year"></span>
                    </div>
                </div>
                <div class="km_time_p">
                    <i class="fa fa-clock km_primary_color" aria-hidden="true"></i>
                    <span class="km_sess_time"></span>
                </div>
                <div class="km_session_days_wrap">
                    <?php $this->sessionDays($session); ?>
                </div>
            </div>
            <div class="km_price_package km_no_payment_info km_common_div">
                <i class="fa fa-money km_primary_color" aria-hidden="true"></i>
                <span class="price">
                    <i class="fa fa-usd GridIcon" aria-hidden="true"></i>
                    <?php if($session->offersClassPackages){ echo $this->CountPackagePrice(1,false,true);   } else {echo $this->display_price($session->price);}  ?>
                    <?php
                    if (!empty($sessionPriceRangeTo)) :
                        wp_sprintf("- %s", $this->display_price($sessionPriceRangeTo));
                    endif;
                    ?>
                </span>
            </div>
            <div class="km_package_payment_screen_info km_hidden">
                <div class="km_selected_package">
                    <h5 class="km_pkg_kids km_primary_color"><?php _e('Selected Package','fieldday'); ?></h5>
                    <div class="km_package_sel"></div>
                </div>
                <div class="km_selected_kids">
                    <h5 class="km_pkg_kids km_primary_color"><?php _e('Selected Kids','fieldday'); ?></h5>
                    <div class="km_kids"></div>
                </div>
            </div>
            </div>
        </div>
        <div class="km_col_7 km_package_participants">
            <div class="km_col_12 km_field_wrap km_atc_participants">
                <?php print $this->fielddayCartParticipants($cartItem); ?>
            </div>
            <div class="recommendedclassPackages km_field_wrap km_atc_paymentoptions"></div>
            <div class="km_about_package km_field_wrap ">
                <div class="km_col_12 km_field_wrap km_atc_paymentoptions required_field">
                    <div class="km_field_wrap ">
                        <h3 class="km_heading_wrap km_primary_color"><?php _e('About Class Packages') ?></h3>
                        <span class="km_package_description">
                            <?php echo $package->description; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="km_renewal km_field_wrap km_atc_paymentoptions">
            </div>
            <div class="km_col_12 km_field_wrap km_atc_paymentoptions required_field">
                <div class="km_row package_payment_section">
                    <!-- Billing Address -->
                   <div class="km_col_12 km_billing_address required_field">
                        <fieldset class="">
                            <!-- <label for="cvv-code">Billing Address</label> -->
                            <h3 class="km_heading_wrap km_primary_color"><?php _e('Billing Address', 'fieldday'); ?> </h3>
                            <input type="text" id="address_autocomplete"data-parsley-required-message="Required" required="required">
                        </fieldset>
                    </div>
                    <!-- Card detail -->
                    <div class="km_package_card km_merchandise_card">
                        <h3 class="km_heading_wrap km_primary_color"><?php _e('Payment Details', 'fieldday'); ?> </h3>
                        <div class="km_card">
                            <?php $paymentMethods = fieldday()->api->getSavedCards(); ?>
                            <?php foreach ($paymentMethods->data as $key => $paymentMethod) : ?>
                                <label class="km_radio_wrap km_radio_wrap_care">
                                    <span class="km_radio_text">
                                        <div class="credit-card-last4">
                                            <?php echo $paymentMethod->cardLast4; ?>
                                        </div>
                                    </span>
                                    <input class="km_package_cardId km_payment_option" <?php echo $paymentMethod->isDefault ? 'checked' : ''; ?> type="radio" value="<?php echo $paymentMethod->_id; ?>" name="ATC[cardId]">
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
                                    <input type="text"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="merchandise_field" required="" />
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
                                <span class="km_save_card_info"><?php _e("Save This Card is required when selecting a payment option that will see future automated withdrawals, such as Installments.") ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Card detail //////////// -->
                    <div class="km_col_12 km_field_wrap km_terms">
                    <div class="km_term_condition">
                    <label class='km_checkbox_wrap'>
                        <span><?php print wp_sprintf("%s <a class='km_provider_terms_display' href=''>%s</a>", __("I've read and accept the", 'fieldday'), __("terms & conditions", 'fieldday')); ?></span>
                        <input required="required" name="km_terms_condition" data-parsley-required-message="Please accept terms & conditions" data-parsley-group="merchandise_field" type="checkbox" class="km_provider_terms km_checkboxteam" required="required">
                        <span class="km_checkbox"></span>
                    </label>
                    <!-- <div class="km_hidden">
                        <?php //print $this->getProviderTerms($step['name']); ?>
                    </div> -->
                    
                </div></div>
                    <!-- Session detail -->
                </div>
                <div class="store_json" data-json=""></div>
            </div>
        </div>
    </div>
</form>
<div class="thank-you-section" style="display: none;">
    <?php print $content = fieldday()->engine->getView('checkout/thanks'); ?>
</div>