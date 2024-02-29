<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Creportes extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mreportes');
        // $this->load->model('Mventa');
        $this->load->library('export_excel');
    }

    public function repVentas(){
        $this->load->view('layout/header');
        $this->load->view('reportes/vrepventas');
        $this->load->view('layout/footer');
    }

    public function insConsumido(){
        $this->load->view('layout/header');
        $this->load->view('reportes/vrepinsconsumido');
        $this->load->view('layout/footer');
    }

    public function insStockMinimo(){
        $this->load->view('layout/header');
        $this->load->view('reportes/vrepinsstockmin');
        $this->load->view('layout/footer');
    }
    
    public function insStock(){
        $this->load->view('layout/header');
        $this->load->view('reportes/vrepstockins');
        $this->load->view('layout/footer');
    }

    public function repVentasByDate(){

        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));

        $result = $this->Mreportes->repVentasByDate($idS,$dateI,$dateF);

        echo json_encode($result);
    }

    public function downloadRepVentas($fecIni,$fecFin){
        $idS = $this->session->userdata('s_idSucursal');
        // $fecIni = $this->input->post('fecIni');
        // $fecFin = $this->input->post('fecFin');

        // $result = $this->Mventa->getVentas($idS,$fecIni,$fecFin);
        $this->export_excel->to_excel($result, 'ventas_de_'.$idS); 
    }

    public function getAperturaCierre(){
        echo json_encode($this->Mreportes->getAperturaCierre());
    }

    public function getProductosConsumidos(){
        $fa = $this->input->post('fa');
        $fc = $this->input->post('fc');
        
        $dateI = $fa;
        $dateF = $fc;

        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d H:i:s', strtotime($dateI));

        if ($fc == 0) {
            $dateF = date('Y-m-d H:i:s');
        }else{

            $dateF = str_replace('/', '-', $dateF);
            $dateF = date('Y-m-d H:i:s', strtotime($dateF));
        }


        //creamos 2 sessiones para las fechas por si imprimen los productos
        $this->session->unset_userdata('s_fecApert');
        $this->session->unset_userdata('s_fecCierr');

        $s_fecAC = array(
                's_fecApert' => $dateI,
                's_fecCierr' => $dateF
            );
        $this->session->set_userdata($s_fecAC);
        //end

        $r = $this->Mreportes->getProductosConsumidos($dateI,$dateF);

        echo json_encode($r);
    }

    public function getInsConsumidos(){
        $fa = $this->input->post('fa');
        $fc = $this->input->post('fc');
        $re = $this->getIC($fa,$fc);
        echo json_encode($re);
    }

    public function getIC($fa,$fc){

        $dateI = $fa;
        $dateF = $fc;

        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d H:i:s', strtotime($dateI));

        if ($fc == 0) {
            $dateF = date('Y-m-d H:i:s');
        }else{

            $dateF = str_replace('/', '-', $dateF);
            $dateF = date('Y-m-d H:i:s', strtotime($dateF));
        }

        // echo $dateI . " - " . $dateF;

        $r = $this->Mreportes->getInsConsumidos($dateI,$dateF);
        return $r;
    }

    public function getStockIns(){
        $r = $this->Mreportes->getStockIns();
        echo json_encode($r);
    }

    public function imprimeInsConsumidos($fa,$fc){

        $hoy = date("dmyHis");

        // $fa = $this->input->post('fa');
        // $fc = $this->input->post('fc');

        $fa = str_replace("-", "/", $fa);
        $fa = str_replace("_", " ", $fa);

        if ($fc == 0) {
            $fc = 0;
        }else{

            $fc = str_replace("-", "/", $fc);
            $fc = str_replace("_", " ", $fc);
        }

        $re = $this->getIC($fa,$fc);

        // echo '<pre>';
        // print_r($re);
        // echo '</pre>';

        $data = [];
        //load the view and saved it into $html variable
        // $html=$this->load->view('welcome_message', $data, true);
        $html = 
            "<style>@page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }
            </style>
            <style>
                body{
                    font: 120% sans-serif small-caps;
                    font-size:11pt;
                    color: #555;
                }

                table{
                    font-size:9pt;
                }
            </style>
            <body>".

            "<b>.:: SIST RESTOBAR ::.</b><br>
            &nbsp;&nbsp;&nbsp;INSUMOS CONSUMIDOS<br>
            <hr style='width:200px;text-align:left;border-top: 3px double black;'><br>
            ".

            "<b>Suc.:</b> ".$this->session->userdata('s_nomSucursal')."<br>".
            "<b>Usu.: </b>".$this->session->userdata('s_usu')."<br><br>".
            "<b>Desde.: </b>".$fa."<br>".
            "<b>Hasta.: </b>".$fc."<br><br>".
            
            
            "<table style='border-top:1px solid #555;border-bottom:1px solid black;'>";

            $cont = "";

            foreach ($re as $key => $value) {
                $cont .= "<tr>
                            <td>&nbsp;&nbsp;&nbsp;<b>".$value->descripcion."</b></td>
                            <td>&nbsp;&nbsp;&nbsp;<b>".round($value->consumido,2)."</b></td>
                            <td>&nbsp;&nbsp;&nbsp;<b>".$value->unidad."</b></td>
                        </tr>";
                
            }

            $html = $html.$cont.
                
            "</table>".

            "<div style='margin-left:35px;'>Fecha: ".date('d/m/y H:i')."</div>
            <hr style='width:200px;text-align:left;border: 3px double black;'>

            </body>";

        //this the the PDF filename that user will get to download
        $pdfFilePath = "ins_cons_".$this->session->userdata('s_idSucursal')."_".$hoy.".pdf";
 
        //load mPDF library
        $this->load->library('M_pdf');
 

       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D"); 
    }

    public function getTotales($idC,$fecIni,$fecFin){
        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));
    }

    public function getTotalEfectivo(){
        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));
        echo $this->Mreportes->getTotalEfectivo($idS,$dateI,$dateF);
    }

    public function getTotalVisa(){
        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));
        echo $this->Mreportes->getTotalVisa($idS,$dateI,$dateF);
    }

    public function getTotalMastercard(){
        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));
        echo $this->Mreportes->getTotalMastercard($idS,$dateI,$dateF);
    }


    public function printProductos(){

        $fa = $this->session->userdata('s_fecApert');
        $fc = $this->session->userdata('s_fecCierr');
        // $hoy = date("dmyHis");
        // $idC = $this->session->userdata('s_idCaja');

        // $fecAC = $this->maperturacierre->getFecApertura($idC);

        // $totApert = $this->nullToCero($this->maperturacierre->getCantApertura($idC));
        // $totEf = $this->nullToCero($this->maperturacierre->getTotalEfectivo($idC,$fecAC));
        // $totVs = $this->nullToCero($this->maperturacierre->getTotalVisa($idC,$fecAC));
        // $totMs = $this->nullToCero($this->maperturacierre->getTotalMastercard($idC,$fecAC));

        // $total = $totEf+$totVs+$totMs+$totApert;
        //echo '<pre>'; print_r($total); echo '</pre>';exit();
        //echo var_dump($tot);
        // $data = [];
        //load the view and saved it into $html variable
        // $html=$this->load->view('welcome_message', $data, true);

        $re = $this->Mreportes->getProductosConsumidos($fa,$fc);

        $html = 
            "<style>@page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }
            </style>
            <style>
                body{
                    font: sans-serif small-caps;
                    font-size:0.9em;
                    color: #555;
                    
                    text-align:left;
                }
                .contenedor{
                    width:250px;
                }
                table{
                    font-size:9pt;
                }
            </style>
            <body><div class='contenedor'>".

                "<div style='text-align:center;'><b>.:: SIST RESTOBAR ::.</b></div>".
                "
                <div style='text-align:center;'><b>PRODUCTOS VENDIDOS</b></div>

                <hr style='text-align:left;border-top: 3px double black;'><br>
                ".

                "<b>Suc.:</b> ".$this->session->userdata('s_nomSucursal')."<br>".
                "<b>Usu.: </b>".$this->session->userdata('s_usu')."<br><br>".
                "<b>Desde.: </b>".$fa."<br>".
                "<b>Hasta.: </b>".$fc."<br><br>".
                
                
                "<table style='border-top:1px solid #555;border-bottom:1px solid black;width:100%;'>";

                $cont = "";

                foreach ($re as $key => $value) {
                    $cont .= "<tr>
                                <td>&nbsp;&nbsp;&nbsp;<b>".$value->nombre."</b></td>
                                <td>&nbsp;&nbsp;&nbsp;<b>".round($value->cant,2)."</b></td>
                            </tr>";
                    
                }

                $html = $html.$cont.
                    
                "</table>".

                "<div style='margin-left:35px;'>Fecha: ".date('d/m/y H:i')."</div>
                <hr style='width:200px;text-align:left;border: 3px double black;'>

            </div></body>";

        //this the the PDF filename that user will get to download
        $pdfFilePath = "productos_vendidos".$fa.".pdf";
 
        //load mPDF library
        $this->load->library('M_pdf');
 

       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D"); 
    }

}