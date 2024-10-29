<li class="km_session_single_item">
    <div class="km_session_col km_session_name">
        <span class="session_name"><?php echo $DayDetail->title; ?></span>
        <span class="session_seats <?php //echo $session_extra['SeatsClass']; ?>">
            <?php echo $DayDetail->availableCount; ?>
            <?php _e('Available Seat(s)', 'fieldday'); ?>
        </span>
    </div>
    <div class="km_session_col km_session_date">
        <!-- <span class="time km_merchandise_expire"><?php //_e('Expire On', 'fieldday'); ?></span> -->
        <span class="year km_merchandise_expire_date"><?php  echo $this->parseDate($DayDetail->expiryDate); ?></span>
    </div>
    <div class="km_session_col km_session_time">
        <?php if($DayDetail->isPerDayCredit):  ?>
            <span class="time km_merchandise_days"><?php _e('Bank Days', 'fieldday'); ?></span>
            <span class="year km_merchandise_days_val"><?php echo $DayDetail->creditAmount; ?></span>
        <?php else: ?>
            <span class="time km_merchandise_amount"><?php echo $this->display_price($DayDetail->creditAmount); ?></span>
        <?php endif; ?>
    </div>
    <div class="km_session_col km_session_price">
        <span class="price">
            <?php echo $this->display_price($DayDetail->totalAmount); ?>
        </span>
        <span class="activity_title"></span>
    </div>
    <div class="km_session_col km_session_actions">
        <?php if($DayDetail->availableCount) : ?>
            <a <?php $this->merchandiseRegister($DayDetail->_id,$DayDetail->title); ?> class="km_btn btn btn-primary">
                <?php $this->displayText('bank_day_btn'); ?>
            </a>
        <?php else: ?>
            <button class="disabled btn btn-default"><?php _e('Registration Full', 'fieldday'); ?></button>
        <?php endif; ?>    
    </div>
</li>