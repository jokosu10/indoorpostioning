<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class Profil_api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_profil');
	}

	public function Profildata_get()
	{
		$data_content['profil'] = $this->m_profil->get_data()->result();
		echo json_encode(array("data"=>$data_content,'status'=> 1,'message' => 'Get Data Profil Successfull'));
		exit(0); 
	}

	public function Profiluser_get($token)
	{
		$data = $this->m_profil->getUserByToken("*", $token)->row_array();
		if(count($data) > 0){
			echo json_encode(array("data"=>$data,'status'=> 1,'message' => 'Get Data Profil Successfull')); 
			exit(0);	
		}else{
			echo json_encode(array("data"=>$data,'status'=> 0,'message' => 'Get Data Profil Failed'));
			exit(0); 
		}
		
	}

	/*public function GetProfil($id=NULL)
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
	}*/

	public function EditProfil_post()
	{
		$mode = $this->input->post("mode");

		//if ($mode == 'edit') {
			$id = $this->input->post("id_user");
			
			if ($this->m_profil->update_data($id,$this->getinput()) == FALSE) {
			 	echo json_encode (array('status'=> 0,'error'=> "Please Cek Your Input"));
			 	exit(0);
			} else {
				echo json_encode (array('status'=> 1,'message' => 'Edit Profil Successfull','Data'=>$this->getinput()));
				exit(0);
			}
	}

	/*add data*/
	private function GetInput(){
		if($this->input->post()){
			$data	= array(
				"username" 		=> $this->input->post("username")
				//"password" 	=> $this->input->post("password"),
			);
			if ($this->input->post("password") != "") {
				$data['password'] = $this->input->post("password");
			}
		}
		 
		return $data;
	}
}