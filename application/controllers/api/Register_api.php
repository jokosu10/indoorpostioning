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
class Register_api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_register');
    }

    public function index()
    {
        # code...
    }

    public function RegisterUser_post()
    {
        $this->form_validation->set_rules("user_name","Username","required|min_length[5]|max_length[12]|is_unique[tbl_user.username]");
        $this->form_validation->set_rules("pass_name","Password","required|matches[re_pass_name]");
        $this->form_validation->set_rules("re_pass_name","Retype Password","required");

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status'=> 0,'error'=> strip_tags(validation_errors())));
        }

        $createTokenRegister = $this->m_register->createToken();
        $data = array_merge($this->getinput(), $createTokenRegister);

        if ($this->m_register->insert_data($data) == FALSE) {
            $this->response(array('status'=> 0,'error'=> "Please Cek Your Input"));
        } else {
            $this->response(array("Data"=>$data,'status'=> 1,'message' => 'Register Sucessful'));
 
        }
    }

    private function GetInput(){
        if($this->input->post()){
            $data   = array(
                "username"      => $this->input->post("user_name"),
                "password"  => md5($this->input->post("pass_name"))            
            );
        }
        
        return $data;
    }

}
