<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/css/jquery.dataTables.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />
  </head>
  <body class="hold-transition skin-blue sidebar-mini bg-gray">
<!-- Main content -->
<div class="col-md-2"></div>
<section class="content col-xs-8">

  <div class="row">
    <div class="col-md-4">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/man_user.png" alt="User profile picture">
          <h3 class="profile-username text-center"><?php echo $this->session->userdata('s_usu');?></h3>
          <p class="text-muted text-center"><?php echo $this->session->userdata('s_nomPerfil');?></p>

          <!-- <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Sucursal</b> <a class="pull-right"><?php echo $this->session->userdata('s_nomSucursal');?></a>
            </li>
          </ul> -->
          <?php if ($this->session->userdata('s_idPerfil') == 3): ?>
            <a href="<?php echo base_url(); ?>ccajero" class="btn btn-primary btn-block"><i class="fa fa-reply-all"></i> &nbsp;&nbsp;&nbsp;<b>Regresar</b></a>
          <?php elseif ($this->session->userdata('s_idPerfil') == 4): ?>
            <a href="<?php echo base_url(); ?>cmozo/mozo" class="btn btn-primary btn-block"><i class="fa fa-reply"></i> &nbsp;&nbsp;&nbsp;<b>Regresar</b></a>
          <?php endif ?>
          
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Cambiar mi contraseña</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          
          <form class="form-horizontal">
            <div class="form-group has-feedback">
              <div class="col-sm-12">
                <input type="password" class="form-control" id="txtClaveActual" placeholder="Contraseña actual" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
            </div>
            <hr>
            <div class="form-group has-feedback">
              <div class="col-sm-12">
                <input type="password" class="form-control" id="txtClaveNueva" placeholder="Nueva Contraseña" required>
                <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
              </div>
            </div>
            <div class="form-group has-feedback">
              <div class="col-sm-12">
                <input type="password" class="form-control" id="txtClaveNuevaRepite" placeholder="Repite la contraseña" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" id="btnChangePassword" class="btn btn-info">Cambiar contraseña</button>
              </div>
            </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div><!-- /.col -->
    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tabCaja" data-toggle="tab">Cajas <i class="fa fa-opencart"></i></a></li>
          <li><a href="#tabIncidencias" data-toggle="tab">Incidencias</a></li>
          <li><a href="#tabDatos" data-toggle="tab">Actualizar datos</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="tabCaja">
            
            <div class="form-group">
              <div class="col-sm-12">
                <button type="button" id="btnVerCaja" class="btn btn-info" onclick="selCaja(<?php echo $this->session->userdata('s_idCaja');?>);"><i class="fa fa-dollar"></i> &nbsp;&nbsp;Ver Caja</button> &nbsp;&nbsp;
                <a href="<?php echo base_url();?>caperturacierre/imprimeCaja" id="btnImprimeCaja" target="_blank" class="btn bg-yellow" ><i class="fa fa-print"></i> &nbsp;&nbsp;Print Caja</a>
              </div>
            </div>
            <br>
            <div class="col-sm-12">
              <div class="box-body">
                <table id="tblInfoCaja" style="display:none;">
                  <tr>
                    <td colspan="3" style="width:100%;color:#444;font-size: 14pt;"><span id="lblFecApertura"></span></td>
                  </tr>
                  <tr>
                    <td colspan="3" style="width:100%;color:#444;font-size: 14pt;"><span id="lblTotalApertura"></span></td>
                  </tr>
                  <tr>
                    <td colspan="3"><br></td>
                  </tr>
                  <tr>
                    <td style="width:33.3%;color:#006699;"><b>EFECTIVO</b></td>
                    <td style="width:33.3%;color:#006699;"><b>VISA</b></td>
                    <td style="width:33.3%;color:#006699;"><b>MASTERCARD</b></td>
                  </tr>
                  <tr>
                    <td><div class="btn btn-info" style="width:90%;" id="lblEfectivo"></div></td>
                    <td><div class="btn btn-primary" style="width:90%;" id="lblVisa"></div></td>
                    <td><div class="btn btn-danger bg-yellow" style="width:90%;" id="lblMastercard"></div></td>
                  </tr>
                  <tr>
                    <td colspan="3"><div id="lblTotal"></div></td>
                  </tr>
                </table>
                  <!-- <table class="table table-striped" id="tblTotales" style="border: 0.1px #EEE solid;">
                  <caption>Totales</caption>
                    <tr>
                      <th style="width: 10%;background-color: #006699;color: white;text-align: center;">N°</th>
                      <th style="width: 25%;background-color: #006699;color: white;">Efectivo</th>
                      <th style="width: 25%;background-color: #006699;color: white;">Visa</th>
                      <th style="width: 10%;background-color: #006699;color: white;">MasterCard</th>
                    </tr>
                    
                  </table> -->
                </div><!-- /.box-body --> 
            </div>

            <label></label>

          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="tabIncidencias">
            <label>No se registraron incidencias.</label>
          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="tabDatos">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">DNI</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputName" placeholder="Name" value="<?php echo $this->session->userdata('s_nomUsuario');?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Escribe tu numero telefonico">
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" placeholder="ingresa tu Email">
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>

          </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
  </div><!-- /.row -->

</section><!-- /.content -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var baseurl = "<?php echo base_url();?>";

    $('#btnChangePassword').click(function(){
      ca = $('#txtClaveActual').val();
      cn = $('#txtClaveNueva').val();
      cnr = $('#txtClaveNuevaRepite').val();
      
      if (ca == null || ca == '') {
        alert('Ingrese contraseña actual');
        $('#txtClaveActual').focus();
      }else{
        
        $.post("<?php echo base_url();?>cusuario/verifUsuClave",
          {clave:ca},
          function(data){
            //alert(data);
            if (data == 1) {
              if (cn == '') {
                alert('Ingrese la nueva contraseña');
                $('#txtClaveNueva').focus();
              }else if(cnr == ''){
                alert('Repita la nueva contraseña');
                $('#txtClaveNuevaRepite').focus();
              }else if(cn != cnr){
                alert('Las constraseñas no coinciden');
                $('#txtClaveNueva').val('');
                $('#txtClaveNuevaRepite').val('');
                $('#txtClaveNueva').focus();
              }else{
                $.post("<?php echo base_url();?>cusuario/changePassword",
                  {nclave:cn},
                  function(data){
                    $('#txtClaveActual').val('');
                    $('#txtClaveNueva').val('');
                    $('#txtClaveNuevaRepite').val('');
                    alert(data);
                  });
              }

            }else{
              alert('Contraseña actual errada.');
              $('#txtClaveActual').val('');
              $('#txtClaveActual').focus();
            }
          }); 
      }
      
    });

    selCaja = function(idCaja){
      
      $('#tblInfoCaja').css('display','block');
      var total = 0;
      var fecApert = '';

      // Get fecha apertura de la caja
      $.ajax({
        url: baseurl+"caperturacierre/getFecApertura",
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {idC:idCaja},
      })
      .done(function(data) {
        fecApert = data;
        // alert(fecApert);
            $('#lblFecApertura').html('<b>* Fecha Apertura : <span style="color:#CC4956;">' + fecApert + '</span></b>');
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      //Con cuanto se aperturo la caja
      // $.post(baseurl+"caperturacierre/getCantApertura",  
      // {idC:idCaja},     
      // function(data){
      //   var v = data;
      //   if (v == null || v == '') {v = '0.00';}
      //   $('#lblTotalApertura').html('<b>Esta caja se aperturo con :</b> ' + parseFloat(v).toFixed(2));
      // });
      var cantApert = 0;
      //Con cuanto se aperturo la caja
      $.ajax({
        url: baseurl+"caperturacierre/getCantApertura",
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {idC:idCaja},
      })
      .done(function(data) {
        cantApert = data;
        var v = data;
            if (v == null || v == '') {v = '0.00';}
            $('#lblTotalApertura').html('<b>* Esta caja se aperturo con : <span style="color:#CC4956;">' + parseFloat(v).toFixed(2)+ '</span></b>');
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      //Total efectivo ingresado (sin la cantidad de la apertura)
      // $.post(baseurl+"caperturacierre/getTotalEfectivo",  
      // {idC:idCaja},     
      // function(data){
      //   var v = data;
      //   if (v == null || v == '') {v = '0.00';}
      //   $('#lblEfectivo').html(v);
      //   total += parseFloat(v);
      //   $('#lblTotal').html('<b style="font-size:14pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
      // });
      $.ajax({
        url: baseurl+"caperturacierre/getTotalEfectivo",
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {idC:idCaja, fecApert:fecApert},
      })
      .done(function(data) {
        // alert(data);
        var v = data;
        if (v == null || v == '') {v = '0.00';}
        $('#lblEfectivo').html(v);
        total += parseFloat(v) + parseFloat(cantApert);
        // $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
        $('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      //Visa
      // $.post(baseurl+"caperturacierre/getTotalVisa",  
      // {idC:idCaja},     
      // function(data){
      //   var v = data;
      //   if (v == null || v == '') {v = '0.00';}
      //   $('#lblVisa').html(v);
      //   total += parseFloat(v);
      //   $('#lblTotal').html('<b style="font-size:14pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
      // });
      $.ajax({
        url: baseurl+"caperturacierre/getTotalVisa",
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {idC:idCaja, fecApert:fecApert},
      })
      .done(function(data) {
        var v = data;
        if (v == null || v == '') {v = '0.00';}
        $('#lblVisa').html(v);
        total += parseFloat(v);
        // $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
        $('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      });

      //Mastercard
      // $.post(baseurl+"caperturacierre/getTotalMastercard",  
      // {idC:idCaja},     
      // function(data){
      //   var v = data;
      //   if (v == null || v == '') {v = '0.00';}
      //   $('#lblMastercard').html(v);
      //   total += parseFloat(v);
      //   $('#lblTotal').html('<b style="font-size:14pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
      // });
      $.ajax({
        url: baseurl+"caperturacierre/getTotalMastercard",
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {idC:idCaja, fecApert:fecApert},
      })
      .done(function(data) {
        var v = data;
        if (v == null || v == '') {v = '0.00';}
        $('#lblMastercard').html(v);
        total += parseFloat(v);
        // $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
        $('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      //$('#lblTotal').html(total);

    };

    impCaja = function(idCaja){
      
      

      //Efectivo
      $.post(baseurl+"caperturacierre/imprimeCaja",  
      {idC:idCaja},     
      function(data){
        alert('d');
        // var v = data;
        // if (v == null || v == '') {v = '0.00';}
        // $('#lblEfectivo').html(v);
        // total += parseFloat(v);
        // $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
      });

    };
  });
</script>

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

    </body>
</html>
