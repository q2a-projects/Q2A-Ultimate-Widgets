<?php

class alert {
	
	function allow_template($template)
	{
		return true;
	}

	function allow_region($region)
	{
		return true;
	}
	
	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		$widget_name = get_class($this) . '_' .strtoupper(substr($region,0,1).substr($place,0,1)) ;
		$text = get_widget_option($widget_name, 'uw_text');
		$type = get_widget_option($widget_name, 'uw_type');
		$close = (bool)get_widget_option($widget_name, 'uw_close');
		$show_x = (bool)get_widget_option($widget_name, 'uw_show_x');
		$close_title = get_widget_option($widget_name, 'uw_close_title');

		if($close){
			echo '<script src="' . UW_URL . 'include/cookie.js"></script>';
			echo '<script src="' . UW_URL . 'include/alert.js"></script>';
			echo '<script>
				$(document).ready(function(){
					hide = doCookie("uw-' . $widget_name . '");
					if(hide==1)
						$(".uw-' . $widget_name . '").hide();
				});
				</script>';
		}

		echo '<aside class="uw-alert-widget uw-' . $widget_name . ' ' . $type .'">';

		if($close){
			echo '<button onclick="return close_alert(this);" closed-box="uw-' . $widget_name . '" class="close uw-alert-close" type="button" data-dismiss="alert" aria-label="Close" title="' . @$close_title . '">';
				if($show_x)
					echo '<span aria-hidden="true">×</span>';
				elseif($close_title)
					echo $close_title;
			echo '</button>';
		}
		if($text)
			echo $text;

		echo '</aside>';
	}
}
