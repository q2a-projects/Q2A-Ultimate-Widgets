<?php

class stat_chart {
	
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
		$days = (int)get_widget_option($widget_name, 'uw_days');
		$labels_on = (bool)get_widget_option($widget_name, 'uw_labels');
		$local = (bool)get_widget_option($widget_name, 'uw_local');
		$type = get_widget_option($widget_name, 'uw_type');
		$color = array();
		$color_q = get_widget_option($widget_name, 'uw_color_q');
		$color_a = get_widget_option($widget_name, 'uw_color_a');
		$color_c = get_widget_option($widget_name, 'uw_color_c');
		$color_u = get_widget_option($widget_name, 'uw_color_u');

		$labels = '["' . qa_lang_sub('main/x_questions', number_format((int)qa_opt('cache_qcount'))) . '","' . qa_lang_sub('main/x_answers', number_format((int)qa_opt('cache_acount'))) . '","' . qa_lang_sub('main/x_comments', number_format((int)qa_opt('cache_ccount'))) . '","' . qa_lang_sub('main/x_users', number_format((int)qa_opt('cache_userpointscount'))) . '"]';
		$data = '["' . qa_opt('cache_qcount') . '","' . qa_opt('cache_acount') . '","' . qa_opt('cache_ccount') . '","' . qa_opt('cache_userpointscount') . '"]';
		$colors = '["' . $color_q . '","' . $color_a . '","' . $color_c . '","' . $color_u . '"]';

		$dataset = '[{';
			$dataset .= 'data:' . $data . ',';
			$dataset .= 'labels:' . $labels . ',';
			$dataset .= 'backgroundColor: ' . $colors . ',';
		$dataset .= '}]';

		echo '<script src="' . UW_URL . 'include/charts.js"></script>';
		if ($local)
			echo '<script src="' . UW_URL . 'include/Chart.min.js"></script>';
		else
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>';


		echo '<aside class="uw-stat-charts-widget">';
		if($title)
			echo '<H2 class="uw-stat-charts-header">'.$title.'</H2>';
		if(! $labels_on)
			$labels = '[]';
		echo '<canvas id="' . $widget_name . '"></canvas>';
		echo '<script>
			$(document).ready(function(){
				draw_chart ("' . $widget_name . '", "' . $type . '", ' . $dataset . ', ' . $labels . ')
			});
			</script>';
		
		echo '</aside>';
	}
}
