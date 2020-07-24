<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $items_per_row
 * @var $atts
 * @var $align
 * @var $el_class
 * @var $el_id
 * @var $content
 * Shortcode class ILC_Media_Grid
 * @var $this ILC_Media_Grid
 */
$el_class      = $el_id = $css_animation = '';
$items_per_row = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items_per_row = absint( $items_per_row );
if ( ! $items_per_row ) {
    $items_per_row = 3;
}

ILC_Media_Grid::$count_items = 0;
ILC_Media_Grid::set_ILC_instance_count();

$items_html = wpb_js_remove_wpautop( $content, false );

$class_to_filter = 'wpb_ilc_media_grid wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->ilcGtSettings( 'base' ), $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( $css_class ) {
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}
$grid_attributes   = array();
$grid_attributes[] = 'class="ilc-media-grid ilc-media-grid-col-' . $items_per_row . '"';


if ( ILC_Media_Grid::$count_items > 0 ):
    wpex_enqueue_lightbox_scripts();
    ?>
    <div <?php echo implode( ' ', $wrapper_attributes ) ?>>
        <div <?php echo implode( ' ', $grid_attributes ) ?>>
            <?php echo $items_html; ?>
        </div>
    </div>
<?php
endif;
ILC_Media_Grid::$count_items = 0;
?>