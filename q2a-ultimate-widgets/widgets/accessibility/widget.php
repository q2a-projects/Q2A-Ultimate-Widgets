<?php

class accessibility {
	
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
		$resize = (bool)get_widget_option($widget_name, 'uw_resize');
		$reset = (bool)get_widget_option($widget_name, 'uw_reset');
		$night_mode = (bool)get_widget_option($widget_name, 'uw_night_mode');
		echo "
		<style>
		.night-mode {
			background-color: #000 !important;
			color: #FFF !important;
			background-image: none;
		}
		</style>
		";
		echo '<script src="' . UW_URL . 'include/cookie.js"></script>';
		echo '<script src="' . UW_URL . 'include/accessibility.js"></script>';

		echo '<aside class="uw-accessibility-widget">';
		if($title)
			echo '<H2 class="uw-accessibility-header">'. $title .'</H2>';

		echo '<button class="uw-accessibility-smaller" onclick="return uw_font_smaller(this);">' . qa_lang_html('uw/an') . '</button>';
		echo '<button class="uw-accessibility-larger" onclick="return uw_font_larger(this);">' . qa_lang_html('uw/ap') . '</button>';
		echo '<button class="uw-accessibility-reset" onclick="return uw_font_reset(this);">' . qa_lang_html('uw/reset') . '</button>';
		echo '<button class="uw-accessibility-night-mode" onclick="return uw_night_mode(this);">' . qa_lang_html('uw/night_mode') . '</button>';

		echo '</aside>';


	}
}
