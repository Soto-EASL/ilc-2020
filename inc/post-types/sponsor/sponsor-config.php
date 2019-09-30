<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ILC_Sponsor_Config {
	protected static $slugs = array(
		'type'     => 'ilc_sponsor',
		'category' => 'ilc_sponsor_category',
	);

	/**
	 * Get thing started
	 */
	public function __construct() {
		// Adds the portfolio post type
		add_action( 'init', array( $this, 'register_post_type' ), 0 );
		// Register event topics
		add_action( 'init', array( $this, 'register_category' ), 0 );
	}

	/**
	 * Get post type slug
	 * @return string
	 */
	public static function get_type_slug() {
		return self::$slugs['type'];
	}

	/**
	 * Get category slug
	 * @return string
	 */
	public static function get_category_slug() {
		return self::$slugs['category'];
	}

	/**
	 * Register post type.
	 *
	 * @since 2.0.0
	 */
	public function register_post_type() {
		register_post_type( self::get_type_slug(), array(
			'labels'              => array(
				'name'               => __( 'Sponsor', 'ilc' ),
				'singular_name'      => __( 'Sponsor', 'ilc' ),
				'add_new'            => __( 'Add New', 'ilc' ),
				'add_new_item'       => __( 'Add New Sponsor', 'ilc' ),
				'edit_item'          => __( 'Edit Sponsor', 'ilc' ),
				'new_item'           => __( 'Add New Sponsor', 'ilc' ),
				'view_item'          => __( 'View Sponsor', 'ilc' ),
				'search_items'       => __( 'Search Sponsors', 'ilc' ),
				'not_found'          => __( 'No Sponsors Found', 'ilc' ),
				'not_found_in_trash' => __( 'No Sponsors Found In Trash', 'ilc' )
			),
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'query_var'           => false,
			'capability_type'     => 'post',
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-heart',
			'supports'            => array(
				'title',
				'author',
			),
			'rewrite'             => false,
		) );
	}

	/**
	 * Register Sponsor Category.
	 *
	 * @since 2.0.0
	 */
	public function register_category() {
		$args = array(
			'labels'            => array(
				'name'                       => __( 'Category', 'total' ),
				'singular_name'              => __( 'Category', 'total' ),
				'menu_name'                  => __( 'Category', 'total' ),
				'search_items'               => __( 'Search', 'total' ),
				'popular_items'              => __( 'Popular', 'total' ),
				'all_items'                  => __( 'All', 'total' ),
				'parent_item'                => __( 'Parent', 'total' ),
				'parent_item_colon'          => __( 'Parent', 'total' ),
				'edit_item'                  => __( 'Edit', 'total' ),
				'update_item'                => __( 'Update', 'total' ),
				'add_new_item'               => __( 'Add New', 'total' ),
				'new_item_name'              => __( 'New', 'total' ),
				'separate_items_with_commas' => __( 'Separate with commas', 'total' ),
				'add_or_remove_items'        => __( 'Add or remove', 'total' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'total' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'show_tagcloud'     => false,
			'hierarchical'      => true,
			'rewrite'           => false,
			'query_var'         => false,
		);

		register_taxonomy( self::get_category_slug(), array( self::get_type_slug() ), $args );
	}

	/**
	 *
	 * @param type $array
	 * @param type $post
	 *
	 * @return type
	 */
	public static function meta_array( $array, $post ) {
		if ( self::get_type_slug() != get_post_type( $post ) ) {
			return $array;
		}
		$prefix                 = 'keydate_';
		$array                  = array();
		$array['key_date_data'] = array(
			'title'    => esc_html__( 'Sponsor Data', 'ilc' ),
			'settings' => array(
				'url'         => array(
					'title'       => esc_html__( 'URL', 'ilc' ),
					'id'          => $prefix . 'url',
					'type'        => 'text',
					'description' => esc_html__( 'Enter the url of this Sponsor.', 'ilc' ),
				),
				'start_date'  => array(
					'title'       => esc_html__( 'Start Date', 'ilc' ),
					'id'          => $prefix . 'date',
					'type'        => 'date',
					'description' => esc_html__( 'Enter the date of the Sponsor.', 'ilc' ),
				),
				'start_time'  => array(
					'title'       => esc_html__( 'Start Time', 'ilc' ),
					'id'          => $prefix . 'start_time',
					'type'        => 'text',
					'description' => esc_html__( 'Enter the start time of this Sponsor. If filled this will be displayed with End Time, eg. 04 February 2019 (10:00CET)', 'ilc' ),
				),
				'expiry_date' => array(
					'title'       => esc_html__( 'End Date', 'ilc' ),
					'id'          => $prefix . 'expiry_date',
					'type'        => 'date',
					'description' => esc_html__( 'Enter the end date of the Sponsor.', 'ilc' ),
				),
				'end_time'    => array(
					'title'       => esc_html__( 'End Time', 'ilc' ),
					'id'          => $prefix . 'end_time',
					'type'        => 'text',
					'description' => esc_html__( 'Enter the end time of this Sponsor. If filled this will be displayed with End Time, eg. 13 February 2019 (23:59CET)', 'ilc' ),
				),
				'alt_title'   => array(
					'title'         => esc_html__( 'Alternative Title', 'ilc' ),
					'id'            => $prefix . 'alt_title',
					'type'          => 'editor',
					'tiny'          => true,
					'row'           => 5,
					'media_buttons' => false,
					'description'   => esc_html__( 'Enter alternative title. Useful to add custom links to a word or few words. Leave empty to use main title. Allowed tags: a, span, em, strong.', 'ilc' ),
				),

			)
		);

		return $array;
	}
}

new ILC_Sponsor_Config();