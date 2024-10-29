<div class="km_session_filters-2 km_shadow" id="km_session_search_container">
    <div class="km_wrap">
        <div class="km_mobile_filters">Filters: <span>(click here to open the filters) </span></div>
        <form id="km_session_filter_form"  class="km_filter_form" method="GET" action="#">
            <?php  if(isset($isMarketplaceList) && $isMarketplaceList!=''){?>
                <input type="hidden" name="isMarketplaceList"  value="true" />
            <?php } ?>
            <input data-search-name="sessionId" type="hidden" name="filters[sessionId]" value="<?php echo $this->getValue('sessionId', $filters); ?>">
            <input id="km_session_tab_id" type="hidden" name="tabId" value="<?php echo $tabs[0]->_id; ?>">
			  <input data-search-name="sessionlayout" type="hidden" name="layout" value="<?php echo $activetheme; ?>">
            <?php
            $session_filters = $this->fielddaySelectedFilters(); 
            print "<div class='km_row_margin km_row km_filter_row  km_mobile_hidden myrow km_filters_change'>";
            $count = 0; 
            $last_element = end($session_filters);

            foreach ($session_filters as $key => $filterKey) { 
                if ((in_array("location",$session_filters) && $count==0)|| (in_array("search",$session_filters) && !in_array("location",$session_filters) && $count<1 && $activetheme=="list_view")){ 
                    print "<div class='km_row km_filter myclassd'>";
                }

                if(!in_array("search",$session_filters) && !in_array("location",$session_filters) && $count==0){ print '<div class="km_row_margin km_row km_filter_row bottom_row list_custom_filter km_mobile_hidden">'; 
                }
                if($filterKey!='types'){
                    print apply_filters("fieldday_session_filter_{$filterKey}", $this->session_filter_output($filterKey, $tagId, $activityTags), $filterKey, $activityTags);
                }

                if ((in_array("search",$session_filters) && !in_array("location",$session_filters) && $count<1) || (in_array("location",$session_filters) && !in_array("search",$session_filters) && $count==0 && $activetheme=="list_view") || in_array("search",$session_filters) && in_array("location",$session_filters) && $count==1 && $activetheme=="list_view"){
                     print '</div></div><div class="km_row_margin km_row km_filter_row bottom_row list_custom_filter km_mobile_hidden">'; 
                }
                if(!in_array("search",$session_filters) && !in_array("location",$session_filters) && $last_element==$filterKey){ print '</div>'; 
                }
                /*if($filterKey=='types'){
                    $types = '<div class="km_row_margin km_row km_filter_row list_custom_filter km_tabs_type">';
                    $types .= apply_filters("fieldday_session_filter_{$filterKey}", $this->session_filter_output($filterKey, $tagId, $activityTags), $filterKey, $activityTags);
                    $types .= '</div>';
                }*/
            $count++;
            }
            print '</div>';
            $types .='<input type="hidden" name="tagId" data-url="" value="" class="km_session_type">';
            echo $types;
            
            ?>

        </form>
        
        
    </div><!-- end wrap -->
</div><!-- end our-program --> 
