<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              	<h3 class="box-title"><i class="fa fa-key"></i> &nbsp;<b>Clave para autorización</b></h3><br>
            	<small style="color: #006699;">Esta clave sirve para que el administrador autorice disminución o cancelación de productos de un pedido.</small>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>cmantenimiento/updClaveAutorizacion">
              	<div class="box-body">
	                <div class="form-group">
	                  <label for="txtInsumo" class="col-sm-2 control-label">Clave</label>
	                  <div class="col-sm-4">
	                    <input type="text" name="txtClaveAutorizacion" class="form-control" placeholder="Ingrese la nueva clave" required>
	                  </div>
	                  <div class="col-sm-2">
	                    <input type="text" class="form-control" readonly="true" value="<?php echo $claveAutorizacion;?>">
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