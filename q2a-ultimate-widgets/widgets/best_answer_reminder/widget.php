<?php

class best_answer_reminder {
	
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
		$min_answers = (int)get_widget_option($widget_name, 'uw_min_answers');
		$title = get_widget_option($widget_name, 'uw_title');
		$thumbnail = (bool)get_widget_option($widget_name, 'uw_thumbnail');
		$default_thumbnail = get_widget_option($widget_name, 'uw_default_thumbnail');


		$userid = qa_get_logged_in_userid();
		$handle = qa_get_logged_in_handle();
		$identifier = QA_FINAL_EXTERNAL_USERS ? $userid : $handle;
		$selectspec=qa_db_posts_basic_selectspec($identifier);
		$selectspec['source'].=" WHERE ^posts.userid=".(QA_FINAL_EXTERNAL_USERS ? "$" : "(SELECT userid FROM ^users WHERE handle=$ LIMIT 1)")." AND type='Q' AND acount > # AND selchildid IS NULL ORDER BY ^posts.amaxvote DESC LIMIT #,#";
		array_push($selectspec['arguments'], $identifier, $min_answers, 0, $count);
		$selectspec['sortdesc']='hotness';

		$questions = qa_db_select_with_pending($selectspec);
		
		if(count($questions)<1)
			return;

		echo '<aside class="uw-reminder-posts-widget">';
		if($title)
			echo '<H2 class="uw-reminder-posts-header">'. $title .'</H2>';

		echo '<ul class="uw-reminder-posts-list">';
		
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
				$src = htmlspecialchars($xpath->evaluate("string(//img/@src)"));
				
				if ( empty($src) && !empty($default_thumbnail) )
					$src = $default_thumbnail;
				$thumb='';
				if ( !empty($src) )
					$thumb= '<img class="uw-reminder-posts-thumbnail" width="60" height="50" src="' . $src . '">';
			}
			echo '<li class="uw-reminder-posts-link-body">';
			echo '<a class="uw-reminder-posts-link" href="' . $questionlink . '">';
			echo $thumb . '<span class="uw-category-posts-title">'. htmlspecialchars($question['title']) . '</span>';
			echo '<span class="uw-reminder-posts-time">' . $when . '</span></a></li>';
		}
		echo '</ul></aside>';
	}
}
