<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Caperturacierre extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Maperturacierre');
	}

	//Llamada menu
	public function aperturaCierre(){
		$this->load->view('layout/header');
		$this->load->view('cajaac/vaperturacierre');
		$this->load->view('layout/footer');
	}

	public function getCajaAC(){
		$idSu = $this->session->userdata('s_idSucursal');
		$consult = $this->Maperturacierre->getCajaAC($idSu);
		echo json_encode($consult);
	}

	public function regAperturaCierre(){
		$this->load->model('Mlogin');

		$nomUsuario = $this->session->userdata('s_nomUsuario');
		$clave = $this->input->post('clave');
		
		$result = $this->Mlogin->compruebaLogin($nomUsuario,sha1($clave));
		$msj = null;
		if ($result == 1) {
			//actualizamos el ultimo registro con ultimo=0, insertamos y guardamos en kardex
			$param['idTipMovCaja'] = $this->input->post('idTMC');
			$param['idAperturaCaja'] = $this->input->post('idAC');
			$param['idCaja'] = $this->input->post('idC');
			$param['idSucursal'] = $this->session->userdata('s_idSucursal');
			$param['monto'] = $this->input->post('monto');
			$param['saldo'] = $this->input->post('saldo');
			$param['estado'] = $this->input->post('estado');
			$param['ultimo'] = $this->input->post('ultimo');

			$this->Maperturacierre->aperturaCierre($param);
			$msj = 1;
		}else{
			$msj = 0;
		}

		echo $msj;
	}

	public function getLastSaldo(){
		$idC = $this->input->post('idC');
		$last_saldo = $this->Maperturacierre->getLastSaldo($idC);
		echo $last_saldo;
	}

	public function getTotalEfectivo(){
		$idC = $this->input->post('idC');
		$fecApert = $this->input->post('fecApert');
		$tot = $this->Maperturacierre->getTotalEfectivo($idC,$fecApert);
		echo $tot;
	}

	public function getTotalPropina(){
		$idC = $this->input->post('idC');
		$tot = $this->Maperturacierre->getTotalPropina($idC);
		echo $tot;
	}

	public function getTotalVisa(){
		$idC = $this->input->post('idC');
		$fecApert = $this->input->post('fecApert');
		$tot = $this->Maperturacierre->getTotalVisa($idC,$fecApert);
		echo $tot;
	}

	public function getTotalMastercard(){
		$idC = $this->input->post('idC');
		$fecApert = $this->input->post('fecApert');
		$tot = $this->Maperturacierre->getTotalMastercard($idC,$fecApert);
		echo $tot;
	}

	public function getCantApertura(){
		$idC = $this->input->post('idC');
		$tot = $this->Maperturacierre->getCantApertura($idC);
		echo $tot;
	}

	public function getFecApertura(){
		$idC = $this->input->post('idC');
		$fecAC = $this->Maperturacierre->getFecApertura($idC);
		echo $fecAC;
	}
	
	public function imprimeCaja(){

		$hoy = date("dmyHis");
		$idC = $this->session->userdata('s_idCaja');

		$fecAC = $this->Maperturacierre->getFecApertura($idC);

		$totApert = $this->nullToCero($this->Maperturacierre->getCantApertura($idC));
		$totEf = $this->nullToCero($this->Maperturacierre->getTotalEfectivo($idC,$fecAC));
		$totVs = $this->nullToCero($this->Maperturacierre->getTotalVisa($idC,$fecAC));
		$totMs = $this->nullToCero($this->Maperturacierre->getTotalMastercard($idC,$fecAC));

		$total = $totEf+$totVs+$totMs+$totApert;
		//echo '<pre>'; print_r($total); echo '</pre>';exit();
		//echo var_dump($tot);
		$data = [];
        //load the view and saved it into $html variable
        // $html=$this->load->view('welcome_message', $data, true);


        ob_start();
		include('hoja.css');
		// include(base_url().'assets/bootstrap/css/bootstrap.min.css');
		$estilos = ob_get_contents();
		ob_end_clean();


 		$html = 
 			"
 			<link rel='stylesheet' href='".base_url()."/assets/bootstrap/css/bootstrap.min.css'>
 			<link rel='stylesheet' href='".base_url()."/restobar/assets/dist/css/AdminLTE.min.css'>
 			<link rel='stylesheet' href='".base_url()."/restobar/assets/plugins/iCheck/square/blue.css'>".

 			"<style>".$estilos."</style>"

 			."<body>
				<div style='width: 220px; border: 1px solid #ccc; padding: 20px;'>

		 			<div style='text-align:center;'>.:: Sist-Restobar ::.</div>
					<div style='text-align:center;'>Cierre de Caja</div>
					<hr style='text-align:center; border-top: 3px double black;'>
					<label>Passwordsss</label>
					<b>Caja : </b>".$this->session->userdata('s_nomCaja')." - <b>Suc.:</b> ".$this->session->userdata('s_nomSucursal')."<br>

					<b>Usu.: </b>".$this->session->userdata('s_usu')."<br><br>

		 			<small class='colorletra'>Esta caja se aperturo con $totApert</small><br>

		 			<table class='table table-bordered'>
		 				<tbody>
			 				<tr>
			 					<td>&nbsp;&nbsp;&nbsp;<b>Efectivo</b></td>
			 					<td align='right'>".$this->nullToCero($totEf)."</td>
			 				</tr>
			 				<tr>
			 					<td>&nbsp;&nbsp;&nbsp;<b>Visa</b></td>
			 					<td align='right'>".$this->nullToCero($totVs)."</td>
			 				</tr>
			 				<tr>
			 					<td>&nbsp;&nbsp;&nbsp;<b>Mastercard</b></td>
			 					<td align='right'>".$this->nullToCero($totMs)."</td>
			 				</tr>
		 				</tbody>
		 			</table>

		 			<b>TOTAL: ".number_format($total, 2, '.', ' ')."</b><br>
					<span style='font-size:8pt;'>(Incluido la cantidad de apertura)</label><br><br>
		 			<div style='margin-left:20px;'>Fecha: ".date('d/m/y H:i')."</div>
		 			<hr style='width:200px;text-align:left;border: 3px double black;'>
				</div>
 			</body>";

        //this the the PDF filename that user will get to download
        $pdfFilePath = "br_cuenta_".$hoy.".pdf";
 
        //load mPDF library
        $this->load->library('M_pdf');
 

       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	}

	private function nullToCero($val){
		return ($val == null)?0:$val;		
	}

}
