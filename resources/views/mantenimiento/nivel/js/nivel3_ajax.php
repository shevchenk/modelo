<script type="text/javascript">
var AjaxNivel={
    AgregarEditar:function(evento){
        var data=$("#ModalNivel3Form").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.Nivel3EM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.Nivel3EM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#Nivel3Form").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#Nivel3Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#Nivel3Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.Nivel3EM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalNivel3Form").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalNivel3Form").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalNivel3Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalNivel3Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.Nivel3EM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
