<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var EmpleadoG={id:0,persona_id:"",persona:"",dni:"",cargo_id:"",cargo:"",local_id:"",local:"",codigo_local:"",medio_captacion_id:"",medio_captacion:"",codigo:"",fecha_ingreso:"",fecha_cese:"",estado:1}; // Datos Globales
var PersonaOpciones = {
    placeholder: 'Persona',
    url: "AjaxDinamic/Mantenimiento.PersonaEM@ListPersona",
    listLocation: "data",
    getValue: "persona",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalEmpleadoForm #txt_persona").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalEmpleadoForm #txt_persona").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_persona").getSelectedItemData().id;
            var value2 = $("#ModalEmpleadoForm #txt_persona").getSelectedItemData().dni;
            $("#ModalEmpleadoForm #txt_persona_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_dni").val(value2).trigger("change");
            $("#ModalEmpleadoForm #txt_persona_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalEmpleadoForm #txt_persona_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
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
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalEmpleadoForm #txt_cargo").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalEmpleadoForm #txt_cargo").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_cargo").getSelectedItemData().id;
            $("#ModalEmpleadoForm #txt_cargo_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_cargo_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalEmpleadoForm #txt_cargo_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
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
                msjG.mensaje('warning',$("#ModalEmpleadoForm #txt_local").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalEmpleadoForm #txt_local").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_local").getSelectedItemData().id;
            var value2 = $("#ModalEmpleadoForm #txt_local").getSelectedItemData().codigo;
            $("#ModalEmpleadoForm #txt_local_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_codigo_local").val(value2).trigger("change");
            $("#ModalEmpleadoForm #txt_local_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalEmpleadoForm #txt_local_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
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
var MedioCaptacionOpciones = {
    placeholder: 'MedioCaptacion',
    url: "AjaxDinamic/Mantenimiento.MedioCaptacionMA@ListMedioCaptacionComision",
    listLocation: "data",
    getValue: "medio_captacion",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalEmpleadoForm #txt_medio_captacion").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalEmpleadoForm #txt_medio_captacion").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalEmpleadoForm #txt_medio_captacion").getSelectedItemData().id;
            $("#ModalEmpleadoForm #txt_medio_captacion_id").val(value).trigger("change");
            $("#ModalEmpleadoForm #txt_medio_captacion_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalEmpleadoForm #txt_medio_captacion_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
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
            $("#ModalEmpleadoForm #txt_medio_captacion_ico, #ModalEmpleadoForm #txt_persona_ico, #ModalEmpleadoForm #txt_local_ico, #ModalEmpleadoForm #txt_cargo_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('#ModalEmpleadoForm #txt_persona').removeAttr( 'disabled' );
        }
        else{
            $('#ModalEmpleadoForm #txt_persona').attr( 'disabled','true' );
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalEmpleadoForm").append("<input type='hidden' value='"+EmpleadoG.id+"' name='id'>");
            $("#ModalEmpleadoForm #txt_medio_captacion_ico, #ModalEmpleadoForm #txt_persona_ico, #ModalEmpleadoForm #txt_local_ico, #ModalEmpleadoForm #txt_cargo_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            if( EmpleadoG.medio_captacion_id=='' ){
                $("#ModalEmpleadoForm #txt_medio_captacion_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            }
        }
        $('#ModalEmpleadoForm #txt_persona').val( EmpleadoG.persona );
        $('#ModalEmpleadoForm #txt_persona_id').val( EmpleadoG.persona_id );
        $('#ModalEmpleadoForm #txt_dni  ').val( EmpleadoG.dni  );
        $('#ModalEmpleadoForm #txt_codigo').val( EmpleadoG.codigo );
        $('#ModalEmpleadoForm #txt_cargo').val( EmpleadoG.cargo );
        $('#ModalEmpleadoForm #txt_cargo_id').val( EmpleadoG.cargo_id );
        $('#ModalEmpleadoForm #txt_local').val( EmpleadoG.local );
        $('#ModalEmpleadoForm #txt_local_id').val( EmpleadoG.local_id );
        $('#ModalEmpleadoForm #txt_codigo_local').val( EmpleadoG.codigo_local );
        $('#ModalEmpleadoForm #txt_medio_captacion').val( EmpleadoG.medio_captacion );
        $('#ModalEmpleadoForm #txt_medio_captacion_id').val( EmpleadoG.medio_captacion_id );
        $('#ModalEmpleadoForm #txt_fecha_ingreso').val( EmpleadoG.fecha_ingreso );
        $('#ModalEmpleadoForm #txt_fecha_cese').val( EmpleadoG.fecha_cese );
    });

    $('#ModalEmpleado').on('hidden.bs.modal', function (event) {
        $("#ModalEmpleadoForm input[type='hidden']").not('.mant').remove();
        $("#ModalEmpleadoForm input,#ModalEmpleadoForm select,#ModalEmpleadoForm textarea").val('');
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $("#ModalEmpleadoForm #txt_persona_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione una persona',4000);
    }
    else if(  $("#ModalEmpleadoForm #txt_cargo_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione puesto de trabajo',4000);
    }
    else if(  $("#ModalEmpleadoForm #txt_local_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y seleccione local',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    EmpleadoG.id='';
    EmpleadoG.persona_id='';
    EmpleadoG.persona='';
    EmpleadoG.dni='';
    EmpleadoG.local_id='';
    EmpleadoG.local='';
    EmpleadoG.codigo_local='';
    EmpleadoG.cargo_id='';
    EmpleadoG.cargo='';
    EmpleadoG.medio_captacion_id='';
    EmpleadoG.medio_captacion='';
    EmpleadoG.codigo='';
    EmpleadoG.fecha_ingreso='';
    EmpleadoG.fecha_cese='';
    if( val==0 ){
        EmpleadoG.id=id;
        EmpleadoG.persona_id=$("#TableEmpleado #trid_"+id+" .persona_id").val();
        EmpleadoG.persona=$("#TableEmpleado #trid_"+id+" .paterno").text()+' '+$("#TableEmpleado #trid_"+id+" .materno").text()+', '+$("#TableEmpleado #trid_"+id+" .nombre").text();
        EmpleadoG.dni=$("#TableEmpleado #trid_"+id+" .dni").text();
        EmpleadoG.local_id=$("#TableEmpleado #trid_"+id+" .local_id").val();
        EmpleadoG.local=$("#TableEmpleado #trid_"+id+" .local").val();
        EmpleadoG.codigo_local=$("#TableEmpleado #trid_"+id+" .codigo_local").val();
        EmpleadoG.cargo_id=$("#TableEmpleado #trid_"+id+" .cargo_id").val();
        EmpleadoG.cargo=$("#TableEmpleado #trid_"+id+" .cargo").val();
        EmpleadoG.medio_captacion_id=$("#TableEmpleado #trid_"+id+" .medio_captacion_id").val();
        EmpleadoG.medio_captacion=$("#TableEmpleado #trid_"+id+" .medio_captacion").val();
        EmpleadoG.codigo=$("#TableEmpleado #trid_"+id+" .codigo").text();
        EmpleadoG.fecha_ingreso=$("#TableEmpleado #trid_"+id+" .fecha_ingreso").val();
        EmpleadoG.fecha_cese=$("#TableEmpleado #trid_"+id+" .fecha_cese").val();
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
                "<input type='hidden' class='cargo' value='"+r.cargo+"'>"+
                "<input type='hidden' class='local_id' value='"+r.local_id+"'>"+
                "<input type='hidden' class='local' value='"+r.local+"'>"+
                "<input type='hidden' class='codigo_local' value='"+r.codigo_local+"'>"+
                "<input type='hidden' class='medio_captacion_id' value='"+$.trim(r.medio_captacion_id)+"'>"+
                "<input type='hidden' class='medio_captacion' value='"+$.trim(r.medio_captacion)+"'>"+
                "<input type='hidden' class='fecha_ingreso' value='"+$.trim(r.fecha_inicio)+"'>"+
                "<input type='hidden' class='fecha_cese' value='"+$.trim(r.fecha_final)+"'>"+
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
