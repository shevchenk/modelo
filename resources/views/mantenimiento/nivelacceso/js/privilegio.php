<script type="text/javascript">
var AddEditPrivilegio=0; //0: Editar | 1: Agregar
var PrivilegioG={id:0,privilegio:"",estado:1}; // Datos Globales

$(document).ready(function() {

    $("#TablePrivilegio").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxPrivilegio.Cargar(HTMLCargarPrivilegio);
    
    $("#PrivilegioForm #TablePrivilegio select").change(function(){ AjaxPrivilegio.Cargar(HTMLCargarPrivilegio); });
    $("#PrivilegioForm #TablePrivilegio input").blur(function(){ AjaxPrivilegio.Cargar(HTMLCargarPrivilegio); });
    
    $('#ModalPrivilegio').on('shown.bs.modal', function (event) {
        $('#ModalPrivilegioForm #txt_privilegio').val( PrivilegioG.privilegio );
        $('#ModalPrivilegioForm #slct_estado').val( PrivilegioG.estado );
        $("#ModalPrivilegio select").selectpicker('refresh');
        
        AjaxPrivilegio.ListOpcion(HTMLListOpcionPrivilegio,PrivilegioG.id);
        if( AddEditPrivilegio==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxPrivilegio();');
            $('#ModalPrivilegioForm #txt_privilegio').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxPrivilegio();');
            $("#ModalPrivilegioForm").append("<input type='hidden' value='"+PrivilegioG.id+"' name='id'>");
        }
    });

    $('#ModalPrivilegio').on('hidden.bs.modal', function (event) {
        $("#ModalPrivilegioForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormPrivilegio=function(){
    var r=true;
    if( $.trim( $("#ModalPrivilegioForm #txt_privilegio").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Privilegio',4000);
    }
    return r;
}

AgregarEditarPrivilegio=function(val,id){
    AddEditPrivilegio=val;
    PrivilegioG.id='';
    PrivilegioG.privilegio='';
    PrivilegioG.estado='1';
    
    if( val==0 ){
        PrivilegioG.id=id;
        PrivilegioG.privilegio=$("#TablePrivilegio #trid_"+id+" .privilegio").text();
        PrivilegioG.estado=$("#TablePrivilegio #trid_"+id+" .estado").val();
    }
    $('#ModalPrivilegio').modal('show');
}

CambiarEstadoPrivilegio=function(estado,id){
    AjaxPrivilegio.CambiarEstado(HTMLCambiarEstadoPrivilegio,estado,id);
}

HTMLCambiarEstadoPrivilegio=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPrivilegio.Cargar(HTMLCargarPrivilegio);
    }
}

AgregarEditarAjaxPrivilegio=function(){
    if( ValidaFormPrivilegio() ){
        AjaxPrivilegio.AgregarEditar(HTMLAgregarEditarPrivilegio);
    }
}

HTMLAgregarEditarPrivilegio=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPrivilegio').modal('hide');
        AjaxPrivilegio.Cargar(HTMLCargarPrivilegio);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarPrivilegio=function(result){

    var html="";
    $('#TablePrivilegio').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoPrivilegio(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoPrivilegio(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='privilegio'>"+r.privilegio+"</td>"+
            "<td class='opciones'>"+$.trim(r.opciones).split(",").join("<hr>")+"</td>"+
            "<td>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarPrivilegio(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TablePrivilegio tbody").html(html); 
    $("#TablePrivilegio").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthPrivilegio": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TablePrivilegio_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPrivilegio','AjaxPrivilegio',result.data,'#TablePrivilegio_paginate');
        }
    });

};

HTMLListOpcionPrivilegio=function(result){
    var html='';
    $.each(result.data,function(index,r){
        var selected='';
        if( $.trim(r.ok)!='' ){
            selected='selected';
        }
        html+="<option value='"+r.id+"' "+selected+">"+r.opcion+"</option>";
    });
    $("#ModalPrivilegioForm #slct_opcion").html(html);
    $("#ModalPrivilegioForm #slct_opcion").selectpicker('refresh');
}
</script>
