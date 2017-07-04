<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'tags' => 'name="uw_title"',
	),
	'uw_days' => array(
		'label' => 'Statistic charts fo number of days:',
		'type' => 'number',
		'default-value' => '7',
		'tags' => 'NAME="uw_days"',
	),
	'uw_type' => array(
		'label' => 'Chart Type:',
		'options' => array("line"=>"line", "bar"=>"bar", "radar"=>"radar", "polarArea"=>"Polar Area", "pie"=>"pie", "doughnut"=>"doughnut", "bubble"=>"bubble", "scatter"=>"scatter"),
		'type' => 'select',
		'default-value' => 'line',
		'tags' => 'NAME="uw_type"',
		'match_by' => 'key',
	),
	'uw_local' => array(
		'label' => 'Use local static files.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_local"',
		'note' => 'Uncheck to use CDN',
	),
	'blank1' => array(
		'type' => 'blank',
	),
	'uw_color_q' => array(
		'label' => 'Question color:',
		'type' => 'text',
		'default-value' => '#3e95cd',
		'tags' => 'NAME="uw_color_q"',
	),
	'uw_color_a' => array(
		'label' => 'Answer color:',
		'type' => 'text',
		'default-value' => '#3cba9f',
		'tags' => 'NAME="uw_color_a"',
	),
	'uw_color_c' => array(
		'label' => 'Comment color:',
		'type' => 'text',
		'default-value' => '#e8c3b9',
		'tags' => 'NAME="uw_color_c"',
	),
	'note' => array(
		'note' => '<span>You can use hex, rgb or rgba color codes. to find color codes you can use a <a href="https://www.w3schools.com/colors/colors_picker.asp">color Picker</a>.</span>',
		'type' => 'static',
	),
);
