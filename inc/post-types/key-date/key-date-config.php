<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
// Include helper functions first so we can use them in the class and other key dates related functions
require_once get_theme_file_path( 'inc/post-types/key-date/key-date-helper.php' );

class ILC_Key_Date_Config {
	protected static $slugs = array(
		'type'     => 'key_date',
		'category' => 'key_date_category',
	);

	/**
	 * Get thing started
	 */
	public function __construct() {
		// Adds the portfolio post type
		add_action( 'init', array( 'ILC_Key_Date_Config', 'register_post_type' ), 0 );
		// Register event topics
		add_action( 'init', array( 'ILC_Key_Date_Config', 'register_category' ), 0 );
		if ( is_admin() ) {
			add_filter( 'manage_' . self::get_type_slug() . '_posts_columns', array( $this, 'extra_columns' ) );
			add_action( 'manage_' . self::get_type_slug() . '_posts_custom_column', array(
				$this,
				'extra_columns_value'
			), 100, 2 );
		}
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
	public static function register_post_type() {
		register_post_type( self::get_type_slug(), array(
			'labels'              => array(
				'name'               => __( 'Key Date', 'total-child' ),
				'singular_name'      => __( 'Key Date', 'total-child' ),
				'add_new'            => __( 'Add New', 'total-child' ),
				'add_new_item'       => __( 'Add New Key Date', 'total-child' ),
				'edit_item'          => __( 'Edit Key Date', 'total-child' ),
				'new_item'           => __( 'Add New Key Date', 'total-child' ),
				'view_item'          => __( 'View Key Date', 'total-child' ),
				'search_items'       => __( 'Search Key Dates', 'total-child' ),
				'not_found'          => __( 'No Key Dates Found', 'total-child' ),
				'not_found_in_trash' => __( 'No Key Dates Found In Trash', 'total-child' )
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
			'menu_icon'           => 'dashicons-calendar-alt',
			'supports'            => array(
				'title',
				'author',
			),
			'rewrite'             => false,
		) );
	}

	/**
	 * Register Key Date Category.
	 *
	 * @since 2.0.0
	 */
	public static function register_category() {
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

	public function extra_columns( $columns = array() ) {
		$columns['kd_date'] = 'Keydate Date';

		return $columns;
	}

	public function extra_columns_value( $column, $post_id ) {
		$value = '';
		switch ( $column ) {
			case 'kd_date':
				$value = get_field( 'keydate_start_date', $post_id );
				break;
		}

		echo $value;
	}
}

new ILC_Key_Date_Config();