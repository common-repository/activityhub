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
class ElementorfielddayParties extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-parties';
    }

    public function get_title()
    {
        return __('Fieldday Parties', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-posts-justified';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
        $this->wpcap_description_options();
        $this->wpcap_included_options();
        $this->wpcap_addons_options();
        $this->wpcap_design_options();
        $this->wpcap_button_options();
        //$this->wpcap_filter_options();
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
        /*$this->add_control(
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
        );*/

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


    private function wpcap_included_options()
    {
        $this->start_controls_section(
            'section_needs_options', [
                'label' => __('Included', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_included', [
                'label' => __('Show Included', 'fieldday'),
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
                'default' => __('Included', 'fieldday'),
                'condition' => [
                    'show_included' => 'yes',
                ],
            ]
        );
       /* $this->add_control(
            'description_needs_max_words', [
                'label' => __('Max Words', 'fieldday'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'show_included' => 'yes',
                ],
            ]
        );*/
        $this->add_control(
            'included_needs_seemore', [
                'label' => __('See More Text', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('see more', 'fieldday'),
                'condition' => [
                    'show_included' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function wpcap_addons_options()
    {
        $this->start_controls_section(
            'section_addons_options', [
                'label' => __('Add-Ons', 'fieldday'),
            ]
        );
        $this->add_control(
            'show_addons', [
                'label' => __('Show Add-Ons', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'addons_description_needs_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Add-Ons', 'fieldday'),
                'condition' => [
                    'show_addons' => 'yes',
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
        /*$this->add_control(
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
        );*/
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
                        '{{WRAPPER}} .km_featured_activity_title' => 'color: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_parties_included, {{WRAPPER}} .km_activity_daily_routine' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_parties_included, {{WRAPPER}} .km_activity_daily_routine' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
                'condition' => [
                    'show_discount' => 'yes',
                ],
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
        //$layoutColumns = $this->settings['activity_layout'];
        $style = fieldday()->engine->getValue('activity_style', $this->settings, false);
        $styleClass = "km_activity_simple";
        if($style == 'alternate') {
            $styleClass = "km_activity_alternate";
        }
        //$layoutclass = ["layout_{$layoutColumns}_columns", $this->settings['activity_image_effect']];

        print "<div style='flex-wrap:wrap;' class='km_party_rooms km_featured_activities km_row {$styleClass}'>";
        $i = 0;
        foreach ($featuredActivities as $key => $activity)
        {  
            if($i==0){
            $photos = $activity->photosURL;
            $thumburl = $photos[0]->original;
            print "<div id='activity_".$activity->_id."' class='km_party_rooms_single km_single_featured_activity layout_1_columns'>";
            print "<h2 class='km_primary_color km_featured_activity_title'>Fun and Awesome Paties At Tamara Clary Studio</h2>";
            print "<div class='km_parties'><h3 class='km_act_heading km_primary_color'>Pre-party Activity</h3><div class='km_activity_description km_activity_text'>Are you ready for party central? At BounceU, the fun begins before the party even starts! From the moment your kids walk through our front doors, our party team is ready to entertain them with games and activities. Parents can easily check in their kids while our team supervises and build up the party excitement. The birthday kid will have all eyes on them as they’re sung our special birthday shout out then it’s off to the Party Parade all the way to our thrilling indoor play centers.</div>";
                $this->displayIncluded($activity);
                $this->addonsOptions($activity);
                $this->displayPurchaseButton($activity);
                print "</div>";
            
                print "<div class='km_parties'><h3 class='km_act_heading km_primary_color'>Pre-party Activity</h3><div class='km_activity_description km_activity_text'>Are you ready for party central? At BounceU, the fun begins before the party even starts! From the moment your kids walk through our front doors, our party team is ready to entertain them with games and activities. Parents can easily check in their kids while our team supervises and build up the party excitement. The birthday kid will have all eyes on them as they’re sung our special birthday shout out then it’s off to the Party Parade all the way to our thrilling indoor play centers.</div>";
                $this->displayIncluded($activity);
                $this->addonsOptions($activity);
                $this->displayPurchaseButton($activity);
                print "</div>";
          
            
            print "<div class='km_parties'><h3 class='km_act_heading km_primary_color'>Pre-party Activity</h3><div class='km_activity_description km_activity_text'>Are you ready for party central? At BounceU, the fun begins before the party even starts! From the moment your kids walk through our front doors, our party team is ready to entertain them with games and activities. Parents can easily check in their kids while our team supervises and build up the party excitement. The birthday kid will have all eyes on them as they’re sung our special birthday shout out then it’s off to the Party Parade all the way to our thrilling indoor play centers.</div>";
            $this->displayIncluded($activity);
            $this->addonsOptions($activity);
            $this->displayPurchaseButton($activity);
            print "</div>";
            print '</div>';

            /*print "<div id='activity_".$activity->_id."' class='km_single_featured_activity layout_1_columns'>";
                //$this->activityTitle($activity);
                print "<div class='km_row km_activity_row km_birthday_widget'>";

                
                    print "<div class='km_col_6 km_parties_desc' style='background:url(".$thumburl.")'><div class=''>";
                        //$this->displayFeatureImage($activity);

                    print "</div></div>";
                    print "<div class='km_col_6'>";
                    $this->displayDescription($activity);
                    print "<div class='km_partiesoptions'>";
                    $this->displayIncluded($activity);
                    $this->addonsOptions($activity); 
                    print "</div>"; 
                    $this->displayPurchaseButton($activity);
                    print "</div>";
                print "</div>";
            print "</div>";*/
        $i++;
        }
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
        //$birthdayrooms = fieldday()->api->BirthdayActivityRooms();
        //print_r($birthdayrooms);
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
  /*  private function activityTitle($activity)
    {
        if ($this->settings['show_title'] == 'yes')
        {
            print wp_sprintf("<%s class='km_featured_activity_title'>%s</%s>", $this->settings['title_tag'], $activity->title, $this->settings['title_tag']);
        }
    }*/

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
        if ($this->settings['show_title'] == 'yes')
        {
            print wp_sprintf("<%s class='km_act_heading km_primary_color km_featured_activity_title km_parties_title'>%s</%s>", $this->settings['title_tag'], $activity->title, $this->settings['title_tag']);
        }
        if ($this->settings['show_description']) {
            $overview = fieldday()->engine->getvalue('overview', $activity, false);
            if($overview!='Na') {
                print "<div class='km_activity_description'>";
                    //print wp_sprintf("<b class='km_act_heading km_primary_color'>%s</b>", $this->settings['description_exp_title']);
                    $readmoreLink = wp_sprintf('<a class="km_modal_link" data-description="%1$s" data-title="%2$s" href="#">%3$s</a>', $activity->overview, $activity->title, $this->settings['description_exp_readmore']);
                    echo "Give your birthday kid the most on their special day in our private party room! Let their smile beam as friends and family are chanting their name as they make their Grand Party Entrance and enthusiastically make their way to the birthday throne. They'll happily dig into their food and birthday cake as they eagerly await to open all of the gifts in the present bin. Our pre-decorated party rooms makes planning easy. It’s sure to be their best birthday yet!";
                    //print wp_sprintf('<span class="km_activity_text">%1$s</span>', wp_trim_words($activity->overview, $this->settings['description_exp_max_words'], $readmoreLink));
                print "</div>";
            }
        }
    }

    public function displayIncluded($activity)
    {
        if ($this->settings['show_included']) {
            $photos = $activity->photosURL;
            $thumburl = $photos[0]->original;
                /*$bringingNeedsArr = fieldday()->engine->getvalue('bringingNeedsArr', $activity, false);
                $bringingNeedsS = fieldday()->engine->getvalue('bringingNeeds', $activity, false);*/
                
                print "<div class='km_partiesoptions'><img src='".$thumburl."'><div class='km_parties_included km_bullets_arrow'><b class='km_act_heading km_primary_color'>What's Included</b><span class='km_activity_text km_bringing_need_item'>Party Set Up &amp; Clean Up</span><span class='km_activity_text km_bringing_need_item'>Pre-Decorated Room</span><span class='km_activity_text km_bringing_need_item'>Throne for Birthday Kid</span><span class='km_activity_text km_bringing_need_item'>Guest of Honor Gift</span><a href='#'>See more</a></div></div>";
            
        }
    }
    public function addonsOptions($activity){
        if ($this->settings['show_addons']) {
            $photos = $activity->photosURL;
            $thumburl = $photos[0]->original;
           // $additionalChargeOptions = fieldday()->engine->getvalue('additionalChargeOptions', $activity, false);
            //if($additionalChargeOptions) {
            print "<div class='km_addons'><b class='km_act_heading km_primary_color'>Add-on options to start the party fun early</b><div class='km_party_grids'><div class='km_party_grid' style='background-image:url(".$thumburl."), linear-gradient(rgb(0 0 0 / 80%),rgb(255 250 250 / 20%))'><h4>Party Decorations</h4><span>$25/party</span></div><div class='km_party_grid' style='background-image:url(".$thumburl."), linear-gradient(rgb(0 0 0 / 80%),rgb(255 250 250 / 20%))'><h4>Party Decorations</h4><span>$25/party</span></div></div></div>";
            //}
        }
    }

    public function displayPurchaseButton($activity)
    {
        if($this->settings['show_purchase_btn']) {
            global $fielddaySetting;
            print "<div class='km_party_btn'><a href='' class='km_button km_col_5 km_primary_bg'>Ready To Have Fun, Book Now!</a></div>";
            /*$purchase_page = get_permalink(fieldday()->engine->getValue('purchase_page', $fielddaySetting, false));
            $activity_link = add_query_arg(['activityId' => $activity->_id], $purchase_page);
            print "<div class='km_activity_pu_btn'>";
                print wp_sprintf('<a class="km_purchase_btn km_btn km_primary_bg" href="%1$s">%2$s</a>', $activity_link, __($this->settings['button_text'], 'fieldday'));
            print "</div>";*/
        }
    }   

}
