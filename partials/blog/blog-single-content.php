<?php
/**
 * Single blog post content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="single-blog-content entry clr"<?php wpex_schema_markup( 'entry_content' ); ?>>
	<?php the_content(); ?> 
	<?php 
	if( has_category(21)){
		get_template_part( 'partials/blog/blog-single-bottom-links' ); 
	}
	?> 
</div>

<?php
// Page links (for the <!-nextpage-> tag)
get_template_part( 'partials/link-pages' ); ?>