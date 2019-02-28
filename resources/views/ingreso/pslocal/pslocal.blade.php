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
    
    @include( 'ingreso.pslocal.js.pslocal_ajax' )
    @include( 'ingreso.pslocal.js.pslocal' )

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
                                    <p>Gestionar los Productos y Servicios de los Locales</p>
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
                <form id="ProductoForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableProducto" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
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
                                            <label><h4>Tipo:</h4></label>
                                            <select class="form-control selectpicker show-menu-arrow" name="slct_tipo" id="slct_tipo">
                                                <option value="">.::Todo::.</option>
                                                <option value="2">Producto</option>
                                                <option value="1">Servicio</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th class="col-xs-3">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Producto / Servicio:</h4></label><br>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_nivel3" id="txt_nivel3" placeholder="Producto / Servicio" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
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
                                        <label><h4>Eliminar:</h4></label>
                                    </th>
                                    <th class="col-xs-1">
                                        <label><h4>Editar:</h4></label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                  <th>Local</th>
                                  <th>Tipo</th>
                                  <th>Producto / Servicio</th>
                                  <th>Stock</th>
                                  <th>Eliminar</th>
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
     @include( 'ingreso.pslocal.form.pslocal' )
@stop
