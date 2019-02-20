<script type="text/javascript">
var AddEditSemestreProgramacion=0; //0: Editar | 1: Agregar
var SemestreProgramacionG={id:0,semestre_id:"",semestre:"",fecha_inicio:"",fecha_final:""}; // Datos Globales

$(document).ready(function() {
});

VerSemestreProgramacion =function(id){
    SemestreProgramacionG.semestre_id=id;
    SemestreProgramacionG.semestre=$("#TableSemestre #trid_"+id+" .semestre").text();
    SemestreProgramacionG.fecha_inicio=$("#TableSemestre #trid_"+id+" .fecha_inicio").text();
    SemestreProgramacionG.fecha_final=$("#TableSemestre #trid_"+id+" .fecha_final").text();
    
    $("#SemestreProgramacionForm #txt_semestre_id").val(SemestreProgramacionG.semestre_id);
    $("#SemestreProgramacionForm #txt_semestre").val(SemestreProgramacionG.semestre);
    $("#SemestreProgramacionForm #txt_fecha_inicio").val(SemestreProgramacionG.fecha_inicio);
    $("#SemestreProgramacionForm #txt_fecha_final").val(SemestreProgramacionG.fecha_final);

    AjaxSemestreProgramacion.Cargar(CargarSemestreProgramacionHTML);
    $(".nav.nav-tabs [href='#MPSemestreProgramacion']").click();
}

AgregarSemestreProgramacion=function(){
    $("#SemestreProgramacionForm .btnplandetalle2").removeAttr("disabled");
    $("#SemestreProgramacionForm .btnplandetalle").attr("disabled","true");
    var html=   "<tr>"+
                    "<td>&nbsp;</td>"+
                    "<td class='centrar'><div class='input-group'>"+
                        '<div class="input-group-addon btn btn-warning" onclick="masterG.Limpiar(\'#ModalSemestreForm #txt_fecha_final\',\'\');"><i class="fa fa-eraser"></i></div>'+
                        '<input type="text" class="form-control fecha" id="txt_fecha" name="txt_fecha" placeholder="AAAA-MM-DD" readonly=""></div>'+
                    "</td>"+
                "</tr>";
    $("#SemestreProgramacionForm #TableSemestreProgramacion tbody").append(html);
    $("#SemestreProgramacionForm #TableSemestreProgramacion .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    })
}

CancelarSemestreProgramacion=function(){
    $("#SemestreProgramacionForm .btnplandetalle2").attr("disabled","true");
    $("#SemestreProgramacionForm .btnplandetalle").removeAttr("disabled");
    $("#SemestreProgramacionForm #TableSemestreProgramacion tbody tr:last-child").remove();
}

GuardarSemestreProgramacion=function(){
    if( $.trim($("#SemestreProgramacionForm #txt_fecha").val())=='' ){
        msjG.mensaje('warning','Ingrese la Fecha',4000);
    }
    else{
        AjaxSemestreProgramacion.Guardar(GuardarSemestreProgramacionHTML);
    }
}

GuardarSemestreProgramacionHTML=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
        $("#SemestreProgramacionForm .btnplandetalle2").attr("disabled","true");
        $("#SemestreProgramacionForm .btnplandetalle").removeAttr("disabled");
        AjaxSemestreProgramacion.Cargar(CargarSemestreProgramacionHTML);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

EliminarSemestreProgramacionId=function(id){
    sweetalertG.confirm('Fecha Programada','Desea eliminar fecha: '+$("#SemestreProgramacionForm #TableSemestreProgramacion #txt_fecha"+id).val(), function(){ AjaxSemestreProgramacion.Eliminar(EliminarSemestreProgramacionHTML,id); });
}

EliminarSemestreProgramacionHTML=function(result){
    AjaxSemestreProgramacion.Cargar(CargarSemestreProgramacionHTML);
    $("#SemestreProgramacionForm .btnplandetalle2").attr("disabled","true");
    $("#SemestreProgramacionForm .btnplandetalle").removeAttr("disabled");
    $("#SemestreProgramacionForm .btnplandetalle2,#SemestreProgramacionForm .btnplandetalle").show();
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

CargarSemestreProgramacionHTML=function(result){
    var html='';
    $("#SemestreProgramacionForm #TableSemestreProgramacion tbody").html(html);
    $.each(result.data,function(index,r){
        html='<tr id="trid_'+r.id+'">'+
                '<td class="centrar">'+
                    '<button type="button" class="btn btn-danger btn-sm btnplandetalle_'+r.id+'" onclick="EliminarSemestreProgramacionId('+r.id+');">'+
                        '<i class="fa fa-trash-o fa-lg"></i>'+
                    '</button>&nbsp;&nbsp;&nbsp;&nbsp;'+
                    '<span><h2>'+(index+1)+'</h2></span>'+
                '</td>'+
                '<td>'+
                    '<input type="text" class="form-control" id="txt_fecha'+r.id+'" name="txt_fecha'+r.id+'" value="'+r.fecha+'" readonly>'+
                '</td>'+
            '</tr>';
        $("#SemestreProgramacionForm #TableSemestreProgramacion tbody").append(html);
    });
}

</script>
