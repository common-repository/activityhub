<?php
$singleGiftOptions = fieldday()->api->getProviderSingleGiftCard($giftCardId);
?>
 <div class='km_giftcard_wrap'>
     <div class="km_featured_giftcard_content">
       <div class="km_single_giftcard km_row">
           <div class="km_gift_preview km_col_4">
                 <div class="km_gift_perview_container">
                   <div class="km_giftimgecontainer">
                      <img class="km_gift_image"  data-giftCardId ="<?php echo $singleGiftOptions->data->_id; ?>"
                       src="<?php echo $singleGiftOptions->data->images['0']->original; ?>" data-original="<?php echo $giftCard->images['0']->original; ?>"/>
                   </div>
                  <div class="km_row km_giftlogo_content">
                        <?php if ($companyImg) {?>
                          <div class="km_gift_logo km_col_6">
                              <img src="<?php echo $companyImg; ?>" />
                          </div>
                          <div  class="km_gift_price km_col_6">
                              <span class="giftcardprice">
                               <?php echo fieldday()->engine->display_price($amonunts['0']); ?>
                              </span>
                          </div>
                        <?php } else { ?>
                          <div  class="km_gift_price km_col_12" style="text-align:center;">
                                <span class="giftcardprice">
                                  <?php echo fieldday()->engine->display_price($amonunts['0']); ?></span>
                          </div>
                         <?php } ?>

                  </div>
                  <hr aria-hidden="true" class="a-spacing-none a-divider-normal gc-live-preview-divider">
                  <div class="km_giftcardmsgcontainer">
                      <span id="giftcardmsg"></span>
                  </div>
               </div>
            </div>
           <div class="km_giftcard_content km_col_8">
               <h3 class="km_giftcard_title_single">
                 <?php //echo $singleGiftOptions->data->title; ?>
               </h3>
               <div class="km_content_wrap_single">
                   <h6 class="km_gift_seaction_head km_primary_color">Select a style for your Gift Card<span class="km_asterisk">*</span></h6>
                   <div class="km_gift_designs">
                       <?php
                    foreach ($singleGiftOptions->data->images as $giftCardThumb) {
                        $selectedCartItem = '';
                        if ($singleGiftOptions->data->images['0']->original === $giftCardThumb->original) {
                            $selectedCartItem = "selectedCartItem";
                        } ?>
                   <div class="km_single_giftdesign <?php echo $selectedCartItem; ?>">
                   <img alt="Festive greetings"  src="<?php echo $giftCardThumb->thumbnail; ?>" id="gc-mini-picker-design-swatch-image-1" height="60" width="80" data-original="<?php echo $giftCardThumb->original; ?>">
                 </div><?php } ?>
               </div>
                   <h6 class="km_gift_seaction_head km_primary_color">Enter your Gift Card details<span class="km_asterisk">*</span></h6>
                   <div class="km_gift_purchase_form">
                           <div class="km_gift_frm_field">
                                 <label>Choose an amount<span class="km_asterisk">*</span></label>
                                 <div class="km_gift_values_wrap">
                                    <?php
                                    foreach ($amonunts as $key => $value) {
                                        $selectedCartItem = '';
                                        if ($amonunts['0'] === $value) {
                                            $selectedCartItem = "selectedCartItem km_primary_border";
                                        }?>                                      
                                   <span class="km_gift_value <?php echo $selectedCartItem; ?>">
                                      <?php echo fieldday()->engine->display_price($value); ?>
                                    </span>
                                    <?php } ?>
                                  <span  class="km_gift_value <?php echo $selectedCartItem; ?>">
                                   <input type="text" value="" id="km_gift_custom_amount"  min='1' max="2000" autocomplete="off" class="a-input-text km_gift_custom_amount" placeholder="Other amount">
                                   </span>
                                   <input type="hidden" name="km_gift_custom_amount" value="<?php echo $selectedCartItem; ?>">
                                   <div class="a-alert-content"></div>
                                </div>
                                <div class="km_gifthowtosendsection">
                                    <h6 class="km_gift_seaction_head km_primary_color">How would you like to send it?<span class="km_asterisk">*</span></h6>
                                    <div class="km_giftsendoption">
                                        <div class="">
                                          <span class="km_sendoption_value selectedCartItem km_primary_border">Email</span>
                                          <!-- <span><input type="radio" name="email"></span> -->
                                          <span class="km_sendoption_value">Text Message + Email</span>
                                          <!-- <span><input type="radio" name="text"></span> -->
                                        </div>
                                    </div>
                                  </div>
                                  <form id="giftCardForm">
                                    <div class="km_gifthowtosendsection">
                                        <h6 class="km_gift_seaction_head km_primary_color">Who is this gift card for?<span class="km_asterisk">*</span></h6>
                                          <div class="km_giftrecipientoption">
                                              <div class="km-gift-card-input">
                                                <span><input type="text"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"   pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  name="recipientname" placeholder="Recipient name"></span>
                                              </div>
                                              <div class="km-gift-card-input km_field_wrap km_field_wrap_zero_padding">
                                                    <span id="email">
                                                      <input type="email" name="recipient_email"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,10);" placeholder="Recipient email">
                                                      <span  style="display:none;" class="km-gift-recipentent-email-error invalid-form-error-message filled">Enter a valid email format.</span>
                                                    </span>
                                                  <span id="phone_number" class="km_phone_input" style="display:none;">


                                                  <input type="hidden" name="parent_phone_gift_code" class="country_code user_country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                                                  <input type="hidden" name="parent_phone_gift_org_number" class="phone_number" value="<?php $this->getValue('phone', $KmUser);?>">
                                                    <input  type="tel"  id="parent_phone_gift"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="recipient_phone" class="km_phone_field km_input" placeholder="Recipient mobile phone number"></span>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="km_gifthowtosendsection">
                                        <h6 class="km_gift_seaction_head km_primary_color">Add a custom message<span class="km_asterisk">*</span></h6>
                                          <div class="km_giftrecipientoption">
                                              <div class="km-gift-card-input">
                                                <textarea id="giftmsg"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"   name="usergiftmsg" rows="4" cols="50" placeholder="">Hope you enjoy this Gift Card!</textarea>

                                              </div>
                                              <p class="invalid-form-error-message filled">No special character allowed.</p>


                                          </div>
                                    </div>
                                    <div class="km_gifthowtosendsection">
                                        <h6 class="km_gift_seaction_head km_primary_color">Who's it from ?<span class="km_asterisk">*</span></h6>
                                          <div class="km_giftrecipientoption">
                                              <div class="km-gift-card-input">
                                                <span>
                                                  <input type="text" pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  name="sender_name" placeholder="Sender Name" oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"  >
                                                </span>
                                              </div>
                                          </div>
                                    </div>
                                  </form>
                                  <!--div class="km_gifthowtosendsection">
                                      <h6 class="km_gift_seaction_head">When should  we send the gift card?</h6>
                                        <div class="km_giftrecipientoption">
                                            <div class="">
                                              <span><input type="date" name="send_date" placeholder="Sender Name"></span>
                                            </div>
                                        </div>
                                  </div-->

                                </div>
                                <div id="verifygiftcardform" class="purchasebutton_container">
                                  <a href="javascript:void(0);" class="km_btn km_add_to_cart_giftCard km_primary_bg">Purchase</a>
                               </div>
                          </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
 <div>
