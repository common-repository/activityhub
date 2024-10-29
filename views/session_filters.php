<div class="km_session_filters-2 km_shadow" id="km_session_search_container">
    <div class="km_wrap">
        <form id="km_session_filter_form"  class="km_filter_form" method="GET" action="#">
            <?php  if(isset($isMarketplaceList) && $isMarketplaceList!=''){?>
                <input type="hidden" name="isMarketplaceList"  value="true" />
            <?php } ?>
            <input data-search-name="sessionId" type="hidden" name="filters[sessionId]" value="<?php echo $this->getValue('sessionId', $filters); ?>">
            <input id="km_session_tab_id" type="hidden" name="tabId" value="<?php echo $tabs[0]->_id; ?>">
			  <input data-search-name="sessionlayout" type="hidden" name="layout" value="<?php echo $activetheme; ?>">
            <?php
            $session_filters = $this->fielddaySelectedFilters(); 
            print "<div class='km_row_margin km_row km_filter_row myrow'>";
            $count = 0; 
            $last_element = end($session_filters);

            foreach ($session_filters as $key => $filterKey) {
                print apply_filters("fieldday_session_filter_{$filterKey}", $this->session_filter_output($filterKey, $tagId, $activityTags), $filterKey, $activityTags);
            }
            print '</div>';
            ?>

        </form>
    </div><!-- end wrap -->
</div><!-- end our-program --> 