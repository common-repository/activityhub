<div id="<?php echo $step['name']; ?>" class="<?php echo $step['classes']; ?>">
    <h2 class="km_progress_header km_primary_color"><?php echo $step['label']; ?></h2>
    <span class="km_participant_form_text"><?php print apply_filters('km_participant_form_text', __("Following Forms Are Required To Complete The Registration.", 'fieldday')); ?></span>
    <span class="km_participant_form_notrequired_text km_hidden"><?php print apply_filters('km_participant_form_notrequired_text', __("NO Forms Are Required To Complete The Registration.", 'fieldday')); ?></span>
    <div class="km_kids_form_wrap" id="km_kids_form_wrap">
        <?php foreach ($this->getUniqueKids() as $kidNumber => $kidinfo) :
            
        ?>
            <?php $kid = $kidinfo['kidInfo']; $kidForms = $kidinfo['forms']; $kidData = $this->getSingleKid($kid['_id']);
            ?>
            <?php if($this->isParticipantFormRequired($kidForms)): ?>
                <div class="single_kid_info">
                    <h4><b><?php echo $kid['firstName']; ?></b></h4>
                    <div class="button-area">
                        <input type="hidden" name="update_kid_info[<?php echo $kid['_id']; ?>]" id="update_kid_info_<?php echo $kid['_id']; ?>" value="false"/>
                        <?php $formrequired = false; 
                        //print_r($kidForms);
                        ?>
                        <?php foreach ($kidForms as $key => $value) :  ?>
                            <?php if($value === true) : $formrequired = true; ?>
                                <?php
                                $modalId = wp_sprintf('km_modal_%s_%s', $key, $kid['_id']);
                                $validFormClass = $this->getKidFormData($key, $kidData) ? "Form_Success km_primary_border" : 'Form_Error'; ?>
                                <div class='_single_kid_form'>
                                    <div data-kid-id="<?php echo $kid['_id']; ?>" href="#" class="fieldday_form_button open_km_modal <?php echo $validFormClass; ?>" data-target="#<?php echo $modalId; ?>">
                                        <i class="fa fa-check-square FaCheckIcon km_primary_color" aria-hidden="true"></i>
                                        <i class="fa fa-window-close FaCloseIcon" aria-hidden="true"></i>
                                        <img src="<?php print wp_sprintf('%s/assets/img/icon/icon_%s.png', fieldday_URL, $key); ?>" />
                                        <span class="km_primary_color"><?php echo $this->MedicalFormLable($key); ?></span>
                                    </div>
                                    <?php echo $this->kid_formpopup($kidData, $key, $kidNumber, $modalId); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="km_btn_wrap">
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_color  km_transparent_bg" onclick="return fieldday.PrevStep();"><?php $this->displayText('atc_prev_btn'); ?></a>
        <a href="javascript:void(0);" class="km_next_step km_btn km_primary_bg" data-group="block-kid_information" onclick="return fieldday.process_kid_info(this, event);"><?php $this->displayText('atc_next_btn'); ?></a>
    </div>
</div>
