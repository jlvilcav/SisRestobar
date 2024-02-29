<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cinsumo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcommon');
		$this->load->model('Minsumo');
	}

	public function index(){
		// $data['listInsumos'] = $this->Minsumo->getInsumoNuevo();

		$this->load->view('layout/header');
		$this->load->view('almacen/vgestorinsumos');//,$data);
		$this->load->view('layout/footer');
	}

	public function getAllInsumos(){
		echo json_encode($this->Minsumo->getInsumoNuevo());
	}

	//llamada menu
	public function insumo(){
		$data['regInsumoState'] = null;
		$data['listCategInsumo'] = $this->Mcommon->fillfull('categoria_insumo');
		$data['listUnidad'] = $this->Mcommon->fillfull('unidad');
		$data['listMedida'] = $this->Mcommon->fillfull('medida');
		$this->load->view('layout/header');
		$this->load->view('almacen/vinsumo', $data);
		$this->load->view('layout/footer');
	}

	public function categInsumo(){
		$data['getCategInsumo'] = $this->Mcommon->fillfull('categoria_insumo');

		$this->load->view('layout/header');
		$this->load->view('almacen/vcategInsumo',$data);
		$this->load->view('layout/footer');
	}

	public function regCategInsumo(){
		$ci = $this->input->post('txtCatInsumo');

		$id = $this->Minsumo->regCategInsumo($ci);

		//$data['getPerfiles'] = null;
		if ($id != 0) {
			$data['regCategInsumoState'] = '1';
			redirect('cinsumo/categInsumo');
		}else{
			$data['regCategInsumoState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vperfiles",$data);
			$this->load->view('layout/footer');
		}
	}

	public function verifInsumo(){
		$ins = $this->input->post('txtInsumo');
		$reg = $this->Mcommon->existe('insumo','descripcion',$ins);
		
		if ($reg != "0") {
			echo $reg->descripcion;
		}else{
			echo "0";
		}
	}

	public function regInsumo(){
		$param['txtInsumo'] = $this->input->post('txtInsumo');
		$param['cboUnidad'] = $this->input->post('cboUnidad');
		$param['cboCategInsumo'] = $this->input->post('cboCategInsumo');
		$param['cboMedida'] = $this->input->post('cboMedida');
		$param['txtCantXMedida'] = $this->input->post('txtCantXMedida');
		$param['txtStockMin'] = $this->input->post('txtStockMin');
		$param['txtPrecSugerido'] = $this->input->post('txtPrecSugerido');	

		$id = $this->Minsumo->regInsumo($param);

		//$data['getPerfiles'] = null;
		if ($id != 0) {
			$data['regInsumoState'] = '1';
			redirect('cinsumo');
		}else{
			$data['regInsumoState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vinsumo",$data);
			$this->load->view('layout/footer');
		}
	}

	public function updCatIns(){
		if($this->input->is_ajax_request()){
			$param['mhdnIdCatIns'] = $this->input->post('mhdnIdCatIns');
			$param['mtxtNomCatIns'] = $this->input->post('mtxtNomCatIns');
			echo $this->Minsumo->updCatIns($param);
		}else{
			echo "No valido ajax";
		}
	}

	public function updInsumo(){
		$param['mhdnIdInsumo'] = $this->input->post('mhdnIdInsumo');
		$param['mtxtInsumo'] = $this->input->post('mtxtInsumo');
		$param['mcboUnidad'] = $this->input->post('mcboUnidad');
		$param['mcboCategInsumo'] = $this->input->post('mcboCategInsumo');
		$param['mcboMedida'] = $this->input->post('mcboMedida');
		$param['mtxtCantXMedida'] = $this->input->post('mtxtCantXMedida');
		$param['mtxtStockMin'] = $this->input->post('mtxtStockMin');
		$param['mtxtPrecSugerido'] = $this->input->post('mtxtPrecSugerido');	

		$id = $this->Minsumo->updInsumo($param);

		echo $id;
		//$data['getPerfiles'] = null;
		// if ($id != 0) {
		// 	$data['regInsumoState'] = '1';
		// 	redirect('cinsumo');
		// }else{
		// 	$data['regInsumoState'] = '0';
		// 	$this->load->view('layout/header');
		// 	$this->load->view("empleadoUsuario/vinsumo",$data);
		// 	$this->load->view('layout/footer');
		// }
	}
}