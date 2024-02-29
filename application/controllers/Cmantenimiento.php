<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cmantenimiento extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mmantenimiento');
	}

	public function index(){
		$data['dolar'] = $this->Mmantenimiento->getCambioMoneda();
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vcambiomoneda',$data);
		$this->load->view('layout/footer');
	}

	public function unidad(){
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vunidad');
		$this->load->view('layout/footer');
	}

	public function medida(){
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vmedida');
		$this->load->view('layout/footer');
	}

	public function updCambioMoneda(){
		$this->Mmantenimiento->updCambioMoneda($this->input->post('txtCambioMoneda'));
		redirect('Cmantenimiento');
	}

	public function regUnidad(){
		$u = $this->input->post('txtUnidad');
		echo $this->Mmantenimiento->regUnidad($u);
	}

	public function updUnidad(){
		$u = $this->input->post('mtxtUnidad');
		$idU = $this->input->post('mhdnIdUnidad');
		echo $this->Mmantenimiento->updUnidad($idU,$u);
	}

	public function regMedida(){
		$m = $this->input->post('txtMedida');
		echo $this->Mmantenimiento->regMedida($m);
	}

	public function updMedida(){
		$m = $this->input->post('mtxtMedida');
		$idM = $this->input->post('mhdnIdMedida');
		echo $this->Mmantenimiento->updMedida($idM,$m);
	}

	public function claveautorizacion(){
		$data['claveAutorizacion'] = $this->Mmantenimiento->getClaveAutorizacion();
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vclaveautorizacion',$data);
		$this->load->view('layout/footer');
	}
	public function updClaveAutorizacion(){
		$this->Mmantenimiento->updClaveAutorizacion($this->input->post('txtClaveAutorizacion'));
		redirect('Cmantenimiento/claveautorizacion');
	}

	public function simbolomoneda(){
		$data['simboloMoneda'] = $this->Mmantenimiento->getSimboloMoneda();
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vsimbolomoneda',$data);
		$this->load->view('layout/footer');
	}
	public function updSimboloMoneda(){
		$this->Mmantenimiento->updSimboloMoneda($this->input->post('txtSimboloMoneda'));
		redirect('Cmantenimiento/simbolomoneda');
	}

	public function porcentajepropina(){
		$data['porcentajePropina'] = $this->Mmantenimiento->getPorcentajePropina();
		$this->load->view('layout/header');
		$this->load->view('mantenimiento/vporcentajepropina',$data);
		$this->load->view('layout/footer');
	}
	public function updPorcentajePropina(){
		$this->Mmantenimiento->updPorcentajePropina($this->input->post('txtPorcentajePropina'));
		redirect('Cmantenimiento/porcentajepropina');
	}
}