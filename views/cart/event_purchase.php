<?php
$eventPrices = $session->eventPrice;
$isCustomGrouping = $session->isCustomGrouping;
$customGroups = $session->customGroups;
$priceNotes = $session->priceNotes;
$allvalues = json_decode(json_encode($eventPrices), true);
if (!array_filter($allvalues)) {
    $eventPrice = 0;
    $paymentMethod = "free";
    $hiddenClass = "km_hidden";
} else { $eventPrice = 1;
    $paymentMethod = "card";
    $hiddenClass = "";}

$additionalCharges = $session->additionalCharges;
$extendedCareDetails = $session->extendedCareDetails;
if ($this->getvalue('isPriceForAllKids', $extendedCareDetails, false) != '' && $this->getvalue('isPriceForAllKids', $extendedCareDetails, false) != 'true') {$priceforAllkids = '';} else { $priceforAllkids = '/seat';}
$session_type = $this->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
$SelectedAdditionalcharges = [];
$SelectedPaymentOptions = [];
$selected_payment_option = null;
if ($cartItem) {
    //echo "<pre>"; print_r($cartItem); echo "</pre>";
    $selected_payment_option = $cartItem['selected_payment_option'];
    $selectedExtendedCare = $cartItem['extendedCareSelected'];
    $SelectedAdditionalcharges = $cartItem['additionalChargeDetails'];
    $bookingoption_selection = $cartItem['bookingoption_selection'];
    $dropindates = $cartItem['dropindates'];
    if (!$SelectedAdditionalcharges) {
        $SelectedAdditionalcharges = [];
    }
}
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
$sessionPrice = $session->price;
$sessionPriceRange = $session->activityId->priceRange;
$sessionPriceRangeFrom = $sessionPriceRange->from;
$sessionPriceRangeto = isset($sessionPriceRange->to) ? $sessionPriceRange->to : null;
$location = $session->siteLocationId->name;
$location_state = $session->siteLocationId->state;
$location_country = $session->siteLocationId->country;
$location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
$session_fullday_price = $session->siteLocationId->oneDayDetails->fullDay->price;
$eventDates = $session->eventDates;
$disableinfants = $disabletodders = $disablechildren = $disableyouth = $disableadults = $disableabove = '';

if ($agefrom >= 2) {$disableinfants = 'disabled';}
if ($agefrom >= 4) {$disabletodders = 'disabled';}
if ($agefrom >= 12) {$disablechildren = 'disabled';}
if ($agefrom >= 18) {$disableyouth = 'disabled';}
if ($agefrom >= 65) {$disableadults = 'disabled';}

?>
<form action="" method="post" id="km_add_to_cart_form" class="km_add_to_cart_form_event_purchase">
    <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $session->_id; ?>">
    <input type="hidden" name="ATC[stripeToken]" class="stripe_token" value="null">
    <input type="hidden" name="ATC[paymentmethod]" class="paymentMethod" value="<?php echo $paymentMethod; ?>">
     <?php if (is_array($eventDates)) {
    foreach ($eventDates as $eventDate) {
        ?>
    <input type="hidden" class="session_date" name="ATC[session_date][]" id="km_atc_session_date" value="<?php echo $eventDate->from; ?>">
    <?php
}
}?>
<div class="km_row km_package_wrapper">

    <div class="km_col_5">
            <div class="km_package_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
                <div class="km_package_session_img km_no_payment_info">
                    <?php $this->displaySessionThumb($session);?>
                </div>
                <!-- <h3 style="" class="km_session_name_heading"><?php //echo $session->name; ?></h3> -->
                <div class="km_row km_common_div">
                    <div class="km_age km_no_payment_info km_col_6">
                        <i class="fa fa-child km_primary_color" aria-hidden="true"></i>
                        <span class="package_price"><?php print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto)?></span>
                    </div>
                    <div class="km_location_package_section km_no_payment_info km_col_6">
                        <i class="fa fa-map-marker km_primary_color"></i>
                        <span class="km_location_session_details">
                        <a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a></span>
                    </div>
                </div>
                <div class="km_date_time km_common_div">
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
                </div>
                <!-- <div class="km_price_package km_no_payment_info km_common_div">
                    <i class="fa fa-money km_primary_color" aria-hidden="true"></i>
                    <span class="price">
                        <i class="fa fa-usd GridIcon" aria-hidden="true"></i>
                        <?php //echo $this->display_price($session_fullday_price); _e('/day','fieldday');?>
                        <?php
//if (!empty($sessionPriceRangeTo)) :
// wp_sprintf("- %s", $this->display_price($sessionPriceRangeTo));
//endif;
?>
                    </span>
                </div> -->
                <div class="km_package_payment_screen_info km_hidden">
                    <div class="km_selected_package">
                        <h5 class="km_pkg_kids"><?php _e('Selected Package', 'fieldday');?></h5>
                        <div class="km_package_sel"></div>
                    </div>
                    <div class="km_selected_kids">
                        <h5 class="km_pkg_kids"><?php _e('Selected Kids', 'fieldday');?></h5>
                        <div class="km_kids"></div>
                    </div>
                </div>

            </div>
            <div class="km_event_ordersummary km_hidden"></div>
        </div>
    <div class="km_col_7 km_events_right">
        <div class="km_field_wrap km_cart_options">
            <?php if ($isCustomGrouping) {

    ?>
            <span class="km_hidden kmeventPrice"><?php echo $eventPrice; ?></span>
            <span class="kmeventrequired  km_seats_error_message_event_tickets"></span>
<?php foreach ($customGroups as $customGroup) {
        $hasSeatRestriction = fieldday()->engine->getvalue('hasSeatRestriction', $customGroup, false);
        if ($hasSeatRestriction) {
            $totalSeats = fieldday()->engine->getvalue('totalSeats', $customGroup, false);
            $totalSeats = $totalSeats?$totalSeats:0;
            $bookedSeats = fieldday()->engine->getvalue('bookedSeats', $customGroup, false);}
            $bookedSeats = $bookedSeats?$bookedSeats:0;
            $lparticipant = end($customGroup->included);
            if ($customGroup->price > 0) {
                $subline = $this->display_price($customGroup->price) . ' + 6% Processing Fee per ticket';
            } else {
                $subline = 'Free for participant with age ' . $customGroup->ageTo . ' & under';
            }
        ?>
                <div class="km_addmi_options"><div><h3 class="km_margin_zero"><?php echo $customGroup->name; ?>
                <span class="km_parti_age"><?php echo $subline; ?></span></h3>
                <?php
$inclusionNotes = fieldday()->engine->getvalue('inclusionNotes', $customGroup, false);
        if (!empty($inclusionNotes)): ?>
                <div class="km_field_wrap km_atc_paymentoptions">
                    <p class="km_ticketinclude km_primary_color"><?php _e("Ticket Includes <span class='km_more_includes km_primary_color'></span>", "fieldday");?></p>
                    <div class="km_event-notes">
                            <?php foreach ($inclusionNotes as $inclusionNote): ?>
                                <span class="km_bringing_need_item km_package_description"><?php echo $inclusionNote; ?></span>
                            <?php endforeach;?>
                    </div>
                </div>
                <?php endif;?>
                </div>
                <?php
$arrayValues = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $disabled = $SoldOut = '';
        if ($hasSeatRestriction) {
            $arrayValues = array();
            if ($totalSeats <= $bookedSeats) {$disabled = 'km_hidden';
                $SoldOut = '<p class="km_event_soldout">Sold Out</p>';} else {
                $availableSeats = $totalSeats - $bookedSeats;
                if ($availableSeats <= 0) {
                    $disabled = 'km_hidden';
                    $SoldOut = '<p class="km_event_soldout">Sold Out</p>';
                } else {
                    for ($x = 0; $x <= $availableSeats; $x++) {
                        array_push($arrayValues, $x);
                    }
                }
            }
        }
        ?>

<!-- show increment and decrement only when tickets are available -->
        <?php
        if( ($hasSeatRestriction && $totalSeats-$bookedSeats>0) || (!$hasSeatRestriction)){  ?>
        <!-- new code layout--->
                <div class='input-group km_addmi_options_input-number-group'>
                    <div class='km_addmi_options_input-group-button'>
                        <span class='km_addmi_options_input-number-decrement  km_primary_bg'>-</span>
                    </div>
                    <input name="ATC[<?php echo $lparticipant; ?>]" class='km_addmi_options_input-number <?php echo $disabled; ?>' type='number' value='<?php echo $arrayValues[0]; ?>' min='<?php echo $arrayValues[0]; ?>'  name='child'>
                    <div class='km_addmi_options_input-group-button'>
                        <span class='km_addmi_options_input-number-increment km_primary_bg'>+</span>
                    </div>
                </div>
        <!-- new code end--->
<!-- show increment and decrement only when tickets are available end -->
        <?php  }   echo $SoldOut; ?>
                </div>
            <?php
}
}

if (!$isCustomGrouping) {?>
        <h3 class="km_primary_color"><?php _e('How many tickets would you like?', 'fieldday');?> <span class="km_asterisk">*</span></h3>
        <span class="km_hidden kmeventPrice"><?php echo $eventPrice; ?></span>
        <span class="kmeventrequired km_seats_error_message_event_tickets"></span>

<ul class="km_event_participants km_event_participants_new_inc_dec_design">
            <?php
if (!$disableinfants) {?>
                    <li><label>Infants<span class="km_parti_age">Ages 0-2</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disableinfants; ?>">-</span><input <?php echo $disableinfants; ?> name="ATC[infants]"  class="km_eparticipants_type" value ="0" type="text"><span class="km_primary_bg plus <?php echo $disableinfants; ?>">+</span> </div> </li>
                <?php }

    if (!$disabletodders) {?>
                    <li><label>Toddler<span class="km_parti_age">Ages 2-4</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disabletodders; ?>">-</span><input <?php echo $disabletodders; ?> name="ATC[toddler]" class="km_eparticipants_type" value="0" type="text"><span class="km_primary_bg plus <?php echo $disabletodders; ?>">+</span> </div></li>
                <?php }

    if (!$disablechildren) {?>
                    <li><label>Children<span class="km_parti_age">Ages 4-12</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disablechildren; ?>">-</span><input <?php echo $disablechildren; ?> name="ATC[children]" class="km_eparticipants_type" value="0" type="text"><span class="km_primary_bg plus <?php echo $disablechildren; ?>">+</span> </div></li>
                <?php }
    if (!$disableyouth) {?>
                    <li><label>Youth<span class="km_parti_age">Ages 12-18</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disableyouth; ?>">-</span><input <?php echo $disableyouth; ?> name="ATC[youth]" class="km_eparticipants_type" value="0" type="text"><span class="km_primary_bg plus <?php echo $disableyouth; ?>">+</span> </div></li>
                <?php }
    if (!$disableadults) {?>
                    <li><label>Adults<span class="km_parti_age">Ages 18-65</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disableadults; ?>">-</span><input <?php echo $disableadults; ?> name="ATC[adults]" class="km_eparticipants_type" value="0" type="text"><span class="km_primary_bg plus <?php echo $disableadults; ?>">+</span> </div></li>
                <?php }
    ?>

                <li><label>Seniors<span class="km_parti_age">Ages 65 & Above</span></label><div class="number"><span class="km_primary_bg minus <?php echo $disableabove; ?>">-</span><input <?php echo $disableabove; ?> name="ATC[seniors]" class="km_eparticipants_type" value="0" type="text"><span class="km_primary_bg  plus <?php echo $disableabove; ?>">+</span> </div></li>
</ul>

            <?php }?>
        <?php if ($priceNotes) {
    echo '<div class="km_event_note">';
    foreach ($priceNotes as $priceNote) {
        echo '<span class="km_event_note_points">' . $priceNote->text . '</span>';
    }
    echo '</div>';
    //print_r($priceNotes); echo '<div class="km_event_note">'.$priceNotes[0]->text.'</div>';
}
?>
        <div class="km_events_prices_section <?php echo $hiddenClass; ?>"></div>
        </div>
        <!--Credit Card details -->
        <div class="km_event_credit km_hidden">
            <?php if (!$KmUser) {?>
        <div class="km_event_info">
            <h3 class="km_heading_wrap km_primary_color"><?php _e('Personal Details', 'fieldday');?> </h3>
            <div class="km_col_6 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('First Name', 'fieldday')?></label><span class="km_asterisk">*</span>
                    <input type="text" oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"    data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."  value="<?php $this->getValue('name', $KmUser);?>" name="parent[name]" value="" class="km_input" data-parsley-group="event_fields" data-parsley-required-message="Required" required=""/>
                </fieldset>
            </div>
            <div class="km_col_6 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Last Name', 'fieldday')?></label><span class="km_asterisk">*</span>
                    <input   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"     data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."  type="text" value="<?php $this->getValue('lname', $KmUser);?>" name="parent[lname]" value="" class="km_input" data-parsley-group="event_fields" data-parsley-required-message="Required" required=""/>
                </fieldset>
            </div>

            <div class="km_col_6 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Email', 'fieldday');?></label><span class="km_asterisk">*</span>
                    <input   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"     data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-type-message="Invalid Email"  type="email" value="<?php $this->getValue('email', $KmUser);?>" name="parent[guestEmail]" value="" id="parentEmail" data-parsley-group="event_fields" class="km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Email" required=""/>
                </fieldset>
            </div>
            <div class="km_col_6 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Phone Number', 'fieldday');?></label><span class="km_asterisk">*</span>
                    <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                    <input type="tel" value="" name="parent[phone]" id="parentPhone" data-parsley-group="event_fields" class="km_phone_field km_input"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-required-message="Required" data-parsley-type-message="Invalid Phone" required=""/>
                </fieldset>
            </div>
            <div class="km_col_12 km_field_wrap">
                <fieldset class="">
                    <label><?php _e('Contact Address', 'fieldday');?></label><span class="km_asterisk">*</span>
                    <input type="text" name="parent[address]" id="address_autocomplete" data-parsley-required-message="Required" required="required" data-parsley-group="event_fields" class="pac-target-input km_input" placeholder="Enter a location" autocomplete="off">
                    <!-- <input type="text" value="" name="parent[address]" value="" id="parentAddress" data-parsley-group="event_fields" class="km_input" data-parsley-required-message="Required" required=""/> -->
                </fieldset>
            </div>
        </div>
        <?php }?>
        <?php if ($eventPrice != 0) {?>
            <div class="km_package_card km_merchandise_card">
                        <h3 class="km_heading_wrap km_primary_color"><?php _e('Payment Details', 'fieldday');?> </h3>
                        <div class="km_card">
                            <?php $paymentMethods = fieldday()->api->getSavedCards();?>
                            <?php foreach ($paymentMethods->data as $key => $paymentMethod): ?>
                                <label class="km_radio_wrap km_radio_wrap_care">
                                    <span class="km_radio_text">
                                        <div class="credit-card-last4">
                                            <?php echo $paymentMethod->cardLast4; ?>
                                        </div>
                                    </span>
                                    <input class="km_package_cardId km_payment_option" <?php echo $paymentMethod->isDefault ? 'checked' : ''; ?> type="radio" value="<?php echo $paymentMethod->_id; ?>" name="ATC[cardId]">
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
                        </div>
                        <div class="km_payment_wrap <?php echo $KmUser && $paymentMethods->data ? 'km_hidden' : ''; ?>">
                            <div class="km_col_12 km_field_wrap field_card_number">
                                <fieldset>
                                    <label for="card-number"><?php _e('Card Number', 'fieldday');?></label><span class="km_asterisk">*</span>
                                    <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="event_fields"  required="" />
                                    <div id="card-type2" class="km_card_type"></div>
                                </fieldset>
                            </div>

                            <div class="km_col_12 km_field_wrap field_card_holdername">
                                <fieldset>
                                    <label for="card-holder-name"><?php _e('Card Holder Name', 'fieldday');?></label><span class="km_asterisk">*</span>
                                    <input type="text"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  id="card-holder-name" class="km_card_holder km_input"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"     data-parsley-required-message="Required"  data-parsley-group="event_fields" required="" />
                                </fieldset>
                            </div>
                            <div class="km_event_crds">
                            <div class="km_col_4 km_field_wrap field_card_exp">
                                <fieldset>
                                    <label><?php _e('Exp.Month', 'fieldday');?></label><span class="km_asterisk">*</span>
                                    <div class="km_custom_dropdown">
                                        <select id='expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="event_fields" required="" >
                                            <option value='' selected>Select</option>
                                            <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                                                <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="km_col_4 km_field_wrap field_card_exp_year">
                                <fieldset>
                                    <label><?php _e('Exp.Year', 'fieldday');?></label><span class="km_asterisk">*</span>
                                    <div class="km_custom_dropdown">
                                        <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="event_fields" data-parsley-required-message="Required"  required=""  >
                                            <option value=''>Select</option>
                                            <?php
for ($i = date('Y'); $i <= date('Y') + 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
    ?>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="km_col_4 km_field_wrap field_card_cvv">
                                <fieldset class="">
                                    <label for="cvv-code"><?php _e('CVV Code', 'fieldday');?></label><span class="km_asterisk">*</span>
                                    <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="event_fields" data-parsley-required-message="Required"  required=""   />
                                </fieldset>
                            </div>
                        </div>
                <div class="km_col_12 km_field_wrap km_terms">
                    <div class="km_term_condition">
                    <label class='km_checkbox_wrap'>
                        <span><?php print wp_sprintf("%s <a class='km_provider_terms_display' href=''>%s</a>", __("I've read and accept the", 'fieldday'), __("terms & conditions", 'fieldday'));?><span class="km_asterisk">*</span></span>
                        <input required="required" name="km_terms_condition" data-parsley-required-message="Please accept terms & conditions" data-parsley-group="event_fields" type="checkbox" class="km_provider_terms km_checkboxteam" required="required">
                        <span class="km_checkbox"></span>
                    </label>
                    <!-- <div class="km_hidden">
                        <?php //print $this->getProviderTerms($step['name']); ?>
                    </div> -->
                    </div>
                </div>

                        </div>
        </div> <!--end of Payment fields -->
        <?php } else {
    if ($KmUser) {
        _e('<span class="km_freevent">Enjoy Free Event, Please click on checkout button to confirm the Booking.</span>', 'fieldday');
    } else {_e('<span class="km_freevent km_notloggedIn">Enjoy Free Event, Fill the details above and click on checkout button to confirm the Booking.</span>', 'fieldday');}
}?>
        </div>

    </div>
</div>
</form>
<div class="thank-you-section" style="display: none;">
    <?php print $content = fieldday()->engine->getView('checkout/thanksevent');?>
</div>