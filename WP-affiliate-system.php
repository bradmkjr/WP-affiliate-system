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
Version:           3.1.0
Author:            Bradford Knowlton
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       github-updater
GitHub Plugin URI: https://github.com/bradmkjr/WP-affiliate-system
GitHub Branch:     master
Requires WP:       4.0.1
*/

/* == NOTICE ===================================================================
* Please do not alter this file. Instead: make a copy of the entire plugin,
* rename it, and work inside the copy. If you modify this plugin directly and
* an update is released, your changes will be lost!
* ========================================================================== */

defined('ABSPATH') or die("No script kiddies please!");

if(!class_exists('WPASSettingsPage')){
	include( plugin_dir_path( __FILE__ ) . 'includes/settings.inc.php');
}

if(!class_exists('WPASShortcodes')){
	require_once plugin_dir_path( __FILE__ ) . 'includes/shortcodes.inc.php';
}

