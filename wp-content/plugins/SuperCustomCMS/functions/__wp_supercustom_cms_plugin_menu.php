<?php


/**
 * settings in plugin-admin-page
 */
function __wp_supercustom_cms_add_settings_page() {
	global $wp_version;

	if ( current_user_can( 'manage_options' ) && function_exists( 'add_submenu_page' ) ) {
		
		$pagehook = add_menu_page( 
			__( 'WPCustomback-end Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ), 
			__( 'Custom Back-end', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ), 
			'manage_options', 
			'WP_SuperCustomCMS', 
			'__wp_supercustom_cms_options', WP_SUPERCUSTOM_CMS_ADDRESS.'images/logo.png'
		);
        add_submenu_page(
            
			__( 'WPCustomback-end Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ), 
			__( 'Custom Back-end', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ), 
            'Custom Back-end mini' ,
			'manage_options', 
			'WP_SuperCustomCMS_mini', 
			'__wp_supercustom_cms_options_mini'
		);
        //add_submenu_page('WP SuperCCMS','WP-SuperCustomCMS', 'WP SuperCCMS', $sc_access, 'WP-SuperCustomCMS', 'WP-SuperCustomCMS',NULL);
		add_action( 'load-' . $pagehook, '__wp_supercustom_cms_on_load_page' );
		add_filter( 'plugin_action_links', '__wp_supercustom_cms_filter_plugin_meta', 10, 2 );
	}
	
}
?>
