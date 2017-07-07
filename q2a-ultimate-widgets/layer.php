<?php

class qa_html_theme_layer extends qa_html_theme_base {
	function doctype(){
		qa_html_theme_base::doctype();
		// Administrator panel navigation item
		if ($this->request == 'admin/ulitmate_widgets') {
			if(empty($this->content['navigation']['sub']))
				$this->content['navigation']['sub']=array();
			require_once QA_INCLUDE_DIR.'qa-app-admin.php';
			$admin_nav = qa_admin_sub_navigation();
			$this->content['navigation']['sub'] = array_merge(
				$admin_nav,
				$this->content['navigation']['sub']
			);
		}
		if ( ($this->template=='admin') or ($this->request == 'ulitmate_widgets') ){
			$this->content['navigation']['sub']['ulitmate_widgets'] = array(
				'label' => 'Ultimate Widgets',
				'url' => qa_path_html('admin/ulitmate_widgets'),
			);
			if ($this->request == 'admin/ulitmate_widgets'){
				$this->content['navigation']['sub']['ulitmate_widgets']['selected'] = true;
			}
		}

		// Widget Options
		if( $this->request=='admin/layoutwidgets' ){
			global $uw_widgets;
			$widget_title = $this->content['form']['hidden']['title'];
			if(isset($_POST['position']))
				$position = substr($_POST['position'],0,2);
			else{
				$position = array_search($this->content['form']['fields']['position']['value'], $this->content['form']['fields']['position']['options']);
				$position = substr(@$position,0,2);
			}
			$widget_name = array_search($widget_title, $uw_widgets);
			$widget_key = $widget_name . '_' . $position;

			if($widget_name){
				// get $widget_options from file
				//include UW_DIR.'/widgets/'.$widget_key.'/options.php'; // get local variable for options from widget module
				// merge widget's system options with our widget's specific options
				$widget_options = get_widget_option_form($widget_name, $widget_key);
				$this->content['form']['fields'] = $this->content['form']['fields'] + $widget_options;
			}
		}
	}

	function head_script()
	{
		qa_html_theme_base::head_script();
		$variables = '';
		$variables .= 'uw_ajax_url = "' . UW_URL . 'ajax.php";';
		$this->output('<script>' . $variables . '</script>');
	}	

	// load individual widget stylings
	function head_css()
	{
		qa_html_theme_base::head_css();
		$style_files = array();
		foreach ($this->content['widgets'] as $region_key => $regions) {
			foreach ($regions as $template_key => $widgets) {
				$position =  strtoupper(substr($region_key,0,1) . substr($template_key,0,1) );
				foreach ($widgets as $key => $widget) {
					$widget_name = get_class ($widget);
					$widget_key = $widget_name.'_'.$position;
					$file = get_widget_option($widget_key, 'uw_styles');
					// if file existed then put it into an array to prevent duplications
					if($file)
						$styles[$widget_name][$file]=true;
				}
			}
		}
		foreach ($styles as $widget_name => $files)
			foreach ($files as $file => $verified)
				$this->output('<link rel="stylesheet" href="'.UW_URL.'widgets/'.$widget_name.'/styles/'.$file.'"/>');
	}	

}

