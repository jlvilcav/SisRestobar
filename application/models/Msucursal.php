<?php

/**
* 
*/
class Msucursal extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function regSucursal($param){
		$campos = array(
			'nombre' => $param['txtNomSucursal'],
			'codUbigeo' => $param['txtCodUbigeo'],
			'direccion' => $param['txtDireccion'],
			'observacion' => $param['txtObservacion'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

		$this->db->insert('sucursal',$campos);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function regMesasSucursal($param){

		$param['usuCrea'] = $this->session->userdata('s_idUsuario');
		$param['sitReg']  = '1';

		$this->db->insert('mesas',$param);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			return $insert_id;
		}else{
			return false;
		}
		
	}

	function updateMesasSucursal($param){
		$q = "UPDATE mesas SET nombre = ?, ancho = ?, alto = ?, x = ?, y = ? WHERE idMesa = ?";
        $this->db->query($q, array($param['nombre'],$param['ancho'],$param['alto'],$param['x'],$param['y'],$param['idMesa']));
        return $param['idMesa'];
	}

	function updateCroquis($idSucursal, $imagen){
		$q = "UPDATE sucursal SET croquis = ? WHERE idSucursal = ?";
        $this->db->query($q, array($imagen, $idSucursal));
	}

	function regcajasSucursal($param){

		$campos = array(
			'idSucursal' => $param['cboSucursal'],
			'descripcion' => $param['txtDescripcion'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

	
		$this->db->insert('caja_sucursal',$campos);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			return $insert_id;
		}else{
			return 0;
		}
				
	}

	function getMesasSucursal(){
		// $this->db->select('s.nombre, m.cantidad');
		// $this->db->from('mesas as m');
		// $this->db->join('sucursal s','s.idSucursal=m.idSucursal');

		$this->db->select('nombre');
		$this->db->from('mesas');
		$this->db->where('idSucursal',$this->session->userdata('s_idSucursal'));

		$cons = $this->db->get();

		if ($cons->num_rows() > 0) {
			return $cons->result();
		}else{
			return false;
		}	
	}

	function getCajaSucursal($suc){
		$this->db->select('c.idCaja,s.nombre, c.descripcion');
		$this->db->from('caja_sucursal as c');
		$this->db->join('sucursal s','s.idSucursal=c.idSucursal');
		$this->db->where('c.idSucursal',$suc);

		$cons = $this->db->get();

		if ($cons->num_rows() > 0) {
			return $cons->result();
		}else{
			return false;
		}
	}

	public function getList(){
		$this->db->select('idSucursal,nombre');
		$this->db->from('sucursal');
		$q = $this->db->get();
		return $q->result();
	}

	public function getMesasBySucursal($idSucursal){
		// $this->db->select('cantidad');
		// $this->db->from('mesas');
		// $this->db->where('idSucursal',$idSucursal);

		// $cons = $this->db->get();

		// if ($cons->num_rows() > 0) {
		// 	$q = $cons->result();
		// 	return $q[0]->cantidad;
		// }else{
		// 	return false;
		// }

		// $this->db->select('nombre');
		// $this->db->from('mesas');
		// $this->db->where('idSucursal',$idSucursal);

//		$cons = $this->db->get();
		$cons = $this->db->query('SELECT idMesa, nombre, coalesce(ancho,0) ancho, coalesce(alto,0) alto, coalesce(x,0) x, coalesce(y,0) y from mesas where idSucursal = '.$idSucursal);
		$q =  $cons->result();
		return $q;
	
		// if ($cons->num_rows() > 0) {
		// 	$q = $cons->result_array();
		// 	return $q['nombre'];
		// }else{
		// 	return false;
		// }	
	}

	public function getCroquis($idSucursal){
		$this->db->select('croquis');
        $this->db->from('sucursal');
        $this->db->where('idSucursal', $idSucursal);
        $r = $this->db->get()->result();
        return $r[0]->croquis;
	}

	public function getStockInsumosBySucursal($idSucursal, $insumosId){
		$this->db->select('idInsumo, stockXMedida stock');
        $this->db->from('insumo_sucursal');
        $this->db->where('idSucursal', $idSucursal);
        $this->db->where_in('idInsumo', $insumosId);
        $q = $this->db->get();
        return $q->result();
	}

	//metodo de urgencia
	public function getNombreMesa($idMesa){
		$this->db->select('nombre');
        $this->db->from('mesas');
        $this->db->where('idMesa', $idMesa);

        $q = $this->db->get();
        return $q->row('nombre');
	}
}