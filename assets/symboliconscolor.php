<?php
/**
 * Symbolicons Color
 *
 * Shows the symbolicons Color settings page, based on the contents on
 * /mu-plugins/symbolicons
 *
 * Version:    2.0
 * Author:     Mika A. Epstein
 * Author URI: https://halfelf.org
 * License:    GPL-2.0+
 *
 */

$upload_dir = wp_upload_dir();

if ( !defined( 'LP_SYMBOLICONS_PATH' ) ) define( 'LP_SYMBOLICONSCOLOR_PATH', $upload_dir['basedir'] . '/lezpress-icons/symboliconscolor/' );

if ( !defined( 'LP_SYMBOLICONS_URL' ) ) define( 'LP_SYMBOLICONSCOLOR_URL', $upload_dir['baseurl'] . '/lezpress-icons/symboliconscolor/' );

// if this file is called directly abort
if ( ! defined('WPINC' ) ) {
	die;
}

class LP_SymboliconsColorSettings {

	/*
	 * Construct
	 *
	 * Actions to happen immediately
	 */
	public function __construct() {
		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
	}

	/*
	 * Init
	 *
	 * Actions to happen on WP init
	 * - add settings page
	 * - establish shortcode
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_shortcode( 'symboliconcolor', array( $this, 'shortcode' ) );
	}

	/*
	 * admin_enqueue_scripts
	 */
	public function admin_enqueue_scripts() {
		wp_register_style( 'symbolicons-admin', '/wp-content/library/assets/css/symbolicons-admin.css', false );
	}

	/*
	 * Shortcode
	 *
	 * Generate the Symbolicon via shortcode
	 *
	 * @param array $atts Attributes for the shortcode
	 *   - file: Filename
	 *   - title: Title to use (for A11y)
	 *   - url: URL to link to (optional)
	 * @return SVG icon of awesomeness
	 */
	function shortcode($atts) {
		$iconsfolder = LP_SYMBOLICONSCOLOR_PATH;
		$svg = shortcode_atts( array(
		'file'	=> '',
		'title'	=> '',
		'url'	=> '',
		), $atts );

		if ( !file_exists( $iconsfolder . $svg[ 'file' ] . '.svg' ) ) $svg[ 'file' ] = 'eightball';

		$iconpath = '<span role="img" aria-label="'. sanitize_text_field( $svg[ 'title' ] ) . '" title="' . sanitize_text_field( $svg[ 'title' ] ) . '" class="svg-color-shortcode ' . sanitize_text_field( $svg[ 'title' ] ) . '">';
		if ( !empty($svg['url']) ) {
			$iconpath .= '<a href=' . esc_url( $svg['url'] ) . '>' . file_get_contents( $iconsfolder . $svg[ 'file' ] . '.svg' ) . '</a>';
		} else {
			$iconpath .= file_get_contents( $iconsfolder . $svg[ 'file' ] . '.svg' );
		}
		$iconpath .= '</span>';

		return $iconpath;
	}

	/*
	 * Settings
	 *
	 * Create our settings page
	 */
	public function add_settings_page() {
		$page = add_theme_page(__('Symbolicons Color'), __('Symbolicons Color'), 'edit_posts', 'symboliconscolor', array($this, 'settings_page'));
	}

	/*
	 * Settings Page Content
	 *
	 * A list of all the Symbolicons and how to use them. Kind of.
	 */
	function settings_page() {
		?>
		<div class="wrap">

		<style>
			span.symlclr-icon {
				width: 80px;
				display: inline-block;
				vertical-align: top;
				margin: 10px;
				word-wrap: break-word;
			}
			span.symlclr-icon svg {
				width: 75px;
				height: 75px;
			}
		</style>

		<h2>Symbolicons Color</h2>

		<?php
		if ( !file_exists( LP_SYMBOLICONSCOLOR_PATH ) && !is_dir( LP_SYMBOLICONSCOLOR_PATH ) ) {
			echo '<p>Your site does not appear to have the symbolicons color folder included, so you can\'t use them. It should be installed at <code>'.$imagepath.'</code> for this to work.';

		} else {

			echo '<p>The following are all the symbolicons in color you have to chose from and their file names.</p><p>They\'re only good for shortcodes like: <br /><code>[symboliconcolor file=cat title="This is a cat" url=http://example.com/cat/]</code></p>';

			foreach( glob( LP_SYMBOLICONSCOLOR_PATH . '*' ) as $filename ){
				$svg  = str_replace( LP_SYMBOLICONSCOLOR_PATH, LP_SYMBOLICONSCOLOR_URL , $filename );
				$name = str_replace( LP_SYMBOLICONSCOLOR_PATH, '' , $filename );
				$name = str_replace( '.svg', '', $name );
				echo '<span role="img"><svg width="100%" height="100%" data-src="' . $svg . '" alt="' . $name .'" /></svg></span>';
			}
		}
	}

}
new LP_SymboliconsColorSettings();