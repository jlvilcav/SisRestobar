<?php
/**
* 
*/
class Mproducto extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function regCategProducto($cp){
		$campos = array(
			'descripcion' => str_replace("'", '’', $cp),
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'sitReg' => '1'
		);
		$this->db->insert('categoria_producto',$campos);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;	
		}else{
			return 0;
		}
	}

	public function getCategProducto(){
		$q = "SELECT * FROM categoria_producto where sitReg = 1 
			ORDER BY descripcion";

		$resultado = $this->db->query($q);
		return $resultado->result();
	}

	public function categProductoPorSucursal($idSucursal){
		$q = "SELECT cp.descripcion, p.idCategoriaProducto
			FROM producto p
			INNER JOIN producto_sucursal ps ON ps.idProducto = p.idProducto
			INNER JOIN categoria_producto cp ON cp.idCategoriaProducto = p.idCategoriaProducto
			WHERE ps.idSucursal = ?
			AND ps.sitReg = 1
			GROUP BY p.idCategoriaProducto, cp.descripcion";

		$resultado = $this->db->query($q, array($idSucursal));
		return $resultado->result();
	}

	function regProducto($data)
	{
		$campos = array(
			'nombre'=> str_replace("'", '’', $data['nombre']),
			'idCategoriaProducto'=> $data['categoriaId'],
			'precioSugeridoVenta' => $data['precio'],
			'imagen' => $data['imagen'],
			'destino' => $data['destino'],
			'usuCrea' => $this->session->userdata('s_idUsuario'),
			'fecCrea' => date_format(new DateTime(), 'Y-m-d H:i:s'),
			'sitReg' => '1'
		);
		$this->db->insert('producto',$campos);
		$id = $this->db->insert_id();
		if ($id > 0 ) {
			return $id;	
		}else{
			return 0;
		}
	}

	function addInsumo($data)
	{
		$data['usuCrea'] = $this->session->userdata('s_idUsuario');
		$data['fecCrea'] = date_format(new DateTime(), 'Y-m-d H:i:s');

		$this->db->insert('insumo_producto',$data);
	}

	function addSucursal($data)
	{
		$this->db->insert('producto_sucursal',$data);
	}

	function getProductsBySucursal($idSucursal){
		$this->db->select('ps.idProductoSucursal as id, p.nombre as name, p.destino as dest, p.imagen as image, p.idCategoriaProducto as categoryId, ps.precioVenta as price');
		$this->db->from('producto_sucursal as ps');
		$this->db->join('producto p','ps.idProducto=p.idProducto');
		$this->db->where('idSucursal',$idSucursal);
		$this->db->where('ps.sitReg',1);
		$cons = $this->db->get();

		return $cons->result();
	}

	function getProductsById($idProd){
		$this->db->select('ps.idProductoSucursal as id, p.nombre as name, p.destino as dest, p.imagen as image, p.idCategoriaProducto as categoryId, ps.precioVenta as price, cp.descripcion catProd');
		$this->db->from('producto_sucursal as ps');
		$this->db->join('producto p','ps.idProducto=p.idProducto');
		$this->db->join('categoria_producto cp','cp.idCategoriaProducto = p.idCategoriaProducto');
		$this->db->where('p.idProducto',$idProd);
		$this->db->where('ps.sitReg',1);
		$cons = $this->db->get();

		return $cons->row();
	}

	function getInsumosForProductsSucursal($products){
		$this->db->select('ps.idProductoSucursal as id, p.nombre as name,ip.idInsumo,ip.cantXMedida cant, ins.descripcion nominsumo');
		$this->db->from('producto_sucursal as ps');
		$this->db->join('producto p','ps.idProducto=p.idProducto');
		$this->db->join('insumo_producto ip','p.idProducto=ip.idProducto');
		$this->db->join('insumo ins','ins.idInsumo=ip.idInsumo');
		$this->db->where_in('ps.idProductoSucursal', $products);
		$cons = $this->db->get();

		return $cons->result();
	}

	public function getProductoBySucursal($idS){
		$this->db->select('@rownum:=@rownum+1 AS rownum,ps.idProductoSucursal, ps.idSucursal, ps.idProducto, p.nombre, cp.descripcion, ps.precioVenta, p.destino, p.imagen, ps.sitReg',false);
		$this->db->from('(SELECT @rownum:=0) f,producto_sucursal ps',false);
		$this->db->join('producto p','p.idProducto = ps.idProducto');
		$this->db->join('categoria_producto cp','cp.idCategoriaProducto = p.idCategoriaProducto');
		$this->db->where('ps.idSucursal',$idS);
		$this->db->where('ps.sitReg',1);
		$consulta = $this->db->get();

		return $consulta;
	}

	public function getDetalleProducto($idP){//getInsumoPorProducto
		$this->db->select('i.idInsumo,i.descripcion desIns,ip.cantXMedida,m.descripcion desMed');
		$this->db->from('insumo_producto ip');
		$this->db->join('insumo i','i.idInsumo = ip.idInsumo');
		$this->db->join('medida m','m.idMedida = i.idMedida');
		$this->db->where('ip.idProducto',$idP);
		//$this->db->where('ps.sitReg',1);
		$consulta = $this->db->get();

		return $consulta->result();	
	}

	public function updateProducto($param){
		//actualizo el nombre en la tabla producto
		$data = array(
            'nombre' => str_replace("'", '’', $param['txtDetNomProducto']),
            'idCategoriaProducto' => $param['cboDetCatProducto'],
            'destino' => $param['cboDetDestProducto'],
            'imagen' => $param['fileDetImgProducto']
        );
        $this->db->where('idProducto', $param['txtDetIdProducto']);
        $this->db->update('producto', $data);


        //actualizo precio en la tabla producto_sucursal
        $data = array(
            'precioVenta' => $param['txtDetPrecProducto'],
            'sitReg' => $param['chkEstado']
        );
        $this->db->where('idProducto', $param['txtDetIdProducto']);
        $this->db->where('idSucursal', $param['hdnIdSucursal']);
        $this->db->update('producto_sucursal', $data);

        return 1;
	}

	public function updCatProd($param){
        $campos = array(
            'descripcion' => str_replace("'", '’', $param['mtxtNomCatProd'])
            );

        $this->db->where('idCategoriaProducto', $param['mhdnIdCatProd']);
        $this->db->update('categoria_producto', $campos); 

        if ($this->db->affected_rows() == 1) {
        	return 1;
        }else{
        	return 0;
        }
    }

    //eliminar insumo del producto
	public function delInsFromProd($idProd,$idIns){
		$this->db->where('idProducto', $idProd);
		$this->db->where('idInsumo', $idIns);
		$this->db->delete('insumo_producto'); 
		return $this->db->affected_rows() > 0;
	}

	//agregar insumo al producto
	public function addInsToProd($idProd,$idIns,$cantIns){
		$campos = array(
			'idProducto' => $idProd,
			'idInsumo' => $idIns,
			'cantXMedida' => $cantIns,
			'usuCrea' => $this->session->userdata('s_idUsuario')
			);

		$this->db->insert('insumo_producto',$campos);

		return 1;
	}

	public function delProducto($idSucursal,$idProducto){
		$campos = array(
			'sitReg' => 0,
			);

		$this->db->where('idProducto',$idProducto);
		$this->db->where('idSucursal',$idSucursal);
		$this->db->update('producto_sucursal',$campos);

		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		}else{
			return 0;
		}
	}
}