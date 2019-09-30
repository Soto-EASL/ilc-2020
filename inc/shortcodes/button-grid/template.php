<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $align
 * @var $el_class
 * @var $el_id
 * @var $content
 * Shortcode class ILC_VC_Button_Grid
 * @var $this ILC_VC_Button_Grid
 */
$align = $el_class = $el_id = $css_animation = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! in_array( $align, array( 'left', 'right', 'center', 'space_between' ) ) ) {
	$align = 'left';
}

ILC_VC_Button_Grid::$active = true;
$buttons_html               = wpb_js_remove_wpautop( $content, false );
ILC_VC_Button_Grid::$active = false;

$class_to_filter = 'wpb_ilc_button_grid wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->ilcGtSettings('base'), $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}

if ( $buttons_html ):
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ) ?>>
        <div class="ilc-btn-grid ilc-btn-grid-align-<?php echo $align; ?>">
			<?php echo $buttons_html ?>
        </div>
    </div>
<?php endif; ?>