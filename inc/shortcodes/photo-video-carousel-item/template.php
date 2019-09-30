<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_id
 * @var $css_class
 * Shortcode class ILC_Photo_Video_Carousel_Item
 * @var $this ILC_Photo_Video_Carousel_Item
 */


$el_id    = '';
$el_class = '';

$caption     = '';
$type        = '';
$grid_image  = '';
$large_image = '';
$video_link  = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$css_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->ilcGtSettings( 'base' ), $atts );
$css_class .= ' wpex-carousel-slide ilc-pv-carousel-item ilc-pv-carousel-item-' . $type . ' clr';


$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . $css_class . '"';
}

$lightbox_gallery_id = 'ilc-lb-gallery-' . ILC_Photo_Video_Carousel::get_ILC_instance_count();

$grid_image  = wp_get_attachment_image_url( $grid_image, 'full' );
$large_image = wp_get_attachment_image_url( $large_image, 'full' );

$data_ok = true;

if ( ! $grid_image ) {
	$data_ok = false;
}
if ( ! $large_image ) {
	$large_image = $grid_image;
}

$link_href = '';
if ( $type == 'video' ) {
	if ( $video_link ) {
		$link_href = $video_link;
	} else {
		$data_ok = false;
	}
} elseif ( $type == 'photo' ) {
	$link_href = $large_image;
}

if ( $data_ok ) :
	ILC_Photo_Video_Carousel::$count_items ++;
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <div class="ilc-pv-carousel-item-inner">
            <a class="ilc-pv-carousel-item-link" href="<?php echo $link_href; ?>" data-fancybox="<?php echo $lightbox_gallery_id; ?>">
                <img src="<?php echo $grid_image; ?>" alt="">
				<?php if ( $caption ): ?><span><?php echo $caption; ?></span><?php endif; ?>
            </a>
        </div>
    </div>
<?php endif; ?>
