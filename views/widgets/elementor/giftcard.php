<?php
$min = $minprice;
$max = $maxprice;
$step = $breakprice;
$amonunts = [];
while ($min <= $max)
{
    if($min != '75'){
    $amonunts[] = $min;
    }
        @$min = $min + $step;
}
        foreach ($giftCard as $giftCardData)
        {
        ?>
        <div class='km_list_giftcard <?php echo $layoutClass; ?>'>
            <div class="km_giftcard_title_section">
                <h3 class="km_giftcard_title">
                <?php echo $giftCardData->title; ?>
                </h3>
            </div>
            <div class="km_giftcard km_row" >
              <div class="km_gift_preview km_rokuimg km_col_6">
                    <div class="km_gift_image_slider">
                      <?php
                    foreach ($giftCardData->images as $giftCardThumb)
                    {
                         ?>
                                  <div class="km_giftdesign_slide ">
                                  <img  class="km_gift_image" alt="Festive greetings"  src="<?php echo $giftCardThumb->original; ?>" >
                                </div>
                              <?php
                    }
                    ?>
                    </div>
                  <div class="km_row km_giftcompany">
                    <?php if($companyImg){?>
                          <div class="km_activity_img km_col_6">
                              <img src="<?php echo $companyImg; ?>" />
                          </div>
                          <div class='km_activity_description km_col_6'>
                            <b class='km_act_heading'><?php echo $description_price_title; ?></b>
                            <span class="km_activity_text"><?php echo $description_price_icon ; ?></span>
                          </div>
                    <?php }?>
                  </div>
              </div>

              <div class="km_giftcard_content km_col_6">
                <div class="km_content_wrap">
                  <div class="km_gift_section">
                    <?php
                    if ( $giftCardData->description ) {
                      echo "<div class='km_activity_description'>";
                        echo "<b class='km_act_heading'>Overview</b>";
                        echo '<span class="km_activity_text">'.$giftCardData->description.'</span>';
                      echo "</div>";
                    }
                    if ( $description_price_icon ) {
                      echo "<div class='km_activity_description '>";
                        echo "<b class='km_act_heading'>".$description_price_title."</b>";
                        echo "<span class='km_activity_text'>".$description_price_icon."</span>";
                      echo "</div>";
                    }
                    if ($show_questions) {
                        if ( $sections_content ) {
                          echo "<div class='km_activity_description'>";
                          foreach ($sections_content as $item ) {
                            echo "<b class='km_act_heading'>". $item['list_title'] ."</b>";
                            echo '<span class="km_activity_text">'.$item['list_content'].'</span>';
                          }
                          echo "</div>";
                        }
                    }
                    ?>
                  </div>

                  <div class="giftcardbuttoncontainer">
                    <?php echo wp_sprintf('<a href="javascript:void(0)" data-title="'.$giftCardData->title.'"  id="km_giftpurchase_btn" class="km_btn km_purchase_btn km_primary_bg" data-giftcardid="'.$giftCardData->_id.'"  data-giftcardprice-range='.htmlspecialchars(json_encode($amonunts), ENT_QUOTES, 'UTF-8').'>%s</a>', $buttonText);
                ?>
                 </div>
                </div>
          </div>

        </div>
    </div>
<?php
}
?>
