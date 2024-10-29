<?php 
if(!empty($cartDetails))
{
	$purchasepage = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
            $content = "<div class='km_cart_page km_col_12' id='km_cart_items_wrap'><h3 class='km_primary_color'>Cart</h3><div class='km_cart_itemsul'>";
            foreach($cartDetails as $cartDetail)
            {
                $kids = $cartDetail->kidId; $kidname='';
                $key = $cartDetail->_id;
                $addedForOneDayOnly = $cartDetail->addedForOneDayOnly;
                $selectedate = '';
                if($addedForOneDayOnly){
                    $bookingtypesel = "Drop-In";
                    $selectedate = fieldday()->engine->parseDate($cartDetail->oneDaySelectedDate,'d-M-Y');
                }else{
                    $bookingtypesel = "All Session Days";
                }
                foreach($kids as $kid){
                    $kidname .= '<span>'.$kid->firstName.'</span>';
                }   
                $session_img = fieldday()->engine->displaySessionThumb($cartDetail->sessionId,false,true);
                $location = $cartDetail->sessionId->siteLocationId->name;
		        $location_state = $cartDetail->sessionId->siteLocationId->state;
		        $location_country = $cartDetail->sessionId->siteLocationId->country;
		        $location_link = "https://www.google.com/maps/place/".$location.",+".$location_state.",+".$location_country;

                $content .= '<div class="km_row km_cart_single">';
                $content .= wp_sprintf('<div class="km_col_2 km_cart_img">%s</div>', $session_img);
                $content .= wp_sprintf('<div class="km_cart_desc km_col_10"><span class="cart_item_heading">%s</span>', $cartDetail->sessionId->name);
                $content .= wp_sprintf('<div class="km_cart_item_seats"><i class="fa fa-child km_primary_color" aria-hidden="true"></i>%s</div>', $kidname);
                $content .= wp_sprintf('<div class="km_cart_item_sdate km_cart_time km_cart_bookingtype_sel"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span>%s</span>', $bookingtypesel);
                if($selectedate){
                $content .= wp_sprintf('<span class="km_cart_item_sdate km_cart_time"> (%s)</span>', $selectedate);
                }
                $content .= '</div>';
                $content .= wp_sprintf('<div class="km_cart_location km_cart_time">
                    <i class="fa fa-map-marker km_primary_color"></i>
                    <span class="km_location_session_details"><a href="%s" onclick="window.open(this.href,"targetWindow","toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600"); return false;">(%s)</a></span></div>', $location_link, $location);
                $content .= wp_sprintf('<div class="km_cart_button"><span data-cart-key="%s" class="km_edit_cart_item km_primary_color">Edit</span><span data-cart-key="%s" class="km_remove_cart_item km_secondary_color" data-actionfrom="cart">Remove</span></div></div>', $key, $key);
                $content .='</div>';
            }
            $content .='</div>';
            $content .= wp_sprintf('<div class="checkout_button"><a class="km_primary_color km_btn km_transparent_bg" href="%s">Continue Shopping</a>', apply_filters('km_purchase_page', $purchasepage));
            $content .= wp_sprintf('<a class="km_btn km_primary_bg" href="%s">Checkout</a></div>', apply_filters('km_checkout_page', site_url('/checkout')));
            $content .='</div>';
            echo $content;
}
?>