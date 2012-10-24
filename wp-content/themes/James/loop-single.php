<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="shadowTop"><h2 class="entry-title"><?php the_title(); ?></h2><div class="clickHide"></div></div>
<div class="content">
<div class="main-content">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
$commentscount = get_comments_number();
$tags_list = get_the_tag_list( '', ', ' );
$metaSwitch = get_option('_tdCore-metaSwitch');
$saleDisplay = get_post_meta($post->ID, '_tdCore-saleDisplay', true);
if($saleDisplay == '') {
if($metaSwitch == '') { $metaSwitch = 'on'; }
if($metaSwitch == 'on') { ?>
<div class="entry-bar">
<span class="bar-icon date"></span><span class="bar-float"><?php the_time('M j, Y') ?> | </span><span class="bar-icon author"></span><span class="bar-float"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_link(); ?></a> | </span><span class="bar-icon cat"></span><span class="bar-float"><?php the_category(', ') ?> | </span><span class="bar-icon comment"></span><span class="bar-float"><a href="<?php the_permalink(); ?>#comments"><?php echo $commentscount; ?></a><?php if ( $tags_list ) { ?> | </span><span class="bar-icon tag"></span><span class="bar-float"><?php  echo $tags_list; ?></span><?php } else { echo '</span>'; } ?><span class="clearFloat"></span>
</div>
<?php } ?>
<?php if($image_url != '') { echo '<img class="contentImageFull" src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&w=600&h=200&a=c" />'; } ?>
<?php get_template_part( 'slider' ); ?>
<div class="entry-content-text">
<?php the_content(); ?>
</div>
<br style="clear: both" />
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
<div id="entry-author-info">
<div id="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tdCore_author_size', 60 ) ); ?>
</div>
<div id="author-description">
<h2><?php printf( esc_attr__( 'About %s', 'tdCore' ), get_the_author() ); ?></h2>
<?php the_author_meta( 'description' ); ?>
<div id="author-link">
<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
<?php printf( __( 'View all posts by ', 'tdCore' ) ); echo get_the_author(); ?>
</a>
</div>
</div>
</div>
<?php endif; ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
<?php require_once(TEMPLATEPATH . '/contact.php'); ?>
<?php comments_template( '', true ); ?>
<?php
} else {
	/* LAYOUT FOR SALES PAGE */
	$saleCount = 0;
$salePrice = get_post_meta($post->ID, '_tdCore-salePrice', true);
$saleThumb1 = get_post_meta($post->ID, '_tdCore-saleThumb1', true);
$saleThumb2 = get_post_meta($post->ID, '_tdCore-saleThumb2', true);
$saleThumb3 = get_post_meta($post->ID, '_tdCore-saleThumb3', true);
$saleThumb4 = get_post_meta($post->ID, '_tdCore-saleThumb4', true);
if ($saleThumb1 != '') { $saleCount += 1; } 
if ($saleThumb2 != '') { $saleCount += 1; } 
if ($saleThumb3 != '') { $saleCount += 1; } 
if ($saleThumb4 != '') { $saleCount += 1; } 
if($saleThumb1 != '') { $saleThumb1 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb1.'&w=160&h=160&a=c'; }
if($saleThumb2 != '') { $saleThumb2 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb2.'&w=160&h=160&a=c'; }
if($saleThumb3 != '') { $saleThumb3 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb3.'&w=160&h=160&a=c'; }
if($saleThumb4 != '') { $saleThumb4 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb4.'&w=160&h=160&a=c'; }
?>
<div class="saleSingle">
<?php if($saleCount > 0) {
$saleCount = 'contentSaleImgOn'; ?>

<div class="saleImgWrap">
<span class="salePrice"><?php echo $salePrice; ?></span>
  <div class="saleImages">
  <?php 
 if($saleThumb1 != '') { echo '<img src='.$saleThumb1.') />'; }
if($saleThumb2 != '') { echo '<img src='.$saleThumb2.') />'; }
if($saleThumb3 != '') { echo '<img src='.$saleThumb3.') />'; }
if($saleThumb4 != '') { echo '<img src='.$saleThumb4.') />'; }
  ?>
  </div>
</div>
<?php } ?>
<div class="entry-content-text <?php echo $saleCount; ?>">
<?php the_content(); ?>
</div>
<div class="clearAll"></div>
</div>
<br style="clear: both" />
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tdCore_author_size', 60 ) ); ?>
						</div>
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'tdCore' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by ', 'tdCore' ) ); echo get_the_author(); ?>
								</a>
							</div>
						</div>
					</div>
<?php endif; ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
<?php require_once(TEMPLATEPATH . '/contact.php'); ?>
<?php comments_template( '', true ); 
}
?>
</div>
<?php 
endwhile;
endif;
?>
</div>
</div>
<div class="contentShadowBottom"></div>




