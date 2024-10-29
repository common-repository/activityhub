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
class ElementorfielddayPackages extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-packages';
    }

    public function get_title()
    {
        return __('Fieldday Packages', 'fieldday');
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
                '1' => __('List view', 'fieldday'),
                '2' => __('Columns view', 'fieldday'),
            ],
            'default' => '1'
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
                'purchase_text', [
            'label' => __('Book Button Text', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Book Now', 'fieldday'),
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
                'km_circle' => esc_html__('Circle', 'fieldday')
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
                        '{{WRAPPER}} .km_package_single' => 'background-color: {{VALUE}};',
                    ]
                ]
        );
        $this->add_control(
                'box_overlay_color',
                [
                    'label' => __('Box Overlay', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_featured_session_img::after' => 'background: {{VALUE}};',
                    ]
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __('Border', 'plugin-domain'),
                    'selector' => '{{WRAPPER}} .km_package_single',
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
                    ]
                ]
        );
        $this->add_control(
            'box-radious', [
                'label' => __('Border Radius', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_package_single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 15,
                    'left' => 15,
                    'bottom' => 15,
                    'right' => 15,
                    'unit' => 'px',
                    'isLinked' => true,
                ]
            ]
        );
        $this->add_control(
            'box-padding', [
                'label' => __('Box Padding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .km_package_single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'label' => __('Box Shadow', 'plugin-domain'),
                    'selector' => '{{WRAPPER}} .km_package_single',
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
                        '{{WRAPPER}} .km_featured_session_title' => 'color: {{VALUE}};',
                    ]
                ]
        );
       
        $this->add_control(
                'purchase_back_color',
                [
                    'label' => __('Purchase Button Background', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_feature_purchase_btn' => 'background-color: {{VALUE}}!important;',
                    ]
                ]
        );
        $this->add_control(
                'purchase_color',
                [
                    'label' => __('Purchase Button Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_feature_purchase_btn' => 'color: {{VALUE}} !important;',
                    ]
                ]
        );
        $this->end_controls_section();
    }

    /**
     * get the list of activities
     * @return array list of activities
     */
    private function activitiesList()
    {
        $activityOptions = ['all' => 'all'];
        $activities = fieldday()->api->homeSessionActivities();
        foreach ($activities->data as $key => $activity)
        {
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
        foreach ($activityTags->data as $key => $tags)
        {
            $tagsOptions[$tags->_id] = $tags->title;
        }
        return $tagsOptions;
    }

    private function displayPackagesList($classPackages)
    {  
        print '<div class="km_packages_section_wrap ' . $this->settings['entrance_animation'] . '" id="km_featureed_session">';
        print '<div class="km_packages_section"><ul class="km_packages_list km_list km_grid" id="">';
        print $this->singlePackage($classPackages->data);
        print '</ul></div>';
        print '</div>';
    }

    /**
     * display single package
     */
    private function singlePackage($package)
    {
        $layoutColumns = $this->settings['session_layout'];
        $layoutclass = $this->settings['box_image_effect'];

        $html ='<li id="km_packages_list_layout" class="km_package_single activethemeview ' .$layoutclass . '"><div class="km_col_2">';
        $html .= $this->displayFeatureImage($package);
        $html .='</div><div class="km_col_10">
        <div class="km_package_Heading_content">
            <div class="km_full_age">';               
        $html .= $this->packageTitle($package);
        $html .='</div>
            <div class="km_Heading_content_inner">';
        $html .= $this->packagePrice($package);        
        $html .='</div><div class="km_session_bottom_wrap km_listview_price_col">
            <div class="km_cart_button_p">';
        $html .= $this->purchaseButton($package);  
        $html .='</div></div></div></div>';

        return $html;
    }

    protected function render($instance = [])
    {
        // Get settings
        $this->settings = $this->get_active_settings();
        $classPackages = fieldday()->api->getPackages(); 
        if ($classPackages->statusCode !== 200)
        {
            echo fieldday()->engine->displayFlash('error', __($classPackages->message, 'fieldday'));
            return;
        }
        $this->displayPackagesList($classPackages);
    }

    /**
     * display purchase button
     * @param Object $package
     */
    private function purchaseButton($package)
    {   
        if($package->status=="live"){
        return wp_sprintf('<a '.fieldday()->engine->packageRegister('',$package->_id).' href="javascript:void(0);" class="km_btn km_feature_purchase_btn km_primary_bg km_session_btn">%s</a>', $this->settings['purchase_text']);
        }

    }
    

    /**
     * Display package Image
     * @param object $package
     * 
     * @return String Html output 
     */
    private function displayFeatureImage($package)
    {
        $featuredImg = fieldday()->engine->getValue('original',$package->image, false);
        $thumburl = fieldday()->engine->getValue('thumbnail',$package->image, false);
        if (!$thumburl)
        {
            $thumburl = $this->settings['box_background']['url'];
        }
        if ($this->settings['show_image'] == 'yes' && $thumburl)
        {
            return wp_sprintf('<div class="km_featured_session_img"><img src="%s" class="img responsive-img"></div>', $thumburl);
        }
    }

    /**
     * Display package Title
     * @param Object $package
     * @return String Html output
     */
    private function packageTitle($package)
    {
        if ($this->settings['show_title'] == 'yes')
        {
            return wp_sprintf("<%s class='km_featured_session_title'>%s</%s>", $this->settings['title_tag'], $package->title, $this->settings['title_tag']);
        }
    }

    /**
     * Display package Price
     * @param Object $package
     * @return String Html output
     */
    private function packagePrice($package)
    {
       $packageprice = array(); 
       $validForUnit = fieldday()->engine->getValue('validForUnit',$package, false);
       $validFor = fieldday()->engine->getValue('validFor',$package, false);
       if($validFor>1){ $duration = $validFor.$validForUnit; }else{ $duration = '/'.$validForUnit;}
       foreach($package->price as $key=>$price){
            if($key=="additionalSeatCost") { $additionalSeatCost = 'Additional Seat Cost: '.$price;}
            else{ $packageprice[] = $price;}
       }
       $price = '$'.implode(", $",$packageprice);
        return wp_sprintf("<div class='km_package_meta'><span class='km_package_price'>%s %s</span><span class='km_package_additional_cost'>%s</span></div>",$price,$duration,$additionalSeatCost);
        
    }
}