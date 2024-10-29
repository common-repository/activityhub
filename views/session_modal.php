<div id="km_modal_discount" class="km_modal km_overlay modal-normal">
    <div class="km_modal_alert">
        <a href="javascript:void();" class="km_popup_close" onclick="fieldday.closediscountpopup(this);">
            <svg width="12" height="12" viewport="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" stroke="#fff" y1="11" x2="11" y2="1" stroke-width="2"></line>
                <line x1="1" y1="1" stroke="#fff" x2="11" y2="11" stroke-width="2"></line>
            </svg>
        </a>
        <!-- <div class="km_modal_heading">
            
        </div> -->
        <div class="km_modal_content">
            <div class="km_Siblings_discount">
                <span class="km_discount_amount"><?php echo $discount[0]; ?></span>
                <span class="km_discount_per">
                  <span class="km_discount_text">%</span><br>
                  <span class="km_discount_text"><?php _e('off', 'fieldday') ?></span>
                </span>
            </div>
            <?php print apply_filters('before_discount_button', $this->discount_before_button($discount), $discount); ?>
            <div class="km_discount_main">
                <?php print apply_filters('discount_button_text', $this->discount_button_text($discount), $discount); ?>
            </div>
            <?php print apply_filters('after_discount_button', $this->discount_after_button($discount), $discount); ?>
        </div>
        <!-- <div class="km_modal_footer">
            
        </div> -->
    </div>
</div>
        