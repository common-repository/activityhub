<?php

namespace fielddayWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;

class ElementorfielddayReviews extends Widget_Base
{

    public function get_name()
    {
        return 'elementor-fieldday-testimonial';
    }

    public function get_title()
    {
        return __('Fieldday Reviews', 'fieldday');
    }

    public function get_icon()
    {
        return 'eicon-rating';
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
                'grid_layout', [
            'label' => __('Grid Layout', 'fieldday'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '1' => __('1 Column view', 'fieldday'),
                '2' => __('2 Columns view', 'fieldday'),
                '3' => __('3 Colums view', 'fieldday')
            ],
            'default' => '1'
                ]
        );


        $this->add_control(
                'content_tag', [
            'label' => __('Content HTML Tag', 'fieldday'),
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
                'i' => 'i'
            ],
            'default' => 'i'
                ]
        );

        $this->add_control(
            'counts', [
                'label' => __('Counts', 'fieldday'),
                'type' => Controls_Manager::TEXT,
                'default' => __('', 'fieldday')
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
                'description_color',
                [
                    'label' => __('Testimonial Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_review_description' => 'color: {{VALUE}};',
                    ]
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_desc_design',
                    'label' => __('Testimonial Typography', 'plugin-domain'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .km_review_description',
                ]
        );

        $this->add_control(
                'username_color',
                [
                    'label' => __('Username Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .km_review_username' => 'color: {{VALUE}};',
                    ]
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_username_design',
                    'label' => __('Username Typography', 'fieldday'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .km_review_username',
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
        // Get settings.
        $this->settings = $this->get_active_settings();
        $set_counts_value = $this->settings['counts']??10;
        if($set_counts_value && $set_counts_value!=''){
            $testemonials = fieldday()->api->getProviderTestimonials(['page' => 0, 'count' => $set_counts_value]);
        }else{
            $testemonials = fieldday()->api->getProviderTestimonials(['page' => 0, 'count' => 10]);
        }
        
        if ($testemonials->statusCode !== 200)
        {
            echo fieldday()->engine->displayFlash('error', __($testemonials->message, 'fieldday'));
            return;
        }

        $this->displayReviews($testemonials);
    }

    private function displayReviews($testemonialsResponse)
    {
        $testemonials = $testemonialsResponse->data;

        print '<div class="km_reviews_outer">';
        print $this->displayReviewSummary($testemonials);
        print wp_sprintf("<h3>%s</h3>", __("Reviews"));
        print "<div class='km_reviews_wrap'>";
        foreach ($testemonials->testimonials as $key => $testimonial)
        { 
            print $this->singleReview($testimonial);
        }
        print '</div>';
        print '</div>';
    }

    private function singleReview($testimonial)
    {
        $layoutColumns = $this->settings['grid_layout'];
        $layoutclass = "layout_{$layoutColumns}_columns";

        $html = '<div id="km_review_' . $testimonial->_id . '" class="km_single_review ' . $layoutclass . '">';
        $html .= "<div class='km_review_header'>";
        $html .= wp_sprintf("<span class='km_review_date'>%s</span>", fieldday()->engine->parseDate($testimonial->createdAt));
        $html .= $this->testimonialUserDetail($testimonial->reviewBy, $testimonial);
        $html .= '</div>';
        $html .= "<div class='km_review_body'>";
        $html .= $this->testimonialDescription($testimonial);
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * display testimonial description
     * @param type $testimonial
     * @return String
     */
    protected function testimonialDescription($testimonial)
    {
        return wp_sprintf('<%1$s class="km_review_description">%2$s</%1$s>', $this->settings['content_tag'], $testimonial->description);
    }

    /**
     * testimonial user info
     * @param object $userInfo
     * @param object $testimonial testimonial data
     * @return string
     */
    protected function testimonialUserDetail($userInfo, $testimonial)
    {
        if ($testimonial->verifiedCustomer)
        {
            $isVerified = "km_verified_user km_secondary_color";
            $verifiedText = __("Verified Buyer", 'fieldday');
        } else
        {
            $isVerified = "km_unverified_user";
            $verifiedText = __("Guest Buyer", 'fieldday');
        }

        $html = "<div class='km_review_user_outer km_review_user_outer_testimonial_wrap'>";
        $html .= wp_sprintf("<div class='km_review_user_dp'>%s</div>", fieldday()->engine->getfielddayUserDP($userInfo));
        $html .= "<div class='km_review_user_name'>";
        $html .= wp_sprintf("<div class='km_review_user_wrap'><span class='km_review_username'>%s</span><span class='km_review_is_verified %s'>%s</span></div>", $userInfo->name, $isVerified, $verifiedText);
        $html .= $this->displayStars($testimonial->rating);
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    protected function displayReviewSummary($testimonials)
    {
        $averageRating = $testimonials->averageRating;
        $reviewCount = (array) $testimonials->reviewCount;
        $html = "<div class='km_review_summary_outer'>";
        $html .= "<div class='km_review_left'>";
        $html .= "<div class='km_review_head'>";
        $html .= wp_sprintf("<span class='km_average_review'>%s</span>", number_format($averageRating->rating, 1));
        $html .= $this->displayStars($averageRating->rating);
        $html .= "</div>";
        $html .= wp_sprintf("<span class='km_review_total'>Based on %d Reviews</span>", $averageRating->ratingCount);
        $html .= "</div>";
        $html .= "<div class='km_review_right'>";
        $html .= $this->displayDetailedSummary($reviewCount, $averageRating->ratingCount);
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    /**
     *
     * @param INT $rating
     * @param INT $totalReviews
     * @return string
     */
    private function displayStars($rating)
    {
        $html = '<div class="km_star_rating_wrap">';
        $html .= "<div class='km_star_rating km_custom_stars'>";
        for ($index = 5; $index >= 1; $index--)
        {
            $class = $rating >= $index ? "km_star_yellow" : "km_star_gray";
            $html .= wp_sprintf('<label for="%1$s-stars" class="star %2$s">&#9733;</label>', $index, $class);
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * display detailed info
     * @param array $reviews
     */
    private function displayDetailedSummary($reviews, $totalRate)
    {   $html;
        $k = array_keys($reviews);
        $v = array_values($reviews);
        $rv = array_reverse($v);
        $kv = array_reverse($k);
        $reviews = array_combine($kv, $rv);
        $html.= "<div class='km_star_rating_summary'>";
        foreach ($reviews as $key => $reviewsCount)
        {

            $percentage = round(($reviewsCount * 100) / $totalRate, 1);
            $html .= "<div class='km_single_summary'>";
            $html .= $this->displayStars($key);
            $html .= wp_sprintf("<span class='km_progress_wrap'><span style='width:%s' class='km_progress_bar'></span></span>", __("{$percentage}%"));
            $html .= wp_sprintf("<span class='km_review_perc km_primary_color'>(%s)</span>", $reviewsCount);
            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }

}
