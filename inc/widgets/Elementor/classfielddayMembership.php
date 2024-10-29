<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use fielddayCore;

class ElementorfielddayMembership extends Widget_Base
{
    /* settings variable */

    private $settings;

    public function get_name()
    {
        return 'elementor-membership-sessions';
    }

    public function get_title()
    {
        return __('Fieldday Memberships', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
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
                '6' => __('6 Columns view', 'fieldday')
            ],
            'default' => '3'
                ]
        );
        $this->add_control(
                'purchase_text', [
            'label' => __('Purchase Button Text', 'fieldday'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Purchase', 'fieldday'),
                ]
        );

        $this->add_control(
                'timeamount_layout', [
            'label' => __('Show CreditAmount', 'fieldday'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '1' => __('Hours', 'fieldday'),
                '2' => __('Minutes', 'fieldday'),
            ],
            'default' => '1'
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
                'event_list_title',
                [
                    'label' => __('Membership Lists Title', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_featured_membershipsession_tilte' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'event_list_title_design',
                    'label' => __('Membership Lists Title Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .km_featured_membershipsession_tilte',
                ]
        );

        $this->add_control(
                'event_title_color',
                [
                    'label' => __('List Content', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .membership_section span' => 'color: {{VALUE}};',
                    ]
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'event_list_content_design',
                    'label' => __('List Content Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .membership_section span',
                ]
        );

        $this->add_responsive_control(
                'align',
                [
                    'label' => __('Alignment', 'elementor'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justified', 'elementor'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .km_featured_membershipsession_content' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    private function membershipList()
    {

        $membership = fieldday()->api->homeMemberActivities();

        return $membership->data;
    }

    private function displayFeatureImage($session)
    {
        $featuredImg = fieldday()->engine->getValue('image', $session, false);
        $thumburl = fieldday()->engine->getValue('thumbnail', $featuredImg, false);

        if ($thumburl)
        {
            return wp_sprintf('<div class="km_featured_session_img membership_session"><img src="%s" class="img responsive-img"></div>', $thumburl);
        }
    }

    /**
     * display purchase button
     * @param Object $session
     */
    private function purchaseButton($featuredSession)
    {
        global $fielddaySetting;

        if (fieldday()->engine->isKmLogin())
        {
            return wp_sprintf('<a href="javascript:void(0);"  class="km_btn km_add_to_cart_membership" data-membershipid="' . $featuredSession->_id . '" data-providerid="' . $featuredSession->providerId . '"  data-membership-price="' . $featuredSession->totalAmount . '"  data-membership-title="' . $featuredSession->title . '">%s</a>', $this->settings['purchase_text']);
        } else
        {
            $showAuthPopup = wp_sprintf('data-session-id="%s" data-tag-id="%s" data-session-date="%s" data-session-featured="%s" data-isGuest="%s" onclick="fieldday.showAuthPopup(this, event)"', @$session->_id, @$tagId, @$session->dateTimestamp->from, "feature-purchase", "true");

            return wp_sprintf('<a href="javascript:void(0);" ' . $showAuthPopup . ' class="km_btn km_feature_purchase_btn km_primary_bg">%s</a>', $this->settings['purchase_text']);
        }
    }

    private function displayCreditamount($amount, $type, $creditTypeApi)
    {
        $result;

        if ($type == '1')
        {
            $hours = floor($amount / 60);
            $min = $amount - ($hours * 60);
            $min = $min ? ":" . $min : '';
            $result = $hours . $min . ' Hours';
        } else
        {
            $result = $amount . " Minutes";
        }
        return $result;
    }

    private function displayMemberList()
    {

        $sessions = $this->membershipList();
        print '<div class="km_featured_sessions_wrap" id="km_featureed_session">';

        print '<div class="km_featured_sessions">';
        foreach ($sessions as $key => $session)
        {
            print $this->singleSession($session);
        }
        print '</div>';

        print '</div>';
    }

    private function singleSession($featuredSession)
    {

        $layoutColumns = $this->settings['session_layout'];
        $creditamonts = $this->settings['timeamount_layout'];
        $layoutclass = ["layout_{$layoutColumns}_columns"];
        $finalPrice = fieldday()->engine->display_price($featuredSession->totalAmount);
        $html = '<div class="km_session_single_item km_featured_single ' . implode(" ", $layoutclass) . '" 
        >';
        $html .= $this->displayFeatureImage($featuredSession);
        $html .= '<div class="km_featured_membershipsession_content">';
        $html .= '<span class="km_featured_membershipsession_tilte">';
        $html .= $featuredSession->title;
        $html .= '</span>';
        $html .= '<div class="membership_section">';
        $html .= '<span class="km_mermbership offer"> Membership offers ';
        $html .= $this->displayCreditamount($featuredSession->creditAmount, $creditamonts, $featuredSession->creditType) . " credits";
        $html .= '</span>';
        $html .= '<span class="km_mermbership duration">';
        $html .= 'Duration: ' . $featuredSession->validFor . ' ' . $featuredSession->validForUnit;
        $html .= '</span>';
        $html .= '<span class="km_mermbership discription">';
        $html .= @$featuredSession->description;
        $html .= '</span>';
        $html .= '<span class="km_mermbership benifits">';
        $html .= 'Benefits: ' . @$featuredSession->benefits[0];
        $html .= '</span>';
        $html .= '<span class="km_mermbership price">';
        $html .= 'Price: ' . $finalPrice;
        $html .= '</span>';
        $html .= '<div class="km_featured_btns">';
        $html .= $this->purchaseButton($featuredSession);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div></div>';

        return $html;
    }

    protected function render($instance = [])
    {
        $this->settings = $this->get_active_settings();
        $this->displayMemberList();
    }

}
?>

