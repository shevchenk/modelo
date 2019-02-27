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

@include( 'ingreso.servicio.js.servicio_ajax' )
@include( 'ingreso.servicio.js.servicio' )
@include( 'ingreso.servicio.js.nivel2_ajax' )
@include( 'ingreso.servicio.js.nivel2' )
@include( 'ingreso.servicio.js.nivel1_ajax' )
@include( 'ingreso.servicio.js.nivel1' )

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
                                    <h2>Nuestros Servicios</h2>
                                    <p>Gestionar los Servicios de brinda empresa</p>
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
                            <li class="active"><a data-toggle="tab" href="#MPnivel3">Servicio</a></li>
                            <li><a data-toggle="tab" href="#MPMPnivel2">Sub Grupo</a></li>
                            <li><a data-toggle="tab" href="#MPnivel1">Grupo</a></li>
                        </ul>

                        <div class="tab-content tab-custom-st">
                            <div id="MPnivel3" class="tab-pane in active animated zoomInLeft">
                                <form id="Nivel3Form" name="Nivel3Form">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableNivel3" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-1">Foto:</th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Item:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_item" id="txt_item" placeholder="Item" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Servicio:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel3" id="txt_nivel3" placeholder="Servicio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-3">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Sub Grupo:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel2" id="txt_nivel2" placeholder="Sub Grupo" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-1">
                                                            <div class="form-group">
                                                                <label><h4>Estado:</h4></label><br>
                                                                <div class="input-group">
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
                                                        <th>Foto</th>
                                                        <th>Item</th>
                                                        <th>Servicio</th>
                                                        <th>Sub Grupo</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPMPnivel2" class="tab-pane animated zoomInLeft">
                                <form id="Nivel2Form" name="Nivel2Form">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableNivel2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Grupo:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel1" id="txt_nivel1" placeholder="Grupo" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Sub Grupo:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel2" id="txt_nivel2" placeholder="Sub Grupo" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group">
                                                                <label><h4>Estado:</h4></label><br>
                                                                <div class="input-group">
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
                                                        <th>Grupo</th>
                                                        <th>Sub Grupo</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar2(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPnivel1" class="tab-pane animated zoomInLeft">
                                <form id="Nivel1Form" name="Nivel1Form">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableNivel1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Item:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_item" id="txt_item" placeholder="Item" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Grupo:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel1" id="txt_nivel1" placeholder="Grupo" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
                                                            <div class="form-group">
                                                                <label><h4>Estado:</h4></label><br>
                                                                <div class="input-group">
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
                                                        <th>Item</th>
                                                        <th>Grupo</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar1(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
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
@include( 'ingreso.servicio.form.servicio' )
@include( 'ingreso.servicio.form.nivel2' )
@include( 'ingreso.servicio.form.nivel1' )
@stop
