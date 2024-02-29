<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cmozo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mproducto');
		// $this->load->model('Mcommon');
		$this->load->model('Msucursal');
		$this->load->model('Mventa');
	}

	//Llamada
	public function mozo(){
		//$this->load->view('layout/header');
		$idSucursal = $this->session->userdata('s_idSucursal');
		$data = array(
			'menu'       => $this->Mproducto->getProductsBySucursal($idSucursal),
			'categories' => $this->Mproducto->categProductoPorSucursal($idSucursal),//$this->Mcommon->fillfull('categoria_producto'),
			//'mesas'      => range(1,$this->Msucursal->getMesasBySucursal($idSucursal)),
			'mesas'      => $this->Msucursal->getMesasBySucursal($idSucursal),
			'croquis'	 => $this->Msucursal->getCroquis($idSucursal),
			'mozo'       => (int) $this->session->userdata('s_idUsuario'),
			);
		$this->load->view('mozo/vmozo',$data);
		//$this->load->view('layout/footer');
	}

	public function pedidos(){
		$items = $this->Mventa->getPedidosByMozo($this->session->userdata('s_idUsuario'));
		echo json_encode($items);
	}
}