<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-street-view"></i> &nbsp;<b>Registro de Personas</b></h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>cpersona/regPersona" id="frmPersona">
        <div class="box-body">
        <div class="form-group">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtDNI" class="col-sm-3 control-label">DNI</label>
            <div class="col-sm-9">
                <input type="text" name="txtDNI" id="txtDNI" class="form-control" maxlength="8">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtNombres">Nombres</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtNombres" class="form-control" id="txtNombres" placeholder="Nombres">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtApPaterno">Ap. Paterno</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtApPaterno" class="form-control" id="txtApPaterno" placeholder="Apellido Paterno"> 
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtApMaterno">Ap. Materno</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtApMaterno" class="form-control" id="txtApMaterno" placeholder="Apellido Materno">
            </div>
          </div>
          <!-- Date dd/mm/yyyy -->
          <div class="form-group">
            <label class="col-sm-3 control-label">Fec. Nac.</label>
            <div class="col-sm-9"> 
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="datFecNac" id="datFecNac">
              </div><!-- /.input group -->
            </div>
          </div><!-- /.form group -->
        </div>
        <div class="col-sm-6">  
          <div class="form-group">
            <label class="col-sm-3 control-label">Departamento</label>
            <div class="col-sm-9">  
              <select class="form-control" name="cboDepartamento" id="cboDepartamento" required>
                <option value="">:: Elija</option>
                <?php
                  foreach ($listDepartamentos as $depa) {
                    echo "<option value='".$depa->codDepartamento."'>".$depa->nombre."</option>";
                  }
                ?>
              </select>
              </div>
          </div>
          <!-- select -->
          <div class="form-group">
            <label class="col-sm-3 control-label">Provincia</label>
            <div class="col-sm-9">  
              <select class="form-control" name="cboProvincia" id="cboProvincia" required>
                <option value="">:: Elija</option>
              </select>
              </div>
          </div>
          <!-- select -->
          <div class="form-group">
            <label class="col-sm-3 control-label">Distrito</label>
            <div class="col-sm-9">  
              <select class="form-control" name="cboDistrito" id="cboDistrito" required>
                <option value="">:: Elija</option>
              </select>
              </div>
          </div>

          <div class="form-group">
            <label for="txtDireccion" class="col-sm-3 control-label">Dirección</label>
            <div class="col-sm-9">
              <input type="text" name="txtDireccion" class="form-control" id="txtDireccion" placeholder="Ingrese su dirección">
            </div>
          </div>
        </div>
        </div>
        </div><!-- /.box-body -->

        <div class="box-footer" id="divBotones">
          <button type="button" id="btnGuardarPersona" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          <a href="<?php echo base_url(); ?>cpersona/gestorEmpleado" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
        </div>
      </form>
    </div><!-- /.box -->
  </div>

  <!-- mensajes -->
  <?php if ($regPersonaState == '1') : ?>
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
  <?php endif; ?>
</div>


<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $("[data-mask]").inputmask();

    //Combos
    $("#cboDepartamento").change(function() {
      $("#cboDepartamento option:selected").each(function() {
        dep = $('#cboDepartamento').val();
        $.post("<?php echo base_url();?>cubigeo/provincias", {
          cboDepartamento : dep
        }, function(data) {
          $("#cboProvincia").html(data);
          $("#cboProvincia").change();
        });
      });
    });


    $('#cboProvincia').change(function(){
      $('#cboProvincia option:selected').each(function(){
        dep = $('#cboDepartamento').val();
        prov = $('#cboProvincia').val();
        $.post("<?php echo base_url();?>cubigeo/distritos"
          ,{
            cboDepartamento:dep,
            cboProvincia:prov
          }
          ,function(data){
            $("#cboDistrito").html(data);
            $("#cboDistrito").change();
          });
      });
    });

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
                $('#frmPersona').attr('action', "<?php echo base_url();?>cpersona/regPersona");
                $('#divBotones').css('display','block');
                $('#txtNombres').val('');
                $('#txtNombres').css('color','#555');
              }
            });
        }        
    });

    var validatorRV = $("#frmPersona").validate({
        rules: {
            txtDNI: { required: true },
            txtNombres: { required: true },
            txtApPaterno: { required: true },
            txtApMaterno: { required: true },
            datFecNac: { required: true },
            cboDepartamento: {
                required: true,
                min: 1
            },
            cboProvincia: {
                required: true,
                min: 1
            },
            cboDistrito: {
                required: true,
                min: 1
            },
        },
        messages:{
            txtDNI: "Ingerse el DNI",
            txtNombres: "Ingrese Nombre",
            txtApPaterno: "Ingerse Apellido Paterno",
            txtApMaterno: "Ingerse Apellido Materno",
            datFecNac: "Ingrese fecha de cumpleaños",
            cboDepartamento: "Elija Departamento",
            cboProvincia: "Elija Provincia",
            cboDistrito: "Elija Distrito",
        }
    });

    $('#btnGuardarPersona').click(function(event) {
        if ($("#frmPersona").valid()) {
            $("#frmPersona").submit();
        }
    });

  });
</script>