<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div></div>
    <div class="col-xs-12 col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Categoria de Insumos</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cinsumo/regCategInsumo">
          <div class="box-body">

            <div class="form-group">
              <label for="txtCatInsumo" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-9">
                <input type="text" name="txtCatInsumo" class="form-control" id="txtCatInsumo" placeholder="Categoria" required>
              </div>
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            <a href="<?php echo base_url(); ?>cinsumo" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
          </div>
        </form>
      </div><!-- /.box -->
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Lista de categoria Insumo</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="display" id="tblListCatInsumo">
            <thead>
              <tr>
                <th style="background-color: #0E759D; color:white; width: 15%; text-align: center;">N°</th>
                <th style="background-color: #0E759D; color:white; width: 40% ">Categoria</th>
                <th style="background-color: #0E759D; color:white; width: 40% ">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach ($getCategInsumo as $ci) {
                  echo "<tr>";
                  echo "<td style='color:#4F7C0F;text-align:center;'>".$ci->idCategoriaInsumo."</td>";
                  echo "<td style='color:#006699;'><i class='fa fa-toggle-on'></i> &nbsp;&nbsp;".$ci->descripcion."</td>";
                  echo "<td style='text-align:center;'><a href='#' title='Editar información' data-toggle='modal' data-target='#modalEditCatIns' class='btn btn-default' onClick='selCatIns(".$ci->idCategoriaInsumo.",\"".$ci->descripcion."\");'><i style='color:#555;' class='fa fa-edit'></i> Editar</a></td>";
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



<!-- Modal editar categoria insumo -->
<div class="modal fade" id="modalEditCatIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Categoria Insumo</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
          <!-- parametros ocultos -->
          <input type="hidden" id="mhdnIdCatIns">
          
          <div class="box-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nombre</label>
                <div class="col-sm-9"> 
                  <input type="text" name="mtxtNomCatIns" class="form-control" id="mtxtNomCatIns" placeholder="">
                </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-info" id="mbtnUpdCatIns">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>