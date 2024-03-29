<?php
/*
 * Library: Functions
 * Description: Special Functions
 * Version: 3.1
 * Author: Mika Epstein
 *
 * @package library
 */

/*
 * File Includes
 */

// Features and WP Stuff
require_once 'blocks/_main.php';
require_once 'features/_main.php';
require_once 'plugins/_main.php';

// Symbolicons
require_once 'assets/symbolicons.php';

/**
 * LezPress_Network class.
 * Functions used by all sites on the network
 */
class LezPress_Network {

	protected static $version;

	public function __construct() {
		self::$version = '3.1';

		// Disable check for 'is your admin password legit'.
		// https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/
		add_filter( 'admin_email_check_interval', '__return_false' );

		// Disable email update alerts for themes and plugins
		add_filter( 'auto_plugin_update_send_email', '__return_false' );
		add_filter( 'auto_theme_update_send_email', '__return_false' );

		// Extend the cookies
		add_filter( 'auth_cookie_expiration', array( $this, 'extend_login_session' ) );

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
			add_action( 'wp_head', array( $this, 'add_meta_tags' ), 2 );
			defined( 'JETPACK_DEV_DEBUG' ) || define( 'JETPACK_DEV_DEBUG', true );
		}

		// After Theme Setup...
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 11 );
	}

	/**
	 * After Theme Setup
	 */
	public function after_setup_theme() {
		//https://make.wordpress.org/core/2021/06/14/introducing-the-template-editor-in-wordpress-5-8/
		remove_theme_support( 'block-templates' );
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

	/**
	 * Extend login sessions
	 * @param  int    $expire Current expire length (3 days)
	 * @return int            New time
	 */
	public function extend_login_session( $expire ) {
		// Set login session limit in seconds
		return YEAR_IN_SECONDS;
	}

}
new LezPress_Network();
