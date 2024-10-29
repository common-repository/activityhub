<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use fielddayCore;

class ElementorfielddayCalendar extends Widget_Base
{

    public function get_name()
    {
        return 'elementor-fieldday-calendar';
    }

    public function get_title()
    {
        return __('Fieldday Calender', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-calendar';
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
            'default' => __('Default title', 'fieldday'),
            'placeholder' => __('Type your title here', 'fieldday'),
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
                'event_time_color',
                [
                    'label' => __('Event Time Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} span.km_event_time' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'event_time_design',
                    'label' => __('Event Time Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} span.km_event_time',
                ]
        );

        $this->add_control(
                'event_title_color',
                [
                    'label' => __('Event Title', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.km_eventclick span' => 'color: {{VALUE}};',
                    ]
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'event_design',
                    'label' => __('Event Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} a.km_eventclick span',
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
        global $fielddaySetting;
        $calendar_view = fieldday()->engine->getValue('fieldday_calendar_view', $fielddaySetting, false);

        $this->settings = $this->get_active_settings();
        $heading = $this->settings['section_headding'];
        /* $alignment=$this->settings['alignment']; */
        $html = '';
        
        $html .= "<h2 class='km_heading center km_primary_color'>" . $heading . "</h2>";
        if($calendar_view=='detailed'){ 
            $html .= '<div id="km_events_calendar_detailed"></div>'; 
        }
        else{
            $html .= '<div id="km_events_calendar"></div>';
        }
        

        return $html;
    }

}
