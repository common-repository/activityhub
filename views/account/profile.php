<?php
$primaryClass = 'km_primary_bg';
$classes = array('kidsprimaryClass' => '', 'primaryClass' => $primaryClass, 'insuranceprimaryClass' => '');
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'kidsinfo') {
    $classes = array('kidsprimaryClass' => $kidsprimaryClass, 'primaryClass' => '', 'insuranceprimaryClass' => '');
}
?>
<div class="km_register_wrap km_my_acnt_km_register_wrap">
    <div class="km_my_account_slidefilter_btn" style="display:none;">
    <a class="km_btn km_primary_bg"><svg class="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512" style="fill: #fff;"><path d="M0 416c0-17.7 14.3-32 32-32l54.7 0c12.3-28.3 40.5-48 73.3-48s61 19.7 73.3 48L480 384c17.7 0 32 14.3 32 32s-14.3 32-32 32l-246.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 448c-17.7 0-32-14.3-32-32zm192 0c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32zM384 256c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32zm-32-80c32.8 0 61 19.7 73.3 48l54.7 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-54.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l246.7 0c12.3-28.3 40.5-48 73.3-48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32s-14.3-32-32-32zm73.3 0L480 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-214.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 128C14.3 128 0 113.7 0 96S14.3 64 32 64l86.7 0C131 35.7 159.2 16 192 16s61 19.7 73.3 48z"></path></svg><span class="km_Dashboard">Dashboard</span></a>
    </div>
    <?php //apply_filters('fieldday_account_top_nav', $this->displayAccountTopNav($classes)); ?>
    <?php echo apply_filters('fieldday_before_account_text', $this->fieldday_before_account_text()); ?>
    <div class="km_row" id="accountInfo">
        <div class="km_row  km_view_all_prctpants_pg_ctm_new">
            <div class="km_col_2 km_profile_sidebar">
                <a href="#" id="_profile" class="km_personal_info km_nav_link km_active km_primary_color" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/personal_info.png"/>
                    <?php _e('Personal Info', 'fieldday');?>
                </a>
                <a  href="<?php echo add_query_arg(['action' => 'kidsinfo', 'id' => null]); ?>" class="km_my_purchase km_nav_link">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/participants.png"/>
                    <?php _e('My Participants', 'fieldday');?>
                </a>
                <a href="#" id="purchase" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/cart.png"/>
                    <?php _e('My Purchase', 'fieldday');?>
                </a>
                <!--a href="#" id="membership" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php //echo fieldday_URL; ?>/assets/img/members.svg"/>
                    <?php //_e('My Membership', 'fieldday'); ?>
                </a-->
                <a href="#" id="tax_detail" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/tax.png"/>
                    <?php _e('Tax Detail', 'fieldday');?>
                </a>
                <a href="#" id="store_credit" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/store-credit.png"/>
                    <?php _e('Store Credits', 'fieldday');?>
                </a>
                <a href="#" id="store_statement" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/credits-statement.png"/>
                    <?php _e('Credit Statement', 'fieldday');?>
                </a>
                <a href="#" id="saved_cards" class="km_my_purchase km_nav_link" onclick="return fieldday.profileForm(this, event);">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/card_icon.png"/>
                    <?php _e('Saved Cards', 'fieldday');?>
                </a>

                <!--<a href="#" id="delete_account" class="km_my_purchase km_nav_link" onclick="">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/personal_info.png"/>

                </a>-->

                <!--<a href="#" id="change_pass">Reset Password</a>-->
                <a href="<?php echo $this->kmLogoutUrl(); ?>" id="signout" class="km_signout km_nav_link">
                    <img src="<?php echo fieldday_URL; ?>/assets/img/logout.png">
                    <?php $this->displayText('km_logout_btn');?></a>
            </div>
            <div class="km_col_10 km_tab_data km_profile_content km_profile_content_profile_update">
                <?php echo $this->getView('account/_profile'); ?>
            </div>
        </div>
    </div>
</div>