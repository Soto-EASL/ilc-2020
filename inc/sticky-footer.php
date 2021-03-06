<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function ilc_sticky_footer() {
	$enabled        = get_field( 'footer_sticky_msg_enable', 'option' );
	$sticky_message = get_field( 'footer_stikcy_msg', 'option' );
	$closed_for_IP  = ilc_footer_message_is_closed();
	if ( ! $enabled || ! $sticky_message || $closed_for_IP ) {
		return '';
	}
	$template = locate_template('partials/footer/sticky-message.php');

	if(!$template){
		return '';
	}
	include $template;
}

function ilc_footer_message_is_closed() {
	$ips = get_option( 'ilc_footer_message_closed_ip' );
	if ( ! is_array( $ips ) ) {
		return false;
	}
	$current_ip = ilc_get_visitorIP();
	if ( ! $current_ip ) {
		return false;
	}
	if ( in_array( $current_ip, $ips ) ) {
		return true;
	}

	return false;
}

function ilc_footer_message_save_closed() {
	$ips = get_option( 'ilc_footer_message_closed_ip' );
	if ( ! is_array( $ips ) ) {
		$ips = array();
	}
	$current_ip = ilc_get_visitorIP();
	if ( ! $current_ip ) {
		return false;
	}
	if ( in_array( $current_ip, $ips ) ) {
		return true;
	}
	$ips[] = $current_ip;
	update_option( 'ilc_footer_message_closed_ip', $ips );

	return true;
}

function ilc_get_visitorIP() {
	$ip = '';
	if ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		if ( strpos( $_SERVER['HTTP_X_FORWARDED_FOR'], ',' ) > 0 ) {
			$ip = explode( ",", $_SERVER['HTTP_X_FORWARDED_FOR'] );
			$ip = trim( $ip[0] );
		} else {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
		return $ip;
	}

	return false;
}

function ilc_save_closed_footer_message() {
	$result = ilc_footer_message_save_closed();
	if ( $result ) {
		wp_send_json( array( 'status' => 'OK' ) );
	}
	wp_send_json( array( 'status' => 'NO' ) );
}

add_action( 'wp_ajax_ilc_save_closed_footer_message', 'ilc_save_closed_footer_message' );
add_action( 'wp_ajax_nopriv_ilc_save_closed_footer_message', 'ilc_save_closed_footer_message' );
