<?php

class youtube {
	
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
		$code = get_widget_option($widget_name, 'uw_code');
		$width = get_widget_option($widget_name, 'uw_width');
		$height = get_widget_option($widget_name, 'uw_height');
		$fullscreen = (bool)get_widget_option($widget_name, 'uw_fullscreen');
		$prefix = get_widget_option($widget_name, 'uw_prefix');
		$suffix = get_widget_option($widget_name, 'uw_suffix');

	    $last_bit = explode('v=',$code);
	    if( isset($last_bit[1]) )
	    	$last_bit = explode('&',$last_bit[1]);
	    $video = '//www.youtube.com/embed/' . $last_bit[0];

		echo '<aside class="uw-youtube-widget">';
		if($title)
			echo '<H2 class="uw-youtube-header">'. $title .'</H2>';

		if($prefix)
			echo $prefix;
		echo '<iframe width="' . $width . '" height="' . $height . '" src="' . $video . '" frameborder="0" ' . ($fullscreen ? 'allowfullscreen':''). '></iframe>';
		if($suffix)
			echo $suffix;

		echo '</aside>';
	}
}
