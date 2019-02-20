<script type="text/javascript">
var AjaxSemestreProgramacion={
    Cargar:function(evento){
        var data=$("#SemestreProgramacionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.SemestreProgramacionPE@Load';
        masterG.postAjax(url,data,evento);
    },
    Guardar:function(evento){
        var data=$("#SemestreProgramacionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.SemestreProgramacionPE@New';
        masterG.postAjax(url,data,evento);
    },
    Eliminar:function(evento,id){
        var data={id:id};
        url='AjaxDinamic/PlanEstudio.SemestreProgramacionPE@Eliminar';
        masterG.postAjax(url,data,evento);
    },
}
</script>
