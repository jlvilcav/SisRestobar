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
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/angularjs/loading-bar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/columns.css">
    <!-- tabs -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/tabs_rb.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/is.ico" type="image/ico" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE_lk.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins-lk.css"> -->

  </head>
<body class="hold-transition" ng-controller="mainController as vm">

<header>
  <div id="topbar" style="background-color: #085981;">
    <!--
    <div class="pull-right">
      <button class="btn btn-default" ng-show="vm.mode=='list'" ng-click="vm.newOrder()">Nueva orden</button>
      <button class="btn btn-default" ng-show="vm.mode=='pedido'" ng-click="vm.goTolist()">Volver</button>
    </div>
    -->
    <a href="<?php echo base_url(); ?>cusuario/profileOfUser" class="btn btn-default btn-flat"><span class="logo-lg"><b>Sist</b>Restobar</span></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <label style="font-size: 12pt;"><?php echo "<label style='color:#888;'>Usuario :</label> ".$this->session->userdata('s_usu')." - ".$this->session->userdata('s_nomSucursal');?></label>
    <div class="pull-right">
      <button type="button" class="btn btn-sm btn-default" ng-click="vm.loadPedidos()" ng-show="vm.mode == 'croquis'"><i class="fa fa-repeat"></i>&nbsp; Actualizar</button>
      <button type="button" class="btn btn-sm btn-default" ng-click="vm.go('croquis')" ng-show="['details', 'delivery'].indexOf(vm.mode) > -1 "><i class="fa fa-arrow-left"></i>&nbsp; Volver</button>
      <a href="<?php echo base_url(); ?>clogin/logout" class="btn btn-sm btn-danger"><i class="fa fa-power-off"></i>&nbsp; Salir</a>
    </div>

    <!-- hidden -->
    <input type="hidden" name="hdnIdCaja" id="hdnIdCaja" value="<?php echo $this->session->userdata('s_usu'); ?>">
    <div class="clearfix"></div>
  </div>
</header>

<section id="croquis" class="withPanel" ng-if="vm.mode == 'croquis'" style="width: 100%;">
  <!-- <div class="control">
      <span>Scale</span>
      <input type="number" min="10" max="200" step="10" class="form-control" ng-model="vm.scale">
  </div> -->
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
      <div class="mesa" ng-repeat="m in vm.mesas" ng-style="{left: m.x + 'px', top: m.y + 'px', width: m.ancho + 'px', height: m.alto + 'px'}" ng-class="{'busy': vm.pedidos[m.idMesa]}" ng-click="vm.loadPedido(vm.pedidos[m.idMesa])">
        <span class="label">{{m.nombre}}</span>
      </div>
    </div>
  </div>
</section>
<section id="deliveryPanel" ng-if="vm.mode == 'croquis'" style="border-left: 1px solid #CCC; padding: 20px; display: none;">
  <h3><i class="fa fa-car"></i> &nbsp;DELIVERY 
    <button class="btn btn-sm btn-success pull-right" ng-click="vm.go('delivery')"><i class="fa fa-plus"></i> &nbsp; Nuevo</button>
  </h3>
  <hr style="border-color: #CCC;">
  <ul id="deliveryList" ng-if="vm.deliverys">
    <li ng-repeat="dl in vm.deliverys" style="border-color: #eee; padding: 10px;">
      <div style="color:#085981; font-weight: bold;">D-{{dl.id}}: </div><div style="color:#444; font-weight: bold;"> {{dl.descripcion}}</div><br>
      <div style="text-align: right;">
        <button class="btn btn-sm btn-default" ng-click="vm.editDelivery(dl.id)"><i class="fa fa-edit"></i> Editar</button> 
        <button class="btn btn-sm btn-default" ng-click="vm.loadPedido({pedido: dl.id})"><i class="fa fa-dollar"></i> Pagar</button>
      </div>
    </li>
  </ul>
</section>
<section id="details" ng-if="vm.mode == 'details'">
    <div id="resumen" class="box">
        <div class="box__header header">
            <h3><i style="color: #CCC;" class="fa fa-tasks"></i> &nbsp;<b>DETALLE ::</b></h3>
        </div>
        <div class="box__content" style="padding: 15px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>:: PRODUCTOS</th>
                        <th>:: CANTIDAD</th>
                        <th>:: COSTO</th>
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="pr in vm.pedido.productos" ng-class="{'not-in': pr.out}">
                        <td style="font-size: 1.5em;">{{pr.name}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button ng-show="vm.pedido.esDelivery != 1" type="button" class="btn btn-primary" ng-click="vm.quantity(pr, -1)"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-default quantity">{{pr.cant}}</button>
                                <button ng-show="vm.pedido.esDelivery != 1" type="button" class="btn btn-primary" ng-click="vm.quantity(pr, 1)"><i class="fa fa-plus"></i></button>
                            </div>
                        </td>
                        <td style="font-size: 1.5em;">{{pr.price}}</td>
                        <td>
                            <button ng-show="vm.pedido.esDelivery != 1" class="btn btn-xs" ng-class="{'btn-success': !pr.out,'btn-danger': pr.out}" ng-click="vm.toggleProduct(pr)">
                                <i class="fa fa-check" ng-if="!pr.out"></i>
                                <i class="fa fa-close" ng-if="pr.out"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  <div id="payment" class="box">
    <div class="box__header header">
      <h3><i style="color: #CCC;" class="fa fa-credit-card"></i> &nbsp;<b>PAGO ::</b></h3>
      <div class="pull-right">
        <span class="total-price">{{vm.total() | currency : vm.simbolomoneda + ' '}}</span>
      </div>
    </div>
    <div class="box__content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="" class="control-label">Nº de ventas</label>
              <input type="text" class="form-control" id="nroVenta" name="nroVenta" ng-model="vm.nro" disabled="disabled">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label class="control-label" style="color: #085981;"><i class="fa fa-user"></i> &nbsp;Cliente</label>
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" readonly="readonly" ng-model="vm.data.cliente">
                <input type="hidden" class="form-control" ng-model="vm.data.dircl">
                <input type="hidden" class="form-control" ng-model="vm.data.telcl">
                <input type="hidden" class="form-control" ng-model="vm.data.celcl">
                <input type="hidden" class="form-control" ng-model="vm.data.nommozo">

                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" ng-click="vm.searchClient()"><i class="fa fa-fw fa-external-link-square"></i></button>
                </span>
              </div><!-- /input-group -->
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label class="control-label col-xs-6 col-md-6" style="color: #085981;"><i class="fa fa-folder"></i> &nbsp;Tipo Recibo</label>
              <label class="control-label col-xs-6 col-md-6" style="color: #085981;"><i class="fa fa-folder"></i> &nbsp;N° Recibo</label>
              <div class="col-xs-6 col-md-6">
                <select class="form-control col-sm-3" ng-model="vm.data.reciboId" ng-options="r.idTipoRecibo as r.descripcion for r in vm.recibos"></select>
              </div>
              <div class="col-xs-6 col-md-6">
                <input type="text" class="form-control" id="numRecibo" name="numRecibo" ng-model="vm.data.numRecibo" placeholder="000-0000-0">
              </div>
            </div>
          </div>
        </div>
        <hr style="border-top-color: #fff;">
        <div class="row">
          <label class="col-xs-6 col-md-4 control-label" style="color: #888;"><i class="fa fa-check"></i>&nbsp;EFECTIVO</label> 
          <div class="col-xs-6 col-md-8">
            <input type="text" class="form-control" id="efectivo" name="efectivo" placeholder="0.00" ng-model="vm.data.efectivo">
          </div>
        </div>
        <div class="row">
          <label class="col-xs-6 col-md-4 control-label" style="color: #888;"><i class="fa fa-check"></i>&nbsp;VISA</label>
          <div class="col-xs-6 col-md-8">
            <input type="text" class="form-control" id="visa" name="visa" placeholder="0.00" ng-model="vm.data.visa">
          </div>
        </div>
        <div class="row">
          <label class="col-xs-6 col-md-4 control-label" style="color: #888;"><i class="fa fa-check"></i>&nbsp;MASTERCARD</label>
          <div class="col-xs-6 col-md-8">
            <input type="text" class="form-control" id="mastercard" name="mastercard" placeholder="0.00" ng-model="vm.data.mastercard">
          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-xs-6 col-md-4 control-label" style="color: #085981;"><i class="fa fa-flash"></i> &nbsp;DESCUENTO</label>
          <div class="col-xs-6 col-md-3">
            <input type="text" class="form-control" id="dsct" name="dsct" placeholder="0.00" ng-model="vm.data.dsct">
          </div>
          <label class="col-xs-6 col-md-2 control-label" style="color: #085981;">PROPINA</label>
          <div class="col-xs-6 col-md-3">
            <input type="text" class="form-control" id="propina" name="propina" placeholder="0.00" ng-model="vm.data.propina">
          </div>
        </div>
        <hr>
        <div class="row">
          <label class="col-xs-4 control-label" style="color: #085981;"><i class="fa fa-undo"></i> &nbsp;VUELTO</label>
          <div class="col-xs-8">
            <input type="text" class="form-control" id="vuelto" name="vuelto" placeholder="0.00" disabled="disabled" value="{{vm.vuelto() | currency : '' }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Delivery-->
<section id="delivery" ng-if="vm.mode == 'delivery'">
    <div id="ClientPanel" class="box">
        <div class="box__header header" style="width: 100%;">
            <h3><i style="color: #CCC;" class="fa fa-reorder"></i> &nbsp;<b>Datos Cliente ::</b></h3>      
        </div> 
        <div class="box__content container-fluid" style="width: 210px;">
          
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <input type="text" ng-model="vm.pedido.descripcion" ng-change="vm.changed = true" placeholder="Cliente" class="form-control" />
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" ng-click="vm.searchClientDelivery()"><i class="fa fa-fw fa-external-link-square"></i></button>
                    </span>
                </div><!-- /input-group -->
            </div>
            <!-- <input type="text" ng-model="vm.pedido.descripcion" ng-change="vm.changed = true" placeholder="Descripción" class="form-control" /> -->
            <textarea class="form-control" ng-model="vm.pedido.indicaciones" ng-change="vm.changed = true" placeholder="Detalles del cliente" style="height: 300px;"></textarea>
        </div>
    </div>
    <div id="carta" class="box withClientPanel">
        <div class="box__header header">
            <div class="box-tools pull-right">
                <label>Categ.</label>
                <select class="form-control form-control-inline" ng-model="vm.currentCategory" ng-options="c.idCategoriaProducto as c.descripcion for c in vm.categories | orderBy:'descripcion'">
                    <option value="">:: TODOS ::</option>
                </select> &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Producto</label>
                <input type="text" ng-model="vm.search" class="form-control form-control-inline" placeholder="Buscar..." />

                <!-- <input type="text" class="form-control" ng-model="vm.currentCategory" ng-options="c.idCategoriaProducto as c.descripcion for c in vm.categories | orderBy:'descripcion'"> -->
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
<footer style="background-color: #085981;">
    <span ng-if="!vm.pedido.esDelivery" class="mesas">Mesas: {{vm.mesasPedido()}} </span>
    <button class="btn btn-default" ng-show="vm.mode == 'details'" ng-click="vm.litokurt()" ng-disabled="!vm.data.pedidoId"><i class="fa fa-cc-discover"></i> &nbsp; Cuenta</button>
    <button class="btn btn-default" ng-show="vm.mode == 'details'" ng-click="vm.pay()" ng-disabled="!vm.data.pedidoId"><i class="fa fa-dollar"></i> &nbsp; Pagar</button>
    <button class="btn btn-danger" ng-show="vm.mode == 'details'" ng-click="vm.cancelVenta()" ng-disabled="!vm.data.pedidoId"><i class="fa fa-close"></i> &nbsp; Cancelar</button>
    <button class="btn btn-default" ng-show="vm.mode == 'delivery'" ng-disabled="!vm.changed" ng-click="vm.save()"><i class="fa fa-save"></i> &nbsp; Guardar</button>
    <button class="btn btn-danger" ng-show="vm.mode == 'delivery' && vm.pedido.id" ng-click="vm.cancel()"><i class="fa fa-trash"></i> &nbsp; Eliminar orden</button>
</footer>

<div class="modal" ng-class="{'show':vm.client.show}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #085981;">
        <button type="button" class="close" ng-click="vm.cancelClient()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color: white;"><i class="fa fa-search"></i> Búsqueda de cliente</h4>
      </div>
      <div class="modal-body">

         <!--Contenedor-->
          <div id="container_tb">
            <!--Pestaña 1 activa por defecto-->
              <input id="tab-1" class="rdTab" type="radio" name="tab-group" checked="checked" />
              <label for="tab-1" class="textTab"><i class="fa fa-search"></i> Buscar cliente</label>

              <!--Pestaña 3 inactiva por defecto-->
              <input id="tab-2" class="rdTab" type="radio" name="tab-group" />
              <label for="tab-2" class="textTab"><i class="fa fa-save"></i> Nuevo cliente</label>
              <!--Contenido a mostrar/ocultar-->
              <div id="content" style="overflow-y: scroll;">
                <!--Contenido de la Pestaña 1-->
                <div id="content-1" class="tabContiene">
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-2">
                            <label class="label-control">DNI</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.dni" placeholder="Ingrese DNI">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Nombre</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.nombre" placeholder="Escriba nombre">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Ape. Paterno</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.apPaterno" placeholder="Ap. paterno">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Ape. Materno</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.apMaterno" placeholder="Ap. Materno">
                          </div>
                          <div class="col-sm-1">
                            <label class="label-control"></label>
                            <button type="button" class="btn btn-primary" ng-click="vm.queryClient()"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </div>
                  <hr>
                  <table class="table" id="tblListaClientes">
                    <thead>
                        <tr>
                            <th style="background-color: #1ab394; color: white; text-align: center;">DNI</th>
                            <th style="background-color: #1ab394; color: white; text-align: center;">Cliente</th>
                            <th style="background-color: #1ab394; color: white; text-align: center;">Dirección</th>
                            <th style="background-color: #1ab394; color: white; text-align: center;">Telefonos</th>
                            <th style="background-color: #1ab394; color: white; text-align: center;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            <tr ng-repeat="cl in vm.client.result">
                                <td style="padding-left: 15px; color: #006699; text-align: center; width: 10%;">{{cl.dni}}</td>
                                <td style="padding-left: 15px; width: 20%;">{{cl.nombre}}, {{cl.apPaterno}} {{cl.apMaterno}}</td>
                                <td style="padding-left: 15px; width: 30%;">{{cl.direccion}}</td>
                                <td style="padding-left: 15px; width: 20%;"><label>Telf.: </label> {{cl.telefono}}<br> <label>Cel.: </label> {{cl.celular}}</td>
                                <td style="padding-left: 15px; text-align: center;width: 10%;">
                                    <button class="btn btn-primary btn-xs" ng-click="vm.selectClient(cl)">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </tbody>
                  </table>
                <br>                  
                </div>
                <!-- Nuevo Cliente -->
                <div id="content-2" class="tabContiene" style="width: 80%;">
                  <div class="container-fluid" style="width: 80%;">
                    <form class="form-horizontal">
                        <!-- <div class="col-sm-12"> -->
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">DNI</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Digite el DNI" ng-model="vm.client.data.ndni">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Escriba el nombre" ng-model="vm.client.data.nnombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Ape. Paterno</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Escriba su apellido paterno" ng-model="vm.client.data.napPaterno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Ape. Materno</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Escriba su apellido materno" ng-model="vm.client.data.napMaterno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Ingrese su dirección" ng-model="vm.client.data.ndireccion" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Telefono</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Su telefono" ng-model="vm.client.data.ntelefono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtInsumo" class="col-sm-3 control-label">Celular</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Su número celular" ng-model="vm.client.data.ncelular">
                                </div>
                            </div>
                          <!-- <div class="col-sm-2">
                            <label class="label-control">DNI</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.ndni">
                          </div> 
                          <div class="col-sm-3">
                            <label class="label-control">Nombre</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.nnombre">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Ape. Paterno</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.napPaterno">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Ape. Materno</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.napMaterno">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Dirección</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.ndireccion">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Telefono</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.ntelefono">
                          </div>
                          <div class="col-sm-3">
                            <label class="label-control">Celular</label>
                            <input type="text" class="form-control" ng-model="vm.client.data.ncelular">
                          </div>-->
                          <div class="col-sm-1">
                            <label class="label-control"></label>
                            <button type="button" class="btn btn-primary" ng-click="vm.newClient()"><i class="fa fa-save"></i> &nbsp; Guardar</button>
                          </div>
                        <!-- </div>   -->
                    </form>
                    
                  </div>
                </div>
              </div>
          </div>

        
      </div>
    </div>
  </div>
</div>

<div class="overlay" ng-show="vm.alert.show">
  <div id="adminToken" class="show">
    <label for="" class="label-control">Se requiere autorización</label>
    <input type="password" class="form-control" ng-model="vm.alert.token" autofocus="true">
    <button class="btn btn-primary" ng-click="vm.sendAuth()">Acceder</button>
    <button class="btn btn-danger" ng-click="vm.cancelAuth()">Cancelar</button>
  </div>
</div>


<div class="overlay" ng-show="vm.client.show"></div>
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
            // alert(data.error || 'Ocurrió un error');
            // return $q.reject(response);
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

  vm.mesas   = <?php echo json_encode($mesas);?>;
  vm.croquis = '<?php echo $croquis;?>';
  vm.mode = 'croquis';
  vm.scale = 150;
  vm.alert = {};
  var pedidoDefault = vm.pedido = {
    productos:[]
  }
  vm.recibos = <?php echo json_encode($recibos);?>;
  var dataDefault = {
    cliente : '[GENERAL]',
    clienteId : 1,
    reciboId : vm.recibos[0].idTipoRecibo,
    numRecibo: '',
    efectivo: 0,
    visa: 0,
    mastercard: 0,
    dsct: 0,
    propina: 0
  };
  vm.cliente = {
    show: false,
    result: []
  }
  vm.sucursal = <?php echo $idSucursal;?>;

  vm.loadPedido = loadPedido;
  vm.quantity = quantity;
  vm.searchClient = searchClient;
  vm.searchClientDelivery = searchClientDelivery;
  vm.cancelClient = cancelClient;
  vm.pay = pay;
  vm.save = save;
  vm.total = total;
  vm.loadPedidos = loadPedidos;
  vm.totalPrecio = totalPrecio;
  vm.vuelto = vuelto;
  vm.data = angular.copy(dataDefault);
  vm.queryClient = queryClient;
  vm.newClient = newClient;
  vm.selectClient = selectClient;
  vm.cancelVenta = cancelVenta;
  vm.cancel = cancel;
  vm.mesasPedido = mesasPedido;
  vm.go = go;
  vm.quantity = quantity;
  vm.litokurt = litokurt;
  vm.editDelivery = editDelivery;
  vm.toggleProduct = toggleProduct;

  vm.addProducto = addProducto;

  vm.sendAuth = sendAuth;
  vm.cancelAuth = cancelAuth;
  vm.cancel = cancel;

  loadPedidos();

  function toggleProduct(pr) {
    pr.out = !pr.out;
    estimateTip();
  }

  function go(mode){
    vm.mode = mode;
    if (mode == 'delivery') {
      vm.pedido = angular.copy(pedidoDefault)
      vm.pedido.esDelivery = 1
    }
  }

  function editDelivery(id) {
    service
      .pedido(id)
      .then(function(res){
        vm.pedido = res.data;
        vm.mode = 'delivery';
      })
  }

  /******************************************************/
  function cancel(token){//alert('cancel');
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

  function goTolist(){
    vm.mode = 'croquis';
    vm.pedido = {};
    loadPedidos();
  }
  /******************************************************/

  function quantity(item, q){
    console.log('siiiiiiiiiiiiiiiiiiiiii que rarooooooo');
    item.cant = parseInt(item.cant);
    if (item.cant + q > 0 && item.cant + q <= item.req) {
      item.cant = item.cant + q;
    }
  }

  function loadPedidos(){
    vm.pedido = angular.copy(pedidoDefault);
    service.pedidos().then(function(response){
      vm.pedidos = response.data;
    });
    service.deliverys().then(function(response){
      vm.deliverys = response.data;
    });
  }

  function queryClient(){
    if (!vm.client.data.dni && !vm.client.data.nombre && !vm.client.data.apPaterno) {
      return alert('Ingrese un criterio de búsqueda');
    }

    service
      .cliente(vm.client.data)
      .then(function(response){
        vm.client.result = response.data;
      });
  }

  function newClient(){
    if (!vm.client.data.ndni) {
      vm.client.data.ndni = '';
      //alert('Ingrese DNI');
      // return false;
    }

    if (!vm.client.data.nnombre) {
      alert('Ingrese Nombre');
      return false;
    }

    if (!vm.client.data.napPaterno) {
      vm.client.data.napPaterno = '';
      // return false;
    }

    if (!vm.client.data.napMaterno) {
      vm.client.data.napMaterno = '';
      // return false;
    }

    if (!vm.client.data.ntelefono) {
      vm.client.data.ntelefono = '';
      // return false;
    }

    if (!vm.client.data.ncelular) {
      alert('Ingrese Celular');
      return false;
    }

    if (!vm.client.data.ndireccion) {
      alert('Ingrese Dirección');
      return false;
    }

    service
      .saveCliente(vm.client.data)
      .then(function(response){
        vm.data.clienteId = response.data;//retorna id persona
        vm.pedido.clienteId = response.data;

        if (vm.client.data.napMaterno == null) {
          vm.client.data.napMaterno = '';
        }

        if (vm.openModalSearchCl == 1) {
          vm.data.cliente = vm.client.data.nnombre + ' ' + (vm.client.data.napPaterno || '') + ' ' + (vm.client.data.napMaterno || '');
        }
        if (vm.openModalSearchCl == 2) {
          vm.pedido.descripcion = vm.client.data.nnombre + ' ' + (vm.client.data.napPaterno || '') + ' ' + (vm.client.data.napMaterno || '');
          vm.pedido.indicaciones = vm.client.data.ndireccion + '\n' + vm.client.data.ntelefono + '\n' + vm.client.data.ncelular;
        }

        vm.client = {
          show: false,
          data: {}
        };
      });
  }

  function searchClient(){
    vm.openModalSearchCl = 1;
    vm.client = {
      show: true,
      data: {}
    }
  }

  function searchClientDelivery(){
    vm.openModalSearchCl = 2;
    vm.client = {
      show: true,
      data: {}
    }
  }

  function selectClient(cl){
    console.log(vm.openModalSearchCl);
    vm.data.clienteId = cl.idPersona;
    vm.pedido.clienteId = cl.idPersona;
    if (vm.openModalSearchCl == 1) {
      vm.data.cliente = cl.nombre + ' ' + (cl.apPaterno || '') + ' ' + (cl.apMaterno || '');
    }
    if (vm.openModalSearchCl == 2) {
      vm.pedido.descripcion = cl.nombre + ' ' + (cl.apPaterno || '') + ' ' + (cl.apMaterno || '');
      vm.pedido.indicaciones = 'Dir.: ' + cl.direccion + '\n' + 'Telf.: ' + cl.telefono + '\n' + 'Cel.: ' + cl.celular;
    }
    vm.client = {
      show: false,
      data: {}
    };
  }

  function cancelClient(){
    vm.client = {
      show: false
    }
  }

  function cancelVenta(){
    vm.data = angular.copy(dataDefault);
    vm.pedido = angular.copy(pedidoDefault);
  }

  // function cancel(id){
  //   if (!confirm('¿Seguro de eliminar el pedido?')) {
  //     return false;
  //   }

  //   service
  //     .cancel({id:vm.pedido.id})
  //     .then(function(response){
  //       alert('Pedido cancelado');
  //       vm.mode = 'croquis'
  //       loadPedidos()
  //     });
  // }

  function loadPedido(data){
    if (!data) {
      return false;
    }
    vm.data= angular.copy(dataDefault);
    service.pedido(data.pedido).then(function(response){
      vm.mode = 'details';
      vm.pedido = response.data;
      vm.pedido.productos = parse(vm.pedido.productos);
      vm.data.pedidoId = response.data.id;
      vm.data.cliente = response.data.cliente;
      vm.data.clienteId = response.data.idCliente;
      vm.data.dircl = response.data.direccion;
      vm.data.telcl = response.data.telefono;
      vm.data.celcl = response.data.celular;
      vm.data.nommozo = response.data.mozo;
      estimateTip()

      nro();
    });
    // console.log(vm.data.clienteId);
  }

  function pay(){
    if (total() <= 0) {
      return alert('Seleccione productos a pagar');
    }
    vm.data.total = total();
    vm.data.productos = [];
    for (var i = 0; i < vm.pedido.productos.length; i++) {
      if (!vm.pedido.productos[i].out) {
        vm.data.productos.push({
          id: vm.pedido.productos[i].id,
          cant: vm.pedido.productos[i].cant
        })
      }
    }
    
    console.log('idcliente: ' + vm.data.clienteId);
    service.pay(vm.data).then(function(response){
      loadPedidos();
      alert('Pedido pagado');
      cancelVenta();
      if (response.data.new) {
        loadPedido({'pedido':response.data.new.id});
      }else{
        go('croquis');
      }
    });
  }

  function vuelto(){
    if (!vm.data.efectivo) {
      return 0;
    }

    var v = parseFloat(vm.data.efectivo || 0) - (total() - parseFloat(vm.data.visa || 0) - parseFloat(vm.data.mastercard || 0));
    return v.toFixed(2);
  }

  function total(){
    var t = 0;
    for (var i = 0; i < vm.pedido.productos.length; i++) {
      if (!vm.pedido.productos[i].out) {
        t += parseFloat(vm.pedido.productos[i].cant) * parseFloat(vm.pedido.productos[i].price);
        //vm.data.propina = (Math.round((t || 0) * 0.1 * 100)/100).toFixed(2);
      }
    }
    t = t * (1 - parseFloat(vm.data.dsct || 0) / 100) + parseFloat(vm.data.propina || 0);
    return t.toFixed(2);
  }

  // function totalSinPropina(){
  //   var t = 0;
  //   for (var i = 0; i < vm.pedido.productos.length; i++) {
  //     if (!vm.pedido.productos[i].out) {
  //       t += parseFloat(vm.pedido.productos[i].cant) * parseFloat(vm.pedido.productos[i].price);
  //     }
  //   }
  //   t = t * (1 - parseFloat(vm.data.dsct || 0) / 100);// + parseFloat(vm.data.propina || 0);
  //   return t.toFixed(2);
  // }

  function nro(){
    service.nro().then(function(response){
      vm.nro = response.data.nro;
    });
  }

  function parse(data){
    for(var i = 0; i < data.length; i++){
      data[i] = parseItem(data[i]);
    }
    return data;
  }

  function parseItem(item){
    item.cant = +item.cant;
    return item;
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

  //litokurt - imprime la cuenta
  function litokurt(){

    if (total() <= 0) {
      return alert('Seleccione productos para la cuenta');
    }
    vm.data.total = total();
    vm.data.productos = [];
    for (var i = 0; i < vm.pedido.productos.length; i++) {
      if (!vm.pedido.productos[i].out) {
        vm.data.productos.push({
          id: vm.pedido.productos[i].id,
          nrodeventag: vm.nro,
          name: vm.pedido.productos[i].name,
          cant: vm.pedido.productos[i].cant,
          price: vm.pedido.productos[i].price,
          mesa: vm.mesasPedido(),
          propina: vm.data.propina,
          nommozo: vm.data.nommozo,
        })
      }
    }

    service.litokurt(vm.data).then(function(response){ //aqui pasa todo el vm.data
      for (var i = 0; i < vm.pedidos.length; i++) {
        if (vm.pedidos[i].id == response.data.id) {
          vm.pedidos.splice(i,1);
          break;
        }
      }
      
    });
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
    // console.log('este es el original :/ ');
    item.cant = parseInt(item.cant);
    if (item.cant + q == 0) {
      if(confirm('¿Desea retirar el producto del pedido ?')){
        for (var i = 0; i < vm.pedido.productos.length; i++) {
          if (vm.pedido.productos[i].id == item.id) {
            vm.changed = true;
            vm.pedido.productos.splice(i,1);
            break;
          }
        }
      };
    }else{
      item.cant = item.cant + q;
      vm.changed = true;
    }
    estimateTip();
  }

  function estimateTip(){
    var porcProp = <?php echo $this->session->userdata('its_rb_s_propinaporcentaje');?>;
    vm.data.propina = (Math.round((total() - (vm.data.propina || 0)) * parseFloat(porcProp))/100).toFixed(2);
  }

    function save(token){
        vm.changed = false;
    
        if (!vm.pedido.descripcion) {
          return alert('Ingrese la descripción')
        }

        if (!vm.pedido.indicaciones) {
          return alert('Ingrese las indicaciones')
        }
        

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
    deliverys: function(){
      return $http.get('<?php echo base_url(); ?>ccajero/deliverys');
    },
    pedido: function(id){
      var q = { q : JSON.stringify({id: id})};
      return $http.post('<?php echo base_url(); ?>cventa/detail', $httpParamSerializer(q));
    },
    pay: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cventa/pay', $httpParamSerializer(q));
    },
    litokurt: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cventa/litokurt', $httpParamSerializer(q));
    },
    cliente: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cpersona/buscar', $httpParamSerializer(q));
    },
    saveCliente: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cpersona/saveCliente', $httpParamSerializer(q));
    },
    nro: function(){
      return $http.get('<?php echo base_url(); ?>cventa/nro');
    },
    save: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>cventa/save', $httpParamSerializer(q));
    },
    cancel: function(data){
      var q = { q : JSON.stringify(data)};
      console.log(q);
      return $http.post('<?php echo base_url(); ?>cventa/cancel', $httpParamSerializer(q));
    }
  }
}
</script>

    </body>
</html>