<?php
/*
Plugin Name: Copyright
Description: Copyright shortcode
Version: 1.0
Author: Mika Epstein
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