<script type="text/javascript">
var AjaxLocal={
    AgregarEditar:function(evento){
        var data=$("#ModalLocalForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.LocalMA@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.LocalMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#LocalForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#LocalForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#LocalForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.LocalMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalLocalForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalLocalForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalLocalForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalLocalForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.LocalMA@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
