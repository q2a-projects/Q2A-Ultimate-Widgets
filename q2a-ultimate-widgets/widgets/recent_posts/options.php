<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'default-value' => 'Recent Questions',
		'tags' => 'name="uw_title"',
	),
	'uw_count' => array(
		'label' => 'number of posts:',
		'type' => 'number',
		'default-value' => '10',
		'tags' => 'NAME="uw_count"',
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
