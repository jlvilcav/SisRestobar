<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Registro de Insumos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="frmRegInsumo" method="POST" action="<?php echo base_url(); ?>cinsumo/regInsumo">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="txtInsumo" class="col-sm-2 control-label">Nombre del insumo</label>
                      <div class="col-sm-6">
                        <input type="text" name="txtInsumo" class="form-control" id="txtInsumo" placeholder="Escriba el nombre" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Unidad</label>
                      <div class="col-sm-6">  
                        <select class="form-control" name="cboUnidad" id="cboUnidad" required>
                          <option value="">:: Elija</option>
                          <?php
                            foreach ($listUnidad as $lu) {
                               echo "<option value='".$lu->idUnidad."'>".$lu->descripcion."</option>";
                             }
                          ?>
                        </select>
                        </div> <div>+</div>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Categoria</label>
                    	<div class="col-sm-6">  
	                      <select class="form-control" name="cboCategInsumo" required>
	                        <option value="">:: Elija</option>
	                        <?php
                            foreach ($listCategInsumo as $lci) {
                               echo "<option value='".$lci->idCategoriaInsumo."'>".$lci->descripcion."</option>";
                             }
                          ?>
	                      </select>
                      	</div>
                    </div>
                    <!-- select -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Medida</label>
                      <div class="col-sm-6">  
                        <select class="form-control" name="cboMedida" required>
                          <option value="">:: Elija</option>
                          <?php
                            foreach ($listMedida as $lm) {
                               echo "<option value='".$lm->idMedida."'>".$lm->descripcion."</option>";
                             }
                          ?>
                        </select>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group">
                      <label for="txtCantXMedida" class="col-sm-2 control-label">Cant. X Medida</label>
                      <div class="col-sm-6">
                        <input type="numeric" name="txtCantXMedida" class="form-control" id="txtCantXMedida" placeholder="0" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txtStockMin" class="col-sm-2 control-label">Stock Minimo</label>
                      <div class="col-sm-6 input-group"> 
                        <div class="col-sm-4">
                          <input type="numeric" name="txtStockMinUnid" class="form-control" id="txtStockMinUnid" placeholder="0" required>
                        </div>
                        <div class="col-sm-8">
                          <input type="numeric" name="txtStockMin" class="form-control" id="txtStockMin" placeholder="0" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txtPrecSugerido" class="col-sm-2 control-label">Precio sugerido</label>
                      <div class="col-sm-6">
                        <input type="numeric" name="txtPrecSugerido" class="form-control" id="txtPrecSugerido" placeholder="0.0" required>
                      </div>
                    </div>

                    

                  </div><!-- /.box-body -->

                  <div class="box-footer" id="divBotones">
                    <button type="button" id="btnGuardarInsumo" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo base_url(); ?>cinsumo" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->
	</div>

  <!-- mensajes -->
  <?php if ($regInsumoState == '1') : ?>
    <div class="col-md-12">
      <div class="callout callout-success">
        <h4>Registrado satisfactoriamente</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php elseif($regInsumoState == '0') : ?>
    <div class="col-md-12">
      <div class="callout callout-danger">
        <h4>Hubo un error al momento de guardar</h4>
        <p>This is a green callout.</p>
      </div>
    </div>
  <?php endif; ?>
</div>



<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $('#txtInsumo').focusout(function(){
      ins = $('#txtInsumo').val();
      $.post(
        "<?php echo base_url(); ?>cinsumo/verifInsumo",
        {txtInsumo:ins},
        function(data){
          if (data != 0) {
            $('#txtInsumo').val('Ya existe este insumo : '+data);
            $('#txtInsumo').css('color','red');
            $('#frmRegInsumo').attr('action', "#");
            $('#divBotones').css('display','none');
          }else{
            $('#frmRegInsumo').attr('action', "<?php echo base_url();?>cinsumo/regInsumo");
            $('#divBotones').css('display','block');
            $('#txtInsumo').css('color','#555');
          }
        });
    });

    $('#txtStockMinUnid').keyup(function(){
      var cxm = $('#txtCantXMedida').val();
      var smu = $('#txtStockMinUnid').val();
      $('#txtStockMin').val(cxm*smu);
    });


    var validatorRV = $("#frmRegInsumo").validate({
        rules: {
            txtInsumo: { required: true },
            cboUnidad: {
                required: true,
                min: 1
            },
            cboCategInsumo: {
                required: true,
                min: 1
            },
            cboMedida: {
                required: true,
                min: 1
            },
            txtCantXMedida: { required: true },
            txtStockMinUnid: { required: true },
        },
        messages:{
            txtInsumo: "Ingerse nombre insumo",
            cboUnidad: "Elija Unidad",
            cboCategInsumo: "Elija Categoria",
            cboMedida: "Elija Medida",
            txtCantXMedida: "Ingerse Cantidad por medida",
            txtStockMinUnid: "Ingerse Stock minimo",
        }
    });

    $('#btnGuardarInsumo').click(function(event) {
        if ($("#frmRegInsumo").valid()) {
            $("#frmRegInsumo").submit();
        }
    });
  });



</script>
