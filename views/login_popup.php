<?php 
$params = [];
if(isset($sessionId) && $sessionId) {
    $params[] = $sessionId;
}

if(isset($tagId) && $tagId) {
    $params[] = $tagId;
}
if(isset($sessionDate) && $sessionDate) {
    $params[] = $sessionDate;
}

if(isset($_REQUEST['sessionfeatured'])) {
$sessionfeatured = filter_input(INPUT_POST, 'sessionfeatured', FILTER_SANITIZE_STRING);
}
if(isset($offerId) && $offerId) {
    $params = [null, null, null];
    $params[] = $offerId;
}
global $fielddaySetting; 
$vendor = array_key_exists('siteName', $fielddaySetting) ? $fielddaySetting['siteName'] : null;
$link  = wp_sprintf('<a href="%s" target="_blank">ActivityHub</a>','https://activityhub.com');
?>
<div class="km_login_wrap km_authpop_wrap">
    <?php do_action('km_before_loginpage'); ?>
    <div class="login_row_mobile">
        <?php _e($link .' powers purchases at '.$vendor .'. In order to process your order, please select one of the following options.', 'fieldday'); ?>
    <div class="km_login_m_button">
        <a class="km_toggle_register km_button" onclick="return fieldday.showRegisterForm(this, event);" href="JavaScript:void(0);">Create My Account</a>
    </div>  
    <div class="km_login_m_button">
        <a data-session-featured="<?php echo $sessionfeatured; ?>" data-session-date="<?= $sessionDate; ?>" 
            data-session-date="<?php echo $sessionDate; ?>" <?php if(isset($_POST['isGuest'])){ echo "data-session-isGuest=true";} ?> <?php if(isset($_POST['session_type'])){ echo "data-type=".$_POST['session_type'];} ?> onclick="return fieldday.showLoginForm(this, event );" class="km_toggle_sigh-in km_btn_green" href="JavaScript:void(0);">Sign In</a>
    </div>
    <div class="km_login_m_button">
                <?php if(isset($offerId) && $offerId): ?>
                    <?php $Registerparams = wp_sprintf("data-offer-id='%s' data-offer-name='%s' ", $offerId, $offername); ?>  
                    <input type="hidden" id="login_form_offerId" value="<?php echo $offerId; ?>">
                    <a href="JavaScript:void(0);" <?php $this->merchandiseRegister($offerId,$offername, true, $sessionfeatured ); ?> id="guest-continue" class="km_button_default km_guest_login abc1">
                        <?php _e('Continue as a Guest', 'fieldday'); ?>
                    </a>
                <?php endif; ?>
                <?php if(isset($sessionId) && $sessionId): ?>
                    <?php if(empty($sessionfeatured)){
                        if(isset($_POST['session_type']) && $_POST['session_type']=='event'){
                            $data = $this->eventRegister($sessionId, $tagId, $sessionDate,true,$sessionfeatured);
                        } else{
                            $data = $this->sessionRegister($sessionId, $tagId, $sessionDate,true,$sessionfeatured); 
                        }
                    ?>
                    <a href="JavaScript:void(0);" <?php echo $data; ?> id="guest-continue" class="km_button_default km_guest_login">
                        <?php _e('Continue as a Guest', 'fieldday'); ?>
                    </a>
                

                <?php } else { ?>

                <a href="JavaScript:void(0);" data-session-id="<?= $sessionId; ?>" data-tag-id="<?php echo $tagId; ?>" data-session-date="<?php echo $sessionDate; ?>" data-session-featured="<?php echo $sessionfeatured; ?>"  onclick="return fieldday.registerSessionTiming(this, event );"  id="guest-continue" class="km_button_default km_guest_login">
                <?php _e('Continue as a Guest', 'fieldday'); ?>
                </a>


                <?php } ?>
                <?php endif; ?>
            </div>



    </div>

    <div class="login_row km_login_options">
        <div class="<?php if(isset($_POST['isGuest'])){ echo "km_col_6 membership ";}else{ echo "km_col_4 "; }?>km_register_module">
            <div class="km_register_sec">
                <h3 class="km_login_m_title">
                    <?php _e('New Customers', 'fieldday'); ?>
                </h3>
                <div class="km_login_m_features">
                    <span><?php _e($vendor.' Partners with '.$link .' to provide online registration. Your online account allows you to do the following and much more:', 'fieldday'); ?></span>
                    <span><?php _e('- Track Orders, Refunds & Tax.', 'fieldday'); ?></span>
                    <span><?php _e('- Get Notified and Stay Engaged.', 'fieldday'); ?></span>
                    <span><?php _e('- Quick Checkout with Profile.', 'fieldday'); ?></span>
                </div>
                <div class="km_login_m_button">
                    <a class="km_toggle_register km_button" onclick="return fieldday.showRegisterForm(this, event);" href="JavaScript:void(0);">Create My Account</a>
                </div>
            </div>
        </div>
        <div class="<?php if(isset($_POST['isGuest'])){ echo "km_col_6 membership ";}else{ echo "km_col_4 "; }?> km_login_module">
            <div class="km_login_sec">
                <h3 class="km_login_m_title">
                    <?php _e('Registered User', 'fieldday'); ?>
                </h3>
                <div class="km_login_m_features">
                    <span><?php _e($vendor.' partners with '.$link .' to provide online registration. In case you have made a purchase at another '.$link .' Partner, please sign in using your account credentials.', 'fieldday'); ?></span>

                    <span class="km_welcome"><?php _e('Welcome Back! Sign In Now.', 'fieldday'); ?></span>
                </div>
                <div class="km_login_m_button">
                    <a data-session-featured="<?php echo $sessionfeatured; ?>" data-session-date="<?= $sessionDate; ?>" 
                        data-session-date="<?php echo $sessionDate; ?>" <?php if(isset($_POST['isGuest'])){ echo "data-session-isGuest=true";} ?> <?php if(isset($_POST['session_type'])){ echo "data-type=".$_POST['session_type'];} ?> onclick="return fieldday.showLoginForm(this, event );" class="km_toggle_sigh-in km_btn km_btn_green" href="JavaScript:void(0);">Sign In</a>
                </div>
            </div>    
        </div>
           <?php if(!$_POST['isGuest']){?>
        <div class="km_col_4 km_guest_module">
            <h3 class="km_login_m_title">
                <?php _e('Guest Checkout', 'fieldday'); ?>
            </h3>
            <?php if(isset($_POST['session_type']) && ($_POST['session_type']=='multiWeek' || $_POST['session_type']=='waitlist')){ ?>
                <div class="km_login_m_features">
                <span><?php _e('Guest mode registration is not available for this session.', 'fieldday'); ?></span>
            </div>
            <?php } else { ?>
            <div class="km_login_m_features">
                <span><?php _e('- Some discounts and coupons might not work.', 'fieldday'); ?></span>
                <span><?php _e('- No Purchase History', 'fieldday'); ?></span>
            </div>
            <div class="km_login_m_button">
                <?php if(isset($offerId) && $offerId): ?>
                    <?php $Registerparams = wp_sprintf("data-offer-id='%s' data-offer-name='%s' ", $offerId, $offername); ?>
                    <input type="hidden" id="login_form_offerId" value="<?php echo $offerId; ?>">
                    <a href="JavaScript:void(0);" <?php $this->merchandiseRegister($offerId,$offername, true, $sessionfeatured ); ?> id="guest-continue" class="km_button_default km_guest_login abc1">
                        <?php _e('Continue as a Guest', 'fieldday'); ?>
                    </a>
                <?php endif; ?>
                <?php if(isset($sessionId) && $sessionId): ?>
                    <?php if(empty($sessionfeatured)){
                        if(isset($_POST['session_type']) && $_POST['session_type']=='event'){
                            $data = $this->eventRegister($sessionId, $tagId, $sessionDate,true,$sessionfeatured);
                        } else{
                            $data = $this->sessionRegister($sessionId, $tagId, $sessionDate,true,$sessionfeatured); 
                        }
                    ?>
                    <a href="JavaScript:void(0);" <?php echo $data; ?> id="guest-continue" class="km_button_default km_guest_login">
                        <?php _e('Continue as a Guest', 'fieldday'); ?>
                    </a>
                

                <?php } else { ?>

                <a href="JavaScript:void(0);"  data-session-id="<?= $sessionId; ?>" data-tag-id="<?php echo $tagId; ?>" data-session-date="<?php echo $sessionDate; ?>" data-session-featured="<?php echo $sessionfeatured; ?>"  onclick="return fieldday.registerSessionTiming(this, event );"  id="guest-continue" class="km_button_default km_guest_login">
                <?php _e('Continue as a Guest', 'fieldday'); ?>
                </a>


                <?php } ?>
                <?php endif; ?>
            </div>
           <?php  } //type Multiweek
           ?>
        </div>
           <?php }?>
    </div>
</div>