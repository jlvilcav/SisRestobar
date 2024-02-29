<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cpersona extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mubigeo');
		$this->load->model('Mcommon');
		$this->load->model('Mpersona');
		$this->load->library('export_excel');
	}

	public function persona(){
		$data['regPersonaState'] = null;
		$data['listDepartamentos'] = $this->Mubigeo->listDepartamentos();

		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/vpersona',$data);
		$this->load->view('layout/footer');
	}

	public function verifDNI(){
		$dni = $this->input->post('txtDNI');
		$reg = $this->Mcommon->existe('persona','dni',$dni);
		
		if ($reg != "0") {
			echo json_encode($reg);
		}else{
			echo "0";
		}
	}

	public function regPersona(){
		$fecNac = $this->input->post('datFecNac');

		$param['txtDNI'] = $this->input->post('txtDNI');
		$param['txtNombres'] = $this->input->post('txtNombres');
		$param['txtApPaterno'] = $this->input->post('txtApPaterno');
		$param['txtApMaterno'] = $this->input->post('txtApMaterno');
		$param['datFecNac'] = $fecNac;
		$param['txtCodUbigeo'] = $this->input->post('cboDepartamento').$this->input->post('cboProvincia').$this->input->post('cboDistrito');
		$param['txtDireccion'] = $this->input->post('txtDireccion');

		$id = $this->Mpersona->regPersona($param);
		//$this->session->set_userdata('user_data',$id);
		if ($id != 0) {
			$data['regPersonaState'] = '1';
			
			$datosPersona = array(
				'dtxtDNI' => $this->input->post('txtDNI'),
				'dNombres' => $this->input->post('txtNombres').', '.$this->input->post('txtApPaterno').' '.$this->input->post('txtApMaterno'),
				'didPersona' => $id
				
			);
			$this->session->set_userdata($datosPersona);
			redirect('cusuario/usuario');
		}else{
			$data['regPersonaState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vpersona",$data);
			$this->load->view('layout/footer');
		}
	}

	function buscar(){
		$data = $this->input->post('q');
        $data = json_decode($data, true);
        if (!$data)
            $this->error('No válido');

		echo json_encode($this->Mpersona->buscar($data));
	}

	function saveCliente(){
		$data = $this->input->post('q');
        $data = json_decode($data, true);
        if (!$data)
            $this->error('No válido');

		echo $this->Mpersona->saveCliente($data);
	}

	public function gestorEmpleado(){
		$data['listEmpleados'] = $this->Mpersona->gestorEmpleado();
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/vgestorempleados',$data);
		$this->load->view('layout/footer');
	}

	public function downloadPersonas(){
		
	    $result = $this->Mpersona->exportEmpleado();
	    $this->export_excel->to_excel($result, 'empleados-excel'); 
	}

	public function selPersona($sitReg,$idC,$idU,$idS,$idP,$idPf,$app,$apm,$nom,$sueldo,$dni){
		$data['sitReg'] = $sitReg;//sitReg
		$data['idU'] = $idU;//usuario
		$data['idC'] = $idC;//caja
		$data['idS'] = $idS;//sucursal
		$data['idP'] = $idP;//persona
		$data['idPf'] = $idPf;//perfil
		$data['app'] = $app;
		$data['apm'] = $apm;
		$data['nom'] = $nom;
		$data['sueldo'] = $sueldo;
		$data['dni'] = $dni;
		$data['listPerfiles'] = $this->Mcommon->fillfull('perfil');
		//$data[''] = $;
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/vupdatepersona',$data);
		$this->load->view('layout/footer');
	}

	public function updatePersona(){
		$param['txtNombres'] = $this->input->post('txtNombres');
		$param['txtApPaterno'] = $this->input->post('txtApPaterno');
		$param['txtApMaterno'] = $this->input->post('txtApMaterno');
		$param['cboPerfil'] = $this->input->post('cboPerfil');
		$param['cboCaja'] = $this->input->post('cboCaja');
		$param['txtDNI'] = $this->input->post('txtDNI');
		$param['txtSueldo'] = $this->input->post('txtSueldo');
		
		$estado = 0;
		if ($this->input->post('chkEstado') == "on") {
			$estado = 1;
		}else{
			$estado = 0;
		}
		$param['chkEstado'] = $estado;

		$param['idPersona'] = $this->input->post('hdnIdPersona');

		$this->Mpersona->updatePersona($param);

		redirect('cpersona/gestorEmpleado');
	}

}