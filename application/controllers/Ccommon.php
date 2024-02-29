<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Ccommon extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mcommon');
	}

	public function getCategoriaInsumo(){
		$r = $this->Mcommon->fillfull('categoria_insumo');
		echo json_encode($r);
	}

	public function getUnidad(){
		$r = $this->Mcommon->fillfull('unidad');
		echo json_encode($r);
	}

    public function getMedida(){        
        $r = $this->Mcommon->fillfull('medida');
		echo json_encode($r);
    }

}