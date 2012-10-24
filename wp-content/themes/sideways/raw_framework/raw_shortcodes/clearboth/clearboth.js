(function() {
	
	tinymce.create('tinymce.plugins.raw_shortcode_clearboth', {		 
		init : function(ed, url) {
			
			// Clearboth
            ed.addButton('raw_clearboth', {
                title : 'Reset top margins',
                image : url+'/clearboth.png',
                onclick : function() {
                    ed.execCommand('mceInsertContent', false, '[clearboth] ');
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

	tinymce.PluginManager.add('raw_clearboth', tinymce.plugins.raw_shortcode_clearboth);
	
})();