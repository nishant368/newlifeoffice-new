<?php
/**
 * @package SuperCustomCMS
 * @subpackage Deinstall options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
?>
		<div class="supercustom_cms_section">
				<div class="supercustom_cms_title">
                <h3 class="hndle" id="uninstall"><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Deinstall Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></h3>                                                                                
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
				<div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">

					<p><?php _e('Use this option for clean your database from all entries of this plugin. When you deactivate the plugin, the deinstall of the plugin <strong>clean not</strong> all entries in the database.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></p>
					<form name="deinstall_options" method="post" id="__wp_supercustom_cms_options_deinstall" action="?page=<?php echo esc_attr( $_GET['page'] );?>">
						<?php wp_nonce_field('wp_supercustom_cms_nonce'); ?>
						<p id="submitbutton">
							<input type="submit" name="__wp_supercustom_cms_deinstall" value="<?php _e('Delete Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> &raquo;" class="button-secondary" />
							<input type="checkbox" name="__wp_supercustom_cms_deinstall_yes" value="__wp_supercustom_cms_deinstall" />
							<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_deinstall" />
						</p>
					</form>
					<p><a class="alignright button" href="javascript:void(0);" onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;"><?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a><br class="clear" /></p>

				</div>
			</div>
		</div>