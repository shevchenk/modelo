<script type="text/javascript">
var AddEditGrupoAcademico=0; //0: Editar | 1: Agregar
var GrupoAcademicoG={id:0,estado:1}; // Datos Globales

var CarreraOpciones = {
    placeholder: 'Carrera',
    url: "AjaxDinamic/PlanEstudio.CarreraPE@ListCarreraPlanEstudio",
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

    $("#GrupoAcademicoFiltroForm .fecha").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:0,
        autoclose: true,
        todayBtn: false
    });

    $("#GrupoAcademicoFiltroForm .fecha2").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

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
    AjaxGrupoAcademico.CargarCiclo(SlctCargarCiclo);
    AjaxGrupoAcademico.CargarSemestre(SlctCargarSemestre);
    $("#GrupoAcademicoFiltroForm #txt_carrera").easyAutocomplete(CarreraOpciones);

    $('#GrupoAcademicoFiltroForm #slct_ciclo_id,#GrupoAcademicoFiltroForm #slct_semestre_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
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

ValidaFormGrupoAcademicoMasivo=function(tf){
    var r=true;
    if( $.trim($("#GrupoAcademicoFiltroForm #slct_local_id").val())=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Local',4000);
    }
    else if( $("#GrupoAcademicoFiltroForm #txt_carrera_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Carrera',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #slct_semestre_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Periodo Académico',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #slct_ciclo_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Ciclo de Estudio',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #slct_frecuencia").val() )=='' && tf==true ){
        r=false;
        msjG.mensaje('warning','Seleccione la(s) Frecuencia(s)',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_fecha_inicio").val() )=='' && tf==true ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha y Hora Inicio',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_fecha_final").val() )=='' && tf==true ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha y Hora Final',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_meta_minima").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Meta Mínima',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_meta_maxima").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Meta Máxima',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_fecha_inicio_mat").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha Inicio Matrícula',4000);
    }
    else if( $.trim( $("#GrupoAcademicoFiltroForm #txt_fecha_final_mat").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Fecha Final Matrícula',4000);
    }
    return r;
}

EditarGrupoAcademicoMasivo=function(){
    if( ValidaFormGrupoAcademicoMasivo(false) ){
        var ids=''; var cantidad=0;
        $("#TableGrupoAcademico input:checkbox:checked").each(function() {
            ids=ids+','+$(this).val();
            cantidad++;
        });

        if( ids!='' ){
            sweetalertG.confirm('Grupo Académico','Esta a punto de modificar '+cantidad+' registro(s)', function(){ AjaxGrupoAcademico.Editar(HTMLEditarGrupoAcademicoMasivo,ids); });
        }
        else{
            msjG.mensaje('warning','Seleccione almenos 1 grupo académico',4000);
        }
    }
}

HTMLEditarGrupoAcademicoMasivo=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

AgregarEditarGrupoAcademicoMasivo=function(){
    if( ValidaFormGrupoAcademicoMasivo(true) ){
        sweetalertG.confirm('Grupo Académico','Se modificarán todos los registros y creará nuevos registros en caso no exista según los filtros seleccionados', function(){ AjaxGrupoAcademico.AgregarEditar(HTMLAgregarEditarGrupoAcademicoMasivo); });
    }
}

HTMLAgregarEditarGrupoAcademicoMasivo=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

AgregarGrupoAcademicoMasivo=function(){
    if( ValidaFormGrupoAcademicoMasivo(true) ){
        sweetalertG.confirm('Grupo Académico','Solo creará nuevos registros en caso no exista según los filtros seleccionados', function(){ AjaxGrupoAcademico.Agregar(HTMLAgregarGrupoAcademicoMasivo); });
    }
}

HTMLAgregarGrupoAcademicoMasivo=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

CambiarEstadoGrupoAcademico=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Grupo Académico','Desea '+texto+' el grupo académico de la posición: '+$("#TableGrupoAcademico #trid_"+id+" .posicion").text(), function(){ AjaxGrupoAcademico.CambiarEstado(HTMLCambiarEstadoGrupoAcademico,estado,id); });
}

HTMLCambiarEstadoGrupoAcademico=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxGrupoAcademico.Cargar(HTMLCargarGrupoAcademico);
    }
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
            "<td class='local'>"+r.local+"</td>"+
            "<td class='plan_estudio'>"+r.plan_estudio+"</td>"+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='fecha'>"+r.fecha_inicio+' / '+r.fecha_final+"</td>"+
            "<td class='frecuencia'>"+r.frecuencia+" de "+r.hora_inicio+" a "+r.hora_final+"</td>"+
            "<td class='meta'>"+r.meta_minima_matricula+" / "+r.meta_maxima_matricula+"</td>"+
            "<td class='fechamat'>"+r.fecha_inicio_mat+" / "+r.fecha_final_mat+"</td>"+
            "<td>"+
            "<input type='hidden' class='id' value='"+r.id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+
            '</td><td>'+
            '<label class="posicion"><input type="checkbox" class="i-checks" value="'+r.id+'">Posición '+(index*1+1)+'</label>';
        html+='</td>';
        html+="</tr>";
    });
    $("#TableGrupoAcademico tbody").html(html); 
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green'
    });
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
</script>
