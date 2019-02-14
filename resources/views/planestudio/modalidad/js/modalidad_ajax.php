<script type="text/javascript">
var AjaxModalidad={
    AgregarEditar:function(evento){
        var data=$("#ModalModalidadForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.ModalidadPE@New';
        if(AddEdit==0){
            url='AjaxDinamic/PlanEstudio.ModalidadPE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#ModalidadForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#ModalidadForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalidadForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.ModalidadPE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalModalidadForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalModalidadForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalModalidadForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalModalidadForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.ModalidadPE@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
