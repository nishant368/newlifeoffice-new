<?php

/**
 * set global options in backend in all areas
 */
function __wp_supercustom_cms_set_global_option() {
	global $_wp_admin_css_colors;
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	$__wp_supercustom_cms_admin_head = '';

	// remove_action( 'admin_head', 'index_js' );

	foreach ( $user_roles as $role ) {
		$disabled_global_option_[$role] = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_global_option_' . $role . '_items' );
	}

	foreach ( $user_roles as $role ) {
		if ( ! isset( $disabled_global_option_[$role]['0'] ) )
			$disabled_global_option_[$role]['0'] = '';
	}
	
	$remove_adminbar = FALSE;
	// new 1.7.8
	foreach ( $user_roles as $role ) {
		$user = wp_get_current_user();
		if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
			if ( current_user_can( $role ) 
				 && isset( $disabled_global_option_[$role] ) 
				 && is_array( $disabled_global_option_[$role] )
				) {
				$global_options = implode( ', ', $disabled_global_option_[$role] );
				if ( __wp_supercustom_cms_recursive_in_array( '.show-admin-bar', $disabled_global_option_[$role] ) )
					$remove_adminbar = TRUE;
			}
		}
	}
	if ( 0 != strpos( $global_options, '#your-profile .form-table fieldset' ) )
		$_wp_admin_css_colors = 0;
	$__wp_supercustom_cms_admin_head .= '<!-- global options -->' . "\n";
	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . $global_options . ' {display: none !important;}</style>' . "\n";
	
	if ( $global_options)
		echo $__wp_supercustom_cms_admin_head;
}

/**
 * Set menu for settings
 */
function __wp_supercustom_cms_set_menu_option() {
	global $pagenow, $menu, $submenu, $user_identity, $wp_version, $current_screen;
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	if ( 'settings_page_SuperCustomCMS/SuperCustomCMS' === $current_screen->id )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	foreach ( $user_roles as $role ) {
		$disabled_menu_[$role]     = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_menu_' . $role . '_items' );
		$disabled_submenu_[$role]  = __wp_supercustom_cms_get_option_value( 'wp_supercustom_cms_disabled_submenu_' . $role . '_items' );
	}
	
	// set menu
	if ( '' != $disabled_menu_['editor'] ) {
		
		// set admin-menu
		foreach ( $user_roles as $role ) {
			$user = wp_get_current_user();
			if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
				if ( current_user_can( $role ) ) {
					$wp_supercustom_cms_menu     = $disabled_menu_[$role];
					$wp_supercustom_cms_submenu  = $disabled_submenu_[$role];
				}
			}
		}
		
		// fallback on users.php on all userroles smaller admin
		if ( is_array( $wp_supercustom_cms_menu) && in_array( 'users.php', $wp_supercustom_cms_menu)  )
			$wp_supercustom_cms_menu[] = 'profile.php';
		
		if ( isset( $menu) && ! empty($menu) ) {
			foreach ( $menu as $index => $item) {
				if ( 'index.php' === $item )
					continue;
				
				if ( isset( $wp_supercustom_cms_menu) && in_array( $item[2], $wp_supercustom_cms_menu) ) {
					unset( $menu[$index] );
				}
				
				if ( isset( $submenu) && !empty( $submenu[$item[2]] ) ) {
					foreach ( $submenu[$item[2]] as $subindex => $subitem) {
						if ( isset( $wp_supercustom_cms_submenu) && in_array( $subitem[2], $wp_supercustom_cms_submenu) )
							//if ( 'profile.php' === $subitem[2] )
							//	unset( $menu[70] );
							unset( $submenu[$item[2]][$subindex] );
					}
				}
			}
		}
	
	}

}


/**
 * set link options in area Links of Backend
 */
function __wp_supercustom_cms_set_link_option() {
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	$__wp_supercustom_cms_admin_head = '';
	
	// remove_action( 'admin_head', 'index_js' );
	
	foreach ( $user_roles as $role ) {
		$disabled_link_option_[$role] = __wp_supercustom_cms_get_option_value( 
			'wp_supercustom_cms_disabled_link_option_' . $role . '_items'
		);
	}
	
	foreach ( $user_roles as $role ) {
		if ( !isset( $disabled_link_option_[$role]['0'] ) )
			$disabled_link_option_[$role]['0'] = '';
	}

	// new 1.7.8
	foreach ( $user_roles as $role ) {
		$user = wp_get_current_user();
		if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
			if ( current_user_can( $role ) 
				 && isset( $disabled_link_option_[$role] ) 
				 && is_array( $disabled_link_option_[$role] )
				) {
				$link_options = implode( ',', $disabled_link_option_[$role] );
			}
		}
	}
	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . 
		$link_options . ' {display: none !important;}</style>' . "\n";
	
	if ( $link_options)
		echo $__wp_supercustom_cms_admin_head;
}

/**
 * remove objects on wp nav menu
 */
function __wp_supercustom_cms_set_nav_menu_option() {
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	$__wp_supercustom_cms_admin_head = '';
	
	// remove_action( 'admin_head', 'index_js' );
	
	foreach ( $user_roles as $role ) {
		$disabled_nav_menu_option_[$role] = __wp_supercustom_cms_get_option_value( 
			'wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items'
		);
	}
	
	foreach ( $user_roles as $role ) {
		if ( ! isset( $disabled_nav_menu_option_[$role]['0'] ) )
			$disabled_nav_menu_option_[$role]['0'] = '';
	}

	// new 1.7.8
	foreach ( $user_roles as $role ) {
		$user = wp_get_current_user();
		if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
			if ( current_user_can( $role ) 
				 && isset( $disabled_nav_menu_option_[$role] ) 
				 && is_array( $disabled_nav_menu_option_[$role] )
				) {
				$nav_menu_options = implode( ',', $disabled_nav_menu_option_[$role] );
			}
		}
	}
	//remove_meta_box( $id, 'nav-menus', 'side' );
	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . 
		$nav_menu_options . ' {display: none !important;}</style>' . "\n";
	
	if ( $nav_menu_options)
		echo $__wp_supercustom_cms_admin_head;
}
?>
