<?php
$available_spots_total = $session->availableSpots ? $session->availableSpots : 0;
$show_available_spots = false;
if ($session->unlimitedSeats) {$show_available_spots = false;} else {
    if (isset($available_spots_total) && $available_spots_total < 50) {
        $show_available_spots = true;
    } else {
        $show_available_spots = false;
    }
}

$priceNotes = $session->priceNotes;
$session_extra = $this->GetSessionVar($session);
$skillLevelOption = $session->skillLevelOption;
if ($skillLevelOption == 'grade') {
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
} else { $icon = "child";}
$sessionPrice = $session->price;
$sessionPriceRange = $session->activityId->priceRange;
$sessionPriceRangeFrom = $sessionPriceRange->from;
$sessionPriceRangeto = isset($sessionPriceRange->to) ? $sessionPriceRange->to : null;
$sessionDateFromFilter = date('n', strtotime($session->dateTimestamp->from));
$sessionDateToFilter = date('n', strtotime($session->dateTimestamp->to));
$oneDaySelectedDate = $this->getValue('oneDaySelectedDate', $session, false);
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
//$location_name = $session->siteLocationId->name;
$location_state = $session->siteLocationId->state;
$location_country = $session->siteLocationId->country;
$location_link = $session->siteLocationId->googleMapUrl;
if (!$location_link) {
    $location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
}
//$description= $session->description;
//$description= substr_replace($description, "...", 250);
$themeimgFile = plugin_dir_url(__FILE__) . "/assets/images/icon.svg";
$currentdate = date("Y-m-d");
$datefrom = $this->parseDate($session->dateTimestamp->from, 'Y-m-d');
$dateto = $this->parseDate($session->dateTimestamp->to, 'Y-m-d');
//echo $this->datediffInWeeks($currentdate, $dateto);
//echo $weeks = $this->weeks_between($datefrom, $dateto);
$day = $this->parseDate($session->dateTimestamp->from, 'd');
$month = $this->parseDate($session->dateTimestamp->from, 'm');
$year = $this->parseDate($session->dateTimestamp->from, 'Y');
$dayofWeek[] = $this->dayofweek($day, $month, $year);

if ($session->sessionType == "multiWeek") { //print_r($session);
    ?>

<li id="km_session_two_coloum_layout" class="km_multiweek km_session_single_item activethemeview km_records" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $agefrom; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">

    <!-- New Design -->
    <!-- Img -->
    <div class="km_col_2">
        <div class="km_align">
            <div class="km_thumbnail_new" onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');">
                <?php $this->displaySessionThumb($session);?>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="km_col_10">
        <div class="km_Heading_content">
            <!-- Heading -->
            <div class="km_full_age">
                <input type='hidden' id='km_session_tags' value='{}'>
                <h3 class="km_session_name_heading km_with_tooltip km_primary_color" onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');" ><?php echo $session->name; ?>
                    <!--div class="km_with_tooltip">
                   <img src="<?php //echo $themeimgFile; ?>" class="km_icon_infor">

                <span class="tooltiptext">More Info About This Activity</span>
                </div-->
                </h3>
                <div class="km_descri" style="display: none"><?php echo $session->description; ?></div>

                <div class="km_session_full_ages">
                    <i class="fa fa-<?php echo $icon; ?> km_primary_color" aria-hidden="true"></i>
                    <span class="session_age_group">
                    <?php
if ($skillLevelOption == 'grade') {
        print wp_sprintf("Grade(s): %s - %s", $gradefrom, $gradeto);
    } else {
        print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
    }
    ?>
                    </span>
                </div>
                <div class="km_location_session_section">
                    <i class="fa fa-map-marker km_primary_color"></i>
                    <span class="km_location_session_details"><a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a><?php //echo $location; ?></span>
                </div>
               <div class="km_avaiableseats_session_section">
                    <a href="javascript:void(0);"  onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');" class="km_session_btn km_moreinfor km_primary_color km_transparent_bg">More Info</a>
                </div>

            </div>
            <div class="km_Heading_content_inner">
                <div class="km_full_age_days">
                    <div class="km_session_days">
                        <span class="activity_title" style="display: none;"><?php echo apply_filters("km_sessionlist_activity_title", $session_extra['activityTitle'], $session, $session_extra); ?></span>
                        <span class="km_session_days_wrap">
                            <?php $this->sessionDays($session);?>
                        </span>
                    </div>
                </div>

                <!-- Date -->
                <div class="km_month_date km_month_year">
                    <i class="fa fa-calendar km_primary_color" aria-hidden="true"></i>
                    <span class="time km_session_month"></span>
                    <span class="year km_session_year"></span>
                </div>
                <div class="km_time">
                    <i class="fa fa-clock km_primary_color" aria-hidden="true"></i>
                    <span class="time km_sess_time"></span>
                </div>

            </div>

            <div class="km_session_bottom_wrap km_listview_price_col">
                <?php //if ($session->availableSpots && !$session->enablePaymentOptions) {  ?>
                <?php if ($session->sessionType != 'event') {?>
                <div class="km_session_price_div">
                    <span class="price">
                        <i class="fa fa-usd km_primary_color" aria-hidden="true"></i>
                        <span class="km_session_price"><?php echo $this->display_price($session->frequencyPrice) . "/week"; ?></span>

                    </span>
                    <!--<span class='km_remain_weeks'><?php //echo $this->week_between_two_dates($currentdate, $dateto)." weeks remaining"; ?></span>-->
                </div>
                <?php }?>
                <div class="km_cart_button_p">
                        <?php

    if ($session->bookingStatus == 'open') {
        ?>
                        <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'multiweek'), 'fieldday');?> href="javascript:void(0);" data-type="multiWeek" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                        <?php _e('Book Now', 'fieldday');?></a>
                        <?php } else {?>
                            <a class="disabled km_btn km_session_btn km_primary_bg"><?php _e('Book Now', 'fieldday');?></a>
                        <?php }?>
                </div>
                <div class="km_avaiableseats_session_section">
                    <?php if ($session->availableSpots) {
        $availtext = 'Available Seat(s)';
        if ($session->availableSpots > 100) {
            $slots = "100+";
        } else { $slots = $session->availableSpots;}

        ?>
                    <span class="session_seats <?php echo $session_extra['SeatsClass']; ?>">
                        <?php echo $slots; ?> <?php _e($availtext, 'fieldday');?>
                    </span>
                <?php }?>

                <?php if ($session->bookingStatus == 'closed') {?>
                           <span class="session_seats text-danger">Registrations Closed.</span>
                <?php }?>

                </div>
            </div>

        </div>
    </div>
<!-- Add to cart -->
</li>

<?php } else {?>
<li id="km_session_two_coloum_layout" class="km_session_single_item activethemeview km_records" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $agefrom; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">

    <!-- New Design -->
    <!-- Img -->
    <div class="km_col_2">
        <div class="km_align">
            <div class="km_thumbnail_new" onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');">
                <?php $this->displaySessionThumb($session);?>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="km_col_10">
        <div class="km_Heading_content">
            <!-- Heading -->
            <div class="km_full_age">
                <input type='hidden' id='km_session_tags' value='{}'>
                <h3 class="km_session_name_heading km_with_tooltip km_primary_color" onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');" ><?php echo $session->name; ?>
                    <!--div class="km_with_tooltip">
                   <img src="<?php //echo $themeimgFile; ?>" class="km_icon_infor">

                <span class="tooltiptext">More Info About This Activity</span>
                </div-->
                </h3>
                <div class="km_descri" style="display: none"><?php echo $session->description; ?></div>

                <div class="km_session_full_ages">
                    <i class="fa fa-<?php echo $icon; ?> km_primary_color" aria-hidden="true"></i>
                    <span class="session_age_group">
                    <?php
if ($skillLevelOption == 'grade') {
    print wp_sprintf("Grade(s): %s - %s", $gradefrom, $gradeto);
} else {
    print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
}
    ?>
                    </span>


                </div>

               <div class="km_avaiableseats_session_section">
                    <a href="javascript:void(0);"  onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>', '<?php echo $session->sessionType; ?>');" class="km_session_btn km_moreinfor km_primary_color km_transparent_bg">More Info</a>
                </div>

            </div>
            <div class="km_Heading_content_inner">
                <div class="km_full_age_days">
                    <div class="km_session_days">
                        <span class="activity_title" style="display: none;"><?php echo apply_filters("km_sessionlist_activity_title", $session_extra['activityTitle'], $session, $session_extra); ?></span>
                        <span class="km_session_days_wrap">
                            <?php $this->sessionDays($session);?>
                        </span>
                    </div>
                </div>

                <!-- Date -->
                <div class="km_month_date km_month_year">
                    <i class="fa fa-calendar km_primary_color" aria-hidden="true"></i>
                    <span class="time km_session_month"></span>
                    <span class="year km_session_year"></span>
                </div>
                <div class="km_time">
                    <i class="fa fa-clock km_primary_color" aria-hidden="true"></i>
                    <span class="time km_sess_time"></span>
                </div>
                <div class="km_location_session_section">
                    <i class="fa fa-map-marker km_primary_color"></i>
                    <span class="km_location_session_details"><a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a><?php //echo $location; ?></span>
                </div>

            </div>


            <div class="km_session_bottom_wrap km_listview_price_col">
                <?php //if ($session->availableSpots && !$session->enablePaymentOptions) {  ?>

            <?php if (!$session->enablePaymentOptions) {?>
                <?php if ($session->sessionType != 'event') {?>
                <div class="km_session_price_div">
                    <span class="price">
                        <i class="fa fa-usd GridIcon" aria-hidden="true"></i>
                        <?php if ($session->offersClassPackages) {if ($session->availableSpots > 0) {echo $this->CountPackagePrice(1, false);
        echo '<span class="km_price_t">' . __('/month', 'fieldday') . '</span>';}} else {
        //echo $this->display_price($session->price);
        print $this->sessionBookingavail($session, false, $groupSessionListing);
    }
        if (!empty($sessionPriceRangeTo)):
            wp_sprintf("- %s", $this->display_price($sessionPriceRangeTo));
        endif;
        ?>
                    </span>
                </div>
                <?php }}
    if ($session->enablePaymentOptions):
        echo '<div class="km_plan_whl">';
        if ($session->price) {
            echo $this->display_price($session->price) . " or ";
        }
        ?>
		<a <?php $this->InstallmentPopup($session->_id, $tagId, $oneDaySelectedDate);?> href="javascript:void(0);" class="km_primary_color km_plans_btn"><?php $this->displayText('installment_plans');?></a>
		<?php echo '</div>';
    endif; ?>
        <div class="km_cart_button_p">
                        <?php
// we have to comment this

    if ($session->bookingStatus == 'open'):
        if ($session->offersClassPackages) {?>
			<a <?php _e($this->packageRegister($session->_id), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_feature_purchase_btn km_primary_bg km_session_btn">
				<?php _e('Book Now', 'fieldday');?>
			</a>
	<?php }
    endif;

    if ($session->sessionType != 'event') {
        if ($session->groupSessionListing) { //Check if Grouping Enable
            //if($session->anySeatAvailable && $session->availableSpots){
            if ($session->bookingStatus == 'open') {
                ?>
                                <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>"
                                data-type="groupSessionListing"   class="km_btn km_primary_bg km_session_btn">
                                <?php $this->displayText('add_to_cart_btn');?>
                                </a><?php
} else {
                if ($session->bookingStatus == 'waitlist') {
                    ?>

                                    <!-- new code logic for add to cart/wishlist  implement -->
                                    <a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn"><?php _e('Wait List', 'fieldday');?></a>
                                     <!-- new code logic for add to cart/wishlist  implement  end-->

                                    <?php
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

                    ?>

                                    <a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn"><?php _e('Wait List', 'fieldday');?></a>



                                    <?php
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

                    <?php }?>
                </div>
                <!-- Old Code below -->
                <div class="km_avaiableseats_session_section">
                    <?php if ($session->availableSpots) {
        if ($session->availableSpots > 100) {
            $slots = "100+";
        } else { $slots = $session->availableSpots;}
        if ($session->sessionType != 'event') {
            $availtext = 'Available Seat(s)';
        } else {
            $availtext = 'Available Ticket(s)';
        }
        ?>
                    <?php if ($show_available_spots) {?>
                    <span class="session_seats <?php echo $session_extra['SeatsClass']; ?>">
                        <?php echo $slots; ?> <?php _e($availtext, 'fieldday');?>
                    </span>
                    <?php }?>

                <?php }?>

                <?php if ($session->bookingStatus == 'closed') {?>
                           <span class="session_seats text-danger">Registrations Closed.</span>
                <?php }?>

                </div>
            </div>

        </div>
        <?php if ($priceNotes) {
        foreach ($priceNotes as $priceNote) {
            echo '<p class="km_notes">' . $priceNote->text . '</p>';
        }
    }
    ?>

    </div>
<!-- Add to cart -->
</li>
<?php }?>