<?php

/*
 * fieldday Main class
 * @package fieldday
 * @since   2.1.0
 */

class fieldday
{

    /**
     * fieldday version.
     *
     * @var string
     */
    public $version = '3.4.0';

    /**
     * The single instance of the class.
     *
     * @var fieldday
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * fieldday API instance
     *
     * @var fieldday
     * @since 1.0.0
     */
    public $api;

    /**
     * fieldday core functions
     *
     * @var fielddayApi
     * @since 1.0.0
     */
    public $engine;

    /**
     * Suffix for script i.e minified or not
     * @var $suffix String
     */
    private $suffix;

    /**
     * Main fieldday Instance.
     *
     * Ensures only one instance of IsLayouts is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return fieldday.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * fieldday Constructor.
     *
     * @global Array fieldday
     *
     */
    public function __construct()
    {
        global $fielddaySetting;

        $fielddaySetting = get_option('fieldday_options', true);
        if (!is_array($fielddaySetting)) {
            $fielddaySetting = [];
        }
        $this->define_constants();
        $this->includes();
        $this->init_hooks();

        $this->api = new fielddayApi();
        $this->engine = new fielddayCore();
        $cookieoffset = $this->engine->getCookieStorage('offset', false);
        if ($cookieoffset) {
            $fielddaySetting['offset'] = $cookieoffset;
        } else {
            $fielddaySetting['offset'] = 300;
        }
        /*$cookievisitbefore = $this->engine->getCookieStorage('visitbefore', false);
        if ($cookievisitbefore)
        {  echo "visitedbefore";
        echo $fielddaySetting['visitbefore'] = $cookievisitbefore;
        } else
        {   echo "notvisitedbefore";
        $fielddaySetting['visitbefore'] = '';
        }*/
        if (isset($_REQUEST['cartId'])) {
            setcookie('GcartId', $_REQUEST['cartId'], time() + (86400), "/"); // 86400 = 1 day
        }
        if (isset($_REQUEST['parentId'])) {
            setcookie('GparentId', $_REQUEST['parentId'], time() + (86400), "/"); // 86400 = 1 day
        }
        $fielddaySetting['siteName'] = get_bloginfo();
        if (!$this->engine->getValue('global_popup_key', $fielddaySetting, false)) {
            $randomnumber = "field_day_" . rand(1, 9999);
            $fielddaySetting['global_popup_key'] = $randomnumber;
        }
        //$fielddaySetting['global_popup_key'] = "_global_discount_check23222";
        $this->suffix = (defined('WP_DEBUG') && true === WP_DEBUG) ? "" : '.min';
    }

    /**
     * Hook into actions and filters.
     *
     * @since 1.0.0
     */
    private function init_hooks()
    {
        register_activation_hook(fieldday_PLUGIN_FILE, array($this, 'fieldday_plugin_install'));
        add_action('init', array($this, 'init'), 0);
        add_action('after_setup_theme', [$this, 'remove_admin_bar']);

        /* register front end scripts */
        add_action('wp_enqueue_scripts', array($this, 'fielddayScripts'), 0);

        /* register admin scripts */
        add_action('admin_enqueue_scripts', array($this, 'fielddayAdminScripts'), 0);

        /* add popup messages in footer */
        add_action('wp_footer', [$this, 'KmAlertMessages']);

        /*
        Not Required Anymore
        add_action('wp_footer', [$this, 'KmStickyWidget']);
        Not Required Anymore  end
         */

        add_action('wp_footer', [$this, 'KmStickyWidgetAddToCartIcon']);

        /* add script in header section */
        add_action('wp_head', [$this, 'fielddayHead']);

        /* add fieldday user into menu selected */
        add_filter('wp_nav_menu_items', [$this, 'fielddayUserInMenu'], 999, 2);

        /* add cart icon into menu selected */
        //add_filter('wp_nav_menu_items', [$this, 'fielddayCartInMenu'], 999, 2);
    }

    public function fielddayHead()
    {
        global $fielddaySetting;
        $this->engine->getValue('fieldday_header_Script', $fielddaySetting);
        $kmPrimaryColor = $this->engine->getValue('primary_color', $fielddaySetting, false);
        $kmSecondaryColor = $this->engine->getValue('secondary_color', $fielddaySetting, false);
        $kmHighlightColor = $this->engine->getValue('highlightcolor', $fielddaySetting, false);
        $fieldday_bullets = $this->engine->getValue('fieldday_bullets', $fielddaySetting, false);
        $fieldday_text_color = $this->engine->getValue('textcolor', $fielddaySetting, false);
        if ($fieldday_text_color == '') {$fieldday_text_color = "#ffffff";}
        $fieldday_text_color2 = $this->engine->getValue('textcolor2', $fielddaySetting, false);
        $fieldday_user_menu_font_size = $this->engine->getValue('fieldday_user_menu_font_size', $fielddaySetting, false);
        if ($fieldday_text_color2 == '') {$fieldday_text_color2 = "#ffffff";}

        print "<style>";
        if ($kmPrimaryColor) {
            print wp_sprintf(".km_primary_bg {background-color: %s !important; color: %s!important;}", $kmPrimaryColor, $fieldday_text_color);
            print wp_sprintf(".km_primary_color {color: %s !important;}", $kmPrimaryColor);
            print wp_sprintf(".km_active_step .km_primary_steps::after {background-color: %s !important; border-color: %s !important;}", $kmPrimaryColor, $kmPrimaryColor);
            print wp_sprintf(".km_active_step .km_primary_steps {background-color: %s !important;border-color: %s !important;}", $kmPrimaryColor, $kmPrimaryColor);
            print wp_sprintf(".km_primary_border {border-color: %s !important;}", $kmPrimaryColor);
            print wp_sprintf(".km_primary_shadow {box-shadow: 0px 0px 5px %s !important;}", $kmPrimaryColor);
            print wp_sprintf(".km_active_participant:before {color: %s !important;}", $kmPrimaryColor);
            print wp_sprintf("th.fc-day-header.fc-widget-header {color: %s !important;}", $kmPrimaryColor);
        }
        if ($kmSecondaryColor) {
            print wp_sprintf(".km_secondary_border {border-color: %s !important;}", $kmSecondaryColor);
            print wp_sprintf(".km_secondary_bg {background-color: %s !important; color: %s!important;}", $kmSecondaryColor, $fieldday_text_color2);
            print wp_sprintf(".km_secondary_color {color: %s !important;}", $kmSecondaryColor);
            print wp_sprintf(".km_primary_bg:hover{background-color: %s !important;}", $kmSecondaryColor);
            print wp_sprintf(".km_secondary_hover_bg:hover{background-color: %s !important;}", $kmSecondaryColor);
            print wp_sprintf(".km_primary_color:not(p):not(h2):not(h3):not(h5):hover{color: %s !important;}", $kmSecondaryColor);
            print wp_sprintf(".km_secondary_color g{fill: %s !important;}", $kmSecondaryColor);
            print wp_sprintf("th.fc-day-header.fc-widget-header {background-color: %s !important;}", $kmSecondaryColor);
        }
        if ($kmHighlightColor) {
            print wp_sprintf(".km_highlight_color{color: %s !important;}", $kmHighlightColor);
        }
        if ($fieldday_bullets) {
            print wp_sprintf('.km_bullets_arrow span:before{ content: "%s"; }', $fieldday_bullets);
        }
        if ($fieldday_user_menu_font_size) {
            print wp_sprintf('.km_user_menu_wrapper .km_user_avatar_wrapper span.km_default_avatar.km_secondary_bg.km_user_info_menu_span{font-size:%spx;}', $fieldday_user_menu_font_size);
        }
        print "</style>";
    }

    /**
     * user HTML in menu
     * @global Array $fielddaySetting
     * @param String $items
     * @param mixed $args
     * @return String menu Html
     */

    public function fielddayUserInMenu($items, $args)
    {
        global $fielddaySetting;

        $selectedMenu = $this->engine->getValue('user_menu', $fielddaySetting, false);
        $selectedCartMenu = $this->engine->getValue('cart_menu', $fielddaySetting, false);
        if (isset($args->menu->term_id)) {
            if ($selectedCartMenu == $args->menu->term_id) {
                $items .= $this->engine->GetCartView();
            }
            if ($selectedMenu == $args->menu->term_id) {
                $items .= $this->engine->UserInMenuHtml();
            }

            return $items;
        } else {
            $menu = wp_get_nav_menu_object($args->menu);
            if ($selectedCartMenu == $menu->term_id) {
                $items .= $this->engine->GetCartView();
            }
            if ($selectedMenu == $menu->term_id) {
                $items .= $this->engine->UserInMenuHtml();
            }

            return $items;
        }

    }

    /*
     * fieldday instalation hook
     */

    public function fieldday_plugin_install()
    {

    }

    /**
     * Init plugin when WordPress Initialises.
     */
    public function init()
    {
        global $KmUser;
        $KmUser = $this->getKmUser();
        $this->BlockfielddayDashboard();
        if (!session_id()) {
            session_start();
        }
        add_role(
            fieldday_ROLE, __('fieldday User'), array(
                'read' => true, // true allows this capability
            )
        );
    }

    /**
     * Define fieldday Constants.
     */
    private function define_constants()
    {

        $this->define('fieldday_ABSPATH', dirname(fieldday_PLUGIN_FILE) . '/');
        $this->define('fieldday_BASENAME', plugin_basename(fieldday_PLUGIN_FILE));
        $this->define('fieldday_URL', plugins_url(basename(fieldday_ABSPATH)));
        $this->define('fieldday_VERSION', $this->version);
        $this->define('fieldday_PLACEHOLDER', fieldday_URL . '/assets/img/placeholder.png');
        $this->define('fieldday_PLACEHOLDER_CHECK', fieldday_URL . '/assets/img/refund_cancel_check.png');
        $this->define('fieldday_PLACEHOLDER_USER', fieldday_URL . '/assets/img/personal_info.png');
        $this->define('fieldday_CURRENCY', '$');
        $this->define('fieldday_ROLE', 'km_user');
        $this->define('fieldday_NOT_ALLOWED_INPUT_CHAR', '/http:|https:|script|src=|\/|\.js|<|>/i');
    }

    /**
     * Include required core files used in admin and on the frontend.
     */
    public function includes()
    {
        global $fielddaySetting;
        $activetheme = array_key_exists('fieldday_theme_mode', $fielddaySetting) ? $fielddaySetting['fieldday_theme_mode'] : null;

        include_once fieldday_ABSPATH . '/inc/ClassFielddayBase.php';
        include_once fieldday_ABSPATH . '/inc/ClassFielddayhubCore.php';
        include_once fieldday_ABSPATH . '/lib/FielddayApi/FielddayApi.php';
        include_once fieldday_ABSPATH . '/inc/ClassShortcodes.php';
        include_once fieldday_ABSPATH . '/inc/ClassActions.php';
        include_once fieldday_ABSPATH . '/inc/widgets/classWidgets.php';
        /*active theme fucntion file*/
        if ($activetheme && file_exists(fieldday_ABSPATH . "/views/theme/{$activetheme}/functions.php")) {
            include_once fieldday_ABSPATH . "/views/theme/{$activetheme}/functions.php";
        }

        /* add admin files */

        /* add admin files */
        if (is_admin()) {
            include_once fieldday_ABSPATH . '/inc/ClassAdminOptions.php';
        }
    }

    /**
     * get fieldday Current loggedin user
     *
     * @return boolean
     */
    public function getKmUser()
    {
        $km_user = wp_get_current_user();
        if ($km_user) {
            $meta = get_user_meta($km_user->ID, 'km_user_data', true);
            if ($meta) {
                $KmUser = $this->api->getUser($meta->_id, $meta->accessToken);
                if ($KmUser->statusCode === 200) {
                    $KmUser->data->accessToken = $meta->accessToken;
                    return $KmUser->data;
                }
            }
        }

        return false;
    }

    /*
     * add some alert messages in wordpress footer
     */

    public function KmAlertMessages()
    {
        global $fielddaySetting;
        $cookieCheck = $this->engine->getCookieStorage($fielddaySetting['global_popup_key'], false);
        $isenabled = $this->engine->getValue('fieldday_global_popup', $fielddaySetting, false);
        $isPopupEnablePage = $this->engine->getValue('fieldday_globalpopup_page', $fielddaySetting, false);
        $pageID = get_the_ID();
        if ($isenabled == 'enabled' && !$cookieCheck) {
            if ($isPopupEnablePage == $pageID || $isPopupEnablePage == 'all') {
                echo $this->engine->getView('global_popup');
            }
        }

        global $fielddaySetting;
        $this->engine->getValue('fieldday_footer_Script', $fielddaySetting);

        echo $this->engine->getView('fieldday_alerts');
    }

    /*
     * add some alert messages in wordpress footer
     */
    public function KmStickyWidget()
    {
        global $fielddaySetting;
        $isenabled = $this->engine->getValue('fieldday_sticky_widget', $fielddaySetting, false);
        $StickyOption = $this->engine->getValue('fieldday_sticky_option', $fielddaySetting, false);
        if ($isenabled == 'enable') {
            echo '<div class="km_sticky km_sticky_nw_cls"><div class="km_sticky_content"><h3>Have questions?</h3><a class="km_sticky_btn" href="javascript:;"><img src="' . fieldday_URL . '/assets/img/contact-fixed.png" alt="Contact Us Now">Contact Us Now</a></div><div class="km_sticky_icon km_sticky_close"></div></div>';
        }

    }

    public function KmStickyWidgetAddToCartIcon()
    {
        global $fielddaySetting;
        $isenabled = $this->engine->getValue('fieldday_sticky_widget', $fielddaySetting, false);
        $fieldday_sticky_icon_bg_color = $this->engine->getValue('fieldday_sticky_icon_bg_color', $fielddaySetting, false);
        $fieldday_sticky_icon_textcolor = $this->engine->getValue('fieldday_sticky_icon_textcolor', $fielddaySetting, false);
        $kmPrimaryColor_Value = $this->engine->getValue('primary_color', $fielddaySetting, false);
        $cartdata = fieldday()->engine->GetCartData();
        if ($cartdata) {
            $count = count($cartdata);
        } else {
            $count = 0;
        }

        if (!$fieldday_sticky_icon_textcolor || $fieldday_sticky_icon_textcolor == '') {
            $fieldday_sticky_icon_textcolor = '#ffffff';
        }

        if (!$fieldday_sticky_icon_bg_color || $fieldday_sticky_icon_bg_color == '') {
            if ($kmPrimaryColor_Value && $kmPrimaryColor_Value != '') {
                $fieldday_sticky_icon_bg_color = $kmPrimaryColor_Value;
            } else {
                $fieldday_sticky_icon_bg_color = '#000000';
            }
        }

        if ($isenabled == 'enable') {

            echo '<div class="km_sticky_cartIcon_mobile_inner_wrap"  style="background:' . $fieldday_sticky_icon_bg_color . ';">
        <div class="km_sticky_cartIcon_mobile_inner KmStickyWidgetAddToCartIcon"  style="background:' . $fieldday_sticky_icon_bg_color . ';">
            <span id="KmStickyWidgetAddToCartIcon_total_count"    style="color:' . $fieldday_sticky_icon_bg_color . ';background:' . $fieldday_sticky_icon_textcolor . ';"  class="km_sticky_cartIcon">' . $count . '</span>
            <svg baseProfile="tiny" class="km_sticky_cartIconsvg" height="" version="1.2" viewBox="" width="" fill="' . $fieldday_sticky_icon_textcolor . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="
">
                <g id="Layer_1" fill-rule="evenodd">
                    <g>
                        <path d="M20.756,5.345C20.565,5.126,20.29,5,20,5H6.181L5.986,3.836C5.906,3.354,5.489,3,5,3H2.75c-0.553,0-1,0.447-1,1    s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124c0.016,0.053,0.029,0.103,0.054,0.151    c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112c0.058,0.054,0.125,0.092,0.193,0.13    c0.038,0.021,0.071,0.049,0.112,0.065C6.748,16.972,6.87,17,6.999,17C7,17,18,17,18,17c0.553,0,1-0.447,1-1s-0.447-1-1-1H7.847    l-0.166-1H19c0.498,0,0.92-0.366,0.99-0.858l1-7C21.031,5.854,20.945,5.563,20.756,5.345z M18.847,7l-0.285,2H15V7H18.847z M14,7    v2h-3V7H14z M14,10v2h-3v-2H14z M10,7v2H7C6.947,9,6.899,9.015,6.852,9.03L6.514,7H10z M7.014,10H10v2H7.347L7.014,10z M15,12v-2    h3.418l-0.285,2H15z">
                        </path>
                        <circle cx="8.5" cy="19.5" r="1.5"></circle>
                        <circle cx="17.5" cy="19.5" r="1.5"></circle>
                    </g>
                </g>
            </svg>
        </div>
        <div class="km_sticky_contactIcon_inner_wrap km_sticky_btn"  style="background:' . $fieldday_sticky_icon_bg_color . ';">
            <div class="km_sticky_contactIcon_inner">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 26 23"  fill="' . $fieldday_sticky_icon_textcolor . '" >
                    <g clip-path="url(#clip0_146_94)">
                        <path d="M25.7301 0.619995V13.39C25.7301 13.4709 25.714 13.5511 25.6828 13.6258C25.6515 13.7004 25.6056 13.7681 25.5479 13.8249C25.4902 13.8817 25.4218 13.9264 25.3466 13.9565C25.2715 13.9865 25.1911 14.0013 25.1101 14H7.40012C7.23834 14 7.08318 13.9357 6.96879 13.8213C6.85439 13.7069 6.79012 13.5518 6.79012 13.39V10.8L7.18012 10.31C7.36128 10.0837 7.47669 9.81194 7.51373 9.52444C7.55077 9.23695 7.50801 8.94481 7.39013 8.67999C7.15032 8.15215 6.94977 7.60733 6.79012 7.04999V0.619995C6.78879 0.539051 6.80359 0.458651 6.83365 0.383484C6.86371 0.308317 6.90844 0.239897 6.96522 0.18219C7.02199 0.124483 7.08968 0.0786421 7.16435 0.0473633C7.23902 0.0160845 7.31917 -1.08733e-05 7.40012 5.51108e-09H25.1101C25.2746 5.51108e-09 25.4323 0.065307 25.5485 0.18158C25.6648 0.297852 25.7301 0.455561 25.7301 0.619995Z" fill="' . $fieldday_sticky_icon_textcolor . '"></path>
                        <path d="M7.83984 1.12012L16.1398 7.59012L24.6598 1.18012" stroke="' . $fieldday_sticky_icon_bg_color . '" stroke-miterlimit="10" stroke-linecap="round"></path>
                        <path d="M7.95996 12.9298L13.01 7.2998" stroke="' . $fieldday_sticky_icon_bg_color . '" stroke-miterlimit="10" stroke-linecap="round"></path>
                        <path d="M19.8901 7.10986L24.7101 12.9499" stroke="' . $fieldday_sticky_icon_bg_color . '" stroke-miterlimit="10" stroke-linecap="round"></path>
                        <path d="M4.6702 12.6299C6.54642 15.4856 9.27606 17.6763 12.4702 18.8899L14.5602 16.2699C14.6869 16.1178 14.8521 16.0023 15.0384 15.9355C15.2248 15.8687 15.4257 15.8529 15.6202 15.8899C16.8911 16.1648 18.1985 16.229 19.4902 16.0799C19.6345 16.0648 19.7803 16.0789 19.919 16.1214C20.0578 16.1639 20.1865 16.2339 20.2976 16.3272C20.4086 16.4205 20.4997 16.5353 20.5655 16.6646C20.6312 16.7939 20.6702 16.9352 20.6802 17.0799L21.0902 20.8199C21.1053 20.9637 21.0912 21.109 21.0486 21.2471C21.006 21.3853 20.9358 21.5133 20.8424 21.6236C20.7489 21.7339 20.6341 21.8241 20.5048 21.8888C20.3755 21.9534 20.2345 21.9913 20.0902 21.9999C15.2781 22.5275 10.4535 21.1226 6.67689 18.0942C2.90027 15.0658 0.480746 10.6617 -0.0498009 5.84992C-0.0634972 5.70642 -0.0483318 5.56162 -0.00519184 5.42408C0.0379482 5.28654 0.108186 5.15902 0.201382 5.04905C0.294578 4.93908 0.408852 4.84887 0.537456 4.78376C0.666061 4.71864 0.806398 4.67992 0.950199 4.6699L4.6902 4.25989C4.83421 4.2433 4.9801 4.25644 5.11885 4.29847C5.25759 4.3405 5.38624 4.41055 5.49684 4.50428C5.60743 4.59801 5.69763 4.71342 5.76185 4.84339C5.82607 4.97336 5.86294 5.11511 5.8702 5.25989C6.00218 6.55187 6.33977 7.81448 6.8702 8.99991C6.95156 9.17984 6.98154 9.37874 6.95683 9.57465C6.93212 9.77056 6.85368 9.95581 6.7302 10.1099L4.6702 12.6299Z" fill="' . $fieldday_sticky_icon_textcolor . '"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_146_94">
                            <rect width="25.73" height="22.06" fill="' . $fieldday_sticky_icon_textcolor . '"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </div>

        </div>
    </div>';

        }
    }
    /**
     * register and enque front end styles and scripts.
     *
     * @since 1.0.0
     */
    public function fielddayScripts()
    {
        global $post;
        global $fielddaySetting;
        $activetheme = $this->engine->getvalue('fieldday_theme_mode', $fielddaySetting, false);

        wp_register_script('intl-tel-input', fieldday_URL . '/assets/js/intlTelInput.js', [], fieldday_VERSION);
        wp_register_script('cleave', fieldday_URL . '/assets/js/cleave.min.js', array(), fieldday_VERSION);
        wp_register_script('cleave-phone.us', fieldday_URL . '/assets/js/cleave-phone.i18n.js', array(), fieldday_VERSION);
        wp_register_script('parsley', fieldday_URL . '/assets/js/parsley.min.js', array(), fieldday_VERSION);
        wp_register_script('serializejson', fieldday_URL . '/assets/js/jquery.serializejson.js', array(), fieldday_VERSION);
        wp_register_script('select2', fieldday_URL . '/assets/js/select2.min.js', array('jquery'), fieldday_VERSION, true);
        wp_register_script('km_slider', fieldday_URL . '/assets/js/slick.min.js', array('jquery'), fieldday_VERSION, true);
        wp_register_script('km_daterangepicker', fieldday_URL . '/assets/js/daterangepicker.min.js', array('jquery'), fieldday_VERSION, true);
        wp_register_script('km_multidatespicker', fieldday_URL . '/assets/js/jquery-ui.multidatespicker.js', array('jquery'), fieldday_VERSION, true);
        wp_register_script('km_stripe_v2','https://js.stripe.com/v2/',[], fieldday_VERSION, true);
        wp_register_script('km_stripe_v3','https://js.stripe.com/v3/',[], fieldday_VERSION, true);
        wp_register_script('km_fullcalendar', fieldday_URL . '/assets/js/fullcalendar.min.js', array('jquery'), fieldday_VERSION, true);
        $themeJsFile = fieldday_ABSPATH . "/views/theme/{$activetheme}/assets/js/scripts.js";

        if (file_exists($themeJsFile)) {

            wp_enqueue_script('km_theme_js_custom', fieldday_URL . "/views/theme/{$activetheme}/assets/js/scripts.js", array('jquery'), fieldday_VERSION);
        }

        //wp_enqueue_script('fieldday_script', fieldday_URL . "/assets/js/fieldday{$this->suffix}.js", array('jquery', 'moment', 'intl-tel-input', 'cleave', 'cleave-phone.us', 'parsley', 'serializejson', 'select2', 'km_slider', 'km_daterangepicker', 'km_fullcalendar', 'km_theme_js_custom'), fieldday_VERSION);

        wp_enqueue_script('fieldday_script', fieldday_URL . "/assets/js/fieldday{$this->suffix}.js", array('jquery','km_stripe_v2','km_stripe_v3','moment', 'intl-tel-input', 'cleave', 'cleave-phone.us', 'parsley', 'serializejson', 'select2', 'km_slider', 'km_daterangepicker', 'km_fullcalendar', 'km_theme_js_custom'), fieldday_VERSION);

        wp_enqueue_script('google-api', '//www.google.com/recaptcha/api.js?h1=en&amp', array(), fieldday_VERSION);

        /**** Pollyfill js commented becuase of hack attack */
        /*
        wp_enqueue_script('google-polyfill-fixed', '//polyfill.io/v3/polyfill.js?features=Symbol%2CObject.getOwnPropertySymbols%2CSymbol.asyncIterator%2CSymbol.for%2CSymbol.hasInstance%2CSymbol.isConcatSpreadable%2CSymbol.iterator%2CSymbol.keyFor%2CSymbol.match%2CSymbol.replace%2CSymbol.prototype.description%2CSymbol.search%2CSymbol.species%2CSymbol.split%2CSymbol.toPrimitive%2CSymbol.toStringTag%2CSymbol.unscopables
        ', array(), fieldday_VERSION);
        */

        $googlemapapi = $this->engine->getvalue('fieldday_googlemapapi_mode', $fielddaySetting, false);

        wp_enqueue_script('google-map-api', "//maps.googleapis.com/maps/api/js?key={$googlemapapi}&libraries=places", array(), fieldday_VERSION);
        /* if(!$this->engine->isKmLogin() ){
        wp_enqueue_script('google-map-api', "//maps.googleapis.com/maps/api/js?key={$googlemapapi}&libraries=places&sensor=false", array(), fieldday_VERSION);
        } */

        //wp_enqueue_script('stripe', 'https://js.stripe.com/v2/');

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('km_multidatespicker');

        wp_register_style('km_fontawesome', fieldday_URL . '/assets/css/fontawesome.full.min.css');
        wp_register_style('intl-tel-input', fieldday_URL . '/assets/css/intlTelInput.css', [], fieldday_VERSION);
        wp_register_style('jquery-ui', fieldday_URL . '/assets/css/jquery-ui.css');
        wp_register_style('select2css', fieldday_URL . '/assets/css/select2.min.css', false, fieldday_VERSION);
        wp_register_style('km_slider', fieldday_URL . '/assets/css/slick.min.css', false, fieldday_VERSION);
        wp_register_style('km_slider_theme', fieldday_URL . '/assets/css/slick-theme.css', false, fieldday_VERSION);
        wp_register_style('km_daterangepicker_theme', fieldday_URL . '/assets/css/daterangepicker.css', false, fieldday_VERSION);
        wp_register_style('km_multidatespicker_theme', fieldday_URL . '/assets/css/jquery-ui.multidatespicker.css', false, fieldday_VERSION);

        wp_register_style('km_fullcalendar_theme', fieldday_URL . '/assets/css/fullcalendar.min.css', false, fieldday_VERSION);

        $themeCssFile = fieldday_ABSPATH . "/views/theme/{$activetheme}/assets/css/style.css";

        if (file_exists($themeCssFile)) {

            wp_register_style('km_theme_css_custom', fieldday_URL . "/views/theme/{$activetheme}/assets/css/style.css", false, fieldday_VERSION);
        }

        wp_enqueue_style('fieldday_style', fieldday_URL . "/assets/css/fieldday{$this->suffix}.css", array('intl-tel-input', 'km_fontawesome', 'jquery-ui', 'select2css', 'km_slider', 'km_slider_theme', 'km_theme_css_custom', 'km_daterangepicker_theme', 'km_fullcalendar_theme'), fieldday_VERSION);

        wp_localize_script('fieldday_script', 'fieldday_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            "permalink" => get_permalink($post->ID),
            '_wpnonce' => wp_create_nonce('km_nonce_' . $post->ID),
            'isKmUser' => $this->engine->isKmLogin(),
            'fieldday_stripe_token' => $this->engine->getStripeToken(),
            'add_to_cart_btn' => $this->engine->displayText('add_to_cart_btn', false),
            'atc_next_btn' => $this->engine->displayText('atc_next_btn', false),
            'atc_prev_btn' => $this->engine->displayText('atc_prev_btn', false),
            'invalid_form_message' => $this->engine->displayText('invalid_form_message', false),
            'delteConfirm' => $this->engine->displayText('delete_confirm_text', false),
            'map_header_text' => $this->engine->displayText('map_header_text', false),
            'map_footer_button_text' => $this->engine->displayText('map_footer_button_text', false),
            'g_sitekey' => $this->engine->getvalue('fieldday_google_recaptcha_id', $fielddaySetting, false),
            'confirm_pop_text' => $this->engine->displayText('confirm_pop_text', false),
            'global_popup_key' => $fielddaySetting['global_popup_key'],
            'isEnabledLocationPopUpPurchasePage' => $fielddaySetting['fieldday_sticky_location_widget'],
            'fieldday_provider_country_code' => $fielddaySetting['fieldday_provider_country_code'] ?? 'US',
            'fieldday_provider_dial_code' => $fielddaySetting['fieldday_provider_dial_code'] ?? '1',
        )
        );
    }

    public function fielddayAdminScripts()
    {
        // Register and enqueue the JavaScript file with jQuery as a dependency
        wp_register_script('intl-tel-input-admin-js', fieldday_URL . '/assets/js/intlTelInput.js', [], fieldday_VERSION, true);
        wp_enqueue_script('intl-tel-input-admin-js');

        wp_register_style('intl-tel-input-admin-css', fieldday_URL . '/assets/css/intlTelInput.css', [], fieldday_VERSION);
        wp_enqueue_style('intl-tel-input-admin-css');

        // Register and enqueue the CSS file and js file

        wp_register_script('fieldday_pickr_script', fieldday_URL . '/assets/js/pickr.min.js', [], fieldday_VERSION);
        wp_enqueue_script('fieldday_admin_script', fieldday_URL . '/assets/js/fieldday_admin.js', array('jquery', 'fieldday_pickr_script'), fieldday_VERSION);
        wp_enqueue_style('fieldday_admin_style', fieldday_URL . '/assets/css/fielday_admin.css', array('fieldday_pickr_style'), fieldday_VERSION);
        wp_register_style('fieldday_pickr_style', fieldday_URL . '/assets/css/pickr.min.css', array(), fieldday_VERSION);
    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * logout fieldday user on admin url
     */
    private function BlockfielddayDashboard()
    {

        if (is_admin() && current_user_can(fieldday_ROLE) && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
            wp_clear_auth_cookie();
            wp_redirect(admin_url());
            exit;
        }
    }

    public function remove_admin_bar()
    {
        if (!is_admin() && current_user_can(fieldday_ROLE)) {
            show_admin_bar(false);
        }
    }

}
