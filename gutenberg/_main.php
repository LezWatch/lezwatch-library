<?php
/**
 * Name: Gutenberg Blocks
 * Description: Blocks for Gutenberg
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class LWTV_Library_Gutenblocks {

	protected static $directory;

	public function __construct() {
		self::$directory = dirname( __FILE__ );

		add_action( 'init', array( $this, 'spoilers' ) );
		add_action( 'init', array( $this, 'listicles' ) );
		add_action( 'init', array( $this, 'author_box' ) );

		add_filter( 'block_categories', function( $categories, $post ) {
			return array_merge(
				$categories,
				array(
					array(
						'slug'  => 'lezwatch',
						'title' => 'LezWatch',
					),
				)
			);
		}, 10, 2 );
	}

	public function spoilers() {
		$index_js = 'spoilers/index.js';
		wp_register_script(
			'spoilers-block-editor',
			content_url( 'library/gutenberg/' . $index_js ),
			array( 'wp-editor', 'wp-blocks', 'wp-i18n', 'wp-element' ),
			filemtime( self::$directory . '/' . $index_js ),
			false
		);

		$editor_css = 'spoilers/editor.css';
		wp_register_style(
			'spoilers-block-editor',
			content_url( 'library/gutenberg/' . $editor_css ),
			array( 'wp-editor', 'wp-blocks' ),
			filemtime( self::$directory . '/' . $editor_css )
		);

		$style_css = 'spoilers/style.css';
		wp_register_style(
			'spoilers-block',
			content_url( 'library/gutenberg/' . $style_css ),
			array( 'wp-editor', 'wp-blocks' ),
			filemtime( self::$directory . '/' . $style_css )
		);

		register_block_type( 'lez-library/spoilers', array(
			'editor_script' => 'spoilers-block-editor',
			'editor_style'  => 'spoilers-block-editor',
			'style'         => 'spoilers-block',
		) );
	}

	public function listicles() {
		$dir = dirname( __FILE__ );

		$index_js = 'listicles/dist/blocks.build.js';
		wp_register_script(
			'listicles-block-editor',
			content_url( 'library/gutenberg/' . $index_js ),
			array( 'wp-editor', 'wp-blocks', 'wp-i18n', 'wp-element' ),
			filemtime( self::$directory . '/' . $index_js ),
			false
		);

		$editor_css = 'listicles/dist/blocks.editor.build.css';
		wp_register_style(
			'listicles-block-editor',
			content_url( 'library/gutenberg/' . $editor_css ),
			array( 'wp-editor', 'wp-blocks' ),
			filemtime( self::$directory . '/' . $editor_css )
		);

		$style_css = 'listicles/dist/blocks.style.build.css';
		wp_register_style(
			'listicles-block',
			content_url( 'library/gutenberg/' . $style_css ),
			array( 'wp-editor', 'wp-blocks' ),
			filemtime( self::$directory . '/' . $style_css )
		);

		register_block_type( 'lez-library/listicles', array(
			'editor_script' => 'listicles-block-editor',
			'editor_style'  => 'listicles-block-editor',
			'style'         => 'listicles-block',
		) );
	}

	public function author_box() {
		$index_js = 'author-box/index.js';
		wp_register_script(
			'author-box-editor',
			content_url( 'library/gutenberg/' . $index_js ),
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
			filemtime( self::$directory . '/' . $index_js ),
			false
		);

		$editor_css = 'author-box/editor.css';
		wp_register_style(
			'author-box-editor',
			content_url( 'library/gutenberg/' . $editor_css ),
			array( 'wp-editor', 'wp-blocks' ),
			filemtime( self::$directory . '/' . $editor_css )
		);

		register_block_type( 'lez-library/author-box', array(
			'attributes'      => array(
				'users' => array(
					'type' => 'string',
				),
			),
			'editor_script'   => 'author-box-editor',
			'editor_style'    => 'author-box-editor',
			'render_callback' => array( 'LP_Shortcodes', 'author_box' ),
		) );
	}

}

if ( function_exists( 'register_block_type' ) ) {
	new LWTV_Library_Gutenblocks();
}
