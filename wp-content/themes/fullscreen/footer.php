		</div>
		</div><!-- end of central -->
	</div><!-- end of mainpage -->
    
    <!-- footer -->
	<div class="footer">
		<div class="decor"></div>
		<div id="show_hide_footer_button" class="show"></div>
        
		<div id="roll-up-info" style="display:none">
			<div id="auto">
				<?php $rollUp_footer_height_auto = get_option( 'rollUp_footer_height_auto' ); 
				if ( !empty( $rollUp_footer_height_auto ) ){
					echo $rollUp_footer_height_auto;
				} else {
					echo "";
				}	?>
			</div>
			<div id="pixels">
				<?php $rollUp_footer_height = get_option( 'rollUp_footer_height' ); 
				if ( !empty( $rollUp_footer_height ) ){
					echo $rollUp_footer_height;
				} else {
					echo 120;
				}	?>
			</div>
		</div>
		
		<div class="inside">
		<div class="content-height">
		<div class="footer-text"><?php echo stripslashes(get_option( 'footer_text' )); ?></div>
		
		<?php 
		$footer_gallery_show = get_option( 'footer_gallery_show' );
		if($footer_gallery_show=="yes"):
		?>
		<!-- content block -->
		<div id="gallery">
		<div id="mcs5_container">
		<div id="footerScrollBox" class="customScrollBox">
		<div class="container">
    		<div class="content">
						<?php			
							$footer_clone_picture = get_option( 'footer_clone_picture' ); 
							if ( !empty( $footer_clone_picture ) ){
								$pictures = json_decode($footer_clone_picture);
							}
							
							
							echo "<ul>";
							 	for($i=0;$i<count($pictures);$i++){
									$rel = "";
									if( (strpos($pictures[$i][1],".jpg")) || (strpos($pictures[$i][1],".png")) || (strpos($pictures[$i][1],".gif")) ){ $rel= 'rel="footer-gallery" '; }
									if(!empty($pictures[$i][0])){
										echo '<li><a '.$rel.'href="'.link_to($pictures[$i][1]).'"><img src="'.get_bloginfo( 'template_directory' ).'/lib/timthumb/timthumb.php?src='.link_to($pictures[$i][0]).'&amp;w=80&amp;h=52" alt="'.$pictures[$i][2].'" title="'.$pictures[$i][2].'" /></a></li>';
									}
								}
								// FIX scroller problem
								if(count($pictures)==7){
									$rel = "";
									if( (strpos($pictures[$i][1],".jpg")) || (strpos($pictures[$i][1],".png")) || (strpos($pictures[$i][1],".gif")) ){ $rel= 'rel="footer-gallery" '; }
									echo '<li><a '.$rel.'href="'.link_to($pictures[6][1]).'"><img src="'.link_to('/lib/timthumb/timthumb.php?src=').link_to($pictures[6][0]).'&amp;w=80&amp;h=52" alt="" title="'.$pictures[6][2].'" /></a></li>';
								}
							echo "</ul>";
						?>						
			</div><!-- end of content -->
		</div><!-- end of container -->
		<div class="dragger_container">
    		<div class="dragger"></div>
		</div>
		</div><!-- end of customScrollBox -->
		
		<span class="prev scrollUpBtn"><span class="wrap"><span>previous</span></span></span>
		<span class="next scrollDownBtn"><span class="wrap"><span>next</span></span></span>
		
		<!-- <a href="#" class="scrollUpBtn">&#8678;</a> <a href="#" class="scrollDownBtn">&#8680;</a> -->
		
		</div><!-- end of mcs5_container -->
		</div><!-- end of gallery -->
		<?php endif; ?>
		
		<div class="footer-widget-container">
		<div class="footer-widget-area">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div>
		</div>
		</div><!-- end of content-height -->
		</div><!-- end of inside -->
				
	</div><!-- end of footer -->
	
</div><!-- end of screen -->
<?php $ga_code = get_option('ga_code'); ?>
<?php if ($ga_code != ''): ?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo $ga_code; ?>']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
<?php endif; ?>

<?php
    wp_footer();
?>

</body>
</html>
