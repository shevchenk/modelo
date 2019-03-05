<script type="text/javascript">
var AjaxTransferir={
    AgregarEditar:function(evento){
        var data=$("#ModalTransferirForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.TransferirMA@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.TransferirMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#TransferirForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#TransferirForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#TransferirForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TransferirMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalTransferirForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalTransferirForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalTransferirForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalTransferirForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TransferirMA@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
