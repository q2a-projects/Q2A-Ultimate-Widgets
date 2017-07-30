<?php

class social_links {
	public $allow_cache = true;
	
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
		$options = get_widget_options($widget_name);
		$style = get_widget_option($widget_name, 'uw_style');;

		echo '<aside class="uw-social-link-widget uw-' . $widget_name . '">';
		echo '<ul class="social-nav ' . $style .'">';
		for ($i=0; $i < 32; $i++) {
			if($options['uw_link_'.$i]){
				echo '<li class="bg-color-' . $options['uw_icon_'.$i] . '"><a href="' . $options['uw_link_'.$i] . '"><i class="' . $options['uw_icon_'.$i] . '"></i></a></li>';
			}
		}

		echo '</aside>';
	}
}
