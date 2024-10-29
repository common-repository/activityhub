<?php
$hasmedInsurance = ($this->getValue('medicalInsurance', $kid_data, false)) ? $this->getValue('isAvailable', $kid_data->medicalInsurance, false) : false;
?>
<div id="<?php echo $wrapperId; ?>" class="km_medical_form_wrap" data-medical-insurance="available">

    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="medicalInsuranceSubscriberName"><?php _e('Subscriber Name', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasmedInsurance) ? $this->getValue('subscribersName', $kid_data->medicalInsurance) : '';?>" data-parsley-group="kidsMedicalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][medicalInsurance][subscribersName]" id="medicalInsuranceSubscriberName" data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="medicalInsuranceGroupNo"><?php _e('Group Number', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasmedInsurance) ? $this->getValue('groupNo', $kid_data->medicalInsurance) : '';?>" data-parsley-group="kidsMedicalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][medicalInsurance][groupNo]" id="medicalInsuranceGroupNo" data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>


    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="medicalInsuranceGroupNo"><?php _e('Policy Number', 'fieldday');?></label>
            <input class="km_input" value="<?php ($hasmedInsurance) ? $this->getValue('policyNo', $kid_data->medicalInsurance) : '';?>" data-parsley-group="kidsMedicalInsurances_<?php echo $kidNumber; ?>" type="text" name="kids[<?php echo $kidNumber; ?>][forms][medicalInsurance][policyNo]" id="medicalInsurancePolicyNo" data-parsley-required-message="Required" required=""/>
        </fieldset>
    </div>

</div>