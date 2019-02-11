<div class="modal" id="ModalPersona" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-tabs-list tab-pt-mg">
                        <ul class="nav nav-tabs tab-nav-center">
                            <li class="active"><a data-toggle="tab" href="#MPdatopersonal">Datos Personales</a></li>
                            <li><a data-toggle="tab" href="#MPdatoadicional">Datos Adicionales</a></li>
                            <li><a data-toggle="tab" href="#MPnivelacceso">Nivel de Acceso</a></li>
                        </ul>
                        <form id="ModalPersonaForm" name="ModalPersonaForm">
                            <div class="tab-content tab-custom-st">
                                <div id="MPdatopersonal" class="tab-pane in active animated zoomInLeft">
                                    <div class="tab-ctn">
                                        <div class="modal-header btn-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Datos Personales</h4>
                                        </div>
                                        <div class="modal-body">
                                            <fieldset>
                                                <div class="row form-group">
                                                    <div class="col-sm-12"> <!--INICIO DE COL SM 12-->
                                                        <div class="col-sm-4">
                                                            <label>Nombre(s):</label>
                                                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Apellido Paterno:</label>
                                                            <input type="text" class="form-control" id="txt_paterno" name="txt_paterno" placeholder="Apellido Paterno">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Apellido Materno:</label>
                                                            <input type="text" class="form-control" id="txt_materno" name="txt_materno" placeholder="Apellido Materno">
                                                        </div>           
                                                    </div> <!--FIN DE COL SM 12-->

                                                    <div class="col-sm-12"><!--INICIO DE COL SM 12-->
                                                        <div class="col-sm-4">
                                                            <label>DNI:</label>
                                                            <input type="text" onkeypress="return masterG.validaNumerosMax(event, this, 15);" class="form-control" id="txt_dni" name="txt_dni" placeholder="DNI"  autocomplete="off">
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label>Sexo:</label>
                                                            <select class="form-control selectpicker show-menu-arrow" id="slct_sexo" name="slct_sexo">
                                                                <option value="0">.::Seleccione::.</option>
                                                                <option data-icon="fa fa-female" 
                                                                        value="F">Femenino</option>
                                                                <option data-icon="fa fa-male" 
                                                                        value="M">Masculino</option>
                                                            </select>
                                                        </div>    

                                                        <div class="col-sm-4">
                                                            <label>Password:</label>
                                                            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Password" autocomplete="off">
                                                        </div>
                                                    </div><!--FIN DE COL SM 12-->   

                                                    <div class="col-sm-12"><!--INICIO DE COL SM 12-->
                                                        <div class="col-sm-4">
                                                            <label>Email:</label>
                                                            <input type="text" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                                                        </div>  

                                                        <div class="col-sm-4">
                                                            <label>Fecha Nacimiento:</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar('#txt_fecha_nacimiento','');"><i class="fa fa-eraser"></i></div>
                                                                <input type="text" class="form-control fecha" id="txt_fecha_nacimiento" name="txt_fecha_nacimiento" placeholder="AAAA-MM-DD" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Estado Civil:</label>
                                                            <select class="form-control selectpicker show-menu-arrow" name="slct_estado_civil" id="slct_estado_civil">
                                                                <option  value='S'>Soltero(a)</option>
                                                                <option  value='C'>Casado(a)</option>
                                                                <option  value='D'>Divorsiado(a)</option>
                                                                <option  value='V'>Viudo(a)</option>
                                                            </select>
                                                        </div>
                                                    </div><!--FIN DE COL SM 12-->

                                                    <div class="col-sm-12"><!--INICIO DE COL SM 12-->
                                                        <div class="col-sm-4">
                                                            <label>Teléfono:</label>
                                                            <textarea cols="3" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Teléfono"></textarea>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Celular:</label>
                                                            <textarea cols="3" class="form-control" id="txt_celular" name="txt_celular" placeholder="Celular"></textarea>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Estado:</label>
                                                            <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                                                <option  value='0'>Inactivo</option>
                                                                <option  value='1'>Activo</option>
                                                            </select>
                                                        </div>
                                                    </div><!--FIN DE COL SM 12-->

                                                    <div class="col-sm-12"><!--INICIO DE COL SM 12-->
                                                        <div class="col-sm-4">
                                                            <label>Foto</label>
                                                            <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                                                            <input type="text" class="mant" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                                                            <label class="btn btn-default btn-flat margin btn-xs">
                                                                <i class="fa fa-file-image-o fa-5x"></i>
                                                                <input type="file" class="mant" style="display: none;" onchange="onImagen(event);" >
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <img class="img-circle" style="height: 200px;width: 100%;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px"> 
                                                            </div>
                                                        </div>
                                                    </div><!--FIN DE COL SM 12-->

                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="MPdatoadicional" class="tab-pane animated zoomInLeft">
                                    <div class="tab-ctn">
                                        <div class="modal-header btn-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Datos Adicionales</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row form-group">
                                                <div class="col-sm-12"> <!--INICIO DE COL SM 12-->
                                                    <div class="col-sm-4">
                                                        <label>Pais Nacimiento:</label>
                                                        <input type="hidden" class="mant" id="txt_pais_id" name="txt_pais_id">
                                                        <input type="text" class="form-control" onblur="LimpiarPersonaModal('txt_pais_id');" id="txt_pais" placeholder="Pais">
                                                    </div>
                                                    <div class="col-sm-8 paisafectado">
                                                        <label>Colegio:</label>
                                                        <input type="hidden" class="mant" id="txt_colegio_id" name="txt_colegio_id">
                                                        <input type="text" class="form-control" onblur="LimpiarPersonaModal('txt_colegio_id');" id="txt_colegio" placeholder="Colegio">
                                                    </div>
                                                </div> <!--FIN DE COL SM 12-->
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6 paisafectado">
                                                        <label>Distrito Nacimiento:</label>
                                                        <input type="hidden" class="mant" id="txt_distrito_id" name="txt_distrito_id">
                                                        <input type="hidden" class="mant" id="txt_provincia_id" name="txt_provincia_id">
                                                        <input type="hidden" class="mant" id="txt_region_id" name="txt_region_id">
                                                        <input type="text" class="form-control" onblur="LimpiarPersonaModal('txt_distrito_id,#txt_provincia_id,#txt_region_id,#txt_provincia,#txt_region');" id="txt_distrito" placeholder="Distrito Nacimiento">
                                                    </div>
                                                    <div class="col-sm-3 paisafectado2">
                                                        <label>Provincia:</label>
                                                        <input type="text" disabled class="form-control" id="txt_provincia" placeholder="Provincia">
                                                    </div>
                                                    <div class="col-sm-3 paisafectado2">
                                                        <label>Región:</label>
                                                        <input type="text" disabled class="form-control" id="txt_region" placeholder="Región">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <label>Distrito Dirección:</label>
                                                        <input type="hidden" class="mant" id="txt_distrito_id_dir" name="txt_distrito_id_dir">
                                                        <input type="hidden" class="mant" id="txt_provincia_id_dir" name="txt_provincia_id_dir">
                                                        <input type="hidden" class="mant" id="txt_region_id_dir" name="txt_region_id_dir">
                                                        <input type="text" class="form-control" onblur="LimpiarPersonaModal('txt_distrito_id_dir,#txt_provincia_id_dir,#txt_region_id_dir,#txt_provincia_dir,#txt_region_dir');" id="txt_distrito_dir" placeholder="Distrito Dirección">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Provincia:</label>
                                                        <input type="text" disabled class="form-control" id="txt_provincia_dir" placeholder="Provincia">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Región:</label>
                                                        <input type="text" disabled class="form-control" id="txt_region_dir" placeholder="Región">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Tenencia:</label>
                                                        <select class="form-control selectpicker show-menu-arrow" name="slct_tenencia" id="slct_tenencia">
                                                            <option  value='0'>Alquilado</option>
                                                            <option  value='1'>Propio</option>
                                                            <option  value='2'>Familiar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <label>Dirección:</label>
                                                        <textarea cols="3" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Dirección"></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Dirección Laboral:</label>
                                                        <textarea cols="3" class="form-control" id="txt_direccion_laboral" name="txt_direccion_laboral" placeholder="Dirección Laboral"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>Empresa Laboral:</label>
                                                        <textarea cols="3" class="form-control" id="txt_empresa_laboral" name="txt_empresa_laboral" placeholder="Empresa Laboral"></textarea>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Teléfono Laboral:</label>
                                                        <textarea cols="3" class="form-control" id="txt_telefono_laboral" name="txt_telefono_laboral" placeholder="Teléfono Laboral"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="MPnivelacceso" class="tab-pane animated zoomInLeft">
                                    <div class="tab-ctn">
                                        <div class="modal-header btn-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Nivel de Acceso</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row form-group">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Privilegios: </label>
                                                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_privilegios">
                                                                <option value="">.::Seleccione::.</option>
                                                            </select>
                                                            <select class="mant" id="slct_locales" style="display: none">
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <br>
                                                        <button type="button" class="btn btn-info" Onclick="AgregarPrivilegio();">
                                                            <i class="fa fa-plus fa-sm"></i>
                                                            &nbsp;Agregar
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="box-body no-padding table-responsive">
                                                        <table id="TablePrivilegio" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr class="cabecera">
                                                                    <th colspan="col-sm-2">
                                                                        <label><h4>Privilegio:</h4></label>
                                                                    </th>
                                                                    <th colspan="col-sm-9">
                                                                        <label><h4>Locales:</h4></label>
                                                                    </th>
                                                                    <th colspan="col-sm-1">
                                                                        <label><h4>[-]</h4></label>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
