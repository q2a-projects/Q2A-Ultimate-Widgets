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
	'blank2' => array(
		'type' => 'blank',
	),
	'uw_prefix' => array(
		'label' => 'Prefix text(or HTML):',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_prefix"',
		'note' => 'This is the text which will show up before search box.',
	),
	'uw_suffix' => array(
		'label' => 'Suffix text(or HTML)',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_suffix"',
		'note' => 'This is the text which will show up after search box.',
	),

);
