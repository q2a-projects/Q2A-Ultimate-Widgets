<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../');
	exit;
}
/*
	Intercept Widget Form and add additional form data
*/
function qa_redirect($request, $params=null, $rooturl=null, $neaturls=null, $anchor=null){
	if( $request=='admin/layout' and ! qa_clicked('docancel') and qa_get_logged_in_level()>=QA_USER_LEVEL_ADMIN){
		global $uw_widgets;
		$widget_key = array_search($_POST['title'], $uw_widgets);
		$position = substr($_POST['position'], 0, 2);
		$option_key = 'uw_option_'.$widget_key.'_'.$position;
		// If a widget is updated then update it's options
		if( qa_post_text('dodelete')=='1' ){
			qa_opt($option_key, '');
		}else{
			$widget_options = array();
			foreach ($_POST as $key => $value) {
				if(substr($key, 0, 3)=='uw_')
					$widget_options[$key] = $value;
			}
			qa_opt($option_key, json_encode($widget_options));
		}
	}
	qa_redirect_base($request, $params, $rooturl, $neaturls, $anchor);
}