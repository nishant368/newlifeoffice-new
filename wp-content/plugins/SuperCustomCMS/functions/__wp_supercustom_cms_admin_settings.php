<?php


/**
 * check user-option and add new style
 * @uses $pagenow
 */
function __wp_supercustom_cms_admin_init() {
	global $pagenow, $post_type, $menu, $submenu, $wp_version;
	
	if ( isset( $_GET['post'] ) )
		$post_id = (int) esc_attr( $_GET['post'] );
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = (int) esc_attr( $_POST['post_ID'] );
	else
		$post_id = 0;
	
	$current_post_type = $post_type;
	if ( ! isset( $current_post_type ) )
		$current_post_type = get_post_type( $post_id );
	if ( ! $current_post_type )
		$current_post_type =  str_replace( 'post_type=', '', esc_attr( $_SERVER['QUERY_STRING'] ) );
	if ( ! $current_post_type ) // set hard to post
		$current_post_type = 'post';
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	
	$SuperCustomCMSoptions = get_option( 'supercustom_cms' );
	// pages for post type Post
	$def_post_pages = array( 'edit.php', 'post.php', 'post-new.php' );
	$def_post_types = array( 'post' );
	$disabled_metaboxes_post_all = array();
	// pages for post type Page
	$def_page_pages = array_merge( $def_post_pages, array( 'page-new.php', 'page.php' ) );
	$def_page_types = array( 'page' );
	$disabled_metaboxes_page_all = array();
	// pages for custom post types
	$def_custom_pages = $def_post_pages;
	$args = array( 'public' => TRUE, '_builtin' => FALSE );
	$def_custom_types = get_post_types( $args );
	// pages for link pages
	$link_pages = array( 'link.php', 'link-manager.php', 'link-add.php', 'edit-link-categories.php' );
	// pages for nav menu
	$nav_menu_pages = array( 'nav-menus.php' );
	// get admin color for current user
	$_mw_admin_color = get_user_option( 'admin_color' );
	
	foreach ( $user_roles as $role ) {
		$disabled_global_option_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_global_option_' . $role . '_items'
		);
		$disabled_metaboxes_post_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'
		);
		$disabled_metaboxes_page_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'
		);
		foreach ( $def_custom_types as $post_type ) {
			$disabled_metaboxes_[$post_type . '_' . $role] = __wp_supercustom_cms_get_option_value(
				'wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'
			);
		}
		$disabled_link_option_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_link_option_' . $role . '_items'
		);
		$disabled_nav_menu_option_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_nav_menu_option_' . $role . '_items'
		);
		array_push( $disabled_metaboxes_post_all, $disabled_metaboxes_post_[$role] );
		array_push( $disabled_metaboxes_page_all, $disabled_metaboxes_page_[$role] );
	}

	// global options
	// exclude super admin
	if ( ! __wp_supercustom_cms_exclude_super_admin() ) {
		$__wp_supercustom_cms_footer = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_footer' );
		switch ( $__wp_supercustom_cms_footer) {
		case 1:
			wp_enqueue_script( 
				'__wp_supercustom_cms_remove_footer', 
				WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/js/remove_footer.js', 
				array( 'jquery' )
			);
			break;
		}
	
		$__wp_supercustom_cms_header = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_header' );
		switch ( $__wp_supercustom_cms_header) {
		case 1:
			wp_enqueue_script( 
				'__wp_supercustom_cms_remove_header', 
				WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/js/remove_header.js', 
				array( 'jquery' ) 
			);
			break;
		}

		//post-page options
		if ( in_array( $pagenow, $def_post_pages ) ) {
		
			$__wp_supercustom_cms_writescroll = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_writescroll' );
			switch ( $__wp_supercustom_cms_writescroll ) {
			case 1:
				wp_enqueue_script( '__wp_supercustom_cms_writescroll', WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/js/writescroll.js', array( 'jquery' ) );
				break;
			}
			$__wp_supercustom_cms_tb_window = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_tb_window' );
			switch ( $__wp_supercustom_cms_tb_window) {
			case 1:
				wp_deregister_script( 'media-upload' );
				wp_enqueue_script(
					'media-upload', 
					WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/js/tb_window.js', 
					array( 'thickbox' )
				);
				break;
			}
			$__wp_supercustom_cms_timestamp = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_timestamp' );
			switch ( $__wp_supercustom_cms_timestamp) {
			case 1:
				wp_enqueue_script(
					'__wp_supercustom_cms_timestamp',
					WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/js/timestamp.js',
					array( 'jquery' )
				);
				break;
			}
			
			//category options
			$__wp_supercustom_cms_cat_full = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_cat_full' );
			switch ( $__wp_supercustom_cms_cat_full ) {
			case 1:
				wp_enqueue_style(
					'SuperCustomCMS-ful-category', 
					WP_PLUGIN_URL . '/' . FB_SUPERCUSTOM_CMS_BASEFOLDER . '/css/mw_cat_full.css'
				);
				break;
			}
			
			// set default editor tinymce
			if ( __wp_supercustom_cms_recursive_in_array( 
					'#editor-toolbar #edButtonHTML, #quicktags, #content-html', 
					$disabled_metaboxes_page_all
				)
				|| __wp_supercustom_cms_recursive_in_array(
					'#editor-toolbar #edButtonHTML, #quicktags, #content-html', 
					$disabled_metaboxes_post_all
				) )
				add_filter( 'wp_default_editor', create_function( '', 'return "tinymce";' ) );
			
			// remove media bottons
			if ( __wp_supercustom_cms_recursive_in_array( 'media_buttons', $disabled_metaboxes_page_all )
				|| __wp_supercustom_cms_recursive_in_array( 'media_buttons', $disabled_metaboxes_post_all ) )
				remove_action( 'media_buttons', 'media_buttons' );
				
			//add_filter( 'image_downsize', '__wp_supercustom_cms_image_downsize', 1, 3);
		}
	
		$__wp_supercustom_cms_control_flashloader = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_control_flashloader' );
		switch ( $__wp_supercustom_cms_control_flashloader) {
		case 1:
			add_filter( 'flash_uploader', '__wp_supercustom_cms_control_flashloader', 1 );
			break;
		}
	}
	
	// change Admin Bar and user Info
	if ( version_compare( $wp_version, '3.3alpha', '>=' ) ) {
		__wp_supercustom_cms_set_menu_option_33();
	} else {
		add_action( 'admin_head', '__wp_supercustom_cms_set_user_info' );
		add_action( 'wp_head', '__wp_supercustom_cms_set_user_info' );
	}
	// set menu option
	add_action( 'admin_head', '__wp_supercustom_cms_set_menu_option', 1 );
	// global_options
	add_action( 'admin_head', '__wp_supercustom_cms_set_global_option', 1 );
	
	// set metabox post option
	if ( in_array( $pagenow, $def_post_pages ) && in_array( $current_post_type, $def_post_types) )
			add_action( 'admin_head', '__wp_supercustom_cms_set_metabox_post_option', 1 );
	// set metabox page option
	if ( in_array( $pagenow, $def_page_pages ) && in_array( $current_post_type, $def_page_types) )
		add_action( 'admin_head', '__wp_supercustom_cms_set_metabox_page_option', 1 );
	// set custom post type options
	if ( function_exists( 'get_post_types' ) && 
		 in_array( $pagenow, $def_custom_pages ) && 
		 in_array( $current_post_type, $def_custom_types)
		)
		add_action( 'admin_head', '__wp_supercustom_cms_set_metabox_cp_option', 1 );
	// set link option
	if ( in_array( $pagenow, $link_pages ) )
		add_action( 'admin_head', '__wp_supercustom_cms_set_link_option', 1 );
	// set wp nav menu options
	if ( in_array( $pagenow, $nav_menu_pages ) )
		add_action( 'admin_head', '__wp_supercustom_cms_set_nav_menu_option', 1 );

	add_action( 'in_admin_footer', '__wp_supercustom_cms_admin_footer' );
	
	$SuperCustomCMSoptions['wp_supercustom_cms_default_menu'] = $menu;
	$SuperCustomCMSoptions['wp_supercustom_cms_default_submenu'] = $submenu;
	
	// if custom design of SuperCustomCMS; kill with version 1.7.18
	if ( ( $_mw_admin_color == 'mw_fresh' ) ||
		 ( $_mw_admin_color == 'mw_classic' ) ||
		 ( $_mw_admin_color == 'mw_colorblind' ) ||
		 ( $_mw_admin_color == 'mw_grey' ) ||
		 ( $_mw_admin_color == 'mw_fresh_ozh_am' ) ||
		 ( $_mw_admin_color == 'mw_classic_ozh_am' ) ||
		 ( $_mw_admin_color == 'mw_fresh_lm' ) ||
		 ( $_mw_admin_color == 'mw_classic_lm' ) ||
		 ( $_mw_admin_color == 'mw_wp23' )
		) {
		
		// only posts
		if ( ( 'post-new.php' == $pagenow ) || 
			 ( 'post.php' == $pagenow ) || 
			 ( 'post' == $post_type )
			) {
			if ( version_compare( substr( $wp_version, 0, 3), '2.7', '<' ) )
				add_action( 'admin_head', '__wp_supercustom_cms_remove_box', 99 );

			// check for array empty
			if ( !isset( $disabled_metaboxes_post_['editor']['0'] ) )
				$disabled_metaboxes_post_['editor']['0'] = '';
			if ( isset( $disabled_metaboxes_post_['administrator']['0'] ) )
			 $disabled_metaboxes_post_['administrator']['0'] = '';
			if ( version_compare(substr( $wp_version, 0, 3), '2.7', '<' ) ) {
				if ( !__wp_supercustom_cms_recursive_in_array( '#categorydivsb', $disabled_metaboxes_post_all ) )
					add_action( 'submitpost_box', '__wp_supercustom_cms_sidecat_list_category_box' );
				if ( !__wp_supercustom_cms_recursive_in_array( '#tagsdivsb', $disabled_metaboxes_post_all ) )
					add_action( 'submitpost_box', '__wp_supercustom_cms_sidecat_list_tag_box' );
			}
		}
		
		// only pages
		if ( ( 'page-new.php' == $pagenow ) || 
			 ( 'page.php' == $pagenow ) || 
			 ( 'post_type=page' == esc_attr( $_SERVER['QUERY_STRING'] ) ) ||
			 ( 'page' == $post_type )
			) {
			// check for array empty
			if ( !isset( $disabled_metaboxes_page_['editor']['0'] ) )
				$disabled_metaboxes_page_['editor']['0'] = '';
			if ( isset( $disabled_metaboxes_page_['administrator']['0'] ) )
				$disabled_metaboxes_page_['administrator']['0'] = '';
		}
	
	}
}


/**
 * add new adminstyle to usersettings
 * @param $file
 */
function __wp_supercustom_cms_admin_styles( $file ) {
	global $wp_version;

	$__wp_supercustom_cms_path = WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/css/';

	if ( version_compare( $wp_version, '3.0alpha', '>=' ) ) {
		
		// MW SuperCustomCMS Classic Tweak
		$styleName = 'SuperCustomCMS:' . ' Tweak ' . __( 'Blue' );
		wp_admin_css_color (
			'mw_classic_tweak', $styleName, $__wp_supercustom_cms_path . 'mw_classic28_tweak.css',
			array( '#073447', '#21759b', '#eaf3fa', '#bbd8e7' )
		);

		// MW SuperCustomCMS Fresh Tweak
		$styleName = 'SuperCustomCMS:' . ' Tweak ' . __( 'Gray' );
		wp_admin_css_color (
			'mw_fresh_tweak', $styleName, $__wp_supercustom_cms_path . 'mw_fresh28_tweak.css',
			array( '#464646', '#6d6d6d', '#f1f1f1', '#dfdfdf' )
		);
	
	}

	if ( version_compare( $wp_version, '2.7alpha', '>=' ) && version_compare( $wp_version, '3.0alpha', '<' ) ) {
		// MW SuperCustomCMS Classic
		$styleName = 'SuperCustomCMS:' . ' ' . __( 'Blue' );
		wp_admin_css_color (
			'mw_classic', $styleName, $__wp_supercustom_cms_path . 'mw_classic27.css',
			array( '#073447', '#21759b', '#eaf3fa', '#bbd8e7' )
		);

		// MW SuperCustomCMS Fresh
		$styleName = 'SuperCustomCMS:' . ' ' . __( 'Gray' );
		wp_admin_css_color (
			'mw_fresh', $styleName, $__wp_supercustom_cms_path . 'mw_fresh27.css',
			array( '#464646', '#6d6d6d', '#f1f1f1', '#dfdfdf' )
		);
		
		// MW SuperCustomCMS Classic Fixed
		$styleName = 'SuperCustomCMS:' . ' Fixed ' . __( 'Blue' );
		wp_admin_css_color (
			'mw_classic_fixed', $styleName, $__wp_supercustom_cms_path . 'mw_classic28_fixed.css',
			array( '#073447', '#21759b', '#eaf3fa', '#bbd8e7' )
		);

		// MW SuperCustomCMS Fresh Fixed
		$styleName = 'SuperCustomCMS:' . ' Fixed ' . __( 'Gray' );
		wp_admin_css_color (
			'mw_fresh_fixed', $styleName, $__wp_supercustom_cms_path . 'mw_fresh28_fixed.css',
			array( '#464646', '#6d6d6d', '#f1f1f1', '#dfdfdf' )
		);
		
		// MW SuperCustomCMS Classic Tweak
		$styleName = 'SuperCustomCMS:' . ' Tweak ' . __( 'Blue' );
		wp_admin_css_color (
			'mw_classic_tweak', $styleName, $__wp_supercustom_cms_path . 'mw_classic28_tweak.css',
			array( '#073447', '#21759b', '#eaf3fa', '#bbd8e7' )
		);

		// MW SuperCustomCMS Fresh Tweak
		$styleName = 'SuperCustomCMS:' . ' Tweak ' . __( 'Gray' );
		wp_admin_css_color (
			'mw_fresh_tweak', $styleName, $__wp_supercustom_cms_path . 'mw_fresh28_tweak.css',
			array( '#464646', '#6d6d6d', '#f1f1f1', '#dfdfdf' )
		);
		
	} elseif ( version_compare( $wp_version, '2.7alpha', '<' ) ) {
		// MW SuperCustomCMS Classic
		$styleName = 'MW SuperCustomCMS:' . ' ' . __( 'Classic' );
		wp_admin_css_color (
			'mw_classic', $styleName, $__wp_supercustom_cms_path . 'mw_classic.css',
			array( '#07273E', '#14568A', '#D54E21', '#2683AE' )
		);

		// MW SuperCustomCMS Fresh
		$styleName = 'MW SuperCustomCMS:' . ' ' . __( 'Fresh' );
		wp_admin_css_color (
			'mw_fresh', $styleName, $__wp_supercustom_cms_path . 'mw_fresh.css',
			array( '#464646', '#CEE1EF', '#D54E21', '#2683AE' )
		);

		// MW SuperCustomCMS WordPress 2.3
		$styleName = 'MW SuperCustomCMS:' . ' ' . __( 'WordPress 2.3' );
		wp_admin_css_color (
			'mw_wp23', $styleName, $__wp_supercustom_cms_path . 'mw_wp23.css',
			array( '#000000', '#14568A', '#448ABD', '#83B4D8' )
		);

		// MW SuperCustomCMS Colorblind
		$styleName = 'MW SuperCustomCMS:' . ' ' . __( 'Maybe i\'m colorblind' );
		wp_admin_css_color (
			'mw_colorblind', $styleName, $__wp_supercustom_cms_path . 'mw_colorblind.css',
			array( '#FF9419', '#F0720C', '#710001', '#550007', '#CF4529' )
		);

		// MW SuperCustomCMS Grey
		$styleName = 'MW SuperCustomCMS:' . ' ' . __( 'Grey' );
		wp_admin_css_color (
			'mw_grey', $styleName, $__wp_supercustom_cms_path . 'mw_grey.css',
			array( '#000000', '#787878', '#F0F0F0', '#D8D8D8', '#909090' )
		);
	}
	/**
	 * style and changes for plugin Admin Drop Down Menu
	 * by Ozh
	 * http://planetozh.com/blog/my-projects/wordpress-admin-menu-drop-down-css/
	 */
	if ( function_exists( 'wp_ozh_adminmenu' ) ) {

		// MW SuperCustomCMS Classic include ozh adminmenu
		$styleName = 'MW SuperCustomCMS inc. Admin Drop Down Menu' . ' ' . __( 'Classic' );
		wp_admin_css_color (
			'mw_classic_ozh_am', $styleName, $__wp_supercustom_cms_path . 'mw_classic_ozh_am.css',
			array( '#07273E', '#14568A', '#D54E21', '#2683AE' )
		);

		// MW SuperCustomCMS Fresh include ozh adminmenu
		$styleName = 'MW SuperCustomCMS inc. Admin Drop Down Menu' . ' ' . __( 'Fresh' );
		wp_admin_css_color (
			'mw_fresh_ozh_am', $styleName, $__wp_supercustom_cms_path . 'mw_fresh_ozh_am.css',
			array( '#464646', '#CEE1EF', '#D54E21', '#2683AE' )
		);

	}

	/**
	 * style and changes for plugin Lighter Menus
	 * by corpodibacco
	 * http://www.italyisfalling.com/lighter-menus
	 */
	if ( function_exists( 'lm_build' ) ) {

		// MW SuperCustomCMS Classic include Lighter Menus
		$styleName = 'MW SuperCustomCMS inc. Lighter Menus' . ' ' . __( 'Classic' );
		wp_admin_css_color (
			'mw_classic_lm', $styleName, $__wp_supercustom_cms_path . 'mw_classic_lm.css',
			array( '#07273E', '#14568A', '#D54E21', '#2683AE' )
		);

		// MW SuperCustomCMS Fresh include Lighter Menus
		$styleName = 'MW SuperCustomCMS inc. Lighter Menus' . ' ' . __( 'Fresh' );
		wp_admin_css_color (
			'mw_fresh_lm', $styleName, $__wp_supercustom_cms_path . 'mw_fresh_lm.css',
			array( '#464646', '#CEE1EF', '#D54E21', '#2683AE' )
		);

	}
}


function __wp_supercustom_cms_exclude_super_admin() {
	// exclude super admin
	if ( function_exists( 'is_super_admin' ) 
		&& is_super_admin() 
		&& 1 == __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_exclude_super_admin' )
	)
		return TRUE;
	
	return FALSE;
}
?>
