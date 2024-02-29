<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Registro de Empresa</h3>
			</div><!-- /.box-header -->

			<form class="form-horizontal" action="<?php echo base_url(); ?>csucursal/regSucursal" method="POST">
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
		</div>
	</div>
</div>