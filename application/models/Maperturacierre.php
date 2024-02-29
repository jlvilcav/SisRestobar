<?php
/**
* 
*/
class Maperturacierre extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	//no lo llaman
	public function regAperturaCierre($param){
		$campos = array(
			'idSucursal' => $param['idSucursal'],
			'idCaja' => $param['idCaja'],
			'monto' => $param['monto'],
			'estado' => $param['estado'],
			'ultimo' => $param['ultimo'],
			'usuCrea' => $this->session->userdata('s_idUsuario')
		);
		
		$this->db->insert('apertura_cierre_caja',$campos);
		$id = $this->db->insert_id();

		if ($id>0) {
			return $id;
		}else{
			return 0;
		}
	}

	public function getCajaAC($idSu){
		$consult = $this->db->query('CALL usp_sel_cajaac('.$idSu.')');
		return $consult->result();
	}

	public function aperturaCierre($param){
		$today = new DateTime();

		//empezamos una transacción
		$this->db->trans_begin();
		
			//actualizamos ultimo=0 segun idAperturaCierre
			$updData=array('ultimo'=>0);
			$this->db->where('idAperturaCierre',$param['idAperturaCaja']);
			$this->db->update('apertura_cierre_caja',$updData);
			
			//insertamos el nuevo valor
			$camposAC = array(
				'idSucursal' => $param['idSucursal'],
				'idCaja' => $param['idCaja'],
				'monto' => $param['monto'],
				'estado' => $param['estado'],
				'ultimo' => 1,
				'usuCrea' => $this->session->userdata('s_idUsuario'),
				'fecApertura' => date_format($today, 'Y-m-d H:i:s')
			);
			
			$this->db->insert('apertura_cierre_caja',$camposAC);
			$last_idAperturaCierre =  $this->db->insert_id();

			//insertamos kardex_caja
			$param['idOperacion'] = $last_idAperturaCierre;
			$this->regKardexCaja($param);
					
		//comprobamos si se han llevado a cabo correctamente todas las consultas
		if ($this->db->trans_status() === FALSE)
		{			
			//si ha habido algún error lo debemos mostrar aquí
        	$this->db->trans_rollback();			
		}else{			
			//en otro caso todo ha ido bien
			$this->db->trans_commit();
		}
	}

	public function regKardexCaja($param){
		//actualizamos "ultimo"=0 segun el id caja..
		$updData=array('ultimo'=>0);
		$this->db->where('idCaja',$param['idCaja']);
		$this->db->update('kardex_caja',$updData);

		//insertamos en kardex_caja
		$today = new DateTime();
		$camposKC = array(
			'idTipMovCaja' => $param['idTipMovCaja'],
			'idSucursal' => $param['idSucursal'],
			'idOperacion' => $param['idOperacion'],
			'idCaja' => $param['idCaja'],
			'monto' => $param['monto'],
			'saldo' => $param['saldo'],
			'fecha' => date_format($today, 'Y-m-d H:i:s'),
			'ultimo' => $param['ultimo'],
			'usuCrea' => $this->session->userdata('s_idUsuario')
		);
		$this->db->insert('kardex_caja',$camposKC);
	}

	public function getLastSaldo($idC){
		$q = 'SELECT saldo FROM kardex_caja AS kc WHERE kc.idKardexCaja = (SELECT MAX(idKardexCaja) FROM kardex_caja WHERE idCaja = ?)';
		$consulta = $this->db->query($q, array($idC));

		return $consulta->row('saldo');
		
	}

	public function verifEstadoCaja($idC){
		$q = 'SELECT estado FROM apertura_cierre_caja AS acc WHERE acc.idAperturaCierre = 
				(SELECT MAX(idAperturaCierre) FROM apertura_cierre_caja WHERE idCaja = ?)';

		$cons = $this->db->query($q, array($idC));
		return $cons->row('estado');		
	}

	public function getTotalPropina($idC){
		$q = "SELECT 
				SUM(propina) propina
				FROM ventas
				WHERE fecCrea >= 
				(SELECT 
				acc.fecApertura
				FROM apertura_cierre_caja acc
				WHERE acc.idCaja = ? AND acc.ultimo = 1 AND acc.estado='A')";

		$cons = $this->db->query($q, array($idC));
		return $cons->row('propina');		
	}

	public function getTotalEfectivo($idC,$fecApert){
		// $q = "SELECT 
		// 	SUM(kc.monto)+acc.monto monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.idCaja = ? AND kc.tipoPago = 'EFECTIVO'
		// 	AND acc.ultimo = 1 AND acc.estado='A'
		// 	AND kc.fecha >= acc.fecApertura";

		$q = "
			SELECT SUM(monto) monto FROM kardex_caja
			WHERE idCaja = $idC AND tipoPago = 'EFECTIVO' AND fecha>'$fecApert'
		";

		// $cons = $this->db->query($q, array($idC));
		$cons = $this->db->query($q);
		return $cons->row('monto');
	}

	public function getTotalVisa($idC,$fecApert){
		// $q = "SELECT 
		// 	SUM(kc.monto) monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.idCaja = ? AND kc.tipoPago = 'VISA'
		// 	AND acc.ultimo = 1 AND acc.estado='A'
		// 	AND kc.fecha >= acc.fecApertura";

		$q = "
			SELECT SUM(monto) monto FROM kardex_caja
			WHERE idCaja = $idC AND tipoPago = 'VISA' AND fecha>'$fecApert'
		";

		// $cons = $this->db->query($q, array($idC));
		$cons = $this->db->query($q);
		return $cons->row('monto');	
	}

	public function getTotalMastercard($idC,$fecApert){
		// $q = "SELECT 
		// 	SUM(kc.monto) monto
		// 	FROM  kardex_caja kc
		// 	INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
		// 	WHERE kc.idCaja = ? AND kc.tipoPago = 'MASTERCARD'
		// 	AND acc.ultimo = 1 AND acc.estado='A'
		// 	AND kc.fecha >= acc.fecApertura";

		// $cons = $this->db->query($q, array($idC));
		$q = "
			SELECT SUM(monto) monto FROM kardex_caja
			WHERE idCaja = $idC AND tipoPago = 'MASTERCARD' AND fecha>'$fecApert'
		";

		// $cons = $this->db->query($q, array($idC));
		$cons = $this->db->query($q);
		return $cons->row('monto');	
	}

	public function getCantApertura($idC){
		$q = "SELECT 
			acc.monto monto
			FROM apertura_cierre_caja acc
			WHERE acc.idCaja = ? AND acc.ultimo = 1 AND acc.estado='A'";

		$cons = $this->db->query($q, array($idC));
		return $cons->row('monto');	
	}

	public function getFecApertura($idC){
		$q = " SELECT fecApertura FROM apertura_cierre_caja
				WHERE ultimo = 1 AND estado = 'A'
				AND idCaja = $idC ";

		$cons = $this->db->query($q);
		return $cons->row('fecApertura');	
	}
	
}