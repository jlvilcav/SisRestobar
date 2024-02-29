<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Ccocina extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcocina');
	}

	public function index(){
		$this->load->view('cocina/index');
	}

	public function cocina($opc){
		$data['opc'] = $opc;
		$this->load->view('cocina/listapedidos', $data);
	}

	public function cocinafinalizado($opc){
		$data['opc'] = $opc;
		$this->load->view('cocina/listapedidosfinalizados', $data);
	}

	public function getProductosPorCocina(){
		$opc = $this->input->post("opc");
		$r = $this->Mcocina->getProductosPorCocina($opc);
		echo json_encode($r);
	}

	public function getProductosPorCocinaFinalizado(){
		$opc = $this->input->post("opc");
		$r = $this->Mcocina->getProductosPorCocinaFinalizado($opc);
		echo json_encode($r);
	}

	public function setEnProceso(){
		$idImprimeTickets = $this->input->post("idImprimeTickets");
		$r = $this->Mcocina->setEnProceso($idImprimeTickets);
		echo $r;
	}

	public function setFinalizado(){
		$idImprimeTickets = $this->input->post("idImprimeTickets");
		$r = $this->Mcocina->setFinalizado($idImprimeTickets);
		echo $r;
	}

}