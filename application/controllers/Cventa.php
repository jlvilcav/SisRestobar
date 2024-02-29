<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cventa extends CI_Controller
{
    // private $token = '123';
    private $token = '';

    
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Mcommon');
        $this->load->model('Mproducto');
        $this->load->model('Mventa');
        $this->load->model('Minsumo');
        $this->load->model('Msucursal');
        $this->load->model('Mticket');
        $this->token = $this->session->userdata('its_rb_s_claveautorizacion');
    }

    public function detail(){
        $data = $this->input->post('q');
        $data = json_decode($data);
        if (!$data)
            $this->error('No válido');
        
        if (!isset($data->id) || (int) $data->id < 1 )
            $this->error('Pedido no encontrado');

        $item = $this->Mventa->getDetails($data->id);

        echo json_encode($item);
    }

    public function save(){
        $data = $this->input->post('q');
        $data = json_decode($data);
        
        if (!$data)
            $this->error('No válido');

        if (!property_exists($data, 'esDelivery'))
            $data->esDelivery = 0;

        if (!$data->esDelivery && (!is_array($data->mesa) || sizeof($data->mesa) == 0)) //esto ya no seria necesario, ya que siempre se elige la mesa primero
            $this->error('Indique la mesa del pedido');
        
        if (!is_array($data->productos) || sizeof($data->productos) == 0)
            $this->error('Debe agregar productos al pedido');

        $idSucursal = $this->session->userdata('s_idSucursal');

        // Id de orden o false en orden nueva
        $id = false;
        if (property_exists($data, 'id') && ((int) $data->id) > 0)
            $id = (int) $data->id;
        
        // Revisa si la venta se puede editar por NO estas pagada
        if ($id !== false && !$this->Mventa->isOpen($id))
            $this->error('Esta venta no puede ser editada');

        // Revisar disponibilidad de mesas
        if(!$data->esDelivery && !$this->Mventa->checkTableAvilable($id, $data->mesa))
            $this->error('Mesa no disponible');

        // Obtener pedido anterior
        $oldProductos = $id ? $this->Mventa->getDetailsVenta($id) : array();

        // Obtener array cantidades por productos
        $cant_old = $this->mapPropertyKey($oldProductos);
        $cant_new = $this->mapPropertyKey($data->productos);

        // Variación de pedido
        $prodsId = array();
        $cant_add = array();
        $necesita_admin = false;
        foreach ($data->productos as $producto) {

            $old_value = 0;
            if(isset($cant_old[$producto->id])){
                $old_value = (int) $cant_old[$producto->id]->cant;
                unset($cant_old[$producto->id]);
            }
            
            $variacion = $cant_new[$producto->id]->cant - $old_value;
            $cant_add[$producto->id] = $variacion;
            if ($variacion > 0){
                $prodsId[] = $producto->id;
            }elseif($variacion < 0){
                $necesita_admin = true;
            }
        }

        if(sizeof($cant_old))
            $necesita_admin = true;// si necesita poner la clave de acceso para eliminar
        
        // Validar stock
        if (sizeof($prodsId) > 0) {
            $insumos_necesarios = $this->Mproducto->getInsumosForProductsSucursal($prodsId);
            // var_dump('$insumos_necesarios',$insumos_necesarios);

            $insumosId = array_map(create_function('$o', 'return $o->idInsumo;'), $insumos_necesarios);
            $insumos_existentes = $this->Msucursal->getStockInsumosBySucursal($idSucursal, $insumosId);
            // var_dump('$insumos_existentes',$insumos_existentes);

            $stock = array();
            // $sssss = "";
            foreach ($insumos_existentes as $insumo) {
                $stock[$insumo->idInsumo] = $insumo->stock;
                // $sssss .= "* ".$insumo->idInsumo." -> ".$insumo->stock . nl2br("\n");
            }
            // var_dump($stock);

            $nomInsStockMin = ''; // aqui acumularemos los nombres de los insumos que tiene stock min y por eso no se peuden comprar
            $nomInsNoExisten = '';
            $indicador = 0;
            foreach ($insumos_necesarios as $in) {
                // var_dump($in->idInsumo);
                // var_dump($stock);
                if (!isset($stock[$in->idInsumo])){
                    $nomInsNoExisten .= "* ".$in->nominsumo.nl2br("\n");
                    $indicador = 1;
                    // $this->error('No existe insumos para '. $in->name);
                }elseif($indicador == 0){
                    $stock[$in->idInsumo] -= $cant_add[$in->id] * $in->cant;
                    if ($stock[$in->idInsumo] < 0){
                        $nomInsStockMin .= "* ".$in->nominsumo . nl2br("\n");//concatenamos los nombres de insumos
                        // $this->error('No existen insumos suficientes para '. $in->name .' ('.$cant_add[$in->id].')');
                    }
                }
            }

            //alerta de insumos que no existen
            if ($nomInsNoExisten != '') {
                $this->error( str_replace('<br />',' ','No existe insumos para '.strtoupper($in->name).", Comprar lo siguiente :".nl2br("\n").$nomInsNoExisten));
            }

            //alerta de insumos insuficientes
            if ($nomInsStockMin != '') {
                $this->error( str_replace('<br />',' ','No existen insumos suficientes para '.strtoupper($in->name).", Comprar lo siguiente :".nl2br("\n").$nomInsStockMin));
                // $this->error('No existen insumos suficientes para: '. $in->name .' ('.$cant_add[$in->id].')'.$nomInsStockMin);
            }
        }

        // if ($necesita_admin && !$data->esDelivery){
        if ($necesita_admin){
            if (!property_exists($data, 'token'))
                $this->error('_NEED_AUTH');

            if ($data->token != $this->token)
                $this->error('Token incorrecto');
        }


        // Guardar pedidos
        if (!$id) {
            $v = array(
                'idSucursal' => $idSucursal,
                'mesa' => '',
                'estado' => 0,
                'esDelivery' => $data->esDelivery,
                'indicaciones' => property_exists($data, 'indicaciones') ? $data->indicaciones : null,
                'descripcion' => property_exists($data, 'descripcion') ? $data->descripcion : null,
                'idPersona' => $data->clienteId, //litokurt 220520172138
                );

            $id = $this->Mventa->create($v);
        } elseif($data->esDelivery) {
            $this->Mventa->updateDelivery(
                                $id, 
                                (property_exists($data, 'descripcion') ? $data->descripcion : null),
                                (property_exists($data, 'indicaciones') ? $data->indicaciones : null));
        }

        if ($id === false)
            $this->error('No se pudo guardar el pedido');

        if (!$data->esDelivery)
            $mesas = $this->Mventa->syncTables($id, $data->mesa);
        else
            $mesas = "D-{$id}";

        foreach ($data->productos as $producto) {
            $pr = array(
                'idVenta' => $id,
                'idProductoSucursal' => $producto->id,
                'cant' => (int) $producto->cant,
                'pUnit' => $producto->price,
                'pTotal' => $producto->cant * $producto->price,
                'observacion' => (isset($producto->detalle) ? $producto->detalle : ''),
                );
            $this->Mventa->addDetalle($pr);
            $this->Minsumo->removeInsumoByProductoSucursal($producto->id, $cant_add[$producto->id]);

            //$this->Mticket->addTicket($idV, $cant_add[$producto->id], $producto, implode(',', $data->mesa), $idSucursal);
            //litokurt
            $this->Mticket->addTicket($id, $cant_add[$producto->id], $producto, $mesas, $idSucursal,  (isset($producto->detalle) ? $producto->detalle : ''),$producto->price,$producto->id, $data->descripcion); //descripcion = cliente
        }

        foreach ($cant_old as $productoId => $prod) {
            $this->Minsumo->removeInsumoByProductoSucursal($productoId, $prod->cant * -1);
            $this->Mventa->removeDetalle($productoId, $id);
        }

        echo json_encode(array('id' => $id));
    }

    public function nro(){
        $idSucursal = $this->session->userdata('s_idSucursal');
        $idVenta = $this->Mventa->countBySucursal($idSucursal) + 1;
        $nro = str_pad($idSucursal, 3, "0", STR_PAD_LEFT).'-'.str_pad($idVenta, 6, "0", STR_PAD_LEFT);
        echo json_encode(array('nro' => $nro));
    }

    private function mapByKey($productos){
        $data = [];
        foreach ($productos as $producto) {
            $data[$producto['id']] = $producto['cant'];
        }
        return $data;
    }

    public function pay(){
        $data = $this->input->post('q');
        $data = json_decode($data, true);
        if (!$data)
            $this->error('No válido');

        // Items del pedido
        $pedido = $this->Mventa->getDetailsVenta($data['pedidoId']);

        // var_dump($pedido);

        // Items del pago
        $pago = $this->mapByKey($data['productos']);

        $total = 0;
        $diff = [];

        foreach ($pedido as $item) {
            // Item esta presente en el pago
            if (isset($pago[$item->id])) {
                // Paga menos del total
                if ($item->cant > $pago[$item->id]) {
                    // Diferencia para nueva venta
                    $diff[$item->id] = $item->cant - $pago[$item->id];
                }
                // Aumento al total, precio de item * cantidad del pago
                $total += $pago[$item->id] * $item->price;
            }else{
                // Diferencia para nueva venta
                $diff[$item->id] = $item->cant;
            }
        }

        /*
        */
        
        //$total += $data['propina'];
        $calDsct = (double)$total * (1 - $data['dsct'] / 100 );
        $totalDsct = (double) $data['total'] - $data['propina']; //16092018
        
        if((string)(round($totalDsct,2)) != (string)(round($calDsct,2)))
            // var_dump($data['total']);
            $this->error('Inconsistencia. Recargue el pedido:'.$totalDsct."-".$calDsct."-".$total);

        //$this->error('ok');
        if ($data['efectivo'] + $data['visa'] + $data['mastercard'] < $data['total'] - $data['dsct'])
            $this->error('Pago insuficiente');

        // Divide cuenta
        $newVenta = false;
        if (sizeof($diff)) {
            $newVenta = $this->Mventa->divideVenta($data['pedidoId'], $diff);
            if ($newVenta === false) {
                $this->error('No se pudo dividir el pedido');
            }
        }

        $idSucursal = $this->session->userdata('s_idSucursal');
        $idVenta = $this->Mventa->countBySucursal($idSucursal) + 1;

        $data['efectivo'] = (isset($data['efectivo'])  ? (double) $data['efectivo'] : 0);
        $data['visa'] = (isset($data['visa'])  ? (double) $data['visa'] : 0);
        $data['mastercard'] = (isset($data['mastercard'])  ? (double) $data['mastercard'] : 0);

        $param = array(
            'pedidoId' => $data['pedidoId'],
            'idTipoRecibo' => $data['reciboId'],
            'numRecibo' => $data['numRecibo'],
            'idPersona' => is_null($data['clienteId']) ? '1' : $data['clienteId'],
            'total' => $total,
            'dsct' => $data['dsct'],
            'numVenta' => $idVenta,
            'numVentaGenerado' => str_pad($idSucursal, 3, "0", STR_PAD_LEFT) . '-' . str_pad($idVenta, 6, "0", STR_PAD_LEFT),
            'idSucursal' => $idSucursal,
            'propina' => $data['propina'],
            );
        $r = $this->Mventa->pay($param);

        if ($r != 1)
            $this->error('No se pudo registrar el pago');

        
        $kardexParm = array(
            'idCaja' => $this->session->userdata('s_idCaja'),
            'idTipMovCaja' => 2,
            'idOperacion' => $data['pedidoId'],
            'idSucursal' => $idSucursal,
            );
        if ($data['efectivo'] > 0) {
            $kardexParm['monto'] = $kardexParm['var'] = $data['total'] - $data['visa'] - $data['mastercard'];
            $kardexParm['tipoPago'] = 'EFECTIVO';
            $this->Mventa->addKardex($kardexParm);
        }

        if ($data['visa'] > 0) {
            $kardexParm['monto'] = $data['visa'];
            $kardexParm['var'] = 0;
            $kardexParm['tipoPago'] = 'VISA';
            $this->Mventa->addKardex($kardexParm);
        }

        if ($data['mastercard'] > 0) {
            $kardexParm['monto'] = $data['mastercard'];
            $kardexParm['var'] = 0;
            $kardexParm['tipoPago'] = 'MASTERCARD';
            $this->Mventa->addKardex($kardexParm);
        }

        echo json_encode(array('id' => $data['pedidoId'], 'new' => $newVenta));
    }

    public function cancel(){
        $data = $this->input->post('q');
        $data = json_decode($data);
        if (!$data)
            $this->error('No válido');

        $id = (int) $data->id;
        if ($id < 0)
            $this->error('Identificador inválido');

        if (!$this->Mventa->isOpen($id))
            $this->error('Esta venta no puede ser cancelada');

        // $isDelivery = $this->Mventa->isDelivery($id);

        // if (!$isDelivery && !property_exists($data, 'token'))
        //     $this->error('Necesita autorización');

        // if (!$isDelivery && $data->token != $this->token)
        //     $this->error('Token incorrecto');

        $isDelivery = $this->Mventa->isDelivery($id);

        if (!property_exists($data, 'token'))
            $this->error('Necesita autorización');

        if ($data->token != $this->token)
            $this->error('Token incorrecto');

        $result = $this->Mventa->cancelVenta($id);
        if ($result != 1)
            $this->error('No se pudo cancelar la venta');

        $productos = $this->Mventa->getDetailsVenta($id);
        foreach ($productos as $producto) {
            $this->Minsumo->removeInsumoByProductoSucursal($producto->id, $producto->cant * -1);
        }
    }

    private function error($error)
    {
        header('HTTP/1.0 403 Forbidden');
        echo json_encode(['error' => $error]);
        exit();
    }

    private function mapPropertyKey($pedido)
    {
        $result = array();
        foreach ($pedido as $producto) {
            $result[$producto->id] = $producto;
        }
        return $result;
    }

    //litokurt
    public function gestorVentas(){
        $this->load->view('layout/header');
        $this->load->view('ventas/vgestorventas');
        $this->load->view('layout/footer');
    }

    // public function ventasByDate(){

    //     $s = $this->input->post('start');
    //     $l= $this->input->post('length');
        
    //     $idS = $this->session->userdata('s_idSucursal');
    //     $fecIni = $this->input->post('fecIni');
    //     $fecFin = $this->input->post('fecFin');

    //     $dateI = $fecIni;
    //     $dateI = str_replace('/', '-', $dateI);
    //     $dateI = date('Y-m-d', strtotime($dateI));

    //     $dateF = $fecFin;
    //     $dateF = str_replace('/', '-', $dateF);
    //     $dateF = date('Y-m-d', strtotime($dateF));

    //     //leemos si ingreso un valor en busqueda
    //     $search = "";

    //     if (!empty($this->input->post('search')['value'])) {
    //         $search = $this->input->post('search')['value'];
    //     }

    //     $result = $this->Mventa->getVentasBySucursal($idS,$dateI,$dateF,$s,$l,$search);

    //     $cant = $result['numdata'];
    //     $result = $result['datos'];

    //     $datos = array();
    //     foreach ($result->result_array() as $row)
    //     {
    //         $nestedData=array();
    //         $nestedData['rownum'] = $row['rownum'];
    //         $nestedData['cliente'] = $row['cliente'];
    //         $nestedData['fecVenta'] = $row['fecVenta'];
    //         $nestedData['empleado'] = $row['empleado'];
    //         $nestedData['numRecibo'] = $row['numRecibo'];
    //         $nestedData['numVentaGenerado'] = $row['numVentaGenerado'];
    //         $nestedData['descripcion'] = $row['descripcion'];
    //         $nestedData['total'] = $row['total'];
    //         $nestedData['idVenta'] = $row['idVenta'];

    //         $datos[] = $nestedData;
    //     }        

    //     $totalData = $result->num_rows();
    //     $totalDataFiltrada = $totalData;

    //     $json_data = array(
    //         "draw"            => intval($this->input->post('draw')),
    //         "recordsTotal"    => intval($totalData),
    //         "recordsFiltered" => intval($cant),
    //         "data"            => $datos
    //         );

    //      echo json_encode($json_data);
    // }


    public function ventasByDate(){
        $idS = $this->session->userdata('s_idSucursal');
        $fecIni = $this->input->post('fecIni');
        $fecFin = $this->input->post('fecFin');

        $dateI = $fecIni;
        $dateI = str_replace('/', '-', $dateI);
        $dateI = date('Y-m-d', strtotime($dateI));

        $dateF = $fecFin;
        $dateF = str_replace('/', '-', $dateF);
        $dateF = date('Y-m-d', strtotime($dateF));

        $result = $this->Mventa->getVentasBySucursal($idS,$dateI,$dateF);
        
        echo json_encode($result);
    }

    public function getDetalleVenta($id,$cliente,$fecVenta,$numVentaGenerado,$total,$propina){//,$nom,$cat,$pv){
        $result = $this->Mventa->getDetalleVenta($id);
        $data['listDetalleVenta'] = $result;
        $data['cliente'] = $cliente;
        $data['fecVenta'] = $fecVenta;
        $data['numVentaGenerado'] = $numVentaGenerado;
        $data['total'] = $total;
        $data['propina'] = $propina;
        $this->load->view('layout/header');
        $this->load->view('ventas/vdetalleventa',$data);
        $this->load->view('layout/footer');
    }

    public function litokurt(){//pide cuenta
        $data = $this->input->post('q');
        $data = json_decode($data, true);
        // echo var_dump($data);
        $this->Mticket->pideCuenta($data);
    }

}