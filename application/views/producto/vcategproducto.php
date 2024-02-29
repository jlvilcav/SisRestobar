<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="col-xs-12 col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Categoria de Productos</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cproducto/regCategProducto">
          <div class="box-body">

            <div class="form-group">
              <label for="txtCatProducto" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-9">
                <input type="text" name="txtCatProducto" class="form-control" id="txtCatProducto" placeholder="Categoria" required>
              </div>
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </form>
      </div><!-- /.box -->
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Lista de categoria producto</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-striped" id="tblListCatProducto">
            <thead>
              <tr>
                <th style="background-color: #0E759D; color:white; text-align: center;">N°</th>
                <th style="background-color: #0E759D; color:white;">Categoria</th>
                <th style="background-color: #0E759D; color:white;">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach ($getCategProducto as $ci) {
                  echo "<tr>";
                  echo "<td style='color:#4F7C0F;text-align:center;'>".$ci->idCategoriaProducto."</td>";
                  echo "<td style='color:#006699;'><i class='fa fa-toggle-on'></i> &nbsp;&nbsp;".$ci->descripcion."</td>";
                  echo "<td style='text-align:center;'><a href='#' title='Editar información' data-toggle='modal' data-target='#modalEditCatProd' class='btn btn-default' onClick='selCatProd(".$ci->idCategoriaProducto.",\"".$ci->descripcion."\");'><i style='color:#555;' class='fa fa-edit'></i> Editar</a></td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
</div>

<!-- Modal Cierre -->
<div class="modal fade" id="modalEditCatProd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Categoria Producto</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
          <!-- parametros ocultos -->
          <input type="hidden" id="mhdnIdCatProd">
          
          <div class="box-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nombre</label>
                <div class="col-sm-9"> 
                  <input type="text" name="mtxtNomCatProd" class="form-control" id="mtxtNomCatProd" placeholder="">
                </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-info" id="mbtnUpdCatProd">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>