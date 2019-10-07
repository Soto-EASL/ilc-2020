<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class ILC_VC_Key_Dates
 * @var $this ILC_VC_Key_Dates
 */
$widget_title           = '';
$include_categories     = '';
$limit                  = '';
$order                  = '';
$orderby                = '';
$display_type           = '';
$diaplay_bototm_content = '';
$hide_expired           = '';
$el_class               = '';
$el_id                  = '';
$css                    = '';
$css_animation          = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! in_array( $display_type, array( 'table', 'list', 'message_box' ) ) ) {
	$display_type = 'list';
}

$css_animation   = $this->getCSSAnimation( $css_animation );
$class_to_filter = 'ilc-key-dates wpb_content_element ';

$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->ilcGtSettings( 'base' ), $atts );

$css_class .= ' ilc-key-dates-' . $display_type;

if ( $diaplay_bototm_content == 'true' ) {
	$css_class .= ' ilc-key-dates-has-bottom-con';
}

$wrapper_attributes = array();
if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}

// Build Query args
$limit = absint( $limit );
if ( ! $limit ) {
	$limit = - 1;
}

if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
	$order = 'ASC';
}

$query_args = array(
	'post_type'      => ILC_Key_Date_Config::get_type_slug(),
	'posts_per_page' => $limit,
	'order'          => $order
);

if ( $orderby == 'start_date' ) {
	$query_args['meta_key'] = 'keydate_start_date';
	$query_args['orderby']  = 'meta_value_num';
}
if ( $orderby == 'title' ) {
	$query_args['orderby'] = 'title';
}
$today = date( 'Ymd' );

if ( 'true' == $hide_expired ) {
	$query_args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key'     => 'keydate_start_date',
			'value'   => $today,
			'compare' => '>=',
			'type'    => 'NUMERIC',
		),
		array(
			'key'     => 'keydate_expiry_date',
			'value'   => $today,
			'compare' => '>=',
			'type'    => 'NUMERIC',
		),
	);
}

$include_categories = $this->string_to_array( $include_categories );

if ( count( $include_categories ) > 0 ) {
	$query_args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => ILC_Key_Date_Config::get_category_slug(),
			'field'    => 'term_id',
			'terms'    => $include_categories,
			'operator' => 'IN',
		)
	);
}

$kd_query = new WP_Query( $query_args );

if ( $kd_query->have_posts() ):

	?>
    <div class=" <?php echo esc_attr( $css_class ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<?php if ( $widget_title ): ?>
            <div class="ilc-heading-wrap ilc-color-secondary">
                <h3 class="ilc-heading"><?php echo $widget_title; ?></h3>
            </div>
		<?php endif; ?>
        <div class="ilc-key-dates-inner">
            <div class="ilc-key-dates-list">
				<?php if ( $display_type == 'message_box' ): ?>
                    <div class="ilc-key-dates-mbicon"><i class="ticon ticon-calendar"></i></div>
				<?php elseif ( $display_type == 'table' ): ?>
                <table class="table-bordered table-light-blue">
					<?php else: ?>
                    <ul>
						<?php endif; ?>
						<?php
						while ( $kd_query->have_posts() ) {
							$kd_query->the_post();
							get_template_part( 'partials/keydates/loop', $display_type );
						}
						wp_reset_query();
						?>
						<?php if ( $display_type == 'message_box' ): ?>

						<?php elseif ( $display_type == 'table' ): ?>
                </table>
			<?php else: ?>
                </ul>
			<?php endif; ?>
            </div>
			<?php if ( $diaplay_bototm_content == 'true' ): ?>
                <div class="ilc-key-dates-bototm-content">
					<?php echo wpb_js_remove_wpautop( $content ); ?>
                </div>
			<?php endif; ?>
        </div>
    </div>

<?php endif; ?>