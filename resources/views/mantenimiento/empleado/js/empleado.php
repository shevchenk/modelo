<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var EmpleadoG={id:0,persona_id:"",cargo_id:"",local_id:"",medio_captacion_id:"",codigo:"",estado:1}; // Datos Globales
var PersonaOpciones = {
    placeholder: 'Persona',
    url: "AjaxDinamic/Mantenimiento.PersonaEM@ListPersona",
    listLocation: "data",
    getValue: "persona",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_persona").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_persona").getSelectedItemData().id;
            var value2 = $("#ModalEmpleadoForm #txt_persona").getSelectedItemData().dni;
            $("#ModalEmpleadoForm #txt_persona_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_dni").val(value2).trigger("change");
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
var CargoOpciones = {
    placeholder: 'Puesto de Trabajo',
    url: "AjaxDinamic/Mantenimiento.CargoEM@ListCargo",
    listLocation: "data",
    getValue: "cargo",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_cargo").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_cargo").getSelectedItemData().id;
            $("#ModalEmpleadoForm #txt_cargo_id").val(value).trigger("change");
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
        data.phrase = $("#txt_local").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalEmpleadoForm #txt_local").getSelectedItemData().codigo;
            $("#ModalEmpleadoForm #txt_local_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_codigo_local").val(value2).trigger("change");
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
var MedioCaptacionOpciones = {
    placeholder: 'MedioCaptacion',
    url: "AjaxDinamic/Mantenimiento.MedioCaptacionMA@ListMedioCaptacionComision",
    listLocation: "data",
    getValue: "medio_captacion",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_medio_captacion").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_medio_captacion").getSelectedItemData().id;
            $("#ModalEmpleadoForm #txt_medio_captacion_id").val(value).trigger("change");
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    $("#TableEmpleado").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalEmpleadoForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

    AjaxEmpleado.Cargar(HTMLCargarEmpleado);
    $("#ModalEmpleadoForm #txt_persona").easyAutocomplete(PersonaOpciones);
    $("#ModalEmpleadoForm #txt_cargo").easyAutocomplete(CargoOpciones);
    $("#ModalEmpleadoForm #txt_local").easyAutocomplete(LocalOpciones);
    $("#ModalEmpleadoForm #txt_medio_captacion").easyAutocomplete(MedioCaptacionOpciones);
    
    $("#ModalEmpleadoForm #TableEmpleado select").change(function(){ AjaxEmpleado.Cargar(HTMLCargarEmpleado); });
    $("#ModalEmpleadoForm #TableEmpleado input").blur(function(){ AjaxEmpleado.Cargar(HTMLCargarEmpleado); });
    
    $('#ModalEmpleado').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalEmpleadoForm").append("<input type='hidden' value='"+EmpleadoG.id+"' name='id'>");
        }
        $('#ModalEmpleadoForm #txt_empleado').val( EmpleadoG.empleado );
        $('#ModalEmpleadoForm #slct_estado').selectpicker( 'val',EmpleadoG.estado );
        $('#ModalEmpleadoForm #txt_empleado').focus();
    });

    $('#ModalEmpleado').on('hidden.bs.modal', function (event) {
        $("#ModalEmpleadoForm input[type='hidden']").not('.mant').remove();
        $("#ModalEmpleadoForm input,#ModalEmpleadoForm select,#ModalEmpleadoForm textarea").val('');
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $.trim( $("#ModalEmpleadoForm #txt_persona").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione una persona',4000);
    }
    else if(  $.trim( $("#ModalEmpleadoForm #txt_cargo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione puesto de trabajo',4000);
    }
    else if(  $.trim( $("#ModalEmpleadoForm #txt_local").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione local',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    EmpleadoG.id='';
    EmpleadoG.persona_id='';
    EmpleadoG.local_id='';
    EmpleadoG.cargo_id='';
    EmpleadoG.medio_captacion_id='';
    EmpleadoG.codigo='';
    EmpleadoG.estado='1';
    if( val==0 ){
        EmpleadoG.id=id;
        EmpleadoG.persona_id=$("#TableEmpleado #trid_"+id+" .persona_id").val();
        EmpleadoG.local_id=$("#TableEmpleado #trid_"+id+" .local_id").val();
        EmpleadoG.cargo_id=$("#TableEmpleado #trid_"+id+" .cargo_id").val();
        EmpleadoG.medio_captacion_id=$("#TableEmpleado #trid_"+id+" .medio_captacion_id").val();
        EmpleadoG.codigo=$("#TableEmpleado #trid_"+id+" .codigo").text();
        EmpleadoG.estado=$("#TableEmpleado #trid_"+id+" .estado").val();
    }
    else{
        $("#ModalEmpleadoForm input[type='hidden']").not('.mant').remove();
        $("#ModalEmpleadoForm input,#ModalEmpleadoForm select,#ModalEmpleadoForm textarea").val('');
    }
    $('#ModalEmpleado').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxEmpleado.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxEmpleado.Cargar(HTMLCargarEmpleado);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxEmpleado.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalEmpleado').modal('hide');
        AjaxEmpleado.Cargar(HTMLCargarEmpleado);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarEmpleado=function(result){

    var html="";
    $('#TableEmpleado').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='paterno'>"+r.paterno+"</td>"+
            "<td class='materno'>"+r.materno+"</td>"+
            "<td class='nombre'>"+r.nombre+"</td>"+
            "<td class='dni'>"+r.dni+"</td>"+
            "<td class='codigo'>"+r.codigo+"</td>"+
            "<td>";
        html+="<input type='hidden' class='persona_id' value='"+r.persona_id+"'>"+
                "<input type='hidden' class='cargo_id' value='"+r.cargo_id+"'>"+
                "<input type='hidden' class='local_id' value='"+r.local_id+"'>"+
                "<input type='hidden' class='medio_captacion_id' value='"+r.medio_captacion_id+"'>"+
                estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableEmpleado tbody").html(html); 
    $("#TableEmpleado").DataTable({
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
            $('#TableEmpleado_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarEmpleado','AjaxEmpleado',result.data,'#TableEmpleado_paginate');
        }
    });

};

</script>
