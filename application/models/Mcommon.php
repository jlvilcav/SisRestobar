<?php
class Mcommon extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function fillfull($table)
	{
		$sql = $this->db->get($table);    		
        return $sql->result();
	}	

	public function existe($table,$campo,$val)
	{
		$this->db->where($campo,$val);
		$sql = $this->db->get($table);
		if ($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return "0";
		}
        
	}
}