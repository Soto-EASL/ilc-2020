<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class ILC_VC_Recent_News
 * @var $this ILC_VC_Recent_News
 */

$title              = '';
$el_class           = '';
$el_id              = '';
$css_animation      = '';
$limit              = '';
$include_categories = '';
$exclude_categories = '';
$excerpt_length     = '';
$view_all_url       = '';
$view_all_text      = '';
$display_type       = '';
$grid_size          = '';
$show_excerpt       = '';
$show_pagination    = '';
$show_view_all      = '';


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$show_excerpt    = 'false' != $show_excerpt ? true : false;
$show_pagination = 'false' != $show_pagination ? true : false;
$show_view_all   = 'false' != $show_view_all ? true : false;

$include_categories = $this->string_to_array( $include_categories );
$exclude_categories = $this->string_to_array( $exclude_categories );
$excerpt_length     = absint( $excerpt_length );

if ( ! in_array( $display_type, array( 'list', 'grid' ) ) ) {
	$display_type = 'list';
}
$grid_size = absint( $grid_size );
if ( ! $grid_size ) {
	$grid_size = 3;
}


$class_to_filter = 'wpb_ilc_recent_news wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->ilcGtSettings( 'base' ), $atts );

$css_class .= " ilc-recent-news-{$display_type}";

if ( $display_type == 'grid' ) {
	$css_class .= " ilc-recent-news-grid-{$grid_size}";
}

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}
$view_all_text = strip_tags( $view_all_text );
if ( ! $view_all_text ) {
	$view_all_text = 'View all';
}
$view_all_html = '';
if ( $view_all_url ) {
	$view_all_html = '<a class="ilc-recent-news-view-all" href="' . esc_url( $view_all_url ) . '">' . $view_all_text . '</a>';
}

if ( ! $limit ) {
	$limit = - 1;
}

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'paged'          => $paged,
	'meta_query'     => array(
//		array(
//			'key'     => '_thumbnail_id',
//			'compare' => 'EXISTS'
//		),
	)
);
$tax_query  = array();
if ( $include_categories ) {
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $include_categories,
		'operator' => 'IN',
	);
}
if ( $exclude_categories ) {
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $exclude_categories,
		'operator' => 'NOT IN',
	);
}
if ( count( $tax_query ) > 0 ) {
	$tax_query['relation']   = 'AND';
	$query_args['tax_query'] = $tax_query;
}


$news_query = new WP_Query( $query_args );

if ( $news_query->have_posts() ):
	$pagination_html = paginate_links( array(
		'total'     => $news_query->max_num_pages,
		'current'   => $paged,
		'end_size'  => 3,
		'mid_size'  => 5,
		'prev_next' => true,
		'prev_text' => '<span class="ticon ticon-angle-left" aria-hidden="true"></span>',
		'next_text' => '<span class="ticon ticon-angle-right" aria-hidden="true"></span>',
		'type'      => 'list',
	) );
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<?php if ( $title ): ?>
            <div class="ilc-heading-wrap ilc-color-secondary">
                <h3 class="ilc-heading"><?php echo $title; ?></h3>
            </div>
		<?php endif; ?>
        <div class="ilc-recent-news-container">
			<?php
			while ( $news_query->have_posts() ) {
				$news_query->the_post();
				?>
                <div class="ilc-recent-news-item">
					<?php if ( has_post_thumbnail() ): ?>
                        <div class="ilc-recent-news-item-image">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'news_list' ); ?>
                                </a>
                            </figure>
                        </div>
					<?php endif; ?>
                    <div class="ilc-recent-news-item-content">
                        <p class="ilc-recent-news-item-date">
							<?php echo wpex_date_format( array(
								'id'     => get_the_ID(),
								'format' => 'd F Y',
							) ); ?>
                        </p>
                        <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<?php if ( $show_excerpt ): ?>
                            <div class="ilc-recent-news-item-excerpt"><?php echo wpex_get_excerpt( array( 'length' => $excerpt_length ) ); ?></div>
						<?php endif; ?>
						<?php if ( $show_view_all && $view_all_html && ( $news_query->current_post + 1 == $news_query->post_count ) ): ?>
                            <div class="ilc-recent-news-all-link"><?php echo $view_all_html; ?></div>
						<?php endif; ?>
                    </div>
                </div>
				<?php
			}
			?>
        </div>
		<?php if ( $show_pagination && $pagination_html ): ?>
            <div class="ilc-pagination-list">
				<?php echo $pagination_html; ?>
            </div>
		<?php endif; ?>
    </div>
	<?php wp_reset_query(); ?>
<?php endif; ?>