<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cproveedor extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mproveedor');
		$this->load->model('Mcommon');
	}

	//Llamada menu
	public function proveedor(){
		$data['regProveedorState'] = null;
		$this->load->view('layout/header');
		$this->load->view('compras/vproveedor',$data);
		$this->load->view('layout/footer');
	}

	public function verifDNI(){
		$dni = $this->input->post('txtDNI');
		$reg = $this->Mcommon->existe('proveedor','dni',$dni);
		
		if ($reg != "0") {
			echo json_encode($reg);
		}else{
			echo "0";
		}
	}

	public function verifRUC(){
		$ruc = $this->input->post('txtRUC');
		$reg = $this->Mcommon->existe('proveedor','ruc',$ruc);
		
		if ($reg != "0") {
			echo json_encode($reg);
		}else{
			echo "0";
		}
	}

	public function regProveedor(){
		$param['txtDNI'] = $this->input->post('txtDNI');
		$param['txtRUC'] = $this->input->post('txtRUC');
		$param['txtRazonSocial'] = $this->input->post('txtRazonSocial');
		$param['txtDireccion'] = $this->input->post('txtDireccion');
		$param['txtTelefono'] = $this->input->post('txtTelefono');
		$param['txtCelular'] = $this->input->post('txtCelular');
		$param['txtEmail'] = $this->input->post('txtEmail');
		$param['txtCta01'] = $this->input->post('txtCta01');
		$param['txtCta02'] = $this->input->post('txtCta02');
		$param['txtObservacion'] = $this->input->post('txtObservacion');

		$id = $this->Mproveedor->regProveedor($param);
		//$this->session->set_userdata('user_data',$id);
		if ($id != 0) {
			$data['regProveedorState'] = '1';
			$this->load->view('layout/header');
			$this->load->view("compras/vproveedor",$data);
			$this->load->view('layout/footer');
		}else{
			$data['regProveedorState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("compras/vproveedor",$data);
			$this->load->view('layout/footer');
		}
	}
}