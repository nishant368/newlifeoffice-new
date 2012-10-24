<div class="wrap supercustom_cms_wrap">
<div class="supercustom_cms_opts">
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="supercustom_cms_" value="<?php echo _wp_supercustomcms_; ?>" />
<?php foreach ($_wp_supercustomcms_Options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
 case "closeonce":
?>
 
</div>

 
<?php break;

case "close":
?>
 
</div>
<br />

 
<?php break;

case "menus":

global $menu, $submenu;
	
//echo '<pre>';print_r($menu); print_r($submenu);
 

echo '<ul id="menus">';

	foreach($menu as $m_key => $menu_item):
		
		if(!$menu_item[0]) { continue; }
		
		echo '<li><strong><input type="checkbox" value="1" name="supercustom_cms_o_hide_menu_'.$m_key.'" '.( get_option( 'supercustom_cms_o_hide_menu_'.$m_key ) ? 'checked="checked" ' : '' ).' /> <span>'.$menu_item[0] . ' <em></em></span> </strong>';
		
			if( isset( $submenu[ $menu_item[2] ] ) ):
				
				echo '<ul >';
			
				foreach($submenu[ $menu_item[2] ] as $sm_key => $submenu_item):
				
					echo '<li><input type="checkbox"  value="1"  name="supercustom_cms_o_hide_submenu_'.$m_key .'_'.$sm_key.'" '. ( get_option( 'supercustom_cms_o_hide_submenu_'.$m_key .'_'.$sm_key ) ? 'checked="checked" ' : '') .'/> '.$submenu_item[0].'</li>';	
				
				endforeach;		
			
				echo '</ul>';
				
			endif;
				
		
		echo '</li>';


	endforeach;
	
echo '</ul>';
 
?>
		 
	
<?php

break;
 
case "title":
?>

<?php break;
 
case 'text':
?>
<?php if ($value['id']=='supercustom_cms_o_header_custom_logo' || $value['id']=='supercustom_cms_o_footer_custom_logo' )  {  ?>

<div style="border:0;" class="supercustom_cms_input supercustom_cms_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" class="<?php echo $value['class']; ?>" title="<?php echo $value['title']; ?>"/><?php echo $value['unit']?>
 <small><?php echo $value['desc']; ?></small>
<div class="clearfix"></div>
 
 </div>
 
<?php } else {       ?>
<div class="supercustom_cms_input supercustom_cms_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
 	<input 
 		name="<?php echo $value['id']; ?>" 
 		id="<?php echo $value['id']; ?>" 
 		type="<?php echo $value['type']; ?>" 
 		value="<?php 	if ( get_option( $value['id'] ) != "") 
 						{ echo stripslashes(get_option( $value['id'])  ); } 
 						else 
 						{ echo $value['std']; } ?>" 
		class="<?php echo (isset($value['class']) ? $value['class'] : '' ); ?>"
		title="<?php echo (isset($value['title']) ? $value['title'] : '' ); ?>" />
		<?php echo (isset($value['unit']) ? $value['unit'] : '' );?>
		
 	<small><?php echo $value['desc']; ?></small>
 	<div class="clearfix"></div>
 
 </div>

<?php }  ?>
 <?php break;
////////////////////////////////////////////////////////////////////////////////************************************************************************//
case 'textcustom':
?>

<div class="supercustom_cms_input supercustom_cms_text">
	
	<label for="<?php echo $value['id']; ?>" title="CSS filename relative from <?php echo get_stylesheet_directory_uri();?>/" ><?php echo $value['name']; ?>   </label>
 	
 	<input 
 		name="<?php echo $value['id']; ?>" 
 		id="<?php echo $value['id']; ?>" 
 		type="<?php echo $value['type']; ?>" 
 		value="<?php if ( get_option( $value['id'] ) != "") 
 			{ echo stripslashes(get_option( $value['id'])  ); } 
 			else 
 			{ echo $value['std']; } ?>" 
 				
		class="<?php echo (isset($value['class']) ? $value['class'] : '' ); ?>" 
		title="<?php echo (isset($value['title']) ? $value['title'] : '' ); ?>"/> 
 
 <?php echo (isset($value['unit']) ? $value['unit'] : '' );?>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>


 <?php break;
//********************************************************************/////////////////////////////////////////////////////////////////////////////////////
 
  case "file":
?>

<div class="supercustom_cms_input supercustom_cms_file">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"/>
 	<input name="upload_image_button" type="button" value="Upload" rel="<?php echo $value['id']; ?>" class="<?php echo $value['class']; ?>"/>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

</div> 
 <?php
break;

case "import_file":
?>
	<div class="supercustom_cms_input import_file">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="file" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"/>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

</div> 
<?php 	
break;
	
/******************************************************************/
case "button":
?>

<div class="supercustom_cms_input supercustom_cms_file">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	
 	<input name="export_button" type="submit" value="Export" class="<?php echo $value['class']; ?>"/>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>


</div> 
 <?php
break;

/*******************************************************************/
 case 'textlocalvideo':
?>

<div class="supercustom_cms_input_local_video supercustom_cms_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  <?php break;
 case 'message':
?>
<div class="supercustom_cms_input_message supercustom_cms_text">
	<div id="icon-users" class="supercustom-cms-icon32"><br></div><?php echo $value['name']; ?>
 </div>
<?php
break;

case 'message2':
?>
<div class="supercustom_cms_input_message supercustom_cms_text">
	<div id="icon-themes" class="supercustom-cms-icon32"><br></div><?php echo $value['name']; ?>
 </div>
<?php
break;
/*************************************/
case 'message3':
?>
<div class="supercustom_cms_input_message1 supercustom_cms_text">
	<?php echo $value['name']; ?>
 </div>
<?php
break;
/*************************************/
 
case 'textarea':
?>

<div class="supercustom_cms_input_welcome_last supercustom_cms_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="supercustom_cms_input supercustom_cms_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<option value="0">choose a role</option>
<?php foreach ($value['options'] as $role => $option) { ?>
		<option value="<?php echo $role;?>"<?php if (get_option( $value['id'] ) == $role) { echo 'selected="selected"'; } elseif ($role==$value['std']) {echo 'selected="selected"';} ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
//////////////////////////////////////////////////
 case 'selectnew':
?>
<div class="supercustom_cms_optsnew">
<div class="supercustom_cms_input supercustom_cms_select">
	<label for="<?php echo $value['idname']; ?>"><?php echo $value['name']; ?></label>
<span class="lineup"><input name="<?php echo $value['idname']; ?>" id="<?php echo $value['idname']; ?>" type="text" value="<?php if ( get_option( $value['idname'] ) != "") { echo stripslashes(get_option( $value['idname'])  ); } else { echo $value['std']; } ?>" />	<br />
<?php echo $value['label']; ?><br />
<select name="<?php echo $value['idlabel']; ?>" id="<?php echo $value['idlabel']; ?>">
<?php foreach ($value['options'] as $role => $option) { ?>
		<option value="<?php echo $role;?>"<?php if (get_option( $value['idlabel'] ) == $role) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
<br />
<input name="add_button" type="submit" value="add" class="<?php echo $value['class']; ?>"/></span>	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
</div>
<?php
break;
case 'selectnewnew':
?>
<div class="supercustom_cms_optsnew">
<div class="supercustom_cms_input supercustom_cms_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>


<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $role => $option) { ?>
		<option value="<?php echo $role;?>"<?php if (get_option( $value['id'] ) == $role) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

<input name="delete_button" OnClick="javascript:return confirm('<?php _e('WARNING! Deleting a role can have severe consequences, proceed only if you know what you are doing.','_wp_supercustomcms_')?>');" type="submit" value="delete" class="<?php echo $value['class']; ?>"/>	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
</div>
<?php
break;



 case "headings":
?>
<label id="<?php echo (isset($value['id']) ? $value['id'] : '' ); ?>"><?php echo $value['heading']; ?> </label>
<small><?php echo (isset($value['desc']) ?  $value['desc'] : '' ); ?></small><div class="clearfix"></div>
<?php
break;
///////////////////////////////////////////////////
case "checkboxlast":
 case "checkbox":
?>

<div class="<?php if($value['type']  == 'checkbox') { echo 'supercustom_cms_input_local_video'; } else { echo 'supercustom_cms_checkbox_last'; }?> supercustom_cms_checkbox">

	<label id="<?php echo $value['id']; ?>" class="<?php echo (!empty($value['class'])?$value['class']:'');?>"><?php echo (isset($value['name']) ? $value['name'] : ''); ?></label>
	
<?php
if(get_option($value['id']))
    {  
        $checked = "checked=\"checked\""; $remChecked = 'supercustom_cms_remChecked';
    }
elseif ( ( ! get_option( 'supercustom_cms_o_ver' ) ) && ($value['std'] == '1') )
    {   
        $checked = "checked=\"checked\"";
        $remChecked = 'supercustom_cms_remChecked';
    }
else
    {
        $checked = '';
        $remChecked = '';
    }
?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> class="<?php echo $remChecked; ?>" />
<?php echo (isset($value['label']) ? $value['label'] : '' ); ?>


	<small><?php echo ( isset($value['desc'] ) ? $value['desc'] : '' ); ?></small><div class="clearfix"></div>
 </div>
 <?php
break;



case "divopen":
?>
<div id="<?php echo $value['id']; ?>" class="<?php echo $value['class']; ?>">
<?php
break;

case "divclose":
?>
</div>
<?php
break;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case "checkboxnewnew":
?>

<div class="<?php if($value['type']  == 'checkbox') { echo 'supercustom_cms_input_local_video'; } else { echo 'supercustom_cms_checkbox_last'; }?> supercustom_cms_checkbox">

	
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; $remChecked = 'supercustom_cms_remChecked'; }else{ $checked = ""; $remChecked = '';} ?>


<table>
<?php 
echo $value['options'];
?></table>

	<small><?php echo (isset($value['desc']) ? $value['desc'] : '' ); ?></small><div class="clearfix"></div>
 </div>
 <?php
break;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case "checkboxlastv3":
	// only show if version 3 of WordPress or above
	global $wp_version;
	if (substr($wp_version,0,3) < 3) {
		echo 'ssssssss<div class="supercustom_cms_checkbox_last supercustom_cms_checkbox">';
		echo '<input type="hidden" name="' . $value['id'] . '" id="' . $value['id'] . '" value="" />';
		echo '<div class="clearfix"></div>';
		echo '</div>';
	} else {
		
		?>
<div class="<?php if($value['type']  == 'checkbox') { echo 'supercustom_cms_input_local_video'; } else { echo 'supercustom_cms_checkbox_last'; }?> supercustom_cms_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; $remChecked = 'supercustom_cms_remChecked'; }else{ $checked = ""; $remChecked = '';} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> class="<?php echo $remChecked; ?>" />

<?php echo (isset($value['label']) ? $value['label'] : '' ); ?>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php 
	}
break; 
case "radio":
?>

<div class="supercustom_cms_input supercustom_cms_radio" <?php if($value['id'] == 'supercustom_cms_o_show_welcome') { echo ' id="form-show-welcome" '; }?> <?php if($value['id'] == 'supercustom_cms_o_editor_template_access') { echo ' id="form-show-template" '; }?>>
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

<?php 
$counter = 1; 
foreach ($value['options'] as $option) { ?>
	<?php $checked=''; if( get_option($value['id']) && (get_option($value['id']) ==  $option)){ $checked = "checked=\"checked\""; }elseif( (! get_option($value['id']) ) && $option == $value['std']){ $checked = "checked=\"checked\""; } else { $checked = ""; } ?>
	<label class="radioyesno"> <?php  if ($counter == 1) { echo 'Yes '; } else { echo 'No '; } ?><input type="radio" name="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php echo $checked; ?> /></label>
<?php
$counter++;
}
?>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
/************************************************/
case "radionew":
?>

<div class="supercustom_cms_radioinput supercustom_cms_radio" <?php if($value['id'] == 'supercustom_cms_o_show_welcome') { echo ' id="form-show-welcome" '; }?> >
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

<?php 
$counter = 1;
foreach ($value['options'] as $option) { ?>
	<?php if(get_option($value['id']) ==  $option){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
	<label class="radioyesno"><?php if ($counter == 1) { echo 'Yes '; } else { echo 'No '; } ?><input type="radio" name="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php echo $checked; ?> /></label>
<?php
$counter++;
}
?>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
/************************************************/
case "radioprofile":
?>

<div class="supercustom_cms_input_profile" <?php if($value['id'] == 'supercustom_cms_o_show_welcome') { echo ' id="form-show-welcome" '; }?> >
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

<?php 
$counter = 1;
foreach ($value['options'] as $option) { ?>
		<?php 
			switch ($counter) {
				case 1:
					$profileName = 'Custom';
					if(get_option($value['id']) ==  1){ $checked = "checked=\"checked\""; }else{ $checked = ""; }
					break;
				case 2:
					$profileName = 'Website';
					if(get_option($value['id']) ==  2){ $checked = "checked=\"checked\""; }else{ $checked = ""; }
					break;
				case 3:
					$profileName = 'Blog';
					if(get_option($value['id']) ==  3){ $checked = "checked=\"checked\""; }else{ $checked = ""; }					
					break;
			}		
		?>
		<label class="radio<?php echo $profileName;?>"><?php echo $profileName;?><input type="radio" name="supercustom_cms_o_radio_profiles" class="<?php echo $value['id']; ?>" value="<?php echo $counter; ?>" <?php echo $checked; ?> id="radio<?php echo $profileName; ?>" /></label>
<?php
$counter++;
}
?>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div> 
<?php break; 


case "subtitle":
?>
	<div class="supercustom_cms_section">
		<div class="supercustom_cms_subtitle">
			<h3><?php echo $value['name']; ?></h3>
			<div class="clearfix"></div>
		</div>
	</div>
<?php 
break;
case "section":

$i++;

?>
<div class="supercustom_cms_section">
<div class="supercustom_cms_title"><h3><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php echo $value['name']; ?></h3><span class="submitt"><input name="save<?php echo $i; ?>" type="submit" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " class="button-abc"/>
</span><div class="clearfix"></div></div>
<div class="supercustom_cms_options" style="display: none;">
<?php break;
case "subsection":
?>
<div id="v<?php echo str_replace(" ", "", $value['name']); ?>" class="video-h">
<h4><?php echo $value['name']; ?> <span class="submit"><input type="submit" value="clear" onclick="clearvid('v<?php echo str_replace(" ", "", $value['name']); ?>');return false;" /></span></h4>
<div class="clearfix"></div>


<?php break;
case "subsectionvars":
?>
<div id="v<?php echo str_replace(" ", "", $value['name']); ?>" class="video-h">
<h4><?php echo $value['name']; ?></h4>
<div class="clearfix"></div>
 
<?php break;
 
}  
}
?>
 
<input type="hidden" name="action" value="save" />
 </form>
 </div>

<?php 
if (!get_option('wpm_o_user_id')):
?>
<?php
endif;
?>
</div>