<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class fieldDayGiftcards extends Widget_Base
{
    public function get_name()
    {
        return 'elementor-fieldday-giftcards';
    }

    public function get_title()
    {
        return __('Fieldday Giftcards', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-posts-justified';
    }

    protected function _register_controls()
    {
      $this->wpcap_content_layout_options();
      $this->wpcap_content_price_options();
      $this->wpcap_design_options();
      $this->wpcap_price_options();
      $this->wpcap_description_options();
      $this->wpcap_image_options();
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
            'giftcardlayout_view', [
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
            'giftcardlayout_style', [
                'label' => __('Style', 'fieldday'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'alternate' => __('Alternate', 'fieldday'),
                    'simple' => __('Simple', 'fieldday')
                ],
                'default' => '3'
            ]
        );
        $this->end_controls_section();

    }


    private function wpcap_content_price_options()
    {

        $this->start_controls_section(
          'section_pricemin_options', [
              'label' => __('Content', 'fieldday'),
          ]
        );

        $this->add_control(
          'pricebreakdown',
          [
            'label' => __( 'Price Breakdown', 'fieldday' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 25,
            'max' => 10000,
            'step' => 25,
            'default' => 25,
          ],

        );
        $this->add_control(
            'purchase_text', [
            'label' => __('Purchase Button Text', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Purchase', 'fieldday'),
                ]
        );

        $this->add_control(
    			'company_icon',
    			[
            'label' => __( 'Company Image', 'fieldday' ),
				    'type' => \Elementor\Controls_Manager::MEDIA,

    			]
		    );

		$this->end_controls_section();

	    $this->end_controls_section();

    }

    /**
     * design controls
     */
    private function wpcap_design_options()
    {
        $this->titleDesginOptions();
        $this->contentDesignOptions();
        $this->boxDesignOptions();
        $this->buttonDesignOptions();
        $this->buttonDesignOptions();

    }

    /**
      @content title desgin Options

    **/
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
                        '{{WRAPPER}} .km_giftcard_title' => 'color: {{VALUE}} !important;',
                    ]
                ]
        );
        $this->add_control(
            'title-margin', [
                'label' => __('margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_giftcard_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .km_giftcard_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => ['10px'],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'plugin-domain'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .km_giftcard_title',
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
                    '{{WRAPPER}} .km_giftcard_title' => 'text-align: {{VALUE}};',
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
                'selector' => '{{WRAPPER}}  a.km_btn.km_purchase_btn',
            ]
        );

        $this->add_control(
            'buttons_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  a.km_btn.km_purchase_btn' => 'color: {{VALUE}};',
                ],
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
                        '{{WRAPPER}} .giftcardbuttoncontainer' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'button_bg-color',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .km_content_wrap a.km_btn.km_purchase_btn' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_content_wrap a.km_btn.km_purchase_btn',
            ]
        );
        $this->add_control(
            'button_border_radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_content_wrap a.km_btn.km_purchase_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'button-padding', [
                'label' => __('Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_content_wrap a.km_btn.km_purchase_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'button-margin', [
                'label' => __('Margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .giftcardbuttoncontainer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
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
                'selector' => '{{WRAPPER}} .km_list_giftcard',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_list_giftcard',
            ]
        );
        $this->add_control(
            'box-radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_list_giftcard' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box-padding', [
                'label' => __('Box Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_list_giftcard' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box-margin', [
                'label' => __('Box margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_list_giftcard' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_list_giftcard',
            ]
        );
        $this->end_controls_section();
    }


    private function wpcap_price_options()
    {
        $this->start_controls_section(
            'section_price_options', [
                'label' => __('Price', 'fieldday'),
            ]
        );

        $this->add_control(
            'description_price_title', [
                'label' => __('Title', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Price', 'fieldday'),
            ]
        );

        $this->add_control(
            'description_price_icon', [
                'label' => __('Price', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('$', 'fieldday'),
            ]
        );

        $this->end_controls_section();
    }
    private function wpcap_description_options()
    {
            $this->start_controls_section(
          'content_section',
          [
            'label' => __( 'Questions', 'plugin-name' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );

        $this->add_control(
            'show_questions', [
                'label' => __('Show Questions', 'fieldday'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'fieldday'),
                'label_off' => __('Hide', 'fieldday'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
          'list_title', [
            'label' => __( 'Title', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'List Title' , 'plugin-domain' ),
            'label_block' => true,
          ]
        );

        $repeater->add_control(
          'list_content', [
            'label' => __( 'Content', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __( 'List Content' , 'plugin-domain' ),
            'show_label' => false,
          ]
        );

        $repeater->add_control(
          'list_color',
          [
            'label' => __( 'Color', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
            ],
          ]
        );

        $this->add_control(
          'list',
          [
            'label' => __( 'Questions List', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
              [
                'list_title' => __( 'Title #1', 'plugin-domain' ),
                'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
              ],
              [
                'list_title' => __( 'Title #2', 'plugin-domain' ),
                'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
              ],
            ],
            'title_field' => '{{{ list_title }}}',
            'condition' => [
                'show_questions' => 'yes',
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
                    '{{WRAPPER}} .km_act_heading' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_activity_bringing_needs, {{WRAPPER}} .km_activity_daily_routine' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'discount-margin', [
                'label' => __('Margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_activity_discounts, {{WRAPPER}} .km_activity_agegroup, {{WRAPPER}} .km_activity_available_dates, {{WRAPPER}} .km_activity_description, {{WRAPPER}} .km_activity_bringing_needs, {{WRAPPER}} .km_activity_daily_routine' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],

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
                    '{{WRAPPER}} .km_giftdesign_slide.slick-slide::before' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'img_border',
                'label' => __('Border', 'plugin-domain'),
                'selector' => '{{WRAPPER}} .km_giftdesign_slide.slick-slide img ',
            ]
        );
        $this->add_control(
            'image_border_radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_giftdesign_slide.slick-slide img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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



    private function purchaseButton()
    {
        global $fielddaySetting;

         return wp_sprintf('<a href="javascript:void(0);"  class="km_btn km_add_to_cart_giftCard">%s</a>', $this->settings['purchase_text']);
    }

    protected function render($instance = [])
    {
        $giftOptions = fieldday()->api->getProviderGiftCards();
        // echo "<pre>"; print_r($giftOptions);
        // die;
        $this->settings = $this->get_active_settings();
        $content = "";
        $layoutColumns = $this->settings['giftcardlayout_view'];
        $layoutclass = ["layout_{$layoutColumns}_columns", $this->settings['activity_image_effect']];
        $companyImg=$this->settings['company_icon']['url'];
        $style = fieldday()->engine->getValue('giftcardlayout_style', $this->settings, false);
        $styleClass = "km_activity_simple";
        if($style == 'alternate') {
            $styleClass = "km_activity_alternate";
        }
        if($giftOptions->statusCode === 200) {
                $content.='<div class="km_featured_sessions_wrap" id="km_featureed_session"><div style="flex-wrap:wrap;" class="km_row km_featured_sessions '. $styleClass.'">';
                $content.=fieldday()->engine->getView('widgets/elementor/giftcard',
                                ['giftCard' => $giftOptions->data,
                                'minprice'=>'25',
                                'maxprice'=>'125',
                                'breakprice'=>$this->settings['pricebreakdown'],
                                'buttonPurchase'=> $this->purchaseButton(),
                                'buttonText'=> $this->settings['purchase_text'],
                                'layoutClass' => implode(" ", $layoutclass),
                                'companyImg' => $companyImg,
                                'description_price_title' => $this->settings['description_price_title'],
                                'description_price_icon' => $this->settings['description_price_icon'],
                                'show_questions' => $this->settings['show_questions'],
                                'sections_content' => $this->settings['list'],
                              ]
                            );
                $content.='</div></div>';

        }else {
            $content.= fieldday()->engine->displayFlash('error', __($giftOptions->message, 'fieldday'));
        }

        print $content;

    }
}
