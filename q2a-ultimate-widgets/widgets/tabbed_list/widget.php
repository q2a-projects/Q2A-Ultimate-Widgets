<?php

class tabbed_list {
	public $allow_cache = true;
	
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
		$title1 = get_widget_option($widget_name, 'uw_title_1');
		$sort1 = get_widget_option($widget_name, 'uw_sort_1');
		$count1 = (int)get_widget_option($widget_name, 'uw_count_1');
		$title2 = get_widget_option($widget_name, 'uw_title_2');
		$sort2 = get_widget_option($widget_name, 'uw_sort_2');
		$count2 = (int)get_widget_option($widget_name, 'uw_count_2');
		$title3 = get_widget_option($widget_name, 'uw_title_3');
		$sort3 = get_widget_option($widget_name, 'uw_sort_3');
		$count3 = (int)get_widget_option($widget_name, 'uw_count_3');
		$thumbnail = (bool)get_widget_option($widget_name, 'uw_thumbnail');
		$default_thumbnail = get_widget_option($widget_name, 'uw_default_thumbnail');


		$userid = qa_get_logged_in_userid();
		$categoryslugs = '';

		echo '
		';

		echo "<script>
			$(document).ready(function(){
				
				$('ul.tabs li').click(function(){
					var tab_id = $(this).attr('data-tab');

					$('ul.tabs li').removeClass('current');
					$('.tab-content').removeClass('current');

					$(this).addClass('current');
					$('#'+tab_id).addClass('current');
				})

			})
			</script>";

		echo '<aside class="uw-tabbed-question-widget">';
		
		echo '<ul class="tabs">';
		echo '<li class="tab-link current" data-tab="tab-1">' . $title1 . '</li>';
		echo '<li class="tab-link" data-tab="tab-2">' . $title2 . '</li>';
		if($title3 && $sort3!='none')
			echo '<li class="tab-link" data-tab="tab-3">' . $title3 . '</li>';
		echo '</ul>';

		echo '<div id="tab-1" class="tab-content current">';
		$questions1 = $this->get_questions($sort1, $count1, $userid, $categoryslugs);
		$this->print_questions($questions1, $thumbnail, $default_thumbnail);
		echo '</div>';

		echo '<div id="tab-2" class="tab-content">';
		$questions2 = $this->get_questions($sort2, $count2, $userid, $categoryslugs);
		$this->print_questions($questions2, $thumbnail, $default_thumbnail);
		echo '</div>';

		if($title3 && $sort3!='none'){
			echo '<div id="tab-3" class="tab-content">';
			$questions3 = $this->get_questions($sort3, $count3, $userid, $categoryslugs);
			$this->print_questions($questions3, $thumbnail, $default_thumbnail);
			echo '</div>';
		}

		echo '</aside>';
	}

	function print_questions($questions, $thumbnail, $default_thumbnail){
		echo '<ul class="uw-tabbed-question-list">';
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
					$thumb= '<img class="uw-tabbed-question-thumbnail" width="60" height="50" src="' . $src . '">';
			}
			echo '<li class="uw-tabbed-question-link-body">';
			echo '<a class="uw-tabbed-question-link" href="' . $questionlink . '">';
			echo $thumb . '<span class="uw-tabbed-question-title">'. htmlspecialchars($question['title']) . '</span>';
			echo '<span class="uw-tabbed-question-time">' . $when . '</span></a></li>';
		}		
		echo '</ul>';
	}

	function get_questions($sort, $count, $userid, $categoryslugs){
		switch ($sort) {
			case 'activity':
				list($questions1, $questions2, $questions3, $questions4)=qa_db_select_with_pending(
					qa_db_qs_selectspec($userid, 'created', 0, $categoryslugs, null, false, false, $count),
					qa_db_recent_a_qs_selectspec($userid, 0, $categoryslugs),
					qa_db_recent_c_qs_selectspec($userid, 0, $categoryslugs),
					qa_db_recent_edit_qs_selectspec($userid, 0, $categoryslugs)
				);
				$questions = qa_any_sort_and_dedupe(array_merge($questions1, $questions2, $questions3, $questions4));
				break;
			case 'random':
				$selectspec = qa_db_qs_selectspec($userid, 'hotness', 0, $categoryslugs, null, false, false, $count);
		 		$selectspec['source'] = str_replace("ORDER BY","ORDER BY RAND(),",$selectspec['source']);
				$questions = qa_db_select_with_pending($selectspec);
				break;
			default:
				$questions = qa_db_select_with_pending(qa_db_qs_selectspec($userid, $sort, 0, $categoryslugs, null, false, false, $count));
		} 
		return $questions;
	}
}
