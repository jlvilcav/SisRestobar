<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Csucursal extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mubigeo');
		$this->load->model('Msucursal');
		$this->load->model('Mcommon');
		$this->load->library('upload');
	}

	public function index(){
		$data['listSucursal'] = $this->Mcommon->fillfull('sucursal');

		$this->load->view('layout/header');
		$this->load->view('sucursal/vgestorsucursal',$data);
		$this->load->view('layout/footer');
	}

	//Llamada menu
	public function sucursal(){
		$data['regSucursalState'] = null;
		$data['listDepartamentos'] = $this->Mubigeo->listDepartamentos();

		$this->load->view('layout/header');
		$this->load->view('sucursal/vsucursal',$data);
		$this->load->view('layout/footer');

	}

	public function cajas(){
		$data['listSucursal'] = $this->Mcommon->fillfull('sucursal');

		$this->load->view('layout/header');
		$this->load->view('sucursal/vcajas',$data);
		$this->load->view('layout/footer');
	}

	public function mesas(){
		$data['regMesasSucursalState'] = null;
		$data['listSucursal'] = $this->Mcommon->fillfull('sucursal');

		//$data['getMesasSucursal'] = null;
		//$data['getMesasSucursal'] = $this->Msucursal->getMesasSucursal();

		$this->load->view('layout/header');
		$this->load->view('sucursal/vmesas',$data);
		$this->load->view('layout/footer');
	}

	public function getmesas($id){
		$mesas = $this->Msucursal->getMesasBySucursal($id);
		echo json_encode($mesas);
	}

	public function regSucursal(){
		$param['txtNomSucursal'] = $this->input->post('txtNomSucursal');
		$param['txtCodUbigeo'] = $this->input->post('cboDepartamento').$this->input->post('cboProvincia').$this->input->post('cboDistrito');
		$param['txtDireccion'] = $this->input->post('txtDireccion');
		$param['txtObservacion'] = $this->input->post('txtObservacion');

		$idsuc = $this->Msucursal->regSucursal($param);

		if ($idsuc > 0) {
			$data['regSucursalState'] = '1';
			$this->load->view('layout/header');
			$this->load->view("sucursal/vsucursal",$data);
			$this->load->view('layout/footer');
		}else{
			$data['regSucursalState'] = '0';
			$this->load->view("sucursal/vsucursal",$data);
		}
	}

	//crear cajas
	public function regCajaSucursal(){
		$param['cboSucursal'] = $this->input->post('cboSucursal');
		$param['txtDescripcion'] = $this->input->post('txtDescripcion');

		$idcasuc = $this->Msucursal->regCajasSucursal($param);

		//registramos en apertura cierre, por defecto cerrado y monto 0
		if ($idcasuc > 0) {
			$this->load->model('maperturacierre');
			$param['idSucursal'] = $this->input->post('cboSucursal');
			$param['idCaja'] = $idcasuc;
			$param['monto'] = 0;
			$param['estado'] = 'C';
			$param['ultimo'] = 1;

			$this->maperturacierre->regAperturaCierre($param);
		}

		//$data['regCajasSucursalState'] = $idcasuc;
		redirect('csucursal/cajas');		
	}

	//registrar mesas
	public function addMesa(){
		$data = $this->input->post('q');
        $data = json_decode($data);
        if (!$data)
            $this->error('No válido');

		$param = array(
			'nombre' => $data->nombre,
			'idSucursal' => $data->idSucursal,
			);

		$idmesuc = $this->Msucursal->regMesasSucursal($param);

		if ($idmesuc === false)
			$this->error('No se pudo guardar la mesa');

		$param['idMesa'] = $idmesuc;
		$param['x']      = 0;
		$param['y']      = 0;
		$param['ancho']  = 40;
		$param['alto']   = 30;

		echo json_encode($param);
	}

	public function updateMesa(){
		$data = $this->input->post('q');
        $data = json_decode($data);
        if (!$data)
            $this->error('No válido');

        $param = array(
        	'idMesa' => $data->idMesa,
        	'nombre'  => $data->nombre,
        	'ancho'  => (int) $data->ancho,
        	'alto'   => (int) $data->alto,
        	'x'      => (int) $data->x,
        	'y'      => (int) $data->y,
        	);

		$this->Msucursal->updateMesasSucursal($param);
        
        echo json_encode($param);
	}

	public function uploadCroquis($id){
		$idSucursal = (int) $id;

		$config = array(
			'upload_path' => './sucursales/',
			'allowed_types' => 'gif|jpg|png',
			/*
			'max_size'	=> '300',
			'max_width' => '1024',
			'max_height' => '768',
			*/
			);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file'))
			$this->error(strip_tags($this->upload->display_errors()));

		$upload = $this->upload->data();

		$imagen = 'sucursales/'.$upload['file_name'];

		$this->Msucursal->updateCroquis($idSucursal, $imagen);

		echo json_encode(array('idSucursal' => $idSucursal, 'croquis' => $imagen));
	}

	public function getCajaSucursal(){
		$suc = $this->input->post('cboSucursal');
		$cs = $this->Msucursal->getCajaSucursal($suc);
		

		$output = null;
		$output .= "<tr>
                  <th style='width: 40%; background-color: #1c84c6; color:white; text-align:center;'>SUCURSAL</th>
                  <th style='width: 60%; background-color: #1c84c6; color:white; text-align:center;'>CAJA</th>
                </tr> ";

		if ($cs) {
			foreach ($cs as $gcs) {
		        $output .= "<tr>";
		        $output .= "<td style='color:#006699; text-align:center;'><i class='fa fa-check-circle'></i> &nbsp;&nbsp;".$gcs->nombre."</td>";
		        $output .= "<td style='color:#4F7C0F; text-align:center;'>".$gcs->descripcion."</td>";
		        $output .= "</tr>";
	      	}

	      	echo $output;
		}else{
			echo '';
		}

		

	}

	private function error($error)
    {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(['error' => $error]);
        exit();
    }
}
