function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertTeamDutchShortcode() {
	var tagtext;
	var styleid = document.getElementById('style_shortcode').value;
	if(styleid != 0){
	  if(styleid == 'one_half_layout') {
	    tagtext = '[one_half]<br />Place your content here...<br />[/one_half]<br /><br />[one_half_last]<br />Place your content here...<br />[/one_half_last]<br />';
    } else if(styleid == 'one_third_layout') {
      tagtext = '[one_third]<br />Place your content here...<br />[/one_third]<br /><br />[one_third]<br />Place your content here...<br />[/one_third]<br /><br />[one_third_last]<br />Place your content here...<br />[/one_third_last]<br />';	
    } else if(styleid == 'one_third_two_third') {
    	tagtext = '[one_third]<br />Place your content here...<br />[/one_third]<br /><br />[two_third_last]<br />Place your content here...<br />[/two_third_last]<br />';
    } else if(styleid == 'two_third_one_third') {
      tagtext = '[two_third]<br />Place your content here...<br />[/two_third]<br /><br />[one_third_last]<br />Place your content here...<br />[/one_third_last]<br />';	
    } else if(styleid == 'one_fourth_layout') {
      tagtext = '[one_fourth]<br />Place your content here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Place your content here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Place your content here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Place your content here...<br />[/one_fourth_last]<br />';	
    } else if(styleid == 'one_fifth_layout') {
      tagtext = '[one_fifth]<br />Place your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Place your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Place your content here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Place your content here...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Place your content here...<br />[/one_fifth_last]<br />';	
    } else if(styleid == 'one_sixth_layout') {
      tagtext = '[one_sixth]<br />Place your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Place your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Place your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Place your content here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Place your content here...<br />[/one_sixth]<br /><br />[one_sixth_last]<br />Place your content here...<br />[/one_sixth_last]<br />';	
    } else if(styleid == 'td_titled_box' || styleid == 'header_box') {
      tagtext = '[' + styleid + ' title="Your Title"]Insert your text here[/' + styleid + ']';
    } else if(styleid == 'check_list' || styleid == 'bullet_list' || styleid == 'barcode_black_list' || styleid == 'barcode_red_list' || styleid == 'barcode_green_list' || styleid == 'barcode_blue_list' || styleid == 'barcode_orange_list' || styleid == 'chat_black_list' || styleid == 'chat_red_list' || styleid == 'chat_green_list' || styleid == 'chat_blue_list' || styleid == 'chat_orange_list' || styleid == 'check_black_list' || styleid == 'check_red_list' || styleid == 'check_green_list' || styleid == 'check_blue_list' || styleid == 'check_orange_list' || styleid == 'link_black_list' || styleid == 'link_red_list' || styleid == 'link_green_list' || styleid == 'link_blue_list' || styleid == 'link_orange_list' || styleid == 'map_black_list' || styleid == 'map_red_list' || styleid == 'map_green_list' || styleid == 'map_blue_list' || styleid == 'map_orange_list') {
      tagtext = '[' + styleid + ']<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/' + styleid + ']';
    } else if(styleid == 'toggle' || styleid == 'toggle_framed'){
		  tagtext = '[' + styleid + ' title="Toggle Title" variation=""]Insert your text here[/' + styleid + ']';
		} else if(styleid == 'dropcap1' || styleid == 'dropcap2' || styleid == 'dropcap3'){
			tagtext = "["+ styleid + "]A[/" + styleid + "]";
		} else if(styleid == 'framed_tabs'){
			tagtext = '[' + styleid + ' tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"]<br /><br />[tab]Tab content 1[/tab]<br />[tab]Tab content 2[/tab]<br />[tab]Tab content 3[/tab]<br /><br />[/' + styleid + ']';
		} else if(styleid == 'button'){
			tagtext = '[' + styleid + ' link="#" target="blank" size="small"]Read More[/' + styleid + ']';	
		} else if(styleid == 'td_link'){
			tagtext = '[' + styleid + ' link="#" target="blank"]Read More[/' + styleid + ']';	
		} else if(styleid == 'download_link'){
			tagtext = '[' + styleid + ' link="#"]Read More[/' + styleid + ']';	
		} else if(styleid == 'email_link'){
			tagtext = '[' + styleid + ' email="#"]Read More[/' + styleid + ']';	
		} else if(styleid == 'contact_info'){
			tagtext = '[' + styleid + ' name="your_name" address="your_address" city="your_city" state="your_state" zip="your_zip" phone="your_phone" email="your_email"]';
		} else if(styleid == 'divider_large'){
			tagtext = '[' + styleid + ']';
		} else if(styleid == 'divider_large_white'){
			tagtext = '[' + styleid + ']';
		} else if(styleid == 'divider_large_gray'){
			tagtext = '[' + styleid + ']';
		} else if(styleid == 'divider_short'){
			tagtext = '[' + styleid + ']';
		} else if(styleid == 'divider_short_white'){
			tagtext = '[' + styleid + ']';
		} else if(styleid == 'divider_short_gray'){
			tagtext = '[' + styleid + ']';
		}

	  	// Lightbox shortcodes
	  	else if(styleid == 'image'){
			tagtext = '['+ styleid +' src="http://" width="217" height="150" title="Your Image Title"]';
		}
	    else if(styleid == 'image_gallery'){
			tagtext = '['+ styleid +'  transition="fade" height="350" width="600" autoplay="false"]<br/>&nbsp;&nbsp;[image src="http://" ]<br/>[/' + styleid + ']';
		}
	  	else if(styleid == 'video'){
			tagtext = '['+ styleid +' src="http://" width="300" height="225" title="Your Video Title"]Insert text or image here[/'+ styleid +']';
		}
	    else if(styleid == 'video_gallery'){
			tagtext = '['+ styleid +' height="350" width="600" autoplay="false"]<br/>&nbsp;&nbsp;[video thumb_src="http://" video_src="http://" ]<br/>[/' + styleid + ']';
		}

	  else {
		  tagtext = '['+ styleid + ']Insert your text here[/' + styleid + ']';
    }
	}
	
	if(styleid == 0){
		tinyMCEPopup.close();
	}
	
	if(window.tinyMCE) {
	  window.tinyMCE.execInstanceCommand('_screen-home-text', 'mceInsertContent', false, tagtext);
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
