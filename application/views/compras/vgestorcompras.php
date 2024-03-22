<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Compras</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          <div class="row">
            <div class="col-xs-3">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total compras</span>
                  <?php
                    $row = 0;
                    foreach ($listCompras as $fila) {
                      $row++;
                    }
                    echo "<span class='info-box-number'>$row</span>";
                  ?>
                  
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    Total de compras
                  </span>
                </div>
              </div>
            </div>

            <div class="col-xs-3">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total egresos por compras</span>
                  <?php
                    $total = 0;
                    foreach ($listCompras as $fila) {
                      $total += $fila->total;
                    }
                    echo "<span class='info-box-number'>$total</span>";
                  ?>                
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    Importe egreso por compras
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-6"></div>


          <!-- Data table -->
          <div class="form-group">
            <!--<div class="col-sm-1"></div>-->
            <div class="col-sm-12">
              <div class="box-body no-padding">
                  <table class="display" id="tblAllCompras">
                    <thead>
                      <tr>
                        <th style="width: 5%;background-color: #0E759D; color: white;">N°</th>
                        <th style="width: 20%;background-color: #0E759D; color: white;">Proveedor</th>
                        <th style="width: 15%;background-color: #0E759D; color: white;">Fec.Comp.</th>
                        <th style="width: 22%;background-color: #0E759D; color: white;">Empleado</th>
                        <th style="width: 10%;background-color: #0E759D; color: white;">Recibo</th>
                        <th style="width: 10%;background-color: #0E759D; color: white;">N°Compra</th>
                        <th style="width: 10%;background-color: #0E759D; color: white; text-align: center;">Total</th>
                        <th style="width: 8%;background-color: #0E759D; color: white;">Ver</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $row = 1;
                        foreach ($listCompras as $fila) {
                          echo "<tr>";
                          echo "<td align='center'>$row</td>";
                          echo "<td style='color:#006699;'><i class='fa fa fa-user'></i> &nbsp; $fila->razonSocial</td>";
                          echo "<td>$fila->fecCompra</td>";
                          echo "<td style='color:#4F7C0F;'><i class='fa fa-child'></i> &nbsp; $fila->empleado</td>";
                          echo "<td>$fila->descripcion</td>";
                          echo "<td align='center'>$fila->numCompraGenerado</td>";
                          echo "<td style='color:#f39c12; font-weight:bold; text-align:center;'>$fila->total</td>";
                          echo "<td><a href='".base_url()."ccompras/getDetalleCompra/".
                          $fila->idCompra."/".
                          str_replace(" ","-",$fila->razonSocial)."/".
                          str_replace(" ","_",str_replace("/","-",$fila->fecCompra))."/".
                          $fila->numCompraGenerado."/".
                          $fila->total."'".
                          " class='btn btn-block btn-primary btn-sm' style='width: 80%;'><i class='fa fa-fw fa-external-link-square'></i></a></td>";
                          echo "</tr>";
                          $row++;
                        }
                      ?>
                    </tbody>                                        
                  </table>
                </div><!-- /.box-body --> 
            </div>
            <!--<div class="col-sm-1"></div>-->
          </div>

        </div>
      </form>
    </div><!--end box box-info-->
  </div>
</div><!--end row-->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Page script -->
<script>
  $(document).ready(function () {

    //Money Euro
    $("[data-mask]").inputmask();

    $('#tblAllCompras').DataTable({
      'paging': true,
      'info': false,
      'stateSave': true
    });

    
  });
</script>
