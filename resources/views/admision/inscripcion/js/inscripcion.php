<script type="text/javascript">
var InscripcionG={};

$(document).ready(function() {
    $("#InscripcionForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });
    AjaxInscripcion.CargarLocal(HTMLCargarLocal);
    AjaxInscripcion.CargarModalidad(HTMLCargarModalidad);
    $("#InscripcionForm #txt_inscrito").easyAutocomplete(PersonaOpciones);
});

HTMLCargarLocal = function(result){
    var html='';
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe, #InscripcionForm #slct_local_estudio_id").html(html);
    html='<option value="">.::Seleccione::.</option>';
    $.each(result.data,function(index,r){
        html+="<option data-subtext='"+r.codigo+"' value="+r.id+">"+r.local+"</option>";
    });
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe, #InscripcionForm #slct_local_estudio_id").html(html);
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe, #InscripcionForm #slct_local_estudio_id").selectpicker('refresh');
}

HTMLCargarModalidad = function(result){
    var html='';
    $("#InscripcionForm #slct_modalidad_id").html(html);
    html='<option value="">.::Seleccione::.</option>';
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.modalidad+"</option>";
    });
    $("#InscripcionForm #slct_modalidad_id").html(html);
    $("#InscripcionForm #slct_modalidad_id").selectpicker('refresh');
}

HTMLPersonaAdicional = function(result){
    var estado_civil='';
    if( $.trim(result.data.estado_civil)=='C' ){
        estado_civil='Casado';
    }
    else if( $.trim(result.data.estado_civil)=='D' ){
        estado_civil='Divorsiado';
    }
    else if( $.trim(result.data.estado_civil)=='S' ){
        estado_civil='Soltero';
    }
    else if( $.trim(result.data.estado_civil)=='V' ){
        estado_civil='Viudo';
    }

    var genero='Femenino';
    if( $.trim(result.data.sexo)=='M' ){
        genero='Masculino';
    }

    var edad=0; var fechahoy=''; var fechaayer='';
    if( $.trim(result.data.fecha_nacimiento)!='' ){
        fechahoy= new Date();
        fechaayer= new Date(result.data.fecha_nacimiento);
        fechaayer= new Date( fechaayer.getTime() + 1000*60*60*5 );
        edad= fechahoy.getFullYear() - fechaayer.getFullYear();

        if( fechaayer.getMonth()+1 > fechahoy.getMonth()+1 || 
            ( fechaayer.getMonth()+1 == fechahoy.getMonth()+1 && fechaayer.getDate() <= fechahoy.getDate() )
        ){
            edad--;
        }
    }

    var tipo='Nacional';
    if( $.trim(result.data.tipo)=='2' ){
        tipo='Particular';
    }


    $('#InscripcionForm #txt_estado_civil').val( estado_civil );
    $('#InscripcionForm #txt_genero').val( genero );
    $('#InscripcionForm #txt_edad').val( edad );
    $('#InscripcionForm #txt_fecha_nacimiento').val( $.trim(result.data.fecha_nacimiento) );
    $('#InscripcionForm #txt_direccion').val( $.trim(result.data.direccion) );
    $('#InscripcionForm #txt_tenencia').val( $.trim(result.data.tenencia) );
    $('#InscripcionForm #txt_empresa_laboral').val( $.trim(result.data.empresa_laboral) );
    $('#InscripcionForm #txt_direccion_laboral').val( $.trim(result.data.direccion_laboral) );
    $('#InscripcionForm #txt_telefono_laboral').val( $.trim(result.data.telefono_laboral) );

    $('#InscripcionForm #txt_pais').val( $.trim(result.data.pais) );
    $('#InscripcionForm #txt_colegio').val( $.trim(result.data.colegio) );
    $('#InscripcionForm #txt_region').val( $.trim(result.data.region) );
    $('#InscripcionForm #txt_provincia').val( $.trim(result.data.provincia) );
    $('#InscripcionForm #txt_distrito').val( $.trim(result.data.distrito) );
    $('#InscripcionForm #txt_region_dir').val( $.trim(result.data.region_dir) );
    $('#InscripcionForm #txt_provincia_dir').val( $.trim(result.data.provincia_dir) );
    $('#InscripcionForm #txt_distrito_dir').val( $.trim(result.data.distrito_dir) );
    $('#InscripcionForm #txt_region_col').val( $.trim(result.data.region_col) );
    $('#InscripcionForm #txt_provincia_col').val( $.trim(result.data.provincia_col) );
    $('#InscripcionForm #txt_distrito_col').val( $.trim(result.data.distrito_col) );
    $('#InscripcionForm #txt_tipo_colegio').val( tipo );
}

OpcionAcademica=function(){
    if( $('#slct_modalidad_id').val()=='' ){
        msjG.mensaje('warning','Seleccione Modalidad de Estudios para buscar grupos académicos',5000);
    }
    else if( $('#slct_local_estudio_id').val()=='' ){
        msjG.mensaje('warning','Seleccione Local de Estudios para buscar grupos académicos',5000);
    }
    else{
        $(".nav.nav-tabs [href='#TABGrupoAcademico']").click();
        $('#TableGrupoAcademico tbody').html('');
        $('#GrupoAcademicoFiltroForm #txt_plan_estudio_id, #GrupoAcademicoFiltroForm #txt_nro_plan_estudio, #GrupoAcademicoFiltroForm #txt_plan_estudio, #GrupoAcademicoFiltroForm #txt_carrera').val('');
        $("#GrupoAcademicoFiltroForm #txt_carrera_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        $("#GrupoAcademicoFiltroForm #txt_carrera").focus();
    }
}

ModalidadSeleccionada=function(){
    $('#txt_modalidad_estudio').val( $('#slct_modalidad_id option:selected').text() );
    $('#txt_modalidad_id').val( $('#slct_modalidad_id').val() );
}

LocalEstudioSeleccionada=function(){
    $('#txt_local_estudio_grupo').val( $('#slct_local_estudio_id option:selected').text() );
    $('#txt_local_estudio_id').val( $('#slct_local_estudio_id').val() );
}
</script>
