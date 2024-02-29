<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 include_once APPPATH.'libraries\third_party\mpdf\mpdf.php';
 // include_once APPPATH.'libraries/third_party/mpdf/mpdf.php'; //linux
 
class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",2,2,2,2,6,3')
    {
        $this->param =$param;
        
        $this->pdf = new mPDF($this->param);
    }
}