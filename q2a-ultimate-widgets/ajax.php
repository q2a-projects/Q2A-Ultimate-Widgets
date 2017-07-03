<?php

//	Output this header as early as possible
	//header('Content-Type: text/plain; charset=utf-8');


//	Ensure no PHP errors are shown in the Ajax response
	//@ini_set('display_errors', 0);


//	Load the Q2A base file which sets up a bunch of crucial functions
	require_once '../../qa-include/qa-base.php';
	qa_report_process_stage('init_ajax');		

//	Get general Ajax parameters from the POST payload, and clear $_GET
	qa_set_request(qa_post_text('qa_request'), qa_post_text('qa_root'));
	
	require_once QA_INCLUDE_DIR.'qa-app-options.php';
	require_once QA_INCLUDE_DIR.'qa-db-metas.php';
	//require_once QA_INCLUDE_DIR.'qa-page.php';

	$action = $_POST['action'];
	if($action=='mailchimp-subscribe'){
		$name = $_POST['name'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$widget_name = $_POST['widget_name'];

		require_once "functions.php";
		require_once "widgets/mailchimp/MailChimp.php";
		$api = get_widget_option($widget_name, 'uw_api');;
		$MailChimp = new MailChimpAPI( $api );

		$list_id = get_widget_option($widget_name, 'uw_list');
		$result = $MailChimp->post('/lists/' . $list_id . '/members', array(
			'email_address' => $email,
			'merge_fields' => array('FNAME'=>$name, 'LNAME'=>$lastname),
			'status' => 'subscribed'
		));
		if($result['status']=='subscribed')
			die("1");
		elseif($result['status']==400)
			die("0");
	}

/*
	Omit PHP closing tag to help avoid accidental output
*/