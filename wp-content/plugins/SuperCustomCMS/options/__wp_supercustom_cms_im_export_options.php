<?php
/**
 * @package SuperCustomCMS
 * @subpackage Im/Export options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
?>
		<div class="supercustom_cms_section">
				<div class="supercustom_cms_title">
                <h3 class="hndle" id="import"><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Export/Import Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></h3>                                                                                
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
				<div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">
					
					<h4><?php _e('Export', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></h4>
					<form name="export_options" method="get" action="">
						<p><?php _e('You can save a .seq file with your options.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></p>
						<p id="submitbutton">
							<input type="hidden" name="__wp_supercustom_cms_export" value="true" />
							<input type="submit" name="__wp_supercustom_cms_save" value="<?php _e('Export &raquo;', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?>" class="button" />
						</p>
					</form>
					
					<h4><?php _e('Import', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></h4>
					<form name="import_options" enctype="multipart/form-data" method="post" action="?page=<?php echo esc_attr( $_GET['page'] ); ?>">
						<?php wp_nonce_field('wp_supercustom_cms_nonce'); ?> 
						<p><?php _e('Choose a SuperCustomCMS (<em>.seq</em>) file to upload, then click <em>Upload file and import</em>.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></p>
						<p>
							<label for="datei_id"><?php _e('Choose a file from your computer', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?>: </label>
							<input name="datei" id="datei_id" type="file" />
						</p>
						<p id="submitbutton">
							<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_import" />
							<input type="submit" name="__wp_supercustom_cms_save" value="<?php _e('Upload file and import &raquo;', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?>" class="button" />
						</p>
					</form>
					<p><a class="alignright button" href="javascript:void(0);" onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;"><?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a><br class="clear" /></p>
					
				</div>
			</div>
		</div>
		