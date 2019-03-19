<script type="text/javascript">
var Inscripcion={};

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
</script>
