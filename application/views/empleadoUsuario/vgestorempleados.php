<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        
        <div class="col-sm-12">
          <h3 class="box-title"><i class="fa fa-users"></i> &nbsp;<b>
              <?php
                  $row = 0;
                  foreach ($listEmpleados as $fila) {
                      $row++;
                  }
                  echo "Empleados SistRestobar  -  (".$row.")";
              ?></b>
          </h3> 
          <a href="<?php echo base_url(); ?>cpersona/downloadPersonas" class="btn pull-right bg-green"><i class="fa fa-file-excel-o"></i> &nbsp;&nbsp;Exportar Excel</a>
          <a href="<?php echo base_url(); ?>cpersona/persona" class="btn pull-right bg-blue"><i class="fa fa-file"></i> &nbsp;&nbsp;Nuevo</a> 
        </div>

      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group">
            <!-- <div class="col-sm-1"></div> -->
            <div class="col-sm-12">
              <div class="box-body no-padding">
                  <table class="display" id="tblAllVentas">
                    <thead>
                      <tr>
                        <th style="width: 7%;background-color: #0E759D; color: white;">N°</th>
                        <th style="width: 15%;background-color: #0E759D; color: white;">DNI</th>
                        <th style="width: 25%;background-color: #0E759D; color: white;">Empleado</th>
                        <th style="width: 10%;background-color: #0E759D; color: white;">Perfil</th>
                        <!-- <th style="width: 10%;background-color: #0E759D; color: white;">Sueldo</th> -->
                        <th style="width: 10%;background-color: #0E759D; color: white;">Fec.Ingreso</th>
                        <th style="width: 10%;background-color: #0E759D; color: white;">Sucursal</th>
                        <th style="width: 5%;background-color: #0E759D; color: white;">Est.</th>
                        <th style="width: 10%;background-color: #0E759D; color: white;">Ver</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $row = 1;
                        foreach ($listEmpleados as $fila) {
                          echo "<tr>";
                          echo "<td align='center'>$row</td>";
                          echo "<td style='color:#006699;'><i class='fa fa fa-user'></i> &nbsp; $fila->dni</td>";
                          echo "<td style='color:#4F7C0F;'><i class='fa fa-child'></i> &nbsp; $fila->apPaterno $fila->apMaterno, $fila->nombre</td>";
                          echo "<td align='center'>$fila->descripcion</td>";
                          // echo "<td style='color:#f39c12; font-weight:bold; text-align:center;'>$fila->sueldo</td>";
                          echo "<td>$fila->fecIngreso</td>";
                          echo "<td style='color:#006699;'><i class='fa fa fa-street-view'></i> &nbsp; $fila->nomSucursal</td>";
                          if ($fila->sitReg == 1) {  
                            echo "<td><span style='color:#006699;'><i class='fa fa-check'></i></span></td>";
                          }else{
                            echo "<td><span style='color:#FF0000;'><i class='fa fa-close'></i></span></td>";
                          }
                          echo "<td>".
                              "<a href='".base_url()."cpersona/selPersona/".$fila->sitReg."/".$fila->idCaja."/".$fila->idUsuario."/".$fila->idSucursal."/".$fila->idPersona."/".$fila->idPerfil."/".$fila->apPaterno."/".$fila->apMaterno."/".$fila->nombre."/".$fila->sueldo."/".$fila->dni."'".
                                " class='btn btn-primary btn-sm'><i class='fa fa-fw fa-external-link-square'></i>".
                                "</a>&nbsp;&nbsp;&nbsp;".

                              "<a onclick='delUsu(".$fila->idPersona.",\"".$fila->nombre." ".$fila->apPaterno."\")' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalConfirmacion'><i class='fa fa-trash'></i></a>".
                            "</td>";
                          echo "</tr>";
                          $row++;
                        }
                      ?>
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

<div class="modal fade" id="modalConfirmacion">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">SistRestobar</h4>
            </div>
            <div class="modal-body">
                <p>¿Esta seguro de eliminar a <label id="lblNomUsuarioDel"></label>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <a id="btnAceptarDelUsu" class="btn btn-primary">Aceptar</a>
            </div>
        </div>
    </div>
</div>


<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Page script -->
<script>
  $(function () {

    //Money Euro
    $("[data-mask]").inputmask();

    $('#tblAllVentas').DataTable({
      'paging': true,
      'info': false,
      'stateSave': true
    });
    
  });
</script>

<script type="text/javascript">
    function delUsu(idPersona,nombre){
        $('#lblNomUsuarioDel').html(nombre);
        $('#btnAceptarDelUsu').attr('href', "<?php echo base_url();?>cusuario/delUsuario/"+idPersona);
    };
</script>