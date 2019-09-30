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
 * Shortcode class ILC_Photo_Video_Carousel
 * @var $this ILC_Photo_Video_Carousel
 */
$el_class = $el_id = $css_animation = '';


$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


ILC_Photo_Video_Carousel::$count_items = 0;
ILC_Photo_Video_Carousel::set_ILC_instance_count();

$items_html = wpb_js_remove_wpautop( $content, false );

$class_to_filter = 'wpb_ilc_photo_video_carousel wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->ilcGtSettings( 'base' ), $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}
$car_wrapper_attributes   = array();
$car_wrapper_attributes[] = 'class="wpex-carousel ilc-carousel owl-carousel clr"';

$carousel_options         = array(
	'arrows'                 => true,
	'dots'                   => 'false',
	'auto_play'              => 'false',
	'infinite_loop'          => true,
	'center'                 => 'false',
	'animation_speed'        => 150,
	'items'                  => 3,
	'items_scroll'           => 1,
	'timeout_duration'       => 5000,
	'items_margin'           => 4,
	'tablet_items'           => 2,
	'mobile_landscape_items' => 1,
	'mobile_portrait_items'  => 1,
);
$car_wrapper_attributes[] = 'data-wpex-carousel="' . vcex_get_carousel_settings( $carousel_options, 'ilc_photo_video_carousel' ) . '"';


if ( ILC_Photo_Video_Carousel::$count_items > 0 ):
	wpex_enqueue_lightbox_scripts();
	vcex_enqueue_carousel_scripts();
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ) ?>>
        <div <?php echo implode( ' ', $car_wrapper_attributes ) ?>>
			<?php echo $items_html; ?>
        </div>
    </div>
<?php
endif;
ILC_Photo_Video_Carousel::$count_items = 0;
?>