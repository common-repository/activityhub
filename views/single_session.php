<?php
$session_extra = $this->GetSessionVar($session);
$skillLevelOption = $session->skillLevelOption;
if($skillLevelOption=='grade'){
    $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
    $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
    $icon = "child";
}else{ $icon = "child"; }
$sessionPrice = $session->price;
$sessionPriceRange = $session->activityId->priceRange;
$sessionPriceRangeFrom = $sessionPriceRange->from;
$sessionPriceRangeto = isset($sessionPriceRange->to) ? $sessionPriceRange->to : null;
$sessionDateFromFilter = date('n', strtotime($session->dateTimestamp->from));
$sessionDateToFilter = date('n', strtotime($session->dateTimestamp->to));
$oneDaySelectedDate = $this->getValue('oneDaySelectedDate', $session, false);
$agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
$ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
$available_spots_total = $session->availableSpots?$session->availableSpots:0;
$show_available_spots = false;
if($session->unlimitedSeats){$show_available_spots = false;}else{
    if(isset($available_spots_total) && $available_spots_total<50){
        $show_available_spots = true;
    }else{
        $show_available_spots = false;
    }
}
?>
<li style="background-image: url(<?php print $this->getsessionImageUrl($session); ?>)" class=" km_session_single_item km_one_column" data-time-stamp-from="<?php echo $session->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $session->dateTimestamp->to; ?>" data-day-type="<?php echo $session_extra['activityType']; ?>" data-month-from="<?php echo $sessionDateFromFilter; ?>" data-month-to="<?php echo $sessionDateToFilter; ?>" data-age-from="<?php echo $session->activityId->ageRange->from; ?>" data-age-to="<?php echo $session->activityId->ageRange->to; ?>">
    <div class="km_img_div"><img src="<?php print $this->getsessionImageUrl($session); ?>"></div>
    <div onclick="return fieldday.viewSessionDetail('<?php echo $session->_id; ?>');" class="km_session_col">
        <input type='hidden' id='km_session_tags' value='{}'>
        <span style="<?php echo isset($session->activityId->colorHex) ? 'color: #'.$session->activityId->colorHex : 'assad'; ?>" class="session_name km_primary_color"><?php echo $session->name; ?></span>        
    </div>
    <div class="km_session_col km_price_grid">
        <span class="session_age_group">
            <i class="fa fa-child km_primary_color" aria-hidden="true"></i>
            <?php 
            if($skillLevelOption=='grade'){
                print wp_sprintf("Grade(s): %s - %s", $gradefrom, $gradeto);
            } else {
                print wp_sprintf("Age: %d - %d yrs", $agefrom, $ageto);
            }
            ?>
        </span>

        <span class="price">
            <i class="fa fa-money GridIcon km_primary_color" aria-hidden="true"></i>
            <?php if($session->offersClassPackages){ if($session->availableSpots>0){echo $this->CountPackagePrice(1,false); echo '<span class="km_price_t">'.__('/month', 'fieldday').'</span>'; } } else {
                //echo $this->display_price($session->price);
                print $this->sessionBookingavail($session , false);
            }  ?>
            <?php
            if (!empty($sessionPriceRangeTo)) :
                wp_sprintf("- %s", $this->display_price($sessionPriceRangeTo));
            endif;
            ?>
        </span>
    </div>
    
    <div class="km_session_col">
        <i class="fa fa-calendar GridIcon km_primary_color" aria-hidden="true"></i>
        <span class="time km_session_month"></span>
        <span class="year km_session_year"></span>
    </div>
    <div class="km_session_col">
        <i class="fa fa-clock GridIcon km_primary_color" aria-hidden="true"></i>
        <span class="time km_sess_time"></span>
        <span class="km_session_days_wrap">
            <?php $this->sessionDays($session); ?>
        </span>
    </div>
      
    <div class="km_session_col">

    <?php if($session->enablePaymentOptions): ?>
        <a <?php $this->InstallmentPopup($session->_id, $tagId, $oneDaySelectedDate); ?> href="javascript:void(0);" class="km_primary_color km_plans_btn">
        <?php $this->displayText('installment_plans'); ?>
        </a>
    <?php endif;?>
    <div class="km_cart_button_p">
            <?php if ($session->availableSpots) :
                if($session->offersClassPackages){ ?> 
                    <a <?php _e($this->packageRegister($session->_id), 'fieldday');  ?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_feature_purchase_btn km_primary_bg km_session_btn">
                    <?php _e('Book Now', 'fieldday'); ?>
                    </a>
                <?php } else{ ?>
            <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate)); ?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
            <?php $this->displayText('add_to_cart_btn'); ?>
            </a>
        <?php } else: ?>
            <a class="disabled km_btn km_session_btn km_primary_bg"><?php _e('Registration Full', 'fieldday'); ?></a>
        <?php endif; ?>
    </div>
        <?php if($session->availableSpots){ 
            if($session->availableSpots>100){
                $slots = "100+";
            }else { $slots = $session->availableSpots; }
        ?>


        <?php if($show_available_spots){ ?>
                        <span class="session_seats <?php echo $session_extra['SeatsClass']; ?>">
                            <?php echo $slots; ?> <?php _e('Available Seat(s)', 'fieldday'); ?>
                        </span>
        <?php } ?>


        <?php } ?>
    </div>

</li>
