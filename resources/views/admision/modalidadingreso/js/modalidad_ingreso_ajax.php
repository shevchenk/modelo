<script type="text/javascript">
var AjaxModalidadIngreso={
    AgregarEditar:function(evento){
        var data=$("#ModalModalidadIngresoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Admision.ModalidadIngresoAD@New';
        if(AddEditModalidadIngreso==0){
            url='AjaxDinamic/Admision.ModalidadIngresoAD@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#ModalidadIngresoForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#ModalidadIngresoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalidadIngresoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.ModalidadIngresoAD@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalModalidadIngresoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalModalidadIngresoForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalModalidadIngresoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalModalidadIngresoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.ModalidadIngresoAD@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
