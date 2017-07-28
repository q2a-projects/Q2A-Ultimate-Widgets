<?php

class random_content {
	
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
		$default_title=get_widget_option($widget_name, 'uw_title');
		$count = (int)get_widget_option($widget_name, 'uw_count');;

		$id = rand(0, $count-1);

		$title = get_widget_option($widget_name, 'uw_title_'.$id);
		$content = get_widget_option($widget_name, 'uw_content_'.$id);

		echo '<aside class="uw-random-content-widget">';
		if($title)
			echo '<H2 class="uw-random-content-header">'.$title.'</H2>';
		elseif($default_title)
			echo '<H2 class="uw-random-content-header">'.$default_title.'</H2>';
		if($content)
			echo '<div class="uw-random-content-text">'.$content.'</div>';
		echo '</aside>';
	}
}
