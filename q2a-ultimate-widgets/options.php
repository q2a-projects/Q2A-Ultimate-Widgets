<?php
/* don't allow this page to be requested directly from browser */	
if (!defined('QA_VERSION')) {
		header('Location: /');
		exit;
}
class uw_options {
	var $directory;
	var $urltoroot;
	var $saved;
	
	function load_module($directory, $urltoroot) {
		$this->directory=$directory;
		$this->urltoroot=$urltoroot;
	}

	function match_request($request){
		if ($request=='admin/ulitmate_widgets')
			return true;
		return false;
	}
	
	function process_request($request)
	{
		$qa_content = qa_content_prepare();
		if (qa_get_logged_in_level() < QA_USER_LEVEL_ADMIN){
			$qa_content['error']="You don't have permission to access this page.";
			return $qa_content;
		}
		global $qa_modules;
		$qa_content['site_title'] = "Q2A Ultimate Widgets by QA-Themes.com ";
		$qa_content['title']="Ultimate Widgets";
		$qa_content['error']="";
		$qa_content['suggest_next']="";
		
		$qa_content['script_rel'][]= $qa_modules['page']['Ultimate Widgets Options']['urltoroot'] . 'include/easyResponsiveTabs.js';
		$qa_content['script_rel'][]= $qa_modules['page']['Ultimate Widgets Options']['urltoroot'] . 'include/main.js';
		$qa_content['css_src'][]= $this->urltoroot . 'include/style.css';
		
		$qa_content['custom'] = $this->page_form();
		//empty sidebar's content
		$qa_content['sidepanel'] = '';
		$qa_content['sidebar'] = '';
		unset($qa_content['widgets']);
		$qa_content['widgets']= array();
		
		return $qa_content;	
	}
	
	function page_form(){
		$output = '';
		if ( (qa_clicked('useo_save')) && ($this->saved==false) ){
				// qa_opt('useo_title_qa', qa_post_text('useo_title_qa'));
				// ~~~
				$output .= '<div class="qa-form-tall-ok">Settings were saved.</div>';
				$this->saved = true;
		}else{
				$this->saved = false;
		}
		if(qa_clicked('useo_reset')){
			//useo_reset_settings();
		}
		global $qa_modules;
		$output .= '
			<form name="useo" action="'.qa_self_html().'" method="post">
				<div id="verticalTab">
					<ul class="resp-tabs-list">
						<li>About<span>Ultimate Widgets Plugin & Developer</span></li>
						<li>To Do<span>New Feature Request</span></li>
					</ul>
					<div class="resp-tabs-container">
						<div>
							' . $this->get_page_contents('about.php') . '
						</div>
						<div>                   
							' . $this->get_page_contents('todo.php') . '
						</div>
					</div>
				</div>
			</form>
		';
		/*
					<section class="qseo-buttons-container">
						<input class="qa-form-tall-button qa-form-tall-button-save useo-right" type="submit" title="" value="Save Changes" name="useo_save">
						<input class="qa-form-tall-button " type="submit" title="" value="Reset Settings" name="useo_reset">
					</section>
		*/
		return $output;
	}
	function get_page_contents($page){
		ob_start();
		include $this->directory . 'option-pages/' . $page;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

