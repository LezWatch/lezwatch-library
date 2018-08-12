<?php
/*
 * Various  used on the LezWatch Network
 *
 * @ver 1.0.0
 * @package library
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class LP_Embeds {

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
		// Gleam
		wp_embed_register_handler( 'gleam', '#https?://gleam\.io/([a-zA-Z0-9_-]+)/.*#i', array( $this, 'gleam_embed_handler' ) );

		// Indigogo
		wp_embed_register_handler( 'indiegogo', '#https?://www\.indiegogo\.com/projects/.*#i', array( $this, 'indiegogo_embed_handler' ) );

		// Disney/ABC Press
		wp_embed_register_handler( 'disneypress', '#https?://www\.disneyabcpress\.com/([a-zA-Z0-9_-]+)/video/([a-zA-Z0-9_-]+)/embed#i', array( $this, 'disneypress_embed_handler' ) );
	}

	/*
	 * Embed an IndieGoGo Campaign
	 *
	 * @since 1.3.2
	 */
	public function indiegogo_embed_handler( $matches, $attr, $url, $rawattr ) {
		$url   = esc_url( $matches[0] );
		$url   = rtrim( $url, '#/' );
		$url   = str_replace( 'projects/', 'project/', $url );
		$embed = sprintf( '<iframe src="%1$s/embedded" width="222" height="445" frameborder="0" scrolling="no"></iframe>', $url );
		return apply_filters( 'indiegogo_embed', $embed, $matches, $attr, $url, $rawattr );
	}

	/*
	 * Embed a Gleam Campaign
	 *
	 * @since 1.3.2
	 */
	public function gleam_embed_handler( $matches, $attr, $url, $rawattr ) {
		$url   = esc_url( $matches[0] );
		$embed = sprintf( '<a class="e-gleam" href="%1$s" rel="nofollow">%1$s</a><script src="//js.gleam.io/e.js" async="true"></script>', $url );
		return apply_filters( 'gleam_embed', $embed, $matches, $attr, $url, $rawattr );
	}

	/*
	 * Embed a  Disney/ABC Press Video
	 *
	 * @since 2.0
	 */
	public function disneypress_embed_handler( $matches, $attr, $url, $rawattr ) {
		$url   = esc_url( $matches[0] );
		$embed = sprintf( '<div class="embed-responsive embed-responsive-16by9"><iframe id="embed" src="%1$s" frameborder="0"></iframe></div>', $url );
		return apply_filters( 'gleam_embed', $embed, $matches, $attr, $url, $rawattr );
	}

}

new LP_Embeds();
