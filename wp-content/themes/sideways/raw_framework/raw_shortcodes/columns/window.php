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
	<title>Column Shortcodes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url() ?>js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
		
	}
	
	function insertShortcode() {
		
		var output;
		var width;
		
		var column_width = document.getElementById('column_width').value;
		var column_last = document.getElementById('column_last').checked;
			
		if ( column_width == '14' ){
			
			width = 'fourth';
			
		} else if ( column_width == '13' ){
			
			width = 'third';
		
		} else if ( column_width == '12' ){
			
			width = 'half';
		
		} else if ( column_width == '23' ){
			
			width = 'twothirds';
		
		}
		
		if ( column_last == true ) {
		
			output = '['+width+' end="true"] *your content goes here* [/'+width+']';
			
		} else {
		
			output = '['+width+'] *your content goes here* [/'+width+']';
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

	<form name="raw_columns_shortcode" action="#">

		<div class="panel_wrapper">	
	
			<fieldset style="padding-left: 15px;">
			
				<legend>Column Width:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">				
					<tr>					 
						<td nowrap="nowrap"><label for="column_width">Width</label></td>						
						<td>							
							<select name="column_width" id="column_width" style="width: 210px;">                        
								<!--<option value="14">One Fourth</option>-->
								<option value="13">One Third</option>
								<option value="12">One Half</option>
								<option value="23">Two Thirds</option>
							</select>						
						</td>						
					</tr>					  
				</table>
				  
				<em style="font-size: 10px; padding: 5px 0 0 45px;">Choose the width of the column to be insterted</em><br/>
				<br/>
				
			</fieldset>
			
			<br />
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Options:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">				  
					<tr>
						<td nowrap="nowrap"><label for="column_last">This is the last column in a row:</label></td>
						<td>
							<input type="checkbox" name="column_last" id="column_last" value="checked" style="width: 50px;"></input>					
						</td>					
					</tr>					  
				</table>
			 
				<em style="font-size: 10px; padding: 5px 0 0">Select the option above if this is the last column in a row. This will remove its right margin</em><br/>
				<br/>
			
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
