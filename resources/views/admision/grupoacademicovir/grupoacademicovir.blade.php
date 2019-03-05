@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    {{ Html::style('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}
    {{ Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}
    {{ Html::script('lib/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}

    {{ Html::style('lib/EasyAutocomplete1.3.5/easy-autocomplete.min.css') }}
    {{ Html::script('lib/EasyAutocomplete1.3.5/jquery.easy-autocomplete.min.js') }}

    {{ Html::style('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js') }}

    {{ Html::style('lib/iCheck/all.css') }}
    {{ Html::script('lib/iCheck/icheck.min.js') }}

    @include( 'admision.grupoacademicovir.js.grupoacademicovir_ajax' )
    @include( 'admision.grupoacademicovir.js.grupoacademicovir' )
@stop

@section('content')
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="fa fa-cogs"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Grupo Académico Admisión Virtual</h2>
                                    <p>Gestionar los grupos académicos admisión virtual</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form id="GrupoAcademicoFiltroForm" name="GrupoAcademicoFiltroForm">
                    <input type="hidden" name="grupo_academico" class="mant" value="1" >
                    <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <legend>FILTROS: BUSQUE Y SELECCIONE GRUPOS ACADÉMICOS</legend>
                        <div class="panel panel-body">
                            <div class="col-md-4">
                                <label>Local de Estudios:</label>
                                <select  class="form-control selectpicker show-menu-arrow" data-selected-text-format="count > 3" data-actions-box="true" data-live-search="true" id="slct_local_id" name="slct_local_id[]" multiple>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Carrera - Plan Estudios:</label>
                                <input type="hidden" class="mant" id="txt_plan_estudio_id" name="txt_plan_estudio_id">
                                <div id="txt_carrera_ico" class="has-error has-feedback">
                                    <input type="text" class="form-control" id="txt_carrera" onblur="masterG.Limpiar('#txt_plan_estudio_id,#txt_nro_plan_estudio,#txt_plan_estudio',this.value);" placeholder="Carrera - Plan Estudios">
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>N° - Plan de Estudios:</label>
                                <div class="input-group">
                                    <div class="input-group-addon col" id="txt_nro_plan_estudio">N°&nbsp;&nbsp;</div>
                                    <input type="text" class="form-control" id="txt_plan_estudio" placeholder="Plan de Estudio" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Periodo Académico:</label>
                                <select class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_semestre_id" name="slct_semestre_id">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Ciclo de Estudios:</label>
                                <input type="text" class="form-control" id="txt_ciclo_id" placeholder="Ciclo de Estudios" value="I Ciclo" disabled>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <legend>DATOS A CREAR O MODIFICAR:</legend>
                        <div class="panel panel-body">
                            <div class="col-md-4">
                                <label>Frecuencia(s):</label>
                                <select  class="form-control selectpicker show-menu-arrow" data-actions-box="true" multiple id="slct_frecuencia" name="slct_frecuencia[]">
                                    <option value="Lu">Lunes</option>
                                    <option value="Ma">Martes</option>
                                    <option value="Mi">Miercoles</option>
                                    <option value="Ju">Jueves</option>
                                    <option value="Vi">Viernes</option>
                                    <option value="Sa">Sábado</option>
                                    <option value="Do">Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label>Fecha y Hora Inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_inicio','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_inicio" name="txt_fecha_inicio" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label>Fecha y Hora Final:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_final','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha" id="txt_fecha_final" name="txt_fecha_final" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <label>Meta Mínima:</label>
                                <input type="number" class="form-control" id="txt_meta_minima" name="txt_meta_minima" placeholder="Meta Mínima" onkeypress="return masterG.validaNumerosMax(event, this, 3);">
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <label>Meta Máxima:</label>
                                <input type="number" class="form-control" id="txt_meta_maxima" name="txt_meta_maxima" placeholder="Meta Máxima" onkeypress="return masterG.validaNumerosMax(event, this, 3);">
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label>Fecha Inicio Matrícula:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_inicio_mat','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha2" id="txt_fecha_inicio_mat" name="txt_fecha_inicio_mat" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label>Fecha Final Matrícula:</label>
                                <div class="input-group">
                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_final_mat','');"><i class="fa fa-eraser"></i></div>
                                    <input type="text" class="form-control fecha2" id="txt_fecha_final_mat" name="txt_fecha_final_mat" placeholder="AAAA-MM-DD" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-footer">
                            <div class="col-md-10">
                                <button type="button" class="btn btn-primary btnplandetalle" onclick="AgregarEditarGrupoAcademicoMasivo();">
                                    <i class="fa fa-plus fa-lg"></i>&nbsp;Crear y <i class="fa fa-edit fa-lg"></i>Editar
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-info btnplandetalle2" onclick="AgregarGrupoAcademicoMasivo();">
                                    <i class="fa fa-plus fa-lg"></i>&nbsp;Solo Crear
                                </button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info btnplandetalle2" onclick="EditarGrupoAcademicoMasivo();">
                                    <i class="fa fa-edit fa-lg"></i>&nbsp;Editar Seleccionado(s)
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form id="GrupoAcademicoForm" name="GrupoAcademicoForm">
                    <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <legend>GRUPOS ACADÉMICOS ADMISIÓN:</legend>
                        <div class="panel panel-body table-responsive">
                            <table id="TableGrupoAcademico" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Local</th>
                                        <th>N° - Plan Estudio</th>
                                        <th>Carrera</th>
                                        <th>Semestre</th>
                                        <th>Ciclo</th>
                                        <th>Fecha inicio / Fecha Final</th>
                                        <th>Frecuencia / Horario</th>
                                        <th>Meta Mínima / Meta Máxima</th>
                                        <th>Fecha Inicio Matrícula / Fecha Final Matrícula</th>
                                        <th>Estado</th>
                                        <th>[ ]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list mg-t-30">
                    <div>Hola</div>
                </div>
            </div>
        </div-->
    </div><!-- .row -->
</div><!-- .content -->
@stop
