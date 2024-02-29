<div class="row">
  <!-- left column -->
  <div class="col-md-12">

      <div class="box box-info">
        <div class="box-header">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
          <h3 class="page-header">Lista de insumos
          <a href="<?php echo base_url();?>cinsumo/insumo" class="btn pull-right bg-green">
            <i class="fa fa-edit"></i> Nuevo
          </a>
          </h3>
          
          </div>
          <div class="col-sm-1"></div>
        </div><!-- /.box-header -->
        <br>
        <div class="box-body no-padding box-primary">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
          <table class="display" id="tblAllInsumos">
            <thead>
              <tr>
                <th style='width: 10%; background-color: #0E759D; color:white; text-align: center;'>N°</th>
                <th style='width: 25%; background-color: #0E759D; color:white;'>Insumo</th>
                <th style='width: 20%; background-color: #0E759D; color:white;'>Categoria</th>
                <th style='width: 15%; background-color: #0E759D; color:white;'>Unidad</th>
                <th style='width: 15%; background-color: #0E759D; color:white;'>Medida</th>
                <th style='width: 15%; background-color: #0E759D; color:white;'>Cant. Med.</th>
                <th style='width: 15%; background-color: #0E759D; color:white;'>Ver</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
          <div class="col-sm-1"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

  </div>
</div>


<!-- Modal Edit Insumo -->
<div class="modal fade" id="modalEditInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> &nbsp;Editar Insumo</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" id="mfrmUpdInsumo">
          <div class="box-body">

            <!-- hidden -->
            <input type="hidden" id="mhdnIdInsumo" value="">
            <input type="hidden" id="mhdnIdMedida">
            <input type="hidden" id="mhdnIdUnidad">

            <div class="form-group">
              <label for="mtxtInsumo" class="col-sm-4 control-label">Insumo</label>
              <div class="col-sm-6">
                <input type="text" name="mtxtInsumo" class="form-control" id="mtxtInsumo" placeholder="Escriba el nombre" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">Unidad</label>
              <div class="col-sm-6">  
                <select class="form-control" name="mcboUnidad" id="mcboUnidad" required>
                  <option value="">:: Elija</option>
                </select>
                </div>
            </div>

            <!-- select -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Categoria</label>
              <div class="col-sm-6">  
                <select class="form-control" name="mcboCategInsumo" id="mcboCategInsumo" required>
                  <option value="">:: Elija</option>
                </select>
                </div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Medida</label>
              <div class="col-sm-6">  
                <select class="form-control" name="mcboMedida" id="mcboMedida" required>
                  <option value="">:: Elija</option>
                </select>
                </div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label for="txtCantXMedida" class="col-sm-4 control-label">Cant. X Medida</label>
              <div class="col-sm-6">
                <input type="numeric" name="mtxtCantXMedida" class="form-control" id="mtxtCantXMedida" placeholder="0" required>
              </div>
            </div>

            <div class="form-group">
              <label for="txtStockMin" class="col-sm-4 control-label">Stock Minimo</label>
              <div class="col-sm-6 input-group"> 
                <div class="col-sm-5">
                  <input type="numeric" name="mtxtStockMinUnid" class="form-control" id="mtxtStockMinUnid" placeholder="0" required>
                </div>
                <div class="col-sm-7">
                  <input type="numeric" name="mtxtStockMin" class="form-control" id="mtxtStockMin" placeholder="0" required readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="txtPrecSugerido" class="col-sm-4 control-label">Precio sugerido</label>
              <div class="col-sm-6">
                <input type="text" name="mtxtPrecSugerido" class="form-control" id="mtxtPrecSugerido" placeholder="0.0" required>
              </div>
            </div>

            

          </div><!-- /.box-body -->

          <!-- <div class="box-footer" id="divBotones">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div> -->
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCerrarModalEditInsumo" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnUpdateInsumo">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/gestorinsumos.js"></script>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>