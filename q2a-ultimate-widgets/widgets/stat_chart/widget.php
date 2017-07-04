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
		$local = (bool)get_widget_option($widget_name, 'uw_local');
		$type = get_widget_option($widget_name, 'uw_type');
		$color = array();
		$color['Q'] = get_widget_option($widget_name, 'uw_color_q');
		$color['A'] = get_widget_option($widget_name, 'uw_color_a');
		$color['C'] = get_widget_option($widget_name, 'uw_color_c');


		$posts = qa_db_read_all_assoc(qa_db_query_sub("select date(^posts.created) AS created,^posts.type,count(*) AS counter from ^posts WHERE ^posts.created  >= ( CURDATE() - INTERVAL " . $days . " DAY ) group by date(^posts.created),^posts.type"));

		$begin = new DateTime('-1 week');
		$end = new DateTime('now +1 day');
		$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
		$labels = '';
		foreach($daterange as $date){
			$labels .= "'" . $date->format("Y-m-d") . "',";
		}

		$labels = '[' . $labels .']';

		foreach($daterange as $date){
			$current_day = $date->format("Y-m-d");
			foreach($posts as $post){
				if ( $current_day == $post['created'])
					$data[$post['type']][$post['created']] = $post['counter'];
			}
			if(! isset($data['Q'][$current_day]))
				$data['Q'][$current_day] = 0;
			if(! isset($data['A'][$current_day]))
				$data['A'][$current_day] = 0;
			if(! isset($data['C'][$current_day]))
				$data['C'][$current_day] = 0;

		}
		$types = array('Q' => qa_lang_html('uw/stat_q'), 'A' => qa_lang_html('uw/stat_a'), 'C' => qa_lang_html('uw/stat_c'));
		$dataset = '[';
		foreach ($data as $key => $value) {
			$data_labels = '';
			foreach ($data[$key] as $skey => $svalue) {
				$data_labels .= "'" . $svalue. "',";
			}
			$dataset .= '{';
			$dataset .= 'data:[' . $data_labels . '],';
			$dataset .= 'label: "' . $types[$key] . '",';
			$dataset .= 'borderColor: "' . $color[$key] . '",';
			$dataset .= 'fill: false,';
			$dataset .= '}, ';
		}
		$dataset .= ']';

		echo '<script src="' . UW_URL . 'include/charts.js"></script>';
		if ($local)
			echo '<script src="' . UW_URL . 'include/Chart.min.js"></script>';
		else
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>';


		echo '<aside class="uw-stat-charts-widget">';
		if($title)
			echo '<H2 class="uw-stat-charts-header">'.$title.'</H2>';

		echo '<canvas id="' . $widget_name . '"></canvas>';
		echo '<script>
			$(document).ready(function(){
				draw_chart ("' . $widget_name . '", "' . $type . '", ' . $dataset . ', ' . $labels . ')
			});
			</script>';
		
		echo '</aside>';
	}
}
