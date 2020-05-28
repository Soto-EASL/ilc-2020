<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if ( function_exists( 'acf_add_options_page' ) ) {
	$ilc_settings_top = acf_add_options_page( array(
		'page_title' => 'ILC 2020 Settings',
		'menu_slug'  => 'ilc-settings',
		'capability' => 'manage_options',
		'redirect'   => false,
	) );
	$ilc_settings_schema = acf_add_options_sub_page(array(
		'page_title'  => __('ILC 2020 Event Schema'),
		'menu_title'  => __('Event Schema'),
		'parent_slug' => $ilc_settings_top['menu_slug'],
		'capability' => 'manage_options',
		'redirect'   => false,
	));
}