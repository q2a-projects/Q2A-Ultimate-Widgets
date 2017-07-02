<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'type' => 'text',
		'tags' => 'name="uw_title"',
	),


	'uw_resize' => array(
		'label' => 'Show font resize buttons',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_resize"',
	),
	'uw_reset' => array(
		'label' => 'Show reset(font size) button',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_reset"',
	),
	'uw_night_mode' => array(
		'label' => 'Show Night Mode button',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_night_mode"',
	),
);
