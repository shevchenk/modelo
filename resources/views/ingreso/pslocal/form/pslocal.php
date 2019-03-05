<div class="modal" id="ModalProducto" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Productos</h4>
            </div>
            <div class="modal-body">
                <form id="ModalProductoForm">
                    <div class="row">
                        <div class="col-md-8 col-xs-8">
                            <label>Local:</label>
                            <input type="hidden" class="mant" id="txt_local_id" name="txt_local_id">
                            <div id="txt_local_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_local_id,#txt_codigo_local',this.value);" id="txt_local" name="txt_local" placeholder="Local">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <label>Código Local:</label>
                            <input type="text" class="form-control" id="txt_codigo_local" placeholder="Código Local" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo:</label>
                            <input type="hidden" class="mant" id="txt_ttipo" name="txt_ttipo">
                            <select class="form-control selectpicker show-menu-arrow" name="slct_tipo" id="slct_tipo">
                                <option value="0">.:Seleccione:.</option>
                                <option value="2">Producto</option>
                                <option value="1">Servicio</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label>Sub Grupo:</label>
                            <input type="text" class="form-control" id="txt_nivel2" placeholder="Sub Grupo" disabled>
                        </div>
                        <div class="col-md-12">
                            <label>Producto / Servicio:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel3_id" name="txt_ps_nivel3_id">
                            <div id="txt_nivel3_ico" class="has-error has-feedback">
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_ps_nivel3_id,#txt_nivel3',this.value);" id="txt_nivel3" name="txt_nivel3" placeholder="Producto / Servicio">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <label>Precio Venta:</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_precio_venta" name="txt_precio_venta">
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <label>Precio Compra:</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_precio_compra" name="txt_precio_compra">
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <label>Moneda:</label>
                            <select  class="form-control selectpicker show-menu-arrow" id="slct_moneda" name="slct_moneda">
                                <option value="0">.::Seleccione::.</option>
                                <option data-icon="fa fa-strikethrough" value="1">Soles</option>
                                <option data-icon="fa fa-dollar" value="2">Dolares</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Stock:</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event,this);" class="form-control" id="txt_stock" name="txt_stock" placeholder="Stock">
                        </div>
                        <div class="col-md-4">
                            <label>Stock Minimo:</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event,this);" class="form-control" id="txt_stock_minimo" name="txt_stock_minimo" placeholder="Stock Minimo">
                        </div>
                        <div class="col-md-4">
                            <label>Días Alerta:</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event,this);" class="form-control" id="txt_dias_alerta" name="txt_dias_alerta" placeholder="Días Alerta">
                        </div>
                        <div class="col-md-4">
                            <label>Fecha Ingreso:</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_ingreso','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_ingreso" name="txt_fecha_ingreso" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Fecha Vencimiento:</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_vencimiento','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_vencimiento" name="txt_fecha_vencimiento" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Días Vencimiento:</label>
                                <input type="number" onkeypress="return masterG.validaNumeros(event,this);" class="form-control" id="txt_dias_vencimiento" name="txt_dias_vencimiento" placeholder="Dias Vencimiento">
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
