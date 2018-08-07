<?php
/**
 * Plugin Name: Listicles for Gutenberg
 * Plugin URI: https://github.com/ipstenu/listicles-gutenberg/
 * Description: Listicles creates a Gutenberg Block for generating listicles in posts.
 * Author: ipstenu
 * Author URI: https://halfelf.org/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
