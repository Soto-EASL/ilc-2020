<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'                    => __( 'ILC Homepage Slider', 'ilc' ),
	'base'                    => 'ilc_homepage_slider',
	'icon'                    => 'vcex-icon ticon ticon-film',
	'is_container'            => false,
	'show_settings_on_create' => false,
	'category'                => __( 'ILC', 'ilc' ),
	'description'             => __( 'Add a homepage slider.', 'ilc' ),
	'php_class_name'          => 'ILC_VC_Homepage_Slider',
	'params'                  => array(
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Homepage Slider', 'ilc' ),
			'param_name'  => 'slider_id',
			'value'       => ILC_VC_Homepage_Slider::get_homepage_sliders_dd(),
			'admin_label' => true,
		),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Element ID', 'total-child' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'total-child' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'total-child' ),
			'param_name'  => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total-child' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => __( 'CSS box', 'total-child' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'total-child' ),
		),
	),
);
