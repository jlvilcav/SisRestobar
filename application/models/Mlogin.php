<?php 
/**
* 
*/
class Mlogin extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function login($nomUsuario,$clave){
		$this->db->select(" u.idUsuario, u.nomUsuario, u.idPerfil, IFNULL(u.idCaja,0) idCaja, cs.descripcion nomCaja,u.idSucursal, 
							CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS usu,
							pe.descripcion nomPerfil,
							s.nombre nomSucursal ",false);
		$this->db->from('usuario AS u');
		$this->db->join('persona p','p.idPersona = u.idPersona');
		$this->db->join('sucursal s','s.idSucursal = u.idSucursal');
		$this->db->join('perfil pe','pe.idPerfil = u.idPerfil');
		$this->db->join('caja_sucursal cs','cs.idCaja = u.idCaja', 'left');
		$this->db->where('u.nomUsuario',$nomUsuario);
		$this->db->where('u.clave',$clave);
		$this->db->where('u.sitReg',1);

		$consulta = $this->db->get();

		if ($consulta->num_rows() == 1) {
			$consulta = $consulta->row();
			
			$config = $this->db->get('rb_sist_config')->result();
			// echo '<pre>'; print_r($config[1]->valor); echo '</pre>';exit();

			$s_login = array(
				's_idUsuario' => $consulta->idUsuario,
				
				's_idPerfil' => $consulta->idPerfil,
				's_nomPerfil' => $consulta->nomPerfil,

				's_idSucursal' => $consulta->idSucursal,
				's_nomSucursal' => $consulta->nomSucursal,				

				's_idCaja' => $consulta->idCaja,
				's_nomCaja' => $consulta->nomCaja,
				's_usu' => $consulta->usu,
				's_nomUsuario' => $consulta->nomUsuario,
				'its_rb_s_simbolomoneda' => $config[0]->valor,//simbolo
				'its_rb_s_claveautorizacion' => $config[1]->valor,//clave
				'its_rb_s_propinaporcentaje' => $config[2]->valor,//% pop
			);
			$this->session->set_userdata($s_login);
			

		}else{
			$this->session->set_flashdata('mensaje','Usuario o contraseña incorrecta');
		}
		//$this->session->set_flashdata('mensaje','Usuario o contraseña incorrecta fuera');
	}

	public function compruebaLogin($nomUsuario,$clave){
		$this->db->select(" u.idUsuario, u.idPerfil, u.idSucursal, CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS usu ",false);
		$this->db->from('usuario AS u');
		$this->db->join('persona p','p.idPersona = u.idPersona');
		$this->db->where('u.nomUsuario',$nomUsuario);
		$this->db->where('u.clave',$clave);

		$consulta = $this->db->get();

		if ($consulta->num_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
		
	}

	public function loginCajaImprime($usu,$clave){
		$this->db->select(" u.idUsuario, u.nomUsuario, u.idPerfil, IFNULL(u.idCaja,0) idCaja,u.idSucursal, 
							CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS usu,
							pe.descripcion nomPerfil,
							s.nombre nomSucursal ",false);
		$this->db->from('usuario AS u');
		$this->db->join('persona p','p.idPersona = u.idPersona');
		$this->db->join('sucursal s','s.idSucursal = u.idSucursal');
		$this->db->join('perfil pe','pe.idPerfil = u.idPerfil');
		$this->db->where('u.nomUsuario',$usu);
		$this->db->where('u.clave',$clave);
		$this->db->where('u.sitReg',1);

		$consulta = $this->db->get();

		if ($consulta->num_rows() == 1) {
			return $consulta->result();
		}else{
			return $consulta->result();
		}
	}

}