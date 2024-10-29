<?php do_action('before_km_sessions'); 
// Ensure $sessions is defined and has the necessary data
if (isset($sessions->data->sessions)) {
    $groupSessionListing = $sessions->data->groupSessionListing;

    print '<div class="filters_info_records">';
    $sectioncount = count($sessions->data->sessions);

    // Make sure these filters are properly hooked
    print apply_filters("fieldday_session_filterinfo", $this->session_recordsinfo($sectioncount, $filters), $sectioncount, $filters);
    print apply_filters("fieldday_session_filterinfo", $this->session_filterinfo($sessions, $filters), $sessions, $filters);
    print '</div>';
    ?>
    
    <section class="program-wrap" data-location-id="<?php echo $sessions->_id; ?>">
        <div class="km_sessionlist_head" id="km_sessionlist_head_two_layout">
        </div>
        <div class="wrap">
            <div class="session-container__list__icons">
                <div class="session-container__list__icons--date">
                </div>
                <div class="session-container__list__icons--time">
                </div>
                <div class="session-container__list__icons--amount">
                </div>
            </div>
        </div>
        <ul class="km_sessions_list km_list km_grid <?php echo 'km_theme_mode_ul_'.fieldday()->engine->getValue('fieldday_theme_mode', $fielddaySetting, false); ?>" id="km_sessions_list_two_column_layout">
            <?php echo fieldday()->engine->getView('session_loop', [
                'sessions' => $sessions->data->sessions, // Corrected from $session->sessions
                'permalink' => get_the_permalink(),
                'filters' => $filters,
                'location' => $location,
                'location_link' => $location_link,
                'tagId' => $tagId,
                'groupSessionListing' => $groupSessionListing
            ]); ?>
        </ul>
    </section>

<?php }else{ ?>
    <div class="km_center_align_div">
        <a href="javascript:void(0);" class="km_btn km_primary_bg km_clear_session_filters">
            <?php $this->displayText('km_clear_session_filters_btn_text'); ?>
        </a>
    </div>
    <div class='km_nodata'>
        <?php $this->displayText('km_no_session_found'); ?>
    </div>
<?php } ?>
