<?php 
/**
*  
*/
class Mubigeo extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function listDepartamentos(){
		$this->db->select('codDepartamento,nombre');
		$this->db->from('ubigeo');
		$this->db->where('codProvincia','00');
		$this->db->where('codDistrito','00');

		$ld = $this->db->get();
		if ($ld->num_rows() > 0) {
			return $ld->result();
		}else{
			return false;
		}
		
	}

	public function listProvincia($dep){
		$this->db->select('codProvincia,nombre');
		$this->db->from('ubigeo');
		$this->db->where('codDepartamento',$dep);
		$this->db->where('codDistrito','00');
		$this->db->where('codProvincia !=','00');

		$lp = $this->db->get();
		if ($lp->num_rows() > 0) {
			return $lp->result();
		}else{
			return false;
		}
	}

	public function listDistrito($dep,$prov){
		$this->db->select('codDistrito,nombre');
		$this->db->from('ubigeo');
		$this->db->where('codDepartamento',$dep);
		$this->db->where('codProvincia',$prov);
		$this->db->where('codDistrito !=','00');

		$ld = $this->db->get();

		if ($ld->num_rows() > 0) {
			return $ld->result();
		}else{
			return false;
		}
	}
}