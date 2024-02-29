<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Registro de Egresos</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">
        <div class="form-group">
        <div class="col-sm-6">
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Caja</label>
            <div class="col-sm-9">  
              <select class="form-control">
                <option>Caja 01</option>
                <option>Caja 02</option>
              </select>
              </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtObservacion">Monto</label>
            <div class="col-sm-9"> 
              <input type="text" name="txtNombres" class="form-control" id="txtNombres" placeholder="0.00">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtObservacion">Motivo</label>
            <div class="col-sm-9"> 
              <textarea type="text" name="txtNombres" class="form-control" id="txtNombres" placeholder="Motivo del egreso"></textarea>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:3px;">
            <label for="txtNomSucursal" class="col-sm-3 control-label">Empleado</label>
            <div class="col-sm-9">
              <div class="input-group input-group-sm">
                <div class="form-group" style="margin-bottom:3px;">
                  <div class="col-sm-12"> 
                    <div class="input-group input-group-sm">
                        <input type="text" name="txtDNI" class="form-control">                      
                      <span class="input-group-btn">
                          <button class="btn btn-info btn-flat" type="button"><i class="fa fa-fw fa-search"></i></button>
                      </span>
                    </div>
                  </div>
                </div>
              </div><!-- /input-group -->            
            </div>
          </div>

          <div class="form-group" style="margin-bottom:3px;">
            <label for="txtNomSucursal" class="col-sm-3 control-label">Incidencia</label>
            <div class="col-sm-9">
              <div class="input-group input-group-sm">
                <div class="form-group" style="margin-bottom:3px;">
                  <div class="col-sm-12"> 
                    <div class="input-group input-group-sm">
                        <textarea type="text" name="txtDNI" class="form-control"></textarea>
                      <span class="input-group-btn">
                          <button class="btn btn-info btn-flat" type="button"><i class="fa fa-fw fa-search"></i></button>
                      </span>
                    </div>
                  </div>
                </div>
              </div><!-- /input-group -->            
            </div>
          </div>
          
        </div>

        
        </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
    </div><!-- /.box -->
  </div>
</div>
