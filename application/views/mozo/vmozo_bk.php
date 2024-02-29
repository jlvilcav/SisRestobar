<!DOCTYPE html>
<html ng-app="restobar.mozo">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/angularjs/loading-bar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/columns.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />

    <style type="text/css">
      .form-control-inline{
        display: inline-block;
        width: auto;
      }


      /* The Modal (background) */      
      .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 60px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
      }

      /* Modal Content */
      .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 5px;
          border: 1px solid #888;
          width: 40%;
      }

      .modal-content img {
          margin: auto;
          /*height: 100%;*/
          width: 100%;
      }

      /* The Close Button */
      .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
      }

      .close:hover,
      .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
      }
    </style>
  </head>
<body class="hold-transition" ng-controller="mainController as vm">
<?php
//echo var_dump($mesas);
?>
<header>
    <div id="topbar" style="background-color: #085981;">
        <div class="pull-right">
            <button class="btn btn-default" ng-show="vm.mode=='croquis'" ng-click="vm.newOrder()"><i class="fa fa-plus"></i> Nueva orden</button>&nbsp;
            <button class="btn btn-default" ng-show="vm.mode=='croquis' || vm.mode=='mesa'" ng-click="vm.loadPedidos()"><i class="fa fa-repeat"></i> Actualizar</button>
            <button class="btn btn-default" id="btnDescartVolver" ng-show="vm.mode=='pedido' || vm.mode=='mesa'" ng-click="vm.goTolist()">
                <i class="fa fa-chevron-circle-left"></i> {{vm.changed ? 'Descartar cambios' : 'Volver'}}
            </button>&nbsp;  
            <a href="<?php echo base_url(); ?>clogin/logout" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i>&nbsp; Salir</a>
        </div>
        <a href="<?php echo base_url(); ?>cusuario/profileOfUser" class="btn btn-default btn-flat"><span class="logo-lg"><b>Sist</b>Restobar</span></a>
        <label style="font-size: 12pt;">
            <?php echo "<label style='color:#888;'>Usuario :</label> ".$this->session->userdata('s_usu')." - ".$this->session->userdata('s_nomSucursal');?>
        </label>
        <div class="clearfix"></div>
    </div>
</header>

<section id="croquis" ng-if="vm.mode == 'croquis' || vm.mode == 'mesa'">
    <div class="control" id="divEscala" style="bottom: 10px;">     
        <div class="box-tools pull-left">
            <span>Escala</span>
        </div>
        <div class="box-tools pull-right" style="padding-bottom: 5px;">
            <button type="button" class="btn btn-box-tool btn-xs" id="btnMinEscala" onclick="document.getElementById('divEscala').style.bottom = '-35px';"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool btn-xs" id="btnMaxEscala" onclick="document.getElementById('divEscala').style.bottom = '10px';"><i class="fa fa-square"></i></button>
        </div>
        <input type="number" min="10" max="200" step="5" class="form-control" ng-model="vm.scale">
    </div>

    <div class="wrap-croquis">
        <div class="croquis" ng-class="{'empty': !vm.croquis}" ng-style="{transform: 'scale('+vm.scale / 100+')'}" style="transform-origin: top left;">
            <img ng-src="{{'<?php echo base_url();?>' + vm.croquis}}" alt="" ng-if="vm.croquis">
            <div class="mesa" ng-repeat="m in vm.mesas" ng-style="{left: m.x + 'px', top: m.y + 'px', width: m.ancho + 'px', height: m.alto + 'px'}" ng-class="{'busy': vm.pedidos[m.idMesa] && vm.pedidos[m.idMesa].pedido != vm.pedido.id ,'other': vm.pedidos[m.idMesa] && vm.pedidos[m.idMesa].mozo != vm.mozo,'selected': vm.pedido && vm.pedido.mesa.indexOf(m.idMesa) > -1 }" ng-click="vm.loadPedido(vm.pedidos[m.idMesa],m.idMesa)">
                <span class="label">{{m.nombre}}</span>
            </div>
        </div>
    </div>
</section>

<section id="details" ng-if="vm.mode == 'pedido'">
    <div id="carta" class="box">
        <div class="box__header header">
            <div class="box-tools pull-right">
                <select class="form-control form-control-inline" ng-model="vm.currentCategory" ng-options="c.idCategoriaProducto as c.descripcion for c in vm.categories | orderBy:'descripcion'">
                    <option value="">:: TODOS ::</option>
                </select>
                <input type="text" ng-model="vm.search" class="form-control form-control-inline" placeholder="Buscar..." />
            </div>
            <h3><i style="color: #CCC;" class="fa fa-reorder"></i> &nbsp;<b>CARTA ::</b></h3>
        </div>
        <div class="box__content container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12" ng-repeat="p in vm.menu | orderBy: 'name' | filter: {'categoryId':(vm.currentCategory || undefined)}:true | filter: {'name':vm.search}" >
                    <!-- <div class="producto picture">
                        <img class="img-responsive" ng-src="{{'<?php echo base_url();?>productos/' + p.image}}" alt="">
                    </div> -->
                    <div class="product">
                        <div class="picture">
                            <!-- <a href='#' id="btnOpenModalFoto" onclick="setImagen(document.getElementById('imgP'));"> -->
                            <img class="img-responsive" ng-src="{{'<?php echo base_url();?>productos/' + p.image}}" onclick="setImagen(this);" id="imgP">
                            <!-- </a> -->
                        </div>
                        <div class="description" ng-click="vm.addProducto(p)">
                            <span class="title">{{p.name}}</span>
                            <span class="price">{{p.price | currency: vm.simbolomoneda}}</span>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div id="order" class="box">
        <div class="box__header header">
          <h3><i style="color: #CCC;" class="fa fa-shopping-cart"></i> &nbsp;<b>PEDIDO ::</b></h3>
          <div class="pull-right" style="font-size: 15pt;" ng-model="vm.totalPrecio()">
            {{vm.totPag | currency : vm.simbolomoneda}}
          </div>
        </div>
        <div class="box__content">
          <div class="product" ng-repeat="pr in vm.pedido.productos">
            <span class="title">{{pr.name}}</span>
            <span class="price pull-right text-right">
              <div>
                {{(pr.price * pr.cant) | currency : vm.simbolomoneda}}
              </div>
              <small>Precio unit. {{pr.price | currency : vm.simbolomoneda}}</small>
            </span>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary" ng-click="vm.quantity(pr, -1)"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-default quantity">{{pr.cant}}</button>
              <button type="button" class="btn btn-primary" ng-click="vm.quantity(pr, 1)"><i class="fa fa-plus"></i></button>
            </div>
            <textarea ng-model="pr.detalle" class="form-control" ng-change="vm.changed = true" rows="1"></textarea>
          </div>
          <div class="empty-text" ng-show="!vm.pedido.productos.length">Pedido vacío</div>
        </div>
    </div>
</section>
<footer ng-show="vm.mode=='pedido'" style="background-color: #085981;">
  <span class="mesas">Mesas: {{vm.mesasPedido()}} 
    &nbsp;&nbsp;<button class="btn btn-default btn-xs" ng-click="vm.editMesas()"><i class="fa fa-refresh"></i> &nbsp;Cambiar mesa</button>
  </span>
  <button class="btn btn-default" ng-disabled="!vm.changed" ng-click="vm.save()"><i class="fa fa-save"></i> Guardar</button>
  <button class="btn btn-danger" ng-show="vm.pedido.id" ng-click="vm.cancel()"><i class="fa fa-trash"></i> Eliminar orden</button>
</footer>
<div class="footer" ng-if="vm.mode == 'mesa'" style="background-color: #085981;">
  <span class="mesas">Mesas: {{vm.mesasPedido()}}</span>
  <button class="btn btn-default" ng-click="vm.next()"><i class="fa fa-arrow-right"></i> Siguiente</button>
</div>
<div class="overlay" ng-show="vm.alert.show">
  <div id="adminToken" class="show">
    <label for="" class="label-control">Se requiere autorización</label>
    <input type="password" class="form-control" ng-model="vm.alert.token" autofocus="true">
    <button class="btn btn-primary" ng-click="vm.sendAuth()">Acceder</button>
    <button class="btn btn-danger" ng-click="vm.cancelAuth()">Cancelar</button>
  </div>
</div>

<!-- The Modal -->
<div id="modalFotoProd" class="modal">
  <!-- <div class="col-sm-6 col-xs-10"> -->
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close"><i class="fa fa-close"></i></span>
      <img src="" id="fotoProducto">
    </div>
  <!-- </div> -->
</div>


<script src="<?php echo base_url(); ?>assets/plugins/angularjs/angular.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/angularjs/loading-bar.min.js"></script>
<script>
angular
  .module('restobar.mozo',['angular-loading-bar'])
  .config(config)
  .controller('mainController',mainController)
  .factory('service',service);

function config($httpProvider)
{
    $httpProvider.interceptors.push(function($q) {
      return {
        responseError: function(response) {
            var data = response.data || {};
            if (data.error) {
              if (data.error.charAt(0) != '_') {
                alert(data.error);
              }
            }else{
              alert('Ocurrió un error');
            }
            return $q.reject(response);
        }
      };
    });
};

function mainController(service){
  var vm = this;
  vm.simbolomoneda = <?php echo "'".$this->session->userdata('its_rb_s_simbolomoneda')."'";?>;
  vm.menu = <?php echo json_encode($menu)?>;
  vm.categories = <?php echo json_encode($categories)?>;
  vm.mesas = <?php echo json_encode($mesas)?>;
  vm.croquis = '<?php echo $croquis;?>';
  vm.mode = "croquis";
  vm.mozo = <?php echo $mozo;?>;
  vm.scale = 180;
  vm.alert = {};

  vm.newOrder = newOrder;
  vm.goTolist = goTolist;
  vm.addProducto = addProducto;
  vm.quantity = quantity;
  vm.loadPedido = loadPedido;
  vm.loadPedidos = loadPedidos;
  vm.sendAuth = sendAuth;
  vm.cancelAuth = cancelAuth;
  vm.cancel = cancel;
  vm.save = save;
  vm.mesasPedido = mesasPedido;
  vm.editMesas = editMesas;
  vm.next = next;
  vm.totalPrecio = totalPrecio;
  vm.totPag = 0;

  vm.changed = false;
  vm.pedidos = false;

  loadPedidos();

  function next(){
    vm.mode = 'pedido';
  }
  function loadPedidos(){
    service.pedidos().then(function(response){
      vm.pedidos = response.data;
    });
  }

  function editMesas(){
    vm.mode = 'mesa';
  }

  function mesasPedido(){
    if (!vm.pedido || !vm.pedido.mesa) { return '';}

    var selected = [];
    for(var i=0; i < vm.mesas.length; i++){
      if (vm.pedido.mesa.indexOf(vm.mesas[i].idMesa) > -1) {
        selected.push(vm.mesas[i].nombre);
      }
    }
    return selected.join();
  }

  function cancel(token){
    if (!token) {
      vm.alert = {
        show: true,
        token: '',
        mode: 'cancel'
      }
      return false;
    }

    service
      .cancel({id:vm.pedido.id, token:token})
      .then(function(response){
        alert('Pedido cancelado');
        goTolist();
      });
  }

  function cancelAuth(){
    vm.alert = {};
  }

  function sendAuth(){
    if (vm.alert.token) {
      var token = vm.alert.token;
      if (vm.alert.mode == 'save') {
        vm.save(token);

      }
      if (vm.alert.mode == 'cancel') {
        vm.cancel(token);
      }
      vm.alert = {};
    }
  }

  function loadPedido(pedido, mesa){
    if (vm.mode == 'mesa') {
      if (pedido && pedido.pedido != vm.pedido.id) {
        return false;
      }
      var index = vm.pedido.mesa.indexOf(mesa);
      if (index == -1) {
        vm.pedido.mesa.push(mesa);
      }else{
        vm.pedido.mesa.splice(index, 1);
      }
      vm.changed = true;
    }else{
      // if (!pedido || pedido.mozo != vm.mozo) {
      //   return false;
      // }
      service.pedido(pedido.pedido).then(function(response){
        vm.pedido = response.data;
        vm.mode = 'pedido';
        vm.changed = false;
      });
    }
  }

  function newOrder(){
    vm.mode = 'mesa';
    vm.pedido = {
      mesa:[],
      productos: []
    }
    vm.changed = false;
  }

  function addProducto(item){
    for (var i = 0; i < vm.pedido.productos.length; i++) {
      if (vm.pedido.productos[i].id == item.id) {
        return alert('El producto ya se encuentra en el pedido');
      }
    }

    vm.changed = true;
    vm.pedido.productos.push({
        id: item.id,
        name: item.name,
        price: item.price,
        dest: item.dest,
        cant: 1
      });
  }

  function quantity(item, q){
    item.cant = parseInt(item.cant);
    if (item.cant + q == 0) {
      if(confirm('¿Desea retirar el producto del pedido ?')){
        for (var i = 0; i < vm.pedido.productos.length; i++) {
          if (vm.pedido.productos[i].id == item.id) {
            vm.changed = true;
            vm.pedido.productos.splice(i,1);
            return false;
          }
        }
      };
    }else{
      item.cant = item.cant + q;
      vm.changed = true;
    }
  }

  function goTolist(){
    vm.mode = 'croquis';
    vm.pedido = {};
    loadPedidos();
  }

  function save(token){
    var data = angular.copy(vm.pedido);
    if (token){
      data.token = token;
    }
    service.save(data).then(function(response){
      if (response.data.id) {
        vm.pedido.id = response.data.id;
      }
      alert('Pedido registrado');
      vm.changed = false;
    }, function(response){
      if (response.data.error == '_NEED_AUTH') {
        vm.alert = {
          show: true,
          token: '',
          mode: 'save'
          };
      }
    });
  }

  function totalPrecio(){
    var t = 0;
    for (var i = 0; i < vm.pedido.productos.length; i++) {
      if (!vm.pedido.productos[i].out) {
        t += parseFloat(vm.pedido.productos[i].cant) * parseFloat(vm.pedido.productos[i].price);
      }
    }

    vm.totPag = t.toFixed(2);
  }
}

function service($http, $httpParamSerializer){
  $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
  return {
    pedidos: function(){
      return $http.get('<?php echo base_url(); ?>ccajero/pedidos');
    },
    pedido: function(id){
      var q = { q : JSON.stringify({id: id})};
      return $http.post('<?php echo base_url(); ?>cventa/detail', $httpParamSerializer(q));
    },
    save: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cventa/save', $httpParamSerializer(q));
    },
    cancel: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cventa/cancel', $httpParamSerializer(q));
    }
  }
}

</script>
<script type="text/javascript">
  // document.getElementById('mostrarFotoProd').style.display = 'none';
  function setImagen(obj){
    // alert(obj.src);    
    document.getElementById('fotoProducto').src = obj.src;
    modal.style.display = "block";
  }

  // Get the modal
  var modal = document.getElementById('modalFotoProd');

  // Get the button that opens the modal
  var btn = document.getElementById("btnOpenModalFoto");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  // btn.onclick = function() {
  //     modal.style.display = "block";
  // }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
</script>


    </body>
</html>
