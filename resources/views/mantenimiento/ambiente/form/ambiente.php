<div class="modal" id="ModalAmbiente" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ambiente</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalAmbienteForm">
                        <div class="col-lg-9 col-md-9 col-xs-9">
                            <div class="form-group">
                            <label>Local:</label>
                            <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                            <div id="txt_local_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id',this.value);" id="txt_local" placeholder="Local">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <div class="form-group">
                                <label>Código:</label>
                                <input type="text" class="form-control" id="txt_codigo_local" placeholder="Código" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>Pabellon:</label>
                            <input type="hidden" class="mant" id="txt_pabellon_id" name="txt_pabellon_id">
                            <div id="txt_pabellon_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_pabellon_id',this.value);" id="txt_pabellon" placeholder="Pabellon">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipo Ambiente:</label>
                                <select class="form-control selectpicker show-menu-arrow" name="slct_tipo_ambiente" id="slct_tipo_ambiente">
                                    <option value='1'>Aula</option>
                                    <option value='2'>Laboratorio</option>
                                    <option value='3'>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ambiente:</label>
                                <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_ambiente" name="txt_ambiente" placeholder="Ambiente" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Piso:</label>
                                <input type="number" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_piso" name="txt_piso" placeholder="Piso">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Aforo:</label>
                                <input type="number" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_aforo" name="txt_aforo" placeholder="Aforo">
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
