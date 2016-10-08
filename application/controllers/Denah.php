<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		checkLogged();
		$this->load->model('m_denah');
		$this->load->model('m_history');
	}

	/*public function index($id = null)
	{
		if(is_null($id)){
			$id = 1;
		}

		$denah = $this->m_denah->get_data("*", null, 1)->row();
		$data_content["denah"] = array();
		if($denah){
			$data_content["denah"] = array("img_denah_ruangan" => 'imagedenah/'.$denah->img_denah_ruangan);
		}

		if($id == 1){
			$data['content'] = $this->load->view('v_denah_1',$data_content,true);
		}else{
			$data['content'] = $this->load->view('v_denah_2',$data_content,true);
		}

		$this->load->view('home',$data);
	}*/

	/*public function ViewDenah1()
	{
		$denah = $this->m_denah->get_data("*", null , 1)->row();
		$data_content["denah"] = array();
		if($denah){
			$data_content["denah"] = array("img_denah_ruangan" => 'imagedenah/'.$denah->img_denah_ruangan);
		}
		$data['content'] = $this->load->view('v_denah_1',$data_content,true);
		$this->load->view('home',$data);
	}

	public function ViewDenah2()
	{
		$denah = $this->m_denah->getLastDenah()->row();
		$data_content["denah"] = array();
		if($denah){
			$data_content["denah"] = array("img_denah_ruangan" => 'imagedenah/'.$denah->img_denah_ruangan);
		}
		$data['content'] = $this->load->view('v_denah_2',$data_content,true);
		$this->load->view('home',$data);
	}*/

	public function ViewDenahFull()
	{
		$denah = $this->m_denah->getLastDenah()->row();
		$data_content["denah"] = array();
		if($denah){
			$data_content["denah"] = array("img_denah_ruangan" => 'imagedenah/'.$denah->img_denah_ruangan);
		}
				$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
		$data['content'] = $this->load->view('v_denah_3',$data_content,true);
		$this->load->view('home',$data);
	}

	public function UploadDenah1()
	{
		if (empty($_FILES['upload_image_denah1']['name']))
		{
    		$this->form_validation->set_rules('upload_image_denah1', 'Image Denah', 'required');
		}

		//konfig upload image
		$config = array();
		$nama_asli= $_FILES['upload_image_denah1']['name'];
		$config['upload_path'] = 'imagedenah/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		/*$config['file_name'] = $nama_asli;
		$config['max_size'] = '1024';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = true;*/
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_image_denah1')) {
			$error = array('error' => $this->upload->display_errors());
			$data_content['denah'] = '';
			$data['content'] = $this->load->view('v_denah_1',$data_content,true);
			$this->load->view('home',$data);
		} else {
			$id = $this->input->post('id_image_denah_1');
			$nm_image_denah = $nama_asli;
			$this->m_denah->insert_data(array('id_denah_ruangan' => $id, 'img_denah_ruangan' =>$nm_image_denah));

			$data_content['denah'] = array("img_denah_ruangan"=> $config['upload_path'].$nama_asli);
					$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
			$data['content'] = $this->load->view('v_denah_1',$data_content,true);
			$this->load->view('home',$data);
		}
	}

	public function UploadDenah2()
	{
		if (empty($_FILES['upload_image_denah2']['name']))
		{
    		$this->form_validation->set_rules('upload_image_denah2', 'Image Denah', 'required');
		}

		//konfig upload image
		$config = array();
		$nama_asli= $_FILES['upload_image_denah2']['name'];
		$config['upload_path'] = 'imagedenah/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		/*$config['file_name'] = $nama_asli;
		$config['max_size'] = '1024';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = true;*/
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_image_denah2')) {
			$error = array('error' => $this->upload->display_errors());
			$data_content['denah'] = '';
			$data['content'] = $this->load->view('v_denah_2',$data_content,true);
					$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
			$this->load->view('home',$data);
		} else {
			$id = $this->input->post('id_image_denah_2');
			$nm_image_denah = $nama_asli;
			$this->m_denah->insert_data(array('id_denah_ruangan' => $id, 'img_denah_ruangan' =>$nm_image_denah));

			$data_content['denah'] = array("img_denah_ruangan"=> $config['upload_path'].$nama_asli);
			$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
			$data['content'] = $this->load->view('v_denah_2',$data_content,true);
			$this->load->view('home',$data);
		}
	}

	public function UploadDenah3()
	{
		if (empty($_FILES['upload_image_denah3']['name']))
		{
    		$this->form_validation->set_rules('upload_image_denah3', 'Image Denah', 'required');
		}

		//konfig upload image
		$config = array();
		$nama_asli= $_FILES['upload_image_denah3']['name'];
		$config['upload_path'] = 'imagedenah/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		/*$config['file_name'] = $nama_asli;
		$config['max_size'] = '1024';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = true;*/
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_image_denah3')) {
			$error = array('error' => $this->upload->display_errors());
			$data_content['denah'] = '';
			$data['content'] = $this->load->view('v_denah_3',$data_content,true);
			$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
			$this->load->view('home',$data);
		} else {
			$id = $this->input->post('id_image_denah_3');
			$nm_image_denah = $nama_asli;
			$this->m_denah->insert_data(array('id_denah_ruangan' => $id, 'img_denah_ruangan' =>$nm_image_denah));

			$data_content['denah'] = array("img_denah_ruangan"=> $config['upload_path'].$nama_asli);
			$data['content'] = $this->load->view('v_denah_3',$data_content,true);
			$all_denah = $this->m_denah->get_data("*")->result_array();
			$data["all_denah"] = $all_denah;
			$this->load->view('home',$data);
		}
	}

	public function view($id = null)
	{
		$denah = $this->m_denah->get_data("*", $id , 1);
		if($denah->num_rows() < 1){
			show_404();
		}


		$data_content["denah"] = $denah->row_array();
		$data['content'] = $this->load->view('v_denah_1',$data_content,true);

		$all_denah = $this->m_denah->get_data("*")->result_array();
		$data["all_denah"] = $all_denah;
		$this->load->view('home',$data);
	}

	//get all user for posisi x and y user from mysql
	public function getAllHistoryPosisiUser()
	{
		header('Content-Type: application/json');
		$last_time_pos_user = $this->input->get("time");
		$id_user = $this->input->get("id_user");

		$limit = !is_null($this->input->get("limit")) ? $this->input->get("limit") : 10 ;

		$posisiUser = $this->m_history->getUserByIduser("*", $id_user,$limit)->result_array();
		//if ($this->input->is_ajax_request()) {
			echo json_encode(array("data" => $posisiUser));
			exit(0);
		//}

	}

	//get last time per user posisi x and y
	public function getHistoryPosisiUserLastTime()
	{
		header('Content-Type: application/json');
		$last_time_pos_user = $this->input->get("time");
		$id_user = $this->input->get("id_user");

		$posisiUser = $this->m_history->getLastUserPosisi($id_user)->result_array();
		//if ($this->input->is_ajax_request()) {
			echo json_encode(array("data" => $posisiUser));
			exit(0);
		//}

	}
}
