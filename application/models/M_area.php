<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_area extends MY_Model
{
    protected $table = "tbl_area_ruangan";
    protected $primary_key = "id_area_ruangan";

    function __construct()
    {
        parent::__construct();
    }
}
