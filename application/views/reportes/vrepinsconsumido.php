<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Apertura y cierre de cajas.</h3>

         
      </div><!-- /.box-header -->
      <div class="alert alert-success">
        <strong>Elija</strong> desde que fecha desea ver productos e insumos consumidos.
      </div>
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">
          
          <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="box-body no-padding">
                <table class="display" id="tblApertCierre" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 5%;background-color: #006699; color: white;">N°</th>
                      <th style="width: 15%;background-color: #006699; color: white;">Caja</th>
                      <th style="width: 20%;background-color: #006699; color: white;">Fec.Apertura.</th>
                      <th style="width: 20%;background-color: #006699; color: white;">Fec. Cierre</th>
                      <th style="width: 15%;background-color: #006699; color: white;">Ver</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div><!-- /.box-body --> 
            </div>
            <!--<div class="col-sm-1"></div>-->
          </div>

        </div>
      </form>
    </div><!--end box box-info-->
  </div>
</div><!--end row-->

<!-- hidden parameters -->
<input type="hidden" id="hdnFecApert">
<input type="hidden" id="hdnFecCierre">

<!-- Modal Productos consumidos -->
<div class="modal fade" id="modalApertura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Productos vendidos</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal">
          <div class="box-body" style="max-height: 65vh; overflow-y: scroll;overflow-x: hidden;">
            <div class="form-group">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">

                <!-- <button type="button" class="btn btn-default" id="btnImprimirProductos" data-dismiss="modal">Imprimir</button> -->
                <a href="<?php echo base_url();?>creportes/printProductos" id="btnImprimirProductos" class="btn bg-yellow" ><i class="fa fa-print"></i> &nbsp;&nbsp;Imprimir productos</a>

                <br><br>
                
                <table class="table table-striped" id="tblProductos">
                  <thead>
                    <tr>
                      <th style="width: 15%;background-color: #BBB; color: white;">N°</th>
                      <th style="width: 60%;background-color: #BBB; color: white;">Productos</th>
                      <th style="width: 15%;background-color: #BBB; color: white; text-align: center;">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>                
                </table>
              </div>
            </div>

          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCerrarModalApert" data-dismiss="modal">Cancelar</button>
        <button type="button" data-toggle="modal" data-target="#modalInsConsumidos" class="btn btn-primary" id="btnVerInsumos">Ver Insumos</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Insumos consumidos -->
<div class="modal fade" id="modalInsConsumidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Total Insumos Consumidos</h4>
      </div>

      <div class="modal-body" style="max-height: 65vh; overflow-y: scroll;overflow-x: hidden;">
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <table class="table table-striped" id="tblInsConsumido">
                  <thead>
                    <tr>
                      <th style="width: 15%;background-color: #BBB; color: white;">N°</th>
                      <th style="width: 50%;background-color: #BBB; color: white;">Insumo</th>
                      <th style="width: 15%;background-color: #BBB; color: white;">Cant.</th>
                      <th style="width: 20%;background-color: #BBB; color: white;">Unidad.</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>                
                </table>
              </div>
            </div>

          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCerrarModalApert" data-dismiss="modal">Cancelar</button>
        <button type="button" data-toggle="modal" data-target="#" class="btn btn-primary" id="btnVerInsumos">Ver Insumos</button>
        <a href="#" id="btnImprimeIC" class="btn bg-yellow" ><i class="fa fa-print"></i> &nbsp;&nbsp;Imprimir</a>
      </div>
    </div>
  </div>
</div>

<!-- Page script -->
<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>