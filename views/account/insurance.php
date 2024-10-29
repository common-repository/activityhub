<?php 
$hasDentalInsurance = $this->getValue('isAvailable', $dentalInsurance, false);
$hasmedInsurance = $this->getValue('isAvailable', $medInsurance, false);
$insuranceprimaryClass ='';
if(isset($_REQUEST['action'])){ 
            $insuranceprimaryClass = 'km_primary_bg';            
}
$classes = array('kidsprimaryClass'=>'','primaryClass'=>'','insuranceprimaryClass'=>$insuranceprimaryClass);
?>
<div class="km_register_wrap ">
    <?php //apply_filters('fieldday_account_top_nav', $this->displayAccountTopNav($classes)); ?> 
    <div class="km_row" id="accountInfo">
        <div class="km_row">
            <form id="parent_insurance_form" method="post" action="">
                <div class="km_row km_tab_data km_profile_content">
                    <div class="km_col_6">
                        <h4><?php _e('Medical Insurance', 'fieldday'); ?></h4>
                        <div id="" class="km_medical_form_wrap" data-dental-insurance="available">
                            <input name="insurance[medInsurance][isAvailable]" type="checkbox" checked="" class="km_hidden">
                            <div class="km_col_12 km_field_wrap">
                                <fieldset class="">
                                    <label for="dentalInsuranceSubscriberName"><?php _e('Subscriber Name', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" type="text" name="insurance[medInsurance][subscribersName]" value="<?php $this->getValue('subscribersName', $medInsurance); ?>" id="dentalInsuranceSubscriberName"  data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>
                            <div class="km_col_6 km_field_wrap">
                                <fieldset class="">
                                    <label for="dentalInsuranceGroupNo"><?php _e('Group Number', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" type="text" name="insurance[medInsurance][groupNo]" value="<?php $this->getValue('groupNo', $medInsurance); ?>" id="dentalInsuranceGroupNo" data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>
                            <div class="km_col_6 km_field_wrap">
                                <fieldset class="">
                                    <label for="dentalInsurancePolicyNo"><?php _e('Policy Number', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" type="text" name="insurance[medInsurance][policyNo]" value="<?php $this->getValue('policyNo', $medInsurance); ?>" id="dentalInsurancePolicyNo" data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="km_col_6">
                        <h4><?php _e('Dental Insurance', 'fieldday'); ?></h4>
                        <div id="" class="km_medical_form_wrap" data-medical-insurance="available">
                            <input name="insurance[dentalInsurance][isAvailable]" type="checkbox" checked="" class="km_hidden">
                            <div class="km_col_12 km_field_wrap">
                                <fieldset class="">
                                    <label for="medicalInsuranceSubscriberName"><?php _e('Subscriber Name', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" value="<?php $this->getValue('subscribersName', $dentalInsurance); ?>" type="text" name="insurance[dentalInsurance][subscribersName]" id="medicalInsuranceSubscriberName" data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>
                            <div class="km_col_6 km_field_wrap">
                                <fieldset class="">
                                    <label for="medicalInsuranceGroupNo"><?php _e('Group Number', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" type="text" value="<?php $this->getValue('groupNo', $dentalInsurance); ?>" name="insurance[dentalInsurance][groupNo]" id="medicalInsuranceGroupNo" data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>
                            <div class="km_col_6 km_field_wrap">
                                <fieldset class="">
                                    <label for="medicalInsurancePolicyNo"><?php _e('Policy Number', 'fieldday'); ?></label>
                                    <input class="km_input" data-parsley-group="parent_insurance_form" type="text" value="<?php $this->getValue('policyNo', $dentalInsurance); ?>" name="insurance[dentalInsurance][policyNo]" id="medicalInsurancePolicyNo" data-parsley-required-message="Required" required=""/>
                                </fieldset>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="km_col_12 km_field_wrap km_btn_wrap">                       
                    <a href="#" id="km_update_insurance" class="km_btn km_primary_bg km_update_insurance"><?php _e('Save', 'fieldday'); ?></a>                    
                </div>
            </form>  
        </div>
    </div>
</div>