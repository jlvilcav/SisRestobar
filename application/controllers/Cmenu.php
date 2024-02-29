<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cmenu extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	//SUCURSAL
	public function sucursal(){
		$this->load->view('layout/header');
		$this->load->view('sucursal/VSucursal');
		$this->load->view('layout/footer');
	}

	public function cajas(){
		$this->load->view('layout/header');
		$this->load->view('sucursal/VCajas');
		$this->load->view('layout/footer');
	}

	public function mesas(){
		$this->load->view('layout/header');
		$this->load->view('sucursal/VMesas');
		$this->load->view('layout/footer');
	}

	//EMPLEADO/USUARIO
	public function persona(){
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/VPersona');
		$this->load->view('layout/footer');
	}

	public function usuario(){
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/VUsuario');
		$this->load->view('layout/footer');
	}

	public function perfiles(){
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/VPerfiles');
		$this->load->view('layout/footer');
	}

	public function permisos(){
		$this->load->view('layout/header');
		$this->load->view('empleadoUsuario/VPermisos');
		$this->load->view('layout/footer');
	}

	//ALMACEN
	public function insumo(){
		$this->load->view('layout/header');
		$this->load->view('almacen/VInsumo');
		$this->load->view('layout/footer');
	}

	public function categInsumo(){
		$this->load->view('layout/header');
		$this->load->view('almacen/VCategInsumo');
		$this->load->view('layout/footer');
	}

	//COMPRAS
	public function proveedor(){
		$this->load->view('layout/header');
		$this->load->view('compras/VProveedor');
		$this->load->view('layout/footer');
	}

	public function compraInsumo(){
		$this->load->view('layout/header');
		$this->load->view('compras/VCompraInsumo');
		$this->load->view('layout/footer');
	}

	public function gestorCompras(){
		$this->load->view('layout/header');
		$this->load->view('compras/VGestorCompras');
		$this->load->view('layout/footer');
	}

	public function detalleCompra(){
		$this->load->view('layout/header');
		$this->load->view('compras/VDetalleCompra');
		$this->load->view('layout/footer');
	}

	//PRODUCTO
	public function producto(){
		$this->load->view('layout/header');
		$this->load->view('producto/VProducto');
		$this->load->view('layout/footer');
	}

	public function categProducto(){
		$this->load->view('layout/header');
		$this->load->view('producto/VCategProducto');
		$this->load->view('layout/footer');
	}

	public function gestorProducto(){
		$this->load->view('layout/header');
		$this->load->view('producto/VGestorProductos');
		$this->load->view('layout/footer');
	}

	public function detalleProducto(){
		$this->load->view('layout/header');
		$this->load->view('producto/VDetalleProducto');
		$this->load->view('layout/footer');
	}

	//CAJA A/C
	public function aperturaCierre(){
		$this->load->view('layout/header');
		$this->load->view('cajaAC/VAperturaCierre');
		$this->load->view('layout/footer');
	}

	//EGRESO
	public function egresos(){
		$this->load->view('layout/header');
		$this->load->view('egresos/VEgresos');
		$this->load->view('layout/footer');
	}







	//MOZO
	public function mozo(){
		//$this->load->view('layout/header');
		$this->load->view('mozo/VMozo');
		//$this->load->view('layout/footer');
	}
}