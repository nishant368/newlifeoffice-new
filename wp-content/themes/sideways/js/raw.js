
function show_share() { 
	jQuery('#share-box').fadeIn(200) ; 
}

function hide_share() { 
	jQuery('#share-box').fadeOut(200) ; 
}

function mainmenu(){
	jQuery("#navigation a").removeAttr("title");
	jQuery("#navigation ul").css({display: "none"}); // Opera Fix
	jQuery("#navigation li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible", display: "none"}).show(400);
		},function(){
			jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
}

function setWidth() {
	
	var width = 0;
	jQuery('#article-list .article-wrapper').each(function() {
		width += jQuery(this).outerWidth( true );
	});
	jQuery('#article-list').css('width', width);
	
}

jQuery(document).ready(function($) {
	
	mainmenu(); // Navigation
	
	// Set article list container width
	setWidth();
	
	// Remove title tags
	$("img.wp-post-image").removeAttr("title");
	
	// IE FIXES
	$("#navigation li:last-child").addClass("ie-last-child-fix");

	
// -----------------------------
//	SOCIAL BUTTON
// -----------------------------


	// Social box animation
	$('.share-button').mouseenter(function() {
		show_share()
	});

	$('#share').mouseleave(function() {
		hide_share();
	});
	
	// Social buttons animation
	$('#share-box a, .social-button-holder a').hover(function(){
		$(this).stop().animate({ opacity : 0.5 }, 200 );
		},
		function () {
			$(this).stop().animate({ opacity : 1 }, 200 );
		}
	);

	
// -----------------------------
//	NAVIGATON MENU ANIMATON
// -----------------------------

	// Nav menu collapse
	$("#expand-button").click(function () {   		
		$(this).toggleClass('collapse').parent('nav').find('ul').slideToggle();
	});

	
// -----------------------------
//	TOGGLE CONTENT
// -----------------------------


	$(".expanding .expand-button").click(function () {
		$(this).toggleClass('close').parent('div').find('.expand').slideToggle('slow');
	});
	
	
// -----------------------------
//	LIGHTBOX IMAGE LINK HOVERS
// -----------------------------
	
	
	// 50% opacity (lightbox items)
	$('.hover_50').hover(function(){
		$('img', this).stop().animate({ opacity : 0.5 }, 500 );
		},
		function () {
			$('img', this).stop().animate({ opacity : 1 }, 500 );
		}
	);
	
	// 0% opacity
	$('.hover_100').hover(function(){
		$('img', this).stop().animate({ opacity : 0 }, 500 );
		},
		function () {
			$('img', this).stop().animate({ opacity : 1 }, 500 );
		}
	);
	

// -----------------------------
//	PORTFOLIO SORTING
// -----------------------------
	
	
	// Horizontal Portfolio Sorting
	$('ul#filter.fixed a').click(function() {
		$('.article-wrapper').fadeOut(500);
		
		$('ul#filter .current').removeClass('current');
		$(this).parent().addClass('current');

		var filterVal = this.getAttribute('title') ;
		
		if(filterVal === 'all') {
			
			$('.article-wrapper.hidden').animate({foo: 1}, 499).fadeIn(500);
			$('.article-wrapper').fadeIn(500);
			$('.article-wrapper').removeClass('hidden');
			
			var width = 0;
			$('.article-wrapper').each(function() {
				width += $(this).outerWidth( true );
			});
			$('#article-list').css('width', width);	
			
		} else {
		
			$('.article-wrapper').each(function() {
				if(!$(this).hasClass(filterVal)) {
					$(this).addClass('hidden');
				} else {
					$(this).animate({foo: 1}, 499).fadeIn(500);
					$(this).removeClass('hidden');
				}
			});
			
			var width = 0;
			$('.article-wrapper:not(.hidden)').each(function() {
				width += $(this).outerWidth( true );
			});
			$('#article-list').css('width', width);		
			
		}

		return false;

	});
	
	// Grid Portfolio Sorting
	$('ul#filter a').click(function() {
		$('#portfolio li').fadeOut(500);
		
		$('ul#filter .current').removeClass('current');
		$(this).parent().addClass('current');

		var filterVal = this.getAttribute('title') ;
		
		if(filterVal === 'all') {
			$('#portfolio li.hidden').animate({foo: 1}, 499).fadeIn(500);
			$('#portfolio li').fadeIn(500);
			$('#portfolio li.hidden').removeClass('hidden');
		} else {
			$('#portfolio li').each(function() {
				if(!$(this).hasClass(filterVal)) {
					$(this).addClass('hidden');
				} else {
					$(this).animate({foo: 1}, 499).fadeIn(500);
					$(this).removeClass('hidden');
				}
			});
		}

		return false;

	});

	
// -----------------------------
//	GALLERY SHORTCODE FADE
// -----------------------------

	$('.gallery-item').hover(function(){
		$('img', this).stop().animate({ opacity : 0.5 }, 500 );
		$('.gallery-caption', this).stop().animate({ opacity : 0 }, 500 );
		},
		function () {
			$('img', this).stop().animate({ opacity : 1 }, 500 );
			$('.gallery-caption', this).stop().animate({ opacity : 1 }, 500 );
		}
	);
	
	// Add prettyphoto rel to links
	$('.gallery-icon a').attr('rel', 'prettyPhoto[1]');
	
// -----------------------------
//	COMMENT FORM VALIDATION
// -----------------------------
	
	// Setup
	var hasMessageError = false;
	var hasNameError = false;
	var hasEmailError = false;
	
	if (document.getElementById("comments")) { 
		hasMessageError = true;
	};
	
	if (document.getElementById("contactName")) { 
		hasNameError = true;
	};
	
	if (document.getElementById("email")) { 
		hasEmailError = true;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	};
	
	// Validation
	$("#commentForm #commentsText").blur(function(){				   				   
		$("#comment-error").remove();
		hasMessageError = false;
		
		var messageVal = $("#commentsText").val();
		if(messageVal === '') {
			$('#commentsText').css( 'border', '2px solid #CC0000' );
			hasMessageError = true;
		}
		
		if(hasMessageError === false){
			$('#commentsText').css('border', 'none');
		}
	});
	
	$("#commentForm #contactName").blur(function(){					   				   
		$("#author-error").remove();
		hasNameError = false;
		
		var authorVal = $("#contactName").val();
		if(authorVal === '') {
			$('#contactName').css( 'border', '2px solid #CC0000' );
			hasNameError = true;
		}
		
		if(hasNameError === false){
			$('#contactName').css('border', 'none');
		}
		
	});
	
	$("#commentForm #email").blur(function(){					   				   
		$("#email-error").remove();
		hasEmailError = false;
		
		var emailVal = $("#email").val();
		if(emailVal === '') {
			$('#email').css( 'border', '2px solid #CC0000' );
			hasEmailError = true;
		} else if (!emailReg.test(emailVal)) {
			$('#email').css( 'border', '2px solid #CC0000' );
			hasEmailError = true;
		}
		
		if(hasEmailError === false){
			$('#email').css('border', 'none');
		}
	});
	
	//Comment Form Submit
	$('#commentForm').submit(function() {
	
		var messageVal = $("#commentsText").val();
		var authorVal = $("#contactName").val();
		var emailVal = $("#email").val();
		
		if (hasMessageError === false && hasNameError === false && hasEmailError === false) {
			
			if ( url.value === 'Website' ){ 
				url.value = '';
			}
			
			window.navigate("#");
			
		} else {
		
			return false;
		
		}	
		
	});
	
});	