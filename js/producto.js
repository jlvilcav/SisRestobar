$(document).ready(function() {
	$('#tblListCatProducto').DataTable({
	  'paging': true,
	  'info': false,
	  'stateSave': true
	});

	// 
	selCatProd = function(idCatProd, nomCatProd){
		$('#mhdnIdCatProd').val(idCatProd);
		$('#mtxtNomCatProd').val(nomCatProd);
	};

	//metodo update del modal
	$('#mbtnUpdCatProd').click(function(){
		var idCI = $('#mhdnIdCatProd').val();
		var nomCI = $('#mtxtNomCatProd').val();
		$.post(baseurl+"cproducto/updCatProd",	
		{
			mhdnIdCatProd:idCI,
			mtxtNomCatProd:nomCI
		},			
		function(data){
			// alert(data);
			if (data == 1) {
				alert('Se actualizo correctamente');
				$('#mbtnCerrarModal').click();
				location.reload();
			}else if (data ==0) {
				alert('ERROR: No se pudo actualizar..!!');
				$('#mbtnCerrarModal').click();
				location.reload();
			}
		});
	});

});