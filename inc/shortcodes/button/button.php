<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ILC_VC_Button extends ILC_Shortcode {
	public static function get_color_class( $color ) {
		$colors = array(
			'primary',
			'secondary',
		);
		if ( ! in_array( $color, $colors ) ) {
			$color = 'primary';
		}

		return 'ilc-btn-' . $color;
	}

	public static function get_size_class( $size ) {
		$sizes = array(
			'small',
			'medium',
			'large',
			'fullwidth',
		);
		if ( ! in_array( $size, $sizes ) ) {
			$size = 'small';
		}

		return 'ilc-btn-' . $size;
	}

	public static function get_align_class( $align ) {
		$alings = array(
			'inline',
			'left',
			'center',
			'right',
		);
		if ( ! in_array( $align, $alings ) ) {
			$align = 'inline';
		}

		return 'ilc-btn-' . $align;
	}
}

