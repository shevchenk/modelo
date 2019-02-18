<script type="text/javascript">
var AddEditPlanEstudioDetalle=0; //0: Editar | 1: Agregar
var PlanEstudioDetalleG={id:0,plan_estudio_id:"",modalidad:"",codigo:"",carrera:"",resolucion:"",fecha_resolucion:"",regimen_estudio:"",regimen_otro:"",periodo_academico:"",duracion:"",credito_teoria:"",credito_practica:""}; // Datos Globales

var CursoOpciones = {
    placeholder: 'Curso',
    url: "AjaxDinamic/PlanEstudio.CursoPE@ListCurso",
    listLocation: "data",
    getValue: "curso",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#PlanEstudioDetalleForm #txt_curso").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#PlanEstudioDetalleForm #txt_curso").getSelectedItemData().id;
            $("#PlanEstudioDetalleForm #txt_curso_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "codigo"
        }
    },
    adjustWidth:false,
};

$(document).ready(function() {
    AjaxPlanEstudioDetalle.CargarCiclo(SlctCargarCiclo);
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle #slct_ciclo_id_filtro").change( function(){ AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML); } );
});

VerPlanDetalle=function(id){
    PlanEstudioDetalleG.plan_estudio_id=id;
    PlanEstudioDetalleG.modalidad=$("#TablePlanEstudio #trid_"+id+" .modalidad").text();
    PlanEstudioDetalleG.codigo=$("#TablePlanEstudio #trid_"+id+" .carrera").text().split("|")[0];
    PlanEstudioDetalleG.carrera=$("#TablePlanEstudio #trid_"+id+" .carrera").text().split("|")[1];
    PlanEstudioDetalleG.resolucion=$("#TablePlanEstudio #trid_"+id+" .resolucion").text();
    PlanEstudioDetalleG.fecha_resolucion=$("#TablePlanEstudio #trid_"+id+" .fecha_resolucion").text();
    PlanEstudioDetalleG.regimen_estudio=$("#TablePlanEstudio #trid_"+id+" .regimen_estudio").val();
    PlanEstudioDetalleG.regimen_otro=$("#TablePlanEstudio #trid_"+id+" .regimen_otro").val();
    PlanEstudioDetalleG.periodo_academico=$("#TablePlanEstudio #trid_"+id+" .periodo_academico").val();
    PlanEstudioDetalleG.duracion=$("#TablePlanEstudio #trid_"+id+" .duracion").val();
    PlanEstudioDetalleG.credito_teoria=$("#TablePlanEstudio #trid_"+id+" .credito_teoria").val();
    PlanEstudioDetalleG.credito_practica=$("#TablePlanEstudio #trid_"+id+" .credito_practica").val();
    PlanEstudioDetalleG.regimen_estudio=$("#ModalPlanEstudioForm #slct_regimen_estudio option[value='"+PlanEstudioDetalleG.regimen_estudio+"']").text();

    $("#PlanEstudioDetalleForm #txt_plan_estudio_id").val(PlanEstudioDetalleG.plan_estudio_id);
    $("#PlanEstudioDetalleForm #txt_modalidad").val(PlanEstudioDetalleG.modalidad);
    $("#PlanEstudioDetalleForm #txt_codigo").val(PlanEstudioDetalleG.codigo);
    $("#PlanEstudioDetalleForm #txt_carrera").val(PlanEstudioDetalleG.carrera);
    $("#PlanEstudioDetalleForm #txt_resolucion").val(PlanEstudioDetalleG.resolucion);
    $("#PlanEstudioDetalleForm #txt_fecha_resolucion").val(PlanEstudioDetalleG.fecha_resolucion);
    $("#PlanEstudioDetalleForm #txt_regimen_estudio").val(PlanEstudioDetalleG.regimen_estudio);
    $("#PlanEstudioDetalleForm #txt_regimen_otro").val(PlanEstudioDetalleG.regimen_otro);
    $("#PlanEstudioDetalleForm #txt_periodo_academico").val(PlanEstudioDetalleG.periodo_academico);
    $("#PlanEstudioDetalleForm #txt_duracion").val(PlanEstudioDetalleG.duracion);
    $("#PlanEstudioDetalleForm #txt_credito_teoria").val(PlanEstudioDetalleG.credito_teoria);
    $("#PlanEstudioDetalleForm #txt_credito_practica").val(PlanEstudioDetalleG.credito_practica);

    AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML);
    AjaxPlanEstudioDetalle.CargarResumen(CargarResumenPlanEstudioHTML);
    $(".nav.nav-tabs [href='#MPPlanEstudioDetalle']").click();
}

SlctCargarCiclo=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.id+"</option>";
    });
    $("#PlanEstudioDetalleForm #slct_ciclo_id_nro").html(html);
    $("#PlanEstudioDetalleForm #slct_ciclo_id_filtro").html("<option value=''>.::Todo::.</option>"+html);
}

AgregarPlantillaCurricular=function(){
    $("#PlanEstudioDetalleForm .btnplandetalle2").removeAttr("disabled");
    $("#PlanEstudioDetalleForm .btnplandetalle").attr("disabled","true");
    var html= $("#PlanEstudioDetalleForm #PlantillaCurricular tbody").html().split("_nro").join("");
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody").append(html);
    $("#PlanEstudioDetalleForm #txt_curso").easyAutocomplete(CursoOpciones);

    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle input[type='number']").keyup(CalcularCreditos);
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle input[type='number']").change(CalcularCreditos);
}

AgregarPlantillaCurricularId=function(id){
    $("#PlanEstudioDetalleForm .btnplandetalle2_"+id).show();
    $("#PlanEstudioDetalleForm .btnplandetalle_"+id).hide();
    $("#PlanEstudioDetalleForm .btnplandetalle2,#PlanEstudioDetalleForm .btnplandetalle").hide();

    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+id+" select,#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+id+" input").removeAttr('disabled');
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+id+" input[type='number']").keyup( function(){ CalcularCreditosId(id); });
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+id+" input[type='number']").change( function(){ CalcularCreditosId(id); });
}

CalcularCreditos=function(){
    PlanEstudioDetalleG.hora_teoria_presencial=$("#PlanEstudioDetalleForm #txt_hora_teoria_presencial").val();
    PlanEstudioDetalleG.hora_teoria_virtual=$("#PlanEstudioDetalleForm #txt_hora_teoria_virtual").val();
    PlanEstudioDetalleG.hora_teoria_total=PlanEstudioDetalleG.hora_teoria_presencial*1 + PlanEstudioDetalleG.hora_teoria_virtual*1;
    PlanEstudioDetalleG.hora_practica_presencial=$("#PlanEstudioDetalleForm #txt_hora_practica_presencial").val();
    PlanEstudioDetalleG.hora_practica_virtual=$("#PlanEstudioDetalleForm #txt_hora_practica_virtual").val();
    PlanEstudioDetalleG.hora_practica_total=PlanEstudioDetalleG.hora_practica_presencial*1 + PlanEstudioDetalleG.hora_practica_virtual*1;
    PlanEstudioDetalleG.hora_total=PlanEstudioDetalleG.hora_teoria_total*1 + PlanEstudioDetalleG.hora_practica_total*1;

    PlanEstudioDetalleG.credito_teoria_presencial=( (PlanEstudioDetalleG.hora_teoria_presencial*1) / (PlanEstudioDetalleG.credito_teoria*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_teoria_virtual=( (PlanEstudioDetalleG.hora_teoria_virtual*1) / (PlanEstudioDetalleG.credito_teoria*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_teoria_total=(PlanEstudioDetalleG.credito_teoria_presencial*1 + PlanEstudioDetalleG.credito_teoria_virtual*1).toFixed(2);
    PlanEstudioDetalleG.credito_practica_presencial=( (PlanEstudioDetalleG.hora_practica_presencial*1) / (PlanEstudioDetalleG.credito_practica*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_practica_virtual=( (PlanEstudioDetalleG.hora_practica_virtual*1) / (PlanEstudioDetalleG.credito_practica*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_practica_total=(PlanEstudioDetalleG.credito_practica_presencial*1 + PlanEstudioDetalleG.credito_practica_virtual*1).toFixed(2);
    PlanEstudioDetalleG.credito_total= (PlanEstudioDetalleG.credito_teoria_total*1 + PlanEstudioDetalleG.credito_practica_total*1).toFixed(2);

    $("#PlanEstudioDetalleForm #txt_hora_teoria_total").val(PlanEstudioDetalleG.hora_teoria_total);
    $("#PlanEstudioDetalleForm #txt_hora_practica_total").val(PlanEstudioDetalleG.hora_practica_total);
    $("#PlanEstudioDetalleForm #txt_hora_total").val(PlanEstudioDetalleG.hora_total);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_presencial").val(PlanEstudioDetalleG.credito_teoria_presencial);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_virtual").val(PlanEstudioDetalleG.credito_teoria_virtual);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_total").val(PlanEstudioDetalleG.credito_teoria_total);
    $("#PlanEstudioDetalleForm #txt_credito_practica_presencial").val(PlanEstudioDetalleG.credito_practica_presencial);
    $("#PlanEstudioDetalleForm #txt_credito_practica_virtual").val(PlanEstudioDetalleG.credito_practica_virtual);
    $("#PlanEstudioDetalleForm #txt_credito_practica_total").val(PlanEstudioDetalleG.credito_practica_total);
    $("#PlanEstudioDetalleForm #txt_credito_total").val(PlanEstudioDetalleG.credito_total);
    $("#PlanEstudioDetalleForm #txt_credito_total").parent('td').removeClass('danger');
    var aux_credito_total=(PlanEstudioDetalleG.credito_total*1).toFixed(0);
    if( PlanEstudioDetalleG.credito_total*1 != aux_credito_total*1 ){
        $("#PlanEstudioDetalleForm #txt_credito_total").parent('td').addClass('danger');
    }
}

CalcularCreditosId=function(id){
    PlanEstudioDetalleG.hora_teoria_presencial=$("#PlanEstudioDetalleForm #txt_hora_teoria_presencial"+id).val();
    PlanEstudioDetalleG.hora_teoria_virtual=$("#PlanEstudioDetalleForm #txt_hora_teoria_virtual"+id).val();
    PlanEstudioDetalleG.hora_teoria_total=PlanEstudioDetalleG.hora_teoria_presencial*1 + PlanEstudioDetalleG.hora_teoria_virtual*1;
    PlanEstudioDetalleG.hora_practica_presencial=$("#PlanEstudioDetalleForm #txt_hora_practica_presencial"+id).val();
    PlanEstudioDetalleG.hora_practica_virtual=$("#PlanEstudioDetalleForm #txt_hora_practica_virtual"+id).val();
    PlanEstudioDetalleG.hora_practica_total=PlanEstudioDetalleG.hora_practica_presencial*1 + PlanEstudioDetalleG.hora_practica_virtual*1;
    PlanEstudioDetalleG.hora_total=PlanEstudioDetalleG.hora_teoria_total*1 + PlanEstudioDetalleG.hora_practica_total*1;

    PlanEstudioDetalleG.credito_teoria_presencial=( (PlanEstudioDetalleG.hora_teoria_presencial*1) / (PlanEstudioDetalleG.credito_teoria*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_teoria_virtual=( (PlanEstudioDetalleG.hora_teoria_virtual*1) / (PlanEstudioDetalleG.credito_teoria*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_teoria_total=(PlanEstudioDetalleG.credito_teoria_presencial*1 + PlanEstudioDetalleG.credito_teoria_virtual*1).toFixed(2);
    PlanEstudioDetalleG.credito_practica_presencial=( (PlanEstudioDetalleG.hora_practica_presencial*1) / (PlanEstudioDetalleG.credito_practica*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_practica_virtual=( (PlanEstudioDetalleG.hora_practica_virtual*1) / (PlanEstudioDetalleG.credito_practica*1) ).toFixed(2);
    PlanEstudioDetalleG.credito_practica_total=(PlanEstudioDetalleG.credito_practica_presencial*1 + PlanEstudioDetalleG.credito_practica_virtual*1).toFixed(2);
    PlanEstudioDetalleG.credito_total= (PlanEstudioDetalleG.credito_teoria_total*1 + PlanEstudioDetalleG.credito_practica_total*1).toFixed(2);

    $("#PlanEstudioDetalleForm #txt_hora_teoria_total"+id).val(PlanEstudioDetalleG.hora_teoria_total);
    $("#PlanEstudioDetalleForm #txt_hora_practica_total"+id).val(PlanEstudioDetalleG.hora_practica_total);
    $("#PlanEstudioDetalleForm #txt_hora_total"+id).val(PlanEstudioDetalleG.hora_total);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_presencial"+id).val(PlanEstudioDetalleG.credito_teoria_presencial);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_virtual"+id).val(PlanEstudioDetalleG.credito_teoria_virtual);
    $("#PlanEstudioDetalleForm #txt_credito_teoria_total"+id).val(PlanEstudioDetalleG.credito_teoria_total);
    $("#PlanEstudioDetalleForm #txt_credito_practica_presencial"+id).val(PlanEstudioDetalleG.credito_practica_presencial);
    $("#PlanEstudioDetalleForm #txt_credito_practica_virtual"+id).val(PlanEstudioDetalleG.credito_practica_virtual);
    $("#PlanEstudioDetalleForm #txt_credito_practica_total"+id).val(PlanEstudioDetalleG.credito_practica_total);
    $("#PlanEstudioDetalleForm #txt_credito_total"+id).val(PlanEstudioDetalleG.credito_total);
    $("#PlanEstudioDetalleForm #txt_credito_total"+id).parent('td').removeClass('danger');
    var aux_credito_total=(PlanEstudioDetalleG.credito_total*1).toFixed(0);
    if( PlanEstudioDetalleG.credito_total*1 != aux_credito_total*1 ){
        $("#PlanEstudioDetalleForm #txt_credito_total"+id).parent('td').addClass('danger');
    }
}

CancelarPlantillaCurricular=function(){
    $("#PlanEstudioDetalleForm .btnplandetalle2").attr("disabled","true");
    $("#PlanEstudioDetalleForm .btnplandetalle").removeAttr("disabled");
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody tr:last-child").remove();
}

CancelarPlantillaCurricularId=function(){
    AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML);
    $("#PlanEstudioDetalleForm .btnplandetalle2").attr("disabled","true");
    $("#PlanEstudioDetalleForm .btnplandetalle").removeAttr("disabled");
    $("#PlanEstudioDetalleForm .btnplandetalle2,#PlanEstudioDetalleForm .btnplandetalle").show();
}

GuardarPlantillaCurricular=function(){
    if( $.trim($("#PlanEstudioDetalleForm #txt_curso").val())=='' ){
        msjG.mensaje('warning','Busque y Seleccione Curso',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_teoria_presencial").val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Teoria Presencial',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_teoria_virtual").val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Teoria Virtual',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_practica_presencial").val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Practica Presencial',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_practica_virtual").val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Practica Virtual',4000);
    }
    else if( $("#PlanEstudioDetalleForm #txt_credito_total").parent('td').attr('class') != 'centrar' ){
        msjG.mensaje('warning','El total de créditos no es un número entero',4000);
    }
    else{
        AjaxPlanEstudioDetalle.Guardar(GuardarPlanEstudioDetalleHTML);
    }
}

GuardarPlantillaCurricularId=function(id){
    if( $.trim($("#PlanEstudioDetalleForm #txt_curso"+id).val())=='' ){
        msjG.mensaje('warning','Busque y Seleccione Curso',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_teoria_presencial"+id).val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Teoria Presencial',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_teoria_virtual"+id).val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Teoria Virtual',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_practica_presencial"+id).val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Practica Presencial',4000);
    }
    else if( $.trim($("#PlanEstudioDetalleForm #txt_hora_practica_virtual"+id).val())=='' ){
        msjG.mensaje('warning','Ingrese N° Horas de Practica Virtual',4000);
    }
    else if( $("#PlanEstudioDetalleForm #txt_credito_total"+id).parent('td').attr('class') != 'centrar' ){
        msjG.mensaje('warning','El total de créditos no es un número entero',4000);
    }
    else{
        AjaxPlanEstudioDetalle.Actualizar( GuardarPlanEstudioDetalleHTMLId,id );
    }
}

GuardarPlanEstudioDetalleHTML=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
        $("#PlanEstudioDetalleForm .btnplandetalle2").attr("disabled","true");
        $("#PlanEstudioDetalleForm .btnplandetalle").removeAttr("disabled");
        AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML);
        AjaxPlanEstudioDetalle.CargarResumen(CargarResumenPlanEstudioHTML);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

GuardarPlanEstudioDetalleHTMLId=function(result){
    AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML);
    AjaxPlanEstudioDetalle.CargarResumen(CargarResumenPlanEstudioHTML);
    $("#PlanEstudioDetalleForm .btnplandetalle2").attr("disabled","true");
    $("#PlanEstudioDetalleForm .btnplandetalle").removeAttr("disabled");
    $("#PlanEstudioDetalleForm .btnplandetalle2,#PlanEstudioDetalleForm .btnplandetalle").show();

    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

EliminarPlantillaCurricularId=function(id){
    sweetalertG.confirm('Plan Estudio Detalle','Desea eliminar Curso: '+$("#PlanEstudioDetalleForm #TablePlanEstudioDetalle #txt_curso"+id).val(), function(){ AjaxPlanEstudioDetalle.Eliminar(EliminarPlanEstudioDetalleHTML,id); });
}

EliminarPlanEstudioDetalleHTML=function(result){
    AjaxPlanEstudioDetalle.Cargar(CargarPlanEstudioDetalleHTML);
    AjaxPlanEstudioDetalle.CargarResumen(CargarResumenPlanEstudioHTML);
    $("#PlanEstudioDetalleForm .btnplandetalle2").attr("disabled","true");
    $("#PlanEstudioDetalleForm .btnplandetalle").removeAttr("disabled");
    $("#PlanEstudioDetalleForm .btnplandetalle2,#PlanEstudioDetalleForm .btnplandetalle").show();
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

CargarPlanEstudioDetalleHTML=function(result){
    var html='';
    $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody").html(html);
    $.each(result.data,function(index,r){
        html='<tr id="trid_'+r.id+'">'+
                '<td class="centrar"> <div class="input-group">'+
                    '<button type="button" class="btn btn-danger btn-sm btnplandetalle_'+r.id+'" onclick="EliminarPlantillaCurricularId('+r.id+');">'+
                        '<i class="fa fa-trash-o fa-lg"></i>'+
                    '</button>'+
                    '<button type="button" class="btn btn-primary btn-sm btnplandetalle_'+r.id+'" onclick="AgregarPlantillaCurricularId('+r.id+');">'+
                        '<i class="fa fa-pencil-square-o fa-lg"></i>'+
                    '</button>'+
                    '<button type="button" style="display:none;" class="btn btn-warning btn-sm btnplandetalle2_'+r.id+'" onclick="CancelarPlantillaCurricularId();">'+
                        '<i class="fa fa-window-close-o fa-lg"></i>'+
                    '</button>'+
                    '<button type="button" style="display:none;" class="btn btn-success btn-sm btnplandetalle2_'+r.id+'" onclick="GuardarPlantillaCurricularId('+r.id+');">'+
                        '<i class="fa fa-check fa-lg"></i>'+
                    '</button>'+
                    '<select style="width:80px !important;" id="slct_ciclo_id'+r.id+'" name="slct_ciclo_id'+r.id+'">'+
                    $("#PlanEstudioDetalleForm #PlantillaCurricular #slct_ciclo_id_nro").html()+
                    '</select></div>'+
                '</td>'+
                '<td>'+
                    '<input type="hidden" class="mant" id="txt_curso_id'+r.id+'" name="txt_curso_id'+r.id+'" value="'+r.curso_id+'">'+
                    '<textarea class="form-control" style="width:200px !important;" type="text" onblur="masterG.Limpiar(\'#txt_curso_id'+r.id+'\',this.value);" rows="1" id="txt_curso'+r.id+'" placeholder="Curso" readonly>'+
                    r.curso+
                    '</textarea>'+
                '</td>'+
                '<td><select style="width:120px !important;" id="slct_tipo_estudio'+r.id+'" name="slct_tipo_estudio'+r.id+'">'+
                        '<option value="1">General</option>'+
                        '<option value="2">Específico</option>'+
                        '<option value="3">Especialidad</option>'+
                    '</select>'+
                '</td>'+
                '<td><select style="width:100px !important;" id="slct_tipo_curso'+r.id+'" name="slct_tipo_curso'+r.id+'">'+
                        '<option value="1">Obligatorio</option>'+
                        '<option value="0">Electivo</option>'+
                    '</select>'+
                '</td>'+

                '<td class="centrar">'+
                    '<input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_teoria_presencial'+r.id+'" name="txt_hora_teoria_presencial'+r.id+'" placeholder="0" value="'+r.hora_teoria_presencial+'">'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_teoria_virtual'+r.id+'" name="txt_hora_teoria_virtual'+r.id+'" placeholder="0" value="'+r.hora_teoria_virtual+'">'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:50px !important;" type="text" class="form-control" id="txt_hora_teoria_total'+r.id+'" name="txt_hora_teoria_total'+r.id+'" placeholder="0" value="'+r.hora_teoria_total+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_practica_presencial'+r.id+'" name="txt_hora_practica_presencial'+r.id+'" placeholder="0" value="'+r.hora_practica_presencial+'">'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:65px !important;" type="number" onkeypress="return masterG.validaNumeros(event, this);" id="txt_hora_practica_virtual'+r.id+'" name="txt_hora_practica_virtual'+r.id+'" placeholder="0" value="'+r.hora_practica_virtual+'">'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:50px !important;" type="text" class="form-control" id="txt_hora_practica_total'+r.id+'" name="txt_hora_practica_total'+r.id+'" placeholder="0" value="'+r.hora_practica_total+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:50px !important;" type="text" class="form-control" id="txt_hora_total'+r.id+'" name="txt_hora_total'+r.id+'" placeholder="0" value="'+r.hora_total+'" readonly>'+
                '</td>'+


                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_presencial'+r.id+'" name="txt_credito_teoria_presencial'+r.id+'" placeholder="0" value="'+r.credito_teoria_presencial+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_virtual'+r.id+'" name="txt_credito_teoria_virtual'+r.id+'" placeholder="0" value="'+r.credito_teoria_virtual+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_teoria_total'+r.id+'" name="txt_credito_teoria_total'+r.id+'" placeholder="0" value="'+r.credito_teoria_total+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_presencial'+r.id+'" name="txt_credito_practica_presencial'+r.id+'" placeholder="0" value="'+r.credito_practica_presencial+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_virtual'+r.id+'" name="txt_credito_practica_virtual'+r.id+'" placeholder="0" value="'+r.credito_practica_virtual+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_practica_total'+r.id+'" name="txt_credito_practica_total'+r.id+'" placeholder="0" value="'+r.credito_practica_total+'" readonly>'+
                '</td>'+
                '<td class="centrar">'+
                    '<input style="width:60px !important;" type="text" class="form-control" id="txt_credito_total'+r.id+'" name="txt_credito_total'+r.id+'" placeholder="0" value="'+r.credito_total+'" readonly>'+
                '</td>'+
            '</tr>';
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody").append(html);
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #slct_ciclo_id"+r.id).val(r.ciclo_id);
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #slct_tipo_estudio"+r.id).val(r.tipo_estudio);
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #slct_tipo_curso"+r.id).val(r.tipo_curso);
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+r.id+" select,#PlanEstudioDetalleForm #TablePlanEstudioDetalle tbody #trid_"+r.id+" input").attr('disabled','true');
    });
}

CargarResumenPlanEstudioHTML=function(result){
    var html=''; var hora_total=0; var credito_total=0; var hora_per=0; var credito_per=0;
    $("#PlanEstudioDetalleForm #TablePlanEstudioResumen .pplantilla label").text('0');
    $("#PlanEstudioDetalleForm #TablePlanEstudioResumen .dec label").text('0.00');
    $("#PlanEstudioDetalleForm #TablePlanEstudioResumen .per label").text('0.00%');
    $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #mcredito_per1").parent('td').parent('tr').removeClass('success').addClass('danger');
    $.each(result.data,function(index,r){
        if( r.ini=='t' && r.fin=='t' ){
            hora_total=r.hora_total*1;
            credito_total=r.credito_total*1;
        }
        
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"curso"+r.fin).text(r.curso);
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"hora_teoria"+r.fin).text(r.hora_teoria);
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"hora_practica"+r.fin).text(r.hora_practica);
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"hora_total"+r.fin).text(r.hora_total);
        hora_per=( (r.hora_total*1)/hora_total )*100;
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"hora_per"+r.fin).text( hora_per.toFixed(2)+'%' );
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"credito_teoria"+r.fin).text(r.credito_teoria);
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"credito_practica"+r.fin).text(r.credito_practica);
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"credito_total"+r.fin).text(r.credito_total);
        credito_per=( (r.credito_total*1)/credito_total )*100;
        $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"credito_per"+r.fin).text( credito_per.toFixed(2)+'%' );
        
        if( r.ini=='m' && r.fin=='1'){
            if( credito_per.toFixed(2)*1>=50 ){
                $("#PlanEstudioDetalleForm #TablePlanEstudioResumen #"+r.ini+"credito_per"+r.fin).parent('td').parent('tr').removeClass('danger').addClass('success');
            }
        }
    });
}
</script>
