<script type="text/javascript">
var AjaxGrupoAcademico={
    Cargar:function(evento,pag){
        data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@LoadProgramacion';
        masterG.postAjax(url,data,evento);
    },
    CargarLocal:function(evento){
        url='AjaxDinamic/Mantenimiento.LocalMA@ListLocal';
        data={};
        masterG.postAjax(url,data,evento);
    },
    CargarCiclo:function(evento){
        url='AjaxDinamic/PlanEstudio.CicloPE@ListCiclo';
        data={};
        masterG.postAjax(url,data,evento);
    },
    CargarSemestre:function(evento){
        url='AjaxDinamic/PlanEstudio.SemestrePE@ListSemestre';
        data={};
        masterG.postAjax(url,data,evento);
    },
};
</script>
