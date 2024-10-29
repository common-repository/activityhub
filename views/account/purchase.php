<?php //echo "<pre>";print_r($purchases); echo "</pre>"; ?>
<h3><?php _e('MY PURCHASE', 'fieldday'); ?></h3>
<div class="km_purchase km_km_purchase_new_version">
  <?php  if(!empty($purchases)) {
    foreach($purchases as $data) {
        $sessionDetails = $data->details;
		$orderCreated_at = new DateTime($data->createdAt);
		$orderCreated_at =  $orderCreated_at->format("M d, Y");
		
		?>
    <div class="km_purchase-item">
        <?php foreach ($sessionDetails as $key => $purchasedetail) {
            echo "<pre style='display:none;'>"; print_r($data); echo "</pre>"; 
			if(isset($purchasedetail->packageDetailsWhenPurchased) && $purchasedetail->packageDetailsWhenPurchased!=''){
                $title = $purchasedetail->packageDetailsWhenPurchased->title;
                $type = __('Credit Purchase', 'fieldday');
                $sessionDateFrom = $sessionDateTo = $sessionDateToYear = $sessionTimeFrom = $sessionTimeTo = " ";
			}else{
                $title = $purchasedetail->sessionId->name;
                $type = $this->GetSessionVar($purchasedetail);
                $type =fieldday()->engine->getValue('activityTitle', $type, false);
				
                $sessionDateFrom = date('M d, Y', strtotime($purchasedetail->sessionId->date->from));
                $sessionDateTo = date('M d', strtotime($purchasedetail->sessionId->date->to));
                $sessionDateToYear = date('Y', strtotime($purchasedetail->sessionId->date->to));
			    $sessionTimeFrom = date('g:i a', strtotime($purchasedetail->sessionId->date->from));
                $sessionTimeTo = date('g:i a', strtotime($purchasedetail->sessionId->date->to));
			}
			/*
            if($purchasedetail->orderType == 'sessionPurchase') { 
                $title = $purchasedetail->sessionId->name;
                $type = $this->GetSessionVar($purchasedetail);
                $type =fieldday()->engine->getValue('activityTitle', $type, false);
                $sessionDateFrom = date('M d, Y', strtotime($purchasedetail->date->from));
                $sessionDateTo = date('M d', strtotime($purchasedetail->date->to));
                $sessionDateToYear = date('Y', strtotime($purchasedetail->date->to));
                $sessionTimeFrom = $this->parseTime($purchasedetail->time->start);
                $sessionTimeTo =$this->parseTime($purchasedetail->time->end);

            }else {  
                $title = $purchasedetail->packageDetailsWhenPurchased->title;
                $type = __('Credit Purchase', 'fieldday');
                $sessionDateFrom = $sessionDateTo = $sessionDateToYear = $sessionTimeFrom = $sessionTimeTo = " ";
            }
			*/

         ?>

<section class="km_km_order-placed" data-time-stamp-from="<?php echo $purchasedetail->dateTimestamp->from; ?>" data-time-stamp-to="<?php echo $purchasedetail->dateTimestamp->to; ?>">
		<div class="container">
			<div class="km_km_order-placed-wrapper">
				<div class="km_km_order-placed-top">
					<div class="km_km_order-placed-top-left">
						<div class="km_km_order">
							<h1 class="km_km_large-hd">order placed</h1>
							<p class="km_km_order-date"><?php echo $orderCreated_at; ?></p>
						</div>
						<div class="km_km_total">
							<h1 class="km_km_large-hd">total</h1>
							<p class="km_km_order-date"><?php echo $this->display_price($data->payableAmount);?></p>
						</div>
                        <?php if(isset($purchasedetail->kidId) && count($purchasedetail->kidId)>0){ ?>
						<div class="km_km_participants">
							<h1 class="km_km_large-hd">participants</h1>
							<p class="km_km_order-date">
                            <?php  
                                foreach ($purchasedetail->kidId as $key => $kidInfo) { 
                                            if($kidInfo->knownAs) {
                                                echo $kidInfo->knownAs;
                                            }else{
                                                echo $kidInfo->firstName;
                                            }
                                            if($key!=count($purchasedetail->kidId)-1){
                                               echo ', ';
                                            }
                                } 
                            ?>                                
                            </p>
						</div>
                        <?php }  ?>
					</div>
					<div class="km_km_order-placed-top-right">
						<div class="km_km_order-id">
							<h1 class="km_km_large-hd">order-id</h1>
							<p class="km_km_order-date"><?php echo $data->orderNo; ?></p>
						</div>
					</div>
				</div>
				<div class="km_km_order-placed-bottom">
					<div class="km_km_art-camp-left">
						<h1 class="km_km_art-hd"><?php echo $title; ?></h1>
						
							<p class="km_km_order-date km_session_fulldate_order"></p>
							<p class="km_km_order-date km_sess_time_order"></p>
						
							<p class="km_km_order-date"><?php echo $type; ?></p>
					</div>
					<div class="km_km_art-camp-right">
						
						<h1 class="km_km_art-hd km_km_payment-detail-hd">payment-details
							<?php if(isset($purchasedetail->enabledPaymentOptions) && isset($purchasedetail->paymentOptionDetails) && isset($purchasedetail->paymentOptionDetails->payments) && count($purchasedetail->paymentOptionDetails->payments)>0) {  ?>
								<span class="km_km_pending-install">(Installment Plan)</span>
							<?php } ?>
						</h1>
						

						<div class="km_km_art-camp-right-inn-main">
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Total Price</li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date">$<?php echo $data->totalAmount; ?></li>
							</ul>						
							<?php if(isset($purchasedetail->discount) && $purchasedetail->discount>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">discount</li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date">$<?php echo $purchasedetail->discount; ?></li>
							</ul>
							<?php } ?>
							<?php if(isset($purchasedetail->siblingDiscountAmount) && $purchasedetail->siblingDiscountAmount>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">sibling discount</li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date">$<?php echo $purchasedetail->siblingDiscountAmount; ?></li>
							</ul>
							<?php } ?>
							<?php if(isset($purchasedetail->couponDiscount) && $purchasedetail->couponDiscount>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Coupon Discount</li>
								<li class="km_km_order-date"></li>
                                <li class="km_km_order-date">$<?php echo $purchasedetail->couponDiscount; ?></li>                                
							</ul>
							<?php } ?>
							<?php if(isset($purchasedetail->campaignDiscount) && $purchasedetail->campaignDiscount>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Campaign Discount</li>
								<li class="km_km_order-date"></li>
                                <li class="km_km_order-date">$<?php echo $purchasedetail->campaignDiscount; ?></li>                                
							</ul>
							<?php } ?>
							<?php if(isset($purchasedetail->additionalDiscountApplied) && $purchasedetail->additionalDiscountApplied>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Additional Discount</li>
								<li class="km_km_order-date"></li>
                                <li class="km_km_order-date">$<?php echo $purchasedetail->additionalDiscountApplied; ?></li>                                
							</ul>
							<?php } ?>

							<?php if(isset($purchasedetail->extendedCarePrice) && $purchasedetail->extendedCarePrice>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Adons Price</li>
								<li class="km_km_order-date"></li>
                                <li class="km_km_order-date">$<?php echo $purchasedetail->extendedCarePrice; ?></li>                                
							</ul>
							<?php } ?>

							<?php if(isset($data->totalFee) && $data->totalFee>0){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date"><strong>Booking/Credit Card Fee</strong></li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date">$<?php echo $data->totalFee; ?></li>
							</ul>
							<?php } ?>

							<?php if(isset($purchasedetail->enabledPaymentOptions) && isset($purchasedetail->paymentOptionDetails) && isset($purchasedetail->paymentOptionDetails->deposit)){?>
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Deposit</li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date">$<?php echo $purchasedetail->paymentOptionDetails->deposit; ?></li>
							</ul>
							<?php } ?>

							
							<ul class="km_km_art-camp-right-inn">
								<li class="km_km_order-date">Payable Amount</li>
								<li class="km_km_order-date"></li>
								<li class="km_km_order-date"><?php echo $this->display_price($purchasedetail->payableAmount);?></li>
							</ul>
                            <?php if(isset($purchasedetail->enabledPaymentOptions)) {  
                                  if(isset($purchasedetail->paymentOptionDetails) && isset($purchasedetail->paymentOptionDetails->payments) && count($purchasedetail->paymentOptionDetails->payments)>0){
                                  foreach($purchasedetail->paymentOptionDetails->payments as $key=>$value){
                                    $timestamp_inst = new DateTime($value->dateTime);
                                    $formattedDate_inst = $timestamp_inst->format("M d, Y");
                            ?>

                                <ul class="km_km_art-camp-right-inn">
                                    <li class="km_km_order-date">installment-<?php echo $formattedDate_inst; ?></li>
                                    <li class="km_km_order-date">
										<?php  
                                           if($value->isPaid){
                                               if($value->isPaid==true){
												 echo 'Paid';
											   }elseif($value->isPaid==false){
                                                 echo 'failed:'.$value->failureReason;
											   }
										   }else{
											  echo 'Pending';
										   }
										?>

									</li>
                                    <li class="km_km_order-date"><?php echo '$'.$value->deposit; ?></li>
                                </ul>

                            <?php }}} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

           <?php } ?>
        </div>
    <?php } ?>
<?php }else{ ?>
    <div id="km_form_response" class="km_form_response open info"><div class="km_nodata"><?php _e('No data to display.', 'fieldday'); ?></div></div>
<?php }?>
</div>
<div class="km_pagination_main">
    <?php
        $count = 10;
        echo  $this->km_pagination($count, $purchase->extraData->page, $purchase->extraData);
    ?>
</div>
