<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$page_header_image     = get_field( 'page_header_image', wpex_get_current_post_id() );
$bg_image_style        = '';
$page_header_image_src = '';
if ( $page_header_image ) {
	$page_header_image_src = wp_get_attachment_image_url( $page_header_image, 'full' );
}

if ( is_single() && has_post_thumbnail() ) {
	$page_header_image_src = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
}

if ( $page_header_image_src ) {
	$bg_image_style = ' style="background-image: url(' . $page_header_image_src . ')"';
	$class          = ' ilc-page-header-hasbg';
} else {
	$class = ' ilc-page-header-nobg';
}

$page_header_image_link    = '';
$page_header_image_link_nt = '';
if ( is_single() ) {
	$page_header_image_link = get_field( 'featured_image_link' );
	$page_header_image_link_nt     = get_field( 'open_in_new_tab' );
}
$page_header_image_link_nt = $page_header_image_link_nt ? ' target="blank"' : '';
?>
<div class="ilc-page-header-bg-wrap<?php echo $class; ?>"<?php echo $bg_image_style ?>>
	<?php if ( $page_header_image_src ): ?>
		<?php if ( $page_header_image_link ): ?>
            <a href="<?php echo esc_url( $page_header_image_link ); ?>"<?php echo $page_header_image_link_nt; ?>>
                <img class="ilc-page-header-img" style="opacity: 0" src="<?php echo $page_header_image_src; ?>" alt="">
            </a>
		<?php else: ?>
            <img class="ilc-page-header-img" style="opacity: 0" src="<?php echo $page_header_image_src; ?>" alt="">
		<?php endif; ?>
	<?php endif; ?>
    <div class="page-header-inner-wrap">

