<?php
function frame( $params, $content = null ) {
	extract(shortcode_atts(array(
	      'bgcolor' => 'none',
     ), $params));
	
	if($bgcolor == "none") {
		$bg = '';
	} else {
		$bg = ' style="background-color: '.$bgcolor.';"';
	}
	
    $result = '<div class="frame"'.$bg.'><div class="frame-wrap"><div class="frame-inner">';
    $result .= do_shortcode( $content );
    $result .= '</div></div></div>';
    
    return force_balance_tags( $result );
}
add_shortcode( "frame", "frame" );
