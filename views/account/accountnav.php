<?php 
$kidData = fieldday()->api->GetKids();
$kids = $kidData->data;
if($kids){
    $link = add_query_arg(['action' => 'insurance', 'id' => null]);
    $class = '';
}else{
    $link = 'javascript:;';
    $class = 'disabled';
}
?>
<div class="km_row km_profile_header">
    <div class="km_col_4 km_profile_nav_active" id="myAccount">
        <a href="<?php echo add_query_arg( ['action' => 'myaccount', 'id' => null]);?>" class=" <?php echo $data['primaryClass']; ?>">
            <i class="fa fa-cog TabsIcon" aria-hidden="true"></i>
            <span class="km_setting_icon"><?php _e('My Account', 'fieldday'); ?></span>
        </a>
    </div>

    <div class="km_col_4" id="kidInformation">
        <a href="<?php echo add_query_arg(['action' => 'kidsinfo', 'id' => null]);?>" class="<?php echo $data['kidsprimaryClass']; ?>">
            <i class="fa fa-meh-o TabsIcon" aria-hidden="true"></i> <span class="km_kids_icon"><?php _e('Kid Information', 'fieldday'); ?></span>
        </a>
    </div>
    <div class="km_col_4" id="persionInsurance">
        <a href="<?php echo $link; ?>" class="<?php echo $class." ".$data['insuranceprimaryClass']; ?>">
            <i class="fa fa-newspaper-o TabsIcon" aria-hidden="true"></i>
            <span class="km_insurance_icon"><?php _e('Insurance', 'fieldday'); ?></span>
        </a>
    </div>          
</div>