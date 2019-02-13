<div class="modal" id="ModalOpcion" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Opción</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalOpcionForm">
                        <div class="col-sm-12">
                            <label>Menu:</label>
                            <input type="hidden" class="mant" id="txt_menu_id" name="txt_menu_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_menu_id',this.value);" id="txt_menu" placeholder="Menu">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Opción:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_opcion" name="txt_opcion" placeholder="Opción" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ruta de la opción:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_ruta" name="txt_ruta" placeholder="Ruta de la opción" maxlength="100">
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
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
