<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_history extends MY_Model
{
    protected $table = "tbl_history_user";
    protected $primary_key = "id_history";

    function __construct()
    {
        parent::__construct();
    }

    function getUserByIduser($coloumn = '*', $id_user = array(), $limit=1)
    {
        if (!is_null($id_user)) {
            $this->db->where_in('id_user = ',$id_user);
        }

        $this->db->select("tbl_user.id_user, username ,x_user, y_user, time");
        $this->db->join("tbl_user","tbl_history_user.id_user = tbl_user.id_user");
        $this->db->order_by($this->primary_key,"desc");
        $this->db->limit($limit);

        $result = $this->db->get($this->table);

        return $result;
    }

    function getLastUserPosisi($id_user = array())
    {
        $sql = "SELECT  history_user.id_user,username, x_user, y_user, time
            FROM (select * from tbl_history_user order by time desc) as history_user
            left join tbl_user tu on tu.id_user = history_user.id_user";
        if (count($id_user) > 0) {
            $sql .= " where in history_user.id_user".implode(",",id_user);
        }

        $sql .= " group by history_user.id_user";
        return $this->db->query($sql);

    }
}
