<div class="row">
	<!-- left column -->
	<div class="col-md-12">
    <div class="col-xs-8">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Perfiles</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cusuario/regPerfil">
          <div class="box-body">

            <div class="form-group">
              <label for="txtPerfil" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-6">
              	<input type="text" name="txtPerfil" class="form-control" id="txtPerfil" placeholder="Perfil" required>
              </div>
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div><!-- /.box -->
  	</div>
    <div class="col-xs-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Perfiles</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tr>
              <th style="width: 25%">N°</th>
              <th>Perfil</th>
            </tr>
            <?php 
              foreach ($getPerfiles as $per) {
                echo "<tr>";
                echo "<td>".$per->idPerfil."</td>";
                echo "<td>".$per->descripcion."</td>";
                echo "</tr>";
              }
            ?>            
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
</div>