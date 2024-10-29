<?php

//print apply_filters("fieldday_session_recordsinfo", $this->session_recordsinfo($sessions, $filters), $sessions, $filters);

if($sessions) {
	//echo $tagId;
    if(!isset($tagId)) $tagId = null;
    foreach($sessions as $counter => $mySession) {
        $location='';
        $location.="&nbsp;".$mySession->siteLocationId->name."&nbsp;";
        $location_link = $mySession->siteLocationId->googleMapUrl;
        echo fieldday()->engine->getView('single_session', ['session' => $mySession, 'permalink' => $permalink,'location'=>$location,  'location_link'=> $location_link,'tagId' => $tagId, 'groupSessionListing'=>$groupSessionListing]);
    }
}else {
    echo wp_sprintf("<div class='km_nodata'>%s</div>", __("No session found. Please try again or use other filters"));
}
