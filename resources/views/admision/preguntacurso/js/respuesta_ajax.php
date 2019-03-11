<script type="text/javascript">
var AjaxRespuesta={
    AgregarEditar:function(evento){
        var data=$("#ModalRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Admision.AlternativaAD@New';
        if(AddEdit==0){
            url='AjaxDinamic/Admision.AlternativaAD@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#RespuestaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#RespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#RespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.AlternativaAD@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalRespuestaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalRespuestaForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalRespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.AlternativaAD@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarTipoRespuesta:function(evento){
        url='AjaxDinamic/Admision.AlternativaAD@ListTipoRespuesta';
        data={tipo_curso:1};
        masterG.postAjax(url,data,evento);
    }
};
</script>
