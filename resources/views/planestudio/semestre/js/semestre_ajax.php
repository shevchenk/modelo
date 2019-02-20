<script type="text/javascript">
var AjaxSemestre={
    AgregarEditar:function(evento){
        var data=$("#ModalSemestreForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.SemestrePE@New';
        if(AddEditSemestre==0){
            url='AjaxDinamic/PlanEstudio.SemestrePE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#SemestreForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#SemestreForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#SemestreForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.SemestrePE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalSemestreForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalSemestreForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalSemestreForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalSemestreForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.SemestrePE@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
