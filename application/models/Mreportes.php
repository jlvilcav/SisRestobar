<?php
/**
* 
*/
class Mreportes extends CI_Model
{
	
	public function repVentasByDate($idS,$fecIni,$fecFin){
   //      $this->db->select("@rownum:=@rownum+1 AS rownum,
			// DATE_FORMAT(fecVenta,'%d/%m/%Y') fecVenta,
   //          SUM(total) total",false);
   //      $this->db->from('(SELECT @rownum:=0) f, ventas',false);
   //      $this->db->where('idSucursal',$idS);
   //      $this->db->where('fecVenta BETWEEN "'.$fecIni.' 00:00:00" AND "'.$fecFin.' 23:59:59"');
   //      $this->db->group_by("DATE_FORMAT(fecVenta,'%d/%m/%Y')",false);
   //      $this->db->order_by("DATE_FORMAT(fecVenta,'%Y')",'asc',false);
   //      $this->db->order_by("DATE_FORMAT(fecVenta,'%m')",false);
   //      $this->db->order_by("DATE_FORMAT(fecVenta,'%d')",false);

        $consulta = $this->db->query("SELECT @rownum:=@rownum+1 AS rownum, COUNT(1) totVentas,
			DATE_FORMAT(fecVenta,'%d/%m/%Y') fecVenta,
            ROUND(SUM(total - (dsct/100)*total),2) total

        FROM (SELECT @rownum:=0) f, ventas
        WHERE idSucursal = $idS 
        AND fecVenta IS NOT NULL
        AND estado = 2
        AND fecVenta BETWEEN '$fecIni 00:00:00' AND '$fecFin 23:59:59' 
        
        GROUP BY DATE_FORMAT(fecVenta,'%d/%m/%Y')
        ORDER BY DATE_FORMAT(fecVenta,'%Y') ASC
        ,DATE_FORMAT(fecVenta,'%m')
        ,DATE_FORMAT(fecVenta,'%d') ",false);

        // $consulta = $this->db->get();
        return $consulta->result();
  }

    public function getAperturaCierre(){
        $idSucursal = $this->session->userdata('s_idSucursal');

        $consulta = $this->db->query(
            "SELECT 
            acc.idAperturaCierre,
            acc.idCaja,
            cs.descripcion,
            acc.idSucursal,
            acc.monto,
            DATE_FORMAT(acc.fecApertura,'%d/%m/%Y %H:%i:%s') fecApertura,
            acc.estado,

            (SELECT ap.idAperturaCierre 
            FROM apertura_cierre_caja ap
            WHERE ap.idSucursal = $idSucursal AND ap.estado = 'C'
            AND ap.idCaja = acc.idCaja
            AND ap.idAperturaCierre > acc.idAperturaCierre
            LIMIT 1) AS idCierre

            ,
            (SELECT ap.monto 
            FROM apertura_cierre_caja ap
            WHERE ap.idSucursal = $idSucursal AND ap.estado = 'C'
            AND ap.idCaja = acc.idCaja
            AND ap.idAperturaCierre > acc.idAperturaCierre
            LIMIT 1) AS cierreMonto

            ,
            (SELECT DATE_FORMAT(ap.fecApertura,'%d/%m/%Y %H:%i:%s')
            FROM apertura_cierre_caja ap
            WHERE ap.idSucursal = $idSucursal AND ap.estado = 'C'
            AND ap.idCaja = acc.idCaja
            AND ap.idAperturaCierre > acc.idAperturaCierre
            LIMIT 1) AS fecCierre

            FROM apertura_cierre_caja acc
            INNER JOIN caja_sucursal cs ON cs.idCaja = acc.idCaja
            WHERE acc.idSucursal = $idSucursal AND acc.estado = 'A'
            ORDER BY acc.idAperturaCierre desc"
            );

        return $consulta->result();
    }

    //productos consumidos
    public function getProductosConsumidos($fa,$fc){
        $idSucursal = $this->session->userdata('s_idSucursal');

        $q = "
            SELECT SUM(dv.cant) cant, p.nombre FROM detalle_venta dv
            INNER JOIN producto_sucursal ps ON ps.idProductoSucursal = dv.idProductoSucursal
            INNER JOIN producto p ON p.idProducto = ps.idProducto
            WHERE idVenta IN (
                SELECT idVenta FROM ventas
                WHERE idSucursal = $idSucursal
                AND fecVenta BETWEEN '$fa' AND '$fc'
            )
            GROUP BY p.nombre
            ORDER BY p.nombre ASC
        ";

        $resultado = $this->db->query($q);
        return $resultado->result();
    }

    public function getInsConsumidos($fa,$fc){
        $idSucursal = $this->session->userdata('s_idSucursal');

        $q = "
            SELECT SUM(tot) totIns, descripcion, cantXMedida, cantMedXUnid, SUM(tot)/cantMedXUnid consumido, unidad FROM (
                SELECT dv.cant cant, p.nombre, 
                p.idProducto, ip.idInsumo, 
                i.descripcion, 
                ip.cantXMedida, 
                u.descripcion unidad,
                i.cantMedXUnid,
                dv.cant*ip.cantXMedida tot FROM detalle_venta dv
                INNER JOIN producto_sucursal ps ON ps.idProductoSucursal = dv.idProductoSucursal
                INNER JOIN producto p ON p.idProducto = ps.idProducto
                INNER JOIN insumo_producto ip ON ip.idProducto = p.idProducto
                INNER JOIN insumo i ON i.idInsumo = ip.idInsumo
                INNER JOIN unidad u ON u.idUnidad = i.idUnidad
                WHERE idVenta IN (

                    SELECT idVenta FROM ventas
                    WHERE idSucursal = $idSucursal
                    AND fecVenta  BETWEEN '$fa' AND '$fc'

                )

                AND cant > 0

            ) d
            GROUP BY descripcion
            ORDER BY descripcion
        ";

        $resultado = $this->db->query($q);
        return $resultado->result();
    }

    public function getStockIns(){
        $idSucursal = $this->session->userdata('s_idSucursal');
        $q = "
            SELECT @rownum:=@rownum+1 AS rownum, 
                isu.idInsumo, 
                i.descripcion insumo, 
                i.cantMedXUnid, 
                i.stockMinXMed minimo, 
                ROUND((i.stockMinXMed/i.cantMedXUnid),0) minUnidad, 
                isu.stockXMedida stock,
                FORMAT(isu.stockXMedida,2) stockXMedida,
                m.descripcion medida,
                FORMAT(isu.stockUnid,2) stockUnid,
                u.descripcion unidad             
            FROM (SELECT @rownum:=0) f, insumo_sucursal isu
            INNER JOIN insumo i ON i.idInsumo = isu.idInsumo
            INNER JOIN unidad u ON u.idUnidad = i.idUnidad
            INNER JOIN medida m ON m.idMedida = i.idMedida
            WHERE isu.idSucursal = $idSucursal
            ORDER BY i.descripcion
        ";
        
        $r = $this->db->query($q);
        return $r->result();
    }

    public function getTotalEfectivo($idS,$fecIni,$fecFin){
        $q = "SELECT 
            SUM(kc.monto)+acc.monto monto
            FROM  kardex_caja kc
            INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
            WHERE kc.tipoPago = 'EFECTIVO'
            AND acc.ultimo = 1 AND acc.idSucursal = $idS
            AND kc.fecha BETWEEN '$fecIni 00:00:00' AND '$fecFin 23:59:59'";

        $cons = $this->db->query($q);
        return $cons->row('monto');
    }

    public function getTotalVisa($idS,$fecIni,$fecFin){
        $q = "SELECT 
            SUM(kc.monto) monto
            FROM  kardex_caja kc
            INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
            WHERE kc.tipoPago = 'VISA'
            AND acc.ultimo = 1 AND acc.idSucursal = $idS
            AND kc.fecha BETWEEN '$fecIni 00:00:00' AND '$fecFin 23:59:59'";

        $cons = $this->db->query($q);
        return $cons->row('monto'); 
    }

    public function getTotalMastercard($idS,$fecIni,$fecFin){
        $q = "SELECT 
            SUM(kc.monto) monto
            FROM  kardex_caja kc
            INNER JOIN apertura_cierre_caja acc ON acc.idCaja = kc.idCaja
            WHERE kc.tipoPago = 'MASTERCARD'
            AND acc.ultimo = 1 AND acc.idSucursal = $idS
            AND kc.fecha BETWEEN '$fecIni 00:00:00' AND '$fecFin 23:59:59'";

        $cons = $this->db->query($q);
        return $cons->row('monto'); 
    }
}