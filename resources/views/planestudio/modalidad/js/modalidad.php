<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ModalidadG={id:0,modalidad:"",estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableModalidad").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxModalidad.Cargar(HTMLCargarModalidad);
    
    $("#ModalidadForm #TableModalidad select").change(function(){ AjaxModalidad.Cargar(HTMLCargarModalidad); });
    $("#ModalidadForm #TableModalidad input").blur(function(){ AjaxModalidad.Cargar(HTMLCargarModalidad); });
    
    $('#ModalModalidad').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalModalidadForm").append("<input type='hidden' value='"+ModalidadG.id+"' name='id'>");
        }
        $('#ModalModalidadForm #txt_modalidad').val( ModalidadG.modalidad );
        $('#ModalModalidadForm #slct_estado').selectpicker( 'val',ModalidadG.estado );
        $('#ModalModalidadForm #txt_modalidad').focus();
    });

    $('#ModalModalidad').on('hidden.bs.modal', function (event) {
        $("#ModalModalidadForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $.trim( $("#ModalModalidadForm #txt_modalidad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cargo',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    ModalidadG.id='';
    ModalidadG.modalidad='';
    ModalidadG.estado='1';
    if( val==0 ){
        ModalidadG.id=id;
        ModalidadG.modalidad=$("#TableModalidad #trid_"+id+" .modalidad").text();
        ModalidadG.estado=$("#TableModalidad #trid_"+id+" .estado").val();
    }
    $('#ModalModalidad').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxModalidad.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxModalidad.Cargar(HTMLCargarModalidad);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxModalidad.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalModalidad').modal('hide');
        AjaxModalidad.Cargar(HTMLCargarModalidad);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarModalidad=function(result){

    var html="";
    $('#TableModalidad').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='modalidad'>"+r.modalidad+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableModalidad tbody").html(html); 
    $("#TableModalidad").DataTable({
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
            $('#TableModalidad_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarModalidad','AjaxModalidad',result.data,'#TableModalidad_paginate');
        }
    });

};

</script>
