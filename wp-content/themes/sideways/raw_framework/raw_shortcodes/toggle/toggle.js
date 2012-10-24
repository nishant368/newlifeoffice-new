(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_toggle', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_toggle', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_toggle.delta_width', 0),
					height : 390 + ed.getLang('raw_shortcode_toggle.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// Toggle
			ed.addButton('raw_toggle', {
				title : 'Insert a toggled content',
				image : url+'/toggle.png',
				cmd : 'mce_raw_shortcode_toggle'
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

	tinymce.PluginManager.add('raw_toggle', tinymce.plugins.raw_shortcode_toggle);
	
})();