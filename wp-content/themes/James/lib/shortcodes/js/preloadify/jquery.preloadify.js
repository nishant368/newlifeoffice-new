// JavaScript Document

jQuery(function(){

jQuery.fn.preloadify = function(options){
	
	var defaults = {
		             delay:0,
					 imagedelay:0,
					 mode:"parallel",
					 preload_parent:"a",
					 check_timer:200,
					 ondone:function(){ },
					 oneachload:function(image){  },
					 fadein:700 ,
					 force_icon:false
					};
	
	// variables declaration and precaching images and parent container
	 var options = jQuery.extend(defaults, options),
		 parent = jQuery(this),
		 timer,i=0,j=options.imagedelay,counter=0,images = parent.find("img").css({display:"block",visibility:"hidden",opacity:0}),
		 checkFlag = [],
		 imagedelayer = function(image,time){
			
			jQuery(image).css("visibility","visible").delay(time).animate({opacity:1},options.fadein,function(){ jQuery(this).parent().removeClass("preloader");  });
			
			};
		
	// add preloader to parent or wrap anchor depending on option	
	images.each(function(){
		
		if(jQuery(this).parent(options.preload_parent).length==0)
		jQuery(this).wrap("<a class='preloader' />");
		else
		jQuery(this).parent().addClass("preloader");
		
		checkFlag[i++] = false;
				
		});
	
	
	
	
	// convert into image array
	images = jQuery.makeArray(images);
	counter = 0;
	
	// function to show image 
	function showimage(i)
	{
		if(checkFlag[i]==false)
			{
				counter++; 
				options.oneachload(images[i]);
				checkFlag[i] = true;
			}
				
		if(options.imagedelay==0&&options.delay==0)
			jQuery(images[i]).css("visibility","visible").animate({opacity:1},700);
		else if(options.delay==0)
		{
			imagedelayer(images[i],j);
			j += options.imagedelay;
		}
		else if(options.imagedelay==0)
		{
			imagedelayer(images[i],options.delay);
			
		}
		else
		{
			imagedelayer(images[i],(options.delay+j));
			j += options.imagedelay;
		}
				
	}
	
	// 	preload images parallel
	function preload_parallel()
	{
		for(i=0;i<images.length;i++)
		{
			if(images[i].complete==true)
			{
				showimage(i);
			 
			}
		}
	}
	
	// shows images based on index with respect to parent container
	function preload_sequential()
	{
		
			if(images[i].complete==true)
			{
				showimage(i);
				 i++;
			}
	}
	
	i=0;j=options.imagedelay;
	// keep on checking after predefined time, if image is loaded
	function init(){
	timer = setInterval(function(){
		
		if(counter>=checkFlag.length)
		{
			clearInterval(timer);
			options.ondone();
			
			return;
		}
		
		
		if(options.mode=="parallel")
		preload_parallel();
		else
		preload_sequential();
		
		},options.check_timer);
		
	}
	
  if(options.force_icon==true){	
  var src = jQuery(".preloader").css("background-image");
 
	var pattern = /url\(|\)|"|'/g;
	src = src.replace(pattern,'');
	
	
	var icon = jQuery("<img />",{
		
		id : 'loadingicon' ,
		src : src
		
		}).hide().appendTo("body");
	
	timer = setInterval(function(){
		
		if(icon[0].complete==true)
		{
			clearInterval(timer);
			setTimeout(function(){ init(); },options.check_timer);
			 icon.remove();
			return;
		}
		
		},50);
		
	
  }
  else
	init();
	
	
	
	}
	
})


/* ------------------- End of plugin -------------------- */