<script type="text/javascript">
var AddEditGrupoAcademico=0; //0: Editar | 1: Agregar
var GrupoAcademicoG={id:0,modalidad:"",modalidad_id:"",carrera:"",carrera_id:"",facultad:"",facultad_id:"",plan_estudio:"",perfil_profesional:"",resolucion:"",fecha_resolucion:"",regimen_estudio:"",regimen_otro:"",periodo_academico:"",duracion:"",credito_teoria:"",credito_practica:"",estado:1}; // Datos Globales
var ModalidadOpciones = {
    placeholder: 'Modalidad',
    url: "AjaxDinamic/GrupoAcademico.ModalidadPE@ListModalidad",
    listLocation: "data",
    getValue: "modalidad",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalGrupoAcademicoForm #txt_modalidad").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalGrupoAcademicoForm #txt_modalidad").getSelectedItemData().id;
            $("#ModalGrupoAcademicoForm #txt_modalidad_id").val(value).trigger("change");
        }
    },
    adjustWidth:false,
};
var CarreraOpciones = {
    placeholder: 'Carrera',
    url: "AjaxDinamic/GrupoAcademico.CarreraPE@ListCarrera",
    listLocation: "data",
    getValue: "carrera",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalGrupoAcademicoForm #txt_carrera").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalGrupoAcademicoForm #txt_carrera").getSelectedItemData().id;
            var value2 = $("#ModalGrupoAcademicoForm #txt_carrera").getSelectedItemData().facultad;
            var value3 = $("#ModalGrupoAcademicoForm #txt_carrera").getSelectedItemData().facultad_id;
            var value4 = $("#ModalGrupoAcademicoForm #txt_carrera").getSelectedItemData().codigo;
            $("#ModalGrupoAcademicoForm #txt_carrera_id").val(value).trigger("change");
            $("#ModalGrupoAcademicoForm #txt_facultad").val(value2).trigger("change");
            $("#ModalGrupoAcademicoForm #txt_facultad_id").val(value3).trigger("change");
            $("#ModalGrupoAcademicoForm #txt_codigo").val(value4).trigger("change");
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

    //$(".nav.nav-tabs [href='#MPGrupoAcademicoDetalle']").toggle();
    $("#TableGrupoAcademico").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalGrupoAcademicoForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    })

    //AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    $("#ModalGrupoAcademicoForm #txt_modalidad").easyAutocomplete(ModalidadOpciones);
    $("#ModalGrupoAcademicoForm #txt_carrera").easyAutocomplete(CarreraOpciones);
    
    //$("#GrupoAcademicoForm #TableGrupoAcademico select").change(function(){ AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico); });
    //$("#GrupoAcademicoForm #TableGrupoAcademico input").blur(function(){ AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico); });
    
});

ValidaFormGrupoAcademico=function(){
    var r=true;
    if( $.trim( $("#ModalGrupoAcademicoForm #txt_modalidad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Modalidad',4000);
    }
    else if( $.trim( $("#ModalGrupoAcademicoForm #txt_facultad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Facultad',4000);
    }
    else if( $.trim( $("#ModalGrupoAcademicoForm #txt_carrera").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Carrera',4000);
    }
    return r;
}

AgregarEditarGrupoAcademico=function(val,id){
    AddEditGrupoAcademico=val;
    GrupoAcademicoG.id='';
    GrupoAcademicoG.modalidad='';
    GrupoAcademicoG.modalidad_id='';
    GrupoAcademicoG.carrera='';
    GrupoAcademicoG.codigo='';
    GrupoAcademicoG.carrera_id='';
    GrupoAcademicoG.facultad='';
    GrupoAcademicoG.facultad_id='';
    GrupoAcademicoG.plan_estudio='';
    GrupoAcademicoG.perfil_profesional='';
    GrupoAcademicoG.resolucion='';
    GrupoAcademicoG.fecha_resolucion='';
    GrupoAcademicoG.regimen_estudio='';
    GrupoAcademicoG.regimen_otro='';
    GrupoAcademicoG.periodo_academico='';
    GrupoAcademicoG.duracion='';
    GrupoAcademicoG.credito_teoria='';
    GrupoAcademicoG.credito_practica='';
    GrupoAcademicoG.estado='1';
    
    if( val==0 ){
        GrupoAcademicoG.id=id;
        GrupoAcademicoG.modalidad=$("#TableGrupoAcademico #trid_"+id+" .modalidad").text();
        GrupoAcademicoG.modalidad_id=$("#TableGrupoAcademico #trid_"+id+" .modalidad_id").val();
        GrupoAcademicoG.codigo=$("#TableGrupoAcademico #trid_"+id+" .carrera").text().split("|")[0];
        GrupoAcademicoG.carrera=$("#TableGrupoAcademico #trid_"+id+" .carrera").text().split("|")[1];
        GrupoAcademicoG.carrera_id=$("#TableGrupoAcademico #trid_"+id+" .carrera_id").val();
        GrupoAcademicoG.facultad=$("#TableGrupoAcademico #trid_"+id+" .facultad").text();
        GrupoAcademicoG.facultad_id=$("#TableGrupoAcademico #trid_"+id+" .facultad_id").val();
        GrupoAcademicoG.plan_estudio=$("#TableGrupoAcademico #trid_"+id+" .plan_estudio").text();
        GrupoAcademicoG.perfil_profesional=$("#TableGrupoAcademico #trid_"+id+" .perfil_profesional").text();
        GrupoAcademicoG.resolucion=$("#TableGrupoAcademico #trid_"+id+" .resolucion").text();
        GrupoAcademicoG.fecha_resolucion=$("#TableGrupoAcademico #trid_"+id+" .fecha_resolucion").text();
        GrupoAcademicoG.regimen_estudio=$("#TableGrupoAcademico #trid_"+id+" .regimen_estudio").val();
        GrupoAcademicoG.regimen_otro=$("#TableGrupoAcademico #trid_"+id+" .regimen_otro").val();
        GrupoAcademicoG.periodo_academico=$("#TableGrupoAcademico #trid_"+id+" .periodo_academico").val();
        GrupoAcademicoG.duracion=$("#TableGrupoAcademico #trid_"+id+" .duracion").val();
        GrupoAcademicoG.credito_teoria=$("#TableGrupoAcademico #trid_"+id+" .credito_teoria").val();
        GrupoAcademicoG.credito_practica=$("#TableGrupoAcademico #trid_"+id+" .credito_practica").val();
        GrupoAcademicoG.estado=$("#TableGrupoAcademico #trid_"+id+" .estado").val();
    }
    $('#ModalGrupoAcademico').modal('show');
}

CambiarEstadoGrupoAcademico=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Plan de Estudio','Desea '+texto+' el plan: '+$("#TableGrupoAcademico #trid_"+id+" .plan_estudio").text(), function(){ AjaxGrupoAcademico.CambiarEstado(HTMLCambiarEstadoGrupoAcademico,estado,id); });
}

HTMLCambiarEstadoGrupoAcademico=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }
}

AgregarEditarAjaxGrupoAcademico=function(){
    if( ValidaFormGrupoAcademico() ){
        AjaxGrupoAcademico.AgregarEditar(HTMLAgregarEditarGrupoAcademico);
    }
}

HTMLAgregarEditarGrupoAcademico=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalGrupoAcademico').modal('hide');
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarGrupoAcademico=function(result){

    var html="";
    $('#TableGrupoAcademico').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span onClick="CambiarEstadoGrupoAcademico(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span onClick="CambiarEstadoGrupoAcademico(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='facultad'>"+r.id+"</td>"+
            "<td>"+
            "<input type='hidden' class='facultad_id' value='"+r.id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+
            '&nbsp;&nbsp;&nbsp;'+
            '<a class="btn btn-primary btn-sm" onClick="AgregarEditarGrupoAcademico(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a>'+"</td>"+
            '<td>';
        html+='</td>';
        html+="</tr>";
    });
    $("#TableGrupoAcademico tbody").html(html); 
    $("#TableGrupoAcademico").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthGrupoAcademico": [100]
    });

};
</script>
