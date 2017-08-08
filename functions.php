<?php
/*
Library: Functions
Description: Special Functions
Version: 2.0.0
Author: Mika Epstein
*/

/*
 * File Includes
 */
include_once( dirname( __FILE__ ) . '/dashboard.php' );
include_once( dirname( __FILE__ ) . '/shortcodes.php' );
include_once( dirname( __FILE__ ) . '/upgrades.php' );

// Local Plugins
include_once( dirname( __FILE__ ) . '/advertising/advertising.php' );
include_once( dirname( __FILE__ ) . '/socialicons/socialicons.php' );

// Symbolicons
include_once( dirname( __FILE__ ) . '/assets/symbolicons.php' );
include_once( dirname( __FILE__ ) . '/assets/symboliconscolor.php' );

/**
 * LezPress_Network class.
 * Functions used by all sites on the network
 */
class LezPress_Network {

	protected static $version;

	function __construct() {
		self::$version = '2.0.0';
		add_action( 'wp_enqueue_scripts', array( $this,  'wp_enqueue_scripts' ) );
	}

	/**
	 * Enqueue Scripts
	 */
	function wp_enqueue_scripts() {
		// Cat Signal
		wp_enqueue_script( 'cat-signal', content_url() . '/library/assets/js/catsignal.js', array(), self::$version, true );
	}

}
new LezPress_Network();