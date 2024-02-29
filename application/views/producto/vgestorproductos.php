<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="col-sm-1"></div>
        <div class="col-sm-8">
        <h3 class="box-title" style="color:#0E759D;" id="cantProductos">Sucursales </h3><br>
        
        <input type="hidden" name="hdnIdSucursal" id="hdnIdSucursal" value="<?php echo $hdnIdSucursal;?>">

        <?php for ($i = 0; $i < sizeof($sucursales); $i++) { ?>          
            <a class="btn pull-center btn-primary abtnProdBySuc" name="<?php echo $sucursales[$i]->nombre;?>" id="<?php echo $sucursales[$i]->idSucursal?>" onClick="loadProductBySucursal(<?php echo $sucursales[$i]->idSucursal?>);">
              <i class="fa fa-home"></i> &nbsp;<?php echo $sucursales[$i]->nombre;?>
            </a>
        <?php } ?>

        <a id="abtnDownloadExcel" class="btn pull-right bg-green">
          <i class="fa fa-file-excel-o"></i> &nbsp;&nbsp;Exportar Excel
        </a>
        </div>
        <div class="col-sm-1"></div>
      </div><!-- /.box-header -->

      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php if ($error != '') { ?>
                    <div class="alert alert-danger">
                        <strong>ERROR!</strong> <?php echo $error;?>.
                    </div>
                <?php }?>
                
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="box-body no-padding">
                  <table class="display" id="tblProductosBysucursal">
                    <thead>
                      <tr>
                        <th style="width: 10%;background-color: #0E759D; color: white; text-align: center;">N°</th>
                        <th style="width: 25%;background-color: #0E759D; color: white;">Producto</th>
                        <th style="width: 20%;background-color: #0E759D; color: white;">Categoria</th>
                        <th style="width: 15%;background-color: #0E759D; color: white;">Prec.Venta.</th>
                        <th style="width: 15%;background-color: #0E759D; color: white;">Est.</th>
                        <th style="width: 30%;background-color: #0E759D; color: white; text-align: center;">Ver</th>
                      </tr>
                    </thead>
                    <tbody></tbody>                    
                  </table>
                </div><!-- /.box-body --> 
            </div>
            <!--<div class="col-sm-1"></div>-->
          </div>

        </div>
      </form>
    </div><!--end box box-info-->
  </div>
</div><!--end row-->


<div class="modal fade" id="modalConfirmacion">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">SistRestobar</h4>
            </div>
            <div class="modal-body">
                <p>¿Esta seguro de eliminar el producto <label id="lblNomProducto"></label>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <a id="btnAceptarDelProd" class="btn btn-primary">Aceptar</a>
            </div>
        </div>
    </div>
</div>


<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Page script -->
<script type="text/javascript">
  // $(document).ready(function(){

    //Money Euro
    $("[data-mask]").inputmask();

    // $.post(
    //       "<?php echo base_url();?>cproducto/getProductoBySucursal"
    //       ,function(data){
    //         var result = $.parseJSON(data);
    //         var sss = 0;
    //         $.each(result, function(i,item){
    //           sss += 1;
    //         });
    //         $('#cantProductos').html('Lista de Productos - (' + sss + ')');
    //       });
    // var idSuc = 0;

    function loadProductBySucursal(idSu){
      var nomSuc = 'Lista de Productos de ' + $('#' + idSu).attr('name');

      $('#'+idSu).addClass('btn-primary');

      $('.abtnProdBySuc').click(function(index){
        $('.abtnProdBySuc').removeClass('btn-primary');
        var i = $('.abtnProdBySuc').index(this);
        nomSuc = 'Lista de Productos de ' + $('.abtnProdBySuc:eq('+i+')').attr('name');
        
        $(this).addClass('btn-primary');
        // idSuc = idSu;
        $('#cantProductos').html(nomSuc);
        $('#abtnDownloadExcel').attr('href','<?php echo base_url(); ?>cproducto/downloadProductos/' + idSu + '/' + $('.abtnProdBySuc:eq('+i+')').attr('name'));

        // alert($(this).attr('id') + " " + $('.abtnProdBySuc:eq('+i+')').attr("name"));
      });

      $('#tblProductosBysucursal').DataTable().destroy();
      $('#tblProductosBysucursal').DataTable({
        'paging': true,
        'info': false,
        'filter': true,
        'stateSave': true,
        'ajax': {
          "url":"<?php echo base_url();?>cproducto/getProductoBySucursal",
          "type":"POST",
          "data" : { idSu : idSu },
          dataSrc: function(data){
            var sss = 0;
            for (var i = 0; i <= data.length - 1; i++) {
              sss ++;
            }
            $('#cantProductos').html(nomSuc + ' (' + sss + ')');
            return data;
          }
        },
        'columns': [
          {data: 'rownum','sClass':'dt-body-center'},
          {data: 'nombre'},
          {data: 'descripcion'},
          {data: 'precioVenta'},
          {data: 'sitReg'},
          {"orderable": false,
          render:function(data, type, row){
            return '<td align="center">' +
                    '<a href="<?php echo base_url(); ?>cproducto/getDetalleProducto/'+row.idProducto+'/'+row.precioVenta+'/'+row.destino+'/'+row.imagen+'/'+row.sitReg+'/'+row.idSucursal+'" id="'+row.idProducto+'" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-external-link-square"></i></a>&nbsp;&nbsp;&nbsp;' + 
                    '<a onClick="delProducto('+row.idSucursal+','+row.idProducto+',\''+row.nombre+'\');" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-fw fa-trash"></i></a>' + 
                '</td>';
          }}
        ],
        "columnDefs": [
          {
            "targets": [1], // El objetivo de la columna de posición, desde cero.
            "data": "nombre", // La inclusión de datos
            "render": function(data, type, row) { // Devuelve el contenido personalizado
              if (row.destino == 'B') {  
                return "<span style='color:#006699;'><i class='fa fa-beer'></i> &nbsp;&nbsp;" + data + "</span>";
              }else{
                return "<span style='color:#4F7C0F;'><i class='fa fa-cutlery'></i> &nbsp;&nbsp;" + data + "</span>";
              }
                
            }
          },
          {
            "targets": [4], // El objetivo de la columna de posición, desde cero.
            "data": "sitReg", // La inclusión de datos
            "render": function(datass, type, row) { // Devuelve el contenido personalizado
              if (row.sitReg == 1) {  
                return "<span style='color:#006699;'><i class='fa fa-check'></i></span>";
              }else{
                return "<span style='color:#FF0000;'><i class='fa fa-close'></i></span>";
              }
                
            }
          }
         ],
        "order": [[ 0, "desc" ]]
      });//.on('draw', actualizaTotal);
    };

    // loadProductBySucursal();

  // });
  $(document).ready(function(){
    var hdnIdSucursal = $('#hdnIdSucursal').val();
    if (hdnIdSucursal != 0) 
      loadProductBySucursal(hdnIdSucursal);
    else
      loadProductBySucursal($('.abtnProdBySuc:eq(0)').attr('id'));

    $('#abtnDownloadExcel').attr('href','<?php echo base_url(); ?>cproducto/downloadProductos/' + $('.abtnProdBySuc:eq(0)').attr('id') + '/' + $('.abtnProdBySuc:eq(0)').attr('name'));  
  });
</script>

<script type="text/javascript">
    function delProducto(idSucursal,idProducto,nombre){
        // alert(idProducto + nombre);return false;
        $('#lblNomProducto').html(nombre);
        $('#btnAceptarDelProd').attr('href', "<?php echo base_url(); ?>cproducto/delProducto/"+idSucursal+"/"+idProducto);
    }
</script>