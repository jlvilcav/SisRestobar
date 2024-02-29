<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clogin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mhome');
		$this->load->model('Mlogin');
	}

	public function index(){
		if ($this->session->userdata('s_idCaja') > 0){
			//verifica si la caja esta abierta
			$this->load->model('maperturacierre');
			$ec = $this->maperturacierre->verifEstadoCaja($this->session->userdata('s_idCaja'));
			if ($ec == 'C') {
				$this->session->set_flashdata('mensaje','CAJA CERRADA');
				$this->load->view('login');
			}elseif ($ec == 'A') {
				redirect('ccajero/index');
			}
			
		}elseif ($this->session->userdata('s_idPerfil') == 4) {
			redirect('cmozo/mozo');
		}elseif($this->session->userdata('s_idPerfil') == 2) {
			$data['cntdCompras'] = $this->Mhome->getCantCompras();
			$data['cntdVentas'] = $this->Mhome->getCantVentas();
			$data['cntdProductos'] = $this->Mhome->getCantProductos();
			$this->load->view('layout/header');
			$this->load->view('home',$data);
			$this->load->view('layout/footer');
		}else{
			$this->load->view('login');
		}
		
	}

	public function home(){
		$this->load->view('layout/header');
		$this->load->view('home');
		$this->load->view('layout/footer');
	}

	public function admin(){
		$this->load->view('layout/header');
		$this->load->view('admin');
		$this->load->view('layout/footer');
	}

	public function login(){

		$usuario = $this->input->post('txtNomUsuario');
		$clave = $this->input->post('txtClave');

		$this->Mlogin->login($usuario, sha1($clave));
		
		if ($this->session->userdata('s_idCaja') > 0){
			//verifica si la caja esta abierta
			$this->load->model('maperturacierre');
			$ec = $this->maperturacierre->verifEstadoCaja($this->session->userdata('s_idCaja'));
			if ($ec == 'C') {
				$this->session->set_flashdata('mensaje','CAJA CERRADA');
				//$this->session->sess_destroy();
				redirect('clogin');
			}elseif ($ec == 'A') {
				redirect('ccajero/index');
			}
			
		}elseif ($this->session->userdata('s_idPerfil') == 2) { //administrador
			$data['cntdCompras'] = $this->Mhome->getCantCompras();
			$data['cntdVentas'] = $this->Mhome->getCantVentas();
			$data['cntdProductos'] = $this->Mhome->getCantProductos();
			$data['totalEfectivo'] = $this->Mhome->getTotalEfectivo();
			$data['totalVisa'] = $this->Mhome->getTotalVisa();
			$data['totalMastercard'] = $this->Mhome->getTotalMastercard();
			$this->load->view('layout/header');
			$this->load->view('home',$data);
			$this->load->view('layout/footer');
		}elseif ($this->session->userdata('s_idPerfil') == 4) { //mozo
			redirect('cmozo/mozo');
		}else{
			$this->load->view('login');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function loginCajaImprime($usu,$clave){
		echo json_encode($this->Mlogin->loginCajaImprime($usu, $this->encrypt->sha1($clave)));
	}
}