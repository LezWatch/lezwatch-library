<?php
/*
 * Various shortcodes and embeds used on the LezWatch Network
 *
 * @ver 2.0.0
 * @package library
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class LP_Shortcodes {

	protected static $version;

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'widget_text', 'do_shortcode' );
		self::$version = '2.0.0';
	}

	/**
	 * Init
	 */
	public function init() {
		// Inline (will remain shortcodes)
		add_shortcode( 'copyright', array( $this, 'copyright' ) );
		add_shortcode( 'numposts', array( $this, 'numposts' ) );
		add_shortcode( 'badge', array( $this, 'badge' ) );

		// Blocks (all have been converted to Gutenblocks)
		add_shortcode( 'author-box', array( 'LWTV_Shortcodes', 'author_box' ) );
		add_shortcode( 'glossary', array( 'LWTV_Shortcodes', 'glossary' ) );
		add_shortcode( 'spoilers', array( $this, 'spoilers' ) );

		// Embeds (all work in Gutenberg)
		add_shortcode( 'gleam', array( $this, 'gleam' ) );
		add_shortcode( 'indiegogo', array( $this, 'indiegogo_shortcode' ) );
		add_shortcode( 'disneypress', array( $this, 'disneypress_shortcode' ) );
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
		$attributes = shortcode_atts(
			array(
				'year' => 'auto',
				'text' => '&copy;',
			),
			$atts
		);

		$year = ( '' === $attributes['year'] || false === ctype_digit( $attributes['year'] ) ) ? date( 'Y' ) : intval( $attributes['year'] );
		$text = ( '' === $attributes['text'] ) ? '&copy;' : sanitize_text_field( $attributes['text'] );

		if ( date( 'Y' ) === $year || $year > date( 'Y' ) ) {
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
	 *    data     = [posts|taxonomy]
	 *    posttype = post type
	 *    term     = term slug
	 *    taxonomy = taxonomy slug
	 *
	 * @since 1.0
	 */
	public function numposts( $atts ) {
		$attr = shortcode_atts(
			array(
				'data'     => 'posts',
				'posttype' => 'post',
				'term'     => '',
				'taxonomy' => '',
			),
			$atts
		);

		if ( 'posts' === $attr['data'] ) {
			// Collect posts
			$posttype = sanitize_text_field( $attr['posttype'] );

			if ( true !== post_type_exists( $posttype ) ) {
				$posttype = 'post';
			}

			$to_count = wp_count_posts( $posttype );
			$return   = $to_count->publish;

		} elseif ( 'taxonomy' === $attr['data'] ) {

			// Collect Taxonomies
			$the_term     = sanitize_text_field( $attr['term'] );
			$the_taxonomy = sanitize_text_field( $attr['taxonomy'] );

			if ( ! is_null( $the_term ) && false !== $the_taxonomy ) {
				$all_taxonomies = ( empty( $the_taxonomy ) ) ? get_taxonomies() : array( $the_taxonomy );

				foreach ( $all_taxonomies as $taxonomy ) {
					$does_term_exist = term_exists( $the_term, $taxonomy );
					if ( 0 !== $does_term_exist && null !== $does_term_exist ) {
						$the_taxonomy = $taxonomy;
						break;
					} else {
						$the_taxonomy = false;
					}
				}
				$to_count = get_term_by( 'slug', $the_term, $the_taxonomy );
				$return   = $to_count->count;
			} else {
				$return = 'n/a';
			}
		} else {
			$return = 'n/a';
		}
		return $return;
	}

	/*
	 * Shortcode for an IndieGoGo Campaign
	 *
	 * Usage: [indiegogo url="https://www.indiegogo.com/projects/riley-parra-season-2-lgbt"]
	 *
	 * Attributes:
	 *		url: The URL of the project
	 *
	 * @since 1.3
	 */
	public function indiegogo_shortcode( $atts ) {
		$attr = shortcode_atts(
			array(
				'url' => '',
			),
			$atts
		);

		$url    = esc_url( $attr['url'] );
		$url    = rtrim( $url, '#/' );
		$url    = str_replace( 'projects/', 'project/', $url );
		$return = '<iframe src="' . $url . '/embedded" width="222px" height="445px" frameborder="0" scrolling="no"></iframe>';

		return $return;
	}

	/*
	 * Display Spoiler Warning
	 *
	 * Usage:
	 *		[spoilers]
	 *		[spoilers warning="OMG! SPIDERS!!!"]
	 *
	 * @since 1.3
	 */
	public function spoilers( $atts ) {
		$default    = 'Warning: This post contains spoilers!';
		$attributes = shortcode_atts(
			array(
				'warning' => $default,
			),
			$atts
		);
		$warning    = ( '' === $attributes['warning'] ) ? $default : sanitize_text_field( $attributes['warning'] );

		return '<div class="alert alert-danger" role="alert"><strong>' . $warning . '</strong></div>';
	}

	/*
	 * Display Badge Link
	 *
	 * Usage:
	 *		[badge url=LINK class="class class" role="role"]TEXT[/badge]
	 *
	 * @since 1.3
	 */
	public function badge( $atts, $content = '', $tag = '' ) {
		$attributes = shortcode_atts(
			array(
				'url'   => '',
				'class' => '',
				'role'  => '',
			),
			$atts
		);
		$content    = ( '' === $content ) ? '' : sanitize_text_field( $content );
		$url        = esc_url( $attributes['url'] );
		$class      = esc_attr( $attributes['class'] );
		$role       = esc_attr( $attributes['role'] );

		return '<a class="' . $class . '" role="' . $role . '" href="' . $url . '">' . do_shortcode( $content ) . '</a>';
	}

	/*
	 * Display Gleam Contest
	 *
	 * Usage:
	 *		[gleam url="https://gleam.io/iR0GQ/gleam-demo-competition"]Gleam Demo Competition[/gleam]
	 *
	 * @since 1.3.1
	 */
	public function gleam( $atts, $content = null ) {
		$attributes = shortcode_atts(
			array(
				'url' => '',
			),
			$atts
		);

		// Bail if empty
		if ( empty( $attributes['url'] ) ) {
			return;
		}

		return sprintf( '<a class="e-gleam" href="%s" rel="nofollow">%s</a><script src="//js.gleam.io/e.js" async="true"></script>', esc_url( $attributes['url'] ), do_shortcode( $content ) );
	}

	/*
	 * Display Disney/ABC Press Video
	 *
	 * Usage:
	 *		[disneypress url="https://www.disneyabcpress.com/freeform/video/B11DA0A8-9C3A-D70E-E864-3A4261C207FB/embed"]
	 *
	 * @since 2.0
	 */
	public function disneypress( $atts, $content = null ) {
		$attributes = shortcode_atts(
			array(
				'url' => '',
			),
			$atts
		);

		// Bail if empty
		if ( empty( $attributes['url'] ) ) {
			return;
		}

		return sprintf( '<div class="embed-responsive embed-responsive-16by9"><iframe id="embed" src="%s" frameborder="0"></iframe></div>', esc_url( $attributes['url'] ) );
	}

}

new LP_Shortcodes();
