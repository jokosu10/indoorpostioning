<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_area extends MY_Model
{
    protected $table = "tbl_area_ruangan";
    protected $primary_key = "id_area_ruangan";

    function __construct()
    {
        parent::__construct();
    }

    public function getAllArea()
    {
        $sql = $this->db->query("SELECT tar.*, tdr.nama_ruangan
        FROM tbl_area_ruangan tar
        left join tbl_denah_ruangan tdr on tdr.id_denah_ruangan = tar.id_denah_ruangan");

        //var_dump($sql);
        return $sql;
    }
}
