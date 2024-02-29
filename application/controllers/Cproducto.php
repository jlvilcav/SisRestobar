<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cproducto extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// $this->load->model('Mcommon');
		$this->load->model('Mproducto');
		$this->load->model('Msucursal');
		$this->load->model('Minsumo');
		$this->load->library('upload');
		$this->load->library('export_excel');
		// $this->load->helper('nuevo_helper');
	}

	//Llamada menu
	public function producto(){
		$idSucursal = $this->session->userdata('s_idSucursal');
		$data = array(
			'getCategProducto' => $this->Mproducto->getCategProducto(),//$this->Mcommon->fillfull('categoria_producto'),
			'sucursales'       => $this->Msucursal->getList(),
			//'listInsumos' 	   => $this->Minsumo->getInsumos($idSucursal), 
			'listInsumos' 	   => $this->Minsumo->getInsumoNuevo(),
			// 'destinos' => array('B' => 'Bar', 'C' => 'Cocina 1', 'c2' => 'Cocina 2'),
			'destinos' => array('B' => 'Bar', 'C' => 'Cocina'),
			);
		$this->load->view('layout/header');
		$this->load->view('producto/vproducto',$data);
		$this->load->view('layout/footer');
	}

	public function categProducto(){
		$data['getCategProducto'] = $this->Mproducto->getCategProducto();//$this->Mcommon->fillfull('categoria_producto');

		$this->load->view('layout/header');
		$this->load->view('producto/vcategproducto',$data);
		$this->load->view('layout/footer');
	}

	public function gestorProducto(){
		$data['error'] = "";
		$data['sucursales'] = $this->Msucursal->getList();
		$data['hdnIdSucursal'] = 0;
		$this->load->view('layout/header');
		$this->load->view('producto/vgestorproductos',$data);
		$this->load->view('layout/footer');
	}

	public function detalleProducto(){
		$this->load->view('layout/header');
		$this->load->view('producto/vdetalleproducto');
		$this->load->view('layout/footer');
	}

	//otros
	public function regCategProducto(){
		$cp = $this->input->post('txtCatProducto');

		$id = $this->Mproducto->regCategProducto($cp);

		//$data['getPerfiles'] = null;
		if ($id != 0) {
			$data['regCategProductoState'] = '1';
			redirect('cproducto/categproducto');
		}else{
			$data['regCategProductoState'] = '0';
			$this->load->view('layout/header');
			$this->load->view("cproducto/categproducto",$data);
			$this->load->view('layout/footer');
		}
	}

	public function insumos(){
		$cart = $this->session->userdata('carritoInsumos');
		if (!$cart)
			$cart = array();		
		echo json_encode($cart);
	}

	public function insumo()
	{
		$data = $this->input->post();

		if (((int) $data['id']) <= 0)
			$this->error('Debe seleccionar un insumo');

		if (((float) $data['cantidad']) <= 0)
			$this->error('Debe ingresar una cantidad');

		$cart = $this->session->userdata('carritoInsumos');
		
		if (!$cart)
			$cart = array();
		
		$item = array(
			'id' => $data['id'],
			'descripcion' => $data['descripcion'],
			'medida' => $data['medida'],
			'cantidad' => $data['cantidad']
			);

		$index = sizeof($cart);

		for ($i=0; $i < sizeof($cart); $i++) {
			if ($cart[$i]['id'] == $item['id']) {
				$index = $i;
				break;
			}
		}

		$cart[$index] = $item;

		$this->session->set_userdata('carritoInsumos',$cart);

		echo json_encode($item);
	}

	public function eliminaitemcarrito(){
		$idIns = $this->input->post('idIns');
		$cart = $this->session->userdata('carritoInsumos');
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

		$this->session->set_userdata('carritoInsumos',$cart);

		echo json_encode(array('removed' => $found, 'id' => $idIns));
	}

	public function resetinsumos(){
		$this->session->unset_userdata('carritoInsumos');
		echo "[]";
	}

	public function save(){

		$config = array(
			'upload_path' => './productos/',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size'	=> '600',
			'max_width' => '1024',
			'max_height' => '768',
			);
		$this->upload->initialize($config);

		$cart = $this->session->userdata('carritoInsumos');

		if (!$cart) 
			$cart = [];
		
		if (sizeof($cart) == 0)
			$this->ajaxerror('El carro se encuentra vacío');

		$data = $this->input->post();
		
		if (empty($data['nombre']))
			$this->ajaxerror('Debe ingresar un nombre');

		if ((float) $data['precio'] <= 0 )
			$this->ajaxerror('Ingrese un precio válido');

		if (empty($data['categoriaId']))
			$this->ajaxerror('Debe seleccionar una categoría');

		if (empty($data['destino']))
			$this->ajaxerror('Seleccione el destino');

		if (!isset($data['sucursal']) || !is_array($data['sucursal']))
			$this->ajaxerror('Debe seleccionar al menos una sucursal');

		if ( ! $this->upload->do_upload('image'))
			$this->ajaxerror(strip_tags($this->upload->display_errors()));
		
		$upload = $this->upload->data();

		//$data['imagen'] = 'productos/'.$upload['file_name'];
		$data['imagen'] = $upload['file_name']; // litokurt

		$id = $this->Mproducto->regProducto($data);

		if ($id === 0)
			$this->ajaxerror('No se pudo guardar el producto');

		foreach ($cart as $item) {
			$ins = array(
				'idProducto' => $id,
				'idInsumo' => $item['id'],
				'cantXMedida' => $item['cantidad'],
				);

			$this->Mproducto->addInsumo($ins);
		}

		foreach ($data['sucursal'] as $value) {
			$suc = array(
				'idProducto' => $id,
				'idSucursal' => $value,
				'precioVenta' => $data['precio'],
				);
			$this->Mproducto->addSucursal($suc);
		}

		$this->session->unset_userdata('carritoInsumos');

		echo '<script>parent.responseAjaxFrame({success:"ok"})</script>';
	}

	private function error($error)
	{
		header('HTTP/1.0 403 Forbidden');
		echo json_encode(['error' => $error]);
		exit();
	}

	private function ajaxerror($error)
	{
		echo '<script>parent.responseAjaxFrame('.json_encode(['error' => $error]).')</script>';
		exit();
	}

	public function getProductoBySucursal(){
		// $idS = $this->session->userdata('s_idSucursal');
		$idS = $this->input->post('idSu');
		$result = $this->Mproducto->getProductoBySucursal($idS);
		echo json_encode($result->result());
	}

	public function getDetalleProducto($id,$pv,$dest,$img,$sitReg,$idSucursal){
		//var_dump(htmlentities($nom));
		$data = array(
			'getCategProducto' => $this->Mproducto->getCategProducto(),
			'listInsumos' 	   => $this->Minsumo->getInsumoNuevo()
			);

		$result = $this->Mproducto->getProductsById($id);
		// $result->name
		// foreach ($query->result() as $row)
	   	// {
	    //   echo $row->title;
	    //   echo $row->name;
	    //   echo $row->body;
	   	// }

		//$data['listDetalleProducto'] = $result;
		$data['nomProducto'] = $result->name;// $nom;
		$data['catProducto'] = $result->catProd;//$cat;//utf8_decode($cat);
		$data['pvProducto'] = $pv;
		$data['idProducto'] = $id;
		$data['destProducto'] = $dest;
		$data['imgProducto'] = $img;
		$data['sitReg'] = $sitReg;
		$data['idSucursal'] = $idSucursal;
		$this->load->view('layout/header');
		$this->load->view('producto/vdetalleproducto',$data);
		$this->load->view('layout/footer');
	}

	public function getInsumoPorProducto(){
		$idProd = $this->input->post('idProd');
		$r = $this->Mproducto->getDetalleProducto($idProd);
		echo json_encode($r);
	}

	public function downloadProductos($idS,$nomSuc){
		// $idS = $this->session->userdata('s_idSucursal');
	    $result = $this->Mproducto->getProductoBySucursal($idS);
	    $this->export_excel->to_excel($result, 'productos_de_'.strtolower($nomSuc)); 
	}

	public function updateProducto(){
		//unlink es para eliminar archivos, pero por ahora no elimnar ya que todos usan el mismo archivo
		//unlink('./productos/pp.jpg');

		$config = array(
			'upload_path' => './productos/',
			'allowed_types' => 'gif|jpg|png',
			'max_size'	=> '600',
			'max_width' => '1024',
			'max_height' => '768',
			);
		$this->upload->initialize($config);
		$error = '';

		if ( ! $this->upload->do_upload('fileDetImgProducto')){
			$error = $this->upload->display_errors();
			//var_dump($error);
			if ($error == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.') {
				$error = 'El archivo excede el peso permitido.';
			}
			if ($error === '<p>You did not select a file to upload.</p>') {
				$error = 'Ud no ha cambiado la imagen.';

				$param['fileDetImgProducto'] = $this->input->post('txtImgProductoOrig');
			
				$param['txtDetNomProducto'] = $this->input->post('txtDetNomProducto');
		    	$param['cboDetCatProducto'] = $this->input->post('cboDetCatProducto');
		    	$param['txtDetPrecProducto'] = $this->input->post('txtDetPrecProducto');
		    	$param['txtDetIdProducto'] = $this->input->post('txtDetIdProducto');
		    	$param['cboDetDestProducto'] = $this->input->post('cboDetDestProducto');
		    	$param['hdnIdSucursal'] = $this->input->post('hdnIdSucursal');		    	

		    	$estado = 0;
				if ($this->input->post('chkEstado') == "on") {
					$estado = 1;
				}else{
					$estado = 0;
				}
				$param['chkEstado'] = $estado;
				
		    	$this->Mproducto->updateProducto($param);
			}
			$data['error'] = $error;
			$data['sucursales'] = $this->Msucursal->getList();
			$data['hdnIdSucursal'] = $this->input->post('hdnIdSucursal');
			$this->load->view('layout/header');
			$this->load->view('producto/vgestorproductos',$data);
			$this->load->view('layout/footer');
		}
		else{
			$upload = $this->upload->data();
			$nomImg = $upload['file_name'];

			if ($error == 'You did not select a file to upload.') {
				$param['fileDetImgProducto'] = $this->input->post('txtImgProductoOrig');
			}else{
				$param['fileDetImgProducto'] = $nomImg;
			}
			
			$param['txtDetNomProducto'] = $this->input->post('txtDetNomProducto');
	    	$param['cboDetCatProducto'] = $this->input->post('cboDetCatProducto');
	    	$param['txtDetPrecProducto'] = $this->input->post('txtDetPrecProducto');
	    	$param['txtDetIdProducto'] = $this->input->post('txtDetIdProducto');
	    	$param['cboDetDestProducto'] = $this->input->post('cboDetDestProducto');
			$param['hdnIdSucursal'] = $this->input->post('hdnIdSucursal');

	    	$estado = 0;
			if ($this->input->post('chkEstado') == "on") {
				$estado = 1;
			}else{
				$estado = 0;
			}
			$param['chkEstado'] = $estado;
			
	    	$this->Mproducto->updateProducto($param);

	    	$data['error'] = "";
	    	$data['sucursales'] = $this->Msucursal->getList();
	    	$data['hdnIdSucursal'] = $this->input->post('hdnIdSucursal');
			$this->load->view('layout/header');
			$this->load->view('producto/vgestorproductos',$data);
			$this->load->view('layout/footer');
		} 
		
	}

	public function updCatProd(){
		if($this->input->is_ajax_request()){
			$param['mhdnIdCatProd'] = $this->input->post('mhdnIdCatProd');
			// $param['mtxtNomCatProd'] = $this->security->xss_clean($this->input->post('mtxtNomCatProd'));
			$param['mtxtNomCatProd'] = $this->input->post('mtxtNomCatProd');
			echo $this->Mproducto->updCatProd($param);
		}else{
			echo "No valido ajax";
		}		
	}

	//eliminar insumo del producto
	public function delInsFromProd(){
		$idProd = $this->input->post('idProd');
		$idIns = $this->input->post('idIns');
		$r = $this->Mproducto->delInsFromProd($idProd,$idIns);
		echo $r;
	}

	//agregar insumo al producto
	public function addInsToProd(){
		$idProd = $this->input->post('idProd');
		$idIns = $this->input->post('idIns');
		$cantIns = $this->input->post('cantIns');

		$r = $this->Mproducto->addInsToProd($idProd,$idIns,$cantIns);
		echo $r;
	}

	public function delProducto($idSucursal,$idProducto){
		if ($idSucursal != $this->session->userdata('s_idSucursal')) {
			$data['error'] = "No puede eliminar productos de otra sucursal";
			$data['sucursales'] = $this->Msucursal->getList();
			$data['hdnIdSucursal'] = 0;
			$this->load->view('layout/header');
			$this->load->view('producto/vgestorproductos',$data);
			$this->load->view('layout/footer');
		}else{
			$r = $this->Mproducto->delProducto($idSucursal,$idProducto);
			if ($r > 0) {
				redirect('cproducto/gestorProducto');
			}else{
				$data['error'] = "No se ha podido elimnar el producto";
				$data['sucursales'] = $this->Msucursal->getList();
				$data['hdnIdSucursal'] = 0;
				$this->load->view('layout/header');
				$this->load->view('producto/vgestorproductos',$data);
				$this->load->view('layout/footer');
			}
		}
	}
}