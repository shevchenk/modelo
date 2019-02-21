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

@include( 'planestudio.semestre.js.semestre_programacion_ajax' )
@include( 'planestudio.semestre.js.semestre_programacion' )
@include( 'planestudio.semestre.js.semestre_ajax' )
@include( 'planestudio.semestre.js.semestre' )

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
                                    <h2>Periodos Académicos</h2>
                                    <p>Gestionar los periodos académicos</p>
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
                            <li class="active"><a data-toggle="tab" href="#MPSemestre">Periodo Académico</a></li>
                            <li><a data-toggle="tab" href="#MPSemestreProgramacion">Programación de Fechas de pago por Periodo</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="MPSemestre" class="tab-pane active animated zoomInLeft">
                                <form id="SemestreForm" name="SemestreForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableSemestre" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Periodo Académico:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_semestre" id="txt_semestre" placeholder="Periodo Académico" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Fecha Inicio:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" maxlength="150" name="txt_fecha_resolucion" id="txt_fecha_resolucion" placeholder="Fecha Inicio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Fecha Final:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" maxlength="150" name="txt_fecha_resolucion" id="txt_fecha_resolucion" placeholder="Fecha Final" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
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
                                                        <th>Periodo Académico</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Final</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditarSemestre(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPSemestreProgramacion" class="tab-pane animated zoomInLeft">
                                <form id="SemestreProgramacionForm" name="SemestreProgramacionForm">
                                    <div class="tab-ctn">
                                        <div class="box-body">
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>Periodo Académico</legend>
                                                <div class="panel panel-body">
                                                    <div class="col-md-4">
                                                        <label>Periodo Académico:</label>
                                                        <input type="hidden" class="form-control" id="txt_semestre_id" name="txt_semestre_id">
                                                        <input type="text" class="form-control" id="txt_semestre" placeholder="Periodo Académico" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Fecha Inicio:</label>
                                                        <input type="text" class="form-control" id="txt_fecha_inicio" placeholder="Fecha Inicio" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Fecha Final:</label>
                                                        <input type="text" class="form-control" id="txt_fecha_final" placeholder="Fecha Final" disabled>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>Programacion de Pagos</legend>
                                                <div class="panel panel-body table-responsive no-padding">
                                                    <table id="TableSemestreProgramacion" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="centrar col-xs-2"> N° </th>
                                                                <th class="centrar col-xs-2"> Fecha Programada</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="btn btn-primary btnplandetalle" onclick="AgregarSemestreProgramacion();">
                                                        <i class="fa fa-plus fa-lg"></i>&nbsp;Agregar
                                                    </button>
                                                    <button type="button" class="btn btn-warning btnplandetalle2" onclick="CancelarSemestreProgramacion();" disabled>
                                                        <i class="fa fa-window-close-o fa-lg"></i>&nbsp;Cancelar
                                                    </button>
                                                    <button type="button" class="btn btn-success btnplandetalle2" onclick="GuardarSemestreProgramacion();" disabled>
                                                        <i class="fa fa-save fa-lg"></i>&nbsp;Guardar
                                                    </button>
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
@include( 'planestudio.semestre.form.semestre' )
@stop
