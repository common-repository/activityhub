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
class ElementorfielddayDonationForm extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-fieldday-donation';
    }

    public function get_title()
    {
        return __('Fieldday Donation', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    protected function _register_controls()
    {

        $this->wpcap_content_layout_options();
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
                'form_layout', [
            'label' => __('Form Layout', 'fieldday'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '1' => __('1 Column view', 'fieldday'),
                '2' => __('2 Columns view', 'fieldday')
            ],
            'default' => '1'
                ]
        );

        $this->add_control(
                'event_name', [
            'label' => __('Event Name', 'fieldday'),
            'type' => Controls_Manager::TEXTAREA,
                    'default' => 'Event Name'
                ]
        );
        $this->add_control(
                'event_description', [
            'label' => __('Event Description', 'fieldday'),
            'type' => Controls_Manager::TEXTAREA,
                    'default' => 'Event Description'
                ]
        );
        $this->add_control(
                'success_message', [
            'label' => __('Success Message', 'fieldday'),
            'type' => Controls_Manager::TEXTAREA,
                ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        // Get settings.
        $filters = [];
        $this->settings = $this->get_active_settings();
        $layoutClass = $this->settings['form_layout'] == 2 ? 'km_col_6' : 'km_col_12';
        $title = fieldday()->engine->getValue('event_name', $this->settings, false);
        $description = fieldday()->engine->getValue('event_description', $this->settings, false);
        $success_message = fieldday()->engine->getValue('success_message', $this->settings, false);
        print fieldday()->engine->getView('donate', ['title' => $title, 'description' => $description, 'layout_class' => $layoutClass, 'success_message' => $success_message]);
    }

}
