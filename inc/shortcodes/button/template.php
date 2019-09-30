<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $url
 * @var $new_tab
 * @var $downloadable
 * @var $color
 * @var $el_id
 * @var $css
 * Shortcode class ILC_VC_Button
 * @var $this ILC_VC_Button
 */
$title        = '';
$url          = '';
$new_tab      = '';
$downloadable = '';
$color        = '';

$el_id = $el_class = $css_animation = $css = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$title = trim( $title );
$title = wp_kses( $title, array(
	'span'   => array(
		'class' => array(),
		'style' => array(),
	),
	'em'     => array(),
	'strong' => array(),
	'br'     => array(),
) );
$url   = trim( $url );

if ( $title && $url ) :
	$button_classes = array( 'ilc-btn' );

	$button_classes[] = ILC_VC_Button::get_color_class( $color );

	$css_class = $this->getCSSAnimation( $css_animation );
	$css_class .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->ilcGtSettings('base'), $atts );

	if ( $css_class ) {
		$button_classes[] = $css_class;
	}

	$wrapper_attributes = array();
	if ( ! empty( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}

	if ( $new_tab == 'true' ) {
		$wrapper_attributes[] = 'target="_blank"';
	}

	if ( $downloadable == 'true' ) {
		$wrapper_attributes[] = 'download="download"';
		$button_classes[]     = 'ilc-btn-download';
	}

	if ( count( $button_classes ) > 0 ) {
		$wrapper_attributes[] = 'class="' . implode( ' ', $button_classes ) . '"';
	}

	$wrapper_attributes[] = 'href="' . esc_url( $url ) . '"';
	?>
    <a <?php echo implode( ' ', $wrapper_attributes ); ?>><span><?php echo $title; ?></span></a>
<?php endif; ?>
