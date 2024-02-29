<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info" class="col-sm-12">
      <div class="box-header with-border">
        <div class="col-sm-1"></div>  
        <h3 class="box-title">Detalles del producto</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?php echo base_url();?>cproducto/updateProducto" method="POST" enctype="multipart/form-data">
        <div class="box-body">
            <div class="col-sm-7">

              <input type="hidden" name="txtDetIdProducto" id="txtDetIdProducto" value="<?php echo $idProducto; ?>">
              <input type="hidden" name="hdnSitReg" id="hdnSitReg" value="<?php echo $sitReg;?>">
              <input type="hidden" name="hdnIdSucursal" id="hdnIdSucursal" value="<?php echo $idSucursal;?>">

              <div class="form-group">
                <div class="col-sm-2"><br></div>
              </div>

              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" style="color: #006699;"><i class="fa fa fa-dropbox"></i> &nbsp;&nbsp; Producto</label>
                <div class="col-sm-7">
                  <input type="text" name="txtDetNomProducto" class="form-control" id="txtDetNomProducto" value="<?php echo $nomProducto; ?>">
                  <!-- <input type="text" name="txtDetNomProducto" class="form-control" id="txtDetNomProducto" value="<?php echo str_replace("-"," ",str_replace("%20"," ", str_replace("%C3%91","Ñ",  urldecode($nomProducto)))); ?>"> -->
                </div>
                <!-- <label class="col-sm-2" style="color: #888;"><?php echo str_replace("-"," ",$nomProducto); ?></label> -->
              </div>

              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" style="color: #006699;"><i class="fa fa fa-rss-square"></i> &nbsp;&nbsp; Categoria</label>
                <!-- <label class="col-sm-2" style="color: #888;"><?php echo str_replace("%20"," ",$catProducto); ?></label> -->
                <div class="col-sm-7">  
                  <select class="form-control" name="cboDetCatProducto" id="cboDetCatProducto">
                    <option value="">:: Elija</option>
                    <?php
                      foreach ($getCategProducto as $lp) {
                        if ($lp->descripcion == str_replace("%20"," ",$catProducto)) {
                          echo "<option value='".$lp->idCategoriaProducto."' selected>".$lp->descripcion."</option>";
                        }else{
                         echo "<option value='".$lp->idCategoriaProducto."'>".$lp->descripcion."</option>";
                        }
                       }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" style="color: #006699;"><i class="fa fa fa-rss-square"></i> &nbsp;&nbsp; Destino</label>
                <!-- <label class="col-sm-2" style="color: #888;"><?php echo str_replace("%20"," ",$catProducto); ?></label> -->
                <div class="col-sm-7">  
                  <select class="form-control" name="cboDetDestProducto" id="cboDetDestProducto">
                    <?php                    
                      if ($destProducto == "B") {
                        echo "<option value='B' selected>BAR</option>";
                        echo "<option value='C'>COCINA 1</option>";
                        echo "<option value='C2'>COCINA 2</option>";
                      }elseif ($destProducto == "C") {
                        echo "<option value='B'>BAR</option>";
                        echo "<option value='C' selected>COCINA 1</option>";
                        echo "<option value='C2'>COCINA 2</option>";
                      }elseif ($destProducto == "C2") {
                        echo "<option value='B'>BAR</option>";
                        echo "<option value='C' selected>COCINA 1</option>";
                        echo "<option value='C2' selected>COCINA 2</option>";
                      }
                    ?>                  
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" style="color: #006699;"><i class="fa fa fa-dollar"></i> &nbsp;&nbsp; Precio</label>
                <div class="col-sm-5">
                  <input type="text" name="txtDetPrecProducto" class="form-control" id="txtDetPrecProducto" value="<?php echo $pvProducto; ?>">
                </div>
                <!-- <label class="col-sm-2" style="color: #888;"><?php echo $pvProducto; ?></label>    -->             
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-success btn-sm" id="btnUpdateProducto">Actualizar</button>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" style="color: #006699;"><i class="fa fa fa-check"></i> &nbsp;&nbsp; Estado</label>
                <div class="col-sm-7">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="chkEstado" id="chkEstado"><label id="lblEstado"></label>
                    </label>
                  </div>
                </div><!-- /.col -->
              </div>

            </div>
            
              <!-- Mostrar y subir imagen -->
              <div class="col-sm-3" >                
                <div style="height:250px;background-color:white;border:#CCC solid 1px;" id="list">                
                  <img src="<?php echo base_url();?>productos/<?php echo $imgProducto;?>" width="90%" height="90%" style="margin-top:11px;margin-left:12px;">
                </div>
                <span class="btn btn-default btn-file" style="width:100%">
                    Buscar imagen <input type="file" id="fileDetImgProducto" name="fileDetImgProducto"/> <!-- onchange="alert($(this).val());" -->
                </span>
                <input type="hidden" name="txtImgProductoOrig" value="<?php echo $imgProducto; ?>">
                <div id="alertaerror"></div>
              </div>

        </div>

        <hr>
        <div class="box-header with-border">
          <div class="col-sm-1"></div>  
          <h3 class="box-title">Insumo del producto</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                <div class="col-sm-1"></div>
                <label for="txtNomInsumo" class="col-sm-1 control-label">Insumo</label>
                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" placeholder="Insumo..." id="txtNomInsumo" name="txtNomInsumo"  readonly="readonly">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalBuscarInsumo"><i class="fa fa-fw fa-external-link-square"></i></button>
                      </span>
                    </div>
                </div>

                <label for="" class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-2">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="txtCantIns" name="txtCantIns" placeholder="Cantidad..">
                      <span class="input-group-addon" id="txtMedida">UNIDAD</span>                      
                    </div>
                </div>

                <button class="btn btn-success" type="button" id="btnAddInsumo"><i class="fa fa-plus"></i></button>
            </div>
            <br>
            <div class="form-group"  class="col-sm-12">
                <div class="col-sm-1"></div>
                <div class="col-sm-9">
                  <div class="box-body no-padding">

                      <!-- hidden -->
                      <input type="hidden" id="hdnIdInsumo" value="">
                      <!-- <input type="hidden" id="hdnMedida" name="hdnMedida"> -->

                      <table class="display" id="tblDetalleProducto">
                        <thead>
                          <tr>
                            <th style="width: 5%;background-color: #0E759D; color: white;">N°</th>
                            <th style="width: 35%;background-color: #0E759D; color: white;">Insumo</th>
                            <th style="width: 20%;background-color: #0E759D; color: white;">Cantidad</th>
                            <th style="width: 20%;background-color: #0E759D; color: white;">Medida</th>
                            <th style="width: 20%;background-color: #0E759D; color: white;">Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>                    
                      </table>
                     
                    </div><!-- /.box-body -->   
                </div>
                <div class="col-sm-1"></div>
            </div>

            <!-- <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
            <div class="bg-gray" style="height: 50px;">
                <div class="info-box-content">                
                  <label class="col-sm-7 control-label" for="txtObservacion" style="font-size: 15pt;">Costo:</label>
                  <label class="col-sm-5 control-label" for="txtObservacion" style="font-size: 15pt;">S/. 2.025</label>
                </div>
            </div>
            </div>
            </div> -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- :: modalBuscarInsumo :: -->
<div class="modal fade" id="modalBuscarInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> &nbsp;Busqueda de Insumos</h4>
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
      </div>
    </div>
  </div>
</div><!-- :: end modalBuscarInsumo :: -->

<!-- <div id="list"></div> -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="<?php echo base_url(); ?>js/detalleproducto.js"></script>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript">
  function archivo(evt) {
      var files = evt.target.files; // FileList object
       
        //Obtenemos la imagen del campo "file". 
      for (var i = 0, f; f = files[i]; i++) {         
           //Solo admitimos imágenes.
           if (!f.type.match('image.*')) {
                continue;
           }
       
           var reader = new FileReader();
           
           reader.onload = (function(theFile) {
               return function(e) {
               // Creamos la imagen.
                      document.getElementById("list").innerHTML = ['<img style="width:90%;height:90%;margin-top:11px;margin-left:12px;" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
               };
           })(f);
 
           reader.readAsDataURL(f);
       }
  }             
  document.getElementById('fileDetImgProducto').addEventListener('change', archivo, false);
</script>

<script type="text/javascript">
  $(document).ready(function(){

    if ($('#hdnSitReg').val() == 1) {
      $('#chkEstado').attr('checked', true);
      $('#lblEstado').html('Activado');
      $('#lblEstado').css('color','#555');
    }else{
      $('#chkEstado').attr('checked', false);
      $('#lblEstado').html('Desactivado');
      $('#lblEstado').css('color','#d73925');
    }

    $("[data-mask]").inputmask();
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('input').on('ifChecked', function(event){
      $('#lblEstado').html('Activado');
      $('#lblEstado').css('color','#555');
      // alert($(this).val()); // alert value
    });

    $('input').on('ifUnchecked', function(event){
      $('#lblEstado').html('Desactivado');
      $('#lblEstado').css('color','#d73925');
      // alert($(this).val()); // alert value
    });

    $('#tblDetalleProducto').DataTable({
        'paging': true,
        'info': false,
        'stateSave': true
      });

    $('#tblBuscarInsumo').DataTable({
      "info": false
    });

    // function responseAjaxFrame(response){
    //   if (response.error) {
    //     return alert(response.error);    
    //   }
    // }
  });
</script>