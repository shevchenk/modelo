<div class="modal" id="ModalEmpleado" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Empleados</h4>
            </div>
            <div class="modal-body">
                <form id="ModalEmpleadoForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6">
                                <label>Persona:</label>
                                <input type="hidden" class="mant" id="txt_persona_id" name="txt_persona_id">
                                <div id="txt_persona_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_persona_id,#txt_dni',this.value);" id="txt_persona" placeholder="Persona">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>DNI:</label>
                                <input type="text" class="form-control" id="txt_dni" disabled>
                            </div>
                            <div class="col-sm-3">
                                <label>Código:</label>
                                <input type="text" id="txt_codigo" name="txt_codigo" class="form-control" id="txt_codigo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-5">
                                <label>Puesto de Trabajo:</label>
                                <input type="hidden" class="mant" id="txt_cargo_id" name="txt_cargo_id">
                                <div id="txt_cargo_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_cargo_id',this.value);" id="txt_cargo" placeholder="Puesto de Trabajo">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label>Local:</label>
                                <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                                <div id="txt_local_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id,#txt_codigo_local',this.value);" id="txt_local" placeholder="Local">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>Código Local:</label>
                                <input type="text" class="form-control" id="txt_codigo_local" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6">
                                <label>Medio de Captación:</label>
                                <input type="hidden" class="mant" id="txt_medio_captacion_id" name="txt_medio_captacion_id">
                                <div id="txt_medio_captacion_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_medio_captacion_id',this.value);" id="txt_medio_captacion" placeholder="Medio de Captación">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Fecha Ingreso:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_ingreso','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_ingreso" name="txt_fecha_ingreso" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Fecha Cese:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_cese','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_cese" name="txt_fecha_cese" placeholder="AAAA-MM-DD" readonly="">
                                </div>
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
