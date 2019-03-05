<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var LocalG={id:0,
local:"",
codigo:"",
direccion:"",
telefono:"",
celular:"",
email:"",
foto:"",
empleado:"",
empleado_id:"",
dni:"",
serie:"",
estado:1}; // Datos Globales
var EmpleadoOpciones = {
    placeholder: 'Empleado',
    url: "AjaxDinamic/Mantenimiento.EmpleadoMA@ListEmpleado",
    listLocation: "data",
    getValue: "empleado",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalLocalForm #txt_empleado").val()+' <b>sin resultados</b>',6000);
            }
        },
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalLocalForm #txt_empleado").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalLocalForm #txt_empleado").getSelectedItemData().id;
            var value2 = $("#ModalLocalForm #txt_empleado").getSelectedItemData().dni;
            $("#ModalLocalForm #txt_empleado_id").val(value).trigger("change");
            $("#ModalLocalForm #txt_dni").val(value2).trigger("change");
            $("#ModalLocalForm #txt_empleado_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalLocalForm #txt_empleado_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    template: {
        type: "custom",
        method: function(value, item) {
            return "<img src='" + item.foto + "' style='width:80px;height:80px;' /> " + value + " | " + item.dni;
        }
    },
    adjustWidth:false,
};
$(document).ready(function() {
    $("#TableLocal").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    $("#ModalLocalForm #txt_empleado").easyAutocomplete(EmpleadoOpciones);
    AjaxLocal.Cargar(HTMLCargarLocal);
    $("#LocalForm #TableLocal select").change(function(){ AjaxLocal.Cargar(HTMLCargarLocal); });
    $("#LocalForm #TableLocal input").blur(function(){ AjaxLocal.Cargar(HTMLCargarLocal); });

    $('#ModalLocal').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
            $("#ModalLocalForm #txt_empleado_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalLocalForm").append("<input type='hidden' value='"+LocalG.id+"' name='id'>");
            $("#ModalLocalForm #txt_empleado_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        }

        $('#ModalLocalForm #txt_local').val( LocalG.local );
        $('#ModalLocalForm #txt_codigo').val( LocalG.codigo );
        $('#ModalLocalForm #txt_direccion').val( LocalG.direccion );
        $('#ModalLocalForm #txt_telefono').val( LocalG.telefono );
        $('#ModalLocalForm #txt_celular').val( LocalG.celular );
        $('#ModalLocalForm #txt_email').val( LocalG.email );
        $('#ModalLocalForm #txt_empleado').val( LocalG.empleado );
        $('#ModalLocalForm #txt_empleado_id').val( LocalG.empleado_id );
        $('#ModalLocalForm #txt_dni').val( LocalG.dni );
        $('#ModalLocalForm #txt_serie').val( LocalG.serie );

        $('#ModalLocalForm #slct_estado').val( LocalG.estado );
        $('#ModalLocalForm #txt_imagen_nombre').val(LocalG.foto);
        $('#ModalLocalForm #txt_imagen_archivo').val('');
        $('#ModalLocalForm .img-circle').attr('src',LocalG.foto);
        $("#ModalLocalForm select").selectpicker('refresh');
        $('#ModalLocalForm #txt_local').focus();
    });

    $('#ModalLocal').on('hidden.bs.modal', function (event) {
        $("ModalLocalForm input[type='hidden']").not('.mant').remove();
       // $("ModalLocalForm input").val('');
    });

    $(document).on('click', '#btnexport', function(event) {
        $(this).attr('href','ReportDinamic/Mantenimiento.LocalMA@ExportLocal?d=1');
    });

});

ValidaForm=function(){
    var r=true;
    if( $("#ModalLocalForm #txt_empleado_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Empleado',4000);
    }
    else if( $.trim( $("#ModalLocalForm #txt_local").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Local',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    LocalG.id='';
    LocalG.local='';
    LocalG.codigo='';
    LocalG.direccion='';
    LocalG.telefono='';
    LocalG.celular='';
    LocalG.email='';
    LocalG.empleado='';
    LocalG.empleado_id='';
    LocalG.dni='';
    LocalG.serie='';
    LocalG.estado='1';
    if( val==0 ){
        LocalG.id=id;
        LocalG.local=$("#TableLocal #trid_"+id+" .local").text();
        LocalG.codigo=$("#TableLocal #trid_"+id+" .codigo").text();
        LocalG.direccion=$("#TableLocal #trid_"+id+" .direccion").text();
        LocalG.telefono=$("#TableLocal #trid_"+id+" .telefono").text();
        LocalG.celular=$("#TableLocal #trid_"+id+" .celular").text();
        LocalG.email=$("#TableLocal #trid_"+id+" .email").text();
        LocalG.serie=$("#TableLocal #trid_"+id+" .serie").val();
        LocalG.foto=$("#TableLocal #trid_"+id+" .foto").val();
        LocalG.empleado=$("#TableLocal #trid_"+id+" .empleado").val();
        LocalG.empleado_id=$("#TableLocal #trid_"+id+" .empleado_id").val();
        LocalG.dni=$("#TableLocal #trid_"+id+" .dni").val();
        LocalG.estado=$("#TableLocal #trid_"+id+" .estado").val();
    }
    $('#ModalLocal').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxLocal.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxLocal.Cargar(HTMLCargarLocal);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxLocal.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalLocal').modal('hide');
        AjaxLocal.Cargar(HTMLCargarLocal);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarLocal=function(result){
    var html="";
    $('#TableLocal').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td><a  target='_blank' href='"+r.foto+"'><img src='"+r.foto+"' style='height: 40px;width: 40px;'></a></td>"+
            "<td class='local'>"+r.local+"</td>"+
            "<td class='codigo'>"+r.codigo+"</td>"+
            "<td class='direccion'>"+r.direccion+"</td>"+
            "<td class='telefono'>"+r.telefono+"</td>"+
            "<td class='celular'>"+r.celular+"</td>"+
            "<td class='email'>"+r.email+"</td>"+
            "<td>"+
            "<input type='hidden' class='foto' value='"+r.foto+"'>"+
            "<input type='hidden' class='empleado_id' value='"+r.empleado_id+"'>"+
            "<input type='hidden' class='dni' value='"+r.dni+"'>"+
            "<input type='hidden' class='serie' value='"+r.serie+"'>"+
            "<input type='hidden' class='empleado' value='"+r.paterno+' '+r.materno+', '+r.nombre+"'>"+
            "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableLocal tbody").html(html); 
    $("#TableLocal").DataTable({
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
            $('#TableLocal_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarLocal','AjaxLocal',result.data,'#TableLocal_paginate');
        }
    });
};

onImagen = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalLocalForm #txt_imagen_archivo').val(e.target.result);
            $('#ModalLocalForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalLocalForm #txt_imagen_nombre').val(files[0].name);
        console.log(files[0].name);
    };
</script>
