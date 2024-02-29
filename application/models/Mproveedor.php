<?php
/**
* 
*/
class Mproveedor extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function regProveedor($param){
		$campos = array(
			'dni' => $param['txtDNI'],
			'ruc' => $param['txtRUC'],
			'razonSocial' => $param['txtRazonSocial'],
			'direccion' => $param['txtDireccion'],
			'telefono' => $param['txtTelefono'],
			'celular' => $param['txtCelular'],
			'email' => $param['txtEmail'],
			'cta01' => $param['txtCta01'],
			'cta02' => $param['txtCta02'],
			'observacion' => $param['txtObservacion'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);

		$this->db->insert('proveedor',$campos);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;	
		}else{
			return 0;
		}
	}

	public function getList(){
		$this->db->select('idProveedor,razonSocial');
		$this->db->from('proveedor');
		$q = $this->db->get();
		return $q->result();
	}


}