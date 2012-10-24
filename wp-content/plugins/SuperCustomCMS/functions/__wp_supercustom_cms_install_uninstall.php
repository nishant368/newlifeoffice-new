<?php


/**
 * Delete options in database
 */
function __wp_supercustom_cms_deinstall() {
	delete_option( 'supercustom_cms' );
    
}


/**
 * Install options in database
 */
function __wp_supercustom_cms_install() {
	global $menu, $submenu;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	$SuperCustomCMSoptions = array();

	foreach ( $user_roles as $role ) {
		$SuperCustomCMSoptions['wp_supercustom_cms_disabled_menu_' . $role . '_items'] = array();
		$SuperCustomCMSoptions['wp_supercustom_cms_disabled_submenu_' . $role . '_items'] = array();
		$SuperCustomCMSoptions['wp_supercustom_cms_disabled_global_option_' . $role . '_items'] = array();
		$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'] = array();
		$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'] = array();
		$args = array( 'public' => TRUE, '_builtin' => FALSE );
		foreach ( get_post_types( $args ) as $post_type ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'] = array();
		}
	}

	$SuperCustomCMSoptions['wp_supercustom_cms_default_menu'] = $menu;
	$SuperCustomCMSoptions['wp_supercustom_cms_default_submenu'] = $submenu;

	add_option( 'supercustom_cms', $SuperCustomCMSoptions );
}
?>
