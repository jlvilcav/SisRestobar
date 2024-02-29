
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>ITS</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets//bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/font-awesome/css/font-awesome.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE_lk.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins-lk.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />
		<style type="text/css" media="screen">
			.cook-1:hover{
				color: #dc3545;
			}
			.cook-2:hover{
				color: #007bff;
			}
		</style>
	</head>
	<body class="hold-transition" style="background-color: #EEE;">
		<input type="hidden" name="hdnNumCocina" id="hdnNumCocina" value="<?php echo $opc?>">
		<div class="row">
			<div class="col-sm-12">
				
				<div class="col-md-12">
				    <div class="box box-primary">
				      	<div class="box-header with-border">
					        <h3 class="box-title">Pedidos Entregados</h3>
					        <a href="<?php echo base_url();?>ccocina/cocina/<?php echo $opc?>" class="btn btn-success pull-right">Ver vigentes</a>
				      	</div>
				        <div class="box-body" style="font-size: 1.5em !important;">
							<table class="table table-bordered table-hover" id="tblProductos">
								<tbody></tbody>
							</table>
				        </div>

				    </div>
				</div>
			</div>
		</div>


		<footer class="col-sm-12" style="bottom: 0px; position: fixed; background-color: white; padding: 10px;">
			<div class="pull-right hidden-xs">
				<b>Version</b> <?php echo $this->config->item('version_sistema'); ?>
			</div>
			<strong>Copyright &copy; <?php echo Date('Y');?> <a href="http://www.intecsolt.pe" target="_blank">INTECSolt</a>.</strong> Todos los derechos reservados.
		</footer>

	<!-- jQuery 2.1.4 -->
	<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

	<script>
		var baseurl = "<?php echo base_url(); ?>";
	</script>
	<script>
		$(document).ready(function() {

			let opc = $('#hdnNumCocina').val();

			// getProductos(opc);

			function getProductos(opc){
				$.ajax({
					url: baseurl + 'ccocina/getProductosPorCocinaFinalizado',
					type: 'POST',
					dataType: 'json',
					data: {opc: opc},
				})
				.done(function(data) {

					$('#tblProductos tbody').html('');

					var mesa = 0;
					var cab = 0; //tiene cabecera? (mesa)
					
					$.each(data, function(i, item) {

						if (item.mesa == mesa) {
							if (cab == 0) {
								$('#tblProductos tbody').append(
										'<tr>' + 
										'	<td colspan="4" style="background-color: #DDD; color: #006699;"><i class="fa fa-check-square"></i> &nbsp; MESA '+item.mesa + '</td>' +
										'</tr>'
									);
								cab = 1;
							}else{

								$('#tblProductos tbody').append('<tr>' + 
									'<td style="width: 40%;">&nbsp;&nbsp;&nbsp;&nbsp; ' + item.producto + '</td>' + 
									'<td style="width: 10%; background-color: #EDF0FD; text-align: center;"><span>' + item.cntd + '</span></td>' + 
									'<td style="width: 30%;">' + item.observacion + '</td>' + 
									'<td style="width: 20%; text-align: center;">' + 
									'	<div class="btn btn-danger"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;' + item.demora + ' min.</div>' +
									'</td>' + 
									'</tr>');
							}
						}else{
							mesa = item.mesa;
							$('#tblProductos tbody').append(
										'<tr>' + 
										'	<td colspan="4" style="background-color: #DDD; color: #006699;"><i class="fa fa-check-square"></i> &nbsp; MESA '+item.mesa + '</td>' +
										'</tr>'
									);

							$('#tblProductos tbody').append('<tr>' + 
									'<td style="width: 40%;">&nbsp;&nbsp;&nbsp;&nbsp; ' + item.producto + '</td>' + 
									'<td style="width: 10%; background-color: #EDF0FD; text-align: center;"><span>' + item.cntd + '</span></td>' + 
									'<td style="width: 30%;">' + item.observacion + '</td>' + 
									'<td style="width: 20%; text-align: center;">' + 
									'	<div class="btn btn-danger"><i class="fa fa-clock-o"></i> &nbsp;&nbsp;' + item.demora + ' min.</div>' +
									'</td>' + 
									'</tr>');
								cab = 1;
						}
					});
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});				
			};

			setInterval(function() {
			    getProductos(opc);
			}, 4000);
			
		});
	</script>

  </body>
</html>
