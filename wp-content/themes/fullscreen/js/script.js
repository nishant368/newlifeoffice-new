// Jquery no conflict mode
$j = jQuery.noConflict();

/* ******************************************************************************************
 * Bootstrap
 * ******************************************************************************************/
$j(window).load(function(){
   if(detectBrowser() == 'chrome' || detectBrowser() == 'safari'){
      Sliders();
   }
});

$j(document).ready(function() {
	
	FixTouchDevice();
	
	LeftBoxDescriptionHeight();
	
	FixContactForm();
	
	FixScrollbars();
	
	ShortcodeAction();
	
	GetCenterMaxWidth();
	
	ApplyFancybox();
	
	CheckSliderPage();
	
	InitCufon();
	  
	InitPixastic();
	//InitMainMenu();
			  
	//InitImages();
	  
	//InitMisc();
	  
	//InitPortfolio();
	
    InitScollbars();
    
    ShowSidebarWidget();
    
    RollUpContent();
    
    RollUpFooter();
    
    ShowSidebarThumbnails();
    
    //GenerateMessages(); 
    
    if(detectBrowser() == 'chrome' || detectBrowser() == 'safari'){
    } else {
      Sliders();
    }
	
	RollUpMenu();
	
	StartAnimation();

	HideShowAllContent();
	
	HideCenterBox();
	
	InitMisc();
	
	SetCenterBoxScrollerHeight();
	
	return false;
});
function detectBrowser(){
  var matches = navigator.userAgent.match(/[A-z]*[/][(0-9)+(.)*]*/g);
  var browser = "";
  var bstring = "";
  bstring += matches.toString();
  
  if(bstring.match(/(Safari)/)){
    if(bstring.match(/(Chrome)/)){
      browser = "chrome";
    } else {
      browser = "safari";
    }
  } else if (bstring.match(/(Firefox)/)){
    browser = "firefox";
  } else if (bstring.match(/(Opera)/)){
    browser = "opera";
  } else {
    if(navigator.appName == 'Microsoft Internet Explorer'){
      browser = "explorer";
    }
  }
  return browser;
}

function isTouchDevice(){
	try{
		document.createEvent("TouchEvent");
		return true;
	}catch(e){
		return false;
	}
}
function touchScroll(id){
	if(isTouchDevice()){ //if touch events exist...
		var el=document.getElementById(id);
		var scrollStartPos=0;

		document.getElementById(id).addEventListener("touchstart", function(event) {
			scrollStartPos=this.scrollTop+event.touches[0].pageY;
			//event.preventDefault();
		},false);

		document.getElementById(id).addEventListener("touchmove", function(event) {
			this.scrollTop=scrollStartPos-event.touches[0].pageY;
			event.preventDefault();
		},false);
	}
}
function touchScrollVertical(id){
	if(isTouchDevice()){ //if touch events exist...
		var el=document.getElementById(id);
		var scrollStartPos=0;

		document.getElementById(id).addEventListener("touchstart", function(event) {
			scrollStartPos=this.scrollLeft+event.touches[0].pageX;
			//event.preventDefault();
		},false);

		document.getElementById(id).addEventListener("touchmove", function(event) {
			this.scrollLeft=scrollStartPos-event.touches[0].pageX;
			event.preventDefault();
		},false);
	}
}
function FixTouchDevice(){
	
	if(isTouchDevice()){
		$j("div.dragger_container").css("display","none");	
		$j("div.customScrollBox").css("overflow","auto");
		
		if($j("body").has("#centerScrollBox").length){
			touchScroll("centerScrollBox");
		}
		if($j("body").has("#leftScrollBox").length){
			touchScroll("leftScrollBox");
		}
		if($j("body").has("#rightScrollBox").length){
			touchScroll("rightScrollBox");
		}
		if($j("body").has("#footerScrollBox").length){
			touchScrollVertical("footerScrollBox");
		}
	}
	
	/*
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad|android)/);
	if (agentID) {
 		iVersion = true;
		
		//main menu fix
		$j.each($j("div.mainmenu ul.menu > li > a"),function(){
			$j(this).attr("rel",$j(this).attr("href").toString());
		});
		
		$j("div.mainmenu ul.menu > li > a").attr("href","#");
		
		$j('div.mainmenu ul > li').bind('touchstart', function(){
			$j(this).find("> a").attr("href",$j(this).find("> a").attr("rel"));
    		$j('div.mainmenu ul > li ul').css("display","none");
			$j(this).find("ul").css("display","block");
		}).bind('touchend', function(){
    		$j("div.mainmenu ul.menu > li > a").attr("href","#");
		});
	}
	*/
}

function LeftBoxDescriptionHeight(){
	var imgHeight = $j('div.box-left div.special img').height();
	// padding
	imgHeight = imgHeight - 20;
	$j('div.box-left div.special div.spcdesc').css("min-height",imgHeight+"px");
}

// remove anchor from contact form
function FixContactForm(){
	if($j(".content").has(".wpcf7").length){
		var actionForm = $j(".wpcf7 form").attr("action").toString();
		actionForm = actionForm.replace(/#.*/m,"");
		$j(".wpcf7 form").attr("action",actionForm);
	}
}

// fix dynamically change of content size
function FixScrollbars(){
	if(!isTouchDevice()){
		// center box
		$j("#mcs2_container .content").resize(function(e){
			$j("#mcs2_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","yes",5);
		});
		// right box
		$j("#mcs_container .content").resize(function(e){
			SetSidebarScrollbar();
		});
		// left box
		$j("#mcs_container_left .content").resize(function(e){
			SetLeftSidebarScrollbar();
		});
	}
}

function ShortcodeAction(){
	$j(".content div.rule").click(function() {
		$j("#mcs2_container .container").css("top","0px");
		$j("#mcs2_container .dragger.ui-draggable").css("top","0px");
	});
}

function GetCenterMaxWidth(){
	if($j(".box-center").has("div.container").length){
		var maxWidth = $j(".box-center div.container").width();
		var maxWidthThumb = maxWidth-10;
		//$j(".box-center img").css("max-width",maxWidth+"px");
		setStyle("#imgMaxWidth",".box-center img { max-width: " + maxWidth + "px; } .box-center img.thumb { max-width: " + maxWidthThumb + "px; }");
		//$j(".box-center img.thumb").css("max-width",maxWidthThumb+"px");
	}
}

function setStyle(id, val)
{
	if($j.browser.msie) {
		var el = document.getElementById(id.replace('#', ''));
		el.styleSheet.cssText = val;		
	}
	else {
		$j(id).html(val);
	}
}

function ApplyFancybox(){
	// Apply fancybox on all images
	$j("a[href$='gif']").fancybox();
	$j("a[href$='jpg']").fancybox();
	$j("a[href$='png']").fancybox();
}

var isMinimized = false;
var minimizeAnim = false;

var defWidth = 0;
var defHeight = 0;
var defHalf = 0;

function HideCenterBox(){
	
	defHeight = $j('.central .part2 .box-center').height();
	
	$j('.part2 #hide-box').click(function(){
		// minimize
		if(!isMinimized && !minimizeAnim) {
			$j(this).attr("class","hide");
			defWidth = $j('.central .part2 .box-center').width();
			defHalf = (defWidth / 2) - 20;
			minimizeAnim = true;
			$j('.central .part2 .inside').hide();
			$j('.central .part2 .float').animate({"width": "31px" , "height" : "31px" }, 1500, "easeInOutExpo", function(){ isMinimized = true; minimizeAnim = false; });
		// maximize
		} else {
			$j(this).attr("class","show");
			$j('.central .part2 .float').animate({"width": "100%" , "height" : defHeight+"px" }, 1500, "easeInOutExpo", function(){ $j('.central .part2 .inside').show(); isMinimized = false; $j('.central .part2 .float').css("height","100%"); });
		}
	});
}

function StartAnimation(){
	if ( !($j.browser.msie) ) {
		if($j(".central").has(".part2.home-page").length){
			
			$j('.mainpage .header').css("top","-150px");
			$j('.mainpage .mainmenu').css("top","-150px");
			var footerHeight = $j('.footer').height();
			$j('.footer').css("bottom","-"+footerHeight+"px");
			
			$j('.mainpage .header').animate({"top": "0px"}, 1500, "easeInOutExpo");
			$j('.mainpage .mainmenu').animate({"top": "0px"}, 1500, "easeInOutExpo");
			
			$j('.footer').animate({"bottom": "0px"}, 1500, "easeInOutExpo");
			
			$j('.mainpage .central .part2').hide();
			$j('.mainpage .central .part2').fadeTo(1500, 1);
			
			var leftHeight = $j('.mainpage .central .part1 .box-left').height();
			$j('.mainpage .central .part1 .box-left').css("top",leftHeight+"px");
			$j('.mainpage .central .part1 .box-left').animate({"top": "0px"}, 1500, "easeInOutExpo");
			
			var rightHeight = $j('.mainpage .central .part3 .box-right').height();
			$j('.mainpage .central .part3 .box-right').css("top",rightHeight+"px");
			$j('.mainpage .central .part3 .box-right').animate({"top": "0px"}, 1500, "easeInOutExpo");			
	
		}
	}
}

function HideShowAllContent(){
	
	var contentHidden = false;
	var footerHeight = $j('.footer').height();
	var leftHeight = $j('.mainpage .central .part1 .box-left').height();
	var rightHeight = $j('.mainpage .central .part3 .box-right').height();
	var centerHeight = $j('.mainpage .central .part2 .box-center').height();
	leftHeight += 20;
	rightHeight += 20;
	centerHeight += 20;
	
	$j(' #show_hide_content_button ').click(function () {
		
		(contentHidden == true) ? contentHidden = false : contentHidden = true;
		
		if (contentHidden == false) {
			
			// set class
			$j(' #show_hide_content_button ').attr("class","show");
			
			$j('.mainpage .header').animate({"top": "0px"}, 1500, "easeInOutExpo");
			$j('.mainpage .mainmenu').animate({"top": "0px"}, 1500, "easeInOutExpo");
			$j('.mainpage .central .part2').show();
			/*
			if($j(".central").has(".part2.home-page").length){
				$j('.mainpage .central .part2').fadeTo("slow", 1);
			} else {
				$j('.mainpage .central .part2 .box-center').animate({"top": "0px"}, 1500, "easeInOutExpo");
			}
			*/
			$j('.footer').animate({"bottom": "0px"}, 1500, "easeInOutExpo");
			
			$j('.mainpage .central .part1 .box-left').show();
			$j('.mainpage .central .part3 .box-right').show();
			$j('.mainpage .central .part1 .box-left').animate({"top": "0px"}, 1500, "easeInOutExpo");
			$j('.mainpage .central .part3 .box-right').animate({"top": "0px"}, 1500, "easeInOutExpo");
        
        } else {
			
			// set class
			$j(' #show_hide_content_button ').attr("class","hide");
			
			$j('.mainpage .header').animate({"top": "-150px"}, 1500, "easeInOutExpo");
			$j('.mainpage .mainmenu').animate({"top": "-150px"}, 1500, "easeInOutExpo");
			$j('.mainpage .central .part2').hide();
			/*
			if($j(".central").has(".part2.home-page").length){
				$j('.mainpage .central .part2').fadeTo("slow", 0);
			} else {
				$j('.mainpage .central .part2 .box-center').animate({"top": "-"+centerHeight+"px"}, 1500, "easeInOutExpo");
			}
			*/
			$j('.footer').animate({"bottom": "-"+footerHeight+"px"}, 1500, "easeInOutExpo");
			$j('.mainpage .central .part1 .box-left').animate({"top": leftHeight+"px"}, 1500, "easeInOutExpo", function() { $j(this).hide(); });
			$j('.mainpage .central .part3 .box-right').animate({"top": rightHeight+"px"}, 1500, "easeInOutExpo", function() { $j(this).hide(); });
			
		}
	});
}	


var isSliderPage = false;

function CheckSliderPage(){
	if($j(".central .part2").has(".promo_slider").length){
		isSliderPage = true;
	}
}

function RollUpMenu(){
	$j(".mainmenu ul > li").hover(function(){
		var submenu = $j(this).find(' > ul');
		var submenuHeight = submenu.height();
		
		submenu.height("1px");
		
		$j(this).find(' > ul').stop().animate({
			height: submenuHeight
		}, 200);
	}, function(){
		
	});
}

// short bubble messages
var messages;
var lastRandom = 0;
var messagesTimer;
var hoverMessage = false;
var currentArea = 1;
var animShow = false;
var wasStopped = false;

var mTop = 0;
var mLeft = 0;
var mWidth = 0;
var mHeight = 0;
var norTop = 0;
var norLeft = 0;

var mouseInMessage = false;
var mouseX = 0;
var mouseY = 0;

function GenerateMessages(){
	if($j(".central .part2").has("#messages-container").length){
		$j(".central .part2 #messages-container .message-box").hide();
		$j(".central .part2 #messages-container .message-box .image").hide();
		
		// get messages
		var jsonMessages = $j('.central .part2 #messages-container #inputJSON').html();
		jsonMessages = jsonMessages.replace("<!--","");
		jsonMessages = jsonMessages.replace("-->","");
		
		messages = $j.parseJSON(jsonMessages);
		
		hoverMessage = false;
		
		GenerateMessagesInterval();
		
		/*
		if($j.trim($j(".central .part2 #messages-container #showMessages").text())=="yes"){
			messagesTimer = setInterval( "GenerateMessagesInterval()", 5000);
		}
		*/
		
		// hover message
		$j(".central .part2 #messages-container .message-box").hover(function(){
			
			
			//hoverMessage = true;
			
			/*
			if(!animShow){
				$j(this).stop(true,true);
				wasStopped = true;
			}
			*/
		}, function(){
			
			//hoverMessage = false;
			/*
			if(wasStopped){
				$j(this).delay(3000);
				hideMessageBox();
			}
			wasStopped = false;
			*/
		});
		
		
		var messageBox = $j(".central .part2 #messages-container .message-box");
		/*
		messageBox.bind('mouseover',function() {
			var mOffset = messageBox.offset();
			
			if((mouseX > mOffset.left-(mWidth/2)) && (mouseX < mOffset.left+(mWidth/2)+20) && (mouseY > (mOffset.top-mHeight)) && (mouseY < (mOffset.top+20))){
					
					messageBox.stop(true,true);
					
					wasStopped = true;
			}
		});
		*/
		messageBox.bind('mouseout',function() {
			if(wasStopped){
				$j(this).delay(3000);
				hideMessageBox();
				wasStopped = false;
			}
		});
		
		
		$j(document).mousemove(function(e){
			mouseX = e.pageX;
			mouseY = e.pageY;
		});
		
	}
}

function GenerateMessagesInterval(){
	if($j(".central .part2").has("#messages-container").length){
		animShow = true;
		// get random message
		var randomMessage = 0;
		if(messages.length>=2){
			do
			{
				randomMessage = Math.floor(Math.random()*messages.length);
			}
			while (lastRandom==randomMessage);
				
			lastRandom=randomMessage;	
		}
		// message values
		var mTitle = messages[randomMessage][0];
		var mLink = messages[randomMessage][1];
		var mText = messages[randomMessage][2];
		var mSign = messages[randomMessage][3];
		
		// get message-box object
		var messageBox = $j(".central .part2 #messages-container .message-box");
		
		// init message
		messageBox.find(".message a h2").html(mTitle);
		messageBox.find(".message a").attr("href",mLink);
		//Cufon.replace('.central .part2 #messages-container .message-box h2');
		messageBox.find(".message .text").html(mText);
		messageBox.find(".message .signature").html(mSign);
		
		messageBox.height("auto");
		messageBox.width("auto");
		
		// set scene
		var winHeight = $j(window).height();
		var centerBoxHeight = winHeight - 230 - $j(".footer").height() - 150;
		
		var defaultCenterHeight = $j('.central .pgsize2').height();
		
		if(centerBoxHeight < defaultCenterHeight){ centerBoxHeight = defaultCenterHeight; }
		
		$j(".central .part2 #messages-container").height(centerBoxHeight+"px");
		
		var conWidth = $j(".central .part2 #messages-container").width();
		var conHeight = $j(".central .part2 #messages-container").height();
		
		// original size
		mHeight = messageBox.height();
		mWidth = messageBox.width();
		
		messageBox.show();
		
		// random position
		
		var areaX = Math.floor((conWidth/2)-(mWidth/2))-100;
		var areaY = conHeight-mHeight-10;
		
		var randX;
		
		if(currentArea==1){
			randX = Math.floor(areaX+178+Math.floor(mWidth/2)+Math.random()*areaX);
			currentArea = 2;
		} else {
			randX = Math.floor(Math.floor(mWidth/2)+Math.random()*areaX);
			currentArea = 1;
		}
		
		var randY = Math.floor(mHeight+Math.random()*areaY);
		
		// set position
		messageBox.css("left",randX+"px");
		messageBox.css("top",randY+"px");
		
		mLeft = parseInt(messageBox.css("left"));
		mTop = parseInt(messageBox.css("top"));
		
		var mPadding = 10;
		
		//messageBox.css("left",messagePosition.left+"px");
		//messageBox.css("top",messagePosition.top+"px");
		
		// minimize message
		messageBox.height("1px");
		messageBox.width("1px");
		
		norTop = mTop - mHeight;
		norLeft = mLeft - (mWidth/2);
		
		var maxTop = norTop - 20;
		var maxLeft = norLeft - 20;
		
		var maxPadding = mPadding + 20;
		
		//$j(".central .part2 #messages-container .message-box").hide().fadeIn(1500);
		
		var hoverStop = false;
		
		
		// scale to 120
		messageBox.animate({
			height: mHeight,
			width: mWidth,
			top: maxTop,
			left: maxLeft,
			'padding-top' : maxPadding,
			'padding-right' : maxPadding,
			'padding-bottom' : maxPadding,
			'padding-left' : maxPadding
		}, 200);
		// unsacale to 100
		messageBox.animate({
			top: norTop,
			left: norLeft,
			'padding-top' : mPadding,
			'padding-right' : mPadding,
			'padding-bottom' : mPadding,
			'padding-left' : mPadding
		}, 200, function(){
			// complete animation
			
			// show arrow
			var aTop;
			var aLeft;
			
			// parts to array
			var partHeight = conHeight/2;
			var part;
			
			var messTop = messageBox.offset();
			messTop = messTop.top;
			messTop += (mHeight/2);
			
			/*
			if(randY<=(partHeight)){
				part = 1;
				aTop = mHeight + 20;
				aLeft = Math.floor(mWidth/2);
			} else if(randY<=(partHeight*2)){
				part = 2;
				aTop = Math.floor(mHeight/2);
				if(currentArea==1){
					aLeft = mWidth+20;
				} else {
					aLeft = -16;
				}
			} else if(randY<=(partHeight*3)){
				part = 3;
				aTop = Math.floor(mHeight/2);
				if(currentArea==1){
					aLeft = mWidth+20;
				} else {
					aLeft = -16;
				}
			} else {
				part = 4;
				aTop = -16;
				aLeft = Math.floor(mWidth/2);
			}
			*/
			if(messTop <= (winHeight/2)){
				part = 1;
				aTop = mHeight+20;
				aLeft = Math.floor(mWidth/2)-5;
			} else {
				part = 2;
				aTop = -15;
				aLeft = Math.floor(mWidth/2)-5;
			}
			messageBox.find(".image img").attr("src","wp-content/themes/fullscreen/images/mes_arrow"+part+".png");
			messageBox.find(".image").css("top",aTop+"px");
			messageBox.find(".image").css("left",aLeft+"px");
			messageBox.find(".image").show();
			
			animShow = false;
			
			var mOffset = messageBox.offset();
			/*
			if((mouseX>mOffset.left) && (mouseX<(mOffset.left+mWidth))){
				alert("TRUE");
			}
			*/
		});
		
		//if(!hoverMessage){
			messageBox.delay(5000);
		//}
		
		hideMessageBox();
		
		/*
		$j(".central .part2 #messages-container .message-box").css("opacity","0");
		$j(".central .part2 #messages-container .message-box").css("filter","alpha(opacity=0)");
		
		$j(".central .part2 #messages-container .message-box").animate({
			top: "48%",
			opacity: 1
		}, 500);
		
		$j(".central .part2 #messages-container .message-box").delay(2000).animate({
			top: "52%",
			opacity: 0
		}, 1500);
		*/
		//$j(".central .part2 #messages-container .message-box").fadeOut(1500);
		
	}
}

var sliderDelay = 3000;
var sliderAnimationTime = 600;

var currentbackgroundImage = 0;
var backgroundImages = new Array();
var leftClick = false;
var sliderAnim = false;
var fadeEffect = false;
var centerSliderEnabled = false;

function Sliders(){
	// is home page and slider
	if($j("div.central div.part2").has("#slider-container").length){
		
		if($j("#slider-container").has("#slider-delay").length){
			sliderDelay = parseInt($j("#slider-container #slider-delay").text());
		}
		
		if($j("#slider-container").has("#slider-animation-time").length){
			sliderAnimationTime = parseInt($j("#slider-container #slider-animation-time").text());
		}
		
		// if center slider is enabled
		if($j('#slider-container').has('ul#anything-slider').length){
			centerSliderEnabled = true;
			$j('#anything-slider').anythingSlider({
				autoPlayLocked:true,
				enableKeyboard:false,
				delay:sliderDelay,
				resumeDelay:sliderDelay,
				animationTime:sliderAnimationTime
			});
			$j('#anything-slider').bind('slide_begin', function(e, slider){
				if(!sliderAnim){ GetNextBackgroundImage(!leftClick); }
				sliderAnim = true;
			});
			$j('#anything-slider').bind('slide_complete', function(e, slider){
				sliderAnim = false;
			});
			
			$j('div.anythingSlider .back').hover(function(){
				leftClick = true;
			}, function(){
				leftClick = false;
			});
			
			$j('div.anythingSlider .forward').hide();
			$j('div.anythingSlider .back').hide();
			
			$j('div.anythingSlider').hover(
				function () {
					$j('div.anythingSlider .forward').show();
					$j('div.anythingSlider .back').show();
				},
				function () {
					$j('div.anythingSlider .forward').hide();
					$j('div.anythingSlider .back').hide();
				}
			);
		}
		
		// if background slider is enabled
		if($j('#slider-container').has('ul#background-slider').length){
			if($j("#slider-container").has("#slider-effect").length){
				if($j("#slider-container #slider-effect").text() == 'yes'){ fadeEffect = true; }
			}
			// get all background images
			$j('#slider-container ul#background-slider li').each(function(){
				backgroundImages.push($j(this).find('img').attr('src'));
			});
			if(fadeEffect){
				$j('div.screen div.mainpic').append("<img class='top-img' src='' alt=''></img>");
				$j('div.screen div.mainpic img').attr("src",backgroundImages[0]);
			} else {
				$j('div.screen div.mainpic img.bottom-img').attr("src",backgroundImages[0]);
			}
			// if center slider is disable, so set own interval
			if(!centerSliderEnabled){
				setInterval("GetRightSlider()",sliderDelay);
			}
		}
		
		/*
		$j(window).resize(function() {
			//alert("reload");
			window.location.reload();
		});
		*/
	}
}
function GetRightSlider(){
	GetNextBackgroundImage(true);
}

// argument to go right = true or left = false
function GetNextBackgroundImage(right){
	// if background slider is enabled
	if($j('#slider-container').has('ul#background-slider').length){
		// cycle to right
		if(right){
			if(currentbackgroundImage < backgroundImages.length-1){
				currentbackgroundImage = currentbackgroundImage + 1;
			} else {
				currentbackgroundImage = 0;
			}
		// cycle to left
		} else {
			if(currentbackgroundImage > 0){
				currentbackgroundImage = currentbackgroundImage - 1;
			} else {
				currentbackgroundImage = backgroundImages.length-1;
			}
		}
		
		if(fadeEffect){
			// set next background
			$j('div.screen div.mainpic img.bottom-img').attr("src",backgroundImages[currentbackgroundImage]);
			// set background
			$j('div.screen div.mainpic img.top-img').fadeOut((sliderAnimationTime),function(){
				$j(this).attr("src",$j('div.screen div.mainpic img.bottom-img').attr("src"));
				$j(this).fadeIn(50);
			});
		} else {
			$j('div.screen div.mainpic img.bottom-img').fadeOut((sliderAnimationTime/2),function(){
				$j(this).attr("src",backgroundImages[currentbackgroundImage]);
			});
			$j('div.screen div.mainpic img.bottom-img').fadeIn(sliderAnimationTime/2);
		}
	}
}

function hideMessageBox(){
	
	var messageBox = $j(".central .part2 #messages-container .message-box");
	
	var mOffset = messageBox.offset();
	
	//if(!hoverMessage){		
			messageBox.animate({
				top: mTop,
				left: mLeft,
				height: "1px",
				width: "1px"
			},{
			   step: function(now, fx) {
				/*
				if((mouseX > mOffset.left-(mWidth/2)) && (mouseX < mOffset.left+(mWidth/2)+20) && (mouseY > (mOffset.top-mHeight)) && (mouseY < (mOffset.top+20))){
					
					//$j(this).stop();
					
					messageBox.animate({
						top: norTop,
						left: norLeft,
						width: mWidth,
						height: mHeight
					},0);
					
					//messageBox.css("width",mWidth+"px");
					//messageBox.width("100%");
					//messageBox.height(mHeight);
					//messageBox.find(".image").show();
					wasStopped = true;
				}
				
				
				//messageBox.trigger('mouseover');
				*/
			   }, 
			   duration: 200,
			   complete: function(){	
				//if(!wasStopped){
					messageBox.find(".image").hide();
					messageBox.hide(); 
					messageBox.css("height",mHeight+"px");
					messageBox.css("width",mWidth+"px");
					// next interval
					GenerateMessagesInterval();
				//}
			   }
			});
	//}
}

function RollUpContent(){
	if(!isSliderPage){
		
		if($j.trim($j("#center-box-height").text()) != 'auto') { 
			var defaultCenterBoxHeight = $j(".box-center.pgsize2").height();
			var defaultScrollerHeight = $j("#mcs2_container").height();
			
			$j(".box-center.pgsize2").hover(
				function () {
					if((!isMinimized) && (!minimizeAnim)) {
						var winHeight = $j(window).height();
						var centerBoxHeight = winHeight - 230 - $j(".footer").height();
						var scrollerHeight = centerBoxHeight - 25;
						if(centerBoxHeight > defaultCenterBoxHeight){
							
							$j(this).stop().animate({
								height: centerBoxHeight+"px"
							}, 500, function(){
								$j("#mcs2_container").css("height",scrollerHeight+"px");
								SetCenterBoxScrollerHeight();
							});
						}
					}
				},
				function () {
					if((!isMinimized) && (!minimizeAnim)) {
						$j(this).stop().animate({
							height: defaultCenterBoxHeight+"px"
						}, 500, function(){
							$j("#mcs2_container").css("height",defaultScrollerHeight+"px");
							SetCenterBoxScrollerHeight();
						});
					}
				}
			);
		} else {
			var winHeight = $j(window).height();
			var centerBoxHeight = winHeight - 230 - $j(".footer").height();
			var scrollerHeight = centerBoxHeight - 25;
			
			$j(".box-center.pgsize2").css("height",centerBoxHeight+"px");
			
			$j("#mcs2_container").css("height",scrollerHeight+"px");
			SetCenterScrollbar();
		}
	}
}

function RollUpFooter(){
	
	var contentHeight = $j(".footer .content-height").height();
	
	var defaultFooterHeight = $j(".footer").height();
	var defaultFooterInsideHeight = $j(".footer .inside").height();
	
	var footerHeight;
	var footerInsideHeight;
	
	// auto roll-up height
	if(parseInt($j(".footer #roll-up-info #auto").html())==1){
		footerHeight = contentHeight;
		footerInsideHeight = footerHeight + 17;
		
	} else {
		footerHeight = parseInt($j(".footer #roll-up-info #pixels").html());
		footerInsideHeight = footerHeight + 17;
	}
	
	$j(".footer").hover(
		function () {
			$j('.footer').stop().animate({
				height: footerHeight+"px"
			}, 500, function(){
				$j("#show_hide_footer_button").attr("class","hide");
			});
			$j(".footer .inside").stop().animate({
				height: footerInsideHeight+"px"
			}, 500);
		},
		function () {
			$j(".footer").stop().animate({
				height: defaultFooterHeight+"px"
			}, 500, function(){
				$j("#show_hide_footer_button").attr("class","show");
			});
			$j(".footer .inside").stop().animate({
				height: defaultFooterInsideHeight+"px"
			}, 500);
		}
	);
	
	$j("#show_hide_footer_button").click(function(){
		if($j(this).attr("class") == "show"){
			$j('.footer').animate({
				height: footerHeight+"px"
			}, 500, function(){
				$j("#show_hide_footer_button").attr("class","hide");
			});
			$j(".footer .inside").animate({
				height: footerInsideHeight+"px"
			}, 500);
		} else {
			$j('.footer').animate({
				height: defaultFooterHeight+"px"
			}, 500, function(){
				$j("#show_hide_footer_button").attr("class","show");
			});
			$j(".footer .inside").animate({
				height: defaultFooterInsideHeight+"px"
			}, 500);
		}
	});
}

function ShowSidebarWidget() {
	var widgetTitles = [];
	var widgetIDs = [];
	var i = 0;
	
	var visible = false;
	$j(".part3 .moretab").click(function(){
		if(visible){
			$j('.part3 .sidetabs ul').css("display","none");
			visible = false;
		} else {
			$j('.part3 .sidetabs ul').css("display","block");
			visible = true;
		}
	});
	
	$j(".part3 .sidetabs").hover(function(){
		$j(".part3 .sidetabs ul").css("display","block");
		visible = true;
	}, function(){
		$j(".part3 .sidetabs ul").css("display","none");
		visible = false;
	});
		
	// get all widget titles
	$j("#primary.sidebar h2").each(function(){
		widgetTitles[i] = $j(this).text();
		i++;
	});
	// remove first li
	$j(".part3 .sidetabs ul li").remove();
	// generate menu
	for(i=0;i<widgetTitles.length;i++){
		$j(".part3 .sidetabs ul").append('<li><span>' + widgetTitles[i] + '</span></li>');
	}
	// activate first li
	$j(".part3 .sidetabs ul li").first().attr('class','active');
	// get widgets IDs
	i = 0;
	$j("#primary.sidebar").children().each(function(){
		widgetIDs[i]  = $j(this).attr('id');
		i++;
	});
	// hide other widgets
	for(i=1;i<widgetIDs.length;i++){
		$j("#primary.sidebar > #" + widgetIDs[i]).hide();
	}
	// show default widget from cookie
	if($j.cookie("defaultWidget")!=null){
		var index = parseInt($j.cookie("defaultWidget"));
		//alert(index);
		// hide all widgets
		for(i=0;i<widgetIDs.length;i++){
			$j("#primary.sidebar > #" + widgetIDs[i]).hide();
		}
		// set title
		$j(".part3 .sidepost > h2").html(widgetTitles[index]);
		Cufon.replace('h2');
		// hide old title
		$j("#primary.sidebar > #" + widgetIDs[index] + " h2").hide();
		// show widget
		$j("#primary.sidebar > #" + widgetIDs[index]).show();
		// activate li item
		$j(".part3 .sidetabs ul li").attr('class','');
		$j(".part3 .sidetabs ul li:eq("+index+")").attr('class','active');
		
		SetSidebarScrollbar();
		
	} else {
		// if cookie not exist
		for(i=0;i<widgetIDs.length;i++){
			$j("#primary.sidebar > #" + widgetIDs[i]).hide();
		}
		// set title
		$j(".part3 .sidepost > h2").html(widgetTitles[0]);
		Cufon.replace('h2');
		// hide old title
		$j("#primary.sidebar > #" + widgetIDs[0] + " h2").hide();
		// show widget
		$j("#primary.sidebar > #" + widgetIDs[0]).show();
		// activate li item
		$j(".part3 .sidetabs ul li").attr('class','');
		$j(".part3 .sidetabs ul li:eq("+0+")").attr('class','active');
		
		SetSidebarScrollbar();
		
	}	
	// click on the li more
	$j(".part3 .sidetabs ul li").click(function () { 
		$j(".part3 .sidetabs ul li").attr('class','');
		$j(this).attr('class','active');
		// hide all widgets
		for(i=0;i<widgetIDs.length;i++){
			$j("#primary.sidebar > #" + widgetIDs[i]).hide();
		}
		
		var index = $j(".part3 .sidetabs ul li").index(this);
				
		// show clicked widget
		$j("#primary.sidebar > #" + widgetIDs[index]).show();
		// hide old title
		$j("#primary.sidebar > #" + widgetIDs[index] + " h2").hide();
		// set title
		$j(".part3 .sidepost > h2").html(widgetTitles[index]);
		Cufon.replace('h2');
		// set cookie to show default widget
		$j.cookie("defaultWidget", index, { path: '/' });
		
		SetSidebarScrollbar();
    });
}

function ShowSidebarThumbnails() {
	
	$j(".part3 .sidepost .postitem").hover(
		function() {
			// if post have thumbnail
			if($j(this).has("div.thumbnailSrc").length){	
				var positionItem = $j(this).offset();
				var posThumbX = positionItem.left - 119;
				var posThumbY = positionItem.top;
				
				$j('.part3 .thumb_container').show();			
				$j(".part3 .thumb_container").css("left",posThumbX+"px");
				$j(".part3 .thumb_container").css("top",posThumbY+"px");
				
				var templateDirectory = $j(".part3 .thumb_container .thumb img").attr("alt");
				var thumbSrc = $j(this).find("div.thumbnailSrc").text();
				var thumbPath = templateDirectory + "/lib/timthumb/timthumb.php?src=" + thumbSrc + "&w=84&h54";
				
				// set thumbnail image
				$j(".part3 .thumb_container .thumb img").attr("src",thumbPath);
									
				$j(".part3 .thumb_container .thumb").css("display","block");
				
				$j(".part3 .thumb_container .thumb").css("left","84px");
				
				$j(".part3 .thumb_container .thumb").stop().animate({
							left: "0px"
				}, 500, function() { });
				
			}
		},
		function() {
			$j(".part3 .thumb_container .thumb").css("display","none");
			$j('.part3 .thumb_container').hide();
		}
	);
	
	// when scrolling
	$j("#mcs_container .customScrollBox").bind("mousewheel", function(event, delta) {
		$j(".part3 .thumb").css("display","none");
	});
}

/* ******************************************************************************************
 * Set scrollbars
 * ******************************************************************************************/
function InitScollbars() {
	if(!isTouchDevice()){
		// center scroller
		SetCenterScrollbar();
		// enable footer scroller
		if($j("#mcs5_container .content ul").children().length>6){
			$j("#mcs5_container").mCustomScrollbar("horizontal",500,"easeOutCirc",1.00,"auto","yes","yes",10);
		} else {
			$j("#mcs5_container .prev").hide();
			$j("#mcs5_container .next").hide();
			$j("#mcs5_container .content").css("margin","auto");
		}
		// right box scroller
		SetSidebarScrollbar();
		// left box scroller
		SetLeftSidebarScrollbar();
	}
}
function iScroll(){
	var myScroll = new iScroll('centerScrollBox', {desktopCompatibility:true});
}

function SetCenterScrollbar() {
	if(!isTouchDevice()){
		// center content scrollbar
		if(!$j(".central").has(".part2.home-page").length){
			if((!isSliderPage)){
				$j("#mcs2_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.00,"auto","yes","yes",5);
			} else {
				$j("#mcs2_container .customScrollBox .container").css("width","100%");
				$j("#mcs2_container .customScrollBox .container .content").css("width","100%");
			}
		}
	}
}

function SetSidebarScrollbar() {
	if(!isTouchDevice()){
		$j("#mcs_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.00,"auto","yes","yes",5);
		// scale sidebar, if scroller is hide
		if($j("#mcs_container .dragger_container").is(":visible")){
			$j("#mcs_container .customScrollBox .container").css("width","95%");
			$j("#mcs_container .customScrollBox .container .content").css("width","98%");
		} else {
			$j("#mcs_container .customScrollBox .container").css("width","100%");
			$j("#mcs_container .customScrollBox .container .content").css("width","100%");
		}
	}
}

function SetLeftSidebarScrollbar() {
	if(!isTouchDevice()){
		$j("#mcs_container_left").mCustomScrollbar("vertical",400,"easeOutCirc",1.00,"auto","yes","yes",5);
		// scale if scroller is hide
		if($j("#mcs_container_left .dragger_container").is(":visible")){
			$j("#mcs_container_left .customScrollBox .container").css("width","95%");
			$j("#mcs_container_left .customScrollBox .container .content").css("width","98%");
		} else {
			$j("#mcs_container_left .customScrollBox .container").css("width","100%");
			$j("#mcs_container_left .customScrollBox .container .content").css("width","100%");
		}
	}
}

/* ******************************************************************************************
 * Font Replacement
 * ******************************************************************************************/
function InitCufon() {  
        
    Cufon.replace('h1, h2, .part2 h3, .services h3 .title, .logo .title, #navigation-header strong');   
    Cufon.replace('#navigation li a', {
        textShadow: '1px 1px rgba(0, 0, 0, 0.5)',
        hover: {
            color: '#b0d719'
        }
    });
    
    Cufon.replace('.logo .title', 
	{
		color: '-linear-gradient(#FFFFFF, #E4D9AD)', 	
		textShadow: '1px 1px rgba(0, 0, 0, 0.5)'
	});
	
	Cufon.replace('.mainmenu ul.menu > li > a', 
	{
		textShadow: '1px 1px rgba(0, 0, 0, 0.5)', 
		hover: {color: '#FFFFFF'}
	});
	
}

/* ******************************************************************************************
 * Image actions
 * ******************************************************************************************/
function InitPixastic() {
    $j('.socialize li img').each(function() {
        $j(this).clone().insertAfter($j(this)).hide();
        $j(this).pixastic('desaturate');
    });
    
    $j('.socialize li').hover(function() {
        $j('canvas', this).hide();    
        $j('img', this).show();
    }, function() {
        $j('canvas', this).show();    
        $j('img', this).hide();    
    });
}

/* ******************************************************************************************
 * Main Menu
 * ******************************************************************************************/
function InitMainMenu() {
    $j('#main-menu ul.sub-menu').parent().addClass('parent');    
    $j('#main-menu li').hover(
    		function() {
    			$j(this).find('ul:first').css({'visibility': 'visible', 'display': 'none'}).slideDown('150');
    			$j(this).find('li:last').css({'background-image': 'none'});
                
    		},
    		function() { 
    			$j(this).find('ul:first').css({'visibility': 'hidden'});
    		}
    	);
}

/* ******************************************************************************************
 * Images
 * ******************************************************************************************/
function InitImages() {
	// Image fancybox
	$j("a[href$='gif']").fancybox();
	$j("a[href$='jpg']").fancybox();
	$j("a[href$='png']").fancybox();
}

/* ******************************************************************************************
 * Miscellaneous
 * ******************************************************************************************/
function InitMisc() {  
  $j('.wpcf7 input, .wpcf7 textarea').each(function(index) {    
    var id = $j(this).attr('id');
    var name = $j(this).attr('name');    
    if (id.length == 0 && name.length != 0) {
      $j(this).attr('id', name);
    }
  });
  
  $j('.wpcf7 label').inFieldLabels();
  
}

/* ******************************************************************************************
 * Portfolio Modal Windows
 * ******************************************************************************************/
function InitPortfolio() {
  $j('.portfolio-website').each(function(index) {
    $j('.website-thumbnail a', this).attr('href', '#website-' + index);
    $j('.website-modal', this).attr('id', 'website-' + index);
  });
  
	$j('.website-thumbnail a').fancybox({
		'modal' 				: false,
		'hideOnOverlayClick' 	: true,
		'hideOnContentClick' 	: false,
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true		
	});    
}

function SetCenterBoxScrollerHeight() {
	if($j("div.box-center").has("#mcs2_container").length){
		var floatHeight = parseInt($j("div.box-center div.float").height());
		var scrollerHeight = floatHeight - 70;
		$j("div.box-center #mcs2_container div.customScrollBox").css("height",scrollerHeight+"px");
		SetCenterScrollbar();
	}
}
