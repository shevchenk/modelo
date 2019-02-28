<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var PromocionG={id:0,local_id:0,local:"",local_codigo:"",ps_nivel3_id:0,nivel3_id:"",precio_venta:"",precio_compra:"",moneda:0,stock:"",
               stock_minimo:"",dias_alerta:"",fecha_vencimiento:"",dias_vencimiento:"",estado:1}; // Datos Globales

var Nivel3Opciones = {
    placeholder: 'Servicio',
    url: "AjaxDinamic/Ingreso.Nivel3IN@ListNivel3",
    listLocation: "data",
    getValue: "nivel3",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_nivel3").val();
        data.tipo = $("#ModalPromocionForm #txt_tipo").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPromocionForm #txt_nivel3").getSelectedItemData().id;
            var ps_nivel2_id = $("#ModalPromocionForm #txt_nivel3").getSelectedItemData().ps_nivel2_id;
            var nivel2 = $("#ModalPromocionForm #txt_nivel3").getSelectedItemData().nivel2;
            var ps_nivel1_id = $("#ModalPromocionForm #txt_nivel3").getSelectedItemData().ps_nivel1_id;
            var nivel1 = $("#ModalPromocionForm #txt_nivel3").getSelectedItemData().nivel1;
            $("#ModalPromocionForm #txt_ps_nivel3_id").val(value).trigger("change");
            $("#ModalPromocionForm #txt_ps_nivel2_id").val(ps_nivel2_id).trigger("change");
            $("#ModalPromocionForm #txt_nivel2").val(nivel2).trigger("change");
            $("#ModalPromocionForm #txt_ps_nivel1_id").val(ps_nivel1_id).trigger("change");
            $("#ModalPromocionForm #txt_nivel1").val(nivel1).trigger("change");
        }
    },
    template: {
        type: "custom",
        method: function(value, item) {
            return "<img src='" + item.foto + "' style='width:80px;height:80px;' /> " + value + " | " + item.nivel2;
        }
    },
    adjustWidth:false,
};

var Nivel2Opciones = {
    placeholder: 'Sub Grupo',
    url: "AjaxDinamic/Ingreso.Nivel2IN@ListNivel2",
    listLocation: "data",
    getValue: "nivel2",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_nivel2").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPromocionForm #txt_nivel2").getSelectedItemData().id;
            var nivel1 = $("#ModalPromocionForm #txt_nivel2").getSelectedItemData().nivel1;
            var ps_nivel1_id = $("#ModalPromocionForm #txt_nivel2").getSelectedItemData().ps_nivel1_id;
            $("#ModalPromocionForm #txt_ps_nivel2_id").val(value).trigger("change");
            $("#ModalPromocionForm #txt_ps_nivel1_id").val(ps_nivel1_id).trigger("change");
            $("#ModalPromocionForm #txt_nivel1").val(nivel1).trigger("change");

            $("#ModalPromocionForm #txt_ps_nivel3_id").val('').trigger("change");
            $("#ModalPromocionForm #txt_nivel3").val('').trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "nivel1"
        }
    },
    adjustWidth:false,
};

var Nivel1Opciones = {
    placeholder: 'Grupo',
    url: "AjaxDinamic/Ingreso.Nivel1IN@ListNivel1",
    listLocation: "data",
    getValue: "nivel1",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_nivel1").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPromocionForm #txt_nivel1").getSelectedItemData().id;
            $("#ModalPromocionForm #txt_ps_nivel1_id").val(value).trigger("change");

            $("#ModalPromocionForm #txt_ps_nivel2_id").val('').trigger("change");
            $("#ModalPromocionForm #txt_nivel2").val('').trigger("change");
            $("#ModalPromocionForm #txt_ps_nivel3_id").val('').trigger("change");
            $("#ModalPromocionForm #txt_nivel3").val('').trigger("change");
        }
    },
    adjustWidth:false,
};

var LocalOpciones = {
    placeholder: 'Local',
    url: "AjaxDinamic/Mantenimiento.LocalMA@ListLocal",
    listLocation: "data",
    getValue: "local",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_local").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPromocionForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalPromocionForm #txt_local").getSelectedItemData().codigo;
            $("#ModalPromocionForm #txt_local_id").val(value).trigger("change");
            $("#ModalPromocionForm #txt_codigo_local").val(value2).trigger("change");
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
    $("#ModalPromocionForm #txt_nivel1").easyAutocomplete(Nivel1Opciones);
    $("#ModalPromocionForm #txt_nivel2").easyAutocomplete(Nivel2Opciones);
    $("#ModalPromocionForm #txt_nivel3").easyAutocomplete(Nivel3Opciones);
    $("#ModalPromocionForm #txt_local").easyAutocomplete(LocalOpciones);
    $("#TablePromocion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
    $(".fechas").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

    AjaxPromocion.Cargar(HTMLCargarPromocion);
    
    $("#PromocionForm #TablePromocion select").change(function(){ AjaxPromocion.Cargar(HTMLCargarPromocion); });
    $("#PromocionForm #TablePromocion input").blur(function(){ AjaxPromocion.Cargar(HTMLCargarPromocion); });
    
    $('#ModalPromocion').on('shown.bs.modal', function (event) {
        $('#ModalPromocionForm #txt_nivel3').val( PromocionG.nivel3 );
        $('#ModalPromocionForm #txt_ps_nivel3_id').val( PromocionG.ps_nivel3_id );
        $('#ModalPromocionForm #txt_nivel2').val( PromocionG.nivel2 );
        $('#ModalPromocionForm #txt_ps_nivel2_id').val( PromocionG.ps_nivel2_id );
        $('#ModalPromocionForm #txt_nivel1').val( PromocionG.nivel1 );
        $('#ModalPromocionForm #txt_ps_nivel1_id').val( PromocionG.ps_nivel1_id );
        $('#ModalPromocionForm #txt_local_id').val( PromocionG.local_id );
        $('#ModalPromocionForm #txt_local').val( PromocionG.local );
        $('#ModalPromocionForm #txt_codigo_local').val( PromocionG.local_codigo );
        $('#ModalPromocionForm #txt_oferta').val( PromocionG.oferta );
        $('#ModalPromocionForm #txt_fecha_inicio_pro').val( PromocionG.fecha_inicio_pro );
        $('#ModalPromocionForm #txt_fecha_final_pro').val( PromocionG.fecha_final_pro );
        $('#ModalPromocionForm #txt_cantidad_pro').val( PromocionG.cantidad_pro );
        $('#ModalPromocionForm #txt_dscto_porcentaje').val( PromocionG.dscto_porcentaje );
        $('#ModalPromocionForm #txt_dscto_monto').val( PromocionG.dscto_monto );
        $('#ModalPromocionForm #txt_dscto_cantidad').val( PromocionG.dscto_cantidad );

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
            $('#ModalPromocionForm #txt_nivel1').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalPromocionForm").append("<input type='hidden' value='"+PromocionG.id+"' name='id'>");
        }
    });

    $('#ModalPromocion').on('hidden.bs.modal', function (event) {
        $("#ModalPromocionForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalPromocionForm #txt_ps_nivel1_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Grupo',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_ps_nivel3_id").val() )!='' && $.trim( $("#ModalPromocionForm #txt_ps_nivel2_id").val() )==''){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Sub Grupo',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_oferta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Oferta',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_fecha_inicio_pro").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha Inicio de Promoción',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_fecha_final_pro").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha Final de Promoción',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_oferta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Oferta',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    PromocionG.id='';
    PromocionG.ps_nivel1_id='';
    PromocionG.nivel1='';
    PromocionG.ps_nivel2_id='';
    PromocionG.nivel2='';
    PromocionG.ps_nivel3_id='';
    PromocionG.nivel3='';
    PromocionG.local_id='';
    PromocionG.local='';
    PromocionG.local_codigo='';
    PromocionG.oferta='';
    PromocionG.fecha_inicio_pro='';
    PromocionG.fecha_final_pro='';
    PromocionG.cantidad_pro='1';
    PromocionG.dscto_porcentaje='0';  
    PromocionG.dscto_monto='0';  
    PromocionG.dscto_cantidad='0';  
    PromocionG.estado='1';
    $('#ModalPromocion').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxPromocion.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPromocion.Cargar(HTMLCargarPromocion);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxPromocion.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPromocion').modal('hide');
        AjaxPromocion.Cargar(HTMLCargarPromocion);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarPromocion=function(result){

    var html="";
    $('#TablePromocion').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span class="danger">Anulado</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel1'>"+ $.trim(r.nivel1) +"</td>"+
            "<td class='nivel2'>"+ $.trim(r.nivel2) +"</td>"+
            "<td class='nivel3'>"+ $.trim(r.nivel3) +"</td>"+
            "<td class='local'>"+ $.trim(r.local) +"</td>"+
            "<td class='oferta'>"+r.oferta+"</td>"+
            "<td class='fecha_inicio_pro'>"+ $.trim(r.fecha_inicio_pro) +"</td>"+
            "<td class='fecha_final_pro'>"+ $.trim(r.fecha_final_pro) +"</td>"+
            "<td class='cantidad_pro'>"+ $.trim(r.cantidad_pro) +"</td>"+
            "<td class='dscto_porcentaje'>"+ $.trim(r.dscto_porcentaje) +"</td>"+
            "<td class='dscto_monto'>"+ $.trim(r.dscto_monto) +"</td>"+
            "<td class='dscto_cantidad'>"+ $.trim(r.dscto_cantidad) +"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
        html+="</tr>";
    });
    $("#TablePromocion tbody").html(html); 
    $("#TablePromocion").DataTable({
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
            $('#TablePromocion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPromocion','AjaxPromocion',result.data,'#TablePromocion_paginate');
        }
    });

};
LimpiarPromocionModal=function(limpiar){
    $("#"+limpiar).val('');
};
</script>
