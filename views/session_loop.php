<?php
//print apply_filters("fieldday_session_recordsinfo", $this->session_recordsinfo($sessions->data->sessions, $filters), $sessions->data->sessions, $filters);
if($sessions) {
    if(!isset($tagId)) $tagId = null;
    foreach($sessions as $counter => $mySession) {
        echo fieldday()->engine->getView('single_session', ['session' => $mySession, 'permalink' => $permalink, 'tagId' => $tagId]);
    }
}else {
    echo wp_sprintf("<div class='km_nodata'>%s</div>", __("No session found. Please try again or use other filters"));
}