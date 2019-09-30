<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ILC_acf_plugin_menu_selector extends acf_field {
	function __construct( $settings ) {

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'ilc_menu_selector';


		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __( 'ILC Menu Selector', 'ilc' );


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'relational';


		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->defaults = array(
			'menu_id' => false,
		);


		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/

		$this->l10n = array(
			'error' => __( 'Error! Please select a menu.', 'ilc' ),
		);


		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/

		$this->settings = $settings;


		// do not delete!
		parent::__construct();

	}


	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field_settings( $field ) {

		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

		//acf_render_field_setting( $field);
	}


	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/

	function render_field( $field ) {

		
		/*
		*  Create a simple text input using the 'font_size' setting.
		*/
		$menus = wp_get_nav_menus();
		if ( ! $menus ) {
			$menus = array();
		}
		?>
        <select name="<?php echo esc_attr( $field['name'] ) ?>">
            <option value="">Select a menu</option>
			<?php foreach ( $menus as $menu ) : ?>
                <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $field['value'], $menu->term_id ); ?>>
					<?php echo esc_html( $menu->name ); ?>
                </option>
			<?php endforeach; ?>
        </select>
		<?php
	}
}

new ILC_acf_plugin_menu_selector( array(
	'version' => '1.0.0',
	'url'     => get_stylesheet_directory_uri() . '/inc/acf-fields/nav-menu-selector',
	'path'    => get_stylesheet_directory() . '/inc/acf-fields/nav-menu-selector'
) );
