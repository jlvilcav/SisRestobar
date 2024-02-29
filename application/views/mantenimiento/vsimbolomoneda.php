<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              	<h3 class="box-title"><i class="fa fa-check-square"></i> &nbsp;<b>Simbolo de moneda</b></h3><br>
            	<small style="color: #006699;">Configura el símbolo de tu moneda según la región o país donde te encuentres.</small>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>cmantenimiento/updSimboloMoneda">
              	<div class="box-body">
	                <div class="form-group">
	                  <label for="txtInsumo" class="col-sm-2 control-label">Simbolo</label>
	                  <div class="col-sm-4">
	                    <input type="text" name="txtSimboloMoneda" class="form-control" placeholder="Nuevo simbolo moneda" required>
	                  </div>
	                  <div class="col-sm-2">
	                    <input type="text" class="form-control" readonly="true" value="<?php echo $simboloMoneda;?>">
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