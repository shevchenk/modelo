<script type="text/javascript">
var AddEditModalidadIngresoRequisito=0; //0: Editar | 1: Agregar
var ModalidadIngresoRequisitoG={id:0,modalidad_ingreso_id:"",modalidad_ingreso:"",tipo:""}; // Datos Globales

$(document).ready(function() {
});

VerModalidadIngresoRequisito =function(id){
    ModalidadIngresoRequisitoG.modalidad_ingreso_id=id;
    ModalidadIngresoRequisitoG.modalidad_ingreso=$("#TableModalidadIngreso #trid_"+id+" .modalidad_ingreso").text();
    ModalidadIngresoRequisitoG.tipo=$("#TableModalidadIngreso #trid_"+id+" .ttipo").text();
    
    $("#ModalidadIngresoRequisitoForm #txt_modalidad_ingreso_id").val(ModalidadIngresoRequisitoG.modalidad_ingreso_id);
    $("#ModalidadIngresoRequisitoForm #txt_modalidad_ingreso").val(ModalidadIngresoRequisitoG.modalidad_ingreso);
    $("#ModalidadIngresoRequisitoForm #txt_tipo").val(ModalidadIngresoRequisitoG.tipo);

    AjaxModalidadIngresoRequisito.Cargar(CargarModalidadIngresoRequisitoHTML);
    $(".nav.nav-tabs [href='#MPModalidadIngresoRequisito']").click();
}

AgregarModalidadIngresoRequisito=function(){
    $("#ModalidadIngresoRequisitoForm .btnplandetalle2").removeAttr("disabled");
    $("#ModalidadIngresoRequisitoForm .btnplandetalle").attr("disabled","true");
    var html=   "<tr>"+
                    "<td>&nbsp;</td>"+
                    "<td class='centrar'>"+
                        '<input type="text" class="form-control" id="txt_requisito" name="txt_requisito" placeholder="Requisito">'+
                    "</td>"+
                "</tr>";
    $("#ModalidadIngresoRequisitoForm #TableModalidadIngresoRequisito tbody").append(html);
}

CancelarModalidadIngresoRequisito=function(){
    $("#ModalidadIngresoRequisitoForm .btnplandetalle2").attr("disabled","true");
    $("#ModalidadIngresoRequisitoForm .btnplandetalle").removeAttr("disabled");
    $("#ModalidadIngresoRequisitoForm #TableModalidadIngresoRequisito tbody tr:last-child").remove();
}

GuardarModalidadIngresoRequisito=function(){
    if( $.trim($("#ModalidadIngresoRequisitoForm #txt_requisito").val())=='' ){
        msjG.mensaje('warning','Ingrese Requisito',4000);
    }
    else{
        AjaxModalidadIngresoRequisito.Guardar(GuardarModalidadIngresoRequisitoHTML);
    }
}

GuardarModalidadIngresoRequisitoHTML=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
        $("#ModalidadIngresoRequisitoForm .btnplandetalle2").attr("disabled","true");
        $("#ModalidadIngresoRequisitoForm .btnplandetalle").removeAttr("disabled");
        AjaxModalidadIngresoRequisito.Cargar(CargarModalidadIngresoRequisitoHTML);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

EliminarModalidadIngresoRequisitoId=function(id){
    sweetalertG.confirm('Modalidad de Ingreso:'+$("#ModalidadIngresoRequisitoForm #txt_modalidad_ingreso").val(),'Desea eliminar requisito: '+$("#ModalidadIngresoRequisitoForm #TableModalidadIngresoRequisito #txt_requisito"+id).val(), function(){ AjaxModalidadIngresoRequisito.Eliminar(EliminarModalidadIngresoRequisitoHTML,id); });
}

EliminarModalidadIngresoRequisitoHTML=function(result){
    AjaxModalidadIngresoRequisito.Cargar(CargarModalidadIngresoRequisitoHTML);
    $("#ModalidadIngresoRequisitoForm .btnplandetalle2").attr("disabled","true");
    $("#ModalidadIngresoRequisitoForm .btnplandetalle").removeAttr("disabled");
    $("#ModalidadIngresoRequisitoForm .btnplandetalle2,#ModalidadIngresoRequisitoForm .btnplandetalle").show();
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,5000);
    }
    else{
        msjG.mensaje('warning',result.msj,5000);
    }
}

CargarModalidadIngresoRequisitoHTML=function(result){
    var html='';
    $("#ModalidadIngresoRequisitoForm #TableModalidadIngresoRequisito tbody").html(html);
    $.each(result.data,function(index,r){
        html='<tr id="trid_'+r.id+'">'+
                '<td class="centrar">'+
                    '<button type="button" class="btn btn-danger btn-sm btnplandetalle_'+r.id+'" onclick="EliminarModalidadIngresoRequisitoId('+r.id+');">'+
                        ''+(index+1)+'<i class="fa fa-trash-o fa-lg"></i>'+
                    '</button>&nbsp;&nbsp;&nbsp;&nbsp;'+
                '</td>'+
                '<td>'+
                    '<input type="text" class="form-control" id="txt_requisito'+r.id+'" name="txt_requisito'+r.id+'" value="'+r.requisito+'" readonly>'+
                '</td>'+
            '</tr>';
        $("#ModalidadIngresoRequisitoForm #TableModalidadIngresoRequisito tbody").append(html);
    });
}

</script>
