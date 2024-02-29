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
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">

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
	<body class="hold-transition login-page">
		<div class="col-sm-12">
			<div class="login-logo">
				<br>
                <a href="#"><b>Sist</b>Restobar <?php echo $this->config->item('version_sistema'); ?></a>
            </div><!-- /.login-logo -->
		</div>
		<div class="col-sm-12" style="top: 20px;">
			<div class="col-sm-6" style="text-align: center; vertical-align: middle; padding: 40px 15px 40px 80px;">
				<a class="btn btn-app cook-1" href="<?php echo base_url();?>ccocina/cocina/C" style="padding: 30px; width: 100%; height: 100%; border: 2px #999 solid;">
					<i class="fa fa-fire" style="font-size: 15em;"></i><h1>COCINA <b>01</b></h1>
				</a>
			</div>
			<div class="col-sm-6" style="text-align: center; vertical-align: middle; padding: 40px 80px 40px 15px;">
				<a class="btn btn-app cook-2" href="<?php echo base_url();?>ccocina/cocina/C2" style="padding: 30px; width: 100%; height: 100%; border: 2px #999 solid; border-radius: 20px;">
					<i class="fa fa-cutlery" style="font-size: 15em;"></i><h1>COCINA <b>02</b></h1>
				</a>
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
	<!-- iCheck -->
	<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

  </body>
</html>
