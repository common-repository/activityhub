<?php
global $fielddaySetting;
$activetheme = $this->getValue('fieldday_theme_mode', $fielddaySetting, false);
	?>
<div class="km_session_filters km_shadow" id="km_session_search_container_two_column">
    <div class="wrap">
        <form id="km_session_filter_form"  class="km_filter_form" method="GET" action="#">
            <?php  if(isset($isMarketplaceList) && $isMarketplaceList!=''){?>
                <input type="hidden" name="isMarketplaceList"  value="true" />
            <?php } ?>
            <input data-search-name="sessionId" type="hidden" name="filters[sessionId]" value="<?php echo $this->getValue('sessionId', $filters); ?>">
            <input data-search-name="sessionlayout" type="hidden" name="layout" value="<?php echo $activetheme; ?>">

            <?php
            $session_filters = $this->fielddaySelectedFilters(); 
            foreach ($session_filters as $key => $filterKey) {
                print apply_filters("fieldday_session_filter_{$filterKey}", $this->session_filter_output($filterKey, $tagId, $activityTags), $filterKey, $activityTags);
            }
            ?>

        </form>
    </div><!-- end wrap -->
</div><!-- end our-program -->
