<?php

class recent_posts {
	
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


		$userid=qa_get_logged_in_userid();
		$questions = qa_db_select_with_pending(qa_db_qs_selectspec($userid, 'created', 0, '', null, false, false, $count));


		echo '<aside class="uw-recent-posts-widget">';
		if($title)
			echo '<H2 class="uw-recent-posts-header">'. $title .'</H2>';

		echo '<ul class="uw-recent-posts-list">';
		
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
					$thumb= '<img class="uw-recent-posts-thumbnail" width="60" height="50" src="' . $src . '">';
			}
			echo '<li class="uw-recent-posts-link-body">';
			echo '<a class="uw-recent-posts-link" href="' . $questionlink . '">';
			echo $thumb . '<span class="uw-recent-posts-title">'. htmlspecialchars($question['title']) . '</span>';
			echo '<span class="uw-recent-posts-time">' . $when . '</span></a></li>';
		}		
		echo '</ul></aside>';
	}
}
