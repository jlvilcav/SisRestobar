<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tipo cambio moneda</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="frmRegInsumo" method="POST" action="<?php echo base_url(); ?>cmantenimiento/updCambioMoneda">
              	<div class="box-body">
	                <div class="form-group">
	                  <label for="txtInsumo" class="col-sm-2 control-label">Cambio dolar</label>
	                  <div class="col-sm-4">
	                    <input type="text" name="txtCambioMoneda" class="form-control" placeholder="Ingrese el tipo de cambio del dolar" required>
	                  </div>
	                  <div class="col-sm-2">
	                    <input type="text" class="form-control" id="txtInsumo" readonly="true" value="<?php echo $dolar;?>">
	                  </div>
	                  <div class="col-sm-2">
	                    <input type="submit" class="btn btn-info" value="Guardar">
	                  </div>
	                </div>
                </div>
            </form>
        </div>
    </div>
</div>