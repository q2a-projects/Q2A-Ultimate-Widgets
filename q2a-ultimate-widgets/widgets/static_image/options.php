<?php

$widget_options = array(
	'uw_title' => array(
		'label' => 'Widget Title',
		'type' => 'text',
		'tags' => 'name="uw_title"',
	),

	'uw_image' => array(
		'label' => 'Image URL(web address)',
		'type' => 'text',
		'tags' => 'NAME="uw_image"',
	),
	'uw_link' => array(
		'label' => 'Image Link URL',
		'type' => 'text',
		'tags' => 'NAME="uw_link"',
		'note' => 'If you put a link address here, image will be linked to it.',
	),
	'uw_image_title' => array(
		'label' => 'Image Title',
		'type' => 'text',
		'tags' => 'NAME="uw_image_title"',
		'note' => 'This is the text which shows when mouse hovers over the image.',
	),
	'uw_image_alt' => array(
		'label' => 'Image alternative text(alt attribute)',
		'type' => 'text',
		'tags' => 'NAME="uw_image_alt"',
		'note' => 'This is the text which shows when image is not loaded.',
	),
	'blank1' => array(
		'type' => 'blank',
	),
	'uw_width' => array(
		'label' => 'Image\'s width',
		'type' => 'text',
		'tags' => 'NAME="uw_width"',
		'note' => 'You can leave it empty, or set a static value such as "200" or "200px" or a relative value such as "100%".',
	),
	'uw_height' => array(
		'label' => 'Image\'s height',
		'type' => 'text',
		'tags' => 'NAME="uw_height"',
		'note' => 'You can leave it empty, or set a static value such as "200" or "200px" or a relative value such as "100%".',
	),
	'blank2' => array(
		'type' => 'blank',
	),
	'uw_prefix' => array(
		'label' => 'Prefix text(or HTML):',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_prefix"',
		'note' => 'This is the text which will show up before image.',
	),
	'uw_suffix' => array(
		'label' => 'Suffix text(or HTML)',
		'type' => 'textarea',
		'rows' => '3',
		'tags' => 'NAME="uw_suffix"',
		'note' => 'This is the text which will show up after image.',
	),
);
