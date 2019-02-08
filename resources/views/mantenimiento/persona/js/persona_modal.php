<script type="text/javascript">
var persona_id, EliminarId="";
var AddEdit=0; //0: Editar | 1: Agregar
var PersonaG = {id:0,
    paterno:"",
    materno:"",
    nombre:"",
    dni:"",
    sexo:0,
    email:"",
    password:"",
    telefono:"",
    celular:"",
    fecha_nacimiento:"",
    estado_civil:"",
    estado:1
}; // Datos Globales
var PersonaAdicionalG = {colegio_id:"",
    pais_id:"",
    region_id:"",
    provincia_id:"",
    distrito_id:"",
    region_id_dir:"",
    provincia_id_dir:"",
    distrito_id_dir:"",
    direccion:"",
    tenencia:0,
    empresa_laboral:"",
    empresa_direccion:"",
    empresa_telefono:""
}; // Datos Adicionales

var ColegioOpciones = {
    placeholder: 'Colegio',
    url: "AjaxDinamic/Mantenimiento.ColegioMA@ListColegio",
    listLocation: "data",
    getValue: "colegio",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPersonaForm #txt_colegio").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPersonaForm #txt_colegio").getSelectedItemData().id;
            $("#ModalPersonaForm #txt_colegio_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "distrito"
        }
        /*type: "custom",
        method: function(value, item) {
            return value+' - '+'<b>Distrito:</b>'+item.distrito;
        }*/
    },
    adjustWidth:false,
};
var PaisOpciones = {
    placeholder: 'Pais',
    url: "AjaxDinamic/Mantenimiento.PaisMA@ListPais",
    listLocation: "data",
    getValue: "pais",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_pais").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPersonaForm #txt_pais").getSelectedItemData().id;
            $("#ModalPersonaForm #txt_pais_id").val(value).trigger("change");
        },
        onClickEvent: function() {
            $(".paisafectado input").removeAttr('disabled');
            if( $("#ModalPersonaForm #txt_pais").getSelectedItemData().id!=173 ){
                $(".paisafectado input,.paisafectado2 input").val('').attr('disabled','true');
            }
        }
    },
    template: {
        type: "description",
        fields: {
            description: "abreviatura"
        }
    },
    adjustWidth:false,
};
var DistritoOpciones = {
    placeholder: 'Distrito',
    url: "AjaxDinamic/Mantenimiento.DistritoMA@ListDistrito",
    listLocation: "data",
    getValue: "distrito",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_distrito").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPersonaForm #txt_distrito").getSelectedItemData().id;
            var value2 = $("#ModalPersonaForm #txt_distrito").getSelectedItemData().provincia_id;
            var value3 = $("#ModalPersonaForm #txt_distrito").getSelectedItemData().region_id;
            var value4 = $("#ModalPersonaForm #txt_distrito").getSelectedItemData().provincia;
            var value5 = $("#ModalPersonaForm #txt_distrito").getSelectedItemData().region;
            $("#ModalPersonaForm #txt_distrito_id").val(value).trigger("change");
            $("#ModalPersonaForm #txt_provincia_id").val(value2).trigger("change");
            $("#ModalPersonaForm #txt_region_id").val(value3).trigger("change");
            $("#ModalPersonaForm #txt_provincia").val(value4).trigger("change");
            $("#ModalPersonaForm #txt_region").val(value5).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "detalle"
        }
    },
    adjustWidth:false,
};
var DistritoDirOpciones = {
    placeholder: 'Distrito',
    url: "AjaxDinamic/Mantenimiento.DistritoMA@ListDistrito",
    listLocation: "data",
    getValue: "distrito",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#txt_distrito_dir").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalPersonaForm #txt_distrito_dir").getSelectedItemData().id;
            var value2 = $("#ModalPersonaForm #txt_distrito_dir").getSelectedItemData().provincia_id;
            var value3 = $("#ModalPersonaForm #txt_distrito_dir").getSelectedItemData().region_id;
            var value4 = $("#ModalPersonaForm #txt_distrito_dir").getSelectedItemData().provincia;
            var value5 = $("#ModalPersonaForm #txt_distrito_dir").getSelectedItemData().region;
            $("#ModalPersonaForm #txt_distrito_id_dir").val(value).trigger("change");
            $("#ModalPersonaForm #txt_provincia_id_dir").val(value2).trigger("change");
            $("#ModalPersonaForm #txt_region_id_dir").val(value3).trigger("change");
            $("#ModalPersonaForm #txt_provincia_dir").val(value4).trigger("change");
            $("#ModalPersonaForm #txt_region_dir").val(value5).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "detalle"
        }
    },
    adjustWidth:false,
};

$(document).ready(function() {

    AjaxPersonaModal.CargarPrivilegio(SlctCargarPrivilegio);
    AjaxPersonaModal.CargarLocal(SlctCargarLocal);
    $("#ModalPersonaForm #txt_colegio").easyAutocomplete(ColegioOpciones);
    $("#ModalPersonaForm #txt_pais").easyAutocomplete(PaisOpciones);
    $("#ModalPersonaForm #txt_distrito").easyAutocomplete(DistritoOpciones);
    $("#ModalPersonaForm #txt_distrito_dir").easyAutocomplete(DistritoDirOpciones);
    $("#ModalPersonaForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

    $('#ModalPersona').on('shown.bs.modal', function (event) {
        CargarModal();
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalPersonaForm").append("<input type='hidden' value='"+PersonaG.id+"' name='id'>");
        }

        $('#ModalPersonaForm #txt_paterno').val( PersonaG.paterno );
        $('#ModalPersonaForm #txt_materno').val( PersonaG.materno );
        $('#ModalPersonaForm #txt_nombre').val( PersonaG.nombre );
        $('#ModalPersonaForm #txt_dni').val( PersonaG.dni );
        $('#ModalPersonaForm #slct_sexo').val( PersonaG.sexo );
        $('#ModalPersonaForm #txt_email').val( PersonaG.email );
        $('#ModalPersonaForm #txt_telefono').val( PersonaG.telefono );
        $('#ModalPersonaForm #txt_password').val( PersonaG.password );
        $('#ModalPersonaForm #txt_celular').val( PersonaG.celular );
        $('#ModalPersonaForm #txt_fecha_nacimiento').val( PersonaG.fecha_nacimiento );
        $('#ModalPersonaForm #slct_estado_civil').val( PersonaG.estado_civil );
        $('#ModalPersonaForm #slct_estado').val( PersonaG.estado );

        $("#ModalPersonaForm select").not('.mant').selectpicker('refresh');
        $('#ModalPersonaForm #txt_nombre').focus();
    });

    $('#ModalPersona').on('hidden.bs.modal', function (event) {
        $("#ModalPersonaForm input[type='hidden']").not('.mant').remove();
        $("#MPdatoadicional input,#MPdatoadicional select").val('');
        $('#ModalPersonaForm select').not('.mant').selectpicker('destroy');
    });
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalPersonaForm #txt_nombre").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Nombre',4000);
    }
    else if( $.trim( $("#ModalPersonaForm #txt_paterno").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Apellido Paterno',4000);
    }
    else if( $.trim( $("#ModalPersonaForm #txt_materno").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Apellido Materno',4000);
    }
    else if( $.trim( $("#ModalPersonaForm #txt_dni").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese DNI',4000);
    }
    else if( $.trim( $("#ModalPersonaForm #slct_sexo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Sleccione Sexo',4000);
    }
   
   
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    PersonaG.id='';
    PersonaG.paterno='';
    PersonaG.materno='';
    PersonaG.nombre='';
    PersonaG.dni='';
    PersonaG.sexo='0';
    PersonaG.email='';
    PersonaG.password='';
    PersonaG.telefono='';
    PersonaG.celular='';
    PersonaG.fecha_nacimiento='';
    PersonaG.estado_civil='S';
    PersonaG.estado='1';
    if( val==0 ){
        PersonaG.id=id;
        PersonaG.paterno=$("#TablePersona #trid_"+id+" .paterno").text();
        PersonaG.materno=$("#TablePersona #trid_"+id+" .materno").text();
        PersonaG.nombre=$("#TablePersona #trid_"+id+" .nombre").text();
        PersonaG.dni=$("#TablePersona #trid_"+id+" .dni").text();
        PersonaG.sexo=$("#TablePersona #trid_"+id+" .sexo").val();
        PersonaG.email=$("#TablePersona #trid_"+id+" .email").text();
        PersonaG.telefono=$("#TablePersona #trid_"+id+" .telefono").val();
        PersonaG.celular=$("#TablePersona #trid_"+id+" .celular").val();
        PersonaG.fecha_nacimiento=$("#TablePersona #trid_"+id+" .fecha_nacimiento").val();
        PersonaG.estado_civil=$("#TablePersona #trid_"+id+" .estado_civil").val();
        PersonaG.estado=$("#TablePersona #trid_"+id+" .estado").val();
    }
    $('#ModalPersona').modal('show');
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxPersonaModal.AgregarEditar(HTMLAgregarEditar);
    }
}

CargarModal=function(){
    if( AddEdit==0 ){
        AjaxPersonaModal.CargarPersonaAdicional(HTMLPersonaAdicional);
        AjaxPersonaModal.CargarPersonaPrivilegio(HTMLPersonaPrivilegio);
    }
}

HTMLPersonaAdicional=function(result){
    $('#ModalPersonaForm #txt_pais_id').val( $.trim(result.data.pais_id) );
    $('#ModalPersonaForm #txt_colegio_id').val( $.trim(result.data.colegio_id) );
    $('#ModalPersonaForm #txt_region_id').val( $.trim(result.data.region_id) );
    $('#ModalPersonaForm #txt_provincia_id').val( $.trim(result.data.provincia_id) );
    $('#ModalPersonaForm #txt_distrito_id').val( $.trim(result.data.distrito_id) );
    $('#ModalPersonaForm #txt_region_id_dir').val( $.trim(result.data.region_id_dir) );
    $('#ModalPersonaForm #txt_provincia_id_dir').val( $.trim(result.data.provincia_id_dir) );
    $('#ModalPersonaForm #txt_distrito_id_dir').val( $.trim(result.data.distrito_id_dir) );
    $('#ModalPersonaForm #txt_direccion').val( $.trim(result.data.direccion) );
    $('#ModalPersonaForm #slct_tenencia').val( $.trim(result.data.tenencia) );
    $('#ModalPersonaForm #txt_empresa_laboral').val( $.trim(result.data.empresa_laboral) );
    $('#ModalPersonaForm #txt_direccion_laboral').val( $.trim(result.data.direccion_laboral) );
    $('#ModalPersonaForm #txt_telefono_laboral').val( $.trim(result.data.telefono_laboral) );

    $('#ModalPersonaForm #txt_pais').val( $.trim(result.data.pais) );
    $('#ModalPersonaForm #txt_colegio').val( $.trim(result.data.colegio) );
    $('#ModalPersonaForm #txt_region').val( $.trim(result.data.region) );
    $('#ModalPersonaForm #txt_provincia').val( $.trim(result.data.provincia) );
    $('#ModalPersonaForm #txt_distrito').val( $.trim(result.data.distrito) );
    $('#ModalPersonaForm #txt_region_dir').val( $.trim(result.data.region_dir) );
    $('#ModalPersonaForm #txt_provincia_dir').val( $.trim(result.data.provincia_dir) );
    $('#ModalPersonaForm #txt_distrito_dir').val( $.trim(result.data.distrito_dir) );
    $("#ModalPersonaForm select").not('.mant').selectpicker('refresh');

    $(".paisafectado input").removeAttr('disabled');
    if( $.trim(result.data.pais_id)!=173 ){
        $(".paisafectado input,.paisafectado2 input").attr('disabled','true');
    }
}

HTMLPersonaPrivilegio=function(result){
    var html=""; var local_ids="";
    $("#TablePrivilegio select").selectpicker('destroy');
    $('#TablePrivilegio tbody').html('');
    $.each(result.data,function(index,r){
        html=  "<tr>"+
                    "<td>"+
                        r.privilegio+
                        "<input type='hidden' name='privilegio_id[]' value='"+r.privilegio_id+"'>"+
                    "</td>"+
                    "<td>"+
                        "<select id='slct_locales"+r.privilegio_id+"' name='slct_locales"+r.privilegio_id+"[]' class='form-control selectpicker show-menu-arrow' data-live-search='true' multiple>"+
                        "<option value=''>.::Todos::.</option>"+
                        $("#ModalPersonaForm #slct_locales").html()+
                        "</select>"+
                    "</td>"+
                    "<td>"+
                        "<button type='button' class='btn btn-danger' Onclick='EliminarPrivilegio(this);'>"+
                            "<i class='fa fa-trash fa-sm'></i>"+
                        "</button>"+
                    "</td>"+
                "</tr>";
        $("#TablePrivilegio tbody").append(html); 
        local_ids=r.local_ids.split(",");
        $("#ModalPersonaForm #slct_locales"+r.privilegio_id).val(local_ids);
        $("#ModalPersonaForm #slct_locales"+r.privilegio_id).selectpicker('refresh');
    });
}

LimpiarPersonaModal=function(limpiar){
    $("#"+limpiar).val('');
}

SlctCargarPrivilegio=function(result){
    var html="<option value=''>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.privilegio+"</option>";
    });
    $("#ModalPersonaForm #slct_privilegios").html(html); 
    $("#ModalPersonaForm #slct_privilegios").selectpicker('refresh');
}

SlctCargarLocal=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.local+"</option>";
    });
    $("#ModalPersonaForm #slct_locales").html(html);
}

AgregarPrivilegio=function(){
    var id = $("#ModalPersonaForm #slct_privilegios").val();
    if( id!='' ){
        var texto= $("#ModalPersonaForm #slct_privilegios option[value='"+id+"']").text();

        if ( $.trim($("#TablePrivilegio #slct_locales"+id).html())=='' ){
            html="<tr>"+
                    "<td>"+
                        texto+
                        "<input type='hidden' name='privilegio_id[]' value='"+id+"'>"+
                    "</td>"+
                    "<td class='id"+id+"'>"+
                        "<select id='slct_locales"+id+"' name='slct_locales"+id+"[]' class='form-control selectpicker show-menu-arrow' data-live-search='true' multiple>"+
                        "<option value=''>.::Todos::.</option>"+
                        $("#ModalPersonaForm #slct_locales").html()+
                        "</select>"+
                    "</td>"+
                    "<td>"+
                        "<button type='button' class='btn btn-danger' Onclick='EliminarPrivilegio(this);'>"+
                            "<i class='fa fa-trash fa-sm'></i>"+
                        "</button>"+
                    "</td>"+
                "</tr>";
            $("#TablePrivilegio tbody").append(html); 
            $("#ModalPersonaForm #slct_locales"+id).selectpicker('refresh');
        }
        else{
            msjG.mensaje('warning','El privilegio ('+texto+') ya existe',3000);
        }
    }
    else{
        msjG.mensaje('warning','Seleccione privilegio',3000);
    }
}

EliminarPrivilegio=function(t){
    EliminarId=t;
    sweetalertG.confirm('Nivel de Acceso','Desea eliminar el privilegio?',EliminarPrivilegioOk);
}

EliminarPrivilegioOk=function(){
    $(EliminarId).parent().parent().remove();
}

Fecha=function(){
    $(".fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });
}

FechaAnio=function(){
    $(".fechaanio").datetimepicker({
        format: "yyyy",
        language: 'es',
        startView: 'decade',
        minView: 'decade',
        viewSelect: 'decade',
        autoclose: true,
    });
}
</script>
