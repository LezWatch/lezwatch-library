<?php
/**
 * Name: Gutenberg Blocks
 * Description: Blocks for Gutenberg
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) || ! function_exists( 'register_block_type' ) ) {
	exit;
}

class LezWatch_Library_Gutenberg {

	protected static $directory;

	public function __construct() {
		self::$directory = dirname( __FILE__ );

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

		add_action( 'enqueue_block_assets', array( $this, 'block_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );

		// Hook server side rendering into render callback
		register_block_type(
			'lez-library/private-note',
			array(
				'render_callback' => array( $this, 'render_private_blocks' ),
			)
		);
	}

	public function block_assets() {
		// Styles.
		$build_css = 'build/style-index.css';
		wp_enqueue_style(
			'lez-library-gutenberg-style', // Handle.
			content_url( 'library/blocks/' . $build_css ),
			array( 'wp-editor' ),
			filemtime( self::$directory . '/' . $build_css )
		);
	}

	public function block_editor_assets() {
		// Scripts.
		$build_js = 'build/index.js';
		wp_enqueue_script(
			'lez-library-gutenberg-blocks', // Handle.
			content_url( 'library/blocks/' . $build_js ),
			array( 'wp-i18n', 'wp-element' ),
			filemtime( self::$directory . '/' . $build_js ),
			true
		);

		// Styles.
		$editor_css = 'build/index.css';
		wp_enqueue_style(
			'lez-library-gutenberg-editor', // Handle.
			content_url( 'library/blocks/' . $editor_css ),
			array(),
			filemtime( self::$directory . '/' . $editor_css )
		);
	}

	public function render_private_blocks( $attributes, $content ) {

		if ( is_admin() ) {
			return $content;
		}

		$dom = new \DomDocument();
		$dom->loadXML( $content );

		$finder             = new \DomXPath( $dom );
		$secure_class       = 'wp-block-lez-library-private-note';
		$secure_content     = $finder->query( "//div[contains(@class, '$secure_class')]" );
		$secure_content_dom = new \DOMDocument();

		foreach ( $secure_content as $node ) {
			$secure_content_dom->appendChild( $secure_content_dom->importNode( $node, true ) );
		}

		$secure_content = trim( $secure_content_dom->saveHTML() );

		// Only people who can edit published posts (author, editor, admin) can see this.
		if ( is_user_logged_in() && current_user_can( 'edit_published_posts' ) ) {
			return $secure_content;
		}
	}

}

new LezWatch_Library_Gutenberg();
