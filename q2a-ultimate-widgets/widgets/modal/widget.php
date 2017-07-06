<?php

class modal {
	
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
		$button = get_widget_option($widget_name, 'uw_button');
		$close = (bool)get_widget_option($widget_name, 'uw_close');
		$text = get_widget_option($widget_name, 'uw_text');
		$prefix = get_widget_option($widget_name, 'uw_prefix');
		$suffix = get_widget_option($widget_name, 'uw_suffix');

		echo '<script src="' . UW_URL . 'include/modal.js"></script>';
		echo '
<style>
.uw-modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}
.uw-modal-content {
    background-color: #fefefe;
    margin: auto;
    border: 1px solid #888;
    width: 80%;
}
.uw-close {
    color: #aaaaaa;
    float: right;
    font-size: 18px;
    font-weight: bold;
}
.uw-close:hover,
.uw-close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
		';
		echo '<aside class="uw-modal-widget">';
		if($title)
			echo '<H2 class="uw-modal-header">'. $title .'</H2>';

		if($prefix)
			echo $prefix;
		echo '<button onclick="show_modal(\'uw-modal-' . $widget_name . '\')" id="uw-modal-btn-'. $widget_name .'">'. $button .'</button>';
		if($suffix)
			echo $suffix;

		echo '<div class="uw-modal" id="uw-modal-'. $widget_name .'"><div class="uw-modal-content" id="uw-modal-content-'. $widget_name .'">';
		if($close)
			echo '<div class="uw-close">&times;</div>';
		echo $text;
		echo '</div></div>';

		echo '</aside>';


	}
}
