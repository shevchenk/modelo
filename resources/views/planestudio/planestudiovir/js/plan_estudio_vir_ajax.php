<script type="text/javascript">
var AjaxPlanEstudio={
    AgregarEditar:function(evento){
        var data=$("#ModalPlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@EditVir';
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PlanEstudioForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PlanEstudioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@LoadVir';
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
    Replicar:function(evento,id){
        $("#ModalPlanEstudioForm").append("<input type='hidden' value='"+id+"' name='id'>");
        $("#ModalPlanEstudioForm").append("<input type='hidden' value='"+$("#TablePlanEstudio #trid_"+id+" .plan_estudio").text()+"' name='plan_estudio'>");
        data=$("#ModalPlanEstudioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPlanEstudioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.PlanEstudioPE@Replicar';
        masterG.postAjax(url,data,evento);
    },
};
</script>
