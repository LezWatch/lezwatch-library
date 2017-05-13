<?php
/*
Plugin Name: Social Icons
Description: Embed social media icons (which are SVG) as shortcodes
Version: 1.0
Author: Mika Epstein
*/

class LP_Socialicons{

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Init
	 */
	public function init() {
		add_shortcode( 'svgicon', array( $this, 'socialicon_shortcode' ) );
		add_shortcode( 'socialicon', array( $this, 'socialicon_shortcode' ) );
		add_filter( 'widget_text', 'do_shortcode', 7 );
	}

	/*
	 * Display Social Icons
	 *
	 * Usage: [svgicon file=(filename) title=(alt title) link=(url)]
	 *
	 * Attributes:
	 * 		file = (text) file name without suffic. (default: square)
	 *		text = (text) alt title. (default: 'an icon' )
	 *		url  = (url) a link (optional)
	 *
	 * @since 1.0
	 */
	public function socialicon_shortcode($atts) {
		$iconsfolder = plugin_dir_path( __FILE__ ) . '/socialicons/';
	    $svg = shortcode_atts( array(
	    'file'	=> 'square',
	    'title'	=> 'an icon',
	    'url'	=> '',
	    ), $atts );

	    if ( !file_exists( $iconsfolder . $svg[ 'file' ] . '.svg' ) ) {
		    $svg['file'] = 'square';
	    }

		$iconpath = '<span role="img" aria-label="' . sanitize_text_field( $svg[ 'title' ] ) . '" title="' . sanitize_text_field( $svg[ 'title' ] ) . '" class="svg-shortcode ' . sanitize_text_field( $svg[ 'title' ] ) . '">';
		if ( !empty( $svg[ 'url' ] ) ) {
			$iconpath .= '<a href=' . esc_url( $svg[ 'url' ] ) . '>' . file_get_contents( $iconsfolder . $svg[ 'file' ] . '.svg' ) . '</a>';
		} else {
			$iconpath .= file_get_contents( $iconsfolder . $svg[ 'file' ] . '.svg' );
		}
		$iconpath .= '</span>';

		return $iconpath;
	}
}

new LP_Socialicons();