<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class History_api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_history');
        $this->load->model('m_profil');
    }

    public function HistoryUser_post()
    {
        $user = $this->m_profil->getUserByToken("*",$this->input->post("token_user"))->row();
        $id_user = 0;
        if (count($user) < 1) {
            echo json_encode(array('status'=> 0,'error'=> "Token User Tidak Ada"));
            exit(0);

        }

        $id_user = $user->id_user;

        //input from android
        $input = $this->getinput();
        $data = array_merge($input, array("id_user" => $id_user));

        if ($this->m_history->insert_data($data) == FALSE) {
            echo json_encode(array('status'=> 0,'error'=> "Please Cek Your Input"));
            exit(0);
        } else {
            echo json_encode(array('status'=> 1,'message' => 'Save History Posisi User Sucessful','data'=>$data));
            exit(0);
        }
    }

    private function GetInput(){
        if($this->input->post()){
            $data   = array(
                "time"          => date('Y-m-d H:i:s'),
                "x_user"      => (double) $this->input->post("x_user"),
                "y_user"      => (double) $this->input->post("y_user"),
                "id_area_ruangan"      => (int) $this->input->post("id_area_ruangan"),
            );
        }

        return $data;
    }

}
