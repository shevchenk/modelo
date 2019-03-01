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

@include( 'admision.modalidadingreso.js.requisitos_ajax' )
@include( 'admision.modalidadingreso.js.requisitos' )
@include( 'admision.modalidadingreso.js.modalidad_ingreso_ajax' )
@include( 'admision.modalidadingreso.js.modalidad_ingreso' )

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
                                    <h2>Modalidades de Ingresos</h2>
                                    <p>Gestionar las modalidades de ingreso del alumno</p>
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
                            <li class="active"><a data-toggle="tab" href="#MPModalidadIngreso">Modalidad de Ingreso</a></li>
                            <li><a data-toggle="tab" href="#MPModalidadIngresoRequisito">Requisitos de la Modalidad de Ingreso</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="MPModalidadIngreso" class="tab-pane active animated zoomInLeft">
                                <form id="ModalidadIngresoForm" name="ModalidadIngresoForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableModalidadIngreso" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Modalidad de Ingreso:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_modalidad_ingreso" id="txt_modalidad_ingreso" placeholder="Modalidad de Ingreso" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Tipo:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <select class="form-control selectpicker show-menu-arrow" name="slct_tipo" id="slct_tipo">
                                                                        <option value='' selected>.::Todo::.</option>
                                                                        <option value='1'>Ordinario</option>
                                                                        <option value='2'>Extra Ordinario</option>
                                                                    </select>
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
                                                        <th class="col-xs-1">Ver Requisitos</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cabecera">
                                                        <th>Modalidad de Ingreso</th>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        <th>Ver Requisitos</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditarModalidadIngreso(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPModalidadIngresoRequisito" class="tab-pane animated zoomInLeft">
                                <form id="ModalidadIngresoRequisitoForm" name="ModalidadIngresoRequisitoForm">
                                    <div class="tab-ctn">
                                        <div class="box-body">
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>Modalidad de Ingreso</legend>
                                                <div class="panel panel-body">
                                                    <div class="col-md-8">
                                                        <label>Modalidad de Ingreso:</label>
                                                        <input type="hidden" class="form-control" id="txt_modalidad_ingreso_id" name="txt_modalidad_ingreso_id">
                                                        <input type="text" class="form-control" id="txt_modalidad_ingreso" placeholder="Modalidad de Ingreso" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Tipo:</label>
                                                        <input type="text" class="form-control" id="txt_tipo" placeholder="Tipo" disabled>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <legend>Requisitos del Medio de Ingreso</legend>
                                                <div class="panel panel-body table-responsive no-padding">
                                                    <table id="TableModalidadIngresoRequisito" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="centrar col-xs-2"> N° </th>
                                                                <th class="centrar col-xs-2"> Requisito</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="btn btn-primary btnplandetalle" onclick="AgregarModalidadIngresoRequisito();">
                                                        <i class="fa fa-plus fa-lg"></i>&nbsp;Agregar
                                                    </button>
                                                    <button type="button" class="btn btn-warning btnplandetalle2" onclick="CancelarModalidadIngresoRequisito();" disabled>
                                                        <i class="fa fa-window-close-o fa-lg"></i>&nbsp;Cancelar
                                                    </button>
                                                    <button type="button" class="btn btn-success btnplandetalle2" onclick="GuardarModalidadIngresoRequisito();" disabled>
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
@include( 'admision.modalidadingreso.form.modalidad_ingreso' )
@stop
