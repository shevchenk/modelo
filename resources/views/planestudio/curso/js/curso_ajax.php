<script type="text/javascript">
var AjaxCurso={
    AgregarEditar:function(evento){
        var data=$("#ModalCursoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.CursoPE@New';
        if(AddEdit==0){
            url='AjaxDinamic/PlanEstudio.CursoPE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#CursoForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#CursoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#CursoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.CursoPE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalCursoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalCursoForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalCursoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalCursoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.CursoPE@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
