<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Login_api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_register');
	}

	public function index()
	{
		$this->load->view('login');
	}


	public function CekPass_post()
	{
		//$this->load->model('m_register');

		$this->form_validation->set_rules("user_name","Username","required");
        $this->form_validation->set_rules("pass_name","Password","required");
        $this->form_validation->set_rules("token","Token","required");

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status'=> 0,'error'=> strip_tags(validation_errors())));
        }

        $nm_user = $this->input->post("user_name");
		$pass_user = $this->input->post("pass_name");
		$token_user = $this->input->post("token");

		$cek_login = $this->m_register->search_data('*',array("username"=>$nm_user,"password"=>md5($pass_user), "token" => $token_user),"and");

		if ($cek_login->num_rows() > 0) {
			$this->response(array("Data"=>$cek_login->row_array(),'status'=> 1,'message' => 'Login Sucessful'));
		} else {
			$this->response(array('status'=> 0,'error'=> "Please Cek Your Input"));
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login","refresh");
	}
}