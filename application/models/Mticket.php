<?php
/**
* 
*/
class Mticket extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	//litokurt
	public function addTicket($idVenta, $cantidad, $producto, $mesa, $idSucursal, $obs, $pUnit, $idProdSuc, $nomCliente){
		if ($cantidad == 0)
			return false;

		//$nombremesa = $this->msucursal->getNombreMesa($mesa);

		$campos = array(
			'producto' => $producto->name,
			'idProdSuc' => $idProdSuc,
			'cntd' => $cantidad,
			'pUnit' => $pUnit,
			'impreso' => ($cantidad <= 0 ? 1 : 0),
			'mesa' => $mesa,//$nombremesa,
			'idSucursal' => $idSucursal,
			'idVenta' => $idVenta,
			'destino' => $producto->dest,
			'observacion' => $obs,
			'mozo' => $this->session->userdata('s_usu'),
			'creado' => date_format(new DateTime(), 'Y-m-d H:i:s'),
			'clienteDelivery' => $nomCliente,
		);
		$this->db->insert('imprime_tickets',$campos);
		$id = $this->db->insert_id();
	}

	public function getToPrint($idSucursal,$barCocina){
		$q = "SELECT mesa
				FROM imprime_tickets
				WHERE id = (SELECT MIN(id) id FROM imprime_tickets WHERE idSucursal = ? AND impreso = 0 and destino = ?)";

		$mesas = $this->db->query($q, array($idSucursal,$barCocina));
		$mesa = $mesas->row('mesa');
		
		if ($mesa == null) {
			$mesa = 0;
		}

		//return $mesa;
		$this->db->select('id, producto, cntd, pUnit, mesa, destino, observacion, mozo, clienteDelivery');
		$this->db->from('imprime_tickets');
		$this->db->where('idSucursal',$idSucursal);
		$this->db->where('mesa',$mesa);
		$this->db->where('destino',$barCocina);
		$this->db->where('impreso',0);

		$rs = $this->db->get()->result();

		$tickets = array();
		foreach ($rs as $tk) {
			$tickets[] = $tk->id;
		}

		if (sizeof($tickets)) {
			$this->db->where_in('id', $tickets);
			$this->db->update('imprime_tickets',array('impreso' => 1));
		}

		return $rs;
	}

	public function activaCuenta($idVenta){
		
		$data = array(
               'impresoCuenta' => 0
            );

		$this->db->where('idVenta',$idVenta);
		//$this->db->where('cntd >',0);
		$this->db->update('imprime_tickets', $data);


	}

	public function printAccount($idSucursal,$idCaja){

		$this->db->select('producto, cantidad, precio, total, mesa, descuento, cliente, direccion, telefono, celular, propina, numVentaG, nommozo');
		$this->db->from('rb_imprimecuenta');
		$this->db->where('idSucursal',$idSucursal);
		$this->db->where('idCaja',$idCaja);

		$rs = $this->db->get()->result();

		//eliminamos la cuenta		
		$this->db->where('idSucursal',$idSucursal);
		$this->db->where('idCaja',$idCaja);
		$this->db->delete('rb_imprimecuenta');

		return $rs;
	}

	public function pideCuenta($data){
		
		//eliminamos del pedido
		$this->db->where('idVenta',$data['pedidoId']);
		$this->db->delete('rb_imprimecuenta');

		//ahora llenamos la tabla
		foreach ($data['productos'] as $p) { 
			$campos = array(
				'idSucursal' => $this->session->userdata('s_idSucursal'),
				'idVenta' => $data['pedidoId'],
				'numVentaG' => $p['nrodeventag'],
				'nommozo' => $p['nommozo'],
				'mesa' => $p['mesa'],
				'idCaja' => $this->session->userdata('s_idCaja'),
				'producto' => $p['name'],
				'cantidad' => $p['cant'],
				'precio' => $p['price'],
				'total' => $data['total'],
				'descuento' => $data['dsct'],
				'estadoImpreso' => 0,
				'cliente' => $data['cliente'],
				'direccion' => $data['dircl'],
				'telefono' => $data['telcl'],
				'celular' => $data['celcl'],
				'propina' =>$data['propina']
			);
 
 			$this->db->insert('rb_imprimecuenta',$campos);

        }
	}

}