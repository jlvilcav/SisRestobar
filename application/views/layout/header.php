<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RESTOBAR</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap_lk.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE_lk.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins-lk.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css"> -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/css/jquery.dataTables.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />


    <style>
        label.error {
            color: #cc5965;
            display: inline-block;
            margin-left: 5px;
        }
        .form-control.error {
            border: 1px dotted #cc5965;
        }
    </style>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <?php if ($this->session->userdata('s_idUsuario')) : ?>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>clogin/login" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>IT</b>S</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sist</b>Restobar</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>

                    <ul class="menu">
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> -->
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li> -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>

                    <ul class="menu">
                      <li>
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li> -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/man_user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('s_usu');?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/img/man_user.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('s_usu')."<br/>".$this->session->userdata('s_nomPerfil');?>
                      <small><?php echo $this->session->userdata('s_nomSucursal');?></small>
                    </p>
                  </li>
                  <!-- Menu Body 
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>cusuario/profileOfUser" class="btn btn-default btn-flat"><i class='fa fa-user'></i> &nbsp;Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>clogin/logout" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> &nbsp;Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button 
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/dist/img/man_user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('s_usu');?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">NAVEGACION</li>
            <!-- Empresa -->
            <li class="treeview <?php if($this->uri->segment(1)=='cempresa'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-industry"></i> <span>Empresa</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cempresa" ><i class="fa fa-circle-o"></i> Configurar</a></li>
              </ul>
            </li>
            <!-- Sucursal -->
            <li class="treeview <?php if($this->uri->segment(1)=='csucursal'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-industry"></i> <span>Sucursal</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>csucursal" ><i class="fa fa-circle-o"></i> Sucursal</a></li>
                <li><a href="<?php echo base_url(); ?>csucursal/cajas"><i class="fa fa-circle-o"></i> Cajas</a></li>
                <li><a href="<?php echo base_url(); ?>csucursal/mesas"><i class="fa fa-circle-o"></i> Mesas</a></li>
              </ul>
            </li>

            <!-- Personal de la empresa -->
            <li class="treeview <?php if($this->uri->segment(1)=='cpersona' || $this->uri->segment(1)=='cusuario'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-user"></i> <span>Empleado/Usuario</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cpersona/persona"><i class="fa fa-circle-o"></i> Registro Empleado</a></li>
                <li><a href="<?php echo base_url(); ?>cusuario/usuario"><i class="fa fa-circle-o"></i> Usuario</a></li>
                <li><a href="<?php echo base_url(); ?>cpersona/gestorEmpleado"><i class="fa fa-circle-o"></i> Gestor de Empleados</a></li>
                <!-- <li><a href="<?php echo base_url(); ?>cusuario/perfiles"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a href="<?php echo base_url(); ?>cusuario/permisos"><i class="fa fa-circle-o"></i> Permisos</a></li> -->
              </ul>
            </li>

            <!-- Almacen -->
            <li class="treeview <?php if($this->uri->segment(1)=='cinsumo'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-archive"></i> <span>Almacen</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cinsumo/categInsumo"><i class="fa fa-circle-o"></i> Categoria Insumo</a></li>
                <li><a href="<?php echo base_url(); ?>cinsumo/insumo"><i class="fa fa-circle-o"></i> Insumos</a></li>
                <li><a href="<?php echo base_url(); ?>cinsumo"><i class="fa fa-circle-o"></i> Gestor de Insumos</a></li>
              </ul>
            </li>

            <!-- Compras -->
            <li class="treeview <?php if($this->uri->segment(1)=='cproveedor' || $this->uri->segment(1)=='ccompras'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>Compras</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cproveedor/proveedor"><i class="fa fa-circle-o"></i> Proveedor</a></li>
                <li><a href="<?php echo base_url(); ?>ccompras/compraInsumo"><i class="fa fa-circle-o"></i> Compras</a></li>
                <li><a href="<?php echo base_url(); ?>ccompras/gestorCompras"><i class="fa fa-circle-o"></i> Gestor Compras</a></li>
              </ul>
            </li>

            <!-- Productos -->
            <li class="treeview <?php if($this->uri->segment(1)=='cproducto'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-bitbucket-square"></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cproducto/categProducto"><i class="fa fa-circle-o"></i> Categoria producto</a></li>
                <li><a href="<?php echo base_url(); ?>cproducto/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="<?php echo base_url(); ?>cproducto/gestorProducto"><i class="fa fa-circle-o"></i> Gestor producto</a></li>
              </ul>
            </li>

            <!-- Reportes -->
            <li class="treeview <?php if($this->uri->segment(1)=='creportes'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-sticky-note"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cventa/gestorVentas"><i class="fa fa-circle-o"></i> Detalle Ventas</a></li>
                <li><a href="<?php echo base_url(); ?>creportes/repVentas"><i class="fa fa-circle-o"></i> Estadistica de Ventas</a></li>
                <li><a href="<?php echo base_url(); ?>creportes/insConsumido"><i class="fa fa-circle-o"></i> Insumos Consumidos</a></li>
                <li><a href="<?php echo base_url(); ?>creportes/insStockMinimo"><i class="fa fa-circle-o"></i> Insumos Stock Min.</a></li>
                <li><a href="<?php echo base_url(); ?>creportes/insStock"><i class="fa fa-circle-o"></i> Stock de Insumos</a></li>
              </ul>
            </li>

            <!-- Caja -->
            <li class="treeview <?php if($this->uri->segment(1)=='caperturacierre'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-opencart"></i> <span>Caja A/C</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>caperturacierre/aperturaCierre"><i class="fa fa-circle-o"></i> Apertura/Cierre</a></li>
              </ul>
            </li>

            <!-- Egresos -->
            <!-- <li>
              <a href="<?php echo base_url(); ?>CMenu/egresos">
                <i class="fa fa-mail-forward"></i> <span>Egreso</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li> -->

            <!-- Incidencias -->
            <!-- <li class="treeview <?php if($this->uri->segment(2)=='regIncidencias' || $this->uri->segment(2)=='gestorIncidencias'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-pencil-square-o"></i> <span>Incidencias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>CMenu/regIncidencias"><i class="fa fa-circle-o"></i> Registro incidecia</a></li>
                <li><a href="<?php echo base_url(); ?>CMenu/gestorIncidencias"><i class="fa fa-circle-o"></i> Gestor incidecia</a></li>
              </ul>
            </li> -->

            <!-- Pagos S/P -->
            <!-- <li class="treeview <?php if($this->uri->segment(2)=='pagoEmpleados' || $this->uri->segment(2)=='pagoServicios'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-sign-out"></i> <span>Pagos S/P</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>CMenu/pagoEmpleados"><i class="fa fa-circle-o"></i> Empleados</a></li>
                <li><a href="<?php echo base_url(); ?>CMenu/pagoServicios"><i class="fa fa-circle-o"></i> Servicios</a></li>
              </ul>
            </li> -->

            <!-- Mantenimiento -->
            <li class="treeview <?php if($this->uri->segment(1)=='cmantenimiento'){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-th"></i> <span>Configuración</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>cmantenimiento/claveautorizacion"><i class="fa fa-circle-o"></i> Clave autorización</a></li>
                <li><a href="<?php echo base_url(); ?>cmantenimiento/simbolomoneda"><i class="fa fa-circle-o"></i> Simbolo Moneda</a></li>
                <li><a href="<?php echo base_url(); ?>cmantenimiento/porcentajepropina"><i class="fa fa-circle-o"></i> Porcentaje propina</a></li>
                <li><a href="<?php echo base_url(); ?>cmantenimiento/unidad"><i class="fa fa-circle-o"></i> Unidad</a></li>
                <li><a href="<?php echo base_url(); ?>cmantenimiento/medida"><i class="fa fa-circle-o"></i> Medida</a></li>
              </ul>
            </li>

            <li class="header">OTROS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Ayuda</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>INTECSolt</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
          <!--<h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">

<?php else : 

  redirect('clogin');

?>

    <?php endif; ?>