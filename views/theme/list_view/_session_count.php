<?php do_action('before_km_sessions'); 

if($sessions->data->sessions): ?>
<?php
print '<div class="filters_info_records">';
  //print apply_filters("fieldday_session_filterinfo", $this->session_filterinfo($sessions, $filters), $sessions, $filters);

$sectioncount = 0;
foreach ($sessions->data->sessions as $session) :

 $sectioncount+= count($session->sessions);
 endforeach;
 print apply_filters("fieldday_session_filterinfo", $this->session_recordsinfo($sectioncount, $filters ), $sectioncount, $filters);
print apply_filters("fieldday_session_filterinfo", $this->session_filterinfo($sessions, $filters), $sessions, $filters);

 print '</div>';
endif; ?>
