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
			echo '<H2 class="uw-login-form-header">'.$title.'</H2>';

		if (qa_is_logged_in()) {
			$themeobject->nav('user');
		} else{
			$nav = $qa_content['navigation']['user'];
			$register = $qa_content['navigation']['user']['register'];


			// login form
			$login=@$qa_content['navigation']['user']['login'];
			echo '<form action="'.$userlinks['login'].'" method="post">',
					'<input type="text" class="uw-login-form-userid" name="emailhandle" placeholder="'.trim(qa_lang_html('users/email_handle_label'), ':').'" />',
					'<input type="password" class="uw-login-form-password" name="password" placeholder="'.trim(qa_lang_html('users/password_label'), ':').'" />',
					'<input class="uw-login-form-login" value="' . qa_lang_html('users/login_button') . '" name="dologin" type="submit">',
					'<div class="uw-login-form-rememberbox"><input type="checkbox" name="rememberme" id="rememberme" class="uw-login-form-rememberme" />',
					'<label for="rememberme" class="uw-login-form-remember">'.qa_lang_html('users/remember').'</label></div>',
					$forgot?'<a class="uw-login-form-forget" href="'. $forgotpath .'">'. qa_lang_html('users/forgot_link') .'</a>':'',
					'<input type="hidden" name="code" value="'.qa_html(qa_get_form_security_code('login')).'"/>',
				'</form>';
			if($social)
				$this->social_login($nav);
			if($registration)
				echo '<a class="uw-login-form-register" href="'. $register['url'] .'">'. $register['label'] .'</a>';
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
