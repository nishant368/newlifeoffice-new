<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
require_once("../api.php");

$post_id = intval($_REQUEST['ID']);
//-----------
//No need to control access here. this does not writes.
//-------------

class SCTypes {
	var $uid = 0;
	var $scripts = array();
	var $styles = array();
	var $allowed_types = array(
		'text',
		'textarea',
		'rtf',
		'colorpicker',
		'dropdown',
		'slider',
		'data',
		'label',
		'hidden',
		'ui_theme'
	);
	
	function SCTypes(){
	
	}
	
	function get_fields($shortcode, &$fields, $q=1000){
		echo "<input type=\"hidden\" class=\"mce-item mce-scopentag\" value=\"$shortcode\" />";
		if(is_array($fields)&&count($fields)==0){
			echo "<input type=\"hidden\" class=\"mce-item mce-scclose\" value=\"$shortcode\" />";
			return;
		}
		$r = 0;
		$last_field = (object)array('content'=>0);
		while( ($r++<$q) && ($field=array_shift($fields)) ){		
			echo $this->get_field($field,$fields,$last_field);
			$last_field = $field;
		}
		if( isset($last_field->content) && $last_field->content!=1 && $last_field->type!='data' ){
			echo "<input type=\"hidden\" class=\"mce-item mce-scclose\" value=\"$shortcode\" />";
		}
		echo "<input type=\"hidden\" class=\"mce-item mce-scclosetag\" value=\"$shortcode\" />";
	}
	
	function get_field($field,&$fields,$last_field){
		if(!in_array($field->type,$this->allowed_types)){return '';}
		$method = $field->type;
		return $this->$method($field,$fields,$last_field);	
	}

	function get_classes($field){
		$tmp = array();
		if( isset($field->content) && $field->content==1 ){
			$tmp[]='mce-content';
		}else{
			$tmp[]='mce-property';
		}
		if( isset($field->classes) && trim($field->classes)!=''){
			$tmp[]=$field->classes;
		}
		if(property_exists($field,'jsfunc') && ''!=trim($field->jsfunc)){
			$tmp[]='parse-with-rel';
		}
		return implode(' ',$tmp);
	}
	
	function data($field,&$fields,$last_field){
		if( isset($last_field->content) && $last_field->content!=1 ){
			echo "<input type=\"hidden\" class=\"mce-item mce-scclose\" value=\"$shortcode\" />";
		}	
?>
<div class="mce-data">
	<h3 class="mce-data-label"><?php echo $field->label; ?></h3>
	<div class="mce-data-rows">
		<div class="mce-data-row">
			<div class="mce-data-row-content">
				<span class="mce-row-delete">&nbsp;</span>
				<?php $this->get_fields($field->shortcode,$fields,$field->field_number)?>
			</div>
		</div>
	</div>
	
	<div class="mce-data-control">
		<input type="button" class="button-secondary add-mce-data-row" value="<?php echo (isset($field->button_label)&&trim($field->button_label)!='')?$field->button_label:'Add data'?>" />
	</div>
</div>
<?php
	}
	
	function get_jsfunc($field){
		if(property_exists($field,'jsfunc') && ''!=trim($field->jsfunc)){
			return str_replace('"','\"',str_replace('{val}',"_val", sprintf("_val = %s ;",$field->jsfunc)));
		}
		return '';
	}
	
	function text($field){
		$field->id = sprintf( "mce-text-%s", $this->uid++ );
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>
			<label class="css-mce-label"><?php echo $field->label; ?></label>
			<div class="css-mce-input">
				<?php echo sprintf("<input id=\"%s\" name=\"%s\" type=\"text\" class=\"mce-item %s\" value=\"%s\" rel=\"%s\" />",$field->id,$field->name,$this->get_classes($field),$field->default,$this->get_jsfunc($field)); ?>
				<?php $this->get_helper($field) ?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function hidden($field){
		echo sprintf("<input id=\"mce-text-%s\" name=\"%s\" type=\"hidden\" class=\"mce-item %s\" value=\"%s\" />",$this->uid++,$field->name,$this->get_classes($field),$field->default); 
	}
	
	function label($field){
?>
		<div class="fieldset">
			<label class="css-mce-field-label <?php echo $this->get_classes($field)?>"><?php echo $field->label; ?></label>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function textarea($field){
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>		
			<label class="css-mce-label"><?php echo $field->label?></label>
			<div class="css-mce-input">
				<?php echo sprintf("<textarea id=\"mce-textarea-%s\" name=\"%s\" class=\"mce-item %s\" rel=\"%s\" >%s</textarea>",$this->uid++,$field->name,$this->get_classes($field),$this->get_jsfunc($field),$field->default); ?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function rtf($field){
		//this is just for future release
		$uid = $this->uid++;
		
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>		
			<label class="css-mce-label"><?php echo $field->label?></label>
			<div class="css-mce-input">
				<?php echo sprintf("<textarea id=\"mce-textarea-%s\" name=\"%s\" class=\"mce-item %s\" rel=\"%s\">%s</textarea>",$uid,$field->name,$this->get_classes($field),$this->get_jsfunc($field),$field->default); ?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	
	function colorpicker($field){
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>		
			<label class="css-mce-label"><?php echo $field->label; ?></label>
			<div class="css-mce-input">
				<?php echo sprintf("<input id=\"mce-colorpicker-%s\" name=\"%s\" type=\"text\" class=\"mce-item sws-colorpicker %s\" value=\"%s\" maxlength=\"6\" size=\"6\" />",$this->uid++,$field->name,$this->get_classes($field),$field->default);?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function ui_theme($field){
		global $sws_plugin;
		$field->options = '';
		foreach($sws_plugin->sws_styles as $s){
			if($s->ui_theme){
				$field->options.=sprintf("%s|%s\n",$s->id,$s->label);
			}
		}
		if($this->have_class('admin-load-ui-theme',$field)){
			$field->extra.=' OnChange="javascript:load_ui_theme(this,\''.WPCSS_URL.'api/wp_print_styles.php\');"';
		}
		$this->dropdown($field);
	}
	
	function have_class($class,$field){
		if( property_exists($field,'classes') && trim($field->classes)!=''){
			$classes = explode(' ',$field->classes);
			return in_array($class,$classes);
		}	
		return false;
	}
		
	function dropdown($field){
		$options = explode("\n", (isset($field->options)?$field->options:'|no options') );
		
		$str = sprintf("<select id=\"mce-dropdown-%s\" name=\"%s\" class=\"mce-item %s\" %s>",$this->uid++,$field->name,$this->get_classes($field),(property_exists($field,'extra')?$field->extra:''));
		if(is_array($options)&&count($options)>0){
			foreach($options as $row){
				$pair = explode('|',$row);
				if(count($pair)>=2){
					//$str.= sprintf("<option %s value=\"%s\">%s</option>",(isset($pair[2])?$pair[2]:''),$pair[0],$pair[1]);
					$str.= sprintf("<option %s value=\"%s\">%s</option>",(isset($pair[2])?$pair[2]:($pair[0]==$field->default?'selected':'')),$pair[0],$pair[1]);
				}
			}
		}
		$str.="</select>";
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>		
			<label class="css-mce-label"><?php echo $field->label?></label>
			<div class="css-mce-input">
				<?php echo $str?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function slider($field){
		$step = property_exists($field,'step')?$field->step:0;
?>
		<div class="fieldset">
			<?php if(!empty($field->description)) :?>
			<div class="description"><?php echo $field->description?></div>
			<?php endif;?>		
			<label class="css-mce-label"><?php echo $field->label ?></label>
			<div class="css-mce-input">
				<?php echo sprintf("<input name=\"%s\" class=\"mce-item sws-rangeinput %s\" type=\"range\" min=\"%s\" max=\"%s\" value=\"%s\" step=\"%s\" />",$field->name,$this->get_classes($field),((isset($field->min)?$field->min:0)),((isset($field->max)?$field->max:100)),$field->default,$step);?>
			</div>
			<div class="clearer"></div>
		</div>
<?php
	}
	
	function scripts(){
		echo "<script type=\"text/javascript\">".implode(" ",$this->scripts)."</script>";
	}
	
	function get_helper($field){
		if($this->have_class('helper-ui-icon', $field )){
			$this->helper_ui_icon($field);
		}
	}
	
	function helper_ui_icon($field){
		$ui_icons = array('ui-icon-carat-1-n','ui-icon-carat-1-ne','ui-icon-carat-1-e','ui-icon-carat-1-se','ui-icon-carat-1-s','ui-icon-carat-1-sw','ui-icon-carat-1-w','ui-icon-carat-1-nw','ui-icon-carat-2-n-s','ui-icon-carat-2-e-w','ui-icon-triangle-1-n','ui-icon-triangle-1-ne','ui-icon-triangle-1-e','ui-icon-triangle-1-se','ui-icon-triangle-1-s','ui-icon-triangle-1-sw','ui-icon-triangle-1-w','ui-icon-triangle-1-nw','ui-icon-triangle-2-n-s','ui-icon-triangle-2-e-w','ui-icon-arrow-1-n','ui-icon-arrow-1-ne','ui-icon-arrow-1-e','ui-icon-arrow-1-se','ui-icon-arrow-1-s','ui-icon-arrow-1-sw','ui-icon-arrow-1-w','ui-icon-arrow-1-nw','ui-icon-arrow-2-n-s','ui-icon-arrow-2-ne-sw','ui-icon-arrow-2-e-w','ui-icon-arrow-2-se-nw','ui-icon-arrowstop-1-n','ui-icon-arrowstop-1-e','ui-icon-arrowstop-1-s','ui-icon-arrowstop-1-w','ui-icon-arrowthick-1-n','ui-icon-arrowthick-1-ne','ui-icon-arrowthick-1-e','ui-icon-arrowthick-1-se','ui-icon-arrowthick-1-s','ui-icon-arrowthick-1-sw','ui-icon-arrowthick-1-w','ui-icon-arrowthick-1-nw','ui-icon-arrowthick-2-n-s','ui-icon-arrowthick-2-ne-sw','ui-icon-arrowthick-2-e-w','ui-icon-arrowthick-2-se-nw','ui-icon-arrowthickstop-1-n','ui-icon-arrowthickstop-1-e','ui-icon-arrowthickstop-1-s','ui-icon-arrowthickstop-1-w','ui-icon-arrowreturnthick-1-w','ui-icon-arrowreturnthick-1-n','ui-icon-arrowreturnthick-1-e','ui-icon-arrowreturnthick-1-s','ui-icon-arrowreturn-1-w','ui-icon-arrowreturn-1-n','ui-icon-arrowreturn-1-e','ui-icon-arrowreturn-1-s','ui-icon-arrowrefresh-1-w','ui-icon-arrowrefresh-1-n','ui-icon-arrowrefresh-1-e','ui-icon-arrowrefresh-1-s','ui-icon-arrow-4','ui-icon-arrow-4-diag','ui-icon-extlink','ui-icon-newwin','ui-icon-refresh','ui-icon-shuffle','ui-icon-transfer-e-w','ui-icon-transferthick-e-w','ui-icon-folder-collapsed','ui-icon-folder-open','ui-icon-document','ui-icon-document-b','ui-icon-note','ui-icon-mail-closed','ui-icon-mail-open','ui-icon-suitcase','ui-icon-comment','ui-icon-person','ui-icon-print','ui-icon-trash','ui-icon-locked','ui-icon-unlocked','ui-icon-bookmark','ui-icon-tag','ui-icon-home','ui-icon-flag','ui-icon-calendar','ui-icon-cart','ui-icon-pencil','ui-icon-clock','ui-icon-disk','ui-icon-calculator','ui-icon-zoomin','ui-icon-zoomout','ui-icon-search','ui-icon-wrench','ui-icon-gear','ui-icon-heart','ui-icon-star','ui-icon-link','ui-icon-cancel','ui-icon-plus','ui-icon-plusthick','ui-icon-minus','ui-icon-minusthick','ui-icon-close','ui-icon-closethick','ui-icon-key','ui-icon-lightbulb','ui-icon-scissors','ui-icon-clipboard','ui-icon-copy','ui-icon-contact','ui-icon-image','ui-icon-video','ui-icon-script','ui-icon-alert','ui-icon-info','ui-icon-notice','ui-icon-help','ui-icon-check','ui-icon-bullet','ui-icon-radio-off','ui-icon-radio-on','ui-icon-pin-w','ui-icon-pin-s','ui-icon-play','ui-icon-pause','ui-icon-seek-next','ui-icon-seek-prev','ui-icon-seek-end','ui-icon-seek-start','ui-icon-seek-first','ui-icon-stop','ui-icon-eject','ui-icon-volume-off','ui-icon-volume-on','ui-icon-power','ui-icon-signal-diag','ui-icon-signal','ui-icon-battery-0','ui-icon-battery-1','ui-icon-battery-2','ui-icon-battery-3','ui-icon-circle-plus','ui-icon-circle-minus','ui-icon-circle-close','ui-icon-circle-triangle-e','ui-icon-circle-triangle-s','ui-icon-circle-triangle-w','ui-icon-circle-triangle-n','ui-icon-circle-arrow-e','ui-icon-circle-arrow-s','ui-icon-circle-arrow-w','ui-icon-circle-arrow-n','ui-icon-circle-zoomin','ui-icon-circle-zoomout','ui-icon-circle-check','ui-icon-circlesmall-plus','ui-icon-circlesmall-minus','ui-icon-circlesmall-close','ui-icon-squaresmall-plus','ui-icon-squaresmall-minus','ui-icon-squaresmall-close','ui-icon-grip-dotted-vertical','ui-icon-grip-dotted-horizontal','ui-icon-grip-solid-vertical','ui-icon-grip-solid-horizontal','ui-icon-gripsmall-diagonal-se','ui-icon-grip-diagonal-se');
	
?>
<div class="helper-ui-icon">
	<ul class="ui-widget ui-helper-clearfix">
<?php foreach($ui_icons as $icon): ?>
	<li class="ui-state-default ui-corner-all" rel="#<?php echo $field->id?>" title="<?php echo $icon ?>">
		<span style="float: left; margin-right: 0.3em;" class="ui-icon-helper ui-icon <?php echo $icon ?>" rel="<?php echo $icon ?>"></span>
	</li>
<?php endforeach; ?>
	</ul>
</div>
<?php		
	}
}

$SCTypes = new SCTypes();

$fields = get_post_meta($post_id,'sc_fields',true);

if(is_array($fields)&&count($fields)>0){
	foreach($fields as $index => $f){
		if(!isset($f->content)){
			$fields[$index]->content = 0;
		}
	}
}

$shortcode = get_post_meta($post_id,'sc_shortcode',true);

$template = get_post_meta($post_id,'sc_template',true);

$con = (object)array(
	'label' => 'Content',
	'name' => 'content',
	'default'=> ' ',
	'content'=> 1,
	'type'=>'textarea'
);

if(false!==strpos($template,'{content}') && !isset($fields['content'])){
	$have_content=false;
	if(is_array($fields) && count($fields)>0){
		foreach($fields as $f){
			if($f->content==1 || $f->type=='data'){
				$have_content=true;
				break;
			}
		}	
	}

	if(!$have_content){
		$fields['content']=$con;
	}
}

if(is_array($fields) && count($fields)>0):
	$SCTypes->get_fields($shortcode, $fields);
else:
?>
<input type="hidden" class="mce-item mce-scopentag" value="<?php echo $shortcode?>" />
<input type="hidden" class="mce-item mce-scclose" value="<?php echo $shortcode?>" />
<?php 
endif; ?>

		<input type="hidden" id="sc_shortcode" name="sc_shortcode" value="<?php echo $shortcode?>" />
		<div class="fieldset-buttons">
			<input type="button" OnClick="javascript:insert_csshortcode();" class="button-primary" value="Insert shortcode" />
		</div>
		<div class="clearer"></div>
<?php $SCTypes->scripts(); ?>
<script type='text/javascript' src='<?php echo WPCSS_URL?>js/jquery.tools.rangeinput.min.js'></script>
<script type='text/javascript' src='<?php echo WPCSS_URL?>colorpicker/js/colorpicker.js'></script>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function($){	
		$('#TB_ajaxContent').css('height','90%');
		$('#TB_ajaxContent').css('width','96%');
		
		$('.mce-row-delete').click(function(){
			$(this).parent().parent().remove();
		});
		$('.add-mce-data-row').click(function(){
			$(this).parent().parent().find('.mce-data-row:first').clone()
				.find('.mce-row-delete').click(function(){
					$(this).parent().parent().slideUp(function(){
						$(this).remove();
					})
				})
				.show().parent().parent()
				.hide().appendTo( $(this).parent().parent().find('.mce-data-rows') ).slideDown('fast',function(){
					set_helpers();
				});
		});
		$('.admin-load-ui-theme').change();
		
		//--
		set_helpers();
});

function set_helpers(){
	set_ui_icon_helper();
	set_colorpicker_helper();
	set_slider();
}

function set_slider(){
	jQuery(document).ready(function($){
		$( ".sws-rangeinput" ).each(function(i,inp){
			if(!$(inp).data("rangeinput")){
				$(this).parent().find('.slider').remove();//because of clone, remove the already added html element.
				$(this).rangeinput();		
			}			
		});
	});
}

function set_colorpicker_helper(){
	jQuery(document).ready(function($){
		if($('.sws-colorpicker').length==0)
			return;
		$('.sws-colorpicker').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(e){
			$(this).ColorPickerSetColor(this.value);
			 if (e.keyCode == 27) { $(this).ColorPickerHide(); }
		});
	});
}

function set_ui_icon_helper(){
	jQuery(document).ready(function($){
		$('.helper-ui-icon li').hover(function(){$(this).addClass('ui-state-hover');},function(){$(this).removeClass('ui-state-hover');})
			.click(function(){
				$(this).parent().parent().parent().find('input:first').val( $(this).attr('title') );
			});	
	});
}

</script>