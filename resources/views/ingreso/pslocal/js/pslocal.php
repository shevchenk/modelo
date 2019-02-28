<script type="text/javascript">
var hoyG='<?php echo date("Y-m-d"); ?>';
var AddEdit=0; //0: Editar | 1: Agregar
var ProductoG={id:0,local_id:0,local:"",local_codigo:"",ps_nivel3_id:0,nivel3_id:"",precio_venta:"",precio_compra:"",moneda:0,stock:"",
               stock_minimo:"",dias_alerta:"",fecha_vencimiento:"",dias_vencimiento:"",estado:1}; // Datos Globales

var Nivel3Opciones = {
    placeholder: 'Producto / Servicio',
    url: "AjaxDinamic/Ingreso.Nivel3IN@ListNivel3",
    listLocation: "data",
    getValue: "nivel3",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalProductoForm #txt_nivel3").val();
        data.tipo = $("#ModalProductoForm #slct_tipo").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalProductoForm #txt_nivel3").getSelectedItemData().id;
            var value2 = $("#ModalProductoForm #txt_nivel3").getSelectedItemData().nivel2;
            $("#ModalProductoForm #txt_ps_nivel3_id").val(value).trigger("change");
            $("#ModalProductoForm #txt_nivel2").val(value2).trigger("change");
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
var LocalOpciones = {
    placeholder: 'Local',
    url: "AjaxDinamic/Mantenimiento.LocalMA@ListLocal",
    listLocation: "data",
    getValue: "local",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalProductoForm #txt_local").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalProductoForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalProductoForm #txt_local").getSelectedItemData().codigo;
            $("#ModalProductoForm #txt_local_id").val(value).trigger("change");
            $("#ModalProductoForm #txt_codigo_local").val(value2).trigger("change");
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
    $("#ModalProductoForm #txt_nivel3").easyAutocomplete(Nivel3Opciones);
    $("#ModalProductoForm #txt_local").easyAutocomplete(LocalOpciones);
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
    $("#ModalProductoForm #slct_tipo").change(function(){ ProductoG.tipo=$("#ModalProductoForm #slct_tipo").val(); ValidaTipo(); });
    
    $('#ModalProducto').on('shown.bs.modal', function (event) {
        $('#ModalProductoForm #txt_nivel3').val( ProductoG.nivel3 );
        $('#ModalProductoForm #txt_nivel2').val( ProductoG.nivel2 );
        $('#ModalProductoForm #txt_ps_nivel3_id').val( ProductoG.ps_nivel3_id );
        $('#ModalProductoForm #txt_local_id').val( ProductoG.local_id );
        $('#ModalProductoForm #txt_local').val( ProductoG.local );
        $('#ModalProductoForm #txt_codigo_local').val( ProductoG.local_codigo );
        $('#ModalProductoForm #txt_precio_venta').val( ProductoG.precio_venta );
        $('#ModalProductoForm #txt_precio_compra').val( ProductoG.precio_compra );
        $('#ModalProductoForm #slct_moneda').val( ProductoG.moneda );
        $('#ModalProductoForm #txt_stock').val( ProductoG.stock );
        $('#ModalProductoForm #txt_stock_minimo').val( ProductoG.stock_minimo );
        $('#ModalProductoForm #txt_dias_alerta').val( ProductoG.dias_alerta );
        $('#ModalProductoForm #txt_fecha_ingreso').val( ProductoG.fecha_ingreso );
        $('#ModalProductoForm #txt_fecha_vencimiento').val( ProductoG.fecha_vencimiento );
        $('#ModalProductoForm #txt_dias_vencimiento').val( ProductoG.dias_vencimiento );
        $('#ModalProductoForm #slct_estado').val( ProductoG.estado );
        $('#ModalProductoForm #slct_tipo').val( ProductoG.tipo );
        $("#ModalProducto select").selectpicker('refresh');

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
            $("#ModalProductoForm #txt_local,#ModalProductoForm #txt_nivel3,#ModalProductoForm #slct_tipo").removeAttr("disabled");
            $('#ModalProductoForm #txt_local').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalProductoForm").append("<input type='hidden' value='"+ProductoG.id+"' name='id'>");
            $("#ModalProductoForm #txt_local,#ModalProductoForm #txt_nivel3,#ModalProductoForm #slct_tipo").attr("disabled",'true');
        }
    });

    $('#ModalProducto').on('hidden.bs.modal', function (event) {
        $("#ModalProductoForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaTipo=function(){
    var tipo=ProductoG.tipo;
    $("#ModalProductoForm #txt_precio_compra").removeAttr('readonly');
    $("#ModalProductoForm #txt_stock").removeAttr('readonly');
    $("#ModalProductoForm #txt_stock_minimo").removeAttr('readonly');
    $("#ModalProductoForm #txt_dias_alerta").removeAttr('readonly');
    $("#ModalProductoForm #txt_dias_vencimiento").removeAttr('readonly');
    $("#ModalProductoForm #txt_precio_compra,#ModalProductoForm #txt_stock_minimo,#ModalProductoForm #txt_dias_alerta,#ModalProductoForm #txt_dias_vencimiento").val('0');
    $("#ModalProductoForm #txt_stock").val('');

    if( tipo==1 ){
        $("#ModalProductoForm #txt_precio_compra").attr('readonly','true');
        $("#ModalProductoForm #txt_stock").attr('readonly','true');
        $("#ModalProductoForm #txt_stock_minimo").attr('readonly','true');
        $("#ModalProductoForm #txt_dias_alerta").attr('readonly','true');
        $("#ModalProductoForm #txt_dias_vencimiento").attr('readonly','true');
        $("#ModalProductoForm #txt_stock").val('-1');
    }
    $("#ModalProductoForm #txt_ttipo").val($("#ModalProductoForm #slct_tipo option:selected").text());
}

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalProductoForm #txt_local_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Local',4000);
    }
    else if( $.trim( $("#ModalProductoForm #slct_tipo").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo',4000);
    }
    else if( $.trim( $("#ModalProductoForm #txt_ps_nivel3_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione '+$("#ModalProductoForm #slct_tipo option:selected").text(),4000);
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
    else if( $.trim( $("#ModalProductoForm #txt_fecha_ingreso").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese fecha ingreso',4000);
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
    ProductoG.nivel2='';
    ProductoG.local_id='';
    ProductoG.local='';
    ProductoG.local_codigo='';
    ProductoG.moneda='1';
    ProductoG.stock='';
    ProductoG.stock_minimo='';
    ProductoG.dias_alerta='';
    ProductoG.fecha_vencimiento='';
    ProductoG.fecha_ingreso=hoyG;
    ProductoG.dias_vencimiento='';
    ProductoG.precio_venta='';
    ProductoG.precio_compra='';  
    ProductoG.estado='1';
    ProductoG.tipo='0';
    
    if( val==0 ){
        ProductoG.id=id;
        ProductoG.ps_nivel3_id=$("#TableProducto #trid_"+id+" .ps_nivel3_id").val();
        ProductoG.nivel3=$("#TableProducto #trid_"+id+" .nivel3").text();
        ProductoG.nivel2=$("#TableProducto #trid_"+id+" .nivel2").val();
        ProductoG.local_id=$("#TableProducto #trid_"+id+" .local_id").val();
        ProductoG.tipo=$("#TableProducto #trid_"+id+" .tipo").val();
        ProductoG.local=$("#TableProducto #trid_"+id+" .local").text();
        ProductoG.local_codigo=$("#TableProducto #trid_"+id+" .local_codigo").val();
        ProductoG.moneda=$("#TableProducto #trid_"+id+" .moneda").val();
        ProductoG.stock=$("#TableProducto #trid_"+id+" .stock").text();
        ProductoG.stock_minimo=$("#TableProducto #trid_"+id+" .stock_minimo").val();
        ProductoG.dias_alerta=$("#TableProducto #trid_"+id+" .dias_alerta").val();
        ProductoG.fecha_vencimiento=$("#TableProducto #trid_"+id+" .fecha_vencimiento").val();
        ProductoG.fecha_ingreso=$("#TableProducto #trid_"+id+" .fecha_ingreso").val();
        ProductoG.dias_vencimiento=$("#TableProducto #trid_"+id+" .dias_vencimiento").val();
        ProductoG.precio_venta=$("#TableProducto #trid_"+id+" .precio_venta").val();
        ProductoG.precio_compra=$("#TableProducto #trid_"+id+" .precio_compra").val();   
        ProductoG.estado=$("#TableProducto #trid_"+id+" .estado").val();
    }
    ValidaTipo();
    $('#ModalProducto').modal('show');
}

CambiarEstado=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Eliminar';
    }
    sweetalertG.confirm('Local:'+$("#TableProducto #trid_"+id+" .local").text(),'Desea '+texto+' el '+$("#TableProducto #trid_"+id+" .ttipo").text()+': '+$("#TableProducto #trid_"+id+" .nivel3").text(), function(){ AjaxProducto.CambiarEstado(HTMLCambiarEstado,estado,id); });
    
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
        msjG.mensaje('warning',result.msj,8000);
    }
}

HTMLCargarProducto=function(result){

    var html="";
    $('#TableProducto').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn fa fa-trash fa-lg btn-danger"></span>';
        }
        tipo='Producto';
        if(r.tipo==1){
            tipo='Servicio';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='ttipo'>"+tipo+"</td>"+
            "<td class='nivel3'>"+r.nivel3+"</td>"+
            "<td class='stock'>"+r.stock+"</td>"+
            "<td>";
        html+="<input type='hidden' class='ps_nivel3_id' value='"+r.ps_nivel3_id+"'>"+
              "<input type='hidden' class='nivel3' value='"+r.nivel3+"'>"+
              "<input type='hidden' class='nivel2' value='"+r.nivel2+"'>"+
              "<input type='hidden' class='tipo' value='"+r.tipo+"'>"+
              "<input type='hidden' class='local_id' value='"+r.local_id+"'>"+
              "<input type='hidden' class='local' value='"+r.local+"'>"+
              "<input type='hidden' class='local_codigo' value='"+r.local_codigo+"'>"+
              "<input type='hidden' class='precio_compra' value='"+r.precio_compra+"'>"+
              "<input type='hidden' class='moneda' value='"+r.moneda+"'>"+
              "<input type='hidden' class='stock' value='"+r.stock+"'>"+
              "<input type='hidden' class='stock_minimo' value='"+r.stock_minimo+"'>"+
              "<input type='hidden' class='dias_alerta' value='"+r.dias_alerta+"'>"+
              "<input type='hidden' class='fecha_vencimiento' value='"+$.trim(r.fecha_vencimiento)+"'>"+
              "<input type='hidden' class='fecha_ingreso' value='"+$.trim(r.fecha_ingreso)+"'>"+
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
</script>
