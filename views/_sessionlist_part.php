<?php do_action('before_km_sessions'); ?>
<?php if($sessions->data->sessions): ?>
    <?php print apply_filters("fieldday_session_filterinfo", $this->session_filterinfo($sessions, $filters), $sessions, $filters); ?>
    <section class="program-wrap" data-location-id="<?php echo $session->_id; ?>">
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
        <ul class="km_sessions_list km_list km_grid <?php echo 'km_theme_mode_ul_'.fieldday()->engine->getValue('fieldday_theme_mode', $fielddaySetting, false); ?>">
            <?php 
            echo fieldday()->engine->getView('session_loop', ['sessions' => $sessions->data->sessions, 'permalink' => get_the_permalink(), 'filters' => $filters, 'tagId' => $tagId]); ?>
        </ul>
    </section>
<?php endif; ?>
