<script type="text/javascript">
var EntidadAjax={
    Cargar:function(evento){
        url='AjaxDinamic/Mantenimiento.EntidadMA@load';
        masterG.postAjax(url,{},evento);
    },
    Editar:function(evento){
        var data=$("#EntidadForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.EntidadMA@New';
        masterG.postAjax(url,data,evento);
    }
};
</script>
