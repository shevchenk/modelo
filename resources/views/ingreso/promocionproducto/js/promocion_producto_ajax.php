<script type="text/javascript">
var AjaxPromocion={
    AgregarEditar:function(evento){
        var data=$("#ModalPromocionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Ingreso.PromocionIN@NewProducto';
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PromocionForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PromocionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PromocionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Ingreso.PromocionIN@LoadProducto';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPromocionForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPromocionForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalPromocionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPromocionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Ingreso.PromocionIN@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
