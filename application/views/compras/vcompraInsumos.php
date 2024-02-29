<div class="row">
  <!-- left column -->
  <div class="col-md-8">
    <div class="box box-info">
    <div style="border: 1px #CCC solid;">
      <!--Busqueda-->
      <div class="box-header with-border">
          <h3 class="box-title">COMPRA</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="cartForm">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="txtObservacion">Insumo</label>
              <div class="col-sm-10"> 
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Insumo..." id="descripcionInsumo" name="descripcionInsumo"  readonly="readonly">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalBuscarInsumo"><i class="fa fa-fw fa-external-link-square"></i></button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-5">
                <label class="control-label">Cntd.</label>
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" id="cntd" name="cntd">
                  <span class="input-group-addon" id="txtUnidad">UNIDAD</span>
                  <input type="hidden" id="unidad" name="unidad" />
                </div>
              </div>
              <div class="col-sm-3">
                <label class="control-label">Prec.unid.</label>
                <div class="input-group-sm">
                  <input type="text" id="prunit" name="prunit" class="form-control">
                </div>
              </div>
              <div class="col-sm-2">
                <label class="control-label">Stock</label>
                <div class="input-group-sm">
                  <input type="text" id="stock" class="form-control" disabled="disabled">
                </div>
              </div>
            </div>
            <div class="text-right">
              <button class="btn btn-primary" type="submit" id="btnAgregarCarrito"><i class="fa fa-fw fa-shopping-cart"></i> Agregar</button>
              <button class="btn btn-danger" id="btnCleanForm" type="button">Cancelar</button>
            </div>
        </div>
        <input type="hidden" id="idInsumo" name="idInsumo" />
        <input type="hidden" id="cantMedXUnid" name="cantMedXUnid" />
        <input type="hidden" id="stockMinXMed" name="stockMinXMed" />
      </form>
    </div>
    </div>
    <div class="box box-info">
      <div style="border: 1px #CCC solid;">
        <div class="box-header with-border">
            <h3 class="box-title">CARRO DE COMPRA</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="tblCanastaInsumos" class="display compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th style="width: 5%;background-color: #0E759D;color: white;"></th>
                      <th style="width: 35%;background-color: #0E759D;color: white;">Nombre</th>
                      <th style="width: 10%;background-color: #0E759D;color: white;">Unidad</th>
                      <th style="width: 10%;background-color: #0E759D;color: white;">Cant</th>
                      <th style="width: 10%;background-color: #0E759D;color: white;">PCostro</th>
                      <th style="width: 10%;background-color: #0E759D;color: white;">PTotal</th>
                      <th style="width: 10%;background-color: #0E759D;color: white;">Accion</th>
                  </tr>
              </thead>
              <tbody></tbody>
            </table>
            <div class="text-right" style="padding-top: 10px;">
              <button class="btn btn-danger" id="btnLimpiarCesta" type="button">Limpiar Compra</button>
            </div>
          </div>
      </div>
    </div>
  </div>

  <!-- rigth column -->
  <div class="col-md-4">
    <div class="box box-info">
      <div style="border: 1px #CCC solid;">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
            <div class="info-box-content">
              <label style="font-size: 35pt;"><?php echo $this->session->userdata('its_rb_s_simbolomoneda');?> <span id="total"></span></label>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      <form id="formCompra" class="form-horizontal" style="margin-bottom:0px;">
          <div class="box-body">
            <div class="form-group" style="margin-bottom:5px;">
                <label class="col-sm-3 control-label" for="txtObservacion">Compra</label>
                  <div class="col-sm-9">
                    <div class="input-group-sm">
                      <input type="text" id="idCompra" class="form-control" value="" disabled="disabled">
                    </div>
                  </div>
              </div>

              <div class="form-group" style="margin-bottom:5px;">
                <label for="txtNomSucursal" class="col-sm-3 control-label">Proveedor</label>
                <div class="col-sm-9">
                    <select class="form-control" name="proveedorId">
                      <?php foreach ($proveedores as $prov) {?>
                        <option value="<?php echo $prov->idProveedor;?>" <?php if($prov->idProveedor == 1): ?> selected="selected" <?php endif ?>><?php echo $prov->razonSocial;?></option>
                      <?php } ?>
                    </select>
                <?php /*
                  <div class="input-group input-group-sm">
              <input type="text" name="txtDNI" class="form-control">
              <span class="input-group-btn">
              <button class="btn btn-info btn-flat" type="button"><i class="fa fa-fw fa-search"></i></button>
              </span>
                  </div><!-- /input-group -->
            */?>
                </div>
              </div>

              <div class="form-group" style="margin-bottom:5px;">
                  <label class="col-sm-3 control-label">Recibo</label>
                  <div class="col-sm-9">
                    <div class="form-group" style="margin-bottom:5px;">
                      <div class="col-sm-5">
                        <select class="form-control" name="tipoReciboId">
                        <?php foreach ($recibos as $rec) {?>
                          <option value="<?php echo $rec->idTipoRecibo;?>"><?php echo $rec->descripcion;?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <div class="col-sm-7">
                    <input type="text" name="nroRecibo" class="form-control" placeholder="N° Recibo">
                  </div>
                </div>
                  </div>
                </div>
              
              <div class="box box-info">
              <div class="form-group" style="margin-bottom:5px;">
                <label class="col-sm-6 control-label" for="txtObservacion">Valor</label>
                <label class="col-sm-6 control-label" for="txtObservacion"><span id="subtotal"></span></label>
            <label class="col-sm-6 control-label" for="txtObservacion">I.G.V.</label>
                <label class="col-sm-6 control-label" for="txtObservacion"><span id="igv"></span></label>
                <label class="col-sm-12 control-label" for="txtObservacion"></label>
              </div>
              </div>
          </div>
        <div class="bg-gray" style="height: 50px;">
              <div class="info-box-content">
                <label class="col-sm-5 control-label" for="txtObservacion" style="font-size: 15pt;">Total:</label>
              <label class="col-sm-7 control-label" for="txtObservacion" style="font-size: 15pt;"><?php echo $this->session->userdata('its_rb_s_simbolomoneda');?> <span id="total2"></span></label>
              </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
          <div class="text-right" style="padding: 10px;">
            <input type="submit" value="Guardar" class="btn btn-primary btn-lg" />
          </div>
      </form>
      </div>
    </div>
  </div>
</div>










<!-- :: modalBuscarInsumo :: -->
<div class="modal fade" id="modalBuscarInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Busqueda de Insumos</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
          <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Insumos</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Nuevos</a></li>
                  <!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box-body no-padding box-primary">
                <table id="tblBuscarInsumo" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style='width: 20%'>Insumo</th>
                      <th style='width: 20%'>Categoria</th>
                      <th style='width: 15%'>Unidad</th>
                      <th style='width: 10%'>Medida</th>
                      <th style='width: 20%'>Cant. Med.</th>
                      <th style='width: 15%'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if (!empty($listInsumos)) {
                        foreach ($listInsumos as $li) { ?>
                          <tr id="insumo<?php echo $li->idInsumo;?>" data-id="<?php echo $li->idInsumo;?>" data-descripcion="<?php echo $li->descripcion; ?>" data-unidad="<?php echo $li->und; ?>" data-precio="<?php echo $li->precioSucursal; ?>" data-cantmedxunid="<?php echo $li->cantMedXUnid; ?>" data-stockminxmed="<?php echo $li->stockMinXMed; ?>" data-stock="<?php echo $li->stockUnid;?> <?php echo $li->und;?>">
                            <td><?php echo $li->descripcion; ?></td>
                            <td><?php echo $li->categinsumo; ?></td>
                            <td><?php echo $li->und; ?></td>
                            <td><?php echo $li->med; ?></td>
                            <td><?php echo $li->cantMedXUnid; ?></td>
                            <td>
                              <a class="btn btn-block btn-default btn-xs selInsumo" data-id="insumo<?php echo $li->idInsumo;?>">ok</a>
                            </td>
                          </tr>
                    <?php
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <div class="box-body no-padding box-primary">
                <table id="tblBuscarInsumoNuevo" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style='width: 20%'>Insumo</th>
                      <th style='width: 20%'>Categoria</th>
                      <th style='width: 15%'>Unidad</th>
                      <th style='width: 10%'>Medida</th>
                      <th style='width: 20%'>Cant. Med.</th>
                      <th style='width: 20%'>Precio</th>
                      <th style='width: 15%'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if (!empty($listInsumoNuevo)) {
                        foreach ($listInsumoNuevo as $li) { ?>
                          <tr id="insumoNuevo<?php echo $li->idInsumo;?>" data-id="<?php echo $li->idInsumo;?>" data-descripcion="<?php echo $li->descripcion; ?>" data-unidad="<?php echo $li->und; ?>" data-precio="<?php echo $li->precioSugerido; ?>" data-cantmedxunid="<?php echo $li->cantMedXUnid; ?>" data-stockminxmed="<?php echo $li->stockMinXMed; ?>">
                            <td><?php echo $li->descripcion; ?></td>
                            <td><?php echo $li->categinsumo; ?></td>
                            <td><?php echo $li->und; ?></td>
                            <td><?php echo $li->med; ?></td>
                            <td><?php echo $li->cantMedXUnid; ?></td>
                            <td><?php echo $li->precioSugerido; ?></td>
                            <td>
                              <a class="btn btn-block btn-default btn-xs selInsumo" data-id="insumoNuevo<?php echo $li->idInsumo;?>" >ok</a>
                            </td>
                          </tr>
                    <?php
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->


                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
      </form>
      </div>




      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModalBuscarInsumo">Cerrar</button>
        <button type="button" class="btn btn-primary">Aperturar</button>
      </div>
    </div>
  </div>
</div><!-- :: end modalBuscarInsumo :: -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var t = $('#tblCanastaInsumos').DataTable({
      'paging': false,
      'info': false,
      'filter': false,
      'stateSave': true,
      'ajax': {
        "url":"<?php echo base_url();?>ccompras/recuperarCarrito", //
        "type":"POST",
        dataSrc: ''
      },
      'columns': [
        {data: null},
        {data: 'nombre'},
        {data: 'unidad'},
        {data: 'cantidad'},
        {data: 'prunit'},
        {data: 'importe'},
        {"orderable": false,
        render:function(data, type, row){
          return '<button type="button" data-id="'+row.id+'" class="btn btn-xs btn-primary editItem"><i class="fa fa-fw fa-pencil"></i></button> <button type="button" data-id="'+row.id+'" class="btn btn-xs btn-danger removeItem"><i class="fa fa-fw fa-trash"></i></button>'
        }}
      ],
      "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": 0
      } ],
      'order': [[ 1, 'asc' ]]
    }).on('draw', actualizaTotal);

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    loadNro();

    $('#tblCanastaInsumos').on('click','.removeItem', function(ev){
      ev.preventDefault();
      var btn = $(this); 
      var id = btn.data('id');

      $.post('<?php echo base_url();?>ccompras/eliminaItemCarritoCompra', {idIns:id}, function(data){
        if (data.removed === true) {
          t
              .row( btn.parents('tr') )
              .remove()
              .draw();
        }
      },'json');
    });

    $('#tblCanastaInsumos').on('click','.editItem', function(ev){
      ev.preventDefault();
      var btn = $(this); 
      var id = btn.data('id');

      var data = t.data();
      for(var i = 0; i < data.length; i++){
        if (data[i].id == id) {
          //populateForm(data[i].id, data[i].nombre, data[i].prunit, data[i].cantidad, data[i].unidad);
          populateForm(data[i]);
          break;
        }
      }
    });

    $('#modalBuscarInsumo').on('click','.selInsumo', function(ev){
      var idIns = $(this).data('id');
      var item = $('#' + idIns);
      var insumo = {
        id: item.data('id'),
        nombre: item.data('descripcion'),
        prunit: item.data('precio'),
        cantidad: 1,
        unidad: item.data('unidad'),
        cantMedXUnid: item.data('cantmedxunid'),
        stockMinXMed: item.data('stockminxmed'),
        stock: item.data('stock')
      };
      populateForm(insumo);
      $('#btnCloseModalBuscarInsumo').click();
    });

  $('#btnCleanForm').on('click', function(ev){
    $('#cartForm')[0].reset();
  });

  function loadNro(){
    $.get('<?php echo base_url();?>ccompras/nro', function(data){
      $('#idCompra').val(data.nro);    
    },'json');
  }
    

    $('#cartForm').on('submit', function(ev){
        ev.preventDefault();
        var id = $('#idInsumo').val();

        if (!id) {
            return alert('Debe seleccionar un insumo');
        }

        $.post('<?php echo base_url();?>ccompras/carritoCompra', $(this).serialize(), function(data){
            $('#cartForm')[0].reset();
            t.ajax.reload();
        },'json')
        .fail(function(response){
            if (response.responseJSON && response.responseJSON.error) {
            return alert(response.responseJSON.error);
            }
            alert('Ocurrió un error');
        });
    });

    $('#formCompra').on('submit', function(ev){
      ev.preventDefault();

      var f = $(this);
      var b = f.find('input[type="submit"]');
      b.prop('disabled','disabled').val('Guardando...');
      console.log( f.serialize()); //return false;
      $.post('<?php echo base_url();?>ccompras/save', f.serialize(), function(data){
        $('#cartForm')[0].reset();
        $('#formCompra')[0].reset();
        t.ajax.reload();
        alert(data.result);
        loadNro();
      },'json')
      .fail(function(response){
        if (response.responseJSON && response.responseJSON.error) {
          return alert(response.responseJSON.error);
        }
        alert('Ocurrió un error');
      })
      .always(function(){
        b.prop('disabled',false).val('Guardar');
      });
    });

  $('#btnLimpiarCesta').click(function(){
    $.ajax({
      url: "<?php echo base_url();?>ccompras/limpiarCarritoCompra",
      success: function(data){
        t.ajax.reload();
      }
    });     
  });

    $('#tblBuscarInsumo').DataTable({
        "info": false
    });

    $('#tblBuscarInsumoNuevo').DataTable({
        "info": false
    });

    function populateForm(insumo){
      $('#idInsumo').val(insumo.id);
      $('#descripcionInsumo').val(insumo.nombre);
      $('#prunit').val(insumo.prunit);
      $('#cntd').val(insumo.cantidad);
      $('#txtUnidad').text(insumo.unidad);
      $('#unidad').val(insumo.unidad);
      $('#stock').val(insumo.stock);
      $('#stockMinXMed').val(insumo.stockMinXMed);
      $('#cantMedXUnid').val(insumo.cantMedXUnid);
      $('#stock').val(insumo.stock);
    }

    function actualizaTotal(){
        var total = 0;
        var data = t.data();
        for(var i = 0; i < data.length; i++){
            total += parseFloat(data[i].importe.replace(/,/g,''));
        }
        var igv = total * 0.18;
        var subtotal = total - igv;

        $('#total,#total2').text(total.toFixed(2));
        $('#subtotal').text(subtotal.toFixed(2));
        $('#igv').text(igv.toFixed(2));
    }

});
</script>