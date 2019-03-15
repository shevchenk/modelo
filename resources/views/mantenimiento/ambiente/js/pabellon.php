<script type="text/javascript">
var AddEditFacultad=0; //0: Editar | 1: Agregar
var FacultadG={id:0,facultad:"",estado:1}; // Datos Globales

$(document).ready(function() {

    $("#TableFacultad").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxFacultad.Cargar(HTMLCargarFacultad);
    
    $("#FacultadForm #TableFacultad select").change(function(){ AjaxFacultad.Cargar(HTMLCargarFacultad); });
    $("#FacultadForm #TableFacultad input").blur(function(){ AjaxFacultad.Cargar(HTMLCargarFacultad); });
    
    $('#ModalFacultad').on('shown.bs.modal', function (event) {
        $('#ModalFacultadForm #txt_facultad').val( FacultadG.facultad );
        $('#ModalFacultadForm #slct_estado').val( FacultadG.estado );
        $("#ModalFacultad select").selectpicker('refresh');
        
        if( AddEditFacultad==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxFacultad();');
            $('#ModalFacultadForm #txt_facultad').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxFacultad();');
            $("#ModalFacultadForm").append("<input type='hidden' value='"+FacultadG.id+"' name='id'>");
        }
    });

    $('#ModalFacultad').on('hidden.bs.modal', function (event) {
        $("#ModalFacultadForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormFacultad=function(){
    var r=true;
    if( $.trim( $("#ModalFacultadForm #txt_facultad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Facultad',4000);
    }
    return r;
}

AgregarEditarFacultad=function(val,id){
    AddEditFacultad=val;
    FacultadG.id='';
    FacultadG.facultad='';
    FacultadG.estado='1';
    
    if( val==0 ){
        FacultadG.id=id;
        FacultadG.facultad=$("#TableFacultad #trid_"+id+" .facultad").text();
        FacultadG.estado=$("#TableFacultad #trid_"+id+" .estado").val();
    }
    $('#ModalFacultad').modal('show');
}

CambiarEstadoFacultad=function(estado,id){
    AjaxFacultad.CambiarEstado(HTMLCambiarEstadoFacultad,estado,id);
}

HTMLCambiarEstadoFacultad=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxFacultad.Cargar(HTMLCargarFacultad);
    }
}

AgregarEditarAjaxFacultad=function(){
    if( ValidaFormFacultad() ){
        AjaxFacultad.AgregarEditar(HTMLAgregarEditarFacultad);
    }
}

HTMLAgregarEditarFacultad=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalFacultad').modal('hide');
        AjaxFacultad.Cargar(HTMLCargarFacultad);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarFacultad=function(result){

    var html="";
    $('#TableFacultad').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoFacultad(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoFacultad(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='facultad'>"+r.facultad+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarFacultad(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableFacultad tbody").html(html); 
    $("#TableFacultad").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthFacultad": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableFacultad_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarFacultad','AjaxFacultad',result.data,'#TableFacultad_paginate');
        }
    });

};
</script>
