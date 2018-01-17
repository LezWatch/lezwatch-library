<?php
/*
Description: Jetpack Customizations
Version: 1.0
*/

if ( ! defined('WPINC' ) ) die;

/**
 * LP_Jetpack_Feedback class.
 * Functions used by Jetpack
 */
class LP_Jetpack_Feedback {

	/**
	 * Constructor
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'dashboard_glance_items', array( $this, 'dashboard_glance' ) );
		add_action( 'admin_head', array( $this, 'dashboard_glance_css' ) );
		
		add_action( 'init', array( $this, 'custom_post_statuses' ), 0 );
		add_filter( 'post_row_actions', array( $this, 'add_posts_rows' ), 10, 2);
		add_action( 'plugins_loaded', array( $this, 'mark_as_answered' ) );
		add_filter( 'display_post_states', array( $this, 'display_post_states' ) );
		add_action( 'admin_footer-post.php', array( $this, 'add_archived_to_post_status_list' ) );
		add_action( 'admin_footer-edit.php', array( $this, 'add_archived_to_bulk_edit' ) );
	}

	/**
	 * Add custom post status for Answered
	 * 
	 * @access public
	 * @return void
	 * @since 1.0
	 */
	public function custom_post_statuses() {
		register_post_status( 'answered', array(
			'label'                     => 'Answered',
			'public'                    => false,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Answered <span class="count">(%s)</span>', 'Answered <span class="count">(%s)</span>' ),
		) );
	}

	/**
	 * Add URL for replying to feedback.
	 * 
	 * @access public
	 * @param mixed $actions
	 * @param mixed $post
	 * @return void
	 * @since 1.0
	 */
	public function add_posts_rows( $actions, $post ) {
		// Only for Feedback
		if ( $post->post_type == 'feedback' ) {
			$url = add_query_arg( 'answered_post_status-post_id', $post->ID );
			$url = add_query_arg( 'answered_post_status-nonce', wp_create_nonce( 'answered_post_status-post_id' . $post->ID ), $url );
	
			// Edit URLs based on status
			if ( $post->post_status !== 'answered' ) {
				$url = add_query_arg( 'answered_post_status-status', 'answered', $url );
				$actions['answered_link']  = '<a href="' . $url . '" title="Mark This Post as Answered">Answered</a>';
			} elseif ( $post->post_status == 'answered' ){
				$url = add_query_arg( 'answered_post_status-status', 'publish', $url );
				$actions['answered']  = '<a class="untrash" href="' . $url . '" title="Mark This Post as Unanswered">Unanswered</a>';
				unset( $actions['edit'] );
				unset( $actions['trash'] );
			}
		}
		return $actions;
	}

	/**
	 * Add Answered to post statues
	 * 
	 * @access public
	 * @param mixed $states
	 * @return void
	 * @since 1.0
	 */
	function display_post_states( $states ) {
		global $post;

		if ( $post->post_type == 'feedback' ) {
			$arg = get_query_var( 'post_status' );
			if( $arg != 'answered' ){
				if( $post->post_status == 'answered' ){
					return array( 'Answered' );
				}
			}
		}

		return $states;
	}

	/**
	 * Process marking as answered
	 * 
	 * @access public
	 * @return void
	 * @since 1.0
	 */
	public function mark_as_answered() {

		// If contact forms aren't active, we'll just pass
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'contact-form' ) ) {

			// Check Nonce
			if ( isset( $_GET['answered_post_status-nonce'] ) && wp_verify_nonce( $_GET['answered_post_status-nonce'], 'answered_post_status-post_id' . $_GET['answered_post_status-post_id'] ) ) { 
				// Check Current user Can and then process
				if( current_user_can('publish_posts') && isset( $_GET['answered_post_status-status'] ) ) {
					$GLOBALS[ 'wp_rewrite' ] = new wp_rewrite;
		
					$status  = $_GET['answered_post_status-status'];
					$post_id = (int) $_GET['answered_post_status-post_id'];
		
					// If it's not a valid status, we have a problem
					if ( !in_array( $status, array( 'answered', 'publish' ) ) ) die( 'ERROR!!!' );
		
					$answered = array( 'ID' => $post_id, 'post_status' => $status );
					wp_update_post( $answered );
				}
			}

		}
	}


	/**
	 * add_archived_to_post_status_list function.
	 * 
	 * @access public
	 * @return void
	 * @since 1.0
	 */
	function add_archived_to_post_status_list(){
		global $post;
		$complete = $label = '';

		// Bail if not feedback
		if ( $post->post_type !== 'feedback' ) return;

		if( $post->post_status == 'answered' ) {
			echo '
				<script>
					jQuery(document).ready(function($){
						$("#post-status-display" ).text("Answered");
						$("select#post_status").append("<option value=\"answered\" selected=\"selected\">Answered</option>");
						$(".misc-pub-post-status label").append("<span id=\"post-status-display\">Answered</span>");
					});
				</script>
			';
		} elseif ( $post->post_status == 'publish' ){
			echo '
				<script>
					jQuery(document).ready(function($){
						$("select#post_status").append("<option value=\"answered\" >Answered</option>");
					});
				</script>
			';
		}
	} 

	public function add_archived_to_bulk_edit() {
		global $post;
		if ( $post->post_type !== 'feedback' ) return;	
		?>
			<script>
			jQuery(document).ready(function($){
				$(".inline-edit-status select ").append("<option value=\"answered\">Answered</option>");
				$(".bulkactions select ").append("<option value=\"answered\">Mark As Answered</option>");
			});
			</script>
		<?php
	}

	/*
	 * Show Feedback in "Right Now"
	 *
	 * @since 1.0
	 */
	public function dashboard_glance() {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'contact-form' ) ) {
			foreach ( array( 'feedback' ) as $post_type ) {
				$num_posts = wp_count_posts( $post_type );
				$count_posts = ( isset( $num_posts->publish ) )? $num_posts->publish : '0';
				if ( $count_posts !== '0' ) {
					if ( 'feedback' == $post_type ) {
						$text = _n( '%s Message', '%s Messages', $count_posts );
					}
					$text = sprintf( $text, number_format_i18n( $count_posts ) );
					printf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', $post_type, $text );
				}
			}
		}
	}

	/*
	 * Custom Icon for Feedback in "Right Now"
	 *
	 * @since 1.0
	 */
	public function dashboard_glance_css() {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'contact-form' ) ) {
		?>
		<style type='text/css'>
			#adminmenu #menu-posts-feedback div.wp-menu-image:before, #dashboard_right_now li.feedback-count a:before {
				content: '\f466';
				margin-left: -1px;
			}
		</style>
		<?php
		}
	}

}

new LP_Jetpack_Feedback();