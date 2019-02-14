<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var CicloG={id:0,ciclo:"",estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableCiclo").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxCiclo.Cargar(HTMLCargarCiclo);
    
    $("#CicloForm #TableCiclo select").change(function(){ AjaxCiclo.Cargar(HTMLCargarCiclo); });
    $("#CicloForm #TableCiclo input").blur(function(){ AjaxCiclo.Cargar(HTMLCargarCiclo); });
    
    $('#ModalCiclo').on('shown.bs.modal', function (event) {
        $('#ModalCicloForm #txt_ciclo').val( CicloG.ciclo );
        $('#ModalCicloForm #slct_estado').selectpicker( 'val',CicloG.estado );
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
            $('#ModalCicloForm #txt_ciclo').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalCicloForm").append("<input type='hidden' value='"+CicloG.id+"' name='id'>");
        }
    });

    $('#ModalCiclo').on('hidden.bs.modal', function (event) {
        $("#ModalCicloForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $.trim( $("#ModalCicloForm #txt_ciclo").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Ciclo',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    CicloG.id='';
    CicloG.ciclo='';
    CicloG.estado='1';
    if( val==0 ){
        CicloG.id=id;
        CicloG.ciclo=$("#TableCiclo #trid_"+id+" .ciclo").text();
        CicloG.estado=$("#TableCiclo #trid_"+id+" .estado").val();
    }
    $('#ModalCiclo').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxCiclo.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxCiclo.Cargar(HTMLCargarCiclo);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxCiclo.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalCiclo').modal('hide');
        AjaxCiclo.Cargar(HTMLCargarCiclo);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarCiclo=function(result){

    var html="";
    $('#TableCiclo').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableCiclo tbody").html(html); 
    $("#TableCiclo").DataTable({
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
            $('#TableCiclo_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarCiclo','AjaxCiclo',result.data,'#TableCiclo_paginate');
        }
    });

};

</script>
