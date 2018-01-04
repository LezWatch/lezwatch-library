<?php
/*
Library: Functions
Description: Special Functions
Version: 2.1.0
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
		self::$version = '2.1.0';
		add_filter( 'comments_open', array( $this, 'filter_media_comment_status' ), 10 , 2 );

		if ( DB_HOST == 'mysql.lwtv.dream.press' ) {
			add_action( 'restrict_site_access_ip_match', array( $this, 'lwtv_restrict_site_access_ip_match' ) );
		}
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