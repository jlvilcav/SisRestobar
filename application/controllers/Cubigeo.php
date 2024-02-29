<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cubigeo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mubigeo');
	}

	//llenar combos
	public function provincias(){
		$dep = $this->input->post('cboDepartamento');
		$prov= $this->Mubigeo->listProvincia($dep);
		foreach($prov as $fila)
		{
			echo "<option value='".$fila->codProvincia."'>".$fila->nombre."</option>";
		}
	}

	public function distritos(){
		$dep = $this->input->post('cboDepartamento');
		$prov = $this->input->post('cboProvincia');
		$dis = $this->Mubigeo->listDistrito($dep,$prov);
		foreach ($dis as $fila) {
			echo "<option value='".$fila->codDistrito."'>".$fila->nombre."</option>";
		}
	}
}