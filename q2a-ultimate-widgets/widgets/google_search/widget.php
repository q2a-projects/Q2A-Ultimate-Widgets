<?php

class google_search {
	
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
		$button = (bool)get_widget_option($widget_name, 'button');;

		echo '<aside class="uw-google-search-widget">';
		if($title)
			echo '<H2 class="uw-google-search-header">'.$title.'</H2>';

		echo '<form action="http://www.google.com/search" class="searchform" method="get" name="searchform" target="_blank">';
		echo '<input name="sitesearch" type="hidden" value="' . qa_opt('site_url') . '">';
		echo '<input autocomplete="on" class="uw-google-search-input" name="q" placeholder="' . $palceholder . '" required="required"  type="text">';
		if($title)
			echo '<button class="uw-google-search-button" type="submit">' . qa_lang_html('uw/search') . '</button>';
		echo '</form>';

			
		echo '</aside>';
	}
}
