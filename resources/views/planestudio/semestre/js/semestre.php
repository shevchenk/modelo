<script type="text/javascript">
var AddEditSemestre=0; //0: Editar | 1: Agregar
var SemestreG={id:0,semestre:"",fecha_inicio:"",fecha_final:"",estado:1}; // Datos Globales
$(document).ready(function() {

    //$(".nav.nav-tabs [href='#MPSemestreDetalle']").toggle();
    $("#TableSemestre").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalSemestreForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    })

    AjaxSemestre.Cargar(HTMLCargarSemestre);
    $("#SemestreForm #TableSemestre select").change(function(){ AjaxSemestre.Cargar(HTMLCargarSemestre); });
    $("#SemestreForm #TableSemestre input").blur(function(){ AjaxSemestre.Cargar(HTMLCargarSemestre); });
    
    $('#ModalSemestre').on('shown.bs.modal', function (event) {
        $('#ModalSemestreForm #txt_semestre').val( SemestreG.semestre );
        $('#ModalSemestreForm #txt_fecha_inicio').val( SemestreG.fecha_inicio );
        $('#ModalSemestreForm #txt_fecha_final').val( SemestreG.fecha_final );
        $('#ModalSemestreForm #slct_estado').val( SemestreG.estado );
        $("#ModalSemestre select").selectpicker('refresh');
        
        if( AddEditSemestre==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxSemestre();');
            $('#ModalSemestreForm #txt_semestre').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxSemestre();');
            $("#ModalSemestreForm").append("<input type='hidden' value='"+SemestreG.id+"' name='id'>");
        }
    });

    $('#ModalSemestre').on('hidden.bs.modal', function (event) {
        $("#ModalSemestreForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormSemestre=function(){
    var r=true;
    if( $.trim( $("#ModalSemestreForm #txt_semestre").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Semestre',4000);
    }
    else if( $.trim( $("#ModalSemestreForm #txt_fecha_inicio").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha de Inicio',4000);
    }
    else if( $.trim( $("#ModalSemestreForm #txt_fecha_final").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Final',4000);
    }
    return r;
}

AgregarEditarSemestre=function(val,id){
    AddEditSemestre=val;
    SemestreG.id='';
    SemestreG.semestre='';
    SemestreG.fecha_inicio='';
    SemestreG.fecha_final='';
    SemestreG.estado='1';
    
    if( val==0 ){
        SemestreG.id=id;
        SemestreG.semestre=$("#TableSemestre #trid_"+id+" .semestre").text();
        SemestreG.fecha_inicio=$("#TableSemestre #trid_"+id+" .fecha_inicio").text();
        SemestreG.fecha_final=$("#TableSemestre #trid_"+id+" .fecha_final").text();
        SemestreG.estado=$("#TableSemestre #trid_"+id+" .estado").val();
    }
    $('#ModalSemestre').modal('show');
}

CambiarEstadoSemestre=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Periodo Académico','Desea '+texto+' el periodo académico: '+$("#TableSemestre #trid_"+id+" .semestre").text(), function(){ AjaxSemestre.CambiarEstado(HTMLCambiarEstadoSemestre,estado,id); });
}

HTMLCambiarEstadoSemestre=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxSemestre.Cargar(HTMLCargarSemestre);
    }
}

AgregarEditarAjaxSemestre=function(){
    if( ValidaFormSemestre() ){
        AjaxSemestre.AgregarEditar(HTMLAgregarEditarSemestre);
    }
}

HTMLAgregarEditarSemestre=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalSemestre').modal('hide');
        AjaxSemestre.Cargar(HTMLCargarSemestre);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarSemestre=function(result){

    var html="";
    $('#TableSemestre').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span onClick="CambiarEstadoSemestre(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span onClick="CambiarEstadoSemestre(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='fecha_inicio'>"+$.trim(r.fecha_inicio)+"</td>"+
            "<td class='fecha_final'>"+$.trim(r.fecha_final)+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+
            '&nbsp;&nbsp;&nbsp;'+
            '<a class="btn btn-primary btn-sm" onClick="AgregarEditarSemestre(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a>'+"</td>"+
            '<td>';
            if( r.estado==1 ){
        html+='<div class="input-group input-group-addon"><a class="btn btn-info btn-sm" onClick="VerSemestreProgramacion('+r.id+')"><i class="fa fa-list-ol fa-2x"></i> </a>'+
            '</div>';
            }
        html+='</td>';
        html+="</tr>";
    });
    $("#TableSemestre tbody").html(html); 
    $("#TableSemestre").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthSemestre": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableSemestre_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarSemestre','AjaxSemestre',result.data,'#TableSemestre_paginate');
        }
    });

}
</script>
