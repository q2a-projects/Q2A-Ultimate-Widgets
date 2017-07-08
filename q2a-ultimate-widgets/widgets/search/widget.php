<?php

class search {
	
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
		$title=get_widget_option($widget_name, 'uw_title');
		$palceholder = get_widget_option($widget_name, 'uw_palceholder');;
		$button = (bool)get_widget_option($widget_name, 'uw_button');;
		$prefix = get_widget_option($widget_name, 'uw_prefix');;
		$suffix = get_widget_option($widget_name, 'uw_suffix');;

		echo '<aside class="uw-search-widget">';
		if($title)
			echo '<H2 class="uw-search-header">'.$title.'</H2>';

		echo '<form action="' . qa_path_html('search') . '" method="get">';
		if($prefix)
			echo $prefix;

		echo '<input autocomplete="on" class="uw-search-input" name="q" placeholder="' . $palceholder . '" required="required"  type="text">';
		if($button)
			echo '<button class="uw-search-button" type="submit">' . qa_lang_html('uw/search') . '</button>';
		if($suffix)
			echo $suffix;
		echo '</form>';

			
		echo '</aside>';
	}
}
