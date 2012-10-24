(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_lists', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_lists', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_lists.delta_width', 0),
					height : 140 + ed.getLang('raw_shortcode_lists.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// lists
            ed.addButton('raw_lists', {
                title : 'Insert list',
                image : url+'/lists.png',
				cmd : 'mce_raw_shortcode_lists'
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

	tinymce.PluginManager.add('raw_lists', tinymce.plugins.raw_shortcode_lists);
	
})();