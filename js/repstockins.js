$(document).ready(function(){
	// alert('repor');
	// insStockMin = function(){
	// 	$.ajax({
	// 		url: baseurl + 'creportes/getStockIns',
	// 		type: 'GET',
	// 		dataType: 'html',
	// 		data: {},
	// 	})
	// 	.done(function(data) {
	// 		var obj = $.parseJSON(data);
	// 		var c = 1;
	// 		$.each(obj, function(index, item) {
	// 			$('#tblStockIns').append(
	// 				'<tr>' +
	// 		          	'<td align="center">' + c + '</td>' +
	// 		          	'<td style="color:#006699;">' + item.insumo + '</td>' +
	// 		          	'<td>' + item.minUnidad + '</td>' +
	// 		          	'<td style="color:#61842c;">' + item.stockUnid + '</td>' +
	// 		          	'<td>' + item.unidad + '</td>' +
	// 	            '</tr>'
	// 				);
	// 			c++;
	// 		});
			
	// 		console.log("success");
	// 	})
	// 	.fail(function() {
	// 		console.log("error");
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
		
	// };
	// insStockMin();


	$('#tblStockIns').DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
      "pagingType": "full_numbers",
      //"displayStart": 20,
      'paging': true,
      'info': false,
      'filter': true,
      'stateSave': false,
      'ajax': {
        "url":baseurl+"creportes/getStockIns",
        "type":"POST",
        // "data":'',
        "dataSrc":''
      },
      'columns': [
        {data: 'rownum','sClass':'dt-body-center'},
        {data: 'insumo'},
        {data: 'cantMedXUnid','sClass':'dt-body-right'},
        {data: 'minUnidad','sClass':'dt-body-right'},
        {data: 'stockXMedida','sClass':'dt-body-right'},
        {data: 'medida','sClass':'dt-body-center'},
        {data: 'stockUnid','sClass':'dt-body-right'},
        {data: 'unidad','sClass':'dt-body-center'}
      ],
      "columnDefs": [
        {
          "targets": [1], // El objetivo de la columna de posición, desde cero.
          "data": "insumo", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#006699;'><strong>" + data + "</strong></span>";
          }
        },
        {
          "targets": [2], // El objetivo de la columna de posición, desde cero.
          "data": "minUnidad", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#4F7C0F;'>" + data + "</span>";              
          }
        }
       ],
      "order": [[ 0, "asc" ]],      
    });

});