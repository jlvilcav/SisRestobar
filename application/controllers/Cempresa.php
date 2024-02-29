<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cempresa extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		// $data['listSucursal'] = $this->mcommon->fillfull('sucursal');

		$this->load->view('layout/header');
		$this->load->view('empresa/vempresa');
		$this->load->view('layout/footer');
	}

	private function error($error)
    {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(['error' => $error]);
        exit();
    }
}