<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
add_filter( 'wpex_metaboxes', '__return_false' );

remove_action( 'wpex_outer_wrap_before', 'wpex_skip_to_content_link' );

function ilc_body_class( $classes ) {
	if ( ! in_array( 'wpex-has-fixed-footer', $classes ) ) {
		$classes[] = 'wpex-has-fixed-footer';
	}

	return $classes;
}

add_filter( 'body_class', 'ilc_body_class' );

function ilc_hide_page_headers_for_pages( $display ) {
	if ( is_front_page() ) {
		$display = false;
	}

	return $display;
}

add_filter( 'wpex_display_page_header', 'ilc_hide_page_headers_for_pages' );

function ilc_template_parts( $parts ) {
	$parts['topbar_countdown'] = 'partials/topbar/topbar-countdown';

	return $parts;
}

add_filter( 'wpex_template_parts', 'ilc_template_parts' );

function ilc_remove_parents_action() {
	// Remove logo from navigation row
	remove_action( 'wpex_hook_header_inner', 'wpex_header_logo' );
}

add_action( 'template_redirect', 'ilc_remove_parents_action' );

function ilc_show_breadcrumbs() {
	if ( ! is_front_page() ) {
		get_template_part( 'partials/breadcrumbs-wrap' );
	}
}

add_action( 'wpex_hook_main_top', 'ilc_show_breadcrumbs', 5 );

function ilc_page_header_bg_open() {
	get_template_part( 'partials/page-header-bg-open' );
}

function ilc_page_header_bg_close() {
	get_template_part( 'partials/page-header-bg-close' );
}

add_action( 'wpex_hook_page_header_top', 'ilc_page_header_bg_open', 1 );
add_action( 'wpex_hook_page_header_bottom', 'ilc_page_header_bg_close', 100 );

function ilc_page_header_title( $args, $instance ) {
	if ( 'singular_page' != $instance ) {
		return $args;
	}
	$page_alternative_title = get_field( 'page_alternative_title', wpex_get_current_post_id() );
	if ( ! $page_alternative_title ) {
		return $args;
	}
	$args['string'] = $page_alternative_title;

	return $args;
}

add_filter( 'wpex_page_header_title_args', 'ilc_page_header_title', 20, 2 );

function ilc_side_menu_page_wrap_open() {
	if ( ! is_page() ) {
		return;
	}
	$page_id            = wpex_get_current_post_id();
	$page_has_side_menu = get_field( 'page_has_side_menu', $page_id );
	$page_side_menu     = get_field( 'page_side_menu', $page_id );
	if ( ! $page_has_side_menu || ! $page_side_menu ) {
		return;
	}
	get_template_part( 'partials/side-menu-wrap-open' );
}

function ilc_side_menu_page_wrap_close() {
	if ( ! is_page() ) {
		return;
	}
	$page_id            = wpex_get_current_post_id();
	$page_has_side_menu = get_field( 'page_has_side_menu', $page_id );
	$page_side_menu     = get_field( 'page_side_menu', $page_id );
	if ( ! $page_has_side_menu || ! $page_side_menu ) {
		return;
	}
	get_template_part( 'partials/side-menu-wrap-close' );
}

add_action( 'wpex_hook_content_before', 'ilc_side_menu_page_wrap_open', 1 );
add_action( 'wpex_hook_content_after', 'ilc_side_menu_page_wrap_close', 100 );


function easl_vc_add_params() {
	vc_add_params( 'vc_single_image', array(
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Over Image Link Text', 'total' ),
			'param_name'  => 'img_over_link_text',
			'description' => __( 'Use this field to add a overlay caption with link', 'total' ),
			'group'       => __( 'Over Image Link', 'total' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Over Image Link', 'total' ),
			'param_name'  => 'img_over_link',
			'description' => __( 'Use this field to add a overlay caption with link', 'total' ),
			'group'       => __( 'Over Image Link', 'total' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Over ImageLink Target', 'js_composer' ),
			'param_name' => 'img_over_linktarget',
			'value'      => vc_target_param_list(),
			'group'      => __( 'Over Image Link', 'total' ),
		),
	) );
}

add_action( 'vc_after_init', 'easl_vc_add_params', 40 );

function ilc_page_content_top() {
	global $wp_query;
	if ( ! is_page() ) {
		return;
	}
	$page_id = $wp_query->get_queried_object_id();
	if ( 4931 == $page_id ) {
		?>
        <script type='text/javascript'>
            var axel = Math.random() + "";
            var a = axel * 10000000000000;
            document.write('<img src="https://pubads.g.doubleclick.net/activity;xsp=224439;ord=1;num=' + a + '?" width=1 height=1 border=0/>');
        </script>
		<?php
	}
}

add_action( 'wpex_hook_content_top', 'ilc_page_content_top' );


function ilc_header_follow_icons() {
	get_template_part( 'partials/follow-icons' );
}

add_action( 'wpex_hook_header_top', 'ilc_header_follow_icons', 2 );

/**
 * Display Social Share Icons
 */
function ilc_social_share_icons() {
	get_template_part( 'partials/social-shares-icons' );
}

function ilc_social_share_icons_row() {
	get_template_part( 'partials/social-shares-icons' );
}

add_action( 'wpex_hook_content_bottom', 'ilc_social_share_icons_row' );

function ilc_event_schema_json_ld() {
	if ( ! is_front_page() ) {
		return;
	}
	$data                     = array();
	$event_name               = get_field( 'ilc_event_name', 'option' );
	$event_tz_offset          = get_field( 'ilc_event_tz_offset', 'option' );
	$event_start_date         = get_field( 'ilc_event_start_date', 'option' );
	$event_end_date           = get_field( 'ilc_event_end_date', 'option' );
	$event_status             = get_field( 'ilc_event_status', 'option' );
	$event_prev_start_date    = get_field( 'ilc_event_prev_start_date', 'option' );
	$event_description        = get_field( 'ilc_event_description', 'option' );
	$event_loc_type           = get_field( 'ilc_event_loc_type', 'option' );
	$event_loc_url            = get_field( 'ilc_event_loc_url', 'option' );
	$event_loc_name           = get_field( 'ilc_event_loc_name', 'option' );
	$event_loc_street_address = get_field( 'ilc_event_loc_street_address', 'option' );
	$event_loc_locality       = get_field( 'ilc_event_loc_locality', 'option' );
	$event_loc_region         = get_field( 'ilc_event_loc_region', 'option' );
	$event_loc_postal_code    = get_field( 'ilc_event_loc_postal_code', 'option' );
	$event_loc_country        = get_field( 'ilc_event_loc_country', 'option' );
	$ilc_event_org_name       = get_field( 'ilc_event_org_name', 'option' );
	$ilc_event_org_url        = get_field( 'ilc_event_org_url', 'option' );
	$event_image_16x9         = get_field( 'ilc_event_image_16x9', 'option' );
	$event_image_4x3          = get_field( 'ilc_event_image_4x3', 'option' );
	$event_image_1x1          = get_field( 'ilc_event_image_1x1', 'option' );

	if ( ! $event_name || ! $event_start_date ) {
		return;
	}

	$location = array();
	if ( 'Virtual' == $event_loc_type && $event_loc_url ) {
		$location = array(
			'@type' => 'VirtualLocation',
			'url'   => esc_url( $event_loc_url ),
		);
	} elseif ( $event_loc_street_address || $event_loc_locality || $event_loc_region || $event_loc_country ) {
		$location['@type'] = 'Place';
		if ( $event_loc_name ) {
			$location['name'] = $event_loc_name;
		}
		if ( $event_loc_street_address ) {
			$location['streetAddress'] = $event_loc_street_address;
		}
		if ( $event_loc_locality ) {
			$location['addressLocality'] = $event_loc_locality;
		}
		if ( $event_loc_postal_code ) {
			$location['postalCode'] = $event_loc_postal_code;
		}
		if ( $event_loc_region ) {
			$location['addressRegion'] = $event_loc_region;
		}
		if ( $event_loc_country ) {
			$location['addressCountry'] = $event_loc_country;
		}
	}
	if ( ! $location ) {
		return;
	}

	$event_tz_offset = trim( $event_tz_offset );
	if ( ! $event_tz_offset ) {
		$event_tz_offset = '+00:00';
	}

	$data['@context']  = 'https://schema.org';
	$data['@type']     = 'Event';
	$data['name']      = $event_name;
	$data['startDate'] = $event_start_date . $event_tz_offset;
	if ( $event_end_date ) {
		$data['endDate'] = $event_end_date . $event_tz_offset;
	}
	if ( 'VirtualLocation' == $location['@type'] ) {
		$data['eventAttendanceMode'] = 'https://schema.org/OnlineEventAttendanceMode';
	} else {
		$data['eventAttendanceMode'] = 'https://schema.org/OfflineEventAttendanceMode';
	}
	if ( 'Cancelled' == $event_status ) {
		$data['eventStatus'] = 'https://schema.org/EventCancelled';
	} elseif ( 'Postponed' == $event_status ) {
		$data['eventStatus'] = 'https://schema.org/EventPostponed';
	} elseif ( 'Rescheduled' == $event_status ) {
		$data['eventStatus'] = 'https://schema.org/EventRescheduled';
		if ( $event_prev_start_date ) {
			$data['previousStartDate'] = $event_prev_start_date . $event_tz_offset;
		}
	} else {
		$data['eventStatus'] = 'https://schema.org/EventScheduled';
	}
	$data['location'] = $location;

	$images = array();
	if ( $event_image_1x1 ) {
		$images[] = $event_image_1x1;
	}
	if ( $event_image_4x3 ) {
		$images[] = $event_image_4x3;
	}
	if ( $event_image_16x9 ) {
		$images[] = $event_image_16x9;
	}
	if($images) {
	    $data['image'] = $images;
    }
	if ( $event_description ) {
		$data['description'] = $event_description;
	}
	if ( $ilc_event_org_name && $ilc_event_org_url ) {
		$data['organizer'] = array(
			'@type' => 'Organization',
			'name'  => $ilc_event_org_name,
			'url'   => esc_url( $ilc_event_org_url ),
		);
	}
	echo '<script type="application/ld+json">' . json_encode( $data,  JSON_UNESCAPED_SLASHES ) . '</script>';
}

add_action( 'wp_head', 'ilc_event_schema_json_ld', 1 );