<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name' => __( 'ILC Media Grid', 'ilc' ),
	'base' => 'ilc_media_grid',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'ilc_media_grid_item',
	),
	'category' => __( 'ILC', 'ilc' ),
	'description' => __( 'Display a photo/video grid.', 'ilc' ),
	'php_class_name' => 'ILC_Media_Grid',
	'js_view' => 'VcColumnView',
	'params' => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Items per row', 'ilc' ),
            'param_name'  => 'items_per_row',
            'std'         => '3',
            'value'       => array(
                __( '1', 'ilc' ) => '1',
                __( '2', 'ilc' ) => '2',
                __( '3', 'ilc' ) => '3',
                __( '4', 'ilc' ) => '4',
                __( '5', 'ilc' ) => '5',
                __( '6', 'ilc' ) => '6',
            ),
            'admin_label' => true,
        ),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
);
