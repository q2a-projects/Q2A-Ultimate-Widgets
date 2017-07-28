<?php

$widget_options = array(
	'uw_type' => array(
		'label' => 'Subscription List',
		'options' => array(
			'alert alert-success' => 'Success',
			'alert alert-info' => 'Info',
			'alert alert-warning' => 'Warning',
			'alert alert-danger' => 'Danger',
		),
		'type' => 'select',
		'default-value' => false,
		'tags' => 'NAME="uw_type"',
		'match_by' => 'key',
	),
	'uw_text' => array(
		'label' => 'Alert Text',
		'type' => 'textarea',
		'rows' => '6',
		'tags' => 'name="uw_text"',
	),
	'uw_close' => array(
		'label' => 'Show "Close" button',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_close"',
	),
	'uw_show_x' => array(
		'label' => 'Show "X" for close button instead of button\'s title text',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_show_x"',
	),
	'uw_close_title' => array(
		'label' => 'Title for close button',
		'type' => 'text',
		'default-value' => "Close",
		'tags' => 'name="uw_close_title"',
	),
);
