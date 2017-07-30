<?php
/*
Plugin Name: Functions
Description: Special Functions
Version: 2.0.0
Author: Mika Epstein
*/

/*
 * File Includes
 */

// Plugin Addons
include_once( dirname( __FILE__ ) . '/plugins/cmb2.php' );
include_once( dirname( __FILE__ ) . '/plugins/facetwp.php' );
include_once( dirname( __FILE__ ) . '/plugins/wp-help.php' );

// Local Plugins
include_once( dirname( __FILE__ ) . '/advertising/advertising.php' );
include_once( dirname( __FILE__ ) . '/socialicons/socialicons.php' );
include_once( dirname( __FILE__ ) . '/symbolicons/symbolicons.php' );
include_once( dirname( __FILE__ ) . '/symboliconscolor/symboliconscolor.php' );

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
		wp_enqueue_script( 'cat-signal', '/wp-content/mu-plugins/assets/js/catsignal.js', array(), self::$version, true );
	}

}
new LezPress_Network();

/**
 * class LezPressCom
 * For LezPress.com only
 *
 * @since 2.0
 */
class LezPressCom {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * INIT function.
	 *
	 * @access public
	 * @return void
	 */
	function init() {

		// Filter genesis footer credits
		add_filter( 'genesis_footer_creds_text', function( $creds ) {
		    $creds = 'Copyright [footer_copyright first="2016"] <a href="https://lezpress.com">Lez Press</a> &middot; <a href="https://lezpress.com/terms-of-use/">Terms of Use</a> <br /> Powered by the <a href="http://www.shareasale.com/r.cfm?b=830048&u=728549&m=28169&urllink=&afftrack=">Showcase Pro Theme</a> on the <a href="http://www.shareasale.com/r.cfm?b=346198&u=728549&m=28169&urllink=&afftrack=">Genesis Framework</a>, [footer_wordpress_link], and <a href="//liquidweb.evyy.net/c/294289/297656/4464">Liquidweb Hosting</a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/297656/4464" style="position:absolute;visibility:hidden;" border="0" /> <br /> [footer_loginout]';
		    return $creds;
		}, 10, 2 );
	}
}


global $blog_id;

// Site URL switches:
$site_url = parse_url( get_site_url( $blog_id ) );
switch ( $site_url['host'] ) {
	case 'lezpress.com':
	case 'lezpress.dev':
	case 'lezpress.local':
		new LezPressCom();
		break;
}