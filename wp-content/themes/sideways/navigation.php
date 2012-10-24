<!-- SEARCH BAR -->
<div id="searchbar-holder">
	
	<a id="top"></a>
	
	<div id="searchbar">
		
		<!-- SEARCH FORM -->
		<?php if ( $theme_options[$shortname.'_header_search'] == 'true' ) { ?>
			
			<ul class="search">
				<li class="widget_search">
					<?php get_search_form(); ?>
				</li>				
			</ul>
			
		<?php } ?>
		
		<?php if ( 
			$theme_options[$shortname.'_email'] != ''
			|| $theme_options[$shortname.'_rss'] == 'true'
			|| $theme_options[$shortname.'_facebook'] != ''
			|| $theme_options[$shortname.'_twitter'] != ''
			|| $theme_options[$shortname.'_google_plus'] != ''
			|| $theme_options[$shortname.'_digg'] != ''
			|| $theme_options[$shortname.'_myspace'] != ''
			|| $theme_options[$shortname.'_dribbble'] != ''
			|| $theme_options[$shortname.'_flickr'] != ''
			|| $theme_options[$shortname.'_linkedin'] != ''
			|| $theme_options[$shortname.'_vimeo'] != ''
			|| $theme_options[$shortname.'_youtube'] != ''
		) { ?>
		
		<!-- SOCIAL BUTTONS -->
		<div id="share">
		
			<a href="#" class="share-button"><span>Share</span></a>
			
			<div id="share-box">
				
				<div id="share-holder">
				
					<!-- SOCIAL NETWORK BUTTONS -->
					<?php if ($theme_options[$shortname.'_email'] != '') : ?><a class="email-button" title="<?php _e('Contact Page', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_email'] ; ?>">Email</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_rss'] == 'true') : ?><a class="rss-button" title="<?php _e('Follow the RSS', 'raw_theme'); ?>" href="<?php bloginfo('rss2_url'); ?>">RSS</a><?php endif ; ?>		
					<?php if ($theme_options[$shortname.'_facebook'] != '') : ?><a class="facebook-button" title="<?php _e('Follow on Facebook', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_facebook'] ; ?>">facebook</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_twitter'] != '') : ?><a class="twitter-button" title="<?php _e('Follow on Twitter', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_twitter'] ; ?>">twitter</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_google_plus'] != '') : ?><a class="google-button" title="<?php _e('Follow on Google+', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_google_plus'] ; ?>">Google+</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_digg'] != '') : ?><a class="digg-button" title="<?php _e('Follow on Digg', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_digg'] ; ?>">Digg</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_myspace'] != '') : ?><a class="myspace-button" title="<?php _e('Follow on Myspace', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_myspace'] ; ?>">Myspace</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_dribbble'] != '') : ?><a class="dribbble-button" title="<?php _e('Follow on Dribbble', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_dribbble'] ; ?>">Dribbble</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_flickr'] != '') : ?><a class="flickr-button" title="<?php _e('Follow on Flickr', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_flickr'] ; ?>">Flickr</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_linkedin'] != '') : ?><a class="linkedin-button" title="<?php _e('Follow on LinkedIn', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_linkedin'] ; ?>">LinkedIn</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_vimeo'] != '') : ?><a class="vimeo-button" title="<?php _e('Follow on Vimeo', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_vimeo'] ; ?>">Vimeo</a><?php endif ; ?>
					<?php if ($theme_options[$shortname.'_youtube'] != '') : ?><a class="youtube-button" title="<?php _e('Follow on YouTube', 'raw_theme'); ?>" href="<?php echo $theme_options[$shortname.'_youtube'] ; ?>">YouTube</a><?php endif ; ?>
					
				</div>
			
			</div>
			
		</div>
		<?php } ?>
		
	</div>
	
</div>

<div id="sidebar">
	
	<?php if ( $theme_options[$shortname.'_logo'] != "" ) { ?>
		
		<!-- LOGO -->
		<header>
		
			<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes($theme_options[$shortname.'_logo']) ; ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
			<span class="displace"><?php bloginfo('description'); ?></span>
		
		</header>
		
	<?php } ?>
	
	<!-- NAVIGATION -->
	<nav>		
		
		<?php wp_nav_menu( 
			array( 
				'theme_location' => 'main-navigation', 
				'container' => false,
				'menu_id' => 'navigation',
				'fallback_cb' => false
			)
		); ?>
		
		<a href="#" id="expand-button" class="collapse"><?php _e("Navigation","raw_theme"); ?></a>
		
	</nav>

</div>