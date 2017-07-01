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
define('UW_DIR', dirname( __FILE__ ));
define('UW_URL', uw_get_base_url().'/qa-plugin/q2a-ultimate-widgets');
define('UW_VERSION', 1);

require_once "functions.php";

qa_register_plugin_module('page', 'options.php', 'uw_options', 'Ultimate Widgets Options');
qa_register_plugin_layer('layer.php', 'Ultimate Widgets Layer');
qa_register_plugin_phrases('languages/uw-lang-*.php', 'uw');
qa_register_plugin_overrides('overrides.php');


global $uw_widgets;
$uw_widgets = array(
	'rss_feed' => 'Ultimate Widgets - RSS Feed',
);
foreach ($uw_widgets as $key => $name) {
	qa_register_plugin_module('widget', 'widgets/'.$key.'/widget.php', $key, $name);
}


function uw_get_base_url()
{
	/* First we need to get the protocol the website is using */
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';

	/* returns /myproject/index.php */
	if(QA_URL_FORMAT_NEAT == 0 || strpos($_SERVER['PHP_SELF'],'/index.php/') !== false):
		$path = strstr($_SERVER['PHP_SELF'], '/index', true);
		$directory = $path;
	else:
		$path = $_SERVER['PHP_SELF'];
		$path_parts = pathinfo($path);
		$directory = $path_parts['dirname'];
		$directory = ($directory == "/") ? "" : $directory;
	endif;       
		
		$directory = ($directory == "\\") ? "" : $directory;
		
	/* Returns localhost OR mysite.com */
	$host = $_SERVER['HTTP_HOST'];

	return $protocol . $host . $directory;
}
/*                              
    Omit PHP closing tag to help avoid accidental output
*/