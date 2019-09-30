<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'ILC 2020 Settings',
		'menu_slug'  => 'ilc-settings',
		'capability' => 'manage_options',
		'redirect'   => false,
	) );
}