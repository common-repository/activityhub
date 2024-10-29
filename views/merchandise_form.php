<div class="">
    <form method="post" action="" id="fieldday_merchandise_form" class="fieldday_merchandise_form">
        <?php if (isset($offerid) && !empty($offerid)) {

    $offet_detailed_data = fieldday()->api->getSingleShoppingPackages([], $offerid);
    if (isset($offet_detailed_data->data) && isset($offet_detailed_data->data->image) && isset($offet_detailed_data->data->image->original) && $offet_detailed_data->data->image->original !== '') {
        $offer_image_url = $offet_detailed_data->data->image->original;
    } else {
        $offer_image_url = fieldday_PLACEHOLDER;
    }

    ?>
        <input type="hidden" value="<?php echo $offerid; ?>" name="packageId"/>
        <input type="hidden" value="1" name="purchaseCount"/>
        <input type="hidden" name="paymentMethod" value="card"/>
        <input type="hidden" name="stripeToken" value="" class="merchandise_stripeToken" id="merchandise_stripeToken"/>
      <?php }?>

<?php
if (isset($offerid) && !empty($offerid)) {
    echo '<div class="km_row km_bank_days_km_row">';
} else {
    echo '<div class="km_row">';
}
?>

            <?php if (!$this->isKmLogin()): ?>
              <?php if ($giftcheckout): ?>
                <div class="km_col_6 km_merchandise_user without-login">
                    <div class="km_col_12 km_field_wrap">
                        <fieldset>
                            <label for="card-number"><?php _e('Full Name', 'fieldday');?></label>
                            <input type="text" class="km_input" name="userDetails[name]" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  required=""    oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"  />
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap">
                        <fieldset>
                            <label for="card-number"><?php _e('Email', 'fieldday');?></label>
                            <input type="email" class="km_input" name="userDetails[email]" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  required=""   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true,100);"  />
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap">
                        <fieldset class="">
                            <label for="profile-phone-number"><?php _e('Phone Number', 'fieldday');?></label>
                            <input type="hidden" name="userDetails[countryCode]" class="country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                            <input type="hidden" name="userDetails[phone]" class="phone_number" value="<?php $this->getValue('phone', $KmUser);?>">
                            <input id="parent_phone" name= "recipient_phone" value="<?php $this->getValue('phone', $KmUser);?>" class="km_phone_field km_input"  type="text" required="" data-parsley-required-message="Required"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-group="merchandise_field">
                        </fieldset>
                    </div>
                </div>
              <?php else: ?>
                <?php
if (isset($offerid) && !empty($offerid)) {
    echo '<div class="km_col_8 km_merchandise_user">
                        <div><span class="km_mermbership_title purchase_model"><h3 class="km_primary_color">Billing Details</h3></span></div>
                        ';
} else {
    echo '<div class="km_col_6 km_merchandise_user">';
}
?>
                          <div class="km_col_12 km_field_wrap">
                              <fieldset>
                                  <label for="card-number"><?php _e('Full Name', 'fieldday');?></label>
                                  <input type="text"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"   oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true);"  class="km_input" name="userDetails[name]" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  required="" />
                              </fieldset>
                          </div>
                          <div class="km_col_12 km_field_wrap">
                              <fieldset>
                                  <label for="card-number"><?php _e('Email', 'fieldday');?></label>
                                  <input type="email" class="km_input" name="userDetails[email]" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true,100);"   required="" />
                              </fieldset>
                          </div>
                          <div class="km_col_12 km_field_wrap">
                              <fieldset class="">
                                  <label for="profile-phone-number"><?php _e('Phone Number', 'fieldday');?></label>
                                  <input type="hidden" name="userDetails[countryCode]" class="country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                                  <input type="hidden" name="userDetails[phone]" class="phone_number" value="<?php $this->getValue('phone', $KmUser);?>">
                                  <input id="parent_phone" value="<?php $this->getValue('phone', $KmUser);?>" class="km_phone_field km_input"  type="text" required="" data-parsley-required-message="Required"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-group="merchandise_field">
                              </fieldset>
                          </div>
                      </div>
                <?php endif;?>
            <?php endif;?>

            <?php if (isset($offerid) && !empty($offerid)) {?>
                 <div class="km_col_4 km_first_order_mobile">
                    <img class="km_gift_image" src="<?php echo $offer_image_url; ?>" />
                 </div>
                <div class="<?php echo $this->isKmLogin() ? 'km_col_8' : 'km_col_8'; ?> km_merchandise_card">
            <?php } else {?>
                <div class="<?php echo $this->isKmLogin() ? 'km_col_12' : 'km_col_6'; ?> km_merchandise_card">
            <?php }?>


              <?php if ($giftcheckout || $offerid): ?>
                <span class='km_mermbership_title purchase_model'><h3 class="km_primary_color">Payment Details</h3></span>
              <?php endif;?>


                <?php
if (isset($offerid) && !empty($offerid)) {
    echo '<div class="km_payment_wrap km_bank_days_km_pmnt_wrp">';
} else {
    echo '<div class="km_payment_wrap">';
}
?>





                    <div class="km_col_8 km_field_wrap field_card_number">
                        <fieldset>
                            <label for="card-number"><?php _e('Card Number', 'fieldday');?></label>
                            <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="merchandise_field"  required="" />
                            <div id="card-type2" class="km_card_type"></div>
                        </fieldset>
                    </div>
                    <div class="km_col_4 km_field_wrap field_card_cvv">
                        <fieldset class="">
                            <label for="cvv-code"><?php _e('CVV Code', 'fieldday');?></label>
                                <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="merchandise_field" data-parsley-required-message="Required"  required=""   />
                        </fieldset>
                    </div>
                    <div class="km_col_12 km_field_wrap field_card_holdername">
                        <fieldset>
                            <label for="card-holder-name"><?php _e('Card Holder Name', 'fieldday');?></label>
                            <input type="text" id="card-holder-name"  pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  class="km_card_holder km_input" data-parsley-required-message="Required" oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,true,1000);"   data-parsley-group="merchandise_field" required="" />
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp">
                        <fieldset>
                            <label><?php _e('Exp.Month', 'fieldday');?></label>
                            <div class="km_custom_dropdown">
                                <select id='expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="merchandise_field" required="" >
                                    <option value='' selected>Select</option>
                                    <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                                        <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp_year">
                        <fieldset>
                            <label><?php _e('Exp.Year', 'fieldday');?></label>
                            <div class="km_custom_dropdown">
                                <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="merchandise_field" data-parsley-required-message="Required"  required=""  >
                                    <option value=''>Select</option>
                                    <?php
for ($i = date('Y'); $i <= date('Y') + 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="km_col_12">
                      <div class="km_term_condition">
                        <label class='km_checkbox_wrap'>
                            <span><?php print wp_sprintf("%s <a class='km_provider_terms_display' href=''>%s</a>", __("I've read and accept the", 'fieldday'), __("terms & conditions", 'fieldday'));?></span>
                            <input required="required" name="km_terms_condition" data-parsley-required-message="Please accept terms & conditions" data-parsley-group="merchandise_field" type="checkbox" class="km_provider_terms km_checkboxteam" required="required">
                            <span class="km_checkbox"></span>
                        </label>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
