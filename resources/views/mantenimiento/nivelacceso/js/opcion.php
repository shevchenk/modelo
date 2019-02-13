<script type="text/javascript">
var AddEditOpcion=0; //0: Editar | 1: Agregar
var OpcionG={id:0,opcion:"",ruta:"",menu_id:"",estado:1}; // Datos Globales
var MenuOpciones = {
    placeholder: 'Menu',
    url: "AjaxDinamic/Mantenimiento.MenuMA@ListMenu",
    listLocation: "data",
    getValue: "menu",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalOpcionForm #txt_menu").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalOpcionForm #txt_menu").getSelectedItemData().id;
            $("#ModalOpcionForm #txt_menu_id").val(value).trigger("change");
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    $("#TableOpcion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxOpcion.Cargar(HTMLCargarOpcion);
    $("#ModalOpcionForm #txt_menu").easyAutocomplete(MenuOpciones);
    
    $("#OpcionForm #TableOpcion select").change(function(){ AjaxOpcion.Cargar(HTMLCargarOpcion); });
    $("#OpcionForm #TableOpcion input").blur(function(){ AjaxOpcion.Cargar(HTMLCargarOpcion); });
    
    $('#ModalOpcion').on('shown.bs.modal', function (event) {
        $('#ModalOpcionForm #txt_opcion').val( OpcionG.opcion );
        $('#ModalOpcionForm #txt_menu').val( OpcionG.menu );
        $('#ModalOpcionForm #txt_menu_id').val( OpcionG.menu_id );
        $('#ModalOpcionForm #txt_ruta').val( OpcionG.ruta );
        $('#ModalOpcionForm #slct_estado').val( OpcionG.estado );
        $("#ModalOpcion select").selectpicker('refresh');
        
        if( AddEditOpcion==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxOpcion();');
            $('#ModalOpcionForm #txt_menu').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxOpcion();');
            $("#ModalOpcionForm").append("<input type='hidden' value='"+OpcionG.id+"' name='id'>");
        }
    });

    $('#ModalOpcion').on('hidden.bs.modal', function (event) {
        $("#ModalOpcionForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormOpcion=function(){
    var r=true;
    if( $.trim( $("#ModalOpcionForm #txt_menu").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Menu',4000);
    }
    else if( $.trim( $("#ModalOpcionForm #txt_opcion").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Opcion',4000);
    }
    else if( $.trim( $("#ModalOpcionForm #txt_ruta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese la ruta del Opción',4000);
    }
    return r;
}

AgregarEditarOpcion=function(val,id){
    AddEditOpcion=val;
    OpcionG.id='';
    OpcionG.opcion='';
    OpcionG.menu='';
    OpcionG.menu_id='';
    OpcionG.ruta='';
    OpcionG.estado='1';
    
    if( val==0 ){
        OpcionG.id=id;
        OpcionG.opcion=$("#TableOpcion #trid_"+id+" .opcion").text();
        OpcionG.ruta=$("#TableOpcion #trid_"+id+" .ruta").text();
        OpcionG.menu=$("#TableOpcion #trid_"+id+" .menu").text();
        OpcionG.menu_id=$("#TableOpcion #trid_"+id+" .menu_id").val();
        OpcionG.estado=$("#TableOpcion #trid_"+id+" .estado").val();
    }
    $('#ModalOpcion').modal('show');
}

CambiarEstadoOpcion=function(estado,id){
    AjaxOpcion.CambiarEstado(HTMLCambiarEstadoOpcion,estado,id);
}

HTMLCambiarEstadoOpcion=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxOpcion.Cargar(HTMLCargarOpcion);
    }
}

AgregarEditarAjaxOpcion=function(){
    if( ValidaFormOpcion() ){
        AjaxOpcion.AgregarEditar(HTMLAgregarEditarOpcion);
    }
}

HTMLAgregarEditarOpcion=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalOpcion').modal('hide');
        AjaxOpcion.Cargar(HTMLCargarOpcion);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarOpcion=function(result){

    var html="";
    $('#TableOpcion').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoOpcion(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoOpcion(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='menu'>"+r.menu+"</td>"+
            "<td class='opcion'>"+r.opcion+"</td>"+
            "<td class='ruta'>"+r.ruta+"</td>"+
            "<td>"+
            "<input type='hidden' class='menu_id' value='"+r.menu_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarOpcion(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableOpcion tbody").html(html); 
    $("#TableOpcion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthOpcion": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableOpcion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarOpcion','AjaxOpcion',result.data,'#TableOpcion_paginate');
        }
    });

};
</script>
