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

@include( 'mantenimiento.nivelacceso.js.menu_ajax' )
@include( 'mantenimiento.nivelacceso.js.menu' )
@include( 'mantenimiento.nivelacceso.js.opcion_ajax' )
@include( 'mantenimiento.nivelacceso.js.opcion' )
@include( 'mantenimiento.nivelacceso.js.privilegio_ajax' )
@include( 'mantenimiento.nivelacceso.js.privilegio' )

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
                                    <h2>Nivel de Acceso</h2>
                                    <p>Gestionar los niveles de acceso al software</p>
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
                            <li class="active"><a data-toggle="tab" href="#MPPrivilegio">Privilegio</a></li>
                            <li><a data-toggle="tab" href="#MPOpcion">Opción</a></li>
                            <li><a data-toggle="tab" href="#MPMenu">Menu</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="MPPrivilegio" class="tab-pane active animated zoomInLeft">
                                <form id="PrivilegioForm" name="PrivilegioForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TablePrivilegio" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Privilegio:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_privilegio" id="txt_privilegio" placeholder="Privilegio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Opción:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_opcion" id="txt_opcion" placeholder="Opción" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
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
                                                        <th>Privilegio</th>
                                                        <th>Opción</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditarPrivilegio(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPOpcion" class="tab-pane animated zoomInLeft">
                                <form id="OpcionForm" name="OpcionForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableOpcion" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-3">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Menu:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_menu" id="txt_menu" placeholder="Menu" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-3">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Opción:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_opcion" id="txt_opcion" placeholder="Opcion" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Ruta:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" maxlength="100" name="txt_ruta" id="txt_ruta" placeholder="Ruta" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
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
                                                        <th>Menu</th>
                                                        <th>Opción</th>
                                                        <th>Ruta</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditarOpcion(1)" >
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <div id="MPMenu" class="tab-pane animated zoomInLeft">
                                <form id="MenuForm" name="MenuForm">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableMenu" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Menu:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_menu" id="txt_menu" placeholder="Menu" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Class Icono:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_class_icono" id="txt_class_icono" placeholder="Class Icono" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-2">
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
                                                        <th>Menu</th>
                                                        <th>Class Icono</th>
                                                        <th>Estado</th>
                                                        <th>[-]</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditarMenu(1)" >
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
@include( 'mantenimiento.nivelacceso.form.menu' )
@include( 'mantenimiento.nivelacceso.form.opcion' )
@include( 'mantenimiento.nivelacceso.form.privilegio' )
@stop
