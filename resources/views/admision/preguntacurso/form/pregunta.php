<div class="modal" id="ModalPregunta" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pregunta</h4>
            </div>
            <div class="modal-body">
                <form id="ModalPreguntaForm">
                    <div class="col-md-12">
                        <label>Curso:</label>
                        <input type="hidden" class="mant" id="txt_curso_id" name="txt_curso_id">
                        <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_curso_id,#txt_curso', this.value);" id="txt_curso" placeholder="Curso">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pregunta</label>
                            <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_pregunta" name="txt_pregunta" placeholder="Pregunta">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo Pregunta</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_tipo_pregunta" id="slct_tipo_pregunta">
                                <option  value='1'>Con Alternativa</option>
                                <option  value='2'>Libre</option>
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
