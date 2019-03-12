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

    @include( 'pregrado.programacion.js.grupoacademico_ajax' )
    @include( 'pregrado.programacion.js.grupoacademico' )
    @include( 'pregrado.programacion.js.programacion_ajax' )
    @include( 'pregrado.programacion.js.programacion' )
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
                                    <h2>Programación de Cursos</h2>
                                    <p>Gestionar la programación de los curso</p>
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
                <div class="widget-tabs-list tab-pt-mg">
                    <ul class="nav nav-tabs tab-nav-center">
                        <li class="active"><a data-toggle="tab" href="#TABGrupoAcademico">Grupos Académicos</a></li>
                        <li><a data-toggle="tab" href="#TABProgramacion">Programación de Cursos</a></li>
                    </ul>
                    <div class="tab-content tab-custom-st">
                        <div id="TABGrupoAcademico" class="tab-pane active animated zoomInLeft">
                            <form id="GrupoAcademicoFiltroForm" name="GrupoAcademicoFiltroForm">
                                <input type="hidden" name="grupo_academico" class="mant" value="1" >
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>FILTROS: BUSQUE Y SELECCIONE GRUPOS ACADÉMICOS</legend>
                                    <div class="panel panel-body">
                                        <div class="col-md-4 col-xs-12">
                                            <label>Local de Estudios:</label>
                                            <select  class="form-control selectpicker show-menu-arrow" data-selected-text-format="count > 3" data-actions-box="true" data-live-search="true" id="slct_local_id" name="slct_local_id[]" multiple>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Carrera - Plan Estudios:</label>
                                            <input type="hidden" class="mant" id="txt_plan_estudio_id" name="txt_plan_estudio_id">
                                            <div id="txt_carrera_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" id="txt_carrera" onblur="masterG.Limpiar('#txt_plan_estudio_id,#txt_nro_plan_estudio,#txt_plan_estudio',this.value);" placeholder="Carrera - Plan Estudios">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>N° - Plan de Estudios:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon col" id="txt_nro_plan_estudio">N°&nbsp;&nbsp;</div>
                                                <input type="text" class="form-control" id="txt_plan_estudio" placeholder="Plan de Estudio" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Periodo Académico:</label>
                                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_semestre_id" name="slct_semestre_id">
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Ciclo de Estudios:</label>
                                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_ciclo_id" name="slct_ciclo_id">
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <form id="GrupoAcademicoForm" name="GrupoAcademicoForm">
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>GRUPOS ACADÉMICOS:</legend>
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
                                                    <th>Ver Programación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div id="TABProgramacion" class="tab-pane animated zoomInLeft">
                            <form id="ProgramacionForm" name="ProgramacionForm">
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>GRUPO ACADÉMICO</legend>
                                    <div class="panel panel-body">
                                        <div class="col-md-3 col-xs-12">
                                            <label>Local de Estudios:</label>
                                            <input type="text" class="form-control" id="txt_local" placeholder="Local de Estudios" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Carrera - Plan Estudios:</label>
                                            <input type="text" class="form-control" id="txt_carrera" placeholder="Carrera" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>N° - Plan de Estudios:</label>
                                            <input type="text" class="form-control" id="txt_plan_estudio" placeholder="Plan Estudios" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Periodo Académico:</label>
                                            <input type="text" class="form-control" id="txt_semestre" placeholder="Periodo Académico" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Ciclo de Estudios:</label>
                                            <input type="text" class="form-control" id="txt_ciclo" placeholder="Ciclo de Estudios" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Fecha Inicio / Fecha Final:</label>
                                            <input type="text" class="form-control" id="txt_fechas" placeholder="Ciclo de Estudios" disabled>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Frecuencia / Horario:</label>
                                            <input type="text" class="form-control" id="txt_horario" placeholder="Frecuencia / Horario" disabled>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Sección:</label>
                                            <select id="slct_seccion" name="slct_seccion" class="form-control selectpicker show-menu-arrow">
                                                <option selected value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <label>Aula del Grupo:</label>
                                            <input type="hidden" class="mant" id="txt_ambiente_id" name="txt_ambiente_id">
                                            <div id="txt_ambiente_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_ambiente_id',this.value);" id="txt_ambiente" placeholder="Aula del Grupo">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>PROGRAMACIÓN</legend>
                                    <div class="panel panel-body table-responsive">
                                        <!-- left container (table with subjects) -->
                                        <table id="TableProgramacionAux">
                                            <tr>
                                                <td>
                                                    <div id="editar_aux" style="display: none;">
                                                        <table class="table"><tr><td>
                                                            <input type="hidden" class="mant" id="txt_plan_estudio_detalle_id_aux" name="txt_plan_estudio_detalle_id_aux">
                                                            <select id="slct_curso_aux" class="form-control col-md-12" onchange="PlanEstudioDetalleId('_aux');">
                                                                <option>Seleccione</option>
                                                            </select>
                                                        </td></tr><tr><td>
                                                            <input type="hidden" class="mant" id="txt_persona_id_aux" name="txt_persona_id_aux">
                                                            <div id="txt_persona_ico_aux" class="has-error has-feedback">
                                                                <input type="text" class="form-control col-md-12" onblur="masterG.Limpiar('#txt_persona_id_aux,#txt_dni_aux',this.value);" id="txt_persona_aux" placeholder="Docente">
                                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                                            </div>
                                                        </td></tr><tr><td>
                                                            <div class="nk-toggle-switch form-control col-md-12" data-ts-color="lime">
                                                                <label class="ts-label">Laboratorio:</label>
                                                                <input id="checklab_aux" type="checkbox" onchange="VisualizaLab(this,'#txt_ambiente_ico_aux');">
                                                                <label class="ts-helper"></label>
                                                            </div>
                                                            <input type="hidden" class="mant" id="txt_ambiente_id_aux" name="txt_ambiente_id_aux">
                                                            <div id="txt_ambiente_ico_aux" class="has-error has-feedback" style="display: none;">
                                                                <input type="text" class="form-control col-md-12" onblur="masterG.Limpiar('#txt_ambiente_id_aux',this.value);" id="txt_ambiente_aux" placeholder="Laboratorio">
                                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                                            </div>
                                                        </td></tr><tr><td>
                                                            <div class="nk-toggle-switch form-control col-md-12" data-ts-color="blue">
                                                                <label class="ts-label">Virtual:</label>
                                                                <input type="hidden" class="mant" id="txt_tipo_clase_aux" name="txt_tipo_clase_aux" value="1">
                                                                <input id="checkvir_aux" type="checkbox" onchange="ClaseVirtual(this,'#txt_tipo_clase_aux');">
                                                                <label class="ts-helper"></label>
                                                            </div>
                                                        </td></tr><tr><td>
                                                            <button type="button" class="btn btn-danger col-md-3 col-xs-4" onclick="CancelarProgramacion('#crear_aux','#editar_aux');"><i class="glyphicon glyphicon-remove"></i></button>
                                                            <button type="button" class="btn btn-success col-md-3 col-md-offset-6 col-xs-4 col-xs-offset-4" onclick="GuardarProgramacion('_aux');"><i class="glyphicon glyphicon-ok"></i></button>
                                                        </td></tr></table>
                                                    </div>
                                                    <div id="listar_aux" style="display: none;">
                                                        <table class="table"><tr><td>
                                                            <input type="hidden" class="mant" id="lbl_plan_estudio_detalle_id_aux">
                                                            <input type="hidden" class="mant" id="lbl_curso_aux">
                                                            <label><b>Curso:</b></label>
                                                            <span id="lbl_curso_t_aux">Hola Mundo</span>
                                                        </td></tr><tr><td>
                                                            <input type="hidden" class="mant" id="lbl_persona_id_aux">
                                                            <label><b>Docente:</b></label>
                                                            <span id="lbl_persona_id_t_aux"></span>
                                                        </td></tr><tr><td>
                                                            <input type="hidden" class="mant" id="lbllab_aux">
                                                            <input type="hidden" class="mant" id="lbl_ambiente_id_aux">
                                                            <label><b>Laboratorio:</b></label>
                                                            <span id="lbllab_t_aux">Si</span>
                                                            <span id="lbl_ambiente_id_t_aux">Sala de Cómputo</span>
                                                        </td></tr><tr><td>
                                                            <input type="hidden" class="mant" id="lblvir_aux">
                                                            <label><b>Virtual:</b></label>
                                                            <span id="lblvir_t_aux">Si</span>
                                                        </td></tr><tr><td class="centrar">
                                                            <button type="button" onclick="AgregarEditarProgramacion('#listar_aux','#editar_aux');" class="btn btn-warning col-md-4 col-xs-4"><i class="glyphicon glyphicon-edit"></i></button>
                                                        </td></tr></table>
                                                    </div>
                                                    <div id="crear_aux" class="centrar">
                                                        <button type="button" onclick="AgregarEditarProgramacion('#crear_aux','#editar_aux');" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table id="TableProgramacion" class="table table-hover table-bordered">
                                            <thead>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .row -->
</div><!-- .content -->
@stop
