<?php
/*
Plugin Name: CMB2 Add Ons
Description: Addons for CMB2 that make life worth living
Version: 1.0
Author: Mika Epstein
*/

/* CMB2 Grid */
define( 'CMB2GRID_DIR', WP_CONTENT_DIR . '/mu-plugins/cmb2/CMB2-grid/' );
include_once( dirname( __FILE__ ) . '/cmb2/CMB2-grid/Cmb2GridPluginLoad.php' );

/* Select2 */
include_once( dirname( __FILE__ ) . '/cmb2/cmb-field-select2/cmb-field-select2.php' );

add_filter( 'pw_cmb2_field_select2_asset_path', 'lezwatch_pw_cmb2_field_select2_asset_path' );
function lezwatch_pw_cmb2_field_select2_asset_path() {
	return WP_CONTENT_URL . '/mu-plugins/cmb2/cmb-field-select2/';
}

// href='https://lezwatchtv.lezpress.dev/wp-content/plugins/Users/ipstenu/Development/repositories/lezwatch-mu-plugins/cmb2/cmb-field-select2/css/select2.min.css