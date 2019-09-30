<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
function ilc_acf_register_fields($version = false){
	require_once get_stylesheet_directory() . '/inc/acf-fields/nav-menu-selector/nav-menu-selector.php';
}
add_action('acf/include_field_types', 'ilc_acf_register_fields');