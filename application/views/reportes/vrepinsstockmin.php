<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title" style="color: #ed5565;"><strong>Lista de insumos que se encuentran bajo stock minimo</strong></h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="box-body no-padding">
                  <table class="table table-striped" id="tblInsStockMin">
                    <thead>
                      <tr>
                        <th style="width: 10%;background-color: #0E759D; color: white; text-align: center;">N°</th>
                        <th style="width: 30%;background-color: #0E759D; color: white;">Insumo</th>
                        <th style="width: 20%;background-color: #0E759D; color: white;">Stock Minimo</th>
                        <th style="width: 20%;background-color: #0E759D; color: white;">En almacen</th>
                        <th style="width: 20%;background-color: #0E759D; color: white;">Unidad</th>
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

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="<?php echo base_url(); ?>js/repinsstockmin.js"></script>

<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>
