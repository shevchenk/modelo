<div class="modal" id="ModalPromocion" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Promocions</h4>
            </div>
            <div class="modal-body">
                <form id="ModalPromocionForm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nivel 1:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel1_id" name="txt_ps_nivel1_id">
                            <input type="text" class="form-control" onblur="LimpiarNivelModal('txt_ps_nivel1_id,#txt_nivel1');" id="txt_nivel1" placeholder="Nivel 1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <label>Local:</label>
                            <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                            <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id,#txt_codigo_local',this.value);" id="txt_local" placeholder="Local">
                        </div>
                        <div class="col-md-4">
                            <label>Código Local:</label>
                            <input type="text" class="form-control" id="txt_codigo_local" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nivel 2:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel2_id" name="txt_ps_nivel2_id">
                            <input type="text" class="form-control" onblur="LimpiarNivelModal('txt_ps_nivel2_id,#txt_nivel2');" id="txt_nivel2" placeholder="Nivel 2">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Oferta</label>
                            <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_oferta" name="txt_oferta">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Inicio Promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_inicio_pro','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_inicio_pro" name="txt_fecha_inicio_pro" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Final Promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_final_pto','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_final_pro" name="txt_fecha_final_pro" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cantidad Promoción</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_cantidad_pro" name="txt_cantidad_pro" placeholder="Cantidad Promoción">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descuento Porcentaje</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dscto_porcentaje" name="txt_dscto_porcentaje" placeholder="Descuento Porcentaje">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descueno Monto</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_dscto_monto" name="txt_dscto_monto" placeholder="Descuento Monto">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descuento Cantidad</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dscto_cantidad" name="txt_dscto_cantidad" placeholder="Descuento CAntidad">
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
