$(document).ready(function(){
	// alert('reportsssss');
	// insStockMin = function(){
	// 	$.ajax({
	// 		url: baseurl + 'chome/getInsStockMin',
	// 		type: 'GET',
	// 		dataType: 'html',
	// 		data: {},
	// 	})
	// 	.done(function(data) {
	// 		var obj = $.parseJSON(data);
	// 		var c = 1;
	// 		$.each(obj, function(index, item) {
	// 			$('#tblInsStockMin').append(
	// 				'<tr>' +
	// 		          	'<td align="center">' + c + '</td>' +
	// 		          	'<td style="color:#006699;">' + item.insumo + '</td>' +
	// 		          	'<td>' + item.minUnidad + '</td>' +
	// 		          	'<td style="color:#AE1414;">' + item.stockUnid + '</td>' +
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


	$('#tblInsStockMin').DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
      "pagingType": "full_numbers",
      //"displayStart": 20,
      'paging': true,
      'info': false,
      'filter': true,
      'stateSave': false,
      'ajax': {
        "url":baseurl+"chome/getInsStockMin",
        "type":"POST",
        // "data":'',
        "dataSrc":''
      },
      'columns': [
        {data: 'rownum','sClass':'dt-body-center'},
        {data: 'insumo'},
        {data: 'minUnidad'},
        {data: 'stockUnid'},
        {data: 'unidad'}
      ],
      "columnDefs": [
        {
          "targets": [1], // El objetivo de la columna de posición, desde cero.
          "data": "insumo", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#006699;'>" + data + "</span>";
          }
        },
        {
          "targets": [2], // El objetivo de la columna de posición, desde cero.
          "data": "minUnidad", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#4F7C0F;'>" + data + "</span>";              
          }
        },
        {
          "targets": [3], // El objetivo de la columna de posición, desde cero.
          "data": "stockUnid", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#AE1414;'>" + data + "</span>";              
          }
        }
       ],
      "order": [[ 0, "asc" ]],      
    });
});