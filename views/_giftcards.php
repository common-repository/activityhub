<?php //print_r($gifts); 
$images = $gifts->images;
if($images){
    $image1 = $images[0]->thumbnail;
}
//print_r($images); 
?>
<li id="km_session_two_coloum_layout" class="km_session_single_item activethemeview km_records">
    <div class="km_col_2">
        <div class="km_align">
            <div class="km_thumbnail_new">
                <img src="<?php echo $image1; ?>" alt="Field Day Placeholder" title="Field Day Placeholder">
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="km_col_10">
        <div class="km_Heading_content">
            <!-- Heading -->
            <div class="km_full_age">
                <input type="hidden" id="km_session_tags" value="{}">
                <h3 class="km_session_name_heading km_with_tooltip km_primary_color"><?php echo $gifts->title ?>   
                <!--div class="km_with_tooltip"><img src="" class="km_icon_infor">
                <span class="tooltiptext">More Info About This Activity</span>
                </div-->
                </h3>
                <div class="km_descri"><?php echo $gifts->description; ?></div>

            </div>
            <div class="km_Heading_content_inner">
                
                
                
            </div>

            <div class="km_session_bottom_wrap km_listview_price_col">
                <div class="km_session_price_div">
                    <span class="price">
                        <i class="fa fa-usd GridIcon" aria-hidden="true"></i>
                        $1 - $2000</span>
                </div>
                <div class="km_cart_button_p">
                <a href="javascript:void(0)" data-title="<?php echo $gifts->title ?>" id="km_giftpurchase_btn" class="km_btn km_purchase_btn km_primary_bg" data-giftcardid="<?php echo $gifts->_id; ?>" data-giftcardprice-range="[25,50,100,125]"><?php _e('Purchase','fieldday'); ?></a>
                </div>
            </div>

        </div>
    </div>
<!-- Add to cart -->
</li>