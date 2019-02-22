<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var MedioCaptacionG={id:0,medio_captacion:"",tipo_medio:"",estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableMedioCaptacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxMedioCaptacion.Cargar(HTMLCargarMedioCaptacion);
    
    $("#MedioCaptacionForm #TableMedioCaptacion select").change(function(){ AjaxMedioCaptacion.Cargar(HTMLCargarMedioCaptacion); });
    $("#MedioCaptacionForm #TableMedioCaptacion input").blur(function(){ AjaxMedioCaptacion.Cargar(HTMLCargarMedioCaptacion); });
    
    $('#ModalMedioCaptacion').on('shown.bs.modal', function (event) {
        $('#ModalMedioCaptacionForm #txt_medio_captacion').val( MedioCaptacionG.medio_captacion );
        $('#ModalMedioCaptacionForm #slct_tipo_medio').selectpicker( 'val',MedioCaptacionG.tipo_medio );
        $('#ModalMedioCaptacionForm #slct_estado').selectpicker( 'val',MedioCaptacionG.estado );
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
            $('#ModalMedioCaptacionForm #txt_medio_captacion').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalMedioCaptacionForm").append("<input type='hidden' value='"+MedioCaptacionG.id+"' name='id'>");
        }
    });

    $('#ModalMedioCaptacion').on('hidden.bs.modal', function (event) {
        $("#ModalMedioCaptacionForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if(  $.trim( $("#ModalMedioCaptacionForm #slct_tipo_medio").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Medio',4000);
    }
    else if(  $.trim( $("#ModalMedioCaptacionForm #txt_medio_captacion").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Medio de Captación',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    MedioCaptacionG.id='';
    MedioCaptacionG.medio_captacion='';
    MedioCaptacionG.tipo_medio='';
    MedioCaptacionG.estado='1';
    if( val==0 ){
        MedioCaptacionG.id=id;
        MedioCaptacionG.medio_captacion=$("#TableMedioCaptacion #trid_"+id+" .medio_captacion").text();
        MedioCaptacionG.tipo_medio=$("#TableMedioCaptacion #trid_"+id+" .tipo_medio").val();
        MedioCaptacionG.estado=$("#TableMedioCaptacion #trid_"+id+" .estado").val();
    }
    $('#ModalMedioCaptacion').modal('show');
}

CambiarEstado=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Medio de Captación','Desea '+texto+' el medio de captación: '+$("#TableMedioCaptacion #trid_"+id+" .medio_captacion").text(), function(){ AjaxMedioCaptacion.CambiarEstado(HTMLCambiarEstado,estado,id); });
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxMedioCaptacion.Cargar(HTMLCargarMedioCaptacion);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxMedioCaptacion.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalMedioCaptacion').modal('hide');
        AjaxMedioCaptacion.Cargar(HTMLCargarMedioCaptacion);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarMedioCaptacion=function(result){

    var html="";
    $('#TableMedioCaptacion').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='tipo_medio_texto'>"+r.tipo_medio_texto+"</td>"+
            "<td class='medio_captacion'>"+r.medio_captacion+"</td>"+
            "<td>"+
            "<input type='hidden' class='tipo_medio' value='"+r.tipo_medio+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableMedioCaptacion tbody").html(html); 
    $("#TableMedioCaptacion").DataTable({
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
            $('#TableMedioCaptacion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarMedioCaptacion','AjaxMedioCaptacion',result.data,'#TableMedioCaptacion_paginate');
        }
    });

};

</script>
