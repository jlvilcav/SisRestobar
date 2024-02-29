<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              	<h3 class="box-title"><i class="fa fa-cog"></i> &nbsp;<b>Porcentaje de propina</b></h3><br>
            	<small style="color: #006699;">Configura el porcentaje de la propina que el sistema cobrara de forma automática.</small>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>cmantenimiento/updPorcentajePropina">
              	<div class="box-body">
	                <div class="form-group">
	                  <label for="txtInsumo" class="col-sm-2 control-label">Propina %</label>
	                  <div class="col-sm-3">
	                    <input type="text" name="txtPorcentajePropina" class="form-control" placeholder="Porcentaje de propina" required>
	                  </div>
	                  <div class="col-sm-2">
	                    <input type="text" class="form-control" readonly="true" value="<?php echo $porcentajePropina;?>">
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