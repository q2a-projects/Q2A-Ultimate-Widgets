<?php
        
/*              
    Plugin Name: Q2A Ultimate Widgets
    Plugin URI: https://github.com/Towhidn/
    Plugin Update Check URI:  
    Plugin Description: Widgets for Question2Answer
    Plugin Version: 1.0
    Plugin Date: 2017-30-6
    Plugin Author: QA-Themes.com
    Plugin Author URI: http://QA-Themes.com
    Plugin License: copy lifted                           
    Plugin Minimum Question2Answer Version: 1.5
*/                      
                        
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
                header('Location: ../../');
                exit;   
}
require_once "functions.php";


define('UW_DIR', dirname( __FILE__ ));
define('UW_URL', uw_get_base_url().'/qa-plugin/q2a-ultimate-widgets/');
define('UW_VERSION', 1);


qa_register_plugin_module('page', 'options.php', 'uw_options', 'Ultimate Widgets Options');
qa_register_plugin_layer('layer.php', 'Ultimate Widgets Layer');
qa_register_plugin_phrases('languages/uw-lang-*.php', 'uw');
qa_register_plugin_overrides('overrides.php');


global $uw_widgets;
$uw_widgets = array(
	'rss_feed' => 'Ultimate Widgets - RSS Feed',
    'recent_activity' => 'Ultimate Widgets - Recent Activity',
	'recent_posts' => 'Ultimate Widgets - Recent Posts',
	'hot_posts' => 'Ultimate Widgets - Hot Posts',
	'most_answered_posts' => 'Ultimate Widgets - Most Answered Posts',
	'most_viewed_posts' => 'Ultimate Widgets - Most Viewed Posts',
    'most_voted_posts' => 'Ultimate Widgets - Most Voted Posts',
	'random_posts' => 'Ultimate Widgets - Random Posts',
    'wp_form_login' => 'Ultimate Widgets - WordPress Login Form',
    'form_login' => 'Ultimate Widgets - Q2A Login Form',
    'trending_topics' => 'Ultimate Widgets - Trending Topics(Tags)',
    'php_exec' => 'Ultimate Widgets - PHP Code Runner',
    'accessibility' => 'Ultimate Widgets - Accessibility',
    'mailchimp' => 'Ultimate Widgets - MailChimp Subscription',
);
foreach ($uw_widgets as $key => $name) {
	qa_register_plugin_module('widget', 'widgets/'.$key.'/widget.php', $key, $name);
}


/*                              
    Omit PHP closing tag to help avoid accidental output
*/