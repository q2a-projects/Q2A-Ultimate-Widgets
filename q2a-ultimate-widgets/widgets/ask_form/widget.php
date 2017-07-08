<?php

class ask_form {
	
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

		if (isset($qa_content['categoryids']))
			$params=array('cat' => end($qa_content['categoryids']));
		else
			$params=null;

		echo '<aside class="uw-ask-widget">';
		if($title)
			echo '<H2 class="uw-ask-header">'.$title.'</H2>';

		echo '<form action="' . qa_path_html('ask', $params) . '" method="post">';
		if($prefix)
			echo $prefix;

		echo '<input autocomplete="on" class="uw-ask-input" name="title" placeholder="' . $palceholder . '" required="required"  type="text">';
		echo '<input type="hidden" name="doask1" value="1">';
		if($button)
			echo '<button class="uw-ask-button" type="submit">' . qa_lang_html('uw/ask') . '</button>';
		if($suffix)
			echo $suffix;
		echo '</form>';

			
		echo '</aside>';
	}
}
