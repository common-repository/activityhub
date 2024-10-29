<?php 
$kidsprimaryClass ='';
if(isset($_REQUEST['action'])){ 
            $kidsprimaryClass = 'km_primary_bg';            
}
$classes = array('kidsprimaryClass'=>$kidsprimaryClass,'primaryClass'=>'','insuranceprimaryClass'=>'');
?>
<div class="km_register_wrap ">
    <div class="km_row">
        <?php //apply_filters('fieldday_account_top_nav', $this->displayAccountTopNav($classes)); ?>
    </div>  
    <div class="km_row km_error_main">
        <p class="fieldday-message km_alert_error"><?php _e($message, 'fieldday'); ?></p> 
    </div>
</div>
