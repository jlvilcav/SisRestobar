<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Ventas</h3>
        <span>Visualice todas las ventas realizadas</span>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Elija opcion</label>
                    <div class="col-sm-4">
                        <div class="input-group" style="width: 100%">
                          <button type="button" class="btn btn-default pull-right" style="width:90%;" id="datFecIniFinVentas">
                            <span><?php echo date('d/m/Y').' - '.date('d/m/Y');?></span>
                            <i class="fa fa-caret-down"></i>
                          </button>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary pull-right" id="btnBuscarVentas">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <a href="#" id="abtnDownloadExcelVentas" class="btn pull-right bg-green">
                            <i class="fa fa-file-excel-o"></i> &nbsp;&nbsp;Exportar Excel
                        </a>
                    </div>
                </div>
          
            </div>

          </div>

          <div class="form-group">
            <!--<div class="col-sm-1"></div>-->
            <div class="col-sm-12">
                
                <div class="box-body no-padding">
                    <table class="display" id="tblAllVentas" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%;background-color: #0E759D; color: white;">N°</th>
                                <th style="width: 20%;background-color: #0E759D; color: white;">Cliente</th>
                                <th style="width: 15%;background-color: #0E759D; color: white;">Fec.venta.</th>
                                <th style="width: 20%;background-color: #0E759D; color: white;">Mozo</th>
                                <th style="width: 10%;background-color: #0E759D; color: white;">Recibo</th>
                                <th style="width: 10%;background-color: #0E759D; color: white;">N°Venta</th>
                                <th style="width: 10%;background-color: #0E759D; color: white;">Total</th>
                                <th style="width: 5%;background-color: #0E759D; color: white;">Ver</th>
                            </tr>
                        </thead>
                        <!-- <tbody>
                         
                        </tbody>  -->               
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

<script src="<?php echo base_url(); ?>js/gestorventas.js"></script>

<!-- Page script -->
<script type="text/javascript">var baseurl = "<?php echo base_url(); ?>";
  $(document).ready(function(){
    $('#tblAllVentas').DataTable();
    //Money Euro
    //$("[data-mask]").inputmask();

    //Date range picker
    //$('#datFecIniFin').daterangepicker();
    
    //Date range as a button
    $('#datFecIniFinVentas').daterangepicker(
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
          $('#datFecIniFinVentas span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }
    );
  })
</script>