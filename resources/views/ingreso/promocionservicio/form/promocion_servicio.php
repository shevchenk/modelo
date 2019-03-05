<div class="modal" id="ModalPromocion" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Promociones de los Servicios</h4>
            </div>
            <div class="modal-body">
                <form id="ModalPromocionForm">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Grupo:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel1_id" name="txt_ps_nivel1_id">
                            <div id="txt_nivel1_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_ps_nivel1_id,#txt_nivel1',this.value);" id="txt_nivel1" placeholder="Grupo">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Sub Grupo:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel2_id" name="txt_ps_nivel2_id">
                            <div id="txt_nivel2_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_ps_nivel2_id,#txt_nivel2',this.value);" id="txt_nivel2" placeholder="Sub Grupo">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Servicio:</label>
                            <input type="hidden" class="mant" value="1" id="txt_tipo" name="txt_tipo">
                            <input type="hidden" class="mant" id="txt_ps_nivel3_id" name="txt_ps_nivel3_id">
                            <div id="txt_nivel3_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_ps_nivel3_id,#txt_nivel3',this.value);" id="txt_nivel3" placeholder="Servicio">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <label>Local:</label>
                            <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                            <div id="txt_local_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id,#txt_codigo_local',this.value);" id="txt_local" placeholder="Local">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <label>Código Local:</label>
                            <input type="text" class="form-control" id="txt_codigo_local" placeholder="Código Local" disabled>
                        </div>
                        <div class="col-md-12">
                            <label>Oferta</label>
                            <textarea placeholder="Oferta del Servicio" rows="3" class="form-control" id="txt_oferta" name="txt_oferta"></textarea>
                        </div> 
                        <div class="col-md-4">
                            <label>Fecha Inicio Promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_inicio_pro','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_inicio_pro" name="txt_fecha_inicio_pro" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Fecha Final Promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_final_pro','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_final_pro" name="txt_fecha_final_pro" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Cantidad Promoción</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_cantidad_pro" name="txt_cantidad_pro" placeholder="Cantidad Promoción">
                        </div>
                        <div class="col-md-4">
                            <label>Descuento Porcentaje</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dscto_porcentaje" name="txt_dscto_porcentaje" placeholder="Descuento Porcentaje">
                        </div>
                        <div class="col-md-4">
                            <label>Descueno Monto</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_dscto_monto" name="txt_dscto_monto" placeholder="Descuento Monto">
                        </div>
                        <div class="col-md-4">
                            <label>Descuento Cantidad</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dscto_cantidad" name="txt_dscto_cantidad" placeholder="Descuento CAntidad">
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
