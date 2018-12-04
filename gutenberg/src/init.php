<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LezWatch_Library_Gutenberg {

	protected static $directory;

	public function __construct() {
		self::$directory = dirname( dirname( __FILE__ ) );

		add_action( 'enqueue_block_assets', array( $this, 'block_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );

		/**
		 * Register Block Types -- Required for ServerSideRender:
		 *  - author-box
		 */
		register_block_type(
			'lez-library/author-box',
			array(
				'attributes'      => array(
					'users' => array(
						'type' => 'string',
					),
				),
				'render_callback' => array( 'LP_Shortcodes', 'author_box' ),
			)
		);
	}

	public function block_assets() {
		// Styles.
		$build_css = 'dist/blocks.style.build.css';
		wp_enqueue_style(
			'lez-library-gutenberg-style', // Handle.
			content_url( 'library/gutenberg/' . $build_css ),
			array( 'wp-editor' ),
			filemtime( self::$directory . '/' . $build_css )
		);
	}

	public function block_editor_assets() {
		// Scripts.
		$build_js = 'dist/blocks.build.js';
		wp_enqueue_script(
			'lez-library-gutenberg-blocks', // Handle.
			content_url( 'library/gutenberg/' . $build_js ),
			array( 'wp-i18n', 'wp-element' ),
			filemtime( self::$directory . '/' . $build_js ),
			true
		);

		// Styles.
		$editor_css = 'dist/blocks.editor.build.css';
		wp_enqueue_style(
			'lez-library-gutenberg-editor', // Handle.
			content_url( 'library/gutenberg/' . $editor_css ),
			array(),
			filemtime( self::$directory . '/' . $editor_css )
		);
	}
}

new LezWatch_Library_Gutenberg();
