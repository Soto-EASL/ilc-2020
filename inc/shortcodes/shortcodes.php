<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
function ilc_vc_get_shortcodes() {
	$shortcodes = array(
		'ilc_button',
		'ilc_button_grid',
		'ilc_heading',
		'ilc_homepage_slider',
		'ilc_key_dates',
		'ilc_photo_video_carousel',
		'ilc_photo_video_carousel_item',
		'ilc_recent_news',
		'ilc_sitemap',
		'ilc_sponsors_carousel',
		'ilc_toggle_text',
		'ilc_yt_player',
	);

	return $shortcodes;
}

function ilc_vc_shortcodes() {
	$inc_dir       = get_stylesheet_directory() . '/inc';
	$shortcode_dir = $inc_dir . '/shortcodes';
	require_once $inc_dir . '/core/class-ilc-shortcode.php';

	$shortcodes = ilc_vc_get_shortcodes();
	foreach ( $shortcodes as $shortcode ) {
		$file_name  = str_replace( 'ilc_', '', $shortcode );
		$file_name  = str_replace( '_', '-', $file_name );
		$file_name  = strtolower( $file_name );
		$class_file = $shortcode_dir . "/{$file_name}/{$file_name}.php";
		$map_file   = $shortcode_dir . "/{$file_name}/map.php";
		if ( file_exists( $class_file ) ) {
			require_once $class_file;
		}
		if ( file_exists( $map_file ) ) {
			vc_lean_map( $shortcode, null, $map_file );
		}
	}
}

add_action( 'vc_after_mapping', 'ilc_vc_shortcodes', 10 );