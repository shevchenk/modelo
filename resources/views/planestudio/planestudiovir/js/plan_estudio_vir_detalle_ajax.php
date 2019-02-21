<script type="text/javascript">
var AjaxPlanEstudioDetalle={
    Cargar:function(evento){
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").attr("disabled","true");
        var data=$("#PlanEstudioDetalleForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").removeAttr("disabled");
        url='AjaxDinamic/PlanEstudio.PlanEstudioDetallePE@Load';
        masterG.postAjax(url,data,evento);
    },
    CargarResumen:function(evento){
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").attr("disabled","true");
        var data=$("#PlanEstudioDetalleForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").removeAttr("disabled");
        url='AjaxDinamic/PlanEstudio.PlanEstudioDetallePE@LoadResumen';
        masterG.postAjax(url,data,evento);
    },
    CargarCiclo:function(evento){
        url='AjaxDinamic/PlanEstudio.CicloPE@ListCiclo';
        data={};
        masterG.postAjax(url,data,evento);
    },
    Actualizar:function(evento,id){
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").attr("disabled","true");
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle #tr select,#PlanEstudioDetalleForm #TablePlanEstudioDetalle #tr input").attr("disabled","true");
         $("#PlanEstudioDetalleForm").append("<input type='hidden' value='"+id+"' id='plan_estudio_detalle_id_"+id+"' name='id'>");
        var data=$("#PlanEstudioDetalleForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PlanEstudioDetalleForm #plan_estudio_detalle_id_"+id).remove();
        $("#PlanEstudioDetalleForm #PlantillaCurricular select,#PlanEstudioDetalleForm #PlantillaCurricular input").removeAttr("disabled");
        $("#PlanEstudioDetalleForm #TablePlanEstudioDetalle #tr select,#PlanEstudioDetalleForm #TablePlanEstudioDetalle #tr input").removeAttr("disabled","true");
        url='AjaxDinamic/PlanEstudio.PlanEstudioDetallePE@EditVir';
        masterG.postAjax(url,data,evento);
    },
}
</script>
