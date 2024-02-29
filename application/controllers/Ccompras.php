<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Ccompras extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// $this->load->model('mcommon');
		$this->load->model('Minsumo');
		$this->load->model('Mtiporecibo');
		$this->load->model('Mproveedor');
		$this->load->model('Mcompra');
	}

	//Lamada menu
	public function compraInsumo(){
		$idSucursal = $this->session->userdata('s_idSucursal');
		$insumos = $this->Minsumo->getInsumos($idSucursal);
		$ins = array();
		foreach ($insumos as $insu) { $ins[] = $insu->idInsumo; }
		$data = array(
			'listInsumos' 	  => $insumos, 
			'listInsumoNuevo' => $this->Minsumo->getInsumoNuevo($ins), 
			'recibos' 		  => $this->Mtiporecibo->getList(), 
			'proveedores' 	  => $this->Mproveedor->getList(), 
			);
		$this->load->view('layout/header');
		$this->load->view('compras/vcompraInsumos',$data);
		$this->load->view('layout/footer');
	}

	public function nro(){
		$idSucursal = $this->session->userdata('s_idSucursal');
		$idCompra = $this->Mcompra->countBySucursal($idSucursal) + 1;
		$nro = str_pad($idSucursal, 3, "0", STR_PAD_LEFT).'-'.str_pad($idCompra, 6, "0", STR_PAD_LEFT);
		echo json_encode(array('nro' => $nro));
	}

	public function gestorCompras(){
		$idS = $this->session->userdata('s_idSucursal');
		$result = $this->Mcompra->getComprasBySucursal($idS);
		$data['listCompras'] = $result;
		$this->load->view('layout/header');
		$this->load->view('compras/vgestorcompras',$data);
		$this->load->view('layout/footer');
	}

	public function detalleCompra(){
		$this->load->view('layout/header');
		$this->load->view('compras/VDetalleCompra');
		$this->load->view('layout/footer');
	}

	public function carritoCompra(){
		$data = $this->input->post();

		if (((int) $data['idInsumo']) <= 0)
			$this->error('Debe seleccionar un insumo');

		if (((float) $data['prunit']) <= 0)
			$this->error('Debe ingresar un precio unitario');

		if (((float) $data['cntd']) <= 0)
			$this->error('Debe ingresar una cantidad');

		$cart = $this->session->userdata('carritoCompra');
		
		if (!$cart)
			$cart = array();
		
		$item = array(
			'id' => $data['idInsumo'],
			'nombre' => $data['descripcionInsumo'],
			'unidad' => $data['unidad'],
			'cantidad' => $data['cntd'],
			'prunit' => $data['prunit'],
			'importe' => number_format((float)  $data['prunit'] * (float) $data['cntd'],2),
			'stockMinXMed' => $data['stockMinXMed'],
			'cantMedXUnid' => $data['cantMedXUnid']
			);

		$index = sizeof($cart);

		for ($i=0; $i < sizeof($cart); $i++) {
			if ($cart[$i]['id'] == $item['id']) {
				$index = $i;
				break;
			}
		}

		$cart[$index] = $item;

		$this->session->set_userdata('carritoCompra',$cart);

		echo json_encode($item);
	}

	public function recuperarCarrito(){// esto si se hace un refresh a la pagina y recuperarmos y devolvermos lo que ya habia en el carrito
		$cart = $this->session->userdata('carritoCompra');
		if (empty($cart))
			$cart = [];
		echo json_encode($cart);
	}

	public function eliminaItemCarritoCompra(){
		$idIns = $this->input->post('idIns');
		$cart = $this->session->userdata('carritoCompra');
		if (!$cart)
			$cart = array();

		$found = false;
		for($i = 0; $i < sizeof($cart); $i++) {
	       	if ($cart[$i]['id'] == $idIns) {
	       		array_splice($cart, $i, 1);
	       		$found = true;
	       		break;
	       	}
	    }

		$this->session->set_userdata('carritoCompra',$cart);

		echo json_encode(array('removed' => $found, 'id' => $idIns));
	}

	public function limpiarCarritoCompra(){
		$this->session->unset_userdata('carritoCompra');
		echo "[]";
	}

	public function save(){
		$cart = $this->session->userdata('carritoCompra');

		if (!$cart) 
			$cart = [];
		
		if (sizeof($cart) == 0)
			$this->error('El carro se encuentra vacío');

		$data = $this->input->post();
		if (empty($data['proveedorId']))
			$this->error('Debe seleccionar un proveedor');

		if (empty($data['tipoReciboId']))
			$this->error('Debe seleccionar un tipo de recibo');

		if (empty($data['nroRecibo']))
			$this->error('Debe ingresar el nro de recibo');

		$total = 0;
		foreach ($cart as $item) {
			$total += str_replace(",","",$item['importe']);
		}

		$idSucursal = $this->session->userdata('s_idSucursal');
		$idCompra = $this->Mcompra->countBySucursal($idSucursal) + 1;
		$parms = array(
			'idSucursal'   => $idSucursal,
			'numCompra'    => $idCompra,
			'numCompraGenerado' => str_pad($idSucursal, 3, "0", STR_PAD_LEFT) . '-' . str_pad($idCompra, 6, "0", STR_PAD_LEFT),
			'idProveedor'  => $data['proveedorId'],
			'idTipoRecibo' => $data['tipoReciboId'],
			'monto'        => $total - ($total * 0.18),
			'igv'          => $total * 0.18,
			'total'        => $total,
			);

		$id = $this->Mcompra->regCompra($parms);

		if ($id === 0)
			$this->error('No se pudo guardar la compra');

		foreach ($cart as $item) {
			$item['idCompra'] = $id;
			$item['idSucursal'] = $idSucursal;
			//var_dump($item);
			$this->Mcompra->addDetalle($item);

			$idIS = $this->Minsumo->getInsumoBySucursal($item['id'],$idSucursal);

			/*
			*/
			if ($idIS === false) {
				$ins = array(
					'idInsumo' => $item['id'],
					'idSucursal' => $item['idSucursal'],
					'stockUnid' => $item['cantidad'],
					'stockXMedida' => $item['cantidad'] * $item['cantMedXUnid'],
					'stockMinXMed' => $item['stockMinXMed'],
					'precioSucursal' => $item['prunit'],
					);
				$this->Minsumo->addInsumoBySucursal($ins);
			}else{
				$ins = array(
					'idInsumoSucursal' => $idIS,
					'stockUnid' => $item['cantidad'],
					'stockXMedida' => $item['cantidad'] * $item['cantMedXUnid'],
					//'stockMinXMed' => $item['stockMinXMed'],
					'precioSucursal' => $item['prunit'],
					);
				$this->Minsumo->updateInsumoBySucursal($ins);
			}
		}

		$this->session->unset_userdata('carritoCompra');

		echo json_encode(array('result' => 'Compra registrada con número: ' . $parms['numCompraGenerado']));
	}

	private function error($error)
	{
		header('HTTP/1.0 403 Forbidden');
		echo json_encode(['error' => $error]);
		exit();
	}

	public function getDetalleCompra($id,$razonSocial,$fecCompra,$numCompra,$total){//,$nom,$cat,$pv){
		$result = $this->Mcompra->getDetalleCompra($id);
		$data['listDetalleCompra'] = $result;
		$data['razonSocial'] = $razonSocial;
		$data['fecCompra'] = $fecCompra;
		$data['numCompra'] = $numCompra;
		$data['total'] = $total;
		$this->load->view('layout/header');
		$this->load->view('compras/vdetallecompra',$data);
		$this->load->view('layout/footer');
	}
	
}