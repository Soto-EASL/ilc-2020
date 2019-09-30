<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'           => __( 'ILC Photo Video Carousel Item', 'ilc' ),
	'base'           => 'ilc_photo_video_carousel_item',
	'as_child'       => array(
		'only' => 'ilc_photo_video_carousel',
	),
	'category'       => __( 'ILC', 'ilc' ),
	'description'    => __( 'Add a photo/video carousel', 'ilc' ),
	'icon'           => 'vcex-icon ticon ticon-film',
	'php_class_name' => 'ILC_Photo_Video_Carousel_Item',
	'params'         => array(
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Caption', 'ilc' ),
			'param_name'  => 'caption',
			'param_holder_class' => 'vc_col-sm-6',
			'description' => __( 'Enter button title.', 'ilc' ),
			'admin_label' => true,
			'group'       => __( 'Data', 'ilc' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'type', 'ilc' ),
			'param_name'  => 'type',
			'param_holder_class' => 'vc_col-sm-6',
			'std'         => 'photo',
			'value'       => array(
				__( 'Photo', 'ilc' ) => 'photo',
				__( 'Video', 'ilc' ) => 'video',
			),
			'admin_label' => true,
			'group'       => __( 'Data', 'ilc' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Grid Image', 'ilc' ),
			'param_name' => 'grid_image',
			'value' => '',
			'param_holder_class' => 'vc_col-sm-6',
			'description' => __( 'Select image from media library, this will be shown on carousel.', 'ilc' ),
			'admin_label' => false,
			'group'       => __( 'Data', 'ilc' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Large Image', 'ilc' ),
			'param_name' => 'large_image',
			'value' => '',
			'param_holder_class' => 'vc_col-sm-6',
			'description' => __( 'Select image from media library, this will be shown on lightbox.', 'ilc' ),
			'admin_label' => false,
			'dependency'  => array(
				'element' => 'type',
				'value'   => array( 'photo' ),
			),
			'group'       => __( 'Data', 'ilc' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Video Link', 'ilc' ),
			'param_name'  => 'video_link',
			'param_holder_class' => 'vc_col-sm-6',
			'description' => __( 'Enter video URL.', 'ilc' ),
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'type',
				'value'   => array( 'video' ),
			),
			'group'       => __( 'Data', 'ilc' ),
		),
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
	),
);
