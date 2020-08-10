<?php
/**
 * Main Header Layout Output
 * Have a look at framework/hooks/actions to see what is hooked into the header
 * See all header parts at partials/header/
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 4.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php wpex_hook_header_before(); ?>

    <header id="site-header" class="<?php echo wpex_header_classes(); ?>"<?php wpex_schema_markup( 'header' ); ?><?php wpex_aria_landmark( 'header' ); ?>>

		<?php wpex_hook_header_top(); ?>

        <div id="ilc-site-header-top" class="container clr">
            <div class="ilc-site-logo">
                <?php wpex_get_template_part('header_logo_inner'); ?>
            </div>
            <div class="ilc-header-buttons-wrap">
                <?php get_template_part('partials/header/countdown'); ?>
                <?php get_template_part('partials/header/header-buttons'); ?>
            </div>
        </div><!-- #site-header-inner -->

        <div id="ilc-site-header-nav">
            <div id="site-header-inner" class="container clr">
				<?php wpex_hook_header_inner(); ?>
            </div>
        </div><!-- #site-header-inner -->

		<?php wpex_hook_header_bottom(); ?>

    </header><!-- #header -->

<?php wpex_hook_header_after(); ?>