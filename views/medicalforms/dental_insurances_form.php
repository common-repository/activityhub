<?php
$hasdentalInsurance = ($this->getValue('dentalInsurance', $kid_data, false)) ? $this->getValue('isAvailable', $kid_data->dentalInsurance, false) : false;
?>
<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-dental-insurance="available">
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="dentalInsuranceSubscriberName"><?php _e('Subscriber Name', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasdentalInsurance) ? $this->getValue('subscribersName', $kid_data->dentalInsurance) : '';?>" data-parsley-group="kidsDentalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][dentalInsurance][subscribersName]" id="dentalInsuranceSubscriberName" data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="dentalInsuranceGroupNo"><?php _e('Group Number', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasdentalInsurance) ? $this->getValue('groupNo', $kid_data->dentalInsurance) : '';?>" data-parsley-group="kidsDentalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][dentalInsurance][groupNo]" id="dentalInsuranceGroupNo"  data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="dentalInsurancePolicyNo"><?php _e('Policy Number', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasdentalInsurance) ? $this->getValue('policyNo', $kid_data->dentalInsurance) : '';?>" data-parsley-group="kidsDentalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][dentalInsurance][policyNo]" id="dentalInsurancePolicyNo"  data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>
</div>