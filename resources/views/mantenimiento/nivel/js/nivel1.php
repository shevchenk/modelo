<script type="text/javascript">
var AddEdit1=0; //0: Editar | 1: Agregar
var Nivel1G={id:0,nivel1:"",item:"",estado:1}; // Datos Globales

$(document).ready(function() {

    $("#TableNivel1").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxNivel1.Cargar1(HTMLCargarNivel1);
    
    $("#Nivel1Form #TableNivel1 select").change(function(){ AjaxNivel1.Cargar1(HTMLCargarNivel1); });
    $("#Nivel1Form #TableNivel1 input").blur(function(){ AjaxNivel1.Cargar1(HTMLCargarNivel1); });
    
    $('#ModalNivel1').on('shown.bs.modal', function (event) {

        if( AddEdit1==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax1();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax1();');
            $("#ModalNivel1Form").append("<input type='hidden' value='"+Nivel1G.id+"' name='id'>");
        }
        $('#ModalNivel1Form #txt_nivel1').val( Nivel1G.nivel1 );
        $('#ModalNivel1Form #txt_item').val( Nivel1G.item );
        $('#ModalNivel1Form #slct_estado').val( Nivel1G.estado );
        $("#ModalNivel1 select").selectpicker('refresh');
       // $('#ModalNivel1Form #txt_nivel1').focus();
    });

    $('#ModalNivel1').on('hidden.bs.modal', function (event) {
        $("#ModalNivel1Form input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm1=function(){
    var r=true;
    if( $.trim( $("#ModalNivel1Form #txt_nivel1").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Nivel 1',4000);
    }
    else if( $.trim( $("#ModalNivel1Form #txt_item").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Item',4000);
    }
    return r;
}

AgregarEditar1=function(val,id){
    AddEdit1=val;
    Nivel1G.id='';
    Nivel1G.nivel1='';
    Nivel1G.item='';
    Nivel1G.estado='1';
    
    if( val==0 ){
        Nivel1G.id=id;
        Nivel1G.nivel1=$("#TableNivel1 #trid_"+id+" .nivel1").text();
        Nivel1G.item=$("#TableNivel1 #trid_"+id+" .item").text();
        Nivel1G.estado=$("#TableNivel1 #trid_"+id+" .estado").val();
    }
    $('#ModalNivel1').modal('show');
}

CambiarEstado1=function(estado,id){
    AjaxNivel1.CambiarEstado1(HTMLCambiarEstado1,estado,id);
}

HTMLCambiarEstado1=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxNivel1.Cargar1(HTMLCargarNivel1);
    }
}

AgregarEditarAjax1=function(){
    if( ValidaForm1() ){
        AjaxNivel1.AgregarEditar1(HTMLAgregarEditar1);
    }
}

HTMLAgregarEditar1=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalNivel1').modal('hide');
        AjaxNivel1.Cargar1(HTMLCargarNivel1);
    }else{
        msjG.mensaje('warning',result.msj,1000);
    }
}

HTMLCargarNivel1=function(result){

    var html="";
    $('#TableNivel1').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado1(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado1(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='nivel1'>"+r.nivel1+"</td>"+
            "<td class='item'>"+r.item+"</td>"+
            "<td>";
        html+="<input type='hidden' class='nivel1' value='"+r.nivel1+"'>"+
              "<input type='hidden' class='item' value='"+r.item+"'>"+
              "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar1(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableNivel1 tbody").html(html); 
    $("#TableNivel1").DataTable({
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
            $('#TableNivel1_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarNivel1','AjaxNivel1',result.data,'#TableNivel1_paginate');
        }
    });

};
</script>
