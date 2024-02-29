selCaja = function(cajero,idCaja,nombre,fecApert){
	$('#tblInfoCaja').css('display','block');
	$('#nomSelCaja').html('<i class="fa fa-check-circle"></i> '+nombre);
	$('#fecApertSelCaja').html('<b>Fecha Apertura: </b>'+fecApert.replace(/-/g,'/'));
	$('#lblCajero').html('<b>Empleado: </b>'+cajero);	
	$('#tblCabecera').html();
	
	var total = 0;

	var cantApert = 0;
	//Con cuanto se aperturo la caja
	$.ajax({
		url: baseurl+"caperturacierre/getCantApertura",
		type: 'POST',
		dataType: 'html',
		async: false,
		data: {idC:idCaja},
	})
	.done(function(data) {
		cantApert = data;
		var v = data;
        if (v == null || v == '') {v = '0.00';}
        $('#lblTotalApertura').html('<b>* Esta caja se aperturo con : <span style="color:#CC4956;">' + parseFloat(v).toFixed(2)+ '</span></b>');
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
    // $.post(baseurl+"caperturacierre/getCantApertura",  
    //   {idC:idCaja},     
    //   function(data){
    //     var v = data;
    //     if (v == null || v == '') {v = '0.00';}
    //     $('#lblTotalApertura').html('<b>* Esta caja se aperturo con : <span style="color:#CC4956;">' + parseFloat(v).toFixed(2)+ '</span></b>');
    // });

	//Total efectivo ingresado (sin la cantidad de la apertura)
	$.ajax({
		url: baseurl+"caperturacierre/getTotalEfectivo",
		type: 'POST',
		dataType: 'html',
		async: false,
		data: {idC:idCaja, fecApert:fecApert},
	})
	.done(function(data) {
		// alert(data);
		var v = data;
		if (v == null || v == '') {v = '0.00';}
		$('#lblEfectivo').html(v);
		total += parseFloat(v) + parseFloat(cantApert);
		// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
		$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	// $.post(baseurl+"caperturacierre/getTotalEfectivo",	
	// {idC:idCaja},
	// function(data){
	// 	var v = data;
	// 	if (v == null || v == '') {v = '0.00';}
	// 	$('#lblEfectivo').html(v);
	// 	total += parseFloat(v);
	// 	// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
	// 	$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
	// });

	//Total efectivo ingresado (sin la cantidad de la apertura)
	$.post(baseurl+"caperturacierre/getTotalPropina",	
	{idC:idCaja},			
	function(data){
		var v = data;
		if (v == null || v == '') {v = '0.00';}
		// $('#lblPropina').html(v);
		propi = parseFloat(v);

		//total += parseFloat(v);
		$('#lblPropina').html('<b><i class="fa fa-dollar"></i> &nbsp;Total Propina:</b> ' + propi.toFixed(2));
		$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
	});

	//Visa
	$.ajax({
		url: baseurl+"caperturacierre/getTotalVisa",
		type: 'POST',
		dataType: 'html',
		async: false,
		data: {idC:idCaja, fecApert:fecApert},
	})
	.done(function(data) {
		var v = data;
		if (v == null || v == '') {v = '0.00';}
		$('#lblVisa').html(v);
		total += parseFloat(v);
		// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
		$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	});
	
	// $.post(baseurl+"caperturacierre/getTotalVisa",	
	// {idC:idCaja},
	// function(data){
	// 	var v = data;
	// 	if (v == null || v == '') {v = '0.00';}
	// 	$('#lblVisa').html(v);
	// 	total += parseFloat(v);
	// 	// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
	// 	$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
	// });

	//Mastercard
	$.ajax({
		url: baseurl+"caperturacierre/getTotalMastercard",
		type: 'POST',
		dataType: 'html',
		async: false,
		data: {idC:idCaja, fecApert:fecApert},
	})
	.done(function(data) {
		var v = data;
		if (v == null || v == '') {v = '0.00';}
		$('#lblMastercard').html(v);
		total += parseFloat(v);
		// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
		$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	// $.post(baseurl+"caperturacierre/getTotalMastercard",	
	// {idC:idCaja},			
	// function(data){
	// 	var v = data;
	// 	if (v == null || v == '') {v = '0.00';}
	// 	$('#lblMastercard').html(v);
	// 	total += parseFloat(v);
	// 	// $('#lblTotal').html('<b>Total:</b> ' + total.toFixed(2));
	// 	$('#lblTotal').html('<b style="font-size:12pt;">TOTAL : ' + total.toFixed(2) + '</b> &nbsp;&nbsp;&nbsp; (Incluido la cantidad de apertura)');
	// });

	//$('#lblTotal').html(total);

};
