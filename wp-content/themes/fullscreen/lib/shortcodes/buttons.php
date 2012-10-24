<?php
/* **********************************************************
 * BUTTONS
 * **********************************************************/
function theme_button( $params, $content = null) {
    extract( shortcode_atts( array(
        'title' => '',
        'link' => '', 
    ), $params ) );

  return '<a href="' . $link . '" class="sc-button"><span><span>' . $title . '</span></span></a>';
}
add_shortcode( 'button', 'theme_button' );