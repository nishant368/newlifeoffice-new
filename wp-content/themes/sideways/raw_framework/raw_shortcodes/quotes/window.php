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
	<title>Quote Shortcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url() ?>js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
		
		var selectedContent = tinyMCE.activeEditor.selection.getContent();
		
		if(selectedContent != '') {
			
			document.getElementById('quote_text').value = selectedContent;
			
		}
		
	}
	
	function insertShortcode() {
		
		var output;
	
		var quote_style = document.getElementById('quote_style').value;
		var quote_text = document.getElementById('quote_text').value;
			
		if (quote_text != '' ){
		
			if ( quote_style == 'right' ){
				output = '[quote_right] '+quote_text+' [/quote_right] ';
			} else if ( quote_style == 'left') {
				output = '[quote_left] '+quote_text+' [/quote_left] ';
			}
		
		} else {
			
			alert('Please enter your quote text.');
			
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

	<form name="raw_box_shortcodes" action="#">
	
		<div class="panel_wrapper">
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Styling:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">
				
					<tr>					 
						<td nowrap="nowrap"><label for="quote_style">Style:</label></td>
						<td>						
							<select name="quote_style" id="quote_style" style="width: 210px">                        
								<option value="left">Left Pull Quote</option>
								<option value="right">Right Pull Quote</option>          
							</select>						
						</td>						
					</tr>					  
				</table>
				  
				<em style="font-size: 10px;padding: 5px 0 0 45px;">Choose the style of quote to be insterted</em>
				<br /><br />
			
			</fieldset>
			
			<br />
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Text:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">				  
					<tr>				 
						<td nowrap="nowrap"><label for="quote_text"><span>*</span>Text:</label></td>					
						<td>					
							<textarea type="text" name="quote_text" id="quote_text" style="width: 230px" rows="7"></textarea>					
						</td>				
					</tr>				  
				</table>
				
				<em style="font-size: 10px;padding: 5px 0 0 45px;">Enter the text to be displayed in this quote</em>
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
