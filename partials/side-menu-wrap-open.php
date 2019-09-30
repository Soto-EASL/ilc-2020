<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$page_side_menu     = get_field( 'page_side_menu', $page_id );
?>

<div class="ilc-side-menu-page-wrap">
	<div class="ilc-side-menu-page-menu-wrap">
		<?php
		wp_nav_menu( array(
			'container'      => 'nav',
			'container_class' => 'ilc-side-menu-nav',
			'menu_id' => '',
			'menu_class'     => '',
			'wp_nav_menu'    => '',
			'echo'           => true,
			'fallback_cb'    => false,
			'menu' => $page_side_menu,
		) );
		?>
	</div>
	<div class="ilc-side-menu-page-content-wrap">
