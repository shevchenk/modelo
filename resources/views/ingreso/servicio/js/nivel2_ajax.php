<script type="text/javascript">
var AjaxNivel2={
    AgregarEditar2:function(evento){
        var data=$("#ModalNivel2Form").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Ingreso.Nivel2IN@New';
        if(AddEdit2==0){
            url='AjaxDinamic/Ingreso.Nivel2IN@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar2:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#Nivel2Form").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#Nivel2Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#Nivel2Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Ingreso.Nivel2IN@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado2:function(evento,AI,id){
        $("#ModalNivel2Form").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalNivel2Form").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalNivel2Form").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalNivel2Form input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Ingreso.Nivel2IN@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
