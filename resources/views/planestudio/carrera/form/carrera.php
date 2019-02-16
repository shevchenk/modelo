<div class="modal" id="ModalCarrera" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Carrera</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalCarreraForm">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>Facultad:</label>
                            <input type="hidden" class="mant" id="txt_facultad_id" name="txt_facultad_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_facultad_id',this.value);" id="txt_facultad" placeholder="Facultad">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Código:</label>
                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Código" maxlength="20">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Carrera:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_carrera" name="txt_carrera" placeholder="Carrera" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Grado Académico:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_grado_academico" name="txt_grado_academico" placeholder="Grado Académico" maxlength="150">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Título Profesional:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_titulo_profesional" name="txt_titulo_profesional" placeholder="Título Profesional" maxlength="150">
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
