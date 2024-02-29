<?php
/**
* 
*/
class Mpersona extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function regPersona($param){
		$campos = array(
			'dni' => $param['txtDNI'],
			'nombre' => $param['txtNombres'],
			'apPaterno' => $param['txtApPaterno'],
			'apMaterno' => $param['txtApMaterno'],
			'fecNac' => date('Y-m-d',strtotime(str_replace('/','-',$param['datFecNac']))),
			'codUbigeo' => $param['txtCodUbigeo'],
			'direccion' => $param['txtDireccion'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

		$this->db->insert('persona',$campos);
		$id = $this->db->insert_id();
		
		if ($id > 0) {			
			return $id;
		}else{
			return 0;
		}
	}

	public function buscar($data){
		$this->db->select('p.idPersona, dni, nombre, apPaterno, apMaterno, direccion, telefono, celular');
		$this->db->from('persona p');
		if (isset($data['dni']) && !empty($data['dni']))
			$this->db->like('dni',$data['dni']);

		if (isset($data['nombre']) && !empty($data['nombre']))
			$this->db->like('nombre',$data['nombre']);

		if (isset($data['apPaterno']) && !empty($data['apPaterno']))
			$this->db->like('apPaterno',$data['apPaterno']);

		if (isset($data['apMaterno']) && !empty($data['apMaterno']))
			$this->db->like('apMaterno',$data['apMaterno']);

		$q = $this->db->get();
		return $q->result();
	}

	public function saveCliente($data){
		$campos = array(
			'dni' => $data['ndni'],
			'nombre' => $data['nnombre'],
			'apPaterno' => $data['napPaterno'],
			'apMaterno' => $data['napMaterno'],
			'direccion' => $data['ndireccion'],
			'telefono' => $data['ntelefono'],
			'celular' => $data['ncelular'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

		$this->db->insert('persona',$campos);
		$id = $this->db->insert_id();
		
		return $id;
	}

	public function gestorEmpleado(){
		$this->db->select('em.idEmpleado,pf.idPerfil,pe.idPersona,pe.dni,pe.nombre,pe.apPaterno,pe.apMaterno,pf.descripcion,em.sueldo,DATE(em.fecCrea) fecIngreso,em.idSucursal,u.idCaja,u.idUsuario,em.sitReg,su.nombre nomSucursal',false);
		$this->db->from('empleado em');
		$this->db->join('sucursal su','su.idSucursal = em.idSucursal');
		$this->db->join('persona pe','pe.idPersona = em.idPersona');
		$this->db->join('usuario u','u.idPersona = pe.idPersona');
		$this->db->join('perfil pf','pf.idPerfil = u.idPerfil');
		$this->db->where('em.sitReg',1);
		//$this->db->where('em.idSucursal',$this->session->userdata('s_idSucursal'));

		$result = $this->db->get();
		return $result->result();
	}

	public function exportEmpleado(){
		$this->db->select('pe.idPersona,pe.dni,pe.nombre,pe.apPaterno,pe.apMaterno,pf.descripcion perfil,em.sueldo,DATE(em.fecCrea) fecIngreso,su.nombre nomSucursal',false);
		$this->db->from('empleado em');
		$this->db->join('sucursal su','su.idSucursal = em.idSucursal');
		$this->db->join('persona pe','pe.idPersona = em.idPersona');
		$this->db->join('usuario u','u.idPersona = pe.idPersona');
		$this->db->join('perfil pf','pf.idPerfil = u.idPerfil');
		//$this->db->where('em.idSucursal',$this->session->userdata('s_idSucursal'));

		$query = $this->db->get();
					
		return $query;
	
	}

	public function updatePersona($param){
		$campos = array(
			'nombre' => $param['txtNombres'],
			'apPaterno' => $param['txtApPaterno'],
			'apMaterno' => $param['txtApMaterno'],
			'dni' => $param['txtDNI']
			);

		$this->db->where('idPersona',$param['idPersona']);
		$this->db->update('persona',$campos);

		$campoE = array(
			'sueldo' => $param['txtSueldo'],
			'sitReg' => $param['chkEstado']
			);

		$this->db->where('idPersona',$param['idPersona']);
		$this->db->update('empleado',$campoE);

		$campoU = array(
			'sitReg' => $param['chkEstado'],
			'idPerfil' => $param['cboPerfil'],
			'idCaja' => $param['cboCaja'],
			'nomUsuario' => $param['txtDNI']
			);

		$this->db->where('idPersona',$param['idPersona']);
		$this->db->update('usuario',$campoU);
	}
}