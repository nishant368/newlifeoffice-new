(function() {

	tinymce.create('tinymce.plugins.raw_shortcode_dropcaps', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_dropcaps', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_dropcaps.delta_width', 0),
					height : 250 + ed.getLang('raw_shortcode_dropcaps.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// dropcaps
            ed.addButton('raw_dropcaps', {
                title : 'Insert dropcap',
                image : url+'/dropcaps.png',
				cmd : 'mce_raw_shortcode_dropcaps'
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

	tinymce.PluginManager.add('raw_dropcaps', tinymce.plugins.raw_shortcode_dropcaps);
	
})();