<?php
if ($eventType == 'bankday') {
    if ($session->availableCount) {if (fieldday()->engine->isKmLogin()) {?>


<a onclick="fieldday.registermerchandise('<?php echo $eventId; ?>', '<?php echo $session->title; ?>')" class="km_btn btn km_primary_bg km_session_btn">
                <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Purchase'; ?>
</a>

<?php } else {?>

    <a data-offer-id="<?php echo $eventId; ?>" data-offer-name="<?php echo $session->title; ?>" onclick="fieldday.showAuthPopup(this, event)" class="km_btn btn km_primary_bg km_session_btn">
	<?php echo isset($eventText) && $eventText != '' ? $eventText : 'Purchase'; ?>
    </a>



<?php }} else {?>
            <button class="disabled btn btn-default"><?php _e('Registration Full', 'fieldday');?></button>
<?php }} elseif ($eventType == 'giftcard') {?>

    <a href="javascript:void(0)" data-title="<?php echo $session->title; ?>" id="km_giftpurchase_btn" class="km_btn km_purchase_btn km_primary_bg" data-giftcardid="<?php echo $eventId; ?>" data-giftcardprice-range="[25,50,100,125]">
        <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Purchase'; ?>
    </a>


<?php } else {?>

<div class="activity_session_list_button_only">
    <?php if ($session->sessionType == 'multiWeek') {?>

                        <?php

    //if ($session->availableSpots && !$session->registrationClosed) :
    if ($session->bookingStatus == 'open'):
    ?>
                        <div class="km_cart_button_p">
                        <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate), 'fieldday');?> href="javascript:void(0);" data-type="multiWeek" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                            <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Book Now'; ?>
                        </a>
                        </div>
                        <?php endif;
    ?>

            <?php }?>

            <?php if ($session->sessionType != 'multiWeek') {?>
                <div class="km_cart_button_p">
                    <?php

    if ($session->bookingStatus == 'open'):
        if ($session->offersClassPackages) {?>
									                            <a <?php _e($this->packageRegister($session->_id), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_feature_purchase_btn km_primary_bg km_session_btn">
									                            <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Book Now'; ?>
									                            </a>
									                        <?php }
    endif;

    if ($session->sessionType != 'event') {
        if ($session->groupSessionListing) { //Check if Grouping Enable
            //if($session->anySeatAvailable || $session->availableSpots){
            if ($session->bookingStatus == 'open') {
                ?>
                                <a data-type="groupSessionListing" <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                                <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Add to Cart'; ?>
                                </a><?php
} else {
                if ($session->bookingStatus == 'waitlist') {
                    ?><a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                                    <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Wait List'; ?>
                                    </a><?php
} else {
                    ?> <a class="disabled km_btn km_session_btn km_primary_bg">
                                        <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Book Now'; ?>
                                        </a>
                                        <?php
}
            }
        } else { // no Grouping Enable
            if ($session->bookingStatus == 'open') {
                ?>
                                <a <?php _e($this->sessionRegister($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">
                                    <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Add to Cart'; ?>
                                </a><?php
} else {
                if ($session->bookingStatus == 'waitlist') {
                    ?> <a <?php _e($this->sessionWaitList($session->_id, $tagId, $oneDaySelectedDate, false, '', 'camp'), 'fieldday');?> href="javascript:void(0);" data-type="waitlist" data-click="<?php echo $session->_id; ?>" class="km_btn km_primary_bg km_session_btn">

                                    <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Wait List'; ?>
                                    </a><?php
} else {
                    ?> <a class="disabled km_btn km_session_btn km_primary_bg">
                                        <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Book Now'; ?>
                                    </a> <?php
}
            }
        }
    }

    if ($session->sessionType == 'event') {
        if ($session->bookingStatus == 'open') {?>
                                <a <?php _e($this->eventRegister($session->_id, 'event'), 'fieldday');?> href="javascript:void(0);" data-click="<?php echo $session->_id; ?>" class="km_btn km_event_purchase_btn km_primary_bg km_session_btn">
                                <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Book Now'; ?>
                                </a>
                           <?php } else {?>
                            <a class="disabled km_btn km_session_btn km_primary_bg">
                                <?php echo isset($eventText) && $eventText != '' ? $eventText : 'Sold Out'; ?>
                            </a>
                        <?php }?>
                    <?php }?>
                </div>
            <?php }?>
        </div>
<?php }?>