<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'default-value' => 'Trending Topics',
		'tags' => 'name="uw_title"',
	),
	'uw_count' => array(
		'label' => 'number of items:',
		'type' => 'number',
		'default-value' => '5',
		'tags' => 'NAME="uw_count"',
	),
	'uw_hours' => array(
		'label' => 'Top topics in how many hours ago?',
		'type' => 'number',
		'suffix' => 'hours',
		'default-value' => '48',
		'tags' => 'NAME="uw_hours"',
	),
);
