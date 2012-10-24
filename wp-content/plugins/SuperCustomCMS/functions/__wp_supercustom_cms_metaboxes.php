<?php


/**
 * list category-box in sidebar
 * @uses $post_ID
 */
function __wp_supercustom_cms_sidecat_list_category_box() {
	global $post_ID;
	?>

	<div class="inside" id="categorydivsb">
		<p><strong><?php _e("Categories"); ?></strong></p>
		<ul id="categorychecklist" class="list:category categorychecklist form-no-clear">
		<?php wp_category_checklist( $post_ID); ?>
		</ul>
	<?php if ( !defined( 'WP_PLUGIN_DIR' ) ) { // for wp <2.6 ?>
		<div id="category-adder" class="wp-hidden-children">
			<h4><a id="category-add-toggle" href="#category-add" class="hide-if-no-js" tabindex="3"><?php _e( '+ Add New Category' ); ?></a></h4>
			<p id="category-add" class="wp-hidden-child">
				<input type="text" name="newcat" id="newcat" class="form-required form-input-tip" value="<?php _e( 'New category name' ); ?>" tabindex="3" />
				<?php wp_dropdown_categories( array( 'hide_empty' => 0, 'name' => 'newcat_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => __( 'Parent category' ), 'tab_index' => 3 ) ); ?>
				<input type="button" id="category-add-sumbit" class="add:categorychecklist:category-add button" value="<?php _e( 'Add' ); ?>" tabindex="3" />
				<?php wp_nonce_field( 'add-category', '_ajax_nonce', FALSE ); ?>
				<span id="category-ajax-response"></span>
			</p>
		</div>
	<?php } else { ?>
		<div id="category-adder" class="wp-hidden-children">
			<h4><a id="category-add-toggle" href="#category-add" class="hide-if-no-js" tabindex="3"><?php _e( '+ Add New Category' ); ?></a></h4>
			<p id="category-add" class="wp-hidden-child">
				<label class="hidden" for="newcat"><?php _e( 'Add New Category' ); ?></label><input type="text" name="newcat" id="newcat" class="form-required form-input-tip" value="<?php _e( 'New category name' ); ?>" tabindex="3" aria-required="TRUE"/>
				<br />
				<label class="hidden" for="newcat_parent"><?php _e( 'Parent category' ); ?>:</label><?php wp_dropdown_categories( array( 'hide_empty' => 0, 'name' => 'newcat_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => __( 'Parent category' ), 'tab_index' => 3 ) ); ?>
				<input type="button" id="category-add-sumbit" class="add:categorychecklist:category-add button" value="<?php _e( 'Add' ); ?>" tabindex="3" />
				<?php wp_nonce_field( 'add-category', '_ajax_nonce', FALSE ); ?>
				<span id="category-ajax-response"></span>
			</p>
		</div>
	<?php } ?>
	</div>
<?php
}


/**
 * list tag-box in sidebar
 * @uses $post_ID
 */
function __wp_supercustom_cms_sidecat_list_tag_box() {
	global $post_ID;

	if ( !class_exists( 'SimpleTagsAdmin' ) ) {
	?>
	<div class="inside" id="tagsdivsb">
		<p><strong><?php _e( 'Tags' ); ?></strong></p>
		<p id="jaxtag"><label class="hidden" for="newtag"><?php _e( 'Tags' ); ?></label><input type="text" name="tags_input" class="tags-input" id="tags-input" size="40" tabindex="3" value="<?php echo get_tags_to_edit( $post_ID); ?>" /></p>
		<div id="tagchecklist"></div>
	</div>
	<?php
	}
}


/**
 * remove default categorydiv
 * @echo script
 */
function __wp_supercustom_cms_remove_box() {

	if ( function_exists( 'remove_meta_box' ) ) {
		if ( !class_exists( 'SimpleTagsAdmin' ) )
			remove_meta_box( 'tagsdiv', 'post', 'normal' );
		
		remove_meta_box( 'categorydiv', 'post', 'normal' );
	} else {
		$__wp_supercustom_cms_sidecat_admin_head  = "\n" . '<script type="text/javascript">' . "\n";
		$__wp_supercustom_cms_sidecat_admin_head .= "\t" . 'jQuery(document).ready(function() { jQuery(\'#categorydiv\' ).remove(); });' . "\n";
		$__wp_supercustom_cms_sidecat_admin_head .= "\t" . 'jQuery(document).ready(function() { jQuery(\'#tagsdiv\' ).remove(); });' . "\n";
		$__wp_supercustom_cms_sidecat_admin_head .= '</script>' . "\n";

		echo $__wp_supercustom_cms_sidecat_admin_head;
	}
}
/**
 * set metabox options from database an area post
 */
function __wp_supercustom_cms_set_metabox_post_option() {
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	$__wp_supercustom_cms_admin_head = '';

	// remove_action( 'admin_head', 'index_js' );

	foreach ( $user_roles as $role ) {
		$disabled_metaboxes_post_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_metaboxes_post_' . $role . '_items'
		);
		
		if ( ! isset( $disabled_metaboxes_post_[$role]['0'] ) )
			$disabled_metaboxes_post_[$role]['0'] = '';
		
		// new 1.7.8
		foreach ( $user_roles as $role ) {
			$user = wp_get_current_user();
			if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
				if ( current_user_can( $role ) && 
					 isset( $disabled_metaboxes_post_[$role] ) && 
					 is_array( $disabled_metaboxes_post_[$role] ) 
					) {
					$metaboxes = implode( ',', $disabled_metaboxes_post_[$role] );
				}
			}
		}
	}

	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . 
		$metaboxes . ' {display: none !important;}</style>' . "\n";
	
	if ( $metaboxes)
		echo $__wp_supercustom_cms_admin_head;
}


/**
 * set metabox options from database an area page
 */
function __wp_supercustom_cms_set_metabox_page_option() {
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	
	$__wp_supercustom_cms_admin_head = '';
	
	// remove_action( 'admin_head', 'index_js' );
	
	foreach ( $user_roles as $role ) {
		$disabled_metaboxes_page_[$role] = __wp_supercustom_cms_get_option_value(
			'wp_supercustom_cms_disabled_metaboxes_page_' . $role . '_items'
		);
		
		if ( ! isset( $disabled_metaboxes_page_[$role]['0'] ) )
			$disabled_metaboxes_page_[$role]['0'] = '';

		// new 1.7.8
		foreach ( $user_roles as $role ) {
			$user = wp_get_current_user();
			if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
				if ( current_user_can( $role ) 
					 && isset( $disabled_metaboxes_page_[$role] ) 
					 && is_array( $disabled_metaboxes_page_[$role] )
					) {
					$metaboxes = implode( ',', $disabled_metaboxes_page_[$role] );
				}
			}
		}
	}
	
	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . 
		$metaboxes . ' {display: none !important;}</style>' . "\n";
	
	if ( $metaboxes)
		echo $__wp_supercustom_cms_admin_head;
}


/**
 * set metabox options from database an area post
 */
function __wp_supercustom_cms_set_metabox_cp_option() {
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	if ( isset( $_GET['post'] ) )
		$post_id = (int) $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = (int) $_POST['post_ID'];
	else
		$post_id = 0;
	
	$current_post_type = $GLOBALS['post_type'];
	if ( ! isset( $current_post_type ) )
		$current_post_type = get_post_type( $post_id );
	if ( ! isset($current_post_type) || ! $current_post_type )
		$current_post_type =  str_replace( 'post_type=', '', esc_attr( $_SERVER['QUERY_STRING'] ) );
	if ( ! $current_post_type ) // set hard to post
		$current_post_type = 'post';
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();

	$__wp_supercustom_cms_admin_head = '';

	// remove_action( 'admin_head', 'index_js' );
	
	foreach ( $user_roles as $role ) {
		$disabled_metaboxes_[$current_post_type . '_' . $role] = __wp_supercustom_cms_get_option_value( 
			'wp_supercustom_cms_disabled_metaboxes_' . $current_post_type . '_' . $role . '_items'
		);
		
		if ( ! isset( $disabled_metaboxes_[$current_post_type . '_' . $role]['0'] ) )
			$disabled_metaboxes_[$current_post_type . '_' . $role]['0'] = '';
		
		foreach ( $user_roles as $role ) {
			$user = wp_get_current_user();
			if ( is_array( $user->roles ) && in_array( $role, $user->roles ) ) {
				if ( current_user_can( $role ) 
					 && isset( $disabled_metaboxes_[$current_post_type . '_' . $role] ) 
					 && is_array( $disabled_metaboxes_[$current_post_type . '_' . $role] ) 
					) {
					$metaboxes = implode( ',', $disabled_metaboxes_[$current_post_type . '_' . $role] );
				}
			}
		}
	}
	
	$__wp_supercustom_cms_admin_head .= '<style type="text/css">' . 
		$metaboxes . ' {display: none !important;}</style>' . "\n";
	
	if ( $metaboxes )
		echo $__wp_supercustom_cms_admin_head;
}
?>
