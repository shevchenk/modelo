<script type="text/javascript">
var PersonaOpciones = {
    placeholder: 'Persona',
    url: "AjaxDinamic/Mantenimiento.PersonaEM@ListPersona",
    listLocation: "data",
    getValue: "persona",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#EntidadForm #txt_persona").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#EntidadForm #txt_persona").getSelectedItemData().id;
            var value2 = $("#EntidadForm #txt_persona").getSelectedItemData().dni;
            $("#EntidadForm #txt_persona_id").val(value).trigger("change");
            $("#EntidadForm #txt_dni").val(value2).trigger("change");
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
    $("#EntidadForm #txt_persona").easyAutocomplete(PersonaOpciones);
    EntidadAjax.Cargar(HTMLCargarEntidad);
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#EntidadForm #txt_persona").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Persona',4000);
    }
    else if( $.trim( $("#EntidadForm #txt_entidad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese nombre de la empresa',4000);
    }
    else if( $.trim( $("#EntidadForm #txt_nombre_comercial").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese nombre comercial de la empresa',4000);
    }
    else if( $.trim( $("#EntidadForm #txt_ruc").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese RUC de la empresa',4000);
    }
    else if( $.trim( $("#EntidadForm #txt_igv").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese igv',4000);
    }
    return r;
}

EditarAjax=function(){
    if( ValidaForm() ){
        EntidadAjax.Editar(HTMLEditar);
    }
}

HTMLCargarEntidad=function(result){
    $('#EntidadForm input').val('');
    $('#EntidadForm .img-circle').removeAttr('src');
    $.each(result.data,function(index,r){
        $("#EntidadForm #txt_persona_id").val(r.persona_id);
        $("#EntidadForm #txt_persona").val(r.paterno+' '+r.materno+', '+r.nombre);
        $("#EntidadForm #txt_dni").val(r.dni);
        $("#EntidadForm #txt_entidad").val(r.entidad);
        $("#EntidadForm #txt_ruc").val(r.ruc);
        $("#EntidadForm #txt_nombre_comercial").val(r.nombre_comercial);
        $("#EntidadForm #txt_igv").val(r.igv);
        $('#EntidadForm #txt_imagen_nombre').val( $.trim(r.logo) );
        $('#EntidadForm .img-circle').attr('src', $.trim(r.logo) );
    })
}

HTMLEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}
</script>
