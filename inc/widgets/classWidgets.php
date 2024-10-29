<?php

namespace fielddayWidget;

/**
 * Class fielddayWidget
 *
 * Plugin widgets for different page builders
 * @since 1.3.0
 */
class fielddayWidget
{

    /**
     * Instance
     *
     * @since 1.3.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Suffix for script i.e minified or not
     * @var $suffix String
     */
    private $suffix;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.3.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        // Register widget style
        $this->_initElementorWidgets();
        $this->suffix = (defined('WP_DEBUG') && true === WP_DEBUG) ? "" : '.min';
    }

    /**
     * Add elementor widgets to plugin
     */
    private function _initElementorWidgets()
    {
        /* add elementor stylesheet */
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);
        /* add elementor scripts */
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
        /* register elementor widgets */
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        /* add elementor widgets categories */
        add_action('elementor/elements/categories_registered', [$this, 'register_widget_category']);
        /* add elementor controls */
        add_action('elementor/controls/controls_registered', array($this, 'controls_registered'));
    }

    /**
     * widget_style
     *
     * Load main style files.
     *
     * @since 1.3.0
     * @access public
     */
    public function widget_styles()
    {
        wp_register_style('fieldday-addon-main-style', fieldday_URL . '/assets/css/widgets'.$this->suffix.'.css', null, fieldday_VERSION);
        wp_enqueue_style('fieldday-addon-main-style');
    }

    /**
     * widget_scripts
     *
     * Load main script files.
     *
     * @since 1.3.0
     * @access public
     */
    public function widget_scripts()
    {
        wp_register_script('fieldday-addon-main-script', fieldday_URL . '/assets/js/widgets' . $this->suffix . '.js', ['jquery'], fieldday_VERSION);
        wp_enqueue_script('fieldday-addon-main-script');

        wp_register_script('fieldday-addon-calender-new-script', fieldday_URL . '/assets/js/widgets_calender' . $this->suffix . '.js', ['jquery'], fieldday_VERSION);
        wp_enqueue_script('fieldday-addon-calender-new-script');
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.3.0
     * @access public
     */
    public function register_widgets()
    {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayFeaturedSession());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayDonationForm());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayReviews());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayCalendar());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayContact());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayMembership());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayFeaturedActivities());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayParties());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayActivitySessionsCopy());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayActivitySessions());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ElementorfielddayPackages());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\fieldDayGiftcards());
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.3.0
     * @access private
     */
    private function include_widgets_files()
    {
        require_once( __DIR__ . '/Elementor/classFeaturedSessions.php' );
        require_once( __DIR__ . '/Elementor/classfielddayDonation.php' );
        require_once( __DIR__ . '/Elementor/classfielddayReviews.php' );
        require_once( __DIR__ . '/Elementor/classfielddayCalender.php' );
        require_once( __DIR__ . '/Elementor/classfielddayContact.php' );
        require_once( __DIR__ . '/Elementor/classfielddayMembership.php' );
        require_once( __DIR__ . '/Elementor/classFeaturedActivities.php' );
        require_once( __DIR__ . '/Elementor/classActivitySessions.php' );
        require_once( __DIR__ . '/Elementor/classActivitySessionsCopy.php' );
        require_once( __DIR__ . '/Elementor/classPackages.php' );
        require_once( __DIR__ . '/Elementor/classFieldDayGiftcards.php' );
        require_once( __DIR__ . '/Elementor/classParties.php' );
    }

    /**
     * register widget category
     *
     * @since 1.3.0
     */
    public function register_widget_category($elements_manager)
    {

        $elements_manager->add_category(
                'wpcap-items', [
            'title' => __('WPCap Elements', 'post-carousel-elementor-addon'),
            'icon' => 'fa fa-plug',
                ]
        );
    }

    /**
     * Add new group control
     *
     * @since 1.3.0
     */
    public function controls_registered($controls_manager)
    {
        
    }

}

// Instantiate widget Class
fielddayWidget::instance();
