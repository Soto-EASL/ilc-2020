<?php
define( 'ILC_THEME_VERSION', '2020.1.2' );


require_once get_stylesheet_directory() . '/inc/post-types/post-types.php';
require_once get_stylesheet_directory() . '/inc/settings.php';
require_once get_stylesheet_directory() . '/inc/total-extend.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/dvgallery-extend.php';
require_once get_stylesheet_directory() . '/inc/sticky-footer.php';
require_once get_stylesheet_directory() . '/inc/acf-fields/fields.php';
require_once get_stylesheet_directory() . '/inc/tidy-backend.php';

function ilc_theme_setup() {
	load_theme_textdomain( 'ilc' );

	add_image_size( 'news_list', 256, 182, true );
	add_image_size( 'grid1-3c', 365, 225, true );
	add_image_size( 'news_single', 1125, 9999, false );
}

add_action( 'after_setup_theme', 'ilc_theme_setup' );
function total_child_enqueue_parent_theme_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'Total' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $version );

}

add_action( 'wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style' );

function total_child_custom_style() {

	// Load the stylesheet
	wp_enqueue_style( 'child-custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css' );

}

add_action( 'wp_enqueue_scripts', 'total_child_custom_style' );

function ilc_custom_scripts() {
	if ( wpex_get_mod( 'topbar_countdown_enable' ) ) {
		wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), '2.1.0', true );
	}
	wp_enqueue_script( 'ilc-custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), ILC_THEME_VERSION, true );
	$ssl_scheme     = is_ssl() ? 'https' : 'http';
	$fornt_end_data = array(
		'ajaxUrl' => admin_url( 'admin-ajax.php', $ssl_scheme ),
	);
	wp_localize_script( 'ilc-custom', 'ILC', $fornt_end_data );
}

add_action( 'wp_enqueue_scripts', 'ilc_custom_scripts' );

function ilc_admin_custom_scripts() {
	wp_enqueue_style( 'ilc-admin-common', get_stylesheet_directory_uri() . '/assets/css/admin/common.css' );
}

add_action( 'admin_enqueue_scripts', 'ilc_admin_custom_scripts' );

add_shortcode( 'soto_year', 'soto_sc_year' );
function soto_sc_year() {
	$year = date( 'Y' );

	return $year;
}



