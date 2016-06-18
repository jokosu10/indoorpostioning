<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_register');
	}

	public function index()
	{
		$this->load->view('login');
	}


	function CekPass()
	{
		$this->load->model('m_register');
		$nm_user = $this->input->post("user_name");
		$pass_user = $this->input->post("pass_name");
		$cek_login = $this->m_register->search_data('*',array("username"=>$nm_user,"password"=>md5($pass_user)),"and");

		if ($cek_login->num_rows() > 0) {
			$this->session->set_flashdata('message_status', 'Login Sukses');
			$this->session->set_userdata(array("id_user"=>$cek_login->row()->id_user,"username"=>$cek_login->row()->username));
			redirect(site_url('home'));	
			return true;
		} else {
			$this->session->set_flashdata('message', 'Login Failed');
			$this->session->set_flashdata('message_status',"User atau Password Salah");
			redirect(site_url('login'));
			return false;
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login","refresh");
	}
}