<?php

class qa_html_theme_layer extends qa_html_theme_base {
	function doctype(){
		qa_html_theme_base::doctype();
		// Administrator panel navigation item
		if ($this->request == 'admin/ultimate_widgets') {
			if(empty($this->content['navigation']['sub']))
				$this->content['navigation']['sub']=array();
			require_once QA_INCLUDE_DIR.'qa-app-admin.php';
			$admin_nav = qa_admin_sub_navigation();
			$this->content['navigation']['sub'] = array_merge(
				$admin_nav,
				$this->content['navigation']['sub']
			);
		}
		if ( ($this->template=='admin') or ($this->request == 'ultimate_widgets') ){
			$this->content['navigation']['sub']['ultimate_widgets'] = array(
				'label' => 'Ultimate Widgets',
				'url' => qa_path_html('admin/ultimate_widgets'),
			);
			if ($this->request == 'admin/ultimate_widgets'){
				$this->content['navigation']['sub']['ultimate_widgets']['selected'] = true;
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
			// if it's one of this plugin's widgets
			if($widget_name){
				$widget_key = $widget_name . '_' . $position;
				// get $widget_options from file
				$widget_options = get_widget_option_form($widget_name, $widget_key);
				// merge widget's system options with our widget's specific options
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
		// if if already added widgets have a css file activated
		$styles = array();
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
		// add styling files to theme
		if($styles)
			foreach ($styles as $widget_name => $files)
				foreach ($files as $file => $verified)
					if( $file != 'none' )
						$this->output('<link rel="stylesheet" href="'.UW_URL.'widgets/'.$widget_name.'/styles/'.$file.'"/>');
	}	

	public function widgets($region, $place)
	{
		if (count(@$this->content['widgets'][$region][$place])) {
			$this->output('<div class="qa-widgets-'.$region.' qa-widgets-'.$region.'-'.$place.'">');

			foreach ($this->content['widgets'][$region][$place] as $module) {
				$widget_key = get_class($module) . '_' .strtoupper(substr($region,0,1).substr($place,0,1)) ;
				// check for filters
				$userpoints = qa_db_user_points_selectspec(qa_get_logged_in_userid());
				if(
					(get_widget_option($widget_key, 'uw_filter_device')=='all' or (qa_is_mobile_probably() and get_widget_option($widget_key, 'uw_filter_device')=='mobile') or (! qa_is_mobile_probably() and get_widget_option($widget_key, 'uw_filter_device')=='desktop'))
					and (get_widget_option($widget_key, 'uw_filter_user')=='anybody' or (get_widget_option($widget_key, 'uw_filter_user')=='visitors' and ! qa_get_logged_in_userid()>0) or (get_widget_option($widget_key, 'uw_filter_user')=='users' and qa_get_logged_in_userid()>0) )
					and (get_widget_option($widget_key, 'uw_filter_user_special')=='anybody' or (get_widget_option($widget_key, 'uw_filter_user_special')=='special' and qa_get_logged_in_level()>=QA_USER_LEVEL_EXPERT) or (get_widget_option($widget_key, 'uw_filter_user_special')=='users' and qa_get_logged_in_userid()>0 and qa_get_logged_in_level()<QA_USER_LEVEL_EXPERT))
					and (get_widget_option($widget_key, 'uw_filter_user_point_enable')==false or (get_widget_option($widget_key, 'uw_filter_user_point_type')=='less' and $userpoints<get_widget_option($widget_key, 'uw_filter_user_point_type')) or (get_widget_option($widget_key, 'uw_filter_user_point_type')=='more' and $userpoints>get_widget_option($widget_key, 'uw_filter_user_point_type')))
				){
					$this->output('<div class="qa-widget-'.$region.' qa-widget-'.$region.'-'.$place.'">');
					// cache th page if it's enabled
					if(isset($module->allow_cache) and $module->allow_cache===true){
						$cache = unserialize( qa_opt('uw_cache_'.$widget_key) );
						$cache_expiration_type = get_widget_option($widget_key, 'uw_cache_exp_type');
						$cache_expiration_delay = (int)get_widget_option($widget_key, 'uw_cache_exp_delay');
						switch ($cache_expiration_type) {
							case 'second':
								$cache_expiration = $cache_expiration_delay;
								break;
							case 'minute':
								$cache_expiration = $cache_expiration_delay*60;
								break;
							case 'hour':
								$cache_expiration = $cache_expiration_delay*3600; //60*60
								break;
							case 'day':
								$cache_expiration = $cache_expiration_delay*86400; //60*60*24
								break;
						}
						if(! isset($cache['expiration']) or @$cache['expiration']+$cache_expiration < time()){
							require_once UW_DIR.'/minifier.php';
							$cache['expiration'] = time();
							ob_start();
							$module->output_widget($region, $place, $this, $this->template, $this->request, $this->content);
							$widget_text = ob_get_clean();
							// HTML Minifier for making cache text smaller, because Q2A option field only stores 8000 charachters
							if(strlen($widget_text)>=8000)
								$cache['data'] = minify_html($widget_text);
							else
								$cache['data'] = $widget_text;
							$cache_text = serialize($cache);
							if(strlen($cache_text)<8000) // there is a limit on how long the stored data in ^options can be
								qa_opt('uw_cache_'.$widget_key, $cache_text);
						}
						echo $cache['data'];
					}else
						$module->output_widget($region, $place, $this, $this->template, $this->request, $this->content);
					$this->output('</div>');
				}
			}

			$this->output('</div>', '');
		}
	}
}

