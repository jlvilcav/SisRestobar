<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

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

          <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
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
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tabVentas" data-toggle="tab">Ventas</a></li>
          <li><a href="#tabIncidencias" data-toggle="tab">Incidencias</a></li>
          <li><a href="#tabDatos" data-toggle="tab">Actualizar datos</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="tabVentas">
                                
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
                <label for="inputEmail" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail" placeholder="Escribe tu numero telefonico">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="ingresa tu Email">
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
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
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
  });
</script>