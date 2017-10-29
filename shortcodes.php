<?php
/*
Library: Global Shortcodes
Description: Various shortcodes used on the LeZWatch Network
Version: 1.2
Author: Mika Epstein
*/

class LP_Shortcodes{

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Init
	 */
	public function init() {
		add_shortcode( 'copyright', array( $this, 'copyright' ) );
		add_shortcode( 'numposts', array( $this, 'numposts' ) );
		add_shortcode( 'author-box', array( $this, 'author_box' ) );
		add_shortcode( 'glossary', array( $this, 'glossary' ) );
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

		$year = ( $attributes[ 'year' ] == '' || ctype_digit( $attributes[ 'year' ] ) == false )? date( 'Y' ) : intval( $attributes[ 'year' ] );
		$text = ( $attributes[ 'text' ] == '' )? '&copy;' : sanitize_text_field( $attributes[ 'text' ] );

		if ( $year == date( 'Y' ) || $year > date( 'Y' ) ) {
			$output = date( 'Y' );
		} elseif ( $year < date( 'Y' ) ) {
			$output = $year . ' - ' . date( 'Y' );
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
			$posttype = sanitize_text_field( $attr[ 'posttype' ] );

			if ( post_type_exists( $posttype ) !== true ) $posttype = 'post';

			$to_count = wp_count_posts( $posttype );
			$return = $to_count->publish;

		} elseif ( $attr[ 'data' ] == 'taxonomy' ) {

			// Collect Taxonomies
			$the_term     = sanitize_text_field( $attr[ 'term' ] );
			$the_taxonomy = sanitize_text_field( $attr[ 'taxonomy' ] );

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
	 * Display Author Box
	 *
	 * Usage: [author-box users=username]
	 *
	 * @since 1.2
	*/
	public function author_box( $atts ) {

		if ( $atts['users'] == '' ) return;

		wp_enqueue_style( 'author-box-shortcode', content_url( 'library/assets/css/author-box.css' ) );

		$users = explode(',', sanitize_user( $atts['users'] ) );
		$user_count = count( $users );

		$columns = 'one-half';
		if ( $user_count == 1 ) $columns = '';
		if ( $user_count % 3 == 0 ) $columns = 'one-third';

		$author_box = '<div class="author-box-shortcode">';

		foreach( $users as $user ) {
			$user = username_exists( sanitize_user( $user ) );
			if ( $user ) {
				$authordata    = get_userdata( $user );
				$gravatar_size = 'genesis_author_box_gravatar_size' ;
				$gravatar      = get_avatar( get_the_author_meta( 'email', $user ), $gravatar_size );
				$description   = wpautop( get_the_author_meta( 'description', $user ) );
				$username      = get_the_author_meta( 'display_name' , $user );

				$author_box   .= '
					<section class="author-box '. $columns .'">'
					. $gravatar
					. '<h4 class="author-box-title"><span itemprop="name">' . $username . '</span></h4>
					<div class="author-box-content" itemprop="description">' . $description .  '</div>
					</section>
				';
			}
		}

		$author_box .= '</div>';

		return $author_box;
	}

	/*
	 * Outputs Glossary Terms
	 *
	 * Usage: [glossary taxonomy="taxonomy slug"]
	 *
	 * Attributes:
	 *		taxonomy = taxonomy slug
	 *
	 * @since 1.0
	 */
	public function glossary( $atts ) {
		$attr = shortcode_atts( array(
			'taxonomy' => '',
		), $atts );
		
		// Bail Early
		if ( $atts['taxonomy'] == '' ) return;
		
		$the_taxonomy = sanitize_text_field( $attr[ 'taxonomy' ] );
		$the_terms    = get_terms( $the_taxonomy );
		$return       = '<ul class="trope-list list-group">';

		if ( $the_terms && !is_wp_error( $the_terms ) ) {
			// loop over each returned trope
			foreach( $the_terms as $term ) {
				$icon    = lwtv_yikes_symbolicons( get_term_meta( $term->term_id, 'lez_termsmeta_icon', true ) .'.svg', 'fa-square' );
				$return .= '<li class="list-group-item glossary term term-' . $term->slug . '"><a href="' . get_term_link( $term->slug, $the_taxonomy ) .'" rel="glossary term">' . $icon .'</a> <a href="' . get_term_link( $term->slug, $the_taxonomy) .'" rel="glossary term" class="trope-link">' . $term->name .'</a></li>';
			}
		}
			
		$return .= '</ul>';
		
		return $return;
		
	}

}

new LP_Shortcodes();