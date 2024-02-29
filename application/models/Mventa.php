<?php
/**
* 
*/
class Mventa extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function create($param){
        $param['usuCrea'] = $this->session->userdata('s_idUsuario'); //error, deberia insertar el id del mozo anterior
        $param['fecCrea'] = date_format(new DateTime(), 'Y-m-d H:i:s');
        
        $this->db->insert('ventas',$param);
        $id = $this->db->insert_id();
        if ($id > 0 ) {
            return $id;
        }else{
            return false;
        }
    }

    //aqui no guarda el usucrea como cajero.. si no con el mozo anteior, esto se aplica cuando son cuentas separadas
    public function createDividida($param){
        // $param['usuCrea'] = ; //error, deberia insertar el id del mozo anterior
        $param['fecCrea'] = date_format(new DateTime(), 'Y-m-d H:i:s');
        
        $this->db->insert('ventas',$param);
        $id = $this->db->insert_id();
        if ($id > 0 ) {
            return $id;
        }else{
            return false;
        }
    }

    public function update($param){
        $q = "UPDATE ventas SET mesa = ? WHERE idVenta = ?";
        $this->db->query($q, array($param['mesa'],$param['id']));

        // $t = "UPDATE imprime_tickets SET mesa = ? WHERE idVenta = ?";
        // $this->db->query($t, array($param['mesa'],$param['id']));

        return $param['id'];
    }

    public function syncTables($idVenta, $new){
        // Get current tables 
        $this->db->select('idMesa');
        $this->db->from('mesas_venta');
        $this->db->where('idVenta', $idVenta);
        $currentTables = $this->db->get()->result();

        $old = array_map(create_function('$o', 'return $o->idMesa;'), $currentTables);
        $ids_add = array_diff($new, $old);
        $ids_remove = array_diff($old, $new);

        if (sizeof($ids_remove) or sizeof($ids_add)) {
            if (sizeof($ids_remove)) {
                $this->db->where('idVenta',$idVenta);
                $this->db->where_in('idMesa',$ids_remove);
                $this->db->delete('mesas_venta');
            }
            
            if (sizeof($ids_add)) {
                $inserts = array();
                //for ($i = 0; $i < sizeof($ids_add); $i++) {
                foreach ($ids_add as $add) {
                    var_dump($add);
                    $inserts[] = array(
                                    'idVenta' => $idVenta,
                                    //'idMesa'  => $ids_add[$i],
                                    'idMesa'  => $add,
                                    );
                }
                //}
                $this->db->insert_batch('mesas_venta', $inserts);
            }

            $this->db->select('nombre');
            $this->db->from('mesas');
            $this->db->where_in('idMesa', $new);
            $m = $this->db->get()->result();

            $mt = array();
            foreach ($m as $n) {
                $mt[] = $n->nombre;
            }

            $q = "UPDATE ventas SET mesa = ? WHERE idVenta = ?";
            $this->db->query($q, array(implode(', ', $mt),$idVenta));

            $t = "UPDATE imprime_tickets SET mesa = ? WHERE idVenta = ?";
            $this->db->query($t, array(implode(', ', $mt),$idVenta));
        }
        $this->db->select('mesa');
        $this->db->from('ventas');
        $this->db->where('idVenta', $idVenta);
        $mesas = $this->db->get()->result();
        return $mesas[0]->mesa;
    }

    public function addDetalle($param){
        $q = "UPDATE detalle_venta SET cant = ?, pUnit = ?, pTotal = ?, observacion = ?, actualizado = ? WHERE idVenta = ? AND idProductoSucursal = ?";
        $this->db->query($q, array($param['cant'],$param['pUnit'],$param['pTotal'],$param['observacion'], time(),$param['idVenta'],$param['idProductoSucursal']));
        if($this->db->affected_rows() == 0){
            $param['actualizado'] = time();
            $this->db->insert('detalle_venta',$param);
        }
    }

    public function removeDetalle($productoId, $idV){
        $q = "DELETE FROM detalle_venta WHERE idVenta = ? AND idProductoSucursal = ?";
        $this->db->query($q, array($idV, $productoId));

        $q = "DELETE FROM imprime_tickets WHERE idVenta = ? AND idProdSuc = ?";
        $this->db->query($q, array($idV, $productoId));
    }

    public function getPedidosByMozo($idMozo){
        $this->db->select('idVenta as id, mesa');
        $this->db->from('ventas');
        $this->db->where('usuCrea', $idMozo);
        $this->db->where('estado', 0);
        $q = $this->db->get();
        return $q->result();

    }

    public function getDetails($idVenta){
        // $this->db->select('idVenta as id, esDelivery, mesa, estado, descripcion, indicaciones');
        // $this->db->from('ventas');
        // $this->db->where('idVenta', $idVenta);

        $this->db->select('v.idVenta AS id, v.esDelivery, v.mesa, v.estado, v.descripcion, v.indicaciones, IFNULL(CONCAT(p.nombre, ", " ,p.apPaterno, " ",p.apMaterno), "GENERAL") as cliente, p.idPersona as idCliente, p.direccion, p.telefono,p.celular, v.usuCrea, 
            IFNULL(CONCAT(pu.nombre, " ", pu.apPaterno), "MOZO") as mozo
            ',false);
        $this->db->from('ventas v');
        $this->db->join('persona p','p.idPersona = v.idPersona','left');
        $this->db->join('usuario u','u.idUsuario = v.usuCrea','left');
        $this->db->join('persona pu','pu.idPersona = u.idPersona','left');
        $this->db->where('v.idVenta', $idVenta);


        $q = $this->db->get();
        if ($q->num_rows() != 1)
            return false;

        $c = $q->result();
        $venta = $c[0];
        if (!$venta->esDelivery) {
            $venta->mesa = $this->getMesasVenta($venta->id);
        }
        $venta->productos = $this->getDetailsVenta($venta->id);
        return $venta;
    }

    public function getMesasVenta($id){
        $mesas = array();
        $this->db->select('idMesa');
        $this->db->from('mesas_venta');
        $this->db->where('idVenta', $id);
        $r = $this->db->get()->result();
        foreach ($r as $mesa) {
            $mesas[] = $mesa->idMesa;
        }
        return $mesas;
    }

    public function checkTableAvilable($idVenta, $mesas){
        $this->db->select('count(1) total');
        $this->db->from('ventas v');
        $this->db->join('mesas_venta as mv','mv.idVenta = v.idVenta');
        $this->db->where('v.estado =', 0);
        $this->db->where('v.idVenta !=', (int) $idVenta);
        $this->db->where_in('mv.idMesa', $mesas);
        $r = $this->db->get()->result();

        return $r[0]->total == 0;
        
    }

    public function cancelVenta($id){
        $q = 'UPDATE ventas SET estado = 1 WHERE idVenta = ?';
        $this->db->query($q, array($id));
        return $this->db->affected_rows();
    }

    public function getDetailsVenta($idVenta){
        $this->db->select('ps.idProductoSucursal as id, pr.nombre as name, pr.destino as dest, dv.cant, dv.cant as req, dv.pUnit as price, dv.observacion as detalle');
        $this->db->from('detalle_venta as dv');
        $this->db->join('producto_sucursal as ps','dv.idProductoSucursal = ps.idProductoSucursal');
        $this->db->join('producto as pr','ps.idProducto = pr.idProducto');
        $this->db->where('idVenta', $idVenta);
        $this->db->group_by('ps.idProductoSucursal'); //se supone que no va.. litokurt
        $q = $this->db->get();
        return $q->result();
    }

    public function getPedidosBySucursal($idSucursal){
        $this->db->select('v.idVenta as id, mv.idMesa,v.usuCrea, DATE_FORMAT(v.fecCrea,"%h:%i %p") fecHora', false);
        $this->db->from('ventas as v');
        $this->db->join('mesas_venta as mv','v.idVenta = mv.idVenta');
        $this->db->where('idSucursal', $idSucursal);
        $this->db->where('estado', 0);
        $this->db->where('esDelivery', 0);
        $q = $this->db->get();
        return $q->result();
    }

    public function getDeliverysBySucursal($idSucursal){
        $this->db->select('v.idVenta as id, v.descripcion');
        $this->db->from('ventas as v');
        $this->db->where('idSucursal', $idSucursal);
        $this->db->where('estado', 0);
        $this->db->where('esDelivery', 1);
        $q = $this->db->get();
        return $q->result();
    }

    public function getTotal($idPedido){
        $this->db->select('sum(pTotal) as total');
        $this->db->from('detalle_venta');
        $this->db->where('idVenta', $idPedido);
        $q = $this->db->get();
        $r = $q->result();
        return $r[0]->total;
    }

    public function pay($data){
        $data['fecVenta'] = date_format(new DateTime(), 'Y-m-d H:i:s');
        $monto_dsct = $data['total'] * (1 - $data['dsct'] / 100);

        $igv = round($monto_dsct * 0.18, 2); /* litokurt **************************************************************** IGV*/
        $monto = $monto_dsct - $igv;
        $fecVenta = date_format(new DateTime(), 'Y-m-d H:i:s');
        $usuCajero = $this->session->userdata('s_idUsuario');

        $q = 'UPDATE ventas 
            SET estado = 2, 
                numVenta = ?, 
                numVentaGenerado = ?, 
                idTipoRecibo = ?, 
                numRecibo = ?, 
                idPersona = ?, 
                fecVenta = ?, 
                monto = ?, 
                igv = ?, 
                total = ?, 
                dsct = ?,
                propina = ?,
                usuCajero = ? 
            WHERE idVenta = ? AND estado = 0 AND idSucursal = ?';
        $this->db->query($q, array($data['numVenta'], $data['numVentaGenerado'], $data['idTipoRecibo'], $data['numRecibo'], $data['idPersona'], $fecVenta, $monto, $igv, $data['total'], $data['dsct'], $data['propina'], $usuCajero, $data['pedidoId'], $data['idSucursal']));
        return $this->db->affected_rows();
    }

    public function countBySucursal($idSucursal){
        $this->db->select('count(1) ventas');
        $this->db->from('ventas');
        $this->db->where('idSucursal',$idSucursal);
        $this->db->where('estado',2);
        $q = $this->db->get();
        $c = $q->result();
        return $c[0]->ventas;
    }

    public function addKardex($parms){
        $q = 'INSERT INTO kardex_caja (idCaja, idSucursal, idTipMovCaja, idOperacion, monto, tipoPago, usuCrea, fecha, saldo) 
            SELECT ?, ?, ?, ?, ?, ?, ?, ?, 
            (select COALESCE(min(q.saldo),0) + ? from (select saldo from kardex_caja WHERE idCaja = ? ORDER BY kardex_caja.idKardexCaja DESC LIMIT 1) as q)
            FROM  dual';

        $this->db->query($q, 
                array($parms['idCaja'], 
                        $parms['idSucursal'], 
                        $parms['idTipMovCaja'], 
                        $parms['idOperacion'], 
                        $parms['monto'], 
                        $parms['tipoPago'], 
                        $this->session->userdata('s_idUsuario'), 
                        date_format(new DateTime(), 'Y-m-d H:i:s'), 
                        $parms['var'], 
                        $parms['idCaja']
                    )
            );
        
        return $this->db->affected_rows();
    }

    public function updateDelivery($id, $descripcion, $indicaciones) {
        $q = 'UPDATE ventas SET descripcion = ?, indicaciones = ? WHERE idVenta = ?';
        $this->db->query($q, array($descripcion, $indicaciones, $id));
        return $this->db->affected_rows();
    }

    public function isOpen($idVenta){
        $q = 'SELECT estado from ventas where idVenta = ? limit 1';
        $r = $this->db->query($q, array($idVenta));
        if ($r->num_rows() != 1)
            return false;
        $row = $r->result();
        return $row[0]->estado == 0;
    }

    public function isDelivery($idVenta){
        $q = 'SELECT esDelivery from ventas where idVenta = ? limit 1';
        $r = $this->db->query($q, array($idVenta));
        if ($r->num_rows() != 1)
            return false;
        $row = $r->result();
        return $row[0]->esDelivery == 1;
    }

    // public function getVentasBySucursal($idS,$fecIni,$fecFin,$start,$length,$search){
    //     $srch = "";
    //     if ($search) {
    //         $srch.=" AND ( v.numVentaGenerado LIKE '%".$search."%' ";    
    //         $srch.=" OR v.numRecibo LIKE '%".$search."%' ";
    //         $srch.=" OR CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) LIKE '%".$search."%' ";
    //         $srch.=" OR DATE_FORMAT(v.fecVenta,'%d/%m/%Y %h:%i %p') LIKE '%".$search."%' ";
    //         $srch.=" OR tr.descripcion LIKE '%".$search."%' ";
    //         $srch.=" OR v.total LIKE '%".$search."%' ";
    //         $srch.=" OR CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) LIKE '%".$search."%' )";
    //     }

    //     $nr = "
    //         SELECT COUNT(1) cant
    //         FROM ventas v
    //         JOIN persona p ON p.idPersona = v.idPersona 
    //         JOIN usuario u ON u.idUsuario = v.usuCrea 
    //         JOIN persona per ON per.idPersona = u.idPersona 
    //         JOIN tipo_recibo tr ON tr.idTipoRecibo = v.idTipoRecibo  
    //         WHERE v.idSucursal = $idS
    //     ".$srch;
    //     $nr = $this->db->query($nr);
    //     $nr = $nr->row();
    //     $nr = $nr->cant;

    //     $q = "
    //         SELECT @rownum:=@rownum+1 AS rownum, v.numVentaGenerado, v.numRecibo,
    //             CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS cliente,
    //             DATE_FORMAT(v.fecVenta,'%d/%m/%Y %h:%i %p') fecVenta,
    //             tr.descripcion,
    //             v.total,
    //             CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) empleado,
    //             v.idVenta
    //         FROM (SELECT @rownum:=0) f, ventas v
    //         INNER JOIN persona p ON p.idPersona = v.idPersona 
    //         INNER JOIN usuario u ON u.idUsuario = v.usuCrea 
    //         INNER JOIN persona per ON per.idPersona = u.idPersona 
    //         INNER JOIN tipo_recibo tr ON tr.idTipoRecibo = v.idTipoRecibo 
    //         WHERE v.idSucursal = $idS
    //         order by v.idVenta desc
            
    //     ".$srch." LIMIT $start, $length ";

    //     //$consulta = $this->db->get();
    //     $consulta = $this->db->query($q);
    //     // $c = $consulta

    //     $res = array(
    //         'datos' => $consulta,
    //         'numdata' => $nr,
    //         'consulta' => $q
    //         );

    //     return $res;
    //     // return $consulta;
    // }


    public function getVentasBySucursal($idS,$fecIni,$fecFin){
        // echo '<pre>'; print_r($fecFin); echo '</pre>';
        // // echo '<pre>'; print_r($fecIni); echo '</pre>';
        // echo '<pre>'; print_r($idS); echo '</pre>';
       
        // $q = "
        //     SELECT @rownum:=@rownum+1 AS rownum, 
        //     v.numVentaGenerado, 
        //     v.numRecibo,
        //         CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS cliente,
        //         DATE_FORMAT(v.fecVenta,'%d/%m/%Y %h:%i %p') fecVenta,
        //         tr.descripcion,
        //         v.total,
        //         CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) empleado,
        //         v.idVenta,v.propina
        //     FROM (SELECT @rownum:=0) f, ventas v
        //     INNER JOIN persona p ON p.idPersona = v.idPersona 
        //     INNER JOIN usuario u ON u.idUsuario = v.usuCrea 
        //     INNER JOIN persona per ON per.idPersona = u.idPersona 
        //     INNER JOIN tipo_recibo tr ON tr.idTipoRecibo = v.idTipoRecibo 
        //     WHERE v.idSucursal = $idS
        //     AND DATE(v.fecVenta) BETWEEN '$fecIni' AND '$fecFin'
        //     order by v.total desc ";


         $q = "
            SELECT '*' AS rownum, 
            v.numVentaGenerado, 
            v.numRecibo,
                CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS cliente,
                DATE_FORMAT(v.fecVenta,'%d/%m/%Y %h:%i %p') fecVenta,
                tr.descripcion,
                v.total,
                CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) empleado,
                v.idVenta,v.propina
            FROM ventas v
            INNER JOIN persona p ON p.idPersona = v.idPersona 
            INNER JOIN usuario u ON u.idUsuario = v.usuCrea 
            INNER JOIN persona per ON per.idPersona = u.idPersona 
            INNER JOIN tipo_recibo tr ON tr.idTipoRecibo = v.idTipoRecibo 
            WHERE v.idSucursal = $idS
            AND DATE(v.fecVenta) BETWEEN '$fecIni' AND '$fecFin'
            order by v.fecVenta desc ";

        $consulta = $this->db->query($q);
        
        return $consulta->result();
    }

    public function getVentas($idS,$fecIni,$fecFin){
        $q = "
            SELECT @rownum:=@rownum+1 AS N, v.numVentaGenerado 'Numero Venta', CONCAT(p.apPaterno,' ',p.apMaterno,', ',p.nombre) AS cliente,
                DATE_FORMAT(v.fecVenta,'%d/%m/%Y %h:%i %p') 'Fecha de la Venta',
                
                v.monto 'Sub Total',
                v.igv Impuesto,
                v.dsct Descuento, 
                v.total Total,
                CONCAT(per.nombre,', ' ,per.apPaterno,' ',per.apMaterno) Mesero,
                v.propina 'Propina del Mesero'
            FROM (SELECT @rownum:=0) f, ventas v
            INNER JOIN persona p ON p.idPersona = v.idPersona 
            INNER JOIN usuario u ON u.idUsuario = v.usuCrea 
            INNER JOIN persona per ON per.idPersona = u.idPersona 
            INNER JOIN tipo_recibo tr ON tr.idTipoRecibo = v.idTipoRecibo 
            WHERE v.idSucursal = $idS
            AND DATE(v.fecVenta) BETWEEN '$fecIni' AND '$fecFin'
            order by v.fecVenta desc
            
        ";

        $consulta = $this->db->query($q);
        return $consulta;
    }

    public function getDetalleVenta($id){
        $this->db->select("pro.nombre,
                            dv.cant,
                            dv.pUnit,
                            dv.pTotal",false);
        $this->db->from('detalle_venta dv');
        $this->db->join('producto_sucursal ps','ps.idProductoSucursal = dv.idProductoSucursal');
        $this->db->join('producto pro','pro.idProducto = ps.idProducto');
        $this->db->where('dv.idVenta',$id);

        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function divideVenta($from, $items){
        $this->db->select("idSucursal, mesa, usuCrea",false);
        $this->db->from('ventas');
        $this->db->where('idVenta',$from);
        $r = $this->db->get()->result();

        $to = $this->createDividida(array(
                'idSucursal' => $r[0]->idSucursal,
                'mesa' => $r[0]->mesa,
                'estado' => 0,
                'usuCrea' => $r[0]->usuCrea,
                ));
        if ($to === false) {
            return false;
        }

        $q = 'INSERT INTO mesas_venta
            SELECT 
                null,
                idMesa,
                ? idVenta
                FROM mesas_venta 
                WHERE idVenta = ?';
        $this->db->query($q, array($to, $from));

        foreach ($items as $idProducto => $cant) {
            // Remove from original order
            $q = 'UPDATE detalle_venta 
            SET 
            cant  = cant - ?,
            pTotal = pTotal - (? * pUnit)
            WHERE idVenta = ? AND idProductoSucursal = ?';
            $this->db->query($q, array($cant, $cant, $from, $idProducto));
            //$this->db->affected_rows();

            // Add item to new order
            $q = 'INSERT INTO detalle_venta
                SELECT 
                    ? idVenta,
                    idProductoSucursal,
                    ? cant,
                    pUnit,
                    ? * pUnit  pTotal,
                    null observacion,
                    actualizado
                    FROM detalle_venta 
                    WHERE idVenta = ? AND idProductoSucursal = ?';
            $this->db->query($q, array($to, $cant, $cant, $from, $idProducto));
            //return $this->db->affected_rows();
        }

        return ['id' => $to, 'mesa' => $r[0]->mesa];

    }
}