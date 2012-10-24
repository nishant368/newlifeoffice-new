(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_youtube', {		 
		init : function(ed, url) {
			
			// YouTube
            ed.addButton('raw_youtube', {
                title : 'Insert YouTube video',
                image : url+'/youtube.png',
                onclick : function() {
                    var vidId = prompt("YouTube Video", "Enter the id of your YouTube video");
                    if (vidId != null && vidId != 'undefined') {
                        ed.execCommand('mceInsertContent', false, '[youtube id="'+vidId+'" title="*VIDEO TITLE*"] ');
					}
                }
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

	tinymce.PluginManager.add('raw_youtube', tinymce.plugins.raw_shortcode_youtube);
	
})();