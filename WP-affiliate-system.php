<?php
/**
 * WP Affiliate System
 *
 * @package   WP-affiliate-system
 * @author    Bradford Knowlton
 * @license   GPL-2.0+
 * @link      https://github.com/bradmkjr/WP-affiliate-system
 */

/*
Plugin Name:       WP Affiliate System
Plugin URI:        https://github.com/bradmkjr/WP-affiliate-system
Description:       Top Secret
Version:           4.0.1
Author:            Bradford Knowlton
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       wp-affiliate-system
GitHub Plugin URI: https://github.com/bradmkjr/WP-affiliate-system
GitHub Branch:     master
Requires WP:       4.8.1
*/

/* == NOTICE ===================================================================
* Please do not alter this file. Instead: make a copy of the entire plugin,
* rename it, and work inside the copy. If you modify this plugin directly and
* an update is released, your changes will be lost!
* ========================================================================== */

defined('ABSPATH') or die("No script kiddies please!");

function wpas_init() {
 load_plugin_textdomain('wp-affiliate-system', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'wpas_init');

if(!class_exists('WPASSettingsPage')){
	include( plugin_dir_path( __FILE__ ) . 'includes/settings.inc.php');
}

if(!class_exists('WPASShortcodes')){
	require_once plugin_dir_path( __FILE__ ) . 'includes/shortcodes.inc.php';
}

if(!class_exists('WPASPost')){
	require_once plugin_dir_path( __FILE__ ) . 'includes/posts.inc.php';
}

if(!class_exists('WPASAmazon')){
	require_once plugin_dir_path( __FILE__ ) . 'plugins/amazon.inc.php';
}

if(!class_exists('WPASImgur')){
	require_once plugin_dir_path( __FILE__ ) . 'plugins/imgur.inc.php';
}

