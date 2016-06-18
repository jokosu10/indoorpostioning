<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		checkLogged();
		$this->load->model('m_register');
		$this->load->model('m_denah');
	}
        
	public function GetUsers($id=NULL)
	{
		if (is_null($id)) {
			$mode = 'create';
		} else {
			$mode = 'edit';
		}

		$data_content['users'] = $this->m_register->get_data()->result();
		$data_content['mode'] = $mode;
		$data['content'] = $this->load->view('v_list_users',$data_content,true);

		$all_denah = $this->m_denah->get_data("*")->result_array();
		$data["all_denah"] = $all_denah;
		$this->load->view('home',$data);
	}

	public function AddUser()
	{
		$this->form_validation->set_rules("user_name","Username","required");
		$this->form_validation->set_rules("pass_name","pass_user","required|matches[re_pass_name]");
		$this->form_validation->set_rules("re_pass_name","re_pass_user","required");
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('message_status', 'Eroor');
			
			redirect(site_url('users/getusers'));
		}

		$mode = $this->input->post("mode");



		if ($mode == 'create') {
			$createTokenRegister = $this->m_register->createToken();
			$data = array_merge($this->getinput(), $createTokenRegister);
			if ($this->m_register->insert_data($data) == FALSE) {
			 	$this->session->set_flashdata('message', 'gagal tambah data');
				$this->session->set_flashdata('message_status', 'Eroor');

				redirect(site_url('users/getusers'));
			} else {
				$this->session->set_flashdata('message', 'sukses input data cubeacon');
				$this->session->set_flashdata('message_status', 'Sukses');
				redirect(site_url('users/getusers')); 
			}
		} elseif ($mode == 'edit') {
			$id = $this->input->post("id_user");
			if ($this->m_register->update_data($id,$this->getinput()) == FALSE) {
			 	$this->session->set_flashdata('message', 'gagal Edit data');
				$this->session->set_flashdata('message_status', 'Eroor');
				redirect(site_url('users/getusers'));
			} else {
				$this->session->set_flashdata('message', 'sukses edit data cubeacon');
				$this->session->set_flashdata('message_status', 'Sukses');
				redirect(site_url('users/getusers'));
			}
		}
	}

	/*add data*/
	private function GetInput(){
		if($this->input->post()){
			$data	= array(
				"username" 	=> $this->input->post("user_name"),
				"password" 	=> md5($this->input->post("pass_name"))
			);
		}
		
		return $data;
	}

	public function DeleteUser($id)
	{
		$this->m_register->delete_data($id);
		redirect(site_url('users/getusers'));
	}
   
}