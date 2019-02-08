<script type="text/javascript">
var AjaxPersonaModal={
    AgregarEditar:function(evento){
        $("#ModalPersonaForm input[name='cargos_selec']").remove();
        //$("#ModalPersonaForm").append("<input type='hidden' value='"+cargos_selec+"' name='cargos_selec'>");

        var data=$("#ModalPersonaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.PersonaEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.PersonaEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    CargarPersonaAdicional:function(evento){
        url='AjaxDinamic/Mantenimiento.PersonaEM@LoadAdicional';
        data={persona_id:PersonaG.id};
        masterG.postAjax(url,data,evento);
    },
    CargarPersonaPrivilegio:function(evento){
        url='AjaxDinamic/Mantenimiento.PersonaEM@LoadPrivilegio';
        data={persona_id:PersonaG.id};
        masterG.postAjax(url,data,evento);
    },
    CargarPrivilegio:function(evento){
        url='AjaxDinamic/Mantenimiento.PrivilegioMA@ListPrivilegio';
        data={};
        masterG.postAjax(url,data,evento);
    },
    CargarLocal:function(evento){
        url='AjaxDinamic/Mantenimiento.LocalMA@ListLocal';
        data={};
        masterG.postAjax(url,data,evento);
    },
};
</script>
