$(document).ready(function(){

    $('#btnBuscarVentas').click(function(){
        var rango = $('#datFecIniFinVentas span').html().trim();
        var fecIni = rango.substring(0, 10);//$('#datFecIni').val();
        var fecFin = rango.substring(13, 23);//$('#datFecFin').val();
        loadVentas(fecIni,fecFin);
    });
    
    loadVentas = function(fecIni, fecFin){
        var fid = fecIni.substring(0, 2);
        var fim = fecIni.substring(3, 5);
        var fia = fecIni.substring(6, 10);
        var fi = fia+'-'+fim+'-'+fid;

        var ffd = fecFin.substring(0, 2);
        var ffm = fecFin.substring(3, 5);
        var ffa = fecFin.substring(6, 10);
        var ff = ffa+'-'+ffm+'-'+ffd;

        // alert('creportes/downloadRepVentas/'+fi+'/'+ff);
        $('#abtnDownloadExcelVentas').attr('href',baseurl+'creportes/downloadRepVentas/'+fi+'/'+ff); 
        
        $('#tblAllVentas').DataTable().destroy();
        $('#tblAllVentas').DataTable({
            // "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            // 'paging': true,
            // 'info': false,
            // 'filter': true,
            // 'processing':true,
            // 'serverSide':true,
            'ajax': {
                "url":baseurl+"cventa/ventasByDate/",
                "type":"POST",
                "data": {
                    fecIni: fecIni,
                    fecFin: fecFin
                },
                dataSrc: '',
                // dataSrc: function(data){
                //     alert(data);
                //   return data;          
                // }
            },
            'columns': [
                {data: 'rownum'},
                {data: 'cliente'},
                {data: 'fecVenta'},
                {data: 'empleado'},
                {data: 'descripcion','sClass':'dt-body-center'},
                {data: 'numVentaGenerado','sClass':'dt-body-center'},
                {data: 'total'},

                {
                    "orderable": true,
                    'sClass':'dt-body-center',
                    render:function(data, type, row){
                  
                        return '<a href="' + baseurl + 'cventa/getDetalleventa/' +
                                row.idVenta + "/" +
                                row.cliente.replace(/ /g,'-').replace(/,/g,'.') + '/' +
                                // str_replace(" ","-",str_replace(",",".",row.cliente))."/".
                                row.fecVenta.replace(/ /g,'_').replace(/\//g,'-') + '/' +
                                // str_replace(" ","_",str_replace("/","-",row.fecVenta))."/".
                                row.numVentaGenerado + "/" +
                                row.total + '/' + 
                                row.propina + '"' +
                                ' class="btn btn-block btn-primary btn-sm" style="width: 80%;"><i class="fa fa-fw fa-external-link-square"></i></a>';
                    }
                }
            ],
            "columnDefs": [
                {
                    "targets": [1], 
                    "data": "cliente",
                    "render": function(data, type, row) { 
                        return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;&nbsp;" + data +"</span>";
                    }
                },
                {
                    "targets": [3], 
                    "data": "empleado",
                    "render": function(data, type, row) { 
                        return "<span style='color:#4F7C0F;'><i class='fa fa-child'></i>" + data +"</span>";
                    }
                },
            ],
            "order": [[ 0, "desc" ]],
        });
    
    };

});