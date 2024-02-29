<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de insumos con sus respectivos stock.</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group">
            <div class="col-sm-12">
              <div class="box-body no-padding">
                  <table class="table table-striped" id="tblStockIns">
                    <thead>
                      <tr>
                        <th style="width: 5%;background-color: #1ab394; color: white; text-align: center;">N°</th>
                        <th style="width: 20%;background-color: #1ab394; color: white; text-align: center;">Insumo</th>
                        <th style="width: 10%;background-color: #1ab394; color: white; text-align: center;">Cant x Unid</th>
                        <th style="width: 10%;background-color: #1ab394; color: white; text-align: center;">Stock Minimo</th>
                        <th style="width: 15%;background-color: #1ab394; color: white; text-align: center;">Stock. X Med.</th>
                        <th style="width: 10%;background-color: #1ab394; color: white; text-align: center;">Medida</th>
                        <th style="width: 10%;background-color: #1ab394; color: white; text-align: center;">Stock. X Unid.</th>
                        <th style="width: 10%;background-color: #1ab394; color: white; text-align: center;">Unidad</th>
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

<script src="<?php echo base_url(); ?>js/repstockins.js"></script>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>
