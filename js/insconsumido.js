$(document).ready(function() {
	
  	// $('#tblAfiliados').DataTable().destroy();
	$('#tblApertCierre').DataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]],
      // "pagingType": "full_numbers",
      //"displayStart": 20,
      'paging': true,
      'info': false,
      'filter': true,
      // 'stateSave': false,
      'ajax': {
        "url":baseurl+"creportes/getAperturaCierre/", //
        "type":"POST",
        dataSrc: ''
        // dataSrc: function(data){
        //     alert(data);
        //   return data;          
        // }
      },
      'columns': [
        {data: 'idAperturaCierre'},
        {data: 'descripcion'},
        {data: 'fecApertura','sClass':'dt-body-center'},
        {data: 'fecCierre','sClass':'dt-body-center'},
        
        {"orderable": true,
        'sClass':'dt-body-center',
          render:function(data, type, row){
        
              return '<span class="pull-center">' +
                      '<div class="dropdown">' +
                      '  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' +
                      '    Acciones' +
                      '  <span class="caret"></span>' +
                      '  </button>' +
                      '    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">' +
                      '    <li><a href="#" data-toggle="modal" data-target="#modalApertura" onClick="getInsCons(\''+row.fecApertura+'\','+'0'+')"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Desde Fec. Apertura</a></li>' +
                      '    <li><a href="#" data-toggle="modal" data-target="#modalApertura" onClick="getInsCons(\''+row.fecApertura+'\',\''+row.fecCierre+'\')"><i class="glyphicon glyphicon-print" style="color:#006699"></i> Entre Fec. Apert y Cierre</a></li>' +
                      '    </ul>' +
                      '</div>' +
                      '</span>';
          }
        }
      ],
      "columnDefs": [
        {
          "targets": [1], 
          "data": "descripcion",
          "render": function(data, type, row) { 
              return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;" + data +"</span>";
          }
        },
        

       ],
      "order": [[ 0, "desc" ]],
      
    });

    getInsCons = function(fecApertura, fecCierre){

      $('#hdnFecApert').val('');
      $('#hdnFecCierre').val('');

      $('#hdnFecApert').val(fecApertura);
      $('#hdnFecCierre').val(fecCierre);

      $('#tblProductos tbody').html('');
        // alert(fecApertura + fecCierre);
        $.ajax({
            url: baseurl + 'creportes/getProductosConsumidos/',
            type: 'POST',
            dataType: 'html',
            data: {
                fa: fecApertura,
                fc: fecCierre
            },
        })
        .done(function(data) {
            // alert(data);
            // console.log(data);
            var ins = $.parseJSON(data);
            var c = 1;
            // alert(ins);
            $.each(ins, function(i, item){
              // alert(item.cant + ' - ' + item.nombre);

              $('#tblProductos tbody').append(
                  '<tr>' + 
                  '   <td>' + c + '</td>' + 
                  '   <td>' + item.nombre + '</td>' + 
                  '   <td>' + item.cant + '</td>' + 
                  '</tr>'
                );

              c++;
            });
            console.log(data);
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    }

  $('#btnVerInsumos').click(function(){
    var fecApertura = $('#hdnFecApert').val();
    var fecCierre = $('#hdnFecCierre').val();

    $('#tblInsConsumido tbody').html('');

    $('#btnCerrarModalApert').click();
    $.ajax({
        url: baseurl + 'creportes/getInsConsumidos/',
        type: 'POST',
        dataType: 'html',
        data: {
            fa: fecApertura,
            fc: fecCierre
        },
    })
    .done(function(data) {
        // alert(data);
        // console.log(data);
        var ins = $.parseJSON(data);
        var c = 1;
        // alert(ins);
        $.each(ins, function(i, item){
          // alert(item.cant + ' - ' + item.nombre);

          $('#tblInsConsumido tbody').append(
              '<tr>' + 
              '   <td>' + c + '</td>' + 
              '   <td>' + item.descripcion + '</td>' + 
              '   <td>' + parseFloat(item.consumido).toFixed(2) + '</td>' + 
              '   <td align="center">' + item.unidad + '</td>' + 
              '</tr>'
            );

          c++;
        });

        fecApertura = fecApertura.replace(/\//g,'-').replace(/ /g,'_');
        fecCierre = fecCierre.replace(/\//g,'-').replace(/ /g,'_');

        $('#btnImprimeIC').attr("href", baseurl + "creportes/imprimeInsConsumidos/" + fecApertura + "/" + fecCierre)
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