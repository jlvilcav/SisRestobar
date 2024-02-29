<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Ccajero extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		/*
		$this->load->model('mcommon');
		*/
		$this->load->model('Mproducto');
		$this->load->model('Msucursal');
		$this->load->model('Mventa');
		$this->load->model('Mtiporecibo');
	}

	//Llamada
	public function index(){
		//$this->load->view('layout/header');
		$idSucursal = $this->session->userdata('s_idSucursal');

		$data = array(
			'idSucursal' => $idSucursal,
			'recibos'    => $this->Mtiporecibo->getList(), //recibos
			'mesas'      => $this->Msucursal->getMesasBySucursal($idSucursal),
			'croquis'	 => $this->Msucursal->getCroquis($idSucursal),
			'menu'       => $this->Mproducto->getProductsBySucursal($idSucursal),
			'categories' => $this->Mproducto->categProductoPorSucursal($idSucursal),
			);
		$this->load->view('cajero/vcajero',$data);
		//$this->load->view('layout/footer');
	}

	public function pedidos() {
		$idSucursal = $this->session->userdata('s_idSucursal');
		$items = $this->Mventa->getPedidosBySucursal($idSucursal);
		$response = array();
		foreach ($items as $item) {
			$response[$item->idMesa] = ['pedido' => $item->id, 'mozo' => (int) $item->usuCrea, 'fecHora' => $item->fecHora];
		}
		echo json_encode($response);
	}

	public function deliverys() {
		$idSucursal = $this->session->userdata('s_idSucursal');
		$items = $this->Mventa->getDeliverysBySucursal($idSucursal);
		
		/*
		$response = array();
		foreach ($items as $item) {
			$response[$item->idMesa] = ['pedido' => $item->id, 'mozo' => (int) $item->usuCrea];
		}
		*/
		echo json_encode($items);
	}
}