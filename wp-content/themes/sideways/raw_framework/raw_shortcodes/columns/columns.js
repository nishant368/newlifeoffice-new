(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_columns', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_columns', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_columns.delta_width', 0),
					height : 255 + ed.getLang('raw_shortcode_columns.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// columns
            ed.addButton('raw_columns', {
                title : 'Insert column',
                image : url+'/columns.png',
				cmd : 'mce_raw_shortcode_columns'
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

	tinymce.PluginManager.add('raw_columns', tinymce.plugins.raw_shortcode_columns);
	
})();