<?php

$widget_options = array(
	'hr1' => array(
		'label' => '<hr>',
		'type' => 'static',
	),
	'uw_title' => array(
		'label' => 'Widget Title',
		'default-value' => 'Subscribe to Newsletter',
		'tags' => 'name="uw_title"',
	),
	'uw_api' => array(
		'label' => 'API Key:',
		'type' => 'text',
		'tags' => 'NAME="uw_api"',
		'note' => 'You can recieve your API key from your mailchimp account. <a href="http://kb.mailchimp.com/accounts/management/about-api-keys#Find-or-Generate-Your-API-Key">Read How</a>',
	),

	'blank1' => array(
		'type' => 'blank',
	),

	'uw_list' => array(
		'label' => 'Subscription List',
		'options' => array(),
		'type' => 'select',
		'default-value' => false,
		'tags' => 'NAME="uw_list"',
		'match_by' => 'key',
	),
	
	'blank1' => array(
		'type' => 'blank',
	),

	'uw_firstname' => array(
		'label' => 'Show first name field.',
		'type' => 'checkbox',
		'default-value' => false,
		'tags' => 'NAME="uw_firstname"',
	),
	'uw_lastname' => array(
		'label' => 'Show Last name field.',
		'type' => 'checkbox',
		'default-value' => false,
		'tags' => 'NAME="uw_lastname"',
	),
	'uw_subscribe' => array(
		'label' => 'Subscribe button text:',
		'type' => 'text',
		'default-value' => 'Subscribe',
		'tags' => 'NAME="uw_subscribe"',
	),
);

function mailchimp($widget_options, $option_key){
	$api = get_widget_option($option_key, 'uw_api');
	$subscription_list = get_widget_option($option_key, 'uw_list');

	require_once UW_DIR.'widgets/mailchimp/MailChimp.php';
	$MailChimp = new MailChimpAPI( $api );
	$lists =  $MailChimp->get('/lists/');
	if(count($lists)<=0)
		$widget_options['0'] = 'Either API Key is not saved or isn\'t right, or no Lists are created in your mailchimp account!';
	else{
		$options=array();
		foreach ($lists['lists'] as $key => $list) {
			$options[ $list['id'] ] = $list['name'];
		}
	}
	$widget_options['uw_list']['options'] = $options;
	$widget_options['uw_list']['value'] = $subscription_list;

	return $widget_options;
}