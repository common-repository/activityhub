<?php
$session_extra = $this->GetSessionVar($session);
$groupSessionListing = $session->groupSessionListing;
$skillLevelOption = $session->skillLevelOption;
if ($skillLevelOption == 'grade') {
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
} else { $icon = "child";}
$sessionDateFromFilter = date('n', strtotime($session->dateTimestamp->from));
$sessionDateToFilter = date('n', strtotime($session->dateTimestamp->to));
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
$sessionPrice = $session->price;
$sessionPriceRange = $session->activityId->priceRange;
$sessionPriceRangeto = isset($sessionPriceRange->to) ? $sessionPriceRange->to : null;
$location = $session->siteLocationId->name;
$location_state = $session->siteLocationId->state;
$location_country = $session->siteLocationId->country;
$location_link = $session->siteLocationId->googleMapUrl;
if (!$location_link) {
    $location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
}
$eventPrices = $session->eventPrice;
$eventClass = '';
if ($eventPrices) {
    $allvalues = json_decode(json_encode($eventPrices), true);
    if (!array_filter($allvalues)) {
        $eventPrice = "Event available for free";
        $eventClass = 'km_avail_free';
    } else {
        $eventPrice = '<i class="fa fa-money km_primary_color" aria-hidden="true"></i> $0 - ' . $this->display_price(max($allvalues)) . '/ticket';
    }
}
if (!$sessiontype) {
    $sessiontype = $session->sessionType;
}
?>
<div class="km_row km_package_wrapper km_cls_actvty_session_original ">
    <div class="km_col_5">

        <div class="km_package_detail" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
                <div class="km_rokuimg" style="width: 100%;">
                    <?php $this->displaySessionThumb($session, true);?>
                </div>
                 <div class="km_row km_common_div km_cls_actvty_session_original_age_grade">
                    <div class="km_age km_no_payment_info km_col_6">
                        <i class="fa fa-<?php echo $icon; ?> km_primary_color" aria-hidden="true"></i>
                        <span class="package_price">
                        <?php
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
                    <div class="km_session_days_wrap">
                        <?php $this->sessionDays($session);?>
                    </div>
                </div>

                <div class="km_rating_p km_common_div">
                    <b class="km_sess_head km_primary_color"><?php _e("Rating");?></b>
                    <?php $this->sessionRating($session);?>
                </div>
                <?php if ($sessiontype == "event") {
    print '<div class="km_detail_bookings km_common_div">';
    print '<div class="km_hidden">' . $this->sessionBookingTypes($session, $tags, false) . '</div>';
    if (!$eventClass) {?><b class="km_sess_head km_primary_color"><?php _e('Ticket Price', "fieldday");?></b> <?php }
    print '<span class="km_session_prices ' . $eventClass . '">' . $eventPrice . '</span></div>';
} else {?>
                <div class="km_detail_bookings km_common_div">
                    <b class="km_sess_head km_primary_color"><?php _e('Bookings Available', "fieldday");?></b>
                    <?php print '<div class="km_hidden">' . $this->sessionBookingTypes($session, $tags, false) . '</div>';?>
                    <?php
//echo "<pre>"; print_r($session); echo "</pre>";
    print $this->sessionBookingavail($session, false);?>
                    <small><?php //_e("*Click Above To Purchase", "fieldday"); ?></small>
                </div>
            <?php }?>

        </div>
        <?php if ($session->sessionType == 'multiWeek') {?>

                        <?php
//echo "<pre>"; print_r($session); echo "</pre>";
    if ($session->bookingStatus == 'open'):
    ?>
                        <div class="km_cart_button_p km_detail_bookbtn">
                        <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate), 'fieldday');?> href="javascript:void(0);" data-type="multiWeek" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                        <?php _e('Book Now', 'fieldday');?></a>
                        </div>
                        <?php endif;
    ?>

        <?php }?>
        <?php if ($session->sessionType != 'multiWeek') {?>
        <div class="km_cart_button_p km_detail_bookbtn">
            <?php
if ($session->bookingStatus == 'open'):
        if ($session->offersClassPackages) {?>
																		                    <a <?php _e($this->packageRegister($session->_id), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_feature_purchase_btn km_primary_bg km_session_btn">
																		                    <?php _e('Book Now', 'fieldday');?>
																		                    </a>
																		                <?php }
    endif;
    if ($session->sessionType != 'event') {
        if ($groupSessionListing) { //Check if Grouping Enable
            //if($session->anySeatAvailable || $session->availableSpots){
            if ($session->bookingStatus == 'open') {
                ?>
                            <a data-type="groupSessionListing" <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                            <?php $this->displayText('add_to_cart_btn');?>
                            </a><?php
} else {
                if ($session->bookingStatus == 'waitlist') {
                    ?><a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn"><?php _e('Wait List', 'fieldday');?></a><?php
} else {
                    ?> <a class="disabled km_btn km_session_btn km_primary_bg"><?php _e('Book Now', 'fieldday');?></a> <?php
}
            }
        } else { // no Grouping Enable
            if ($session->bookingStatus == 'open') {
                ?>
                            <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                            <?php $this->displayText('add_to_cart_btn');?>
                            </a><?php
} else {
                if ($session->bookingStatus == 'waitlist') {
                    ?> <a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn"><?php _e('Wait List', 'fieldday');?></a><?php
} else {
                    ?> <a class="disabled km_btn km_session_btn km_primary_bg"><?php _e('Book Now', 'fieldday');?></a> <?php
}
            }
        }
    }
    if ($session->sessionType == 'event') {
        if ($session->bookingStatus == 'open') {?>
                                <a <?php _e($this->eventRegister($session->_id, 'event'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_event_purchase_btn km_primary_bg km_session_btn">
                                <?php _e('Book Now', 'fieldday');?>
                                </a>
                           <?php } else {?>
                            <a class="disabled km_btn km_session_btn km_primary_bg"><?php _e('Sold Out', 'fieldday');?></a>
                           <?php }?>

                    <?php
}?>
    </div>
    <?php }?>
    </div>
    <div class="km_col_7 km_package_participants">
         <?php
if ($this->getValue('description', $session, false)) {
    $title = __("About This Session", 'fieldday');
    $description = $this->getValue('description', $session, false);
} else {
    $title = __("Activity Overview", 'fieldday');
    $description = $session->activityId->overview;
}
?>
        <?php if ($description != '' && $description != 'Na') {?>
            <div class="km_session_about km_field_wrap km_atc_paymentoptions">
                <h3 class="km_heading_wrap km_primary_color"><?php print $title;?></h3>
                <div class="km_activity_overview">
                    <span class="km_package_description"><?php echo $description; ?></span>
                   <!--  <i  data-tooltip-title="Get the Share Link for this activity" class="fa fa-share-alt km_booking_type km_col_3 km_tooltip" aria-hidden="true" id="sharesession" onclick="shareSession()"></i> -->
                    <a href="javascript:void(0);" class="km_package_back_btn km_transparent_bg km_package_btns km_btn km_primary_color km_share_button" id="sharesession"><i class="fa fa-share-alt"></i> Share</a>
                </div>
            </div>
        <?php }?>
        <!-- bringing needs -->
        <?php
$bringingNeedsS = fieldday()->engine->getvalue('bringingNeeds', $session->activityId, false);
if (!empty($session->activityId->bringingNeedsArr) && $bringingNeedsS != 'Na'): ?>
        <div class="km_bringing_needs km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Bringing Needs", "fieldday");?></h3>
            <div class="km_activity_overview km_bullets_arrow">
                <?php if (isset($session->activityId->bringingNeedsArr)): ?>
                    <?php foreach ($session->activityId->bringingNeedsArr as $key => $bringingNeeds): ?>
                        <span class="km_bringing_need_item km_package_description" id="<?php echo $bringingNeeds->_id; ?>"><?php echo $bringingNeeds->title; ?></span>
                    <?php endforeach;?>
                <?php else: ?>
                        <p><?php echo $session->activityId->bringingNeeds; ?></p>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
        <!-- bringing needs -->

        <!-- Prerequisite -->
        <?php
$prerequisitesS = fieldday()->engine->getvalue('prerequisites', $session->activityId, false);
//$prerequisitesArr = fieldday()->engine->getvalue('prerequisitesArr', $session->activityId, false);
//print_r($prerequisitesArr); echo "sdasdasdasd";
if (!empty($prerequisitesS) && $prerequisitesS != 'Na' && $prerequisitesS != 'NA'): ?>
        <div class="km_bringing_needs km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Prerequisites ", "fieldday");?></h3>
            <div class="km_activity_overview km_bullets_arrow">
                <?php if (isset($session->activityId->prerequisitesArr)): ?>
                    <?php foreach ($session->activityId->prerequisitesArr as $key => $prerequisite): ?>
                        <span class="km_bringing_need_item km_package_description" id="<?php echo $prerequisite->_id; ?>"><?php echo $prerequisite->title; ?></span>
                    <?php endforeach;?>
                <?php else: ?>
                        <p><?php echo $session->activityId->prerequisites; ?></p>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
        <!-- Prerequisite -->
        <?php $additionalCharges = fieldday()->engine->getvalue('additionalCharges', $session, false);
if ($additionalCharges) {
    print "<div class='km_activity_additionalcharges km_field_wrap km_atc_paymentoptions recommendedclassPackages'>";?>
                <h3 class="km_heading_wrap km_primary_color"><?php _e("Additional Charges ", "fieldday");?></h3>
                    <?php foreach ($additionalCharges as $key => $additionalCharge) {
        $additional_price = $this->display_price($additionalCharge->price);
        print wp_sprintf('<span class="km_activity_text km_additionalcharge_item" id="%1$s">%2$s<span class="km_primary_color"> %3$s </span></span>', $additionalCharge->title, $additionalCharge->title, $additional_price);
    }
    print "</div>";
}?>
        <!-- Important Dates -->
        <?php $important_dates = $this->getImportantDates($session);
if ($important_dates):
?>
        <div class="km_bringing_needs km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Important Dates", "fieldday");?></h3>
            <?php
foreach ($important_dates as $key => $important_date) {?>
                        <div class="km_important_dates_sec">
                            <div class="km_important_note"><?php echo $this->getValue('note', $important_date, false); ?></div>
                            <div class="km_important_dates_info"><i class="fa fa-calendar"></i> <?php echo $this->getValue('date', $important_date, false); ?><span> | </span><i class="fa fa-clock"></i> <?php echo $this->getValue('startTime', $important_date, false); ?> - <?php echo $this->getValue('endTime', $important_date, false); ?><br>
                            <i class="fa fa-map-marker"></i> <?php print $this->getSiteLocation($session);?></div>
                        </div>
                   <?php }?>
        </div>
        <?php endif;?>
        <!-- Important Dates -->

        <!-- Typical Day at Camp -->
        <?php
$dailyRoutineS = fieldday()->engine->getvalue('dailyRoutineArr', $session, false);
$dailyRoutinetitle = json_decode(json_encode($dailyRoutineS), true);
$titlevalue = $dailyRoutinetitle[0]['title'];
if (empty($dailyRoutineS) || $titlevalue == 'Na' || $titlevalue == 'N/A' || $titlevalue == 'NA') {
    $dailyRoutineS = $session->activityId->dailyRoutineArr;
}
$dailyRoutinetitle = json_decode(json_encode($dailyRoutineS), true);
$Atitlevalue = $dailyRoutinetitle[0]['title'];
if ($dailyRoutineS && $Atitlevalue != 'Na' && $Atitlevalue != 'N/A' && $Atitlevalue != 'NA'): ?>
        <div class="km_typical_days km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Typical Day At Camp", "fieldday");?></h3>
                <div class="km_typical_day km_bullets_arrow">
                <?php if (isset($dailyRoutineS)): ?>
                   <?php foreach ($dailyRoutineS as $key => $dailyRoutine): ?>
                        <div class="km_typical_day_wrap">
                            <span class="km_daily_route_item km_package_description" id="<?php echo $dailyRoutine->_id; ?>">
                                <?php echo $dailyRoutine->title; ?>
                                <small>(<?php echo $dailyRoutine->start; ?> - <?php echo $dailyRoutine->end; ?>)</small>
                            </span>
                        </div>
                    <?php endforeach;?>
                    <?php //else: ?>
                        <!-- <span class="km_package_description"><?php //echo $session->activityId->dailyRoutine; ?></span> -->
                    <?php endif;?>
                </div>
        </div>
        <?php endif;?>
        <!-- Typical Day at Camp -->
        <!--  Extended care options -->
        <?php $extendedCareOptions = $this->ExtendedCareOptions($session);?>
        <?php if ($extendedCareOptions): ?>
            <div class="km_extendedcare_options km_bullets_arrow km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                    <h3 class="km_heading_wrap km_primary_color"><?php _e("Extended Care Options", "fieldday");?></h3>
                    <div class="km_typical_day">
                        <?php print $extendedCareOptions?>
                    </div>
            </div>
        <?php endif;?>
        <!--  Extended care options -->

        <!--  other  options -->
        <?php $sessionOtherOptions = $this->sessionOtherOptions($session);?>
        <?php if ($sessionOtherOptions): ?>
        <div class="km_extendedcare_options km_field_wrap km_atc_paymentoptions recommendedclassPackages km_bullets_arrow">
                <h3 class="km_heading_wrap km_primary_color"><?php _e("Other Options", "fieldday");?></h3>
                <div class="km_typical_day">
                    <?php print $sessionOtherOptions;?>
                </div>
        </div>
        <?php endif;?>
        <!--  other options -->

        <!-- Pick-up/Drop Off Location -->
        <div class="km_pickup_location km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <?php if ($sessiontype == "event") {
    echo '<h3 class="km_heading_wrap km_primary_color">' . __("Location", "fieldday") . '</h3>';
} else {?>
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Pick-up & Drop Off Location", "fieldday");?></h3>
            <?php }?>
                <div class="km_activity_overview">
                    <?php
$open = "window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false";
print wp_sprintf('<span><i class="fa fa-map-marker km_primary_color"></i><a href="%s" onclick="%s;">%s<span class="km_small">(Click here to get directions)</span></a></span>', $location_link, $open, $location);
$address2 = urlencode($address);
//$iframeUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3237.0247377133505!2d-78.87916838514383!3d35.77476868017267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89aced1c0a4d397f:0x97cbd70ff7feb310!2s'.$address2.'!5e0!3m2!1sen!2sin!4v1586342152817!5m2!1sen!2sin';
?>
                </div>
                <div class="km_map">
                    <!--<iframe src="<?php //echo $iframeUrl; ?>" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
                </div>
        </div>
        <!-- Pick-up/Drop Off Location -->
        <?php $cancellationPolicy = fieldday()->engine->getvalue('cancellationPolicy', $session, false);
if ($cancellationPolicy) {
    ?>
            <div class="km_detail_policy km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                <h3 class="km_heading_wrap km_primary_color"><?php _e("Cancellation Policy", "fieldday");?></h3>
                <?php $cancellationPolicynote = fieldday()->engine->getvalue('note', $session->cancellationPolicy, false);
    $cancellationPolicydescription = fieldday()->engine->getvalue('description', $session->cancellationPolicy, false);
    if ($cancellationPolicydescription) {
        print wp_sprintf('<div class="km_activity_text"><span class="km_policy_description">%s</span></div>', $cancellationPolicydescription);
    }
    if ($cancellationPolicynote) {
        print wp_sprintf('<div class="km_activity_text"><span class="km_policy_note">%s</span></div>', $cancellationPolicynote);
    }
    $cancellationPolicyterms = fieldday()->engine->getvalue('terms', $session->cancellationPolicy, false);
    if ($cancellationPolicyterms) {
        print "<ul class='km_policy_terms'>";
        foreach ($cancellationPolicyterms as $key => $cancellationPolicyItem) {
            print wp_sprintf('<li class="km_activity_text km_additionalcharge_item" id="%1$s"><i class="fa fa-check km_angle_right"></i> %2$s</li>', $cancellationPolicyItem, $cancellationPolicyItem);
        }
        print "</ul>";
    }?>
            </div>
        <?php
}?>

        <!-- session review -->
        <?php $reviews = $this->getValue('reviews', $session, false);
if ($reviews) {
    ?>
        <div class="km_session_reviews km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_heading_wrap km_primary_color"><?php _e("Reviews", 'fieldday');?></h3>
            <div id="km_session_reviews" class="km_row">
                <?php echo $this->displaysessionReviews($session); ?>
            </div>
        </div>
        <?php
}?>
        <!-- session review -->
    </div>

</div>

<style type="text/css">
.km_modal_content {padding: 20px 0;}
</style>