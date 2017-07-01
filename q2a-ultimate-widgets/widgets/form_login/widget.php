<?php

class form_login {
	
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
		$title=get_widget_option($widget_name, 'uw_title');
		$registration = (bool)get_widget_option($widget_name, 'uw_registration');;
		$forgot = (bool)get_widget_option($widget_name, 'uw_forgot');;
		$social = (bool)get_widget_option($widget_name, 'uw_social');;
			
		$topath=qa_get('to');
		$userlinks=qa_get_login_links(qa_path_to_root(), isset($topath) ? $topath : qa_path($request, $_GET, ''));
		$forgotpath=qa_path('forgot');

		echo '<aside class="uw-login-form-widget">';
		if($title)
			echo '<H2 class="uw-feed-header">'.$title.'</H2>';

		if (qa_is_logged_in()) {
			$themeobject->nav('user');
		} else{
			$nav = $qa_content['navigation']['user'];
			$register = $qa_content['navigation']['user']['register'];


			// login form
			$login=@$qa_content['navigation']['user']['login'];
			echo '<!--[Begin: login form]-->',				
				'<form id="qa-loginform" action="'.$userlinks['login'].'" method="post">',
					'<input type="text" id="qa-userid" name="emailhandle" placeholder="'.trim(qa_lang_html('users/email_handle_label'), ':').'" />',
					'<input type="password" id="qa-password" name="password" placeholder="'.trim(qa_lang_html('users/password_label'), ':').'" />',
					'<input class="qa-form-tall-button qa-form-tall-button-login" value="Log In" name="dologin" type="submit">',
					$forgot?'<a class="btn qa-forget" href="'. $forgotpath .'">'. qa_lang_html('users/forgot_link') .'</a>':'',
					'<div id="qa-rememberbox"><input type="checkbox" name="rememberme" id="qa-rememberme" />',
					'<label for="rememberme" id="qa-remember">'.qa_lang_html('users/remember').'</label></div>',
					'<input type="hidden" name="code" value="'.qa_html(qa_get_form_security_code('login')).'"/>',
				'</form>',
				'<!--[End: login form]-->';
			if($social)
				$this->social_login($nav);
			if($registration)
				echo '<a class="btn qa-register" href="'. $register['url'] .'">'. $register['label'] .'</a>';
		}

		echo '</aside>';
	}

	function social_login($nav){
		// social login buttons
		unset($nav['register']);
		unset($nav['login']);
		echo '<section class="social-block">';
		foreach($nav as $nav_item){
			echo $nav_item['label'];
		}
		echo '</section>';
	}
}
