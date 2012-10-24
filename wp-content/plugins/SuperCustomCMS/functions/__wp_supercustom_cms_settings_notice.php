<?php
/**
 * @package    SuperCustomCMS
 * @subpackage Notice for settings page
 * @author     Frank Bültge
 */
if ( ! function_exists( 'add_filter' ) ) {
	echo "Hi there! I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
// always visible
add_action( 'load-settings_page_SuperCustomCMS/SuperCustomCMS', '__wp_supercustom_cms_add_settings_error' );
//add_action( 'admin_notices', '__wp_supercustom_cms_on_admin_init' );

function __wp_supercustom_cms_add_settings_error() {
	
	$settings_hint_message = '<span style="font-size: 30px;">&#x261D;</span>' . __( 'Attention: The settings page ignores this settings and view all areas!', FB_SUPERCUSTOM_CMS_TEXTDOMAIN );
	
	add_settings_error(
		'__wp_supercustomcms_settings_hint_message',
		'__wp_supercustomcms_settings_hint',
		$settings_hint_message,
		'updated'
	);
	
}

function __wp_supercustom_cms_get_admin_notices() {
	
	settings_errors( '__wp_supercustomcms_settings_hint_message' );
}
