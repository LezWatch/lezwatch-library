<?php
/*
Plugin Name: Dashboard
Description: Custom Dashboard and WP Admin Changes
Version: 1.1
Author: Mika Epstein
*/

// Disable JSON - TEMPORARILY
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');

/*
 * Show Feedback in "Right Now"
 *
 * @since 1.0
 */

add_action( 'dashboard_glance_items', 'lez_feedback_right_now' );
function lez_feedback_right_now() {
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

add_action('admin_head', 'lez_feedback_right_now_css');
function lez_feedback_right_now_css() {
   echo "<style type='text/css'>
           #adminmenu #menu-posts-feedback div.wp-menu-image:before, #dashboard_right_now li.feedback-count a:before {
                content: '\\f466';
                margin-left: -1px;
            }
         </style>";

}

/*
 * Show mark if featured image is set
 *
 * @since 1.1
 */

add_filter('manage_posts_columns', 'lez_fi_manage_posts_columns');
function lez_fi_manage_posts_columns( $columns ) {
	if ( !is_array( $columns ) ) $columns = array();
	$new_columns = array();

	foreach( $columns as $key => $title ) {
		if ( $key == 'title' ) $new_columns['featured_image'] = '<span class="dashicons dashicons-camera"></span>';
		$new_columns[$key] = $title;
	}

	return $new_columns;
}

add_action('manage_posts_custom_column', 'lez_fi_manage_posts_custom_column', 10, 2);
function lez_fi_manage_posts_custom_column( $column_name, $post_ID ) {
    if ($column_name == 'featured_image') {
        $post_featured_image = lez_fi_manage_column_check( $post_ID );
        $output = '<span class="dashicons dashicons-no"></span>';
        if ( $post_featured_image && $post_featured_image == true ) $output = '<span class="dashicons dashicons-yes"></span>';
        echo $output;
    }
}

function lez_fi_manage_column_check( $post_ID ) {
    $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
    $post_thumbnail_img = false;
    if ( $post_thumbnail_id ) $post_thumbnail_img = true;
	return $post_thumbnail_img;
}

add_action( 'admin_print_scripts', 'lez_fi_admin_print_styles' );
function lez_fi_admin_print_styles(){
	echo '
	<style>
		th#featured_image,
		td.featured_image.column-featured_image {
			max-height: 25px;
			max-width: 25px;
			width: 25px;
			color: #444;
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