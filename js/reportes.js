$(document).ready(function() {
var fechasChartjs = [];
var valoresChartjs = [];
$('#btnBuscar').click(function(){
  $('#tblAllVentas').DataTable().destroy();

  var rango = $('#datFecIniFin span').html();
  var fecIni = rango.substring(0, 10);//$('#datFecIni').val();
  var fecFin = rango.substring(13, 23);//$('#datFecFin').val();

  //alert(fecIni+"aaa"+fecFin+"bbb");
  // alert(rango);
	$('#tblAllVentas').DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
      "pagingType": "full_numbers",
      //"displayStart": 20,
      'paging': true,
      'info': false,
      'filter': false,
      'stateSave': false,
      'ajax': {
        "url":baseurl+"creportes/repVentasByDate/", //
        "type":"POST",
        "data":{
          'fecIni':fecIni,
          'fecFin':fecFin
        },
        "dataSrc": function(data){
          // alert(data);
          var return_data = new Array();
          var inTotal = 0;
          var numVent = 0;

          fechasChartjs = [];
          valoresChartjs = [];

          for(var i=0;i< data.length; i++){
            numVent += parseFloat(data[i].totVentas);
            inTotal += parseFloat(data[i].total);
            fechasChartjs.push(data[i].fecVenta);
            valoresChartjs.push(data[i].total);
          }
          //alert(fechasChartjs);
          $('#numOfVentas').html("Total ventas: " + numVent + "  -  Total Ingreso: " + inTotal.toFixed(2));
          // $('#totalIngreso').html(inTotal.toFixed(2));

          //eliminamos y creamos canvas

          $('#myChart').remove(); // this is my <canvas> element
          $('#content_canvas').append('<canvas id="myChart" width="400" height="200"><canvas>');

          // chartjs
          var colores = fechasChartjs;//["January", "February", "March", "April", "May", "June", "July"];
          var datos = valoresChartjs; //[65, 59, 80, 81, 56, 55, 40];

          var ctx = document.getElementById("myChart").getContext("2d");



          var myChart = new Chart(ctx, {
              type: 'line',
              data:{
                labels: fechasChartjs, //["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                  {
                      label: "Ica",
                      fill: true,
                      lineTension: 0.1,
                      backgroundColor: "rgba(75,192,192,0.2)",
                      borderColor: "rgba(127,206,29,1)",
                      borderCapStyle: 'butt',
                      borderDash: [],
                      borderDashOffset: 0.9,
                      borderJoinStyle: 'miter',
                      pointBorderColor: "rgba(127,206,29  ,1)",
                      pointBackgroundColor: "#fff",
                      pointBorderWidth: 10,
                      pointHoverRadius: 5,
                      pointHoverBackgroundColor: "rgba(75,192,192,1)",
                      pointHoverBorderColor: "rgba(220,220,220,1)",
                      pointHoverBorderWidth: 5,
                      pointRadius: 1,
                      pointHitRadius: 10,
                      data: datos,// [65, 59, 80, 81, 56, 55, 40],
                      spanGaps: true,
                  }
                ]
              },
              options: {
                responsive:true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
              }
            });
          //ctx.clear();
          return data;
        }
      },
      'columns': [
        {data: 'rownum','sClass':'dt-body-center'},
        {data: 'fecVenta'},
        {data: 'total'}
      ],
      "columnDefs": [
        {
          "targets": [1], // El objetivo de la columna de posición, desde cero.
          "data": "fecVenta", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#006699;'>" + data + "</span>";
          }
        },
        {
          "targets": [2], // El objetivo de la columna de posición, desde cero.
          "data": "total", // La inclusión de datos
          "render": function(data, type, row) { // Devuelve el contenido personalizado
            return "<span style='color:#4F7C0F;'>" + data + "</span>";              
          }
        }
       ],
      "order": [[ 0, "asc" ]],
      
    });//.on('draw', actualizaTotal);


  //getTotalEfectivo
  $.post(baseurl+'creportes/getTotalEfectivo',
    {fecIni: fecIni,fecFin: fecFin},
    function(data) {
      $('#totalInEfectivo').html(data);
  });
  
  // getTotalVisa
  $.post(baseurl+'creportes/getTotalVisa',
    {fecIni: fecIni,fecFin: fecFin},
    function(data) {
      $('#totalInVisa').html(data);
  });

  // getTotalMastercard
  $.post(baseurl+'creportes/getTotalMastercard',
    {fecIni: fecIni,fecFin: fecFin},
    function(data) {
      $('#totalInMastercard').html(data);
  });
  
});

// $('#tblProductos').DataTable({
//     'paging': true,
//     'info': false,
//     'stateSave': true
//   });

// $('#tblInsConsumido').DataTable();

});