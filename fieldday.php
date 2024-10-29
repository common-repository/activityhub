<?php

/**
 * Plugin Name: Field Day
 * Plugin URI: https://activityhub.com
 * Description: A wordpress plugin for Field Day API
 * Version: 3.4.0
 * Author: Field Day
 * Author URI: https://profiles.wordpress.org/fieldday/
 * Text Domain: Field Day
 * Domain Path: /i18n/languages/
 *
 * @package Field Day
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define fieldday_PLUGIN_FILE.
if (!defined('fieldday_PLUGIN_FILE')) {
    define('fieldday_PLUGIN_FILE', __FILE__);
}

// Include the main fieldday class.
if (!class_exists('fieldday')) {
    include_once dirname(__FILE__) . '/inc/Classfieldday.php';
}

/**
 * Main instance of fieldday.
 *
 * Returns the main instance of fieldday.
 *
 * @since  1.0.0
 * @return fieldday
 */

function fieldday()
{
    return fieldday::instance();
}

// Global for backwards compatibility.
$GLOBALS['fieldday'] = fieldday();
