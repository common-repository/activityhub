<?php
$session_extra = $this->GetSessionVar($session);
$additionalCharges = $session->additionalCharges;
$extendedCareDetails = $session->extendedCareDetails;
$session_type = $this->getvalue('oneDayType', $session, false) ? $this->getvalue('oneDayType', $session, false) : 'weekly';
$SelectedAdditionalcharges = [];
$SelectedPaymentOptions = [];
$selected_payment_option = null;
if($cartItem) {
    //echo "<pre>"; print_r($cartItem); echo "</pre>";
    $selected_payment_option = $cartItem['selected_payment_option'];
    $selectedExtendedCare = $cartItem['extendedCareSelected'];
    $SelectedAdditionalcharges = $cartItem['additionalChargeDetails'];
    if(!$SelectedAdditionalcharges) {
        $SelectedAdditionalcharges = [];
    }
}
?>
<?php if($session->enablePaymentOptions): ?>
    <div class="km_atc_payment_plans_wrapper">
        <div class="km_col_12 km_atc_payment_plans">
            <div class="">
                <h3><?php _e("Installment Plans of ", 'fieldday'); print $session->name; ?></h3>
            </div>
                <div class="km_payment_packages">
                    <ul>
                        <li>
                            <span><?php _e("Deposit", 'fieldday'); ?></span>
                            <span><?php _e("Today", 'fielday'); ?></span>
                            <span><?php echo $this->display_price($session->paymentOptions[0]->deposit); ?></span>
                        </li>
                        <?php foreach($session->paymentOptions[0]->payments as $key => $paymentOption): ?>
                            <li>
                                <span><?php _e("Installment", 'fieldday'); ?></span>
                                <span><?php echo $this->parseDate($paymentOption->dateTime); ?></span>
                                <span><?php echo $this->display_price($paymentOption->deposit); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        </div>
    </div>
            
<?php endif; ?>