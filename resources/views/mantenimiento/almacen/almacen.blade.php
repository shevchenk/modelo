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
    
    @include( 'mantenimiento.almacen.js.almacen_ajax' )
    @include( 'mantenimiento.almacen.js.almacen' )

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
                                    <h2>Transferir</h2>
                                    <p>Gestionar el ingreso y salida de productos</p>
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
                <form id="TransferirForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableTransferir" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-3">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Local destino:</h4></label><br>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_local_id_destino" id="txt_local_id_destino" placeholder="Local Destino" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
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
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Cantidad:</h4></label><br>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_cantidad" id="txt_cantidad" placeholder="Cantidad" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Fecha Transferencia:</h4></label><br>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_fecha_transferir" id="txt_fecha_transferir" placeholder="Fecha Transferir" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">
                                        <div class="form-group">
                                            <label><h4>Estado:</h4></label><br>
                                            <div class="input-group">
                                                <select class="form-control selectpicker show-menu-arrow" name="slct_estado_transferencia" id="slct_estado_transferencia">
                                                    <option value='' selected>.::Todo::.</option>
                                                    <option value='0'>Pendiente</option>
                                                    <option value='1'>Aprobado Transferencia</option>
                                                    <option value='2'>Aprobado Almacen</option>
                                                    <option value='3'>Denegado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">
                                        <div class="form-group">
                                            <label><h4>Estado:</h4></label>
                                            <div class="input-group">
                                                <select class="form-control" name="slct_estado" id="slct_estado">
                                                    <option value='' selected>.::Todo::.</option>
                                                    <option value='0'>Inactivo</option>
                                                    <option value='1'>Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                  <th>Local Destino</th>
                                  <th>Local</th>
                                  <th>Cantidad</th>
                                  <th>Fecha Transferencia</th>
                                  <th>Estado</th>
                                  <th>Estado</th>
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
     @include( 'mantenimiento.almacen.form.almacen' )
@stop
