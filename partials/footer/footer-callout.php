<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$callout_text         = get_field( 'footer_callout_text', 'option' );
$callout_button_title = get_field( 'footer_callout_button_title', 'option' );
$callout_button_url   = get_field( 'footer_callout_button_url', 'option' );
$callout_button_nt    = get_field( 'footer_callout_open_in_new_tab', 'option' );

if ( $callout_button_nt ) {
	$callout_button_nt = ' target="_blank';
} else {
	$callout_button_nt = '';
}
$callout_button_html = '';
if ( $callout_button_title && $callout_button_url ) {
	$callout_button_html = '<a class="ilc-btn ilc-btn-primary" href="' . $callout_button_url . $callout_button_nt . '"><span>' . $callout_button_title . '</span></a>';
}

if ( $callout_text || $callout_button_html ):
	?>
    <div id="footer-callout-wrap" class="clr">
        <div id="footer-callout" class="container">
			<?php if ( $callout_text ): ?>
                <div class="footer-callout-text">
					<?php echo do_shortcode( $callout_text ); ?>
                </div>
			<?php endif; ?>
			<?php if ( $callout_text ): ?>
            <div class="footer-callout-button-wrap">
				<?php echo $callout_button_html; ?>
            </div>
        </div>
		<?php endif; ?>
    </div>
<?php endif; ?>