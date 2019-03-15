<script type="text/javascript">
var AddEditAmbiente=0; //0: Editar | 1: Agregar
var AmbienteG={id:0,ambiente:"",codigo:"",pabellon:"",pabellon_id:"",grado_academico:"",titulo_profesional:"",estado:1}; // Datos Globales
var PabellonOpciones = {
    placeholder: 'Pabellon',
    url: "AjaxDinamic/Mantenimiento.PabellonMA@ListPabellon",
    listLocation: "data",
    getValue: "pabellon",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if( r.rst==2 ){
                msjG.mensaje('warning','Busque y Seleccione Local',6000);
            }
            else if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalAmbienteForm #txt_pabellon").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalAmbienteForm #txt_pabellon").val();
        data.local_id = '';
        if( $("#ModalAmbienteForm #txt_local_ico").hasClass("has-success") ){
            data.local_id = $("#ModalAmbienteForm #txt_local_id").val();
        }
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalAmbienteForm #txt_pabellon").getSelectedItemData().id;
            $("#ModalAmbienteForm #txt_pabellon_id").val(value).trigger("change");
            $("#ModalAmbienteForm #txt_pabellon_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalAmbienteForm #txt_pabellon_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    adjustWidth:false,
};

var LocalOpciones = {
    placeholder: 'Local',
    url: "AjaxDinamic/Mantenimiento.LocalMA@ListLocal",
    listLocation: "data",
    getValue: "local",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalAmbienteForm #txt_local").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalAmbienteForm #txt_local").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalAmbienteForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalAmbienteForm #txt_local").getSelectedItemData().codigo;
            $("#ModalAmbienteForm #txt_local_id").val(value).trigger("change");
            $("#ModalAmbienteForm #txt_codigo_local").val(value2).trigger("change");
            $("#ModalAmbienteForm #txt_local_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalAmbienteForm #txt_local_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
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

    $("#TableAmbiente").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxAmbiente.Cargar(HTMLCargarAmbiente);
    $("#ModalAmbienteForm #txt_pabellon").easyAutocomplete(PabellonOpciones);
    $("#ModalAmbienteForm #txt_local").easyAutocomplete(LocalOpciones);
    
    $("#AmbienteForm #TableAmbiente select").change(function(){ AjaxAmbiente.Cargar(HTMLCargarAmbiente); });
    $("#AmbienteForm #TableAmbiente input").blur(function(){ AjaxAmbiente.Cargar(HTMLCargarAmbiente); });
    
    $('#ModalAmbiente').on('shown.bs.modal', function (event) {
        $('#ModalAmbienteForm #txt_ambiente').val( AmbienteG.ambiente );
        $('#ModalAmbienteForm #txt_local').val( AmbienteG.local );
        $('#ModalAmbienteForm #txt_local_id').val( AmbienteG.local_id );
        $('#ModalAmbienteForm #txt_codigo_local').val( AmbienteG.codigo_local );
        $('#ModalAmbienteForm #txt_pabellon').val( AmbienteG.pabellon );
        $('#ModalAmbienteForm #txt_pabellon_id').val( AmbienteG.pabellon_id );
        $('#ModalAmbienteForm #txt_piso').val( AmbienteG.piso );
        $('#ModalAmbienteForm #txt_aforo').val( AmbienteG.aforo );
        $('#ModalAmbienteForm #slct_tipo_ambiente').val( AmbienteG.tipo_ambiente );
        $('#ModalAmbienteForm #slct_estado').val( AmbienteG.estado );
        $("#ModalAmbiente select").selectpicker('refresh');
        
        if( AddEditAmbiente==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxAmbiente();');
            $("#ModalAmbienteForm #txt_pabellon_ico, #ModalAmbienteForm #txt_local_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $("#ModalAmbienteForm #slct_tipo_ambiente").selectpicker('val','1');
            $('#ModalAmbienteForm #txt_local, #ModalAmbienteForm #txt_pabellon').removeAttr('disabled');
            $('#ModalAmbienteForm #txt_local').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxAmbiente();');
            $("#ModalAmbienteForm").append("<input type='hidden' value='"+AmbienteG.id+"' name='id'>");
            $("#ModalAmbienteForm #txt_pabellon_ico, #ModalAmbienteForm #txt_local_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            $('#ModalAmbienteForm #txt_local, #ModalAmbienteForm #txt_pabellon').attr('disabled','true');
        }
    });

    $('#ModalAmbiente').on('hidden.bs.modal', function (event) {
        $("#ModalAmbienteForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormAmbiente=function(){
    var r=true;
    if( $("#ModalAmbienteForm #txt_local_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Local',4000);
    }
    else if( $("#ModalAmbienteForm #txt_pabellon_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Pabellon',4000);
    }
    else if( $.trim( $("#ModalAmbienteForm #slct_tipo_ambiente").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo Ambiente',4000);
    }
    else if( $.trim( $("#ModalAmbienteForm #txt_ambiente").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Ambiente',4000);
    }
    else if( $.trim( $("#ModalAmbienteForm #txt_piso").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Piso del ambiente',4000);
    }
    else if( $.trim( $("#ModalAmbienteForm #txt_aforo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Aforo',4000);
    }
    return r;
}

AgregarEditarAmbiente=function(val,id){
    AddEditAmbiente=val;
    AmbienteG.id='';
    AmbienteG.ambiente='';
    AmbienteG.tipo_ambiente='';
    AmbienteG.pabellon='';
    AmbienteG.pabellon_id='';
    AmbienteG.local='';
    AmbienteG.local_id='';
    AmbienteG.codigo_local='';
    AmbienteG.piso='';
    AmbienteG.aforo='';
    AmbienteG.estado='1';
    
    if( val==0 ){
        AmbienteG.id=id;
        AmbienteG.ambiente=$("#TableAmbiente #trid_"+id+" .ambiente").text();
        AmbienteG.tipo_ambiente=$("#TableAmbiente #trid_"+id+" .tipo_ambiente").val();
        AmbienteG.pabellon=$("#TableAmbiente #trid_"+id+" .pabellon").text();
        AmbienteG.pabellon_id=$("#TableAmbiente #trid_"+id+" .pabellon_id").val();
        AmbienteG.local=$("#TableAmbiente #trid_"+id+" .local").text();
        AmbienteG.local_id=$("#TableAmbiente #trid_"+id+" .local_id").val();
        AmbienteG.codigo_local=$("#TableAmbiente #trid_"+id+" .codigo_local").val();
        AmbienteG.piso=$("#TableAmbiente #trid_"+id+" .piso").text();
        AmbienteG.aforo=$("#TableAmbiente #trid_"+id+" .aforo").text();
        AmbienteG.estado=$("#TableAmbiente #trid_"+id+" .estado").val();
    }
    $('#ModalAmbiente').modal('show');
}

CambiarEstadoAmbiente=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Ambiente','Desea '+texto+' el ambiente: '+$("#TableAmbiente #trid_"+id+" .ambiente").text(), function(){ AjaxAmbiente.CambiarEstado(HTMLCambiarEstadoAmbiente,estado,id); });
}

HTMLCambiarEstadoAmbiente=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxAmbiente.Cargar(HTMLCargarAmbiente);
    }
}

AgregarEditarAjaxAmbiente=function(){
    if( ValidaFormAmbiente() ){
        AjaxAmbiente.AgregarEditar(HTMLAgregarEditarAmbiente);
    }
}

HTMLAgregarEditarAmbiente=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalAmbiente').modal('hide');
        AjaxAmbiente.Cargar(HTMLCargarAmbiente);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarAmbiente=function(result){

    var html="";
    $('#TableAmbiente').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoAmbiente(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoAmbiente(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        tipo_ambiente_t='Aula';
        if( r.tipo_ambiente==2 ){
            tipo_ambiente_t='Laboratorio';
        }
        else if( r.tipo_ambiente==3 ){
            tipo_ambiente_t='Otro';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='pabellon'>"+r.pabellon+"</td>"+
            "<td class='tipo_ambiente_t'>"+tipo_ambiente_t+"</td>"+
            "<td class='ambiente'>"+r.ambiente+"</td>"+
            "<td class='piso'>"+r.piso+"</td>"+
            "<td class='aforo'>"+r.aforo+"</td>"+
            "<td>"+
            "<input type='hidden' class='tipo_ambiente' value='"+r.tipo_ambiente+"'>"+
            "<input type='hidden' class='pabellon_id' value='"+r.pabellon_id+"'>"+
            "<input type='hidden' class='codigo_local' value='"+r.codigo_local+"'>"+
            "<input type='hidden' class='local_id' value='"+r.local_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarAmbiente(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableAmbiente tbody").html(html); 
    $("#TableAmbiente").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthAmbiente": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableAmbiente_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarAmbiente','AjaxAmbiente',result.data,'#TableAmbiente_paginate');
        }
    });

};
</script>
