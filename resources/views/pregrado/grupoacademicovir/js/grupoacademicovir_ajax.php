<script type="text/javascript">
var AjaxGrupoAcademico={
    AgregarEditar:function(evento){
        var data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@NewEdit';
        masterG.postAjax(url,data,evento);
    },
    Agregar:function(evento){
        var data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@New';
        masterG.postAjax(url,data,evento);
    },
    Editar:function(evento,ids){
        $("#GrupoAcademicoFiltroForm").append("<input type='hidden' value='"+ids+"' id='ids' name='ids'>");
        var data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#GrupoAcademicoFiltroForm #ids").remove();
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@Edit';
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#GrupoAcademicoFiltroForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#GrupoAcademicoFiltroForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#GrupoAcademicoFiltroForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#GrupoAcademicoFiltroForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@EditStatus';
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
