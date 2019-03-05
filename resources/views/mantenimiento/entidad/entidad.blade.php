@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/EasyAutocomplete1.3.5/easy-autocomplete.min.css') }}
    {{ Html::script('lib/EasyAutocomplete1.3.5/jquery.easy-autocomplete.min.js') }}
    {{ Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}

    @include( 'mantenimiento.entidad.js.entidad_ajax' )
    @include( 'mantenimiento.entidad.js.entidad' )
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
                                    <h2>Configuración del Software</h2>
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
                    <form id="EntidadForm">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Persona:</label>
                                    <input type="hidden" class="mant" id="txt_persona_id" name="txt_persona_id">
                                    <div id="txt_persona_ico" class="has-error has-feedback">
                                        <input type="text" class="form-control" onblur="masterG.Limpiar('#txt_persona_id,#txt_dni',this.value);" id="txt_persona" placeholder="Persona">
                                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>DNI:</label>
                                    <input type="text" class="form-control" maxlength="8" id="txt_dni" placeholder="DNI" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Entidad:</label>
                                    <input type="text" class="form-control" maxlength="150" id="txt_entidad" name="txt_entidad" placeholder="Entidad">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Nombre Comercial:</label>
                                    <input type="text" class="form-control" maxlength="150" id="txt_nombre_comercial" name="txt_nombre_comercial" placeholder="Nombre Comercial">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>RUC:</label>
                                    <input type="text" class="form-control" maxlength="11" onkeypress="return masterG.validaNumeros(event,this,'ruc');return masterG.validaNumerosMax(event,this,11);" id="txt_ruc" name="txt_ruc" placeholder="RUC">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>IGV:</label>
                                    <input type="number" class="form-control" maxlength="2" onkeypress="return masterG.validaNumerosMax(event,this,2);" id="txt_igv" name="txt_igv" placeholder="IGV">
                                </div>
                            </div>
                            <div class="row"><!--INICIO DE COL SM 12-->
                                <div class="col-sm-4">
                                    <label>Logo - <span> Formato=> .ico</span></label>
                                    <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                                    <input type="text" class="mant" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                                    <label class="btn btn-default btn-flat margin btn-xs">
                                        <i class="fa fa-file-image-o fa-5x"></i>
                                        <input type="file" class="mant" style="display: none;" onchange="masterG.onImagen(event,'#EntidadForm #txt_imagen_nombre','#EntidadForm #txt_imagen_archivo','#EntidadForm .img-circle');" >
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <img class="img-circle" style="height: 200px;width: 200px;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px"> 
                                    </div>
                                </div>
                            </div><!--FIN DE COL SM 12-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
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
