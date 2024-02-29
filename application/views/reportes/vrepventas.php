<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Estadistica de Ventas </h3><br>
        <h3 style="font-weight: bold;" id="numOfVentas"></h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

            <div class="col-sm-3">
              <div class="form-group">
                <!-- <label class="col-sm-4 control-label">Elija opcion</label> -->
                <div class="input-group col-sm-12">
                  <button type="button" class="btn btn-default pull-right" style="width:90%;" id="datFecIniFin">
                    <span>
                      <i class="fa fa-calendar"></i> <?php echo date('d/m/Y').' - '.date('d/m/Y');?><!-- Seleccione rango fechas -->
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group  col-sm-12">
                  <button type="button" class="btn btn-primary pull-right" id="btnBuscar">
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>            
            </div>
            
            <div class="col-sm-9">
              <div class="col-xs-4">
                <div class="info-box bg-aqua">
                  <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">EFECTIVO</span>
                    <span class='info-box-number' id="totalInEfectivo"></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                      SistRestobar &copy;
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-xs-4">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="fa fa-cc-visa"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">VISA</span>
                    <span class='info-box-number' id="totalInVisa"></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                      SistRestobar &copy;
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-xs-4">
                <div class="info-box bg-yellow  ">
                  <span class="info-box-icon"><i class="fa fa-cc-mastercard"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">MASTERCARD</span>
                    <span class='info-box-number' id="totalInMastercard"></span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                      SistRestobar &copy;
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </div>

        </div>

        <div class="form-group">
          <!-- chartjs -->
          <div class="box-body col-sm-9" id="content_canvas">
            <canvas id="myChart" width="400" height="200"></canvas>
          </div>
          <!--<div class="col-sm-1"></div>-->
          <div class="col-sm-3">
            <div class="box-body no-padding">
                <table class="display" id="tblAllVentas" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 5%;background-color: #0E759D; color: white; text-align: center;">N°</th>
                      <th style="width: 15%;background-color: #0E759D; color: white; text-align: center;">Fec.venta.</th>
                      <th style="width: 10%;background-color: #0E759D; color: white; text-align: center;">Total</th>
                    </tr>
                  </thead>
                  <tbody></tbody>          
                </table>
              </div><!-- /.box-body --> 
          </div>
          <!--<div class="col-sm-1"></div>-->
        </div>

      </form>
    </div><!--end box box-info-->
  </div>
</div><!--end row-->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- chartjs -->
<!--  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
<!-- Page script -->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
  $(document).ready(function(){

    //Date range as a button
    $('#datFecIniFin').daterangepicker(
        {
          ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Ultimo mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment(),//.subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#datFecIniFin span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }
    );
  })
</script>
