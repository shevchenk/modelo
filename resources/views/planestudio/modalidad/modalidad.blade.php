@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    {{ Html::style('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}
    {{ Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}
    {{ Html::script('lib/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}

    @include( 'planestudio.modalidad.js.modalidad_ajax' )
    @include( 'planestudio.modalidad.js.modalidad' )

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
                                    <h2>Modalidad de Estudio</h2>
                                    <p>Gestionar las modalidades de estudios</p>
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
                <form id="ModalidadForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableModalidad" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-5">
                                        <div class="form-group col-xs-12">
                                            <label><h4>Modalidad de Estudio:</h4></label><br>
                                            <div class="input-group col-xs-12">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_modalidad" id="txt_modalidad" placeholder="Modalidad de Estudio" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
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
                                  <th>Modalidad de Estudio</th>
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
     @include( 'planestudio.modalidad.form.modalidad' )
@stop
