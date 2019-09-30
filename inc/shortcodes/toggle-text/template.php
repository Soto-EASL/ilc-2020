<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class ILC_VC_Heading
 * @var $this ILC_VC_Heading
 */
$el_class      = '';
$el_id         = '';
$css           = '';
$css_animation = '';
$more_text     = '';
$less_text     = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation   = $this->getCSSAnimation( $css_animation );
$class_to_filter = '';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$css_class = 'ilc-toggle-text-wrap ' . $css_class;

$wrapper_attributes = array();
if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}
$wrapper_attributes[] = 'class="' . $css_class . '"';
$wrapper_attributes   = implode( ' ', $wrapper_attributes );


if ( $content ):
	?>
    <div <?php echo $wrapper_attributes; ?>>
        <div class="ilc-toggle-text"><?php echo wpb_js_remove_wpautop( $content, false ); ?></div>
        <span class="ilc-toggle-text-trigger" data-more="<?php echo esc_attr( $more_text ); ?>" data-less="<?php echo esc_attr( $less_text ); ?>"><?php echo $more_text; ?></span>
    </div>
<?php endif; ?>