<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_beacon extends MY_Model 
{
	protected $table = "tbl_cubeacon";
	protected $primary_key = "id_cubeacon";
	
    function __construct()
    {
        parent::__construct();
    }
}