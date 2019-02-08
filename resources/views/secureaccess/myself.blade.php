@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    @include( 'secureaccess.js.myself_ajax' )
    @include( 'secureaccess.js.myself' )
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
                                    <h2>Mi Acceso</h2>
                                    <p>Actualizar</p>
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
                        </div><!-- .box-body -->
                    </form><!-- .form -->
                </div>
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .content -->
@stop
