<?php
/**
* 
*/
class Musuario extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function regPerfil($per){
		$campos = array(
			'descripcion'=>$per,
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);
		$this->db->insert('perfil',$campos);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;	
		}else{
			return 0;
		}
	}

	public function regUsuario($param){
		//guardamos Empleado
		$campos = array(
			'idPersona' => $param['hdnIdPersona'],
			'fecIngreso' => date('Y-m-d',strtotime(str_replace('/','-',$param['datFecIngreso']))),
			'idSucursal' => $param['cboSucursal'],
			'sueldo' => $param['txtSueldo'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

		$this->db->insert('empleado',$campos);
		$id = $this->db->insert_id();

		if ($id > 0 ) {
			//guardamos usuario
			$campos = array(
				'idPerfil' => $param['cboPerfil'],
				'idCaja' => $param['cboCaja'],
				'idPersona' => $param['hdnIdPersona'],
				'idSucursal' => $param['cboSucursal'],
				'nomUsuario' => $param['txtNomUsuario'],
				'clave' => $param['txtClave'],
				'usuCrea' => $this->session->userdata('s_idUsuario'),
				'sitReg' => '1'
			);

			$this->db->insert('usuario',$campos);
			$id = $this->db->insert_id();
			if ($id > 0 ) {
				return $id;	
			}else{
				return 0;
			}

		}else{
			return 0;
		}
		
	}

	public function changePassword($idUsuario,$clave){
		$campos = array(
			'clave' => $clave
		);
		
		$this->db->trans_start();
		$this->db->where('idUsuario', $idUsuario);
		$this->db->update('usuario', $campos);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){return 0;}
		else{return 1;}
	}

	public function resetClave($idUsuario,$txtNewClave){
		$campos = array(
	        'clave' => sha1($txtNewClave)
		);

		$this->db->where('idUsuario', $idUsuario);
		$this->db->update('usuario', $campos);

		return $this->db->affected_rows();
	}

	public function delUsuario($idPersona){
		$campoE = array(
			'sitReg' => 0,
			);

		$this->db->where('idPersona',$idPersona);
		$this->db->update('empleado',$campoE);

		if ($this->db->affected_rows() > 0) {
			$campos = array(
				'sitReg' => 0,
				);

			$this->db->where('idPersona',$idPersona);
			$this->db->update('usuario',$campos);

			return $this->db->affected_rows();
		}else{
			return 0;
		}

	}
}