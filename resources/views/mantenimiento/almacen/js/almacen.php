<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TransferirG={id:0,local_id_destino:"",local_destino:"",codigo_local_destino:"",empleado_id_destino:"",empleado_destino:""
                ,dni_destino:"",ps_nivel3_local_id:"",ps_nivel3:"",local_id:"",local:"",codigo_local:"",empleado_id:"",empleado:""
               ,dni:"",cantidad:"",fecha_transferir:"",estado:1}; // Datos Globales
var Nivel3Opciones = {
    placeholder: 'Nivel 3',
    url: "AjaxDinamic/Ingreso.PSLocalIN@LoadLocalProducto",
    listLocation: "data",
    getValue: "nivel3",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalTransferirForm #txt_ps_nivel3").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalTransferirForm #txt_ps_nivel3").getSelectedItemData().id;
            $("#ModalTransferirForm #txt_ps_nivel3_local_id").val(value).trigger("change");
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
            var value = $("#ModalTransferirForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalTransferirForm #txt_local").getSelectedItemData().codigo;
            $("#ModalTransferirForm #txt_local_id").val(value).trigger("change");
            $("#ModalTransferirForm #txt_codigo_local").val(value2).trigger("change");
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
var LocalDestinoOpciones = {
    placeholder: 'Local',
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
            var value = $("#ModalTransferirForm #txt_local_destino").getSelectedItemData().id;
            var value2 = $("#ModalTransferirForm #txt_local_destino").getSelectedItemData().codigo;
            $("#ModalTransferirForm #txt_local_id_destino").val(value).trigger("change");
            $("#ModalTransferirForm #txt_codigo_local_destino").val(value2).trigger("change");
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
var EmpleadoOpciones = {
    placeholder: 'Empleado',
    url: "AjaxDinamic/Mantenimiento.EmpleadoMA@ListEmpleado",
    listLocation: "data",
    getValue: "empleado",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalLocalForm #txt_empleado").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalTransferirForm #txt_empleado").getSelectedItemData().id;
            var value2 = $("#ModalTransferirForm #txt_empleado").getSelectedItemData().dni;
            $("#ModalTransferirForm #txt_empleado_id").val(value).trigger("change");
            $("#ModalTransferirForm #txt_dni").val(value2).trigger("change");
        }
    },
    template: {
        type: "custom",
        method: function(value, item) {
            return "<img src='" + item.foto + "' style='width:80px;height:80px;' /> " + value + " | " + item.dni;
        }
    },
    adjustWidth:false,
};
var EmpleadoDestinoOpciones = {
    placeholder: 'Empleado',
    url: "AjaxDinamic/Mantenimiento.EmpleadoMA@ListEmpleado",
    listLocation: "data",
    getValue: "empleado",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalLocalForm #txt_empleado_destino").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalTransferirForm #txt_empleado_destino").getSelectedItemData().id;
            var value2 = $("#ModalTransferirForm #txt_empleado_destino").getSelectedItemData().dni;
            $("#ModalTransferirForm #txt_empleado_id_destino").val(value).trigger("change");
            $("#ModalTransferirForm #txt_dni_destino").val(value2).trigger("change");
        }
    },
    template: {
        type: "custom",
        method: function(value, item) {
            return "<img src='" + item.foto + "' style='width:80px;height:80px;' /> " + value + " | " + item.dni;
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {
    $("#ModalTransferirForm #txt_ps_nivel3").easyAutocomplete(Nivel3Opciones);
    $("#ModalTransferirForm #txt_local").easyAutocomplete(LocalOpciones);
    $("#ModalTransferirForm #txt_empleado").easyAutocomplete(EmpleadoOpciones);
    $("#ModalTransferirForm #txt_local_destino").easyAutocomplete(LocalDestinoOpciones);
    $("#ModalTransferirForm #txt_empleado_destino").easyAutocomplete(EmpleadoDestinoOpciones);
    $("#TableTransferir").DataTable({
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

    AjaxTransferir.Cargar(HTMLCargarTransferir);
    
    $("#TransferirForm #TableTransferir select").change(function(){ AjaxTransferir.Cargar(HTMLCargarTransferir); });
    $("#TransferirForm #TableTransferir input").blur(function(){ AjaxTransferir.Cargar(HTMLCargarTransferir); });
    
    $('#ModalTransferir').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalTransferirForm").append("<input type='hidden' value='"+TransferirG.id+"' name='id'>");
        }
        $('#ModalTransferirForm #txt_local_id_destino').val( TransferirG.local_id_destino );
        $('#ModalTransferirForm #txt_local_destino').val( TransferirG.local_destino );
        $('#ModalTransferirForm #txt_codigo_local_destino').val( TransferirG.codigo_local_destino );
        $('#ModalTransferirForm #txt_empleado_id_destino').val( TransferirG.empleado_id_destino );
        $('#ModalTransferirForm #txt_empleado_destino').val( TransferirG.empleado_destino );
        $('#ModalTransferirForm #txt_dni_destino').val( TransferirG.dni_destino );
        $('#ModalTransferirForm #txt_ps_nivel3_local_id').val( TransferirG.ps_nivel3_local_id );
        $('#ModalTransferirForm #txt_ps_nivel3').val( TransferirG.ps_nivel3 );
        $('#ModalTransferirForm #txt_local_id').val( TransferirG.local_id );
        $('#ModalTransferirForm #txt_local').val( TransferirG.local );
        $('#ModalTransferirForm #txt_codigo_local').val( TransferirG.codigo_local );
        $('#ModalTransferirForm #txt_empleado_id').val( TransferirG.empleado_id );
        $('#ModalTransferirForm #txt_empleado').val( TransferirG.empleado );
        $('#ModalTransferirForm #txt_dni').val( TransferirG.dni );
        $('#ModalTransferirForm #txt_cantidad').val( TransferirG.cantidad );
        $('#ModalTransferirForm #txt_fecha_transferir').val( TransferirG.fecha_transferir );
        $('#ModalTransferirForm #slct_estado').val( TransferirG.estado );
        $("#ModalTransferir select").selectpicker('refresh');
        $('#ModalTransferirForm #txt_producto').focus();
    });

    $('#ModalTransferir').on('hidden.bs.modal', function (event) {
        $("#ModalTransferirForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalTransferirForm #txt_local_id_destino").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Local Destino',4000);
    }
    else if( $.trim( $("#ModalTransferirForm #txt_empleado_id_destino").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Empleado Destino',4000);
    }
    else if( $.trim( $("#ModalTransferirForm #txt_ps_nivel3_local_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Producto',4000);
    }
    else if( $.trim( $("#ModalTransferirForm #txt_local_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Local',4000);
    }
    else if( $.trim( $("#ModalTransferirForm #txt_empleado_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Empleado',4000);
    }
    else if( $.trim( $("#ModalTransferirForm #txt_cantidad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cantidad',4000);
    }else if( $.trim( $("#ModalTransferirForm #txt_fecha_transferir").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese fecha transferir',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    TransferirG.id='';
    TransferirG.local_id_destino='';
    TransferirG.local_destino='';
    TransferirG.codigo_local_destino='';
    TransferirG.empleado_id_destino='';
    TransferirG.empleado_destino='';
    TransferirG.dni_destino='';
    TransferirG.ps_nivel3_local_id='';
    TransferirG.ps_nivel3='';
    TransferirG.local_id='';
    TransferirG.local='';
    TransferirG.codigo_local='';
    TransferirG.empleado_id='';  
    TransferirG.empleado='';  
    TransferirG.dni='';  
    TransferirG.cantidad='';
    TransferirG.fecha_transferir='';
    TransferirG.estado='1';
    
    if( val==0 ){
        TransferirG.id=id;
        TransferirG.ps_nivel3_id=$("#TableTransferir #trid_"+id+" .ps_nivel3_id").val();
        TransferirG.nivel3=$("#TableTransferir #trid_"+id+" .nivel3").text();
        TransferirG.local_id=$("#TableTransferir #trid_"+id+" .local_id").val();
        TransferirG.local=$("#TableTransferir #trid_"+id+" .local").text();
        TransferirG.local_codigo=$("#TableTransferir #trid_"+id+" .local_codigo").val();
        TransferirG.moneda=$("#TableTransferir #trid_"+id+" .moneda").val();
        TransferirG.stock=$("#TableTransferir #trid_"+id+" .stock").text();
        TransferirG.stock_minimo=$("#TableTransferir #trid_"+id+" .stock_minimo").val();
        TransferirG.dias_alerta=$("#TableTransferir #trid_"+id+" .dias_alerta").val();
        TransferirG.fecha_vencimiento=$("#TableTransferir #trid_"+id+" .fecha_vencimiento").val();
        TransferirG.dias_vencimiento=$("#TableTransferir #trid_"+id+" .dias_vencimiento").val();
        TransferirG.precio_venta=$("#TableTransferir #trid_"+id+" .precio_venta").val();
        TransferirG.precio_compra=$("#TableTransferir #trid_"+id+" .precio_compra").val();   
        TransferirG.estado=$("#TableTransferir #trid_"+id+" .estado").val();
    }
    $('#ModalTransferir').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxTransferir.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxTransferir.Cargar(HTMLCargarTransferir);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxTransferir.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalTransferir').modal('hide');
        AjaxTransferir.Cargar(HTMLCargarTransferir);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarTransferir=function(result){

    var html="";
    $('#TableTransferir').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        estadohtml1='<span id="'+r.id+'" onClick="CambiarEstado1(1,'+r.id+')" class="btn btn-info">Pendiente</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        if(r.estado_transferir==1){
            estadohtml1='<span id="'+r.id+'" onClick="CambiarEstado1(0,'+r.id+')" class="btn btn-primary">Aprobado Transferencia</span>';
        }else if(r.estado_transferir==2){
            estadohtml1='<span id="'+r.id+'" onClick="CambiarEstado1(0,'+r.id+')" class="btn btn-success">Aprobado Almacen</span>';
        }else if(r.estado_transferir==3){
            estadohtml1='<span id="'+r.id+'" class="btn btn-warning">Denegado</span>';
        }
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='local_destino'>"+r.local_destino+"</td>"+
            "<td class='local_origen'>"+r.local_origen+"</td>"+
            "<td class='cantidad'>"+r.cantidad+"</td>"+
            "<td class='fecha_transferir'>"+r.fecha_transferir+"</td>"+
            "<td>";
        html+="<input type='hidden' class='fecha_transferir' value='"+r.fecha_transferir+"'>"+
              "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml1+"</td>"+
              "<td><input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
        html+="</tr>";
    });
    $("#TableTransferir tbody").html(html); 
    $("#TableTransferir").DataTable({
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
            $('#TableTransferir_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarTransferir','AjaxTransferir',result.data,'#TableTransferir_paginate');
        }
    });

};
LimpiarTransferirModal=function(limpiar){
    $("#"+limpiar).val('');
};
</script>
