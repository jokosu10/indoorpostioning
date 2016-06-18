<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		checkLogged();
		$this->load->model('m_denah');
	}

	public function index()
	{
		$all_denah = $this->m_denah->get_data("*")->result_array();
		$data["all_denah"] = $all_denah;
		$this->load->view('home', $data);
	}
}
