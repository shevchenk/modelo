<script type="text/javascript">
var AjaxPersona={
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PersonaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PersonaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PersonaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PersonaEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPersonaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPersonaForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalPersonaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPersonaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PersonaEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
