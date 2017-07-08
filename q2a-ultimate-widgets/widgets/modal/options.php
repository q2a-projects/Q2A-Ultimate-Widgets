<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'type' => 'text',
		'tags' => 'name="uw_title"',
	),

	'uw_button' => array(
		'label' => 'Button Text:',
		'type' => 'text',
		'default-value' => 'Call to Action',
		'tags' => 'name="uw_button"',
	),
	'uw_close' => array(
		'label' => 'Show "Close" button on modal.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'name="uw_close"',
	),
	'uw_text' => array(
		'label' => 'Modal Content(static text or HTML):',
		'type' => 'textarea',
		'rows' => '6',
		'default-value' => '',
		'tags' => 'NAME="uw_text"',
	),
	'blank' => array(
		'type' => 'blank',
	),
	'uw_prefix' => array(
		'label' => 'Prefix text(or HTML):',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_prefix"',
		'note' => 'This is the text which will show up before button.',
	),
	'uw_suffix' => array(
		'label' => 'Suffix text(or HTML)',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_suffix"',
		'note' => 'This is the text which will show up after button.',
	),

);
