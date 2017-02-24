<?php
/*
Plugin Name: Global Shortcodes
Description: Various shortcodes used on the LeZWatch Network
Version: 1.1
Author: Mika Epstein
*/

class LezWatch_Shortcodes{

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
		add_shortcode( 'copyright', array( $this, 'copyright') );
		add_shortcode( 'numposts', array( $this, 'numposts') );
		add_shortcode( 'google-ads', array( $this, 'google_ads') );
	}

	/*
	 * Display Copyright Year
	 *
	 * Usage: [copyright year=(start year) text=(copyright text)]
	 *
	 * Attributes:
	 * 		year = (int) start year. (default: current year)
	 *		text = (text) copyright message. (default: &copy; )
	 *
	 * @since 1.0
	 */	
	public function copyright( $atts ) {
	    $attributes = shortcode_atts( array(
	        'year' => 'auto',
	        'text' => '&copy;'
	    ), $atts );
	    
		$year = ( $attributes['year'] == '' || ctype_digit($attributes['year']) == false )? date('Y') : intval($attributes['year']);
		$text = ( $attributes['text'] == '' )? '&copy;' : sanitize_text_field( $attributes['text'] );
	
		if ( $year == date('Y') || $year > date('Y') ) {
			$output = date('Y');
		} elseif ( $year < date('Y') ) {
			$output = $year . ' - ' . date('Y');
		}
	
		return $text . ' ' . $output;
	}

	/*
	 * Number of Posts via shortcodes
	 *
	 * Usage: [numposts data="posts" posttype="post type" term="term slug" taxonomy="taxonomy slug"]
	 *
	 * Attributes:
	 *		data     = [posts|taxonomy]
	 * 		posttype = post type
	 * 		term     = term slug
	 *		taxonomy = taxonomy slug
	 *
	 * @since 1.0
	 */
	public function numposts( $atts ) {
		$attr = shortcode_atts( array(
			'data'     => 'posts',
			'posttype' => 'post',
			'term'     => '',
			'taxonomy' => '',
		), $atts );

		if ( $attr['data'] == 'posts' ) {

			// Collect posts
			$posttype = sanitize_text_field( $attr['posttype'] );
			
			if ( post_type_exists( $posttype ) !== true ) $posttype = 'post';
			
			$to_count = wp_count_posts( $posttype );
			$return = $to_count->publish;

		} elseif ( $attr['data'] == 'taxonomy' ) {

			// Collect Taxonomies
			$the_term     = sanitize_text_field( $attr['term'] );
			$the_taxonomy = sanitize_text_field( $attr['taxonomy'] );

			if ( !is_null($the_term) && $the_taxonomy !== false ) {			
				$all_taxonomies = ( empty( $the_taxonomy ) )? get_taxonomies() : array( $the_taxonomy ) ;

				foreach ( $all_taxonomies as $taxonomy ) {
				    $does_term_exist = term_exists( $the_term, $taxonomy );
				    if ( $does_term_exist !== 0 && $does_term_exist !== null ) {
					    $the_taxonomy = $taxonomy;
					    break;
				    } else {
					    $the_taxonomy = false;
				    }
				}
				$to_count = get_term_by( 'slug', $the_term, $the_taxonomy );
				$return = $to_count->count;
			} else {
				$return = 'n/a';
			}
		} else {
			$return = 'n/a';
		}
		
		return $return;
	}

	/*
	 * Display Google Ads (responsive only)
	 *
	 * Usage: [google-ads]
	 *
	 * @since 1.0
	*/
	public function google_ads( $atts ) {
	
		$ads = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Responsive -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-7868382837959636"
			     data-ad-slot="8167384707"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
	
		return $ads;
	}	
}

new LezWatch_Shortcodes();