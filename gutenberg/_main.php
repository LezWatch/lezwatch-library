<?php
/**
 * Name: Gutenberg Blocks
 * Description: Blocks for Gutenberg
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Block Initializer.
*/
require_once 'src/init.php';

// Add a block category
add_filter(
	'block_categories',
	function( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'lezwatch',
					'title' => 'LezWatch Library',
				),
			)
		);
	},
	10,
	2
);
