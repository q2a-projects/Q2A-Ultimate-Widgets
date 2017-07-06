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

	'uw_code' => array(
		'label' => 'Sound Track\'s link or trackID:',
		'type' => 'text',
		'tags' => 'name="uw_code"',
	),
	'uw_width' => array(
		'label' => 'Video\'s width:',
		'type' => 'text',
		'default-value' => '100%',
		'tags' => 'name="uw_width"',
	),
	'uw_height' => array(
		'label' => 'Video\'s height:',
		'type' => 'text',
		'tags' => 'name="uw_height"',
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
