<script type="text/javascript">
var AjaxModalidadIngresoRequisito={
    Cargar:function(evento){
        var data=$("#ModalidadIngresoRequisitoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Admision.ModalidadIngresoRequisitoAD@Load';
        masterG.postAjax(url,data,evento);
    },
    Guardar:function(evento){
        var data=$("#ModalidadIngresoRequisitoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Admision.ModalidadIngresoRequisitoAD@New';
        masterG.postAjax(url,data,evento);
    },
    Eliminar:function(evento,id){
        var data={id:id};
        url='AjaxDinamic/Admision.ModalidadIngresoRequisitoAD@Eliminar';
        masterG.postAjax(url,data,evento);
    },
}
</script>
