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

@include( 'mantenimiento.nivel.js.nivel3_ajax' )
@include( 'mantenimiento.nivel.js.nivel3' )
@include( 'mantenimiento.nivel.js.nivel2_ajax' )
@include( 'mantenimiento.nivel.js.nivel2' )
@include( 'mantenimiento.nivel.js.nivel1_ajax' )
@include( 'mantenimiento.nivel.js.nivel1' )

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
                                    <h2>Productos y Servicios de los Locales</h2>
                                    <p>Gestionar los Niveles</p>
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
                            <li class="active"><a data-toggle="tab" href="#MPnivel3">Nivel 3</a></li>
                            <li><a data-toggle="tab" href="#MPMPnivel2">Nivel 2</a></li>
                            <li><a data-toggle="tab" href="#MPnivel1">Nivel 1</a></li>
                        </ul>

                        <div class="tab-content tab-custom-st">
                            <div id="MPnivel3" class="tab-pane in active animated zoomInLeft">
                                <form id="Nivel3Form" name="Nivel3Form">
                                    <div class="tab-ctn">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="TableNivel3" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="cabecera">
                                                        <th class="col-xs-3">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Nivel 2:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel2" id="txt_nivel2" placeholder="Nivel 2" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-3">
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
                                                                <label><h4>Nivel 3:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel3" id="txt_nivel3" placeholder="Nivel 3" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
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
                                                        <th>Nivel 2</th>
                                                        <th>Item</th>
                                                        <th>Nivel 3</th>
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
                                                                <label><h4>Nivel 1:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel1" id="txt_nivel1" placeholder="Nivel 1" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Nivel 2:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel2" id="txt_nivel2" placeholder="Nivel 2" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
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
                                                        <th>Nivel 1</th>
                                                        <th>Nivel 2</th>
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
                                                                <label><h4>Nivel 1:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_nivel1" id="txt_nivel1" placeholder="Nivel 1" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="col-xs-5">
                                                            <div class="form-group col-xs-12">
                                                                <label><h4>Item:</h4></label><br>
                                                                <div class="input-group col-xs-12">
                                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                                    <input type="text" class="form-control" name="txt_item" id="txt_item" placeholder="Item" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
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
                                                        <th>Nivel 1</th>
                                                        <th>Item</th>
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
            <!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                            <form id="ProductoForm">
                                <div class="box-body table-responsive no-padding">
                                    <table id="TableProducto" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th class="col-xs-3">
                                                    <div class="form-group col-xs-12">
                                                        <label><h4>Nivel 3:</h4></label><br>
                                                        <div class="input-group col-xs-12">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_nivel3" id="txt_local" placeholder="Local" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-3">
                                                    <div class="form-group col-xs-12">
                                                        <label><h4>Local:</h4></label><br>
                                                        <div class="input-group col-xs-12">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_local" id="txt_local" placeholder="Local" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-3">
                                                    <div class="form-group col-xs-12">
                                                        <label><h4>Stock:</h4></label><br>
                                                        <div class="input-group col-xs-12">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_stock" id="txt_stock" placeholder="Stock" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
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
                                              <th>Nivel 3</th>
                                              <th>Local</th>
                                              <th>Stock</th>
                                              <th>Estado</th>
                                              <th>[-]</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
                                        <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                    </div>
                                </div> .box-body 
                            </form> .form 
                            </div>
                        </div>-->
        </div>
    </div>
</div>
@stop

@section('form')
@include( 'mantenimiento.nivel.form.nivel3' )
@include( 'mantenimiento.nivel.form.nivel2' )
@include( 'mantenimiento.nivel.form.nivel1' )
@stop
