<?php
function get_widget_options($widget_key){
	global $widget_options;
	$option_key = 'uw_option_'.$widget_key;
	if(! isset($widget_options[$option_key]))
		$widget_options[$option_key] = json_decode( qa_opt($option_key), true);
	return $widget_options[$option_key];
}
function get_widget_option($option_key, $option){
	$options = get_widget_options($option_key);
	return @$options[$option];
}
function get_widget_option_fields($widget_name, $option_key){
	// get $widget_options from file
	include UW_DIR.'/widgets/'.$widget_name.'/options.php'; // get local variable for options from widget module
	if( function_exists($widget_name) )
		$widget_options = $widget_name($widget_options, $option_key);
	return $widget_options;
}

function get_widget_option_form($widget_name, $option_key){
	$fields = get_widget_option_fields($widget_name, $option_key);
	$options = get_widget_options($option_key);
	// if there are css files in this widget add them to options
	$styles_path = UW_DIR.'/widgets/'.$widget_name.'/styles/';
	if(file_exists($styles_path)){
		$fields = array('uw_styles' => array(
					'label' => 'Active CSS Style for widget:',
					'options' => array('none' => 'No Styling'),
					'type' => 'select',
					'default-value' => 'none',
					'tags' => 'NAME="uw_styles"',
					'match_by' => 'key',
				)) + $fields;
		foreach(glob($styles_path .'*.css') as $file)
			$fields['uw_styles']['options'] += array(basename($file) => substr(basename($file), 0, -4)); // remove .css from file name
		$active_style = get_widget_option($option_key, 'uw_styles');
		//if( !$active_style or $active_style='' or $active_style=='none' )
		//	$fields['uw_styles']['options']['value'] = 'none';
	}
	// set default values
	foreach ($fields as $key => $field) {
		if( isset($options[$key]) )
			$fields[$key]['value'] = qa_html($options[$key]);
		else
			if( isset($fields[$key]['default-value']) )
				$fields[$key]['value'] = $fields[$key]['default-value'];
			else
				$fields[$key]['value'] = '';
	}

	return $fields;
}


function uw_get_base_url()
{
	/* First we need to get the protocol the website is using */
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';

	/* returns /myproject/index.php */
	if(QA_URL_FORMAT_NEAT == 0 || strpos($_SERVER['PHP_SELF'],'/index.php/') !== false):
		$path = strstr($_SERVER['PHP_SELF'], '/index', true);
		$directory = $path;
	else:
		$path = $_SERVER['PHP_SELF'];
		$path_parts = pathinfo($path);
		$directory = $path_parts['dirname'];
		$directory = ($directory == "/") ? "" : $directory;
	endif;       
		
		$directory = ($directory == "\\") ? "" : $directory;
		
	/* Returns localhost OR mysite.com */
	$host = $_SERVER['HTTP_HOST'];

	return $protocol . $host . $directory;
}