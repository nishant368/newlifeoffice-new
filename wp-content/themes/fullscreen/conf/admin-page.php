<?php
// Edit this data structure to change the form in WordPress:
$sp_boxes = array (
	'Hide wordpress title on page (show alternative title if is set)' =>     
		array (             
			array( 'page_hide_title', 
				   '<strong class="title-inline">Hide:</strong>', 
				   'checkbox' 
				 ),
		),
	'Show featured image on page' =>     
		array (             
			array( 'page_show_featured_image', 
				   '<strong class="title-inline">Show:</strong>', 
				   'checkbox' 
				 ),
		),
	'Hide center-box closing button' =>     
		array (             
			array( 'page_hide_box', 
				   '<strong class="title-inline">Hide:</strong>', 
				   'checkbox' 
				 ),
		),
	'Alternative title on page' =>     
		array (             
			array( 'page_alternative_title', 
				   '<strong class="title-inline">Alternative title:</strong>', 
				   'textarea' 
				 ),
		),
	'Hide center-box backround on page' =>     
		array (             
			array( 'page_hide_cb_background', 
				   '<strong class="title-inline">Hide: </strong>', 
				   'checkbox'
				 ),
		),
	'Center-box background variant' =>     
		array (             
			array( 'center_box_bg_variant', 
				   '<strong class="title-inline">Select background variant:</strong>', 
				   'background_variant'
				 ),
		),
	'Background image on page' =>     
		array (             
			array( 'page_background_image', 
				   '<strong class="title-inline">Image URL</strong>', 
				   'image_url' 
				 ),
		),	
);


// Do not edit past this point.
// Use the admin_menu action to define the custom boxes
add_action( 'admin_menu', 'sp_add_custom_box' );
// Use the save_post action to do something with the data entered
// Save the custom fields
add_action( 'save_post', 'sp_save_postdata', 1, 2 );
// Adds a custom section to the "advanced" Post and Page edit screens
function sp_add_custom_box() {
	global $sp_boxes;
	if ( function_exists( 'add_meta_box' ) ) {
		foreach ( array_keys( $sp_boxes ) as $box_name ) {
			add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'post', 'normal', 'high' );
			add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'page', 'normal', 'high' );
		}
	}
}

function sp_post_custom_box ( $obj, $box ) {
	global $sp_boxes;
	static $sp_nonce_flag = false;
	// Run once
	if ( ! $sp_nonce_flag ) {
		echo_sp_nonce();
		$sp_nonce_flag = true;
	}
	// Genrate box contents
	foreach ( $sp_boxes[$box['id']] as $sp_box ) {
		echo field_html( $sp_box );
	}
}
function field_html ( $args ) {
	switch ( $args[2] ) {
		case 'textarea':
			return text_area( $args );
		case 'checkbox':
			// Checkbox  
			return check_box ( $args );
		case 'background_variant':
			// Dropmenu  
			return background_variant ( $args );
		case 'image_url':
			// Image URL
			return image_url ($args);
		case 'text':
		default:
			return text_field( $args );
	}
}

function image_url ( $args ) {
	global $post;
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format =
		  '<label for="%1$s">%2$s</label>'
		. '<input style="width: 100%%;" type="text" id="%1$s" name="%1$s" value="%3$s" />';
	return vsprintf( $label_format, $args );
}

function background_variant ( $args ) {
	global $post;
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );

	$label_format =
		  '<label for="%1$s">%2$s</label>'
		. '<select name="%1$s" style="font-size:14px;width:400px;">';

	$options = array(
        'Use global setting',
        'Light',
        'Dark'
    );
    
	foreach ($options as $option) {
		$label_format .= '<option value="'.$option.'"';
		
		if ( get_post_meta($post->ID, $args[0], true) == $option ) { 
			$label_format .= ' selected="selected"'; 
		}
		
		$label_format .= '>'.$option.'</option>';
	}
	
	$label_format .= "</select>";
	
	return vsprintf( $label_format, $args );
}

function check_box ( $args ) {
	global $post;
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$checked="";
	if ( get_post_meta($post->ID, $args[0], true) == "yes" ) { $checked='checked="checked"'; }
	$label_format =
		  '<label for="%1$s">%2$s</label>'
		. '<input type="checkbox" style="width: auto;" '.$checked.' name="%1$s" value="yes" /><br /><br />';
	return vsprintf( $label_format, $args );
}

function text_field ( $args ) {
	global $post;
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format =
		  '<label for="%1$s">%2$s</label>'
		. '<input style="width: 95%%;" type="text" name="%1$s" value="%3$s" /><br /><br />';
	return vsprintf( $label_format, $args );
}
function text_area ( $args ) {
	global $post;
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format =
		  '<label for="%1$s">%2$s</label>'
		. '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';
	return vsprintf( $label_format, $args );
}
/* When the post is saved, saves our custom data */
function sp_save_postdata($post_id, $post) {
	global $sp_boxes;
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	// Is the user allowed to edit the post or page?
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
	} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
	}
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	// The data is already in $sp_boxes, but we need to flatten it out.
	foreach ( $sp_boxes as $sp_box ) {
		foreach ( $sp_box as $sp_fields ) {
			$my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
		}
	}
	// Add values of $my_data as custom fields
	// Let's cycle through the $my_data array!
	foreach ($my_data as $key => $value) {
		if ( 'revision' == $post->post_type  ) {
			// don't store custom data twice
			return;
		}
		// if $value is an array, make it a CSV (unlikely)
		$value = implode(',', (array)$value);
		if ( get_post_meta($post->ID, $key, FALSE) ) {
			// Custom field has a value.
			update_post_meta($post->ID, $key, $value);
		} else {
			// Custom field does not have a value.
			add_post_meta($post->ID, $key, $value);
		}
		if (!$value) {
			// delete blanks
			delete_post_meta($post->ID, $key);
		}
	}
}
function echo_sp_nonce () {
	// Use nonce for verification ... ONLY USE ONCE!
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'sp_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
// A simple function to get data stored in a custom field
if ( !function_exists('get_custom_field') ) {
	function get_custom_field($field) {
	   global $post;
	   $custom_field = get_post_meta($post->ID, $field, true);
	   echo $custom_field;
	}
}
?>
