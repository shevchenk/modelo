<script type="text/javascript">
var AddEdit2=0; //0: Editar | 1: Agregar
var Nivel2G={id:0,ps_nivel1_id:"",nivel1:"",nivel2:"",estado:1}; // Datos Globales
var Nivel1Opciones = {
    placeholder: 'Grupo',
    url: "AjaxDinamic/Ingreso.Nivel1IN@ListNivel1",
    listLocation: "data",
    getValue: "nivel1",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#ModalNivel2Form #txt_nivel1").val()+' <b>sin resultados</b>',6000);
            }
        },
    },
    preparePostData: function(data) {
        data.phrase = $("#ModalNivel2Form #txt_nivel1").val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#ModalNivel2Form #txt_nivel1").getSelectedItemData().id;
            $("#ModalNivel2Form #txt_ps_nivel1_id").val(value).trigger("change");
            $("#ModalNivel2Form #txt_nivel1_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#ModalNivel2Form #txt_nivel1_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    adjustWidth:false,
};
$(document).ready(function() {
    $("#ModalNivel2Form #txt_nivel1").easyAutocomplete(Nivel1Opciones);
    
    $("#TableNivel2").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxNivel2.Cargar2(HTMLCargarNivel2);
    
    $("#Nivel2Form #TableNivel2 select").change(function(){ AjaxNivel2.Cargar2(HTMLCargarNivel2); });
    $("#Nivel2Form #TableNivel2 input").blur(function(){ AjaxNivel2.Cargar2(HTMLCargarNivel2); });
    
    $('#ModalNivel2').on('shown.bs.modal', function (event) {
        $('#ModalNivel2Form #txt_nivel1').val( Nivel2G.nivel1 );
        $('#ModalNivel2Form #txt_ps_nivel1_id').val( Nivel2G.ps_nivel1_id );
        $('#ModalNivel2Form #txt_nivel2').val( Nivel2G.nivel2 );
        $('#ModalNivel2Form #slct_estado').val( Nivel2G.estado );
        $("#ModalNivel2 select").selectpicker('refresh');

        if( AddEdit2==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalNivel2Form #txt_nivel1_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('#ModalNivel2Form #txt_nivel2').focus();
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalNivel2Form").append("<input type='hidden' value='"+Nivel2G.id+"' name='id'>");
            $("#ModalNivel2Form #txt_nivel1_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        }
    });

    $('#ModalNivel2').on('hidden.bs.modal', function (event) {
        $("#ModalNivel2Form input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm2=function(){
    var r=true;
    if( $("#ModalNivel2Form #txt_nivel1_ico").hasClass("has-error") ){
        r=false;
        msjG.mensaje('warning','Busque y Seleccione Grupo',4000);
    }
    else if( $.trim( $("#ModalNivel2Form #txt_nivel2").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Sub Grupo',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit2=val;
    Nivel2G.id='';
    Nivel2G.ps_nivel1_id='';
    Nivel2G.nivel1='';
    Nivel2G.nivel2='';
    Nivel2G.estado='1';
    
    if( val==0 ){
        Nivel2G.id=id;
        Nivel2G.ps_nivel1_id=$("#TableNivel2 #trid_"+id+" .ps_nivel1_id").val();
        Nivel2G.nivel1=$("#TableNivel2 #trid_"+id+" .nivel1").text();
        Nivel2G.nivel2=$("#TableNivel2 #trid_"+id+" .nivel2").text();
        Nivel2G.estado=$("#TableNivel2 #trid_"+id+" .estado").val();
    }
    $('#ModalNivel2').modal('show');
}

CambiarEstado2=function(estado,id){
    var texto='Acticar';
    if( estado==0 ){
        texto='Inactivar';
    }
    sweetalertG.confirm('Sub Grupos','Desea '+texto+' el sub grupo: '+$("#TableNivel2 #trid_"+id+" .nivel2").text(), function(){ AjaxNivel2.CambiarEstado2(HTMLCambiarEstado2,estado,id); });
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxNivel2.Cargar2(HTMLCargarNivel2);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxNivel2.AgregarEditar2(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalNivel2').modal('hide');
        AjaxNivel2.Cargar2(HTMLCargarNivel2);
    }else{
        msjG.mensaje('warning',result.msj,2000);
    }
}

HTMLCargarNivel2=function(result){

    var html="";
    $('#TableNivel2').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel1'>"+r.nivel1+"</td>"+
            "<td class='nivel2'>"+r.nivel2+"</td>"+
            "<td>";
        html+="<input type='hidden' class='ps_nivel1_id' value='"+r.ps_nivel1_id+"'>"+
              "<input type='hidden' class='nivel1' value='"+r.nivel1+"'>"+
              "<input type='hidden' class='nivel2' value='"+r.nivel2+"'>"+
              "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableNivel2 tbody").html(html); 
    $("#TableNivel2").DataTable({
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
            $('#TableNivel2_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarNivel2','AjaxNivel2',result.data,'#TableNivel2_paginate');
        }
    });

};
</script>
