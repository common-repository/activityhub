<h3><?php echo $this->MedicalFormLable('kidsDoctors'); ?></h3>
<form class="km_kids_forms km_kids_doctor_form" id="km_profile_kids_form" action="" method="post">
    <input type="hidden" value="<?php echo $kidId; ?>" name="kidId">
    <div class="field_wrapper">
        <?php $doctor_address = $this->getvalue('address', $doctor_info, false);?>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorName"><?php _e('Name', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('name', $doctor_info);?>" data-parsley-group="kids_forms_field" name="forms[doctors][name]" id="kids_doctors_field_Name" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap km_doctors_form_mobile_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorPhone"><?php _e('Phone', 'fieldday');?></label>
                <!--<input type="hidden" name="forms[doctors][countryCode]" class="country_code" value="1"> -->
                <input type="hidden" name="forms[doctors][phone]" class="phone_number" value="<?php $this->getvalue('phone', $doctor_info);?>">
                <input class="km_input km_phone_field" type="text" value="<?php $this->getvalue('phone', $doctor_info);?>" data-parsley-group="kids_forms_field"  id="kids_doctors_field_Phone"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorStreet"><?php _e('Street', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('street', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][street]" id="kids_doctors_field_street" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorState"><?php _e('State', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('state', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][state]" id="kids_doctors_field_State" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorCity"><?php _e('City', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('city', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][city]" id="kids_doctors_field_City" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorPin"><?php _e('Zip', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('pin', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][pin]" id="kids_doctors_field_Pin" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorPin"><?php _e('Country', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('country', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][country]" id="kids_doctors_field_country" data-parsley-required-message="Required"  required=""/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_pos_relative">
                <label for="doctorPin"><?php _e('Landmark', 'fieldday');?></label>
                <input class="km_input" type="text" value="<?php $this->getvalue('landmark', $doctor_address);?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][landmark]" id="kids_doctors_field_landmark"/>
            </fieldset>
        </div>
        <div class="km_col_4 km_field_wrap">
            <fieldset class="km_hidden km_pos_relative">
                <label for="doctorPin"><?php _e('Location', 'fieldday');?></label>
                <?php $location = $this->getvalue('location', $doctor_address, false);?>
                <div class="km_row">
                    <div class="km_col_6 km_long">
                        <input class="km_input" type="text" id="km_doc_lat" value="<?php echo ($this->getvalue('0', $location)) ? $this->getvalue('0', $location) : '0'; ?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][location][0]" id="kids_doctors_field_location_0"/ >
                    </div>
                    <div class="km_col_6 km_lat">
                        <input class="km_input" type="text" id="km_doc_long" value="<?php echo ($this->getvalue('1', $location)) ? $this->getvalue('1', $location) : '0'; ?>" data-parsley-group="kids_forms_field" name="forms[doctors][address][location][1]" id="kids_doctors_field_location_1"/>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="km_col_12 km_btn_wrap">
            <a class="km_btn km_save_kidform km_btn_primary km_primary_bg"><?php _e('Save', 'fieldday');?></a>
        </div>
    </div>
</form>