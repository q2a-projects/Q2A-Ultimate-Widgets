<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'default-value' => 'Feed',
		'tags' => 'name="uw_title"',
	),
	'uw_url' => array(
		'label' => 'RSS Feed URL',
		'default-value' => 'http://qa-themes.com/feed/',
		'tags' => 'name="uw_url"',
	),
	'uw_count' => array(
		'label' => 'number of recent feed items:',
		'type' => 'number',
		'default-value' => '10',
		'tags' => 'NAME="uw_count"',
	),
	'uw_nofollow' => array(
		'label' => 'Don\'t pass SEO juice to link targets. <small>"this option adds "NoFollow" to link relation attribute."</small>',
		'type' => 'checkbox',
		'tags' => 'NAME="uw_nofollow"',
	),
	'uw_gzip' => array(
		'label' => 'Decompress feed if it\'s GZip(recommended). if you are sure feed is not compressed with GZip you can disable this options.',
		'type' => 'checkbox',
		'default-value' => true,
		'tags' => 'NAME="uw_gzip"',
	),

	'blank1' => array(
		'type' => 'blank',
	),

	'uw_thumbnail' => array(
		'label' => 'Show image thumbnails:',
		'type' => 'checkbox',
		'tags' => 'NAME="uw_thumbnail"',
	),
	'uw_thumbnail_width' => array(
		'label' => 'Thumbnail Width:',
		'type' => 'number',
		'default-value' => '180',
		'suffix' => 'px',
		'tags' => 'NAME="uw_thumbnail_width"',
	),
	'uw_thumbnail_hight' => array(
		'label' => 'Thumbnail Height:',
		'type' => 'number',
		'default-value' => '150',
		'suffix' => 'px',
		'tags' => 'NAME="uw_thumbnail_hight"',
	),
);
