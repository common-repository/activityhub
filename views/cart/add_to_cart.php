<?php
if( (($session->bookingStatus=='open' || $session->bookingStatus=='waitlist') && $KmUser) || (!$kmUser && $session->bookingStatus=='open') ){
$session_extra = $this->GetSessionVar($session);
$skillLevelOption = $session->skillLevelOption;
if ($skillLevelOption == 'grade') {
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
} else { $icon = "child";}
$additionalCharges = $session->additionalCharges;
$extendedCareDetails = $session->extendedCareDetails;
if ($this->getvalue('isPriceForAllKids', $extendedCareDetails, false) != '' && $this->getvalue('isPriceForAllKids', $extendedCareDetails, false) != 'true') {$priceforAllkids = '';} else { $priceforAllkids = '/seat';}
$session_type = $this->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
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
$sessionAllowWaitlist = $session->allowWaitlist;
?>
<form action="" method="post" id="km_add_to_cart_form" data-age-from="<?php echo $agefrom; ?>" data-age-to="<?php echo $ageto; ?>" class="km_add_to_cart_form_aadd_to_cart">
  <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $session->_id; ?>">
  <input type="hidden" class="tag_id" name="ATC[tag_id]" id="km_atc_tag_id" value="<?php echo $tagId; ?>">
  <input type="hidden" class="agefrom" name="ATC[age_from]" id="km_atc_agefrom" value="<?php echo $agefrom; ?>">
  <input type="hidden" class="ageto" name="ATC[age_to]" id="km_atc_ageto" value="<?php echo $ageto; ?>">
<?php if (is_array($_REQUEST['sessionDate'])) {
    foreach ($_REQUEST['sessionDate'] as $sessiondate) {?>
    <input type="hidden" class="session_date" name="ATC[session_date][]" id="km_atc_session_date" value="<?php echo $sessiondate; ?>">
  <?php }

} else {?>
  <input type="hidden" class="session_date" name="ATC[session_date]" id="km_atc_session_date" value="<?php echo $sessionDate; ?>">
<?php }
if ($cartkey): ?>
  <input type="hidden" name="cartItemKey" id="km_atc_cartkey" value="<?php echo $cartkey; ?>">
<?php endif;?>
<div class="km_newparticipant_form"></div>
<div class="km_row km_package_wrapper">
  <div class="km_col_5">
    <div class="km_package_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
      <div class="km_package_session_img km_no_payment_info">
          <?php $this->displaySessionThumb($session);?>
      </div>
      <div class="km_row km_common_div">
        <div class="km_age km_no_payment_info km_col_6">
            <i class="fa fa-child km_primary_color" aria-hidden="true"></i>
            <span class="package_price"><?php
if ($skillLevelOption == 'grade') {
    print wp_sprintf("Grade(s): %s - %s", $gradefrom, $gradeto);
} else {
    print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
}
?>
            </span>
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
              <h5 class="km_pkg_kids"><?php _e('Selected Package', 'fieldday');?></h5>
              <div class="km_package_sel"></div>
          </div>
          <div class="km_selected_kids">
              <h5 class="km_pkg_kids"><?php _e('Selected Kids', 'fieldday');?></h5>
              <div class="km_kids"></div>
          </div>
      </div>
    </div>
  </div>
  <div class="km_col_7 km_package_participants">
    <div class="km_cart_sectionone">
      <div class="km_col_12 km_field_wrap km_atc_participants">
          <?php print $this->fielddayCartParticipants($cartItem, $session);?>
      </div>
      <div class="km_booking_selection km_atc_participants_booking">
      <?php
$bookingTypesAvailable = $this->_sessionBookingTypes();
$fullWeekPrice = $this->getValue('price', $session, false);
$oneDayPrice = $this->getValue('oneDayPrice', $session, false);
$km_type_of_booking_html = '<select  data-date-from=' . $session->dateTimestamp->from . ' data-date-to=' . $session->dateTimestamp->to . ' id="km_booking_radio_select"  data-parsely-type-message="Invalid Value"  data-parsley-type="alphanum" name="ATC[bookingoption_selection]" required="true"  data-parsley-group="atc_field" data-parsley-required-message="Select Booking Option"><option value="" hidden>Select Booking Type</option>';
$days = $this->eventDays($session);
$days_count = count(array_filter($days));
if (array($days)) {
    $days = implode(',', array_filter($days));
}
$fullWeekPrice = $this->getValue('price', $session, false);
$availableSpots = $this->getValue('availableSpots', $session, false);
$onedayPOtions = $this->getValue('oneDayKidRegistration', $session, false);
$bookingStatusParam = $session->bookingStatus;
$fulweekchecked = '';
if ($onedayPOtions == '') {
    $fulweekchecked = ""; //"checked";
}
if ($fullWeekPrice && $onedayPOtions) {?><h3 class="km_primary_color">What type of booking would you prefer? <span class="km_asterisk">*</span></h3> <div class="km_booking_options km_field_wrap km_booking_options_no_margin">
      <?php }?>
      <?php if (!$availableSpots && !$session->allowWaitlist) {
    $class = "disabled";
    $text = '<div class="km_fullsession_booked">The "full session" has sold out.</div>';
} elseif (!$KmUser && $session->allowWaitlist && !$availableSpots) {
    $class = "disabled";
    $text = '<div class="km_fullsession_booked">The "full session" has sold out.</div>';
} else {
    $class = "";
    $text = '';
}

$lable = $bookingTypesAvailable['weeklyKidRegistration']['lable'];
$duration = $bookingTypesAvailable['weeklyKidRegistration']['duration'];
$fullWeekPrice = $this->getValue('price', $session, false);
$km_type_of_booking_html .= '<option class="km_booking_radio" ' . $class . ' type="radio" data-price=' . $fullWeekPrice . '   data-fullcamp-avail=' . $availableSpots . ' value="fullcamp" >All Session Days (' . $days_count . ') - ' . $this->display_price($fullWeekPrice) . '</option>';

if ($this->getValue('oneDayKidRegistration', $session, false) || $this->getValue('morningKidRegistration', $session, false) || $this->getValue('eveningKidRegistration', $session, false)) {

    $ttttt = [];
    $lable = $bookingTypesAvailable['oneDayKidRegistration']['lable'];
    $duration = $bookingTypesAvailable['oneDayKidRegistration']['duration'];
    $Pricekey = $bookingTypesAvailable['oneDayKidRegistration']['apikey'];
    $PriceValue = $this->getValue($Pricekey, $oneDayPrice, false);?>
        <?php

    foreach ($bookingTypesAvailable as $key => $bookingType) {
        if ($bookingArray = $this->getValue($key, $session, false)) {
            $lable = $bookingType['lable'];
            $duration = $bookingType['duration'];
            $Pricekey = $bookingType['apikey'];
            $PriceValue = $this->getValue($Pricekey, $oneDayPrice, false);
            $key = $Pricekey . 'Dates';
            $dates = array();
            $datesMrng = array();
            $datesEvng = array();
            $waitlistDatesNew = array();
            $waitlistDatesNewMorning = array();
            $waitlistDatesNewEvening = array();
            $allDatesSessionsArrayDatesTime = array();
            $allDatesSessionsArrayDatesTimeUtc = array();
            $datestime = array();
            $avail = array();
            foreach ($singlesessionInfo->$key as $Datesarray) {
                $ttttt[] = $Datesarray;
                //print_r($Datesarray);
                $from = $this->parseDate($Datesarray->date->from, 'm-d-Y');
                $to = $this->parseDate($Datesarray->date->to, 'm-d-Y');
                $oneDaySelectedDate = $this->parseDate($Datesarray->oneDaySelectedDate, 'm-d-Y');
                $oneDaySelectedDateTime = $Datesarray->localDateTimestamp->from;
                $allDatesSessionsArrayDatesTime[$oneDaySelectedDate] = $oneDaySelectedDateTime;
                $allDatesSessionsArrayDatesTimeUtc[$oneDaySelectedDate] = $Datesarray->oneDaySelectedDate;
                if ($bookingStatusParam == 'open' || $bookingStatusParam == 'waitlist') {
                    //if($Datesarray->availableSpots>0 || $WaitlistSession){
                    if (!in_array($oneDaySelectedDate, $dates, true)) {
                        $avail[$oneDaySelectedDate] = $Datesarray->availableSpots;
                        $datestime[$oneDaySelectedDate] = $oneDaySelectedDateTime;
                        if ($Datesarray->availableSpots && $Datesarray->availableSpots > 0) {
                            array_push($dates, $oneDaySelectedDate);
                        } else {
                            if ($sessionAllowWaitlist) {
                                if ($key == 'halfDayEvngDates') {
                                    array_push($waitlistDatesNewEvening, $oneDaySelectedDate);
                                } elseif ($key == 'halfDayMrngDates') {
                                    array_push($waitlistDatesNewMorning, $oneDaySelectedDate);
                                } else {
                                    array_push($waitlistDatesNew, $oneDaySelectedDate);
                                }
                            }
                        }
                    }
                }
            }
            $daydatefrom = reset($dates); //$singlesessionInfo->$key[0]->date->from;
            $daydateto = end($dates); // $singlesessionInfo->$key[0]->date->to;

            if (($dates && !$KmUser) || ($KmUser)) {
                $km_type_of_booking_html .= '<option class="km_purchasefield km_booking_radio" data-booking-type="' . $key . '" data-oneday-times-all-dates=' . json_encode($allDatesSessionsArrayDatesTime) . '  data-oneday-times-all-dates-utc=' . json_encode($allDatesSessionsArrayDatesTimeUtc) . '  data-waitlist-days-morning=' . json_encode($waitlistDatesNewMorning) . '  data-waitlist-days-evening=' . json_encode($waitlistDatesNewEvening) . ' data-waitlist-days=' . json_encode($waitlistDatesNew) . ' data-oneday-dates = ' . json_encode($dates) . ' data-oneday-times= ' . json_encode($datestime) . ' data-price= ' . $PriceValue . '  data-oneday-avail = ' . json_encode($avail) . ' value= ' . $Pricekey . ' >Drop-in one or more day - ' . $this->display_price($PriceValue) . $duration . '</option>';
            }

        }
    }

}
$km_type_of_booking_html .= '</select>';
echo '<div class="km_wrapper_drpdown_TOB">' . $km_type_of_booking_html . '</div>';

if ($fullWeekPrice && $onedayPOtions) {?> </div> <?php }
echo $text;?>
        <div class="km_cart_calender_main km_hidden"><h3 class="km_primary_color">What day(s) would you like to register for? <span class="km_asterisk">*</span></h3></div><div class="km_cart_calender km_datepicker km_hidden" data-date-from= <?php echo $session->dateTimestamp->from; ?> data-date-to= <?php echo $session->dateTimestamp->to; ?> data-days= <?php echo $days; ?>>Select Date <span class="km_dates_count"></span></div><div class="km_calender km_hidden"><div class="km_calander_div"></div><span class="km_cal_close km_transparent_bg km_secondary_color">Done</span></div>
        <div class="km_onedayavail"></div>
        <!-- <input type="hidden" value="" class="km_allowed_seats" name="AllowedSeats"> -->
        <span class="km_hidden km_allowed_seats" id="" <?php echo $allowedvalue; ?>></span>
        <div class="km_field_wrap km_field_wrap_zero_padding"><textarea id="DatesLabel" data-parsley-group="atc_field" data-parsley-required-message="Select valid date" name="ATC[dropindates]" class="km_hidden"></textarea></div>
        <textarea id="DatesTimeLabel" name="ATC[dropindatestime]" class="km_hidden"></textarea>
        <textarea id="DatesTimeLabelAllDates" name="ATC[DatesTimeLabelAllDates]" class="km_hidden"></textarea>
        <textarea id="DatesTimeLabelAllDatesUtcFormat" name="ATC[DatesTimeLabelAllDatesUtcFormat]" class="km_hidden"></textarea>
        <input type="hidden" id="KmSessionBookingStatus" disabled value="<?php echo $bookingStatusParam; ?>"  />
        </div>
        <?php
$html = '<div class="km_input_extraoptions km_field_wrap km_atc_extended_care km_cart_options"></div>';
$html_additional = '<div class="km_extra_additional km_field_wrap km_atc_extended_care km_cart_options"></div>';
echo $html;
echo $html_additional;

$installment_hidden = "km_hidden";
if ($session->enablePaymentOptions):
?>
    <div class="km_field_wrap km_atc_paymentoptions km_installments <?php echo $installment_hidden; ?>">
      <h3 class="km_heading_required_wrap km_primary_color"><?php _e('How would you like to pay? <span class="km_asterisk">*</span>', 'fieldday');?></h3>
      <label class="km_radio_wrap">
        <div class="km_radio_text">
            <span><?php _e("Pay In Full");?></span>
            <span class="km_cartsession_price km_primary_color"><?php echo $this->display_price($session->price);
_e("/seat"); ?></span>
        </div>
        <input data-parsley-group="atc_field" <?php echo ($KmUser) ? 'data-parsley-required-message="please select payment option"  required=""' : ""; ?> <?php echo (!$KmUser) ? "checked" : ""; ?> class="km_purchasefield" data-text="" value="full_amount" type="radio" name="ATC[selected_payment_option]">
        <span class="km_radio"></span>
      </label>
      <div class="<?php echo !$KmUser ? "km_disabled" : ""; ?>">
      <?php if (!$KmUser): ?>
        <div class="km_disabled_message_wrap">
            <span class="km_disabled_message">
                <?php _e("Login or create an account to enable the Installment Payment plan.", "fieldday");?>
            </span>
        </div>
      <?php endif;?>
      <label class="km_radio_wrap">
        <div class="km_radio_text">
            <span><?php _e("Installment Plan", 'fielday');?></span>
            <p><?php echo "Deposit + " . count($session->paymentOptions[0]->payments) . " installments"; ?></p>
        </div>
        <input data-parsley-group="atc_field" class="km_purchasefield" data-text="" <?php echo ($KmUser) ? 'data-parsley-required-message="please select payment option"  required=""' : ""; ?>  value="<?php echo $session->paymentOptions[0]->_id; ?>" type="radio" name="ATC[selected_payment_option]">
        <span class="km_radio"></span>
      </label>
      <div class="km_payment_packages">
        <ul>
            <li>
              <span><?php _e("Deposit", 'fieldday');?></span>
              <span><?php _e("Today", 'fielday');?></span>
              <span><?php echo $this->display_price($session->paymentOptions[0]->deposit); ?></span>
            </li>
            <?php foreach ($session->paymentOptions[0]->payments as $key => $paymentOption): ?>
              <li>
                <span><?php _e("Installment", 'fieldday');?></span>
                <span><?php echo $this->parseDate($paymentOption->dateTime); ?></span>
                <span><?php echo $this->display_price($paymentOption->deposit); ?></span>
              </li>
            <?php endforeach;?>
        </ul>
      </div>
    </div>
    </div>
<?php endif;?>
</div> <!-- Extra Div added to wrap -->
<?php
if (!$KmUser && !$_SESSION['Gpersonal_detail']) {?>
  <div class="km_guest_personalinfo km_hidden">
    <h3 class="km_heading_wrap km_primary_color"><?php _e('Contact Information', 'fieldday');?> </h3>
    <div class="km_col_12 km_field_wrap">
      <fieldset class="">
        <label><?php _e('Full Name', 'fieldday')?></label><span class="km_asterisk">*</span>
        <input type="text"    oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"    pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  value="<?php $this->getValue('name', $KmUser);?>" name="personal_fullname" value="" class="km_input" data-parsley-group="atc_infofield" data-parsley-required-message="Required" required=""/>
      </fieldset>
    </div>
    <div class="km_col_12 km_field_wrap">
      <fieldset class="">
        <label><?php _e('Email', 'fieldday');?></label><span class="km_asterisk">*</span>
        <input type="email"    oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"    value="<?php $this->getValue('email', $KmUser);?>" name="personal_guestEmail" value="" id="parentEmail" data-parsley-group="atc_infofield" class="km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Email" required=""/>
      </fieldset>
    </div>
    <div class="km_col_12 km_field_wrap">
      <fieldset class="km_phone_set km_cart_phone">
        <label><?php _e('Phone Number', 'fieldday');?></label><span class="km_asterisk">*</span>
        <input type="hidden" name="user-country-code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
        <input type="hidden" name="users-countrycode" class="users_countrycode" value="<?php echo $kmGetCountryCode = fieldday()->engine->kmGetCountryCode(); ?>">
        <input type="text" value="" name="personal_phone" id="parentPhone" data-parsley-group="atc_infofield" class="km_phone_field km_input" data-parsley-required-message="Required" data-parsley-type-message="Invalid Phone" required=""  data-parsley-minlength-message="Phone should contain 10 characters"/>
      </fieldset>
    </div>
  </div>
<?php }?>
</div>
</div>


</form>

<div class="thank-you-section" style="display: none;">
  <?php print $content = fieldday()->engine->getView('checkout/thankswaitlist');?>
</div>

<?php  }elseif(!$kmUser && $session->bookingStatus=='waitlist'){
  $_POST['session_type'] = 'waitlist';
  $_POST['sessionId'] = $session->_id;
  print $content = fieldday()->engine->getView('login_popup' ,['session_type'=>'waitlist','sessionId' => $session->_id]);
}elseif($session->bookingStatus=='closed'){
  echo '<div><h2>Registrations are Closed.</h2></div>'; 
} ?>