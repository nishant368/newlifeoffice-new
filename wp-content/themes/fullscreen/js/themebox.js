$j = jQuery.noConflict();
$j(document).ready(function () { 
	
	FloatThemeBox();
	
	BestSellersClick();

});

function BestSellersClick(){
	$j("#theme-box select#best-sellers").change(function(){
		switch($j(this).val())
		{
			case "corporate":
				window.location.href = 'http://www.ait.sk/corporate/wp';
				break;
			case "simplicius":
				window.location.href = 'http://www.ait.sk/simplicius/wp';
				break;
			case "universal-business":
				window.location.href = 'http://www.ait.sk/universal-business/wp';
				break;
			case "glamorous":
				window.location.href = 'http://www.ait.sk/glamorous/wp';
				break;
			case "trademark":
				window.location.href = 'http://www.ait.sk/trademark/wp';
				break;
			case "fullscreen":
				window.location.href = 'http://www.ait.sk/fullscreen/wp';
				break;
			default:
		}
	});
}

function FloatThemeBox () {
    if ($j.cookie('themebox-status') == 'closed') {
        $j('#theme-box').css({'left': '-131px'});
        $j('#theme-box-closer').removeClass('opened').addClass('closed');       
    }
    
    $j('#theme-box-closer').click(function () {
        if ($j(this).hasClass('opened')) {
            $j('#theme-box').animate({
                'left': '-131px'
            }, 500, function () {
                $j('#theme-box-closer').removeClass('opened').addClass('closed');       
                $j.cookie('themebox-status', 'closed', { path: '/' });
            });
        }
        
        if ($j(this).hasClass('closed')) {
            $j('#theme-box').animate({
                'left': '-0px'
            }, 500, function () {
                $j('#theme-box-closer').removeClass('closed').addClass('opened');       
                $j.cookie('themebox-status', 'opened', { path: '/' });
            });
        }        
    });
    
    var name = '#theme-box';  
    var menuYloc = null; 
    if ($j(name).length) {
        menuYloc = parseInt($j(name).css('top').substring(0,$j(name).css('top').indexOf('px')))      
        $j(window).scroll(function () {
            var offset = menuYloc + $j(document).scrollTop() + 'px';  
            $j(name).animate({top:offset},{duration:500,queue:false});          
        });
    }
}
