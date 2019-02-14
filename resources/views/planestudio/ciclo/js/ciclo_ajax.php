<script type="text/javascript">
var AjaxCiclo={
    AgregarEditar:function(evento){
        var data=$("#ModalCicloForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/PlanEstudio.CicloPE@New';
        if(AddEdit==0){
            url='AjaxDinamic/PlanEstudio.CicloPE@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#CicloForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#CicloForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#CicloForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.CicloPE@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalCicloForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalCicloForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalCicloForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalCicloForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/PlanEstudio.CicloPE@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
