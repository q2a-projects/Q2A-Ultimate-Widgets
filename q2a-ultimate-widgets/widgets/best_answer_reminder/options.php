<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'default-value' => 'Choose Best Answer',
		'tags' => 'name="uw_title"',
	),
	'uw_count' => array(
		'label' => 'Maximum number of posts in list:',
		'type' => 'number',
		'default-value' => '10',
		'tags' => 'NAME="uw_count"',
	),

	'blank1' => array(
		'type' => 'blank',
	),

	'uw_min_answers' => array(
		'label' => 'Minimum number of answers to make question eligible:',
		'type' => 'number',
		'default-value' => '3',
		'tags' => 'NAME="uw_min_answers"',
	),

	'blank1' => array(
		'type' => 'blank',
	),

	'uw_thumbnail' => array(
		'label' => 'Enable thumbnail image',
		'type' => 'checkbox',
		'default-value' => false,
		'tags' => 'NAME="uw_thumbnail"',
		'note' => 'read first image inside question content and show it as thumbnail image',
	),
	'uw_default_thumbnail' => array(
		'label' => 'Default thumbnail image URL',
		'tags' => 'NAME="uw_default_thumbnail"',
		'suffix' => 'leave empty to load no thumbnails',
	),
);
