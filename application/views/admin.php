<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php?>
	<?php
		if (!$this->session->userdata('s_idUsuario')):
			//redirect('usuario/VLsogin');
	?>
		<h1>ERROR <?php echo $this->session->userdata('s_idUsuario') ?></h1>
	<?php
		else : 			
	?>
		<h1>BIENVENIDOS ADMINISTRADOR <?php echo $this->session->userdata('s_idUsuario') ?></h1>
		<a href="<?php echo base_url();?>CLogin/logout">Cerrar sesion</a>
	<?php
		endif;
	?>
</body>
</html>