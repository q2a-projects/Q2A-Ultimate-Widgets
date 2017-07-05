<?php

class static_text {
	
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

		echo '<aside class="uw-static-text-widget">';
		if($title)
			echo '<H2 class="uw-static-text-header">'. $title .'</H2>';

		echo '<div class="uw-static-text-content">';
		echo $text;
		echo '</div>';

		echo '</aside>';


	}
}
