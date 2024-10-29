<?php
print apply_filters("fieldday_session_recordsinfo", $this->session_recordsinfo($sessions, $filters), $sessions, $filters);

// echo"<pre>";
// print_r($sessions);
// echo"</pre>";
if($sessions) {
	
	//echo $tagId;
    if(!isset($tagId)) $tagId = null;
    foreach($sessions as $counter => $mySession) {
        $location='';
        $location.="&nbsp;".$mySession->siteLocationId->name."&nbsp;";
        $location_link = $mySession->siteLocationId->googleMapUrl;
        echo fieldday()->engine->getView('layout/single_session', ['session' => $mySession, 'permalink' => $permalink, 'tagId' => $tagId]);
    }
}else {
    echo wp_sprintf("<div class='km_nodata'>%s</div>", __("No session found. Please try again or use other filters"));
} 