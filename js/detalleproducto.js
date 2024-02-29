$(document).ready(function(){
	//limpiamos la tabla detalle insumos
	
	// $('#btnCargarInsumosProd').click(function(){
		var idProd = $('#txtDetIdProducto').val()
		// alert(idProd);
	// });

	//cargamos los insumos por producto
	loadInsOfProd = function(){
		$.ajax({
			url: baseurl + 'cproducto/getInsumoPorProducto/',
			type: 'POST',
			dataType: 'html',
			data: {idProd: idProd},
		})
		.done(function(data) {
			$('#tblDetalleProducto tbody').html('');
			var obj = $.parseJSON(data);
			// alert(obj);
			var c = 1;
			$.each(obj, function(index, item) {
				$('#tblDetalleProducto tbody').append(
					'<tr id="' + item.idInsumo + '">' +
			          	'<td align="center">' + c + '</td>' +
			          	'<td style="color:#006699;">' + item.desIns + '</td>' +
			          	'<td>' + item.cantXMedida + '</td>' +
			          	'<td>' + item.desMed + '</td>' +
			          	'<td><button type="button" onclick="deleteInsFromProd(' + item.idInsumo + ')"><i class="fa fa-trash"></i></button></td>' +
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
	loadInsOfProd();

	//elminamos una fila de la tabla insumo
	deleteInsFromProd = function(idIns){
		// $('#tblDetalleProducto tr#' + idIns).remove();
		var idProd = $('#txtDetIdProducto').val();

		$.ajax({
			url: baseurl + 'cproducto/delInsFromProd/',
			type: 'POST',
			dataType: 'html',
			data: {
				idProd: idProd,
				idIns: idIns
			},
		})
		.done(function() {
			loadInsOfProd();
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	}
	
	//seleccionamos insumo
	$('#tblBuscarInsumo').on('click','.selInsumo',function(ev){
	    var b = $(this);
	    var ins = {
	      descripcion: b.data('descripcion'),
	      medida: b.data('medida'),
	      cantidad: 0,
	      id: b.data('idinsumo')
	    }
	    selInsumo(ins);
	    $('#btnCloseModalBuscarInsumo').click()
	});

	function selInsumo(ins)
	{
	    $('#txtMedida').text(ins.medida);
	    // $('#hdnMedida').val(ins.medida);
	    $('#txtNomInsumo').val(ins.descripcion);
	    $('#txtCantIns').val(ins.cantidad);
	    $('#hdnIdInsumo').val(ins.id);
	}

	//Agregamos insumos al producto
	$('#btnAddInsumo').click(function() {
		var medida = $('#txtMedida').text();
	    // var medIns = $('#hdnMedida').val();
	    var nomIns = $('#txtNomInsumo').val();
	    var cantIns = $('#txtCantIns').val();
	    var idIns = $('#hdnIdInsumo').val();

	    if (cantIns <= 0) {
	    	alert('Ingrese la cantidad del insumo');
	    	return false;
	    }else{
		    $.ajax({
				url: baseurl + 'cproducto/addInsToProd/',
				type: 'POST',
				dataType: 'html',
				data: {
					idProd: idProd,
					idIns: idIns,
					cantIns: cantIns
				},
			})
			.done(function() {
				$('#txtMedida').text('');
			    $('#txtNomInsumo').val('');
			    $('#txtCantIns').val('');
			    $('#hdnIdInsumo').val('');
				loadInsOfProd();
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
	    }
	 //    $('#tblDetalleProducto tbody').append(
		// 	'<tr id="' + idIns + '">' +
	 //          	'<td align="center"> - </td>' +
	 //          	'<td style="color:#006699;">' + nomIns + '</td>' +
	 //          	'<td>' + cantIns + '</td>' +
	 //          	'<td>' + medIns + '</td>' +
	 //          	'<td><button type="button" onclick="deleteInsFromProd(' + idIns + ')"><i class="fa fa-trash"></i></button></td>' +
  //           '</tr>'
		// );
	});

});