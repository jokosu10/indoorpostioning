<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        checkLogged();
        $this->load->model('m_area');
    }

    public function GetArea($id=NULL)
    {
        if (is_null($id)) {
            $mode = 'create';
        } else {
            $mode = 'edit';
        }

        $data_content['area'] = $this->m_area->get_data()->result();
        $data_content['mode'] = $mode;
        $data['content'] = $this->load->view('v_list_area',$data_content,true);

        $all_area = $this->m_area->get_data("*")->result_array();
        $data["all_area"] = $all_area;
        $this->load->view('home',$data);
    }

    public function AddArea()
    {
        $this->form_validation->set_rules("name_area","Name Area","required");
        $this->form_validation->set_rules("x1_area","x1_area","required|numeric");
        $this->form_validation->set_rules("y1_area","y1_area","required|numeric");
        $this->form_validation->set_rules("x2_area","x2_area","required|numeric");
        $this->form_validation->set_rules("y2_area","y2_area","required|numeric");
        $this->form_validation->set_rules("x3_area","x3_area","required|numeric");
        $this->form_validation->set_rules("y3_area","y3_area","required|numeric");
        $this->form_validation->set_rules("x4_area","x4_area","required|numeric");
        $this->form_validation->set_rules("y4_area","y4_area","required|numeric");

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('message_status', 'Eroor');

            redirect(site_url('area/getarea'));
        }

        $mode = $this->input->post("mode");



        if ($mode == 'create') {
            if ($this->m_area->insert_data($this->getinput()) == FALSE) {
                $this->session->set_flashdata('message', 'Gagal Tambah Data Area Ruangan');
                $this->session->set_flashdata('message_status', 'Eroor');

                redirect(site_url('area/getarea'));
            } else {
                $this->session->set_flashdata('message', 'Sukses Input Data Area Ruangan');
                $this->session->set_flashdata('message_status', 'Sukses');
                redirect(site_url('area/getarea'));
            }
        } elseif ($mode == 'edit') {
            $id = $this->input->post("id_area_ruangan");
            if ($this->m_area->update_data($id,$this->getinput()) == FALSE) {
                $this->session->set_flashdata('message', 'Gagal Edit Data Area Ruangan');
                $this->session->set_flashdata('message_status', 'Eroor');
                redirect(site_url('area/getarea'));
            } else {
                $this->session->set_flashdata('message', 'Sukses Edit Data Area Ruangan');
                $this->session->set_flashdata('message_status', 'Sukses');
                redirect(site_url('area/getarea'));
            }
        }
    }

    /*add data*/
    private function GetInput(){
        if($this->input->post()){
            $data   = array(
                "nama_area_ruangan"  => $this->input->post("name_area"),
                "x1"  => $this->input->post("x1_area"),
                "y1" => $this->input->post("y1_area"),
                "x2"  => $this->input->post("x2_area"),
                "y2" => $this->input->post("y2_area"),
                "x3"  => $this->input->post("x3_area"),
                "y3" => $this->input->post("y3_area"),
                "x4"  => $this->input->post("x4_area"),
                "y4" => $this->input->post("y4_area")
            );
        }

        return $data;
    }

    public function DeleteArea($id)
    {
        $this->m_area->delete_data($id);
        redirect(site_url('area/getarea'));
    }

}
