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

    @include( 'admision.inscripcion.js.grupoacademico_ajax' )
    @include( 'admision.inscripcion.js.grupoacademico' )
    @include( 'admision.inscripcion.js.inscripcion_ajax' )
    @include( 'admision.inscripcion.js.inscripcion' )
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
                                    <h2>Inscripciones</h2>
                                    <p>Gestionar la inscripción del alumno</p>
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
                <div class="widget-tabs-list tab-pt-mg">
                    <ul class="nav nav-tabs tab-nav-center">
                        <li class="active"><a data-toggle="tab" href="#TABInscripcion">Registrar Inscripción</a></li>
                        <li><a data-toggle="tab" href="#TABGrupoAcademico">Seleccionar Grupo Académico</a></li>
                        <li><a data-toggle="tab" href="#TABPagos">Buscar Pagos</a></li>
                    </ul>
                    <div class="tab-content tab-custom-st">
                        <div id="TABInscripcion" class="tab-pane active animated zoomInLeft">
                            <form id="InscripcionForm" name="InscripcionForm">
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>FICHA DE INSCRIPCIÓN DEL POSTULANTE:</legend>
                                    <div class="panel panel-body">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Fecha de Inscripción:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_inscripcion','');"><i class="fa fa-eraser"></i></div>
                                                <input type="text" class="form-control fecha" id="txt_fecha_inscripcion" name="txt_fecha_inscripcion" placeholder="AAAA-MM-DD" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Local de Registro:</label>
                                            <select id="slct_local_id_registro" name="slct_local_id_registro" class="form-control selectpicker show-menu-arrow" data-live-search="true">
                                                <option value="">.::Seleccione::.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Local de Informes:</label>
                                            <select id="slct_local_id_informe" name="slct_local_id_informe" class="form-control selectpicker show-menu-arrow" data-live-search="true">
                                                <option value="">.::Seleccione::.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Modalidad de Estudios:</label>
                                            <select id="slct_modalidad_id" name="slct_modalidad_id" class="form-control selectpicker show-menu-arrow">
                                                <option value="">.::Seleccione::.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-10 col-xs-12">
                                            <label>Inscrito:</label>
                                            <input type="hidden" class="form-control" id="txt_inscrito_id" name="txt_inscrito_id">
                                            <div id="txt_inscrito_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" id="txt_inscrito" onblur="masterG.Limpiar('#txt_inscrito_id',this.value);" placeholder="Paterno | Materno | Nombre | DNI">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <label>Inscrito:</label>
                                            <input type="text" class="form-control" id="txt_dni" placeholder="DNI" disabled>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>DATOS DEL POSTULANTE:</legend>
                                    <div class="panel panel-body">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Estado Civil:</label>
                                                <input type="text" class="form-control adicionales" id="txt_estado_civil" placeholder="Estado Civil" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Documento Identidad:</label>
                                                <input type="text" class="form-control adicionales" id="txt_dni" placeholder="Documento de Identidad" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Fecha de Nacimiento:</label>
                                                <input type="text" class="form-control adicionales" id="txt_fecha_nacimiento" placeholder="Fecha de Nacimiento" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Edad:</label>
                                                <input type="text" class="form-control adicionales" id="txt_edad" placeholder="Edad" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Género:</label>
                                                <input type="text" class="form-control adicionales" id="txt_genero" placeholder="Género" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>País de Nacimiento:</label>
                                                <input type="text" class="form-control adicionales" id="txt_pais" placeholder="País" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Departamento de Nacimiento:</label>
                                                <input type="text" class="form-control adicionales" id="txt_region" placeholder="Departamento" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Provincia de Nacimiento:</label>
                                                <input type="text" class="form-control adicionales" id="txt_provincia" placeholder="Provincia" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Distrito de Nacimiento:</label>
                                                <input type="text" class="form-control adicionales" id="txt_distrito" placeholder="Distrito" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Dirección donde vive:</label>
                                                <textarea type="text" class="form-control adicionales" id="txt_direccion" placeholder="Dirección" readonly>
                                                </textarea>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Tenencia de casa:</label>
                                                <input type="text" class="form-control adicionales" id="txt_tenencia" placeholder="Tenencia" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Departamento donde Vive:</label>
                                                <input type="text" class="form-control adicionales" id="txt_region_dir" placeholder="Departamento" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Provincia donde Vive:</label>
                                                <input type="text" class="form-control adicionales" id="txt_provincia_dir" placeholder="Provincia" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Distrito donde Vive:</label>
                                                <input type="text" class="form-control adicionales" id="txt_distrito_dir" placeholder="Distrito" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Dirección Laboral:</label>
                                                <textarea type="text" class="form-control adicionales" id="txt_direccion_laboral" placeholder="Dirección de Trabajo" readonly>
                                                </textarea>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Empresa Laboral:</label>
                                                <input type="text" class="form-control adicionales" id="txt_empresa_laboral" placeholder="Empresa Laboral" readonly>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label>Teléfono Laboral:</label>
                                                <input type="text" class="form-control adicionales" id="txt_telefono_laboral" placeholder="Teléfono Laboral" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Colegio:</label>
                                                <textarea type="text" class="form-control adicionales" id="txt_colegio" placeholder="Colegio" readonly>
                                                </textarea>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Tipo Colegio:</label>
                                                <input type="text" class="form-control adicionales" id="txt_distrito_col" placeholder="Distrito" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Departamento Colegio:</label>
                                                <input type="text" class="form-control adicionales" id="txt_region_col" placeholder="Departamento" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Provincia Colegio:</label>
                                                <input type="text" class="form-control adicionales" id="txt_provincia_col" placeholder="Provincia" readonly>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                                <label>Distrito Colegio:</label>
                                                <input type="text" class="form-control adicionales" id="txt_distrito_col" placeholder="Distrito" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>DATOS DE ADMISIÓN:</legend>
                                    <div class="panel panel-body">
                                        <div class="col-lg-12 col-md-12 col-sx-12">
                                            <div class="col-md-4 col-xs-11">
                                                <label>Local de Estudios:</label>
                                                <select id="slct_local_estudio_id" name="slct_local_estudio_id" class="form-control selectpicker show-menu-arrow">
                                                    <option value="">.::Seleccione::.</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <br>
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search fa-2x"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <legend>1° Opción:</legend>
                                            <div class="panel panel-body">
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Carrera:</label>
                                                    <input type="text" class="form-control" id="txt_carrera" placeholder="Carrera" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Semestre:</label>
                                                    <input type="text" class="form-control" id="txt_semestre" placeholder="Semestre" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Fecha de Inicio:</label>
                                                    <input type="text" class="form-control" id="txt_fecha_inicio" placeholder="Fecha de Inicio" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Horario:</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Horario" readonly>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <legend>2° Opción:</legend>
                                            <div class="panel panel-body">
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Carrera:</label>
                                                    <input type="text" class="form-control" id="txt_carrera_2" placeholder="Carrera" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Semestre:</label>
                                                    <input type="text" class="form-control" id="txt_semestre_2" placeholder="Semestre" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Fecha de Inicio:</label>
                                                    <input type="text" class="form-control" id="txt_fecha_inicio_2" placeholder="Fecha de Inicio" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12">
                                                    <label>Horario:</label>
                                                    <input type="text" class="form-control" id="txt_horario_2" placeholder="Horario" readonly>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="col-lg-12 col-md-12 col-sx-12">
                                            <div class="col-md-4 col-xs-12">
                                                <label>Modalidad de Ingreso:</label>
                                                <select id="slct_modalidad_ingreso_id" name="slct_modalidad_ingreso_id" class="form-control selectpicker show-menu-arrow">
                                                    <option value="">.::Seleccione::.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sx-12 mg-t-20 mx-t-20" id="div_requerimiento">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sx-12">
                                                        <div class="nk-toggle-switch form-control" data-ts-color="lime">
                                                            <label class="ts-label">1.- Req A:</label>
                                                            <input id="checklab_aux" type="checkbox">
                                                            <label class="ts-helper"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                                                        <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre_1"  name="txt_imagen_nombre_1" value="">
                                                        <input type="text" class="mant" style="display: none;" id="txt_imagen_archivo_1" name="txt_imagen_archivo_1">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-sx-12">
                                                        <label class="btn btn-default btn-flat margin btn-xs">
                                                            <i class="fa fa-file-image-o fa-3x"></i>
                                                            <i class="fa fa-file-pdf-o fa-3x"></i>
                                                            <input type="file" class="mant" style="display: none;" onchange="masterG.onImagen(event,'#InscripcionForm #txt_imagen_nombre_1','#InscripcionForm #txt_imagen_archivo_1','#InscripcionForm #img_1');" >
                                                        </label>
                                                    </div>
                                                
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sx-12">
                                                        <div class="nk-toggle-switch form-control" data-ts-color="lime">
                                                            <label class="ts-label">2.- Req B:</label>
                                                            <input id="checklab_aux" type="checkbox">
                                                            <label class="ts-helper"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                                                        <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre_2"  name="txt_imagen_nombre_2" value="">
                                                        <input type="text" class="mant" style="display: none;" id="txt_imagen_archivo_2" name="txt_imagen_archivo_2">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-sx-12">
                                                        <label class="btn btn-default btn-flat margin btn-xs">
                                                            <i class="fa fa-file-image-o fa-3x"></i>
                                                            <i class="fa fa-file-pdf-o fa-3x"></i>
                                                            <input type="file" class="mant" style="display: none;" onchange="masterG.onImagen(event,'#InscripcionForm #txt_imagen_nombre_2','#InscripcionForm #txt_imagen_archivo_2','#InscripcionForm #img_2');" >
                                                        </label>
                                                    </div>
                                                
                                            </ol>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>PAGOS:</legend>
                                    <div class="panel panel-body">
                                        <fieldset class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <legend>Inscripción:
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search fa-2x"></i>
                                                </button>
                                            </legend>
                                            <div class="panel panel-body">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Fecha de Pago:</label>
                                                    <input type="text" class="form-control" id="txt_carrera" placeholder="Fecha de Pago" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Serie Documento:</label>
                                                    <input type="text" class="form-control" id="txt_fecha_inicio" placeholder="Serie Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Nro Documento:</label>
                                                    <input type="text" class="form-control" id="txt_semestre" placeholder="Nro Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto:</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Descripción Promoción</label>
                                                    <textarea id="txt_horario" class="form-control" readonly>
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto Promoción</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <legend>Matrícula:
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search fa-2x"></i>
                                                </button>
                                            </legend>
                                            <div class="panel panel-body">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Fecha de Pago:</label>
                                                    <input type="text" class="form-control" id="txt_carrera" placeholder="Fecha de Pago" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Serie Documento:</label>
                                                    <input type="text" class="form-control" id="txt_fecha_inicio" placeholder="Serie Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Nro Documento:</label>
                                                    <input type="text" class="form-control" id="txt_semestre" placeholder="Nro Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto:</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Descripción Promoción</label>
                                                    <textarea id="txt_horario" class="form-control" readonly>
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto Promoción</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <legend>Pensión:
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search fa-2x"></i>
                                                </button>
                                            </legend>
                                            <div class="panel panel-body">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Fecha de Pago:</label>
                                                    <input type="text" class="form-control" id="txt_carrera" placeholder="Fecha de Pago" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Serie Documento:</label>
                                                    <input type="text" class="form-control" id="txt_fecha_inicio" placeholder="Serie Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Nro Documento:</label>
                                                    <input type="text" class="form-control" id="txt_semestre" placeholder="Nro Documento" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto:</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Descripción Promoción</label>
                                                    <textarea id="txt_horario" class="form-control" readonly>
                                                    </textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Monto Promoción</label>
                                                    <input type="text" class="form-control" id="txt_horario" placeholder="Monto" readonly>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </fieldset>
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>MARKETING:</legend>
                                    <div class="panel panel-body">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Recepcionista:</label>
                                            <input type="hidden" class="form-control" id="txt_recepcionista_id" name="txt_recepcionista_id">
                                            <div id="txt_recepcionista_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" id="txt_recepcionista" onblur="masterG.Limpiar('#txt_recepcionista_id',this.value);" placeholder="Paterno | Materno | Nombre | DNI">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Medio de Captación:</label>
                                            <select id="slct_medio_captacion_id" name="slct_medio_captacion_id" class="form-control selectpicker show-menu-arrow">
                                                <option value="">.::Seleccione::.</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Medio Seleccionado:</label>
                                            <input type="hidden" class="form-control" id="txt_empleado_id" name="txt_empleado_id">
                                            <div id="txt_empleado_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" id="txt_empleado" onblur="masterG.Limpiar('#txt_empleado_id',this.value);" placeholder="Paterno | Materno | Nombre | DNI">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <label>Descripción:</label>
                                            <input type="text" class="form-control" id="txt_descripcion_mc" placeholder="Descripción">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-primary col-lg-2 col-lg-offset-7 col-md-3 col-md-offset-4 col-xs-4 col-xs-offset-2" onclick="">
                                            <i class="fa fa-file-pdf-o fa-2x">PDF</i>
                                        </button>
                                        <button type="button" class="btn btn-success col-lg-2 col-lg-offset-1 col-md-3 col-md-offset-2 col-xs-4 col-xs-offset-2" onclick="">
                                            <i class="fa fa-cloud-upload fa-2x">Guardar</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="TABGrupoAcademico" class="tab-pane animated zoomInLeft">
                            <form id="GrupoAcademicoFiltroForm" name="GrupoAcademicoFiltroForm">
                                <input type="hidden" name="grupo_academico" class="mant" value="1" >
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>FILTROS: BUSQUE Y SELECCIONE GRUPOS ACADÉMICOS</legend>
                                    <div class="panel panel-body">
                                        <div class="col-md-4 col-xs-12">
                                            <label>Local de Estudios:</label>
                                            <input type="text" class="form-control" id="txt_local" placeholder="Local de Estudios">
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Carrera - Plan Estudios:</label>
                                            <input type="hidden" class="mant" id="txt_plan_estudio_id" name="txt_plan_estudio_id">
                                            <div id="txt_carrera_ico" class="has-error has-feedback">
                                                <input type="text" class="form-control" id="txt_carrera" onblur="masterG.Limpiar('#txt_plan_estudio_id,#txt_nro_plan_estudio,#txt_plan_estudio',this.value);" placeholder="Carrera - Plan Estudios">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>N° - Plan de Estudios:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon col" id="txt_nro_plan_estudio">N°&nbsp;&nbsp;</div>
                                                <input type="text" class="form-control" id="txt_plan_estudio" placeholder="Plan de Estudio" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Periodo Académico:</label>
                                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_semestre_id" name="slct_semestre_id">
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label>Ciclo de Estudios:</label>
                                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_ciclo_id" name="slct_ciclo_id">
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <form id="GrupoAcademicoForm" name="GrupoAcademicoForm">
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>GRUPOS ACADÉMICOS:</legend>
                                    <div class="panel panel-body table-responsive">
                                        <table id="TableGrupoAcademico" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>N° - Plan Estudio</th>
                                                    <th>Carrera</th>
                                                    <th>Semestre</th>
                                                    <th>Ciclo</th>
                                                    <th>Fecha inicio / Fecha Final</th>
                                                    <th>Frecuencia / Horario</th>
                                                    <th>Meta Mínima / Meta Máxima</th>
                                                    <th>Fecha Inicio Matrícula / Fecha Final Matrícula</th>
                                                    <th>Ver Programación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div id="TABPagos" class="tab-pane animated zoomInLeft">
                            <form id="PagosForm" name="PagosForm">
                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>FILTROS: BUSQUE Y SELECCIONE PAGOS</legend>
                                    <div class="panel panel-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>Fecha Inicio de Pago:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_pago_inicio','');"><i class="fa fa-eraser"></i></div>
                                                    <input type="text" class="form-control fecha" id="txt_fecha_pago_inicio" name="txt_fecha_pago_inicio" placeholder="AAAA-MM-DD" readonly>
                                                </div>
                                            </div>
                                             <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label>Fecha Fin de Pago:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_pago_final','');"><i class="fa fa-eraser"></i></div>
                                                    <input type="text" class="form-control fecha" id="txt_fecha_pago_final" name="txt_fecha_pago_final" placeholder="AAAA-MM-DD" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <br>
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4 col-xs-12">
                                                <label>Local de Registro:</label>
                                                <input type="text" class="form-control" id="txt_local" placeholder="Local de Registro" disabled>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <label>Inscrito:</label>
                                                <input type="text" class="form-control" id="txt_local" placeholder="Inscrito" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <legend>PAGOS REGISTRADOS:</legend>
                                    <div class="panel panel-body table-responsive">
                                        <table id="TablePagos" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>Fecha</th>
                                                    <th>Monto</th>
                                                    <th>Nro Serie / Nro Documento</th>
                                                    <th>Promoción</th>
                                                    <th>Monto Promoción</th>
                                                    <th>Seleccionar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .row -->
</div><!-- .content -->
@stop
