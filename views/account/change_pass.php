<h3><?php _e('RESET PASSWORD', 'fieldday'); ?></h3>
<form class="km_reset_password_form" id="km_reset_password_form" method="post" action="#" data-user-token="">
	<div class="km_col_12 km_field_wrap">
	    <fieldset>  
		    <label for="current-password">Current Password</label>
		    <input type="password" name="current-password" id="km_current_password" data-parsley-required-message="Required" required />
	    </fieldset> 
	</div>
	<div class="km_col_12 km_field_wrap">
	    <fieldset>  
		    <label for="new-password">New Password</label>
		    <input type="password" name="new-password" id="km_new_password" data-parsley-required-message="Required" required />
		</fieldset> 
	</div>
	<div class="km_col_12 km_field_wrap">
	    <fieldset>
		    <label for="confirm-new-password">Confirm New Password</label>
		    <input type="password" name="confirm-new-password" id="km_confirm_new_password" data-parsley-required-message="Required" required />
	    </fieldset> 
	</div>
	<div class="km_col_12 km_field_wrap">
    	<input type="submit" id="km_reset_password_submit" name="km_reset_password_submit" class="km_btn btn--pink km_primary_bg" value="Save" onclick="return fieldday.updatePassword(this, event);">
	</div>
</form>