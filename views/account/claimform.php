<form id="km_claimForm" class="km_claimForm">
    <div class="km_col_12"><?php print apply_filters("km_storecredit_claim_info", __("Enter your claim code received in your email to claim.", "fieldday")); ?></div>
    <div class="">
        <div class="km_col_12 km_field_wrap">
            <fieldset>  
                <input type="text" name="code" id="km_new_password" placeholder="<?php _e("Enter code here...", "fieldday"); ?>" data-parsley-required-message="Required" class="km_input" data-parsley-group="claim_code" required />
            </fieldset> 
        </div>
        <div class="km_col_12 km_field_wrap km_center">
            <button class='km_btn km_btn_default km_primary_color km_transparent_bg' onclick='fieldday.closepopup(this);'><?php _e("Cancel", "fieldday"); ?></button>
            <button type="submit" id="" name="km_reset_password_submit" class="km_btn km_btn_default km_primary_bg" onclick="return fieldday.claimStoreCredit(this, event);">Submit</button>
        </div>
    </div>
</form>