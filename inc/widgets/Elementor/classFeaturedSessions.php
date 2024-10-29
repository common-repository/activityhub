<?php

namespace fielddayWidget\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

/**
 * @since 1.1.0
 */
class ElementorfielddayFeaturedSession extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-featured-sessions';
    }

    public function get_title()
    {
        return __('Fieldday Featured Sessions', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
        $this->wpcap_box_layout_options();
        $this->wpcap_design_options();
        $this->wpcap_filter_options();
    }

    /**
     * Content Layout Options.
     */
    private function wpcap_content_layout_options()
    {

        $this->start_controls_section(
            'section_layout', [
                'label' => esc_html__('Layout', 'fieldday'),
            ]
        );
        $this->add_control(
            'session_layout', [
                'label' => __('View', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1 Column view', 'fieldday'),
                    '2' => __('2 Columns view', 'fieldday'),
                    '3' => __('3 Colums view', 'fieldday'),
                    '4' => __('4 Columns view', 'fieldday'),
                    '5' => __('5 Columns view', 'fieldday'),
                    '6' => __('6 Columns view', 'fieldday'),
                ],
                'default' => '3',
            ]
        );
        $this->add_control(
            'show_image', [
                'label' => __('Image', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __('Title HTML Tag', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_learn_more', [
                'label' => __('Learn More', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'read_more_text', [
                'label' => __('More Information Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More', 'fieldday'),
                'condition' => [
                    'show_learn_more' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'purchase_text', [
                'label' => __('Purchase Button Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Purchase', 'fieldday'),
            ]
        );
        $this->end_controls_section();
    }

    /**
     * layout controls
     */
    private function wpcap_box_layout_options()
    {
        $this->start_controls_section(
            'section_box_options', [
                'label' => __('Box Options', 'fieldday'),
            ]
        );
        $this->add_control(
            'entrance_animation',
            [
                'label' => __('Entrance Animation', 'fieldday'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );
        $this->add_control(
            'box_image_effect', [
                'label' => esc_html__('Hover Effect', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'km_zoom-in' => esc_html__('Zoom In', 'fieldday'),
                    'km_zoom-out' => esc_html__('Zoom Out', 'fieldday'),
                    'km_blur' => esc_html__('Blur', 'fieldday'),
                    'km_slide' => esc_html__('Slide', 'fieldday'),
                    'km_rotate' => esc_html__('Rotate', 'fieldday'),
                    'km_flashing' => esc_html__('Flashing', 'fieldday'),
                    'km_shine' => esc_html__('Shine', 'fieldday'),
                    'km_circle' => esc_html__('Circle', 'fieldday'),
                ],
                'default' => 'km_blur',
            ]
        );
        $this->add_control(
            'box_background',
            [
                'label' => __('Box Default Image', 'fieldday'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'box_color',
            [
                'label' => __('Box Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_single' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'box_overlay_color',
            [
                'label' => __('Box Overlay', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_single .km_featured_session_img::after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_featured_single',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#ccc',
                    ],
                ],
            ]
        );
        $this->add_control(
            'box-radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_featured_single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 15,
                    'left' => 15,
                    'bottom' => 15,
                    'right' => 15,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );
        $this->add_control(
            'box-padding', [
                'label' => __('Box Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_featured_single .km_featured_session_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_featured_single',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * design controls
     */
    private function wpcap_design_options()
    {
        $this->start_controls_section(
            'section_design_options', [
                'label' => __('Design Options', 'elementor'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_session_title' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'address_color',
            [
                'label' => __('Address Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_session_location a' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'age_color',
            [
                'label' => __('Age Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_age' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'seats_color',
            [
                'label' => __('Seats Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_availspots ' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => __('Price Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_session_price' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label' => __('Date Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_date' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'time_color',
            [
                'label' => __('Time Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_time' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'learn_more_back_color',
            [
                'label' => __('Learn More Button Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_learn_more_btn' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'learn_more_color',
            [
                'label' => __('Learn More Button Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_learn_more_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'purchase_back_color',
            [
                'label' => __('Purchase Button Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_btns .km_feature_purchase_btn' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'purchase_color',
            [
                'label' => __('Purchase Button Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_featured_btns .km_feature_purchase_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * filter controls
     */
    private function wpcap_filter_options()
    {
        $this->start_controls_section(
            'section_filter_options', [
                'label' => __('Filter Options', 'elementor'),
            ]
        );

        $this->add_control(
            'session_group_by', [
                'label' => __('Group Sessions By Activity', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fieldday'),
                'label_off' => __('No', 'fieldday'),
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'session_filters', [
                'label' => __('Enable Filters', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'fieldday'),
                'label_off' => __('No', 'fieldday'),
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'session_tag_id', [
                'label' => esc_html__('Session Type', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => self::activityTags(),
                'default' => 'all',
                'condition' => [
                    'session_filters' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'session_activity_id', [
                'label' => esc_html__('Activity', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => self::activitiesList(),
                'default' => 'all',
                'condition' => [
                    'session_filters' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'session_age_from', [
                'label' => esc_html__('Age From', 'fieldday'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 30,
                'step' => 1,
                'default' => 1,
                'condition' => [
                    'session_filters' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'session_age_to', [
                'label' => esc_html__('Age To', 'fieldday'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 99,
                'default' => 10,
                'step' => 1,
                'condition' => [
                    'session_filters' => 'yes',
                ],
            ]
        );
    }

    /**
     * get the list of activities
     * @return array list of activities
     */
    private function activitiesList()
    {
        $activityOptions = ['all' => 'all'];
        $activities = fieldday()->api->homeSessionActivities();
        foreach ($activities->data as $key => $activity) {
            $activityOptions[$activity->_id] = $activity->title;
        }
        return $activityOptions;
    }

    /**
     * get the list of activity tags
     * @return array list of activity tags
     */
    private function activityTags()
    {
        $tagsOptions = ['all' => 'all'];
        $activityTags = fieldday()->api->getActivityTagsCount();
        foreach ($activityTags->data as $key => $tags) {
            $tagsOptions[$tags->_id] = $tags->title;
        }
        return $tagsOptions;
    }

    /**
     * normalize sessions
     * @param mixed $sessions
     */
    protected function normalizedSessions($sessions)
    {
        if ($this->settings['session_group_by'] == 'yes') {
            $grouppedsessions = [];
            foreach ($sessions as $key => $session) {
                $grouppedsessions[$session->activityId->title][] = $session;
            }

            return $grouppedsessions;
        }
        return $sessions;
    }

    private function displaySessionList($featuredSession)
    {

        $sessions = $this->normalizedSessions($featuredSession->data->sessions);
        print '<div class="km_featured_sessions_wrap ' . $this->settings['entrance_animation'] . '" id="km_featureed_session">';
        print $this->hiddenSessionTags($featuredSession->data);
        if ($this->settings['session_group_by'] == 'yes') {
            foreach ($sessions as $activityName => $activitysessions) {
                print wp_sprintf('<h3 class="km_session_group">%s</h3>', $activityName);
                print '<div class="km_featured_sessions km_featured_session_widget">';
                foreach ($activitysessions as $key => $session) {
                    print $this->singleSession($session);
                }
                print '</div>';
            }
        } else {
            print '<div class="km_featured_sessions km_featured_session_widget">';
            foreach ($sessions as $key => $session) {
                print $this->singleSession($session);
            }
            print '</div>';
        }
        print '</div>';
    }

    /**
     * display single session
     * @param mixed $HomeSessions
     */
    private function singleSession($featuredSession)
    {

        $layoutColumns = $this->settings['session_layout'];
        $layoutclass = ["layout_{$layoutColumns}_columns", $this->settings['box_image_effect']];

        $html = '<div class="km_session_single_item km_featured_single ' . implode(" ", $layoutclass) . '" data-time-stamp-from="' . $featuredSession->dateTimestamp->from . '" data-time-stamp-to="' . $featuredSession->dateTimestamp->to . '">';
        $html .= $this->displayFeatureImage($featuredSession);
        $html .= '<div class="km_featured_session_content">';
        $html .= $this->sessionTitle($featuredSession);
        $html .= $this->SessionLocation($featuredSession);

        $html .= '<div class="km_common km_featured_ageSeat">';
        $html .= $this->sessionAge($featuredSession);
        $html .= $this->SessionSpots($featuredSession);
        $html .= '</div>';
        $html .= $this->sessionDateTime($featuredSession);

        $html .= $this->SessionPrice($featuredSession);
        $html .= '<div class="km_featured_btns">';
        $html .= $this->moreInfoButton($featuredSession);
        $html .= $this->purchaseButton($featuredSession);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    protected function render($instance = [])
    {
        // Get settings.
        $filters = [];
        $this->settings = $this->get_active_settings();
        if ($this->settings['session_filters'] == 'yes') {
            if ($this->settings['session_tag_id'] !== 'all') {
                $filters['tagId'] = $this->settings['session_tag_id'];
            }
            if ($this->settings['session_activity_id'] !== 'all') {
                $filters['filters']['activityId'] = $this->settings['session_activity_id'];
            }
            if ($this->settings['session_age_from'] && $this->settings['session_age_to']) {
                $filters['filters']['age']['from'] = $this->settings['session_age_from'];
                if ($this->settings['session_age_to'] > $this->settings['session_age_from']) {
                    $filters['filters']['age']['to'] = $this->settings['session_age_to'];
                } else {
                    $filters['filters']['age']['to'] = $this->settings['session_age_from'];
                }
            }
        }

        $featuredSession = fieldday()->api->getFeaturedSession($filters);
        if ($featuredSession->statusCode !== 200) {
            echo fieldday()->engine->displayFlash('error', __($featuredSession->message, 'fieldday'));
            return;
        }

        $this->displaySessionList($featuredSession);
    }

    /**
     * add hidden fields for tags Id
     * @param array $session
     */
    private function hiddenSessionTags($session)
    {
        return wp_sprintf("<input type='hidden' id='km_session_tags' value='%s'>", json_encode($session->bookingTypeTags));
    }

    /**
     *
     * @param array $session
     */
    private function moreInfoButton($session)
    {
        if ($this->settings['show_learn_more'] == 'yes') {
            return wp_sprintf('<a href="javascript:void(0);" onclick="return fieldday.viewSessionDetail(\'%s\');" class="km_btn km_learn_more_btn km_transparent_bg km_primary_color">%s</a>', $session->_id, $this->settings['read_more_text']);
        }
    }

    /**
     * display purchase button
     * @param Object $session
     */
    private function purchaseButton($session)
    {
        global $fielddaySetting;
        $oneDaySelectedDate = fieldday()->engine->getValue('oneDaySelectedDate', $session, false);
        $tagId = $session->sessionTypeTag;
        global $KmUser;

        if (!is_user_logged_in() && !current_user_can(fieldday_ROLE) && !$KmUser) {
            $showAuthPopup = wp_sprintf('data-session-id="%s" data-tag-id="%s" data-session-date="%s" data-session-featured="%s" onclick="fieldday.showAuthPopup(this, event)"', $session->_id, $tagId, $session->dateTimestamp->from, "");
        } else {
            $showAuthPopup = wp_sprintf('onclick="fieldday.registerSession(\'%s\', \'%s\', \'%s\', \'%s\')"', $session->_id, $tagId, $session->dateTimestamp->from, "");
        }

        if ($session->eveningKidRegistration || $session->morningKidRegistration || $session->oneDayKidRegistration) {
            if ($session->bookingStatus == 'open' || $session->bookingStatus == 'waitlist') {
                return wp_sprintf('<a href="javascript:void(0);" ' . $showAuthPopup . ' class="km_btn km_feature_purchase_btn km_primary_bg">%s</a>', $this->settings['purchase_text']);
            } else {
                return wp_sprintf('<a href="javascript:void(0);" class="disabled km_btn km_session_btn km_primary_bg">%s</a>', __('Registration Full', 'fieldday'));
            }
        } else {if ($session->bookingStatus == 'open' || $session->bookingStatus == 'waitlist') {
            return wp_sprintf('<a href="javascript:void(0);" ' . $showAuthPopup . ' class="km_btn km_feature_purchase_btn km_primary_bg">%s</a>', $this->settings['purchase_text']);
        } else {
            return wp_sprintf('<a href="javascript:void(0);" class="disabled km_btn km_session_btn km_primary_bg">%s</a>', __('Registration Full', 'fieldday'));
        }}
    }

    /**
     * get the session Date and time
     * @param Object $session
     */
    private function sessionDateTime($session)
    {
        $datetime = '<span class="km_featured_date"><div class="km_date_p"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span class="km_session_month"></span></div><div class="km_date_p"><span class="km_session_year"></span></div></span>';

        $datetime .= '<span class="km_featured_time"><i class="fa fa-clock km_primary_color" aria-hidden="true"></i><span class="km_sess_time"></span></span>';

        return $datetime;
    }
    /**
     * get the session Age
     * @param Object $session
     */
    private function sessionAge($session)
    {
        $ageRange = fieldday()->engine->getValue('ageRange', $session, false);
        $skillLevelOption = fieldday()->engine->getValue('skillLevelOption', $session, false);
        if ($skillLevelOption == 'grade') {
            $gradeRange = fieldday()->engine->getValue('gradeRange', $session, false);
            $age = wp_sprintf('<span class="km_featured_age"><i class="fa fa-child km_primary_color" aria-hidden="true"></i>Grade(s): %s-%s</span>', $gradeRange->from, $gradeRange->to);
        } else {
            if ($ageRange) {
                $age = wp_sprintf('<span class="km_featured_age"><i class="fa fa-child km_primary_color" aria-hidden="true"></i>Age: %s-%s yrs</span>', $ageRange->from, $ageRange->to);
            }
        }
        return $age;
    }

    private function SessionSpots($session)
    {
        $availspot = fieldday()->engine->getValue('availableSpots', $session, false);
        $alert_class = '';
        if ($availspot > 0 && $session->bookingStatus == 'open') {
            if ($availspot < 5) {$alert_class = 'km_alert_red';}
            $spots = wp_sprintf('<span class="km_featured_availspots %s"><i class="fa fa-clipboard-check km_primary_color"></i>Seat Available: %s</span>', $alert_class, $availspot);
        }
        return $spots;
    }

    private function SessionLocation($session)
    {
        $location = $session->siteLocationId->name;
        $location_state = $session->siteLocationId->state;
        $location_country = $session->siteLocationId->country;
        $location_link = "https://www.google.com/maps/place/" . $location . ",+" . $location_state . ",+" . $location_country;
        $open = "window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false";
        $Sessionlocation = wp_sprintf('<span class="km_session_location"><i class="fa fa-map-marker km_primary_color"></i><a href="%s" onclick="%s;">%s</a></span>', $location_link, $open, $location);

        return $Sessionlocation;

    }

    private function SessionPrice($session)
    {
        $sessionsPrices = fieldday()->engine->sessionBookingavail($session, true);
        return $sessionsPrices;
    }

    /**
     * Display session Image
     * @param object $session
     *
     * @return String Html output
     */
    private function displayFeatureImage($session)
    {
        $featuredImg = fieldday()->engine->getValue('sessionImage', $session, false);
        $thumburl = fieldday()->engine->getValue('thumbnail', $featuredImg, false);
        if (!$thumburl) {
            $thumburl = $this->settings['box_background']['url'];
        }
        if ($this->settings['show_image'] == 'yes' && $thumburl) {
            return wp_sprintf('<div class="km_featured_session_img"><img src="%s" class="img responsive-img"></div>', $thumburl);
        }
    }

    /**
     * Display session Title
     * @param Object $session
     * @return String Html output
     */
    private function sessionTitle($session)
    {
        if ($this->settings['show_title'] == 'yes') {
            return wp_sprintf("<%s class='km_featured_session_title km_primary_color'>%s</%s>", $this->settings['title_tag'], $session->name, $this->settings['title_tag']);
        }
    }

}
