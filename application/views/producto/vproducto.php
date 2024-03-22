<style>
  
    .fileUpload {
        position: relative;
        overflow: hidden;
    }
    
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<div class="row">
    <form id="mainForm" class="form-horizontal" method="post" target="ajaxframe" enctype="multipart/form-data" action="<?php echo base_url();?>cproducto/save">
      <!-- left column -->
      <div class="col-md-1"></div>
      <div class="col-md-7">
        <div class="box box-info">
        <div style="border: 1px #CCC solid;">
            <!--Busqueda-->
            <div class="box-header with-border">
              <h3 class="box-title">PRODUCTO</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group" style="margin-bottom:5px;">
                  <label class="col-sm-2 control-label">Producto</label>
                  <div class="col-sm-9">
                    <div class="form-group" style="margin-bottom:5px;">
                      <div class="col-sm-6"> 
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Producto" required>
                      </div>
                      <label class="col-sm-3 control-label">Precio venta</label>
                      <div class="col-sm-3"> 
                        <input type="text" name="precio" class="form-control" placeholder="0.00" required>
                      </div>
                    </div>
                  </div>             
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Categoria</label>
                    <div class="col-sm-9">  
                        <select class="form-control" name="categoriaId" id="categoriaId" required>
                            <option value="">:: Elija</option>
                            <?php
                                foreach ($getCategProducto as $lp) {
                                   echo "<option value='".$lp->idCategoriaProducto."'>".$lp->descripcion."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="descripcionInsumo" class="col-sm-2 control-label">Insumo</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="categoriaId" id="categoriaId" required>
                              <option value="">:: Elija</option>
                              <?php
                                foreach ($getCategProducto as $lp) {
                                   echo "<option value='".$lp->idCategoriaProducto."'>".$lp->descripcion."</option>";
                                 }
                              ?>
                            </select>
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalBuscarInsumo"><i class="fa fa-plus"></i></button>
                          </span>
                        </div>
                    </div>
                </div> -->

                <div class="form-group">

                    <label class="col-sm-2 control-label">imagen</label>

                    <div class="col-sm-10">
                        <div class="fileUpload btn btn-primary" style="width: 20%;float: left;">
                            <span>Seleccionar</span>
                            <input id="uploadBtn" type="file" class="upload" name="image" />
                        </div>
                        <input id="uploadFile" class="form-control col-sm-4" placeholder="..." disabled="disabled" style="width: 70%;"/>
                    </div>

                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Destino</label>
                  <div class="col-sm-9">  
                    <select class="form-control" name="destino" id="destino" required>
                      <?php
                        foreach ($destinos as $id => $value) {
                           echo "<option value='".$id."'>".$value."</option>";
                         }
                      ?>
                    </select>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="box box-info">
            <div style="border: 1px #CCC solid;">
                <!--Busqueda-->
                <div class="box-header with-border">
                  <h3 class="box-title">INSUMOS</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="descripcionInsumo" class="col-sm-2 control-label">Insumo</label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control" placeholder="Insumo..." id="descripcionInsumo" name="descripcionInsumo"  readonly="readonly">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalBuscarInsumo"><i class="fa fa-fw fa-external-link-square"></i></button>
                              </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Cantidad</label>
                        <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control" id="cntd" name="cntd">
                              <span class="input-group-addon" id="txtMedida">UNIDAD</span>
                              <input type="hidden" id="medida" name="medida" />
                            </div>
                        </div>
                        <input type="hidden" id="idInsumo" value="">
                    </div>
                    <div class="text-right" style="margin-bottom: 10px;">
                        <button id="addInsumo" class="btn btn-primary" type="button">Guardar</button>
                        <button id="cancelInsumo" class="btn btn-danger" type="button">cancelar</button>
                    </div>

                    <table id="tblInsumos" class="table table-condensed" style="border: 0.1px #EEE solid;">
                      <thead>
                        <tr>
                          <th style="width: 10%;background-color: #0E759D;color: white;text-align: center;">N°</th>
                          <th style="width: 35%;background-color: #0E759D;color: white;">Insumo</th>
                          <th style="width: 20%;background-color: #0E759D;color: white;">Cantidad</th>
                          <th style="width: 20%;background-color: #0E759D;color: white;">Medida</th>
                          <th style="width: 15%;background-color: #0E759D;"></th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                    <div class="text-right" style="padding: 10px;">
                        <button id="resetCart" type="button" class="btn btn-danger">Limpiar insumos</button>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- rigth column -->
      <div class="col-md-3">
        <div class="box box-info">
          <div style="border: 1px #CCC solid;">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-navicon"></i></span>
                <div class="info-box-content">
                  <label style="font-size: 20pt;">Sucursales</label>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <div class="box-body">
              <table class="table table-striped">
              <?php for ($i = 0; $i < sizeof($sucursales); $i++) { ?>
                <tr>
                  <td style="width: 15px"> <?php echo $i + 1;?></td>
                  <td> <?php echo $sucursales[$i]->nombre;?></td>
                  <td style="width: 40px">
                    <div class="icheck"><input type="checkbox" checked="true" name="sucursal[]" value="<?php echo $sucursales[$i]->idSucursal;?>"></div>
                  </td>
                </tr>
              <?php } ?>                        
              </table>
            </div>
          </div>
        </div>
        <div class="text-right" style="padding: 10px;">
          <input type="submit" value="Guardar" class="btn btn-primary btn-lg" id="btnGuardar" />
        </div>
      </div> 
    </form>
</div>
<iframe name="ajaxframe" style="display: none;"></iframe>


<!-- :: modalBuscarInsumo :: -->
<div class="modal fade" id="modalBuscarInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> &nbsp;&nbsp;Busqueda de Insumos</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
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
              <?php foreach ($listInsumos as $li) { ?>
                <tr>
                  <td><?php echo $li->descripcion;?></td>
                  <td><?php echo $li->categinsumo;?></td>
                  <td><?php echo $li->und;?></td>
                  <td><?php echo $li->med;?></td>
                  <td><?php echo $li->cantMedXUnid;?></td>
                  <td>
                    <button type="button" class='btn btn-block btn-default btn-xs selInsumo' data-idinsumo="<?php echo $li->idInsumo;?>" data-medida="<?php echo $li->med;?>" data-medida="<?php echo $li->med;?>" data-descripcion="<?php echo $li->descripcion;?>">ok</button>
                  </td>
                </tr>
              <?php } ?> 
              </tbody>  
            </table>
          </div><!-- /.box-body -->

          <!-- campos ocultos temporales -->
          <input type="hidden" name="hdnIdInsumo" id="hdnIdInsumo"></input>

      </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModalBuscarInsumo">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary">Aperturar</button> -->
      </div>
    </div>
  </div>
</div><!-- :: end modalBuscarInsumo :: -->


<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };

  var t = $('#tblInsumos').DataTable({
    'paging': false,
    'info': false,
    'filter': false,
    'stateSave': true,
    'ajax': {
      "url":"<?php echo base_url();?>cproducto/insumos", //
      "type":"POST",
      dataSrc: ''
    },
    'columns': [
      {data: null},
      {data: 'descripcion'},
      {data: 'cantidad'},
      {data: 'medida'},
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
  });

  t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  $('#tblBuscarInsumo').on('click','.selInsumo',function(ev){
    var b = $(this);
    var it = {
      descripcion: b.data('descripcion'),
      medida: b.data('medida'),
      cantidad: 0,
      id: b.data('idinsumo')
    }
    selInsumo(it);
    $('#btnCloseModalBuscarInsumo').click()
  })

  $('#addInsumo').on('click', function(ev){alert();
    var data = {
      medida: $('#medida').val(),
      descripcion: $('#descripcionInsumo').val(),
      cantidad: $('#cntd').val(),
      id: $('#idInsumo').val()
      };
    if (!data.id) {
      return alert('Debe seleccionar un insumo');
    }

    $.post("<?php echo base_url();?>cproducto/insumo", data, function(data){
      cancelInsumo();
      t.ajax.reload();
    },'json').fail(function(response){
      if (response.responseJSON && response.responseJSON.error) {
        return alert(response.responseJSON.error);
      }
      alert('Ocurrió un error');
    });
  });

  $('#tblInsumos').on('click','.removeItem', function(ev){
    ev.preventDefault();
    var btn = $(this); 
    var id = btn.data('id');

    $.post('<?php echo base_url();?>cproducto/eliminaitemcarrito', {idIns:id}, function(data){
      if (data.removed === true) {
        t
            .row( btn.parents('tr') )
            .remove()
            .draw();
      }
    },'json');
  });

  $('#tblInsumos').on('click','.editItem', function(ev){
    ev.preventDefault();
    var btn = $(this); 
    var id = btn.data('id');

    var data = t.data();
    for(var i = 0; i < data.length; i++){
      if (data[i].id == id) {
        //populateForm(data[i].id, data[i].nombre, data[i].prunit, data[i].cantidad, data[i].unidad);
        selInsumo(data[i]);
        break;
      }
    }
  });

  $('#cancelInsumo').on('click', cancelInsumo);

  $('#resetCart').on('click', function(ev){
     $.ajax({
      url: "<?php echo base_url();?>cproducto/resetinsumos",
      success: function(data){
        t.ajax.reload();
      }
    }); 
  });

  $('#mainForm').on('submit', function(ev){
    $('#btnGuardar').val('Guardando...').prop('disabled',true);
  });



  function selInsumo(it)
  {
    $('#txtMedida').text(it.medida);
    $('#medida').val(it.medida);
    $('#descripcionInsumo').val(it.descripcion);
    $('#cntd').val(it.cantidad);
    $('#idInsumo').val(it.id);
  }

  function cancelInsumo()
  {
    $('#txtMedida').text('UNIDAD');
    $('#medida').val('');
    $('#descripcionInsumo').val('');
    $('#cntd').val('');
    $('#idInsumo').val('');
  }

  
  $('#tblBuscarInsumo').DataTable({
    "info": false
  });

  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
});

function responseAjaxFrame(response){
  $('#btnGuardar').val('Guardar').prop('disabled',false);
  if (response.error) {
    return alert(response.error);    
  }
  
  alert('Producto registrado');
  $('#tblInsumos').DataTable().ajax.reload();
  $('#mainForm')[0].reset();
}
</script>
