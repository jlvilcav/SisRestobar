<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
      	<div class="col-sm-1"></div>
        <h3 class="box-title">Detalles de la Venta</h3>
      </div><!-- /.box-header -->
      <br>
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

        	<div class="form-group">
        		<div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-credit-card"></i> &nbsp;&nbsp; N° Venta</label>
	            <label class="col-sm-4" style="color: #888;"><?php echo $numVentaGenerado; ?></label>	            
          	</div>

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-calendar"></i> &nbsp;&nbsp; Fecha</label>
	            <label class="col-sm-4" style="color: #888;"><?php echo str_replace("_"," ",str_replace("-","/",$fecVenta)); ?></label>	            
          	</div>
<!-- 
          	<div class="form-group">
	            <label class="col-sm-2 control-label">Documento</label>
	            <label class="col-sm-2 control-label" style="color: #009ABF;">Boleta</label>	            
          	</div> -->

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-user"></i> &nbsp;&nbsp; Cliente</label>
	            <label class="col-sm-4" style="color: #888;"><?php echo str_replace("-"," ",str_replace(".",",",$cliente)); ?></label>	            
          	</div>

          	<!-- <div class="form-group">
	            <label class="col-sm-2 control-label">Sub-total</label>
	            <label class="col-sm-2 control-label" style="color: #009ABF;">464.60</label>	            
          	</div> -->

          	<!-- <div class="form-group">
	            <label class="col-sm-2 control-label">I.G.V.</label>
	            <label class="col-sm-2 control-label" style="color: #009ABF;">40.40</label>	            
          	</div> -->

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-dollar"></i> &nbsp;&nbsp; Total</label>
	            <label class="col-sm-4" style="color: #888;"><?php echo $total; ?></label>	            
          	</div>

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-dollar"></i> &nbsp;&nbsp; Propina</label>
	            <label class="col-sm-4" style="color: #888;"><?php echo $propina; ?></label>	            
          	</div>
			<br>
          	<div class="form-group">
		        <div class="col-sm-1"></div>
		        <div class="col-sm-8">
		          <div class="box-body no-padding">
		              <table class="display" id="tblDetalleCompra">
		              	<thead>
			                <tr>
			                  <th style="width: 5%;background-color: #0E759D; color: white;">N°</th>
			                  <th style="width: 35%;background-color: #0E759D; color: white;">Producto</th>
			                  <th style="width: 15%;background-color: #0E759D; color: white;">Cantidad</th>
			                  <th style="width: 15%;background-color: #0E759D; color: white;">P. Costo</th>
			                  <th style="width: 10%;background-color: #0E759D; color: white;">P. Total</th>
			                </tr>
		           		</thead>
		           		<tbody>
			                <?php 
			                	$row = 1;
			                	foreach ($listDetalleVenta as $fila) {
			                		echo "<tr>";
			                		echo "<td align='center'>$row</td>";
			                		echo "<td style='color:#006699;'>$fila->nombre</td>";
			                		echo "<td align='center'>$fila->cant</td>";
			                		echo "<td align='center'>$fila->pUnit</td>";
			                		echo "<td align='center' style='color:#4F7C0F;'>$fila->pTotal</td>";
			                		echo "</tr>";
			                		$row++;
			                	}
			                ?>
		                </tbody>	                
		              </table>
		            </div><!-- /.box-body -->	
		        </div>
		        <div class="col-sm-1"></div>
	        </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tblDetalleCompra').DataTable({
	      'paging': true,
	      'info': false,
	      'stateSave': true
	    });
	});
</script>