<?php
/*
Library:  Dashboard
Description: Custom Dashboard and WP Admin Changes
Version: 1.2.1
Author: Mika Epstein
*/

class LP_Dashboard{

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'dashboard_glance_items', array( $this, 'dashboard_glance_feedback' ) );
		add_action( 'admin_head', array( $this, 'dashboard_glance_feedback_css' ) );
		add_filter( 'manage_posts_columns', array( $this, 'featured_image_manage_posts_columns' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'featured_image_manage_custom_columns' ) , 10, 2);
		add_action( 'admin_print_scripts', array( $this, 'featured_image_admin_print_styles' )  );

		add_action( 'pre_ping', array( $this, 'no_self_ping' ) );
	}

	/**
	 * Prevent self pings by interlinks
	 *
	 * @since 1.2.0
	 */
	function no_self_ping( &$links ) {
		$home = get_option( 'home' );
		foreach ( $links as $l => $link )
		  if ( 0 === strpos( $link, $home ) )
	        unset( $links[ $l ] );
	}

	/*
	 * Show Feedback in "Right Now"
	 *
	 * @since 1.0
	 */
	public function dashboard_glance_feedback() {
        	foreach ( array( 'feedback' ) as $post_type ) {
        		$num_posts = wp_count_posts( $post_type );
        		if ( $num_posts && $num_posts->publish ) {
        			if ( 'feedback' == $post_type ) {
        				$text = _n( '%s Message', '%s Messages', $num_posts->publish );
        			}
        			$text = sprintf( $text, number_format_i18n( $num_posts->publish ) );
        			printf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', $post_type, $text );
        		}
        	}
	}

	/*
	 * Custom Icon for Feedback in "Right Now"
	 *
	 * @since 1.0
	 */
	public function dashboard_glance_feedback_css() {
		echo "
		<style type='text/css'>
			#adminmenu #menu-posts-feedback div.wp-menu-image:before, #dashboard_right_now li.feedback-count a:before {
				content: '\\f466';
				margin-left: -1px;
			}
		</style>";
	}

	/*
	 * Create custom column for featured images in posts lists
	 *
	 * @since 1.1
	 */
	public function featured_image_manage_posts_columns( $columns ) {
		if ( !is_array( $columns ) ) $columns = array();
		$new_columns = array();

		// Put the feature image right after title
		foreach( $columns as $key => $title ) {
			$new_columns[$key] = $title;
			if ( $key == 'title' ) $new_columns['featured_image'] = '<span class="dashicons dashicons-camera"><span class="screen-reader-text">Image?</span></span>';
		}

		return $new_columns;
	}

	/*
	 * Content for featured image custom column
	 *
	 * @since 1.1
	 */
	public function featured_image_manage_custom_columns( $column_name, $post_ID ) {
	    if ($column_name == 'featured_image') {

			$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
			$post_featured_image = false;
			if ( $post_thumbnail_id ) $post_featured_image = true;

	        $output = '<span class="dashicons dashicons-no"><span class="screen-reader-text">No</span></span>';
	        if ( $post_featured_image == true ) $output = '<span class="dashicons dashicons-yes"><span class="screen-reader-text">Yes</span></span>';
	        echo $output;
	    }
	}

	/*
	 * CSS for featured image custom column
	 *
	 * @since 1.1
	 */
	public function featured_image_admin_print_styles(){
		echo '
		<style>
			th#featured_image,
			td.featured_image.column-featured_image {
				max-height: 25px;
				max-width: 25px;
				color: #444;
				width: 2.2em;
			}
			td.featured_image span.dashicons-no {
				color: #dc3232;
			}
			td.featured_image span.dashicons-yes {
				color: #46b450;
			}
			div#screen-options-wrap.hidden span.dashicons-camera {
				padding-top: 5px;
			}
		</style>';
	}

}

new LP_Dashboard();