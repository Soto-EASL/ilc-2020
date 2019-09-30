<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'           => __( 'ILC Button', 'ilc' ),
	'base'           => 'ilc_button',
	'category'       => __( 'ILC', 'ilc' ),
	'description'    => __( 'Add a button', 'ilc' ),
	'icon'           => 'vcex-icon ticon ticon-external-link-square',
	'php_class_name' => 'ILC_VC_Button',
	'params'         => array(
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Title', 'ilc' ),
			'param_name'  => 'title',
			'description' => __( 'Enter button title.', 'ilc' ),
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'URL', 'ilc' ),
			'param_name'  => 'url',
			'description' => __( 'Enter button URL.', 'ilc' ),
			'admin_label' => true,
		),
		array(
			'type'       => 'vcex_ofswitch',
			'std'        => 'false',
			'heading'    => __( 'Open in New Tab', 'ilc' ),
			'param_name' => 'new_tab',
		),
		array(
			'type'       => 'vcex_ofswitch',
			'std'        => 'false',
			'heading'    => __( 'Downloadable', 'ilc' ),
			'param_name' => 'downloadable',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Color', 'ilc' ),
			'param_name'  => 'color',
			'std'         => 'primary',
			'value'       => array(
				__( 'Primary(Light Blue)', 'ilc' )  => 'primary',
				__( 'Secondary(Deep Blue)', 'ilc' ) => 'secondary',
			),
			'admin_label' => true,
		),
		vc_map_add_css_animation(),
		array(
			'type'        => 'el_id',
			'heading'     => __( 'Element ID', 'ilc' ),
			'param_name'  => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'ilc' ),
			'param_name'  => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'ilc' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'js_composer' ),
		),
	),
);
