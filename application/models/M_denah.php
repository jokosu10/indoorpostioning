<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_denah extends MY_Model 
{
	protected $table = "tbl_denah_ruangan";
	protected $primary_key = "id_denah_ruangan";
	
    function __construct()
    {
        parent::__construct();
    }

    public function getLastDenah()
    {
    	$sql = $this->db->query("SELECT *
                FROM tbl_denah_ruangan
                ORDER BY id_denah_ruangan DESC
                LIMIT 1");

    	//var_dump($sql);
    	return $sql;
    }
}