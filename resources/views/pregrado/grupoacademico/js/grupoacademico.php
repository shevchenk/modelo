<script type="text/javascript">
var AddEditGrupoAcademico=0; //0: Editar | 1: Agregar
var GrupoAcademicoG={id:0,modalidad:"",modalidad_id:"",carrera:"",carrera_id:"",facultad:"",facultad_id:"",plan_estudio:"",perfil_profesional:"",resolucion:"",fecha_resolucion:"",regimen_estudio:"",regimen_otro:"",periodo_academico:"",duracion:"",credito_teoria:"",credito_practica:"",estado:1}; // Datos Globales

var CarreraOpciones = {
    placeholder: 'Carrera',
    url: "AjaxDinamic/PlanEstudio.CarreraPE@ListCarreraPlanEstudio",
    listLocation: "data",
    getValue: "carrera",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#GrupoAcademicoFiltroForm #txt_carrera").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var plan_estudio_id = $("#GrupoAcademicoFiltroForm #txt_carrera").getSelectedItemData().plan_estudio_id;
            var plan_estudio = $("#GrupoAcademicoFiltroForm #txt_carrera").getSelectedItemData().plan_estudio;
            var nro_plan_estudio = $("#GrupoAcademicoFiltroForm #txt_carrera").getSelectedItemData().nro_plan_estudio;
            $("#GrupoAcademicoFiltroForm #txt_plan_estudio_id").val(plan_estudio_id).trigger("change");
            $("#GrupoAcademicoFiltroForm #txt_plan_estudio").val(plan_estudio).trigger("change");
            $("#GrupoAcademicoFiltroForm #txt_nro_plan_estudio").text(nro_plan_estudio).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "plan_estudio_text"
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    $("#GrupoAcademicoFiltroForm .fecha").datetimepicker({
        format: "yyyy-mm-dd h:i",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:0,
        autoclose: true,
        todayBtn: false
    })

    //AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    AjaxGrupoAcademico.CargarLocal(SlctCargarLocal);
    AjaxGrupoAcademico.CargarCiclo(SlctCargarCiclo);
    AjaxGrupoAcademico.CargarSemestre(SlctCargarSemestre);
    $("#GrupoAcademicoFiltroForm #txt_carrera").easyAutocomplete(CarreraOpciones);

    $('#GrupoAcademicoFiltroForm #slct_local_id,#GrupoAcademicoFiltroForm #slct_ciclo_id,#GrupoAcademicoFiltroForm #slct_semestre_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        msjG.mensaje('warning','holas'+clickedIndex+'|'+isSelected+'|'+previousValue,15000);
    });
    
    //$("#GrupoAcademicoForm #TableGrupoAcademico select").change(function(){ AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico); });
    //$("#GrupoAcademicoForm #TableGrupoAcademico input").blur(function(){ AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico); });
    
});

SlctCargarLocal=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option data-subtext='"+r.codigo+"' value="+r.id+">"+r.local+"</option>";
    });
    $("#GrupoAcademicoFiltroForm #slct_local_id").html(html);
    $("#GrupoAcademicoFiltroForm #slct_local_id").selectpicker('refresh');
}

SlctCargarCiclo=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.ciclo+"</option>";
    });
    $("#GrupoAcademicoFiltroForm #slct_ciclo_id").html(html);
    $("#GrupoAcademicoFiltroForm #slct_ciclo_id").selectpicker('refresh');
}

SlctCargarSemestre=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.semestre+"</option>";
    });
    $("#GrupoAcademicoFiltroForm #slct_semestre_id").html(html);
    $("#GrupoAcademicoFiltroForm #slct_semestre_id").selectpicker('refresh');
}

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
