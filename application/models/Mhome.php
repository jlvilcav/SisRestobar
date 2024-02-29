<?php
/**
* 
*/
class Mhome extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getCantCompras(){
		$this->db->where('idSucursal',$this->session->userdata('s_idSucursal'));
		$this->db->where('sitReg',1);
		$con = $this->db->get('compras');

		return $con->num_rows();
	}

	public function getCantVentas(){
		$this->db->where('idSucursal',$this->session->userdata('s_idSucursal'));
		$this->db->where('estado',2);
		$con = $this->db->get('ventas');

		return $con->num_rows();
	}

	public function getCantProductos(){
		//antes
		// $this->db->where('idSucursal',$this->session->userdata('s_idSucursal'));
		// $con = $this->db->get('producto_sucursal');
		// return $con->num_rows();

		//ahora
		$con = $this->db->get('producto');
		return $con->num_rows();
	}

	//economico
	public function getTotalEfectivo(){
		return 0;
		// $q = "SELECT 
		// 	SUM(kc.monto)+acc.monto monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.tipoPago = 'EFECTIVO'
		// 	AND acc.ultimo = 1 AND acc.estado='A'";

		// $cons = $this->db->query($q);
		// return $cons->row('monto');
	}

	public function getTotalVisa(){
		return 0;
		// $q = "SELECT 
		// 	SUM(kc.monto) monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.tipoPago = 'VISA'
		// 	AND acc.ultimo = 1";

		// $cons = $this->db->query($q);
		// return $cons->row('monto');
	}

	public function getTotalMastercard(){
		return 0;
		// $q = "SELECT 
		// 	SUM(kc.monto) monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.tipoPago = 'MASTERCARD'
		// 	AND acc.ultimo = 1";
		
		// $cons = $this->db->query($q);
		// return $cons->row('monto');
	}

	public function getInsStockMin(){
		$idSucursal = $this->session->userdata('s_idSucursal');
		$q = "
			SELECT @rownum:=@rownum+1 AS rownum, isu.idInsumo, i.descripcion insumo, i.cantMedXUnid, i.stockMinXMed minimo, ROUND((i.stockMinXMed/i.cantMedXUnid),0) minUnidad, isu.stockUnid, isu.stockXMedida stock, u.descripcion unidad
			FROM (SELECT @rownum:=0) f, insumo_sucursal isu
			INNER JOIN insumo i ON i.idInsumo = isu.idInsumo
			INNER JOIN unidad u ON u.idUnidad = i.idUnidad
			WHERE isu.idSucursal = $idSucursal
			AND isu.stockXMedida <= i.stockMinXMed
		";
		
		$r = $this->db->query($q);
		return $r->result();
	}
}