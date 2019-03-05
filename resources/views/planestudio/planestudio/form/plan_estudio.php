<div class="modal" id="ModalPlanEstudio" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Plan de Estudio</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalPlanEstudioForm">
                        <div class="col-md-12">
                            <div class="col-sm-4">
                                <label>Modalidad:</label>
                                <input type="hidden" class="mant" id="txt_modalidad_id" name="txt_modalidad_id">
                                <div id="txt_modalidad_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_modalidad_id',this.value);" id="txt_modalidad" placeholder="Modalidad">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <label>Facultad:</label>
                                <input type="hidden" class="mant" id="txt_facultad_id" name="txt_facultad_id">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_facultad_id',this.value);" id="txt_facultad" placeholder="Facultad" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <label>Carrera:</label>
                                <input type="hidden" class="mant" id="txt_carrera_id" name="txt_carrera_id">
                                <div id="txt_carrera_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_carrera_id',this.value);" id="txt_carrera" placeholder="Carrera">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Código:</label>
                                <input type="text" class="form-control" id="txt_codigo" placeholder="Código" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Plan de Estudio:</label>
                                    <textarea class="form-control" id="txt_plan_estudio" name="txt_plan_estudio" placeholder="Plan de Estudio" maxlength="150" cols="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Perfil Profesional:</label>
                                    <textarea class="form-control" id="txt_perfil_profesional" name="txt_perfil_profesional" placeholder="Perfil Profesional" maxlength="150" cols="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Resolución:</label>
                                    <input type="text" class="form-control" id="txt_resolucion" name="txt_resolucion" placeholder="Resolución" maxlength="150">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Fecha Resolución:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#ModalPlanEstudioForm #txt_fecha_resolucion','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_resolucion" name="txt_fecha_resolucion" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label>Régimen:</label>
                                <select class="form-control selectpicker show-menu-arrow" name="slct_regimen_estudio" id="slct_regimen_estudio">
                                    <option  value='3'>Trimestral</option>
                                    <option  value='4'>Cuatrimestral</option>
                                    <option  value='6'>Semestral</option>
                                    <option  value='12'>Anual</option>
                                    <option  value='0'>Otro</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Otro Régimen:</label>
                                <textarea class="form-control" id="txt_regimen_otro" name="txt_regimen_otro" placeholder="Otro Régimen" maxlength="150" cols="3"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label>N° Periodo Académico x Año:</label>
                                <input type="number" class="form-control" onkeypress="return masterG.validaNumeros(event, this);" id="txt_periodo_academico" name="txt_periodo_academico" placeholder="N° Periodo Académico x Año">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label>Duración del Programa:</label>
                                <input type="number" class="form-control" onkeypress="return masterG.validaNumeros(event, this);" id="txt_duracion" name="txt_duracion" placeholder="Duración del Programa">
                            </div>
                            <div class="col-md-4">
                                <label>Valor del Crédito en H. Teoría:</label>
                                <input type="number" class="form-control" onkeypress="return masterG.validaNumeros(event, this);" id="txt_credito_teoria" name="txt_credito_teoria" placeholder="Valor del Crédito en Teoría">
                            </div>
                            <div class="col-md-4">
                                <label>Valor del Crédito en H. Práctica:</label>
                                <input type="number" class="form-control" onkeypress="return masterG.validaNumeros(event, this);" id="txt_credito_practica" name="txt_credito_practica" placeholder="Valor del Crédito en Práctica">
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
