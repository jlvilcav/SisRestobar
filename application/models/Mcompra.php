<?php
/**
* 
*/
class Mcompra extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function regCompra($param){
		$today = new DateTime();
		$param['sitReg'] = '1';
		$param['usuCrea'] = $this->session->userdata('s_idUsuario');
		$param['fecCompra'] = $param['fecCrea'] = date_format($today, 'Y-m-d H:i:s');
		
		$this->db->insert('compras',$param);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;
		}else{
			return 0;
		}
	}

	public function addDetalle($param){

		$data = array(
			'idCompra' => $param['idCompra'],
			'idInsumo' => $param['id'],
			'idSucursal' => $param['idSucursal'],
			'cant' => $param['cantidad'],
			'cantXMedida' => $param['cantMedXUnid'],
			'pcosto' => $param['prunit'],
			'ptotal' => str_replace(",","",$param['importe']),
			);
		
		$this->db->insert('detalle_compra',$data);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;
		}else{
			return 0;
		}
	}

	public function countBySucursal($idSucursal){
		$this->db->select('count(1) compras');
		$this->db->from('compras');
		$q = $this->db->get();
		$c = $q->result();
		return $c[0]->compras;
	}

	public function getComprasBySucursal($idS){
		$this->db->select("c.numCompra, c.numCompraGenerado,
			p.razonSocial,
			DATE_FORMAT(c.fecCompra,'%d/%m/%Y %h:%i %p') fecCompra,
			tr.descripcion,
			c.total,
			CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) empleado,
			c.idCompra",false);
		$this->db->from('compras c');
		$this->db->join('proveedor p','p.idProveedor = c.idProveedor');
		$this->db->join('usuario u','u.idUsuario = c.usuCrea');
		$this->db->join('persona per','per.idPersona = u.idPersona');
		$this->db->join('tipo_recibo tr','tr.idTipoRecibo = c.idTipoRecibo');
		$this->db->where('c.idSucursal',$idS);
		$this->db->order_by('c.idCompra', "desc");

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function getDetalleCompra($id){
		$this->db->select("i.descripcion,
			dc.cant,
			dc.pcosto,
			ptotal",false);
		$this->db->from('detalle_compra dc');
		$this->db->join('insumo i','i.idInsumo = dc.idInsumo');
		$this->db->where('dc.idCompra',$id);

		$consulta = $this->db->get();
		return $consulta->result();
	}

}