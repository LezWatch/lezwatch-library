<?php
/*
Plugin Name: Global Shortcodes
Description: Various shortcodes used on the LeZWatch Network
Version: 1.0
Author: Mika Epstein
*/

/*
 * Display Copyright Year
 * [copyright year=(start year) text=(copyright text)]
 * &copy; 2016
 *
 * Attributes:
 * 		year = (int) start year. (default: current year)
 *		text = (text) copyright message. (default: &copy; )
 *
 * @since 1.0
 */

function lez_auto_copyright( $year = '' , $text = '' ){
	$year = ( $year == '' || ctype_digit($year) == false )? date('Y') : intval($year);
	$text = ( $text == '' )? '&copy;' : sanitize_text_field( $text );

	if( $year == date('Y') || $year > date('Y') ) $output = date('Y');
	elseif( $year < date('Y') )  $output = $year . ' - ' . date('Y');

	echo $text . ' ' . $output;
}

function lez_auto_copyright_shortcode( $atts ) {
    $attributes = shortcode_atts( array(
        'year' => 'auto',
        'text' => '&copy;'
    ), $atts );

    return lez_auto_copyright( sanitize_text_field($attributes['year']), sanitize_text_field($attributes['text']) );
}
add_shortcode( 'copyright', 'lez_auto_copyright_shortcode' );


/*
 * Number of Posts via shortcodes
 *
 * [numposts type="posts"]
 *
 * Attributes:
 * 		type = post type
 *
 * @since 1.0
 */

//
function lezwatch_numposts_shortcode( $atts ) {
	$attr = shortcode_atts( array(
		'type' => 'post',
	), $atts );

	$posttype = sanitize_text_field( $attr['type'] );
	if ( post_type_exists( $posttype ) !== true ) $posttype = 'post';

	$to_count = wp_count_posts( $posttype );
	return $to_count->publish;

}
add_shortcode( 'numposts', 'lezwatch_numposts_shortcode' );

/*
 * Number of Posts via shortcodes
 *
 * [numtax term="term_slug" taxonomy="tax_slug"]
 *
 * Attributes:
 * 		term = term slug
 *		taxonomy = taxonomy slug
 *
 * @since 1.0
 */
function lezwatch_numtax_shortcode( $atts ) {
	$attr = shortcode_atts( array(
		'term'     => '',
		'taxonomy' => '',
	), $atts );

	$the_term = sanitize_text_field( $attr['term'] );

	// Early Bailout
	if ( is_null($the_term) ) return "n/a";

	$all_taxonomies = ( empty( $attr['taxonomy'] ) )? get_taxonomies() : array( sanitize_text_field( $attr['taxonomy'] ) );

	//$all_taxonomies = get_taxonomies();
	foreach ( $all_taxonomies as $taxonomy ) {
	    $does_term_exist = term_exists( $the_term, $taxonomy );
	    if ( $does_term_exist !== 0 && $does_term_exist !== null ) {
		    $the_taxonomy = $taxonomy;
		    break;
	    } else {
		    $the_taxonomy = false;
	    }
	}

	// If no taxonomy, bail
	if ( $the_taxonomy == false ) return "n/a";

	$to_count = get_term_by( 'slug', $the_term, $the_taxonomy );
	return $to_count->count;

}
add_shortcode( 'numtax', 'lezwatch_numtax_shortcode' );


/*
 * Display Google Ads (responsive)
 *
 * [google-ads]
 *
 * @since 1.0
*/

function lez_google_ads_shortcode($atts) {

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

add_shortcode('google-ads', 'lez_google_ads_shortcode');
