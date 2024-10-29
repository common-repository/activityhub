<form id="km_card_form">
    <div class="km_payment_wrap">
        <div class="km_col_8 km_field_wrap field_card_number">
            <input type="hidden" name="stripeToken" id="_stripeToken">
            <label for="km_card_number"><?php _e('Card Number', 'fieldday');?></label>
            <input type="text" maxlength="20" class="km_card_number km_input" id="km_card_number" data-stripe="number" data-parsley-required-message="Required" data-parsley-group="add_new_card"  required="" />
            <div class="km_card_type"></div>
        </div>
        <div class="km_col_4 km_field_wrap field_card_cvv">
            <label for="km_cvv_code"><?php _e('CVV Code', 'fieldday');?></label>
            <input type="text"  id="km_card_cvc" maxlength="4" class="km_card_cvc km_input" data-stripe="cvc" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" data-parsley-group="add_new_card" data-parsley-required-message="Required"  required=""   />
        </div>
        <div class="km_col_12 km_field_wrap field_card_holdername">
            <label for="km_card_holder_name"><?php _e('Card Holder Name', 'fieldday');?></label>
            <input type="text" oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"  id="card-holder-name" class="km_card_holder km_input" data-parsley-required-message="Required"  data-parsley-group="add_new_card" required="" />
        </div>
        <div class="km_col_6 km_field_wrap field_card_exp">
            <label><?php _e('Exp.Month', 'fieldday');?></label>
            <div class="km_custom_dropdown">
                <select id='km_expireMM' class= "km_card_expiry_month km_input" data-stripe="exp-month"  data-parsley-required-message="Required" data-parsley-group="add_new_card" required="" >
                    <option value='' selected>Select</option>
                    <?php foreach ($this->KmMonths() as $number => $monthName): ?>
                        <option value="<?php echo $number; ?>"><?php echo $monthName; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="km_col_6 km_field_wrap field_card_exp_year">
            <label><?php _e('Exp.Year', 'fieldday');?></label>
            <div class="km_custom_dropdown">
                <select class="km_card_expiry_year km_input" data-stripe="exp-year" data-parsley-group="add_new_card" data-parsley-required-message="Required"  required=""  >
                    <option value=''>Select</option>
                    <?php
for ($i = date('Y'); $i <= date('Y') + 30; $i++) {
    echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
                </select>
            </div>
        </div>
        <div class="km_col_6 km_field_wrap field_card_exp_year">
            <label class='km_checkbox_wrap'>
                <span><?php _e("Set as Default")?></span>
                <input name="isDefault" value="true" checked="true"  type="checkbox" class="km_provider_terms km_checkboxteam">
                <span class="km_checkbox"></span>
            </label>
        </div>
    </div>
</form>
