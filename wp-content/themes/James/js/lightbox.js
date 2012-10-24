
jQuery(document).ready(function(){
	
		jQuery("a[rel='lightbox_image']").colorbox();
		jQuery("a[rel='lightbox_video']").each(setZoomIcon);
		jQuery("a[rel='lightbox_image']").each(setZoomIcon);
	});

	function setZoomIcon(ind) {
		if (this.getElementsByTagName('img').length == 0) return true;

		var icon = 'image_icon_play.png'
		if( this.rel == 'lightbox_image' ) icon = 'image_icon_zoom.png';

		var zoom;
		var link = jQuery(this);
		var img = link.find('img:first');
		link.append(
				zoom = jQuery("<img src='" + themeDir + "/images/" + icon + "' class='lb_zoom' />")
				);

		var size = img.height();
		if (img.height() > img.width()) size = img.width();

		var pos = jQuery(this).offset();

		zoom.css({position: 'absolute', height: size + 'px', width: size + 'px'});

		zoom.offset({
			left: pos.left + Math.round((img.width() - zoom.width()) / 2)
		});

		if (jQuery.browser.mozilla) {
			zoom.offset({
				left: img.offset().left + Math.round((img.width() - zoom.width()) / 2)
			});
		}
			
			if (jQuery.browser.msie) {
			zoom.offset({
				top:  img.offset().top  + Math.round((img.height() - zoom.height()) / 2),
				left: img.offset().left + Math.round((img.width() - zoom.width()) / 2)
			});
		}



		if (jQuery.browser.msie) {
			var left = zoom.offset().left;
			if (left < 0) left = -left;
			zoom.offset({
				left: left + Math.round((img.width() - zoom.width()) / 2),
				top: img.offset().top
			});
			zoom.hide();
		} else {
			zoom.css({opacity: 0})
		}

		link.hover(
				function() {
					var zoom = jQuery(this).find('img.lb_zoom');
					if (jQuery.browser.webkit) {
						var img = jQuery(this).find('img:first');
						var size = img.height();
						if (img.height() > img.width()) size = img.width();
						zoom.css({width: size + 'px', height: size + 'px'})
						zoom.offset({
							top:  img.offset().top  + Math.round((img.height() - zoom.height()) / 2),
							left: img.offset().left + Math.round((img.width() - zoom.width()) / 2)
						});
					}
					if (jQuery.browser.opera) {
						var img = jQuery(this).find('img:first');
						if( parseInt(zoom.css('top')) < 0 ) {
							zoom.hide();
						}
					}
					if (jQuery.browser.msie) {
						zoom.show();
					} else {
						zoom.animate({opacity: 1}, 300);
					}
				},
				function() {
					if (jQuery.browser.msie) {
						zoom.hide();
					} else {
						zoom.animate({opacity: 0}, 300);
					}
				}
				);
	}

function setForVideo(id){
	var cont = jQuery('#'+id);
	var thumbs = cont.find('div.galleria-thumbnails').find('div.galleria-image');
	thumbs.unbind('click');
	thumbs.find('img').bind('click', function(e){
		var width = cont.find('.galleria-stage').width();
		var height = cont.find('.galleria-stage').height();
		var src = this.src.split('?video=')[1];

		if (src.indexOf('youtube.com') > 0 || src.indexOf('vimeo.com') > 0) {
			var arr = cont.find('div.galleria-images').find('div.galleria-image');
			var imgs = cont.find('galleria-thumbnails-list').find('img');
			arr.each(function(ind){
				var src = imgs[ind].attr('src').split('?video=')[1];
				
				if (src.indexOf('youtube.com') > 0 || src.indexOf('vimeo.com') > 0) {
					arr[ind].html('<iframe frameborder="0" src="'+ src +'" width="' + width + '" height="' + height + '"></iframe>');
				} else {
					var params = {};
					var attrs = {};
					var flashvars = {};
					attrs.id = "#vh_" + id;
					flashvars.moviefile = encodeURIComponent(src);
					flashvars.autoplay = 1;
					flashvars.wmode = "transparent";
					params.moviefile = encodeURIComponent(src);
					params.autoplay = 1;
					params.wmode = "transparent";
					var swf_file = themeDir + '/tdplayer.swf';
					swfobject.embedSWF(swf_file, "vh_" + id, cont.find('.galleria-stage').width(), cont.find('.galleria-stage').height(), "9", false, flashvars, params, attrs);
				}
			});
		} else {
			var params = {};
			var attrs = {};
			var flashvars = {};
			attrs.id = "#vh_" + id;
			flashvars.moviefile = encodeURIComponent( src );
			flashvars.autoplay = 1;
			flashvars.wmode = "transparent";
			params.moviefile = encodeURIComponent( src );
			params.autoplay = 1;
			params.wmode = "transparent";
			var swf_file = themeDir + '/tdplayer.swf';
			swfobject.embedSWF(swf_file, "vh_" + id, cont.find('.galleria-stage').width(), cont.find('.galleria-stage').height(), "9", false, flashvars, params, attrs);
		}
	});
}

function showGalleryFrame(id) {
	var gal = jQuery('#' + id);
	gal.find('div.galleria-images').find('img').each(function(ind) {
		var src = this.src.split('?video=')[1];
		/*if (src.indexOf('youtube.com') > 0 || src.indexOf('vimeo.com') > 0) {
			this.parentNode.innerHTML = '<iframe id="gl_video" src="' + src + '" width="100%" height="100%" style="z-index:  2 !important;"></iframe>';
		/*} else {*/
			this.parentNode.innerHTML = '<iframe scrolling="no" style="z-index: 2 !important; overflow-x: hidden; overflow-y: hidden;" id="gl_video" src="' + themeDir + '/lib/videogallery.php?src='+ src +'&theme='+ themeDir + '" width="100%" height="100%"></iframe>';
		//}
	});
	gal.find('div.galleria-thumbnails').find('div.galleria-image').unbind('click');
	gal.find('div.galleria-image-nav-right').hide();
	gal.find('div.galleria-image-nav-left').hide();
	gal.find('div.galleria-counter').hide();
	gal.find('div.galleria-thumbnails').find('div.galleria-image').find('img').bind('click', function() {
		var src = this.src.split('?video=')[1];
		//document.getElementById('gl_video').src = src;

		//if (src.indexOf('youtube.com') > 0 || src.indexOf('vimeo.com') > 0) {
			//document.getElementById('gl_video').src = src;
		/*} else {*/
			document.getElementById('gl_video').src = themeDir + '/lib/videogallery.php?src='+ src +'&theme='+ themeDir;
		//}
	});
}