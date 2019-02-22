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

@include( 'planestudio.planestudiovir.js.plan_estudio_vir_detalle_ajax' )
@include( 'planestudio.planestudiovir.js.plan_estudio_vir_detalle' )
@include( 'planestudio.planestudiovir.js.plan_estudio_vir_ajax' )
@include( 'planestudio.planestudiovir.js.plan_estudio_vir' )

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
                                    <h2>Plan de Estudios</h2>
                                    <p>Gestionar los Planes de Estudios</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
<!-- Notification area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="data-table-list">
                    <div class="widget-tabs-list tab-pt-mg">
                        <ul class="nav nav-tabs tab-nav-center">
                            <li class="active"><a data-toggle="tab" href="#MPPlanEstudio">Plan de Estudio</a></li>
                            <li><a data-toggle="tab" href="#MPPlanEstudioDetalle">Detalle del plan de estudio</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="MPPlanEstudio" class="tab-pane active animated zoomInLeft">
                                <form id="PlanEstudioForm" name="PlanEstudioForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TablePlanEstudio" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Facultad:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" name="txt_facultad" id="txt_facultad" placeholder="Facultad" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Carrera:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" name="txt_carrera" id="txt_carrera" placeholder="Carrera" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Modalidad:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" name="txt_modalidad" id="txt_modalidad" placeholder="Modalidad" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>N° Plan de Estudio:</h4></label>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Plan de Estudio:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" maxlength="100" name="txt_plan_estudio" id="txt_plan_estudio" placeholder="Plan de Estudio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Perfil Profesional:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" maxlength="150" name="txt_perfil_profesional" id="txt_perfil_profesional" placeholder="Perfil Profesional" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Resolución:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" maxlength="150" name="txt_resolucion" id="txt_resolucion" placeholder="Resolución" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Fecha Resolución:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" style="width:100px !important;" maxlength="150" name="txt_fecha_resolucion" id="txt_fecha_resolucion" placeholder="Fecha Resolución" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Fecha Creación:</h4></label>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-1">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Estado:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                                                        <option value='' selected>.::Todo::.</option>
                                                                        <option value='0'>Inactivo</option>
                                                                        <option value='1'>Activo</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-1">[-]</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cabecera">
                                                        <th>Facultad</th>
                                                        <th>Carrera</th>
                                                        <th>Modalidad</th>
                                                        <th>N° Plan de Estudio</th>
                                                        <th>Plan de Estudio</th>
                                                        <th>Perfil Profesional</th>
                                                        <th>Resolución</th>
                                                        <th>Fecha Resolución</th>
                                                        <th>Fecha Creación</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPPlanEstudioDetalle" class="tab-pane animated zoomInLeft">
                                <form id="PlanEstudioDetalleForm" name="PlanEstudioDetalleForm">
                                    <div class="tab-ctn">
                                        <div class="box-body">
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>SECCIÓN 1: INFORMACIÓN GENERAL DEL PROGRAMA</legend>
                                                <div class="panel panel-body">
                                                    <div class="col-md-4">
                                                        <label>Código del Programa de Estudio:</label>
                                                        <input type="text" class="form-control" id="txt_codigo" placeholder="Código" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Denominación del Programa de Estudio:</label>
                                                        <input type="text" class="form-control" id="txt_carrera" placeholder="Carrera" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>N° Plan de Estudios:</label>
                                                        <div class="input-group">
                                                        <div class="input-group-addon" id="txt_nro_plan_estudio"></div>
                                                        <input type="text" class="form-control col-md-8" id="txt_plan_estudio" placeholder="Plan de Estudio" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Modalidad de Estudios:</label>
                                                        <input type="text" class="form-control" id="txt_modalidad" placeholder="Modalidad" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Documento Actualización del Plan Curricular:</label>
                                                        <input type="text" class="form-control" id="txt_resolucion" placeholder="Resolución" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Fecha Actualización del Plan Curricular:</label>
                                                        <input type="text" class="form-control" id="txt_fecha_resolucion" placeholder="Fecha Resolución" disabled>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>SECCIÓN 2: PERIODO ACADÉMICO Y VALOR DEL CRÉDITO</legend>
                                                <div class="panel panel-body">
                                                    <div class="col-md-4">
                                                        <label>Régimen de Estudios:</label>
                                                        <input type="text" class="form-control" id="txt_regimen_estudio" placeholder="Régimen de Estudios" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>N° de Periodos Académicos por Año:</label>
                                                        <input type="text" class="form-control" id="txt_periodo_academico" placeholder="N° Periodo Académico" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Valor de 1 Crédito en Horas de Teoría por Periodo Académico:</label>
                                                        <input type="text" class="form-control" id="txt_credito_teoria" placeholder="Valor del Crédito en Teoria" disabled>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>En caso se Tome otra Periocidad, Señale cual::</label>
                                                        <input type="text" class="form-control" id="txt_otro" placeholder="Otra Periocidad" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Duración del Programa en Años:</label>
                                                        <input type="text" class="form-control" id="txt_duracion" placeholder="Duración del Programa" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Valor de 1 Crédito en Horas de Práctica por Periodo Académico:</label>
                                                        <input type="text" class="form-control" id="txt_credito_practica" placeholder="Valor del Crédito en Práctica" disabled>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>SECCIÓN 3: TABLA RESUMEN DE CRÉDITOS Y HORAS DEL PROGRAMA</legend>
                                                <div class="panel panel-body table-responsive no-padding">
                                                    <table id="TablePlanEstudioResumen" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="centrar" rowspan="2" colspan="2" >
                                                                    <button type="button" class="btn btn-info" onclick="AjaxPlanEstudioDetalle.CargarResumen(CargarResumenPlanEstudioHTML);">
                                                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                                                    </button>
                                                                </th>
                                                                <th class="centrar" rowspan="2"> N° Cursos</th>
                                                                <th class="centrar" colspan="4"> N° Horas Lectivas</th>
                                                                <th class="centrar" colspan="4"> N° Créditos Académicos</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="centrar"> Teoría</th>
                                                                <th class="centrar"> Práctica</th>
                                                                <th class="centrar"> Total</th>
                                                                <th class="centrar"> % Total</th>

                                                                <th class="centrar"> Teoría</th>
                                                                <th class="centrar"> Práctica</th>
                                                                <th class="centrar"> Total</th>
                                                                <th class="centrar"> % Total</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="centrar" colspan="2">TOTAL:</th>
                                                                <th class="centrar pplantilla">
                                                                    <label id="tcursot">0</label>
                                                                </th>

                                                                <th class="centrar pplantilla">
                                                                    <label id="thora_teoriat">0</label>
                                                                </th>
                                                                <th class="centrar pplantilla">
                                                                    <label id="thora_practicat">0</label>
                                                                </th>
                                                                <th class="centrar pplantilla">
                                                                    <label id="thora_totalt">0</label>
                                                                </th>
                                                                <th class="centrar pplantilla per">
                                                                    <label id="thora_pert">0.00%</label>
                                                                </th>

                                                                <th class="centrar pplantilla dec">
                                                                    <label id="tcredito_teoriat">0.00</label>
                                                                </th>
                                                                <th class="centrar pplantilla dec">
                                                                    <label id="tcredito_practicat">0.00</label>
                                                                </th>
                                                                <th class="centrar pplantilla dec">
                                                                    <label id="tcredito_totalt">0.00</label>
                                                                </th>
                                                                <th class="centrar pplantilla per">
                                                                    <label id="tcredito_pert">0.00%</label>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="centrar" rowspan="4">Tipo de Estudios</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estudios Generales</td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ecurso1">0</label>
                                                                </td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_teoria1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_practica1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_total1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ehora_per1">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_teoria1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_practica1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_total1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ecredito_per1">0.00%</label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estudios Específicos</td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ecurso2">0</label>
                                                                </td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_teoria2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_practica2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_total2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ehora_per2">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_teoria2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_practica2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_total2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ecredito_per2">0.00%</label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estudios de Especialidad</td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ecurso3">0</label>
                                                                </td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_teoria3">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_practica3">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="ehora_total3">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ehora_per3">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_teoria3">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_practica3">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="ecredito_total3">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="ecredito_per3">0.00%</label>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="centrar" rowspan="3">Modalidad</td>
                                                            </tr>
                                                             <tr class="success">
                                                                <td>Presencial</td>
                                                                <td class="centrar">&nbsp;</td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_teoria1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_practica1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_total1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="mhora_per1">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_teoria1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_practica1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_total1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="mcredito_per1">0.00%</label>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td>Virtual</td>
                                                                <td class="centrar">&nbsp;</td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_teoria2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_practica2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="mhora_total2">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="mhora_per2">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_teoria2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_practica2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="mcredito_total2">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="mcredito_per2">0.00%</label>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="centrar" rowspan="3">Tipo de Curso</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Obligatorios</td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="tcurso1">0</label>
                                                                </td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_teoria1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_practica1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_total1">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="thora_per1">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_teoria1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_practica1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_total1">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="tcredito_per1">0.00%</label>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td>Electivos</td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="tcurso0">0</label>
                                                                </td>

                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_teoria0">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_practica0">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla">
                                                                    <label id="thora_total0">0</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="thora_per0">0.00%</label>
                                                                </td>

                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_teoria0">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_practica0">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla dec">
                                                                    <label id="tcredito_total0">0.00</label>
                                                                </td>
                                                                <td class="centrar pplantilla per">
                                                                    <label id="tcredito_per0">0.00%</label>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>SECCIÓN 4: DESCRIPCIÓN DE LA MALLA CURRICULAR</legend>
                                                <div class="panel panel-body table-responsive no-padding">
                                                    <table id="PlantillaCurricular" style="display: none;" class="mant table table-bordered table-hover">
                                                        <tbody>
                                                            <tr id="tr_nro">
                                                                <td class="centrar">
                                                                    <select style="width:80px !important;" id="slct_ciclo_id_nro" name="slct_ciclo_id_nro">
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="mant" id="txt_curso_id_nro" name="txt_curso_id_nro">
                                                                    <input class="form-control" style="width:200px !important;" type="text" onblur="masterG.Limpiar('#txt_curso_id_nro',this.value);" id="txt_curso_nro" name="txt_curso_nro" placeholder="Curso">
                                                                </td>
                                                                <td><select style="width:120px !important;" id="slct_tipo_estudio_nro" name="slct_tipo_estudio_nro">
                                                                        <option value="1">General</option>
                                                                        <option value="2">Específico</option>
                                                                        <option value="3">Especialidad</option>
                                                                    </select>
                                                                </td>
                                                                <td><select style="width:100px !important;" id="slct_tipo_curso_nro" name="slct_tipo_curso_nro">
                                                                        <option value="1">Obligatorio</option>
                                                                        <option value="0">Electivo</option>
                                                                    </select>
                                                                </td>

                                                                <td class="centrar">
                                                                    <input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_teoria_presencial_nro" name="txt_hora_teoria_presencial_nro" placeholder="0" value="0">
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_teoria_virtual_nro" name="txt_hora_teoria_virtual_nro" placeholder="0" value="0">
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:50px !important;" type="text" class="form-control" id="txt_hora_teoria_total_nro" name="txt_hora_teoria_total_nro" placeholder="0" value='0' readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_practica_presencial_nro" name="txt_hora_practica_presencial_nro" placeholder="0" value="0">
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_practica_virtual_nro" name="txt_hora_practica_virtual_nro" placeholder="0" value="0">
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:50px !important;" type="text" class="form-control" id="txt_hora_practica_total_nro" name="txt_hora_practica_total_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:50px !important;" type="text" class="form-control" id="txt_hora_total_nro" name="txt_hora_total_nro" placeholder="0" value="0" readonly>
                                                                </td>


                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_presencial_nro" name="txt_credito_teoria_presencial_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_virtual_nro" name="txt_credito_teoria_virtual_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_total_nro" name="txt_credito_teoria_total_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_presencial_nro" name="txt_credito_practica_presencial_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_virtual_nro" name="txt_credito_practica_virtual_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_total_nro" name="txt_credito_practica_total_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                                <td class="centrar">
                                                                    <input style="width:60px !important;" type="text" class="form-control" id="txt_credito_total_nro" name="txt_credito_total_nro" placeholder="0" value="0" readonly>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table id="TablePlanEstudioDetalle" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="centrar col-xs-2" rowspan="3"> Periodo Académico
                                                                    <input type="hidden" class="mant" name="txt_plan_estudio_id" id="txt_plan_estudio_id" value="0">
                                                                    <select id="slct_ciclo_id_filtro" name="slct_ciclo_id_filtro" class="form-control"></select>
                                                                </th>
                                                                <th class="centrar col-xs-2" rowspan="3"> Nombre del Curso</th>
                                                                <th class="centrar col-xs-2" rowspan="3"> Tipo de Estudios</th>
                                                                <th class="centrar col-xs-2" rowspan="3"> Tipo de Curso</th>
                                                                <th class="centrar" colspan="7"> Horas Lectivas por Periodo Académico</th>
                                                                <th class="centrar" colspan="7"> Créditos Académicos</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="centrar" colspan="3"> Teoría</th>
                                                                <th class="centrar" colspan="3"> Práctica</th>
                                                                <th class="centrar" rowspan="2"> Total de Horas</th>
                                                                <th class="centrar" colspan="3"> Teoría</th>
                                                                <th class="centrar" colspan="3"> Práctica</th>
                                                                <th class="centrar" rowspan="2"> Total de Créditos Otorgados</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="centrar col-xs-1">Pre</th>
                                                                <th class="centrar col-xs-1">Vir</th>
                                                                <th class="centrar col-xs-1">Total</th>
                                                                <th class="centrar col-xs-1">Pre</th>
                                                                <th class="centrar col-xs-1">Vir</th>
                                                                <th class="centrar col-xs-1">Total</th>

                                                                <th class="centrar col-xs-1">Pre</th>
                                                                <th class="centrar col-xs-1">Vir</th>
                                                                <th class="centrar col-xs-1">Total</th>
                                                                <th class="centrar col-xs-1">Pre</th>
                                                                <th class="centrar col-xs-1">Vir</th>
                                                                <th class="centrar col-xs-1">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </fieldset>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@stop

@section('form')
@include( 'planestudio.planestudiovir.form.plan_estudio_vir' )
@stop
