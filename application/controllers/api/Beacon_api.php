<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Beacon_api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('m_beacon');
	}
        
	public function Cubeacondata_get()
	{
		$data_content['cubeacon'] = $this->m_beacon->get_data()->result();
		$this->response(array('status'=> 1,'message' => 'Get List CuBeacon Successfull','data'=>$data_content)); 
	}

	public function Cubeacon_post($mode="create",$id = null)
	{
		$this->form_validation->set_rules("nama_cubeacon","Nama Cubeacon","required");
		$this->form_validation->set_rules("uuid_cubeacon","UUID Cubeacon","required");
		$this->form_validation->set_rules("major_cubeacon","Major Cubeacon","required");
		$this->form_validation->set_rules("minor_cubeacon","Minor Cubeacon","required");
		$this->form_validation->set_rules("mac_cubeacon","Mac Address Cubeacon","required");
		$this->form_validation->set_rules("x_pos_cubeacon","X Postion Cubeacon","required");
		$this->form_validation->set_rules("y_pos_cubeacon","Y Postion Cubeacon","required");
		$this->form_validation->set_rules("token","Token","required");
		
		if ($this->form_validation->run() == FALSE) {
			$this->response(array('status'=> 0,'error'=> strip_tags(validation_errors())));
		}

		if ((int)checkToken($this->input->post("token")) < 1) {
			$this->response(array('status'=> 0,'error'=> "Token Not Match"));
		}

		if ($mode == 'create') {
			if ($this->m_beacon->insert_data($this->getinput()) == FALSE) {
			 	$this->response(array('status'=> 0,'error'=> "Please Cek Your Input"));
			} else {
				$this->response(array("Data"=>$this->getinput(),'status'=> 1,'message' => 'Add Beacon Successfull')); 
			}
		} elseif ($mode == 'edit') {
			if ($this->m_beacon->get_data('*',$id)->num_rows() < 1) {
				$this->response(array('status'=> 0,'error'=> "Cubeacon Not Available"));
			}

			if ($this->m_beacon->update_data($id,$this->getinput()) == FALSE) {
				$this->response(array('status'=> 0,'error'=> "Please Cek Your Input"));
			} else {
				$this->response(array("Data"=>$this->getinput(),'status'=> 1,'message' => 'Edit Beacon Successfull'));
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