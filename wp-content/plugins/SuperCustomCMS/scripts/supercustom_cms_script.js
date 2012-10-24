function supercustom_cms_menus() {
	// Set initial open/close
	jQuery('#menus > li').each(function() {
  		var submenu = jQuery('ul',this);
  		
  		if(jQuery(submenu).length>0) {
			jQuery(submenu).slideDown(500);
			jQuery("em",this).text("↓");
		}
  			
  		if(jQuery('input:eq(0)',this).is(':checked')) {
  			if(jQuery(submenu).length>0) {
  				jQuery(submenu).slideDown(500);
  				jQuery("em",this).text("↑");
  			}
  		} else {
  			if(jQuery(submenu).length>0) {
  				jQuery(submenu).hide();
  				jQuery("em",this).text("↓");
  			}
  		}
  	});
  	
  	// On click
	jQuery('#menus span').click(function() {
  		var parent = jQuery(this).parent().parent();
  		var submenu = jQuery('ul',parent);
  		jQuery(submenu).slideToggle(500,function() {
  			var parent = jQuery(this).parent();
			jQuery("em",parent).text(jQuery(submenu).is(':visible') ? "↑" : "↓");
  		});
  	});
  	
	// On click
	jQuery('#menus input').click(function() {
  		var parent = jQuery(this).parent().parent();
  		var submenu = jQuery('ul',parent);
  		if(jQuery(this).is(':checked')) {
  			if(jQuery(submenu).length>0) {
  				jQuery(submenu).slideDown(500);
  				jQuery('li',submenu).each(function() {
  					jQuery('input',this).attr('checked','checked');
  				});
  			}
  		} else {
  			if(jQuery(submenu).length>0) {
  				jQuery(submenu).slideUp(500);
  				jQuery('li',submenu).each(function() {
  					jQuery('input',this).removeAttr('checked');
  				});
  			}
  		}
  	});
}

jQuery(document).ready(function($){
    supercustom_cms_menus();
  	
    	
    $('#supercustom_cms_o_edit_role').parent().css('borderTop','0');
    $('#roles_capabilities').parent().css('paddingLeft','30px').css('paddingRight','30px').css('paddingBottom','10px');
    
    jQuery('.edit_role_name').hide();
	jQuery('#supercustom_cms_o_head_cap').hide();
	/**/
	jQuery('.supercustom_cms_o_modify_sub_menu').hide();

/**/
    	/*jQuery('#footer-left').remove();*/
    
		jQuery('.supercustom_cms_options').slideUp();
		
		jQuery('.video-h').hover(function() {
			jQuery(this).addClass('pretty-hover');
		}, function() {
			jQuery(this).removeClass('pretty-hover');
		});

		var showHideWelcome;
		var formField;
		
		showHideWelcome = jQuery('.supercustom_cms_opts form #form-show-welcome input:radio:checked').val();
		if(showHideWelcome == 0) {
			jQuery('.video-h').hide();
		}
		
		 jQuery('.supercustom_cms_opts form #form-show-welcome input:radio').click(function() {
		 	showHideWelcome = jQuery('.supercustom_cms_opts form #form-show-welcome input:radio:checked').val();
			if(showHideWelcome == 0) {
				jQuery('.video-h').hide();
			} else {
				jQuery('.video-h').show();
			}
		 });
		
  
		jQuery('.supercustom_cms_section h3').click(function(){		
			if(jQuery(this).parent().next('.supercustom_cms_options').css('display')=='none')
				{	jQuery(this).removeClass('inactive');
					jQuery(this).addClass('active');
					jQuery(this).children('img').removeClass('inactive');
					jQuery(this).children('img').addClass('active');
					
				}
			else
				{	jQuery(this).removeClass('active');
					jQuery(this).addClass('inactive');		
					jQuery(this).children('img').removeClass('active');			
					jQuery(this).children('img').addClass('inactive');
				}
				
			jQuery(this).parent().next('.supercustom_cms_options').slideToggle('slow');	
		});
		
		jQuery('#radioWebsite').click(function() {
			jQuery('input[name=supercustom_cms_o_hide_posts]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_media]').attr('checked', false);
			jQuery('input[name=supercustom_cms_o_hide_links]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_pages]').attr('checked', false);			
			jQuery('input[name=supercustom_cms_o_hide_comments]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_users]').attr('checked', true);			
			jQuery('input[name=supercustom_cms_o_hide_tools]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_separator2]').attr('checked', true);		
			jQuery('input[name=supercustom_cms_o_show_appearance]').attr('checked', false);		
			jQuery('input[name=supercustom_cms_o_show_widgets]').attr('checked', false);					
		});

		jQuery('#radioBlog').click(function() {
			jQuery('input[name=supercustom_cms_o_hide_posts]').attr('checked', false);
			jQuery('input[name=supercustom_cms_o_hide_media]').attr('checked', false);
			jQuery('input[name=supercustom_cms_o_hide_links]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_pages]').attr('checked', false);			
			jQuery('input[name=supercustom_cms_o_hide_comments]').attr('checked', false);
			jQuery('input[name=supercustom_cms_o_hide_users]').attr('checked', true);			
			jQuery('input[name=supercustom_cms_o_hide_tools]').attr('checked', true);
			jQuery('input[name=supercustom_cms_o_hide_separator2]').attr('checked', true);			
			jQuery('input[name=supercustom_cms_o_show_appearance]').attr('checked', false);		
			jQuery('input[name=supercustom_cms_o_show_widgets]').attr('checked', false);					
		});

		jQuery('.supercustom_cms_input_local_video').click(function() {
			if(jQuery('label',this).hasClass('supercustom_cms_o_parent_label_active')) {
				jQuery('.supercustom_cms_o_parent_label_active',this).removeClass('supercustom_cms_o_parent_label_active');
			} else {
				jQuery('.supercustom_cms_o_parent_label',this).addClass('supercustom_cms_o_parent_label_active');
			}
			
			jQuery(this).next('.supercustom_cms_o_modify_sub_menu').slideToggle('slow');	
		});

		jQuery('#radioCustom').click(function() {
			if (jQuery('#supercustom_cms_o_hide_posts').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_posts]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_posts]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_media').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_media]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_media]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_links').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_links]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_links]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_pages').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_pages]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_pages]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_comments').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_comments]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_comments]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_users').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_users]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_users]').attr('checked', false); }
			if (jQuery('#supercustom_cms_o_hide_tools').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_tools]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_tools]').attr('checked', false); }			
			if (jQuery('#supercustom_cms_o_hide_separator2').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_hide_separator2]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_hide_separator2]').attr('checked', false); }			
			if (jQuery('#supercustom_cms_o_show_appearance').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_show_appearance]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_show_appearance]').attr('checked', false); }			
			if (jQuery('#supercustom_cms_o_show_widgets').is('.supercustom_cms_remChecked')) { jQuery('input[name=supercustom_cms_o_show_widgets]').attr('checked', true); } else { jQuery('input[name=supercustom_cms_o_show_widgets]').attr('checked', false); }			

		});
		
		
		// Set default value
		
		jQuery(".default-text").focus(function(srcc){
		    if (jQuery(this).val() == jQuery(this)[0].title){
		    	jQuery(this).val("");
		    }
		});

		jQuery(".default-text").blur(function(){
		    if (jQuery(this).val() == "" || isNaN(jQuery(this).val())){
		    	jQuery(this).val(jQuery(this)[0].title);
		    }
		});
/***********************************************************************************/
		jQuery(".add").click(function(){
		    if (jQuery("#supercustom_cms_o_role_name").val() == ""){
		    	alert("must fill role name");
		    	return false;

		    }

		});

/*hide roles_capabilities*/
var roleName;


jQuery('#supercustom_cms_o_edit_role').change(function() {
		jQuery('.edit_role_name').hide();
		jQuery('#supercustom_cms_o_head_cap').show();
		roleName=jQuery("#supercustom_cms_o_edit_role").val();
		if(roleName==0)
			jQuery('#supercustom_cms_o_head_cap').hide();
		 	
		jQuery('#roles_'+roleName).show();
			
		 });

/**/

/***********************************************************************************/

		jQuery(".default-text").blur();
		
		
		// Add http with devoloper url if not exist
		
		jQuery("#supercustom_cms_o_developer_url").blur(function() {
			  var input = jQuery(this);
			  var val = input.val();
			  if (val && !val.match(/^http([s]?):\/\/.*/)) {
			    input.val('http://' + val);
			  }
		});

		
	

    	

// Ajax function goes here


/*$.ajax({
  url: "supercustom-cms-plugin.php",
  context: document.body,
  success: function update_function(){
alert("hai";
    $(this).addClass("done");
  }
});*/
////////////////////////////////////////////////
});
    