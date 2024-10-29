<?php //echo "<pre>"; echo "sdasdasd"; print_r($CartTotals); echo "</pre>"; ?>
<div class="km_cart_wrap">
    <div class="km_citems_sec">
    <?php
foreach ($calculationInfo as $cartDetail):
    //$cartItemDetail = $this->getCartItem($CalculationItem->bookingKey);
    /*if (!in_array($cartItemDetail, $booking_array)){
    array_push($booking_array,$cartItemDetail);
    } */

    $kids = $cartDetail->kidId;
    $kidname = '';
    $kidscount = 0;
    $key = $cartDetail->_id;
    $addedForOneDayOnly = $cartDetail->addedForOneDayOnly;
    $selectedate = '';
    if ($addedForOneDayOnly) {
        $bookingtypesel = "One Day Only";
        $selectedate = fieldday()->engine->parseDate($cartDetail->oneDaySelectedDate, 'd-M-Y');
    } else {
        $bookingtypesel = "All Session Days";
    }
    foreach ($kids as $kid) {
        $kidname .= '<span>' . $kid->firstName . '</span>';
        $kidscount++;
    }
    $session_img = fieldday()->engine->displaySessionThumb($cartDetail->sessionId, false, true);
    //$session_img = fieldday()->engine->getsessionImageUrl($cartDetail,false,true);
    $totalPriceOneSession = $cartDetail->perPersonPerSessionPrice * $kidscount;
    ?>
																      <div class="km_cart_item">
																        <?php
    $hasPaymentOption = $this->getValue('selected_payment_option', $cartItemDetail, false);
    $location = $cartDetail->sessionId->siteLocationId->name;
    $location_state = $cartDetail->sessionId->siteLocationId->state;
    $location_country = $cartDetail->sessionId->siteLocationId->country;
    $location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
    $cart_key = $cartDetail->_id;
    ?>
																        <div class="km_cart_items_list km_row">
																            <div class="km_col_2"><?php print wp_sprintf('%s', $session_img);?></div>
																            <div class="km_ci_detail km_col_6 km_session_single_item" data-time-stamp-from="<?php echo $cartItemDetail['session_detail']->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $cartItemDetail['session_detail']->dateTimestamp->to; ?>" data-day-type="">
																                <div class="km_citem_name km_primary_color"><?php echo $cartDetail->sessionId->name ?></div>
																                <?php
    print wp_sprintf('<div class="km_cart_item_seats"><i class="fa fa-child km_primary_color" aria-hidden="true"></i><span class="km_kids_name">%s</span></div>', $kidname);
    if ($selectedate) {
        print wp_sprintf('<div class="km_cart_item_sdate km_cart_time"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span class="km_cart_date">%s</span></div>', $selectedate);
    } else {
        print wp_sprintf('<div class="km_cart_item_sdate km_cart_time"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span class="km_cart_date">%s</span></div>', 'All Session Days');
    }
    ?>
																               <!--  <div class="km_date_time km_cart_time">
																                    <div class="km_time_p">
																                        <i class="fa fa-clock km_primary_color" aria-hidden="true"></i>
																                        <span class="km_sess_time"></span>
																                    </div>
																                </div> -->
																                <div class="km_cart_location km_cart_time">
																                    <i class="fa fa-map-marker km_primary_color"></i>
																                    <span class="km_location_session_details">
																                    <a href="<?php echo $location_link; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;"><?php echo $location; ?></a></span>
																                </div>
																                <?php
    print wp_sprintf('<div class="km_cart_button"><span data-cart-key="%s" class="km_remove_cart_item km_secondary_color">Remove</span></div>', $cart_key);
    ?>

																            </div>

																            <div class="km_ci_payment_detail km_col_4">
																                <?php if ($hasPaymentOption && $hasPaymentOption != 'full_amount'): ?>
																                <div class="km_sess_total_price"><?php print wp_sprintf('%s <strong>%s</strong>', __('Deposit Price', 'fieldday'), $this->display_price($cartDetail->totalPrice));?></div>
																                <?php else: ?>
                  <div class="km_sess_total_price"><?php print wp_sprintf('%s <strong>%s</strong>', __('Price', 'fieldday'), $this->display_price($totalPriceOneSession));?></div>
                <?php endif;?>
                <?php if ($cartDetail->additionalChargePrice) {?>
                <div class="km_sess_total_price"><?php print wp_sprintf('%s <strong>%s</strong>', __('Additional Charges ', 'fieldday'), $this->display_price($cartDetail->additionalChargePrice));?></div>
                <?php }?>
                <?php if ($cartDetail->extendedCarePrice) {?>
                <div class="km_sess_total_price"><?php print wp_sprintf('%s <strong>%s</strong>', __('Extended Care charges', 'fieldday'), $this->display_price($cartDetail->extendedCarePrice));?></div>
                <?php }?>
                <?php if ($cartDetail->siblingDiscountAmount) {?>
                <div class="km_sess_sibling"><?php print wp_sprintf('%s <strong>%s</strong>', __('Sibling Discount', 'fieldday'), $this->display_price($cartDetail->siblingDiscountAmount));?></div>
                <?php }?>
                 <?php if ($cartDetail->membershipApplied): ?>
                <div class="km_sess_total_price"><?php print wp_sprintf('%s <strong>%s</strong>', __('Membership Discount:', 'fieldday'), $this->display_price($cartDetail->membershipDiscount));?></div>
                <?php endif;?>
                <?php if ($hasPaymentOption && $hasPaymentOption != 'full_amount'): ?>
                  <div class="km_checkout_installments km_col_6">
                    <p class="km_installments_heading">Payment with Installments <i class="fa fa-chevron-circle-down"  data-sessionId="<?php echo $CalculationItem->sessionId; ?>" id="km_checkoutpayments"></i></p>
                  </div>
                <?php endif;?>
            </div>
        </div>


       <!--  <div class="my__purchase-details km_row">
            <div class="km_cart_session_name km_col_3">
                <?php //apply_filters('fieldday_cart_item_title', $this->displayCartSessionName($cartItemDetail), $CalculationItem, $cartItemDetail); ?>
                <?php //if($hasPaymentOption && $hasPaymentOption != 'full_amount') : ?>
                  <div class="km_checkout_installments km_col_6">
                    <p class="km_installments_heading">Payment with Installments <i class="fa fa-chevron-circle-down"  data-sessionId="<?php //echo $CalculationItem->sessionId;?>" id="km_checkoutpayments"></i></p>
                  </div>
                <?php //endif; ?>
            </div>
            <div class="km_cart_meta km_col_3">
                <?php //apply_filters('fieldday_cart_additionalcharges', $this->displayAdditionalChargesOnCart($CalculationItem), $CalculationItem, $cartItemDetail); ?>
            </div>
            <div class="km_col_3">
                <?php //apply_filters('fieldday_cart_extended_care', $this->displayExtendedCareOnCart($CalculationItem, $cartItemDetail), $CalculationItem, $cartItemDetail); ?>
            </div>
            <div class="km_col_3">
                <?php //apply_filters('fieldday_cart_kids', $this->displayKidsOnCart($cartItemDetail), $CalculationItem, $cartItemDetail); ?>
            </div>
        </div> -->
       <!--  <div class="km_cart_price_row">
            <?php //if($hasPaymentOption && $hasPaymentOption != 'full_amount') : ?>
                <div class="km_sess_total_price"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Deposit Price:', 'fieldday'), $this->display_price($CalculationItem->totalSessionPrice)); ?></div>
            <?php //else: ?>
              <div class="km_sess_total_price"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Session Price:', 'fieldday'), $this->display_price($CalculationItem->totalSessionPrice)); ?></div>
            <?php //endif; ?>
            <div class="km_sess_total_price"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Additional Charges: ', 'fieldday'), $this->display_price($CalculationItem->additionalChargePrice)); ?></div>
            <div class="km_sess_total_price"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Extended Care charges:', 'fieldday'), $this->display_price($CalculationItem->extendedCarePrice)); ?></div>
            <div class="km_sess_sibling"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Sibling Discount:', 'fieldday'), $this->display_price($CalculationItem->siblingDiscountAmount)); ?></div>
        </div> -->
    </div>
    <?php endforeach;?>
    </div>
    <?php
if ($cartDetail->siblingDiscountEligible) {?>
            <div class="km_sibling_discount">
                    <label class="km_checkbox_wrap">
                        <span><?php _e('Apply Sibling Discount', 'fieldday');?></span>
                        <input onchange="return fieldday.siblingDiscount(this, event);" name="km_sibling_discount" type="checkbox" <?php if ($CartTotals->siblingDiscount) {echo "checked";}?> class="">
                        <span class="km_checkbox"></span>
                    </label>
                </div>
    <?php }?>
    <div class="km_row km_total_price_wrap km_col_12">
        <div class="km_promo km_col_8">
            <h3 class="km_heading km_primary_color"><?php _e('Promo Code', 'fieldday');?></h3>
            <!-- <div class="km_primary_color">Promo Code</div> -->
            <div class="km_field_wrap"><input class="km_input" value="<?php echo $coupon; ?>"  type="text" name="couponCode"><a href="javascript:void(0);" class="km_promo_btn km_btn km_primary_bg" data-group="coupon_code" onclick="return fieldday.process_coupon_apply(this, event);"><?php _e('Apply', 'fieldday')?></a></div>
        <?php //}
$available_coupons = fieldday()->api->AvailableCoupons();
if ($available_coupons->statusCode == 200) {
    echo '<div id="km_avail_coupons" class="km_column_wrap km_col_12">
                <h3 class="km_heading km_primary_color">' . __('Available Coupons', 'fieldday') . '</h3>
                <ul>';
    $coupons = $available_coupons->data; //print_r($coupons);
    foreach ($coupons as $coupon) { $Maxdiscountapplied ='';
        $percentagesymbol = $dollarsymbol = '';
        $discountType = $coupon->discountType;
        if ($discountType == 'percent') {$percentagesymbol = '%';}
        if ($discountType == 'unit') {$dollarsymbol = '$';}
        $expiryDate = fieldday()->engine->parseDate($coupon->expiryDate, 'd/M/Y');
        $isMaxDiscountAmount = fieldday()->engine->getValue('isMaxDiscountAmount', $coupon,false);
        $maxDiscount = fieldday()->engine->getValue('maxDiscount', $coupon,false);
        if($isMaxDiscountAmount) {
            $Maxdiscountapplied = '<span class="km_max_discount">(Max discount: '.fieldday_CURRENCY . $maxDiscount.')</span>';
        }
        
        ?>
            <li><h4><?php echo $coupon->title; ?></h4><span class="km_coupon_percent"><?php echo $dollarsymbol . $coupon->discount . $percentagesymbol; ?></span><?php echo $Maxdiscountapplied; ?><span class="km_coupon_valid">Valid until <?php echo $expiryDate; ?></span></li>

        <?php
}
    echo '</ul></div>';
}
?>

        </div>
        <div class="km_total_price_inner km_col_4">
        <h3 class="km_primary_color"><?php _e('Cart Total', 'fieldday');?></h3>
        <ul>
            <!-- <div class="km_sess_total_price"><?php //print wp_sprintf('%s : <strong>%s</strong>', __('Purchase Price', 'fieldday'), $this->display_price($calculationInfo->totalAmount)); ?></div>
        <div class="km_sess_sibling"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Sibling Discount:' , 'fieldday'), $this->display_price($calculationInfo->siblingDiscount)); ?></div>
        <div class="km_sess_sibling"><?php //print wp_sprintf('%s <strong>%s</strong>', __('Campaign Discount:' , 'fieldday'), $this->display_price($calculationInfo->campaignDiscount)); ?></div>
        <div class="km_sess_total_price"><?php //print wp_sprintf('%s <strong>%s</strong>',__('Credit Applied:', 'fieldday'), $this->getCreditApplied($calculationInfo)); ?></div> -->
        <?php //if($calculationInfo->totalFee): ?>
            <li><?php print wp_sprintf('<span class="km_title_">%s</span><span class="km_price_ km_secondary_color">%s</span>', __('Fee (Credit Card + Field Day Fee):', 'fieldday'), $this->display_price($CartTotals->totalFee));?></li>
        <?php //endif; ?>
        <?php if ($CartTotals->membershipApplied): ?>
        <li><?php print wp_sprintf('<span class="km_title_">%s</span><span class="km_price_ km_secondary_color">%s</span>', __('Membership Discount:', 'fieldday'), $this->display_price($CartTotals->membershipDiscount));?></li>
        <?php endif;?>
        <?php if ($CartTotals->siblingDiscount): ?>
        <li><?php print wp_sprintf('<span class="km_title_">%s</span><span class="km_price_ km_secondary_color">%s</span>', __('Sibling Discount:', 'fieldday'), $this->display_price($CartTotals->siblingDiscount));?></li>
        <?php endif;?>
        <?php
if ($CartTotals->couponDiscount) {?>
            <li><?php print wp_sprintf('<span class="km_title_">%s</span><span class="km_price_ km_secondary_color">%s</span>', __('Coupon Discount:', 'fieldday'), $this->display_price($CartTotals->couponDiscount));?><span class="km_remove_coupon_icon"  onclick="return fieldday.process_coupon_apply(this, event,'remove');"><i class="fa fa-remove" style="font-size:48px;color:red"></i></span></li>
        <?php }
?>
        <li class="km_primary_color km_totalpayable"><?php print wp_sprintf('<span class="km_title_">%s</span><span class="km_price_">%s</span>', __('Total Payable:', 'fieldday'), $this->display_price($CartTotals->payableAmount));?></li>
         </ul>
        </div>

    </div>
</div>
<?php if ($cartDetail->cartId) {
    echo '<input type="hidden" name="cartId" value="' . $cartDetail->cartId . '">';
}
if ($CartTotals->payableAmount > 0) {$paymentmethod = 'card';} else { $paymentmethod = 'free';}
echo '<input type="hidden" name="paymentMethod" value="' . $paymentmethod . '">';
?>
