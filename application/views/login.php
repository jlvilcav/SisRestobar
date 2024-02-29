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
        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/font-awesome/css/font-awesome.min.css"> -->


        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css"> -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />

        <style>
            .contenedor{
                /*background-image: url("http://www.clicktomsystem.com/wp-content/uploads/Programa-de-un-Restaurante.png") no-repeat;*/
                width: 100%;
                min-height: 100%;
                background: url(<?php echo base_url(); ?>assets/img/fondo<?php echo rand(1, 4);?>.jpg) no-repeat center center fixed; 
                background-size: cover;
                position: absolute;
                top: 0; 
                left: 0;
                z-index: 0;
            }

            .layer {
                background-color: rgba(243, 243, 243, 0.3);
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }

        </style>
    </head>
    <body class="hold-transition login-page">  <!-- background="<?php echo base_url(); ?>assets/img/fondo1.jpg" -->
        <div class="contenedor">
            <div class="layer"></div>
            <div class="login-box" style="background-color: white; padding: 20px;">
                <div class="login-logo">
                    <!-- <i class="glyphicon glyphicon-apple"></i> --> &nbsp;<a href="#"><b>Sist</b>Restobar</a>
                    <div style="color: #888; font-size: 0.5em;">
                        <small>Bienvenido a <b>Sist</b>Restobar <?php echo $this->config->item('version_sistema'); ?></small>                        
                    </div>
                </div><!-- /.login-logo -->
                <div class="login-box-body">
                    <!-- <p class="login-box-msg">Identifíquese para iniciar sesión</p> -->
                    <form action="<?php echo base_url(); ?>clogin/login" method="POST">
                        <div class="form-group has-feedback">
                            <input type="text" name="txtNomUsuario" class="form-control" placeholder="Usuario" maxlength="8" autofocus>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="txtClave" class="form-control" placeholder="Contraseña">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <!-- <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox"> Recuerdame
                                    </label>
                                </div> -->
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                            </div><!-- /.col -->
                        </div>
                    </form>

                    <!-- <a href="#">Olvide mi contraseña</a><br> -->
                    <?php echo  $this->session->flashdata('mensaje'); ?>
                    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
                    <br>

                </div><!-- /.login-box-body -->
                <div class="login-box-footer" style="border-top: 1px solid #CCC; font-size: 0.8em; padding: 10px; color: #888;">
                    <!-- <div class="pull-right hidden-xs">
                        <b>Version</b> <?php echo $this->config->item('version_sistema'); ?>
                    </div> -->
                    <strong>Copyright &copy; <?php echo Date('Y');?> <a href="http://www.intecsolt.com" target="_blank">INTECSolt</a></strong> | Todos los derechos reservados.
                </div>
            </div><!-- /.login-box -->
        </div>
            

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
  </body>
</html>
