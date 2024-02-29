<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
      	<div class="col-sm-1"></div>
        <h3 class="box-title">Detalles de la compra</h3>
      </div><!-- /.box-header -->
      <br>
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

        	<div class="form-group">
        		<div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-credit-card"></i> &nbsp;&nbsp; N° Compra</label>
	            <label class="col-sm-2" style="color: #888;"><?php echo $numCompra; ?></label>	            
          	</div>

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-calendar"></i> &nbsp;&nbsp; Fecha</label>
	            <label class="col-sm-2" style="color: #888;"><?php echo str_replace("_"," ",str_replace("-","/",$fecCompra)); ?></label>	            
          	</div>
<!-- 
          	<div class="form-group">
	            <label class="col-sm-2 control-label">Documento</label>
	            <label class="col-sm-2 control-label" style="color: #009ABF;">Boleta</label>	            
          	</div> -->

          	<div class="form-group">
	            <div class="col-sm-2"></div>
	            <label class="col-sm-2" style="color: #006699;"><i class="fa fa fa-user"></i> &nbsp;&nbsp; Proveedor</label>
	            <label class="col-sm-2" style="color: #888;"><?php echo str_replace("-"," ",$razonSocial); ?></label>	            
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
	            <label class="col-sm-2" style="color: #888;"><?php echo $total; ?></label>	            
          	</div>
			<br>
          	<div class="form-group">
		        <div class="col-sm-1"></div>
		        <div class="col-sm-9">
		          <div class="box-body no-padding">
		              <table class="display" id="tblDetalleCompra">
		              	<thead>
			                <tr>
			                  <th style="width: 5%;background-color: #0E759D; color: white;">N°</th>
			                  <th style="width: 35%;background-color: #0E759D; color: white;">Insumo</th>
			                  <th style="width: 15%;background-color: #0E759D; color: white;">Cantidad</th>
			                  <th style="width: 15%;background-color: #0E759D; color: white;">P. Costo</th>
			                  <th style="width: 10%;background-color: #0E759D; color: white;">P. Total</th>
			                </tr>
		           		</thead>
		           		<tbody>
			                <?php 
			                	$row = 1;
			                	foreach ($listDetalleCompra as $fila) {
			                		echo "<tr>";
			                		echo "<td align='center'>$row</td>";
			                		echo "<td style='color:#006699;'>$fila->descripcion</td>";
			                		echo "<td align='center'>$fila->cant</td>";
			                		echo "<td align='center'>$fila->pcosto</td>";
			                		echo "<td align='center' style='color:#4F7C0F;'>$fila->ptotal</td>";
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