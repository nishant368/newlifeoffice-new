$j = jQuery.noConflict();
$j(document).ready(function () {
    
	InitBoxes();
    
    var loc = window.location;
    var pathName = loc.pathname.substring(loc.pathname.lastIndexOf('/') + 1);
    if(pathName=="admin.php" && ($j("body").has("#sheepItFormPictures").length == 1)){
						//////////////// speepItForm Clone Pistures
						var sheepItForm = {};
						var siForms;
						
						var numbers = new Array();
						var hiddenInput = $j('#sheepItFormPictures > input[type="hidden"]');
						
						// SheepIt Form Pictures
						sheepItForm = $j('#sheepItFormPictures').sheepIt({
							separator: '',
							allowRemoveLast: true,
							allowRemoveCurrent: true,
							allowRemoveAll: true,
							allowAdd: true,
							allowAddN: true,
							maxFormsCount: 30,
							minFormsCount: 1,
							iniFormsCount: 1,
							beforeClone: function(source, template) {
								var index = source.getFormsCount()+1;
								template.find('h4').html(index + ". Image");
							},
							afterAdd: function(source, newForm) {
								var currIndex = newForm.find('input[name="index_number"]').attr("value");
								numbers.push(currIndex);
								$j(hiddenInput).attr("value",numbers.toString());
							}
						});
						$j('#sheepItFormPictures #sheepItFormPictures_remove_last').click(function() {
							numbers.pop();
							$j(hiddenInput).attr("value",numbers.toString());
						});
						// default values
						var initValues = $j('#sheepItFormPictures .initValues').html().toString();
						if (initValues == 'yes') {
							
						} else {
							// get forms from JSON
							var jsonText = $j('#sheepItFormPictures .inputJSON').html().toString();
							
							var forms = $j.parseJSON(jsonText);
							// add n forms
							sheepItForm.addNForms(forms.length-1);
							// init forms
							for(i=0;i<forms.length;i++){
								$j('#sheepItFormPictures input[id="image_src_'+i+'"]').attr("value",forms[i][0]);
								$j('#sheepItFormPictures input[id="image_link_'+i+'"]').attr("value",forms[i][1]);
								$j('#sheepItFormPictures input[id="image_desc_'+i+'"]').attr("value",forms[i][2]);
							}
						}
						
						////////////// speepItForm Clone Home Slider
						var sheepItFormHomeSlider = {};
						var siFormsHomeSlider;
						
						var numbersHomeSlider = new Array();
						var hiddenInputHomeSlider = $j('#sheepItFormHomeSlider > input[type="hidden"]');
						
						// SheepIt Form Home Slider
						sheepItFormHomeSlider = $j('#sheepItFormHomeSlider').sheepIt({
							separator: '',
							allowRemoveLast: true,
							allowRemoveCurrent: true,
							allowRemoveAll: true,
							allowAdd: true,
							allowAddN: true,
							maxFormsCount: 30,
							minFormsCount: 1,
							iniFormsCount: 1,
							beforeClone: function(source, template) {
								var index = source.getFormsCount()+1;
								template.find('h4').html(index + ". Image");
							},
							afterAdd: function(source, newForm) {
								var currIndex = newForm.find('input[name="index_number_home_slider"]').attr("value");
								numbersHomeSlider.push(currIndex);
								$j(hiddenInputHomeSlider).attr("value",numbersHomeSlider.toString());
							}
						});
						$j('#sheepItFormHomeSlider #sheepItFormHomeSlider_remove_last').click(function() {
							numbersHomeSlider.pop();
							$j(hiddenInputHomeSlider).attr("value",numbersHomeSlider.toString());
						});
						
						// default values
						var initValues = $j('#sheepItFormHomeSlider .initValues').html().toString();
						if (initValues == 'yes') {
							sheepItFormHomeSlider.addNForms(2);
							
							// 1. Form
							$j('#sheepItFormHomeSlider input[id="img_src_0"]').attr("value",'wp-content/themes/fullscreen/images/empty_slide1.png');
							$j('#sheepItFormHomeSlider input[id="img_link_0"]').attr("value",'http://www.ait-themes.com');
							$j('#sheepItFormHomeSlider input[id="img_desc_0"]').attr("value",'Slide 1');
							$j('#sheepItFormHomeSlider input[id="img_background_0"]').attr("value",'wp-content/themes/fullscreen/images/default.jpg');
							// 2. Form
							$j('#sheepItFormHomeSlider input[id="img_src_1"]').attr("value",'wp-content/themes/fullscreen/images/empty_slide2.png');
							$j('#sheepItFormHomeSlider input[id="img_link_1"]').attr("value",'http://www.ait-themes.com');
							$j('#sheepItFormHomeSlider input[id="img_desc_1"]').attr("value",'Slide 2');
							$j('#sheepItFormHomeSlider input[id="img_background_1"]').attr("value",'wp-content/themes/fullscreen/images/default1.jpg');
							// 3. Form
							$j('#sheepItFormHomeSlider input[id="img_src_2"]').attr("value",'wp-content/themes/fullscreen/images/empty_slide3.png');
							$j('#sheepItFormHomeSlider input[id="img_link_2"]').attr("value",'http://www.ait-themes.com');
							$j('#sheepItFormHomeSlider input[id="img_desc_2"]').attr("value",'Slide 3');
							$j('#sheepItFormHomeSlider input[id="img_background_2"]').attr("value",'wp-content/themes/fullscreen/images/default2.jpg');
							
						} else {
						
							// get forms from JSON
							var jsonTextHomeSlider = $j('#sheepItFormHomeSlider .inputJSON').html().toString();
							
							var formsHomeSlider = $j.parseJSON(jsonTextHomeSlider);
							// add n forms
							sheepItFormHomeSlider.addNForms(formsHomeSlider.length-1);
							// init forms
							for(i=0;i<formsHomeSlider.length;i++){
								$j('#sheepItFormHomeSlider input[id="img_src_'+i+'"]').attr("value",formsHomeSlider[i][0]);
								$j('#sheepItFormHomeSlider input[id="img_link_'+i+'"]').attr("value",formsHomeSlider[i][1]);
								$j('#sheepItFormHomeSlider input[id="img_desc_'+i+'"]').attr("value",formsHomeSlider[i][2]);
								$j('#sheepItFormHomeSlider input[id="img_background_'+i+'"]').attr("value",formsHomeSlider[i][3]);
							}
						
						}	
	}
    
    // Color picker
    $j('#background_color').css('backgroundColor', $j('#background_color').attr('value'));    
	$j('#background_color').ColorPicker({
		color: $j('#background_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#background_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#background_color').val('#' + hex);		
			$j('#background_color').css('backgroundColor', '#' + hex);		
		}
	})

    $j('#titles_color').css('backgroundColor', $j('#titles_color').attr('value'));    
	$j('#titles_color').ColorPicker({
		color: $j('#titles_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#titles_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#titles_color').val('#' + hex);		
			$j('#titles_color').css('backgroundColor', '#' + hex);		
		}
	})
	
    $j('#left_box_title_color').css('backgroundColor', $j('#left_box_title_color').attr('value'));    
	$j('#left_box_title_color').ColorPicker({
		color: $j('#left_box_title_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#left_box_title_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#left_box_title_color').val('#' + hex);		
			$j('#left_box_title_color').css('backgroundColor', '#' + hex);		
		}
	})

    $j('#center_box_dark_title_color').css('backgroundColor', $j('#center_box_dark_title_color').attr('value'));
	$j('#center_box_dark_title_color').ColorPicker({
		color: $j('#center_box_dark_title_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_dark_title_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_dark_title_color').val('#' + hex);		
			$j('#center_box_dark_title_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#center_box_dark_subtitles_color').css('backgroundColor', $j('#center_box_dark_subtitles_color').attr('value'));    
	$j('#center_box_dark_subtitles_color').ColorPicker({
		color: $j('#center_box_dark_subtitles_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_dark_subtitles_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_dark_subtitles_color').val('#' + hex);		
			$j('#center_box_dark_subtitles_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#center_box_dark_links_color').css('backgroundColor', $j('#center_box_dark_links_color').attr('value'));
	$j('#center_box_dark_links_color').ColorPicker({
		color: $j('#center_box_dark_links_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_dark_links_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_dark_links_color').val('#' + hex);		
			$j('#center_box_dark_links_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#center_box_light_title_color').css('backgroundColor', $j('#center_box_light_title_color').attr('value'));
	$j('#center_box_light_title_color').ColorPicker({
		color: $j('#center_box_light_title_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_light_title_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_light_title_color').val('#' + hex);		
			$j('#center_box_light_title_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#center_box_light_subtitles_color').css('backgroundColor', $j('#center_box_light_subtitles_color').attr('value'));    
	$j('#center_box_light_subtitles_color').ColorPicker({
		color: $j('#center_box_light_subtitles_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_light_subtitles_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_light_subtitles_color').val('#' + hex);		
			$j('#center_box_light_subtitles_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#center_box_light_links_color').css('backgroundColor', $j('#center_box_light_links_color').attr('value'));
	$j('#center_box_light_links_color').ColorPicker({
		color: $j('#center_box_light_links_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#center_box_light_links_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#center_box_light_links_color').val('#' + hex);		
			$j('#center_box_light_links_color').css('backgroundColor', '#' + hex);		
		}
	})
		
    $j('#right_box_subtitles_color').css('backgroundColor', $j('#right_box_subtitles_color').attr('value'));    
	$j('#right_box_subtitles_color').ColorPicker({
		color: $j('#right_box_subtitles_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#right_box_subtitles_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#right_box_subtitles_color').val('#' + hex);		
			$j('#right_box_subtitles_color').css('backgroundColor', '#' + hex);		
		}
	})
	
	$j('#decor_lines_color').css('backgroundColor', $j('#decor_lines_color').attr('value'));    
	$j('#decor_lines_color').ColorPicker({
		color: $j('#decor_lines_color').attr('value'),
		onHide: function (colpkr) {
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#decor_lines_color').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
			$j('#decor_lines_color').val('#' + hex);		
			$j('#decor_lines_color').css('backgroundColor', '#' + hex);		
		}
	})
});

/* ******************************************************************************************
 * Boxes
 * ******************************************************************************************/
function InitBoxes() {
  $j('.theme-admin-head .expander-wrap').click(function () {
    $j(this).parent().parent().toggleClass('expanded');
    
    if ($j(this).text().toLowerCase() == 'open') 
        $j(this).text('close');
    else 
        $j(this).text('open');
        
    var admin_box = $j(this).parent().parent().parent();
    var content = admin_box.find('.theme-admin-content');
    content.toggleClass('expanded');
    
    if (content.hasClass('expanded')){
        //content.slideDown();
		content.show();
	} else {
        //content.slideUp();
		content.hide();
	}
  });
}
