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
		add_action( 'wp_before_admin_bar_render', array( $this, 'rainbow_bar' ) );
	}

	/**
	 * Enqueue Scripts
	 */
	function wp_enqueue_scripts() {
		// Cat Signal
		// wp_enqueue_script( 'cat-signal', content_url() . '/library/assets/js/catsignal.js', array(), self::$version, true );
	}

	/**
	 * GAY
	 */
	function rainbow_bar() {
	?>
		<style type="text/css">
			#wpadminbar {
				background: linear-gradient(
					to bottom,
					#e24c3e 0%,
					#e24c3e 16.66667%,
					#f47d3b 16.66667%,
					#f47d3b 33.33333%,
					#fdb813 33.33333%,
					#fdb813 50%,
					#74bb5d 50%,
					#74bb5d 66.66667%,
					#38a6d7 66.66667%,
					#38a6d7 83.33333%,
					#8c7ab8 83.33333%,
					#8c7ab8 100% );
			}
			#wpadminbar,
			#wpadminbar .quicklinks > ul > li {
				-webkit-box-shadow: unset;
				-moz-box-shadow: unset;
				box-shadow: unset;
			}
			#wpadminbar .ab-top-menu > li > a {
				/* background-color: rgba( 50, 55, 60, .85 ); */
			}
			
			#wpadminbar .ab-item, #wpadminbar a.ab-item, #wpadminbar > #wp-toolbar span.ab-label, #wpadminbar > #wp-toolbar span.noticon,
			#wpadminbar .ab-icon, #wpadminbar .ab-icon:before, #wpadminbar .ab-item:before, #wpadminbar .ab-item:after {
				color: #000;
			}
		</style>
	<?php
	}

}
new LezPress_Network();