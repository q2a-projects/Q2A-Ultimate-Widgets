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

		echo '<aside class="uw-feed-widget">';
		if($title)
			echo '<H2 class="uw-feed-header">'.$title.'</H2>';
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

	function gzdecoder($d){
		$f=ord(substr($d,3,1));
		$h=10;$e=0;
		if($f&4){
			$e=@unpack('v',substr($d,10,2));
			$e=$e[1];$h+=2+$e;
		}
		if($f&8){
			$h=@strpos($d,chr(0),$h)+1;
		}
		if($f&16){
			$h=@strpos($d,chr(0),$h)+1;
		}
		if($f&2){
			$h+=2;
		}
		$u = @gzinflate(@substr($d,$h));
		if($u===FALSE){
			$u=$d;
		}
		return $u;
	}
}
