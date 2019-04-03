<script type="text/javascript">
var AddEditGrupoAcademico=0; //0: Editar | 1: Agregar
var GrupoAcademicoG={id:0,estado:1}; // Datos Globales

var CarreraOpciones = {
    placeholder: 'Carrera',
    url: "AjaxDinamic/PlanEstudio.CarreraPE@ListCarreraPlanEstudioLibre",
    listLocation: "data",
    getValue: "carrera",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#GrupoAcademicoFiltroForm #txt_carrera").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#GrupoAcademicoFiltroForm #txt_carrera").val();
        data.modalidad_id = $('#GrupoAcademicoFiltroForm #txt_modalidad_id').val();
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
            AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
            $("#GrupoAcademicoFiltroForm #txt_carrera_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#GrupoAcademicoFiltroForm #txt_carrera_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
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

    $("#TableGrupoAcademico").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthGrupoAcademico": [100],
        "language": {
            "decimal":        "",
            "emptyTable":     "No hay registros",
            "info":           "Mostrando _START_ de _END_ del _TOTAL_ total",
            "infoEmpty":      "Mostrando 0 de 0 del 0 total",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "zeroRecords":    "No éxiste registro aún",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        },
    });

    AjaxGrupoAcademico.CargarLocal(SlctCargarLocal);
    AjaxGrupoAcademico.CargarSemestre(SlctCargarSemestre);
    $("#GrupoAcademicoFiltroForm #txt_carrera").easyAutocomplete(CarreraOpciones);

    $('#GrupoAcademicoFiltroForm,#GrupoAcademicoFiltroForm #slct_semestre_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    });
    $('#GrupoAcademicoFiltroForm #slct_local_id').on('hidden.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    });
});

SlctCargarLocal=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option data-subtext='"+r.codigo+"' value="+r.id+">"+r.local+"</option>";
    });
    $("#GrupoAcademicoFiltroForm #slct_local_id").html(html);
    $("#GrupoAcademicoFiltroForm #slct_local_id").selectpicker('refresh');
}

SlctCargarSemestre=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.semestre+"</option>";
    });
    $("#GrupoAcademicoFiltroForm #slct_semestre_id").html(html);
    $("#GrupoAcademicoFiltroForm #slct_semestre_id").selectpicker('refresh');
}

HTMLCargarGrupoAcademico=function(result){

    var html="";
    $('#TableGrupoAcademico').DataTable().destroy();
    
    $.each(result.data,function(index,r){
        estadohtml='<span onClick="CambiarEstadoGrupoAcademico(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span onClick="CambiarEstadoGrupoAcademico(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='local'><input type='hidden' class='local_id' value='"+r.local_id+"'>"+r.local+"</td>"+
            "<td class='plan_estudio'>"+r.plan_estudio+"</td>"+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='fecha'>"+r.fecha_inicio+' / '+r.fecha_final+"</td>"+
            "<td class='frecuencia'>"+r.frecuencia+" de "+r.hora_inicio+" a "+r.hora_final+"</td>"+
            "<td class='meta'>"+r.meta_minima_matricula+" / "+r.meta_maxima_matricula+"</td>"+
            "<td class='fechamat'>"+r.fecha_inicio_mat+" / "+r.fecha_final_mat+"</td>"+
            "<td><button type='button' onClick='CargarOpcion("+r.id+")' class='btn btn-info'><i class='glyphicon glyphicon-check'></i></button></td>"
            "</tr>";
    });
    $("#TableGrupoAcademico tbody").html(html); 
    $("#TableGrupoAcademico").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthGrupoAcademico": [100],
        "language": {
            "decimal":        "",
            "emptyTable":     "No hay registros",
            "info":           "Mostrando _START_ de _END_ del _TOTAL_ total",
            "infoEmpty":      "Mostrando 0 de 0 del 0 total",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "zeroRecords":    "No éxiste registro aún",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        },
    });

};

CargarOpcion=function(id){
    var opcion= $('#slct_opcion').val();
    $('#txt_plan_estudio_'+opcion).val( $('#trid_'+id+' .plan_estudio').text() );
    $('#txt_carrera_'+opcion).val( $('#trid_'+id+' .carrera').text() );
    $('#txt_semestre_'+opcion).val( $('#trid_'+id+' .semestre').text() );
    $('#txt_fecha_inicio_'+opcion).val( $('#trid_'+id+' .fecha').text() );
    $('#txt_horario_'+opcion).val( $('#trid_'+id+' .frecuencia').text() );
    $(".nav.nav-tabs [href='#TABInscripcion']").click();
    $('#txt_carrera_1').click();
}
</script>
