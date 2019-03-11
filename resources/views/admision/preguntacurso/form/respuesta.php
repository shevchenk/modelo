<div class="modal" id="ModalRespuesta" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Respuesta</h4>
            </div>
            <div class="modal-body">
                <form id="ModalRespuestaForm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Pregunta</label>
                            <input  type="hidden" class="form-control mant"  id="txt_pregunta_id" name="txt_pregunta_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_pregunta" name="txt_pregunta" disabled="">
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alternativa</label>
                            <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_alternativa" name="txt_alternativa">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alternativa Correcta</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_correcto" id="slct_correcto">
                                <option value>.::Seleccione::.</option>
                                <option  value='0'>Incorrecto</option>
                                <option  value='1'>Correcto</option>
                            </select>
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
