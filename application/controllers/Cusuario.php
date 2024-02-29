<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cusuario extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Musuario');
		$this->load->model('Mcommon');
		$this->load->model('Msucursal');
		$this->load->model('Mlogin');
	}

	//llamada menu
	public function usuario(){
		$data['regUsuarioState'] = null;
		$data['listSucursal'] = $this->Mcommon->fillfull('sucursal');
		$data['listPerfiles'] = $this->Mcommon->fillfull('perfil');
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/vusuario',$data);
		$this->load->view('layout/footer');
	}

	public function perfiles(){
		$data['getPerfiles'] = $this->Mcommon->fillfull('perfil');

		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/vperfiles',$data);
		$this->load->view('layout/footer');
	}

	public function permisos(){
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/VPermisos');
		$this->load->view('layout/footer');
	}

	//otras funciones
	public function regPerfil(){
		$per = $this->input->post('txtPerfil');

		$id = $this->Musuario->regPerfil($per);

		//$data['getPerfiles'] = null;
		if ($id != 0) {
			$data['regPerfilState'] = '1';
			redirect('cusuario/perfiles');
		}else{
			$data['regPerfilState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vperfiles",$data);
			$this->load->view('layout/footer');
		}
	}

	public function getCajaSucursal(){
		$suc = $this->input->post('cboSucursal');
		$cs = $this->Msucursal->getCajaSucursal($suc);

		if ($cs) {
			foreach($cs as $fila)
			{
				echo "<option value='".$fila->idCaja."'>".$fila->descripcion."</option>";
			}
		}		
	}

	public function getCajaByUsuario(){
		$suc = $this->input->post('cboSucursal');
		$idC = $this->input->post('idC');
		$cs = $this->Msucursal->getCajaSucursal($suc);

		if ($cs) {
			foreach($cs as $fila)
			{
				if ($fila->idCaja == $idC) {
					echo "<option value='".$fila->idCaja."' selected>".$fila->descripcion."</option>";
				}else{
					echo "<option value='".$fila->idCaja."'>".$fila->descripcion."</option>";
				}
			}
		}		
	}

	public function verifUsuario(){
		$usu = $this->input->post('txtNomUsuario');
		$reg = $this->Mcommon->existe('usuario','nomUsuario',$usu);
		
		if ($reg != "0") {
			echo $reg->nomUsuario;
		}else{
			echo "0";
		}
	}

	public function regUsuario(){
		$idPer = $this->session->userdata('didPersona');
		if (empty($idPer)) {
			$idPer = $this->input->post('hdnIdPersona');
		}

		$nomUsu = $this->session->userdata('dtxtDNI');
		if (empty($nomUsu)) {
			$nomUsu = $this->input->post('txtDNI');
		}

		$param['hdnIdPersona'] = $idPer;
		$param['txtNomUsuario'] = $nomUsu;
		$param['txtClave'] = sha1($this->input->post('txtClave'));
		$param['datFecIngreso'] = $this->input->post('datFecIngreso');
		$param['cboSucursal'] = $this->input->post('cboSucursal');
		$param['cboPerfil'] = $this->input->post('cboPerfil');
		$param['cboCaja'] = $this->input->post('cboCaja');
		$param['txtSueldo'] = $this->input->post('txtSueldo');

		$idUsu = $this->Musuario->regUsuario($param);

		if ($idUsu != 0) {
			$this->session->unset_userdata('dtxtDNI');
            $this->session->unset_userdata('dNombres');
            $this->session->unset_userdata('didPersona');

			$data['regUsuarioState'] = '1';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vusuario",$data);
			$this->load->view('layout/footer');
		}else{
			$data['regUsuarioState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("empleadoUsuario/vusuario",$data);
			$this->load->view('layout/footer');
		}
	}

	public function cancelarRegUsuario(){
		$this->session->unset_userdata('dtxtDNI');
        $this->session->unset_userdata('dNombres');
        $this->session->unset_userdata('didPersona');

		$data['regUsuarioState'] = null;
		$this->load->view('layout/header');
		$this->load->view("empleadoUsuario/vusuario",$data);
		$this->load->view('layout/footer');
	}

	public function profileOfUser(){
		$ip = $this->session->userdata('s_idPerfil');
		//$noMenu = array(3,4);
		//if (in_array($ip, $noMenu)) {
		if ($ip == 3) {
			$this->load->view('empleadoUsuario/vperfilusuariocajero');
		}elseif ($ip == 4) {
			$this->load->view('empleadoUsuario/vperfilusuariomozo');
		}else{
			$this->load->view('layout/header');
			$this->load->view('empleadoUsuario/vperfilusuarioadmin');
			$this->load->view('layout/footer');
		}
	}

	public function verifUsuClave(){
		$nomUsuario = $this->session->userdata('s_nomUsuario');
		$clave = $this->input->post('clave');

		$result = $this->Mlogin->compruebaLogin($nomUsuario, sha1($clave));
		echo $result;
	}

	public function changePassword(){
		$idUsuario = $this->session->userdata('s_idUsuario');
		$clave = $this->input->post('nclave');
		$result = $this->Musuario->changePassword($idUsuario, sha1($clave));
		if ($result == 1) {
			echo "Contraseña actualizada";
		}else{
			echo "Ocurrio un error";
		}
	}

	public function resetClave(){
		$idUsuario = $this->input->post('idUsuario');
		$txtNewClave = $this->input->post('txtNewClave');
		echo $this->Musuario->resetClave($idUsuario,$txtNewClave);
	}

	public function delUsuario($idPersona){
		//deshabilitar empleado y usuario
		$this->Musuario->delUsuario($idPersona);
		redirect('cpersona/gestorEmpleado');
	}
}
