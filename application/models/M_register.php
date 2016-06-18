<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_register extends MY_Model 
{
	protected $table = "tbl_user";
	protected $primary_key = "id_user";
	
    function __construct()
    {
        parent::__construct();
    }

    public function createToken()
    {   
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d H:i:s');
        
        $string = array(
                'token'=> $token,
                'join_date'=>$date
            );
        //$query = $this->db->insert_string('tokens',$string);
        //$this->db->query($query);
        return $string;
        
    } 

    public function checkToken($token)
    {
        $query = $this->search_data('*',array("token"=>$token),"and");
        //var_dump($query->num_rows());die;
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}