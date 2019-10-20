<?php
/*
 * Library: Functions
 * Description: Special Functions
 * Version: 3.0
 * Author: Mika Epstein
 *
 * @package library
 */

/*
 * File Includes
 */

// Composer
require_once 'vendor/autoload.php';

// Features and WP Stuff
require_once 'features/dashboard.php';
require_once 'features/embeds.php';
require_once 'features/shortcodes.php';
require_once 'features/upgrades.php';
require_once 'gutenberg/_main.php';
require_once 'plugins/jetpack.php';

// Symbolicons
require_once 'assets/symbolicons.php';

/**
 * LezPress_Network class.
 * Functions used by all sites on the network
 */
class LezPress_Network {

	protected static $version;

	public function __construct() {
		self::$version = '3.0';

		// Disable check for 'is your admin password legit'.
		// https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/
		add_filter( 'admin_email_check_interval', '__return_false' );

		// Force close comments on media
		add_filter( 'comments_open', array( $this, 'filter_media_comment_status' ), 10, 2 );

		// Enqueue scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Login Page Changes
		add_action( 'login_enqueue_scripts', array( $this, 'login_logos' ) );
		add_filter( 'login_headerurl', array( $this, 'login_headerurl' ) );
		add_filter( 'login_headertext', array( $this, 'login_headertitle' ) );
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
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'admin-styles', content_url( 'library/assets/css/wp-admin.css' ), array(), self::$version );
	}

	/*
	 * Login Logos
	 */
	public function login_logos() {
		$site_url = wp_parse_url( home_url() );
		$temp     = explode( '.', $site_url['host'] );
		unset( $temp[ count( $temp ) - 1 ] );
		$domain     = implode( '.', $temp );
		$logo_image = content_url( 'library/assets/images/' . $domain . '.png' );

		// Bail if the logo doesn't exist
		if ( ! file_exists( WP_CONTENT_DIR . '/library/assets/images/' . $domain . '.png' ) ) {
			return;
		}

		// Otherwise, let's customize!
		?>
		<style type="text/css">
			#login h1 a, .login h1 a { background-image: url(<?php echo esc_url( $logo_image ); ?>);
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
	public function login_headerurl() {
		return home_url();
	}

	/*
	 * Login Title
	 */
	public function login_headertitle() {
		return get_bloginfo( 'name' );
	}

	/*
	 * Login Errors
	 */
	public function login_errors( $error ) {
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
		// @codingStandardsIgnoreStart
		if ( ! is_user_logged_in() && session_status() != PHP_SESSION_ACTIVE ) {
			@session_start();
		}
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Disable comments on media files.
	 * Since: 1.0.0
	 */
	public function filter_media_comment_status( $open, $post_id ) {
		$post = get_post( $post_id );
		if ( 'attachment' === $post->post_type ) {
			return false;
		}
		return $open;
	}

}
new LezPress_Network();
