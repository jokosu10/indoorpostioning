<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_register');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function RegisterUser()
	{
		$this->form_validation->set_rules("user_name","Username","required");
		$this->form_validation->set_rules("pass_name","Password","required|matches[re_pass_name]");
		$this->form_validation->set_rules("re_pass_name","Retype Password","required");

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('message_status', 'Eroor');
			
			redirect(site_url('register'));
		}

		$createTokenRegister = $this->m_register->createToken();
		$data = array_merge($this->getinput(), $createTokenRegister);

		if ($this->m_register->insert_data($data) == FALSE) {
		 	$this->session->set_flashdata('message', 'gagal register user');
			$this->session->set_flashdata('message_status', 'Eroor');

			redirect(site_url('register'));
		} else {
			$this->session->set_flashdata('message', 'registrasi user sukses');
			$this->session->set_flashdata('message_status', 'Sukses');
			redirect(site_url('register')); 
		}
	}
	
	/*add data*/
	private function GetInput(){
		if($this->input->post()){
			$data	= array(
				"username"		=> $this->input->post("user_name"),
				"password" 	=> md5($this->input->post("pass_name")),
			);
		}
		
		return $data;
	}	
}