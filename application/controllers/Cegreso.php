<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cegreso extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	//Llamada menu
	public function egresos(){
		$this->load->view('layout/header');
		$this->load->view('egresos/VEgresos');
		$this->load->view('layout/footer');
	}

}