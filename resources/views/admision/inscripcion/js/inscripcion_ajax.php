<script type="text/javascript">
var AjaxInscripcion={
    CargarLocal:function(evento){
        var data={};
        url='AjaxDinamic/Mantenimiento.LocalMA@listLocal';
        masterG.postAjax(url,data,evento);
    },
    CargarModalidad:function(evento){
        var data={};
        url='AjaxDinamic/PlanEstudio.ModalidadPE@listModalidad';
        masterG.postAjax(url,data,evento);
    },
    CargarPersonaAdicional:function(evento){
        url='AjaxDinamic/Mantenimiento.PersonaEM@LoadAdicional';
        data={persona_id:InscripcionG.persona_id,todo:1};
        masterG.postAjax(url,data,evento);
    },
};

var PersonaOpciones = {
    placeholder: 'Persona',
    url: "AjaxDinamic/Mantenimiento.PersonaEM@ListPersona",
    listLocation: "data",
    getValue: "persona",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#InscripcionForm #txt_inscrito").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#InscripcionForm #txt_inscrito").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var persona_id = $("#InscripcionForm #txt_inscrito").getSelectedItemData().id;
            var dni = $("#InscripcionForm #txt_inscrito").getSelectedItemData().dni;
            $("#InscripcionForm #txt_inscrito_id").val(persona_id).trigger("change");
            $("#InscripcionForm #txt_dni").val(dni).trigger("change");
            $("#InscripcionForm #txt_inscrito_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            InscripcionG.persona_id=persona_id;
            AjaxInscripcion.CargarPersonaAdicional(HTMLPersonaAdicional);
        },
        onLoadEvent: function() {
            $("#InscripcionForm #txt_inscrito_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('#InscripcionForm .adicionales').val('');
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
</script>
