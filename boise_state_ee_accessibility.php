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

// From https://eventespresso.com/topic/how-do-i-stop-extra-ee-code-being-added-to-all-pages/
add_action('template_redirect', 'ee_remove_cart_markup');
function ee_remove_cart_markup(){
	if( is_page( array( 996, 14  ) ) ) {
		remove_action( 'loop_start', array( 'EED_Single_Page_Checkout', 'set_checkout_anchor' ), 1 );
	}
}

function boise_state_ee_accessibility($content) {
	$tables = $dom->getElementsByTagName('table');
	foreach($tables as $table) {
		if ($table->getAttribute('class') == 'fc-border-separate') {
			// Remove the style attribute from the table tag to get rid of any
			// presentational attributes.
			$field->setAttribute('style', '');
			// TODO?: need to add "width:100%" (which we just removed from the table tag)
			// on to the class 'fc-border-separate'
		}
	}

	$tablerows = $dom->getElementsByTagName('tr');
	foreach($tablerows as $tablerow) {
		if ($tablerow->getAttribute('class') == 'fc-day-header') {	

			// TODO: actually, this'll be only one of several class designations on this 
			// tag, so we shouldn't do a literal string compare.
			
			$tablerow->setAttribute('style', '');

			// TODO: need to add "width: 92px;" (which we just removed from the TR tag)
			// on to the class 'fc-day-header'

		}
	}
}

// The 3rd parameter here sets the priority. It's optional and defaults to 10.
// By setting this higher, these string replacements happen *after* other plugins (like Tablepress) have done their thang.
add_filter('the_content', 'boise_state_ee_accessibility', 400);
add_filter('the_excerpt', 'boise_state_ee_accessibility', 400);
