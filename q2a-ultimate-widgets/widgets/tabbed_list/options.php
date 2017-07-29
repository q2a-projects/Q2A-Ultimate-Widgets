<?php

$widget_options = array(
	'uw_title_1' => array(
		'label' => 'Tab Title',
		'default-value' => 'Recent',
		'tags' => 'name="uw_title_1"',
	),
	'uw_count_1' => array(
		'label' => 'number of posts:',
		'type' => 'number',
		'default-value' => '5',
		'tags' => 'NAME="uw_count_1"',
	),
	'uw_sort_1' => array(
		'label' => 'Question Sorting',
		'options' => array(
			'activity' => 'Recent Activity',
			'random' => 'Random Questions',
			'hotness' => 'Hot',
			'created' => 'Recently Asked',
			'acount' => 'Most Answered',
			'views' => 'Most Viewed',
			'netvotes' => 'Most Voted',
		),
		'type' => 'select',
		'default-value' => 'created',
		'tags' => 'NAME="uw_sort_1"',
		'match_by' => 'key',
	),
	'blank1' => array(
		'type' => 'blank',
	),

	'uw_title_2' => array(
		'label' => 'Tab Title',
		'default-value' => 'Hot',
		'tags' => 'name="uw_title_2"',
	),
	'uw_count_2' => array(
		'label' => 'number of posts:',
		'type' => 'number',
		'default-value' => '5',
		'tags' => 'NAME="uw_count_2"',
	),
	'uw_sort_2' => array(
		'label' => 'Question Sorting',
		'options' => array(
			'activity' => 'Recent Activity',
			'random' => 'Random Questions',
			'hotness' => 'Hot',
			'created' => 'Recently Asked',
			'acount' => 'Most Answered',
			'views' => 'Most Viewed',
			'netvotes' => 'Most Voted',
		),
		'type' => 'select',
		'default-value' => 'hotness',
		'tags' => 'NAME="uw_sort_2"',
		'match_by' => 'key',
	),
	'blank2' => array(
		'type' => 'blank',
	),
	'uw_title_3' => array(
		'label' => 'Tab Title',
		'default-value' => 'Activity',
		'tags' => 'name="uw_title_3"',
	),
	'uw_count_3' => array(
		'label' => 'number of posts:',
		'type' => 'number',
		'default-value' => '5',
		'tags' => 'NAME="uw_count_3"',
	),
	'uw_sort_3' => array(
		'label' => 'Question Sorting',
		'options' => array(
			'none' => 'None(don\'t show)',
			'activity' => 'Recent Activity',
			'random' => 'Random Questions',
			'hotness' => 'Hot',
			'created' => 'Recently Asked',
			'acount' => 'Most Answered',
			'views' => 'Most Viewed',
			'netvotes' => 'Most Voted',
		),
		'type' => 'select',
		'default-value' => 'activity',
		'tags' => 'NAME="uw_sort_3"',
		'match_by' => 'key',
	),
	'blank3' => array(
		'type' => 'blank',
	),

	'uw_thumbnail' => array(
		'label' => 'Enable thumbnail image',
		'type' => 'checkbox',
		'default-value' => false,
		'tags' => 'NAME="uw_thumbnail"',
		'note' => 'read first image inside question content and show it as thumbnail image',
	),
	'uw_default_thumbnail' => array(
		'label' => 'Default thumbnail image URL',
		'tags' => 'NAME="uw_default_thumbnail"',
		'suffix' => 'leave empty to load no thumbnails',
	),
);
