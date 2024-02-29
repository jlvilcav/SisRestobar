$(document).ready(function() {

	$('#tblListCatInsumo').DataTable({
	  'paging': true,
	  'info': false,
	  'stateSave': true
	});

	// 
	selCatIns = function(idCatIns, nomCatins){
		$('#mhdnIdCatIns').val(idCatIns);
		$('#mtxtNomCatIns').val(nomCatins);
	};

	//metodo update del modal
	$('#mbtnUpdCatIns').click(function(){
		var idCI = $('#mhdnIdCatIns').val();
		var nomCI = $('#mtxtNomCatIns').val();
		$.post(baseurl+"cinsumo/updCatIns",	
		{
			mhdnIdCatIns:idCI,
			mtxtNomCatIns:nomCI
		},			
		function(data){
			if (data == 1) {
				alert('Se actualizo correctamente');
				$('#mbtnCerrarModal').click();
				location.reload();
			}
		});
	});

});