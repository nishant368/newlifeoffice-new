$j = jQuery.noConflict();
$j(document).ready(function () {
	
	setMediaUpload();
	
	$j('#sheepItFormHomeSlider_add').click(function(){
		setMediaUpload();
	});
	
	$j('#sheepItFormPictures_add').click(function(){
		setMediaUpload();
	});
	
});

function setMediaUpload(){
	
	var mediaUpload = '';
	
	$j('input[type="button"].media-select').click(function() { 
	 var buttonID = $j(this).attr("id").toString();
	 var inputID = buttonID.replace("_selectMedia", "");
	 formfield = inputID;
	 mediaUpload = inputID;
	 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 return false;
	});
	
	window.send_to_editor = function(html) {
	 var imgurl = $j('img',html).attr('src');
	 $j('#'+mediaUpload).val(imgurl);
	 tb_remove();
	}
}
