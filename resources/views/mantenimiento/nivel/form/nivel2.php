<div class="modal" id="ModalNivel2" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nivel 2</h4>
            </div>
            <div class="modal-body">
                <form id="ModalNivel2Form">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nivel 1:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel1_id" name="txt_ps_nivel1_id">
                            <input type="text" class="form-control" onblur="LimpiarNivelModal('txt_ps_nivel1_id,#txt_nivel1');" id="txt_nivel1" placeholder="Nivel 1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nivel 2</label>
                            <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_nivel2" name="txt_nivel2">
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                <option  value='0'>Inactivo</option>
                                <option  value='1'>Activo</option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group"> 
                         <label></label>
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
