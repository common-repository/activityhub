<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class ElementorfielddayActivitySessionsCopy extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-activity-sessions-copy';
    }

    public function get_title()
    {
        return __('Fieldday Sessions Detailed View', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-posts-justified';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
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
/*
        $this->add_control(
            'activity_layout', [
                'label' => __('View', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1 Column view', 'fieldday'),
                    '2' => __('2 Columns view', 'fieldday'),
                    '3' => __('3 Colums view', 'fieldday'),
                    '4' => __('4 Columns view', 'fieldday'),
                    '5' => __('5 Columns view', 'fieldday'),
                    '6' => __('6 Columns view', 'fieldday')
                ],
                'default' => '3'
            ]
        );
     
        $this->add_control(
            'activity_style', [
                'label' => __('Style', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'alternate' => __('Alternate', 'fieldday'),
                    'simple' => __('Simple', 'fieldday')
                ],
                'default' => '3'
            ]
        );
           */
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
            'show_bringing', [
                'label' => __('Bringing', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_prerequisite', [
                'label' => __('Prerequisites', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_additionalCharges', [
                'label' => __('Additional Charges', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_importantdates', [
                'label' => __('Important Dates', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_dailyRoutineS', [
                'label' => __('Typical Day At Camp', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_extendedcareoptions', [
                'label' => __('Extended Care Options', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_otheroptions', [
                'label' => __('Other Options', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_reviews', [
                'label' => __('Show Reviews', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_pickuplocation', [
                'label' => __('Pick-up & Drop Off Location', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_cancellationPolicy', [
                'label' => __('Cancellation Policy', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
/*
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
*/

        $this->end_controls_section();
    }

    private function wpcap_image_options()
    {
        $this->start_controls_section(
            'section_image_design_options', [
                'label' => __('Image Options', 'fieldday'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'activity_image_effect', [
                'label' => esc_html__('Hover Effect', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'fieldday'),
                    'km_zoom-in' => esc_html__('Zoom In', 'fieldday'),
                    'km_zoom-out' => esc_html__('Zoom Out', 'fieldday'),
                    'km_blur' => esc_html__('Blur', 'fieldday'),
                    'km_slide' => esc_html__('Slide', 'fieldday'),
                    'km_rotate' => esc_html__('Rotate', 'fieldday'),
                    'km_flashing' => esc_html__('Flashing', 'fieldday'),
                    'km_shine' => esc_html__('Shine', 'fieldday'),
                    'km_circle' => esc_html__('Circle', 'fieldday')
                ],
                'default' => 'km_blur',
            ]
        );
        $this->add_control(
            'activity_image_overlay',
            [
                'label' => __('Image Overlay', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_featured_session_img::after' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'img_border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_single_featured_activity .km_featured_session_img',
            ]
        );
        $this->add_control(
            'image_border_radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_featured_session_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_dimension',
            [
                'label' => __( 'Image Dimension', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
                'default' => [
                        'width' => '',
                        'height' => '',
                ],
            ]
        );
        $this->add_control(
            'default_image',
            [
                'label' => __('Default Image', 'fieldday'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function boxDesignOptions()
    {
        $this->start_controls_section(
            'section_box_design_options', [
                'label' => __('Box Options', 'fieldday'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .km_single_featured_activity',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_single_featured_activity',
            ]
        );
        $this->add_control(
            'box-radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box-padding', [
                'label' => __('Box Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box-margin', [
                'label' => __('Box margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_single_featured_activity',
            ]
        );
        $this->end_controls_section();
    }

    private function titleDesginOptions()
    {
        $this->start_controls_section(
                'section_design_options', [
                    'label' => __('Title', 'elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => __('Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_featured_activity_title' => 'color: {{VALUE}};',
                    ]
                ]
        );
        $this->add_control(
            'title-margin', [
                'label' => __('margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_featured_activity_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
            ]
        );
        $this->add_control(
            'title-padding', [
                'label' => __('Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_featured_activity_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'plugin-domain'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .km_featured_activity_title',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .km_featured_activity_title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function contentDesignOptions()
    {
        $this->start_controls_section(
                'section_design_options_description', [
                'label' => __('Content', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_act_heading' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Heading Typography', 'plugin-domain'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .km_act_heading',
            ]
        );

        $this->add_responsive_control(
            'heading_align',
            [
                'label' => esc_html__( 'Heading Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                            'title' => esc_html__( 'Left', 'elementor' ),
                            'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                            'title' => esc_html__( 'Center', 'elementor' ),
                            'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                            'title' => esc_html__( 'Right', 'elementor' ),
                            'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                            'title' => esc_html__( 'Justified', 'elementor' ),
                            'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                        '{{WRAPPER}} .km_act_heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_activity_text , {{WRAPPER}} .km_elem_marker' => 'color: {{VALUE}} !important;',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Text Typography', 'plugin-domain'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .km_activity_text',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .km_activity_text' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'discount-padding', [
                'label' => __('Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_activity_bringing_needs, {{WRAPPER}} .km_activity_daily_routine' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_discount' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'discount-margin', [
                'label' => __('margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_activity_bringing_needs, {{WRAPPER}} .km_activity_daily_routine' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
                'condition' => [
                    'show_discount' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * design controls
     */
    private function wpcap_design_options()
    {
        $this->titleDesginOptions();
        $this->contentDesignOptions();
        $this->wpcap_image_options();
        $this->boxDesignOptions();
    }
     /**
     * filter controls for sessions
     */
    private function wpcap_filter_options()
    {
        $this->start_controls_section(
                'section_filter_options', [
            'label' => __('Filter Options', 'elementor'),
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
            'activity_ids', [
            'label' => esc_html__('Select Activity', 'fieldday'),
            'type' => Controls_Manager::SELECT,
            'options' =>$this->ActivitiesList(),
            /* 'default' => 'all', */
            'condition' => [
                'session_filters' => 'yes',
            ],
                ]
        );
/*
        $this->add_control(
			'sessions_ids',
			[
				'label' => esc_html__( 'Select Sessions', 'plugin-name' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
                'options' => $this->SessionsList($control),
				'default' => [],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                'session_filters' => 'yes',
                ],
			]
		);
*/


        $this->end_controls_section();
    }

    /**
     * get the list of sessions
     * @return array list of all sessions
     */
    private function SessionsList( $control )
    {
        $tagsOptions = ['all' => 'all'];  $filters =[]; $activity_id=[];
        $control = (array) $this; 
        foreach($control as $cont){ 
            if(is_array($cont)){
               $activity_id[] = $cont['settings']['activity_ids']; 
            }
           
        }
        $trimmed_array = array_map('trim', array_filter($activity_id));
         
        foreach($trimmed_array as $trimmed_arr){
            if($trimmed_arr!=''){
                $filter_value = $trimmed_arr;
            }
        }
        $filters['filters']['activityId'] = $filter_value;
        $ProviderSessions = fieldday()->api->GetProviderSessionsNew($filters);
        $sessions_data = $this->getSessionsList($ProviderSessions);
        foreach ($sessions_data as $key => $session)
        {   
            if($filter_value!=""){
            $tagsOptions[$key] = $session;
            }

        }
        return $tagsOptions;
    }    

    private function getSessionsList($sessions, $key = false)
    {
        
        
        $activitys = $sessions->data->sessions; 
        $searchactivitys = [];
        if($activitys){
            //foreach ($activitys as $activity => $singlesessions)
            //{   
                foreach ($activitys as $singleactivitys => $singleactivity)
                {   
                    $searchactivitys[$singleactivity->_id] = wp_sprintf('%s', $singleactivity->name);    
                }
            //}
        }
        return $searchactivitys;
    }

     /**
     * get the list of activities
     * @return array list of activities
     */
    private function ActivitiesList()
    {
        /* $activityOptions = ['all' => 'all']; */
        $activities = fieldday()->api->getFeaturedActivities();
        foreach ($activities->data as $key => $activity)
        {
            $activityOptions[$activity->_id] = $activity->title;
        }
        return $activityOptions;
    }

    private function displaySessionList($SessionsOnly) 
    { 
        $this->settings = $this->get_active_settings(); $filters = [];
        $layoutColumns = $this->settings['activity_layout'];
        $style = fieldday()->engine->getValue('activity_style', $this->settings, false);
        $styleClass = "km_activity_simple";
        if($style == 'alternate') {
            $styleClass = "km_activity_alternate";
        }
        $layoutclass = ["layout_{$layoutColumns}_columns", $this->settings['activity_image_effect']];

        if ($this->settings['activity_ids'] !== 'all')
            {
                $filters['filters']['activityId'] = $this->settings['activity_ids'];
            }
        $let_selected_activity_key = $this->get_active_settings()['activity_ids'];
        $let_selected_activity_key_data = $this->ActivitiesList();
        print "<h1>{$let_selected_activity_key_data[$let_selected_activity_key]}</h1>
        <div style='flex-wrap:wrap;'  class='km_cls_actvty_session_copy km_featured_activities km_row {$styleClass}'>";
        if(!empty($SessionsOnly['sessions']) && $SessionsOnly['sessions'][0]!='all'){ 
            foreach ($SessionsOnly['sessions'] as $key => $sessionname)
            {   
                $session_id = $sessionname; 
                $this->single_session_data($session_id,$layoutclass);
            }
        } else {
            $ProviderSessions = fieldday()->api->GetProviderSessionsNew($filters);
            $sessions_data = $this->getSessionsList($ProviderSessions);
            foreach ($sessions_data as $key => $sessionname)
            {
                $session_id = $key; 
                $this->single_session_data($session_id,$layoutclass);    
            }
        }
        print "</div>";
    }
    private function single_session_data($session_id,$layoutclass){
        $sessionInfo = fieldday()->api->getActivitySessionDetail($session_id);
            if ($sessionInfo->statusCode === 200)
            {
                $session = $sessionInfo->data; 
                $postdata = '';
                $sessiontype = '';
                echo $content = fieldday()->engine->getview('session_detail_for_new_sessions_widget', ['session' => $session, 'tags' => fieldday()->engine->getValue('tags', $postdata, false),'sessiontype'=>$sessiontype ,'page_data' => $this->settings ]);

                /*
                
                print "<div class='km_single_featured_activity km_elem_single_session ". implode(" ", $layoutclass) ."'>";
                $this->SessionTitle($session);
                print "<div class='km_row km_activity_row km_elem_session'>";
                    print "<div class='km_col_5'>";
                        $this->displayFeatureImage($session);
                        $this->displayAge($session);
                        $this->displayDateTime($session);
                        $this->displayReviewStar($session);
                        $this->displayBooking($session);

                    print "</div>";
                    print "<div class='km_col_7'>";
                        $this->displayDescription($session);
                        $this->displayBringingNeeds($session);
                        $this->displayPrerequisite($session);
                        $this->displayAdditionalCharges($session);
                        $this->displayImportantDates($session);
                        $this->displaydailyRoutine($session);
                        $this->displayExtendedCare($session);
                        $this->displayOtherOptions($session);
                        $this->displayPickUpLocation($session);
                        $this->displayCancellationPolicy($session);
                        //$this->displayReviews($session);   
                    print "</div>";
                print "</div>";
                print "</div>";
                */
            } 


            if ($sessionInfo->statusCode !== 200)
            {
                echo fieldday()->engine->displayFlash('error', __($sessionInfo->message, 'fieldday'));
                return;
            }
    }
    protected function render($instance = [])
    {
        // Get settings.
        $filters = []; $SessionsOnly = [];
        $this->settings = $this->get_active_settings();
        if ($this->settings['session_filters'] == 'yes')
        {
            if(array_key_exists('sessions_ids', $this->settings) && is_array($this->settings['sessions_ids'])) {
              $SessionsOnly['sessions'] = $this->settings['sessions_ids'];
            }
        }
        $this->displaySessionList($SessionsOnly);
    }

    /**
     * Display Session Title
     * @param Object $session_name
     * @return String Html output
     */
    private function SessionTitle($session_name)
    {
        if ($this->settings['show_title'] == 'yes')
        {
            print wp_sprintf("<%s class='km_featured_activity_title'>%s</%s>", $this->settings['title_tag'], $session_name->name, $this->settings['title_tag']);
        }
    }

    /**
     * Display session Image
     * @param object $session
     *
     * @return String Html output
     */
    private function displayFeatureImage($session)
    {   
        if ($this->settings['show_image'] == 'yes')
        {   
            $featured_image =  $this->SessionThumb($session);
            print wp_sprintf('<div class="km_featured_session_img"><img style="width:%s; height:%s" src="%s" class="img responsive-img"></div>', $this->settings['image_dimension']['width'], $this->settings['image_dimension']['height'], $featured_image);
        }
    }
    private function SessionThumb($session){
        $sessionPhotoURL = isset($session->activityId->photosURL) ? $session->activityId->photosURL : [];
        $photoOriginal = null;
        $sessionPhotoURL = isset($session->sessionImage->original) ? $session->sessionImage->original: null;
        if ($sessionPhotoURL)
        {
            return $sessionPhotoURL;

        } else  {
            return fieldday_PLACEHOLDER;
        }
    }

    public function displayAge($session)
    {
        $agefrom = $session->ageRange->from ?? $session->activityId->ageRange->from;
        $ageto = $session->ageRange->to ?? $session->activityId->ageRange->to;
        $location = $session->siteLocationId->name;
        $location_state = $session->siteLocationId->state;
        $location_country = $session->siteLocationId->country;
        $location_link = $session->siteLocationId->googleMapUrl;
        $skillLevelOption = fieldday()->engine->getValue('skillLevelOption', $session, false);
        print '<div class="km_row km_common_div">';
        if($skillLevelOption=='grade'){
            $gradefrom = $session->gradeRange->from ?? $session->activityId->gradeRange->from;
            $gradeto = $session->gradeRange->to ?? $session->activityId->gradeRange->to;
            print '<div class="km_age km_no_payment_info km_col_5">
            <i class="fa fa-child km_primary_color km_elem_marker" aria-hidden="true"></i>
            <span class="package_price">Grade(s): '.$gradefrom.' - '.$gradeto.'</span>
            </div>';
        } else {
            print '<div class="km_age km_no_payment_info km_col_5">
            <i class="fa fa-child km_primary_color km_elem_marker" aria-hidden="true"></i>
            <span class="package_price">Age: '.$agefrom.' - '.$ageto.' yrs</span>
            </div>';
        }
        print '<div class="km_location_package_section km_no_payment_info km_col_7">
            <i class="fa fa-map-marker km_elem_marker km_primary_color"></i>
            <span class="km_location_session_details">';
            $open = "window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false";
            print wp_sprintf('<a class="km_activity_text" href="%s" onclick="%s;">%s</a>',$location_link,$open,$location);
            print '</span></div></div>';
    }

    public function displayDateTime($session)
    {   
        $sessionDateFromFilter = date('n', strtotime($session->dateTimestamp->from));
        $sessionDateToFilter = date('n', strtotime($session->dateTimestamp->to));
        print '<div class="km_elem_dt" data-time-stamp-from="'.$session->dateTimestamp->from.'" data-time-stamp-to="'. $session->dateTimestamp->to.'" data-day-type="'.$session_extra["activityType"].'" data-month-from="'.$sessionDateFromFilter.'" data-month-to="'. $sessionDateToFilter.'"> <div class="km_date_time km_common_div km_elem_days">
            <div class="km_date_p02">
                <div class="km_date_p">
                    <i class="fa fa-calendar km_primary_color km_elem_marker" aria-hidden="true"></i>
                    <span class="km_session_month"></span>
                </div>
                <div class="km_date_p">
                    <span class="km_session_year"></span>
                </div>
            </div>
            <div class="km_time_p">
                <i class="fa fa-clock km_primary_color km_elem_marker" aria-hidden="true"></i>
                <span class="km_sess_time"></span>                        
            </div>
            <div class="km_session_days_wrap">';
            fieldday()->engine->sessionDays($session);
            print'</div></div></div>';
    }

    public function displayReviewStar($session)
    {
        print '<div class="km_rating_p km_common_div">
        <b class="km_sess_head km_primary_color">'.__("Rating").'</b>';
        fieldday()->engine->sessionRating($session);
        print '</div>';
    }

    public function displayBooking($session)
    {
        print '<div class="km_detail_bookings km_common_div">
        <b class="km_sess_head km_primary_color">'.__('Bookings Available', "fieldday").'</b><div class="km_hidden">'.fieldday()->engine->sessionBookingTypes($session, $tags, false).'</div>'.fieldday()->engine->sessionBookingavail($session,false).'
        </div>';
    }

    public function displayDescription($session) {
        if(fieldday()->engine->getValue('description', $session, false)) {
            $title = __("About This Session", 'fieldday');
            $description = fieldday()->engine->getValue('description', $session, false);
        }else {
            $title = __("Activity Overview", 'fieldday');
            $description = $session->activityId->overview;
        }
            print "<div class='km_activity_description'>";
                print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $title);
                print wp_sprintf('<span class="km_activity_text">%s</span>', $description);
            print "</div>";
    }

    public function displayBringingNeeds($session)
    {
        if ($this->settings['show_bringing'] == 'yes') {
            $bringingNeedsS = fieldday()->engine->getvalue('bringingNeeds', $session->activityId, false);
            if(!empty($session->activityId->bringingNeedsArr) && $bringingNeedsS!='Na' && $bringingNeedsS!='N/A'): 
            print '<div class="km_bringing_needs km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                <h3 class="km_act_heading km_primary_color">'.__("Bringing Needs", "fieldday").'</h3>
                <div class="km_activity_overview km_bullets_arrow">';
                    if(isset($session->activityId->bringingNeedsArr)): 
                        foreach ($session->activityId->bringingNeedsArr as $key => $bringingNeeds):
                            print '<span class="km_bringing_need_item km_package_description km_activity_text" id="'.$bringingNeeds->_id.'">'.$bringingNeeds->title.'</span>';
                        endforeach; 
                     else:
                            print '<p>'.$session->activityId->bringingNeeds.'</p>';
                   endif;
                print '</div>
            </div>';
            endif;
        }
    }

    public function displayPrerequisite($session)
    {   
        if ($this->settings['show_prerequisite'] == 'yes') {
            //$prerequisitesS = fieldday()->engine->getvalue('prerequisites', $session->activityId, false);
        $prerequisitesArr = fieldday()->engine->getvalue('prerequisitesArr', $session->activityId, false);
        $prerequisitestitle = json_decode(json_encode($prerequisitesArr), true);
        $titlevalue = $prerequisitestitle[0]['title'];

        if($prerequisitesArr && $titlevalue!='Na' && $titlevalue!='NA' && $titlevalue!='N/A') :
            print '<div class="km_bringing_needs km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                <h3 class="km_act_heading km_primary_color">'.__("Prerequisites ", "fieldday").'</h3>
                <div class="km_activity_overview km_bullets_arrow">';
                    if(isset($session->activityId->prerequisitesArr)):
                        foreach ($session->activityId->prerequisitesArr as $key => $prerequisite):
                            print '<span class="km_bringing_need_item km_package_description km_activity_text" id="'.$prerequisite->_id.'">'.$prerequisite->title.'</span>';
                        endforeach;
                    else:
                        print '<p>'.$session->activityId->prerequisites.'</p>';
                    endif;
                print '</div>
            </div>';
            endif;
        }
    }

    public function displayAdditionalCharges($session){
        if ($this->settings['show_additionalCharges'] == 'yes') {
            $additionalCharges = fieldday()->engine->getvalue('additionalCharges', $session, false);
            if($additionalCharges) {
            print "<div class='km_activity_additionalcharges km_field_wrap km_atc_paymentoptions recommendedclassPackages'>";
                print '<h3 class="km_act_heading km_primary_color">'.__("Additional Charges ", "fieldday").'</h3>';
                    foreach($additionalCharges as $key => $additionalCharge) {
                        $additional_price = fieldday()->engine->display_price($additionalCharge->price);
                        print wp_sprintf('<span class="km_activity_text km_additionalcharge_item" id="%1$s">%2$s<span class="km_primary_color km_activity_text"> %3$s </span></span>', $additionalCharge->title, $additionalCharge->title, $additional_price);
                    }
            print "</div>";
            }
        }
    }

    public function displayImportantDates($session)
    {    
        if ($this->settings['show_importantdates'] == 'yes') {
            $important_dates =  fieldday()->engine->getImportantDates($session);
            if($important_dates):
                print "<div class='km_activity_daily_routine'>";
                    print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", 'Important Dates');
                    foreach ($important_dates as $key => $important_date) {
                        print wp_sprintf('<div class="km_important_dates_sec">
                                <div class="km_important_note">%1$s</div>
                                <div class="km_important_dates_info"><i class="fa fa-calendar"></i> %2$s<span> | </span><i class="fa fa-clock"></i> %3$s - %4$s<br>
                                <i class="fa fa-map-marker"></i> %5$s</div>
                            </div>',fieldday()->engine->getValue('note', $important_date,false),fieldday()->engine->getValue('date', $important_date,false),fieldday()->engine->getValue('startTime', $important_date,false),fieldday()->engine->getValue('endTime', $important_date,false),fieldday()->engine->getSiteLocation($session)); 
                    }
                    print "</div>";
            endif;
        }
    }

    public function displaydailyRoutine($session)
    { 
        if ($this->settings['show_dailyRoutineS'] == 'yes') {
        $dailyRoutineS = fieldday()->engine->getvalue('dailyRoutineArr', $session, false);
        $dailyRoutinetitle = json_decode(json_encode($dailyRoutineS), true);
        $titlevalue = $dailyRoutinetitle[0]['title'];
        if(empty($dailyRoutineS) || $titlevalue=='Na' || $titlevalue=='N/A' || $titlevalue=='NA'){ 
            $dailyRoutineS = $session->activityId->dailyRoutineArr;
        }
        $AdailyRoutinetitle = json_decode(json_encode($dailyRoutineS), true);
        $Atitlevalue = $AdailyRoutinetitle[0]['title'];

            if($dailyRoutineS && $Atitlevalue!='Na' && $Atitlevalue!='N/A' && $Atitlevalue!='NA'): 
            print '<div class="km_typical_days km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                <h3 class="km_act_heading km_primary_color">'.__("Typical Day At Camp", "fieldday").'</h3>
                    <div class="km_typical_day km_bullets_arrow">';
                        if(isset($dailyRoutineS)):
                            foreach ($dailyRoutineS as $key => $dailyRoutine):
                                print '<div class="km_typical_day_wrap">
                                    <span class="km_daily_route_item km_package_description km_activity_text" id="'.$dailyRoutine->_id.'">
                                        '.$dailyRoutine->title.'
                                        <small>('.$dailyRoutine->start.' - '.$dailyRoutine->end.')</small>
                                    </span>                                   
                                </div>';
                            endforeach;
                        endif;
                    print '</div>
            </div>';
            endif;
        }
    }

    public function displayExtendedCare($session){
        if ($this->settings['show_extendedcareoptions'] == 'yes') {
            $extendedCareOptions = fieldday()->engine->ExtendedCareOptions($session);
            if($extendedCareOptions):
                print '<div class="km_extendedcare_options km_bullets_arrow km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                        <h3 class="km_act_heading km_primary_color">'.__("Extended Care Options", "fieldday").'</h3>
                        <div class="km_typical_day">'.$extendedCareOptions.'</div>
                </div>';
            endif;
        }
    }

    public function displayOtherOptions($session)
    {   
        if ($this->settings['show_otheroptions'] == 'yes') {
            $sessionOtherOptions = fieldday()->engine->sessionOtherOptions($session);
            if($sessionOtherOptions): 
            print '<div class="km_extendedcare_options km_field_wrap km_atc_paymentoptions recommendedclassPackages km_bullets_arrow">
                    <h3 class="km_act_heading km_primary_color">'.__("Other Options", "fieldday").'</h3>
                    <div class="km_typical_day">'.$sessionOtherOptions.'</div>
            </div>';
            endif;
        } 
    }

    public function displayPickUpLocation($session)
    {   
        $location = $session->siteLocationId->name;
        $location_state = $session->siteLocationId->state;
        $location_country = $session->siteLocationId->country;
        $location_link = $session->siteLocationId->googleMapUrl;
        if ($this->settings['show_pickuplocation'] == 'yes') {
            print '<div class="km_pickup_location km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                <h3 class="km_act_heading km_primary_color">'.__("Pick-up & Drop Off Location", "fieldday").'</h3>
                <div class="km_activity_overview">';
                    $open = "window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false";
                    print wp_sprintf('<span><i class="fa fa-map-marker km_elem_marker km_primary_color"></i><a class="km_activity_text" href="%s" onclick="%s;">%s<span class="km_small km_activity_text">(Click here to get directions)</span></a></span>',$location_link,$open,$location);
                    $address2 = urlencode($address);
                print '</div>
                <div class="km_map"></div>
            </div>';
        }
    }

    public function displayCancellationPolicy($session)
    {   
        if ($this->settings['show_cancellationPolicy'] == 'yes') {
            $cancellationPolicy = fieldday()->engine->getvalue('cancellationPolicy', $session, false); 
            if($cancellationPolicy){
                print '<div class="km_detail_policy km_field_wrap km_atc_paymentoptions recommendedclassPackages">
                    <h3 class="km_act_heading km_primary_color">'.__("Cancellation Policy", "fieldday").'</h3>';
                    $cancellationPolicynote = fieldday()->engine->getvalue('note', $session->cancellationPolicy, false);
                    $cancellationPolicydescription = fieldday()->engine->getvalue('description', $session->cancellationPolicy, false);
                    if($cancellationPolicydescription){
                       print wp_sprintf('<div class=""><span class="km_policy_description km_activity_text">%s</span></div>',$cancellationPolicydescription);
                    }
                    if($cancellationPolicynote){
                       print wp_sprintf('<div class=""><span class="km_policy_note km_activity_text">%s</span></div>',$cancellationPolicynote);
                    }
                    $cancellationPolicyterms = fieldday()->engine->getvalue('terms', $session->cancellationPolicy, false);
                        if($cancellationPolicyterms){
                            print "<ul class='km_policy_terms'>";
                            foreach ($cancellationPolicyterms as $key => $cancellationPolicyItem) {
                                print wp_sprintf('<li class="km_activity_text km_additionalcharge_item" id="%1$s"><i class="fa fa-check km_angle_right"></i> %2$s</li>', $cancellationPolicyItem, $cancellationPolicyItem);
                            }
                            print "</ul>";
                        } 
                print '</div>';
            }
        }
    }

    public function displayReviews($session)
    {
        print'<div class="km_session_reviews km_field_wrap km_atc_paymentoptions recommendedclassPackages">
            <h3 class="km_act_heading km_primary_color">'.__("Reviews", 'fieldday').'</h3>
            <div id="km_session_reviews" class="km_row">'.fieldday()->engine->displaysessionReviews($session).'
            </div>
        </div>';
    }
}