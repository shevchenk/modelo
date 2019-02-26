<div class="modal" id="ModalNivel3" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Servicio</h4>
            </div>
            <div class="modal-body">
                <form id="ModalNivel3Form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sub Grupo:</label>
                                <input type="hidden" class="mant" id="txt_ps_nivel2_id" name="txt_ps_nivel2_id">
                                <input type="text" class="form-control" onblur="LimpiarNivelModal('txt_ps_nivel2_id,#txt_nivel2');" id="txt_nivel2" placeholder="Sub Grupo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_item" name="txt_item" placeholder="Item">
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Servicio:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_nivel3" name="txt_nivel3" placeholder="Servicio">
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripción del Servicio"></textarea>
                            </div>
                        </div> 
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Imagen:</label>
                                <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                                <input type="text" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                                <label class="btn btn-default btn-flat margin btn-xs">
                                    <i class="fa fa-file-image-o fa-5x"></i>
                                    <input type="file" style="display: none;" onchange="onImagen(event);" >
                                </label>

                            </div>  
                        </div> 
                        <div class="col-md-5">
                            <div class="form-group">
                                <img class="img-circle" style="height: 142px;width: 100%;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px"> 
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Estado:</label>
                                <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                    <option  value='0'>Inactivo</option>
                                    <option  value='1'>Activo</option>
                                </select>
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
