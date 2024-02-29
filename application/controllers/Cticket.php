<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cticket extends CI_Controller
{    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mticket');
    }

    public function toprint($idSucursal,$barCocina){
    	echo json_encode($this->Mticket->getToPrint($idSucursal,$barCocina));
    }

    public function printAccount($idSucursal,$idCaja){
    	// echo json_encode($this->Mticket->printAccount($idSucursal));
        echo json_encode($this->Mticket->printAccount($idSucursal,$idCaja));
    }
}