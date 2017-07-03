<?php

class mailchimp {
	
	function allow_template($template)
	{
		return true;
	}

	function allow_region($region)
	{
		return true;
	}
	
	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		$widget_name = get_class($this) . '_' .strtoupper(substr($region,0,1).substr($place,0,1)) ;
		$title = get_widget_option($widget_name, 'uw_title');
		$firstname = (bool)get_widget_option($widget_name, 'uw_firstname');
		$lastname = (bool)get_widget_option($widget_name, 'uw_lastname');
		$list = get_widget_option($widget_name, 'uw_list');

		
		echo '<aside class="uw-mailchimp-widget">';
		echo '<script src="' . UW_URL . 'include/mailchimp.js"></script>';
		$variables = '';
		$variables .= 'uw_mailchimp_invalid = "' . qa_lang_html('uw/invalid') .'";';
		$variables .= 'uw_mailchimp_subscribing = "' . qa_lang_html('uw/subscribing') .'";';
		$variables .= 'uw_mailchimp_success = "' . qa_lang_html('uw/subscribe_success') .'";';
		$variables .= 'uw_mailchimp_fail = "' . qa_lang_html('uw/subscribe_fail') .'";';
		echo '<script>' . $variables . '</script>';
		

		if($title)
			echo '<H2 class="uw-mailchimp-header" placeholder="">'. $title .'</H2>';
		if($firstname)
			echo '<input class="uw-mailchimp-firstname" id="input-name-' . $widget_name . '" type="text" placeholder="' . qa_lang_html('uw/first_name') . '"></input>';
		if($lastname)
			echo '<input class="uw-mailchimp-lastname" id="input-lastname-' . $widget_name . '" type="text" placeholder="' . qa_lang_html('uw/last_name') . '"></input>';
		echo '<input class="uw-mailchimp-email" id="input-email-' . $widget_name . '" type="text" placeholder="' . qa_lang_html('uw/email') . '"></input>';
		echo '<input id="input-list-id-' . $widget_name . '" type="hidden" value="' . $list . '"></input>';
		echo '<button class="uw-mailchimp-subscribe" id="' . $widget_name . '">' . qa_lang_html('uw/subscribe') . '</button>';
		echo '<span class="uw-mailchimp-message" id="message-' . $widget_name . '"></button>';

		echo '</aside>';


	}
}
