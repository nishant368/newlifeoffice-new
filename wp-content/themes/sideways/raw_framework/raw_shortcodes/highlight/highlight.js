(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_highlight', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_highlight', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_highlight.delta_width', 0),
					height : 210 + ed.getLang('raw_shortcode_highlight.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// boxes
            ed.addButton('raw_highlight', {
                title : 'Insert highlighted text',
                image : url+'/highlight.png',
				cmd : 'mce_raw_shortcode_highlight'
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

	tinymce.PluginManager.add('raw_highlight', tinymce.plugins.raw_shortcode_highlight);
	
})();