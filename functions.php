<?php
/*
Library: Functions
Description: Special Functions
Version: 2.1.4
Author: Mika Epstein
*/

/*
 * File Includes
 */
include_once( dirname( __FILE__ ) . '/dashboard.php' );
include_once( dirname( __FILE__ ) . '/gutenberg.php' );
include_once( dirname( __FILE__ ) . '/shortcodes.php' );
include_once( dirname( __FILE__ ) . '/upgrades.php' );

// Local Plugins
include_once( dirname( __FILE__ ) . '/advertising/advertising.php' );

// WordPress Plugins
require_once( 'plugins/jetpack.php' );

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
		self::$version = '2.1.4';

		// Close comments on media
		add_filter( 'comments_open', array( $this, 'filter_media_comment_status' ), 10 , 2 );

		// Enqueue scripts
		add_action( 'admin_enqueue_scripts',  array( $this, 'admin_enqueue_scripts' ) );

		// When in Dev Mode...
		if ( defined( 'LWTV_DEV_SITE' ) && LWTV_DEV_SITE ) {
			add_action( 'restrict_site_access_ip_match', array( $this, 'lwtv_restrict_site_access_ip_match' ) );
			add_action( 'wp_head', array( $this, 'add_meta_tags' ), 2 );
			defined( 'JETPACK_DEV_DEBUG' ) || define( 'JETPACK_DEV_DEBUG', true );
		}
	}

	/*
	 * Admin CSS
	 */
	function admin_enqueue_scripts() {
		wp_enqueue_style( 'admin-styles', content_url( 'library/assets/css/wp-admin.css' ) );
	}

	/**
	 * Damn it Google, GO AWAY
	 * Since: 2.1.4
	 */
	public function add_meta_tags() {
		echo '<meta name="robots" content="noindex">' . "\n";
	}

	/**
	 * Prevent caching when running restrict site access plugin
	 * Since: 2.1.0
	 */
	public function lwtv_restrict_site_access_ip_match() {
		session_start();
	}

	/**
	 * Disable comments on media files.
	 * Since: 1.0.0
	 */
	function filter_media_comment_status( $open, $post_id ) {
		$post = get_post( $post_id );
		if( $post->post_type == 'attachment' ) {
			return false;
		}
		return $open;
	}

}
new LezPress_Network();