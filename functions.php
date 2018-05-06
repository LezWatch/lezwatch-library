<?php
/*
Library: Functions
Description: Special Functions
Version: 2.1.5
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

		// Login Page Changes
		add_action( 'login_enqueue_scripts', array( $this, 'login_logos' ) );
		add_filter( 'login_headerurl', array( $this, 'login_headerurl' ) );
		add_filter( 'login_headertitle', array( $this, 'login_headertitle' ) );
		add_filter( 'login_errors', array( $this, 'login_errors' ) );

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

	/*
	 * Login Logos
	 */
	function login_logos() {
		$site_url   = parse_url( home_url() );
		$temp       = explode( '.', $site_url['host']);
		unset( $temp[ count($temp) - 1 ] );
		$domain     = implode( '.', $temp );
		$logo_image = content_url( 'library/assets/images/' . $domain . '.png' );

		// Bail if the logo doesn't exist
		if ( !file_exists( WP_CONTENT_DIR . '/library/assets/images/' . $domain . '.png' ) ) return;

		// Otherwise, let's customize!
		?>
		<style type="text/css">
			#login h1 a, .login h1 a { background-image: url(<?php echo $logo_image; ?>);
				height:80px;
				width:80px;
				background-size: 80px 80px;
			}
		</style>
		<?php
	}

	/*
	 * Login URL
	 */
	function login_headerurl() {
		return home_url();
	}

	/*
	 * Login Title
	 */
	function login_headertitle() {
		return get_bloginfo( 'name' );
	}

	/*
	 * Login Errors
	 */
	function login_errors( $error ) {

		$diane = '<br /><img src="' . content_url( 'library/assets/images/diane-fuck-off.gif' ) . '" />';
		$error = $error . $diane;
		return $error;
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