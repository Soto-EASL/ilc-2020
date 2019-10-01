<?php
define( 'ILC_THEME_VERSION', '2020.1' );


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

function ilcmh_set_restricted_access() {
	if ( ! empty( $_POST['ilcmh_pass'] ) ) {

		$allowed_passwords = array( 'ILC2020!**' );
		if ( ! in_array( $_POST['ilcmh_pass'], $allowed_passwords ) ) {
			wp_redirect( add_query_arg( array( 'ilc_wrong_pass', 1 ), get_site_url() ) );
			die();

		}
		setcookie( 'ilc_non_admin_allow_access', 'yes', time() + 7 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, true, true );

		wp_redirect( get_site_url() );
		exit();
	}
	if ( ! empty( $_GET['ilc_clear_rs_cookie'] ) ) {
		setcookie( 'ilc_non_admin_allow_access', 'yes', time() - 7 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, true, true );
		wp_redirect( get_site_url() );
		exit();
	}
}

add_action( 'init', 'ilcmh_set_restricted_access' );


function ilcmh_load_landing_page() {
	if ( is_user_logged_in() ) {
		return;
	}
	if ( empty( $_COOKIE['ilc_non_admin_allow_access'] ) || 'yes' != $_COOKIE['ilc_non_admin_allow_access'] ) {
		get_template_part( 'ilc-landing-page' );
		die();
	}
}

add_action( 'template_redirect', 'ilcmh_load_landing_page' );

function ilc_f___the_browser_cache( $src, $handle ) {
	if ( ! in_array( $handle, array( 'wpex-style', 'ilc-youtube-player-scripts', 'ilc-custom' ) ) ) {
		return $src;
	}

	return add_query_arg( 'ver', ILC_THEME_VERSION, $src );
}

function ilc_conditional_actions_init(){
	$site_url = get_site_url();
	if(false !== strpos($site_url, 'stage.ilc-congress.eu')){
		add_filter( 'style_loader_src', 'ilc_f___the_browser_cache', 20, 2 );
		add_filter( 'script_loader_src', 'ilc_f___the_browser_cache', 20, 2 );

	}
}
add_action('init', 'ilc_conditional_actions_init');



