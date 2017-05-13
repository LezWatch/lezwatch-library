<?php
/*
Plugin Name: Per-Site Functions
Description: Special Functions Per Site only
Version: 1.0
Author: Mika Epstein
*/


/**
 * class LP_Per_Site
 *
 * @since 1.0
 */
class LP_Per_Site {


	public function __construct() {
		global $blog_id;

		// Site URL switches:
		$site_url = parse_url( get_site_url( $blog_id ) );
		switch ( $site_url['host'] ) {
			case 'lezpress.com':
			case 'lezpress.dev':
				add_action( 'init', array( $this, 'lezpress' ) );
				break;
		}

		// Enable shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode' );

	}

	function lezpress() {
		add_filter( 'genesis_footer_creds_text', function( $creds ) {
		    $creds = 'Copyright [footer_copyright first="2016"] <a href="https://lezpress.com">Lez Press</a> &middot; <a href="https://lezpress.com/terms-of-use/">Terms of Use</a> <br /> Powered by the <a href="http://www.shareasale.com/r.cfm?b=830048&u=728549&m=28169&urllink=&afftrack=">Showcase Pro Theme</a> on the <a href="http://www.shareasale.com/r.cfm?b=346198&u=728549&m=28169&urllink=&afftrack=">Genesis Framework</a>, [footer_wordpress_link], and <a href="//liquidweb.evyy.net/c/294289/297656/4464">Liquidweb Hosting</a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/297656/4464" style="position:absolute;visibility:hidden;" border="0" /> <br /> [footer_loginout]';
		    return $creds;
		}, 10, 2 );
	}
}

new LP_Per_Site();