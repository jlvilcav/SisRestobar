<div class="row">
	<!-- left column -->
	<div class="col-md-12">

    <div class="box box-info">

      <div class="box-header">
        <div class="col-sm-1"></div>
        <div class="col-sm-9">
          <h3 class="page-header"><i class="fa fa-list-ul"></i> &nbsp; Lista de sucursales
          <a href="<?php echo base_url();?>csucursal/sucursal" class="btn pull-right bg-green">
            <i class="fa fa-plus"></i> &nbsp;Nuevo
          </a>
          </h3>
        </div>
      </div><!-- /.box-header -->

      <div class="box-body box-primary">
        <div class="col-sm-1"></div>
        <div class="col-sm-9">
          <table class="table table-striped" id="tblSucursales">
            <thead>
              <tr>
                <th style='width: 10%; background-color: #006699; color:white; text-align: center;'>N°</th>
                <th style='width: 20%; background-color: #006699; color:white;'>Sucursal</th>
                <th style='width: 30%; background-color: #006699; color:white;'>Dirección</th>
                <th style='width: 30%; background-color: #006699; color:white;'>Observación</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $row = 1;
                foreach ($listSucursal as $ls) {
                  echo "<tr>";
                  echo "<td align='center'>".$row."</td>";
                  echo "<td style='color:#006699;'><i class='fa fa-home'></i> &nbsp;&nbsp;&nbsp;".$ls->nombre."</td>";
                  echo "<td style='color:#4F7C0F;'>".$ls->direccion."</td>";
                  echo "<td>".$ls->observacion."</td>";
                  echo "</tr>";
                  $row++;
                }
              ?>   
            </tbody>
          </table>
        </div>

      </div><!-- /.box-body -->
    </div><!-- /.box -->

  </div>
</div>

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tblSucursales').DataTable({
      'paging': true,
      'info': false,
      'stateSave': true
    });
  });
</script>