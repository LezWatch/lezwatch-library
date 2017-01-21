<?php
/*
Plugin Name: Dashboard
Description: Custom Dashboard Changes
Version: 1.0
Author: Mika Epstein
*/

// Adding to Right Now
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

// Styling Icons
function lez_feedback_right_now_css() {
   echo "<style type='text/css'>
           #adminmenu #menu-posts-feedback div.wp-menu-image:before, #dashboard_right_now li.feedback-count a:before {
                content: '\\f466';
                margin-left: -1px;
            }
         </style>";

}

add_action('admin_head', 'lez_feedback_right_now_css');


