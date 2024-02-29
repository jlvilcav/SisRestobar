$(document).ready(function(){

	//cargamos los combos
	//categoria insumo
	$.ajax({
		url: baseurl + 'ccommon/getCategoriaInsumo/',
		type: 'POST',
		dataType: 'html',
		data: {},
	})
	.done(function(data) {
		var obj = $.parseJSON(data);
		// alert(obj);
		$.each(obj, function(index, item) {
		$('#mcboCategInsumo').append(
			'<option value="'+item.idCategoriaInsumo+'">'+item.descripcion+'</option>'
			);
		});
		console.log("success");
	});

	//combo unidad
	$.ajax({
		url: baseurl + 'ccommon/getUnidad/',
		type: 'POST',
		dataType: 'html',
		data: {},
	})
	.done(function(data) {
		var obj = $.parseJSON(data);
		// alert(obj);
		$.each(obj, function(index, item) {
		$('#mcboUnidad').append(
			'<option value="'+item.idUnidad+'">'+item.descripcion+'</option>'
			);
		});
		console.log("success");
	});

	//combo Medida
	$.ajax({
		url: baseurl + 'ccommon/getMedida/',
		type: 'POST',
		dataType: 'html',
		data: {},
	})
	.done(function(data) {
		var obj = $.parseJSON(data);
		// alert(obj);
		$.each(obj, function(index, item) {
		$('#mcboMedida').append(
			'<option value="'+item.idMedida+'">'+item.descripcion+'</option>'
			);
		});
		console.log("success");
	});

	loadAllInsumos = function(){
		$('#tblAllInsumos').DataTable().destroy();
		$('#tblAllInsumos').DataTable({
	      	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
	      	'paging': true,
	      	'info': false,
	      	'filter': true,
	      	'ajax': {
		        "url":baseurl+"cinsumo/getAllInsumos/",
		        "type":"POST",
		        dataSrc: ''
	        // dataSrc: function(data){
	        //     alert(data);
	        //   return data;          
	        // }
	      },
	      'columns': [
	        {data: 'idInsumo'},
	        {data: 'descripcion'},
	        {data: 'categinsumo'},
	        {data: 'und','sClass':'dt-body-center'},
	        {data: 'med','sClass':'dt-body-center'},
	        {data: 'cantMedXUnid','sClass':'dt-body-center'},
	        
	        {"orderable": true,
	        'sClass':'dt-body-center',
	          render:function(data, type, row){
	        
	              return '<a href="#" ' +
					      		'data-idinsumo="'+row.idInsumo+'" ' +
					      		'data-descripcion="'+row.descripcion+'" ' +
					      		'data-idcatins="'+row.idCategoriaInsumo+'" ' +
					      		'data-idmedida="'+row.idMedida+'" ' +
								'data-med="'+row.med+'" ' +
								'data-idunidad="'+row.idUnidad+'" ' +
								'data-und="'+row.und+'" ' +
								'data-cantmedxunid="'+row.cantMedXUnid+'" ' +
								'data-stockminxmed="'+row.stockMinXMed+'" ' +
								'data-preciosugerido="'+row.precioSugerido+'" ' +								   
				      		'class="btn btn-block btn-primary btn-sm selInsumo" style="width: 80%;" data-toggle="modal" data-target="#modalEditInsumo"><i class="fa fa-fw fa-external-link-square"></i></a>';
	          }
	        }
	      ],
	      "columnDefs": [
	        {
	          "targets": [1], 
	          "data": "descripcion",
	          "render": function(data, type, row) { 
	              return "<span style='color:#006699;'><i class='fa fa-check'></i> &nbsp;&nbsp;" + data +"</span>";
	          }
	        },
	        {
	          "targets": [2], 
	          "data": "categinsumo",
	          "render": function(data, type, row) { 
	              return "<span style='color:#4F7C0F;'>" + data +"</span>";
	          }
	        },
	        

	       ],
	      "order": [[ 0, "desc" ]],
	      
	    });		
 		// $.ajax({
 		// 	url: baseurl + 'cinsumo/getAllInsumos/',
 		// 	type: 'POST',
 		// 	dataType: 'html',
 		// 	data: {},
 		// })
 		// .done(function(data) {
 		// 	$('#tblAllInsumos tbody').html('');
 		// 	var obj = $.parseJSON(data);
 		// 	var c = 1;
 		// 	$.each(obj,function(index, item) {
 		// 		$('#tblAllInsumos tbody').append(
 		// 			'<tr>' +
			// 	      	'<td align="center">' + c + '</td>' +
			// 	      	'<td style="color:#006699;">' + item.descripcion + '</td>' +
			// 	      	'<td style="color:#4F7C0F;">' + item.categinsumo + '</td>' +
			// 	      	'<td><i class="fa fa-check"></i> &nbsp;' + item.und + '</td>' +
			// 	      	'<td align="center">' + item.med + '</td>' +
			// 	      	'<td align="center">' + item.cantMedXUnid + '</td>' +
			// 	      	'<td align="center"><a href="#" ' +
			// 		      		'data-idinsumo="'+item.idInsumo+'" ' +
			// 		      		'data-descripcion="'+item.descripcion+'" ' +
			// 		      		'data-idcatins="'+item.idCategoriaInsumo+'" ' +
			// 		      		'data-idmedida="'+item.idMedida+'" ' +
			// 					'data-med="'+item.med+'" ' +
			// 					'data-idunidad="'+item.idUnidad+'" ' +
			// 					'data-und="'+item.und+'" ' +
			// 					'data-cantmedxunid="'+item.cantMedXUnid+'" ' +
			// 					'data-stockminxmed="'+item.stockMinXMed+'" ' +
			// 					'data-preciosugerido="'+item.precioSugerido+'" ' +								   
			// 	      		'class="btn btn-block btn-primary btn-sm selInsumo" style="width: 80%;" data-toggle="modal" data-target="#modalEditInsumo"><i class="fa fa-fw fa-external-link-square"></i></a></td>' +
			//       	'</tr>'
 		// 			);

 		// 		c++;
 		// 	});
 		// 	console.log("success");
 		// })
 		// .fail(function() {
 		// 	console.log("error");
 		// })
 		// .always(function() {
 		// 	console.log("complete");
 		// });
 		
 	};
    loadAllInsumos();

    //seleccionamos insumo
	$('#tblAllInsumos').on('click','.selInsumo',function(ev){
	    var b = $(this);
	    var ins = {
	      id: b.data('idinsumo'),
	      descripcion: b.data('descripcion'),
	      idcatins: b.data('idcatins'),
	      idMedida: b.data('idmedida'),
	      med: b.data('med'),
	      idUnidad: b.data('idunidad'),
	      und: b.data('und'),
	      cantMedXUnid: b.data('cantmedxunid'),
	      stockMinXMed: b.data('stockminxmed'),
	      precioSugerido: b.data('preciosugerido')
	    }
	    selInsumo(ins);
	});

	function selInsumo(ins)
	{
		$('#mhdnIdInsumo').val(ins.id);
	    $('#mtxtInsumo').val(ins.descripcion);
	    $('#mcboCategInsumo').val(ins.idcatins);
	    $('#mcboUnidad').val(ins.idUnidad);
	    $('#mhdnIdUnidad').val(ins.idUnidad);
	    $('#mcboMedida').val(ins.idMedida);
	    $('#mhdnIdMedida').val(ins.idMedida);
	    $('#mtxtCantXMedida').val(ins.cantMedXUnid);
	    $('#mtxtStockMinUnid').val(ins.stockMinXMed/ins.cantMedXUnid);
	    $('#mtxtStockMin').val(ins.stockMinXMed);	    
	    $('#mtxtPrecSugerido').val(ins.precioSugerido);

	}

	//multiplicacion unidad por medida
	$('#mtxtStockMinUnid').keyup(function(){
      var cxm = $('#mtxtCantXMedida').val();
      var smu = $('#mtxtStockMinUnid').val();
      $('#mtxtStockMin').val(cxm*smu);
    });

    //update actualizar insumo
    $('#btnUpdateInsumo').click(function(){
    	var mhdnIdInsumo = $('#mhdnIdInsumo').val();
	    var mtxtInsumo = $('#mtxtInsumo').val();
	    var mcboCategInsumo = $('#mcboCategInsumo').val();
	    var mcboUnidad = $('#mcboUnidad').val();
	    var mhdnIdUnidad = $('#mhdnIdUnidad').val();
	    var mcboMedida = $('#mcboMedida').val();
	    var mhdnIdMedida = $('#mhdnIdMedida').val();
	    var mtxtCantXMedida = $('#mtxtCantXMedida').val();
	    var mtxtStockMin = $('#mtxtStockMin').val();	    
	    var mtxtPrecSugerido = $('#mtxtPrecSugerido').val();

	    // alert(mhdnIdInsumo + ' - ' + mtxtInsumo);
    	// var param = $('#mfrmUpdInsumo').serializeArray();
    	$.ajax({
    		url: baseurl + 'cinsumo/updInsumo/',
    		type: 'POST',
    		dataType: 'html',
    		data:{
    			mhdnIdInsumo: mhdnIdInsumo,
				mtxtInsumo: mtxtInsumo,
				mcboCategInsumo: mcboCategInsumo,
				mcboUnidad: mcboUnidad,
				mhdnIdUnidad: mhdnIdUnidad,
				mcboMedida: mcboMedida,
				mhdnIdMedida: mhdnIdMedida,
				mtxtCantXMedida: mtxtCantXMedida,
				mtxtStockMin: mtxtStockMin,
				mtxtPrecSugerido: mtxtPrecSugerido
    		} //$('#mfrmUpdInsumo').serializeArray()
    	})
    	.done(function(data) {
    		$('#btnCerrarModalEditInsumo').click();
    		loadAllInsumos();
    		console.log(data);
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    });
});