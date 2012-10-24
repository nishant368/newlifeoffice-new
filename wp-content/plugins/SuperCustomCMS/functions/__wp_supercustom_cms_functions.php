<?php
//install
require_once( '__wp_supercustom_cms_install_dashboard.php' );
require_once( '__wp_supercustom_cms_install_adminbar.php' );
//postinstall
include'__wp_supercustom_cms_flash_uploader.php';
include'__wp_supercustom_cms_admin_settings.php';
include'__wp_supercustom_cms_user_info.php';
include'__wp_supercustom_cms_install_uninstall.php';
include'__wp_supercustom_cms_import_export.php';
include'__wp_supercustom_cms_updatedatabase.php';
include'__wp_supercustom_cms_get_options.php';
include'__wp_supercustom_cms_set_options.php';
include'__wp_supercustom_cms_admin_footer.php';
include'__wp_supercustom_cms_plugin_menu.php';
include'__wp_supercustom_cms_metaboxes.php';

/**
 * Uses WordPress filter for image_downsize, kill wp-image-dimension
 * code by Andrew Rickmann
 * http://www.wp-fun.co.uk/
 * @param $value, $id, $size
 */
function __wp_supercustom_cms_image_downsize( $value = FALSE, $id = 0, $size = 'medium' ) {

	if ( ! wp_attachment_is_image( $id ) )
		return FALSE;

	$img_url = wp_get_attachment_url( $id);
	
	// Mimic functionality in image_downsize function in wp-includes/media.php
	if ( $intermediate = image_get_intermediate_size( $id, $size ) ) {
		$img_url = str_replace( basename( $img_url ), $intermediate['file'], $img_url );
	} elseif ( $size == 'thumbnail' ) {
		// fall back to the old thumbnail
		if ( $thumb_file = wp_get_attachment_thumb_file() && $info = getimagesize( $thumb_file ) ) {
			$img_url = str_replace( basename( $img_url ), basename( $thumb_file ), $img_url );
		}
	}
		
	if ( $img_url )
		return array( $img_url, 0, 0);
	
	return FALSE;
}

function __wp_supercustom_cms_textdomain() {
	
	load_plugin_textdomain( 
		__wp_supercustom_cms_get_plugin_data( 'TextDomain' ), 
		FALSE, 
		dirname( FB_SUPERCUSTOM_CMS_BASENAME ) . __wp_supercustom_cms_get_plugin_data( 'DomainPath' )
	);
}


function __wp_supercustom_cms_register_styles() {
	
	wp_register_style( 'SuperCustomCMS-style', plugins_url( 'css/style.css', __FILE__ ) );
}


function __wp_supercustom_cms_recursive_in_array( $needle, $haystack ) {
	
	if ( '' != $haystack ) {
		foreach ( $haystack as $stalk ) {
			if ( $needle == $stalk || 
				 ( is_array( $stalk) && 
				   __wp_supercustom_cms_recursive_in_array( $needle, $stalk ) 
				 )
				) {
				return TRUE;
			}
		}
		return FALSE;
	}
}


/**
 * remove the dashbord
 * @author of basic Austin Matzko
 * http://www.ilfilosofo.com/blog/2006/05/24/plugin-remove-the-wordpress-dashboard/
 */
function __wp_supercustom_cms_remove_dashboard() {
	global $menu, $submenu, $user_ID, $wp_version;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	foreach ( $user_roles as $role ) {
		$disabled_menu_[$role]     = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_menu_' . $role . '_items' );
		$disabled_submenu_[$role]  = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_submenu_' . $role . '_items' );
	}

	$disabled_menu_all     = array();
	$disabled_submenu_all  = array();

	foreach ( $user_roles as $role ) {
		array_push( $disabled_menu_all, $disabled_menu_[$role] );
		array_push( $disabled_submenu_all, $disabled_submenu_[$role] );
	}

	// remove dashboard
	if ( $disabled_menu_all != '' || $disabled_submenu_all != '' ) {

		foreach ( $user_roles as $role ) {
			
			if ( current_user_can( $role ) ) {
				if ( __wp_supercustom_cms_recursive_in_array( 'index.php', $disabled_menu_[$role] ) || __wp_supercustom_cms_recursive_in_array( 'index.php', $disabled_submenu_[$role] ) )
					$redirect = TRUE;
				else 
					$redirect = FALSE;
			}
		}
		
		if ( $redirect ) {
			$__wp_supercustom_cms_db_redirect = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_db_redirect' );
			$__wp_supercustom_cms_db_redirect_admin_url = get_option( 'siteurl' ) . '/wp-admin/';
			switch ( $__wp_supercustom_cms_db_redirect) {
			case 0:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'profile.php';
				break;
			case 1:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'edit.php';
				break;
			case 2:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'edit.php?post_type=page';
				break;
			case 3:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'post-new.php';
				break;
			case 4:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'page-new.php';
				break;
			case 5:
				$__wp_supercustom_cms_db_redirect = $__wp_supercustom_cms_db_redirect_admin_url . 'edit-comments.php';
				break;
			case 6:
				$__wp_supercustom_cms_db_redirect = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_db_redirect_txt' );
				break;
			}
			
			// fallback for WP smaller 3.0
			if ( version_compare( $wp_version, "3.0alpha", "<") && 'edit.php?post_type=page' == $__wp_supercustom_cms_db_redirect )
				$__wp_supercustom_cms_db_redirect = 'edit-pages.php';
			
			$the_user = new WP_User( $user_ID);
			reset( $menu);
			$page = key( $menu);

			while ( (__( 'Dashboard' ) != $menu[$page][0] ) && next( $menu) || (__( 'Dashboard' ) != $menu[$page][1] ) && next( $menu) )
				$page = key( $menu);

			if (__( 'Dashboard' ) == $menu[$page][0] || __( 'Dashboard' ) == $menu[$page][1] )
				unset( $menu[$page] );
			reset( $menu); $page = key( $menu);

			while ( !$the_user->has_cap( $menu[$page][1] ) && next( $menu) )
				$page = key( $menu);

			if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) ) {
				wp_redirect( $__wp_supercustom_cms_db_redirect );
			}
		}
	}
}

?>
