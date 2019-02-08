<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var RegimenG={id:0,cargo:"",estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableRegimen").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxRegimen.Cargar(HTMLCargarRegimen);
    
    $("#RegimenForm #TableRegimen select").change(function(){ AjaxRegimen.Cargar(HTMLCargarRegimen); });
    $("#RegimenForm #TableRegimen input").blur(function(){ AjaxRegimen.Cargar(HTMLCargarRegimen); });
    
    $('#ModalRegimen').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalRegimenForm").append("<input type='hidden' value='"+RegimenG.id+"' name='id'>");
        }
        $('#ModalRegimenForm #txt_cargo').val( RegimenG.cargo );
        $('#ModalRegimenForm #slct_estado').selectpicker( 'val',RegimenG.estado );
        $('#ModalRegimenForm #txt_cargo').focus();
    });

    $('#ModalRegimen').on('hidden.bs.modal', function (event) {
        $("#ModalRegimenForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $.trim( $("#ModalRegimenForm #txt_cargo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cargo',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    RegimenG.id='';
    RegimenG.cargo='';
    RegimenG.estado='1';
    if( val==0 ){
        RegimenG.id=id;
        RegimenG.cargo=$("#TableRegimen #trid_"+id+" .cargo").text();
        RegimenG.estado=$("#TableRegimen #trid_"+id+" .estado").val();
    }
    $('#ModalRegimen').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxRegimen.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxRegimen.Cargar(HTMLCargarRegimen);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxRegimen.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalRegimen').modal('hide');
        AjaxRegimen.Cargar(HTMLCargarRegimen);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarRegimen=function(result){

    var html="";
    $('#TableRegimen').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='cargo'>"+r.cargo+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableRegimen tbody").html(html); 
    $("#TableRegimen").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableRegimen_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarRegimen','AjaxRegimen',result.data,'#TableRegimen_paginate');
        }
    });

};

</script>
