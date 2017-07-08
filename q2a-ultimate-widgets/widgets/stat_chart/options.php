<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'tags' => 'name="uw_title"',
	),
	'uw_type' => array(
		'label' => 'Chart Type:',
		'options' => array("bar"=>"bar", "radar"=>"radar", "polarArea"=>"Polar Area", "pie"=>"pie", "doughnut"=>"doughnut"),
		'type' => 'select',
		'default-value' => 'pie',
		'tags' => 'NAME="uw_type"',
		'match_by' => 'key',
	),
	'uw_labels' => array(
		'label' => 'Show Lables on top of chart.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_labels"',
		'note' => 'If checked, four lables will show on top of the chart to allow hiding chart data.',
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
		'label' => 'Questions color:',
		'type' => 'text',
		'default-value' => '#3e95cd',
		'tags' => 'NAME="uw_color_q"',
	),
	'uw_color_a' => array(
		'label' => 'Answers color:',
		'type' => 'text',
		'default-value' => '#3cba9f',
		'tags' => 'NAME="uw_color_a"',
	),
	'uw_color_c' => array(
		'label' => 'Comments color:',
		'type' => 'text',
		'default-value' => '#5EB5EF',
		'tags' => 'NAME="uw_color_c"',
	),
	'uw_color_u' => array(
		'label' => 'Users color:',
		'type' => 'text',
		'default-value' => '#C2C4D1',
		'tags' => 'NAME="uw_color_u"',
	),
	'note' => array(
		'note' => '<span>You can use hex, rgb or rgba color codes. to find color codes you can use a <a href="https://www.w3schools.com/colors/colors_picker.asp">color Picker</a>.</span>',
		'type' => 'static',
	),
);
