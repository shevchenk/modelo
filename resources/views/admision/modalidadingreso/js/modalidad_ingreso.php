<script type="text/javascript">
var AddEditModalidadIngreso=0; //0: Editar | 1: Agregar
var ModalidadIngresoG={id:0,modalidad_ingreso:"",tipo:"",estado:1}; // Datos Globales
$(document).ready(function() {

    //$(".nav.nav-tabs [href='#MPModalidadIngresoDetalle']").toggle();
    $("#TableModalidadIngreso").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalModalidadIngresoForm .fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    })

    AjaxModalidadIngreso.Cargar(HTMLCargarModalidadIngreso);
    $("#ModalidadIngresoForm #TableModalidadIngreso select").change(function(){ AjaxModalidadIngreso.Cargar(HTMLCargarModalidadIngreso); });
    $("#ModalidadIngresoForm #TableModalidadIngreso input").blur(function(){ AjaxModalidadIngreso.Cargar(HTMLCargarModalidadIngreso); });
    
    $('#ModalModalidadIngreso').on('shown.bs.modal', function (event) {
        $('#ModalModalidadIngresoForm #txt_modalidad_ingreso').val( ModalidadIngresoG.modalidad_ingreso );
        $('#ModalModalidadIngresoForm #slct_tipo').val( ModalidadIngresoG.tipo );
        $('#ModalModalidadIngresoForm #slct_estado').val( ModalidadIngresoG.estado );
        $("#ModalModalidadIngreso select").selectpicker('refresh');
        
        if( AddEditModalidadIngreso==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxModalidadIngreso();');
            $('#ModalModalidadIngresoForm #txt_modalidad_ingreso').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxModalidadIngreso();');
            $("#ModalModalidadIngresoForm").append("<input type='hidden' value='"+ModalidadIngresoG.id+"' name='id'>");
        }
    });

    $('#ModalModalidadIngreso').on('hidden.bs.modal', function (event) {
        $("#ModalModalidadIngresoForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormModalidadIngreso=function(){
    var r=true;
    if( $.trim( $("#ModalModalidadIngresoForm #txt_modalidad_ingreso").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Modalidad Ingreso',4000);
    }
    else if( $.trim( $("#ModalModalidadIngresoForm #slct_tipo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Modalida de Ingreso',4000);
    }
    return r;
}

AgregarEditarModalidadIngreso=function(val,id){
    AddEditModalidadIngreso=val;
    ModalidadIngresoG.id='';
    ModalidadIngresoG.modalidad_ingreso='';
    ModalidadIngresoG.tipo='';
    ModalidadIngresoG.estado='1';
    
    if( val==0 ){
        ModalidadIngresoG.id=id;
        ModalidadIngresoG.modalidad_ingreso=$("#TableModalidadIngreso #trid_"+id+" .modalidad_ingreso").text();
        ModalidadIngresoG.tipo=$("#TableModalidadIngreso #trid_"+id+" .tipo").val();
        ModalidadIngresoG.estado=$("#TableModalidadIngreso #trid_"+id+" .estado").val();
    }
    $('#ModalModalidadIngreso').modal('show');
}

CambiarEstadoModalidadIngreso=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Modalidad Ingreso','Desea '+texto+' la modalidad de ingreso: '+$("#TableModalidadIngreso #trid_"+id+" .modalidad_ingreso").text(), function(){ AjaxModalidadIngreso.CambiarEstado(HTMLCambiarEstadoModalidadIngreso,estado,id); });
}

HTMLCambiarEstadoModalidadIngreso=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxModalidadIngreso.Cargar(HTMLCargarModalidadIngreso);
    }
}

AgregarEditarAjaxModalidadIngreso=function(){
    if( ValidaFormModalidadIngreso() ){
        AjaxModalidadIngreso.AgregarEditar(HTMLAgregarEditarModalidadIngreso);
    }
}

HTMLAgregarEditarModalidadIngreso=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalModalidadIngreso').modal('hide');
        AjaxModalidadIngreso.Cargar(HTMLCargarModalidadIngreso);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarModalidadIngreso=function(result){

    var html="";
    $('#TableModalidadIngreso').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span onClick="CambiarEstadoModalidadIngreso(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span onClick="CambiarEstadoModalidadIngreso(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        tipo='Ordinario';
        if( r.tipo==2 ){
            tipo='Extra Ordinario';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='modalidad_ingreso'>"+r.modalidad_ingreso+"</td>"+
            "<td class='ttipo'>"+tipo+"</td>"+
            "<td>";
        html+="<input type='hidden' class='tipo' value='"+r.tipo+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+
            '&nbsp;&nbsp;&nbsp;'+
            '<a class="btn btn-primary btn-sm" onClick="AgregarEditarModalidadIngreso(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a>'+"</td>"+
            '<td>';
            if( r.estado==1 ){
        html+='<div class="input-group input-group-addon"><a class="btn btn-info btn-sm" onClick="VerModalidadIngresoRequisito('+r.id+')"><i class="fa fa-list-ol fa-2x"></i> </a>'+
            '</div>';
            }
        html+='</td>';
        html+="</tr>";
    });
    $("#TableModalidadIngreso tbody").html(html); 
    $("#TableModalidadIngreso").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthModalidadIngreso": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableModalidadIngreso_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarModalidadIngreso','AjaxModalidadIngreso',result.data,'#TableModalidadIngreso_paginate');
        }
    });

}
</script>
