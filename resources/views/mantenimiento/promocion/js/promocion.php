<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var PromocionG={id:0,local_id:0,local:"",local_codigo:"",ps_nivel3_id:0,nivel3_id:"",precio_venta:"",precio_compra:"",moneda:0,stock:"",
               stock_minimo:"",dias_alerta:"",fecha_vencimiento:"",dias_vencimiento:"",estado:1}; // Datos Globales

var Nivel2Opciones = {
    placeholder: 'Nivel 2',
    url: "AjaxDinamic/Mantenimiento.Nivel2EM@ListNivel2",
    listLocation: "data",
    getValue: "nivel2",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_nivel2").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPromocionForm #txt_nivel2").getSelectedItemData().id;
            $("#ModalPromocionForm #txt_ps_nivel2_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "nivel2"
        }
        /*type: "custom",
        method: function(value, item) {
            return value+' - '+'<b>Distrito:</b>'+item.distrito;
        }*/
    },
    adjustWidth:false,
};
var Nivel1Opciones = {
    placeholder: 'Nivel 1',
    url: "AjaxDinamic/Mantenimiento.Nivel1EM@ListNivel1",
    listLocation: "data",
    getValue: "nivel1",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPromocionForm #txt_nivel1").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPromocionForm #txt_nivel1").getSelectedItemData().id;
            $("#ModalPromocionForm #txt_ps_nivel1_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "nivel1"
        }
        /*type: "custom",
        method: function(value, item) {
            return value+' - '+'<b>Distrito:</b>'+item.distrito;
        }*/
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
        data.phrase = $("#txt_local").val();
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

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalPromocionForm").append("<input type='hidden' value='"+PromocionG.id+"' name='id'>");
        }
        $('#ModalPromocionForm #txt_nivel3').val( PromocionG.nivel3 );
        $('#ModalPromocionForm #txt_ps_nivel3_id').val( PromocionG.ps_nivel3_id );
        $('#ModalPromocionForm #txt_local_id').val( PromocionG.local_id );
        $('#ModalPromocionForm #txt_local').val( PromocionG.local );
        $('#ModalPromocionForm #txt_codigo_local').val( PromocionG.local_codigo );
        $('#ModalPromocionForm #txt_precio_venta').val( PromocionG.precio_venta );
        $('#ModalPromocionForm #txt_precio_compra').val( PromocionG.precio_compra );
        $('#ModalPromocionForm #slct_moneda').val( PromocionG.moneda );
        $('#ModalPromocionForm #txt_stock').val( PromocionG.stock );
        $('#ModalPromocionForm #txt_stock_minimo').val( PromocionG.stock_minimo );
        $('#ModalPromocionForm #txt_dias_alerta').val( PromocionG.dias_alerta );
        $('#ModalPromocionForm #txt_fecha_vencimiento').val( PromocionG.fecha_vencimiento );
        $('#ModalPromocionForm #txt_dias_vencimiento').val( PromocionG.dias_vencimiento );
        $('#ModalPromocionForm #slct_estado').val( PromocionG.estado );
        $("#ModalPromocion select").selectpicker('refresh');
        $('#ModalPromocionForm #txt_producto').focus();
    });

    $('#ModalPromocion').on('hidden.bs.modal', function (event) {
        $("#ModalPromocionForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalPromocionForm #txt_local_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Local',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_ps_nivel1_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Nivel 1',4000);
    }
    else if( $.trim( $("#ModalPromocionForm #txt_ps_nivel2_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Nivel 2',4000);
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
    PromocionG.local_id='';
    PromocionG.local='';
    PromocionG.local_codigo='';
    PromocionG.oferta='';
    PromocionG.fecha_inicio_pro='';
    PromocionG.fecha_final_pro='';
    PromocionG.cantidad_pro='';
    PromocionG.dscto_porcentaje='';  
    PromocionG.dscto_monto='';  
    PromocionG.dscto_cantidad='';  
    PromocionG.estado='1';
    
    if( val==0 ){
        PromocionG.id=id;
        PromocionG.ps_nivel3_id=$("#TablePromocion #trid_"+id+" .ps_nivel3_id").val();
        PromocionG.nivel3=$("#TablePromocion #trid_"+id+" .nivel3").text();
        PromocionG.local_id=$("#TablePromocion #trid_"+id+" .local_id").val();
        PromocionG.local=$("#TablePromocion #trid_"+id+" .local").text();
        PromocionG.local_codigo=$("#TablePromocion #trid_"+id+" .local_codigo").val();
        PromocionG.moneda=$("#TablePromocion #trid_"+id+" .moneda").val();
        PromocionG.stock=$("#TablePromocion #trid_"+id+" .stock").text();
        PromocionG.stock_minimo=$("#TablePromocion #trid_"+id+" .stock_minimo").val();
        PromocionG.dias_alerta=$("#TablePromocion #trid_"+id+" .dias_alerta").val();
        PromocionG.fecha_vencimiento=$("#TablePromocion #trid_"+id+" .fecha_vencimiento").val();
        PromocionG.dias_vencimiento=$("#TablePromocion #trid_"+id+" .dias_vencimiento").val();
        PromocionG.precio_venta=$("#TablePromocion #trid_"+id+" .precio_venta").val();
        PromocionG.precio_compra=$("#TablePromocion #trid_"+id+" .precio_compra").val();   
        PromocionG.estado=$("#TablePromocion #trid_"+id+" .estado").val();
    }
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
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel3'>"+r.nivel1+"</td>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='stock'>"+r.nivel2+"</td>"+
            "<td class='stock'>"+r.oferta+"</td>"+
            "<td>";
        html+="<input type='hidden' class='ps_nivel3_id' value='"+r.nivel1+"'>"+
              "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
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
