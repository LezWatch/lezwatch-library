<?php
/**
 * Symbolicons Color
 *
 * Shows the symbolicons Color settings page, based on the contents on
 * /mu-plugins/symbolicons
 *
 * Version:    1.0
 * Author:     Mika A. Epstein
 * Author URI: https://halfelf.org
 * License:    GPL-2.0+
 *
 */

if ( !defined( 'LP_SYMBOLICONSCOLOR_PATH' ) ) define( 'LP_SYMBOLICONSCOLOR_PATH', WP_CONTENT_DIR . '/mu-plugins/symboliconscolor/' );

if ( !defined( 'LP_SYMBOLICONSCOLOR_URL' ) ) define( 'LP_SYMBOLICONSCOLOR_URL', '/wp-content/mu-plugins/symboliconscolor/' );

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
    }

	/*
	 * Init
	 *
	 * Actions to happen on WP init
	 * - add settings page
	 * - establish shortcode
	 */
    public function init() {
        add_action( 'admin_menu', array( $this, 'add_settings_page') );
        add_shortcode('symboliconcolor', array( $this, 'shortcode') );
    }

	/*
	 * Shortcode
	 *
	 * Generate the Symbolicon via shortcode
	 *
	 * @param array $atts Attributes for the shortcode
	 *                    - file: Filename
	 *                    - title: Title to use (for A11y)
	 *                    - url: URL to link to (optional)
	 * @return SVG icon of awesomeness
	 */
	function shortcode($atts) {
		$iconsfolder = LP_SYMBOLICONSCOLOR_PATH.'/svg/';
	    $svg = shortcode_atts( array(
	    'file'	=> '',
	    'title'	=> '',
	    'url'	=> '',
	    ), $atts );

	    if ( !file_exists( $iconsfolder.$svg['file'].'.svg' ) ) $svg['file'] = 'eightball';

		$iconpath = '<span role="img" aria-label="'. sanitize_text_field($svg['title']).'" title="'.sanitize_text_field($svg['title']).'" class="svg-color-shortcode '.sanitize_text_field($svg['title']).'">';
		if ( !empty($svg['url']) ) {
			$iconpath .= '<a href='.esc_url( $svg['url'] ).'>'.file_get_contents( $iconsfolder.$svg['file'].'.svg' ).'</a>';
		} else {
			$iconpath .= file_get_contents( $iconsfolder.$svg['file'].'.svg' );
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

		$imagepath = LP_SYMBOLICONSCOLOR_PATH.'/svg/';

		if ( !file_exists( $imagepath ) && !is_dir( $imagepath ) ) {
			echo '<p>Your site does not appear to have the symbolicons color folder included, so you can\'t use them. It should be installed at <code>'.$imagepath.'</code> for this to work.';

		} else {

			echo '<p>The following are all the symbolicons in color you have to chose from and their file names.</p><p>They\'re only good for shortcodes like: <br /><code>[symboliconscolor file=cat title="This is a cat" url=http://example.com/cat/]</code></p>';

			foreach( glob( $imagepath.'*' ) as $filename ){
				$image = file_get_contents( $filename );
				$name  = str_replace( $imagepath, '' , $filename );
				$name  = str_replace( '.svg', '', $name );
				echo '<span role="img" class="symlclr-icon">' . $image . $name .'</span>';
			}
		}
	}

}
new LP_SymboliconsColorSettings();

/*
 * Inline CSS
 *
 * Forcing the Symbolicons not to be Gigantor, Robot of Robots, on all pages.
 * This should be defined by Symbolicons regularm but just in case...
 */

if ( !function_exists( 'lp_symbolicon_admin_inline_css' ) ) {
	function lp_symbolicon_admin_inline_css(){
		echo '
		<style>
			span.svg-shortcode svg {
			    width: 50px;
			    height: 50px;
			    margin: 0 5px 0 5px;
			}
		</style>
		';
	}
	add_action( 'admin_print_scripts', 'lp_symbolicon_admin_inline_css' );
}