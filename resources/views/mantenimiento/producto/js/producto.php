<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ProductoG={id:0,local_id:0,ps_nivel3_id:0,nivel3_id:"",precio_venta:"",precio_compra:"",moneda:0,stock:"",
               stock_minimo:"",dias_alerta:"",fecha_vencimiento:"",dias_vencimiento:"",estado:1}; // Datos Globales

var Nivel3Opciones = {
    placeholder: 'Nivel 3',
    url: "AjaxDinamic/Mantenimiento.Nivel3EM@ListNivel3",
    listLocation: "data",
    getValue: "nivel3",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalProductoForm #txt_nivel3").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalProductoForm #txt_nivel3").getSelectedItemData().id;
            $("#ModalProductoForm #txt_ps_nivel3_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "nivel3"
        }
        /*type: "custom",
        method: function(value, item) {
            return value+' - '+'<b>Distrito:</b>'+item.distrito;
        }*/
    },
    adjustWidth:false,
};
$(document).ready(function() {
    $("#ModalProductoForm #txt_nivel3").easyAutocomplete(Nivel3Opciones);
    AjaxProducto.CargarLocal(SlctCargarLocal);
    
    $("#TableProducto").DataTable({
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

    AjaxProducto.Cargar(HTMLCargarProducto);
    
    $("#ProductoForm #TableProducto select").change(function(){ AjaxProducto.Cargar(HTMLCargarProducto); });
    $("#ProductoForm #TableProducto input").blur(function(){ AjaxProducto.Cargar(HTMLCargarProducto); });
    
    $('#ModalProducto').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalProductoForm").append("<input type='hidden' value='"+ProductoG.id+"' name='id'>");
        }
        $('#ModalProductoForm #txt_nivel3').val( ProductoG.nivel3 );
        $('#ModalProductoForm #txt_ps_nivel3_id').val( ProductoG.ps_nivel3_id );
        $('#ModalProductoForm #slct_local_id').val( ProductoG.local_id );
        $('#ModalProductoForm #txt_precio_venta').val( ProductoG.precio_venta );
        $('#ModalProductoForm #txt_precio_compra').val( ProductoG.precio_compra );
        $('#ModalProductoForm #slct_moneda').val( ProductoG.moneda );
        $('#ModalProductoForm #txt_stock').val( ProductoG.stock );
        $('#ModalProductoForm #txt_stock_minimo').val( ProductoG.stock_minimo );
        $('#ModalProductoForm #txt_dias_alerta').val( ProductoG.dias_alerta );
        $('#ModalProductoForm #txt_fecha_vencimiento').val( ProductoG.fecha_vencimiento );
        $('#ModalProductoForm #txt_dias_vencimiento').val( ProductoG.dias_vencimiento );
        $('#ModalProductoForm #slct_estado').val( ProductoG.estado );
        $("#ModalProducto select").selectpicker('refresh');
        $('#ModalProductoForm #txt_producto').focus();
    });

    $('#ModalProducto').on('hidden.bs.modal', function (event) {
        $("#ModalProductoForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalProductoForm #txt_ps_nivel3_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Nivel 3',4000);
    }
    else if( $.trim( $("#ModalProductoForm #slct_local_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Local',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_precio_venta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Precio de Venta',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_precio_compra").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Precio de Compra',4000);
    }
    else if( $.trim( $("#ModalProductoForm #slct_moneda").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Moneda',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_stock").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Stock',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_stock_minimo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Stock Mínimo',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_dias_alerta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese días de alerta',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_fecha_vencimiento").val() )=='' && 
            $.trim( $("#ModalProductoForm #txt_dias_vencimiento").val() )==''){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha o días de vencimiento',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    ProductoG.id='';
    ProductoG.ps_nivel3_id='';
    ProductoG.nivel3='';
    ProductoG.local_id='';
    ProductoG.moneda='';
    ProductoG.stock='';
    ProductoG.stock_minimo='';
    ProductoG.dias_alerta='';
    ProductoG.fecha_vencimiento='';
    ProductoG.dias_vencimiento='';
    ProductoG.precio_venta='';
    ProductoG.precio_compra='';  
    ProductoG.estado='1';
    
    if( val==0 ){
        ProductoG.id=id;
        ProductoG.ps_nivel3_id=$("#TableProducto #trid_"+id+" .ps_nivel3_id").val();
        ProductoG.nivel3=$("#TableProducto #trid_"+id+" .nivel3").text();
        ProductoG.local_id=$("#TableProducto #trid_"+id+" .local_id").val();
        ProductoG.moneda=$("#TableProducto #trid_"+id+" .moneda").val();
        ProductoG.stock=$("#TableProducto #trid_"+id+" .stock").text();
        ProductoG.stock_minimo=$("#TableProducto #trid_"+id+" .stock_minimo").val();
        ProductoG.dias_alerta=$("#TableProducto #trid_"+id+" .dias_alerta").val();
        ProductoG.fecha_vencimiento=$("#TableProducto #trid_"+id+" .fecha_vencimiento").val();
        ProductoG.dias_vencimiento=$("#TableProducto #trid_"+id+" .dias_vencimiento").val();
        ProductoG.precio_venta=$("#TableProducto #trid_"+id+" .precio_venta").val();
        ProductoG.precio_compra=$("#TableProducto #trid_"+id+" .precio_compra").val();   
        ProductoG.estado=$("#TableProducto #trid_"+id+" .estado").val();
    }
    $('#ModalProducto').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxProducto.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxProducto.Cargar(HTMLCargarProducto);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxProducto.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalProducto').modal('hide');
        AjaxProducto.Cargar(HTMLCargarProducto);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarProducto=function(result){

    var html="";
    $('#TableProducto').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel3'>"+r.nivel3+"</td>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='stock'>"+r.stock+"</td>"+
            "<td>";
        html+="<input type='hidden' class='ps_nivel3_id' value='"+r.ps_nivel3_id+"'>"+
              "<input type='hidden' class='nivel3' value='"+r.nivel3+"'>"+
              "<input type='hidden' class='local_id' value='"+r.local_id+"'>"+
              "<input type='hidden' class='precio_compra' value='"+r.precio_compra+"'>"+
              "<input type='hidden' class='moneda' value='"+r.moneda+"'>"+
              "<input type='hidden' class='stock' value='"+r.stock+"'>"+
              "<input type='hidden' class='stock_minimo' value='"+r.stock_minimo+"'>"+
              "<input type='hidden' class='dias_alerta' value='"+r.dias_alerta+"'>"+
              "<input type='hidden' class='fecha_vencimiento' value='"+r.fecha_vencimiento+"'>"+
              "<input type='hidden' class='dias_vencimiento' value='"+r.dias_vencimiento+"'>"+
              "<input type='hidden' class='precio_venta' value='"+r.precio_venta+"'>"+
              "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableProducto tbody").html(html); 
    $("#TableProducto").DataTable({
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
            $('#TableProducto_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarProducto','AjaxProducto',result.data,'#TableProducto_paginate');
        }
    });

};
LimpiarProductoModal=function(limpiar){
    $("#"+limpiar).val('');
};
SlctCargarLocal=function(result){
    var html="<option value=''>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.local+"</option>";
    });
    $("#ModalProductoForm #slct_local_id").html(html);
    $("#ModalProductoForm #slct_local_id").selectpicker('refresh');
}
</script>
