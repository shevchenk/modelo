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

    @include( 'pregrado.grupoacademico.js.grupoacademico_ajax' )
    @include( 'pregrado.grupoacademico.js.grupoacademico' )
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
                                    <h2>Grupo Académico</h2>
                                    <p>Gestionar los grupos académicos</p>
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
                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_plan_estudio_id,#txt_nro_plan_estudio,#txt_plan_estudio',this.value);" id="txt_persona" placeholder="Carrera - Plan Estudios">
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
                                <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_semestre_id" name="slct_semestre_id">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Ciclo de Estudios:</label>
                                <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_ciclo_id" name="slct_ciclo_id">
                                </select>
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <label>Meta Mínima:</label>
                                <input type="number" class="form-control" id="txt_meta_minima" name="txt_meta_minima" placeholder="Meta Mínima" onkeypress="return masterG.validaNumerosMax(event, this, 3);">
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <label>Meta Máxima:</label>
                                <input type="number" class="form-control" id="txt_meta_maxima" name="txt_meta_maxima" placeholder="Meta Máxima" onkeypress="return masterG.validaNumerosMax(event, this, 3);">
                            </div>

                            <div class="col-md-4">
                                <label>Días:</label>
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
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form id="GrupoAcademicoForm" name="GrupoAcademicoForm">
                    <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <legend>GRUPOS ACADÉMICOS:</legend>
                        <div class="panel panel-body">
                            
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
