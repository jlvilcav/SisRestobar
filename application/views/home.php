<div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Indicadores internos</h3>
      </div><!-- /.box-header -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
	    <div class="inner">
	      <h3><div id="cntdCompras"><?php echo $cntdCompras; ?></h3>
	      <p>Compras</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-bag"></i>
	    </div>
	    <a href="<?php echo base_url();?>ccompras/gestorCompras" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
	    <div class="inner">
	      <h3><div id="cntdVentas"><?php echo $cntdVentas; ?></div></h3>
	      <p>Ventas</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-stats-bars"></i>
	    </div>
	    <a href="<?php echo base_url();?>cventa/gestorVentas" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
	    <div class="inner">
	      <h3><div id="cntdProductos"><?php echo $cntdProductos; ?></h3>
	      <p>Productos</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-pie-graph"></i>
	    </div>
	    <a href="<?php echo base_url();?>cproducto/gestorProducto" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
	    <div class="inner">
	      <h3 id="hTotalStockMin"></h3>
	      <p>Stock Minimo</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-ios-cloud-download-outline"></i>
	    </div>
	    <a href="<?php echo base_url();?>creportes/insStockMinimo" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div><!-- ./col -->
</div>
</div>

<!-- <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Indicadores economicos</h3>
      </div>
	<div class="row">
		<div class="col-lg-3 col-xs-6">
		  
		  <div class="small-box bg-aqua">
		    <div class="inner">
		      <h3><div id="totEfectivo"><?php echo $totalEfectivo; ?></h3>
		      <p>Efectivo</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-bag"></i>
		    </div>
		    <a class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		
		  <div class="small-box bg-green">
		    <div class="inner">
		      <h3><div id="totVisa"><?php echo $totalVisa; ?></div></h3>
		      <p>Visa</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-stats-bars"></i>
		    </div>
		    <a class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  
		  <div class="small-box bg-yellow">
		    <div class="inner">
		      <h3><div id="totMastercard"><?php echo $totalMastercard; ?></h3>
		      <p>Mastercard</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-pie-graph"></i>
		    </div>
		    <a class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
	</div>
</div>
 -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>js/home.js"></script>

<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//Cantidad Compras
		function updCntdCompras(){
			$.post(
				"<?php echo base_url(); ?>chome/getCantCompras",
				function(data){
					$('#cntdCompras').html(data);
				}
			);
		};setInterval(updCntdCompras,20000);

		//Cantidad ventas
		function updCntdVentas(){
			$.post(
			"<?php echo base_url(); ?>chome/getCantVentas",
			function(data){
				$('#cntdVentas').html(data);		
			}
		);
		};setInterval(updCntdVentas,8000);

		//Cantidad ventas
		function updCntdProductos(){
			$.post(
			"<?php echo base_url(); ?>chome/getCantProductos",
			function(data){
				$('#cntdProductos').html(data);		
			}
		);
		};setInterval(updCntdProductos,8000);		

		// //Total efectivo
		// function updTotEfectivo(){
		// 	$.post(
		// 	"<?php echo base_url(); ?>chome/getTotalEfectivo",
		// 	function(data){
		// 		$('#totEfectivo').html(data);		
		// 	}
		// );
		// };setInterval(updTotEfectivo,8000);

		// //Total visa
		// function updTotVisa(){
		// 	$.post(
		// 	"<?php echo base_url(); ?>chome/getTotalVisa",
		// 	function(data){
		// 		$('#totVisa').html(data);		
		// 	}
		// );
		// };setInterval(updTotVisa,8000);

		// //Total mastercard
		// function updTotMastercard(){
		// 	$.post(
		// 	"<?php echo base_url(); ?>chome/getTotalMastercard",
		// 	function(data){
		// 		$('#totMastercard').html(data);		
		// 	}
		// );
		// };setInterval(updTotMastercard,8000);	
		
	});
</script>