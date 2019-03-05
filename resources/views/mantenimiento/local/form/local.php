<div class="modal" id="ModalLocal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header btn-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Local</h4>
        </div>
        <div class="modal-body">
          <form id="ModalLocalForm">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Responsable:</label>
                <input type="hidden" class="mant" id="txt_empleado_id" name="txt_empleado_id">
                <div id="txt_empleado_ico" class="has-error has-feedback">
                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_empleado_id,#txt_dni',this.value);" id="txt_empleado" placeholder="Empleado">
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
              </div>
              <div class="col-sm-4">
                <label>DNI::</label>
                <input type="text" class="form-control" id="txt_dni" disabled>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <label>Local:</label>
                <input type="text" class="form-control" id="txt_local" name="txt_local" placeholder="Local">
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Código:</label>
                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Código">
              </div>
              <div class="col-md-4">
                <label>Serie:</label>
                <input type="text" class="form-control" id="txt_serie" name="txt_serie" placeholder="Serie">
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <label>Dirección:</label>
                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Dirección">
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-sm-6">
                <label>Telefono:</label>
                <textarea cols="3" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Teléfono"></textarea>
              </div>
              <div class="col-sm-6">
                <label>Celular:</label>
                <textarea cols="3" class="form-control" id="txt_celular" name="txt_celular" placeholder="Celular"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-sm-6">
                <label>Email:</label>
                <input type="text" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
              </div>
              <div class="col-sm-6">
                <label>Estado:</label>
                  <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                    <option value='0'>Inactivo</option>
                    <option value='1' selected>Activo</option>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-8">
                <label>Imagen:</label>
                <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                <input type="text" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                <label class="btn btn-default btn-flat margin btn-xs">
                    <i class="fa fa-file-image-o fa-lg"></i>
                    <input type="file" style="display: none;" onchange="onImagen(event);" >
                </label>
              </div>
              <div class="col-md-4">
                <img class="img-circle" style="height: 142px;width: 100%;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px">
              </div>
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
