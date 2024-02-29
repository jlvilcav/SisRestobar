<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Registro de Personas</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" id="frmRegProveedor" method="POST" action="<?php echo base_url(); ?>cproveedor/regProveedor">
        <div class="box-body">
        <div class="form-group">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtDNI">DNI</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtDNI" class="form-control" id="txtDNI" placeholder="DNI" maxlength="8">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtRUC">RUC</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtRUC" class="form-control" id="txtRUC" placeholder="RUC" maxlength="11">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtRazonSocial">Razon Social</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtRazonSocial" class="form-control" id="txtRazonSocial" placeholder="Escriba razon social">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtDireccion">Dirección</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtDireccion" class="form-control" id="txtDireccion" placeholder="Indique la direccion"> 
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtTelefono">Telefono</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtTelefono" class="form-control" id="txtTelefono" placeholder="0">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtCelular">Celular</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtCelular" class="form-control" id="txtCelular" placeholder="0">
            </div>
          </div>
          
        </div>

        <div class="col-sm-6">  

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtEmail">Email</label>
            <div class="col-sm-9"> 
              <input type="email" name="txtEmail" class="form-control" id="txtEmail" placeholder="ejmplo@dominio.com">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtCta01">Cta 01</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtCta01" class="form-control" id="txtCta01" placeholder="00-0000000-0-00">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtCta02">Cta 02</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtCta02" class="form-control" id="txtCta02" placeholder="00-0000000-0-00">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtObservacion">Observación</label>
            <div class="col-sm-9"> 
              <textarea type="text" name="txtObservacion" class="form-control" id="txtObservacion" placeholder="Observación"></textarea> 
            </div>
          </div>

          <!--<div class="form-group">
            <label class="col-sm-3 control-label" for="exampleInputPassword1">Estado</label>
            <div class="col-sm-9"> 
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                  Activo
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                  Inactivo
                </label>
              </div>
            </div>
          </div>-->
          
        </div>
        </div>
        </div><!-- /.box-body -->

        <div class="box-footer" id="divBotones">
          <button type="button" id="btnGuardarProveedor" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
    </div><!-- /.box -->
  </div>

  <!-- mensajes -->
  <?php if ($regProveedorState == '1') : ?>
    <div class="col-md-12">
      <div class="callout callout-success">
        <h4>Registrado satisfactoriamente</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php elseif($regProveedorState == '0') : ?>
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

<script type="text/javascript">
  $(document).ready(function(){
    
    //verificamos DNI
    $('#txtDNI').keyup(function(){
      len = $('#txtDNI').val().length;
      if (len == 8) {
        dni = $('#txtDNI').val();
        $.post(
          "<?php echo base_url(); ?>cproveedor/verifDNI",
          {txtDNI:dni},
          function(data){
            var json = $.parseJSON(data);

            if (data != 0) {
              $('#txtRazonSocial').val('Ya existe esta persona: '+json.razonSocial);
              $('#txtRazonSocial').css('color','red');
              $('#frmRegProveedor').attr('action', "#");
              $('#divBotones').css('display','none');
            }else{
              $('#frmRegProveedor').attr('action', "<?php echo base_url();?>cproveedor/regProveedor");
              $('#divBotones').css('display','block');
              $('#txtRazonSocial').val('');
              $('#txtRazonSocial').css('color','#555');
            }
          });
      }
    });

    //verificamos RUC
    $('#txtRUC').keyup(function(){
      len = $('#txtRUC').val().length;
      if (len == 11) {
        ruc = $('#txtRUC').val();
        $.post(
          "<?php echo base_url(); ?>cproveedor/verifRUC",
          {txtRUC:ruc},
          function(data){
            var json = $.parseJSON(data);
            
            if (data != 0) {
              $('#txtRazonSocial').val('Ya existe esta empresa: '+json.razonSocial);
              $('#txtRazonSocial').css('color','red');
              $('#frmRegProveedor').attr('action', "#");
              $('#divBotones').css('display','none');
            }else{
              $('#frmRegProveedor').attr('action', "<?php echo base_url();?>cproveedor/regProveedor");
              $('#divBotones').css('display','block');
              $('#txtRazonSocial').val('');
              $('#txtRazonSocial').css('color','#555');
            }
          });
      }
    });


    var validatorRV = $("#frmRegProveedor").validate({
        rules: {
            txtDNI: { required: true },
            txtRUC: { required: true },
            txtRazonSocial: { required: true },
            txtDireccion: { required: true },
            txtTelefono: { required: true },
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
            txtRUC: "Ingrese RUC",
            txtRazonSocial: "Ingerse Razón Social",
            txtDireccion: "Ingerse dirección",
            txtTelefono: "Ingrese teléfono",
            cboDepartamento: "Elija Departamento",
            cboProvincia: "Elija Provincia",
            cboDistrito: "Elija Distrito",
        }
    });

    $('#btnGuardarProveedor').click(function(event) {
        if ($("#frmRegProveedor").valid()) {
            $("#frmRegProveedor").submit();
        }
    });

  }); 
</script>


