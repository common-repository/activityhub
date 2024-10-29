<div class="field_wrapper">
    <?php $doctor_address = $this->getvalue('address', $doctor_info, false);?>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="doctorName<?php echo $kidNumber; ?>"><?php _e('Name', 'fieldday');?></label>
            <input class="km_input" type="text" value="<?php $this->getvalue('name', $doctor_info);?>" data-parsley-group="kidsDoctors_<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][doctors][name]" id="doctorName<?php echo $kidNumber; ?>" data-parsley-required-message="Required"  required=""/>
        </fieldset>
    </div>
    <div class="km_col_4 km_field_wrap">
        <fieldset class="">
            <label for="doctorPhone<?php echo $kidNumber; ?>"><?php _e('Phone', 'fieldday');?></label>
            <!--<input type="hidden" name="kids[<?php //echo $kidNumber; ?>][forms][doctors][countryCode]" class="country_code" value="1"> -->
            <input type="hidden" name="kids[<?php echo $kidNumber; ?>][forms][doctors][phone]" class="phone_number" value="<?php $this->getvalue('phone', $doctor_info);?>">
            <input class="km_input km_phone_field" type="text" value="<?php $this->getvalue('phone', $doctor_info);?>"  data-parsley-minlength-message="Phone should contain 10 characters" data-parsley-group="kidsDoctors_<?php echo $kidNumber; ?>"  id="doctorPhone<?php echo $kidNumber; ?>" data-parsley-required-message="Required"  required=""/>
        </fieldset>
    </div>
    <div class="km_col_4 km_field_wrap km_doctor_address">
     <!--    <label for="doctorStreet<?php echo $kidNumber; ?>"><?php _e('Address', 'fieldday');?></label>
        <input type="text" class="km_input km_addr_city" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][street]" id="doctorStreet<?php echo $kidNumber; ?>" data-parsley-required-message="Required" data-parsley-group="kidsDoctors_<?php echo $kidNumber; ?>" required=""/> -->
        <fieldset class="">
            <label for="doctorStreet<?php echo $kidNumber; ?>"><?php _e('Address', 'fieldday');?></label>
            <input class="km_input kmdoctorStreet" type="text" value="<?php $this->getvalue('street', $doctor_address);?>" data-parsley-group="kidsDoctors_<?php echo $kidNumber; ?>" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][street]" id="doctorStreet<?php echo $kidNumber; ?>" data-parsley-required-message="Required"  required=""/>
        </fieldset>
    <input class="km_input kmdoctorpin" type="hidden" value="<?php $this->getvalue('pin', $doctor_address);?>" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][pin]" id="doctorPin<?php echo $kidNumber; ?>"/>
    <input class="km_input kmdoctorState" type="hidden" value="<?php $this->getvalue('state', $doctor_address);?>" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][state]" id="doctorState<?php echo $kidNumber; ?>">
    <input class="km_input kmdoctorCity" type="hidden" value="<?php $this->getvalue('city', $doctor_address);?>" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][city]" id="doctorCity<?php echo $kidNumber; ?>">
    </div>

    <div class="km_col_4 km_field_wrap">
        <input type="hidden" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][country]" value="US" />
        <input type="hidden" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][landmark]" value="none" />
        <input type="hidden" name="kids[<?php echo $kidNumber; ?>][forms][doctors][address][location]" value="[0,0]" />

    </div>
</div>