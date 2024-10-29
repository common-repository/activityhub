<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use fielddayCore;

class ElementorfielddayContact extends Widget_Base
{

    public function get_name()
    {
        return 'elementor-fieldday-contact';
    }

    public function get_title()
    {
        return __('Fieldday Contact', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-mail';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
        $this->wpcap_content_design_options();
    }

    /**
     * Content Layout Options.
     */
    private function wpcap_content_layout_options()
    {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'fieldday'),
                ]
        );

        $this->add_control(
            'section_headding', [
            'label' => __('Heading', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Contact Us', 'fieldday'),
            'placeholder' => __('Type your title here', 'fieldday'),
                ]
        );
        $this->add_control(
            'section_subheadding', [
            'label' => __('Sub Heading', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Please use this contact form to reach out to us. We will respond within 24 to 48 hours.', 'fieldday'),
            'placeholder' => __('Type your Sub heading here', 'fieldday'),
            ]
        );
        $this->add_control(
            'section_btn_text', [
            'label' => __('Button Text', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Submit'),
            'placeholder' => __('', 'fieldday'),
            ]
        );

        $this->end_controls_section();
    }

    private function wpcap_content_design_options()
    {
        $this->start_controls_section(
                'section_design_options', [
            'label' => __('Design Options', 'elementor'),
                ]
        );

        $this->add_control(
                'Heading Color',
                [
                    'label' => __('Heading Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .email_login_wrap h4' => 'color: {{VALUE}} !important;',
                    ]
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_design',
                    'label' => __('HeadingTypography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .email_login_wrap .km_contact_heading',
                ]
        );

        $this->add_control(
            'heading-margin', [
                'label' => __('Heading Margin', 'contact-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .email_login_wrap h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
            ]
        );
        $this->add_control(
            'heading-padding', [
                'label' => __('Heading Padding', 'contact-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .email_login_wrap h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
                'subtitle_color',
                [
                    'label' => __('Sub Heading Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .email_login_wrap h5' => 'color: {{VALUE}} !important;',
                    ]
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'subheading_design',
                    'label' => __('Sub Heading Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .email_login_wrap .km_contact_subheading',
                ]
        );
        $this->add_control(
            'subheading-margin', [
                'label' => __('Sub Heading Margin', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .email_login_wrap h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => ['5px'],
            ]
        );
        $this->add_control(
            'subheading-padding', [
                'label' => __('Sub HeadingPadding', 'post-grid-elementor-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .email_login_wrap h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btn_design',
            [
                'label' => __('Button Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #contact-submit' => 'background: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'btn_text_design',
            [
                'label' => __('Button Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #contact-submit' => 'color: {{VALUE}} !important;',
                ]
            ]
        );

        $this->add_control(
            'btn_design_hover',
            [
                'label' => __('Button Hover Background', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #contact-submit:hover' => 'background: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_control(
            'btn_color_hover',
            [
                'label' => __('Button Hover Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #contact-submit:hover' => 'color: {{VALUE}} !important;',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /**
     * render the widget
     * @param mixed $instance
     * @return HTML content
     */
    protected function render($instance = [])
    {
        print $this->displayCalenders();
    }

    private function displayCalenders()
    {

        $this->settings = $this->get_active_settings();
        $heading = $this->settings['section_headding'];
        $subheadding = $this->settings['section_subheadding'];
        $sectionbtntext = $this->settings['section_btn_text'];
        $captcha = fieldday()->engine->googleRecaptcha('',true);
        $content = fieldday()->engine->getView('contactform', ['Heading'=>$heading,'SubHeading'=>$subheadding,'phoneID'=>'parentPhoneW', 'btnText'=>$sectionbtntext]);
        return $content;
    }

}
