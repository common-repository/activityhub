<?php

if (!defined('ABSPATH')) // Or some other WordPress constant
{
    exit;
}

add_filter('fieldday_session_filter_location', 'theme_view_session_filter_location', 11, 2);

function theme_view_session_filter_location($locations)
{

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
    return '<div class="km_col_3 km_session_location_filter select-wrapper testing">
    <i class="fa fa-map-marker" aria-hidden="true" style="top: 13px;"></i>
          <select data-search-name="location" onchange="return fieldday.processSessionFilters(this, event);" id="km_location_search" class="km_session_search session-search_location km_input" name="filters[location]">
              <option value="all">' . __('All Locations', 'fieldday') . '</option>
              ' . $options . '
          </select>

  </div>';
}

add_filter('fieldday_session_filter_search', 'theme_view_session_filter_search', 11, 2);

function theme_view_session_filter_search()
{
    return '<div class="km_col_3 select-wrapper">
      <input id="km_session_search_keyword"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"    data-search-name="searchKey" type="text" class="searchInput km_input" name="filters[searchKey]" placeholder="Search Keywords…"/></div>';
}

add_filter('fieldday_session_filter_types', 'theme_view_session_filter_types', 11, 3);
function theme_view_session_filter_types($content, $tagId, $activityTags)
{
    $html = '<div class="km_col_7">';
    $useragent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis', $useragent)) {
        $html .= "<div class='km_show_mobile'>";
        $html .= "<select name='tagId' class='km_input km_session_type' onchange='return fieldday.filterByTag(this, event);'>";
        foreach ($activityTags as $key => $type) {
            $checked = ($type->_id == $data['tagId']) ? 'selected' : '';
            $isActive = ($type->_id == $data['tagId']) ? 'km_active_filter' : '';
            $tagTitle = $type->wpShowTitle ? $type->wpShowTitle : $type->title;
            $html .= '<option ' . $checked . ' value="' . $type->_id . '">' . $tagTitle . '</opion>';
        }
        $html .= "</select>";
        $html .= '</div>';
    } else {

        $html .= "<div class='km_hide_mobile'><div class='km_filter_types select-wrapper'>";
        foreach ($activityTags as $key => $type) {
            $checked = ($type->_id == $data['tagId']) ? 'checked' : '';
            $isActive = ($type->_id == $data['tagId']) ? 'km_active_filter km_primary_bg' : '';
            $tagTitle = $type->wpShowTitle ? $type->wpShowTitle : $type->title;
            $html .= '<label class="km_radio_wrap_filterd km_secondary_hover_bg' . $isActive . '">
                  <span class="km_radio_text">' . $tagTitle . '</span>
                  <input ' . $checked . ' type="radio" data-filter-title="' . $type->title . ' camp" name="tagId" data-url="" onchange="return fieldday.filterByTag(this, event);" value="' . $type->_id . '" class="km_session_type">
              </label>';
        }
        $html .= '</div></div>';
    }

    $html .= '</div>';

    return $html;
}
add_filter('fieldday_session_filter_activities', 'theme_view_session_filter_activities', 11, 2);
function theme_view_session_filter_activities($content, $filterKey)
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
    return '<div class="km_filter_activity select-wrapper">

            <div class="km_custom_dropdown_n">


                <select data-search-name="activityId" onchange="return fieldday.processSessionFilters(this, event);" id="km_activity_search" class="km_session_search session-search_activity" name="filters[activityId]">
                  <option value="all">All ' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</option>
                  ' . $options . '
                </select>

            </div>
        </div>';
}
