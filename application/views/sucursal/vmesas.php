<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/angularjs/loading-bar.min.css">
<div ng-app="restobar.mesas" ng-controller="mainController as vm">
  
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label for="sucursal_id" class="col-sm-2 control-label">Sucursal</label>
            <div class="col-sm-8">
              <select class="form-control" name="sucursal_id" id="sucursal_id" ng-model="vm.currentSucursal" ng-options="s as s.nombre for s in vm.sucursales" ng-change="vm.loadSucursal()">
                <option value="">- seleccione -</option>
              </select>
            </div>
          </div>
        </div><!-- /.box-body -->
      </form>
    </div><!-- /.box -->
  </div>
  <div class="col-md-6"></div>
</div>
<div class="row" ng-if="vm.loadedSucursal">
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Mesas</h3>
      </div><!-- /.box-header -->
      <div class="box-body"  style="height:400px;overflow:scroll;">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width:6%;text-align:center;background:#999;color:white;">#</th>
            <th style="width:20%;text-align:center;background:#1c84c6;color:white;">Mesa</th>
            <th style="width:17%;text-align:center;background:#1c84c6;color:white;">Ancho</th>
            <th style="width:17%;text-align:center;background:#1c84c6;color:white;">Alto</th>
            <th style="width:17%;text-align:center;background:#23c6c8;color:white;">Pos x</th>
            <th style="width:17%;text-align:center;background:#23c6c8;color:white;">Pos y</th>
            <th style="width:6%;text-align:center;background:#1ab394 ;color:white;"><i class="fa fa-save"></i></th>
          </tr>          
        </thead>  
        <tbody>
          <tr ng-repeat="m in vm.mesas">
            <td style="text-align:center;background:#DDD;">{{$index + 1}}</td>
            <td><input class="form-control" style="padding:1px;text-align:center;color:#006699;" type="text" ng-model="m.nombre"/></td>
            <td><input class="form-control" style="padding:1px;" type="number" min="0" ng-model="m.ancho" /></td>
            <td><input class="form-control" style="padding:1px;" type="number" min="0" ng-model="m.alto" /></td>
            <td><input class="form-control" style="padding:1px;color:#31982A;" type="number" min="0" ng-model="m.x" /></td>
            <td><input class="form-control" style="padding:1px;color:#31982A;" type="number" min="0" ng-model="m.y" /></td>
            <td><button class="btn btn-primary btn-sm" ng-click="vm.updateMesa(m)"><i class="fa fa-save"></i></button></td>
          </tr>
        </tbody>
        <tfoot style="border-top: solid 2px #ccc">
          <tr>
            <td colspan="6"><input type="text" ng-model="vm.formData.nombre" class="form-control" placeholder="Nombre"></td>
            <td>
              <button class="btn btn-primary btn-block" ng-click="vm.addMesa()"><i class="fa fa-plus"></i></button>
            </td>
          </tr>
        </tfoot>
      </table>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="pull-right">
          <button class="btn btn-sm btn-primary" ngf-select ng-model="vm.file" name="file" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-change="vm.uploadCroquis($files)"><i class="fa fa-upload"></i> &nbsp;Subir croquis</button>
        </div>
        <h3 class="box-title">Croquis</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="wrap-croquis">
          <div ng-style="{transform: 'scale('+vm.scale / 100+')'}" style="transform-origin: top left;">
            <div class="croquis" ng-class="{'empty': !vm.currentSucursal || !vm.currentSucursal.croquis}">
              <img ng-src="{{'../' + vm.currentSucursal.croquis}}" alt="" ng-if="vm.currentSucursal && vm.currentSucursal.croquis">
              <div class="mesa" ng-repeat="m in vm.mesas" ng-style="{left: m.x + 'px', top: m.y + 'px', width: m.ancho + 'px', height: m.alto + 'px'}">
                <span class="label">{{m.nombre}}</span>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <label class="control-label col-sm-1">Scale</label>
          <div class="col-sm-3">
            <input type="number" min="10" max="150" step="10" class="form-control" ng-model="vm.scale">
          </div>
          <div class="col-sm-8"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
.wrap-croquis{
  max-height: 500px;
  overflow: auto;
}
.croquis{
  position: relative;
  background: #CCC;
  transform-origin: left top;
}
.croquis.empty{
  height: 800px;
  width: 800px;
}
.mesa{
  position: absolute;
  min-width: 10px;
  min-height: 10px;
  outline: dotted 3px white;
  border-radius: 3px;
  background: red;
}
.mesa .label{
  /*background: red;*/
  width: 100%;
  display: inline-block;
  font-size: 1.2em;
}
.mesa:hover{
  background: green;  
}
.mesa .label:hover{
  background: green;
}
</style>

<script src="<?php echo base_url(); ?>assets/plugins/angularjs/angular.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/angularjs/loading-bar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/angularjs/ng-file-upload.min.js"></script>
<script>
angular
  .module('restobar.mesas',['angular-loading-bar','ngFileUpload'])
  .config(config)
  .controller('mainController',mainController)
  .factory('service',service)
  .filter('num', function() {
      return function(input) {
        return parseInt(input, 10);
      };
  });
function config($httpProvider)
{
    $httpProvider.interceptors.push(function($q) {
      return {
        responseError: function(response) {
            var data = response.data || {};
            if (data.error) {
              alert(data.error);
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

  vm.sucursales = <?php echo json_encode($listSucursal);?>;
  vm.loadedSucursal = false;
  vm.formData = {};
  vm.scale = 100;

  vm.loadSucursal = loadSucursal;
  vm.addMesa = addMesa;
  vm.updateMesa = updateMesa;
  vm.uploadCroquis = uploadCroquis;

  function uploadCroquis($files){
    if ($files.length) {
      service.uploadCroquis({
        file: $files[0]
      }, vm.currentSucursal.idSucursal).then(function(response){
        for(var i = 0; i < vm.sucursales.length; i++){
          if (vm.sucursales[i].idSucursal == response.data.idSucursal) {
            vm.sucursales[i].croquis = response.data.croquis;
            break;
          }
        }
      });
    }
  }

  function addMesa(){
    if (!vm.formData.nombre) {
      return alert('Ingrese un nombre');
    }

    vm.formData.idSucursal = vm.currentSucursal.idSucursal;
    service
      .addMesa(vm.formData)
      .then(function(response){
        vm.formData = {};
        vm.mesas.push(parseItem(response.data));
      });
  }

  function updateMesa(m){
    service.updateMesa(m)
      .then(function(response){
        for(var i = 0; i < vm.mesas.length; i++)
        {
          if (vm.mesas[i].idMesa == response.data.idMesa) {
            vm.mesas[i] = parseItem(response.data);
            break;
          }
        }
      });
  }

  function loadSucursal(){
    vm.loadedSucursal = false;
    if (vm.currentSucursal) {
      service.getMesas(vm.currentSucursal.idSucursal)
        .then(function(response){
          vm.mesas = response.data;
          vm.mesas = parseData(vm.mesas);
          vm.loadedSucursal = true;
        })
    }
  }

  function parseData(data){
    for(var i = 0; i < data.length; i++){
      data[i] = parseItem(data[i]);
    }
    return data;
  }

  function parseItem(item){
    item.ancho = parseInt(item.ancho, 10);
    item.alto = parseInt(item.alto, 10);
    item.x = parseInt(item.x, 10);
    item.y = parseInt(item.y, 10);
    return item;
  }
}

function service($http, $httpParamSerializer, Upload){
  $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
  return {
    getMesas: function(idSucursal){
      return $http.get('<?php echo base_url(); ?>csucursal/getmesas/' + idSucursal);
    },
    addMesa: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>csucursal/addMesa', $httpParamSerializer(q));
    },
    updateMesa: function(data){
      var q = { q : JSON.stringify(data)};
      return $http.post('<?php echo base_url(); ?>csucursal/updateMesa', $httpParamSerializer(q));
    }, 
    uploadCroquis: function(data, idSucursal){
      return Upload.upload({
        'url': '<?php echo base_url(); ?>csucursal/uploadCroquis/' + idSucursal,
        data: data
      });
    }
  }
}
</script>