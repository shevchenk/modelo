<script type="text/javascript">
var AjaxGrupoAcademico={
    AgregarEditar:function(evento){
        var data=$("#ModalGrupoAcademicoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@New';
        if(AddEditGrupoAcademico==0){
            url='AjaxDinamic/PreGrado.GrupoAcademicoPG@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#GrupoAcademicoForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#GrupoAcademicoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#GrupoAcademicoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PreGrado.GrupoAcademicoPG@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalGrupoAcademicoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalGrupoAcademicoForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalGrupoAcademicoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalGrupoAcademicoForm input[type='hidden']").not('.mant').remove();
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
