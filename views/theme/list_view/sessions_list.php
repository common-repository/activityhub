<?php
if (!defined('ABSPATH')) // Or some other WordPress constant
    exit;
?>
<!--two column layout -->
<section class="km_SessionsSection">
    <div class="container-fluid">    
    <?php 
    if($fielddaySetting['fieldday_filters_mode']=='slide'){ ?>
        <div class="km_slidefilter_btn">
        <a class="km_btn km_primary_bg"><svg class="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512" style="fill: #fff;"><path d="M0 416c0-17.7 14.3-32 32-32l54.7 0c12.3-28.3 40.5-48 73.3-48s61 19.7 73.3 48L480 384c17.7 0 32 14.3 32 32s-14.3 32-32 32l-246.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 448c-17.7 0-32-14.3-32-32zm192 0c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32zM384 256c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32zm-32-80c32.8 0 61 19.7 73.3 48l54.7 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-54.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l246.7 0c12.3-28.3 40.5-48 73.3-48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32s-14.3-32-32-32zm73.3 0L480 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-214.7 0c-12.3 28.3-40.5 48-73.3 48s-61-19.7-73.3-48L32 128C14.3 128 0 113.7 0 96S14.3 64 32 64l86.7 0C131 35.7 159.2 16 192 16s61 19.7 73.3 48z"></path></svg>Filters</a></div>
    <?php }  ?>
    <div class="km_row km_filter_<?php echo $fielddaySetting['fieldday_filters_mode']; ?>">
        <?php if($fielddaySetting['fieldday_filters_mode']=='slide'){ ?>
            <div class="km_slide_header"><div class="removefilterselecter">X</div></div>
            <div class="km_slide_title"><h3 class="km_heading km_primary_color"><?php _e('Filter Sessions', 'fieldday'); ?></h3></div>
        <?php } ?>
        <div class="km_col_12 km_list_filters">
            <?php
            $filters['showAllSessions'] = 'true';
            if(isset($_REQUEST['activityId'])){
               $filters['filters']['activityId'] = $_REQUEST['activityId']; 
               $filters['showAllSessions'] = 'false';
            }
            $sessions = fieldday()->api->GetProviderSessionsNew($filters);
            $searchLocation = $this->getSiteLocation($sessions);
            do_action('before_km_session_filters', $activityTags);
            if(isset($isMarketplaceList)){
                echo fieldday()->engine->getView('session_filters', ['locations' => $searchLocation, 'activityTags' => $activityTags->data, 'filters' => $this->getValue('filters', $filters), 'tagId' => $tagId,'isMarketplaceList'=>$isMarketplaceList]);
            }else{
                echo fieldday()->engine->getView('session_filters', ['locations' => $searchLocation, 'activityTags' => $activityTags->data, 'filters' => $this->getValue('filters', $filters), 'tagId' => $tagId]);
            }
        ?>
    </div>
    </div>
        <div class="km_row_wrap">
            <div id="km_session_filter_form_div"  class="km_filter_form_div">
                <?php
                $session_filters = $this->fielddaySelectedFilters(); 
                $types_sec ='';
                foreach ($session_filters as $key => $filterKey) { 
                    if($filterKey=='types'){
                        $types_sec .= '<div class="km_row_margin km_row km_filter_row list_custom_filter km_tabs_type">';
                        $types_sec .= apply_filters("fieldday_session_filter_{$filterKey}", $this->session_filter_output($filterKey, $tagId, $activityTags->data), $filterKey, $activityTags->data);
                        $types_sec .= '</div>';
                    }
                }
                echo $types_sec;
                ?>
            </div>

            <?php 
            $cartdata = $this->GetCartData();
            if($cartdata){
              $cartcount = count($cartdata);
            }else{
              $cartcount = 0;
            }
            //print fieldday()->engine->getView('_session_count', ['sessions' => $sessions, 'permalink' => get_the_permalink(), 'filters' => $filters, 'tagId' => $tagId]);
            ?>

<div class="km_cart">
<?php  if($fielddaySetting['cart_menu']!='defaultview'){ $class="km_hidden";} ?>
            <div class="km_col_12 km_session_list_icons">
            <?php  if($fielddaySetting['cart_menu']=='defaultview'){?>
                <div class="single_icon">
                    <div class="km_cart_toggle <?php echo $class; ?>">
                        <span id="km_cart_total_count" class="km_secondary_color"><?php echo $cartcount; ?></span>
                        <svg baseProfile="tiny" class="km_secondary_color" height="30px" version="1.2" viewBox="0 0 30 30" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Layer_1" fill-rule="evenodd">
                                <g>
                                    <path d="M20.756,5.345C20.565,5.126,20.29,5,20,5H6.181L5.986,3.836C5.906,3.354,5.489,3,5,3H2.75c-0.553,0-1,0.447-1,1    s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124c0.016,0.053,0.029,0.103,0.054,0.151    c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112c0.058,0.054,0.125,0.092,0.193,0.13    c0.038,0.021,0.071,0.049,0.112,0.065C6.748,16.972,6.87,17,6.999,17C7,17,18,17,18,17c0.553,0,1-0.447,1-1s-0.447-1-1-1H7.847    l-0.166-1H19c0.498,0,0.92-0.366,0.99-0.858l1-7C21.031,5.854,20.945,5.563,20.756,5.345z M18.847,7l-0.285,2H15V7H18.847z M14,7    v2h-3V7H14z M14,10v2h-3v-2H14z M10,7v2H7C6.947,9,6.899,9.015,6.852,9.03L6.514,7H10z M7.014,10H10v2H7.347L7.014,10z M15,12v-2    h3.418l-0.285,2H15z"/>
                                    <circle cx="8.5" cy="19.5" r="1.5"/>
                                    <circle cx="17.5" cy="19.5" r="1.5"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <!-- mobile cart view code start -->
                    <div class="cart_bttn_mobile">
                        <button class="mobile_bttn km_primary_bg"> view cart <span id="km_cart_total_count" class="mobile_cart_count"> <?php echo $cartcount; ?> </span></button>
                    </div>
                    <div id="km_cart_items_wrap_mobile"></div>
                    <!-- mobile cart view code end -->
                    <div id="km_cart_items_wrap"></div>
                </div>
            <?php  } ?>

            <?php  if($fielddaySetting['cart_menu']!='defaultview'){?>
                <div class="single_icon">
                    <!-- mobile cart view code start -->
                    <div class="cart_bttn_mobile">
                        <button class="mobile_bttn km_primary_bg"> view cart <span id="km_cart_total_count" class="mobile_cart_count"> <?php echo $cartcount; ?> </span></button>
                    </div>
                </div>
            <?php  } ?>

            <div class="single_icon">
                    <a href="javascript:void(0);" data-style="grid" class="km_session_switcher">
                        <svg width="30px" height="30px" viewBox="0 0 30 30" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="#147b8d" fill-rule="evenodd">
                                <g id="Programs2" transform="translate(-1349.000000, -696.000000)">
                                    <g id="Group-3" transform="translate(1349.000000, 696.000000)">
                                        <rect id="Rectangle-14" x="0" y="0" width="8.11594203" height="8.11594203"></rect>
                                        <rect id="Rectangle-14-Copy-2" x="0" y="11.3623188" width="8.11594203" height="8.11594203"></rect>
                                        <rect id="Rectangle-14-Copy" x="11.3623188" y="0" width="8.11594203" height="8.11594203"></rect>
                                        <rect id="Rectangle-14-Copy-3" x="11.3623188" y="11.3623188" width="8.11594203" height="8.11594203"></rect>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="single_icon">
                    <a href="javascript:void(0);" data-style="list" class="km_current_layout km_session_switcher">
                        <svg width="30px" height="30px" viewBox="0 0 30 30" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="#147b8d" fill-rule="evenodd">
                                <g id="Programs2" transform="translate(-1382.000000, -696.000000)">
                                    <g id="Group-2" transform="translate(1382.000000, 696.000000)">
                                        <rect id="Rectangle-14-Copy-4" x="0.275362319" y="0" width="22.7246377" height="2.43478261"></rect>
                                        <rect id="Rectangle-14-Copy-5" x="0.275362319" y="8.11594203" width="22.7246377" height="2.43478261"></rect>
                                        <rect id="Rectangle-14-Copy-6" x="0.275362319" y="16.2318841" width="22.7246377" height="2.43478261"></rect>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

            <div class="km_col_12 km_shadow_right km_session_list activethemelistview">
                <div class="container-fluid km_provider_merchandise">
                    <!-- Update by ajax -->
                </div>
                <div class="km_provider_sessions">
                    <?php
                    print fieldday()->engine->getView('_sessionlist_part', ['sessions' => $sessions, 'permalink' => get_the_permalink(), 'filters' => $filters, 'tagId' => $tagId]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
