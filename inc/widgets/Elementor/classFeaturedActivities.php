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
class ElementorfielddayFeaturedActivities extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-activities';
    }

    public function get_title()
    {
        return __('Fieldday Activities', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-posts-justified';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
        $this->wpcap_description_options();
        $this->wpcap_bringingNeeds_options();
        $this->wpcap_prerequisites_options();
        $this->wpcap_extendedCareOptions_options();
        $this->wpcap_additionalCharges_options();
        $this->wpcap_cancellationPolicy_options();  
        $this->wpcap_totalSessions_options(); 
        $this->wpcap_routine_options();
        $this->wpcap_age_options();
        $this->wpcap_discount_options();
        $this->wpcap_design_options();
        $this->wpcap_button_options();
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


    private function wpcap_bringingNeeds_options()
    {
        $this->start_controls_section(
            'section_needs_options', [
                'label' => __('Bringing Needs', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_bringing_needs', [
                'label' => __('Show Bringing Needs', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Bringing Needs', 'fieldday'),
                'condition' => [
                    'show_bringing_needs' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_needs_max_words', [
                'label' => __('Max Words', 'fieldday'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'show_bringing_needs' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_needs_readmore', [
                'label' => __('Read More Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('read more', 'fieldday'),
                'condition' => [
                    'show_bringing_needs' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function wpcap_additionalCharges_options()
    {
        $this->start_controls_section(
            'section_additionalcharges_options', [
                'label' => __('Additional Charges', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_additionalCharges', [
                'label' => __('Show Additional Charges', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'additionalCharges_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Additional Charges', 'fieldday'),
                'condition' => [
                    'show_additionalCharges' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    
    private function wpcap_totalSessions_options()
    {
        $this->start_controls_section(
            'section_totalsessions_options', [
                'label' => __('Sessions Available', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_totalSessions', [
                'label' => __('Show Available Sessions', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'totalSessions_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Sessions Available', 'fieldday'),
                'condition' => [
                    'show_totalSessions' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_cancellationPolicy_options()
    {
        $this->start_controls_section(
            'section_policy_options', [
                'label' => __('Cancellation Policy', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_cancellationPolicy', [
                'label' => __('Show Cancellation Policy', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cancellationPolicy_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Cancellation Policy', 'fieldday'),
                'condition' => [
                    'show_cancellationPolicy' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_extendedCareOptions_options()
    {
        $this->start_controls_section(
            'section_extendedcare_options', [
                'label' => __('Extended Care', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_extendedCare', [
                'label' => __('Show Extended Care', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'extendedCare_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Extended Care', 'fieldday'),
                'condition' => [
                    'show_extendedCare' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_prerequisites_options()
    {
        $this->start_controls_section(
            'section_prerequisites_options', [
                'label' => __('Prerequisite', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_prerequisites', [
                'label' => __('Show Prerequisite', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'prerequisites_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Prerequisite', 'fieldday'),
                'condition' => [
                    'show_prerequisites' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_age_options()
    {
        $this->start_controls_section(
            'section_age_options', [
                'label' => __('Age Group', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_age_group', [
                'label' => __('Show Age Group', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_age_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Ages', 'fieldday'),
                'condition' => [
                    'show_age_group' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'description_age_year_txt', [
                'label' => __('year text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('yrs', 'fieldday'),
                'condition' => [
                    'show_age_group' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }
    private function wpcap_discount_options()
    {
        $this->start_controls_section(
            'section_discount_options', [
                'label' => __('Discounts', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_discount', [
                'label' => __('Show Dates', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'discount_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Discounts', 'fieldday'),
                'condition' => [
                    'show_discount' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_routine_options()
    {
        $this->start_controls_section(
            'section_routine_options', [
                'label' => __('Daily Routine', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_daily_routine', [
                'label' => __('Show Description', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_routine_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Daily Routine', 'fieldday'),
                'condition' => [
                    'show_daily_routine' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_routine_max_words', [
                'label' => __('Max Words', 'fieldday'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'show_daily_routine' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_routine_readmore', [
                'label' => __('Read More Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('read more', 'fieldday'),
                'condition' => [
                    'show_daily_routine' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    private function wpcap_description_options()
    {
        $this->start_controls_section(
            'section_description_options', [
                'label' => __('Description', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_description', [
                'label' => __('Show Description', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_exp_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Class Experience', 'fieldday'),
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_exp_max_words', [
                'label' => __('Max Words', 'fieldday'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'description_exp_readmore', [
                'label' => __('Read More Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('read more', 'fieldday'),
                'condition' => [
                    'show_description' => 'yes',
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
                    '{{WRAPPER}} .km_activity_text' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_activity_bringing_needs, {{WRAPPER}} .km_activity_daily_routine, {{WRAPPER}} .km_activity_prerequisite, {{WRAPPER}} .km_activity_extendedCare, {{WRAPPER}} .km_activity_policy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
                /*'condition' => [
                    'show_discount' => 'yes',
                ],*/
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
                /*'condition' => [
                    'show_discount' => 'yes',
                ],*/
            ]
        );
        $this->end_controls_section();
    }

    private function buttonDesignOptions()
    {
        //button controls
        $this->start_controls_section(
                'section_btn_design_options', [
                'label' => __('Button', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typography',
                'label' => __('Typography', 'plugin-domain'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .km_activity_pu_btn .km_purchase_btn',
            ]
        );

        $this->add_responsive_control(
            'btn_align',
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
                        '{{WRAPPER}} .km_activity_pu_btn' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_purchase_btn' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_bg-color',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_purchase_btn' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_single_featured_activity .km_purchase_btn',
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_border_radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_purchase_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button-padding', [
                'label' => __('Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_purchase_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'button-margin', [
                'label' => __('Margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_single_featured_activity .km_activity_pu_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ]
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
        $this->buttonDesignOptions();
    }

    private function wpcap_button_options()
    {
        $this->start_controls_section(
            'section_button_options', [
                'label' => __('Button', 'fieldday'),
            ]
        );

        $this->add_control(
            'show_purchase_btn', [
                'label' => __('Show Button', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'button_text', [
                'label' => __('text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Purchase', 'fieldday'),
                'condition' => [
                    'show_purchase_btn' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

     /**
     * filter controls for activities
     */
    private function wpcap_filter_options()
    {
        $this->start_controls_section(
                'section_filter_options', [
            'label' => __('Filter Options', 'elementor'),
                ]
        );
        $this->add_control(
			'activity_ids',
			[
				'label' => esc_html__( 'Select Activities', 'plugin-name' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' =>$this->featureactivitiesList(),
				'default' => [],
			]
		);
     
    }

     /**
     * get the list of feature activities
     * @return array list of feature activities
     */
    private function featureactivitiesList()
    {
        $activityOptions = [];
        $activities = fieldday()->api->getFeaturedActivities();
        foreach ($activities->data as $key => $activity)
        {
            $activityOptions[$activity->_id] = $activity->title;
        }
        return $activityOptions;
    }

    private function displayActivitiesList($featuredActivities)
    {
        $this->settings = $this->get_active_settings();
        $layoutColumns = $this->settings['activity_layout'];
        $style = fieldday()->engine->getValue('activity_style', $this->settings, false);
        $styleClass = "km_activity_simple";
        if($style == 'alternate') {
            $styleClass = "km_activity_alternate";
        }
        $layoutclass = ["layout_{$layoutColumns}_columns", $this->settings['activity_image_effect']];

        print "<div style='flex-wrap:wrap;' class='km_fieldday_activities_widget_cls_ km_featured_activities km_row {$styleClass}'>";
        foreach ($featuredActivities as $key => $activity)
        {  
            print "<div id='activity_".$activity->_id."' class='km_single_featured_activity ". implode(" ", $layoutclass) ."'>";
                $this->activityTitle($activity);
                print "<div class='km_row km_activity_row'>";

                    print "<div class='km_col_5'><div class='km_leftinfo_detail'>";
                        $this->displayFeatureImage($activity);
                        print "<div class='km_row km_activity_meta'>";
                            $this->displayAgeGroup($activity);
                            $this->displayPriceRange($activity);
                            $this->BookingsAvailable($activity);
                            $this->BookingOptions($activity);
                            $this->displayDiscounts($activity);
                        print "</div>";

                    print "</div></div>";
                    print "<div class='km_col_7'>";
                    $this->displayDescription($activity);
                    $this->displayBringingNeeds($activity);
                    $this->displayPrerequisite($activity);
                    $this->extendedCareOptions($activity);
                    $this->additionalChargeOptions($activity);  
                    $this->displayDailyRouteen($activity);
                    $this->displaycancellationPolicy($activity);
                    $this->totalPublishedSessions($activity); 
                    $this->displayPurchaseButton($activity);
                    print "</div>";
                print "</div>";
            print "</div>";
        }
        print "</div>";
    }

    protected function render($instance = [])
    {
        $queryoptions = [];
        $settings = ($this->get_active_settings());
            if(array_key_exists('activity_ids', $settings) && is_array($settings['activity_ids'])) {
              $queryoptions['activities'] = $settings['activity_ids'];
            }

        $featuredActivities = fieldday()->api->getFeaturedActivities($queryoptions);
        if ($featuredActivities->statusCode !== 200)
        {
            echo fieldday()->engine->displayFlash('error', __($featuredActivities->message, 'fieldday'));
            return;
        }

        $this->displayActivitiesList($featuredActivities->data);
    }

    /**
     * Display activity Title
     * @param Object $activity
     * @return String Html output
     */
    private function activityTitle($activity)
    {
        if ($this->settings['show_title'] == 'yes')
        {
            print wp_sprintf("<%s class='km_featured_activity_title'>%s</%s>", $this->settings['title_tag'], $activity->title, $this->settings['title_tag']);
        }
    }

    /**
     * Display session Image
     * @param object $activity
     *
     * @return String Html output
     */
    private function displayFeatureImage($activity)
    {
        $photos = $activity->photosURL;
        $thumburl = $photos[0]->original;
        if (!count($photos))
        {
            $thumburl = $this->settings['default_image']['url'];
        }
        if ($this->settings['show_image'] == 'yes' && $thumburl)
        {
            print wp_sprintf('<div class="km_featured_session_img"><img style="width:%s; height:%s" src="%s" class="img responsive-img"></div>', $this->settings['image_dimension']['width'], $this->settings['image_dimension']['height'], $thumburl);
        }
    }

    public function displayDescription($activity) {
        if ($this->settings['show_description']) {
            $overview = fieldday()->engine->getvalue('overview', $activity, false);
            if($overview!='Na') {
                print "<div class='km_activity_description'>";
                    print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['description_exp_title']);
                    $readmoreLink = wp_sprintf('<a class="km_modal_link" data-description="%1$s" data-title="%2$s" href="#">%3$s</a>', strip_tags($activity->overview), $activity->title, $this->settings['description_exp_readmore']);
                    print wp_sprintf('<span class="km_activity_text">%1$s</span>', wp_trim_words(strip_tags($activity->overview), $this->settings['description_exp_max_words'], $readmoreLink));
                print "</div>";
            }
        }
    }

    public function displayBringingNeeds($activity)
    {
        if ($this->settings['show_bringing_needs']) {
            
                $bringingNeedsArr = fieldday()->engine->getvalue('bringingNeedsArr', $activity, false);
                $bringingNeedsS = fieldday()->engine->getvalue('bringingNeeds', $activity, false);
                

                if($bringingNeedsArr && $bringingNeedsS!='Na') { //$i = 0;
                    print "<div class='km_activity_bringing_needs km_bullets_arrow'>";
                    print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['description_needs_title']); 
                    foreach ($bringingNeedsArr as $key => $bringingNeeds) {
                        if($bringingNeeds->title!='Na'){
                            print wp_sprintf('<span class="km_activity_text km_bringing_need_item" id="%1$s">%2$s</span>', $bringingNeeds->_id, $bringingNeeds->title);
                        }
                    $i++;   
                    }
                print "</div>";
                }
            
        }
    }

    public function displayPrerequisite($activity){
        if ($this->settings['show_prerequisites']) {
        $prerequisitesArr = fieldday()->engine->getvalue('prerequisitesArr', $activity, false);
        $prerequisitestitle = json_decode(json_encode($prerequisitesArr), true);
        $titlevalue = $prerequisitestitle[0]['title'];
        if($prerequisitesArr && $titlevalue!='Na' && $titlevalue!='NA' && $titlevalue!='N/A') {
        print "<div class='km_activity_prerequisite km_bullets_arrow'>";
        print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['prerequisites_description_needs_title']);
        foreach ($prerequisitesArr as $key => $prerequisites) {
                print wp_sprintf('<span class="km_activity_text km_prerequisites_item" id="%1$s">%2$s</span>', $prerequisites->_id, $prerequisites->title);
        }  
        print "</div>";
        }
        }
    }

    public function extendedCareOptions($activity){
        if ($this->settings['show_extendedCare']) {
            $extendedCareOptions = fieldday()->engine->getvalue('extendedCareOptions', $activity, false);
            if($extendedCareOptions) {
            print "<div class='km_activity_extendedCare km_bullets_arrow'>";
                print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['extendedCare_description_needs_title']);
                    foreach ($extendedCareOptions as $key => $extendedCareOption) {
                        print wp_sprintf('<span class="km_activity_text km_extendedcare_item">%2$s</span>', $extendedCareOption, $extendedCareOption);
                    }
            print "</div>";
            }
        }
    }
    public function totalPublishedSessions($activity){
        global $fielddaySetting;
        if ($this->settings['show_totalSessions']) { 
          $totalPublishedSessions = fieldday()->engine->getvalue('totalPublishedSessions', $activity, false);
          $upcomingSessions = fieldday()->engine->getvalue('upcomingSessions', $activity, false); 
          $upcommingcount = count($upcomingSessions);
          $upcomming_more = $totalPublishedSessions - $upcommingcount;
            if($totalPublishedSessions){
            } 

            if($upcomingSessions){
                print '<div class="km_published_sessions">';
                print wp_sprintf("<b class='km_act_heading km_primary_color'>%s:</b>", $this->settings['totalSessions_description_needs_title']);
                print '<div class="km_upcomming_sessions">';

                foreach($upcomingSessions as $upcomingSession){ 
                    $location = $upcomingSession->siteLocationId->name;
                    $location_state = $upcomingSession->siteLocationId->state;
                    $location_country = $upcomingSession->siteLocationId->country;
                    $location_link = $upcomingSession->siteLocationId->googleMapUrl;
                    $open = "window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false";
                    print '<div class="km_session_single_item" data-time-stamp-from="' . $upcomingSession->dateTimestamp->from . '" data-time-stamp-to="' . $upcomingSession->dateTimestamp->to . '">';
                    print wp_sprintf('<div class="km_upcsession_title">%s</div>',$upcomingSession->name);
                    print '<div class="km_upcsession_meta">';
                    if($upcomingSession->price!=0){
                    print wp_sprintf('<span><i class="fa fa-money km_primary_color"></i><span class="km_see_listing">%s</span></span>',__('[See Listing for Price]','fieldday'));
                    }
                    print wp_sprintf('<span><i class="fa fa-map-marker km_primary_color"></i><a href="%s" onclick="%s;">%s</a></span>',$location_link,$open,$location);
                    print '</div>';
                    print '<div class="km_date_p02"><div class="km_date_p"><i class="fa fa-calendar km_primary_color" aria-hidden="true"></i><span class="km_session_month"></span></div>
                        <div class="km_date_p"><span class="km_session_year"></span></div></div>';
                    print '<div class="km_time_p"><i class="fa fa-clock km_primary_color" aria-hidden="true"></i><span class="km_sess_time"></span></div>';
                    print '</div>';
                }
                if($upcomming_more>0){
                    $purchase_page = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
                    $activity_link = add_query_arg(['activityId' => $activity->_id], $purchase_page);
                    print wp_sprintf('<div class="km_more_upcomming"><a class="km_secondary_color" href="%1$s">%2$s</a></div>', $activity_link, __('Click Purchase to see all available dates.', 'fieldday'));
                    //print wp_sprintf('<div class="km_more_upcomming"><span class=" km_secondary_color">Click Purchase to see all available dates.</span></div>',__('Available','fieldday'),$upcomming_more);
                }
                print '</div></div>';
            }


        }
    }
    public function displaycancellationPolicy($activity){
        if ($this->settings['show_cancellationPolicy']) {
            $cancellationPolicy = fieldday()->engine->getvalue('cancellationPolicy', $activity, false);
            if($cancellationPolicy) {
            print "<div class='km_activity_policy'>";
                print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['cancellationPolicy_description_needs_title']);
                $cancellationPolicynote = fieldday()->engine->getvalue('note', $activity->cancellationPolicy, false);
                $cancellationPolicydescription = fieldday()->engine->getvalue('description', $activity->cancellationPolicy, false);
                if($cancellationPolicydescription){
                   print wp_sprintf('<div class="km_activity_text km_policy_description">%s</div>',$cancellationPolicydescription);
                }
                if($cancellationPolicynote){
                   print wp_sprintf('<div class="km_activity_text km_policy_note">%s</div>',$cancellationPolicynote);
                }
                $cancellationPolicyterms = fieldday()->engine->getvalue('terms', $activity->cancellationPolicy, false);
                    if($cancellationPolicyterms){
                        print "<ul class='km_policy_terms'>";
                        foreach ($cancellationPolicyterms as $key => $cancellationPolicyItem) {
                            print wp_sprintf('<li class="km_activity_text km_additionalcharge_item" id="%1$s"><i class="fa fa-check km_angle_right"></i> %2$s</li>', $cancellationPolicyItem, $cancellationPolicyItem);
                        }
                        print "</ul>";
                    }
            print "</div>";
            }
        }
    }
    public function additionalChargeOptions($activity){
        if ($this->settings['show_additionalCharges']) {
            $additionalChargeOptions = fieldday()->engine->getvalue('additionalChargeOptions', $activity, false);
            if($additionalChargeOptions) {
            print "<div class='km_activity_extendedCare km_bullets_arrow'>";
                print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['additionalCharges_description_needs_title']);
                    foreach ($additionalChargeOptions as $key => $additionalCharge) {
                        print wp_sprintf('<span class="km_activity_text km_additionalcharge_item" id="%1$s">%2$s</span>', $additionalCharge, $additionalCharge);
                    }
            print "</div>";
            }
        }
    }

    public function displayDailyRouteen($activity)
    {  
        if ($this->settings['show_daily_routine']) {
            $dailyRoutineArr = fieldday()->engine->getvalue('dailyRoutineArr', $activity, false);
            $dailyRoutineS = fieldday()->engine->getvalue('dailyRoutine', $activity, false);
            
            if($dailyRoutineArr && $dailyRoutineS!='Na') {
                print "<div class='km_activity_daily_routine km_bullets_arrow'>";
                    print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['description_routine_title']);
                        foreach ($dailyRoutineArr as $key => $dailyRoutine) {
                            print wp_sprintf('<span class="km_activity_text km_daily_route_item" id="%1$s">%2$s</span>', $dailyRoutine->_id, $dailyRoutine->title);
                        }
                print "</div>";
            }
        }
    }

    public function displayPurchaseButton($activity)
    {
        if($this->settings['show_purchase_btn']) {
            global $fielddaySetting;
            $purchase_page = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
            $activity_link = add_query_arg(['activityId' => $activity->_id], $purchase_page);
            print "<div class='km_activity_pu_btn'>";
                print wp_sprintf('<a class="km_purchase_btn km_btn km_primary_bg" href="%1$s">%2$s</a>', $activity_link, __($this->settings['button_text'], 'fieldday'));
            print "</div>";
        }
    }
    public function displayAgeGroup($activity)
    {   //print_r($activity);
        if ($this->settings['show_age_group']) {
            print "<div class='km_activity_meta km_left_meta'>";
                print '<i class="fa fa-child km_primary_color" aria-hidden="true"></i>';
                $skillLevelOption = fieldday()->engine->getValue('skillLevelOption', $activity, false);
                if($skillLevelOption=='grade'){
                    print wp_sprintf('<span class="km_activity_text">Grade(s): %1$s - %2$s</span>', $activity->gradeRange->from, $activity->gradeRange->to);
                } else {
                    print wp_sprintf('<span class="km_activity_text">Age: %1$s - %2$s %3$s</span>', $activity->ageRange->from, $activity->ageRange->to, $this->settings['description_age_year_txt']);
                }
                
            print "</div>";

        }
    }

    public function displayPriceRange($activity){ 
        $prices = array();
        $from_price = fieldday()->engine->getValue('from', $activity->priceRange, false);
        $price = fieldday()->engine->display_price($from_price);
        print '<div class="km_priceRange km_left_meta km_activity_text"><i class="fa fa-money km_primary_color"></i>';
        print wp_sprintf('<span class="km_price">%s %s</span>',$price,'onwards');
        print '</div>';
    }

    public function BookingsAvailable($activity)
    {    
        $availablePaymentOptions = fieldday()->engine->getvalue('availablePaymentOptions', $activity, false);
        
        if($availablePaymentOptions) {
        print "<div class='km_left_meta km_activity_payment_options'>";
            print wp_sprintf("<b class='km_act_heading km_sess_head km_primary_color'>%s</b>", 'Payment Options');
            print "<ul class='km_listing'>";
            foreach ($availablePaymentOptions as $key => $availablePaymentOption) {
                print wp_sprintf('<li class="km_booking_item" id="%1$s"><i class="fa fa-angle-right km_primary_color km_angle_right"></i><span class="km_activity_text km_activity_cnt ">%2$s</span></li>', $availablePaymentOption->title, $availablePaymentOption->title);
            }
            
        print "</ul></div>";
        }
        

    }
     public function BookingOptions($activity)
    {    
        $availableBookingOptions = fieldday()->engine->getvalue('availableBookingOptions', $activity, false);
        if($availableBookingOptions) {
        print "<div class='km_left_meta km_activity_payment_options'>";
            print wp_sprintf("<b class='km_act_heading km_sess_head km_primary_color'>%s</b>", 'Activity Hosted');
            print "<ul class='km_listing'>";
            foreach ($availableBookingOptions as $key => $availableBookingOption) {
                print wp_sprintf('<li class="km_activity_text km_booking_item" id="%1$s"><i class="fa fa-angle-right km_primary_color km_angle_right"></i>%2$s</li>', $availableBookingOption, $availableBookingOption);
            }
            
        print "</ul></div>";
        }
        

    }

    public function displayDiscounts($activity) {
        if ($this->settings['show_discount'] && $activity->offeringDiscounts) {
            print "<div class='km_activity_meta km_left_meta'>";
                print wp_sprintf("<b class='km_act_heading km_sess_head km_primary_color'>%s</b>", $this->settings['discount_title']);
                    print "<div class='km_discounts'>";
                    foreach ($activity->offeringDiscounts as $key => $discount)
                    {
                        print wp_sprintf('<span class="km_btn km_primary_color km_transparent_bg">%s</span>', $discount);
                    }
            print "</div></div>";

        }
    }
    

}
