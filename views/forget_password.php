<form class="km_kids_forms km_forget_password" onsubmit="return fieldday.forgetPassword('.km_user_reset_password', event);" id="km_forget_password" action="" method="post">
	<div class="km_col_12 km_field_wrap">
		<p><?php _e('Enter the email associated with your account and we will send an email with instructions to reset your password.','fieldday')?></p>
	</div>
    <div class="km_col_12 km_field_wrap">
        <!-- <label for="email"><?php //_e('Enter email address', 'fieldday'); ?></label> -->
        <i class="fa fa-envelope-o km_forget_email_icon" aria-hidden="true"></i>
        <input type="email" class="km_input" name="km_user_email" placeholder="<?php  _e('Enter email address', 'fieldday'); ?>" data-parsley-group="forgetPassword" data-parsley-required-message="Required" data-parsley-type-message="Invalid Email" required="">
    </div>
    <div class="km_col_12 km_btn_wrap km_field_wrap  ">
        <a class="km_btn km_user_reset_password km_btn_primary  km_primary_bg" onclick="return fieldday.forgetPassword(this,event);"><?php _e('Reset Password', 'fieldday'); ?></a>
    </div>
</form>