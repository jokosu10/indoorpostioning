<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		checkLogged();
		$this->load->model('m_history');
	}

	public function GetProfil($id=NULL)
	{
		if (is_null($id)) {
			$mode = 'create';
		} else {
			$mode = 'edit';
		}
		$id_session = $this->session->userdata("id_user");

		$data_content['profil'] = $this->m_profil->get_data('*', $id_session)->row();
		$data_content['mode'] = $mode;
		$data['content'] = $this->load->view('v_profil',$data_content,true);

		$all_denah = $this->m_denah->get_data("*")->result_array();
		$data["all_denah"] = $all_denah;
		$this->load->view('home',$data);
	}
}