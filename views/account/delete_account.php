<h3><?php _e("Delete Account", "fieldday");?></h3>
<div class="">
<section class="km_user_delete_account_detail_outwrapper">
	<div class="container">
		<div class="km_user_delete_account_wrap">
			<div class="km_user_delete_account_main">
				<h1 class="km_user_delte_hd">Are you sure you want to delete this account?</h1>
				<p class="km_user_delte_content km_user_delte_content-01">Before proceeding, please be sure to review the <span class="km_Ternservice">Terms of Service </span>regarding deletion.</p>
				<p class="km_user_delte_content km_user_delte_content-02">This action <span class="km_cantundone">CANNOT be undone.</span> Please be certain about your decision.</p>
				<p class="km_user_delte_content km_user_delte_content-03">Deleting this account will delete all the registrations (both past and upcoming), profile information and notifications. </p>
			</div>
			<form id="km_user_delete_account_form" class="km_user_delete_account_form">
				<div class="km_user_contentdete_formdiv">
				  <input type="checkbox"  required id="check01" name="">
				  <label for="check01">I won’t be able to log into ActivityHub without creating a new account.</label>
				</div>
				<div class="km_user_contentdete_formdiv">
				  <input type="checkbox"  required id="check02" name="">
				  <label for="check02">I understand my past activity  registration(s) records will be deleted forever.</label>
				</div>
				<div class="km_user_contentdete_formdiv">
				  <input type="checkbox" id="check03" name="">
				  <label for="check03">I understand my future activity registration(s) records and services can get impacted.</label>
				</div>
				<div class="km_user_contentdete_formdiv_confirm">
					<label>Type “DELETE” to confirm.</label>
					<input   onpaste="return false"  name="delete" required placeholder="DELETE"  type="text" name="">
				</div>
			</form>
			<div class="km_user_delte_buttons">
                <a href="#" onclick="return fieldday.deleteUserAccountFieldday();" id="km_remove_user_acnt_btn" class="km_button km_primary_bg">Delete</a>
			</div>
		</div>
	</div>
</section>
</div>

