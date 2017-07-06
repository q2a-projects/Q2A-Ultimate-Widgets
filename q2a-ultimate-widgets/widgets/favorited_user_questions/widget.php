<?php

class favorited_user_questions {
	
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
		$count = (int)get_widget_option($widget_name, 'uw_count');
		$title = get_widget_option($widget_name, 'uw_title');
		$thumbnail = (bool)get_widget_option($widget_name, 'uw_thumbnail');
		$default_thumbnail = get_widget_option($widget_name, 'uw_default_thumbnail');


		$userid = (int)qa_get_logged_in_userid();
		$categoryslugs = '';
		$selectspec = qa_db_qs_selectspec($userid, 'created', 0, $categoryslugs, null, false, false, $count);
		$selectspec['source'] = '^posts LEFT JOIN ^categories ON ^categories.categoryid=^posts.categoryid LEFT JOIN ^userpoints ON ^posts.userid=^userpoints.userid LEFT JOIN ^users ON ^posts.userid=^users.userid LEFT JOIN ^uservotes ON ^posts.postid=^uservotes.postid AND ^uservotes.userid=$';
		$selectspec['source'] .= ' WHERE EXISTS (SELECT ^userfavorites.entityid FROM ^userfavorites WHERE ^posts.userid = ^userfavorites.entityid AND ^userfavorites.entitytype=$ AND ^userfavorites.userid=#) AND ^posts.type=$ ORDER BY ^posts.created DESC LIMIT #,#';
		unset($selectspec['columns']['userfavoriteq']);
		unset($selectspec['arguments']);
		$selectspec['arguments'] = array(0 =>$userid , 1 => "U", 2 => $userid, 3 => "Q", 4 => 0, 5 => $count);
		//v( $selectspec );

		$questions = qa_db_select_with_pending($selectspec);

		echo '<aside class="uw-recent-activity-widget">';
		if($title)
			echo '<H2 class="uw-recent-activity-header">'. $title .'</H2>';

		echo '<ul class="uw-recent-activity-list">';
		
		$i=0;
		$thumb='';
		foreach ($questions as $question)
		{
			$i++;
			$questionid=$question['postid'];
			$questionlink = qa_path_html(qa_q_request($questionid, $question['title']),null, qa_opt('site_url'));
			$q_time= qa_when_to_html($question['created'], 7);
			$when=@$q_time['prefix'] . ' ' . @$q_time['data'] . ' ' . @$q_time['suffix'];
			if ($thumbnail){
				// get question content
				$result=qa_db_query_sub('SELECT content FROM ^posts WHERE postid=#', $questionid);
				$postinfo=qa_db_read_one_assoc($result, 'postid');
				// get thumbnail
				$doc = new DOMDocument();
				@$doc->loadHTML($postinfo['content']);
				$xpath = new DOMXPath($doc);
				$src = $xpath->evaluate("string(//img/@src)");
				
				if ( empty($src) && !empty($default_thumbnail) )
					$src = $default_thumbnail;
				$thumb='';
				if ( !empty($src) )
					$thumb= '<div class="uw-recent-thumb"><a class="uw-recent-activity-link-thumbnail" href="' . $questionlink . '"><img class="uw-recent-activity-thumbnail" width="60" height="50" src="' . $src . '"></a></div>';
			}
			echo '<li>' . $thumb;
			echo '<div class="uw-recent-activity-link-body"><a class="uw-recent-activity-link" href="' . $questionlink . '"><h4 class="uw-recent-activity-link-header">' . $question['title'] . '</h4>';
			echo '<span class="uw-recent-activity-time">' . $when . '</span></a></div></li>';
		}		
		echo '</ul></aside>';


	}
}
