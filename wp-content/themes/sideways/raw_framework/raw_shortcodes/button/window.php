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
	<title>Button Shortcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url() ?>js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
		
	}
	
	function insertShortcode() {
		
		var output;
			
		var button_url = document.getElementById('button_url').value;
		var button_text = document.getElementById('button_text').value;
		var button_align = document.getElementById('button_align').value;
		
		if (button_text != '' ){
			
			output = '[button align="'+button_align+'" link="'+button_url+'"]'+button_text+'[/button] ';
		
		} else {
			
			alert('Please enter the text to appear on your button.');
			
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
		label span { color: #f00; }	
    </style>
    
</head>
<body onload="init();">

	<form name="raw_button_shortcode" action="#">

		<div class="panel_wrapper">
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Button URL:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">
				
					<tr>					
						<td nowrap="nowrap"><label for="button_style">URL:</label></td>						
						<td>							
							<input type="text" name="button_url" id="button_url" style="width: 230px;"></input>						
						</td>						
					</tr>
					  
				  </table>
				  
				<em style="font-size: 10px; padding: 5px 0 0 45px;">Enter the page the button will link to</em><br />
				<br />
			
			</fieldset>
			
			<br />
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Text:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">				  
					<tr>				 
						<td nowrap="nowrap"><label for="button_text"><span>*</span>Text:</label></td>					
						<td>					
							<input type="text" name="button_text" id="button_text" style="width: 230px;"></input>					
						</td>					
					</tr>				  
				</table>
			
				<em style="font-size: 10px; padding: 5px 0 0 45px;">Enter the text to be displayed on the button</em><br />
				<table border="0" cellpadding="4" cellspacing="0">				  
					<tr>					 
						<td nowrap="nowrap"><label for="button_align">Align:</label></td>
						<td>						
							<select name="button_align" id="button_align" style="width: 210px">
								<option value="left">Left</option>
								<option value="right">Right</option>
								<option value="center">center</option>
							</select>						
						</td>
					</tr>			  
				</table>
			
				<em style="font-size: 10px; padding: 5px 0 0 45px;">Select button alignment</em><br />
				<br />
			
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
