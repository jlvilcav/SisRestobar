<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Sucursales</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?php echo base_url(); ?>csucursal/regSucursal" method="POST">
        <!--<?= form_open(base_url().'cubigeo/listDepartamentos');  ?>-->
          <div class="box-body">

            <div class="form-group">
              <label for="txtNomSucursal" class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-8">
              	<input type="text" name="txtNomSucursal" class="form-control" id="txtNomSucursal" placeholder="Escriba el nombre" required>
              </div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Departamento</label>
            	<div class="col-sm-8">  
                <select class="form-control" name="cboDepartamento" id="cboDepartamento" required>
                  <option value="">:: Elija</option>
                  <?php
                    foreach ($listDepartamentos as $depa) {
                      echo "<option value='".$depa->codDepartamento."'>".$depa->nombre."</option>";
                    }
                  ?>
                </select>
              	</div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-8">  
                <select class="form-control" name="cboProvincia" id="cboProvincia" required>
                  <option value="">:: Elija</option>
                </select>
              	</div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Distrito</label>
              <div class="col-sm-8">  
                <select class="form-control" name="cboDistrito" id="cboDistrito" required>
                  <option value="">:: Elija</option>
                </select>
              	</div>
            </div>

            <div class="form-group">
              <label for="txtDireccion" class="col-sm-2 control-label">Dirección</label>
              <div class="col-sm-8">
              	<input type="text" name="txtDireccion" class="form-control" id="txtDireccion" placeholder="Ingrese su dirección" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="txtObservacion">Observación</label>
              <div class="col-sm-8"> 
              	<textarea type="text" name="txtObservacion" class="form-control" id="txtObservacion" placeholder="Observación"></textarea> 
              </div>
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Guardar</button>
            <a href="<?php echo base_url();?>/csucursal" class="btn btn-danger" id="btnCancelar"><i class="fa fa-close"></i> &nbsp;Cancelar</a>
          </div>
        </form>
      </div><!-- /.box -->
	</div>

  <!-- mensajes -->
  <?php if ($regSucursalState == '1') : ?>
    <div class="col-md-12">
      <div class="callout callout-success">
        <h4>Registrado satisfactoriamente</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php elseif($regSucursalState == '0') : ?>
    <div class="col-md-12">
      <div class="callout callout-danger">
        <h4>Hubo un error al momento de guardar</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php endif; ?>
</div>




<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#cboDepartamento").change(function() {
      $("#cboDepartamento option:selected").each(function() {
        dep = $('#cboDepartamento').val();
        $.post("<?php echo base_url();?>cubigeo/provincias", {
          cboDepartamento : dep
        }, function(data) {
          $("#cboProvincia").html(data);
					// Seleccionar automáticamente la primera opción después de cargarlas
					$("#cboProvincia option:first").prop("selected", true);
					// Disparar el evento change del combo de provincias para cargar los distritos relacionados
					$("#cboProvincia").change();
        });
      });
    })


    $('#cboProvincia').change(function(){//debugger;
      $('#cboProvincia option:selected').each(function(){
        dep = $('#cboDepartamento').val();
        prov = $('#cboProvincia').val();
        $.post("<?php echo base_url();?>cubigeo/distritos"
          ,{
            cboDepartamento:dep,
            cboProvincia:prov
          }
          ,function(data){
            $("#cboDistrito").html(data);
          });
      });
    });

  });
</script>
