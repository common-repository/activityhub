<?php

class fielddayOptions
{

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $pages;
    public $themename;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'fieldday__plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
        remove_action('login_init', 'send_frame_options_header', 10, 0);
        remove_action('admin_init', 'send_frame_options_header', 10, 0);
        //add_filter( 'elementor/template-library/get_template', [ $this, 'fieldday_siblingpopup_template'] );
        add_filter('elementor/template-library/get_template', [$this, 'fieldday_globalpopup_template']);

        $this->pages = get_pages();
    }

    /**
     * Add options page
     */
    public function fieldday__plugin_page()
    {
        add_menu_page(
            'fieldday Options', 'Field Day', 'manage_options', 'fieldday_options', [$this, 'fieldday_options_page'], fieldday_URL . '/assets/img/icon.png'
        );
    }

    /**
     * Options page callback
     */
    public function fieldday_options_page()
    {
        // Set class property
        $this->options = get_option('fieldday_options');
        if (!is_array($this->options)) {
            $this->options = [];
        }
        echo '<div class="wrap">';
        echo wp_sprintf('<h1>%s</h1>', __('fieldday Settings', 'fieldday'));
        echo '<form method="post" action="options.php" class="km_admin_fieldday_settings">';
        // This prints out all hidden setting fields
        settings_fields('fieldday_option_group');
        do_settings_sections('fieldday_options');
        submit_button();
        echo '</form>';
        echo '</div>';
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'fieldday_option_group', // Option group
            'fieldday_options', // Option name
            [$this, 'sanitize']// Sanitize
        );
        add_settings_section(
            'fieldday_general', // ID
            'General Setting', // Title
            [$this, 'general_setting'], // Callback
            'fieldday_options' // Page
        );
        add_settings_field(
            'fieldday_session_filters', __('Session Filters', 'fieldday'), [$this, 'fieldday_session_filters'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_api_authorization', __('Redirect Page after Login', 'fieldday'), [$this, 'fieldday_login_redirect_render'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_myAccount_page', __('Select My Account Page', 'fieldday'), [$this, 'fieldday_myaccount_redirect_render'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_purchase_page', __('Select Purchase Page', 'fieldday'), [$this, 'fieldday_purchase_redirect_render'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_thankyou_page', __('Select Thankyou Page', 'fieldday'), [$this, 'fieldday_thankyou_redirect_render'], 'fieldday_options', 'fieldday_general'
        );
        /*
        add_settings_field(
        'fieldday_provider_page', __('Select Provider Page', 'fieldday'), [$this, 'fieldday_provider_redirect_render'], 'fieldday_options', 'fieldday_general'
        );
         */
        add_settings_field(
            'fieldday_user_menu', __('User Information Menu', 'fieldday'), [$this, 'fieldday_user_menu'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_user_menu_height', __('User Menu Image Height', 'fieldday'), [$this, 'fieldday_user_menu_height'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_user_menu_width', __('User Menu Image Width', 'fieldday'), [$this, 'fieldday_user_menu_width'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_user_menu_font_size', __('User Menu Image Font Size', 'fieldday'), [$this, 'fieldday_user_menu_font_size'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_cart_menu', __('Cart Icon', 'fieldday'), [$this, 'fieldday_cart_menu'], 'fieldday_options', 'fieldday_general'
        );

        /*
        add_settings_field(
        'fieldday_siblingpop_menu', __('Sibling Popup', 'fieldday'), [$this, 'fieldday_siblingpop_menu'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
        'fieldday_siblingpopup_template', __('Global Sibling Template', 'fieldday'), [$this, 'fieldday_siblingpopup_display'], 'fieldday_options', 'fieldday_general'
        ); */
        add_settings_field(
            'fieldday_globalpop_menu', __('Popup', 'fieldday'), [$this, 'fieldday_globalpop_menu'], 'fieldday_options', 'fieldday_general'
        );
        global $fielddaySetting;
        $isPopupEnable = fieldday()->engine->getValue('fieldday_global_popup', $fielddaySetting, false);
        if ($isPopupEnable == 'enabled') {
            add_settings_field(
                'fieldday_globalpopup_template', __('Popup Template', 'fieldday'), [$this, 'fieldday_globalpopup_display'], 'fieldday_options', 'fieldday_general'
            );

            add_settings_field(
                'fieldday_globalpopup_page', __('Page', 'fieldday'), [$this, 'fieldday_globalpopup_page'], 'fieldday_options', 'fieldday_general'
            );
        }
        add_settings_field(
            'global_popup_key', __('Global Popup Key', 'fieldday'), [$this, 'fieldday_global_popup_key'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_debug_mode', __('Debug Mode', 'fieldday'), [$this, 'fieldday_debug_mode'], 'fieldday_options', 'fieldday_general'
        );
        /* add_settings_field(
        'fieldday_purchase_layout_mode', __('Purchase Session Layout', 'fieldday'), [$this, 'fieldday_purchase_layout_mode'], 'fieldday_options', 'fieldday_general'
        ); */
        add_settings_field(
            'fieldday_facebook_redirect', __('Facebook Redirect Url', 'fieldday'), [$this, 'fieldday_facebook_redirect'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_google_redirect', __('Google Login Url', 'fieldday'), [$this, 'fieldday_google_redirect'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_section(
            'fieldday_api_detail', // ID
            'fieldday Api Detail', // Title
            [$this, 'print_api_info'], // Callback
            'fieldday_options' // Page
        );

        add_settings_field(
            'fieldday_api_authorization', __('Authorization Key', 'fieldday'), [$this, 'fieldday_api_authorization_render'], 'fieldday_options', 'fieldday_api_detail'
        );

        add_settings_field(
            'fieldday_provider_id', __('Provider ID', 'fieldday'), [$this, 'fieldday_provider_id_render'], 'fieldday_options', 'fieldday_api_detail'
        );

        add_settings_field(
            'fieldday_api_url', __('API URL', 'fieldday'), [$this, 'fieldday_api_url_render'], 'fieldday_options', 'fieldday_api_detail'
        );

        add_settings_section(
            'fieldday_recaptcha_detail', // ID
            'reCaptcha Settings', // Title
            [$this, 'print_recaptcha_info'], // Callback
            'fieldday_options' // Page
        );

        add_settings_field(
            'fieldday_google_recaptcha_id', __('reCaptcha Site Key', 'fieldday'), [$this, 'fieldday_google_recaptcha_id_render'], 'fieldday_options', 'fieldday_recaptcha_detail'
        );

        add_settings_field(
            'fieldday_google_recaptcha_secret', __('reCaptcha Secret', 'fieldday'), [$this, 'fieldday_google_recaptcha_secret_render'], 'fieldday_options', 'fieldday_recaptcha_detail'
        );

        add_settings_section(
            'fieldday_payment_mode', // ID
            'Payment Mode', // Title
            [$this, 'print_payment_mode'], // Callback
            'fieldday_options' // Page
        );
        add_settings_field(
            'fieldday_payment_mode_select', __('Select Payment Mode', 'fieldday'), [$this, 'fieldday_payment_mode_select_render'], 'fieldday_options', 'fieldday_payment_mode'
        );

        add_settings_section(
            'fieldday_head_foot_scripts', // ID
            'Header & Footer Script', // Title
            function () {
                return __('Header & Footer Script', 'fieldday');
            }, // Callback
            'fieldday_options' // Page
        );

        add_settings_field(
            'fieldday_head_script_input', __('Header Script', 'fieldday'), [$this, 'fieldday_header_script'], 'fieldday_options', 'fieldday_head_foot_scripts'
        );
        add_settings_field(
            'fieldday_foot_script_input', __('Footer Script', 'fieldday'), [$this, 'fieldday_footer_script'], 'fieldday_options', 'fieldday_head_foot_scripts'
        );

        add_settings_field(
            'fieldday_theme_mode', __('Theme', 'fieldday'),
            [$this, 'fieldday_theme_mode'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_filters_mode', __('Filters', 'fieldday'),
            [$this, 'fieldday_filters_mode'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_calendar_view', __('Calendar View', 'fieldday'),
            [$this, 'fieldday_calendar_view'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'default_settings_country', __('Select Country', 'fieldday'),
            [$this, 'default_settings_country'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_colors', __('Theme Colors', 'fieldday'), [$this, 'fieldday_colors'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_highlightcolor', __('Highlight Color', 'fieldday'), [$this, 'fieldday_highlightcolor'], 'fieldday_options', 'fieldday_general'
        );
        add_settings_field(
            'fieldday_textcolor', __('Text Color Primary Background', 'fieldday'), [$this, 'fieldday_textcolor'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_textcolor2', __('Text Color Secondary Background', 'fieldday'), [$this, 'fieldday_textcolor2'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_sticky_icon_textcolor', __('Sticky Widget Icon  Color', 'fieldday'), [$this, 'fieldday_sticky_icon_textcolor'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_sticky_icon_bg_color', __('Sticky Widget Icon  Background Color', 'fieldday'), [$this, 'fieldday_sticky_icon_bg_color'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_bullets', __('Bullets', 'fieldday'), [$this, 'fieldday_bullets'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_googlemapapi_mode', __('Google Map Api Key', 'fieldday'),
            [$this, 'fieldday_googlemapapi_mode'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_sticky_widget', __('Enable Sticky Widget', 'fieldday'),
            [$this, 'fieldday_sticky_widget'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_sticky_location_widget', __('Enable Sticky Locaction Widget on Purchase Page', 'fieldday'),
            [$this, 'fieldday_sticky_location_widget'], 'fieldday_options', 'fieldday_general'
        );

        add_settings_field(
            'fieldday_sticky_option', __('Select Option', 'fieldday'),
            [$this, 'fieldday_sticky_option'], 'fieldday_options', 'fieldday_general'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        if (array_key_exists('fieldday_debug_mode', $input) && $input['fieldday_debug_mode'] == 'enabled') {
            $blogname = get_bloginfo('name');
            $blogurl = get_bloginfo('url');
            $message = 'Hey There,';
            $message .= '<p>';
            $message .= wp_sprintf('you have turned on the debug mode of fieldday at <a href="%s">%s</a>. Do not forget to turn it off to minimize the disc usage.', $blogname, $blogurl);
            $message .= '</p>';
            //deprecated since php 7.2
            //add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
            add_filter('wp_mail_content_type', function () {return 'text/html';});
            $adminEmail = get_bloginfo('admin_email');
            wp_mail($adminEmail, 'Important Alert.', $message);
        }
        return $input;
    }

    /**
     * Print the fieldday api information
     */
    public function general_setting()
    {
        print sprintf('');
    }

    /**
     * Print the fieldday api information
     */
    public function print_api_info()
    {
        print sprintf(__('Enter your Field Day API key details below. You can get it from %s', 'fieldday'), '<a target="_blank" href="https://vendor.fieldday.com/"> Here</a>');
    }

    /**
     * Print the fieldday Payment mode
     */
    public function print_payment_mode()
    {
        print sprintf(__('Select payment mode. live OR Sandbox.', 'fieldday'));
    }

    /**
     * Print recaptcha information
     */
    public function print_recaptcha_info()
    {
        print sprintf(__('Enter google reCaptcha details below. You can get it from %s', 'fieldday'), '<a target="_blank" href="https://www.google.com/recaptcha/admin"> Here</a>');
    }

    /**
     * display value from array
     * @param String $key
     * @param bolean $return
     *
     * @return String value from options
     */
    private function displayValue($key, $return = false)
    {
        if (array_key_exists($key, $this->options)) {
            if ($return) {
                return $this->options[$key];
            }
            print $this->options[$key];
        }
    }

    /**
     * display dropdown of menus to display logged in user info in menu
     */
    public function fieldday_user_menu()
    {
        $menus = wp_get_nav_menus(array('orderby' => 'name'));
        echo '<select style="width:50%; min-width:300px;" name="fieldday_options[user_menu]">';
        echo '<option value="">-select menu-</option>';
        if ($menus) {

            foreach ($menus as $menu) {
                $selected = $this->displayValue('user_menu', true) == $menu->term_id ? 'selected' : '';
                echo wp_sprintf('<option %s value="%s">%s</option>', $selected, $menu->term_id, $menu->name);
            }
        }
        echo '</select>';
    }

    public function fieldday_user_menu_height()
    {

        ?>
        <input type="number" min="1"   placeholder="60"  required   max="200" name="fieldday_options[fieldday_user_menu_height]" value="<?php echo $this->displayValue('fieldday_user_menu_height'); ?>">
        <?php

    }

    public function fieldday_user_menu_width()
    {
        ?>
        <input type="number" min="1"  placeholder="60"  required   max="200" name="fieldday_options[fieldday_user_menu_width]" value="<?php echo $this->displayValue('fieldday_user_menu_width'); ?>">
        <?php

    }

    public function fieldday_user_menu_font_size()
    {
        ?>
        <input type="number" placeholder="14" required  min="1" max="200" name="fieldday_options[fieldday_user_menu_font_size]" value="<?php echo $this->displayValue('fieldday_user_menu_font_size'); ?>">
        <?php

    }

    /**
     * display dropdown of menus to display cart in menu
     */
    /*
    public function fieldday_cart_menu()
    {
    //$menus = wp_get_nav_menus(array('orderby' => 'name'));
    ?>
    <select style="width:50%; min-width:300px;" name="fieldday_options[cart_menu]">
    <option value="">-Select Option-</option>
    <option value='defaultview' <?php echo $this->displayValue('cart_menu', true) == 'defaultview' ? 'selected' : ''; ?>>Default View</option>
    <option value='mainmenu' <?php echo $this->displayValue('cart_menu', true) == 'mainmenu' ? 'selected' : ''; ?>>Main Menu</option>
    </select>
    <?php
    }
     */
    public function fieldday_cart_menu()
    {
        $menus = wp_get_nav_menus(array('orderby' => 'name'));
        ?>
      <select style="width:50%; min-width:300px;" name="fieldday_options[cart_menu]">
      <option value='defaultview' <?php echo $this->displayValue('cart_menu', true) == 'defaultview' ? 'selected' : ''; ?>>Default View</option>
      <!--<option value='mainmenu' <?php //echo $this->displayValue('cart_menu', true) == 'mainmenu' ? 'selected' : ''; ?>>Main Menu</option>-->
        <?php
if ($menus) {
            foreach ($menus as $menu) {
                $selected = $this->displayValue('cart_menu', true) == $menu->term_id ? 'selected' : '';
                echo wp_sprintf('<option %s value="%s">%s</option>', $selected, $menu->term_id, $menu->name);
            }
        }

        echo '</select>';
    }

    /**
     * enable/disable sibling popup

    public function fieldday_siblingpop_menu() {
    ?>
    <select style="width:50%; min-width:300px;" name="fieldday_options[fieldday_sibling_popup]">
    <option <?php echo $this->displayValue('fieldday_sibling_popup', true) == 'enabled' ? 'selected' : ''; ?> value="enabled">Enable</option>
    <option <?php echo $this->displayValue('fieldday_sibling_popup', true) == 'disabled' ? 'selected' : ''; ?> value="disabled">Disable</option>
    </select>
    <?php
    }

     * Get Elementor saved template list
     * Select Sibling popup template elementor

    public function fieldday_siblingpopup_display(){
    if($_REQUEST['page'] == 'fieldday_options'){
    echo"<select name='fieldday_options[fieldday_siblingpopup_template]'>";
    \Elementor\Plugin::instance()->templates_manager->get_templates();
    echo"</select'>";
    }

    }
    public function fieldday_siblingpopup_template($template) {

    if(!empty($template)){
    ?>
    <option id="<?=$template['template_id'];?>"
    <?php echo ($template['template_id'] == $this->displayValue('fieldday_siblingpopup_template', true)) ? "selected" : ''; ?>
    value="<?= $template['template_id'];?>">
    <label for="<?=$template['template_id'];?>"><?= ucfirst($template['title']);?></label></option>
    <?php
    }
    }
     */

    /**
     * enable/disable global popup
     */
    public function fieldday_globalpop_menu()
    {
        ?>
        <select class="globalpopupselect" style="width:50%; min-width:300px;" name="fieldday_options[fieldday_global_popup]">
            <option <?php echo $this->displayValue('fieldday_global_popup', true) == 'enabled' ? 'selected' : ''; ?> value="enabled">Enable</option>
            <option <?php echo $this->displayValue('fieldday_global_popup', true) == 'disabled' ? 'selected' : ''; ?> value="disabled">Disable</option>
        </select>
        <?php
}

    /**
     * Get Elementor saved template list
     * Select Global popup template elementor
     */
    public function fieldday_globalpopup_display()
    {
        echo "<select name='fieldday_options[fieldday_globalpopup_template]'>";
        \Elementor\Plugin::instance()->templates_manager->get_templates();
        echo "</select'>";
    }

    public function fieldday_globalpopup_template($template)
    {
        if (!empty($template) && $_REQUEST['page'] == 'fieldday_options') {
            ?>
            <option id="<<?php echo $template['template_id']; ?>"
            <?php echo ($template['template_id'] == $this->displayValue('fieldday_globalpopup_template', true)) ? "selected" : ''; ?>
                    value="<?php echo $template['template_id']; ?>">
            <label for="<?php echo $template['template_id']; ?>"><?php echo ucfirst($template['title']); ?></label></option>
            <?php
}
    }

    public function fieldday_globalpopup_page()
    {
        $pages = get_pages();
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[fieldday_globalpopup_page]">
            <option value="all">All</option>

        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('fieldday_globalpopup_page', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo ucfirst($page->post_title); ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    /**
     * Global Popup key
     */
    public function fieldday_global_popup_key()
    {
        ?>
        <input placeholder="add some random char for cookie name" type='text' style="width:50%; min-width:300px;" name='fieldday_options[global_popup_key]' value='<?php $this->displayValue('global_popup_key');?>'>
        <?php
}

    /**
     * Enable/disable plugin debug mode
     */
    public function fieldday_debug_mode()
    {
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[fieldday_debug_mode]">
            <option <?php echo $this->displayValue('fieldday_debug_mode', true) == 'disabled' ? 'selected' : ''; ?> value="disabled">Disable</option>
            <option <?php echo $this->displayValue('fieldday_debug_mode', true) == 'enabled' ? 'selected' : ''; ?> value="enabled">Enable</option>
        </select>
        <?php
}

    /**
     * Column layout purchase session
     */
    /*
    public function fieldday_purchase_layout_mode() {

    ?>
    <select style="width:50%; min-width:300px;" name="fieldday_options[fieldday_purchase_layout_mode]">
    <option <?php echo $this->displayValue('fieldday_purchase_layout_mode', true) == 'one' ? 'selected' : ''; ?> value="one">One Cloumn</option>
    <option <?php echo $this->displayValue('fieldday_purchase_layout_mode', true) == 'two' ? 'selected' : ''; ?> value="two">Two Cloumn</option>
    </select>
    <?php
    }
     */

    /**
     * filters options
     */
    public function fieldday_session_filters()
    {
        $session_filters = $this->displayValue('session_filters', true);
        if (!$session_filters) {
            $session_filters = [];
        }
        ?>
        <select style="width:50%; min-width:300px;" multiple="true" name="fieldday_options[session_filters][]">
            <?php foreach (fieldday()->engine->fielddayFilters() as $key => $filter): ?>
                <option <?php echo in_array($key, $session_filters) ? 'selected' : ''; ?> value="<?php echo $key; ?>"><?php echo $filter; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    /**
     * Primary & Secondary Color Options
     */
    public function fieldday_colors()
    {?>
      <label for="km_fieldday_primary_color"><?php _e("Primary Color", 'fieldday');?></label>
      <input id="km_fieldday_primary_color" class="km_color_picker" type='text' style="" name='fieldday_options[primary_color]' value='<?php $this->displayValue('primary_color');?>'><br>

      <label for="km_fieldday_secondary_color"><?php _e("Secondary Color", 'fieldday');?></label>
      <input id="km_fieldday_secondary_color" class="km_color_picker" type='text' style="" name='fieldday_options[secondary_color]' value='<?php $this->displayValue('secondary_color');?>'>
      <?php
}

    public function fieldday_highlightcolor()
    {?>
      <!-- <label for="km_fieldday_highlightcolor"><?php //_e("Highlight Color", 'fieldday'); ?></label> -->
      <input id="km_fieldday_highlightcolor" class="km_color_picker" type='text' style="" name='fieldday_options[highlightcolor]' value='<?php $this->displayValue('highlightcolor');?>'>
      <span>(Color used to Highlight the main/important text on website)</span>
      <?php
}

    public function fieldday_textcolor()
    {?>
      <input id="km_fieldday_text_color" class="km_color_picker" type='text' style="" name='fieldday_options[textcolor]' value='<?php $this->displayValue('textcolor');?>'>
      <span>(Primary text Color)</span>
      <?php
}

    public function fieldday_textcolor2()
    {?>
      <input id="km_fieldday_text_color2" class="km_color_picker" type='text' style="" name='fieldday_options[textcolor2]' value='<?php $this->displayValue('textcolor2');?>'>
      <span>(Secondary text Color)</span>
      <?php
}

    public function fieldday_sticky_icon_textcolor()
    {
        global $fielddaySetting;
        $fieldday_sticky_icon_textcolor = $fielddaySetting['fieldday_sticky_icon_textcolor'];
        if (!$fieldday_sticky_icon_textcolor || $fieldday_sticky_icon_textcolor == '') {
            $fieldday_sticky_icon_textcolor = '#ffffff';
        }

        ?>
      <input id="fieldday_sticky_icon_textcolor"  class="km_color_picker"   type='text' name='fieldday_options[fieldday_sticky_icon_textcolor]' value='<?php echo $fieldday_sticky_icon_textcolor; ?>'>
      <?php
}

    public function fieldday_sticky_icon_bg_color()
    {
        global $fielddaySetting;
        $fieldday_sticky_icon_bg_color = $fielddaySetting['fieldday_sticky_icon_bg_color'];
        $kmPrimaryColor_Value = $fielddaySetting['primary_color'];
        if (!$fieldday_sticky_icon_bg_color || $fieldday_sticky_icon_bg_color == '') {
            if ($kmPrimaryColor_Value && $kmPrimaryColor_Value != '') {
                $fieldday_sticky_icon_bg_color = $kmPrimaryColor_Value;
            } else {
                $fieldday_sticky_icon_bg_color = '#000000';
            }
        }
        ?>
      <input id="fieldday_sticky_icon_bg_color"  class="km_color_picker"   type='text'   name='fieldday_options[fieldday_sticky_icon_bg_color]' value='<?php echo $fieldday_sticky_icon_bg_color; ?>'>
      <?php
}

    /**
     * Bullets selection for multiple options
     */
    public function fieldday_bullets()
    {
        $selected_bullet = $this->displayValue('fieldday_bullets', true);
        ?>
        <input type="radio" id="km_fieldday_asterisk" <?php echo ($selected_bullet == '\2731') ? 'checked' : 'not' ?> name="fieldday_options[fieldday_bullets]" value="\2731"><label for="km_fieldday_asterisk">&#10033;</label>
        <input type="radio" id="km_fieldday_arrow" <?php echo ($selected_bullet == '\27A3') ? 'checked' : 'not' ?> name="fieldday_options[fieldday_bullets]" value="\27A3"><label for="km_fieldday_arrow">&#10147;</label>
        <input type="radio" id="km_fieldday_dash" <?php echo ($selected_bullet == '\2013') ? 'checked' : 'not' ?> name="fieldday_options[fieldday_bullets]" value="\2013"><label for="km_fieldday_dash">&ndash;</label>
        <input type="radio" id="km_fieldday_dot" <?php echo ($selected_bullet == '\2022') ? 'checked' : 'not' ?> name="fieldday_options[fieldday_bullets]" value="\2022"><label for="km_fieldday_dot">&bull;</label>

    <?php }

    /**
     * Html option for login redirect page
     */
    public function fieldday_login_redirect_render()
    {
        $pages = get_pages();
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[login_redirect]">
        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('login_redirect', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    /**
     * Html option for My account redirect page
     */
    public function fieldday_myaccount_redirect_render()
    {
        $pages = get_pages();
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[myaccount_redirect]">
        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('myaccount_redirect', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    public function fieldday_purchase_redirect_render()
    {
        $pages = $this->pages;
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[purchase_page]">
        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('purchase_page', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    public function fieldday_thankyou_redirect_render()
    {
        $pages = $this->pages;
        ?>
        <p>Must add [filedday_thankyou_page] shortcode on the page, if you want to show order details on Thankyou page. After the successfull order is placed users are redirected to thankyou page.Leave it empty if you wish to skip redirection.</p>
        <select style="width:50%; min-width:300px;margin-top:5px;" name="fieldday_options[thankyou_page]">
            <option value="">Select Page</option>
        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('thankyou_page', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    public function fieldday_provider_redirect_render()
    {
        $pages = $this->pages;
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[provider_page]">
        <?php foreach ($pages as $key => $page): ?>
                <option <?php echo $this->displayValue('provider_page', true) == $page->ID ? 'selected' : ''; ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
        <?php endforeach;?>
        </select>
        <?php
}

    /**
     * Html option for Payment mode selection
     */
    public function fieldday_payment_mode_select_render()
    {
        ?>
        <select style="width:50%; min-width:300px;" name="fieldday_options[fieldday_payment_mode]">
            <option <?php echo $this->displayValue('fieldday_payment_mode', true) == 'no' ? 'selected' : ''; ?> value="no">Sand Box</option>
            <option <?php echo $this->displayValue('fieldday_payment_mode', true) == 'yes' ? 'selected' : ''; ?> value="yes">Live</option>
        </select>
        <?php
}

    /**
     * google redirect url
     */
    public function fieldday_google_redirect()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_google_redirect]' value='<?php $this->displayValue('fieldday_google_redirect');?>'>
        <?php
}

    /**
     * fscebook login redirect
     */
    public function fieldday_facebook_redirect()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_facebook_redirect]' value='<?php $this->displayValue('fieldday_facebook_redirect');?>'>
        <?php
}

    /**
     * input option for API auth key
     */
    public function fieldday_api_authorization_render()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_api_auth_key]' value='<?php $this->displayValue('fieldday_api_auth_key');?>'>
        <?php
}

    /**
     * input field for fieldday provider ID
     */
    public function fieldday_provider_id_render()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_api_provider]' value='<?php echo $this->displayValue('fieldday_api_provider'); ?>'>
        <?php
}

    /**
     * fieldday API Url
     */
    public function fieldday_api_url_render()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_api_endpoint]' value='<?php echo $this->displayValue('fieldday_api_endpoint'); ?>'>
        <?php
}

    /**
     * google recaptcha ID
     */
    public function fieldday_google_recaptcha_id_render()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_google_recaptcha_id]' value='<?php echo $this->displayValue('fieldday_google_recaptcha_id'); ?>'>
               <?php
}

    /**
     * google recaptcha secret
     */
    public function fieldday_google_recaptcha_secret_render()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_google_recaptcha_secret]' value='<?php echo $this->displayValue('fieldday_google_recaptcha_secret'); ?>'>
        <?php
}

    /**
     * script for header
     */
    public function fieldday_header_script()
    {
        ?>
        <textarea name='fieldday_options[fieldday_header_Script]' rows="5" cols="100"><?php echo $this->displayValue('fieldday_header_Script'); ?></textarea>
        <?php
}

    /**
     * script for footer
     */
    public function fieldday_footer_script()
    {
        ?>
        <textarea name='fieldday_options[fieldday_footer_Script]' rows="5" cols="100"><?php echo $this->displayValue('fieldday_footer_Script'); ?></textarea>
        <?php
}

    /**
     * Select theme
     */
    public function fieldday_theme_mode()
    {

        $dir = WP_PLUGIN_DIR . "/activityhub/views/theme/";
        $defualtoption = '';
        if (empty($this->displayValue('fieldday_theme_mode', true))) {

            $defualtoption = 'list_view';
        } else {
            $defualtoption = $this->displayValue('fieldday_theme_mode', true);
        }
        $themelist = scandir($dir);
        foreach ($themelist as $themename) {

            if ($themename != '.' && $themename != '..') {

                $themedisplayname = preg_replace('/[^A-Za-z0-9\-]/', " ", ucfirst($themename));
                ?>
                <input type="radio" id="<?=$themename;?>" name="fieldday_options[fieldday_theme_mode]"
                <?php echo ($themename == $defualtoption) ? "checked" : ""; ?>

                       value="<?=$themename;?>"><label for="<?=$themename;?>"><?=$themedisplayname;?></label><br>
                <?php
}
        }
    }

    /*Select Filters*/
    public function fieldday_filters_mode()
    {?>
      <select name="fieldday_options[fieldday_filters_mode]">
        <option value=''>Select</option>
        <option value='top' <?php echo $this->displayValue('fieldday_filters_mode', true) == 'top' ? 'selected' : ''; ?>>Top of Listings</option>
        <option value='slide' <?php echo $this->displayValue('fieldday_filters_mode', true) == 'slide' ? 'selected' : ''; ?>>Slide to Left</option>
      </select>
      <?php
}

    public function fieldday_calendar_view()
    {?>
        <select name="fieldday_options[fieldday_calendar_view]">
            <option value='default' <?php echo $this->displayValue('fieldday_calendar_view', true) == 'default' ? 'selected' : ''; ?>>Default</option>
            <option value='detailed' <?php echo $this->displayValue('fieldday_calendar_view', true) == 'detailed' ? 'selected' : ''; ?>>Detailed Session View</option>
        </select>
    <?php }

    public function default_settings_country()
    {
        $km_default_settings_country = $this->displayValue('fieldday_provider_country_code', true) ?? 'US';
        $km_default_settings_country_dialCode = $this->displayValue('fieldday_provider_dial_code', true) ?? '1';
        ?>
                <div class="km_field_wrap km_phone_input">
                        <input type="hidden" name="fieldday_options[fieldday_provider_country_code]" class="country_code user_country_code" value="<?php echo $km_default_settings_country; ?>">
                        <input type="hidden" name="fieldday_options[fieldday_provider_dial_code]" class="user_dial_code" value="<?php echo $km_default_settings_country_dialCode; ?>">
                        <input  id="km_admin_user_phone"  />
                </div>
    <?php }

    public function fieldday_googlemapapi_mode()
    {
        ?>
        <input type='text' style="width:50%; min-width:300px;" name='fieldday_options[fieldday_googlemapapi_mode]' value='<?php echo $this->displayValue('fieldday_googlemapapi_mode'); ?>'>
        <?php
}

    public function fieldday_sticky_widget()
    {?>
      <input type="checkbox" value="enable" <?php echo $this->displayValue('fieldday_sticky_widget', true) == 'enable' ? 'checked' : ''; ?> name='fieldday_options[fieldday_sticky_widget]'>
    <?php
}

    public function fieldday_sticky_location_widget()
    {?>
        <input type="checkbox" value="enable" <?php echo $this->displayValue('fieldday_sticky_location_widget', true) == 'enable' ? 'checked' : ''; ?> name='fieldday_options[fieldday_sticky_location_widget]'>
      <?php
}

    public function fieldday_sticky_option()
    {?>
      <select name="fieldday_options[fieldday_sticky_option]">
        <option value=''>Select</option>
        <option value='contactform' <?php echo $this->displayValue('fieldday_sticky_option', true) == 'contactform' ? 'selected' : ''; ?>>Contact Us</option>
        <option disabled="disabled" value='subscription'>Subscription (Not implemented yet)</option>
      </select>
      <span>(Selects what shows in sticky Widget)</span>
      <?php
}

}

return new fielddayOptions();
