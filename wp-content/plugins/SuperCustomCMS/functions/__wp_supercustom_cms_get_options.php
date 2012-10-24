<?php


/**
 * @version WP 2.8
 * Add action link(s) to plugins page
 *
 * @package Secure WordPress
 *
 * @param $links, $file
 * @return $links
 */
function __wp_supercustom_cms_filter_plugin_meta( $links, $file ) {
	
	/* create link */
	if ( FB_SUPERCUSTOM_CMS_BASENAME == $file ) {
		array_unshift(
			$links,
			sprintf( '<a href="options-general.php?page=%s">%s</a>', FB_SUPERCUSTOM_CMS_BASENAME, __( 'Settings' ) )
		);
	}
	
	return $links;
}


/**
 * content of help
 */
function __wp_supercustom_cms_contextual_help( $contextual_help, $screen_id, $screen ) {
	
	if ( 'settings_page_SuperCustomCMS/SuperCustomCMS' !== $screen_id )
			return $contextual_help;
	
	$contextual_help = __( '<a href="http://wordpress.org/extend/plugins/SuperCustomCMS/">Documentation</a>', FB_SUPERCUSTOM_CMS_TEXTDOMAIN );
	
	return $contextual_help;
}


function __wp_supercustom_cms_on_load_page() {
	
	add_filter( 'contextual_help', '__wp_supercustom_cms_contextual_help', 10, 3 );
	
	wp_enqueue_style( 'SuperCustomCMS-style' );
}


/**
 * Set theme for users
 * Kill with version 1.7.18
 */
function __wp_supercustom_cms_set_theme() {

	if ( ! current_user_can( 'edit_users' ) )
		wp_die( __( 'Cheatin&#8217; uh?' ) );

	$user_ids    = $_POST[wp_supercustom_cms_theme_items];
	$admin_color = htmlspecialchars( stripslashes( $_POST[__wp_supercustom_cms_set_theme] ) );

	if ( ! $user_ids )
		return FALSE;

	foreach( $user_ids as $user_id ) {
		update_usermeta( $user_id, 'admin_color', $admin_color );
	}
	
}


/**
 * read otpions
 */
function __wp_supercustom_cms_get_option_value( $key) {

	$SuperCustomCMSoptions = get_option( 'supercustom_cms' );
	
	if ( isset( $SuperCustomCMSoptions[$key] ) )
		return ( $SuperCustomCMSoptions[$key] );
}
?>
