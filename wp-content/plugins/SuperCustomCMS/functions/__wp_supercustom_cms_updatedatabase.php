<?php 
/**
 * Update options in database
 */
function __wp_supercustom_cms_update() {
    
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	$args = array( 'public' => TRUE, '_builtin' => FALSE );
	$post_types = get_post_types( $args );
	
	if ( isset( $_POST['__wp_supercustom_cms_user_info'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_user_info'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_user_info'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_user_info'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_dashmenu'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_dashmenu'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_dashmenu'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_dashmenu'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_footer'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_footer'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_footer'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_footer'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_header'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_header'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_header'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_header'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_exclude_super_admin'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_exclude_super_admin'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_exclude_super_admin'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_exclude_super_admin'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_writescroll'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_writescroll'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_writescroll'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_writescroll'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_tb_window'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_tb_window'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_tb_window'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_tb_window'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_cat_full'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_cat_full'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_cat_full'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_cat_full'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_db_redirect'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_db_redirect'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_db_redirect'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_db_redirect'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_ui_redirect'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_ui_redirect'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_ui_redirect'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_ui_redirect'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_advice'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_advice'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_advice'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_advice'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_advice_txt'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_advice_txt'] = stripslashes( $_POST['__wp_supercustom_cms_advice_txt'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_advice_txt'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_timestamp'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_timestamp'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_timestamp'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_timestamp'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_control_flashloader'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_control_flashloader'] = strip_tags(stripslashes( $_POST['__wp_supercustom_cms_control_flashloader'] ) );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_control_flashloader'] = 0;
	}

	if ( isset( $_POST['__wp_supercustom_cms_db_redirect_txt'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_db_redirect_txt'] = stripslashes( $_POST['__wp_supercustom_cms_db_redirect_txt'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_db_redirect_txt'] = 0;
	}

	// menu update
	foreach ( $user_roles as $role ) {
		if ( isset( $_POST['wp_supercustom_cms_disabled_menu_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_menu_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_menu_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_menu_' . $role . '_items'] = array();
		}
		
		if ( isset( $_POST['wp_supercustom_cms_disabled_submenu_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_submenu_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_submenu_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_submenu_' . $role . '_items'] = array();
		}
	}

	// global_options, metaboxes update
	foreach ( $user_roles as $role ) {
		if ( isset( $_POST['wp_supercustom_cms_disabled_global_option_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_global_option_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_global_option_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_global_option_' . $role . '_items'] = array();
		}
		
		if ( isset( $_POST['wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'] = array();
		}

		if ( isset( $_POST['wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'] = $_POST['wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'] = array();
		}
		
		foreach ( $post_types as $post_type ) {
			if ( isset( $_POST['wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'] ) ) {
				$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'] = $_POST['wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'];
			} else {
				$SuperCustomCMSoptions['wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'] = array();
			}
		}
		
		if ( isset( $_POST['wp_supercustom_cms_disabled_link_option_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_link_option_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_link_option_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_link_option_' . $role . '_items'] = array();
		}
		
		// wp nav menu options
		if ( isset( $_POST['wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items'] = array();
		}
		
		// wp dashboard option
		if ( isset( $_POST['wp_supercustom_cms_disabled_dashboard_option_' . $role . '_items'] ) ) {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_dashboard_option_' . $role . '_items']  = $_POST['wp_supercustom_cms_disabled_dashboard_option_' . $role . '_items'];
		} else {
			$SuperCustomCMSoptions['wp_supercustom_cms_disabled_dashboard_option_' . $role . '_items'] = array();
		}
	}
	
	// own options
	if ( isset( $_POST['__wp_supercustom_cms_own_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_options'] = 0;
	}
	
	// own post options
	if ( isset( $_POST['__wp_supercustom_cms_own_post_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_post_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_post_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_post_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_post_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_post_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_post_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_post_options'] = 0;
	}
	
	// own page options
	if ( isset( $_POST['__wp_supercustom_cms_own_page_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_page_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_page_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_page_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_page_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_page_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_page_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_page_options'] = 0;
	}
	
	// own custom  post options
	foreach ( $post_types as $post_type ) {
		if ( isset( $_POST['__wp_supercustom_cms_own_values_' . $post_type] ) ) {
			$SuperCustomCMSoptions['__wp_supercustom_cms_own_values_' . $post_type] = stripslashes( $_POST['__wp_supercustom_cms_own_values_' . $post_type] );
		} else {
			$SuperCustomCMSoptions['__wp_supercustom_cms_own_values_' . $post_type] = 0;
		}
		
		if ( isset( $_POST['__wp_supercustom_cms_own_options_' . $post_type] ) ) {
			$SuperCustomCMSoptions['__wp_supercustom_cms_own_options_' . $post_type ] = stripslashes( $_POST['__wp_supercustom_cms_own_options_' . $post_type] );
		} else {
			$SuperCustomCMSoptions['__wp_supercustom_cms_own_options_' . $post_type] = 0;
		}
	}
	
	// own link options
	if ( isset( $_POST['__wp_supercustom_cms_own_link_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_link_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_link_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_link_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_link_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_link_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_link_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_link_options'] = 0;
	}
	
	// wp nav menu options
	if ( isset( $_POST['__wp_supercustom_cms_own_nav_menu_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_nav_menu_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_nav_menu_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_nav_menu_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_nav_menu_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_nav_menu_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_nav_menu_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_nav_menu_options'] = 0;
	}
	
	// own dashboard options	
	if ( isset( $_POST['__wp_supercustom_cms_own_dashboard_values'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_dashboard_values'] = stripslashes( $_POST['__wp_supercustom_cms_own_dashboard_values'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_dashboard_values'] = 0;
	}
	
	if ( isset( $_POST['__wp_supercustom_cms_own_dashboard_options'] ) ) {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_dashboard_options'] = stripslashes( $_POST['__wp_supercustom_cms_own_dashboard_options'] );
	} else {
		$SuperCustomCMSoptions['__wp_supercustom_cms_own_dashboard_options'] = 0;
	}
	
	$SuperCustomCMSoptions['wp_supercustom_cms_dashboard_widgets'] = __wp_supercustom_cms_get_option_value('wp_supercustom_cms_dashboard_widgets' );
	
	$SuperCustomCMSoptions['wp_supercustom_cms_default_menu'] = $GLOBALS['menu'];
	$SuperCustomCMSoptions['wp_supercustom_cms_default_submenu'] = $GLOBALS['submenu'];
	
	// update
	update_option( 'supercustom_cms', $SuperCustomCMSoptions );
	//$SuperCustomCMSoptions = get_option( 'supercustom_cms' );
	
	$myErrors = new __wp_supercustom_cms_message_class();
	$myErrors = '<div id="message" class="updated fade"><p>' . $myErrors->get_error( '__wp_supercustom_cms_update' ) . '</p></div>';
	echo $myErrors;
}
?>