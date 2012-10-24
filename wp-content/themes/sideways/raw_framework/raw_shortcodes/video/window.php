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
	<title>Video Shortcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url() ?>js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript">
		function init() {
			
			tinyMCEPopup.resizeToInnerSize();
		
		}
		
		function insertShortcode() {
			
			var output;
			
			var title = document.getElementById('video_title').value;
			var url = document.getElementById('video_url').value;
			
			var image = document.getElementById('video_image').value;
			if ( image != '' ) {
				image = 'image="'+image+'" ';
			} else {
				image = '';
			}
			
			var height = document.getElementById('video_height').value;
			if ( height != '' ) {
				height = 'height="'+height+'" ';
			} else {
				height = 'height="270" ';
			}
			
			var width = document.getElementById('video_width').value;
			if ( width != '' ) {
				width = 'width="'+width+'" ';
			} else {
				width = 'width="480" ';
			}
			
			var align = document.getElementById('video_align').value;
			if ( align != '' ) {
				align = 'align="'+align+'" ';
			} else {
				align = 'align="none" ';
			}
			
			var controlbar = document.getElementById('video_controlbar').value;
			if ( controlbar == 'true' ) {
				controlbar = 'controlbar="true" ';
			} else {
				controlbar = '';
			}
			
			var autostart = document.getElementById('video_autostart').value;
			if ( autostart == 'true' ) {
				autostart = 'autostart="true" ';
			} else {
				autostart = '';
			}
			
			var icons = document.getElementById('video_icons').value;
			if ( icons == 'false' ) {
				icons = 'icons="false" ';
			} else {
				icons = '';
			}
			
			var stretching = document.getElementById('video_stretching').value;
			if ( stretching == 'none' ) {
				stretching = '';
			} else {
				stretching = 'stretching="'+stretching+'" ';
			}
			
			var skin = document.getElementById('video_skin').value;
			if ( skin != '' ) {
				skin = 'skin="'+skin+'" ';
			} else {
				skin = '';
			}
			
			if ( url != '' && title != '' ){
			
				output = '[video title="'+title+'" url="'+url+'" '+image+height+width+align+controlbar+autostart+icons+stretching+skin+' ]';				
			
			} else {
				
				alert('Please enter the title and URL of your video.');
				
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

	<form name="raw_video_shortcodes" action="#">
	
		<div class="panel_wrapper">
			
			<fieldset style="padding-left: 15px;">
			
				<legend>Options:</legend>
				
				<br />
			
				<table border="0" cellpadding="4" cellspacing="0">
					<tr>				 
						<td nowrap="nowrap"><label for="video_title"><span>*</span>Title:</label></td>					
						<td>					
							<input type="text" name="video_title" id="video_title" style="width: 230px"></input>					
						</td>				
					</tr>
					<tr>				 
						<td nowrap="nowrap"><label for="video_url"><span>*</span>URL:</label></td>					
						<td>					
							<input type="text" name="video_url" id="video_url" style="width: 230px"></input>					
						</td>				
					</tr>
					<tr>				 
						<td nowrap="nowrap"><label for="video_image">Preview Image URL:</label></td>					
						<td>					
							<input type="text" name="video_image" id="video_image" style="width: 230px"></input>					
						</td>				
					</tr>					
					<tr>				 
						<td nowrap="nowrap"><label for="video_height">Height:</label></td>					
						<td>					
							<input type="text" name="video_height" id="video_height" style="width: 230px"></input>					
						</td>				
					</tr>
					<tr>				 
						<td nowrap="nowrap"><label for="video_width">Width:</label></td>					
						<td>					
							<input type="text" name="video_width" id="video_width" style="width: 230px"></input>					
						</td>				
					</tr>
					<tr>					 
						<td nowrap="nowrap"><label for="video_align">Align:</label></td>
						<td>						
							<select name="video_align" id="video_align" style="width: 210px">                        
								<option value="none">None</option>
								<option value="alignleft">Left</option>
								<option value="alignright">Right</option>
								<option value="aligncenter">center</option>
							</select>						
						</td>
					</tr>
					<tr>					 
						<td nowrap="nowrap"><label for="video_controlbar">Control Bar:</label></td>
						<td>						
							<select name="video_controlbar" id="video_controlbar" style="width: 210px">                        
								<option value="bottom">Bottom</option>
								<option value="over">Over</option>
								<option value="top">Top</option>
							</select>						
						</td>
					</tr>
					<tr>					 
						<td nowrap="nowrap"><label for="video_autostart">Auto Start:</label></td>
						<td>						
							<select name="video_autostart" id="video_autostart" style="width: 210px">                        
								<option value="false">False</option>
								<option value="true">True</option>
							</select>						
						</td>
					</tr>
					<tr>					 
						<td nowrap="nowrap"><label for="video_icons">Show Icons:</label></td>
						<td>						
							<select name="video_icons" id="video_icons" style="width: 210px">								
								<option value="true">True</option>
								<option value="false">False</option>
							</select>						
						</td>
					</tr>					
					<tr>					 
						<td nowrap="nowrap"><label for="video_stretching">Stretching:</label></td>
						<td>						
							<select name="video_stretching" id="video_stretching" style="width: 210px">                        
								<option value="fill">Fill</option>
								<option value="exact">Exact</option>
								<option value="uniform">Uniform</option>
								<option value="none">None</option>
							</select>						
						</td>
					</tr>
					<tr>				 
						<td nowrap="nowrap">
							<label for="video_skin">Player Skin:</label></td>					
						<td>					
							<input type="text" name="video_skin" id="video_skin" style="width: 230px"></input>					
						</td>						
					</tr>					
				</table>

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