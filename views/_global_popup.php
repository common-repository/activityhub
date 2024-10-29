<?php
 $this->fielddayGlobalPopupData();  
?>
<div class="km_popup_button">
    <a href="<?php echo apply_filters('fieldday_popup_link', get_permalink($this->getValue('purchase_page', $fielddaySetting, false))); ?>" class="km_global_pop_btn km_btn">
        <?php print apply_filters("_fieldday_popup_purchase_text", __("Shop Now", 'fieldday')); ?>
    </a>            
</div>