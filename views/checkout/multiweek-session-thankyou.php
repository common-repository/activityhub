<div class="km_thankyou_page">
        <div class="km_thankyou_page_first_child">
        <h5>Thank you!</h5>
        <div class="km_first_p">
        <div class="km_user_name">
            <p>Thank you for your order, <?php echo $data->data->parentId->name; ?>!</p>
            <p>Order #<?php echo $data->data->orderNo??''; ?></p>
        </div>
        <p >Your registration has been <b>SUCCESSFULLY</b> placed, and your seat(s) <b>CONFIRMED.</b></p>
        <p class="km_border-p">An email receipt has been sent to <b><?php echo $data->data->parentId->email; ?>.</b></p>
       </div>
        <div class="km_partner_name">
           <h4><?php echo $data->data->providerId->name; ?></h4>
           <p><b><?php echo $data->data->parentId->name; ?> -</b> Here is your order Summary</p>
        </div>
        <div class="km_thankyou_page_table" style="overflow-x:auto;">
            <table>
              <tr>
                <th>Items</th>
                <th class="km_thankyou_td_center">Unit Price</th>
                <th class="km_thankyou_td_center">Seats</th>
                <th class="km_thankyou_td_center">Subtotal</th>
              </tr>

              <?php foreach($data->data->details as $key=>$value ){ 
                $siblingDiscountAmount = $siblingDiscountAmount + $value->siblingDiscountAmount;
                $campaignDiscount = $campaignDiscount + $value->campaignDiscount;
                $couponDiscount = $couponDiscount + $value->couponDiscount;
                $kids = $value->kidId;
                $kidsArray = [];
                foreach($kids as $keyKid=>$ValueKid){
                  $kidsArray[] = $ValueKid->firstName;
                }
                $kidsArrayString = implode(', ',$kidsArray);
                $seatsCount = count($kidsArray);
                $type = $value->addedForOneDayOnly?'Drop In':'Full Session';
                ?>
              <tr>
                <td>
                    <p><b><?php echo $value->sessionId->name; ?></b></p>
                    <p><b>Date:</b> <?php echo date('M d Y', strtotime($value->localDateTimestamp->from)) . '-' . date('M d Y', strtotime($value->localDateTimestamp->to)); ?></p>
                    <p><b>Location:</b><?php echo $value->sessionId->siteLocationId->street.' , '.$value->sessionId->siteLocationId->city.', '.$value->sessionId->siteLocationId->state.', '.$value->sessionId->siteLocationId->pin.', '.$value->sessionId->siteLocationId->country; ?></p>
                    <p><b>Additional Purchase:</b> <?php echo fieldday()->engine->display_price($value->extendedCarePrice); ?></p> 
                    <p><b>Participant(s):</b> <?php echo $kidsArrayString; ?></p>
                    <p><b>Siblings Discount:</b><?php echo fieldday()->engine->display_price($value->siblingDiscountAmount); ?></p>
                </td>
                <td><p class="km_thankyou_td_center"><?php echo fieldday()->engine->display_price($value->perPersonPerSessionPrice); ?></p></td>
                <td><p class="km_thankyou_td_center"><?php echo $seatsCount; ?></p></td>
                <td><p class="km_thankyou_td_center"><?php echo fieldday()->engine->display_price($value->totalPrice); ?></p></td>
              </tr>
              <?php } ?>

              <?php if(($siblingDiscountAmount+$campaignDiscount+$couponDiscount)>0){ ?>
              <tr>
                <td>
                  <p><b>Discount</b></p>
                  <p>Siblings Discount:<?php echo fieldday()->engine->display_price($siblingDiscountAmount); ?></p>
                  <p>Campaign Discount:<?php echo fieldday()->engine->display_price($campaignDiscount); ?></p>
                  <p>Coupon Discount :<?php echo fieldday()->engine->display_price($couponDiscount); ?> </p>
                </td>
                <td colspan="3"><p class="km_thankyou_td_right">
                  <?php echo  fieldday()->engine->display_price($siblingDiscountAmount+$campaignDiscount+$couponDiscount);?>
                </p></td>
              </tr>
              <?php } ?> 


              <tr>
                <td><p><b>Credit Applied</b></p></td>
                <td colspan="3"><p class="km_thankyou_td_right"><?php echo fieldday()->engine->display_price($data->data->storeCreditPaid); ?></p></td>
              </tr>
              <tr>
                <td><p><b>Fee</b></p></td>
                <td colspan="3"><p class="km_thankyou_td_right"><?php echo fieldday()->engine->display_price($data->data->totalFee); ?></p></td>
              </tr>
              <tr>
                <td><p><b>Order Total</b></p></td>
                <td colspan="3"><p class="km_thankyou_td_right"><?php echo fieldday()->engine->display_price($data->data->paidAmount); ?></p></td>
              </tr>
            </table>
          </div>
</div>