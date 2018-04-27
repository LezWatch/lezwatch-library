<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package library
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function lp_spoilers_block_init() {
	$dir = dirname( __FILE__ );

	$index_js = 'spoilers/index.js';
	wp_register_script(
		'spoilers-block-editor',
		content_url( 'library/gutenberg/' . $index_js ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'spoilers/editor.css';
	wp_register_style(
		'spoilers-block-editor',
		content_url( 'library/gutenberg/' . $editor_css ),
		array( 'wp-blocks' ),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'spoilers/style.css';
	wp_register_style(
		'spoilers-block',
		content_url( 'library/gutenberg/' . $style_css ),
		array( 'wp-blocks' ),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'library/spoilers', array(
		'editor_script' => 'spoilers-block-editor',
		'editor_style'  => 'spoilers-block-editor',
		'style'         => 'spoilers-block',
	) );
}
add_action( 'init', 'lp_spoilers_block_init' );
