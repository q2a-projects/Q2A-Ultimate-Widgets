<?php

class soundcloud {
	
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
		$prefix = get_widget_option($widget_name, 'uw_prefix');
		$suffix = get_widget_option($widget_name, 'uw_suffix');

	    if( strpos($code, 'soundcloud.com') )
	    	$code = $code;
	    else
	    	$code = 'http://api.soundcloud.com/tracks/' . $code;
	    $url = 'https://w.soundcloud.com/player/?url=' . $code;

		echo '<aside class="uw-youtube-widget">';
		if($title)
			echo '<H2 class="uw-youtube-header">'. $title .'</H2>';

		if($prefix)
			echo $prefix;
		echo '<iframe width="' . $width . '" height="' . $height . '" src="' . $url . '" frameborder="0" scrolling="no"></iframe>';
		if($suffix)
			echo $suffix;

		echo '</aside>';
	}
}
