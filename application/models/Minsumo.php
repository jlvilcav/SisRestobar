<?php
/**
* 
*/
class Minsumo extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    function regCategInsumo($ci){
        $campos = array(
            'descripcion'=>$ci,
            'usuCrea' => $this->session->userdata('s_idUsuario'),
            'sitReg' => '1'
        );
        $this->db->insert('categoria_insumo',$campos);
        $id = $this->db->insert_id();
        if ($id > 0 ) {
            return $id; 
        }else{
            return 0;
        }
    }

    function getInsumos($idSucursal){
        $this->db->select('isu.idInsumo,isu.precioSucursal,isu.stockUnid,isu.stockUnid,isu.stockMinXMed,
            i.descripcion, ci.descripcion categinsumo, u.descripcion und, m.descripcion med, i.cantMedXUnid');
        $this->db->from('insumo_sucursal as isu');
        $this->db->join('insumo i','i.idInsumo=isu.idInsumo');
        $this->db->join('categoria_insumo ci','ci.idCategoriaInsumo=i.idCategoriaInsumo');
        $this->db->join('unidad u','u.idUnidad=i.idUnidad');
        $this->db->join('medida m','m.idMedida=i.idMedida');
        $this->db->where('idSucursal',$idSucursal);

        $cons = $this->db->get();

        return $cons->result();
    }

    function getInsumoById($idIns){
        $this->db->select('i.idInsumo, i.descripcion, ci.descripcion AS categinsumo, u.descripcion AS und, m.descripcion AS med, i.cantMedXUnid, i.stockMinXMed, i.precioSugerido',true);
        $this->db->from('insumo AS i');
        $this->db->join('categoria_insumo ci','ci.idCategoriaInsumo=i.idCategoriaInsumo');
        $this->db->join('unidad u','u.idUnidad=i.idUnidad');
        $this->db->join('medida m','m.idMedida=i.idMedida');
        $this->db->where('i.idInsumo',$idIns);

        $cons = $this->db->get();

        if ($cons->num_rows() > 0) {
            return $cons->row();
        }else{
            return false;
        }
    }

    function getInsumoNuevo($insumos = array()){
        $this->db->select('i.idInsumo, i.descripcion, ci.idCategoriaInsumo, ci.descripcion AS categinsumo, u.idUnidad, u.descripcion AS und, m.idMedida, m.descripcion AS med, i.cantMedXUnid, i.stockMinXMed, i.precioSugerido',true);
        $this->db->from('insumo AS i');
        $this->db->join('categoria_insumo ci','ci.idCategoriaInsumo=i.idCategoriaInsumo');
        $this->db->join('unidad u','u.idUnidad=i.idUnidad');
        $this->db->join('medida m','m.idMedida=i.idMedida');

        if (sizeof($insumos) != 0)
            $this->db->where_not_in('idInsumo',$insumos);

        $cons = $this->db->get();

        if ($cons->num_rows() > 0) {
            return $cons->result();
        }else{
            return false;
        }
    }

    function regInsumo($param){
        $campos = array(
            'descripcion' => $param['txtInsumo'],
            'idCategoriaInsumo' => $param['cboCategInsumo'],
            'idUnidad' => $param['cboUnidad'],
            'idMedida' => $param['cboMedida'],
            'cantMedXUnid' => $param['txtCantXMedida'],
            'stockMinXMed' => $param['txtStockMin'],
            'precioSugerido' => $param['txtPrecSugerido'],
            'usuCrea' => $this->session->userdata('s_idUsuario'),
            'sitReg' => '1'
        );
        $this->db->insert('insumo',$campos);
        $id = $this->db->insert_id();
        if ($id > 0 ) {
            return $id; 
        }else{
            return 0;
        }
    }

    function getInsumoBySucursal($idInsumo, $idSucursal)
    {
        $this->db->select('idInsumoSucursal');
        $this->db->from('insumo_sucursal');
        $this->db->where('idSucursal',$idSucursal);
        $this->db->where('idInsumo',$idInsumo);
        $cons = $this->db->get();
        if ($cons->num_rows() == 1) {
            $q = $cons->result();
            return $q[0]->idInsumoSucursal;
        }else{
            return false;
        }
    }

    function addInsumoBySucursal($param){
        $param['usuCrea'] = $this->session->userdata('s_idUsuario');
        $this->db->insert('insumo_sucursal',$param);
        $id = $this->db->insert_id();
        if ($id > 0 ) {
            return $id; 
        }else{
            return false;
        }
    }

    function updateInsumoBySucursal($data){
        $q = "UPDATE insumo_sucursal SET stockUnid = stockUnid + ? , stockXMedida = stockXMedida + ? , precioSucursal = ? WHERE idInsumoSucursal = ?";
        $this->db->query($q, array($data['stockUnid'],$data['stockXMedida'],$data['precioSucursal'],$data['idInsumoSucursal']));

    }

    function removeInsumoByProductoSucursal($productoId, $cant){
        $q = 'UPDATE insumo_sucursal insu
        join insumo_producto inpr on
        inpr.idInsumo = insu.idInsumo
        join producto_sucursal prsu on
        prsu.idProducto = inpr.idProducto
        SET
        insu.stockXMedida = insu.stockXMedida - (inpr.cantXMedida * ?),
        insu.stockUnid = round((insu.stockXMedida - (inpr.cantXMedida * ?)) / (select cantMedXUnid from insumo where idInsumo = insu.idInsumo),1)
        WHERE prsu.idProductoSucursal = ?
        AND
        insu.idSucursal = prsu.idSucursal';

        $this->db->query($q, array($cant,$cant,$productoId));


        //var_dump('$productoId', $productoId);
        //var_dump('$cant', $cant);

    }

    public function updCatIns($param){
        $campos = array(
            'descripcion' => $param['mtxtNomCatIns']
            );

        $this->db->where('idCategoriaInsumo', $param['mhdnIdCatIns']);
        $this->db->update('categoria_insumo', $campos); 

        return 1;
    }

    public function updInsumo($param){
        $campos = array(
            'descripcion' => $param['mtxtInsumo'],
            'idCategoriaInsumo' => $param['mcboCategInsumo'],
            'idUnidad' => $param['mcboUnidad'],
            'idMedida' => $param['mcboMedida'],
            'cantMedXUnid' => $param['mtxtCantXMedida'],
            'stockMinXMed' => $param['mtxtStockMin'],
            'precioSugerido' => $param['mtxtPrecSugerido'],
            'usuMod' => $this->session->userdata('s_idUsuario'),
        );
        
        $this->db->where('idInsumo',$param['mhdnIdInsumo']);
        $this->db->update('insumo',$campos);
        
        return $this->db->affected_rows();
        
    }
}