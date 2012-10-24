<?php

switch ( get_post_meta( $post->ID, $shortname.'_portfolio_item_type', true) ) {
	case __('Gallery', 'raw_theme') :
		include ('page-gallery.php');
	break;
	case __('Default', 'raw_theme') :
		include ('single-portfolio-default.php');
	break;
	case __('Full Width', 'raw_theme') :
		include ('single-portfolio-full-width.php');
	break;
}

 ?>