<script type="text/javascript">
var AjaxAmbiente={
    AgregarEditar:function(evento){
        var data=$("#ModalAmbienteForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.AmbienteMA@New';
        if(AddEditAmbiente==0){
            url='AjaxDinamic/Mantenimiento.AmbienteMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#AmbienteForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#AmbienteForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#AmbienteForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.AmbienteMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalAmbienteForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalAmbienteForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalAmbienteForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalAmbienteForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.AmbienteMA@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
