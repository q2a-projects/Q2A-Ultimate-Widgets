<?php

$widget_options = array(
	'uw_style' => array(
		'label' => 'Icon List Style:',
		'options' => array('round'=>'Round'),
		'type' => 'select',
		'default-value' => 'round',
		'tags' => 'NAME="uw_type"',
		'match_by' => 'key',
	),
);


function social_links($widget_options, $option_key){
	$icons = array('icon-google' => 'google', 'icon-twitter' => 'twitter', 'icon-facebook' => 'facebook', 'icon-reddit' => 'reddit', 'icon-youtube' => 'youtube', 'icon-vimeo' => 'vimeo', 'icon-linkedin' => 'linkedin', 'icon-wordpress' => 'wordpress', 'icon-quora' => 'quora', 'icon-github' => 'github', 'icon-tumblr' => 'tumblr', 'icon-instagram' => 'instagram', 'icon-blogger' => 'blogger', 'icon-pinterest' => 'pinterest', 'icon-duckduckgo' => 'duckduckgo', 'icon-aim' => 'aim', 'icon-delicious' => 'delicious', 'icon-paypal' => 'paypal', 'icon-flattr' => 'flattr', 'icon-android' => 'android', 'icon-eventful' => 'eventful', 'icon-smashmag' => 'smashmag', 'icon-gplus' => 'gplus', 'icon-wikipedia' => 'wikipedia', 'icon-lanyrd' => 'lanyrd', 'icon-calendar' => 'calendar', 'icon-stumbleupon' => 'stumbleupon', 'icon-fivehundredpx' => 'fivehundredpx', 'icon-bitcoin' => 'bitcoin', 'icon-w3c' => 'w3c', 'icon-foursquare' => 'foursquare', 'icon-html5' => 'html5', 'icon-ie' => 'ie', 'icon-call' => 'call', 'icon-grooveshark' => 'grooveshark', 'icon-ninetyninedesigns' => 'ninetyninedesigns', 'icon-forrst' => 'forrst', 'icon-digg' => 'digg', 'icon-spotify' => 'spotify', 'icon-guest' => 'guest', 'icon-gowalla' => 'gowalla', 'icon-appstore' => 'appstore', 'icon-cc' => 'cc', 'icon-dribbble' => 'dribbble', 'icon-evernote' => 'evernote', 'icon-flickr' => 'flickr', 'icon-viadeo' => 'viadeo', 'icon-instapaper' => 'instapaper', 'icon-weibo' => 'weibo', 'icon-klout' => 'klout', 'icon-meetup' => 'meetup', 'icon-vk' => 'vk', 'icon-plancast' => 'plancast', 'icon-disqus' => 'disqus', 'icon-rss' => 'rss', 'icon-skype' => 'skype', 'icon-windows' => 'windows', 'icon-xing' => 'xing', 'icon-yahoo' => 'yahoo', 'icon-chrome' => 'chrome', 'icon-email' => 'email', 'icon-macstore' => 'macstore', 'icon-myspace' => 'myspace', 'icon-podcast' => 'podcast', 'icon-amazon' => 'amazon', 'icon-steam' => 'steam', 'icon-cloudapp' => 'cloudapp', 'icon-dropbox' => 'dropbox', 'icon-ebay' => 'ebay', 'icon-github-circled' => 'github-circled', 'icon-googleplay' => 'googleplay', 'icon-itunes' => 'itunes', 'icon-plurk' => 'plurk', 'icon-songkick' => 'songkick', 'icon-lastfm' => 'lastfm', 'icon-gmail' => 'gmail', 'icon-pinboard' => 'pinboard', 'icon-openid' => 'openid', 'icon-soundcloud' => 'soundcloud', 'icon-eventasaurus' => 'eventasaurus', 'icon-yelp' => 'yelp', 'icon-intensedebate' => 'intensedebate', 'icon-eventbrite' => 'eventbrite', 'icon-scribd' => 'scribd', 'icon-posterous' => 'posterous', 'icon-stripe' => 'stripe', 'icon-opentable' => 'opentable', 'icon-cart' => 'cart', 'icon-print' => 'print', 'icon-angellist' => 'angellist', 'icon-dwolla' => 'dwolla', 'icon-appnet' => 'appnet', 'icon-statusnet' => 'statusnet', 'icon-acrobat' => 'acrobat', 'icon-drupal' => 'drupal', 'icon-buffer' => 'buffer', 'icon-pocket' => 'pocket', 'icon-bitbucket' => 'bitbucket', 'icon-lego' => 'lego', 'icon-login' => 'login', 'icon-stackoverflow' => 'stackoverflow', 'icon-hackernews' => 'hackernews', 'icon-lkdto' => 'lkdto');
	for ($i=0; $i < 32; $i++) { 
		$num = (string)$i+1;
		$widget_options['note_'. $i] = array(
			'note' => '<hr>',
			'type' => 'static',
		);
		$widget_options['uw_icon_'.$i] = array(
			'label' => 'Icon #' . $num . ':',
			'options' => $icons,
			'type' => 'select',
			'default-value' => false,
			'tags' => 'NAME="uw_icon_'.$i .'"',
			'match_by' => 'key',
		);
		$widget_options['uw_link_'.$i] = array(
			'label' => 'Link #' . $num . ':',
			'type' => 'text',
			'tags' => 'NAME="uw_link_'.$i .'"',
		);
	}	
	return $widget_options;
}