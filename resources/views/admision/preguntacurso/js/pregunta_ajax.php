<script type="text/javascript">
var AjaxPregunta={
    AgregarEditar:function(evento){
        var data=$("#ModalPreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Admision.PreguntaAD@New';
        if(AddEdit==0){
            url='AjaxDinamic/Admision.PreguntaAD@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PreguntaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PreguntaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.PreguntaAD@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPreguntaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPreguntaForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalPreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPreguntaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Admision.PreguntaAD@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
