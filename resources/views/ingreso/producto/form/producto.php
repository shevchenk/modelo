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
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nivel 3:</label>
                            <input type="hidden" class="mant" id="txt_ps_nivel3_id" name="txt_ps_nivel3_id">
                            <input type="text" class="form-control" onblur="LimpiarProductoModal('txt_ps_nivel3_id,#txt_nivel3');" id="txt_nivel3" placeholder="Nivel 3">
                        </div>
                    </div>
                    <div class="col-md-7">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Precio Venta</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_precio_venta" name="txt_precio_venta">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Precio Compra</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_precio_compra" name="txt_precio_compra">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Moneda</label>
                            <select  class="form-control selectpicker show-menu-arrow" id="slct_moneda" name="slct_moneda">
                                <option value="0">.::Seleccione::.</option>
                                <option data-icon="fa fa-strikethrough" 
                                        value="1">Soles</option>
                                <option data-icon="fa fa-dollar" 
                                        value="2">Dolares</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_stock" name="txt_stock" placeholder="Stock">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stock Minimo</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_stock_minimo" name="txt_stock_minimo" placeholder="Stock Minimo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Días Alerta</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dias_alerta" name="txt_dias_alerta" placeholder="Días Alerta">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha Vencimiento</label>
                            <div class="input-group">
                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_vencimiento','');"><i class="fa fa-eraser"></i></div>
                                <input type="text" class="form-control fechas" id="txt_fecha_vencimiento" name="txt_fecha_vencimiento" placeholder="0000-00-00" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Días Vencimiento</label>
                            <input type="number" onkeypress="return masterG.validaNumeros(event);" class="form-control" id="txt_dias_vencimiento" name="txt_dias_vencimiento" placeholder="Dias Vencimiento">
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
