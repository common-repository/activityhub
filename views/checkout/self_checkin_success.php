<?php 
$events = $ticketdata->booking->details[0];
$session = $events->sessionId;
$activity = $events->activityId;
$signInTime = $ticketdata->signInTime;
$signInTime =  $this->parseDate($ticketdata->signInTime,'M d, Y');
$eventDate = date('M d, Y', strtotime($events->localDateTimestamp->from));
$priceBreakup = $ticketdata->booking->details[0]->priceBreakup;
$isCouponApplied = $ticketdata->booking->isCouponApplied;
if($isCouponApplied){
$couponId = $ticketdata->booking->couponId;
if($couponId->discountType=='percent'){ $discount_symbol = '%';}
$totaldiscount = $couponId->discount.$discount_symbol;
$coupon = '(Coupon - '.$totaldiscount.')'; 
}
?>
<div class="km_thankyou_page km_selfcheckin_thankyou">
    <img src="<?php echo fieldday_URL; ?>/assets/img/checkin-success.gif">
    <!-- <svg width="102px" height="60px" viewBox="0 0 102 102">
        <g id="Accout-Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Proccess-S5" transform="translate(-669.000000, -533.000000)">
                <g id="Group" transform="translate(670.000000, 534.000000)">
                    <path d="M43.3213435,62.7638709 L33.8955408,52.9421993 C32.7014864,51.6975873 32.7014864,49.680363 33.8955408,48.4362651 C35.0876242,47.1909676 37.0247187,47.1909676 38.2191016,48.4362651 L45.4831239,56.0043698 L63.7804057,36.933459 C64.975117,35.688847 66.9097479,35.688847 68.1044592,36.933459 C69.2985136,38.1789279 69.2985136,40.1952953 68.1044592,41.4400787 L47.6449043,62.7638709 C47.0477129,63.3854914 46.2655827,63.6969014 45.4831239,63.6969014 C44.7009937,63.6969014 43.9186992,63.3854914 43.3213435,62.7638709 Z" id="tickmark" fill="#BFD00C"></path>
                    <circle id="Oval-3" stroke="#BFD00C" stroke-width="2" cx="50" cy="50" r="50"></circle>
                    <circle id="Oval-3" stroke="#BFD00C" cx="50.5" cy="50.5" r="42.5"></circle>
                </g>
            </g>
        </g>
    </svg> -->
    <h2 class="km_thankyou_title"><?php _e('Success Check-in','fiedday') ?></h2>
    <p class="checkin_date"><?php echo $eventDate; ?></p>
    <div class="km_group_success">
        <span>Group Size</span>
        <span class="km_number km_highlight_color"><?php echo $events->totalParticipants; ?></span>
    </div>
    <div class="km_eventgroups_detail">
        <?php if($priceBreakup){ ?>
        <ul>
            <?php 
            foreach($priceBreakup as $bookingroups) {
            if($bookingroups->customGroupKey){ $grouptitle = $bookingroups->customGroupKey; }
            else{ $grouptitle = $bookingroups->key; }
            echo '<li>'.ucwords($grouptitle).' - '.$bookingroups->seatCount.'</li>';
            } 
            echo '<li class="km_highlight_color">Paid Amount: '.$this->display_price($ticketdata->booking->paidAmount).' '.$coupon.'</li>';
            ?>
        </ul>
    <?php } ?>
    </div>
    <div class="km_thankyou_message"><?php _e('<h3 class="km_dont_close">Do Not Close</h3>Show Screen to check-in agent for admission.','fiedday') ?></div>
    <div class="km_ticket_thankyou">
        <div class="km_ticket_userinfo">
            <h3 class="km_session_name_heading km_with_tooltip km_primary_color"><?php echo $session->name; ?></h3>
            <div class="km_ticket_userinfo_detail"><?php echo $ticketdata->booking->parentId->name; ?></div>
            <?php if($ticketdata->appliedMilitaryDiscount) { ?>
           <div class="km_ticket_userinfo_detail"><?php echo 'Military & First Responders - ID Check' ?></div>
       <?php } ?>
        </div>
    </div>
    
    <a href="<?php $this->displayText('km_checkout_return_url'); ?>"  class="km_btn km_primary_bg"><?php $this->displayText('km_checkout_return_text'); ?></a>
</div>