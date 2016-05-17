<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_denah');
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

	public function ViewDenah1()
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
			$this->load->view('home',$data);	
		} else {
			$id = $this->input->post('id_image_denah_2');
			$nm_image_denah = $nama_asli;
			$this->m_denah->insert_data(array('id_denah_ruangan' => $id, 'img_denah_ruangan' =>$nm_image_denah));

			$data_content['denah'] = array("img_denah_ruangan"=> $config['upload_path'].$nama_asli);  
			$data['content'] = $this->load->view('v_denah_2',$data_content,true);
			$this->load->view('home',$data);
		}
	}
}
