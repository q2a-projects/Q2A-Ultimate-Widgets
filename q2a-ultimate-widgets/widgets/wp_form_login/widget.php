<?php

class wp_form_login {
	
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

		echo '<aside class="uw-wp-login-form-widget">';
		if($title)
			echo '<H2 class="uw-wp-login-form-header">'.$title.'</H2>';
		If( qa_is_logged_in() )
			$themeobject->nav('user');
		else{
			if(function_exists('wp_login_form'))
				wp_login_form(array('redirect' =>  $_SERVER['REQUEST_URI'] ));
			if($registration && function_exists('wp_registration_url'))
				echo '<a href="'. wp_registration_url() . '&redirect_to=' . $_SERVER['REQUEST_URI'] . '">Register</a>';
			if($forgot && function_exists('wp_lostpassword_url'))
				echo '<a href="'. wp_lostpassword_url(  $_SERVER['REQUEST_URI'] ) . '">Forgot Password</a>';
		}

			
		echo '</aside>';
	}
}
