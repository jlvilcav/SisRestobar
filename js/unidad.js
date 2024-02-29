$(document).ready(function(){
	// alert('unidad');
	
	//cargar tabla con las unidades
	loadUnidades = function(){
		$('#tblUnidades tbody').html('');
		$.ajax({
			url: baseurl + 'ccommon/getUnidad',
			type: 'GET',
			dataType: 'html',
			data: {},
		})
		.done(function(data) {
			var obj = $.parseJSON(data);
			var c = 1;
			$.each(obj, function(index, item) {
				$('#tblUnidades tbody').append(
					'<tr>' +
			          	'<td align="center">' + c + '</td>' +
			          	'<td style="color:#006699;"><strong>' + item.descripcion + '</strong></td>' +
			          	'<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalEditUnidad" onclick="selUnidad('+item.idUnidad+',\'' + item.descripcion + '\')"><i class="fa fa-edit"></i> &nbsp;Editar</button></td>' +
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
	loadUnidades();

	//selunidad
	selUnidad = function(idUnd,descp){
		$('#mhdnIdUnidad').val(idUnd);		
		$('#mtxtUnidad').val(descp);
	}

	//guardamos unidad
	$('#btnGuardarUnidad').click(function() {
		var und = $('#txtUnidad').val();
		if (!und) {
			alert('Ingrese unidad');
			return false;
		}

		$.ajax({
			url: baseurl + 'cmantenimiento/regUnidad',
			type: 'POST',
			dataType: 'html',
			data: {
				txtUnidad : und
			},
		})
		.done(function(data) {
			// alert(data);
			if (data > 0) {
				alert('Se grabo correctamente');
				loadUnidades();
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

	//actualizamos unidad
	$('#mbtnUpdUnidad').click(function() {
		var und = $('#mtxtUnidad').val();
		var idU = $('#mhdnIdUnidad').val();
		if (!und) {
			alert('Ingrese unidad');
			return false;
		}

		$.ajax({
			url: baseurl + 'cmantenimiento/updUnidad',
			type: 'POST',
			dataType: 'html',
			data: {
				mhdnIdUnidad : idU,
				mtxtUnidad : und
			},
		})
		.done(function(data) {
			// alert(data);
			if (data > 0) {
				// alert('Se grabo correctamente');
				$('#mbtnCerrarModal').click();
				loadUnidades();
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