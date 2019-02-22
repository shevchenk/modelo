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

    @include( 'pregrado.grupoacademico.js.grupoacademico_ajax' )
    @include( 'pregrado.grupoacademico.js.grupoacademico' )
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
                                    <i class="fa fa-user-secret"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Grupo Académico</h2>
                                    <p>Gestionar los grupos académicos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <form id="MyselfForm">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contraseña Nueva:</label>
                                    <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña Nueva">
                                </div>
                                <div class="form-group">
                                    <label>Confirmar Contraseña Nueva:</label>
                                    <input type="password" class="form-control" id="txt_password_confirm" name="txt_password_confirm" placeholder="Confirmar Contraseña Nueva">
                                </div>
                                <div class="form-group">
                                    <label><i class="fa fa-asterisk"></i> Su contraseña Actual:</label>
                                    <input type="password" class="form-control" id="txt_password_actual" name="txt_password_actual" placeholder="Su contraseña Actual">
                                </div>
                                <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="EditarAjax()" >
                                    <i class="fa fa-edit fa-lg"></i>&nbsp;Guardar</a>
                                </div>
                                </div>
                            </div>
                        </div><!-- .box-body -->
                    </form><!-- .form -->
                </div>

                <div class="data-table-list">
                    <form id="MyselfForm">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contraseña Nueva:</label>
                                    <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña Nueva">
                                </div>
                                <div class="form-group">
                                    <label>Confirmar Contraseña Nueva:</label>
                                    <input type="password" class="form-control" id="txt_password_confirm" name="txt_password_confirm" placeholder="Confirmar Contraseña Nueva">
                                </div>
                                <div class="form-group">
                                    <label><i class="fa fa-asterisk"></i> Su contraseña Actual:</label>
                                    <input type="password" class="form-control" id="txt_password_actual" name="txt_password_actual" placeholder="Su contraseña Actual">
                                </div>
                                <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="EditarAjax()" >
                                    <i class="fa fa-edit fa-lg"></i>&nbsp;Guardar</a>
                                </div>
                                </div>
                            </div>
                        </div><!-- .box-body -->
                    </form><!-- .form -->
                </div>
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .content -->
@stop
