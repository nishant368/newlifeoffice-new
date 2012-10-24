<?php
	
	// Setup location of WordPress
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];

	// Access WordPress
	require_once( $path_to_wp.'/wp-load.php' );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Styled Lists Shortcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url() ?>js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
		
	}
	
	function insertShortcode() {
		
		var output;
	
		var list_style = document.getElementById('list_style').value;
			
		if ( list_style == 'tick' ){
		
			output = '[list style="tick"] <li>*List Item*</li> [/list] ';
		
		} else if ( list_style == 'cross' ){
		
			output = '[list style="cross"] <li>*List Item*</li> [/list] ';
			
		} else if ( list_style == 'circle' ){
		
			output = '[list style="circle"] <li>*List Item*</li> [/list] ';
			
		} else if ( list_style == 'square' ){
		
			output = '[list style="sqaure"] <li>*List Item*</li> [/list] ';
			
		}
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, output);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
	<base target="_self" />
    
	<style type="text/css">	
		label span { color: #F00; }	
    </style>
    
</head>
<body onload="init();">

	<form name="raw_list_shortcode" action="#">
	
		<div class="panel_wrapper">
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Style:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">				
					<tr>					 
						<td nowrap="nowrap"><label for="list_style">Style</label></td>						
						<td>							
							<select name="list_style" id="list_style" style="width: 230px">                        
								<option value="tick">Tick</option>
								<option value="cross">Cross</option>
								<option value="circle">Circle</option>
								<option value="square">Square</option>
							</select>						
						</td>						
					</tr>				  
				</table>
				  
				<em style="font-size: 10px; padding: 5px 0 0 45px;">Choose the list style to be insterted</em>
				<br /><br />
			
			</fieldset>
			
		</div>

		<div class="mceActionPanel">
			<input type="button" id="cancel" name="cancel" value="Close" style="float: left" onclick="tinyMCEPopup.close();" />
			<input type="submit" id="insert" name="insert" value="Insert" style="float: right" onclick="insertShortcode();" />
		</div>
		
	</form>
	
</body>
</html>
<?php

?>
