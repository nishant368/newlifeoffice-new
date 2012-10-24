jQuery(window).bind("load", function() {
	jQuery('.container').fadeIn();
	jQuery('.sidebar').delay(200).fadeIn(700);
	jQuery("#menu-header li").each(function(){
		elem = jQuery(this).parent();
		if (elem.is (".sub-menu")) {
			var offset = jQuery(this).parent().parent().offset();
			lG = offset.left;
			jQuery(this).css({ 'padding-left': lG, opacity: 1 })
		}
	});
	setTimeout( function() {
		var h = jQuery(window).height();
		var h = h - 55;
		var h = h - jQuery('#wpadminbar').innerHeight();
		var cH = h - 96;
		var sHn = h - 96;
		var cHm = jQuery('.main-content').innerHeight();
		var sH = jQuery('.sidebar-content').innerHeight();
		if (sH > cHm) {
			barH = sH+5;
		} else {
			barH = cHm;
		}
		if (barH > cH) {
			dH = barH - cH;
			if ( $.browser.msie ) {
				dH = dH + 20;
			}
		if(dH < 46) {
			dH = dH;
		} else {
			dH = 46;
		}
			cH = barH ;
			sHn = barH + 40 ;
			if ( $.browser.msie ) {
		dH = dH + 30;
		}
			jQuery(".container").css({ 'padding-bottom': dH });
			jQuery(".content").css({  'padding-bottom': 40 });
			pBot = 46;
		} else {
			jQuery(".container").css({ 'padding-bottom': 0 });
			jQuery(".content").css({  'padding-bottom': 0 });
			pBot = 0;
		}
		jQuery(".container").animate({ minHeight : h });
		jQuery(".content").animate({  height : cH });
		jQuery(".sidebar-wrap").animate({  height : sHn });
		jQuery('.contentShadowBottom').delay(200).fadeOut();
	}, 1000);
});
jQuery.event.add(window, "scroll", resizeFrame);
jQuery.event.add(window, "resize", resizeFrame);
function resizeFrame() {
	var h = jQuery(window).height();
	var h = h - 55;
	var h = h - jQuery('#wpadminbar').innerHeight();
	var cH = h - 96;
	var sHn = h - 96;
	var cHm = jQuery('.main-content').innerHeight();
	var sH = jQuery('.sidebar-content').innerHeight();
	if (sH > cHm) {
		barH = sH+5;
	} else {
		barH = cHm;
	}
	if (barH > cH) {
		dH = barH - cH;
	if(dH < 46) {
		dH = dH;
	} else {
		dH = 46;
	}
		cH = barH ;
		sHn = barH + 40;
		if ( $.browser.msie ) {
		dH = dH + 30;
		}
		jQuery(".container").css({ 'padding-bottom': dH });
		jQuery(".content").css({  'padding-bottom': 40 });
	} else {
		jQuery(".container").css({ 'padding-bottom': 0 });
		jQuery(".content").css({  'padding-bottom': 0 });
	}
	jQuery(".container").css({ minHeight : h });
	jQuery(".content").css({  height : cH });
	jQuery(".sidebar-wrap").css({  height : sHn });
}
jQuery(document).ready(function() {	
	var w = jQuery(window).width();
	var lW = jQuery('.logo').width();
	var soW = jQuery('#sociables').width();
	soW = soW + 30;
	fW = lW + soW + 40;
	var minW = 980 - fW;
	menuW = 980 - fW;
	mW = 0;
	jQuery("#menu-header li").each(function(){
		elem = jQuery(this).parent();
		if (elem.is (".sub-menu")) { } else {
			mW = mW + jQuery(this).outerWidth(true);
			if(mW >= menuW) {
				jQuery(this).remove();
			}
		}
		jQuery(this).fadeIn();
	});
	jQuery('.sub-menu .menuHeaderStripe').remove();
	jQuery("#menu-header li").hover(function(){
		jQuery(this).find('ul:first').stop(true, true).delay(400).css({visibility: "visible",display: "none"}).slideDown();
	}, function(){ 
		jQuery(this).find('.sub-menu').stop(true, true).delay(300).slideUp();
	});
	jQuery('.menuHeaderStripe:last').remove();
	jQuery('.clickHide').click(function () {
		if (jQuery('.content').is(":hidden")) {
			jQuery('.clickHide').animate({backgroundPosition: '-125px -31px'});
				if (jQuery('.sidebar').length) { 
					jQuery('.content').slideDown();
					jQuery('.contentShadowBottom').fadeOut();
					if ( $.browser.msie ) {
					jQuery('.sidebar').show().delay(350).animate({ left: 10 });
					} else {
					jQuery('.sidebar').show().delay(350).animate({ left: 10, opacity : 1 });
					}
					jQuery('.container').css({ 'padding-bottom': pBot });
					if ( $.browser.msie ) {
    				setTimeout( function() {
						resizeFrame();
						}, 1000);
 					}
				} else {
					jQuery('.content').slideDown();			
					jQuery('.contentShadowBottom').fadeOut();
				}
			} else {
			jQuery('.clickHide').animate({backgroundPosition: '-125px 3px'});
			if (jQuery('.sidebar').length) { 
				if ( $.browser.msie ) {
					jQuery('.sidebar').animate({ left: 220 });
				} else {
					jQuery('.sidebar').animate({ left: 220, opacity : 0 });
				}
				jQuery('.content').delay(350).slideUp();
				jQuery('.contentShadowBottom').fadeIn();
				jQuery('.container').css({ minHeight: 50, 'padding-bottom': 0 });
				jQuery('.sidebar').hide(300);
				jQuery('.main-wrap').css({ minHeight: 50, minWidth: 80 });
			} else {
				jQuery('.content').slideUp();
				jQuery('.container').css({ minHeight: 80 });
				jQuery('.contentShadowBottom').fadeIn();
			}
		}
	});
	jQuery('.box').hover(function() {
		jQuery('.colorInside', this).stop(true, true).animate({ opacity : 0.5 }).fadeIn();
		jQuery('.boxInside', this).stop(true, true).animate({ opacity : 1 }).fadeIn();
	}, function() {
		jQuery('.colorInside', this).stop(true, true).animate({ opacity : 0 });
		jQuery('.boxInside', this).stop(true, true).animate({ opacity : 0 });
	});
	jQuery('#controls-close').click(function() {
		if (jQuery('#controls-wrapper').is(":hidden")) {
			jQuery('#controls-icon').animate({backgroundPosition: '-149px -16px'});
			jQuery('#galleryNav').slideDown();
			jQuery('#controls-close').animate({ bottom: 176 });
		} else {
			jQuery('#controls-icon').animate({backgroundPosition: '-149px 8px'});
			jQuery('#galleryNav').slideUp();
			jQuery('#controls-close').animate({ bottom: 76 });
		}
	});
	var sWc = jQuery('.search-content').width();
	jQuery('.searchWrap .social').fadeOut();
	jQuery('.social').css({ 'float' : 'none' });
	jQuery('.searchWrap .search-bar').fadeOut();
	jQuery('.search-content').animate({ width : 0 }).fadeOut();
	jQuery('.search-icon').hover(function() {
	jQuery('.searchTooltip').stop(true, true).fadeIn();
	}, function() {
		jQuery('.searchTooltip').stop(true, true).fadeOut();
	});
	jQuery('.login-icon').hover(function() {
	jQuery('.loginTooltip').stop(true, true).fadeIn();
	}, function() {
		jQuery('.loginTooltip').stop(true, true).fadeOut();
	});
	jQuery('#controls-close').hover(function() {
	jQuery('.galleryTooltip').stop(true, true).fadeIn();
	}, function() {
	jQuery('.galleryTooltip').stop(true, true).fadeOut();
	});
	jQuery('.search-icon').click(function() {
		if(jQuery('.login-content').is(":hidden")) { } else {
			jQuery('.login-icon').animate({ backgroundPosition: '-149px 8px' });
			jQuery('.login-form').fadeOut();
			jQuery('.login-content').delay(400).animate({ width : 0 }).fadeOut();
		}
		if (jQuery('.search-content').is(":hidden")) {
			jQuery('.search-icon').animate({backgroundPosition: '-149px -16px'});
			jQuery('.search-content').css({ 'visibility' : 'visible' });
			jQuery('.search-content').fadeIn().animate({ width : sWc });
			jQuery('.searchWrap .social').delay(600).fadeIn();
			jQuery('.searchWrap .search-bar').delay(700).fadeIn();
		} else {
			jQuery('.search-icon').animate({backgroundPosition: '-149px 8px'});
			jQuery('.searchWrap .social').fadeOut();
			jQuery('.social').css({ 'float' : 'none' });
			jQuery('.searchWrap .search-bar').fadeOut();
			jQuery('.search-content').delay(400).animate({ width : 0 }).fadeOut();
		}
	});
	var lWc = jQuery('.login-content').width();
	jQuery('.login-content').animate({ width : 0 }).fadeOut();
	jQuery('.login-form').fadeOut();
	jQuery('.login-icon').click(function() {
		if(jQuery('.login-content').is(":hidden")) {
			jQuery('.login-icon').animate({ backgroundPosition: '-149px -16px' });
			jQuery('.login-content').css({ visibility : 'visible' });
			jQuery('.login-content').fadeIn().animate({ width : lWc });
			jQuery('.login-form').delay(700).fadeIn();
		} else {
			jQuery('.login-icon').animate({ backgroundPosition: '-149px 8px' });
			jQuery('.login-form').fadeOut();
			jQuery('.login-content').delay(400).animate({ width : 0 }).fadeOut();
		}
	});
	/* VALIDATE CONTACT FORM */
	function validateContactForm() {
  var ok = true;
  jQuery.each(jQuery('.required-field'), function() {
    if(jQuery(this).val() == '') {
      ok = false;
      jQuery(this).css({'border':'#c00 solid 1px'});
    } else {
      jQuery(this).css({'border':'0'});
    }
  });
  if(ok) {
    return true;
  } else {
    jQuery('#contact-error').fadeIn();
  }
  return false;
	}
  if(jQuery('#contactform').length > 0) {
    jQuery('#contactform').submit(function() { return validateContactForm(); });
    jQuery('.contact-submit').click(function() {
      jQuery('#contactform').submit();
    });
  }
	var slI = 0;
	jQuery('.post').each(function() {
		slI += 1;
		jQuery('.saleImages', this).after('<ul id="SaleNav" class="'+slI+'">').cycle({ 
    fx:     'fade', 
    speed:  'fast', 
    timeout: 0, 
    pager:  '.'+slI, 
    pagerAnchorBuilder: function(idx, slide) { 
        return '<li><a href="#"><img src="' + slide.src + '" width="74" height="76" /></a></li>';
				return '<br style="clear: both;" />';
    } 
		});
	});
	jQuery('.saleCategory:odd').addClass('odd');
	jQuery('.saleCategory:even').addClass('even');
	jQuery('#SaleNav > li:odd').addClass('odd');
});