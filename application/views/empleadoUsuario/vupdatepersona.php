<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-check"></i> Actualizacion de datos del personal</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cpersona/updatePersona" id="frmPersona">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-6">

              <!-- hidden -->
              <input type="hidden" name="hdnIdSucursal" id="hdnIdSucursal" value="<?php echo $idS;?>">
              <input type="hidden" name="hdnIdUsuario" id="hdnIdUsuario" value="<?php echo $idU;?>">
              <input type="hidden" name="hdnIdCaja" id="hdnIdCaja" value="<?php echo $idC;?>">
              <input type="hidden" name="hdnSitReg" id="hdnSitReg" value="<?php echo $sitReg;?>">
              <input type="hidden" name="hdnIdPersona" id="hdnIdPersona" value="<?php echo $idP;?>">

              <div class="form-group">
                <label for="txtDNI" class="col-sm-3 control-label">DNI</label>
                <div class="col-sm-9">
                    <input type="text" name="txtDNI" id="txtDNI" class="form-control" maxlength="8" value="<?php echo $dni;?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="txtNombres">Nombres</label>
                <div class="col-sm-9"> 
                  <input type="text" name="txtNombres" class="form-control" id="txtNombres" value="<?php echo urldecode($nom);?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="txtApPaterno">Ap. Paterno</label>
                <div class="col-sm-9"> 
                  <input type="text" name="txtApPaterno" class="form-control" id="txtApPaterno" value="<?php echo urldecode($app);?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="txtApMaterno">Ap. Materno</label>
                <div class="col-sm-9"> 
                  <input type="text" name="txtApMaterno" class="form-control" id="txtApMaterno" value="<?php echo urldecode($apm);?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="txtSueldo">Sueldo</label>
                <div class="col-sm-9"> 
                  <input type="text" name="txtSueldo" class="form-control" id="txtSueldo" value="<?php echo $sueldo;?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Perfil</label>
                <div class="col-sm-9">  
                  <select class="form-control" name="cboPerfil" id="cboPerfil">
                    <option value="">:: Elija</option>
                    <?php 
                      foreach ($listPerfiles as $fila) {
                        if ($fila->idPerfil == $idPf) {
                          echo "<option value='".$fila->idPerfil."' selected>".$fila->descripcion."</option>";
                        }else{
                          echo "<option value='".$fila->idPerfil."'>".$fila->descripcion."</option>";
                        }
                       
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
                    <label class="col-sm-3 control-label">Estado</label>
                    <div class="col-sm-3">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="chkEstado" id="chkEstado"><label id="lblEstado"></label>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary" id="btnModalResetear" data-toggle="modal" data-target="#modalResetClave"><i class="fa fa-refresh"></i> Reset Contraseña</button>
                    </div>
                </div>
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer" id="divBotones">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div><!-- /.box -->
  </div>

<div class="modal fade" id="modalResetClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-opencart"></i> &nbsp;&nbsp;Reseteo de Contraseña</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="box-body">
                        <span class="direct-chat-name pull-left"><b>¿Esta seguro de resetear la contraseña?.</b> 
                        <br><br> Ingrese la nueva contraseña:</span>
                        <input type="text" name="txtNewClave" class="form-control" id="txtNewClave" placeholder="*******"> 
                        <br>
                        <span class="direct-chat-name pull-left">Los usuarios podran cambiar su contraseña luego de ingresar al sistema.</span>
                    </div>
                </form>
                <div class="alert alert-info" style="display: none;">
                    <strong>Felicidades!</strong> La contraseña ha sido reseteada.
                </div>
                <div class="alert alert-warning" style="display: none;">
                    <strong>Alerta!</strong> Al parecer el usuario YA tiene como contraseña <b>123456</b>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnResetearClave"> <i class="fa fa-refresh"></i> &nbsp; Resetear</button>
                <button type="button" class="btn btn-default" id="btnCerrarModalApert" data-dismiss="modal"> <i class="fa fa-close"></i> &nbsp; Cancelar</button>
            </div>
        </div>
    </div>
</div>

  <!-- mensajes -->
  <!-- <?php if ($regPersonaState == '1') : ?>
    <div class="col-md-12">
      <div class="callout callout-success">
        <h4>Registrado satisfactoriamente</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php elseif($regPersonaState == '0') : ?>
    <div class="col-md-12">
      <div class="callout callout-danger">
        <h4>Hubo un error al momento de guardar</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php endif; ?> -->
</div>


<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    // if ($('#chkEstado').is(":checked"))
    // {
    //   alert('1');
    // }else{
    //   alert('no');
    // }

    //alert($('#hdnSitReg').val());
    if ($('#hdnSitReg').val() == 1) {
      $('#chkEstado').attr('checked', true);
      $('#lblEstado').html('Activado');
      $('#lblEstado').css('color','#555');
    }else{
      $('#chkEstado').attr('checked', false);
      $('#lblEstado').html('Desactivado');
      $('#lblEstado').css('color','#d73925');
    }

    $("[data-mask]").inputmask();

    $('#divCaja').css('display','none');
    
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('input').on('ifChecked', function(event){
      $('#lblEstado').html('Activado');
      $('#lblEstado').css('color','#555');
      // alert($(this).val()); // alert value
    });

    $('input').on('ifUnchecked', function(event){
      $('#lblEstado').html('Desactivado');
      $('#lblEstado').css('color','#d73925');
      // alert($(this).val()); // alert value
    });

    //$('#chkEstado').val($(this).is(':checked'));
    
    //Money Euro
    $("[data-mask]").inputmask();

    //visible divCaja
    $('#cboPerfil').change(function(){
      per = $('#cboPerfil').val();
      suc = $('#hdnIdSucursal').val();
      //usu = $('#hdnIdUsuario').val();
      idC = $('#hdnIdCaja').val();
      if (per == 3) {
        $.post(
          "<?php echo base_url(); ?>cusuario/getCajaByUsuario"
          ,{cboSucursal:suc,idC:idC}
          ,function(data){
            $('#cboCaja').html(data);
            $('#cboCaja').change();
          }); 
        $('#divCaja').css('display','block');
      }else{
        $('#cboCaja').val(0);
        $('#divCaja').css('display','none');
      }
    });

    $('#cboPerfil').change();

    //txtDNI
    $("#txtDNI").keyup(function(){
        var len = $("#txtDNI").val().length;
        if (len == 8) {
          dni = $('#txtDNI').val();
          $.post(
            "<?php echo base_url();?>cpersona/verifDNI",
            {txtDNI:dni},
            function(data){
              var json = $.parseJSON(data);
              if (data != 0) {
                $('#txtNombres').val('Ya existe esta persona: '+json.apPaterno+' '+json.apMaterno+', '+json.nombre);
                $('#txtNombres').css('color','red');
                $('#frmPersona').attr('action', "#");
                $('#divBotones').css('display','none');
              }else{
                $('#frmPersona').attr('action', "<?php echo base_url();?>cpersona/updatePersona");
                $('#divBotones').css('display','block');
                //$('#txtNombres').val('');
                $('#txtNombres').css('color','#555');
              }
            });
        }        
    });

    $('#btnModalResetear').click(function() {
        $('.alert-info').css('display','none');
        $('.alert-warning').css('display','none');
    });

    $('#btnResetearClave').click(function() {
        var idUsu = $('#hdnIdUsuario').val();
        var txtNewClave = $('#txtNewClave').val();
        $.post('<?php echo base_url();?>cusuario/resetClave',
            {idUsuario: idUsu,txtNewClave:txtNewClave},
            function(data){
                if (data>0) {
                    $('.alert-info').css('display','block');
                    setTimeout(
                        function() 
                        {
                            $('#btnCerrarModalApert').click();
                        }, 5000);
                }else{
                    $('.alert-warning').css('display','block');
                    setTimeout(
                        function() 
                        {
                            $('#btnCerrarModalApert').click();
                        }, 5000);
                }
        });
    });

  });
</script>