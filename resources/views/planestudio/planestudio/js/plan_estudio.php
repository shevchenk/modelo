<script type="text/javascript">
var AddEditPlanEstudio=0; //0: Editar | 1: Agregar
var PlanEstudioG={id:0,modalidad:"",modalidad_id:"",carrera:"",carrera_id:"",facultad:"",facultad_id:"",plan_estudio:"",perfil_profesional:"",resolucion:"",fecha_resolucion:"",regimen_estudio:"",regimen_otro:"",periodo_academico:"",duracion:"",credito_teoria:"",credito_practica:"",estado:1}; // Datos Globales
var ModalidadOpciones = {
    placeholder: 'Modalidad',
    url: "AjaxDinamic/PlanEstudio.ModalidadPE@ListModalidad",
    listLocation: "data",
    getValue: "modalidad",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPlanEstudioForm #txt_modalidad").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPlanEstudioForm #txt_modalidad").getSelectedItemData().id;
            $("#ModalPlanEstudioForm #txt_modalidad_id").val(value).trigger("change");
        }
    },
    adjustWidth:false,
};
var CarreraOpciones = {
    placeholder: 'Carrera',
    url: "AjaxDinamic/PlanEstudio.CarreraPE@ListCarrera",
    listLocation: "data",
    getValue: "carrera",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalPlanEstudioForm #txt_carrera").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPlanEstudioForm #txt_carrera").getSelectedItemData().id;
            var value2 = $("#ModalPlanEstudioForm #txt_carrera").getSelectedItemData().facultad;
            var value3 = $("#ModalPlanEstudioForm #txt_carrera").getSelectedItemData().facultad_id;
            var value4 = $("#ModalPlanEstudioForm #txt_carrera").getSelectedItemData().codigo;
            $("#ModalPlanEstudioForm #txt_carrera_id").val(value).trigger("change");
            $("#ModalPlanEstudioForm #txt_facultad").val(value2).trigger("change");
            $("#ModalPlanEstudioForm #txt_facultad_id").val(value3).trigger("change");
            $("#ModalPlanEstudioForm #txt_codigo").val(value4).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "facultad"
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    //$(".nav.nav-tabs [href='#MPPlanEstudioDetalle']").toggle();
    $("#TablePlanEstudio").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalPlanEstudioForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    })

    AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio);
    $("#ModalPlanEstudioForm #txt_modalidad").easyAutocomplete(ModalidadOpciones);
    $("#ModalPlanEstudioForm #txt_carrera").easyAutocomplete(CarreraOpciones);
    
    $("#PlanEstudioForm #TablePlanEstudio select").change(function(){ AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio); });
    $("#PlanEstudioForm #TablePlanEstudio input").blur(function(){ AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio); });
    
    $('#ModalPlanEstudio').on('shown.bs.modal', function (event) {
        $('#ModalPlanEstudioForm #txt_modalidad').val( PlanEstudioG.modalidad );
        $('#ModalPlanEstudioForm #txt_modalidad_id').val( PlanEstudioG.modalidad_id );
        $('#ModalPlanEstudioForm #txt_carrera').val( PlanEstudioG.carrera );
        $('#ModalPlanEstudioForm #txt_codigo').val( PlanEstudioG.codigo );
        $('#ModalPlanEstudioForm #txt_carrera_id').val( PlanEstudioG.carrera_id );
        $('#ModalPlanEstudioForm #txt_facultad').val( PlanEstudioG.facultad );
        $('#ModalPlanEstudioForm #txt_facultad_id').val( PlanEstudioG.facultad_id );
        $('#ModalPlanEstudioForm #txt_plan_estudio').val( PlanEstudioG.plan_estudio );
        $('#ModalPlanEstudioForm #txt_perfil_profesional').val( PlanEstudioG.perfil_profesional );
        $('#ModalPlanEstudioForm #txt_resolucion').val( PlanEstudioG.resolucion );
        $('#ModalPlanEstudioForm #txt_fecha_resolucion').val( PlanEstudioG.fecha_resolucion );
        $('#ModalPlanEstudioForm #slct_regimen_estudio').val( PlanEstudioG.regimen_estudio );
        $('#ModalPlanEstudioForm #txt_regimen_otro').val( PlanEstudioG.regimen_otro );
        $('#ModalPlanEstudioForm #txt_periodo_academico').val( PlanEstudioG.periodo_academico );
        $('#ModalPlanEstudioForm #txt_duracion').val( PlanEstudioG.duracion );
        $('#ModalPlanEstudioForm #txt_credito_teoria').val( PlanEstudioG.credito_teoria );
        $('#ModalPlanEstudioForm #txt_credito_practica').val( PlanEstudioG.credito_practica );
        $('#ModalPlanEstudioForm #slct_estado').val( PlanEstudioG.estado );
        $("#ModalPlanEstudio select").selectpicker('refresh');
        
        if( AddEditPlanEstudio==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxPlanEstudio();');
            $('#ModalPlanEstudioForm #txt_modalidad').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxPlanEstudio();');
            $("#ModalPlanEstudioForm").append("<input type='hidden' value='"+PlanEstudioG.id+"' name='id'>");
        }
    });

    $('#ModalPlanEstudio').on('hidden.bs.modal', function (event) {
        $("#ModalPlanEstudioForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormPlanEstudio=function(){
    var r=true;
    if( $.trim( $("#ModalPlanEstudioForm #txt_modalidad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Modalidad',4000);
    }
    else if( $.trim( $("#ModalPlanEstudioForm #txt_facultad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Facultad',4000);
    }
    else if( $.trim( $("#ModalPlanEstudioForm #txt_carrera").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Carrera',4000);
    }
    return r;
}

AgregarEditarPlanEstudio=function(val,id){
    AddEditPlanEstudio=val;
    PlanEstudioG.id='';
    PlanEstudioG.modalidad='';
    PlanEstudioG.modalidad_id='';
    PlanEstudioG.carrera='';
    PlanEstudioG.codigo='';
    PlanEstudioG.carrera_id='';
    PlanEstudioG.facultad='';
    PlanEstudioG.facultad_id='';
    PlanEstudioG.plan_estudio='';
    PlanEstudioG.perfil_profesional='';
    PlanEstudioG.resolucion='';
    PlanEstudioG.fecha_resolucion='';
    PlanEstudioG.regimen_estudio='';
    PlanEstudioG.regimen_otro='';
    PlanEstudioG.periodo_academico='';
    PlanEstudioG.duracion='';
    PlanEstudioG.credito_teoria='';
    PlanEstudioG.credito_practica='';
    PlanEstudioG.estado='1';
    
    if( val==0 ){
        PlanEstudioG.id=id;
        PlanEstudioG.modalidad=$("#TablePlanEstudio #trid_"+id+" .modalidad").text();
        PlanEstudioG.modalidad_id=$("#TablePlanEstudio #trid_"+id+" .modalidad_id").val();
        PlanEstudioG.codigo=$("#TablePlanEstudio #trid_"+id+" .carrera").text().split("|")[0];
        PlanEstudioG.carrera=$("#TablePlanEstudio #trid_"+id+" .carrera").text().split("|")[1];
        PlanEstudioG.carrera_id=$("#TablePlanEstudio #trid_"+id+" .carrera_id").val();
        PlanEstudioG.facultad=$("#TablePlanEstudio #trid_"+id+" .facultad").text();
        PlanEstudioG.facultad_id=$("#TablePlanEstudio #trid_"+id+" .facultad_id").val();
        PlanEstudioG.plan_estudio=$("#TablePlanEstudio #trid_"+id+" .plan_estudio").text();
        PlanEstudioG.perfil_profesional=$("#TablePlanEstudio #trid_"+id+" .perfil_profesional").text();
        PlanEstudioG.resolucion=$("#TablePlanEstudio #trid_"+id+" .resolucion").text();
        PlanEstudioG.fecha_resolucion=$("#TablePlanEstudio #trid_"+id+" .fecha_resolucion").text();
        PlanEstudioG.regimen_estudio=$("#TablePlanEstudio #trid_"+id+" .regimen_estudio").val();
        PlanEstudioG.regimen_otro=$("#TablePlanEstudio #trid_"+id+" .regimen_otro").val();
        PlanEstudioG.periodo_academico=$("#TablePlanEstudio #trid_"+id+" .periodo_academico").val();
        PlanEstudioG.duracion=$("#TablePlanEstudio #trid_"+id+" .duracion").val();
        PlanEstudioG.credito_teoria=$("#TablePlanEstudio #trid_"+id+" .credito_teoria").val();
        PlanEstudioG.credito_practica=$("#TablePlanEstudio #trid_"+id+" .credito_practica").val();
        PlanEstudioG.estado=$("#TablePlanEstudio #trid_"+id+" .estado").val();
    }
    $('#ModalPlanEstudio').modal('show');
}

CambiarEstadoPlanEstudio=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Plan de Estudio','Desea '+texto+' el plan: '+$("#TablePlanEstudio #trid_"+id+" .plan_estudio").text(), function(){ AjaxPlanEstudio.CambiarEstado(HTMLCambiarEstadoPlanEstudio,estado,id); });
}

HTMLCambiarEstadoPlanEstudio=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio);
    }
}

AgregarEditarAjaxPlanEstudio=function(){
    if( ValidaFormPlanEstudio() ){
        AjaxPlanEstudio.AgregarEditar(HTMLAgregarEditarPlanEstudio);
    }
}

HTMLAgregarEditarPlanEstudio=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPlanEstudio').modal('hide');
        AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

ReplicarPlanEstudio=function(id){
    sweetalertG.confirm('Plan de Estudio','Esta seguro de replicar el N°: '+$("#TablePlanEstudio #trid_"+id+" .nro_plan_estudio").text()+' del plan: '+$("#TablePlanEstudio #trid_"+id+" .plan_estudio").text(), function(){ AjaxPlanEstudio.Replicar(ReplicarPlanEstudioHTML,id); });
}

ReplicarPlanEstudioHTML=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPlanEstudio.Cargar(HTMLCargarPlanEstudio);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarPlanEstudio=function(result){

    var html="";
    $('#TablePlanEstudio').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span onClick="CambiarEstadoPlanEstudio(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span onClick="CambiarEstadoPlanEstudio(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='facultad'>"+r.facultad+"</td>"+
            "<td class='carrera'>"+r.codigo+'|'+r.carrera+"</td>"+
            "<td class='modalidad'>"+r.modalidad+"</td>"+
            "<td class='nro_plan_estudio centrar'>"+$.trim(r.nro_plan_estudio)+"</td>"+
            "<td class='plan_estudio'>"+$.trim(r.plan_estudio)+"</td>"+
            "<td class='perfil_profesional'>"+$.trim(r.perfil_profesional)+"</td>"+
            "<td class='resolucion'>"+$.trim(r.resolucion)+"</td>"+
            "<td class='fecha_resolucion'>"+$.trim(r.fecha_resolucion)+"</td>"+
            "<td class='fecha_creacion'>"+$.trim(r.created_at)+"</td>"+
            "<td>"+
            "<input type='hidden' class='regimen_estudio' value='"+r.regimen_estudio+"'>"+
            "<input type='hidden' class='regimen_otro' value='"+r.regimen_otro+"'>"+
            "<input type='hidden' class='periodo_academico' value='"+r.periodo_academico+"'>"+
            "<input type='hidden' class='duracion' value='"+r.duracion+"'>"+
            "<input type='hidden' class='credito_teoria' value='"+r.credito_teoria+"'>"+
            "<input type='hidden' class='credito_practica' value='"+r.credito_practica+"'>"+
            "<input type='hidden' class='modalidad_id' value='"+r.modalidad_id+"'>"+
            "<input type='hidden' class='carrera_id' value='"+r.carrera_id+"'>"+
            "<input type='hidden' class='facultad_id' value='"+r.facultad_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+
            '&nbsp;&nbsp;&nbsp;'+
            '<a class="btn btn-primary btn-sm" onClick="AgregarEditarPlanEstudio(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a>'+"</td>"+
            '<td>';
            if( r.estado==1 ){
        html+='<div class="input-group input-group-addon"><a class="btn btn-info btn-sm" onClick="VerPlanDetalle('+r.id+')"><i class="fa fa-list-ol fa-2x"></i> </a>'+
            '&nbsp;&nbsp;&nbsp;'+
            '<button type="button" class="btn btn-warning btn-sm" onclick="ReplicarPlanEstudio('+r.id+');">'+
                '<i class="fa fa-copy fa-2x"></i>'+
            '</button></div>';
            }
        html+='</td>';
        html+="</tr>";
    });
    $("#TablePlanEstudio tbody").html(html); 
    $("#TablePlanEstudio").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthPlanEstudio": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TablePlanEstudio_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPlanEstudio','AjaxPlanEstudio',result.data,'#TablePlanEstudio_paginate');
        }
    });

};
</script>
