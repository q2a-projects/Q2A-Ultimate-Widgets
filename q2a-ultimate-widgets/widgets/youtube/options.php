<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'type' => 'text',
		'tags' => 'name="uw_title"',
	),

	'uw_code' => array(
		'label' => 'Youtube Video\'s link or code:',
		'type' => 'text',
		'tags' => 'name="uw_code"',
	),
	'uw_width' => array(
		'label' => 'Video\'s width:',
		'type' => 'text',
		'tags' => 'name="uw_width"',
	),
	'uw_height' => array(
		'label' => 'Video\'s height:',
		'type' => 'text',
		'tags' => 'name="uw_height"',
	),
	'uw_fullscreen' => array(
		'label' => 'Allow fullscreen:',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'name="uw_fullscreen"',
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
