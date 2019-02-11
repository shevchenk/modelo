<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var Nivel3G={id:0,ps_nivel2_id:"",item:"",nivel2:"",nivel3:"",descripcion:"",imagen_archivo:"",
               imagen_nombre:"",estado:1}; // Datos Globales
var Nivel2Opciones = {
    placeholder: 'Nivel 2',
    url: "AjaxDinamic/Mantenimiento.Nivel2EM@ListNivel2",
    listLocation: "data",
    getValue: "nivel2",
    ajaxSettings: { dataType: "json", method: "POST", data: {} },
    preparePostData: function(data) {
        data.phrase = $("#ModalNivel3Form #txt_nivel2").val();
        return data;
    },
    list: {
        onSelectItemEvent: function() {
            var value = $("#ModalNivel3Form #txt_nivel2").getSelectedItemData().id;
            $("#ModalNivel3Form #txt_ps_nivel2_id").val(value).trigger("change");
        }
    },
    template: {
        type: "description",
        fields: {
            description: "nivel2"
        }
        /*type: "custom",
        method: function(value, item) {
            return value+' - '+'<b>Distrito:</b>'+item.distrito;
        }*/
    },
    adjustWidth:false,
};
$(document).ready(function() {
    $("#ModalNivel3Form #txt_nivel2").easyAutocomplete(Nivel2Opciones);
    
    $("#TableNivel3").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
    $(".fechas").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time:false,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

    AjaxNivel.Cargar(HTMLCargarNivel);
    
    $("#Nivel3Form #TableNivel3 select").change(function(){ AjaxNivel.Cargar(HTMLCargarNivel); });
    $("#Nivel3Form #TableNivel3 input").blur(function(){ AjaxNivel.Cargar(HTMLCargarNivel); });
    
    $('#ModalNivel3').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalNivel3Form").append("<input type='hidden' value='"+Nivel3G.id+"' name='id'>");
        }
        $('#ModalNivel3Form #txt_nivel2').val( Nivel3G.nivel2 );
        $('#ModalNivel3Form #txt_ps_nivel2_id').val( Nivel3G.ps_nivel2_id );
        $('#ModalNivel3Form #txt_item').val( Nivel3G.item );
        $('#ModalNivel3Form #txt_nivel3').val( Nivel3G.nivel3 );
        $('#ModalNivel3Form #txt_descripcion').val( Nivel3G.descripcion );
        $('#ModalNivel3Form #slct_estado').val( Nivel3G.estado );
        $('#ModalNivel3Form #txt_imagen_nombre').val(Nivel3G.imagen_nombre);
        $('#ModalNivel3Form #txt_imagen_archivo').val('');
        $('#ModalNivel3Form .img-circle').attr('src',Nivel3G.imagen_archivo);
        $("#ModalNivel3 select").selectpicker('refresh');
       // $('#ModalNivel3Form #txt_nivel2').focus();
    });

    $('#ModalNivel3').on('hidden.bs.modal', function (event) {
        $("#ModalNivel3Form input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalNivel3Form #txt_ps_nivel2_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Nivel 2',4000);
    }
    else if( $.trim( $("#ModalNivel3Form #txt_item").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Item',4000);
    }
    else if( $.trim( $("#ModalNivel3Form #txt_nivel3").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Nivel 3',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    Nivel3G.id='';
    Nivel3G.ps_nivel2_id='';
    Nivel3G.item='';
    Nivel3G.nivel2='';
    Nivel3G.nivel3='';
    Nivel3G.descripcion='';
    Nivel3G.imagen_archivo='';
    Nivel3G.imagen_nombre='';
    Nivel3G.estado='1';
    
    if( val==0 ){
        Nivel3G.id=id;
        Nivel3G.ps_nivel2_id=$("#TableNivel3 #trid_"+id+" .ps_nivel2_id").val();
        Nivel3G.item=$("#TableNivel3 #trid_"+id+" .item").text();
        Nivel3G.nivel2=$("#TableNivel3 #trid_"+id+" .nivel2").text();
        Nivel3G.nivel3=$("#TableNivel3 #trid_"+id+" .nivel3").text();
        Nivel3G.descripcion=$("#TableNivel3 #trid_"+id+" .descripcion").val(); 
        Nivel3G.foto=$("#TableNivel3 #trid_"+id+" .foto").val();
        if(Nivel3G.foto!='undefined'){
            Nivel3G.imagen_archivo='img/product/'+Nivel3G.foto;
            Nivel3G.imagen_nombre=Nivel3G.foto;
        }else {
            Nivel3G.imagen_archivo='';
            Nivel3G.imagen_nombre='';
        }  
        Nivel3G.estado=$("#TableNivel3 #trid_"+id+" .estado").val();
    }
    $('#ModalNivel3').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxNivel.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxNivel.Cargar(HTMLCargarNivel);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxNivel.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalNivel3').modal('hide');
        AjaxNivel.Cargar(HTMLCargarNivel);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarNivel=function(result){

    var html="";
    $('#TableNivel3').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel2'>"+r.nivel2+"</td>"+
            "<td class='item'>"+r.item+"</td>"+
            "<td class='nivel3'>"+r.nivel3+"</td>"+
            "<td>";
        html+="<input type='hidden' class='ps_nivel2_id' value='"+r.ps_nivel2_id+"'>"+
              "<input type='hidden' class='item' value='"+r.item+"'>"+
              "<input type='hidden' class='nivel3' value='"+r.nivel3+"'>"+
              "<input type='hidden' class='nivel2' value='"+r.nivel2+"'>"+
              "<input type='hidden' class='descripcion' value='"+r.descripcion+"'>";
        if(r.foto!=null){
            html+="<input type='hidden' class='foto' value='"+r.foto+"'>";}
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableNivel3 tbody").html(html); 
    $("#TableNivel3").DataTable({
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
            $('#TableNivel3_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarNivel','AjaxNivel',result.data,'#TableNivel3_paginate');
        }
    });

};
LimpiarNivelModal=function(limpiar){
    $("#"+limpiar).val('');
};
onImagen = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalNivel3Form #txt_imagen_archivo').val(e.target.result);
            $('#ModalNivel3Form .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalNivel3Form #txt_imagen_nombre').val(files[0].name);
        console.log(files[0].name);
    };

</script>
