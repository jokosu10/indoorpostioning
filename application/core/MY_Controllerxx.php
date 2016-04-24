<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/* Cara pemakaian template :
	* Setting lokasi template variable $tpl_sidebar, $tpl_header, $tpl_layout, $tpl_footer (bisa custom)
	* variable $data = penampungan info-info : (bisa custom)
	* - $this->data['header'] = var $data utk header
	* - $this->data['sidebar'] = var $data utk sidebar
	* - $this->data['content'] = var $data utk content
	* - $this->data['footer'] = var $data utk footer
	* - $this->data['json'] = var $data utk json
	* - var $data (title, description, keywords, author) sbg global info site.
	 */
	protected $data = Array();

	protected $tpl_header = "template/header";
	protected $tpl_sidebar = "template/sidebar";
	protected $tpl_layout = "template/layout";
	protected $tpl_footer = "template/footer";

	protected function info(){
		$this->data['site_title'] = "Insanislami";
		$this->data['site_description'] = "Insanislami web umroh";
		$this->data['site_keywords'] = "Insanislami, umroh, web";
		$this->data['site_author'] = "Bagus P";
		$this->data['title'] = "";

		$this->data['json'] = "";

		$this->data['header']= "";
		$this->data['content'] 	= "";
		$this->data['sidebar']	= "";
		$this->data['footer']	= "";

		$this->data['header']['site_title'] = "Insanislami";
		$this->data['content']['breadcrumb'] = "";
	}

	public function __construct()
	{
		parent::__construct();
		
		/*if( $this->session->userdata('id_user') == FALSE ) {
			return redirect(site_url('login'));
		}*/

		$this->info();
		$this->load_breadcrumb();
	}

	protected function render($view, $renderData ="fullpage") {
        switch (strtolower($renderData)) {
        case "ajax"     :
        	$this->data['content']['breadcrumb'] = $this->breadcrumbs->show();
            return $this->load->view($view,$this->data['content']);
        break;
        case "json"     :
            return json_output($this->data['json']);
        break;
        case "fullpage" :
        default         : 
        	$this->data['content']['breadcrumb'] = $this->breadcrumbs->show();
			$this->data["_header"] = $this->load->view($this->tpl_header, $this->data['header'],true);
			$this->data["_content"] = $this->load->view($view, $this->data['content'],true);
			$this->data["_sidebar"] = $this->load->view($this->tpl_sidebar, $this->data['sidebar'],true);
			
			//$this->data["_footer"] = $this->load->view($this->tp_footer,$this->data['footer'],true);
			
			//render view
			$this->load->view($this->tpl_layout,$this->data);

			if(!$this->input->is_ajax_request()){
				$this->output->enable_profiler(config_item('enable_debug'));	
			}
		break;
    	}
	}

	private function load_breadcrumb(){
		$this->load->library('breadcrumbs');
		$this->breadcrumbs->push('Dashboard', '#dashboard');
	}

	protected function render_ajax($view) {
		return $this->render($view, 'ajax');
	}

	protected function render_json($view) {
		return $this->render($view, 'json');
	}

	protected function set_tpl_header($val){
		$this->tpl_header = $val;		
	}

	protected function set_tpl_layout($val){
		$this->tpl_layout = $val;		
	}

	protected function set_tpl_sidebar($val){
		$this->tpl_sidebar = $val;		
	}

	protected function set_tpl_footer($val){
		$this->tpl_footer = $val;		
	}

	protected function set_title($val){
		$this->data['title'] = $val;
	}

	protected function set_global_info($key, $val){
		$this->data[$key] = $val;
	}
}