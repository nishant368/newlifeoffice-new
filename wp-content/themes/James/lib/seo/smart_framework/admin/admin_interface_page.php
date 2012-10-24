<?php
/* smartSeo Admin (plugin) Interface Page */
function smartSeo_create_settings_page(){
	global $smartSeo, $prefix;
	$prefix = $smartSeo->prefix;
	
	$utils = $smartSeo->utils;
?>

<div class="wrap" id="smartSeo_fields">	
<?php 
	$action_response = smartSeo_save_admin_options();
	if ( $action_response == 'saved' ) { ?><div style="clear:both;"></div><div class="happy"><?php echo $utils['shortname']; ?>'s Options has been updated!</div><?php } 
	if ( $action_response == 'reset' ) { ?><div style="clear:both;"></div><div class="warning"><?php echo $utils['shortname']; ?>'s Options has been reset!</div><?php } 

	// Errors
	/* Check if no duplicate id options */
	function check_option_ids() {
		global $admin_options, $all_ids, $smartSeo;
		
		$options = array_merge($admin_options);
		
		smart_array_walk_recursive($options, 'all_ids');
		$all_ids = array_count_values($all_ids);
		
		foreach($all_ids as $id => $count) {
			if($count>1) $errors_print .= "The ID <b>$id</b> is repeating $count times. <br />";
		}
		return $errors_print;
	}
	
	function all_ids($item, $key) { 
		global $all_ids; 
		if($key === "id") $all_ids[] = $item;
	}    
	
	$errors_print .= check_option_ids();
	
	$error_occurred = false;
	$upload_tracking = get_option('smartSeo_upload_tracking');
	if(!empty($upload_tracking)){
	$output = '<div class="errors"><ul>' . "\n";
		$error_shown == false;
		foreach($upload_tracking as $array )
		{
			 if(array_key_exists('error', $array)){
					$error_occurred = true;
					$errors_print .= '<li><strong>' . $array['option_name']. '</strong>: ' .  $array['error'] . '</li>' . "\n";
			}
		}
	} 
	
	if($errors_print<>'') {
		$error_occurred = true;
	}
		
	if($error_occurred) {
		$output = '<div class="errors"><ul>' . "\n";
		$output .= $errors_print;
		$output .= '</ul></div>' . "\n";
		echo $output;
	}
		
	delete_option('smartSeo_upload_tracking');
	?>

	
	
	<?php 
	//*****************************************************//
	
	if($_GET['step'] == 4) update_option("{$prefix}_installed", 'yes');

	$installed_theme = get_option("{$prefix}_installed");
	
		echo '<div style="height:15px;"></div>';
		echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post"  enctype="multipart/form-data">';
	
		//Generate the admin page contet, all input custom data
		echo smartSeo_options_page_content();
	
	//*****************************************************//
	?>
	
  <?php  wp_nonce_field('reset_options'); echo "\n"; ?>

	<p class="submit submit-footer">
		<input name="save" type="submit" value="Save All Changes" />
		<input type="hidden" name="smartSeo_save" value="save" />
	</p>
  
	<div style="clear:both;"></div>
</form>
    
<div style="clear:both;"></div>    
</div>
 <?php
}