<?php

// ---------- NAVIGATION MENUS ---------- //
add_theme_support( 'nav-menus' );

// REGISTER MENUS
function register_menus() {
	if ( function_exists( 'wp_nav_menu' ) )
		register_nav_menus(
			array(
				'main-navigation' => __( 'Main Navigation', 'raw_theme' ),
				'footer-navigation' => __( 'Footer Navigation', 'raw_theme' )
			)
		);
}
add_action( 'init', 'register_menus' );

?>