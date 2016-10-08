<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profil extends MY_Model 
{
	protected $table = "tbl_user";
	protected $primary_key = "id_user";
	
    function __construct()
    {
        parent::__construct();
    }

    function getUserByToken($coloumn = '*', $where)
    {
		$this->db->or_where('token = ',$where);
		$this->db->select($coloumn);
		$result = $this->db->get($this->table);
		
		return $result;
    }
}