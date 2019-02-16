<script type="text/javascript">
var AddEditCarrera=0; //0: Editar | 1: Agregar
var CarreraG={id:0,carrera:"",codigo:"",facultad:"",facultad_id:"",grado_academico:"",titulo_profesional:"",estado:1}; // Datos Globales
var FacultadOpciones = {
    placeholder: 'Facultad',
    url: "AjaxDinamic/PlanEstudio.FacultadPE@ListFacultad",
    listLocation: "data",
    getValue: "facultad",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalCarreraForm #txt_facultad").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalCarreraForm #txt_facultad").getSelectedItemData().id;
            $("#ModalCarreraForm #txt_facultad_id").val(value).trigger("change");
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {

    $("#TableCarrera").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxCarrera.Cargar(HTMLCargarCarrera);
    $("#ModalCarreraForm #txt_facultad").easyAutocomplete(FacultadOpciones);
    
    $("#CarreraForm #TableCarrera select").change(function(){ AjaxCarrera.Cargar(HTMLCargarCarrera); });
    $("#CarreraForm #TableCarrera input").blur(function(){ AjaxCarrera.Cargar(HTMLCargarCarrera); });
    
    $('#ModalCarrera').on('shown.bs.modal', function (event) {
        $('#ModalCarreraForm #txt_carrera').val( CarreraG.carrera );
        $('#ModalCarreraForm #txt_codigo').val( CarreraG.codigo );
        $('#ModalCarreraForm #txt_facultad').val( CarreraG.facultad );
        $('#ModalCarreraForm #txt_facultad_id').val( CarreraG.facultad_id );
        $('#ModalCarreraForm #txt_grado_academico').val( CarreraG.grado_academico );
        $('#ModalCarreraForm #txt_titulo_profesional').val( CarreraG.titulo_profesional );
        $('#ModalCarreraForm #slct_estado').val( CarreraG.estado );
        $("#ModalCarrera select").selectpicker('refresh');
        
        if( AddEditCarrera==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjaxCarrera();');
            $('#ModalCarreraForm #txt_facultad').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjaxCarrera();');
            $("#ModalCarreraForm").append("<input type='hidden' value='"+CarreraG.id+"' name='id'>");
        }
    });

    $('#ModalCarrera').on('hidden.bs.modal', function (event) {
        $("#ModalCarreraForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaFormCarrera=function(){
    var r=true;
    if( $.trim( $("#ModalCarreraForm #txt_facultad").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Facultad',4000);
    }
    else if( $.trim( $("#ModalCarreraForm #txt_carrera").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Carrera',4000);
    }
    return r;
}

AgregarEditarCarrera=function(val,id){
    AddEditCarrera=val;
    CarreraG.id='';
    CarreraG.carrera='';
    CarreraG.codigo='';
    CarreraG.facultad='';
    CarreraG.facultad_id='';
    CarreraG.grado_academico='';
    CarreraG.titulo_profesional='';
    CarreraG.estado='1';
    
    if( val==0 ){
        CarreraG.id=id;
        CarreraG.carrera=$("#TableCarrera #trid_"+id+" .carrera").text();
        CarreraG.codigo=$("#TableCarrera #trid_"+id+" .codigo").text();
        CarreraG.grado_academico=$("#TableCarrera #trid_"+id+" .grado_academico").text();
        CarreraG.titulo_profesional=$("#TableCarrera #trid_"+id+" .titulo_profesional").text();
        CarreraG.facultad=$("#TableCarrera #trid_"+id+" .facultad").text();
        CarreraG.facultad_id=$("#TableCarrera #trid_"+id+" .facultad_id").val();
        CarreraG.estado=$("#TableCarrera #trid_"+id+" .estado").val();
    }
    $('#ModalCarrera').modal('show');
}

CambiarEstadoCarrera=function(estado,id){
    AjaxCarrera.CambiarEstado(HTMLCambiarEstadoCarrera,estado,id);
}

HTMLCambiarEstadoCarrera=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxCarrera.Cargar(HTMLCargarCarrera);
    }
}

AgregarEditarAjaxCarrera=function(){
    if( ValidaFormCarrera() ){
        AjaxCarrera.AgregarEditar(HTMLAgregarEditarCarrera);
    }
}

HTMLAgregarEditarCarrera=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalCarrera').modal('hide');
        AjaxCarrera.Cargar(HTMLCargarCarrera);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarCarrera=function(result){

    var html="";
    $('#TableCarrera').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoCarrera(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstadoCarrera(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='facultad'>"+r.facultad+"</td>"+
            "<td class='codigo'>"+r.codigo+"</td>"+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='grado_academico'>"+r.grado_academico+"</td>"+
            "<td class='titulo_profesional'>"+r.titulo_profesional+"</td>"+
            "<td>"+
            "<input type='hidden' class='facultad_id' value='"+r.facultad_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditarCarrera(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableCarrera tbody").html(html); 
    $("#TableCarrera").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthCarrera": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableCarrera_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarCarrera','AjaxCarrera',result.data,'#TableCarrera_paginate');
        }
    });

};
</script>
