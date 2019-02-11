<script type="text/javascript">
var AjaxNivel1={
    AgregarEditar1:function(evento){
        var data=$("#ModalNivel1Form").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.Nivel1EM@New';
        if(AddEdit1==0){
            url='AjaxDinamic/Mantenimiento.Nivel1EM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar1:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#Nivel1Form").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#Nivel1Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#Nivel1Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.Nivel1EM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado1:function(evento,AI,id){
        $("#ModalNivel1Form").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalNivel1Form").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalNivel1Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalNivel1Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.Nivel1EM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
