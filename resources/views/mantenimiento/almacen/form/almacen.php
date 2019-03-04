<div class="modal" id="ModalTransferir" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transferir</h4>
            </div>
            <div class="modal-body">
                <form id="ModalTransferirForm">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label>Local Destino:</label>
                            <input type="hidden" class="mant" id="txt_local_id_destino" name="txt_local_id_destino">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id_destino,#txt_codigo_local_destino', this.value);" id="txt_local_destino" placeholder="Local Destino">
                        </div>
                        <div class="col-md-4">
                            <label>Código Local:</label>
                            <input type="text" class="form-control" id="txt_codigo_local_destino" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label>Empleado Destino:</label>
                            <input type="hidden" class="mant" id="txt_empleado_id_destino" name="txt_empleado_id_destino">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_empleado_id_destino,#txt_dni_destino', this.value);" id="txt_empleado_destino" placeholder="Empleado Destino">
                        </div>
                        <div class="col-sm-4">
                            <label>DNI::</label>
                            <input type="text" class="form-control" id="txt_dni_destino" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nivel 3:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel3_local_id" name="txt_ps_nivel3_local_id">
                            <input type="text" class="form-control" onblur="LimpiarNivelModal('#txt_ps_nivel3_local_id,#txt_ps_nivel3');" id="txt_ps_nivel3" placeholder="Nivel 3">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label>Local Origen:</label>
                            <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id,#txt_codigo_local', this.value);" id="txt_local" placeholder="Local">
                        </div>
                        <div class="col-md-4">
                            <label>Código Local:</label>
                            <input type="text" class="form-control" id="txt_codigo_local" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label>Empleado Origen:</label>
                            <input type="hidden" class="mant" id="txt_empleado_id" name="txt_empleado_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_empleado_id,#txt_dni', this.value);" id="txt_empleado" placeholder="Empleado">
                        </div>
                        <div class="col-sm-4">
                            <label>DNI::</label>
                            <input type="text" class="form-control" id="txt_dni" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_cantidad" name="txt_cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Transferencia</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_transferir', '');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fechas" id="txt_fecha_transferir" name="txt_fecha_transferir" placeholder="0000-00-00" readonly="">
                                </div>
                            </div>
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
