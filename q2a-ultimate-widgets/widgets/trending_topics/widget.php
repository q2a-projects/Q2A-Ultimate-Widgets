<?php

class trending_topics {
	
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
		$hours = (int)get_widget_option($widget_name, 'uw_hours');

		// Get tags from latest questions
		$userid = qa_get_logged_in_userid();
		$selectspec=array(
			'columns' => array(
				'^posts.tags', '^posts.postid', 
			),
			'arraykey' => 'postid',
			'source' => '^posts WHERE ^posts.type=\'Q\' AND ^posts.created >= DATE_SUB(NOW(),INTERVAL ' . $hours . ' HOUR); ',
			'arguments' => array(),
		);
		$questions = qa_db_select_with_pending($selectspec);
		// get tags and sort top used tags
		$tags = array();
		foreach ($questions as $question){
			$post_tags = explode(',', $question['tags']);
			if($post_tags[0]!='')
				foreach ($post_tags as $tag) {
					if(isset($tags[$tag]))
						$tags[$tag] += 1;
					else
						$tags[$tag] = 1;
				}
		}
		arsort($tags);
		// show tags
		echo '<aside class="uw-trending-topics-widget">';
		if($title)
			echo '<H2 class="uw-trending-topics-header">'. $title .'</H2>';

		echo '<ul class="uw-trending-topics-list">';
		$i = 0;
		foreach ($tags as $tag => $num)
		{
			if($i >= $count)
				break;
			$i++;
			echo '<li><a class="uw-trending-topics-link" href="' . qa_path_html('tag/' . $tag) . '">' . qa_html($tag) . '</a></li>';
		}		
		echo '</ul></aside>';
	}
}
