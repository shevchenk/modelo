@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    {{ Html::style('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}
    {{ Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}
    {{ Html::script('lib/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}

    {{ Html::style('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js') }}

    {{ Html::style('lib/EasyAutocomplete1.3.5/easy-autocomplete.min.css') }}
    {{ Html::script('lib/EasyAutocomplete1.3.5/jquery.easy-autocomplete.min.js') }}

    @include( 'mantenimiento.empleado.js.empleado_ajax' )
    @include( 'mantenimiento.empleado.js.empleado' )

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
                                    <h2>Empleados</h2>
                                    <p>Gestionar registro de Empleados</p>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                <form id="EmpleadoForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableEmpleado" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Apellido Paterno:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_paterno" id="txt_paterno" placeholder="Apellido Paterno" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Apellido Materno:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_materno" id="txt_materno" placeholder="Apellido Materno" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Nombre:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" placeholder="Nombre" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>DNI:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_dni" id="txt_dni" placeholder="DNI" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Código:</h4></label>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_codigo" id="txt_codigo" placeholder="Código" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Estado:</h4></label>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">[-]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                  <th>Apellido Paterno</th>
                                  <th>Apellido Materno</th>
                                  <th>Nombre</th>
                                  <th>DNI</th>
                                  <th>Código</th>
                                  <th>Estado</th>
                                  <th>[-]</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
                            <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                        </div>
                    </div><!-- .box-body -->
                </form><!-- .form -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('form')
     @include( 'mantenimiento.empleado.form.empleado' )
@stop
