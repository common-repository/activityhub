<div class="km_auth_required">
	<h2><?php $this->getValue('name', $KmUser); ?></h2>
    <p><?php _e('You are already logged-in. Go to My Account page '); ?> <a class="km_btn km_primary_bg" href="<?php echo $this->myaccounyRedirect(); ?>"><?php _e('Here'); ?></a></p>
    
</div>