<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var PreguntaG={id:0,curso:"",curso_id:0,pregunta:'',tipo_pregunta:0,estado:1}; // Pregunta Globales
var CursoOpciones = {
    placeholder: 'Curso',
    url: "AjaxDinamic/Mantenimiento.LocalMA@ListLocal",
    listLocation: "data",
    getValue: "local",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_local_destino").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPreguntaForm #txt_local_destino").getSelectedItemData().id;
            var value2 = $("#ModalPreguntaForm #txt_local_destino").getSelectedItemData().codigo;
            $("#ModalPreguntaForm #txt_local_id_destino").val(value).trigger("change");
            $("#ModalPreguntaForm #txt_codigo_local_destino").val(value2).trigger("change");
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
    $("#ModalPreguntaForm #txt_curso").easyAutocomplete(CursoOpciones);
    $("#TablePregunta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    AjaxPregunta.Cargar(HTMLCargarPregunta);
    $("#PreguntaForm #TablePregunta select").change(function(){ AjaxPregunta.Cargar(HTMLCargarPregunta); });
    $("#PreguntaForm #TablePregunta input").blur(function(){ AjaxPregunta.Cargar(HTMLCargarPregunta); });

    $('#ModalPregunta').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalPreguntaForm").append("<input type='hidden' value='"+PreguntaG.id+"' name='id'>");
        }
        $('#ModalPreguntaForm #txt_curso').val( PreguntaG.curso );
        $('#ModalPreguntaForm #txt_curso_id').val( PreguntaG.curso_id );
        $('#ModalPreguntaForm #txt_pregunta').val( PreguntaG.pregunta );
        $('#ModalPreguntaForm #slct_tipo_pregunta').selectpicker('val', PreguntaG.tipo_pregunta );
        $('#ModalPreguntaForm #slct_estado').selectpicker( 'val',PreguntaG.estado );
        $('#ModalPreguntaForm #txt_pregunta').focus();
    });

    $('#ModalPregunta').on('hidden.bs.modal', function (event) {
        $("#ModalPreguntaForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm2=function(){
    var r=true;
    if( $.trim( $("#ModalPreguntaForm #txt_curso_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Curso',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #txt_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Pregunta',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #slct_tipo_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Pregunta',4000);
    }
//    else if( $.trim( $("#ModalPreguntaForm #txt_puntaje").val() )=='' ){
//        r=false;
//        msjG.mensaje('warning','Ingrese Puntaje',4000);
//    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    PreguntaG.id='';
    PreguntaG.curso='';
    PreguntaG.curso_id='';
    PreguntaG.pregunta='';
    PreguntaG.tipo_pregunta='';
    PreguntaG.estado='1';
    if( val==0 ){
        PreguntaG.id=id;
        PreguntaG.curso=$("#TablePregunta #trid_"+id+" .curso").text();
        PreguntaG.curso_id=$("#TablePregunta #trid_"+id+" .curso_id").val();
        PreguntaG.pregunta=$("#TablePregunta #trid_"+id+" .pregunta").text();
        PreguntaG.tipo_pregunta=$("#TablePregunta #trid_"+id+" .tipo_pregunta").val();
        PreguntaG.estado=$("#TablePregunta #trid_"+id+" .estado").val(); 
    }
    $('#ModalPregunta').modal('show');
}

CambiarEstado2=function(estado,id){
       AjaxPregunta.CambiarEstado(HTMLCambiarEstado2,estado,id);
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPregunta.Cargar(HTMLCargarPregunta);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxPregunta.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPregunta').modal('hide');
        AjaxPregunta.Cargar(HTMLCargarPregunta);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarPregunta=function(result){
    var html="";
    $('#TablePregunta').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+='<tr id="trid_'+r.id+'" onClick="CargarRespuesta('+r.id+',\''+r.pregunta+'\',this)">'+
            "<td class='curso'>"+r.curso+"</td>"+
            "<td class='pregunta'>"+r.pregunta+"</td>"+
            "<td class='tipo_pregunta_nombre'>"+r.tipo_pregunta_nombre+"</td>"+
            "<td>"+
            "<input type='hidden' class='curso_id' value='"+r.curso_id+"'>"+
            "<input type='hidden' class='pregunta' value='"+r.pregunta+"'>"+
            "<input type='hidden' class='tipo_pregunta' value='"+r.tipo_pregunta+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
  //      html+='<td><a class="btn btn-info btn-sm" onClick="CargarRespuesta('+r.id+',\''+r.pregunta+'\','+r.puntaje+',this)"><i class="fa fa-th-list fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TablePregunta tbody").html(html); 
    $("#TablePregunta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TablePregunta_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPregunta','AjaxPregunta',result.data,'#TablePregunta_paginate');
        }
        
    });
};
CargarRespuesta=function(id,pregunta,boton){   
      var tr = boton;
        var trs = tr.parentNode.children;
        for(var i =0;i<trs.length;i++)
            trs[i].style.backgroundColor="#f9f9f9";
        tr.style.backgroundColor = "#9CD9DE";
     $("#RespuestaForm #txt_pregunta_id").val(id);
     $("#ModalRespuestaForm #txt_pregunta_id").val(id);
     $("#ModalRespuestaForm #txt_pregunta").val(pregunta);
     AjaxRespuesta.Cargar(HTMLCargarRespuesta);
     $("#RespuestaForm").css("display","");
     
};
</script>
