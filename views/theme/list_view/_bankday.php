<?php

/*echo"<pre>";
print_r($DayDetail);
echo"</pre>";*/
$sessionPhotoURL = $DayDetail->image->original;
//$description= $DayDetail->description;
//$description= substr_replace($description, "...", 250);
?>
<li id="km_session_two_coloum_layout" class="km_session_single_item activethemeview km_records">

   
	 <!-- Img -->
    <div class="km_col_2 km_align">
		<div class="km_thumbnail_new km_merchandise_image">
        <?php 
        if ($sessionPhotoURL)
        {
            print wp_sprintf('<img src="%s" alt="%s" title="%s" />', $sessionPhotoURL, $DayDetail->title, $DayDetail->title);
        }else
        {
            print wp_sprintf('<img src="%s" />', fieldday_PLACEHOLDER);
        }

            //$this->displaySessionThumb($DayDetail);  ?>
        </div>

    </div>

    <div class="km_col_10">
	
	 <div class="km_Heading_content">
	<!-- Heading -->
            <div onclick="return ActivityHub.viewSessionDetail('<?php echo $DayDetail->_id; ?>');" class="km_full_age">
                <input type='hidden' id='km_session_tags' value='{}'>
                <h3 class="km_session_name_heading km_primary_color"><?php echo $DayDetail->title; ?></h3>
                 <div class="km_descri" style="display: none"><?php echo $DayDetail->description;?></div>
                <!-- <span class="session_seats <?php //echo $session_extra['SeatsClass']; ?>"><?php //echo $session->availableSpots; ?> <?php _e('Available Seat(s)', 'fieldday'); ?></span> -->
              
            </div>
        <div class="km_Heading_content_inner">
            <!--div class="km_full_age_days">
                <div class="km_session_days">
                      <span class="activity_title" style="display: none;">
                        <?php  apply_filters("km_sessionlist_activity_title", $session_extra['activityTitle'], $session, $session_extra); ?></span>
                    <span class="km_session_days_wrap">
                        <?php if($session){ $this->sessionDays($session); } ?>
                    </span>
                </div>
            </div>

            <div class="km_time">
                <i class="fa fa-clock GridIcon" aria-hidden="true"></i>
                <span class="time km_sess_time"></span>
            </div--->

            <!-- Date -->
            <div class="km_month_date km_month_year">
                <i class="fa fa-calendar km_primary_color" aria-hidden="true"></i>
               <span class="year km_merchandise_expire_date"><?php echo $this->parseDate($DayDetail->expiryDate,'M-d-Y'); ?></span>
				
            </div>

            <div class="km_location_session_section">
				<?php if($DayDetail->isPerDayCredit):  ?>
				<span class="price"><?php _e('Bank Days', 'fieldday'); ?>
				<?php echo $DayDetail->creditAmount; ?>
				</span>
				<?php else: ?>
				<span class="price">
				<?php _e('Credit Amount', 'fieldday'); ?>
				<?php echo $this->display_price($DayDetail->creditAmount); ?>
				</span>
				<?php endif; ?>
            </div>

        </div>

        <div class="km_session_bottom_wrap km_listview_price_col">
            <div class="km_session_price_div">
                <span class="price">
                    <i class="fa fa-usd GridIcon" aria-hidden="true"></i>
                    <?php echo $this->display_price($DayDetail->totalAmount); ?>
                </span>
            </div>
            <div class="km_cart_button_p">
                 
				<?php 
                if($DayDetail->availableCount) : ?>
				<a <?php $this->merchandiseRegister($DayDetail->_id,$DayDetail->title); ?> class="km_btn btn km_primary_bg km_session_btn">
				<?php $this->displayText('bank_day_btn'); ?>
				</a>
				<?php else: ?>
				<button class="disabled btn btn-default km_session_btn km_primary_bg"><?php _e('Registration Full', 'fieldday'); ?></button>
				<?php endif; ?>
            </div>
        </div>

        </div>
	
	
    </div>



 
</li>
