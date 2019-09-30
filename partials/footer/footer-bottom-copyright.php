<?php
/**
 * Footer bottom content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 4.5
 */
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$left_items = get_field( 'footer_bottom_left_items', 'option' );
$soto_text  = get_field( 'soto_attribution_text', 'option' );

if ( $left_items || $soto_text ):
	if ( have_rows( 'footer_bottom_left_items', 'option' ) ):
		?>
        <div class="ilc-footer-copy-items">
            <ul class="ilc-footer-copy-items-list">
				<?php
				while ( have_rows( 'footer_bottom_left_items', 'option' ) ):
					the_row();
					$item_title = get_sub_field( 'title' );
					$item_url   = get_sub_field( 'url' );
					$item_nt    = get_sub_field( 'open_in_new_tab' );

					if ( $item_nt ) {
						$item_nt = ' target="_blank"';
					} else {
						$item_nt = '';
					}

					$item_html = '';
					if ( ! $item_url ) {
						$item_html = $item_title;
					} else {
						$item_html = '<a href="' . esc_url( $item_url ) . $item_nt . '">'. $item_title .'</a>';
					}
					if(!$item_html){
					    continue;
                    }
					?>
                    <li class="ilc-footer-copy-item"><?php echo $item_html; ?></li>
				<?php endwhile; ?>
            </ul>
        </div>
	<?php endif; ?>
	<?php if ( $soto_text ): ?>
    <div class="ilc-soto-attribution">
		<?php echo do_shortcode( $soto_text ); ?>
    </div>
<?php endif; ?>
<?php endif; ?>
