(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_boxes', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_boxes', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_boxes.delta_width', 0),
					height : 310 + ed.getLang('raw_shortcode_boxes.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// boxes
            ed.addButton('raw_boxes', {
                title : 'Insert styled box',
                image : url+'/boxes.png',
				cmd : 'mce_raw_shortcode_boxes'
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

	tinymce.PluginManager.add('raw_boxes', tinymce.plugins.raw_shortcode_boxes);
	
})();