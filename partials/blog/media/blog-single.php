<?php
/**
 * Blog single post standard format media
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.5.4.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if there isn't a thumbnail or hidden
$display_featured_image = get_post_meta(get_the_ID(), 'ilc_display_featured_image', true);
$thumbnail = wpex_get_blog_post_thumbnail();
if ( 'no' != $display_featured_image && $thumbnail ) : ?>

	<div id="post-media" class="clr">

		<?php
		// Image with lightbox link
		if ( wpex_get_mod( 'blog_post_image_lightbox' ) ) :

			// Get full image
			$full_image = wp_get_attachment_url( get_post_thumbnail_id() );

			// Load lightbox skin stylesheet
			wpex_enqueue_ilightbox_skin(); ?>

			<a href="<?php echo esc_url( $full_image ); ?>" title="<?php esc_attr_e( 'Enlarge Image', 'total' ); ?>" class="wpex-lightbox<?php wpex_entry_image_animation_classes(); ?>" data-type="image"><?php echo $thumbnail; ?></a>

		<?php
		// No lightbox
		else : ?>

			<?php echo $thumbnail; ?>
			
		<?php endif; ?>

		<?php
		// Blog entry caption
		if ( wpex_get_mod( 'blog_thumbnail_caption' ) && $caption = wpex_featured_image_caption() ) : ?>
		
			<div class="post-media-caption clr"><?php echo $caption; ?></div>

		<?php endif; ?>

	</div><!-- #post-media -->

<?php endif; ?>