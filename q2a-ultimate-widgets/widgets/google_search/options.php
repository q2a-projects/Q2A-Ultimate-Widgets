<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'tags' => 'name="uw_title"',
	),
	'uw_palceholder' => array(
		'label' => 'Placeholder Text for textbox',
		'type' => 'text',
		'default-value' => 'Search ' . qa_opt('site_title'),
		'tags' => 'NAME="uw_palceholder"',
	),
	'uw_button' => array(
		'label' => 'Show search button.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_button"',
	),
);
