<?php 
global $fielddaySetting;
$provider_page = get_permalink(fieldday()->engine->getValue('provider_page', $fielddaySetting, false));
$html='';
foreach($providerslist as $list){
	$logo_img = $this->getProviderLogoUrl($list);
	
	$html.='<div class="km_col_12 km_row">';
	$html.='<div class="km_col_2"><div class="km_align"><div class="km_thumbnail_new">
        '.$logo_img.'</div></div></div>';
    $html.='<div class="km_col_10><h3 class="km_session_name_heading km_primary_color">'.$list->name.'</h3><div class="km_star-rating">Rating: '.$list->rating.'</div><div class="km_descri" style="display: none;">Welcome to our art studio! Our studio has a family atmosphere. Our Art Day is filled with lots of fun, games, laughter, hugs and creating art. Tamara teaching style is a hands on approach with individual and group instruction.</div><div class="km_cart_button_p"><a href="'.$provider_page.'?providerId='.$providerId.'&Id='.$list->_id.'" class="km_btn km_primary_bg">Learn More</a></div></div>';
	$html.='</div>';
	echo $html;
}
?>