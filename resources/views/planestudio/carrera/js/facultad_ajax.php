<script type="text/javascript">
var AjaxFacultad={
    AgregarEditar:function(evento){
        var data=$("#ModalFacultadForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.FacultadPE@New';
        if(AddEditFacultad==0){
            url='AjaxDinamic/PlanEstudio.FacultadPE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#FacultadForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#FacultadForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#FacultadForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.FacultadPE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalFacultadForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalFacultadForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalFacultadForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalFacultadForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.FacultadPE@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
