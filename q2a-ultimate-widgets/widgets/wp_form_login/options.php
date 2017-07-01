<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'tags' => 'name="uw_title"',
	),
	'uw_registration' => array(
		'label' => 'Show link to "Registration" page.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_registration"',
	),
	'uw_forgot' => array(
		'label' => 'Show link to "Forgot Password" page.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_forgot"',
	),
);
