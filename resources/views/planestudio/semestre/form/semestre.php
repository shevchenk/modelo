<div class="modal" id="ModalSemestre" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Plan de Estudio</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ModalSemestreForm">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                                <label>Periodo Académico:</label>
                                <input type="text" class="form-control" id="txt_semestre" name="txt_semestre" placeholder="Periodo Académico">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Fecha Inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#ModalSemestreForm #txt_fecha_inicio','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_inicio" name="txt_fecha_inicio" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha Final:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#ModalSemestreForm #txt_fecha_final','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_final" name="txt_fecha_final" placeholder="AAAA-MM-DD" readonly="">
                                </div>
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
