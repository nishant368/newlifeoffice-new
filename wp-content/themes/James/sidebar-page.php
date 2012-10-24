<?php
/**
* Template Name: Sidebar
*/
get_header(); 
$showContent = get_post_meta($post->ID, '_tdCore-showContent', true);
if($showContent != 'no') { ?>
<div class="main-wrap">
<div class="sidebar"><div class="sidebarShadowTop"></div><div class="sidebar-wrap"><div class="sidebar-content"><?php get_sidebar(); ?></div></div></div>
<?php } ?>
<div class="container">
<?php get_template_part( 'loop', 'page' ); ?>
</div>
</div>
<?php get_footer(); ?>
</div>