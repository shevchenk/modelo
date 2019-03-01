<div class="modal" id="ModalModalidadIngreso" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modalidad de Ingreso</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalModalidadIngresoForm">
                        <div class="col-md-12">
                            <label>Modalidad de Ingreso:</label>
                            <input type="text" class="form-control" id="txt_modalidad_ingreso" name="txt_modalidad_ingreso" placeholder="Modalidad Ingreso">
                        </div>
                        <div class="col-md-12">
                            <label>Tipo:</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_tipo" id="slct_tipo">
                                <option value='' selected>.::Seleccione::.</option>
                                <option value='1'>Ordinario</option>
                                <option value='2'>Extra Ordinario</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Estado:</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                <option  value='0'>Inactivo</option>
                                <option  value='1'>Activo</option>
                            </select>
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
