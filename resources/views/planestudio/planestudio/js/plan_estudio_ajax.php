<script type="text/javascript">
var AjaxPlanEstudio={
    AgregarEditar:function(evento){
        var data=$("#ModalPlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@New';
        if(AddEditPlanEstudio==0){
            url='AjaxDinamic/PlanEstudio.PlanEstudioPE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PlanEstudioForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PlanEstudioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPlanEstudioForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPlanEstudioForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalPlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPlanEstudioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
