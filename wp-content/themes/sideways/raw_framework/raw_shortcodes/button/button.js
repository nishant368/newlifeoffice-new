(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_linkButton', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_button', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_button.delta_width', 0),
					height : 270 + ed.getLang('raw_shortcode_button.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// Button
            ed.addButton('raw_linkButton', {
                title : 'Insert a button link',
                image : url+'/button.png',
                cmd : 'mce_raw_shortcode_button'
            });
			
		},

		getInfo : function() {
			
			return {				
				longname : "Raw Shortcodes",
                author : 'Eugene Okoronkwo',
                authorurl : 'http://raw-brand.com/',
                infourl : 'http://raw-brand.com/',
                version : "1.0"				
			};
			
		}		
	});

	tinymce.PluginManager.add('raw_linkButton', tinymce.plugins.raw_shortcode_linkButton);
	
})();