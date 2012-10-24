(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_divider', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_divider', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_divider.delta_width', 0),
					height : 140 + ed.getLang('raw_shortcode_divider.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// divider
            ed.addButton('raw_divider', {
                title : 'Insert divider',
                image : url+'/divider.png',
				cmd : 'mce_raw_shortcode_divider'
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

	tinymce.PluginManager.add('raw_divider', tinymce.plugins.raw_shortcode_divider);
	
})();