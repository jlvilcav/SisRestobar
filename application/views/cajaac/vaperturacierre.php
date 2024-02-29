<?php if ($this->session->userdata('s_idSucursal')) : ?>


<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Apertura / Cierre de caja</h3><br>
        <small style="color: #006699;"><strong>Importante..!!</strong> Si alguna de las cajas no aparece, es por que la caja registrada no ha sido asignado a ningun empleado.</small>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">

          	<div class="form-group">
		        <div class="col-sm-1"></div>
		        <div class="col-sm-7">
		          <div class="box-body">
		              <table class="table table-striped" id="tblCajas" style="border: 0.1px #EEE solid;">
		              <!-- <caption>Apertura/Cierre</caption> -->
		                <tr>
		                  <th style="width: 10%;background-color: #0E759D;color: white;text-align: center;">N°</th>
		                  <th style="width: 30%;background-color: #0E759D;color: white;">Caja</th>
		                  <th style="width: 35%;background-color: #0E759D;color: white;">Estado</th>
		                  <th colspan="2" style="width: 25%;background-color: #0E759D;color: white;">Acción</th>
		                </tr>
		                
		              </table>
		            </div><!-- /.box-body -->	
		        </div>
		        <div class="col-sm-4">
		          <div class="box-body">
		          	<table id="tblInfoCaja" style="display:none;">
		          		<tr>
		          			<td colspan="3"><div id="nomSelCaja" style="color:#006699;font-weight: bold;"></div></td>
		          		</tr>
		          		<tr>
		          			<td colspan="3"><div id="lblCajero"></div></td>
		          		</tr>
		          		<tr>
		          			<td colspan="3"><div id="fecApertSelCaja"></div></td>
		          		</tr>
		          		<tr>
		          			<td colspan="3"><div id="lblTotalApertura"></div></td>
		          		</tr>
		          		<tr>
		          			<td style="width:33.3%;color:#006699;"><b>EFECTIVO</b></td>
		          			<td style="width:33.3%;color:#006699;"><b>VISA</b></td>
		          			<td style="width:33.3%;color:#006699;"><b>MASTERCARD</b></td>
		          		</tr>
		          		<tr>
		          			<td><div class="btn btn-info" style="width:90%;" id="lblEfectivo"></div></td>
		          			<td><div class="btn btn-primary" style="width:90%;" id="lblVisa"></div></td>
		          			<td><div class="btn btn-danger bg-yellow" style="width:90%;" id="lblMastercard"></div></td>
		          		</tr>
		          		<tr>
		          			<td colspan="3"><div id="lblPropina"></div></td>
		          		</tr>
		          		<tr>
		          			<td colspan="3"><div id="lblTotal"></div></td>
		          		</tr>
		          	</table>
		              <!-- <table class="table table-striped" id="tblTotales" style="border: 0.1px #EEE solid;">
		              <caption>Totales</caption>
		                <tr>
		                  <th style="width: 10%;background-color: #006699;color: white;text-align: center;">N°</th>
		                  <th style="width: 25%;background-color: #006699;color: white;">Efectivo</th>
		                  <th style="width: 25%;background-color: #006699;color: white;">Visa</th>
		                  <th style="width: 10%;background-color: #006699;color: white;">MasterCard</th>
		                </tr>
		                
		              </table> -->
		            </div><!-- /.box-body -->	
		        </div>
		        <div class="col-sm-1"></div>
	        </div>

        </div>
      </form>

    </div>
  </div>
</div>




<!-- Modal Apertura -->
<div class="modal fade" id="modalApertura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-opencart"></i> &nbsp;&nbsp;Apertura Caja</h4>
      </div>

      <div class="modal-body">
	      <form class="form-horizontal">
			<div class="box-body">
		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtMontoApertura">Monto</label>
		            <div class="col-sm-9"> 
		              <input type="text" name="txtMontoApertura" class="form-control" id="txtMontoApertura" placeholder="0.00">
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtNomUsuarioApert">Usurio</label>
		            <div class="col-sm-9"> 
		              <input type="text" name="txtNomUsuarioApert" class="form-control" id="txtNomUsuarioApert"  value="<?php echo $this->session->userdata('s_nomUsuario');?>" readonly>
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtClaveApert">Clave</label>
		            <div class="col-sm-9"> 
		              <input type="password" name="txtClaveApert" class="form-control" id="txtClaveApert" placeholder="********">
		            </div>
		        </div>
			</div>
		  </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCerrarModalApert" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnAperturarCaja">Aperturar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Cierre -->
<div class="modal fade" id="modalCierre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-circle-o"></i> &nbsp;&nbsp;Cierre Caja</h4>
      </div>

      <div class="modal-body">
	      <form class="form-horizontal" action="<?php echo base_url(); ?>caperturacierre/cerrarCaja">
			<div class="box-body">
		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtMontoCierre">Monto</label>
		            <div class="col-sm-9"> 
		              <input type="text" name="txtMontoCierre" class="form-control" id="txtMontoCierre" placeholder="0.0" disabled="">
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtNomUsuarioCierre">Usurio</label>
		            <div class="col-sm-9"> 
		              <input type="text" name="txtNomUsuarioCierre" class="form-control" id="txtNomUsuarioCierre" value="<?php echo $this->session->userdata('s_nomUsuario');?>" readonly>
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="col-sm-3 control-label" for="txtClaveCierre">Clave</label>
		            <div class="col-sm-9"> 
		              <input type="password" name="txtClaveCierre" class="form-control" id="txtClaveCierre" placeholder="********">
		            </div>
		        </div>
			</div>
		  </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCerrarModalCierre" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnCerrarCaja">Cerrar Caja</button>
      </div>
    </div>
  </div>
</div>

<!-- Campos ocultos -->
<input type="hidden" id="hdnIdAperturaCierre"></input>
<input type="hidden" id="hdnIdCaja"></input>




<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">var baseurl = "<?php echo base_url(); ?>";
	$(document).ready(function(){
		// $('#tblCajas th').css("background-color","rgba(255,0,0,0.1)");
		// $(window).scroll(function(){
		// 	var scroll = $(window).scrollTop();

		// 	if (scroll>10) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.1)");}
		// 	if (scroll>20) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.2)");}
		// 	if (scroll>30) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.3)");}
		// 	if (scroll>40) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.4)");}
		// 	if (scroll>50) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.5)");}
		// 	if (scroll>60) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.6)");}
		// 	if (scroll>70) {$('#tblCajas th').css("background-color","rgba(255,0,0,0.7)");}
		// });

		

		//Cargamos las cajas y sus estados
		$.post("<?php echo base_url(); ?>caperturacierre/getCajaAC",      
      	function(data){//alert(data);
        	var result = JSON.parse(data);
        	var row = 1;
        	var output = null;
        	var btn = null;
        	$.each(result, function(i,item){

        		if (item.estado == 'A') {
					btn = '<td>'+
							'<a href="#" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#modalCierre" style="width: 80%;" onClick="selAperturaCierre('+item.idAperturaCierre+','+item.idCaja+');"><i class="fa fa-fw fa-power-off"></i></a>'+
							'</td>'+
							'<td>'+
							'<a href="#" class="btn btn-block btn-primary btn-sm" style="width: 80%;" onClick="selCaja(\''+item.cajero+'\','+item.idCaja+',\''+item.descripcion+'\',\''+item.fecApertura+'\');"><i class="fa fa-fw fa-external-link-square"></i></a>'+
							'</td>';
				}else{
					btn = '<td><a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modalApertura" style="width: 80%;" onClick="selAperturaCierre('+item.idAperturaCierre+','+item.idCaja+');"><i class="fa fa-fw fa-external-link-square"></i></a></td>';
				}

        		output = '<tr>'+
        				 '<td style="text-align:center;">'+row+'</td>'+
        				 '<td style="color:#006699;"><i class="fa fa-check-circle"></i> &nbsp;&nbsp;'+item.descripcion+'</td>'+
        				 '<td style="color:#4F7C0F;">'+item.estadoCompleto+'</td>'+
        				 btn+
        				 '</tr>';
        		$('#tblCajas').append(output);
        		row++;
        	});
      	});

		// var clickap = 0;
		$('#btnAperturarCaja').click(function(){
			
			
			// clickap++;
			// if (clickap==1) {

				// timer = setTimeout(function() {
					var cl = $('#txtClaveApert').val();
					var idAC = $('#hdnIdAperturaCierre').val();
					var idC = $('#hdnIdCaja').val();
					var monto = $('#txtMontoApertura').val();




					$.ajax({
						url: "<?php echo base_url(); ?>caperturacierre/regAperturaCierre",
						type: 'POST',
						dataType: 'html',
						data: {
							clave:cl,
							idTMC:1,
							idAC:idAC,
							idC:idC,
							monto:monto,
							saldo:monto,
							estado: 'A',
							ultimo:1
						},
						beforeSend: function(){
							$('#btnAperturarCaja').prop('disabled', true);
							// $('#btnAperturarCaja').css('display', 'none');
						},
					})
					.done(function(data) {
						if (data == 1) {
							$('#btnCerrarModalApert').click();
							location.reload();
						}
						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});




					// $.post("<?php echo base_url(); ?>caperturacierre/regAperturaCierre",	
					// {
					// 	clave:cl,
					// 	idTMC:1,
					// 	idAC:idAC,
					// 	idC:idC,
					// 	monto:monto,
					// 	saldo:monto,
					// 	estado: 'A',
					// 	ultimo:1
					// },			
					// function(data){
					// 	if (data == 1) {
					// 		$('#btnCerrarModalApert').click();
					// 		location.reload();
					// 	}
					// 	clickap = 0;
					// });
				// }, 1000);
			// }else{

			// }
			
			
		});

		// var clickcr = 0;
		$('#btnCerrarCaja').click(function(){
			// clickcr++;
			// if (clickcr==1) {

				// timer = setTimeout(function() {
					var cl = $('#txtClaveCierre').val();
					var idAC = $('#hdnIdAperturaCierre').val();
					var idC = $('#hdnIdCaja').val();
					var monto = $('#txtMontoCierre').val();
					
					$.ajax({
						url: "<?php echo base_url(); ?>caperturacierre/regAperturaCierre",
						type: 'POST',
						dataType: 'html',
						data: {
							clave:cl,
							idTMC:3,
							idAC:idAC,
							idC:idC,
							monto:monto,
							saldo:0,
							estado: 'C',
							ultimo:1
						},
						beforeSend: function(){
							$('#btnCerrarCaja').prop('disabled', true);
						},
					})
					.done(function(data) {
						if (data == 1) {
							$('#btnCerrarModalCierre').click();
							location.reload();
						}
						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});





					
					// $.post("<?php echo base_url(); ?>caperturacierre/regAperturaCierre",	
					// {
					// 	clave:cl,
					// 	idTMC:3,
					// 	idAC:idAC,
					// 	idC:idC,
					// 	monto:monto,
					// 	saldo:0,
					// 	estado: 'C',
					// 	ultimo:1
					// },			
					// function(data){
					// 	if (data == 1) {
					// 		$('#btnCerrarModalCierre').click();
					// 		location.reload();
					// 	}
					// 	clickcr = 0;
					// });
				// }, 1000);
			// }else{

			// }			
			
		});

		$('#modalCierre').on('show.bs.modal', function () {
			var idC = $('#hdnIdCaja').val();
			$.post("<?php echo base_url(); ?>caperturacierre/getLastSaldo",	
			{idC:idC},			
			function(data){
				$('#txtMontoCierre').val(data);
			});

		});
      	
	});

	function selAperturaCierre(idAc,idC){
		document.getElementById('hdnIdAperturaCierre').value = idAc;
		document.getElementById('hdnIdCaja').value = idC;
	}
</script>





<?php else : echo "no autorizado"; ?>

<?php endif; ?>