<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'                    => __( 'Sponsors Carousel', 'ilc' ),
	'base'                    => 'ilc_sponsors_carousel',
	'icon'                    => 'vcex-icon-box vcex-icon ticon ticon-caret-square-o-right',
	'is_container'            => false,
	'show_settings_on_create' => false,
	'category'                => __( 'ILC', 'ilc' ),
	'description'             => __( 'Display sponsors carousel.', 'ilc' ),
	'php_class_name'          => 'ILC_VC_Sponsors_Carousel',
	'params'                  => array(
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Items (desktop)', 'ilc' ),
			'param_name'  => 'items',
			'std'         => '5',
			'value'       => array(
				'2'  => '2',
				'3'  => '3',
				'4'  => '4',
				'5'  => '5',
				'6'  => '6',
			),
			'admin_label' => true,
		),
		vc_map_add_css_animation(),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Element ID', 'js_composer' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'js_composer' ),
			'param_name'  => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'js_composer' ),
		),
	),
);
