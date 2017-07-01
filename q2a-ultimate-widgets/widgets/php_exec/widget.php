<?php

class php_exec {
	
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
		$title = get_widget_option($widget_name, 'uw_title');
		$text = get_widget_option($widget_name, 'uw_text');

		echo '<aside class="uw-php-exec-widget">';
		if($title)
			echo '<H2 class="uw-trending-topics-header">'. $title .'</H2>';

		ob_start();
		eval('?>'.$text);
		$text = ob_get_contents();
		ob_end_clean();
		echo $text;
		echo '<aside class="uw-php-exec-widget">';
	}
}
