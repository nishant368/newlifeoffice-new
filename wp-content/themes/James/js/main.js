/**
 * Coin Slider - Unique jQuery Image Slider
 * @version: 1.0 - (2010/04/04)
 * @requires jQuery v1.2.2 or later 
 * @author Ivan Lazarevic
 * Examples and documentation at: http://workshop.rs/projects/coin-slider/
 
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
**/

(function($) {

	var params 		= new Array;
	var order		= new Array;
	var images		= new Array;
	var links		= new Array;
	var linksTarget = new Array;
	var titles		= new Array;
	var interval	= new Array;
	var imagePos	= new Array;
	var appInterval = new Array;	
	var squarePos	= new Array;	
	var reverse		= new Array;
	
	$.fn.coinslider= $.fn.CoinSlider = function(options){
		init = function(el){
				
			order[el.id] 		= new Array();	// order of square appereance
			images[el.id]		= new Array();
			links[el.id]		= new Array();
			linksTarget[el.id]	= new Array();
			titles[el.id]		= new Array();
			imagePos[el.id]		= 0;
			squarePos[el.id]	= 0;
			reverse[el.id]		= 1;						
				
			params[el.id] = $.extend({}, $.fn.coinslider.defaults, options);
						
			// create images, links and titles arrays
			$.each($('#'+el.id+' img'), function(i,item){
				images[el.id][i] 		= $(item).attr('src');
				links[el.id][i] 		= $(item).parent().is('a') ? $(item).parent().attr('href') : '';
				linksTarget[el.id][i] 	= $(item).parent().is('a') ? $(item).parent().attr('target') : '';
				titles[el.id][i] 		= $(item).next().is('span') ? $(item).next().html() : '';
				$(item).hide();
				$(item).next().hide();
			});			
			

			// set panel
			$(el).css({
				'background-image':'url('+images[el.id][0]+')',
				'width': params[el.id].width,
				'height': params[el.id].height,
				'position': 'relative',
				'background-position': 'top left'
			}).wrap("<div class='coin-slider' id='coin-slider-"+el.id+"' />");	
			
				
			// create title bar
			$('#'+el.id).append("<div class='cs-title' id='cs-title-"+el.id+"' style='position: absolute; bottom:0; left: 0; z-index: 1000;'></div>");
						
			$.setFields(el);
			
			if(params[el.id].navigation)
				$.setNavigation(el);
			
			$.transition(el,0);
			$.transitionCall(el);
				
		}
		
		// squares positions
		$.setFields = function(el){
			
			tWidth = sWidth = parseInt(params[el.id].width/params[el.id].spw);
			tHeight = sHeight = parseInt(params[el.id].height/params[el.id].sph);
			
			counter = sLeft = sTop = 0;
			tgapx = gapx = params[el.id].width - params[el.id].spw*sWidth;
			tgapy = gapy = params[el.id].height - params[el.id].sph*sHeight;
			
			for(i=1;i <= params[el.id].sph;i++){
				$('.wp-post-image').css({'margin-top':'-21px'});
				gapx = tgapx;
				
					if(gapy > 0){
						gapy--;
						sHeight = tHeight+1;
					} else {
						sHeight = tHeight;
					}
				
				for(j=1; j <= params[el.id].spw; j++){	

					if(gapx > 0){
						gapx--;
						sWidth = tWidth+1;
					} else {
						sWidth = tWidth;
					}

					order[el.id][counter] = i+''+j;
					counter++;
					
					if(params[el.id].links)
						$('#'+el.id).append("<a href='"+links[el.id][0]+"' class='cs-"+el.id+"' id='cs-"+el.id+i+j+"' style='width:"+sWidth+"px; height:"+sHeight+"px; float: left; position: absolute;'></a>");
					else
						$('#'+el.id).append("<div class='cs-"+el.id+"' id='cs-"+el.id+i+j+"' style='width:"+sWidth+"px; height:"+sHeight+"px; float: left; position: absolute;'></div>");
								
					// positioning squares
					$("#cs-"+el.id+i+j).css({ 
						'background-position': -sLeft +'px '+(-sTop+'px'),
						'left' : sLeft ,
						'top': sTop
					});
				
					sLeft += sWidth;
				}

				sTop += sHeight;
				sLeft = 0;					
					
			}
			
			
			$('.cs-'+el.id).mouseover(function(){
				$('#cs-navigation-'+el.id).show();
			});
		
			$('.cs-'+el.id).mouseout(function(){
				$('#cs-navigation-'+el.id).hide();
			});	
			
			$('#cs-title-'+el.id).mouseover(function(){
				$('#cs-navigation-'+el.id).show();
			});
		
			$('#cs-title-'+el.id).mouseout(function(){
				$('#cs-navigation-'+el.id).hide();
			});	
			
			if(params[el.id].hoverPause){	
				$('.cs-'+el.id).mouseover(function(){
					params[el.id].pause = true;
				});
			
				$('.cs-'+el.id).mouseout(function(){
					params[el.id].pause = false;
				});	
				
				$('#cs-title-'+el.id).mouseover(function(){
					params[el.id].pause = true;
				});
			
				$('#cs-title-'+el.id).mouseout(function(){
					params[el.id].pause = false;
				});	
			}
					
			
		};
				
		
		$.transitionCall = function(el){
		
			clearInterval(interval[el.id]);	
			delay = params[el.id].delay + params[el.id].spw*params[el.id].sph*params[el.id].sDelay;
			interval[el.id] = setInterval(function() { $.transition(el)  }, delay);
			
		}
		
		// transitions
		$.transition = function(el,direction){
			
			if(params[el.id].pause == true) return;
			
			$.effect(el);
			
			squarePos[el.id] = 0;
			appInterval[el.id] = setInterval(function() { $.appereance(el,order[el.id][squarePos[el.id]])  },params[el.id].sDelay);
					
			$(el).css({ 'background-image': 'url('+images[el.id][imagePos[el.id]]+')' });
			
			if(typeof(direction) == "undefined")
				imagePos[el.id]++;
			else
				if(direction == 'prev')
					imagePos[el.id]--;
				else
					imagePos[el.id] = direction;
		
			if  (imagePos[el.id] == images[el.id].length) {
				imagePos[el.id] = 0;
			}
			
			if (imagePos[el.id] == -1){
				imagePos[el.id] = images[el.id].length-1;
			}
	
			$('.cs-button-'+el.id).removeClass('cs-active');
			$('#cs-button-'+el.id+"-"+(imagePos[el.id]+1)).addClass('cs-active');
			
			if(titles[el.id][imagePos[el.id]]){
				$('#cs-title-'+el.id).css({ 'opacity' : 0 }).animate({ 'opacity' : params[el.id].opacity }, params[el.id].titleSpeed);
				$('#cs-title-'+el.id).html(titles[el.id][imagePos[el.id]]);
			} else {
				$('#cs-title-'+el.id).css('opacity',0);
			}				
				
		};
		
		$.appereance = function(el,sid){

			$('.cs-'+el.id).attr('href',links[el.id][imagePos[el.id]]).attr('target',linksTarget[el.id][imagePos[el.id]]);

			if (squarePos[el.id] == params[el.id].spw*params[el.id].sph) {
				clearInterval(appInterval[el.id]);
				return;
			}

			$('#cs-'+el.id+sid).css({ opacity: 0, 'background-image': 'url('+images[el.id][imagePos[el.id]]+')' });
			$('#cs-'+el.id+sid).animate({ opacity: 1 }, 300);
			squarePos[el.id]++;
			
		};
		
		// navigation
		$.setNavigation = function(el){
			// create prev and next 
			$(el).append("<div id='cs-navigation-"+el.id+"'></div>");
			$('#cs-navigation-'+el.id).hide();
			
			//$('#cs-navigation-'+el.id).append("<a href='#' id='cs-prev-"+el.id+"' class='cs-prev'>prev</a>");
			//$('#cs-navigation-'+el.id).append("<a href='#' id='cs-next-"+el.id+"' class='cs-next'>next</a>");
			$('#cs-prev-'+el.id).css({
				'position' 	: 'absolute',
				'top'		: params[el.id].height/2 - 15,
				'left'		: 0,
				'z-index' 	: 1001,
				'line-height': '30px',
				'opacity'	: params[el.id].opacity
			}).click( function(e){
				e.preventDefault();
				$.transition(el,'prev');
				$.transitionCall(el);		
			}).mouseover( function(){ $('#cs-navigation-'+el.id).show() });
	
			$('#cs-next-'+el.id).css({
				'position' 	: 'absolute',
				'top'		: params[el.id].height/2 - 15,
				'right'		: 0,
				'z-index' 	: 1001,
				'line-height': '30px',
				'opacity'	: params[el.id].opacity
			}).click( function(e){
				e.preventDefault();
				$.transition(el);
				$.transitionCall(el);
			}).mouseover( function(){ $('#cs-navigation-'+el.id).show() });
		
			// image buttons
			$("<div id='cs-buttons-"+el.id+"' class='cs-buttons'></div>").appendTo($('#coin-slider-'+el.id+''));

			
			for(k=1;k<images[el.id].length+1;k++){
				$('#cs-buttons-'+el.id).append("<a href='#' class='cs-button-"+el.id+"' id='cs-button-"+el.id+"-"+k+"'>"+k+"</a>");
			}
			
			$.each($('.cs-button-'+el.id), function(i,item){
				$(item).click( function(e){
					$('.cs-button-'+el.id).removeClass('cs-active');
					$(this).addClass('cs-active');
					e.preventDefault();
					$.transition(el,i);
					$.transitionCall(el);				
				})
			});	
			
			$('#cs-navigation-'+el.id+' a').mouseout(function(){
				$('#cs-navigation-'+el.id).hide();
				params[el.id].pause = false;
			});						

			$("#cs-buttons-"+el.id).css({
				'left'			: '50%',
				'margin-left' 	: -images[el.id].length*15/2-5,
				'position'		: 'absolute'
				
			});
			
				
		}




		// effects
		$.effect = function(el){
			
			effA = ['random','swirl','rain','straight'];
			if(params[el.id].effect == '')
				eff = effA[Math.floor(Math.random()*(effA.length))];
			else
				eff = params[el.id].effect;

			order[el.id] = new Array();

			if(eff == 'random'){
				counter = 0;
				  for(i=1;i <= params[el.id].sph;i++){
				  	for(j=1; j <= params[el.id].spw; j++){	
				  		order[el.id][counter] = i+''+j;
						counter++;
				  	}
				  }	
				$.random(order[el.id]);
			}
			
			if(eff == 'rain')	{
				$.rain(el);
			}
			
			if(eff == 'swirl')
				$.swirl(el);
				
			if(eff == 'straight')
				$.straight(el);
				
			reverse[el.id] *= -1;
			if(reverse[el.id] > 0){
				order[el.id].reverse();
			}

		}

			
		// shuffle array function
		$.random = function(arr) {
						
		  var i = arr.length;
		  if ( i == 0 ) return false;
		  while ( --i ) {
		     var j = Math.floor( Math.random() * ( i + 1 ) );
		     var tempi = arr[i];
		     var tempj = arr[j];
		     arr[i] = tempj;
		     arr[j] = tempi;
		   }
		}	
		
		//swirl effect by milos popovic
		$.swirl = function(el){

			var n = params[el.id].sph;
			var m = params[el.id].spw;

			var x = 1;
			var y = 1;
			var going = 0;
			var num = 0;
			var c = 0;
			
			var dowhile = true;
						
			while(dowhile) {
				
				num = (going==0 || going==2) ? m : n;
				
				for (i=1;i<=num;i++){
					
					order[el.id][c] = x+''+y;
					c++;

					if(i!=num){
						switch(going){
							case 0 : y++; break;
							case 1 : x++; break;
							case 2 : y--; break;
							case 3 : x--; break;
						
						}
					}
				}
				
				going = (going+1)%4;

				switch(going){
					case 0 : m--; y++; break;
					case 1 : n--; x++; break;
					case 2 : m--; y--; break;
					case 3 : n--; x--; break;		
				}
				
				check = $.max(n,m) - $.min(n,m);			
				if(m<=check && n<=check)
					dowhile = false;
									
			}
		}

		// rain effect
		$.rain = function(el){
			var n = params[el.id].sph;
			var m = params[el.id].spw;

			var c = 0;
			var to = to2 = from = 1;
			var dowhile = true;


			while(dowhile){
				
				for(i=from;i<=to;i++){
					order[el.id][c] = i+''+parseInt(to2-i+1);
					c++;
				}
				
				to2++;
				
				if(to < n && to2 < m && n<m){
					to++;	
				}
				
				if(to < n && n>=m){
					to++;	
				}
				
				if(to2 > m){
					from++;
				}
				
				if(from > to) dowhile= false;
				
			}			

		}

		// straight effect
		$.straight = function(el){
			counter = 0;
			for(i=1;i <= params[el.id].sph;i++){
				for(j=1; j <= params[el.id].spw; j++){	
					order[el.id][counter] = i+''+j;
					counter++;
				}
				
			}
		}

		$.min = function(n,m){
			if (n>m) return m;
			else return n;
		}
		
		$.max = function(n,m){
			if (n<m) return m;
			else return n;
		}		
	
	this.each (
		function(){ init(this); }
	);
	

	};
	
	
	// default values
	$.fn.coinslider.defaults = {	
		width: 620, // width of slider panel
		height: 290, // height of slider panel
		spw: 7, // squares per width
		sph: 5, // squares per height
		delay: 3000, // delay between images in ms
		sDelay: 30, // delay beetwen squares in ms
		opacity: 0.7, // opacity of title and navigation
		titleSpeed: 500, // speed of title appereance in ms
		effect: '', // random, swirl, rain, straight
		navigation: true, // prev next and buttons
		links : true, // show images as links 
		hoverPause: true // pause on hover		
	};	
	
})(jQuery);
/**
 * @author Alexander Farkas
 * v. 1.22
 */


(function($) {
	if(!document.defaultView || !document.defaultView.getComputedStyle){ // IE6-IE8
		var oldCurCSS = $.curCSS;
		$.curCSS = function(elem, name, force){
			if(name === 'background-position'){
				name = 'backgroundPosition';
			}
			if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
				return oldCurCSS.apply(this, arguments);
			}
			var style = elem.style;
			if ( !force && style && style[ name ] ){
				return style[ name ];
			}
			return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
		};
	}
	
	var oldAnim = $.fn.animate;
	$.fn.animate = function(prop){
		if('background-position' in prop){
			prop.backgroundPosition = prop['background-position'];
			delete prop['background-position'];
		}
		if('backgroundPosition' in prop){
			prop.backgroundPosition = '('+ prop.backgroundPosition;
		}
		return oldAnim.apply(this, arguments);
	};
	
	function toArray(strg){
		strg = strg.replace(/left|top/g,'0px');
		strg = strg.replace(/right|bottom/g,'100%');
		strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
		var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
		return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
	}
	
	$.fx.step. backgroundPosition = function(fx) {
		if (!fx.bgPosReady) {
			var start = $.curCSS(fx.elem,'backgroundPosition');
			if(!start){//FF2 no inline-style fallback
				start = '0px 0px';
			}
			
			start = toArray(start);
			fx.start = [start[0],start[2]];
			var end = toArray(fx.end);
			fx.end = [end[0],end[2]];
			
			fx.unit = [end[1],end[3]];
			fx.bgPosReady = true;
		}
		//return;
		var nowPosX = [];
		nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
		nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];           
		fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];

	};
})(jQuery);
/*
	Supersized - Fullscreen Slideshow jQuery Plugin
	Version 3.1.1
	www.buildinternet.com/project/supersized
	
	By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
	Released under MIT License / GPL License
*/
(function(a){a(document).ready(function(){
	imgP = $('.hiddenLink').html();
	a("body").prepend('').prepend('')});a.supersized=function(o){var c={slideshow:1,autoplay:1,start_slide:1,slide_interval:5000,transition:1,transition_speed:750,new_window:1,pause_hover:0,keyboard_nav:1,performance:1,image_protect:1,image_path:imgP,min_width:0,min_height:0,vertical_center:1,horizontal_center:1,fit_portrait:0,fit_landscape:0,navigation:1,thumbnail_navigation:0,slide_counter:1,slide_captions:1};var g=a("#supersized");var d="#pauseplay";if(o){var o=a.extend(c,o)}else{var o=a.extend(c)}var b=false;var j=false;var i=o.image_path;if(o.start_slide){var h=o.start_slide-1}else{var h=Math.floor(Math.random()*o.slides.length)}var n=o.new_window?' target="_blank"':"";if(o.performance==3){g.addClass("speed")}else{if((o.performance==1)||(o.performance==2)){g.addClass("quality")}}if(o.slides.length>1){h-1<0?loadPrev=o.slides.length-1:loadPrev=h-1;var e=(o.slides[loadPrev].url)?"href='"+o.slides[loadPrev].url+"'":"";a("<img/>").attr("src",o.slides[loadPrev].image).appendTo(g).wrap("<a "+e+n+"></a>")}e=(o.slides[h].url)?"href='"+o.slides[h].url+"'":"";a("<img/>").attr("src",o.slides[h].image).appendTo(g).wrap('<a class="activeslide" '+e+n+"></a>");if(o.slides.length>1){h==o.slides.length-1?loadNext=0:loadNext=h+1;e=(o.slides[loadNext].url)?"href='"+o.slides[loadNext].url+"'":"";a("<img/>").attr("src",o.slides[loadNext].image).appendTo(g).wrap("<a "+e+n+"></a>")}g.hide();a("#controls-wrapper").hide();a(window).load(function(){a("#supersized-loader").hide();g.fadeIn("fast");a("#controls-wrapper").show();if(o.thumbnail_navigation){h-1<0?prevThumb=o.slides.length-1:prevThumb=h-1;a("#prevthumb").show().html(a("<img/>").attr("src",o.slides[prevThumb].image));h==o.slides.length-1?nextThumb=0:nextThumb=h+1;a("#nextthumb").show().html(a("<img/>").attr("src",o.slides[nextThumb].image))}m();if(o.slide_captions){a("#slidecaption").html(o.slides[h].title)}if(!(o.navigation)){a("#navigation").hide()}if(o.slideshow&&o.slides.length>1){if(o.slide_counter){a("#slidecounter .slidenumber").html(h+1);a("#slidecounter .totalslides").html(o.slides.length)}slideshow_interval=setInterval(k,o.slide_interval);if(!(o.autoplay)){clearInterval(slideshow_interval);j=true;if(a(d).attr("src")){a(d).attr("src",i+"play_dull.png")}}if(o.thumbnail_navigation){a("#nextthumb").click(function(){if(b){return false}clearInterval(slideshow_interval);k(g,o);if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false});a("#prevthumb").click(function(){if(b){return false}clearInterval(slideshow_interval);f(g,o);if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false})}if(o.navigation){a("#navigation a").click(function(){a(this).blur();return false});a("#nextslide").click(function(){if(b){return false}clearInterval(slideshow_interval);k();if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false});if(a("#nextslide").attr("src")){a("#nextslide").mousedown(function(){a(this).attr("src",i+"forward.png")});a("#nextslide").mouseup(function(){a(this).attr("src",i+"forward_dull.png")});a("#nextslide").mouseout(function(){a(this).attr("src",i+"forward_dull.png")})}a("#prevslide").click(function(){if(b){return false}clearInterval(slideshow_interval);f();if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false});if(a("#prevslide").attr("src")){a("#prevslide").mousedown(function(){a(this).attr("src",i+"back.png")});a("#prevslide").mouseup(function(){a(this).attr("src",i+"back_dull.png")});a("#prevslide").mouseout(function(){a(this).attr("src",i+"back_dull.png")})}a(d).click(function(){if(b){return false}if(j){if(a(d).attr("src")){a(d).attr("src",i+"pause_dull.png")}j=false;slideshow_interval=setInterval(k,o.slide_interval)}else{if(a(d).attr("src")){a(d).attr("src",i+"play_dull.png")}clearInterval(slideshow_interval);j=true}return false})}}});if(o.keyboard_nav){a(document.documentElement).keydown(function(p){if((p.keyCode==37)||(p.keyCode==40)){if(a("#prevslide").attr("src")){a("#prevslide").attr("src",i+"back.png")}}else{if((p.keyCode==39)||(p.keyCode==38)){if(a("#nextslide").attr("src")){a("#nextslide").attr("src",i+"forward.png")}}}});a(document.documentElement).keyup(function(p){clearInterval(slideshow_interval);if((p.keyCode==37)||(p.keyCode==40)){if(a("#prevslide").attr("src")){a("#prevslide").attr("src",i+"back_dull.png")}if(b){return false}clearInterval(slideshow_interval);f();if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false}else{if((p.keyCode==39)||(p.keyCode==38)){if(a("#nextslide").attr("src")){a("#nextslide").attr("src",i+"forward_dull.png")}if(b){return false}clearInterval(slideshow_interval);k();if(!(j)){slideshow_interval=setInterval(k,o.slide_interval)}return false}else{if(p.keyCode==32){if(b){return false}if(j){if(a(d).attr("src")){a(d).attr("src",i+"pause_dull.png")}j=false;slideshow_interval=setInterval(k,o.slide_interval)}else{if(a(d).attr("src")){a(d).attr("src",i+"play_dull.png")}j=true}return false}}}})}if(o.slideshow&&o.pause_hover){a(g).hover(function(){if(b){return false}if(!(j)&&o.navigation){if(a(d).attr("src")){a(d).attr("src",i+"pause.png")}clearInterval(slideshow_interval)}},function(){if(!(j)&&o.navigation){if(a(d).attr("src")){a(d).attr("src",i+"pause_dull.png")}slideshow_interval=setInterval(k,o.slide_interval)}})}a(window).resize(function(){m()});function m(){return g.each(function(){var p=a("img",g);a(p).each(function(){var r=(a(this).height()/a(this).width()).toFixed(2);var q=a(window).width();var s=a(window).height();var t;if((s>o.min_height)||(q>o.min_width)){if((s/q)>r){if(o.fit_landscape&&r<=1){a(this).width(q);a(this).height(q*r)}else{a(this).height(s);a(this).width(s/r)}}else{if(o.fit_portrait&&r>1){a(this).height(s);a(this).width(s/r)}else{a(this).width(q);a(this).height(q*r)}}}if(o.horizontal_center){a(this).css("left",(q-a(this).width())/2)}if(o.vertical_center){a(this).css("top",(s-a(this).height())/2)}});if(o.image_protect){a("img",g).bind("contextmenu",function(){return false});a("img",g).bind("mousedown",function(){return false})}return false})}function k(){if(b){return false}else{b=true}var r=o.slides;var q=g.find(".activeslide");q.removeClass("activeslide");if(q.length==0){q=g.find("a:last")}var p=q.next().length?q.next():g.find("a:first");var s=p.prev().length?p.prev():g.find("a:last");a(".prevslide").removeClass("prevslide");s.addClass("prevslide");h+1==r.length?h=0:h++;if(o.performance==1){g.removeClass("quality").addClass("speed")}loadSlide=false;h==r.length-1?loadSlide=0:loadSlide=h+1;e=(o.slides[loadSlide].url)?"href='"+o.slides[loadSlide].url+"'":"";a("<img/>").attr("src",o.slides[loadSlide].image).appendTo(g).wrap("<a "+e+n+"></a>");if(o.thumbnail_navigation==1){h-1<0?prevThumb=r.length-1:prevThumb=h-1;a("#prevthumb").html(a("<img/>").attr("src",o.slides[prevThumb].image));nextThumb=loadSlide;a("#nextthumb").html(a("<img/>").attr("src",o.slides[nextThumb].image))}q.prev().remove();if(o.slide_counter){a("#slidecounter .slidenumber").html(h+1)}if(o.slide_captions){(o.slides[h].title)?a("#slidecaption").html(o.slides[h].title):a("#slidecaption").html("")}p.hide().addClass("activeslide");switch(o.transition){case 0:p.show();b=false;break;case 1:p.fadeTo(o.transition_speed,1,function(){l()});break;case 2:p.animate({top:-a(window).height()},0).show().animate({top:0},o.transition_speed,function(){l()});break;case 3:p.animate({left:a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});break;case 4:p.animate({top:a(window).height()},0).show().animate({top:0},o.transition_speed,function(){l()});break;case 5:p.animate({left:-a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});break;case 6:p.animate({left:a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});q.animate({left:-a(window).width()},o.transition_speed);break;case 7:p.animate({left:-a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});q.animate({left:a(window).width()},o.transition_speed);break}}function f(){if(b){return false}else{b=true}var r=o.slides;var q=g.find(".activeslide");q.removeClass("activeslide");if(q.length==0){q=a(g).find("a:first")}var p=q.prev().length?q.prev():a(g).find("a:last");var s=p.next().length?p.next():a(g).find("a:first");a(".prevslide").removeClass("prevslide");s.addClass("prevslide");h==0?h=r.length-1:h--;if(o.performance==1){g.removeClass("quality").addClass("speed")}loadSlide=false;h-1<0?loadSlide=r.length-1:loadSlide=h-1;e=(o.slides[loadSlide].url)?"href='"+o.slides[loadSlide].url+"'":"";a("<img/>").attr("src",o.slides[loadSlide].image).prependTo(g).wrap("<a "+e+n+"></a>");if(o.thumbnail_navigation==1){prevThumb=loadSlide;a("#prevthumb").html(a("<img/>").attr("src",o.slides[prevThumb].image));h==r.length-1?nextThumb=0:nextThumb=h+1;a("#nextthumb").html(a("<img/>").attr("src",o.slides[nextThumb].image))}q.next().remove();if(o.slide_counter){a("#slidecounter .slidenumber").html(h+1)}if(o.slide_captions){(o.slides[h].title)?a("#slidecaption").html(o.slides[h].title):a("#slidecaption").html("")}p.hide().addClass("activeslide");switch(o.transition){case 0:p.show();b=false;break;case 1:p.fadeTo(o.transition_speed,1,function(){l()});break;case 2:p.animate({top:a(window).height()},0).show().animate({top:0},o.transition_speed,function(){l()});break;case 3:p.animate({left:-a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});break;case 4:p.animate({top:-a(window).height()},0).show().animate({top:0},o.transition_speed,function(){l()});break;case 5:p.animate({left:a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});break;case 6:p.animate({left:-a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});q.animate({left:a(window).width()},o.transition_speed);break;case 7:p.animate({left:a(window).width()},0).show().animate({left:0},o.transition_speed,function(){l()});q.animate({left:-a(window).width()},o.transition_speed);break}}function l(){b=false;if(o.performance==1){g.removeClass("speed").addClass("quality")}m()}}})(jQuery);
/**
 * Isotope v1.3.110525
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2011 David DeSandro / Metafizzy
 */
/**
 * Isotope v1.3.110525
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2011 David DeSandro / Metafizzy
 */

(function( window, $, undefined ){

  // ========================= getStyleProperty by kangax ===============================
  // http://perfectionkills.com/feature-testing-css-properties/

  var getStyleProperty = (function(){

    var prefixes = ['Moz', 'Webkit', 'Khtml', 'O', 'Ms'];

    function getStyleProperty(propName, element) {
      element = element || document.documentElement;
      var style = element.style,
          prefixed;

      // test standard property first
      if (typeof style[propName] === 'string') {
        return propName;
      }

      // capitalize
      propName = propName.charAt(0).toUpperCase() + propName.slice(1);

      // test vendor specific properties
      for (var i=0, l=prefixes.length; i<l; i++) {
        prefixed = prefixes[i] + propName;
        if (typeof style[prefixed] === 'string') {
          return prefixed;
        }
      }
    }

    return getStyleProperty;
  })();

  var transformProp = getStyleProperty('transform');

  // ========================= miniModernizr ===============================
  // <3<3<3 and thanks to Faruk and Paul for doing the heavy lifting

  /*!
   * Modernizr v1.6ish: miniModernizr for Isotope
   * http://www.modernizr.com
   *
   * Developed by: 
   * - Faruk Ates  http://farukat.es/
   * - Paul Irish  http://paulirish.com/
   *
   * Copyright (c) 2009-2010
   * Dual-licensed under the BSD or MIT licenses.
   * http://www.modernizr.com/license/
   */

 
  /*
   * This version whittles down the script just to check support for
   * CSS transitions, transforms, and 3D transforms.
  */
  
  var docElement = document.documentElement,
      vendorCSSPrefixes = ' -o- -moz- -ms- -webkit- -khtml- '.split(' '),
      tests = [
        {
          name : 'csstransforms',
          getResult : function() {
            return !!transformProp;
          }
        },
        {
          name : 'csstransforms3d',
          getResult : function() {
            var test = !!getStyleProperty('perspective');
            // double check for Chrome's false positive
            if ( test ){
              var st = document.createElement('style'),
                  div = document.createElement('div'),
                  mq = '@media (' + vendorCSSPrefixes.join('transform-3d),(') + 'modernizr)';

              st.textContent = mq + '{#modernizr{height:3px}}';
              (document.head || document.getElementsByTagName('head')[0]).appendChild(st);
              div.id = 'modernizr';
              docElement.appendChild(div);

              test = div.offsetHeight === 3;

              st.parentNode.removeChild(st);
              div.parentNode.removeChild(div);
            }
            return !!test;
          }
        },
        {
          name : 'csstransitions',
          getResult : function() {
            return !!getStyleProperty('transitionProperty');
          }
        }
      ],

      i, len = tests.length
  ;

  if ( window.Modernizr ) {
    // if there's a previous Modernzir, check if there are necessary tests
    for ( i=0; i < len; i++ ) {
      var test = tests[i];
      if ( !Modernizr.hasOwnProperty( test.name ) ) {
        // if test hasn't been run, use addTest to run it
        Modernizr.addTest( test.name, test.getResult );
      }
    }
  } else {
    // or create new mini Modernizr that just has the 3 tests
    window.Modernizr = (function(){

      var miniModernizr = {
            _version : '1.6ish: miniModernizr for Isotope'
          },
          classes = [],
          test, result, className;

      // Run through tests
      for ( i=0; i < len; i++ ) {
        test = tests[i];
        result = test.getResult();
        miniModernizr[ test.name ] = result;
        className = ( result ?  '' : 'no-' ) + test.name;
        classes.push( className );
      }

      // Add the new classes to the <html> element.
      docElement.className += ' ' + classes.join( ' ' );

      return miniModernizr;
    })();
  }



  // ========================= isoTransform ===============================

  /**
   *  provides hooks for .css({ scale: value, translate: [x, y] })
   *  Progressively enhanced CSS transforms
   *  Uses hardware accelerated 3D transforms for Safari
   *  or falls back to 2D transforms.
   */
  
  if ( Modernizr.csstransforms ) {
    
        // i.e. transformFnNotations.scale(0.5) >> 'scale3d( 0.5, 0.5, 1)'
    var transformFnNotations = Modernizr.csstransforms3d ? 
      { // 3D transform functions
        translate : function ( position ) {
          return 'translate3d(' + position[0] + 'px, ' + position[1] + 'px, 0) ';
        },
        scale : function ( scale ) {
          return 'scale3d(' + scale + ', ' + scale + ', 1) ';
        }
      } :
      { // 2D transform functions
        translate : function ( position ) {
          return 'translate(' + position[0] + 'px, ' + position[1] + 'px) ';
        },
        scale : function ( scale ) {
          return 'scale(' + scale + ') ';
        }
      }
    ;

    var setIsoTransform = function ( elem, name, value ) {
          // unpack current transform data
      var data =  $.data( elem, 'isoTransform' ) || {},
          newData = {},
          fnName,
          transformObj = {},
          transformValue;

      // i.e. newData.scale = 0.5
      newData[ name ] = value;
      // extend new value over current data
      $.extend( data, newData );

      for ( fnName in data ) {
        transformValue = data[ fnName ];
        transformObj[ fnName ] = transformFnNotations[ fnName ]( transformValue );
      }

      // get proper order
      // ideally, we could loop through this give an array, but since we only have
      // a couple transforms we're keeping track of, we'll do it like so
      var translateFn = transformObj.translate || '',
          scaleFn = transformObj.scale || '',
          // sorting so translate always comes first
          valueFns = translateFn + scaleFn;

      // set data back in elem
      $.data( elem, 'isoTransform', data );

      // set name to vendor specific property
      elem.style[ transformProp ] = valueFns;
    };
   
    // ==================== scale ===================
  
    $.cssNumber.scale = true;
  
    $.cssHooks.scale = {
      set: function( elem, value ) {
        // properly parse strings
        if ( typeof value === 'string' ) {
          value = parseFloat( value );
        }
        setIsoTransform( elem, 'scale', value );
      },
      get: function( elem, computed ) {
        var transform = $.data( elem, 'isoTransform' );
        return transform && transform.scale ? transform.scale : 1;
      }
    };

    $.fx.step.scale = function( fx ) {
      $.cssHooks.scale.set( fx.elem, fx.now+fx.unit );
    };
  
  
    // ==================== translate ===================
    
    $.cssNumber.translate = true;
  
    $.cssHooks.translate = {
      set: function( elem, value ) {

        // all this would be for public use
        // properly parsing strings and whatnot
        // if ( typeof value === 'string' ) {
        //   value = value.split(' ');
        // }
        // 
        // var i, val;
        // for ( i = 0; i < 2; i++ ) {
        //   val = value[i];
        //   if ( typeof val === 'string' ) {
        //     val = parseInt( val );
        //   }
        // }

        setIsoTransform( elem, 'translate', value );
      },
    
      get: function( elem, computed ) {
        var transform = $.data( elem, 'isoTransform' );
        return transform && transform.translate ? transform.translate : [ 0, 0 ];
      }
    };

  }



  /*
   * smartresize: debounced resize event for jQuery
   *
   * latest version and complete README available on Github:
   * https://github.com/louisremi/jquery.smartresize.js
   *
   * Copyright 2011 @louis_remi
   * Licensed under the MIT license.
   */

  var $event = $.event,
      resizeTimeout;

  $event.special.smartresize = {
    setup: function() {
      $(this).bind( "resize", $event.special.smartresize.handler );
    },
    teardown: function() {
      $(this).unbind( "resize", $event.special.smartresize.handler );
    },
    handler: function( event, execAsap ) {
      // Save the context
      var context = this,
          args = arguments;

      // set correct event type
      event.type = "smartresize";

      if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
      resizeTimeout = setTimeout(function() {
        jQuery.event.handle.apply( context, args );
      }, execAsap === "execAsap"? 0 : 100 );
    }
  };

  $.fn.smartresize = function( fn ) {
    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
  };



// ========================= Isotope ===============================


  // our "Widget" object constructor
  $.Isotope = function( options, element ){
    this.element = $( element );

    this._create( options );
    this._init();
  };
  
  // styles of container element we want to keep track of
  var isoContainerStyles = [ 'overflow', 'position', 'width', 'height' ];
  
  $.Isotope.settings = {
    resizable: true,
    layoutMode : 'masonry',
    containerClass : 'isotope',
    itemClass : 'isotope-item',
    hiddenClass : 'isotope-hidden',
    hiddenStyle : Modernizr.csstransforms && !$.browser.opera ? 
      { opacity : 0, scale : 0.001 } : // browsers support CSS transforms, not Opera
      { opacity : 0 }, // other browsers, including Opera
    visibleStyle : Modernizr.csstransforms && !$.browser.opera ? 
      { opacity : 1, scale : 1 } : // browsers support CSS transforms, not Opera
      { opacity : 1 },  // other browsers, including Opera
    animationEngine : $.browser.opera ? 'jquery' : 'best-available',
    animationOptions: {
      queue: false,
      duration: 800
    },
    sortBy : 'original-order',
    sortAscending : true,
    resizesContainer : true,
    transformsEnabled : true,
    itemPositionDataEnabled: false
  };

  $.Isotope.prototype = {

    // sets up widget
    _create : function( options ) {
      
      this.options = $.extend( true, {}, $.Isotope.settings, options );
      
      this.styleQueue = [];
      this.elemCount = 0;

      // get original styles in case we re-apply them in .destroy()
      var elemStyle = this.element[0].style;
      this.originalStyle = {};
      for ( var i=0, len = isoContainerStyles.length; i < len; i++ ) {
        var prop = isoContainerStyles[i];
        this.originalStyle[ prop ] = elemStyle[ prop ] || null;
      }
      
      this.element.css({
        overflow : 'hidden',
        position : 'relative'
      });
      
      this._updateAnimationEngine();
      this._updateUsingTransforms();
      
      // sorting
      var originalOrderSorter = {
        'original-order' : function( $elem, instance ) {
          return instance.elemCount;
        }
      };

      this.options.getSortData = $.extend( this.options.getSortData, originalOrderSorter );

      // need to get atoms
      this.reloadItems();
      
      // get top left position of where the bricks should be
      var $cursor = $( document.createElement('div') ).prependTo( this.element );
      this.offset = $cursor.position();
      $cursor.remove();

      // add isotope class first time around
      var instance = this;
      setTimeout( function() {
        instance.element.addClass( instance.options.containerClass );
      }, 0 );
      
      // bind resize method
      if ( this.options.resizable ) {
        $(window).bind( 'smartresize.isotope', function() { 
          instance.resize();
        });
      }
      
    },
    
    _getAtoms : function( $elems ) {
      var selector = this.options.itemSelector,
          // filter & find 
          $atoms = selector ? $elems.filter( selector ).add( $elems.find( selector ) ) : $elems,
          // base style for atoms
          atomStyle = { position: 'absolute' };
          
      if ( this.usingTransforms ) {
        atomStyle.left = 0;
        atomStyle.top = 0;
      }

      $atoms.css( atomStyle ).addClass( this.options.itemClass );

      this.updateSortData( $atoms, true );
      
      return $atoms;
    },
  
    // _init fires when your instance is first created
    // (from the constructor above), and when you
    // attempt to initialize the widget again (by the bridge)
    // after it has already been initialized.
    _init : function( callback ) {
      
      this.$filteredAtoms = this._filter( this.$allAtoms );
      this._sort();
      
      this.reLayout( callback );

    },

    option : function( opts ){
      // change options AFTER initialization:
      // signature: $('#foo').bar({ cool:false });
      if ( $.isPlainObject( opts ) ){
        this.options = $.extend( true, this.options, opts );
        for ( var optionName in opts ) {
          this._updateOption( optionName );
        }
      }
    },
    
    // ====================== updaters ====================== //
    // kind of like setters
    
    // trigger _updateOptionName if it exists
    _updateOption : function( optionName ) {
      var updateOptionFn = '_update' + optionName.charAt(0).toUpperCase() + optionName.slice(1);
      if ( this[ updateOptionFn ] ) {
        this[ updateOptionFn ]();
      }
    },
    
    _updateAnimationEngine : function() {
      var animationEngine = this.options.animationEngine.toLowerCase().replace( /[ _\-]/g, '');
      // set applyStyleFnName
      switch ( animationEngine ) {
        case 'css' :
        case 'none' :
          this.isUsingJQueryAnimation = false;
          break;
        case 'jquery' :
          this.isUsingJQueryAnimation = true;
          break;
        default : // best available
          this.isUsingJQueryAnimation = !Modernizr.csstransitions;
      }
      
      this._updateUsingTransforms();
    },
    
    _updateTransformsEnabled : function() {
      this._updateUsingTransforms();
    },
    
    _updateUsingTransforms : function() {
      this.usingTransforms = this.options.transformsEnabled && Modernizr.csstransforms && Modernizr.csstransitions && !this.isUsingJQueryAnimation;

      this.getPositionStyles = this.usingTransforms ? this._translate : this._positionAbs;
    },

    
    // ====================== Filtering ======================

    _filter : function( $atoms ) {
      var $filteredAtoms,
          filter = this.options.filter === '' ? '*' : this.options.filter;

      if ( !filter ) {
        $filteredAtoms = $atoms;
      } else {
        var hiddenClass    = this.options.hiddenClass,
            hiddenSelector = '.' + hiddenClass,
            $visibleAtoms  = $atoms.not( hiddenSelector ),
            $hiddenAtoms   = $atoms.filter( hiddenSelector ),
            $atomsToShow   = $hiddenAtoms;

        $filteredAtoms = $atoms.filter( filter );

        if ( filter !== '*' ) {
          $atomsToShow = $hiddenAtoms.filter( filter );

          var $atomsToHide = $visibleAtoms.not( filter ).toggleClass( hiddenClass );
          $atomsToHide.addClass( hiddenClass );
          this.styleQueue.push({ $el: $atomsToHide, style: this.options.hiddenStyle });
        }
        
        this.styleQueue.push({ $el: $atomsToShow, style: this.options.visibleStyle });
        $atomsToShow.removeClass( hiddenClass );
      }
      
      return $filteredAtoms;
    },
    
    // ====================== Sorting ======================
    
    updateSortData : function( $atoms, isIncrementingElemCount ) {
      var instance = this,
          getSortData = this.options.getSortData,
          $this, sortData;
      $atoms.each(function(){
        $this = $(this);
        sortData = {};
        // get value for sort data based on fn( $elem ) passed in
        for ( var key in getSortData ) {
          sortData[ key ] = getSortData[ key ]( $this, instance );
        }
        // apply sort data to element
        $.data( this, 'isotope-sort-data', sortData );
        if ( isIncrementingElemCount ) {
          instance.elemCount ++;
        }
      });
    },
    
    // used on all the filtered atoms
    _sort : function() {
      
      var sortBy = this.options.sortBy,
          getSorter = this._getSorter,
          sortDir = this.options.sortAscending ? 1 : -1,
          sortFn = function( alpha, beta ) {
            var a = getSorter( alpha, sortBy ),
                b = getSorter( beta, sortBy );
            // fall back to original order if data matches
            if ( a === b && sortBy !== 'original-order') {
              a = getSorter( alpha, 'original-order' );
              b = getSorter( beta, 'original-order' );
            }
            return ( ( a > b ) ? 1 : ( a < b ) ? -1 : 0 ) * sortDir;
          };
      
      this.$filteredAtoms.sort( sortFn );
    },

    _getSorter : function( elem, sortBy ) {
      return $.data( elem, 'isotope-sort-data' )[ sortBy ];
    },

    // ====================== Layout Helpers ======================

    _translate : function( x, y ) {
      return { translate : [ x, y ] };
    },
    
    _positionAbs : function( x, y ) {
      return { left: x, top: y };
    },

    _pushPosition : function( $elem, x, y ) {
      x += this.offset.left;
      y += this.offset.top;
      var position = this.getPositionStyles( x, y );
      this.styleQueue.push({ $el: $elem, style: position });
      if ( this.options.itemPositionDataEnabled ) {
        $elem.data('isotope-item-position', {x: x, y: y} );
      }
    },


    // ====================== General Layout ======================

    // used on collection of atoms (should be filtered, and sorted before )
    // accepts atoms-to-be-laid-out to start with
    layout : function( $elems, callback ) {

      var layoutMode = this.options.layoutMode;

      // layout logic
      this[ '_' +  layoutMode + 'Layout' ]( $elems );
      
      // set the size of the container
      if ( this.options.resizesContainer ) {
        var containerStyle = this[ '_' +  layoutMode + 'GetContainerSize' ]();
        this.styleQueue.push({ $el: this.element, style: containerStyle });
      }

      // are we animating the layout arrangement?
      // use plugin-ish syntax for css or animate
      var styleFn = !this.isLaidOut ? 'css' : (
            this.isUsingJQueryAnimation ? 'animate' : 'css'
          ),
          animOpts = this.options.animationOptions;

      // process styleQueue
      $.each( this.styleQueue, function( i, obj ) {
        obj.$el[ styleFn ]( obj.style, animOpts );
      });

      // clear out queue for next time
      this.styleQueue = [];

      // provide $elems as context for the callback
      if ( callback ) {
        callback.call( $elems );
      }
      
      this.isLaidOut = true;
    },
    
    
    resize : function() {
      if ( this[ '_' + this.options.layoutMode + 'ResizeChanged' ]() ) {
        this.reLayout();
      }
    },
    
    
    reLayout : function( callback ) {
      
      this[ '_' +  this.options.layoutMode + 'Reset' ]();
      this.layout( this.$filteredAtoms, callback );
      
    },
    
    // ====================== Convenience methods ======================
    
    // adds a jQuery object of items to a isotope container
    addItems : function( $content, callback ) {
      var $newAtoms = this._getAtoms( $content );
      // add new atoms to atoms pools
      // FIXME : this breaks shuffle order and returns to original order
      this.$allAtoms = this.$allAtoms.add( $newAtoms );

      if ( callback ) {
        callback( $newAtoms );
      }
    },
    
    // convienence method for adding elements properly to any layout
    insert : function( $content, callback ) {
      this.element.append( $content );
      
      var instance = this;
      this.addItems( $content, function( $newAtoms ) {
        var $filteredAtoms = instance._filter( $newAtoms );
        instance.$filteredAtoms = instance.$filteredAtoms.add( $filteredAtoms );
      });
      
      this._sort();
      this.reLayout( callback );
      
    },
    
    // convienence method for working with Infinite Scroll
    appended : function( $content, callback ) {
      var instance = this;
      this.addItems( $content, function( $newAtoms ){
        instance.$filteredAtoms = instance.$filteredAtoms.add( $newAtoms );
        instance.layout( $newAtoms, callback );
      });
    },
    
    // gathers all atoms
    reloadItems : function() {
      this.$allAtoms = this._getAtoms( this.element.children() );
    },
    
    // removes elements from Isotope widget
    remove : function( $content ) {

      this.$allAtoms = this.$allAtoms.not( $content );
      this.$filteredAtoms = this.$filteredAtoms.not( $content );

      $content.remove();
      
    },
    
    _shuffleArray : function ( array ) {
      var tmp, current, i = array.length;
      
      if ( i ){ 
        while(--i) {
          current = ~~( Math.random() * (i + 1) );
          tmp = array[current];
          array[current] = array[i];
          array[i] = tmp;
        }
      }
      return array;
    },
    
    // HACKy should probably remove
    shuffle : function( callback ) {
      this.options.sortBy = 'shuffle';
      
      this.$allAtoms = this._shuffleArray( this.$allAtoms );
      this.$filteredAtoms = this._filter( this.$allAtoms );
      
      this.reLayout( callback );
    },
    
    // destroys widget, returns elements and container back (close) to original style
    destroy : function() {

      var usingTransforms = this.usingTransforms;

      this.$allAtoms
        .removeClass( this.options.hiddenClass + ' ' + this.options.itemClass )
        .each(function(){
          this.style.position = null;
          this.style.top = null;
          this.style.left = null;
          this.style.opacity = null;
          if ( usingTransforms ) {
            this.style[ transformProp ] = null;
          }
        });
      
      // re-apply saved container styles
      var elemStyle = this.element[0].style;
      for ( var i=0, len = isoContainerStyles.length; i < len; i++ ) {
        var prop = isoContainerStyles[i];
        elemStyle[ prop ] = this.originalStyle[ prop ];
      }
      
      this.element
        .unbind('.isotope')
        .removeClass( this.options.containerClass )
        .removeData('isotope');
      
      $(window).unbind('.isotope');

    },
    
    
    // ====================== LAYOUTS ======================
    
    // calculates number of rows or columns
    // requires columnWidth or rowHeight to be set on namespaced object
    // i.e. this.masonry.columnWidth = 200
    _getSegments : function( isRows ) {
      var namespace = this.options.layoutMode,
          measure  = isRows ? 'rowHeight' : 'columnWidth',
          size     = isRows ? 'height' : 'width',
          UCSize   = isRows ? 'Height' : 'Width',
          segmentsName = isRows ? 'rows' : 'cols',
          containerSize = this.element[ size ](),
          segments,
          segmentSize;
      
                    // i.e. options.masonry && options.masonry.columnWidth
      segmentSize = this.options[ namespace ] && this.options[ namespace ][ measure ] ||
                    // or use the size of the first item
                    this.$filteredAtoms[ 'outer' + UCSize ](true) ||
                    // if there's no items, use size of container
                    containerSize;
      
      segments = Math.floor( containerSize / segmentSize );
      segments = Math.max( segments, 1 );

      // i.e. this.masonry.cols = ....
      this[ namespace ][ segmentsName ] = segments;
      // i.e. this.masonry.columnWidth = ...
      this[ namespace ][ measure ] = segmentSize;
      
    },
    
    _checkIfSegmentsChanged : function( isRows ) {
      var namespace = this.options.layoutMode,
          segmentsName = isRows ? 'rows' : 'cols',
          prevSegments = this[ namespace ][ segmentsName ];
      // update cols/rows
      this._getSegments( isRows );
      // return if updated cols/rows is not equal to previous
      return ( this[ namespace ][ segmentsName ] !== prevSegments );
    },

    // ====================== Masonry ======================
  
    _masonryReset : function() {
      // layout-specific props
      this.masonry = {};
      // FIXME shouldn't have to call this again
      this._getSegments();
      var i = this.masonry.cols;
      this.masonry.colYs = [];
      while (i--) {
        this.masonry.colYs.push( 0 );
      }
    },
  
    _masonryLayout : function( $elems ) {
      var instance = this,
          props = instance.masonry;
      $elems.each(function(){
        var $this  = $(this),
            //how many columns does this brick span
            colSpan = Math.ceil( $this.outerWidth(true) / props.columnWidth );
        colSpan = Math.min( colSpan, props.cols );

        if ( colSpan === 1 ) {
          // if brick spans only one column, just like singleMode
          instance._masonryPlaceBrick( $this, props.colYs );
        } else {
          // brick spans more than one column
          // how many different places could this brick fit horizontally
          var groupCount = props.cols + 1 - colSpan,
              groupY = [],
              groupColY,
              i;

          // for each group potential horizontal position
          for ( i=0; i < groupCount; i++ ) {
            // make an array of colY values for that one group
            groupColY = props.colYs.slice( i, i+colSpan );
            // and get the max value of the array
            groupY[i] = Math.max.apply( Math, groupColY );
          }
        
          instance._masonryPlaceBrick( $this, groupY );
        }
      });
    },
    
    // worker method that places brick in the columnSet
    //   with the the minY
    _masonryPlaceBrick : function( $brick, setY ) {
      // get the minimum Y value from the columns
      var minimumY = Math.min.apply( Math, setY ),
          shortCol = 0;

      // Find index of short column, the first from the left
      for (var i=0, len = setY.length; i < len; i++) {
        if ( setY[i] === minimumY ) {
          shortCol = i;
          break;
        }
      }
    
      // position the brick
      x = this.masonry.columnWidth * shortCol;
      y = minimumY;
      this._pushPosition( $brick, x, y );

      // apply setHeight to necessary columns
      var setHeight = minimumY + $brick.outerHeight(true),
          setSpan = this.masonry.cols + 1 - len;
      for ( i=0; i < setSpan; i++ ) {
        this.masonry.colYs[ shortCol + i ] = setHeight;
      }

    },
    
    _masonryGetContainerSize : function() {
      var containerHeight = Math.max.apply( Math, this.masonry.colYs );
      return { height: containerHeight+76 };
    },
  
    _masonryResizeChanged : function() {
      return this._checkIfSegmentsChanged();
    },
  
    // ====================== fitRows ======================
    
    _fitRowsReset : function() {
      this.fitRows = {
        x : 0,
        y : 0,
        height : 0
      };
    },
  
    _fitRowsLayout : function( $elems ) {
      var instance = this,
          containerWidth = this.element.width(),
          props = this.fitRows;
      
      $elems.each( function() {
        var $this = $(this),
            atomW = $this.outerWidth(true),
            atomH = $this.outerHeight(true);
      
        if ( props.x !== 0 && atomW + props.x > containerWidth ) {
          // if this element cannot fit in the current row
          props.x = 0;
          props.y = props.height;
        } 
      
        // position the atom
        instance._pushPosition( $this, props.x, props.y );
  
        props.height = Math.max( props.y + atomH, props.height );
        props.x += atomW;
  
      });
    },
  
    _fitRowsGetContainerSize : function () {
      return { height : this.fitRows.height };
    },
  
    _fitRowsResizeChanged : function() {
      return true;
    },
  

    // ====================== cellsByRow ======================
  
    _cellsByRowReset : function() {
      this.cellsByRow = {
        index : 0
      };
      // get this.cellsByRow.columnWidth
      this._getSegments();
      // get this.cellsByRow.rowHeight
      this._getSegments(true);
    },

    _cellsByRowLayout : function( $elems ) {
      var instance = this,
          props = this.cellsByRow;
      $elems.each( function(){
        var $this = $(this),
            col = props.index % props.cols,
            row = ~~( props.index / props.cols ),
            x = ( col + 0.5 ) * props.columnWidth - $this.outerWidth(true) / 2,
            y = ( row + 0.5 ) * props.rowHeight - $this.outerHeight(true) / 2;
        instance._pushPosition( $this, x, y );
        props.index ++;
      });
    },

    _cellsByRowGetContainerSize : function() {
      return { height : Math.ceil( this.$filteredAtoms.length / this.cellsByRow.cols ) * this.cellsByRow.rowHeight + this.offset.top };
    },

    _cellsByRowResizeChanged : function() {
      return this._checkIfSegmentsChanged();
    },
  
  
    // ====================== straightDown ======================
  
    _straightDownReset : function() {
      this.straightDown = {
        y : 0
      };
    },

    _straightDownLayout : function( $elems ) {
      var instance = this;
      $elems.each( function( i ){
        var $this = $(this);
        instance._pushPosition( $this, 0, instance.straightDown.y );
        instance.straightDown.y += $this.outerHeight(true);
      });
    },

    _straightDownGetContainerSize : function() {
      return { height : this.straightDown.y };
    },

    _straightDownResizeChanged : function() {
      return true;
    },


    // ====================== masonryHorizontal ======================
    
    _masonryHorizontalReset : function() {
      // layout-specific props
      this.masonryHorizontal = {};
      // FIXME shouldn't have to call this again
      this._getSegments( true );
      var i = this.masonryHorizontal.rows;
      this.masonryHorizontal.rowXs = [];
      while (i--) {
        this.masonryHorizontal.rowXs.push( 0 );
      }
    },
  
    _masonryHorizontalLayout : function( $elems ) {
      var instance = this,
          props = instance.masonryHorizontal;
      $elems.each(function(){
        var $this  = $(this),
            //how many rows does this brick span
            rowSpan = Math.ceil( $this.outerHeight(true) / props.rowHeight );
        rowSpan = Math.min( rowSpan, props.rows );

        if ( rowSpan === 1 ) {
          // if brick spans only one column, just like singleMode
          instance._masonryHorizontalPlaceBrick( $this, props.rowXs );
        } else {
          // brick spans more than one row
          // how many different places could this brick fit horizontally
          var groupCount = props.rows + 1 - rowSpan,
              groupX = [],
              groupRowX, i;

          // for each group potential horizontal position
          for ( i=0; i < groupCount; i++ ) {
            // make an array of colY values for that one group
            groupRowX = props.rowXs.slice( i, i+rowSpan );
            // and get the max value of the array
            groupX[i] = Math.max.apply( Math, groupRowX );
          }

          instance._masonryHorizontalPlaceBrick( $this, groupX );
        }
      });
    },
    
    _masonryHorizontalPlaceBrick : function( $brick, setX ) {
      // get the minimum Y value from the columns
      var minimumX  = Math.min.apply( Math, setX ),
          smallRow  = 0;
      // Find index of smallest row, the first from the top
      for (var i=0, len = setX.length; i < len; i++) {
        if ( setX[i] === minimumX ) {
          smallRow = i;
          break;
        }
      }

      // position the brick
      x = minimumX;
      y = this.masonryHorizontal.rowHeight * smallRow;
      this._pushPosition( $brick, x, y );

      // apply setHeight to necessary columns
      var setWidth = minimumX + $brick.outerWidth(true),
          setSpan = this.masonryHorizontal.rows + 1 - len;
      for ( i=0; i < setSpan; i++ ) {
        this.masonryHorizontal.rowXs[ smallRow + i ] = setWidth;
      }
    },

    _masonryHorizontalGetContainerSize : function() {
      var containerWidth = Math.max.apply( Math, this.masonryHorizontal.rowXs );
      return { width: containerWidth };
    },
    
    _masonryHorizontalResizeChanged : function() {
      return this._checkIfSegmentsChanged(true);
    },


    // ====================== fitColumns ======================
  
    _fitColumnsReset : function() {
      this.fitColumns = {
        x : 0,
        y : 0,
        width : 0
      };
    },
    
    _fitColumnsLayout : function( $elems ) {
      var instance = this,
          containerHeight = this.element.height(),
          props = this.fitColumns;
      $elems.each( function() {
        var $this = $(this),
            atomW = $this.outerWidth(true),
            atomH = $this.outerHeight(true);

        if ( props.y !== 0 && atomH + props.y > containerHeight ) {
          // if this element cannot fit in the current column
          props.x = props.width;
          props.y = 0;
        } 

        // position the atom
        instance._pushPosition( $this, props.x, props.y );

        props.width = Math.max( props.x + atomW, props.width );
        props.y += atomH;

      });
    },
    
    _fitColumnsGetContainerSize : function () {
      return { width : this.fitColumns.width };
    },
    
    _fitColumnsResizeChanged : function() {
      return true;
    },
    

  
    // ====================== cellsByColumn ======================
  
    _cellsByColumnReset : function() {
      this.cellsByColumn = {
        index : 0
      };
      // get this.cellsByColumn.columnWidth
      this._getSegments();
      // get this.cellsByColumn.rowHeight
      this._getSegments(true);
    },

    _cellsByColumnLayout : function( $elems ) {
      var instance = this,
          props = this.cellsByColumn;
      $elems.each( function(){
        var $this = $(this),
            col = ~~( props.index / props.rows ),
            row = props.index % props.rows,
            x = ( col + 0.5 )  * props.columnWidth - $this.outerWidth(true) / 2,
            y = ( row + 0.5 ) * props.rowHeight - $this.outerHeight(true) / 2;
        instance._pushPosition( $this, x, y );
        props.index ++;
      });
    },

    _cellsByColumnGetContainerSize : function() {
      return { width : Math.ceil( this.$filteredAtoms.length / this.cellsByColumn.rows ) * this.cellsByColumn.columnWidth };
    },

    _cellsByColumnResizeChanged : function() {
      return this._checkIfSegmentsChanged(true);
    },
    
    // ====================== straightAcross ======================

    _straightAcrossReset : function() {
      this.straightAcross = {
        x : 0
      };
    },

    _straightAcrossLayout : function( $elems ) {
      var instance = this;
      $elems.each( function( i ){
        var $this = $(this);
        instance._pushPosition( $this, instance.straightAcross.x, 0 );
        instance.straightAcross.x += $this.outerWidth(true);
      });
    },

    _straightAcrossGetContainerSize : function() {
      return { width : this.straightAcross.x };
    },

    _straightAcrossResizeChanged : function() {
      return true;
    }

  };
  
  
  // ======================= imagesLoaded Plugin  ===============================
  // A fork of http://gist.github.com/268257 by Paul Irish

  // mit license. paul irish. 2010.
  // webkit fix from Oren Solomianik. thx!

  $.fn.imagesLoaded = function(callback){
    var elems = this.find('img'),
        len   = elems.length,
        _this = this;

    if ( !elems.length ) {
      callback.call( this );
    }

    elems.bind('load',function(){
      if (--len <= 0){ 
        callback.call( _this ); 
      }
    }).each(function(){
      // cached images don't fire load sometimes, so we reset src.
      if (this.complete || this.complete === undefined){
        var src = this.src;
        // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
        // data uri bypasses webkit log warning (thx doug jones)
        this.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
        this.src = src;
      }  
    }); 

    return this;
  };

  

  // =======================  Plugin bridge  ===============================
  // leverages data method to either create or return $.Isotope constructor
  // A bit from jQuery UI
  //   https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
  // A bit from jcarousel 
  //   https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js

  $.fn.isotope = function( options ) {
    if ( typeof options === 'string' ) {
      // call method
      var args = Array.prototype.slice.call( arguments, 1 );

      this.each(function(){
        var instance = $.data( this, 'isotope' );
        if ( !instance ) {
          return $.error( "cannot call methods on isotope prior to initialization; " +
            "attempted to call method '" + options + "'" );
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
          return $.error( "no such method '" + options + "' for isotope instance" );
        }
        // apply method
        instance[ options ].apply( instance, args );
      });
    } else {
      this.each(function() {
        var instance = $.data( this, 'isotope' );
        if ( instance ) {
          // apply options & init
          instance.option( options );
          instance._init();
        } else {
          // initialize new instance
          $.data( this, 'isotope', new $.Isotope( options, this ) );
        }
      });
    }
    // return jQuery object
    // so plugin methods do not have to
    return this;
  };

})( window, jQuery );

///
///
///
///
///
//////
/////
/////
// ColorBox v1.3.16 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2011 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
(function ($, document, window) {
	var
	// ColorBox Default Settings.	
	// See http://colorpowered.com/colorbox for details.
	defaults = {
		transition: "elastic",
		speed: 300,
		width: false,
		initialWidth: "600",
		innerWidth: false,
		maxWidth: false,
		height: false,
		initialHeight: "450",
		innerHeight: false,
		maxHeight: false,
		scalePhotos: true,
		scrolling: true,
		inline: false,
		html: false,
		iframe: false,
		fastIframe: true,
		photo: false,
		href: false,
		title: false,
		rel: false,
		opacity: 0.9,
		preloading: true,
		current: "image {current} of {total}",
		previous: "previous",
		next: "next",
		close: "close",
		open: false,
		returnFocus: true,
		loop: true,
		slideshow: false,
		slideshowAuto: true,
		slideshowSpeed: 2500,
		slideshowStart: "start slideshow",
		slideshowStop: "stop slideshow",
		onOpen: false,
		onLoad: false,
		onComplete: false,
		onCleanup: false,
		onClosed: false,
		overlayClose: true,		
		escKey: true,
		arrowKey: true
	},
	
	// Abstracting the HTML and event identifiers for easy rebranding
	colorbox = 'colorbox',
	prefix = 'cbox',
	
	// Events	
	event_open = prefix + '_open',
	event_load = prefix + '_load',
	event_complete = prefix + '_complete',
	event_cleanup = prefix + '_cleanup',
	event_closed = prefix + '_closed',
	event_purge = prefix + '_purge',
	
	// Special Handling for IE
	isIE = $.browser.msie && !$.support.opacity, // feature detection alone gave a false positive on at least one phone browser and on some development versions of Chrome.
	isIE6 = isIE && $.browser.version < 7,
	event_ie6 = prefix + '_IE6',

	// Cached jQuery Object Variables
	$overlay,
	$box,
	$wrap,
	$content,
	$topBorder,
	$leftBorder,
	$rightBorder,
	$bottomBorder,
	$related,
	$window,
	$loaded,
	$loadingBay,
	$loadingOverlay,
	$title,
	$current,
	$slideshow,
	$next,
	$prev,
	$close,
	$groupControls,

	// Variables for cached values or use across multiple functions
	settings = {},
	interfaceHeight,
	interfaceWidth,
	loadedHeight,
	loadedWidth,
	element,
	index,
	photo,
	open,
	active,
	closing = false,
	
	publicMethod,
	boxElement = prefix + 'Element';
	
	// ****************
	// HELPER FUNCTIONS
	// ****************

	// jQuery object generator to reduce code size
	function $div(id, cssText) { 
		var div = document.createElement('div');
		if (id) {
            div.id = prefix + id;
        }
		div.style.cssText = cssText || false;
		return $(div);
	}

	// Convert % values to pixels
	function setSize(size, dimension) {
		dimension = dimension === 'x' ? $window.width() : $window.height();
		return (typeof size === 'string') ? Math.round((/%/.test(size) ? (dimension / 100) * parseInt(size, 10) : parseInt(size, 10))) : size;
	}
	
	// Checks an href to see if it is a photo.
	// There is a force photo option (photo: true) for hrefs that cannot be matched by this regex.
	function isImage(url) {
		return settings.photo || /\.(gif|png|jpg|jpeg|bmp)(?:\?([^#]*))?(?:#(\.*))?$/i.test(url);
	}
	
	// Assigns function results to their respective settings.  This allows functions to be used as values.
	function process(settings) {
		for (var i in settings) {
			if ($.isFunction(settings[i]) && i.substring(0, 2) !== 'on') { // checks to make sure the function isn't one of the callbacks, they will be handled at the appropriate time.
			    settings[i] = settings[i].call(element);
			}
		}
		settings.rel = settings.rel || element.rel || 'nofollow';
		settings.href = $.trim(settings.href || $(element).attr('href'));
		settings.title = settings.title || element.title;
	}

	function trigger(event, callback) {
		if (callback) {
			callback.call(element);
		}
		$.event.trigger(event);
	}

	// Slideshow functionality
	function slideshow() {
		var
		timeOut,
		className = prefix + "Slideshow_",
		click = "click." + prefix,
		start,
		stop,
		clear;
		
		if (settings.slideshow && $related[1]) {
			start = function () {
				$slideshow
					.text(settings.slideshowStop)
					.unbind(click)
					.bind(event_complete, function () {
						if (index < $related.length - 1 || settings.loop) {
							timeOut = setTimeout(publicMethod.next, settings.slideshowSpeed);
						}
					})
					.bind(event_load, function () {
						clearTimeout(timeOut);
					})
					.one(click + ' ' + event_cleanup, stop);
				$box.removeClass(className + "off").addClass(className + "on");
				timeOut = setTimeout(publicMethod.next, settings.slideshowSpeed);
			};
			
			stop = function () {
				clearTimeout(timeOut);
				$slideshow
					.text(settings.slideshowStart)
					.unbind([event_complete, event_load, event_cleanup, click].join(' '))
					.one(click, start);
				$box.removeClass(className + "on").addClass(className + "off");
			};
			
			if (settings.slideshowAuto) {
				start();
			} else {
				stop();
			}
		}
	}

	function launch(elem) {
		if (!closing) {
			
			element = elem;
			
			process($.extend(settings, $.data(element, colorbox)));
			
			$related = $(element);
			
			index = 0;
			myClass = $(this).attr('class');
			if (settings.myClass !== 'nofollow') {
				$related = $('.' + boxElement).filter(function () {
					var relRelated = $.data(this, colorbox).myClass || this.myClass;
					//alert(relRelated);
					return (relRelated === settings.myClass);
				});
				index = $related.index(element);
				
				// Check direct calls to ColorBox.
				if (index === -1) {
					$related = $related.add(element);
					index = $related.length - 1;
				}
			}
			
			if (!open) {
				open = active = true; // Prevents the page-change action from queuing up if the visitor holds down the left or right keys.
				
				$box.show();
				
				if (settings.returnFocus) {
					try {
						element.blur();
						$(element).one(event_closed, function () {
							try {
								this.focus();
							} catch (e) {
								// do nothing
							}
						});
					} catch (e) {
						// do nothing
					}
				}
				
				// +settings.opacity avoids a problem in IE when using non-zero-prefixed-string-values, like '.5'
				$overlay.css({"opacity": +settings.opacity, "cursor": settings.overlayClose ? "pointer" : "auto"}).show();
				
				// Opens inital empty ColorBox prior to content being loaded.
				settings.w = setSize(settings.initialWidth, 'x');
				settings.h = setSize(settings.initialHeight, 'y');
				publicMethod.position(0);
				
				if (isIE6) {
					$window.bind('resize.' + event_ie6 + ' scroll.' + event_ie6, function () {
						$overlay.css({width: $window.width(), height: $window.height(), top: $window.scrollTop(), left: $window.scrollLeft()});
					}).trigger('resize.' + event_ie6);
				}
				
				trigger(event_open, settings.onOpen);
				
				$groupControls.add($title).hide();
				
				$close.html(settings.close).show();
			}
			
			publicMethod.load(true);
		}
	}

	// ****************
	// PUBLIC FUNCTIONS
	// Usage format: $.fn.colorbox.close();
	// Usage from within an iframe: parent.$.fn.colorbox.close();
	// ****************
	
	publicMethod = $.fn[colorbox] = $[colorbox] = function (options, callback) {
		var $this = this, autoOpen;
		
		if (!$this[0] && $this.selector) { // if a selector was given and it didn't match any elements, go ahead and exit.
			return $this;
		}
		
		options = options || {};
		
		if (callback) {
			options.onComplete = callback;
		}
		
		if (!$this[0] || $this.selector === undefined) { // detects $.colorbox() and $.fn.colorbox()
			$this = $('<a/>');
			options.open = true; // assume an immediate open
		}
		
		$this.each(function () {
			$.data(this, colorbox, $.extend({}, $.data(this, colorbox) || defaults, options));
			$(this).addClass(boxElement);
		});
		
		autoOpen = options.open;
		
		if ($.isFunction(autoOpen)) {
			autoOpen = autoOpen.call($this);
		}
		
		if (autoOpen) {
			launch($this[0]);
		}
		
		return $this;
	};

	// Initialize ColorBox: store common calculations, preload the interface graphics, append the html.
	// This preps colorbox for a speedy open when clicked, and lightens the burdon on the browser by only
	// having to run once, instead of each time colorbox is opened.
	publicMethod.init = function () {
		// Create & Append jQuery Objects
		$window = $(window);
		$box = $div().attr({id: colorbox, 'class': isIE ? prefix + (isIE6 ? 'IE6' : 'IE') : ''});
		$overlay = $div("Overlay", isIE6 ? 'position:absolute' : '').hide();
		
		$wrap = $div("Wrapper");
		$content = $div("Content").append(
			$loaded = $div("LoadedContent", 'width:0; height:0; overflow:hidden'),
			$loadingOverlay = $div("LoadingOverlay").add($div("LoadingGraphic")),
			$title = $div("Title"),
			$current = $div("Current"),
			$next = $div("Next"),
			$prev = $div("Previous"),
			$slideshow = $div("Slideshow").bind(event_open, slideshow),
			$close = $div("Close")
		);
		$wrap.append( // The 3x3 Grid that makes up ColorBox
			$div().append(
				$div("TopLeft"),
				$topBorder = $div("TopCenter"),
				$div("TopRight")
			),
			$div(false, 'clear:left').append(
				$leftBorder = $div("MiddleLeft"),
				$content,
				$rightBorder = $div("MiddleRight")
			),
			$div(false, 'clear:left').append(
				$div("BottomLeft"),
				$bottomBorder = $div("BottomCenter"),
				$div("BottomRight")
			)
		).children().children().css({'float': 'left'});
		
		$loadingBay = $div(false, 'position:absolute; width:9999px; visibility:hidden; display:none');
		
		$('body').prepend($overlay, $box.append($wrap, $loadingBay));
		
		$content.children()
		.hover(function () {
			$(this).addClass('hover');
		}, function () {
			$(this).removeClass('hover');
		}).addClass('hover');
		
		// Cache values needed for size calculations
		interfaceHeight = $topBorder.height() + $bottomBorder.height() + $content.outerHeight(true) - $content.height();//Subtraction needed for IE6
		interfaceWidth = $leftBorder.width() + $rightBorder.width() + $content.outerWidth(true) - $content.width();
		loadedHeight = $loaded.outerHeight(true);
		loadedWidth = $loaded.outerWidth(true);
		
		// Setting padding to remove the need to do size conversions during the animation step.
		$box.css({"padding-bottom": interfaceHeight, "padding-right": interfaceWidth}).hide();
		
                // Setup button events.
                $next.click(function () {
                        publicMethod.next();
                });
                $prev.click(function () {
                        publicMethod.prev();
                });
                $close.click(function () {
                        publicMethod.close();
                });
		
		$groupControls = $next.add($prev).add($current).add($slideshow);
		
		// Adding the 'hover' class allowed the browser to load the hover-state
		// background graphics.  The class can now can be removed.
		$content.children().removeClass('hover');
		
		$('.' + boxElement).live('click', function (e) {
			// checks to see if it was a non-left mouse-click and for clicks modified with ctrl, shift, or alt.
			if (!((e.button !== 0 && typeof e.button !== 'undefined') || e.ctrlKey || e.shiftKey || e.altKey)) {
				e.preventDefault();
				launch(this);
			}
		});
		
		$overlay.click(function () {
			if (settings.overlayClose) {
				publicMethod.close();
			}
		});
		
		// Set Navigation Key Bindings
		$(document).bind('keydown.' + prefix, function (e) {
                        var key = e.keyCode;
			if (open && settings.escKey && key === 27) {
				e.preventDefault();
				publicMethod.close();
			}
			if (open && settings.arrowKey && $related[1]) {
				if (key === 37) {
					e.preventDefault();
					$prev.click();
				} else if (key === 39) {
					e.preventDefault();
					$next.click();
				}
			}
		});
	};
	
	publicMethod.remove = function () {
		$box.add($overlay).remove();
		$('.' + boxElement).die('click').removeData(colorbox).removeClass(boxElement);
	};

	publicMethod.position = function (speed, loadedCallback) {
		var
		animate_speed,
		// keeps the top and left positions within the browser's viewport.
		posTop = Math.max(document.documentElement.clientHeight - settings.h - loadedHeight - interfaceHeight, 0) / 2 + $window.scrollTop(),
		posLeft = Math.max($window.width() - settings.w - loadedWidth - interfaceWidth, 0) / 2 + $window.scrollLeft();
		
		// setting the speed to 0 to reduce the delay between same-sized content.
		animate_speed = ($box.width() === settings.w + loadedWidth && $box.height() === settings.h + loadedHeight) ? 0 : speed;
		
		// this gives the wrapper plenty of breathing room so it's floated contents can move around smoothly,
		// but it has to be shrank down around the size of div#colorbox when it's done.  If not,
		// it can invoke an obscure IE bug when using iframes.
		$wrap[0].style.width = $wrap[0].style.height = "9999px";
		
		function modalDimensions(that) {
			// loading overlay height has to be explicitly set for IE6.
			$topBorder[0].style.width = $bottomBorder[0].style.width = $content[0].style.width = that.style.width;
			$loadingOverlay[0].style.height = $loadingOverlay[1].style.height = $content[0].style.height = $leftBorder[0].style.height = $rightBorder[0].style.height = that.style.height;
		}
		
		$box.dequeue().animate({width: settings.w + loadedWidth, height: settings.h + loadedHeight, top: posTop, left: posLeft}, {
			duration: animate_speed,
			complete: function () {
				modalDimensions(this);
				
				active = false;
				
				// shrink the wrapper down to exactly the size of colorbox to avoid a bug in IE's iframe implementation.
				$wrap[0].style.width = (settings.w + loadedWidth + interfaceWidth) + "px";
				$wrap[0].style.height = (settings.h + loadedHeight + interfaceHeight) + "px";
				
				if (loadedCallback) {
					loadedCallback();
				}
			},
			step: function () {
				modalDimensions(this);
			}
		});
	};

	publicMethod.resize = function (options) {
		if (open) {
			options = options || {};
			
			if (options.width) {
				settings.w = setSize(options.width, 'x') - loadedWidth - interfaceWidth;
			}
			if (options.innerWidth) {
				settings.w = setSize(options.innerWidth, 'x');
			}
			$loaded.css({width: settings.w});
			
			if (options.height) {
				settings.h = setSize(options.height, 'y') - loadedHeight - interfaceHeight;
			}
			if (options.innerHeight) {
				settings.h = setSize(options.innerHeight, 'y');
			}
			if (!options.innerHeight && !options.height) {				
				var $child = $loaded.wrapInner("<div style='overflow:auto'></div>").children(); // temporary wrapper to get an accurate estimate of just how high the total content should be.
				settings.h = $child.height();
				$child.replaceWith($child.children()); // ditch the temporary wrapper div used in height calculation
			}
			$loaded.css({height: settings.h});
			
			publicMethod.position(settings.transition === "none" ? 0 : settings.speed);
		}
	};

	publicMethod.prep = function (object) {
		if (!open) {
			return;
		}
		
		var speed = settings.transition === "none" ? 0 : settings.speed;
		
		$window.unbind('resize.' + prefix);
		$loaded.remove();
		$loaded = $div('LoadedContent').html(object);
		
		function getWidth() {
			settings.w = settings.w || $loaded.width();
			settings.w = settings.mw && settings.mw < settings.w ? settings.mw : settings.w;
			return settings.w;
		}
		function getHeight() {
			settings.h = settings.h || $loaded.height();
			settings.h = settings.mh && settings.mh < settings.h ? settings.mh : settings.h;
			return settings.h;
		}
		
		$loaded.hide()
		.appendTo($loadingBay.show())// content has to be appended to the DOM for accurate size calculations.
		.css({width: getWidth(), overflow: settings.scrolling ? 'auto' : 'hidden'})
		.css({height: getHeight()})// sets the height independently from the width in case the new width influences the value of height.
		.prependTo($content);
		
		$loadingBay.hide();
		
		// floating the IMG removes the bottom line-height and fixed a problem where IE miscalculates the width of the parent element as 100% of the document width.
		//$(photo).css({'float': 'none', marginLeft: 'auto', marginRight: 'auto'});
		
                $(photo).css({'float': 'none'});
                
		// Hides SELECT elements in IE6 because they would otherwise sit on top of the overlay.
		if (isIE6) {
			$('select').not($box.find('select')).filter(function () {
				return this.style.visibility !== 'hidden';
			}).css({'visibility': 'hidden'}).one(event_cleanup, function () {
				this.style.visibility = 'inherit';
			});
		}
		
		function setPosition(s) {
			publicMethod.position(s, function () {
				var prev, prevSrc, next, nextSrc, total = $related.length, iframe, complete;
				
				if (!open) {
					return;
				}
				
				complete = function () {
					$loadingOverlay.hide();
					trigger(event_complete, settings.onComplete);
				};
				
				if (isIE) {
					//This fadeIn helps the bicubic resampling to kick-in.
					if (photo) {
						$loaded.fadeIn(100);
					}
				}
				
				$title.html(settings.title).add($loaded).show();
				
				if (total > 1) { // handle grouping
					if (typeof settings.current === "string") {
						$current.html(settings.current.replace(/\{current\}/, index + 1).replace(/\{total\}/, total)).show();
					}
					
					$next[(settings.loop || index < total - 1) ? "show" : "hide"]().html(settings.next);
					$prev[(settings.loop || index) ? "show" : "hide"]().html(settings.previous);
					
					prev = index ? $related[index - 1] : $related[total - 1];
					next = index < total - 1 ? $related[index + 1] : $related[0];
					
					if (settings.slideshow) {
						$slideshow.show();
					}
					
					// Preloads images within a rel group
					if (settings.preloading) {
						nextSrc = $.data(next, colorbox).href || next.href;
						prevSrc = $.data(prev, colorbox).href || prev.href;
						
						nextSrc = $.isFunction(nextSrc) ? nextSrc.call(next) : nextSrc;
						prevSrc = $.isFunction(prevSrc) ? prevSrc.call(prev) : prevSrc;
						
						if (isImage(nextSrc)) {
							$('<img/>')[0].src = nextSrc;
						}
						
						if (isImage(prevSrc)) {
							$('<img/>')[0].src = prevSrc;
						}
					}
				} else {
					$groupControls.hide();
				}
				
				if (settings.iframe) {
					iframe = $('<iframe/>').addClass(prefix + 'Iframe')[0];
					
					if (settings.fastIframe) {
						complete();
					} else {
						$(iframe).load(complete);
					}
					iframe.name = prefix + (+new Date());
					iframe.src = settings.href;
					
					if (!settings.scrolling) {
						iframe.scrolling = "no";
					}
					
					if (isIE) {
                        iframe.frameBorder=0;
						iframe.allowTransparency = "true";
					}
					
					$(iframe).appendTo($loaded).one(event_purge, function () {
						iframe.src = "//about:blank";
					});
				} else {
					complete();
				}
				
				if (settings.transition === 'fade') {
					$box.fadeTo(speed, 1, function () {
						$box[0].style.filter = "";
					});
				} else {
                     $box[0].style.filter = "";
				}
				
				$window.bind('resize.' + prefix, function () {
					publicMethod.position(0);
				});
			});
		}
		
		if (settings.transition === 'fade') {
			$box.fadeTo(speed, 0, function () {
				setPosition(0);
			});
		} else {
			setPosition(speed);
		}
	};

	publicMethod.load = function (launched) {
		var href, setResize, prep = publicMethod.prep;
		
		active = true;
		
		photo = false;
		
		element = $related[index];
		
		if (!launched) {
			process($.extend(settings, $.data(element, colorbox)));
		}
		
		trigger(event_purge);
		
		trigger(event_load, settings.onLoad);
		
		settings.h = settings.height ?
				setSize(settings.height, 'y') - loadedHeight - interfaceHeight :
				settings.innerHeight && setSize(settings.innerHeight, 'y');
		
		settings.w = settings.width ?
				setSize(settings.width, 'x') - loadedWidth - interfaceWidth :
				settings.innerWidth && setSize(settings.innerWidth, 'x');
		
		// Sets the minimum dimensions for use in image scaling
		settings.mw = settings.w;
		settings.mh = settings.h;
		
		// Re-evaluate the minimum width and height based on maxWidth and maxHeight values.
		// If the width or height exceed the maxWidth or maxHeight, use the maximum values instead.
		if (settings.maxWidth) {
			settings.mw = setSize(settings.maxWidth, 'x') - loadedWidth - interfaceWidth;
			settings.mw = settings.w && settings.w < settings.mw ? settings.w : settings.mw;
		}
		if (settings.maxHeight) {
			settings.mh = setSize(settings.maxHeight, 'y') - loadedHeight - interfaceHeight;
			settings.mh = settings.h && settings.h < settings.mh ? settings.h : settings.mh;
		}
		
		href = settings.href;
		
		$loadingOverlay.show();

		if (settings.inline) {
			// Inserts an empty placeholder where inline content is being pulled from.
			// An event is bound to put inline content back when ColorBox closes or loads new content.
			$div().hide().insertBefore($(href)[0]).one(event_purge, function () {
				$(this).replaceWith($loaded.children());
			});
			prep($(href));
		} else if (settings.iframe) {
			// IFrame element won't be added to the DOM until it is ready to be displayed,
			// to avoid problems with DOM-ready JS that might be trying to run in that iframe.
			prep(" ");
		} else if (settings.html) {
			prep(settings.html);
		} else if (isImage(href)) {
			$(photo = new Image())
			.addClass(prefix + 'Photo')
			.error(function () {
				settings.title = false;
				prep($div('Error').text('This image could not be loaded'));
			})
			.load(function () {
				var percent;
				photo.onload = null; //stops animated gifs from firing the onload repeatedly.
				
				if (settings.scalePhotos) {
					setResize = function () {
						photo.height -= photo.height * percent;
						photo.width -= photo.width * percent;	
					};
					if (settings.mw && photo.width > settings.mw) {
						percent = (photo.width - settings.mw) / photo.width;
						setResize();
					}
					if (settings.mh && photo.height > settings.mh) {
						percent = (photo.height - settings.mh) / photo.height;
						setResize();
					}
				}
				
				if (settings.h) {
					photo.style.marginTop = Math.max(settings.h - photo.height, 0) / 2 + 'px';
				}
				
				if ($related[1] && (index < $related.length - 1 || settings.loop)) {
					photo.style.cursor = 'pointer';
					photo.onclick = function () {
                                                publicMethod.next();
                                        };
				}
				
				if (isIE) {
					photo.style.msInterpolationMode = 'bicubic';
				}
				
				setTimeout(function () { // A pause because Chrome will sometimes report a 0 by 0 size otherwise.
					prep(photo);
				}, 1);
			});
			
			setTimeout(function () { // A pause because Opera 10.6+ will sometimes not run the onload function otherwise.
				photo.src = href;
			}, 1);
		} else if (href) {
			$loadingBay.load(href, function (data, status, xhr) {
				prep(status === 'error' ? $div('Error').text('Request unsuccessful: ' + xhr.statusText) : $(this).contents());
			});
		}
	};
        
	// Navigates to the next page/image in a set.
	publicMethod.next = function () {
		if (!active && $related[1] && (index < $related.length - 1 || settings.loop)) {
			index = index < $related.length - 1 ? index + 1 : 0;
			publicMethod.load();
		}
	};
	
	publicMethod.prev = function () {
		if (!active && $related[1] && (index || settings.loop)) {
			index = index ? index - 1 : $related.length - 1;
			publicMethod.load();
		}
	};

	// Note: to use this within an iframe use the following format: parent.$.fn.colorbox.close();
	publicMethod.close = function () {
		if (open && !closing) {
			
			closing = true;
			
			open = false;
			
			trigger(event_cleanup, settings.onCleanup);
			
			$window.unbind('.' + prefix + ' .' + event_ie6);
			
			$overlay.fadeTo(200, 0);
			
			$box.stop().fadeTo(300, 0, function () {
                                
				$box.add($overlay).css({'opacity': 1, cursor: 'auto'}).hide();
				
				trigger(event_purge);
				
				$loaded.remove();
				
				setTimeout(function () {
					closing = false;
					trigger(event_closed, settings.onClosed);
				}, 1);
			});
		}
	};

	// A method for fetching the current element ColorBox is referencing.
	// returns a jQuery object.
	publicMethod.element = function () {
		return $(element);
	};

	publicMethod.settings = defaults;

	// Initializes ColorBox when the DOM has loaded
	$(publicMethod.init);

}(jQuery, document, this));

jQuery(document).ready(function(){
	
		jQuery("a[class='lightbox_image']").colorbox();
		jQuery("a[class='lightbox_video']").each(setZoomIcon);
		jQuery("a[class='lightbox_image']").each(setZoomIcon);
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
////
////
///
////
////
////
////
////
////

// ADDCHRIS //

/*
 * Galleria v 1.2 prerelease 1.1 2010-11-23
 * http://galleria.aino.se
 *
 * Copyright (c) 2010, Aino
 * Licensed under the MIT license.
 */

(function($) {

// some references
var undef,
    window = this,
    doc    = document,
    $doc   = $( doc );

// internal constants
var DEBUG = false,
    NAV   = navigator.userAgent.toLowerCase(),
    HASH  = window.location.hash.replace(/#\//, ''),
    CLICK = function() {
        // use this to make touch devices snappier
        return Galleria.TOUCH ? 'touchstart' : 'click';
    },
    IE    = (function() {
        var v = 3,
            div = doc.createElement( 'div' );
        while (
            div.innerHTML = '<!--[if gt IE '+(++v)+']><i></i><![endif]-->',
            div.getElementsByTagName('i')[0]
        );
        return v > 4 ? v : undef;
    }() ),
    DOM   = function() {
        return {
            html:  doc.documentElement,
            body:  doc.body,
            head:  doc.getElementsByTagName('head')[0],
            title: doc.title
        };
    },

    // the internal timeouts object
    // provides helper methods for controlling timeouts
    _timeouts = {

        trunk: {},

        add: function( id, fn, delay, loop ) {
            loop = loop || false;
            this.clear( id );
            if ( loop ) {
                var old = fn;
                fn = function() {
                    old();
                    _timeouts.add( id, fn, delay );
                };
            }
            this.trunk[ id ] = window.setTimeout( fn, delay );
        },

        clear: function( id ) {

            var del = function( i ) {
                window.clearTimeout( this.trunk[ i ] );
                delete this.trunk[ i ];
            };

            if ( !!id && id in this.trunk ) {
                del.call( _timeouts, id );

            } else if ( typeof id == 'undefined' ) {
                for ( var i in this.trunk ) {
                    del.call( _timeouts, i );
                }
            }
        }
    },

    // the internal gallery holder
    _galleries = [],

    // the transitions holder
    _transitions = {

        fade: function(params, complete) {
            $(params.next).css('opacity', 0).show().animate({
                opacity: 1
            }, params.speed, complete);

            if (params.prev) {
                $(params.prev).css('opacity', 1).show().animate({
                    opacity: 0
                }, params.speed);
            }
        },

        flash: function(params, complete) {
            $(params.next).css('opacity', 0);
            if (params.prev) {
                $(params.prev).animate({
                    opacity: 0
                }, (params.speed / 2), function() {
                    $(params.next).animate({
                        opacity: 1
                    }, params.speed, complete);
                });
            } else {
                $(params.next).animate({
                    opacity: 1
                }, params.speed, complete);
            }
        },

        pulse: function(params, complete) {
            if (params.prev) {
                $(params.prev).hide();
            }
            $(params.next).css('opacity', 0).animate({
                opacity:1
            }, params.speed, complete);
        },

        slide: function(params, complete) {
            var image  = $(params.next).parent(),
                images = this.$('images'), // ??
                width  = this._stageWidth,
                easing = this.getOptions( 'easing' );

            image.css({
                left: width * ( params.rewind ? -1 : 1 )
            });
            images.animate({
                left: width * ( params.rewind ? 1 : -1 )
            }, {
                duration: params.speed,
                queue: false,
                easing: easing,
                complete: function() {
                    images.css('left', 0);
                    image.css('left', 0);
                    complete();
                }
            });
        },

        fadeslide: function(params, complete) {

            var x = 0,
                easing = this.getOptions('easing'),
                distance = this.getStageWidth();

            if (params.prev) {
                x = Utils.parseValue( $(params.prev).css('left') );
                $(params.prev).css({
                    opacity: 1,
                    left: x
                }).animate({
                    opacity: 0,
                    left: x + ( distance * ( params.rewind ? 1 : -1 ) )
                },{
                    duration: params.speed,
                    queue: false,
                    easing: easing
                });
            }

            x = Utils.parseValue( $(params.next).css('left') );

            $(params.next).css({
                left: x + ( distance * ( params.rewind ? -1 : 1 ) ),
                opacity: 0
            }).animate({
                opacity: 1,
                left: x
            }, {
                duration: params.speed,
                complete: complete,
                queue: false,
                easing: easing
            });
        }
    },

    // the Utils singleton
    Utils = (function() {

        return {

            array : function( obj ) {
                return Array.prototype.slice.call(obj);
            },

            create : function( className, nodeName ) {
                nodeName = nodeName || 'div';
                var elem = doc.createElement( nodeName );
                elem.className = className;
                return elem;
            },

            forceStyles : function( elem, styles ) {
                elem = $(elem);
                if ( elem.attr( 'style' ) ) {
                    elem.data( 'styles', elem.attr( 'style' ) ).removeAttr( 'style' );
                }
                elem.css( styles );
            },

            revertStyles : function() {
                $.each( Utils.array( arguments ), function( i, elem ) {

                    elem = $( elem ).removeAttr( 'style' );

                    if ( elem.data( 'styles' ) ) {
                        elem.attr( 'style', elem.data('styles') ).data( 'styles', null );
                    }
                });
            },

            moveOut : function( elem ) {
                Utils.forceStyles( elem, {
                    position: 'absolute',
                    left: -10000
                });
            },

            moveIn : function() {
                Utils.revertStyles.apply( Utils, Utils.array( arguments ) );
            },

            hide : function( elem, speed, callback ) {
                elem = $(elem);

                // save the value if not exist
                if (! elem.data('opacity') ) {
                    elem.data('opacity', elem.css('opacity') );
                }

                // always hide
                var style = { opacity: 0 };

                if (speed) {
                    elem.stop().animate( style, speed, callback );
                } else {
                    elem.css( style );
                };
            },

            show : function( elem, speed, callback ) {
                elem = $(elem);

                // bring back saved opacity
                var saved = parseFloat( elem.data('opacity') ) || 1,
                    style = { opacity: saved };

                // reset save if opacity == 1
                if (saved == 1) {
                    elem.data('opacity', null);
                }

                // animate or toggle
                if (speed) {
                    elem.stop().animate( style, speed, callback );
                } else {
                    elem.css( style );
                };
            },

            addTimer : function() {
                _timeouts.add.apply( _timeouts, Utils.array( arguments ) );
                return this;
            },

            clearTimer : function() {
                _timeouts.clear.apply( _timeouts, Utils.array( arguments ) );
                return this;
            },

            wait : function(options) {
                options = $.extend({
                    until : function() { return false; },
                    success : function() {},
                    error : function() { Galleria.raise('Could not complete wait function.'); },
                    timeout: 3000
                }, options);

                var start = Utils.timestamp(),
                    elapsed,
                    now;

                window.setTimeout(function() {
                    now = Utils.timestamp();
                    elapsed = now - start;
                    if ( options.until( elapsed ) ) {
                        options.success();
                        return false;
                    }

                    if (now >= start + options.timeout) {
                        options.error();
                        return false;
                    }
                    window.setTimeout(arguments.callee, 2);
                }, 2);
            },

            toggleQuality : function( img, force ) {

                if ( !( IE == 7 || IE == 8 ) || !!img === false ) {
                    return;
                }

                if ( typeof force === 'undefined' ) {
                    force = img.style.msInterpolationMode == 'nearest-neighbor';
                }

                img.style.msInterpolationMode = force ? 'bicubic' : 'nearest-neighbor';
            },

            insertStyleTag : function( styles ) {
                var style = doc.createElement( 'style' );
                DOM().head.appendChild( style );

                if ( style.styleSheet ) { // IE
                    style.styleSheet.cssText = styles;
                } else {
                    var cssText = doc.createTextNode( styles );
                    style.appendChild( cssText );
                }
            },

            // a loadscript method that works for local scripts
            loadScript: function( url, callback ) {
                var done = false,
                    script = $('<scr'+'ipt>').attr({
                        src: url,
                        async: true
                    }).get(0);

               // Attach handlers for all browsers
               script.onload = script.onreadystatechange = function() {
                   if ( !done && (!this.readyState ||
                       this.readyState == 'loaded' || this.readyState == 'complete') ) {
                       done = true;

                       if (typeof callback == 'function') {
                           callback.call( this, this );
                       }

                       // Handle memory leak in IE
                       script.onload = script.onreadystatechange = null;
                   }
               };

               var s = doc.getElementsByTagName( 'script' )[0];
               s.parentNode.insertBefore( script, s );
            },

            // parse anything into a number
            parseValue: function( val ) {
                if (typeof val == 'number') {
                    return val;
                } else if (typeof val == 'string') {
                    var arr = val.match(/\-?\d/g);
                    return arr && arr.constructor == Array ? arr.join('') * 1 : 0;
                } else {
                    return 0;
                }
            },

            // timestamp abstraction
            timestamp: function() {
                return new Date().getTime();
            },

            // this is pretty crap, but works for now
            // it will add a callback, but it can't guarantee that the styles can be fetched
            // using getComputedStyle further checking needed, possibly a dummy element
            loadCSS : function( href, id, callback ) {

                var link,
                    ready = false,
                    length;

                // look for manual css
                $('link[rel=stylesheet]').each(function() {
                    if ( new RegExp( href ).test( this.href ) ) {
                        link = this;
                        return false;
                    }
                });

                if ( typeof id == 'function' ) {
                    callback = id;
                    id = undef;
                }

                callback = callback || function() {}; // dirty

                // if already present, return
                if ( link ) {
                    callback.call( link, link );
                    return link;
                }

                // save the length of stylesheets to check against
                length = doc.styleSheets.length;

                // add timestamp if DEBUG is true
                if ( DEBUG ) {
                    href += '?' + Utils.timestamp();
                }

                // check for existing id
                if( $('#'+id).length ) {
                    $('#'+id).attr('href', href);
                    length--;
                    ready = true;
                } else {
                    link = $( '<link>' ).attr({
                        rel: 'stylesheet',
                        href: href,
                        id: id
                    }).get(0);

                    window.setTimeout(function() {
                        var styles = $('link[rel="stylesheet"], style');
                        if ( styles.length ) {
                            styles.get(0).parentNode.insertBefore( link, styles[0] );
                        } else {
                            DOM().head.appendChild( link );
                        }

                        if ( IE ) {
                            link.attachEvent( 'onreadystatechange', function(e) {
                                if( link.readyState == 'complete' ) {
                                    ready = true;
                                }
                            });
                        } else {
                            // what to do here? returning for now.
                            ready = true;
                        }
                    }, 10);
                }

                if (typeof callback == 'function') {

                    Utils.wait({
                        until: function() {
                            return ready && doc.styleSheets.length > length;
                        },
                        success: function() {
                            Utils.addTimer( 'css', function() {
                                callback.call( link, link );
                            }, 100);
                        },
                        error: function() {
                            Galleria.raise( 'Theme CSS could not load' );
                        },
                        timeout: 1000
                    });
                }
                return link;
            }
        };
    })();

/**
    The main Galleria class

    @class

    @example var gallery = new Galleria();

    @author http://aino.se

    @requires jQuery

    @returns {Galleria}
*/

Galleria = function() {

    var self = this;

    // the theme used
    this._theme = undef;

    // internal options
    this._options = {};

    // flag for controlling play/pause
    this._playing = false;

    // internal interval for slideshow
    this._playtime = 5000;

    // internal variable for the currently active image
    this._active = null;

    // the internal queue, arrayified
    this._queue = { length: 0 };

    // the internal data array
    this._data = [];

    // the internal dom collection
    this._dom = {};

    // the internal thumbnails array
    this._thumbnails = [];

    // internal init flag
    this._initialized = false;

    // global stagewidth/height
    this._stageWidth = 0;
    this._stageHeight = 0;

    // target holder
    this._target = undef;

    // instance id
    this._id = Utils.timestamp();

    // add some elements
    var divs =  'container stage images image-nav image-nav-left image-nav-right ' +
                'info info-text info-title info-description info-author ' +
                'thumbnails thumbnails-list thumbnails-container thumb-nav-left thumb-nav-right ' +
                'loader counter tooltip',
        spans = 'current total';

    $.each( divs.split(' '), function( i, elemId ) {
        self._dom[ elemId ] = Utils.create( 'galleria-' + elemId );
    });

    $.each( spans.split(' '), function( i, elemId ) {
        self._dom[ elemId ] = Utils.create( 'galleria-' + elemId, 'span' );
    });

    // the internal keyboard object
    // keeps reference of the keybinds and provides helper methods for binding keys
    var keyboard = this._keyboard = {

        keys : {
            'UP': 38,
            'DOWN': 40,
            'LEFT': 37,
            'RIGHT': 39,
            'RETURN': 13,
            'ESCAPE': 27,
            'BACKSPACE': 8,
            'SPACE': 32
        },

        map : {},

        bound: false,

        press: function(e) {
            var key = e.keyCode || e.which;
            if ( key in keyboard.map && typeof keyboard.map[key] == 'function' ) {
                keyboard.map[key].call(self, e);
            }
        },

        attach: function(map) {
            for( var key in map ) {
                var up = key.toUpperCase();
                if ( up in keyboard.keys ) {
                    keyboard.map[ keyboard.keys[up] ] = map[key];
                }
            }
            if ( !keyboard.bound ) {
                keyboard.bound = true;
                $doc.bind('keydown', keyboard.press);
            }
        },

        detach: function() {
            keyboard.bound = false;
            $doc.unbind('keydown', keyboard.press);
        }
    };

    // internal controls for keeping track of active / inactive images
    var controls = this._controls = {

        0: undef,

        1: undef,

        active : 0,

        swap : function() {
            controls.active = controls.active ? 0 : 1;
        },

        getActive : function() {
            return controls[ controls.active ];
        },

        getNext : function() {
            return controls[ 1 - controls.active ];
        }
    };

    // internal carousel object
    var carousel = this._carousel = {

        // shortcuts
        next: self.$('thumb-nav-right'),
        prev: self.$('thumb-nav-left'),

        // cache the width
        width: 0,

        // track the current position
        current: 0,

        // cache max value
        max: 0,

        // save all hooks for each width in an array
        hooks: [],

        // update the carousel
        // you can run this method anytime, f.ex on window.resize
        update: function() {
            var w = 0,
                h = 0,
                hooks = [0];

            $.each( self._thumbnails, function( i, thumb ) {
                if ( thumb.ready ) {
                    w += thumb.outerWidth || $( thumb.container ).outerWidth( true );
                    hooks[ i+1 ] = w;
                    h = Math.max( h, thumb.outerHeight || $( thumb.container).outerHeight( true ) );
                }
            });

            self.$( 'thumbnails' ).css({
                width: w,
                height: h
            });

            carousel.max = w;
            carousel.hooks = hooks;
            carousel.width = self.$( 'thumbnails-list' ).width();
            carousel.setClasses();

            self.$( 'thumbnails-container' ).toggleClass( 'galleria-carousel', w > carousel.width );

            // todo: fix so the carousel moves to the left
        },

        bindControls: function() {

            carousel.next.bind( CLICK(), function(e) {
                e.preventDefault();

                if ( self._options.carousel_steps == 'auto' ) {

                    for ( var i = carousel.current; i < carousel.hooks.length; i++ ) {
                        if ( carousel.hooks[i] - carousel.hooks[ carousel.current ] > carousel.width ) {
                            carousel.set(i - 2);
                            break;
                        }
                    }

                } else {
                    carousel.set( carousel.current + self._options.carousel_steps);
                }
            });

            carousel.prev.bind( CLICK(), function(e) {
                e.preventDefault();

                if ( self._options.carousel_steps == 'auto' ) {

                    for ( var i = carousel.current; i >= 0; i-- ) {
                        if ( carousel.hooks[ carousel.current ] - carousel.hooks[i] > carousel.width ) {
                            carousel.set( i + 2 );
                            break;
                        } else if ( i == 0 ) {
                            carousel.set( 0 );
                            break;
                        }
                    }
                } else {
                    carousel.set( carousel.current - self._options.carousel_steps );
                }
            });
        },

        // calculate and set positions
        set: function( i ) {
            i = Math.max( i, 0 );
            while ( carousel.hooks[i - 1] + carousel.width > carousel.max && i >= 0 ) {
                i--;
            }
            carousel.current = i;
            carousel.animate();
        },

        // get the last position
        getLast: function(i) {
            return ( i || carousel.current ) - 1;
        },

        // follow the active image
        follow: function(i) {

            //don't follow if position fits
            if ( i == 0 || i == carousel.hooks.length - 2 ) {
                carousel.set( i );
                return;
            }

            // calculate last position
            var last = carousel.current;
            while( carousel.hooks[last] - carousel.hooks[ carousel.current ] <
                   carousel.width && last <= carousel.hooks.length ) {
                last ++;
            }

            // set position
            if ( i - 1 < carousel.current ) {
                carousel.set( i - 1 );
            } else if ( i + 2 > last) {
                carousel.set( i - last + carousel.current + 2 );
            }
        },

        // helper for setting disabled classes
        setClasses: function() {
            carousel.prev.toggleClass( 'disabled', !carousel.current );
            carousel.next.toggleClass( 'disabled', carousel.hooks[ carousel.current ] + carousel.width > carousel.max );
        },

        // the animation method
        animate: function(to) {
            carousel.setClasses();
            var num = carousel.hooks[ carousel.current ] * -1;

            if ( isNaN( num ) ) {
                return;
            }

            self.$( 'thumbnails' ).animate({
                left: num
            },{
                duration: self._options.carousel_speed,
                easing: self._options.easing,
                queue: false
            });
        }
    };

    // tooltip control
    // added in 1.2
    var tooltip = this._tooltip = {

        initialized : false,

        open: false,

        init: function() {

            tooltip.initialized = true;

            var css = '.galleria-tooltip{padding:3px 8px;max-width:50%;background:#ffe;color:#000;z-index:3;position:absolute;font-size:11px;line-height:1.3' +
                      'opacity:0;box-shadow:0 0 2px rgba(0,0,0,.4);-moz-box-shadow:0 0 2px rgba(0,0,0,.4);-webkit-box-shadow:0 0 2px rgba(0,0,0,.4);}';

            Utils.insertStyleTag(css);

            self.$( 'tooltip' ).css('opacity', .8);
            Utils.hide( self.get('tooltip') );

        },

        // move handler
        move: function( e ) {
            var mouseX = self.getMousePosition(e).x,
                mouseY = self.getMousePosition(e).y,
                $elem = self.$( 'tooltip' ),
                x = mouseX,
                y = mouseY,
                height = $elem.outerHeight( true ) + 1,
                width = $elem.outerWidth( true ),
                limitY = height + 15;

            var maxX = self.$( 'container').width() - width - 2,
                maxY = self.$( 'container').height() - height - 2;

            if ( !isNaN(x) && !isNaN(y) ) {

                x += 10;
                y -= 30;

                x = Math.max( 0, Math.min( maxX, x ) );
                y = Math.max( 0, Math.min( maxY, y ) );

                if( mouseY < limitY ) {
                    y = limitY;
                }

                $elem.css({ left: x, top: y });
            }
        },

        // bind elements to the tooltip
        // you can bind multiple elementIDs using { elemID : function } or { elemID : string }
        // you can also bind single DOM elements using bind(elem, string)
        bind: function( elem, value ) {

            if (! tooltip.initialized ) {
                tooltip.init();
            }

            var hover = function( elem, value) {

                tooltip.define( elem, value );

                $( elem ).hover(function() {

                    Utils.clearTimer('switch_tooltip');
                    self.$('container').unbind( 'mousemove', tooltip.move ).bind( 'mousemove', tooltip.move ).trigger( 'mousemove' );
                    tooltip.show( elem );

                    Galleria.utils.addTimer( 'tooltip', function() {
                        self.$( 'tooltip' ).stop();
                        Utils.show( self.get( 'tooltip' ), 400 );
                        tooltip.open = true;

                    }, tooltip.open ? 0 : 1000);

                }, function() {

                    self.$( 'container' ).unbind( 'mousemove', tooltip.move );
                    Utils.clearTimer( 'tooltip' );
                    
                    self.$( 'tooltip' ).stop();
                    
                    Utils.hide( self.get( 'tooltip' ), 200, function() {
                        Utils.addTimer('switch_tooltip', function() {
                            tooltip.open = false;
                        }, 1000);
                    });
                });
            };

            if (typeof value == 'string') {
                hover( ( elem in self._dom ? self.get(elem) : elem ), value );
            } else {
                // asume elemID here
                $.each( elem, function( elemID, val ) {
                    hover( self.get(elemID), val );
                });
            }
        },

        show: function( elem ) {
            
            elem = $( elem in self._dom ? self.get(elem) : elem );
            
            var text = elem.data( 'tt' );
            
            if ( ! text ) {
                return;
            }
            
            text = typeof text == 'function' ? text() : text;
            
            self.$( 'tooltip' ).html( text.replace(/\s/, '&nbsp;') );
            
            // trigger mousemove on mouseup in case of click
            elem.bind( 'mouseup', function( e ) {
                
                // attach a tiny settimeout to make sure the new tooltip is filled
                window.setTimeout( (function( ev ) {
                    return function() {
                        tooltip.move( ev );
                    }
                })( e ), 10);
                
                elem.unbind( 'mouseup', arguments.callee );
            });
        },

        define: function( elem, value ) {

            // we store functions, not strings
            if (typeof value !== 'function') {
                var s = value;
                value = function() {
                    return s;
                };
            }

            elem = $( elem in self._dom ? self.get(elem) : elem ).data('tt', value);

            tooltip.show( elem );

        }
    };

    // internal fullscreen control
    // added in 1.195
    // still kind of experimental
    var fullscreen = this._fullscreen = {
        scrolled: 0,
        enter: function(callback) {

            // hide the image until rescale is complete
            Utils.hide( self.getActiveImage() );

            self.$( 'container' ).addClass( 'fullscreen' );

            fullscreen.scrolled = $(window).scrollTop();

            // begin styleforce
            Utils.forceStyles(self.get('container'), {
                position: 'fixed',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                zIndex: 10000
            });

            var htmlbody = {
                height: '100%',
                overflow: 'hidden',
                margin:0,
                padding:0
            };

            Utils.forceStyles( DOM().html, htmlbody );
            Utils.forceStyles( DOM().body, htmlbody );

            // attach some keys
            self.attachKeyboard({
                escape: self.exitFullscreen,
                right: self.next,
                left: self.prev
            });

            // init the first rescale and attach callbacks
            self.rescale(function() {

                Utils.addTimer('fullscreen_enter', function() {
                    // show the image after 50 ms
                    Utils.show( self.getActiveImage() );

                    if (typeof callback == 'function') {
                        callback.call( self );
                    }

                }, 100);

                self.trigger( Galleria.FULLSCREEN_ENTER );
            });

            // bind the scaling to the resize event
            $(window).resize( function() {
                fullscreen.scale();
            } );
        },

        scale : function() {
            self.rescale();
        },

        exit: function(callback) {

            Utils.hide( self.getActiveImage() );

            self.$('container').removeClass( 'fullscreen' );

            // revert all styles
            Utils.revertStyles( self.get('container'), DOM().html, DOM().body );

            // scroll back
            window.scrollTo(0, fullscreen.scrolled);

            // detach all keyboard events (is this good?)
            self.detachKeyboard();

            self.rescale(function() {
                Utils.addTimer('fullscreen_exit', function() {

                    // show the image after 50 ms
                    Utils.show( self.getActiveImage() );

                    if ( typeof callback == 'function' ) {
                        callback.call( self );
                    }

                }, 50);

                self.trigger( Galleria.FULLSCREEN_EXIT );
            });

            $(window).unbind('resize', fullscreen.scale);
        }
    };

    // the internal idle object for controlling idle states
    // TODO occational event conflicts
    var idle = this._idle = {

        trunk: [],

        bound: false,

        add: function(elem, to) {
            if (!elem) {
                return;
            }
            if (!idle.bound) {
                idle.addEvent();
            }
            elem = $(elem);

            var from = {};

            for (var style in to) {
                from[style] = elem.css(style);
            }
            elem.data('idle', {
                from: from,
                to: to,
                complete: true,
                busy: false
            });
            idle.addTimer();
            idle.trunk.push(elem);
        },

        remove: function(elem) {

            elem = jQuery(elem);

            $.each(idle.trunk, function(i, el) {
                if ( el.length && !el.not(elem).length ) {
                    self._idle.show(elem);
                    self._idle.trunk.splice(i, 1);
                }
            });

            if (!idle.trunk.length) {
                idle.removeEvent();
                Utils.clearTimer('idle');
            }
        },

        addEvent : function() {
            idle.bound = true;
            self.$('container').bind('mousemove click', idle.showAll );
        },

        removeEvent : function() {
            idle.bound = false;
            self.$('container').unbind('mousemove click', idle.showAll );
        },

        addTimer : function() {
            Utils.addTimer('idle', function() {
                self._idle.hide();
            }, self._options.idle_time );
        },

        hide : function() {

            self.trigger( Galleria.IDLE_ENTER );

            $.each( idle.trunk, function(i, elem) {

                var data = elem.data('idle');

                if (! data) {
                    return;
                }

                elem.data('idle').complete = false;
                
                elem.stop().animate(data.to, {
                    duration: 600,
                    queue: false,
                    easing: 'swing'
                });
            });
        },

        showAll : function() {

            Utils.clearTimer('idle');

            $.each(self._idle.trunk, function( i, elem ) {
                self._idle.show( elem );
            });
        },

        show: function(elem) {

            var data = elem.data('idle');

            if (!data.busy && !data.complete) {

                data.busy = true;

                self.trigger( Galleria.IDLE_EXIT );
                
                Utils.clearTimer( 'idle' );

                elem.stop().animate(data.from, {
                    duration: 300,
                    queue: false,
                    easing: 'swing',
                    complete: function() {
                        $(this).data('idle').busy = false;
                        $(this).data('idle').complete = true;
                    }
                });
            }
            idle.addTimer();
        }
    };

    // internal lightbox object
    // creates a predesigned lightbox for simple popups of images in galleria
    var lightbox = this._lightbox = {

        width : 0,

        height : 0,

        initialized : false,

        active : null,

        image : null,

        elems : {},

        init : function() {

            // trigger the event
            self.trigger( Galleria.LIGHTBOX_OPEN );

            if ( lightbox.initialized ) {
                return;
            }
            lightbox.initialized = true;

            // create some elements to work with
            var elems = 'overlay box content shadow title info close prevholder prev nextholder next counter image',
                el = {},
                op = self._options,
                css = '',
                cssMap = {
                    overlay:    'position:fixed;display:none;opacity:'+op.overlay_opacity+';top:0;left:0;width:100%;height:100%;background:'+op.overlay_background+';z-index:99990',
                    box:        'position:fixed;display:none;width:400px;height:400px;top:50%;left:50%;margin-top:-200px;margin-left:-200px;z-index:99991',
                    shadow:     'position:absolute;background:#000;width:100%;height:100%;',
                    content:    'position:absolute;background-color:#fff;top:10px;left:10px;right:10px;bottom:10px;overflow:hidden',
                    info:       'position:absolute;bottom:10px;left:10px;right:10px;color:#444;font:11px/13px arial,sans-serif;height:13px',
                    close:      'position:absolute;top:10px;right:10px;height:20px;width:20px;background:#fff;text-align:center;cursor:pointer;color:#444;font:16px/22px arial,sans-serif;z-index:99999',
                    image:      'position:absolute;top:10px;left:10px;right:10px;bottom:30px;overflow:hidden',
                    prevholder: 'position:absolute;width:50%;height:100%;cursor:pointer',
                    nextholder: 'position:absolute;width:50%;height:100%;right:0;cursor:pointer',
                    prev:       'position:absolute;top:50%;margin-top:-20px;height:40px;width:30px;background:#fff;left:20px;display:none;line-height:40px;text-align:center;color:#000',
                    next:       'position:absolute;top:50%;margin-top:-20px;height:40px;width:30px;background:#fff;right:20px;left:auto;display:none;line-height:40px;text-align:center;color:#000',
                    title:      'float:left',
                    counter:    'float:right;margin-left:8px'
                },
                hover = function(elem) {
                    return elem.hover(
                        function() { $(this).css( 'color', '#bbb' ); },
                        function() { $(this).css( 'color', '#444' ); }
                    );
                };

            // create and insert CSS
            $.each(cssMap, function( key, value ) {
                css += '.galleria-lightbox-'+key+'{'+value+'}';
            });

            Utils.insertStyleTag( css );

            // create the elements
            $.each(elems.split(' '), function( i, elemId ) {
                self.addElement( 'lightbox-' + elemId );
                el[ elemId ] = lightbox.elems[ elemId ] = self.get( 'lightbox-' + elemId );
            });

            // initiate the image
            lightbox.image = new Galleria.Picture();

            // append the elements
            self.append({
                'lightbox-box': ['lightbox-shadow','lightbox-content', 'lightbox-close','lightbox-prevholder','lightbox-nextholder'],
                'lightbox-info': ['lightbox-title','lightbox-counter'],
                'lightbox-content': ['lightbox-info', 'lightbox-image'],
                'lightbox-prevholder': 'lightbox-prev',
                'lightbox-nextholder': 'lightbox-next'
            });

            $( el.image ).append( lightbox.image.container );

            $( DOM().body ).append( el.overlay, el.box );

            // add the prev/next nav and bind some controls

            hover( $( el.close ).bind( CLICK(), lightbox.hide ).html('&#215;') );

            $.each( ['Prev','Next'], function(i, dir) {

                var $d = $( el[ dir.toLowerCase() ] ).html( /v/.test( dir ) ? '‹&nbsp;' : '&nbsp;›' );

                $( el[ dir.toLowerCase()+'holder'] ).hover(function() {
                    $d.show();
                }, function() {
                    $d.fadeOut( 200 );
                }).bind( CLICK(), function() {
                    lightbox[ 'show' + dir ]();
                });

            });
            $( el.overlay ).bind( CLICK(), lightbox.hide );

        },

        rescale: function(event) {

            // calculate
             var width = Math.min( $(window).width()-40, lightbox.width ),
                height = Math.min( $(window).height()-60, lightbox.height ),
                ratio = Math.min( width / lightbox.width, height / lightbox.height ),
                destWidth = ( lightbox.width * ratio ) + 40,
                destHeight = ( lightbox.height * ratio ) + 60,
                to = {
                    width: destWidth,
                    height: destHeight,
                    marginTop: Math.ceil( destHeight / 2 ) *- 1,
                    marginLeft: Math.ceil( destWidth / 2 ) *- 1
                };

            // if rescale event, don't animate
            if ( event ) {
                $( lightbox.elems.box ).css( to );
            } else {
                $( lightbox.elems.box ).animate(
                    to,
                    self._options.lightbox_transition_speed,
                    self._options.easing,
                    function() {
                        var image = lightbox.image,
                            speed = self._options.lightbox_fade_speed;

                        self.trigger({
                            type: Galleria.LIGHTBOX_IMAGE,
                            imageTarget: image.image
                        });

                        image.show();
                        Utils.show( image.image, speed );
                        Utils.show( lightbox.elems.info, speed );
                    }
                );
            }
        },

        hide: function() {

            // remove the image
            lightbox.image.image = null;

            $(window).unbind('resize', lightbox.rescale);

            $( lightbox.elems.box ).hide();

            Utils.hide( lightbox.elems.info );

            Utils.hide( lightbox.elems.overlay, 200, function() {
                $( this ).hide().css( 'opacity', self._options.overlay_opacity );
                self.trigger( Galleria.LIGHTBOX_CLOSE );
            });
        },

        showNext: function() {
            lightbox.show( self.getNext( lightbox.active ) );
        },

        showPrev: function() {
            lightbox.show( self.getPrev( lightbox.active ) );
        },

        show: function(index) {

            lightbox.active = index = typeof index == 'number' ? index : self.getIndex();

            if ( !lightbox.initialized ) {
                lightbox.init();
            }

            $(window).unbind('resize', lightbox.rescale );

            var data = self.getData(index),
                total = self.getDataLength();

            Utils.hide( lightbox.elems.info );

            lightbox.image.load( data.image, function( image ) {

                lightbox.width = image.original.width;
                lightbox.height = image.original.height;

                $( image.image ).css({
                    width: '100.5%',
                    height: '100.5%',
                    top: 0,
                    zIndex: 99998,
                    opacity: 0
                });

                lightbox.elems.title.innerHTML = data.title;
                lightbox.elems.counter.innerHTML = (index + 1) + ' / ' + total;
                $(window).resize( lightbox.rescale );
                lightbox.rescale();
            });

            $( lightbox.elems.overlay ).show();
            $( lightbox.elems.box ).show();
        }
    };

    return this;
};

// end Galleria constructor

Galleria.prototype = {
    
    // bring back the constructor reference
    
    constructor: Galleria,

    /**
        Use this function to initialize the gallery and start loading.
        Should only be called once per instance.

        @param {HTML Element} target The target element
        @param {Object} options The gallery options

        @returns {Galleria}
    */

    init: function( target, options ) {

        var self = this;

        // save the instance
        _galleries.push( this );

        // save the original ingredients
        this._original = {
            target: target,
            options: options,
            data: null
        };

        // save the target here
        this._target = this._dom.target = target.nodeName ? target : $( target ).get(0);

        // raise error if no target is detected
        if ( !this._target ) {
             Galleria.raise('Target not found.');
             return;
        }

        // apply options
        this._options = {
            autoplay: false,
            carousel: true,
            carousel_follow: true,
            carousel_speed: 400,
            carousel_steps: 'auto',
            clicknext: false,
            data_config : function( elem ) { return {}; },
            data_selector: 'img',
            data_source: this._target,
            debug: undef,
            easing: 'galleria',
            extend: function(options) {},
            height: 'auto',
            idle_time: 3000,
            image_crop: false,
            image_margin: 0,
            image_pan: false,
            image_pan_smoothness: 12,
            image_position: '50%',
            keep_source: false,
            lightbox_fade_speed: 200,
            lightbox_transition_speed: 500,
            link_source_images: true,
            max_scale_ratio: undef,
            min_scale_ratio: undef,
            on_image: function(img,thumb) {},
            overlay_opacity: .85,
            overlay_background: '#0b0b0b',
            pause_on_interaction: true, // 1.9.96
            popup_links: false,
            preload: 2,
            queue: true,
            show: 0,
            show_info: true,
            show_counter: true,
            show_imagenav: true,
            thumb_crop: true,
            thumb_event_type: CLICK(),
            thumb_fit: true,
            thumb_margin: 0,
            thumb_quality: 'auto',
            thumbnails: true,
            transition: 'fade',
            transition_initial: undef,
            transition_speed: 400,
            width: 'auto'
        };

        // apply debug
        if ( options && options.debug === true ) {
            DEBUG = true;
        }

        // hide all content
        $( this._target ).children().hide();

        // now we just have to wait for the theme...
        if ( Galleria.theme ) {
            this._init();
        } else {
            Utils.addTimer('themeload', function() {
                Galleria.raise( 'No theme found.', true);
            }, 2000);

            $doc.one( Galleria.THEMELOAD, function() {
                Utils.clearTimer( 'themeload' );
                self._init.call( self );
            });
        }
    },

    // the internal _init is called when the THEMELOAD event is triggered
    // this method should only be called once per instance
    // for manipulation of data, use the .load method

    _init: function() {
        var self = this;

        if ( this._initialized ) {
            Galleria.raise( 'Init failed: Gallery instance already initialized.' );
            return this;
        }

        this._initialized = true;

        if ( !Galleria.theme ) {
            Galleria.raise( 'Init failed: No theme found.' );
            return this;
        }

        // merge the theme & caller options
        $.extend( true, this._options, Galleria.theme.defaults, this._original.options );

        // bind the gallery to run when data is ready
        this.bind( Galleria.DATA, function() {

            // save the new data
            this._original.data = this._data;

            // lets show the counter here
            this.get('total').innerHTML = this.getDataLength();

            // cache the container
            var $container = this.$( 'container' );

            // the gallery is ready, let's just wait for the css
            var num = { width: 0, height: 0 };
            var testElem =  Utils.create('galleria-image');

            // check container and thumbnail height
            Utils.wait({
                until: function() {

                    // keep trying to get the value
                    $.each(['width', 'height'], function( i, m ) {
                        
                        // first check if options is set
                        
                        if (self._options[ m ] && typeof self._options[ m ] == 'number') {
                            num[ m ] = self._options[ m ];
                        } else {
                            
                            // else extract the meassures in the following order:
                            
                            num[m] = Utils.parseValue( $container.css( m ) ) ||         // 1. the container css
                                     Utils.parseValue( self.$( 'target' ).css( m ) ) || // 2. the target css
                                     $container[ m ]() ||                               // 3. the container jQuery method
                                     self.$( 'target' )[ m ]();                         // 4. the container jQuery method
                        }

                    });

                    var thumbHeight = function() {
                        return true;
                    };

                    // make sure thumbnails have a height as well
                    if ( self._options.thumbnails ) {
                        self.$('thumbnails').append( testElem );
                        thumbHeight = function() {
                            return !!$( testElem ).height();
                        };
                    }

                    return thumbHeight() && num.width && num.height > 50;

                },
                success: function() {

                    // remove the testElem
                    $( testElem ).remove();

                    // apply the new meassures
                    $container.width( num.width );
                    $container.height( num.height );

                    // for some strange reason, webkit needs a single setTimeout to play ball
                    if ( Galleria.WEBKIT ) {
                        window.setTimeout( function() {
                            self._run();
                        }, 1);
                    } else {
                        self._run();
                    }
                },
                error: function() {
                    // Height was probably not set, raise a hard error
                    Galleria.raise('Width & Height not found.', true);
                },
                timeout: 2000
            });
        });

        // postrun some stuff after the gallery is ready
        // make sure it only runs once
        var one = false;

        this.bind( Galleria.READY, function() {

            // show counter
            Utils.show( this.get('counter') );

            // bind clicknext
            if ( this._options.clicknext ) {
                $.each( this._data, function( i, data ) {
                    delete data.link;
                });
                this.$( 'stage' ).css({ cursor : 'pointer' }).bind( CLICK(), function(e) {
                    self.next();
                });
            }

            // bind carousel nav
            if ( this._options.carousel ) {
                this._carousel.bindControls();
            }

            // start autoplay
            if ( this._options.autoplay ) {

                this.pause();

                if ( typeof this._options.autoplay == 'number' ) {
                    this._playtime = this._options.autoplay;
                }

                this.trigger( Galleria.PLAY );
                this._playing = true;
            }

            // if second load, just do the show and return
            if ( one ) {
                if ( typeof this._options.show == 'number' ) {
                    this.show( this._options.show );
                }
                return;
            }

            one = true;

            // initialize the History plugin
            if ( Galleria.History ) {

                // bind the show method
                Galleria.History.change(function(e) {

                    // grab history ID
                    var val = parseInt( e.value.replace( /\//, '' ) );

                    // if ID is NaN, the user pressed back from the first image
                    // return to previous address
                    if (isNaN(val)) {
                        window.history.go(-1);

                    // else show the image
                    } else {
                        self.show( val, undef, true );
                    }
                });
            }

            // call the theme init method
            Galleria.theme.init.call( this, this._options );

            // call the extend option
            this._options.extend.call( this, this._options );

            // show the initial image
            // first test for permalinks in history
            if ( /^[0-9]{1,4}$/.test( HASH ) && Galleria.History ) {
                this.show( HASH, undef, true );

            } else {
                this.show( this._options.show );
            }

        });

        // build the gallery frame
        this.append({
            'info-text' :
                ['info-title', 'info-description', 'info-author'],
            'info' :
                ['info-text'],
            'image-nav' :
                ['image-nav-right', 'image-nav-left'],
            'stage' :
                ['images', 'loader', 'counter', 'image-nav'],
            'thumbnails-list' :
                ['thumbnails'],
            'thumbnails-container' :
                ['thumb-nav-left', 'thumbnails-list', 'thumb-nav-right'],
            'container' :
                ['stage', 'thumbnails-container', 'info', 'tooltip']
        });

        Utils.hide( this.$( 'counter' ).append(
            this.get( 'current' ),
            ' / ',
            this.get( 'total' )
        ) );

        this.setCounter('&#8211;');

        // add images to the controls
        $.each( new Array(2), function(i) {

            // create a new Picture instance
            var image = new Galleria.Picture();

            // apply some styles
            $( image.container ).css({
                position: 'absolute',
                top: 0,
                left: 0
            });

            // append the image
            self.$( 'images' ).append( image.container );

            // reload the controls
            self._controls[i] = image;

        });

        // some forced generic styling
        this.$( 'images' ).css({
            position: 'relative',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%'
        });

        this.$( 'thumbnails, thumbnails-list' ).css({
            overflow: 'hidden',
            position: 'relative'
        });

        // bind image navigation arrows
        this.$( 'image-nav-right, image-nav-left' ).bind( CLICK(), function(e) {

            // tune the clicknext option
            if ( self._options.clicknext ) {
                e.stopPropagation();
            }

            // pause if options is set
            if ( self._options.pause_on_interaction ) {
                self.pause();
            }

            // navigate
            var fn = /right/.test( this.className ) ? 'next' : 'prev';
            self[ fn ]();

        });

        // hide controls if chosen to
        $.each( ['info','counter','image-nav'], function( i, el ) {
            if ( self._options[ 'show_' + el.replace(/-/, '') ] === false ) {
                Utils.moveOut( self.get( el ) );
            }
        });

        // load up target content
        this.load();

        // now it's usually safe to remove the content
        // IE will never stop loading if we remove it, so let's keep it hidden for IE (it's usually fast enough anyway)
        if ( !this._options.keep_source && !IE ) {
            this._target.innerHTML = '';
        }

        // append the gallery frame
        this.$( 'target' ).append( this.get( 'container' ) );

        // parse the carousel on each thumb load
        if ( this._options.carousel ) {
            this.bind( Galleria.THUMBNAIL, function() {
                this.updateCarousel();
            });
        }

        // bind on_image helper
        this.bind( Galleria.IMAGE, function( e ) {
            this._options.on_image.call( this, e.imageTarget, e.thumbTarget );
        });

        return this;
    },

    // the internal _run method should be called after loading data into galleria
    // creates thumbnails and makes sure the gallery has proper meassurements
    _run : function() {
        // shortcuts
        var self = this,
            o = this._options,

            // width/height for calculations
            width  = 0,
            height = 0,

            // cache the thumbnail option
            optval = typeof o.thumbnails == 'string' ? o.thumbnails.toLowerCase() : null;

        // loop through data and create thumbnails
        for( var i = 0; this._data[i]; i++ ) {

            var thumb,
                data = this._data[i],
                $container;

            if ( o.thumbnails === true ) {

                // add a new Picture instance
                thumb = new Galleria.Picture(i);

                // get source from thumb or image
                var src = data.thumb || data.image;

                // append the thumbnail
                this.$( 'thumbnails' ).append( thumb.container );

                // cache the container
                $container = $( thumb.container );

                // move some data into the instance
                // for some reason, jQuery cant handle css(property) when zooming in FF, breaking the gallery
                // so we resort to getComputedStyle for browsers who support it
                var getStyle = function( prop ) {
                    return doc.defaultView && doc.defaultView.getComputedStyle ?
                        doc.defaultView.getComputedStyle( thumb.container, null )[ prop ] :
                        $container.css( prop );
                };

                thumb.data = {
                    width  : Utils.parseValue( getStyle( 'width' ) ),
                    height : Utils.parseValue( getStyle( 'height' ) ),
                    order  : i
                };

                // grab & reset size for smoother thumbnail loads
                $container.css(( o.thumb_fit && o.thumb_crop !== true ) ?
                    { width: 0, height: 0 } :
                    { width: thumb.data.width, height: thumb.data.height });

                // load the thumbnail
                thumb.load( src, function( thumb ) {

                    // scale when ready
                    thumb.scale({
                        width:    thumb.data.width,
                        height:   thumb.data.height,
                        crop:     o.thumb_crop,
                        margin:   o.thumb_margin,
                        complete: function( thumb ) {

                            // shrink thumbnails to fit
                            var top = ['left', 'top'];
                            var arr = ['Width', 'Height'];

                            // calculate shrinked positions
                            $.each(arr, function( i, meassure ) {
                                var m = meassure.toLowerCase();
                                if ( (o.thumb_crop !== true || o.thumb_crop == m ) && o.thumb_fit ) {
                                    var css = {};
                                    css[m] = thumb[m];
                                    $( thumb.container ).css( css );
                                    css = {};
                                    css[top[i]] = 0;
                                    $( thumb.image ).css( css);
                                }

                                // cache outer meassures
                                thumb['outer' + meassure] = $( thumb.container )['outer' + meassure]( true );
                            });

                            // set high quality if downscale is moderate
                            Utils.toggleQuality( thumb.image,
                                o.thumb_quality === true ||
                                ( o.thumb_quality == 'auto' && thumb.original.width < thumb.width * 3 )
                            );

                            // trigger the THUMBNAIL event
                            self.trigger({
                                type: Galleria.THUMBNAIL,
                                thumbTarget: thumb.image,
                                index: thumb.data.order
                            });
                        }
                    });
                });

                // preload all images here
                if ( o.preload == 'all' ) {
                    thumb.add( data.image );
                }

            // create empty spans if thumbnails is set to 'empty'
            } else if ( optval == 'empty' || optval == 'numbers' ) {

                thumb = {
                    container:  Utils.create( 'galleria-image' ),
                    image: Utils.create( 'img', 'span' ),
                    ready: true
                };

                // create numbered thumbnails
                if ( optval == 'numbers' ) {
                    $( thumb.image ).text( i + 1 );
                }
                
                this.$( 'thumbnails' ).append( thumb.container );
                
                // we need to "fake" a loading delay before we append and trigger
                // 50+ should be enough
                
                window.setTimeout((function(image, index, container) {
                    return function() {
                        $( container ).append( image );
                        self.trigger({
                            type: Galleria.THUMBNAIL,
                            thumbTarget: image,
                            index: index
                        });
                    }
                })( thumb.image, i, thumb.container ), 50 + (i*20) );
                

            // create null object to silent errors
            } else {
                thumb = {
                    container: null,
                    image: null
                };
            }

            // add events for thumbnails
            // you can control the event type using thumb_event_type
            // we'll add the same event to the source if it's kept

            $( thumb.container ).add( o.keep_source && o.link_source_images ? data.original : null )
                .data('index', i).bind(o.thumb_event_type, function(e) {
                    // pause if option is set
                    if ( o.pause_on_interaction ) {
                        self.pause();
                    }

                    // extract the index from the data
                    var index = $( e.currentTarget ).data( 'index' );
                    if ( self.getIndex() !== index ) {
                        self.show( index );
                    }

                    e.preventDefault();
            });

            this._thumbnails.push( thumb );
        }

        // make sure we have a stageHeight && stageWidth

        Utils.wait({

            until: function() {
                self._stageWidth  = self.$( 'stage' ).width();
                self._stageHeight = self.$( 'stage' ).height();
                return( self._stageWidth && 
                        self._stageHeight > 50 ); // what is an acceptable height?
            },

            success: function() {
                self.trigger( Galleria.READY );
            },

            error: function() {
                Galleria.raise('stage meassures not found');
            }

        });
    },

    /**
        Loads data into the gallery.
        You can call this method on an existing gallery to reload the gallery with new data.

        @param {Array or String} source Optional JSON array of data or selector of where to find data in the document.
        Defaults to the Galleria target or data_source option.

        @param {String} selector Optional element selector of what elements to parse.
        Defaults to 'img'.

        @param {Function} config Optional function to modify the data extraction proceedure from the selector.
        See the data_config option for more information.

        @returns {Galleria}
    */

    load : function( source, selector, config ) {

        var self = this;

        // empty the data array
        this._data = [];

        // empty the thumbnails
        this._thumbnails = [];
        this.$('thumbnails').empty();

        // shorten the arguments
        if ( typeof selector == 'function' ) {
            config = selector;
            selector = null;
        }

        // use the source set by target
        source = source || this._options.data_source;

        // use selector set by option
        selector = selector || this._options.data_selector;

        // use the data_config set by option
        config = config || this._options.data_config;

        // check if the data is an array already
        if ( source.constructor == Array ) {
            if ( this.validate( source) ) {
                this._data = source;
                this.trigger( Galleria.DATA );
            } else {
                Galleria.raise( 'Load failed: JSON Array not valid.' );
            }
            return this;
        }
        // loop through images and set data
        $( source ).find( selector ).each( function( i, img ) {
            var data = {},
                img = $( img ),
                parent = img.parent(),
                href = parent.attr( 'href' );

            // check if it's a link to another image
            if ( /\.(png|gif|jpg|jpeg)$/i.test(href) ) {
                data.image = href;

            // else assign the href as a link if it exists
            } else if ( href ) {
                data.link = href;
            }

            // mix default extractions with the hrefs and config
            // and push it into the data array
            self._data.push( $.extend({

                title:       img.attr('title'),
                thumb:       img.attr('src'),
                image:       img.attr('src'),
                description: img.attr('alt'),
                link:        img.attr('longdesc'),
                original:    img.get(0) // saved as a reference

            }, data, config( img ) ) );

        });
        // trigger the DATA event and return
        if ( this.getDataLength() ) {
            this.trigger( Galleria.DATA );
        } else {
            Galleria.raise('Load failed: no data found.');
        }
        return this;

    },

    _getActive: function() {
        return this._controls.getActive();
    },

    validate : function( data ) {
        // todo: validate a custom data array
        return true;
    },

    /**
        Bind any event to Galleria

        @param {String} type The Event type to listen for
        @param {Function} fn The function to execute when the event is triggered

        @example this.bind( Galleria.IMAGE, function() { Galleria.log('image shown') });

        @returns {Galleria}
    */

    bind : function(type, fn) {
        this.$( 'container' ).bind( type, this.proxy(fn) );
        return this;
    },

    /**
        Unbind any event to Galleria

        @param {String} type The Event type to forget

        @returns {Galleria}
    */

    unbind : function(type) {
        this.$( 'container' ).unbind( type );
        return this;
    },

    /**
        Manually trigger a Galleria event

        @param {String} type The Event to trigger

        @returns {Galleria}
    */

    trigger : function( type ) {
        type = typeof type == 'object' ?
            $.extend( type, { scope: this } ) :
            { type: type, scope: this };
        this.$( 'container' ).trigger( type );
        return this;
    },

    /**
        Assign an "idle state" to any element.
        The idle state will be applied after a certain amount of idle time
        Useful to hide f.ex navigation when the gallery is inactive

        @param {HTML Element or String} elem The Dom node or selector to apply the idle state to
        @param {Object} styles the CSS styles to apply

        @example addIdleState( this.get('image-nav'), { opacity: 0 });
        @example addIdleState( '.galleria-image-nav', { top: -200 });

        @returns {Galleria}
    */

    addIdleState: function( elem, styles ) {
        this._idle.add.apply( this._idle, Utils.array( arguments ) );
        return this;
    },

    /**
        Removes any idle state previously set using addIdleState()

        @param {HTML Element or String} elem The Dom node or selector to remove the idle state from.

        @returns {Galleria}
    */

    removeIdleState: function( elem ) {
        this._idle.remove.apply( this._idle, Utils.array( arguments ) );
        return this;
    },

    /**
        Force Galleria to enter idle mode.

        @returns {Galleria}
    */

    enterIdleMode: function() {
        this._idle.hide();
        return this;
    },

    /**
        Force Galleria to exit idle mode.

        @returns {Galleria}
    */

    exitIdleMode: function() {
        this.idle._show();
        return this;
    },

    /**
        Enter FullScreen mode

        @param {Function} callback the function to be executed when the fullscreen mode is fully applied.

        @returns {Galleria}
    */

    enterFullscreen: function( callback ) {
        this._fullscreen.enter.apply( this, Utils.array( arguments ) );
        return this;
    },

    /**
        Exits FullScreen mode

        @param {Function} callback the function to be executed when the fullscreen mode is fully applied.

        @returns {Galleria}
    */

    exitFullscreen: function( callback ) {
        this._fullscreen.exit.apply( this, Utils.array( arguments ) );
        return this;
    },

    /**
        Adds a tooltip to any element.
        You can also call this method with an object as argument with elemID:value pairs to apply tooltips to (see examples)

        @param {HTML Element} elem The DOM Node to attach the event to
        @param {String or Function} value The tooltip message. Can also be a function that returns a string.

        @example this.bindTooltip( this.get('thumbnails'), 'My thumbnails');
        @example this.bindTooltip( this.get('thumbnails'), function() { return 'My thumbs' });
        @example this.bindTooltip( { image_nav: 'Navigation' });

        @returns {Galleria}
    */

    bindTooltip: function( elem, value ) {
        this._tooltip.bind.apply( this._tooltip, Utils.array(arguments) );
        return this;
    },

    /**
        Note: this method is deprecated. Use refreshTooltip() instead.
        
        Redefine a tooltip.
        Use this if you want to re-apply a tooltip value to an already bound tooltip element.

        @param {HTML Element} elem The DOM Node to attach the event to
        @param {String or Function} value The tooltip message. Can also be a function that returns a string.

        @returns {Galleria}
    */

    defineTooltip: function( elem, value ) {
        this._tooltip.define.apply( this._tooltip, Utils.array(arguments) );
        return this;
    },

    /**
        Refresh a tooltip value.
        Use this if you want to change the tooltip value at runtime, f.ex if you have a play/pause toggle.

        @param {HTML Element} elem The DOM Node that has a tooltip that should be refreshed

        @returns {Galleria}
    */

    refreshTooltip: function() {
        this._tooltip.show.apply( this._tooltip, Utils.array(arguments) );
        return this;
    },

    /**
        Open a pre-designed lightbox with the currently active image.
        You can control some visuals using gallery options.

        @returns {Galleria}
    */

    openLightbox: function() {
        this._lightbox.show.apply( this._lightbox, Utils.array( arguments ) );
        return this;
    },

    /**
        Close the lightbox.

        @returns {Galleria}
    */

    closeLightbox: function() {
        this._lightbox.hide.apply( this._lightbox, Utils.array( arguments ) );
        return this;
    },

    /**
        Get the currently active image element.

        @returns {HTML Element} The image element
    */

    getActiveImage: function() {
        return this._getActive().image || undef;
    },

    /**
        Get the currently active thumbnail element.

        @returns {HTML Element} The thumbnail element
    */

    getActiveThumb: function() {
        return this._thumbnails[ this._active ].image || undef;
    },

    /**
        Get the mouse position relative to the gallery container

        @param e The mouse event

        @example

var gallery = this;
$(document).mousemove(function(e) {
    console.log( gallery.getMousePosition(e).x );
});

        @returns {Object} Object with x & y of the relative mouse postion
    */

    getMousePosition : function(e) {
        return {
            x: e.pageX - this.$( 'container' ).offset().left,
            y: e.pageY - this.$( 'container' ).offset().top
        };
    },

    /**
        Adds a panning effect to the image

        @param img The optional image element. If not specified it takes the currently active image

        @returns {Galleria}
    */

    addPan : function( img ) {

        if ( this._options.image_crop === false ) {
            return;
        }

        img = $( img || this.getActiveImage() );

        // define some variables and methods
        var self   = this,
            x      = img.width() / 2,
            y      = img.height() / 2,
            curX   = destX = parseInt( img.css( 'left' ) ) || 0,
            curY   = destY = parseInt( img.css( 'top' ) ) || 0,
            distX  = 0,
            distY  = 0,
            active = false,
            ts     = Utils.timestamp(),
            cache  = 0,
            move   = 0,

            // positions the image
            position = function( dist, cur, pos ) {
                if ( dist > 0 ) {
                    move = Math.round( Math.max( dist * -1, Math.min( 0, cur ) ) );
                    if ( cache != move ) {

                        cache = move;

                        if ( IE == 8 ) { // scroll is faster for IE
                            img.parent()[ 'scroll' + pos ]( move * -1 );
                        } else {
                            var css = {};
                            css[ pos.toLowerCase() ] = move;
                            img.css(css);
                        }
                    }
                }
            },

            // calculates mouse position after 50ms
            calculate = function(e) {
                if (Utils.timestamp() - ts < 50) {
                    return;
                }
                active = true;
                x = self.getMousePosition(e).x;
                y = self.getMousePosition(e).y;
            },

            // the main loop to check
            loop = function(e) {

                if (!active) {
                    return;
                }

                distX = img.width() - self._stageWidth;
                distY = img.height() - self._stageHeight;
                destX = x / self._stageWidth * distX * -1;
                destY = y / self._stageHeight * distY * -1;
                curX += ( destX - curX ) / self._options.image_pan_smoothness;
                curY += ( destY - curY ) / self._options.image_pan_smoothness;

                position( distY, curY, 'Top' );
                position( distX, curX, 'Left' );

            };

        // we need to use scroll in IE8 to speed things up
        if ( IE == 8 ) {

            img.parent().scrollTop( curY * -1 ).scrollLeft( curX * -1 );
            img.css({
                top: 0,
                left: 0
            });

        }

        // unbind and bind event
        this.$( 'stage' ).unbind( 'mousemove', calculate ).bind( 'mousemove', calculate );

        // loop the loop
        Utils.addTimer('pan', loop, 50, true);

        return this;
    },

    /**
        Brings the scope into any callback

        @param fn The callback to bring the scope into
        @param scope Optional scope to bring

        @example $('#fullscreen').click( this.proxy(function() { this.enterFullscreen(); }) )

        @returns {Function} Return the callback with the gallery scope
    */

    proxy : function( fn, scope ) {
        if ( typeof fn !== 'function' ) {
            return function() {};
        }
        scope = scope || this;
        return function() {
            return fn.apply( scope, Utils.array( arguments ) );
        };
    },

    /**
        Removes the panning effect set by addPan()

        @returns {Galleria}
    */

    removePan: function() {

        if ( IE == 8 ) {
            // todo: doublecheck this
        }
        this.$( 'stage' ).unbind( 'mousemove' );

        Utils.clearTimer('pan');

        return this;
    },

    /**
        Adds an element to the Galleria DOM array.
        When you add an element here, you can access it using element ID in many API calls

        @param {String} id The element ID you wish to use. You can add many elements by adding more arguments.

        @example addElement('mybutton');
        @example addElement('mybutton','mylink');

        @returns {Galleria}
    */

    addElement : function( id ) {

        var dom = this._dom;

        $.each( Utils.array(arguments), function( i, blueprint ) {
           dom[ blueprint ] = Utils.create( 'galleria-' + blueprint );
        });

        return this;
    },

    /**
        Attach keyboard events to Galleria

        @param {Object} map The map object of events.
        Possible keys are 'UP', 'DOWN', 'LEFT', 'RIGHT', 'RETURN', 'ESCAPE', 'BACKSPACE', and 'SPACE'.

        @example

this.attachKeyboard({
    right: this.next,
    left: this.prev,
    up: function() {
        console.log( 'up key pressed' )
    }
});

        @returns {Galleria}
    */

    attachKeyboard : function( map ) {
        this._keyboard.attach.apply( this._keyboard, Utils.array( arguments ) );
        return this;
    },

    /**
        Detach all keyboard events to Galleria

        @returns {Galleria}
    */

    detachKeyboard : function() {
        this._keyboard.detach.apply( this._keyboard, Utils.array( arguments ) );
        return this;
    },

    /**
        Fast helper for appending galleria elements that you added using addElement()

        @param {String} parentID The parent element ID where the element will be appended
        @param {String} childID the element ID that should be appended

        @example this.addElement('myElement');
        this.appendChild( 'info', 'myElement' );

        @returns {Galleria}
    */

    appendChild : function( parentID, childID ) {
        this.$( parentID ).append( this.get( childID ) || childID );
        return this;
    },

    /**
        Fast helper for appending galleria elements that you added using addElement()

        @param {String} parentID The parent element ID where the element will be preppended
        @param {String} childID the element ID that should be preppended

        @example

this.addElement('myElement');
this.prependChild( 'info', 'myElement' );

        @returns {Galleria}
    */

    prependChild : function( parentID, childID ) {
        this.$( parentID ).prepend( this.get( childID ) || childID );
        return this;
    },

    /**
        Remove an element by blueprint

        @param {String} elemID The element to be removed.
        You can remove multiple elements by adding arguments.

        @returns {Galleria}
    */

    remove : function( elemID ) {
        this.$( Utils.array( arguments ).join(',') ).remove();
        return this;
    },

    // a fast helper for building dom structures
    // leave this out of the API for now

    append : function( data ) {
        for( var i in data) {
            if ( data[i].constructor == Array ) {
                for( var j = 0; data[i][j]; j++ ) {
                    this.appendChild( i, data[i][j] );
                }
            } else {
                this.appendChild( i, data[i] );
            }
        }
        return this;
    },

    // an internal helper for scaling according to options
    _scaleImage : function( image, options ) {
        
        options = $.extend({
            width:    this._stageWidth,
            height:   this._stageHeight,
            crop:     this._options.image_crop,
            max:      this._options.max_scale_ratio,
            min:      this._options.min_scale_ratio,
            margin:   this._options.image_margin,
            position: this._options.image_position
        }, options );

       ( image || this._controls.getActive() ).scale( options );

        return this;
    },

    /**
        Updates the carousel,
        useful if you resize the gallery and want to re-check if the carousel nav is needed.

        @returns {Galleria}
    */

    updateCarousel : function() {
        this._carousel.update();
        return this;
    },

    /**
        Rescales the gallery

        @param {Number} width The target width
        @param {Number} height The target height
        @param {Function} complete The callback to be called when the scaling is complete

        @returns {Galleria}
    */

    rescale : function( width, height, complete ) {

        var self = this;

        // allow rescale(fn)
        if ( typeof width == 'function' ) {
            complete = width;
            width = undef;
        }

        var scale = function() {

            // shortcut
            var o = self._options;

            // set stagewidth
            self._stageWidth = width || self.$( 'stage' ).width();
            self._stageHeight = height || self.$( 'stage' ).height();

            // scale the active image
            self._scaleImage();

            if ( self._options.carousel ) {
                self.updateCarousel();
            }

            self.trigger( Galleria.RESCALE );

            if ( typeof complete == 'function' ) {
                complete.call( self );
            }
        };

        if ( Galleria.WEBKIT && !width && !height ) {
            Utils.addTimer( 'scale', scale, 5 );// webkit is too fast
        } else {
            scale.call( self );
        }

        return this;
    },

    /**
        Refreshes the gallery.
        Useful if you change image options at runtime and want to apply the changes to the active image.

        @returns {Galleria}
    */

    refreshImage : function() {
        this._scaleImage();
        if ( this._options.image_pan ) {
            this.addPan();
        }
        return this;
    },

    /**
        Shows an image by index

        @param {Number} index The index to show
        @param {Boolean} rewind A boolean that should be true if you want the transition to go back

        @returns {Galleria}
    */

    show : function( index, rewind, _history ) {

        // do nothing if index is false or queue is false and transition is in progress
        if ( index === false || !this._options.queue && this._queue.stalled ) {
            return;
        }
        
        index = Math.max( 0, Math.min( parseInt(index), this.getDataLength() - 1 ) );

        rewind = typeof rewind != 'undefined' ? !!rewind : index < this.getIndex();

        _history = _history || false;

        // do the history thing and return
        if ( !_history && Galleria.History ) {
            Galleria.History.value( index.toString() );
            return;
        }

        this._active = index;

        Array.prototype.push.call( this._queue, {
            index : index,
            rewind : rewind
        });
        if ( !this._queue.stalled ) {
            this._show();
        }

        return this;
    },

    // the internal _show method does the actual showing
    _show : function() {

        // shortcuts
        var self   = this,
            queue  = this._queue[ 0 ],
            data   = this.getData( queue.index );
        
        if ( !data ) {
            return;
        }
        
        var src    = data.image,
            active = this._controls.getActive(),
            next   = this._controls.getNext(),
            cached = next.isCached( src ),
            thumb  = this._thumbnails[ queue.index ];

            // to be fired when loading & transition is complete:
        var complete = function() {

            // remove stalled
            self._queue.stalled = false;

            // optimize quality
            Utils.toggleQuality( next.image, self._options.image_quality );

            // swap
            $( active.container ).css({
                zIndex: 0,
                opacity: 0
            });
            $( next.container ).css({
                zIndex: 1,
                opacity: 1
            });
            self._controls.swap();

            // add pan according to option
            if ( self._options.image_pan ) {
                self.addPan( next.image );
            }

            // make the image link
            if ( data.link ) {
                $( next.image ).css({
                    cursor: 'pointer'
                }).bind( CLICK(), function() {

                    // popup link
                    if ( self._options.popup_links ) {
                        var win = window.open( data.link, '_blank' );
                    } else {
                        window.location.href = data.link;
                    }
                });
            }

            // remove the queued image
            Array.prototype.shift.call( self._queue );

            // if we still have images in the queue, show it
            if ( self._queue.length ) {
                self._show();
            }

            // check if we are playing
            self._playCheck();

            // trigger IMAGE event
            self.trigger({
                type:        Galleria.IMAGE,
                index:       queue.index,
                imageTarget: next.image,
                thumbTarget: thumb.image
            });
        };

        // let the carousel follow
        if ( this._options.carousel && this._options.carousel_follow ) {
            this._carousel.follow( queue.index );
        }

        // preload images
        if ( this._options.preload ) {

            var p,
                n = this.getNext();

            try {
                for ( var i = this._options.preload; i > 0; i-- ) {
                    p = new Galleria.Picture();
                    p.add( self.getData( n ).image );
                    n = self.getNext( n );
                }
            } catch(e) {}
        }

        // show the next image, just in case
        Utils.show( next.container );

        // add active classes
        $( self._thumbnails[ queue.index ].container )
            .addClass( 'active' )
            .siblings( '.active' )
            .removeClass( 'active' );

        // trigger the LOADSTART event
        self.trigger( {
            type: Galleria.LOADSTART,
            cached: cached,
            index: queue.index,
            imageTarget: next.image,
            thumbTarget: thumb.image
        });
        // begin loading the next image
        next.load( src, function( next ) {
            self._scaleImage( next, {

                complete: function( next ) {

                    Utils.show( next.container );

                    // toggle low quality for IE
                    if ( 'image' in active ) {
                        Utils.toggleQuality( active.image, false );
                    }
                    Utils.toggleQuality( next.image, false );

                    // stall the queue
                    self._queue.stalled = true;

                    // remove the image panning, if applied
                    // TODO: rethink if this is necessary
                    self.removePan();

                    // set the captions and counter
                    self.setInfo( queue.index );
                    self.setCounter( queue.index );

                    // trigger the LOADFINISH event
                    self.trigger({
                        type: Galleria.LOADFINISH,
                        cached: cached,
                        index: queue.index,
                        imageTarget: next.image,
                        thumbTarget: self._thumbnails[ queue.index ].image
                    });

                    var transition = active.image === null && self._options.transition_initial ?
                        self._options.transition_initial : self._options.transition;

                    // validate the transition
                    if ( transition in _transitions === false ) {

                        complete();

                    } else {
                        var params = {
                            prev:   active.image,
                            next:   next.image,
                            rewind: queue.rewind,
                            speed:  self._options.transition_speed || 400
                        };

                        // call the transition function and send some stuff
                        _transitions[ transition ].call(self, params, complete );

                    }
                }
            });
        });
    },

    /**
        Gets the next index

        @param {Number} base Optional starting point

        @returns {Number} the next index, or the first if you are at the first (looping)
    */

    getNext : function( base ) {
        base = typeof base == 'number' ? base : this.getIndex();
        return base == this.getDataLength() - 1 ? 0 : base + 1;
    },

    /**
        Gets the previous index

        @param {Number} base Optional starting point

        @returns {Number} the previous index, or the last if you are at the first (looping)
    */

    getPrev : function( base ) {
        base = typeof base == 'number' ? base : this.getIndex();
        return base === 0 ? this.getDataLength() - 1 : base - 1;
    },

    /**
        Shows the next image in line

        @returns {Galleria}
    */

    next : function() {
        if ( this.getDataLength() > 1 ) {
            this.show( this.getNext(), false );
        }
        return this;
    },

    /**
        Shows the previous image in line

        @returns {Galleria}
    */

    prev : function() {
        if ( this.getDataLength() > 1 ) {
            this.show( this.getPrev(), true );
        }
        return this;
    },

    /**
        Retrieve a DOM element by element ID

        @param {String} elemId The delement ID to fetch

        @returns {HTML Element} The elements DOM node or null if not found.
    */

    get : function( elemId ) {
        return elemId in this._dom ? this._dom[ elemId ] : null;
    },

    /**
        Retrieve a data object

        @param {Number} index The data index to retrieve.
        If no index specified it will take the currently active image

        @returns {Object} The data object
    */

    getData : function( index ) {
        return index in this._data ?
            this._data[ index ] : this._data[ this._active ];
    },

    /**
        Retrieve the number of data items

        @returns {Number} The data length
    */
    getDataLength : function() {
        return this._data.length;
    },

    /**
        Retrieve the currently active index

        @returns {Number} The active index
    */

    getIndex : function() {
        return typeof this._active === 'number' ? this._active : false;
    },

    /**
        Retrieve the stage height

        @returns {Number} The stage height
    */

    getStageHeight : function() {
        return this._stageHeight;
    },

    /**
        Retrieve the stage width

        @returns {Number} The stage width
    */

    getStageWidth : function() {
        return this._stageWidth;
    },

    /**
        Retrieve the option

        @param {String} key The option key to retrieve. If no key specified it will return all options in an object.

        @returns option or options
    */

    getOptions : function( key ) {
        return typeof key == 'undefined' ? this._options : this._options[ key ];
    },

    /**
        Set options to the instance.
        You can set options using a key & value argument or a single object argument (see examples)

        @param {String} key The option key
        @param {String} value the the options value

        @example setOptions( 'autoplay', true )
        @example setOptions({ autoplay: true });

        @returns {Galleria}
    */

    setOptions : function( key, value ) {
        if ( typeof key == 'object' ) {
            $.extend( this._options, key );
        } else {
            this._options[ key ] = value;
        }
        return this;
    },

    /**
        Starts playing the slideshow

        @param {Number} delay Sets the slideshow interval in milliseconds.
        If you set it once, you can just call play() and get the same interval the next time.

        @returns {Galleria}
    */

    play : function( delay ) {
        
        this._playing = true;
        
        this._playtime = delay || this._playtime;

        this._playCheck();
        
        this.trigger( Galleria.PLAY );

        return this;
    },

    /**
        Stops the slideshow if currently playing

        @returns {Galleria}
    */

    pause : function() {
        
        this._playing = false;
        
        this.trigger( Galleria.PAUSE );
        
        return this;
    },

    /**
        Toggle between play and pause events.

        @param {Number} delay Sets the slideshow interval in milliseconds.

        @returns {Galleria}
    */

    playToggle : function( delay ) {
        return ( this._playing ) ? this.pause() : this.play( delay );
    },
    
    /**
        Checks if the gallery is currently playing

        @returns {Boolean}
    */
    
    isPlaying : function() {
        return this._playing;
    },

    _playCheck : function() {
        var self = this,
            played = 0,
            interval = 20,
            now = Utils.timestamp();

        if ( this._playing ) {

            Utils.clearTimer('play');
            var fn = function() {

                played = Utils.timestamp() - now;
                if ( played >= self._playtime && self._playing ) {
                    Utils.clearTimer('play');
                    self.next();
                    return;
                }
                if ( self._playing ) {

                    // trigger the PROGRESS event
                    self.trigger({
                        type:         Galleria.PROGRESS,
                        percent:      Math.ceil( played / self._playtime * 100 ),
                        seconds:      Math.floor( played / 1000 ),
                        milliseconds: played
                    });

                    Utils.addTimer( 'play', fn, interval );
                }
            };
            Utils.addTimer( 'play', fn, interval );
        }
    },

    setIndex: function( val ) {
        this._active = val;
        return this;
    },

    /**
        Manually modify the counter

        @param {Number} index Optional data index to fectch,
        if no index found it assumes the currently active index

        @returns {Galleria}
    */

    setCounter: function( index ) {

        if ( typeof index == 'number' ) {
            index++;
        } else if ( typeof index == 'undefined' ) {
            index = this.getIndex()+1;
        }

        this.get( 'current' ).innerHTML = index;

        if ( IE == 8 ) { // weird IE8 bug

            var opacity = this.$( 'counter' ).css( 'opacity' );
            this.$( 'counter' ).css( 'opacity', opacity );

        }

        return this;
    },

    /**
        Manually set captions

        @param {Number} index Optional data index to fectch and apply as caption,
        if no index found it assumes the currently active index

        @returns {Galleria}
    */

    setInfo : function( index ) {

        var self = this,
            data = this.getData( index );

        $.each( ['title','description','author'], function( i, type ) {

            var elem = self.$( 'info-' + type );

            if ( !!data[type] ) {
                elem[ data[ type ].length ? 'show' : 'hide' ]().html( data[ type ] );
            } else {
               elem.empty().hide();
            }
        });

        return this;
    },

    /**
        Checks if the data contains any captions

        @param {Number} index Optional data index to fectch,
        if no index found it assumes the currently active index.

        @returns {Boolean}
    */

    hasInfo : function( index ) {

        var d = this.getData( index );
        var check = 'title description'.split(' ');
        for ( var i = 0; check[i]; i++ ) {
            if ( !!this.getData( index )[ check[i] ] ) {
                return true;
            }
        }
        return false;

    },

    jQuery : function( str ) {

        var self = this,
            ret = [];

        $.each( str.split(','), function( i, elemId ) {
            elemId = $.trim( elemId );

            if ( self.get( elemId ) ) {
                ret.push( elemId );
            }
        });

        var jQ = $( self.get( ret.shift() ) );

        $.each( ret, function( i, elemId ) {
            jQ = jQ.add( self.get( elemId ) );
        });

        return jQ;

    },

    /**
        Converts element IDs into a jQuery collection
        You can call for multiple IDs separated with commas.

        @param {String} str One or more element IDs (comma-separated)

        @returns {jQuery}

        @example this.$('info,container').hide();
    */

    $ : function() {
        return this.jQuery.apply( this, Utils.array( arguments ) );
    }

};

// End of Galleria prototype

$.extend( Galleria, {

    // Event placeholders
    DATA:             'g_data',
    READY:            'g_ready',
    THUMBNAIL:        'g_thumbnail',
    LOADSTART:        'g_loadstart',
    LOADFINISH:       'g_loadfinish',
    IMAGE:            'g_image',
    THEMELOAD:        'g_themeload',
    PLAY:             'g_play',
    PAUSE:            'g_pause',
    PROGRESS:         'g_progress',
    FULLSCREEN_ENTER: 'g_fullscreen_enter',
    FULLSCREEN_EXIT:  'g_fullscreen_exit',
    IDLE_ENTER:       'g_idle_enter',
    IDLE_EXIT:        'g_idle_exit',
    RESCALE:          'g_rescale',
    LIGHTBOX_OPEN:    'g_lightbox_open',
    LIGHTBOX_CLOSE:   'g_lightbox_close',
    LIGHTBOX_IMAGE:   'g_lightbox_image',

    // Browser helpers
    IE9:     IE == 9,
    IE8:     IE == 8,
    IE7:     IE == 7,
    IE6:     IE == 6,
    IE:      !!IE,
    WEBKIT:  /webkit/.test( NAV ),
    SAFARI:  /safari/.test( NAV ),
    CHROME:  /chrome/.test( NAV ),
    QUIRK:   ( IE && doc.compatMode && doc.compatMode == "BackCompat" ),
    MAC:     /mac/.test( navigator.platform.toLowerCase() ),
    OPERA:   !!window.opera,
    IPHONE:  /iphone/.test( NAV ),
    IPAD:    /ipad/.test( NAV ),
    ANDROID: /android/.test( NAV ),

    // Todo detect touch devices in a better way, possibly using event detection
    TOUCH:   !!( /iphone/.test( NAV ) || /ipad/.test( NAV ) || /android/.test( NAV ) )

});

// Galleria static methods

/**
    Adds a theme that you can use for your Gallery

    @param {Object} theme Object that should contain all your theme settings.
    <ul>
        <li>name – name of the theme</li>
        <li>author - name of the author</li>
        <li>version - version number</li>
        <li>css - css file name (not path)</li>
        <li>defaults - default options to apply, including theme-specific options</li>
        <li>init - the init function</li>
    </ul>

    @returns {Object} theme
*/

Galleria.addTheme = function( theme ) {

    // make sure we have a name
    if ( !!theme['name'] === false ) {
        Galleria.raise('No theme name specified');
    }

    if ( typeof theme.defaults != 'object' ) {
        theme.defaults = {};
    }

    if ( typeof theme.css == 'string' ) {

        var css;

        // look for the absolute path
        $('script').each(function( i, script ) {

            // look for the theme script
            var reg = new RegExp( 'galleria\\.' + theme.name.toLowerCase() + '\\.' );
            if( reg.test( script.src )) {

                // we have a match
                css = script.src.replace(/[^\/]*$/, '') + theme.css;

                Utils.addTimer( "css", function() {
                    Utils.loadCSS( css, 'galleria-theme', function() {
                        Galleria.theme = theme;
                        $doc.trigger( Galleria.THEMELOAD );
                    });
                }, 1);

            }
        });

        if ( !css ) {
            Galleria.raise('No theme CSS loaded');
        }
    } else {
        Galleria.theme = theme;
        $doc.trigger( Galleria.THEMELOAD );
    }
    return theme;
};

/**
    loadTheme loads a theme js file and attaches a load event to Galleria

    @param {String} src The relative path to the theme source file

    @param {Object} option Optional options you want to apply
*/

Galleria.loadTheme = function( src, options ) {

    var loaded = false,
        length = _galleries.length;

    // first clear the current theme, if exists
    Galleria.theme = undef;

    // load the theme
    Utils.loadScript( src, function() {
        loaded = true;
    } );

    // set a 1 sec timeout, then display a hard error if no theme is loaded
    Utils.wait({
        until: function() {
            return loaded;
        },
        error: function() {
            Galleria.raise( "Theme at " + src + " could not load, check theme path.", true );
        },
        success: function() {

            // check for existing galleries and reload them with the new theme
            if ( length ) {

                // temporary save the new galleries
                var refreshed = [];

                // refresh all instances
                // when adding a new theme to an existing gallery, all options will be resetted but the data will be kept
                // you can apply new options as a second argument
                $.each( Galleria.get(), function(i, instance) {

                    // mix the old data and options into the new instance
                    var op = $.extend( instance._original.options, {
                        data_source: instance._data
                    }, options);

                    // remove the old container
                    instance.$('container').remove();

                    // create a new instance
                    var g = new Galleria();

                    // move the id
                    g._id = instance._id;

                    // initialize the new instance
                    g.init( instance._original.target, op );

                    // push the new instance
                    refreshed.push( g );
                });

                // now overwrite the old holder with the new instances
                _galleries = refreshed;
            }
        },
        timeout: 2000
    });
};

/**
    Retrieves a Galleria instance.

    @param {Number} index Optional index to retrieve.
    If no index is supplied, the method will return all instances in an array.

    @returns {Galleria or Array}
*/

Galleria.get = function( index ) {
    if ( !!_galleries[ index ] ) {
        return _galleries[ index ];
    } else if ( typeof index !== 'number' ) {
        return _galleries;
    } else {
        Galleria.raise('Gallery index ' + index + ' not found');
    }
};

/**
    Creates a transition to be used in your gallery

    @param {String} name The name of the transition that you will use as an option

    @param {Function} fn The function to be executed in the transition.
    The function contains two arguments, params and complete.
    Use the params Object to integrate the transition, and then call complete when you are done.

*/

Galleria.addTransition = function( name, fn ) {
    _transitions[name] = fn;
};

Galleria.utils = Utils;

/**
    A helper metod for cross-browser logging.
    It uses the console log if available otherwise it falls back to the opera
    debugger and finally <code>alert()</code>

    @example Galleria.log("hello", document.body, [1,2,3]);
*/

Galleria.log = function() {
    try {
        window.console.log.apply( window.console, Utils.array(arguments) );
    } catch( e ) {
        try {
            opera.postError.apply( opera, arguments );
        } catch( er ) {
              alert( Utils.array(arguments).split(', ') );
        }
    }
};

/**
    Method for raising errors

    @param {String} msg The message to throw

    @param {Boolean} fatal Set this to true to override debug settings and display a fatal error
*/

Galleria.raise = function( msg, fatal ) {
    if ( DEBUG || fatal ) {
        var type = fatal ? 'Fatal error' : 'Error';
        throw new Error( type + ': ' + msg );
    }
};

/**
    Adds preload, cache, scale and crop functionality

    @constructor

    @requires jQuery

    @param {Number} id Optional id to keep track of instances
*/

Galleria.Picture = function( id ) {

    // save the id
    this.id = id || null;

    // the image should be null until loaded
    this.image = null;

    // Create a new container
    this.container = Utils.create('galleria-image');

    // add container styles
    $( this.container ).css({
        overflow: 'hidden',
        position: 'relative' // for IE Standards mode
    });

    // saves the original meassurements
    this.original = {
        width: 0,
        height: 0
    };

    // flag when the image is ready
    this.ready = false;

    // flag when the image is loaded
    this.loaded = false;

};

Galleria.Picture.prototype = {

    // the inherited cache object
    cache: {},

    // creates a new image and adds it to cache when loaded
    add: function( src ) {

        var self = this;

        // create the image
        var image = new Image();

        // force a block display
        $( image ).css( 'display', 'block');

        if ( self.cache[ src ] ) {
            // no need to onload if the image is cached
            image.src = src;
            self.loaded = true;
            self.original = {
                height: image.height,
                width: image.width
            };
            return image;
        }

        // begin preload and insert in cache when done
        image.onload = function() {
            self.original = {
                height: this.height,
                width: this.width
            };
            self.cache[ src ] = src; // will override old cache
            self.loaded = true;
        };

        image.src = src;
        return image;

    },

    // show the image on stage
    show: function() {
        Utils.show( this.image );
    },

    // hide the image
    hide: function() {
        Utils.moveOut( this.image );
    },

    clear: function() {
        this.image = null;
    },

    /**
        Checks if an image is in cache

        @param {String} src The image source path, ex '/path/to/img.jpg'

        @returns {Boolean}
    */

    isCached: function( src ) {
        return !!this.cache[src];
    },

    /**
        Loads an image and call the callback when ready.
        Will also add the image to cache.

        @param {String} src The image source path, ex '/path/to/img.jpg'
        @param {Function} callback The function to be executed when the image is loaded & scaled

        @returns {jQuery} The image container object
    */

    load: function(src, callback) {

        // save the instance
        var self = this;

        $( this.container ).empty(true);

        // add the image to cache and hide it
        this.image = this.add( src );
        Utils.hide( this.image );

        // append the image into the container
        $( this.container ).append( this.image );

        // check for loaded image using a timeout
        Utils.wait({
            until: function() {
                // TODO this should be properly tested in Opera
                return self.loaded && self.image.complete && self.image.width;
            },
            success: function() {
                // call success
                window.setTimeout(function() { callback.call( self, self ); }, 50 );
            },
            error: function() {
                window.setTimeout(function() { callback.call( self, self ); }, 50 );
                Galleria.raise('image not loaded in 10 seconds: '+ src);
            },
            timeout: 10000
        });

        // return the container
        return this.container;
    },

    /**
        Scales and crops the image

        @param {Object} options The method takes an object with a number of options:

        <ul>
            <li>width - width of the container</li>
            <li>height - height of the container</li>
            <li>min - minimum scale ratio</li>
            <li>max - maximum scale ratio</li>
            <li>margin - distance in pixels from the image border to the container</li>
            <li>complete - a callback that fires when scaling is complete</li>
            <li>position - positions the image, works like the css background-image property.</li>
            <li>crop - defines how to crop. Can be true, false, 'width' or 'height'</li>
        </ul>

        @returns {jQuery} The image container object
    */

    scale: function( options ) {

        // extend some defaults
        options = $.extend({
            width: 0,
            height: 0,
            min: undef,
            max: undef,
            margin: 0,
            complete: function() {},
            position: 'center',
            crop: false
        }, options);

        // return the element if no image found
        if (!this.image) {
            return this.container;
        }

        // store locale variables of width & height
        var width,
            height,
            self = this,
            $container = $( self.container );

        // wait for the width/height
        Utils.wait({
            until: function() {

                width  = options.width
                    || $container.width()
                    || Utils.parseValue( $container.css('width') );

                height = options.height
                    || $container.height()
                    || Utils.parseValue( $container.css('height') );

                return width && height;
            },
            success: function() {
                // calculate some cropping
                var newWidth = ( width - options.margin * 2 ) / self.original.width,
                    newHeight = ( height - options.margin * 2 ) / self.original.height,
                    cropMap = {
                        'true'  : Math.max( newWidth, newHeight ),
                        'width' : newWidth,
                        'height': newHeight,
                        'false' : Math.min( newWidth, newHeight )
                    },
                    ratio = cropMap[ options.crop.toString() ];

                // allow max_scale_ratio
                if ( options.max ) {
                    ratio = Math.min( options.max, ratio );
                }

                // allow min_scale_ratio
                if ( options.min ) {
                    ratio = Math.max( options.min, ratio );
                }

                $( self.container ).width( width ).height( height );

                // round up the width / height
                $.each( ['width','height'], function( i, m ) {
                    $( self.image )[ m ]( self[ m ] = Math.ceil( self.original[ m ] * ratio ) );
                });

                // calculate image_position
                var pos = {},
                    mix = {},
                    getPosition = function(value, meassure, margin) {
                        var result = 0;
                        if (/\%/.test(value)) {
                            var flt = parseInt(value) / 100;
                            result = Math.ceil( $( self.image )[ meassure ]() * -1 * flt + margin * flt );
                        } else {
                            result = Utils.parseValue( value );
                        }
                        return result;
                    },
                    positionMap = {
                        'top': { top: 0 },
                        'left': { left: 0 },
                        'right': { left: '100%' },
                        'bottom': { top: '100%' }
                    };

                $.each( options.position.toLowerCase().split(' '), function( i, value ) {
                    if ( value == 'center' ) {
                        value = '50%';
                    }
                    pos[i ? 'top' : 'left'] = value;
                });

                $.each( pos, function( i, value ) {
                    if ( positionMap.hasOwnProperty( value ) ) {
                        $.extend( mix, positionMap[ value ] );
                    }
                });

                pos = pos.top ? $.extend( pos, mix ) : mix;

                pos = $.extend({
                    top: '50%',
                    left: '50%'
                }, pos);

                // apply position
                $( self.image ).css({
                    position : 'relative',
										width: '100%',
                    top :  getPosition(pos.top, 'height', height) - options.margin,
                    left : getPosition(pos.left, 'width', width) - options.margin
                });

                // show the image
                self.show();

                // flag ready and call the callback
                self.ready = true;
                options.complete.call( self, self );
            },
            error: function() {
                Galleria.raise('Could not scale image: '+self.image.src);
            },
            timeout: 1000
        });
        return this;
    }
};

// our own easings
$.extend( $.easing, {
    galleria: function (_, t, b, c, d) {
        if ((t/=d/2) < 1) {
            return c/2*t*t*t*t + b;
        }
        return -c/2 * ((t-=2)*t*t*t - 2) + b;
    },
    galleriaIn: function (_, t, b, c, d) {
    return c*(t/=d)*t*t*t + b;
  },
  galleriaOut: function (_, t, b, c, d) {
    return -c * ((t=t/d-1)*t*t*t - 1) + b;
  }
});

// the plugin initializer
$.fn.galleria = function( options ) {

    return this.each(function() {

        var gallery = new Galleria();
        gallery.init( this, options );

    });
};

// expose Galleria
window.Galleria = Galleria;

// phew

})( jQuery );
/*!
 * jQuery Cycle Plugin (with Transition Definitions)
 * Examples and documentation at: http://jquery.malsup.com/cycle/
 * Copyright (c) 2007-2010 M. Alsup
 * Version: 2.88 (08-JUN-2010)
 * Dual licensed under the MIT and GPL licenses.
 * http://jquery.malsup.com/license.html
 * Requires: jQuery v1.2.6 or later
 */
;(function($) {

var ver = '2.88';

// if $.support is not defined (pre jQuery 1.3) add what I need
if ($.support == undefined) {
	$.support = {
		opacity: !($.browser.msie)
	};
}

function debug(s) {
	if ($.fn.cycle.debug)
		log(s);
}		
function log() {
	if (window.console && window.console.log)
		window.console.log('[cycle] ' + Array.prototype.join.call(arguments,' '));
};

// the options arg can be...
//   a number  - indicates an immediate transition should occur to the given slide index
//   a string  - 'pause', 'resume', 'toggle', 'next', 'prev', 'stop', 'destroy' or the name of a transition effect (ie, 'fade', 'zoom', etc)
//   an object - properties to control the slideshow
//
// the arg2 arg can be...
//   the name of an fx (only used in conjunction with a numeric value for 'options')
//   the value true (only used in first arg == 'resume') and indicates
//	 that the resume should occur immediately (not wait for next timeout)

$.fn.cycle = function(options, arg2) {
	var o = { s: this.selector, c: this.context };

	// in 1.3+ we can fix mistakes with the ready state
	if (this.length === 0 && options != 'stop') {
		if (!$.isReady && o.s) {
			log('DOM not ready, queuing slideshow');
			$(function() {
				$(o.s,o.c).cycle(options,arg2);
			});
			return this;
		}
		// is your DOM ready?  http://docs.jquery.com/Tutorials:Introducing_$(document).ready()
		log('terminating; zero elements found by selector' + ($.isReady ? '' : ' (DOM not ready)'));
		return this;
	}

	// iterate the matched nodeset
	return this.each(function() {
		var opts = handleArguments(this, options, arg2);
		if (opts === false)
			return;

		opts.updateActivePagerLink = opts.updateActivePagerLink || $.fn.cycle.updateActivePagerLink;
		
		// stop existing slideshow for this container (if there is one)
		if (this.cycleTimeout)
			clearTimeout(this.cycleTimeout);
		this.cycleTimeout = this.cyclePause = 0;

		var $cont = $(this);
		var $slides = opts.slideExpr ? $(opts.slideExpr, this) : $cont.children();
		var els = $slides.get();
		if (els.length < 2) {
			log('terminating; too few slides: ' + els.length);
			return;
		}

		var opts2 = buildOptions($cont, $slides, els, opts, o);
		if (opts2 === false)
			return;

		var startTime = opts2.continuous ? 10 : getTimeout(els[opts2.currSlide], els[opts2.nextSlide], opts2, !opts2.rev);

		// if it's an auto slideshow, kick it off
		if (startTime) {
			startTime += (opts2.delay || 0);
			if (startTime < 10)
				startTime = 10;
			debug('first timeout: ' + startTime);
			this.cycleTimeout = setTimeout(function(){go(els,opts2,0,(!opts2.rev && !opts.backwards))}, startTime);
		}
	});
};

// process the args that were passed to the plugin fn
function handleArguments(cont, options, arg2) {
	if (cont.cycleStop == undefined)
		cont.cycleStop = 0;
	if (options === undefined || options === null)
		options = {};
	if (options.constructor == String) {
		switch(options) {
		case 'destroy':
		case 'stop':
			var opts = $(cont).data('cycle.opts');
			if (!opts)
				return false;
			cont.cycleStop++; // callbacks look for change
			if (cont.cycleTimeout)
				clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
			$(cont).removeData('cycle.opts');
			if (options == 'destroy')
				destroy(opts);
			return false;
		case 'toggle':
			cont.cyclePause = (cont.cyclePause === 1) ? 0 : 1;
			checkInstantResume(cont.cyclePause, arg2, cont);
			return false;
		case 'pause':
			cont.cyclePause = 1;
			return false;
		case 'resume':
			cont.cyclePause = 0;
			checkInstantResume(false, arg2, cont);
			return false;
		case 'prev':
		case 'next':
			var opts = $(cont).data('cycle.opts');
			if (!opts) {
				log('options not found, "prev/next" ignored');
				return false;
			}
			$.fn.cycle[options](opts);
			return false;
		default:
			options = { fx: options };
		};
		return options;
	}
	else if (options.constructor == Number) {
		// go to the requested slide
		var num = options;
		options = $(cont).data('cycle.opts');
		if (!options) {
			log('options not found, can not advance slide');
			return false;
		}
		if (num < 0 || num >= options.elements.length) {
			log('invalid slide index: ' + num);
			return false;
		}
		options.nextSlide = num;
		if (cont.cycleTimeout) {
			clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
		}
		if (typeof arg2 == 'string')
			options.oneTimeFx = arg2;
		go(options.elements, options, 1, num >= options.currSlide);
		return false;
	}
	return options;
	
	function checkInstantResume(isPaused, arg2, cont) {
		if (!isPaused && arg2 === true) { // resume now!
			var options = $(cont).data('cycle.opts');
			if (!options) {
				log('options not found, can not resume');
				return false;
			}
			if (cont.cycleTimeout) {
				clearTimeout(cont.cycleTimeout);
				cont.cycleTimeout = 0;
			}
			go(options.elements, options, 1, (!opts.rev && !opts.backwards));
		}
	}
};

function removeFilter(el, opts) {
	if (!$.support.opacity && opts.cleartype && el.style.filter) {
		try { el.style.removeAttribute('filter'); }
		catch(smother) {} // handle old opera versions
	}
};

// unbind event handlers
function destroy(opts) {
	if (opts.next)
		$(opts.next).unbind(opts.prevNextEvent);
	if (opts.prev)
		$(opts.prev).unbind(opts.prevNextEvent);
	
	if (opts.pager || opts.pagerAnchorBuilder)
		$.each(opts.pagerAnchors || [], function() {
			this.unbind().remove();
		});
	opts.pagerAnchors = null;
	if (opts.destroy) // callback
		opts.destroy(opts);
};

// one-time initialization
function buildOptions($cont, $slides, els, options, o) {
	// support metadata plugin (v1.0 and v2.0)
	var opts = $.extend({}, $.fn.cycle.defaults, options || {}, $.metadata ? $cont.metadata() : $.meta ? $cont.data() : {});
	if (opts.autostop)
		opts.countdown = opts.autostopCount || els.length;

	var cont = $cont[0];
	$cont.data('cycle.opts', opts);
	opts.$cont = $cont;
	opts.stopCount = cont.cycleStop;
	opts.elements = els;
	opts.before = opts.before ? [opts.before] : [];
	opts.after = opts.after ? [opts.after] : [];
	opts.after.unshift(function(){ opts.busy=0; });

	// push some after callbacks
	if (!$.support.opacity && opts.cleartype)
		opts.after.push(function() { removeFilter(this, opts); });
	if (opts.continuous)
		opts.after.push(function() { go(els,opts,0,(!opts.rev && !opts.backwards)); });

	saveOriginalOpts(opts);

	// clearType corrections
	if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
		clearTypeFix($slides);

	// container requires non-static position so that slides can be position within
	if ($cont.css('position') == 'static')
		$cont.css('position', 'relative');
	if (opts.width)
		$cont.width(opts.width);
	if (opts.height && opts.height != 'auto')
		$cont.height(opts.height);

	if (opts.startingSlide)
		opts.startingSlide = parseInt(opts.startingSlide);
	else if (opts.backwards)
		opts.startingSlide = els.length - 1;

	// if random, mix up the slide array
	if (opts.random) {
		opts.randomMap = [];
		for (var i = 0; i < els.length; i++)
			opts.randomMap.push(i);
		opts.randomMap.sort(function(a,b) {return Math.random() - 0.5;});
		opts.randomIndex = 1;
		opts.startingSlide = opts.randomMap[1];
	}
	else if (opts.startingSlide >= els.length)
		opts.startingSlide = 0; // catch bogus input
	opts.currSlide = opts.startingSlide || 0;
	var first = opts.startingSlide;

	// set position and zIndex on all the slides
	$slides.css({position: 'absolute', top:0, left:0}).hide().each(function(i) {
		var z;
		if (opts.backwards)
			z = first ? i <= first ? els.length + (i-first) : first-i : els.length-i;
		else
			z = first ? i >= first ? els.length - (i-first) : first-i : els.length-i;
		$(this).css('z-index', z)
	});

	// make sure first slide is visible
	$(els[first]).css('opacity',1).show(); // opacity bit needed to handle restart use case
	removeFilter(els[first], opts);

	// stretch slides
	if (opts.fit && opts.width)
		$slides.width(opts.width);
	if (opts.fit && opts.height && opts.height != 'auto')
		$slides.height(opts.height);

	// stretch container
	var reshape = opts.containerResize && !$cont.innerHeight();
	if (reshape) { // do this only if container has no size http://tinyurl.com/da2oa9
		var maxw = 0, maxh = 0;
		for(var j=0; j < els.length; j++) {
			var $e = $(els[j]), e = $e[0], w = $e.outerWidth(), h = $e.outerHeight();
			if (!w) w = e.offsetWidth || e.width || $e.attr('width')
			if (!h) h = e.offsetHeight || e.height || $e.attr('height');
			maxw = w > maxw ? w : maxw;
			maxh = h > maxh ? h : maxh;
		}
		if (maxw > 0 && maxh > 0)
			$cont.css({width:maxw+'px',height:maxh+'px'});
	}

	if (opts.pause)
		$cont.hover(function(){this.cyclePause++;},function(){this.cyclePause--;});

	if (supportMultiTransitions(opts) === false)
		return false;

	// apparently a lot of people use image slideshows without height/width attributes on the images.
	// Cycle 2.50+ requires the sizing info for every slide; this block tries to deal with that.
	var requeue = false;
	options.requeueAttempts = options.requeueAttempts || 0;
	$slides.each(function() {
		// try to get height/width of each slide
		var $el = $(this);
		this.cycleH = (opts.fit && opts.height) ? opts.height : ($el.height() || this.offsetHeight || this.height || $el.attr('height') || 0);
		this.cycleW = (opts.fit && opts.width) ? opts.width : ($el.width() || this.offsetWidth || this.width || $el.attr('width') || 0);

		if ( $el.is('img') ) {
			// sigh..  sniffing, hacking, shrugging...  this crappy hack tries to account for what browsers do when
			// an image is being downloaded and the markup did not include sizing info (height/width attributes);
			// there seems to be some "default" sizes used in this situation
			var loadingIE	= ($.browser.msie  && this.cycleW == 28 && this.cycleH == 30 && !this.complete);
			var loadingFF	= ($.browser.mozilla && this.cycleW == 34 && this.cycleH == 19 && !this.complete);
			var loadingOp	= ($.browser.opera && ((this.cycleW == 42 && this.cycleH == 19) || (this.cycleW == 37 && this.cycleH == 17)) && !this.complete);
			var loadingOther = (this.cycleH == 0 && this.cycleW == 0 && !this.complete);
			// don't requeue for images that are still loading but have a valid size
			if (loadingIE || loadingFF || loadingOp || loadingOther) {
				if (o.s && opts.requeueOnImageNotLoaded && ++options.requeueAttempts < 100) { // track retry count so we don't loop forever
					log(options.requeueAttempts,' - img slide not loaded, requeuing slideshow: ', this.src, this.cycleW, this.cycleH);
					setTimeout(function() {$(o.s,o.c).cycle(options)}, opts.requeueTimeout);
					requeue = true;
					return false; // break each loop
				}
				else {
					log('could not determine size of image: '+this.src, this.cycleW, this.cycleH);
				}
			}
		}
		return true;
	});

	if (requeue)
		return false;

	opts.cssBefore = opts.cssBefore || {};
	opts.animIn = opts.animIn || {};
	opts.animOut = opts.animOut || {};

	$slides.not(':eq('+first+')').css(opts.cssBefore);
	if (opts.cssFirst)
		$($slides[first]).css(opts.cssFirst);

	if (opts.timeout) {
		opts.timeout = parseInt(opts.timeout);
		// ensure that timeout and speed settings are sane
		if (opts.speed.constructor == String)
			opts.speed = $.fx.speeds[opts.speed] || parseInt(opts.speed);
		if (!opts.sync)
			opts.speed = opts.speed / 2;
		
		var buffer = opts.fx == 'shuffle' ? 500 : 250;
		while((opts.timeout - opts.speed) < buffer) // sanitize timeout
			opts.timeout += opts.speed;
	}
	if (opts.easing)
		opts.easeIn = opts.easeOut = opts.easing;
	if (!opts.speedIn)
		opts.speedIn = opts.speed;
	if (!opts.speedOut)
		opts.speedOut = opts.speed;

	opts.slideCount = els.length;
	opts.currSlide = opts.lastSlide = first;
	if (opts.random) {
		if (++opts.randomIndex == els.length)
			opts.randomIndex = 0;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else if (opts.backwards)
		opts.nextSlide = opts.startingSlide == 0 ? (els.length-1) : opts.startingSlide-1;
	else
		opts.nextSlide = opts.startingSlide >= (els.length-1) ? 0 : opts.startingSlide+1;

	// run transition init fn
	if (!opts.multiFx) {
		var init = $.fn.cycle.transitions[opts.fx];
		if ($.isFunction(init))
			init($cont, $slides, opts);
		else if (opts.fx != 'custom' && !opts.multiFx) {
			log('unknown transition: ' + opts.fx,'; slideshow terminating');
			return false;
		}
	}

	// fire artificial events
	var e0 = $slides[first];
	if (opts.before.length)
		opts.before[0].apply(e0, [e0, e0, opts, true]);
	if (opts.after.length > 1)
		opts.after[1].apply(e0, [e0, e0, opts, true]);

	if (opts.next)
		$(opts.next).bind(opts.prevNextEvent,function(){return advance(opts,opts.rev?-1:1)});
	if (opts.prev)
		$(opts.prev).bind(opts.prevNextEvent,function(){return advance(opts,opts.rev?1:-1)});
	if (opts.pager || opts.pagerAnchorBuilder)
		buildPager(els,opts);

	exposeAddSlide(opts, els);

	return opts;
};

// save off original opts so we can restore after clearing state
function saveOriginalOpts(opts) {
	opts.original = { before: [], after: [] };
	opts.original.cssBefore = $.extend({}, opts.cssBefore);
	opts.original.cssAfter  = $.extend({}, opts.cssAfter);
	opts.original.animIn	= $.extend({}, opts.animIn);
	opts.original.animOut   = $.extend({}, opts.animOut);
	$.each(opts.before, function() { opts.original.before.push(this); });
	$.each(opts.after,  function() { opts.original.after.push(this); });
};

function supportMultiTransitions(opts) {
	var i, tx, txs = $.fn.cycle.transitions;
	// look for multiple effects
	if (opts.fx.indexOf(',') > 0) {
		opts.multiFx = true;
		opts.fxs = opts.fx.replace(/\s*/g,'').split(',');
		// discard any bogus effect names
		for (i=0; i < opts.fxs.length; i++) {
			var fx = opts.fxs[i];
			tx = txs[fx];
			if (!tx || !txs.hasOwnProperty(fx) || !$.isFunction(tx)) {
				log('discarding unknown transition: ',fx);
				opts.fxs.splice(i,1);
				i--;
			}
		}
		// if we have an empty list then we threw everything away!
		if (!opts.fxs.length) {
			log('No valid transitions named; slideshow terminating.');
			return false;
		}
	}
	else if (opts.fx == 'all') {  // auto-gen the list of transitions
		opts.multiFx = true;
		opts.fxs = [];
		for (p in txs) {
			tx = txs[p];
			if (txs.hasOwnProperty(p) && $.isFunction(tx))
				opts.fxs.push(p);
		}
	}
	if (opts.multiFx && opts.randomizeEffects) {
		// munge the fxs array to make effect selection random
		var r1 = Math.floor(Math.random() * 20) + 30;
		for (i = 0; i < r1; i++) {
			var r2 = Math.floor(Math.random() * opts.fxs.length);
			opts.fxs.push(opts.fxs.splice(r2,1)[0]);
		}
		debug('randomized fx sequence: ',opts.fxs);
	}
	return true;
};

// provide a mechanism for adding slides after the slideshow has started
function exposeAddSlide(opts, els) {
	opts.addSlide = function(newSlide, prepend) {
		var $s = $(newSlide), s = $s[0];
		if (!opts.autostopCount)
			opts.countdown++;
		els[prepend?'unshift':'push'](s);
		if (opts.els)
			opts.els[prepend?'unshift':'push'](s); // shuffle needs this
		opts.slideCount = els.length;

		$s.css('position','absolute');
		$s[prepend?'prependTo':'appendTo'](opts.$cont);

		if (prepend) {
			opts.currSlide++;
			opts.nextSlide++;
		}

		if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
			clearTypeFix($s);

		if (opts.fit && opts.width)
			$s.width(opts.width);
		if (opts.fit && opts.height && opts.height != 'auto')
			$slides.height(opts.height);
		s.cycleH = (opts.fit && opts.height) ? opts.height : $s.height();
		s.cycleW = (opts.fit && opts.width) ? opts.width : $s.width();

		$s.css(opts.cssBefore);

		if (opts.pager || opts.pagerAnchorBuilder)
			$.fn.cycle.createPagerAnchor(els.length-1, s, $(opts.pager), els, opts);

		if ($.isFunction(opts.onAddSlide))
			opts.onAddSlide($s);
		else
			$s.hide(); // default behavior
	};
}

// reset internal state; we do this on every pass in order to support multiple effects
$.fn.cycle.resetState = function(opts, fx) {
	fx = fx || opts.fx;
	opts.before = []; opts.after = [];
	opts.cssBefore = $.extend({}, opts.original.cssBefore);
	opts.cssAfter  = $.extend({}, opts.original.cssAfter);
	opts.animIn	= $.extend({}, opts.original.animIn);
	opts.animOut   = $.extend({}, opts.original.animOut);
	opts.fxFn = null;
	$.each(opts.original.before, function() { opts.before.push(this); });
	$.each(opts.original.after,  function() { opts.after.push(this); });

	// re-init
	var init = $.fn.cycle.transitions[fx];
	if ($.isFunction(init))
		init(opts.$cont, $(opts.elements), opts);
};

// this is the main engine fn, it handles the timeouts, callbacks and slide index mgmt
function go(els, opts, manual, fwd) {
	// opts.busy is true if we're in the middle of an animation
	if (manual && opts.busy && opts.manualTrump) {
		// let manual transitions requests trump active ones
		debug('manualTrump in go(), stopping active transition');
		$(els).stop(true,true);
		opts.busy = false;
	}
	// don't begin another timeout-based transition if there is one active
	if (opts.busy) {
		debug('transition active, ignoring new tx request');
		return;
	}

	var p = opts.$cont[0], curr = els[opts.currSlide], next = els[opts.nextSlide];

	// stop cycling if we have an outstanding stop request
	if (p.cycleStop != opts.stopCount || p.cycleTimeout === 0 && !manual)
		return;

	// check to see if we should stop cycling based on autostop options
	if (!manual && !p.cyclePause && !opts.bounce &&
		((opts.autostop && (--opts.countdown <= 0)) ||
		(opts.nowrap && !opts.random && opts.nextSlide < opts.currSlide))) {
		if (opts.end)
			opts.end(opts);
		return;
	}

	// if slideshow is paused, only transition on a manual trigger
	var changed = false;
	if ((manual || !p.cyclePause) && (opts.nextSlide != opts.currSlide)) {
		changed = true;
		var fx = opts.fx;
		// keep trying to get the slide size if we don't have it yet
		curr.cycleH = curr.cycleH || $(curr).height();
		curr.cycleW = curr.cycleW || $(curr).width();
		next.cycleH = next.cycleH || $(next).height();
		next.cycleW = next.cycleW || $(next).width();

		// support multiple transition types
		if (opts.multiFx) {
			if (opts.lastFx == undefined || ++opts.lastFx >= opts.fxs.length)
				opts.lastFx = 0;
			fx = opts.fxs[opts.lastFx];
			opts.currFx = fx;
		}

		// one-time fx overrides apply to:  $('div').cycle(3,'zoom');
		if (opts.oneTimeFx) {
			fx = opts.oneTimeFx;
			opts.oneTimeFx = null;
		}

		$.fn.cycle.resetState(opts, fx);

		// run the before callbacks
		if (opts.before.length)
			$.each(opts.before, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});

		// stage the after callacks
		var after = function() {
			$.each(opts.after, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});
		};

		debug('tx firing; currSlide: ' + opts.currSlide + '; nextSlide: ' + opts.nextSlide);
		
		// get ready to perform the transition
		opts.busy = 1;
		if (opts.fxFn) // fx function provided?
			opts.fxFn(curr, next, opts, after, fwd, manual && opts.fastOnEvent);
		else if ($.isFunction($.fn.cycle[opts.fx])) // fx plugin ?
			$.fn.cycle[opts.fx](curr, next, opts, after, fwd, manual && opts.fastOnEvent);
		else
			$.fn.cycle.custom(curr, next, opts, after, fwd, manual && opts.fastOnEvent);
	}

	if (changed || opts.nextSlide == opts.currSlide) {
		// calculate the next slide
		opts.lastSlide = opts.currSlide;
		if (opts.random) {
			opts.currSlide = opts.nextSlide;
			if (++opts.randomIndex == els.length)
				opts.randomIndex = 0;
			opts.nextSlide = opts.randomMap[opts.randomIndex];
			if (opts.nextSlide == opts.currSlide)
				opts.nextSlide = (opts.currSlide == opts.slideCount - 1) ? 0 : opts.currSlide + 1;
		}
		else if (opts.backwards) {
			var roll = (opts.nextSlide - 1) < 0;
			if (roll && opts.bounce) {
				opts.backwards = !opts.backwards;
				opts.nextSlide = 1;
				opts.currSlide = 0;
			}
			else {
				opts.nextSlide = roll ? (els.length-1) : opts.nextSlide-1;
				opts.currSlide = roll ? 0 : opts.nextSlide+1;
			}
		}
		else { // sequence
			var roll = (opts.nextSlide + 1) == els.length;
			if (roll && opts.bounce) {
				opts.backwards = !opts.backwards;
				opts.nextSlide = els.length-2;
				opts.currSlide = els.length-1;
			}
			else {
				opts.nextSlide = roll ? 0 : opts.nextSlide+1;
				opts.currSlide = roll ? els.length-1 : opts.nextSlide-1;
			}
		}
	}
	if (changed && opts.pager)
		opts.updateActivePagerLink(opts.pager, opts.currSlide, opts.activePagerClass);
	
	// stage the next transition
	var ms = 0;
	if (opts.timeout && !opts.continuous)
		ms = getTimeout(els[opts.currSlide], els[opts.nextSlide], opts, fwd);
	else if (opts.continuous && p.cyclePause) // continuous shows work off an after callback, not this timer logic
		ms = 10;
	if (ms > 0)
		p.cycleTimeout = setTimeout(function(){ go(els, opts, 0, (!opts.rev && !opts.backwards)) }, ms);
};

// invoked after transition
$.fn.cycle.updateActivePagerLink = function(pager, currSlide, clsName) {
   $(pager).each(function() {
       $(this).children().removeClass(clsName).eq(currSlide).addClass(clsName);
   });
};

// calculate timeout value for current transition
function getTimeout(curr, next, opts, fwd) {
	if (opts.timeoutFn) {
		// call user provided calc fn
		var t = opts.timeoutFn.call(curr,curr,next,opts,fwd);
		while ((t - opts.speed) < 250) // sanitize timeout
			t += opts.speed;
		debug('calculated timeout: ' + t + '; speed: ' + opts.speed);
		if (t !== false)
			return t;
	}
	return opts.timeout;
};

// expose next/prev function, caller must pass in state
$.fn.cycle.next = function(opts) { advance(opts, opts.rev?-1:1); };
$.fn.cycle.prev = function(opts) { advance(opts, opts.rev?1:-1);};

// advance slide forward or back
function advance(opts, val) {
	var els = opts.elements;
	var p = opts.$cont[0], timeout = p.cycleTimeout;
	if (timeout) {
		clearTimeout(timeout);
		p.cycleTimeout = 0;
	}
	if (opts.random && val < 0) {
		// move back to the previously display slide
		opts.randomIndex--;
		if (--opts.randomIndex == -2)
			opts.randomIndex = els.length-2;
		else if (opts.randomIndex == -1)
			opts.randomIndex = els.length-1;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else if (opts.random) {
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else {
		opts.nextSlide = opts.currSlide + val;
		if (opts.nextSlide < 0) {
			if (opts.nowrap) return false;
			opts.nextSlide = els.length - 1;
		}
		else if (opts.nextSlide >= els.length) {
			if (opts.nowrap) return false;
			opts.nextSlide = 0;
		}
	}

	var cb = opts.onPrevNextEvent || opts.prevNextClick; // prevNextClick is deprecated
	if ($.isFunction(cb))
		cb(val > 0, opts.nextSlide, els[opts.nextSlide]);
	go(els, opts, 1, val>=0);
	return false;
};

function buildPager(els, opts) {
	var $p = $(opts.pager);
	$.each(els, function(i,o) {
		$.fn.cycle.createPagerAnchor(i,o,$p,els,opts);
	});
	opts.updateActivePagerLink(opts.pager, opts.startingSlide, opts.activePagerClass);
};

$.fn.cycle.createPagerAnchor = function(i, el, $p, els, opts) {
	var a;
	if ($.isFunction(opts.pagerAnchorBuilder)) {
		a = opts.pagerAnchorBuilder(i,el);
		debug('pagerAnchorBuilder('+i+', el) returned: ' + a);
	}
	else
		a = '<a href="#">'+(i+1)+'</a>';
		
	if (!a)
		return;
	var $a = $(a);
	// don't reparent if anchor is in the dom
	if ($a.parents('body').length === 0) {
		var arr = [];
		if ($p.length > 1) {
			$p.each(function() {
				var $clone = $a.clone(true);
				$(this).append($clone);
				arr.push($clone[0]);
			});
			$a = $(arr);
		}
		else {
			$a.appendTo($p);
		}
	}

	opts.pagerAnchors =  opts.pagerAnchors || [];
	opts.pagerAnchors.push($a);
	$a.bind(opts.pagerEvent, function(e) {
		e.preventDefault();
		opts.nextSlide = i;
		var p = opts.$cont[0], timeout = p.cycleTimeout;
		if (timeout) {
			clearTimeout(timeout);
			p.cycleTimeout = 0;
		}
		var cb = opts.onPagerEvent || opts.pagerClick; // pagerClick is deprecated
		if ($.isFunction(cb))
			cb(opts.nextSlide, els[opts.nextSlide]);
		go(els,opts,1,opts.currSlide < i); // trigger the trans
//		return false; // <== allow bubble
	});
	
	if ( ! /^click/.test(opts.pagerEvent) && !opts.allowPagerClickBubble)
		$a.bind('click.cycle', function(){return false;}); // suppress click
	
	if (opts.pauseOnPagerHover)
		$a.hover(function() { opts.$cont[0].cyclePause++; }, function() { opts.$cont[0].cyclePause--; } );
};

// helper fn to calculate the number of slides between the current and the next
$.fn.cycle.hopsFromLast = function(opts, fwd) {
	var hops, l = opts.lastSlide, c = opts.currSlide;
	if (fwd)
		hops = c > l ? c - l : opts.slideCount - l;
	else
		hops = c < l ? l - c : l + opts.slideCount - c;
	return hops;
};

// fix clearType problems in ie6 by setting an explicit bg color
// (otherwise text slides look horrible during a fade transition)
function clearTypeFix($slides) {
	debug('applying clearType background-color hack');
	function hex(s) {
		s = parseInt(s).toString(16);
		return s.length < 2 ? '0'+s : s;
	};
	function getBg(e) {
		for ( ; e && e.nodeName.toLowerCase() != 'html'; e = e.parentNode) {
			var v = $.css(e,'background-color');
			if (v.indexOf('rgb') >= 0 ) {
				var rgb = v.match(/\d+/g);
				return '#'+ hex(rgb[0]) + hex(rgb[1]) + hex(rgb[2]);
			}
			if (v && v != 'transparent')
				return v;
		}
		return '#ffffff';
	};
	$slides.each(function() { $(this).css('background-color', getBg(this)); });
};

// reset common props before the next transition
$.fn.cycle.commonReset = function(curr,next,opts,w,h,rev) {
	$(opts.elements).not(curr).hide();
	opts.cssBefore.opacity = 1;
	opts.cssBefore.display = 'block';
	if (w !== false && next.cycleW > 0)
		opts.cssBefore.width = next.cycleW;
	if (h !== false && next.cycleH > 0)
		opts.cssBefore.height = next.cycleH;
	opts.cssAfter = opts.cssAfter || {};
	opts.cssAfter.display = 'none';
	$(curr).css('zIndex',opts.slideCount + (rev === true ? 1 : 0));
	$(next).css('zIndex',opts.slideCount + (rev === true ? 0 : 1));
};

// the actual fn for effecting a transition
$.fn.cycle.custom = function(curr, next, opts, cb, fwd, speedOverride) {
	var $l = $(curr), $n = $(next);
	var speedIn = opts.speedIn, speedOut = opts.speedOut, easeIn = opts.easeIn, easeOut = opts.easeOut;
	$n.css(opts.cssBefore);
	if (speedOverride) {
		if (typeof speedOverride == 'number')
			speedIn = speedOut = speedOverride;
		else
			speedIn = speedOut = 1;
		easeIn = easeOut = null;
	}
	var fn = function() {$n.animate(opts.animIn, speedIn, easeIn, cb)};
	$l.animate(opts.animOut, speedOut, easeOut, function() {
		if (opts.cssAfter) $l.css(opts.cssAfter);
		if (!opts.sync) fn();
	});
	if (opts.sync) fn();
};

// transition definitions - only fade is defined here, transition pack defines the rest
$.fn.cycle.transitions = {
	fade: function($cont, $slides, opts) {
		$slides.not(':eq('+opts.currSlide+')').css('opacity',0);
		opts.before.push(function(curr,next,opts) {
			$.fn.cycle.commonReset(curr,next,opts);
			opts.cssBefore.opacity = 0;
		});
		opts.animIn	   = { opacity: 1 };
		opts.animOut   = { opacity: 0 };
		opts.cssBefore = { top: 0, left: 0 };
	}
};

$.fn.cycle.ver = function() { return ver; };

// override these globally if you like (they are all optional)
$.fn.cycle.defaults = {
	fx:			  'fade', // name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle')
	timeout:	   4000,  // milliseconds between slide transitions (0 to disable auto advance)
	timeoutFn:     null,  // callback for determining per-slide timeout value:  function(currSlideElement, nextSlideElement, options, forwardFlag)
	continuous:	   0,	  // true to start next transition immediately after current one completes
	speed:		   1000,  // speed of the transition (any valid fx speed value)
	speedIn:	   null,  // speed of the 'in' transition
	speedOut:	   null,  // speed of the 'out' transition
	next:		   null,  // selector for element to use as event trigger for next slide
	prev:		   null,  // selector for element to use as event trigger for previous slide
//	prevNextClick: null,  // @deprecated; please use onPrevNextEvent instead
	onPrevNextEvent: null,  // callback fn for prev/next events: function(isNext, zeroBasedSlideIndex, slideElement)
	prevNextEvent:'click.cycle',// event which drives the manual transition to the previous or next slide
	pager:		   null,  // selector for element to use as pager container
	//pagerClick   null,  // @deprecated; please use onPagerEvent instead
	onPagerEvent:  null,  // callback fn for pager events: function(zeroBasedSlideIndex, slideElement)
	pagerEvent:	  'click.cycle', // name of event which drives the pager navigation
	allowPagerClickBubble: false, // allows or prevents click event on pager anchors from bubbling
	pagerAnchorBuilder: null, // callback fn for building anchor links:  function(index, DOMelement)
	before:		   null,  // transition callback (scope set to element to be shown):	 function(currSlideElement, nextSlideElement, options, forwardFlag)
	after:		   null,  // transition callback (scope set to element that was shown):  function(currSlideElement, nextSlideElement, options, forwardFlag)
	end:		   null,  // callback invoked when the slideshow terminates (use with autostop or nowrap options): function(options)
	easing:		   null,  // easing method for both in and out transitions
	easeIn:		   null,  // easing for "in" transition
	easeOut:	   null,  // easing for "out" transition
	shuffle:	   null,  // coords for shuffle animation, ex: { top:15, left: 200 }
	animIn:		   null,  // properties that define how the slide animates in
	animOut:	   null,  // properties that define how the slide animates out
	cssBefore:	   null,  // properties that define the initial state of the slide before transitioning in
	cssAfter:	   null,  // properties that defined the state of the slide after transitioning out
	fxFn:		   null,  // function used to control the transition: function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag)
	height:		  'auto', // container height
	startingSlide: 0,	  // zero-based index of the first slide to be displayed
	sync:		   1,	  // true if in/out transitions should occur simultaneously
	random:		   0,	  // true for random, false for sequence (not applicable to shuffle fx)
	fit:		   0,	  // force slides to fit container
	containerResize: 1,	  // resize container to fit largest slide
	pause:		   0,	  // true to enable "pause on hover"
	pauseOnPagerHover: 0, // true to pause when hovering over pager link
	autostop:	   0,	  // true to end slideshow after X transitions (where X == slide count)
	autostopCount: 0,	  // number of transitions (optionally used with autostop to define X)
	delay:		   0,	  // additional delay (in ms) for first transition (hint: can be negative)
	slideExpr:	   null,  // expression for selecting slides (if something other than all children is required)
	cleartype:	   !$.support.opacity,  // true if clearType corrections should be applied (for IE)
	cleartypeNoBg: false, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
	nowrap:		   0,	  // true to prevent slideshow from wrapping
	fastOnEvent:   0,	  // force fast transitions when triggered manually (via pager or prev/next); value == time in ms
	randomizeEffects: 1,  // valid when multiple effects are used; true to make the effect sequence random
	rev:		   0,	 // causes animations to transition in reverse
	manualTrump:   true,  // causes manual transition to stop an active transition instead of being ignored
	requeueOnImageNotLoaded: true, // requeue the slideshow if any image slides are not yet loaded
	requeueTimeout: 250,  // ms delay for requeue
	activePagerClass: 'activeSlide', // class name used for the active pager link
	updateActivePagerLink: null, // callback fn invoked to update the active pager link (adds/removes activePagerClass style)
	backwards:     false  // true to start slideshow at last slide and move backwards through the stack
};

})(jQuery);


/*!
 * jQuery Cycle Plugin Transition Definitions
 * This script is a plugin for the jQuery Cycle Plugin
 * Examples and documentation at: http://malsup.com/jquery/cycle/
 * Copyright (c) 2007-2010 M. Alsup
 * Version:	 2.72
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
(function($) {

//
// These functions define one-time slide initialization for the named
// transitions. To save file size feel free to remove any of these that you
// don't need.
//
$.fn.cycle.transitions.none = function($cont, $slides, opts) {
	opts.fxFn = function(curr,next,opts,after){
		$(next).show();
		$(curr).hide();
		after();
	};
}

// scrollUp/Down/Left/Right
$.fn.cycle.transitions.scrollUp = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssBefore ={ top: h, left: 0 };
	opts.cssFirst = { top: 0 };
	opts.animIn	  = { top: 0 };
	opts.animOut  = { top: -h };
};
$.fn.cycle.transitions.scrollDown = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssFirst = { top: 0 };
	opts.cssBefore= { top: -h, left: 0 };
	opts.animIn	  = { top: 0 };
	opts.animOut  = { top: h };
};
$.fn.cycle.transitions.scrollLeft = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { left: w, top: 0 };
	opts.animIn	  = { left: 0 };
	opts.animOut  = { left: 0-w };
};
$.fn.cycle.transitions.scrollRight = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { left: -w, top: 0 };
	opts.animIn	  = { left: 0 };
	opts.animOut  = { left: w };
};
$.fn.cycle.transitions.scrollHorz = function($cont, $slides, opts) {
	$cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts, fwd) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.left = fwd ? (next.cycleW-1) : (1-next.cycleW);
		opts.animOut.left = fwd ? -curr.cycleW : curr.cycleW;
	});
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { top: 0 };
	opts.animIn   = { left: 0 };
	opts.animOut  = { top: 0 };
};
$.fn.cycle.transitions.scrollVert = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push(function(curr, next, opts, fwd) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.top = fwd ? (1-next.cycleH) : (next.cycleH-1);
		opts.animOut.top = fwd ? curr.cycleH : -curr.cycleH;
	});
	opts.cssFirst = { top: 0 };
	opts.cssBefore= { left: 0 };
	opts.animIn   = { top: 0 };
	opts.animOut  = { left: 0 };
};

// slideX/slideY
$.fn.cycle.transitions.slideX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore = { left: 0, top: 0, width: 0 };
	opts.animIn	 = { width: 'show' };
	opts.animOut = { width: 0 };
};
$.fn.cycle.transitions.slideY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
	});
	opts.cssBefore = { left: 0, top: 0, height: 0 };
	opts.animIn	 = { height: 'show' };
	opts.animOut = { height: 0 };
};

// shuffle
$.fn.cycle.transitions.shuffle = function($cont, $slides, opts) {
	var i, w = $cont.css('overflow', 'visible').width();
	$slides.css({left: 0, top: 0});
	opts.before.push(function(curr,next,opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
	});
	// only adjust speed once!
	if (!opts.speedAdjusted) {
		opts.speed = opts.speed / 2; // shuffle has 2 transitions
		opts.speedAdjusted = true;
	}
	opts.random = 0;
	opts.shuffle = opts.shuffle || {left:-w, top:15};
	opts.els = [];
	for (i=0; i < $slides.length; i++)
		opts.els.push($slides[i]);

	for (i=0; i < opts.currSlide; i++)
		opts.els.push(opts.els.shift());

	// custom transition fn (hat tip to Benjamin Sterling for this bit of sweetness!)
	opts.fxFn = function(curr, next, opts, cb, fwd) {
		var $el = fwd ? $(curr) : $(next);
		$(next).css(opts.cssBefore);
		var count = opts.slideCount;
		$el.animate(opts.shuffle, opts.speedIn, opts.easeIn, function() {
			var hops = $.fn.cycle.hopsFromLast(opts, fwd);
			for (var k=0; k < hops; k++)
				fwd ? opts.els.push(opts.els.shift()) : opts.els.unshift(opts.els.pop());
			if (fwd) {
				for (var i=0, len=opts.els.length; i < len; i++)
					$(opts.els[i]).css('z-index', len-i+count);
			}
			else {
				var z = $(curr).css('z-index');
				$el.css('z-index', parseInt(z)+1+count);
			}
			$el.animate({left:0, top:0}, opts.speedOut, opts.easeOut, function() {
				$(fwd ? this : curr).hide();
				if (cb) cb();
			});
		});
	};
	opts.cssBefore = { display: 'block', opacity: 1, top: 0, left: 0 };
};

// turnUp/Down/Left/Right
$.fn.cycle.transitions.turnUp = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = next.cycleH;
		opts.animIn.height = next.cycleH;
	});
	opts.cssFirst  = { top: 0 };
	opts.cssBefore = { left: 0, height: 0 };
	opts.animIn	   = { top: 0 };
	opts.animOut   = { height: 0 };
};
$.fn.cycle.transitions.turnDown = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssFirst  = { top: 0 };
	opts.cssBefore = { left: 0, top: 0, height: 0 };
	opts.animOut   = { height: 0 };
};
$.fn.cycle.transitions.turnLeft = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = next.cycleW;
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore = { top: 0, width: 0  };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { width: 0 };
};
$.fn.cycle.transitions.turnRight = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
		opts.animOut.left = curr.cycleW;
	});
	opts.cssBefore = { top: 0, left: 0, width: 0 };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { width: 0 };
};

// zoom
$.fn.cycle.transitions.zoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.cssBefore.left = next.cycleW/2;
		opts.animIn	   = { top: 0, left: 0, width: next.cycleW, height: next.cycleH };
		opts.animOut   = { width: 0, height: 0, top: curr.cycleH/2, left: curr.cycleW/2 };
	});
	opts.cssFirst = { top:0, left: 0 };
	opts.cssBefore = { width: 0, height: 0 };
};

// fadeZoom
$.fn.cycle.transitions.fadeZoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false);
		opts.cssBefore.left = next.cycleW/2;
		opts.cssBefore.top = next.cycleH/2;
		opts.animIn	= { top: 0, left: 0, width: next.cycleW, height: next.cycleH };
	});
	opts.cssBefore = { width: 0, height: 0 };
	opts.animOut  = { opacity: 0 };
};

// blindX
$.fn.cycle.transitions.blindX = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.width = next.cycleW;
		opts.animOut.left   = curr.cycleW;
	});
	opts.cssBefore = { left: w, top: 0 };
	opts.animIn = { left: 0 };
	opts.animOut  = { left: w };
};
// blindY
$.fn.cycle.transitions.blindY = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore = { top: h, left: 0 };
	opts.animIn = { top: 0 };
	opts.animOut  = { top: h };
};
// blindZ
$.fn.cycle.transitions.blindZ = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	var w = $cont.width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore = { top: h, left: w };
	opts.animIn = { top: 0, left: 0 };
	opts.animOut  = { top: h, left: w };
};

// growX - grow horizontally from centered 0 width
$.fn.cycle.transitions.growX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = this.cycleW/2;
		opts.animIn = { left: 0, width: this.cycleW };
		opts.animOut = { left: 0 };
	});
	opts.cssBefore = { width: 0, top: 0 };
};
// growY - grow vertically from centered 0 height
$.fn.cycle.transitions.growY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = this.cycleH/2;
		opts.animIn = { top: 0, height: this.cycleH };
		opts.animOut = { top: 0 };
	});
	opts.cssBefore = { height: 0, left: 0 };
};

// curtainX - squeeze in both edges horizontally
$.fn.cycle.transitions.curtainX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true,true);
		opts.cssBefore.left = next.cycleW/2;
		opts.animIn = { left: 0, width: this.cycleW };
		opts.animOut = { left: curr.cycleW/2, width: 0 };
	});
	opts.cssBefore = { top: 0, width: 0 };
};
// curtainY - squeeze in both edges vertically
$.fn.cycle.transitions.curtainY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.animIn = { top: 0, height: next.cycleH };
		opts.animOut = { top: curr.cycleH/2, height: 0 };
	});
	opts.cssBefore = { left: 0, height: 0 };
};

// cover - curr slide covered by next slide
$.fn.cycle.transitions.cover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		if (d == 'right')
			opts.cssBefore.left = -w;
		else if (d == 'up')
			opts.cssBefore.top = h;
		else if (d == 'down')
			opts.cssBefore.top = -h;
		else
			opts.cssBefore.left = w;
	});
	opts.animIn = { left: 0, top: 0};
	opts.animOut = { opacity: 1 };
	opts.cssBefore = { top: 0, left: 0 };
};

// uncover - curr slide moves off next slide
$.fn.cycle.transitions.uncover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		if (d == 'right')
			opts.animOut.left = w;
		else if (d == 'up')
			opts.animOut.top = -h;
		else if (d == 'down')
			opts.animOut.top = h;
		else
			opts.animOut.left = -w;
	});
	opts.animIn = { left: 0, top: 0 };
	opts.animOut = { opacity: 1 };
	opts.cssBefore = { top: 0, left: 0 };
};

// toss - move top slide and fade away
$.fn.cycle.transitions.toss = function($cont, $slides, opts) {
	var w = $cont.css('overflow','visible').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		// provide default toss settings if animOut not provided
		if (!opts.animOut.left && !opts.animOut.top)
			opts.animOut = { left: w*2, top: -h/2, opacity: 0 };
		else
			opts.animOut.opacity = 0;
	});
	opts.cssBefore = { left: 0, top: 0 };
	opts.animIn = { left: 0 };
};

// wipe - clip animation
$.fn.cycle.transitions.wipe = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.cssBefore = opts.cssBefore || {};
	var clip;
	if (opts.clip) {
		if (/l2r/.test(opts.clip))
			clip = 'rect(0px 0px '+h+'px 0px)';
		else if (/r2l/.test(opts.clip))
			clip = 'rect(0px '+w+'px '+h+'px '+w+'px)';
		else if (/t2b/.test(opts.clip))
			clip = 'rect(0px '+w+'px 0px 0px)';
		else if (/b2t/.test(opts.clip))
			clip = 'rect('+h+'px '+w+'px '+h+'px 0px)';
		else if (/zoom/.test(opts.clip)) {
			var top = parseInt(h/2);
			var left = parseInt(w/2);
			clip = 'rect('+top+'px '+left+'px '+top+'px '+left+'px)';
		}
	}

	opts.cssBefore.clip = opts.cssBefore.clip || clip || 'rect(0px 0px 0px 0px)';

	var d = opts.cssBefore.clip.match(/(\d+)/g);
	var t = parseInt(d[0]), r = parseInt(d[1]), b = parseInt(d[2]), l = parseInt(d[3]);

	opts.before.push(function(curr, next, opts) {
		if (curr == next) return;
		var $curr = $(curr), $next = $(next);
		$.fn.cycle.commonReset(curr,next,opts,true,true,false);
		opts.cssAfter.display = 'block';

		var step = 1, count = parseInt((opts.speedIn / 13)) - 1;
		(function f() {
			var tt = t ? t - parseInt(step * (t/count)) : 0;
			var ll = l ? l - parseInt(step * (l/count)) : 0;
			var bb = b < h ? b + parseInt(step * ((h-b)/count || 1)) : h;
			var rr = r < w ? r + parseInt(step * ((w-r)/count || 1)) : w;
			$next.css({ clip: 'rect('+tt+'px '+rr+'px '+bb+'px '+ll+'px)' });
			(step++ <= count) ? setTimeout(f, 13) : $curr.css('display', 'none');
		})();
	});
	opts.cssBefore = { display: 'block', opacity: 1, top: 0, left: 0 };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { left: 0 };
};

})(jQuery);