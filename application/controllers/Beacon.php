<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beacon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		checkLogged();
		$this->load->model('m_beacon');
	}
        
	public function GetCubeacon($id=NULL)
	{
		if (is_null($id)) {
			$mode = 'create';
		} else {
			$mode = 'edit';
		}

		$data_content['cubeacon'] = $this->m_beacon->get_data()->result();
		$data_content['mode'] = $mode;
		$data['content'] = $this->load->view('v_add_beacon',$data_content,true);
		$this->load->view('home',$data);
	}

	public function AddCubeacon()
	{
		$this->form_validation->set_rules("nama_cubeacon","Nama Cubeacon","required");
		$this->form_validation->set_rules("uuid_cubeacon","UUID Cubeacon","required");
		$this->form_validation->set_rules("major_cubeacon","Major Cubeacon","required");
		$this->form_validation->set_rules("minor_cubeacon","Minor Cubeacon","required");
		$this->form_validation->set_rules("mac_cubeacon","Mac Address Cubeacon","required");
		$this->form_validation->set_rules("x_pos_cubeacon","X Postion Cubeacon","required");
		$this->form_validation->set_rules("y_pos_cubeacon","Y Postion Cubeacon","required");
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', validation_errors());
			$this->session->set_flashdata('message_status', 'Eroor');
			
			redirect(site_url('beacon/getcubeacon'));
		}

		$mode = $this->input->post("mode");

		if ($mode == 'create') {
			if ($this->m_beacon->insert_data($this->getinput()) == FALSE) {
			 	$this->session->set_flashdata('message', 'gagal tambah data');
				$this->session->set_flashdata('message_status', 'Eroor');

				redirect(site_url('beacon/getcubeacon'));
			} else {
				$this->session->set_flashdata('message', 'sukses input data cubeacon');
				$this->session->set_flashdata('message_status', 'Sukses');
				redirect(site_url('beacon/getcubeacon')); 
			}
		} elseif ($mode == 'edit') {
			$id = $this->input->post("id_cubeacon");
			if ($this->m_beacon->update_data($id,$this->getinput()) == FALSE) {
			 	$this->session->set_flashdata('message', 'gagal Edit data');
				$this->session->set_flashdata('message_status', 'Eroor');
				redirect(site_url('beacon/getcubeacon'));
			} else {
				$this->session->set_flashdata('message', 'sukses edit data cubeacon');
				$this->session->set_flashdata('message_status', 'Sukses');
				redirect(site_url('beacon/getcubeacon'));
			}
		}
	}

	/*add data*/
	private function GetInput(){
		if($this->input->post()){
			$data	= array(
				"nama_cubeacon" 		=> $this->input->post("nama_cubeacon"),
				"uuid_cubeacon" 	=> $this->input->post("uuid_cubeacon"),
				"major_cubeacon" 	=> $this->input->post("major_cubeacon"),
				"minor_cubeacon" 		=> $this->input->post("minor_cubeacon"),
				"mac_address" 		=> $this->input->post("mac_cubeacon"),
				"x_position" 		=> $this->input->post("x_pos_cubeacon"),
				"y_position" 		=> $this->input->post("y_pos_cubeacon"),
			);
		}
		
		return $data;
	}

	public function DeleteCubeacon($id)
	{
		$this->m_beacon->delete_data($id);
		redirect(site_url('beacon/getcubeacon'));
	}
   
}