<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_beacon extends MY_Model
{
	protected $table = "tbl_cubeacon";
	protected $primary_key = "id_cubeacon";

    function __construct()
    {
        parent::__construct();
    }

    public function getAllCubeacon()
    {
        $sql = $this->db->query("SELECT tc.*, tdr.nama_ruangan
                FROM tbl_cubeacon tc
                left join tbl_denah_ruangan tdr on tdr.id_denah_ruangan = tc.id_denah_ruangan");

        //var_dump($sql);
        return $sql;
    }
}
