<?php
/**
 * @package SuperCustomCMS
 * @subpackage Backend Options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
global $wp_menu_editor;
$wp_menu_editor->enqueue_scripts();
$wp_menu_editor->enqueue_styles();
///&noheader=1
?>
            <div class="supercustom_cms_section">
				<div class="supercustom_cms_title"><h3><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Menu editor options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></h3> 
                <form method="post" action="<?php echo admin_url('admin.php?page=WP_SuperCustomCMS'); ?>" id='supercustomcms_main_form' name='supercustomcms_main_form'>
                	<?php wp_nonce_field('menu-editor-form'); ?>
                	<input type="hidden" name="data" id="supercustomcms_data" value=""/>
                                                                                     
                    <span class="submitt"><input type="submit" id='supercustomcms_save_menu' class="button-abc" value=" " />
                    <!--<input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " />-->
                    </span>
                        <div class="clearfix"></div></div>
                            <div class="supercustom_cms_options" style="display: none;">
                            <div class="inside">
                        <?php $wp_menu_editor->page_menu_editor() ?>
    				</div>
    			</div>
                </form>  
		</div>
		