<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-plus"></i> &nbsp;<b>Crear Usuario</b></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cusuario/regUsuario" id="frmUsuario">
                  <div class="box-body">
                    <div class="form-group">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="txtNomSucursal" class="col-sm-3 control-label">DNI</label>
                        <div class="col-sm-9">
                          <!--<div class="input-group input-group-sm">-->
                            <input type="text" id="txtDNI" name="txtDNI" class="form-control" value="<?php echo $this->session->userdata('dtxtDNI');?>"
                                  <?php if($this->session->userdata('dtxtDNI')){echo "disabled";};?> maxlength="8" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="txtNombres">Empleado</label>
                        <div class="col-sm-9"> 
                          <input type="text" name="txtNombres" class="form-control" id="txtNombres" value="<?php echo $this->session->userdata('dNombres');?>" placeholder="Nombres" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="txtNomUsuario">Usuario</label>
                        <div class="col-sm-9"> 
                          <input type="text" name="txtNomUsuario" class="form-control" id="txtNomUsuario" placeholder="Nombre de usuario" value="<?php echo $this->session->userdata('dtxtDNI');?>" disabled> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="txtClave">Contraseña</label>
                        <div class="col-sm-9"> 
                          <input type="text" name="txtClave" class="form-control" id="txtClave" value="123456" placeholder="*********">
                        </div>
                      </div>
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Fec. Ingreso  </label>
                        <div class="col-sm-9"> 
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" value="<?php echo date('d/m/y');?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="datFecIngreso" name="datFecIngreso">
                          </div><!-- /.input group -->
                        </div>
                      </div><!-- /.form group -->
                      
                    </div>
                    <div class="col-sm-6">  
                      <!-- select -->
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Sucursal</label>
                        <div class="col-sm-9">  
                          <select class="form-control" name="cboSucursal" id="cboSucursal" required>
                            <option value="">:: Elija</option>
                            <?php 
                              foreach ($listSucursal as $fila) {
                                echo "<option value='".$fila->idSucursal."'>".$fila->nombre."</option>";
                              }
                            ?>
                          </select>
                          </div>
                      </div>
                      <!-- select -->
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Perfil</label>
                        <div class="col-sm-9">  
                          <select class="form-control" name="cboPerfil" id="cboPerfil" required>
                            <option value="">:: Elija</option>
                            <?php 
                              foreach ($listPerfiles as $fila) {
                                echo "<option value='".$fila->idPerfil."'>".$fila->descripcion."</option>";
                              }
                            ?>
                          </select>
                          </div>
                      </div>
                      <!-- select -->
                      <div class="form-group" id="divCaja">
                        <label class="col-sm-3 control-label">Caja</label>
                        <div class="col-sm-9">  
                          <select class="form-control" name="cboCaja" id="cboCaja">
                            <option value="">:: Elija</option>
                          </select>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="txtSueldo" class="col-sm-3 control-label">Sueldo</label>
                        <div class="col-sm-9">
                          <input type="text" name="txtSueldo" class="form-control" id="txtSueldo" placeholder="0.0" required>
                        </div>
                      </div>

                    </div>
                    </div>

                  </div><!-- /.box-body -->


                  

                  <div class="box-footer" id="divBotones">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <a href="<?php echo base_url(); ?>cpersona/gestorEmpleado" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
                  </div>

                  <!--Hidden controls-->
                  <input type="hidden" id="hdnIdPersona" name="hdnIdPersona"></input>

                </form>
              </div>
              </div><!-- /.box -->
  </div>

  <!-- mensajes -->
  <?php if ($regUsuarioState == '1') : ?>
    <div class="col-md-12">
      <div class="callout callout-success">
        <h4>Registrado satisfactoriamente</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php elseif($regUsuarioState == '0') : ?>
    <div class="col-md-12">
      <div class="callout callout-danger">
        <h4>Hubo un error al momento de guardar</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php endif; ?>

</div>

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Page script -->
<script>
  $(document).ready(function() {
    $('#divCaja').css('display','none');
    
    //Money Euro
    $("[data-mask]").inputmask();

    //visible divCaja
    $('#cboPerfil').change(function(){
      per = $('#cboPerfil').val();
      suc = $('#cboSucursal').val();
      if (per == 3) {
        $.post(
          "<?php echo base_url(); ?>cusuario/getCajaSucursal"
          ,{cboSucursal:suc}
          ,function(data){
            $('#cboCaja').html(data);
          }); 
        $('#divCaja').css('display','block');
      }else{
        $('#cboCaja').val(0);
        $('#divCaja').css('display','none'); 
      }
    });
    
    //buscamos info por dni
    $("#txtDNI").keyup(function(){

      ldni = $('#txtDNI').val().length;
      if (ldni == 8) {
        $('#txtNomUsuario').val('');
        $('#txtNombres').val('');
        dni = $('#txtDNI').val();        

        /*$.ajax({
          url: "<?php echo base_url(); ?>cpersona/verifDNI",
          datatype: 'json',
          type: 'POST',
          cache: false,
          data:{'txtDNI':dni},
          success:function(data){
            var json = $.parseJSON(data);
            alert(json.nombre);
          }
        });*/

        $.post(
          "<?php echo base_url(); ?>cpersona/verifDNI"
          ,{txtDNI:dni}
          ,function(data){
            var json = $.parseJSON(data);
            if (data == 0) {              
              $('#txtNombres').val('No existe registro');
              $('#txtNombres').css('color','red');
              $('#frmUsuario').attr('action', "#");
              $('#divBotones').css('display','none');
            }else{
              $('#txtNombres').val(json.apPaterno+' '+json.apMaterno+', '+json.nombre);
              $('#txtNombres').css('color','#555');
              $('#hdnIdPersona').val(json.idPersona);

                //verificamos si ya existe el usuario
                $.post(
                  "<?php echo base_url(); ?>cusuario/verifUsuario"
                  ,{txtNomUsuario:dni}
                  ,function(data){
                    
                    if (data != 0) {
                      //alert(data);
                      $('#txtNomUsuario').val('Ya existe este usuario: '+data);
                      $('#txtNomUsuario').css('color','red');
                      $('#frmUsuario').attr('action', "#");
                      $('#divBotones').css('display','none');
                    }else{
                      $('#txtNomUsuario').val(dni);
                      $('#txtNomUsuario').css('color','#555');
                      $('#frmUsuario').attr('action', "<?php echo base_url();?>cusuario/regUsuario");
                      $('#divBotones').css('display','block');
                    }
                });
            }          
          });
      }
    });

  });
</script>