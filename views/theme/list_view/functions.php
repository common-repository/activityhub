<?php

if (!defined('ABSPATH')) // Or some other WordPress constant
{
    exit;
}

add_filter('fieldday_session_filter_location', 'theme_view_session_filter_location', 11);

function theme_view_session_filter_location()
{
    global $fielddaySetting;
    $locations = [];
    $locationsResponse = fieldday()->api->getProviderLocations();
    if ($locationsResponse->statusCode == 200) {
        foreach ($locationsResponse->data as $key => $locationdata) {
            $locations[$locationdata->_id] = $locationdata->name;
        }
    }
    $options = "";
    foreach ($locations as $location_id => $location) {
        $options .= wp_sprintf('<option value="%s">%s</option>', $location_id, $location);
    }
    if ($fielddaySetting['fieldday_filters_mode'] == 'slide') {
        $slideClass = "km_listtheme_filter_content";
    }
    return '<div class="km_filter_location select-wrapper">
            <button id="filter_type_location" class="km_listtheme_filter_btn km_filter_heading"><span>Location</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>
            <div class="km_custom_dropdown ' . $slideClass . '">

                <i class="fa fa-map-marker" aria-hidden="true" style="top: 13px; padding-left: 7px;"></i>
                <select data-search-name="location" onchange="return fieldday.processSessionFilters(this, event);" id="km_location_search" class="km_session_search session-search_location km_input" name="filters[location]">
                  <option value="all">' . __('All Locations', 'fieldday') . '</option>
                  ' . $options . '
                </select>
                <span class="pointer"><i class="fa fa-caret-down"></i></span>
            </div>
        </div>';
}

add_filter('fieldday_session_filter_search', 'theme_view_session_filter_search', 11, 2);

function theme_view_session_filter_search()
{global $fielddaySetting;
    if ($fielddaySetting['fieldday_filters_mode'] == 'slide') {
        $slideClass = "km_listtheme_filter_content";
    }
    return '
    <div class="km_filter_type select-wrapper km_col_6 list_custom_filter list_custom_filter_text_srch">
    <button id="filter_type_keyword" class="km_listtheme_filter_btn km_filter_heading"><span>Search by Keyword</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>
        <div class="km_custom_dropdown ' . $slideClass . '">
            <i class="fa fa-search" aria-hidden="true" style="top: 13px; padding-left: 7px;"></i>
            <input id="km_session_search_keyword"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"    data-search-name="searchKey" type="text" class="searchInput km_input" name="filters[searchKey]" placeholder="Search Keywords…"/></div></div>';
}

add_filter('fieldday_session_filter_types', 'theme_view_session_filter_types', 11, 3);
function theme_view_session_filter_types($content, $filterKey, $activityTags)
{
    $html = '<div class="km_filter_types km_listtheme_filter_wrap select-wrapper test">';
    $html .= '<button id="filter_type_types" class="km_listtheme_filter_btn km_filter_heading"><span>' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>';
    $html .= '<div class="typescontent km_primary_border km_listtheme_filter_content">';
    if ($activityTags) {
        $html .= '<label class="km_radio_wrap active km_primary_border">
                  <span class="km_radio_text km_primary_color">' . __('All Activities', 'fieldday') . '</span>
                  <input type="radio" data-filter-title=""  id="km_wrap_fieldday_all_tab_id" name="tagId" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="" class="km_session_type">
                  <span class="km_radio"></span>
              </label>';
        foreach ($activityTags as $key => $type) {
            $checked = ($type->_id == $data['tagId']) ? 'checked' : '';
            //print_r($type);
            if ($type->title == 'Event Ticket') {$tab = 'events';} else { $tab = $type->title;}
            $tagTitle = $type->wpShowTitle ? $type->wpShowTitle : $type->title;
            $html .= '<label class="km_radio_wrap" data-tab="' . $tab . '">
                  <span class="km_radio_text km_primary_color">' . $tagTitle . '</span>
                  <input ' . $checked . ' type="radio" data-filter-title="' . $type->title . ' camp" name="tagId" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="' . $type->_id . '" class="km_session_type">
                  <span class="km_radio"></span>
              </label>';
        }
    }
    $isavailable = fieldday()->engine->GetBankDays();
    if ($isavailable == true) {
        //$checked = ($type->_id == $data['tagId']) ? 'checked' : '';
        $html .= '<label class="km_radio_wrap">
                  <span class="km_radio_text km_primary_color">' . __('Bank Days', 'fieldday') . '</span>
                  <input type="radio" name="tagId" data-url="" onchange="return fieldday.showMerchandise(this, event);" value="" class="km_session_type">
                  <span class="km_radio"></span>
              </label>';
    } else { //echo "isfalse";
    }
    $isgift = fieldday()->engine->GetGiftCards();
    if ($isgift == true) {
        //$checked = ($type->_id == $data['tagId']) ? 'checked' : '';
        $html .= '<label class="km_radio_wrap" id="km_wrap_fieldday_gft_tab_id">
                  <span class="km_radio_text km_primary_color">' . __('Gift Cards', 'fieldday') . '</span>
                  <input type="radio" name="tagId" data-url="" onclick="return fieldday.showGiftCards(this, event);" onchange="return fieldday.showGiftCards(this, event);" value="" class="km_session_type">
                  <span class="km_radio"></span>
              </label>';
    } else { //echo "isfalse";
    }
    $html .= '</div>';
    $html .= '<div class="km_tabs_heading km_hidden">Using the tabs above, select the activity of interest</div>';
    $html .= '</div>';

    return $html;
}

add_filter('fieldday_session_filter_month', 'theme_view_session_filter_month', 11, 2);

function theme_view_session_filter_month()
{
    $html = '<div class="km_filter_month select-wrapper km_listtheme_filter_wrap">
         <input type="hidden"  id="km_if_session_filter_date" value="" />
        <div id="reportrange"  class="" style="cursor: pointer; border: 1px solid #ccc; width: 100%">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-angle-down"></i>
        </div></div>
        ';
    return $html;
}

//add_filter('fieldday_session_filter_bankdays', 'theme_view_session_filter_bankdays', 11, 2);

function theme_view_session_filter_bankdays($content, $filterKey)
{
    return '<div class="km_filter_type select-wrapper km_listtheme_filter_wrap">
    <button id="filter_type_bankdays" class="km_listtheme_filter_btn km_filter_heading"><span>' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>
    <div  class="km_bank_type km_primary_border km_listtheme_filter_content">
        <label class="km_checkbox_wrap">
            <span class="km_radio_text">' . __('Purchase Bank Days', 'fieldday') . '</span>
            <input class="km_merchandise" name="km_merchandise"  id="km_merchandise" value="true" type="checkbox" >
            <input type="hidden" name="layout" id="layoutdesign" value="' . $activetheme . '">
            <span class="km_checkbox"></span>
        </label>
    </div>
  </div>';
}

add_filter('fieldday_session_filter_age', 'theme_view_session_filter_age', 11, 2);

function theme_view_session_filter_age($content, $filterKey)
{
    $html = '<div class="km_filter_types select-wrapper km_listtheme_filter_wrap">';
    $html .= '<button id="filter_type_age" class="km_listtheme_filter_btn km_filter_heading"><span><i class="fa fa-child mr-2" aria-hidden="true"></i>&nbsp;' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>';
    $html .= '<div class="km_age_filter_items km_primary_border km_listtheme_filter_content">';
    for ($age = 1; $age <= 20; $age++) {
        $html .= '<label class="km_radio_wrap">
              <span class="km_radio_text">' . $age . '</span>
              <input type="radio" data-search-name="age" name="filters[age]" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="' . $age . '" class="km_session_type">
              <span class="km_radio km_primary_border"></span>
          </label>';
    }
    $html .= '</div>';
    $html .= '</div>';

    return $html;

}
add_filter('fieldday_session_filter_activities', 'theme_view_session_filter_activities', 11, 3);
function theme_view_session_filter_activities($content, $filterKey, $activityTags)
{
    $activities = [];

    $getActivities = fieldday()->api->getFeaturedActivities();
    if ($getActivities->statusCode == 200) {
        foreach ($getActivities->data as $key => $activity) {
            $activities[$activity->_id] = $activity->title;
        }
    }

    $options = "";
    foreach ($activities as $key => $activity_name) {
        $options .= wp_sprintf('<option value="%s">%s</option>', $key, $activity_name);
    }
    $html = '<div class="km_filter_activities km_listtheme_filter_wrap select-wrapper">';
    $html .= '<button id="filter_type_activities" class="km_listtheme_filter_btn km_filter_heading"><span class="km_aCtiviti_Icon_span"><img class="km_aCtiviti_Icon" src="' . fieldday_URL . '/assets/img/activities.png"
    ">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>';
    $html .= '<div class="activitiescontent km_primary_border km_listtheme_filter_content">';
    if ($activities) {
        $html .= '<label class="km_radio_wrap">
                  <span class="km_radio_text">' . __('All', 'fieldday') . '</span>
                  <input checked type="radio" data-filter-title="' . __('All', 'fieldday') . '" data-search-name="activityId" name="filters[activityId]" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="' . __('all', 'fieldday') . '" class="km_activities_type">
                  <span class="km_radio"></span>
        </label>';
        foreach ($activities as $key => $activity_name) {

            if (isset($_REQUEST['activityId'])) {
                $checked = ($key == $_REQUEST['activityId']) ? 'checked' : '';
            } else {
                $checked = ($key == $data['actvityfilterId']) ? 'checked' : '';
            }
            $html .= '<label class="km_radio_wrap">
                  <span class="km_radio_text">' . $activity_name . '</span>
                  <input ' . $checked . ' type="radio" data-filter-title="' . $activity_name . '" data-search-name="activityId" name="filters[activityId]" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="' . $key . '" class="km_activities_type">
                  <span class="km_radio"></span>
              </label>';
        }
    }
    $html .= '</div>';
    $html .= '</div>';

    return $html;

}
