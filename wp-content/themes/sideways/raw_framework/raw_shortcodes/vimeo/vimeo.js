(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_vimeo', {		 
		init : function(ed, url) {
			
			// YouTube
            ed.addButton('raw_vimeo', {
                title : 'Insert Vimeo video',
                image : url+'/vimeo.png',
                onclick : function() {
                    var vidId = prompt("Vimeo Video", "Enter the id of your Vimeo video");
                    if (vidId != null && vidId != 'undefined') {
                        ed.execCommand('mceInsertContent', false, '[vimeo id="'+vidId+'"] ');
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

	tinymce.PluginManager.add('raw_vimeo', tinymce.plugins.raw_shortcode_vimeo);
	
})();