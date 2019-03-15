<script type="text/javascript">
var AjaxPabellon={
    AgregarEditar:function(evento){
        var data=$("#ModalPabellonForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.PabellonMA@New';
        if(AddEditPabellon==0){
            url='AjaxDinamic/Mantenimiento.PabellonMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PabellonForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PabellonForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PabellonForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PabellonMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPabellonForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPabellonForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalPabellonForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPabellonForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PabellonMA@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
