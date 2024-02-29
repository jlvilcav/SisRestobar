<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="col-xs-6">
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Registro de Medida de medida</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              
              <div class="form-group">
                <label for="txtMedida" class="col-sm-2 control-label">Medida</label>
                <div class="col-sm-7">
                  <input type="text" name="txtMedida" class="form-control" id="txtMedida" placeholder="Ingrese Medida">
                </div>
                <button type="button" class="btn btn-primary" id="btnGuardarMedida">Guardar</button>
              </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
              
            </div>
          </form>
        </div><!-- /.box -->
    </div>
    <div class="col-md-5">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Medidas registradas</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped" id="tblMedidas">
                <thead>
                  <tr>
                    <th style="width: 10%;background-color: #0E759D; color: white; text-align: center;">N°</th>
                    <th style="width: 35%;background-color: #0E759D; color: white; text-align: center;">Medida</th>
                    <th style="width: 15%;background-color: #0E759D; color: white; text-align: center;">Ver</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
    </div>
  </div>
</div>


<!-- Modal EditMedida -->
<div class="modal fade" id="modalEditMedida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> &nbsp;Editar Medida</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
          <!-- parametros ocultos -->
          <input type="hidden" id="mhdnIdMedida">
          
          <div class="box-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Medida</label>
                <div class="col-sm-9"> 
                  <input type="text" name="mtxtMedida" class="form-control" id="mtxtMedida" placeholder="">
                </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-info" id="mbtnUpdMedida">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>js/medida.js"></script>
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>
