<?php if ($this->session->userdata('s_idUsuario')) : ?>

<div class="row">
	<!-- left column -->
	<div class="col-sm-12">
    <div class="col-sm-6">
  		<div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><b><i class="fa fa-chrome"></i> &nbsp; Registro de Cajas</b></h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" id="frmRegCajas" action="<?php echo base_url(); ?>csucursal/regCajaSucursal" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Sucursal</label>
              	<div class="col-sm-8">  
                  <select class="form-control" name="cboSucursal" id="cboSucursal">
                    <option value="">:: Elija</option>
                    <?php 
                      foreach ($listSucursal as $fila) {
                        echo "<option value='".$fila->idSucursal."'>".$fila->nombre."</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label for="txtCantCajas" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-8">
                	<input type="text" name="txtDescripcion" class="form-control" id="txtDescripcion" placeholder="CAJA 01">
                </div>
              </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Guardar</button>
            </div>
          </form>
        </div><!-- /.box -->
  	</div>
    <div class="col-sm-4">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Cajas por sucursal</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped" id="tblCajaSucursal">
                               
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#cboSucursal').change(function(){
      $('#cboSucursal option:selected').each(function(){
        suc = $('#cboSucursal').val();
        $.post(
          "<?php echo base_url();?>csucursal/getCajaSucursal",
          {cboSucursal:suc},
          function(data){
            // alert(data);
            $('#tblCajaSucursal').html(data);
          });
      });
    });


    var validatorRV = $("#frmRegCajas").validate({
        rules: {
            cboSucursal: {
                required: true,
                min: 1
            },
            txtDescripcion: { required: true },
        },
        messages:{
            cboSucursal: "Elija Sucursal",
            txtDescripcion: "Ingerse nombre de la caja",
        }
    });

  });
</script>




<?php 
  else : 
    echo "no autorizado";

  endif; 
?>