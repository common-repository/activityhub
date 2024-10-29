<?php
if (!defined('ABSPATH')) // Or some other WordPress constant
{
    exit;
}

add_filter('fieldday_session_filter_location', 'theme_view_session_filter_location', 11, 2);

function theme_view_session_filter_location($locations, $filterKey)
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
    return '<div class="km_filter_location select-wrapper">
      <h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
      <div class="km_custom_dropdown">
          <select data-search-name="location" onchange="return fieldday.processSessionFilters(this, event);" id="km_location_search" class="km_session_search session-search_location km_input" name="filters[location]">
              <option value="all">' . __('All Locations', 'fieldday') . '</option>
              ' . $options . '
          </select>
      </div>
  </div>';

}

add_filter('fieldday_session_filter_search', 'theme_view_session_filter_search', 11, 2);

function theme_view_session_filter_search()
{

    return '
   <div class="km_filter_type select-wrapper">
  <br>
   <input id="km_session_search_keyword"  oninput="fieldday.kmRemoveExtraSpacesFromValue(this,event,false);"   data-search-name="searchKey" type="text" class="searchInput km_input" name="filters[searchKey]" placeholder="Search Keywords…"/></div>';
}

add_filter('fieldday_session_filter_types', 'theme_view_session_filter_types', 11, 3);

function theme_view_session_filter_types($tagId, $filterKey, $activityTags)
{
    $html = '<div class="km_filter_types select-wrapper">';
    $html .= '<h3  class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>';
    $html .= '<div>';
    foreach ($activityTags as $key => $type) {
        $checked = ($type->_id == $data['tagId']) ? 'checked' : '';
        $tagTitle = $type->wpShowTitle ? $type->wpShowTitle : $type->title;
        $html .= '<label class="km_radio_wrap">
              <span class="km_radio_text">' . $tagTitle . '</span>
              <input ' . $checked . ' type="radio" data-filter-title="' . $type->title . ' camp" name="tagId" data-url="" onchange="return fieldday.processSessionFilters(this, event);" value="' . $type->_id . '" class="km_session_type">
              <span class="km_radio"></span>
          </label>';
    }
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

add_filter('fieldday_session_filter_age', 'theme_view_session_filter_age', 11, 2);

function theme_view_session_filter_age($content, $filterKey)
{

    $html = '<div class="km_filter_age select-wrapper">';
    $html .= '<h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
  <div class="km_custom_dropdown">
      <select data-search-name="age" onchange="return fieldday.processSessionFilters(this, event);" id="age-search" class="session-search session-search_age km_input" name="filters[age]">
          <option value="all">All</option>';
    for ($age = 1; $age <= 20; $age++) {
        $html .= '<option value="' . $age . '">' . $age . '</option>';
    }
    $html .= '</select>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}
add_filter('fieldday_session_filter_type', 'theme_view_session_filter_type', 11, 2);

function theme_view_session_filter_type($content, $filterKey)
{
    return '<div class="our-program__form--type">
  <h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
  <div class="km_custom_dropdown">
      <select data-search-name="type" onchange="return fieldday.processSessionFilters(this, event);" id="type-search" class="session-search km_input" name="filters[type]">
          <option value="all">' . __("All", 'fieldday') . '</option>
          <option value="camp">' . __("Camp", 'fieldday') . '</option>
          <option value="class">' . __("Class", 'fieldday') . '</option>
      </select>
  </div>
</div>';
}

add_filter('fieldday_session_filter_month', 'theme_view_session_filter_month', 11, 2);

function theme_view_session_filter_month($content, $filterKey)
{
    $html = '<div class="km_filter_month select-wrapper">';
    $html .= '<h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
  <div class="km_custom_dropdown">
      <select data-search-name="month" onchange="return fieldday.processSessionFilters(this, event);" id="month-search" class="session-search session-search_month km_input" name="filters[month]">
          <option value="all">All</option>';
    foreach (fieldday()->engine->KmMonths() as $key => $month) {
        $html .= '<option value="' . ($key - 1) . '">' . $month . '</option>';
    }
    $html .= '</select>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

add_filter('fieldday_session_filter_bankdays', 'theme_view_session_filter_bankdays', 11, 2);

function theme_view_session_filter_bankdays($content, $filterKey)
{
    return '<div class="km_filter_type select-wrapper">
  <h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
  <div>
      <label class="km_checkbox_wrap">
          <span class="km_radio_text">' . __('Purchase Bank Days', 'fieldday') . '</span>
          <input class="km_merchandise" name="km_merchandise"  id="km_merchandise" value="true" type="checkbox" ><br>
          <input type="hidden" name="layout" id="layoutdesign" value="' . $activetheme . '">
          <span class="km_checkbox"></span>
      </label>
  </div>
</div>';
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

    $html = '<div class="km_filter_activities select-wrapper" >
  <h3 class="km_filter_heading km_primary_color">' . fieldday()->engine->getValue($filterKey, fieldday()->engine->fielddayFilters(), false) . '</h3>
  <div class="km_custom_dropdown">
      <select data-search-name="activityId" onchange="return fieldday.processSessionFilters(this, event);" id="activity-search" class="session-search session-search_activity km_input" name="filters[activityId]">
          <option value="all">All</option>';
    foreach ($activities as $key => $activity_name) {
        $html .= '<option value="' . $key . '">' . $activity_name . '</option>';
    }
    $html .= '</select>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;

}
