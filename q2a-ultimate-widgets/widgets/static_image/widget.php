<?php

class static_image {
	
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
		$image = get_widget_option($widget_name, 'uw_image');
		$link = get_widget_option($widget_name, 'uw_link');
		$image_title = get_widget_option($widget_name, 'uw_image_title');
		$image_alt = get_widget_option($widget_name, 'uw_image_alt');
		$width = get_widget_option($widget_name, 'uw_width');
		$height = get_widget_option($widget_name, 'uw_height');
		$prefix = get_widget_option($widget_name, 'uw_prefix');
		$suffix = get_widget_option($widget_name, 'uw_suffix');

		echo '<aside class="uw-static-image-widget">';
		if($title)
			echo '<H2 class="uw-static-image-header">'. $title .'</H2>';

		if($prefix)
			echo '<div class="uw-static-image-prefix">'. $prefix .'</div>';

		if($link)
			echo '<a class="uw-static-image-link" href="' . $link . '">';

		echo '<img src="' . @$image . '" alt="' . @$image_alt . '" title="' . @$image_title . '" width="' . @$width . '" height="' . @$height . '">';

		if($link)
			echo '</a>';

		if($suffix)
			echo '<div class="uw-static-image-siffic">'. $suffix .'</div>';

		echo '</aside>';


	}
}
