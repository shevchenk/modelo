<div class="modal" id="ModalPlanEstudio" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Plan de Estudio</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalPlanEstudioForm">
                        <div class="col-sm-12">
                            <label>Modalidad:</label>
                            <input type="hidden" class="mant" id="txt_modalidad_id" name="txt_modalidad_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_modalidad_id',this.value);" id="txt_modalidad" placeholder="Modalidad">
                        </div>
                        <div class="col-sm-12">
                            <label>Facultad:</label>
                            <input type="hidden" class="mant" id="txt_facultad_id" name="txt_facultad_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_facultad_id',this.value);" id="txt_facultad" placeholder="Facultad" disabled>
                        </div>
                        <div class="col-md-12">
                            <label>Carrera:</label>
                            <input type="hidden" class="mant" id="txt_carrera_id" name="txt_carrera_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_carrera_id',this.value);" id="txt_carrera" placeholder="Carrera">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Plan de Estudio:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_plan_estudio" name="txt_plan_estudio" placeholder="Plan de Estudio" maxlength="150">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Perfil Profesional:</label>
                                <textarea class="form-control" id="txt_perfil_profesional" name="txt_perfil_profesional" placeholder="Perfil Profesional" maxlength="150" cols="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Resolución:</label>
                                <input type="text" class="form-control" id="txt_resolucion" name="txt_resolucion" placeholder="Resolución" maxlength="150">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Fecha Resolución:</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#ModalPlanEstudioForm #txt_fecha_resolucion','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fecha" id="txt_fecha_resolucion" name="txt_fecha_resolucion" placeholder="AAAA-MM-DD" readonly="">
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
