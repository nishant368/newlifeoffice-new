(function() {

	tinymce.create('tinymce.plugins.raw_shortcode_video', {		 
		init : function(ed, url) {
			
			ed.addCommand('mce_raw_shortcode_video', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 450 + ed.getLang('raw_shortcode_video.delta_width', 0),
					height : 500 + ed.getLang('raw_shortcode_video.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
			});
			
			// video
            ed.addButton('raw_video', {
                title : 'Insert embedded video',
                image : url+'/video.png',
				cmd : 'mce_raw_shortcode_video'
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

	tinymce.PluginManager.add('raw_video', tinymce.plugins.raw_shortcode_video);
	
})();