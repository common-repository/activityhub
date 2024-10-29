<?php
if(($session->bookingStatus=='open' || $session->bookingStatus=='waitlist') && $KmUser){
$session_extra = $this->GetSessionVar($session);
$skillLevelOption = $session->skillLevelOption;
if($skillLevelOption=='grade'){
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
}else{ $icon = "child"; }
$additionalCharges = $session->additionalCharges;
$additionalDayPrice=$session->additionalDayPrice;
$extendedCareDetails = $session->extendedCareDetails;
if($this->getvalue('isPriceForAllKids', $extendedCareDetails, false)!='' && $this->getvalue('isPriceForAllKids', $extendedCareDetails, false)!='true'){ $priceforAllkids = ''; } else { $priceforAllkids = '/seat';}
$session_type = $this->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
$SelectedAdditionalcharges = [];
$SelectedPaymentOptions = [];
$selected_payment_option = null;
if($cartItem) { 
    $selected_payment_option = $cartItem['selected_payment_option'];
    $selectedExtendedCare = $cartItem['extendedCareSelected'];
    $SelectedAdditionalcharges = $cartItem['additionalChargeDetails'];
    $bookingoption_selection = $cartItem['bookingoption_selection'];
    $dropindates = $cartItem['dropindates'];
    $dropindatestime = $cartItem['dropindatestime'];
    if(!$SelectedAdditionalcharges) {
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
$location_link = "https://www.google.com/maps/place/".$location.",+".$location_state.",+".$location_country;
$session_fullday_price = $session->siteLocationId->oneDayDetails->fullDay->price;
$currentdate = date("m/d/Y");
$campstart_date = $this->parseDate($session->dateTimestamp->from,'M d, Y');
$campend_date = $this->parseDate($session->dateTimestamp->to,'M d, Y');
$dateto = $this->parseDate($session->dateTimestamp->to,'m/d/Y');
$title = $logintitle = "Who'll be attending?";
$Iscredit = $this->Get_User_Credit();
$discardDates = $session->discardDates;
$frequencyPrice = $this->getValue('frequencyPrice', $session, false); 
$midWeekBookingAllowed = $this->getValue('midWeekBookingAllowed', $session, false); 
?>
<form action="" method="post" id="km_add_to_cart_form" data-age-from="<?php echo $agefrom; ?>" data-age-to="<?php echo $ageto; ?>" class="km_add_to_cart_form_atc_multiweek">
  <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $session->_id; ?>">
  <input type="hidden" class="tag_id" name="ATC[tag_id]" id="km_atc_tag_id" value="<?php echo $tagId; ?>">
  <input type="hidden" class="agefrom" name="ATC[age_from]" id="km_atc_agefrom" value="<?php echo $agefrom; ?>">
  <input type="hidden" class="ageto" name="ATC[age_to]" id="km_atc_ageto" value="<?php echo $ageto; ?>">
  <input type="hidden" name="ATC[stripeToken]" class="stripe_token" value="null">
    <input type="hidden" name="ATC[paymentmethod]" class="paymentMethod" value="free">
  <?php if($Iscredit) { ?>
    <input type="hidden" class="storeCreditUsed" name="storeCreditUsed" value ="<?php echo $Iscredit[0]->_id; ?>">
  <?php } ?>
  

  <?php if(is_array($_REQUEST['sessionDate'])){
foreach($_REQUEST['sessionDate'] as $sessiondate){ ?>
<input type="hidden" class="session_date" name="ATC[session_date][]" id="km_atc_session_date" value="<?php echo $sessiondate; ?>">
<?php }
 }else{?>
  <input type="hidden" class="session_date" name="ATC[session_date]" id="km_atc_session_date" value="<?php echo $sessionDate; ?>">

    <?php } if($cartkey) : ?>
    <input type="hidden" name="cartItemKey" id="km_atc_cartkey" value="<?php echo $cartkey; ?>">
    <?php endif; ?>
    <div class="km_newparticipant_form"></div>
    <div class="km_row km_package_wrapper">
        <div class="km_col_5">
            <div class="km_package_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
                <div class="km_package_session_img km_no_payment_info">
                    <?php $this->displaySessionThumb($session); ?>
                </div>
                <div class="km_row km_common_div">
                    <div class="km_age km_no_payment_info km_col_6">
                        <i class="fa fa-child km_primary_color" aria-hidden="true"></i>
                        <span class="package_price"><?php 
                        if($skillLevelOption=='grade'){
                          print wp_sprintf("Grade(s): %s - %s", $gradefrom, $gradeto);
                        } else {
                          print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
                        }
                        ?></span>
                    </div>
                    <div class="km_location_package_section km_no_payment_info km_col_6">
                        <i class="fa fa-map-marker km_primary_color"></i>
                        <span class="km_location_session_details">
                        <a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a></span>
                    </div>
                </div>
                <div class="km_date_time km_common_div km_cart_date">
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
                <div class="km_package_payment_screen_info km_hidden">
                    <div class="km_selected_package">
                        <h5 class="km_pkg_kids"><?php _e('Selected Package','fieldday'); ?></h5>
                        <div class="km_package_sel"></div>
                    </div>
                    <div class="km_selected_kids">
                        <h5 class="km_pkg_kids"><?php _e('Selected Kids','fieldday'); ?></h5>
                        <div class="km_kids"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="km_col_7 km_package_participants">
        <div class="km_field_wrap km_multiweek_options">
        <div class="km_col_12 km_field_wrap km_atc_participants km_multiweek_section km_multiweek_session">
          <span class="kmkidsrequired km_required"></span>
            <?php print $this->fielddayCartParticipants($cartItem, $session, $title,$logintitle); ?>
        </div>
        
         <div class="km_booking_selection km_multiweek_booking km_atc_participants_booking">
          <?php  $bookingsPermitted = $this->getValue('bookingsPermitted', $session, false); 
          $daysOfWeek = $this->getValue('daysOfWeek', $session, false); 
          if($bookingsPermitted=='oneDays' && $daysOfWeek){ ?>
            <span class="kmdaysrequired km_required"></span>
            <h3 class="km_primary_color"><?php _e('Select One or more Session Day', 'fieldday'); ?> <span class="km_asterisk">*</span></h3>
            <?php
            echo '<div class="km_event_Daysweek">';
            foreach ($this->_weekDays() as $dayNum => $weekday)
            {
              $activeClass = in_array($dayNum, $daysOfWeek) ? "km_day_active km_secondary_bg" : "";
              if(in_array($dayNum, $daysOfWeek)){ ?>
                <label class="km_checkbox_wrap km_checkbox_wrap_care">
                  <span class="km_radio_text"><?php echo $weekday['short']; ?></span>
                  <input class="km_purchasefield km_multiweekday_selection" data-text="WeekDays" type="checkbox" value="<?php echo $dayNum; ?>" name="ATC[daysOfWeek][]">
                  <span class="km_checkbox"></span> 
                </label>
                <!-- <input type="checkbox" name="<?php echo $weekday['name']; ?>"><?php echo $weekday['name']; ?> -->
                <?php
              }
            }
            echo '</div>';
          } else{ 
            
            ?>
            <span class="kmdaterequired km_required"></span>
            <div data-excluded-dates = <?php echo json_encode($discardDates);?> data-midweekbooking="<?php echo $midWeekBookingAllowed; ?>" data-weekdays="<?php echo json_encode($session->daysOfWeek) ;?>" data-date-from= <?php echo $session->dateTimestamp->from; ?> data-date-to= <?php echo $session->dateTimestamp->to; ?> class="km_multiweek_calander">Select Date <span class="km_dates_count"></span></div>

            <div class="km_calender km_hidden"><div class="km_multiweek_calander_div"></div><span class="km_cal_close km_transparent_bg km_secondary_color">Done</span>
            <input id="StartingDate" name="ATC[startingdate]" class="km_hidden" value=''>
            
          </div>
          <?php } ?>


        </div>

        <div class="km_multiweekSession km_camp_dates km_atc_participants_booking">
          <h3 class="km_primary_color"><?php _e('Camp Dates', 'fieldday'); ?></h3>
          <?php //if($session->bookingsPermitted=='allWeek') { ?>
          <div class="km_mw_dates">
            <span class="km_date_title">Session Start Date:</span>
            <span class="km_date_value"><b><?php echo $campstart_date?></b></span>
          </div>
          <div class="km_mw_dates km_joiningdate" style="display:none;">
            <span class="km_date_title">You’re starting on:</span>
            <span class="km_date_value"></span>
          </div>
          <div class="km_mw_dates">
            <span class="km_date_title">End Date:</span>
            <span class="km_date_value"><span class="km_sub">This registration will end on</span><b><?php echo $campend_date; ?></b></span>
          </div>
          <?php //} ?>
        </div>
        
        <div class="km_multiweekSession km_due km_hidden km_atc_participants_booking">
          <h3 class="km_primary_color"><?php _e('Price Details', 'fieldday'); ?></h3>
            <div class="km_mw_dates km_due_today">
              <span class="km_date_title">Due Today<span class="km_sub km_text_green"></span></span>
              <span class="km_date_value">$180</span>
            </div>
            <?php if($Iscredit) { ?>
            <div class="km_mw_dates">
              <span class="km_date_title">Available Credit</span>
              <span class="km_date_value"><?php echo $this->display_price($Iscredit[0]->remainingCredits); ?></span> 
            </div>
            <?php } ?>
            <div class="km_mw_dates km_total_due">
              <span class="km_date_title">Total Due Today</span>
              <span class="km_date_value"></span>
            </div>         
        </div>

        <div class="km_multiweekSession km_renewal km_hidden km_atc_participants_booking">
          <h3 class="km_primary_color"><?php _e('Auto Renewal', 'fieldday'); ?></h3>
          
          <div class="km_mw_dates km_weeks_remaining">
            <span class="km_date_title"></span>
            <span class="km_date_value"></span>
          </div>
          
          <div class="km_mw_dates km_next_payment">
            <span class="km_date_title">Next Payment</span>
            <span class="km_date_value"></span>
          </div>
        </div>

        <?php if($discardDates) { ?>
        <div class="km_multiweekSession km_excluded km_atc_participants_booking">
          <h3 class="km_primary_color"><?php _e('Excluded Dates', 'fieldday'); ?></h3>
          <ul class="km_excluded_dates">
            <?php foreach($discardDates as $discardDate) {
              echo '<li>'.$this->parseDate($discardDate,'M d, Y').'</li>';
            } ?>
          </ul>
        </div> 
        <?php } ?>
        </div>
        <div class="km_multiweek_credit km_hidden">         
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
                            <div class="km_col_12 km_field_wrap field_card_number">
                                <fieldset>
                                    <label for="card-number"><?php _e('Card Number', 'fieldday'); ?></label><span class="km_asterisk">*</span>
                                    <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="multiweek_fields"  required="" />
                                    <div id="card-type2" class="km_card_type"></div>
                                </fieldset>
                            </div>
                            
                            <div class="km_col_12 km_field_wrap field_card_holdername">
                                <fieldset>
                                    <label for="card-holder-name"><?php _e('Card Holder Name', 'fieldday'); ?></label><span class="km_asterisk">*</span>
                                    <input  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  type="text" id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="multiweek_fields" required="" />
                                </fieldset>
                            </div>
                            <div class="km_event_crds">
                            <div class="km_col_4 km_field_wrap field_card_exp">
                                <fieldset>
                                    <label><?php _e('Exp.Month', 'fieldday'); ?></label><span class="km_asterisk">*</span>
                                    <div class="km_custom_dropdown">
                                        <select id='expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="multiweek_fields" required="" >
                                            <option value='' selected>Select</option>
                                            <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                                                <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="km_col_4 km_field_wrap field_card_exp_year">
                                <fieldset>
                                    <label><?php _e('Exp.Year', 'fieldday'); ?></label><span class="km_asterisk">*</span>
                                    <div class="km_custom_dropdown">
                                        <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="multiweek_fields" data-parsley-required-message="Required"  required=""  >
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
                            <div class="km_col_4 km_field_wrap field_card_cvv">
                                <fieldset class="">
                                    <label for="cvv-code"><?php _e('CVV Code', 'fieldday'); ?></label><span class="km_asterisk">*</span>
                                    <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="multiweek_fields" data-parsley-required-message="Required"  required=""   />
                                </fieldset>
                            </div>
                        </div> 
                <div class="km_col_12 km_field_wrap km_terms">
                    <div class="km_term_condition">
                    <label class='km_checkbox_wrap'>
                        <span><?php print wp_sprintf("%s <a class='km_provider_terms_display' href=''>%s</a>", __("I've read and accept the", 'fieldday'), __("terms & conditions", 'fieldday')); ?><span class="km_asterisk">*</span></span>
                        <input required="required" name="km_terms_condition" data-parsley-required-message="Please accept terms & conditions" data-parsley-group="multiweek_fields" type="checkbox" class="km_provider_terms km_checkboxteam" required="required">
                        <span class="km_checkbox"></span>
                    </label>
                    </div>
                </div>
                        
                        </div>
        </div> <!--end of Payment fields -->
        </div>
       

    </div>
</div>
</form>
<div class="thank-you-section" style="display: none;">
    <?php print $content = fieldday()->engine->getView('checkout/thanks' ,['type' => 'multiweek']); ?>
</div>

<?php }elseif($session->bookingStatus=='closed'){
  echo '<div><h2>Registrations are Closed.</h2></div>';  
}else if(!$kmUser){ 
  $_POST['session_type'] = 'multiWeek';
  $_POST['sessionId'] = $session->_id;
  print $content = fieldday()->engine->getView('login_popup' ,['session_type'=>'multiWeek','sessionId' => $session->_id]);
} ?>