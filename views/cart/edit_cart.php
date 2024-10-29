<?php 
$session_extra = $this->GetSessionVar($session);
//echo "<pre>"; print_r($cartItem); echo "</pre>";
$skillLevelOption = $session->skillLevelOption;
if($skillLevelOption=='grade'){
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
}else{ $icon = "child"; }
$datespicked = $bookingoption.'Dates'; 
$additionalCharges = $session->additionalCharges;
$extendedCareDetails = $session->extendedCareDetails;
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
$addedForOneDayOnly = $cartItem->addedForOneDayOnly;
$PaymentOptions = $cartItem->enabledPaymentOptions;
$selectedate = '';
if($addedForOneDayOnly){
    $bookingtypesel = "";
    $selectedate = fieldday()->engine->parseDate($cartItem->oneDaySelectedDate,'d-M-Y');
    $campday = 'Drop-in one or more day ('.$selectedate.')';
    $datespicked = 'fullDayDates';
    $Onedaydates = $session->$datespicked;
    foreach($Onedaydates as $Onedaydate){ 
      $oneDaySelectedDate = $Onedaydate->oneDaySelectedDate; 
      $date_booked = date('d-M-Y', strtotime($oneDaySelectedDate));
      if ($date_booked == $selectedate){
        $extendedCareDetails = $Onedaydate->extendedCareDetails;
        $additionalCharges = $Onedaydate->additionalCharges;
        $availableSpots = $Onedaydate->availableSpots;
      }
    }
}else{
    $bookingtypesel = "";
    $campday = 'All Session Days';
    $fullWeekPrice = $this->getValue('price', $session, false);
    $availableSpots = $this->getValue('availableSpots', $session, false); 
}

/*if($cartItem) { 
    $dropindatess = array();
    $bookingoption_selection = $cartItem->oneDayType;
    $dropindatess =  fieldday()->engine->parseDate($cartItem->oneDaySelectedDate,'m-d-y');
    $dropindates = json_encode(array($dropindatess));
}*/
?>
<form action="" method="post" id="km_add_to_cart_form" data-age-from="<?php echo $agefrom; ?>" data-age-to="<?php echo $ageto; ?>" class="km_edit_form km_add_to_cart_form_edit_cart">
  <input type="hidden" class="session_id" name="ATC[session_id]" id="km_atc_session_id" value="<?php echo $session->_id; ?>">
  <input type="hidden" class="tag_id" name="ATC[tag_id]" id="km_atc_tag_id" value="<?php echo $tagId; ?>">
  <input type="hidden" class="agefrom" name="ATC[age_from]" id="km_atc_agefrom" value="<?php echo $agefrom; ?>">
  <input type="hidden" class="ageto" name="ATC[age_to]" id="km_atc_ageto" value="<?php echo $ageto; ?>">
  <input type="hidden" name="cartItemKey" id="km_atc_cartkey" value="<?php echo $cartkey; ?>">
  <?php 
  $providerKey = array_key_exists('fieldday_api_provider', $fielddaySetting) ? $fielddaySetting['fieldday_api_provider'] : null; $allowedvalue = '';
  if($providerKey=='6194009c70a3e70db6b7f0fc'){
    if($session->_id=='63bae369cb06550afcc9ab7c' || $session->_id=='63abd00afb72062a1a48d40a'){
      $allowedvalue= 'data-static-seats="4"';
    }
  }
  ?>
  <span class="km_hidden km_allowed_seats" id="<?php echo $availableSpots; ?>" <?php echo $allowedvalue; ?>></span>
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
    <div class="km_cart_sectionone">
      <div class="km_col_12 km_field_wrap km_atc_participants">
      <?php 
      print $this->fielddayCartParticipantsNew($cartItem, $session); ?>
      </div>

      <div class="km_booking_selection km_atc_participants_booking">
        <h3 class="km_primary_color">Booking Selection</h3> 
        <div class="km_booking_options km_field_wrap required_field">
          <div class="km_Full_session km_booking_option km_field_wrap required_field km_width_100_percent">
            <!--<span class="km_booking_title"><?php //echo $bookingtypesel; ?></span> -->       
            <label class="km_radio_wrap km_radio_wrap_care">
              <span class="km_radio_text"><?php echo $campday; ?>
                <span class="km_cartsession_price km_primary_color"><?php echo $fullWeekPrice; ?></span> 
              </span>
              <!-- <input class="km_booking_radio" type="radio" data-price="250" checked="" value="fullcamp" name="ATC[bookingoption_selection]" onclick="" required="" data-parsley-group="atc_field" data-parsley-required-message="Select Booking Option">
              <span class="km_radio"></span> -->
            </label>
          </div>
        </div> 
        
      </div>
      <?php
      if($PaymentOptions){ ?>
        <div class="km_field_wrap km_atc_paymentoptions km_installments_edit">
        <h3 class="km_heading_required_wrap km_primary_color"><?php _e('Payment Selection', 'fieldday'); ?></h3>
        
        <div class="km_payment_packages">
          <div class="km_radio_text">
            <span><?php _e("Installment Plan", 'fielday'); ?></span>
            <p><?php echo "Deposit + ".count($cartItem->sessionId->paymentOptions[0]->payments)." installments"; ?></p>
        </div>
          <ul>
              <li>
                  <span><?php _e("Deposit", 'fieldday'); ?></span>
                  <span><?php _e("Today", 'fielday'); ?></span>
                  <span><?php echo $this->display_price($cartItem->sessionId->paymentOptions[0]->deposit); ?></span>
              </li>
              <?php foreach($cartItem->sessionId->paymentOptions[0]->payments as $key => $paymentOption): ?>
                  <li>
                      <span><?php _e("Installment", 'fieldday'); ?></span>
                      <span><?php echo $this->parseDate($paymentOption->dateTime); ?></span>
                      <span><?php echo $this->display_price($paymentOption->deposit); ?></span>
                  </li>
              <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php
      }
      ?>
      <div class=""></div>
      <!-- Extended and Additionals for Edit Screen -->
      <?php
        $selectedExtendedCare[] = $cartItem->extendedCareSelected;
        //print_r($selectedExtendedCare);
        $SelectedAdditionalArray = $cartItem->additionalChargeDetails;
        //print_r($SelectedAdditionalArray);
        $SelectedAdditionalcharges = [];
        foreach($SelectedAdditionalArray as $SelectedAdditionalArrayV)
        { 
            $SelectedAdditionalcharges[] = $SelectedAdditionalArrayV->_id;
        }        
      ?>
      <?php
      if (!empty($extendedCareDetails)) : ?>
      <div class="km_input_extraoptions km_field_wrap km_atc_extended_care km_cart_options">
        <h3 class="km_primary_color"><?php _e("Elevate Your Experience with these Add-Ons", "fieldday"); ?></h3>
        <div class="km_additionalcharges_wrap">
          <?php 
          foreach ($extendedCareDetails as $chargetype => $charges):
                if ($chargetype == 'earlyCare' || $chargetype == 'afterCare' || $chargetype == 'combined'):
                  $optionname = $chargetype;
                  $option_checked = '';
                  if(in_array($optionname, $selectedExtendedCare)){
                     $option_checked = 'checked'; 
                  }
                    $html ='<label class="km_checkbox_wrap km_checkbox_wrap_care">
                        <span class="km_radio_text">'.fieldday()->engine->extendedCareTypes($chargetype).'
                        <span class="km_cartsession_price km_FullSessionextendedPrice km_primary_color">'.fieldday()->engine->display_price($charges->price).$priceforAllkids.'</span><span class="km_hidden km_cartsession_price km_primary_color km_perDayextendedPrice">'.fieldday()->engine->display_price($charges->pricePerDay).'/day</span>
                        </span>
                        <span class="days km_service_days km_text_green">'.fieldday()->engine->sessionServiceDays($session_type).'</span>
                        
                        <input '.$option_checked.' class="km_purchasefield" data-text="'.fieldday()->engine->extendedCareTypes($chargetype).'" type="checkbox" data-price="'.$charges->price.'" value="'.$chargetype.'" name="ATC[extendedCareSelected][]"><span class="km_checkbox"></span>
                    </label>';
                  echo $html;
                endif;
          endforeach;
          ?>       
        </div>

      </div>
      <?php
      endif;
      if (!empty($additionalCharges)) : ?>
      <div class="km_extra_additional km_field_wrap km_atc_extended_care km_cart_options">
        <?php
        $html_additional = '<h3 class="km_primary_color">'.__("More Options", "fieldday").'</h3>
          <div class="additionalcharges_wrap">';
            foreach ($additionalCharges as $key => $product): 
              if( !isset($product->isAvailablefor) || isset($product->isAvailableFor->$session_type) && $product->isAvailableFor->$session_type) :
                $optionname = $product->_id;
                $option_checked = ''; $mandatory_message = '';
                if(in_array($optionname, $SelectedAdditionalcharges)){
                   $option_checked = 'checked';  
                }
                if($product->isMandatory==1){
                  $option_checked = 'checked disabled';
                  $mandatory_message = '<span class="km_mandatory">This option is mandatory to check </span>';
                }

                $html_additional .= '<label class="km_checkbox_wrap km_checkbox_wrap_care">
                    <span class="km_radio_text">'.$product->title.'<span class="km_cartsession_price km_primary_color">'.fieldday()->engine->display_price($product->price).'</span>
                    </span>'.$mandatory_message.'
                    <input '.$option_checked.' data-parsley-required-message="Required" data-parsley-group="atc_field" class="km_purchasefield" data-text="'.$product->title.'" data-price="'.$product->price.'" value="'.$product->_id.'" type="checkbox" name="ATC[additionalChargeDetails][]">
                    <span class="km_checkbox"></span>
                </label>';
              endif;
            endforeach;
        $html_additional .= '</div>';
        echo $html_additional;
        ?>
      </div> 
    <?php endif; ?>
    </div> 
  </div>
</div>
</form>