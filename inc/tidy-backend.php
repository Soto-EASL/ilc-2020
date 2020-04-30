<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


function ilc_change_pt_labels_post( $labels ) {
	$labels = array(
		'name'                  => _x( 'News', 'post type general name' ),
		'singular_name'         => _x( 'News', 'post type singular name' ),
		'add_new'               => _x( 'Add New', 'post' ),
		'add_new_item'          => __( 'Add New News' ),
		'edit_item'             => __( 'Edit News' ),
		'new_item'              => __( 'New News' ),
		'view_item'             => __( 'View News' ),
		'view_items'            => __( 'View News' ),
		'search_items'          => __( 'Search News' ),
		'not_found'             => __( 'No news found.' ),
		'not_found_in_trash'    => __( 'No news found in Trash.' ),
		'all_items'             => __( 'All News' ),
		'archives'              => __( 'News Archives' ),
		'attributes'            => __( 'News Attributes' ),
		'insert_into_item'      => __( 'Insert into news' ),
		'uploaded_to_this_item' => __( 'Uploaded to this news' ),
		'filter_items_list'     => __( 'Filter news list' ),
		'items_list_navigation' => __( 'News list navigation' ),
		'items_list'            => __( 'News list' ),
		'menu_name'             => _x( 'News', 'post type general name' ),
		'name_admin_bar'        => _x( 'News', 'add new from admin bar' ),
	);

	return $labels;
}

add_filter( 'post_type_labels_post', 'ilc_change_pt_labels_post', 10 );

/**
 * menu Order
 */
add_filter( 'custom_menu_order', '__return_true' );

function ilc_admin_menu_change() {
	global $menu, $submenu, $pagenow, $title;
	// Rename menu
	$to_rename = array(
		//'revslider' => 'Homepage Sliders'
		'vc-general' => 'Page Builder'
	);
	$to_hide   = array(
		'vc-general' => array(
			'vc-general',
			'vc-roles',
			'vc-updater',
			'vc-automapper',
			'templatera',
			'edit.php?post_type=vc_grid_item',
			'vc-welcome',
		),
		'edit.php?post_type=acf-field-group' => 'edit.php?post_type=acf-field-group'
	);
	if ( 12 == get_current_user_id() ) {
		$to_hide = array();
	}
	foreach ( $menu as $id => $data ) {
		if ( isset( $to_rename[ $data[2] ] ) ) {
			$menu[ $id ][0] = $to_rename[ $data[2] ];
			$menu[ $id ][3] = $to_rename[ $data[2] ];
		}
		if ( array_key_exists( $data[2], $to_hide ) ) {
			if ( is_array( $to_hide[ $data[2] ] ) ) {
				if ( $submenu[ $data[2] ] ) {
					foreach ( $submenu[ $data[2] ] as $sm_id => $sm_data ) {
						if ( in_array( $sm_data[2], $to_hide[ $data[2] ] ) ) {
							unset( $submenu[ $data[2] ][ $sm_id ] );
						}
					}
				}
			} else {
				unset( $menu[ $id ] );
			}
		}
	}
}

add_action( 'admin_menu', 'ilc_admin_menu_change', 200 );

function ilc_amdin_menu_order( $menu_order ) {
	$separator1_position = array_search( 'separator1', $menu_order );
	if ( 'false' === $separator1_position ) {
		$separator1_position = 1;
	}
	$front_end_menus = array(
		'edit.php?post_type=hp_slider', // Home page sliders
		//'revslider', // Home page sliders
		'edit.php?post_type=key_date', // Key Date
		'edit.php',// News/posts
		'edit.php?post_type=page', // Pages
		'vc-general', // Page Builder
		'edit.php?post_type=ilc_sponsor', // Sponsors
		'ilc-settings', // Home page sliders
	);
	foreach ( $front_end_menus as $menu_id ) {
		$position = array_search( $menu_id, $menu_order );
		if ( 'false' != $position ) {
			unset( $menu_order[ $position ] );
		}
	}
	array_splice( $menu_order, $separator1_position, 0, $front_end_menus );

	return $menu_order;

}

add_filter( 'menu_order', 'ilc_amdin_menu_order' );

/**
 * WP Bakery Page Builder
 */
function ilc_backend_enqueue_editor_css_js() {
	wp_enqueue_style( 'ilc-jscomposers', get_stylesheet_directory_uri() . '/assets/css/admin/js-composer.css', array(), time() );
	wp_enqueue_script( 'ilc-jscomposers', get_stylesheet_directory_uri() . '/assets/js/admin/js-composer.js', array(), time(), true );
}

add_action( 'vc_backend_editor_enqueue_js_css', 'ilc_backend_enqueue_editor_css_js' );