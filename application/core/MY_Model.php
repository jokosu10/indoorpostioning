<?php 
class MY_Model extends CI_Model {

	protected $table = "";
	protected $primary_key = "";
	
    function __construct()
    {
        parent::__construct();
    }
	
	function auto_number($coloumn = null)
	{
		if($coloumn == null){
			$this->db->select_max($this->primary_key);
		} else {
			$this->db->select_max($coloumn);
		}
		$data = $this->db->get($this->table);

		if($data->num_rows() > 0){
			$new_num = (($coloumn == null) ? $data->row($this->primary_key) : $data->row($coloumn)) + 1;
		} else {
			$new_num = 1;
		}
		return $new_num;
	}
    
    function get_data($coloumn = '*', $id = null, $limit = null, $offset = null)
    {
		if($id == null){
			$this->db->select($coloumn);
			$result = $this->db->get($this->table, $limit, $offset);
		} else {
			$this->db->select($coloumn);
			$result = $this->db->get_where($this->table, array($this->primary_key => $id), $limit, $offset);
		}
		
		return $result;
    }

    function search_data($coloumn = '*', $where, $where_method = null, $limit = null, $offset = null)
    {
		foreach($where as $col_where => $val_where){
			if($where_method == 'or'){
				$this->db->or_where($col_where.' like ', '%'.$val_where.'%');
			} else {
				$this->db->where($col_where.' like ', '%'.$val_where.'%');
			}
		}
		$this->db->select($coloumn);
		$result = $this->db->get($this->table, $limit, $offset);
		
		return $result;
    }
	
	function insert_data($data)
    {
		$result = $this->db->insert($this->table, $data);
		//$result = $this->db->affected_rows();
		return $result;
    }

    function insert_batch_data($data)
    {
		$result = $this->db->insert_batch($this->table, $data);
		//$result = $this->db->affected_rows();
		return $result;
    }

    function update_data($id, $data)
    {
        $result = $this->db->update($this->table, $data, array($this->primary_key => $id));
		return $result;
    }

    function update_batch_data($id, $data)
    {
        $result = $this->db->update_batch($this->table, $data, array($this->primary_key => $id));
		return $result;
    }
	
	function delete_data($id)
    {
		$this->db->delete($this->table, array($this->primary_key => $id));
		$result = ($this->db->affected_rows() < 1) ? FALSE : TRUE;
		return $result;
    }
	
	function run_query($query){
		$result = $this->db->query($query);
		return $result;
	}

	function last_insert_id(){
		return $this->db->insert_id();
	}

	function count(){
		return $this->db->count_all($table);
	}

	function select_max($coloumn){
		$this->db->select_max($coloumn);
		$query = $this->db->get($coloumn);
		return $query;
	}

	function truncate_table(){
		$this->db->truncate($this->table);
	}
}