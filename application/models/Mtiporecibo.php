<?php
/**
* 
*/
class Mtiporecibo extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getList(){
		$this->db->select('idTipoRecibo,descripcion');
		$this->db->from('tipo_recibo');
		$q = $this->db->get();
		return $q->result();
	}
}