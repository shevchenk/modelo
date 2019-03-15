<script type="text/javascript">
var AddEditPabellon=0; //0: Editar | 1: Agregar
var PabellonG={id:0,pabellon:"",estado:1}; // Datos Globales
var LocalPabOpciones = {
    placeholder: 'Local',
    url: "AjaxDinamic/Mantenimiento.LocalMA@ListLocal",
    listLocation: "data",
    getValue: "local",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalPabellonForm #txt_localp").val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalPabellonForm #txt_localp").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalPabellonForm #txt_localp").getSelectedItemData().id;
            var value2 = $("#ModalPabellonForm #txt_localp").getSelectedItemData().codigo;
            $("#ModalPabellonForm #txt_local_id").val(value).trigger("change");
            $("#ModalPabellonForm #txt_codigo_local").val(value2).trigger("change");
            $("#ModalPabellonForm #txt_local_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalPabellonForm #txt_local_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    template: {
        type: "description",
        fields: {
            description: "codigo"
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    $("#TablePabellon").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    $("#ModalPabellonForm #txt_localp").easyAutocomplete(LocalPabOpciones);

    AjaxPabellon.Cargar(HTMLCargarPabellon);
    
    $("#PabellonForm #TablePabellon select").change(function(){ AjaxPabellon.Cargar(HTMLCargarPabellon); });
    $("#PabellonForm #TablePabellon input").blur(function(){ AjaxPabellon.Cargar(HTMLCargarPabellon); });
    
    $('#ModalPabellon').on('shown.bs.modal', function (event) {
        $('#ModalPabellonForm #txt_pabellon').val( PabellonG.pabellon );
        $('#ModalPabellonForm #txt_localp').val( PabellonG.local );
        $('#ModalPabellonForm #txt_local_id').val( PabellonG.local_id );
        $('#ModalPabellonForm #txt_codigo_local').val( PabellonG.codigo_local );
        $('#ModalPabellonForm #slct_estado').val( PabellonG.estado );
        $("#ModalPabellonForm select").selectpicker('refresh');
        
        if( AddEditPabellon==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxPabellon();');
            $("#ModalPabellonForm #txt_local_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('#ModalPabellonForm #txt_localp').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxPabellon();');
            $("#ModalPabellonForm #txt_local_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            $("#ModalPabellonForm").append("<input type='hidden' value='"+PabellonG.id+"' name='id'>");
        }
    });

    $('#ModalPabellon').on('hidden.bs.modal', function (event) {
        $("#ModalPabellonForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormPabellon=function(){
    var r=true;
    if( $("#ModalPabellonForm #txt_local_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Local',4000);
    }
    else if( $.trim( $("#ModalPabellonForm #txt_pabellon").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Pabellon',4000);
    }
    return r;
}

AgregarEditarPabellon=function(val,id){
    AddEditPabellon=val;
    PabellonG.id='';
    PabellonG.pabellon='';
    PabellonG.local='';
    PabellonG.local_id='';
    PabellonG.codigo_local='';
    PabellonG.estado='1';
    
    if( val==0 ){
        PabellonG.id=id;
        PabellonG.pabellon=$("#TablePabellon #trid_"+id+" .pabellon").text();
        PabellonG.local=$("#TablePabellon #trid_"+id+" .local").text();
        PabellonG.local_id=$("#TablePabellon #trid_"+id+" .local_id").val();
        PabellonG.codigo_local=$("#TablePabellon #trid_"+id+" .codigo_local").val();
        PabellonG.estado=$("#TablePabellon #trid_"+id+" .estado").val();
    }
    $('#ModalPabellon').modal('show');
}

CambiarEstadoPabellon=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Pabellon','Desea '+texto+' el pabellon: '+$("#TablePabellon #trid_"+id+" .pabellon").text(), function(){ AjaxPabellon.CambiarEstado(HTMLCambiarEstadoPabellon,estado,id); });
}

HTMLCambiarEstadoPabellon=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPabellon.Cargar(HTMLCargarPabellon);
    }
}

AgregarEditarAjaxPabellon=function(){
    if( ValidaFormPabellon() ){
        AjaxPabellon.AgregarEditar(HTMLAgregarEditarPabellon);
    }
}

HTMLAgregarEditarPabellon=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPabellon').modal('hide');
        AjaxPabellon.Cargar(HTMLCargarPabellon);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarPabellon=function(result){

    var html="";
    $('#TablePabellon').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoPabellon(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoPabellon(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='pabellon'>"+r.pabellon+"</td>"+
            "<td>"+
            "<input type='hidden' class='codigo_local' value='"+r.codigo_local+"'>"+
            "<input type='hidden' class='local_id' value='"+r.local_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarPabellon(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TablePabellon tbody").html(html); 
    $("#TablePabellon").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthPabellon": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TablePabellon_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPabellon','AjaxPabellon',result.data,'#TablePabellon_paginate');
        }
    });

};
</script>
