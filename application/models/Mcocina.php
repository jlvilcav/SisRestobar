<?php
class Mcocina extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProductosPorCocina($opc){

		$ids = $this->session->userdata('s_idSucursal');

		$hoy = date('Y-m-d');

		$q = "SELECT estado, GROUP_CONCAT(id SEPARATOR ',') AS idImprimeTickets, producto, SUM(cntd) AS cntd, mesa, idVenta, GROUP_CONCAT(observacion SEPARATOR '<br>') AS observacion, destino, mozo, idSucursal
				FROM imprime_tickets
				WHERE idSucursal = 2 AND estado IN (1,2) AND destino = '$opc' AND creado > '$hoy 00:00:00'
				GROUP BY producto, mesa, idVenta, observacion, destino, mozo, idSucursal
				ORDER BY idVenta ASC, id ASC ";
				// return $q;
		$r = $this->db->query($q);
		return $r->result();
	}

	public function getProductosPorCocinaFinalizado($opc){

		$ids = $this->session->userdata('s_idSucursal');

		$hoy = date('Y-m-d');

		$q = "SELECT IFNULL(SEC_TO_TIME(TIMESTAMPDIFF(SECOND , tiempoInicio, tiempoFin )),'00:00:00') AS demora, estado, GROUP_CONCAT(id SEPARATOR ',') AS idImprimeTickets, producto, SUM(cntd) AS cntd, mesa, idVenta, GROUP_CONCAT(observacion SEPARATOR '<br>') AS observacion, destino, mozo, idSucursal
				FROM imprime_tickets
				WHERE idSucursal = 2 AND estado = 3 AND destino = '$opc' AND creado > '$hoy 00:00:00'
				GROUP BY producto, mesa, idVenta, observacion, destino, mozo, idSucursal
				ORDER BY idVenta ASC, id ASC ";
				// return $q;
		$r = $this->db->query($q);
		return $r->result();
	}

	public function setEnProceso($idImprimeTickets){
		$hoy = date('Y-m-d H:i:s');
		$q = "UPDATE imprime_tickets SET estado = 2, tiempoInicio = '$hoy' WHERE id IN ($idImprimeTickets) ";
		$r = $this->db->query($q);
		return $this->db->affected_rows();
	}

	public function setFinalizado($idImprimeTickets){
		$hoy = date('Y-m-d H:i:s');
		$q = "UPDATE imprime_tickets SET estado = 3, tiempoFin = '$hoy' WHERE id IN ($idImprimeTickets) ";
		$r = $this->db->query($q);
		return $this->db->affected_rows();
	}

}

