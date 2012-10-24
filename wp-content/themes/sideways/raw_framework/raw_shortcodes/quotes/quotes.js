(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_quotes', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_quotes', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 360 + ed.getLang('raw_shortcode_quotes.delta_width', 0),
					height : 320 + ed.getLang('raw_shortcode_quotes.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// quotes
            ed.addButton('raw_quotes', {
                title : 'Insert pull quote',
                image : url+'/quotes.png',
				cmd : 'mce_raw_shortcode_quotes'
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

	tinymce.PluginManager.add('raw_quotes', tinymce.plugins.raw_shortcode_quotes);
	
})();