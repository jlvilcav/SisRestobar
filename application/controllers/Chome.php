<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Chome extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mhome');
	}

	public function getCantCompras(){
		echo $this->Mhome->getCantCompras();
	}

	public function getCantVentas(){
		echo $this->Mhome->getCantVentas();
	}

	public function getCantProductos(){
		echo $this->Mhome->getCantProductos();
	}

	public function getTotalEfectivo(){
		$tot = $this->Mhome->getTotalEfectivo();
		echo $tot;
	}

	// public function getTotalVisa(){
	// 	$tot = $this->Mhome->getTotalVisa();
	// 	echo $tot;
	// }

	// public function getTotalMastercard(){
	// 	$tot = $this->Mhome->getTotalMastercard();
	// 	echo $tot;
	// }

	public function getInsStockMin(){
		$r = $this->Mhome->getInsStockMin();
		echo json_encode($r);
	}
}