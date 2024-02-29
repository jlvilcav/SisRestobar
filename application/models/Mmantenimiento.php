<?php
/**
* 
*/
class Mmantenimiento extends CI_Model
{
	public function getCambioMoneda(){
		$r = $this->db->get('tipo_cambio_moneda');
		$q = $r->result();
		return $q[0]->valorCambio;
	}

	public function updCambioMoneda($valor){
		$this->db->update('tipo_cambio_moneda',array('valorCambio' => $valor));
	}

	public function regUnidad($u){
		$campos = array(
			'descripcion' => $u
			);

		$this->db->insert('unidad',$campos);
		return $this->db->affected_rows();
	}

	public function updUnidad($idU,$u){
		$campos = array(
			'descripcion' => $u
			);

		$this->db->where('idUnidad',$idU);
		$this->db->update('unidad',$campos);
		return $this->db->affected_rows();
	}

	public function regMedida($m){
		$campos = array(
			'descripcion' => $m
			);

		$this->db->insert('medida',$campos);
		return $this->db->affected_rows();
	}

	public function updMedida($idM,$m){
		$campos = array(
			'descripcion' => $m
			);

		$this->db->where('idMedida',$idM);
		$this->db->update('medida',$campos);
		return $this->db->affected_rows();
	}

	public function getClaveAutorizacion(){
		$r = $this->db->get('rb_sist_config');
		$q = $r->result();
		return $q[1]->valor;
	}
	public function updClaveAutorizacion($valor){
		$this->db->where('idConfig',2);
		$this->db->update('rb_sist_config',array('valor' => $valor));
	}

	public function getSimboloMoneda(){
		$r = $this->db->get('rb_sist_config');
		$q = $r->result();
		return $q[0]->valor;
	}
	public function updSimboloMoneda($valor){
		$this->db->where('idConfig',1);
		$this->db->update('rb_sist_config',array('valor' => $valor));
	}

	public function getPorcentajePropina(){
		$r = $this->db->get('rb_sist_config');
		$q = $r->result();
		return $q[2]->valor;
	}
	public function updPorcentajePropina($valor){
		$this->db->where('idConfig',3);
		$this->db->update('rb_sist_config',array('valor' => $valor));
	}
}