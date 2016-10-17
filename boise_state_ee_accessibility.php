<?php
/*
Plugin Name: Boise State EE Accessibility Plugin
Description: Plugin for programmatically fixing minor accessibility issues caused by the Event Espresso plugin.
Version: 0.1.0
Author: David Lentz
*/

defined( 'ABSPATH' ) or die( 'No hackers' );

if( ! class_exists( 'Boise_State_EE_Plugin_Updater' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Boise_State_Plugin_Updater( __FILE__ );
$updater->set_username( 'OITWPsupport' );
$updater->set_repository( 'boise-state-ee-accessibility-plugin' );
$updater->initialize();


function boise_state_ee_accessibility($content) {


}

// The 3rd parameter here sets the priority. It's optional and defaults to 10.
// By setting this higher, these string replacements happen *after* other plugins (like Tablepress) have done their thang.
add_filter('the_content', 'bsu_accessibility', 400);
add_filter('the_excerpt', 'bsu_accessibility', 400);
