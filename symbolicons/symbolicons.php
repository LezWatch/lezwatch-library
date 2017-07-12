<?php
/**
 * Symbolicons
 *
 * Shows the symbolicons settings page, based on the contents on
 * /mu-plugins/symbolicons
 *
 * Version:    1.0
 * Author:     Mika A. Epstein
 * Author URI: https://halfelf.org
 * License:    GPL-2.0+
 *
 */

if ( !defined( 'LP_SYMBOLICONS_PATH' ) ) define( 'LP_SYMBOLICONS_PATH', dirname( __FILE__ ) . '/' );

if ( !defined( 'LP_SYMBOLICONS_URL' ) ) define( 'LP_SYMBOLICONS_URL', '/wp-content/mu-plugins/symbolicons/' );

// if this file is called directly abort
if ( ! defined('WPINC' ) ) {
	die;
}

class LP_SymboliconsSettings {

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
        add_shortcode( 'symbolicon', array( $this, 'shortcode' ) );
    }

	/*
	 * admin_enqueue_scripts
	 */
    public function admin_enqueue_scripts() {
        wp_register_style( 'symbolicons-admin', '/wp-content/assets/css/symbolicons-admin.css', false );
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
		$iconsfolder = LP_SYMBOLICONS_PATH . '/svg/';
	    $svg = shortcode_atts( array(
	    	'file'	=> '',
			'title'	=> '',
			'url'	=> '',
	    ), $atts );

		// Default to the square if nothing is there
	    if ( !file_exists( $iconsfolder . $svg[ 'file' ] . '.svg' ) ) $svg[ 'file' ] = 'square';

		$iconpath = '<span role="img" aria-label="' . sanitize_text_field( $svg[ 'title' ] ) . '" title="' . sanitize_text_field( $svg[ 'title' ] ) . '" class="svg-shortcode ' . sanitize_text_field( $svg[ 'title' ] ) . '">';
		if ( !empty( $svg[ 'url' ] ) ) {
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
		$page = add_theme_page( 'Symbolicons', 'Symbolicons', 'edit_posts', 'symbolicons', array( $this, 'settings_page' ) );
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
			span.cmb2-icon {
				width: 80px;
			    display: inline-block;
			    vertical-align: top;
			    margin: 10px;
			    word-wrap: break-word;
			}
			span.cmb2-icon svg {
			    width: 75px;
			    height: 75px;
			}
			span.cmb2-icon svg * {
				fill: #444;
			}
		</style>

		<h2>Symbolicons</h2>

		<?php

		$imagepath = LP_SYMBOLICONS_PATH . '/svg/';

		echo '<p>The following are all the symbolicons you have to chose from and their file names. Let this help you be more better with your iconing.</p>';

		foreach( glob( $imagepath . '*' ) as $filename ){
			$image = file_get_contents( $filename );
			$name  = str_replace( $imagepath, '' , $filename );
			$name  = str_replace( '.svg', '', $name );
			echo '<span role="img" class="cmb2-icon">' . $image . $name .'</span>';
		}
	}

}
new LP_SymboliconsSettings();