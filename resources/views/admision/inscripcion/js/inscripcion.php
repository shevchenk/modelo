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
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe").html(html);
    html='<option value="">.::Seleccione::.</option>';
    $.each(result.data,function(index,r){
        html+="<option data-subtext='"+r.codigo+"' value="+r.id+">"+r.local+"</option>";
    });
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe").html(html);
    $("#InscripcionForm #slct_local_id_registro, #InscripcionForm #slct_local_id_informe").selectpicker('refresh');
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
}
</script>
