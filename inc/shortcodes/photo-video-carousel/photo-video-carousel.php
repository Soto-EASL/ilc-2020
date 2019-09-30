<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ILC_Photo_Video_Carousel extends ILC_Shortcode_Container {
	public static $count_items = 0;
	private static $instance_count = 0;

	public static function reset_items() {
		self::$count_items = 0;
	}

	public static function get_ILC_instance_count() {
		return self::$instance_count;
	}

	public static function set_ILC_instance_count() {
		return self::$instance_count ++;
	}
}
