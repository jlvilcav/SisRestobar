$(document).ready(function(){
	// alert('Medida');
	
	//cargar tabla con las medidas
	loadMedidas = function(){
		$('#tblMedidas tbody').html('');
		$.ajax({
			url: baseurl + 'ccommon/getMedida',
			type: 'GET',
			dataType: 'html',
			data: {},
		})
		.done(function(data) {
			var obj = $.parseJSON(data);
			var c = 1;
			$.each(obj, function(index, item) {
				$('#tblMedidas tbody').append(
					'<tr>' +
			          	'<td align="center">' + c + '</td>' +
			          	'<td style="color:#006699;"><strong>' + item.descripcion + '</strong></td>' +
			          	'<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalEditMedida" onclick="selMedida('+item.idMedida+',\'' + item.descripcion + '\')"><i class="fa fa-edit"></i> &nbsp;Editar</button></td>' +
		            '</tr>'
					);
				c++;
			});
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	};
	loadMedidas();

	//selMedida
	selMedida = function(idMed,descp){
		$('#mhdnIdMedida').val(idMed);		
		$('#mtxtMedida').val(descp);
	}

	//guardamos Medida
	$('#btnGuardarMedida').click(function() {
		var med = $('#txtMedida').val();
		if (!med) {
			alert('Ingrese Medida');
			return false;
		}

		$.ajax({
			url: baseurl + 'cmantenimiento/regMedida',
			type: 'POST',
			dataType: 'html',
			data: {
				txtMedida : med
			},
		})
		.done(function(data) {
			// alert(data);
			if (data > 0) {
				alert('Se grabo correctamente');
				loadMedidas();
			}else{
				alert('ERROR.');
			}
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	//actualizamos Medida
	$('#mbtnUpdMedida').click(function() {
		var med = $('#mtxtMedida').val();
		var idM = $('#mhdnIdMedida').val();
		if (!med) {
			alert('Ingrese Medida');
			return false;
		}

		$.ajax({
			url: baseurl + 'cmantenimiento/updMedida',
			type: 'POST',
			dataType: 'html',
			data: {
				mhdnIdMedida : idM,
				mtxtMedida : med
			},
		})
		.done(function(data) {
			// alert(data);
			if (data > 0) {
				// alert('Se grabo correctamente');
				$('#mbtnCerrarModal').click();
				loadMedidas();
			}else{
				alert('ERROR.');
			}
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	
});