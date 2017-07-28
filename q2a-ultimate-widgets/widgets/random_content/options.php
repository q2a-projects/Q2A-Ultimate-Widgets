<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Default Widget Title',
		'tags' => 'name="uw_title"',
		'note' => 'If any of randomly selected fields has a title, then it\'ll show as widget\'s title. otherwise this field\'s value will show up as title.',
	),
	'uw_count' => array(
		'label' => 'Number of random content',
		'type' => 'number',
		'default-value' => '3',
		'tags' => 'NAME="uw_count"',
	),
);
function random_content($widget_options, $option_key){
	$count = (int)get_widget_option($option_key, 'uw_count');
	if($count<=1){
		$widget_options['uw_count']['value'] = 3;
		$count = 3;
	}
	for ($i=0; $i < $count; $i++) { 
		$num = (string)$i+1;
		$widget_options['note_'. $i] = array(
			'note' => '<hr>',
			'type' => 'static',
		);
		$widget_options['uw_title_'. $i] = array(
			'label' => 'Title #'. $num,
			'type' => 'text',
			'tags' => 'NAME="uw_title_'. $i .'"',
		);
		$widget_options['uw_content_'. $i] = array(
			'label' => 'Content #'. $num,
			'type' => 'textarea',
			'rows' => '3',
			'tags' => 'NAME="uw_content_'. $i .'"',
		);
	}
	
	return $widget_options;
}