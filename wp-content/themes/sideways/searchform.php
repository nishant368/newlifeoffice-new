<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input class="searchsubmit" type="submit" value="Search">
		<input class="text s" type="text" value="<?php if(trim(wp_specialchars($s,1))!='') echo trim(wp_specialchars($s,1));else echo '';?>" name="s">							
	</fieldset>
</form>