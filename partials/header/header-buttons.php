<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if ( have_rows( 'header_buttons', 'option' ) ):
	?>
    <ul class="ilc-header-buttons">
		<?php
		while ( have_rows( 'header_buttons', 'option' ) ):
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
				$item_html = '<a class="ilc-btn ilc-btn-primary" href="' . esc_url( $item_url ) . $item_nt . '"><span>' . $item_title . '</span></a>';
			}
			if ( ! $item_html ) {
				continue;
			}
			?>
            <li><?php echo $item_html; ?></li>
		<?php endwhile; ?>
    </ul>


<?php endif; ?>