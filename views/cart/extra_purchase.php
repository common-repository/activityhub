<?php
$session_extra = $this->GetSessionVar($session);
$additionalCharges = $session->additionalCharges;
$extendedCareDetails = $session->extendedCareDetails;
$session_type = $this->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
$extendedavailable = $additionalavailable = false;
?>
<div class="km_extrapurchase km_col_12">
    <div class="km_row">
        <div class="km_additional_charges km_col_6">
            <fieldset>
                <legend><?php _e('Extended Care', 'fieldday'); ?></legend>
                <?php $isCare = (isset($extendedCareDetails->afterCare) || isset($extendedCareDetails->earlyCare) || isset($extendedCareDetails->combined)) ? true : false; ?>
                <?php if (!empty($extendedCareDetails) && $isCare) : ?>
                    <div class="km_additionalcharges_wrap">
                        <?php foreach ($extendedCareDetails as $chargetype => $charges): ?>
                            <?php if($this->getvalue('isAvailable', $extendedCareDetails, false)): $extendedavailable = true; ?>
                                <?php if ($chargetype == 'afterCare' && $session_extra['activityType'] != 'morningonly'): ?>
                                    <div class="form-group">
                                        <div class="km_addtnl_left">
                                            <label class="km_radio_wrap">
                                                <span class="km_radio_text"><?php echo $this->extendedCareTypes($chargetype); ?></span>
                                                <input class="km_purchasefield" data-text="<?php echo $this->extendedCareTypes($chargetype); ?>" type="radio" data-price="<?php echo $charges->pricePerSession; ?>" value="<?php echo $chargetype; ?>" name="ATC[extendedCareSelected]" onclick="fieldday.radiobuttonevent(this, event);">
                                                    <span class="km_radio"></span>
                                            </label>
                                        </div>
                                        <div class="km_addtnl_right">
                                            <span class="price km_service_price"><?php echo $this->display_price($charges->pricePerSession); ?></span>
                                            <span class="days km_service_days km_text_green"><?php echo $this->sessionServiceDays($session_type); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($chargetype == 'earlyCare' && $session_extra['activityType'] != 'eveningonly'): ?>
                                    <div class="form-group">
                                        <div class="km_addtnl_left">
                                            <label class="km_radio_wrap">
                                                <span class="km_radio_text"><?php echo $this->extendedCareTypes($chargetype); ?></span>
                                                <input class="km_purchasefield" data-text="<?php echo $this->extendedCareTypes($chargetype); ?>" data-price="<?php echo $charges->pricePerSession; ?>" value="<?php echo $chargetype; ?>" type="radio" name="ATC[extendedCareSelected]" onclick="fieldday.radiobuttonevent(this, event);">
                                                <span class="km_radio"></span>
                                            </label>
                                        </div>
                                        <div class="km_addtnl_right">
                                            <span class="price km_service_price"><?php echo $this->display_price($charges->pricePerSession); ?></span>
                                            <span class="days km_service_days km_text_green"><?php echo $this->sessionServiceDays($session_type); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($chargetype == 'combined'): ?>
                                    <div class="form-group">
                                        <div class="km_addtnl_left">
                                            <label class="km_radio_wrap">
                                                <span class="km_radio_text"><?php echo $this->extendedCareTypes($chargetype); ?></span>
                                                <input class="km_purchasefield" data-text="<?php echo $this->extendedCareTypes($chargetype); ?>" data-price="<?php echo $charges->pricePerSession; ?>" value="<?php echo $chargetype; ?>" type="radio" name="ATC[extendedCareSelected]" onclick="fieldday.radiobuttonevent(this, event);">
                                                <span class="km_radio"></span>
                                            </label>
                                        </div>
                                        <div class="km_addtnl_right">
                                            <span class="price km_service_price"><?php echo $this->display_price($charges->pricePerSession); ?></span>
                                            <span class="days km_service_days km_text_green"><?php echo $this->sessionServiceDays($session_type); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if(!$extendedavailable): ?>
                    <div class="km_no_data"><?php _e('No Extended Care service for this session.', 'fieldday'); ?></div>
                <?php endif; ?>
            </fieldset>
        </div>
        <div class="additional_charges km_col_6">
            <fieldset>
                <legend><?php _e("Additional Charges", 'fieldday'); ?></legend>
                <?php if (!empty($additionalCharges)) : ?>
                    <div class="additionalcharges_wrap">
                        <?php foreach ($additionalCharges as $key => $product): ?>
                            <?php if(isset($product->isAvailableFor->$session_type) && $product->isAvailableFor->$session_type) : $additionalavailable = true;?>
                                <div class="form-group km_purchase_detail_single" data-time-start="<?php echo $product->starts; ?>" data-time-end="<?php echo $product->ends; ?>">
                                    <div class="km_addtnl_left">
                                        <label class="km_checkbox_wrap">
                                            <span class="km_radio_text"><?php echo $product->title; ?></span>
                                            <input class="km_purchasefield" data-text="<?php echo $product->title; ?>" data-price="<?php echo $product->price; ?>" value="<?php echo $product->_id; ?>" type="checkbox" name="ATC[additionalChargeDetails][]">
                                            <span class="km_checkbox"></span>
                                        </label>
                                    </div>
                                    <div class="km_addtnl_right">
                                        <span class="price"><?php echo $this->display_price($product->price); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if(!$additionalavailable) : ?>
                    <div class="km_no_data"><?php _e('No Additional service for this session.', 'fieldday'); ?></div>
                <?php endif; ?>
            </fieldset>
        </div>
    </div>
</div>
