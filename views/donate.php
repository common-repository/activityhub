<?php global $KmUser;?>
<div id="km_donation_wrap" class="km_donate_wrap">
    <form id="km_donation_wrap"  class="km_donation_form">
        <h3 class="km_donateus_title"><?php _e($title, 'fieldday');?></h3>
        <p class="km_donate_description"><?php _e($description, 'fieldday');?></p>
        <div class="<?php echo $layout_class == 'km_col_6' ? 'km_row' : 'km_row_column'; ?>">
            <div class="km_column_wrap km_payment_column <?php echo $layout_class; ?>">
                <h3 class="km_heading km_primary_color km_col_12"><?php _e('Billing Details', 'fieldday');?></h3>
                <input type="hidden" name="donationData[eventName]" value="<?php _e($title, 'fieldday');?>"/>
                <input type="hidden" name="donationData[description]" value="<?php _e($description, 'fieldday');?>"/>
                <input type="hidden" name="donationData[stripeToken]" class="stripe_token" value="null">
                <input type="hidden" name="success_message" value="<?php echo $success_message; ?>">
                <div class="km_col_6 km_field_wrap">
                    <fieldset>
                        <label for="km_donar_fname"><?php _e('First Name', 'fieldday');?></label>
                        <input type="text"  data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."  name="donationData[userDetails][firstName]" value="<?php echo $this->getValue('name', $KmUser, false) ? $this->getValue('name', $KmUser, false) : ""; ?>" class="km_input" id="km_donar_fname" data-parsley-required-message="Required" data-parsley-group="km_donate" required="" />
                    </fieldset>
                </div>
                <div class="km_col_6 km_field_wrap">
                    <fieldset>
                        <label for="km_donar_lname"><?php _e('Last Name', 'fieldday');?></label>
                        <input type="text"  data-parsley-type="alphanum" data-parsley-trigger="keyup" data-parsley-type-message="No special character allowed."  class="km_input" name="donationData[userDetails][lastName]" id="km_donar_lname" data-parsley-group="km_donate"/>
                    </fieldset>
                </div>
                <div class="km_col_6 km_field_wrap">
                    <fieldset>
                        <label for="km_donar_lname"><?php _e('Email', 'fieldday');?></label>
                        <input type="email"  data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-type-message="Invalid Email"  name="donationData[userDetails][email]" value="<?php echo $this->getValue('email', $KmUser, false) ? $this->getValue('email', $KmUser, false) : ""; ?>" class="km_input" id="km_donar_lname" data-parsley-required-message="Required" data-parsley-group="km_donate" required="" />
                    </fieldset>
                </div>
                <div class="km_col_6 km_field_wrap">
                    <fieldset class="">
                        <label for="profile-phone-number"><?php _e('Phone Number', 'fieldday');?></label>
                        <input type="hidden" name="donationData[userDetails][countryCode]" class="country_code" value="<?php echo $kmGetCountryDialCode = fieldday()->engine->kmGetCountryDialCode(); ?>">
                        <input type="hidden" name="donationData[userDetails][phone]" class="phone_number" value="<?php $this->getValue('phone', $KmUser);?>">
                        <input id="parent_phone" value="<?php $this->getValue('phone', $KmUser);?>" data-parsley-group="km_donate" class="km_phone_field km_input" data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-required-message="Required"  required="" type="tel">
                    </fieldset>
                </div>
                <div class="km_col_6 km_field_wrap">
                    <fieldset>
                        <label for="km_donar_lname"><?php _e('Amount', 'fieldday');?></label>
                        <input type="number" min="1" name="donationData[amount]" class="km_input" id="km_donar_lname" data-parsley-required-message="Required" data-parsley-group="km_donate" required="" />
                    </fieldset>
                </div>
            </div>
            <div class="km_column_wrap km_payment_column <?php echo $layout_class; ?>">
                <h3 class="km_heading km_primary_color km_col_12"><?php _e('Payment Details', 'fieldday');?></h3>
                <div class="km_payment_wrap">
                    <div class="km_col_8 km_field_wrap field_card_number">
                        <fieldset>
                            <label for="km_card_number"><?php _e('Card Number', 'fieldday');?></label>
                            <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="km_donate"  required="" />
                            <div class="km_card_type"></div>
                        </fieldset>
                    </div>
                    <div class="km_col_4 km_field_wrap field_card_cvv">
                        <fieldset class="">
                            <label for="km_cvv_code"><?php _e('CVV Code', 'fieldday');?></label>
                            <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="km_donate" data-parsley-required-message="Required"  required=""   />
                        </fieldset>
                    </div>
                    <div class="km_col_12 km_field_wrap field_card_holdername">
                        <fieldset>
                            <label for="km_card_holder_name"><?php _e('Card Holder Name', 'fieldday');?></label>
                            <input type="text"      oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false,1000);"   pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="km_donate" required="" />
                        </fieldset>
                    </div>
                    <div class="km_col_6 km_field_wrap field_card_exp">
                        <fieldset>
                            <label><?php _e('Exp.Month', 'fieldday');?></label>
                            <div class="km_custom_dropdown">
                                <select id='km_expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="km_donate" required="" >
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
                                <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="km_donate" data-parsley-required-message="Required"  required=""  >
                                    <option value=''>Select</option>
                                    <?php
for ($i = date('Y'); $i <= date('Y') + 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="km_col_12 km_field_wrap km_text_center">
            <fieldset>
                <?php fieldday()->engine->googleRecaptcha();?>
            </fieldset>
        </div>
        <div class="km_btn_wrap km_padding_30">
            <input type="submit" onclick="return fieldday.submitDonation(this, event);" class="km_btn km_primary_bg" value="<?php _e("Donate");?>">
        </div>
    </form>
</div>