<script type="text/javascript">
var AjaxProgramacion={
    Eliminar:function(evento,id){
        var data={id:id};
        url='AjaxDinamic/PreGrado.GrupoAcademicoDetallePG@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    DefinirAula:function(evento,datos){
        var data=datos;
        url='AjaxDinamic/PreGrado.GrupoAcademicoDetallePG@EditAula';
        masterG.postAjax(url,data,evento);
    },
    AgregarEditar:function(evento,datos){
        var data=datos;
        url='AjaxDinamic/PreGrado.GrupoAcademicoDetallePG@NewEdit';
        masterG.postAjax(url,data,evento);
    },
    CargarCurso:function(evento){
        var data={grupo_academico_id: ProgramacionG.grupo_academico_id};
        url='AjaxDinamic/PlanEstudio.CursoPE@listCursoPlan';
        masterG.postAjax(url,data,evento,null,false);
    },
    CargarHoras:function(evento, valor){
        var data={grupo_academico_id: ProgramacionG.grupo_academico_id, seccion:valor};
        url='AjaxDinamic/PreGrado.GrupoAcademicoDetallePG@ListHoras';
        masterG.postAjax(url,data,evento,null,false);
    },
    CargarProgramacion:function(evento,valor){
        var data={grupo_academico_id: ProgramacionG.grupo_academico_id, seccion:valor};
        url='AjaxDinamic/PreGrado.GrupoAcademicoDetallePG@LoadProgramacion';
        masterG.postAjax(url,data,evento,null);
    }
};
</script>
