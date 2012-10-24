<?php

/**
 * set menu options from database
 */
function __wp_supercustom_cms_set_user_info() {
	global $pagenow, $menu, $submenu, $user_identity, $wp_version;
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	foreach ( $user_roles as $role ) {
		$disabled_menu_[$role]     = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_menu_' . $role . '_items' );
		$disabled_submenu_[$role]  = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_submenu_' . $role . '_items' );
	}
	
	$__wp_supercustom_cms_admin_head       = "\n";
	$__wp_supercustom_cms_user_info        = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_user_info' );
	$__wp_supercustom_cms_ui_redirect      = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_ui_redirect' );
	

	// change user-info
	switch ( $__wp_supercustom_cms_user_info) {
		case 1:
			$__wp_supercustom_cms_admin_head .= '<script type="text/javascript">' . "\n";
			$__wp_supercustom_cms_admin_head .= "\t" . 'jQuery(document).ready(function() { jQuery(\'#user_info\' ).remove(); });' . "\n";
			$__wp_supercustom_cms_admin_head .= '</script>' . "\n";
			break;
		case 2:
			if ( version_compare( $wp_version, "3.2alpha", ">=") ) {
				if ( function_exists( 'is_admin_bar_showing' ) && is_admin_bar_showing() )
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info31.css" type="text/css" />' . "\n";
				$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info32.css" type="text/css" />' . "\n";
			} elseif ( version_compare( $wp_version, "3.0alpha", ">=") ) {
				if ( function_exists( 'is_admin_bar_showing' ) && is_admin_bar_showing() )
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info31.css" type="text/css" />' . "\n";
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info30.css" type="text/css" />' . "\n";
				} elseif ( version_compare(substr( $wp_version, 0, 3), '2.7', '>=' ) ) {
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info27.css" type="text/css" />' . "\n";
				} else {
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info.css" type="text/css" />' . "\n";
				}
			$__wp_supercustom_cms_admin_head .= '<script type="text/javascript">' . "\n";
			$__wp_supercustom_cms_admin_head .= "\t" . 'jQuery(document).ready(function() { jQuery(\'#user_info\' ).remove();';
			if ( $__wp_supercustom_cms_ui_redirect == '1' ) {
				$__wp_supercustom_cms_admin_head .= 'jQuery(\'div#wpcontent\' ).after(\'<div id="small_user_info"><p><a href="' . get_option( 'siteurl' ) . wp_nonce_url( ( '/wp-login.php?action=logout&amp;redirect_to=' ) . get_option( 'siteurl' ) , 'log-out' ) . '" title="' . __( 'Log Out' ) . '">' . __( 'Log Out' ) . '</a></p></div>\' ) });' . "\n";
			} else {
				$__wp_supercustom_cms_admin_head .= 'jQuery(\'div#wpcontent\' ).after(\'<div id="small_user_info"><p><a href="' . get_option( 'siteurl' ) . wp_nonce_url( ( '/wp-login.php?action=logout' ) , 'log-out' ) . '" title="' . __( 'Log Out' ) . '">' . __( 'Log Out' ) . '</a></p></div>\' ) });' . "\n";
			}
			$__wp_supercustom_cms_admin_head .= '</script>' . "\n";
			break;
		case 3:
			if ( version_compare( $wp_version, "3.2alpha", ">=") ) {
				if ( function_exists( 'is_admin_bar_showing' ) && is_admin_bar_showing() )
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info31.css" type="text/css" />' . "\n";
				$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info32.css" type="text/css" />' . "\n";
			} elseif ( version_compare( $wp_version, "3.0alpha", ">=") ) {
				if ( function_exists( 'is_admin_bar_showing' ) && is_admin_bar_showing() )
					$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info31.css" type="text/css" />' . "\n";
				$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info30.css" type="text/css" />' . "\n";
			} elseif ( version_compare(substr( $wp_version, 0, 3), '2.7', '>=' ) ) {
				$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info27.css" type="text/css" />' . "\n";
			} else {
				$__wp_supercustom_cms_admin_head .= '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/mw_small_user_info.css" type="text/css" />' . "\n";
			}
			$__wp_supercustom_cms_admin_head .= '<script type="text/javascript">' . "\n";
			$__wp_supercustom_cms_admin_head .= "\t" . 'jQuery(document).ready(function() { jQuery(\'#user_info\' ).remove();';
			if ( $__wp_supercustom_cms_ui_redirect == '1' ) {
				$__wp_supercustom_cms_admin_head .= 'jQuery(\'div#wpcontent\' ).after(\'<div id="small_user_info"><p><a href="' . get_option( 'siteurl' ) . ( '/wp-admin/profile.php' ) . '">' . $user_identity . '</a> | <a href="' . get_option( 'siteurl' ) . wp_nonce_url( ( '/wp-login.php?action=logout&amp;redirect_to=' ) . get_option( 'siteurl' ), 'log-out' ) . '" title="' . __( 'Log Out' ) . '">' . __( 'Log Out' ) . '</a></p></div>\' ) });' . "\n";
			} else {
				$__wp_supercustom_cms_admin_head .= 'jQuery(\'div#wpcontent\' ).after(\'<div id="small_user_info"><p><a href="' . get_option( 'siteurl' ) . ( '/wp-admin/profile.php' ) . '">' . $user_identity . '</a> | <a href="' . get_option( 'siteurl' ) . wp_nonce_url( ( '/wp-login.php?action=logout' ), 'log-out' ) . '" title="' . __( 'Log Out' ) . '">' . __( 'Log Out' ) . '</a></p></div>\' ) });' . "\n";
			}
			$__wp_supercustom_cms_admin_head .= '</script>' . "\n";
			break;
	}
	
	echo $__wp_supercustom_cms_admin_head;
}

/**
 * __wp_supercustom_cms_get_all_user_roles() - Returns an array with all user roles(names) in it.
 * Inclusive self defined roles (for example with the 'Role Manager' plugin).
 * code by Vincent Weber, www.webRtistik.nl
 * @uses $wp_roles
 * @return $user_roles
 */
function __wp_supercustom_cms_get_all_user_roles() {
	global $wp_roles;
	
	$user_roles = array();
	
	if ( isset( $wp_roles->roles) && is_array( $wp_roles->roles) ) {
		foreach ( $wp_roles->roles as $role => $data) {
			array_push( $user_roles, $role );
			//$data contains caps, maybe for later use..
		}
	}
	
	return $user_roles;
}

/**
 * __wp_supercustom_cms_get_all_user_roles_names() - Returns an array with all user roles_names in it.
 * Inclusive self defined roles (for example with the 'Role Manager' plugin).
 * @uses $wp_roles
 * @return $user_roles_names
 */
function __wp_supercustom_cms_get_all_user_roles_names() {
	global $wp_roles;
	
	$user_roles_names = array();

	foreach ( $wp_roles->role_names as $role_name => $data) {
		if ( function_exists( 'translate_user_role' ) )
			$data = translate_user_role( $data );
		else
			$data = translate_with_context( $data );
		
		array_push( $user_roles_names, $data );
	}
	
	return $user_roles_names;
}

/**
 * small user-info
 */
function __wp_supercustom_cms_small_user_info() {
?>
	<div id="small_user_info">
		<p>
			<a href="<?php echo wp_nonce_url( 
			site_url( 'wp-login.php?action=logout' ), 
			'log-out' ) ?>" 
			title="<?php _e( 'Log Out' ) ?>"><?php _e( 'Log Out' ); ?></a>
		</p>
	</div>
<?php
}
?>
