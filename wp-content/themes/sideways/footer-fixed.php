<?php

global $shortname, $theme_options;

?>
<!-- FOOTER -->
<footer class="fixed">

	<div id="footer-content">
	
		<nav>
			
			<?php wp_nav_menu( 
				array( 
					'theme_location' => 'footer-navigation', 
					'container' => false,
					'menu_id' => 'footer-navigation',
					'fallback_cb' => false
				)
			); ?>
			
		</nav>
		
		<p>&copy; <?php echo date("Y"); ?> <?php echo stripslashes( $theme_options[ $shortname.'_footer_text' ] ); ?></p>
	
	</div>
	
	<?php wp_footer(); ?>
	
</footer>

</body>
</html>
