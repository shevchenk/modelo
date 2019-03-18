<script type="text/javascript">

$(document).ready(function() {
    var opcionesm="<?php echo session('opciones'); ?>";
    var validarutaurlm="<?php echo $valida_ruta_url; ?>";
    var iconom='fa fa-dashboard';
    if( opcionesm.split(validarutaurlm).length>1 ){
      iconom=opcionesm.split(validarutaurlm)[1].split("|")[1];
    }
    else if( validarutaurlm=='secureaccess.myself' ){
      iconom="fa fa-user-secret";
    }
    $(".breadcomb-icon>i").removeClass().addClass(iconom);

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      $('.selectpicker').selectpicker('mobile');
    }
    
    $('div.custom-menu-content').each(function(indice, elemento) {
        htm=$(elemento).html();
        if(htm.split('<a href="'+validarutaurlm+'"').length>1){
            var idmenu=$(htm).attr('id');
            $('#'+idmenu).addClass('active');
            $("ul.notika-menu-wrap a[href='#"+idmenu+"']").attr('aria-expanded','true');
            $("ul.notika-menu-wrap a[href='#"+idmenu+"']").parent('li').addClass('active');
        }

        if( "<?php echo $valida_ruta_url; ?>"=="secureaccess.inicio" ){
          msjG.mensaje('success','Bienvenido',3000);
        }
    });
    jQuery('nav#dropdown').meanmenu();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var masterG ={
    postAjax:function(url,data,eventsucces,eventbefore,syncr){
      if( typeof syncr== 'undefined' ){
            syncr=true;
      }
      $.ajax({
            url         : url,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            async       : syncr,
            beforeSend : function() {
                $(".content .box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                if( typeof eventbefore!= 'undefined' && eventbefore!=null){
                  eventbefore();
                }
            },
            success : function(r) {
                $(".content .box .overlay").remove();
                if( typeof eventsucces!= 'undefined' && eventsucces!=null){
                  eventsucces(r);
                }
            },
            error: function(result){
                $(".content .box .overlay").remove();
                if( typeof(result.status)!='undefined' && result.status==401 && result.statusText=='Unauthorized' ){
                    msjG.mensaje('warning','Su sesión a caducado',4000);
                }
                else{
                    msjG.mensaje('danger','',3000);
                }

            }
        });
    },
    CargarPaginacion:function(HTML,ajax,result,id){
        var html='<ul class="pagination">';
        if( result.current_page==1 ){
            html+=  '<li class="paginate_button disabled">'+
                        '<a class="notika-icon notika-left-arrow"></a>'+
                    '</li>';
        }
        else{
            html+=  '<li class="paginate_button " onClick="'+ajax+'.Cargar('+HTML+','+(result.current_page-1)+');">'+
                        '<a class="notika-icon notika-left-arrow"></a>'+
                    '</li>';
        }
        var ini=1; var fin=result.last_page;
        if( result.last_page>5 ){
            if( result.last_page-3<=result.current_page ){
                ini=result.last_page-4;
            }
            else if( result.current_page<5 ){
                fin=5;
            }
            else{
                ini=result.current_page-1;
                fin=result.current_page+1;
            }
        }

        if( (ini>1 && result.current_page>4) || (result.last_page-3<=result.current_page && result.current_page<=4 && ini>1) ){
            html+=  '<li class="paginate_button" onClick="'+ajax+'.Cargar('+HTML+',1);">'+
                        '<a>1</a>'+
                    '</li>';
            html+=  '<li class="paginate_button disabled"><a>…</a></li>';
        }
        for(i=ini; i<=fin; i++){
            if( i==result.current_page ){
                html+=  '<li class="paginate_button active">'+
                            '<a>'+i+'</a>'+
                        '</li>';
            }
            else{
                html+=  '<li class="paginate_button" onClick="'+ajax+'.Cargar('+HTML+','+i+');">'+
                            '<a>'+i+'</a>'+
                        '</li>';
            }
        }
        if( fin>=5 && result.last_page>5 && result.last_page-3>result.current_page){
            html+=  '<li class="paginate_button disabled"><a>…</a></li>';
            html+=  '<li class="paginate_button" onClick="'+ajax+'.Cargar('+HTML+','+result.last_page+');">'+
                        '<a>'+result.last_page+'</a>'+
                    '</li>';
        }

        if( result.current_page==result.last_page || result.last_page==0){
            html+=  '<li class="paginate_button disabled">'+
                        '<a class="notika-icon notika-right-arrow"></a>'+
                    '</li>';
        }
        else{
            html+=  '<li class="paginate_button" onClick="'+ajax+'.Cargar('+HTML+','+(result.current_page*1+1)+');">'+
                        '<a class="notika-icon notika-right-arrow"></a>'+
                    '</li>';
        }
        html+='</ul>';

        $(id).append(html);
    },
    enterGlobal:function(e,etiqueta,selecciona){
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==13){
            e.preventDefault();
            $(etiqueta).click(); 
            if( typeof(selecciona)!='undefined' ){
                $(etiqueta).focus(); 
            }
        }
    },
    validaNumerosMax:function(e,t,max){ 
        tecla = (document.all) ? e.keyCode : e.which;//captura evento teclado
        if (tecla==8 || tecla==0) return true;//8 barra, 0 flechas desplaz
        if(t.value.length>=max)return false;
        patron = /\d/; // Solo acepta números
        te = String.fromCharCode(tecla); 
        return patron.test(te);
    },
    validaLetras:function(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0) return true;//8 barra, 0 flechas desplaz
        patron =/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/; // 4 ,\s espacio en blanco, patron = /\d/; // Solo acepta números, patron = /\w/; // Acepta números y letras, patron = /\D/; // No acepta números, patron =/[A-Za-z\s]/; //sin ñÑ
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
    validaAlfanumerico:function(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0 || tecla==46) return true;//8 barra, 0 flechas desplaz
        patron =/[A-Za-zñÑáéíóúÁÉÍÓÚ@.,_\-\s\d]/; // 4 ,\s espacio en blanco, patron = /\d/; // Solo acepta números, patron = /\w/; // Acepta números y letras, patron = /\D/; // No acepta números, patron =/[A-Za-z\s]/; //sin ñÑ
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
    validaNumeros:function(e,t,tipo) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        valida=t.value.substring(0,2);
        if (tecla==8 || tecla==0) return true;//8 barra, 0 flechas desplaz
        if( tipo=='ruc' ){
          if( (valida.length==0 && (tecla!=50 && tecla!=49 )) || (valida.length==1 && tecla!=48) ){
            return false;
          }
        }
        patron = /\d/; // Solo acepta números
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
    validaDecimal:function(e,t) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        pos=t.value.indexOf('.');
        if ( pos!= -1 && tecla == 46 ) return false;// Valida si se registro nuevament el
        if ((tecla == 8 || tecla == 0 || tecla == 46)) return true;
        if (tecla <= 47 || tecla >= 58) return false;
        patron = /\d/; // Solo acepta números
        te = String.fromCharCode(tecla); // 5
        return patron.test(te);
    },
    DecimalMax:function(t,n){
        pos=t.value.indexOf('.');
        if( pos!= -1 && t.value!='' && t.value.substring(pos+1).length>=2 ){
          t.value = parseFloat(t.value).toFixed(n);
        }
    },
    IniciarLogin:function(evento, priv){
        $("#form_mensajes_modal #privilegio_idMasterG").remove();
        $("#form_mensajes_modal").append("<input type='hidden' name='privilegio_id' id='privilegio_idMasterG' value='"+priv+"'>");
        var datos=$("#form_mensajes_modal").serialize();
        var url='AjaxDinamic/SecureAccess.PersonaSA@Privilegio';
        masterG.postAjax(url,datos,evento);
    },
    HTMLIniciarLogin:function(result){
        if( result.rst==1 ){
            window.location='secureaccess.inicio';
        }
    },
    Limpiar:function(t,v){
        if( $.trim(v)=='' ){
            $(t).val('');
        }
    },
    onImagen: function (ev,nombre,archivo,src) {
        var files = ev.target.files || ev.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $(archivo).val(e.target.result);
            $(src).attr('src',e.target.result);
        };
        reader.onprogress=() => {
            //msjG.mensaje('warning','Cargando yo ando',2000);
        }
        reader.readAsDataURL(files[0]);
        $(nombre).val(files[0].name);
        console.log(files[0].name);
    },
    OpenCloseMenu:function(){
    //
    }
}

var msjG = {
    notify: function (from, align, icon, type, animIn, animOut, timer, message){
        $.growl({
            icon: icon,
            title: '',
            message: message,
            url: ''
        },{
                element: 'body',
                type: type,
                allow_dismiss: true,
                placement: {
                        from: from,
                        align: align
                },
                offset: {
                    x: 20,
                    y: 85
                },
                spacing: 10,
                z_index: 1031,
                delay: 2500,
                timer: timer,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                        enter: animIn,
                        exit: animOut
                },
                icon_type: 'class',
                template: '<div data-growl="container" class="alert" role="alert">' +
                                '<button type="button" class="close" data-growl="dismiss">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '<span class="sr-only">Close</span>' +
                                '</button>' +
                                '<span data-growl="icon"></span>' +
                                '<span data-growl="title"></span>' +
                                '<span data-growl="message"></span>' +
                                '<a href="#" data-growl="url"></a>' +
                            '</div>'
        });
    },
    mensaje: function (nType, texto, tiempo) {
      var img='';
      var nFrom='top';
      var nAlign='center';
      var nIcons='fa fa-check';
      var nAnimIn='animated fadeInDown';
      var nAnimOut='animated fadeOutDown';
      var nTimer=tiempo;
      var nMessage=texto;
        if(nType=="danger"){
          nIcons="fa fa-ban";
        }
        if(nType=="warning"){
          nIcons="fa fa-warning";
        }
        if (nType == 'danger' && texto.length == 0) {
            nMessage = 'Ocurrio una interrupción en el proceso, favor de intentar nuevamente.';
        }
        msjG.notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, nTimer, nMessage);
    },

}

var sweetalertG = {
    confirm: function (titulo, descripcion, consulta) {
      swal({
          title: titulo,
          text: descripcion,
          showCancelButton: true,
          //type: 'warning',
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: true
      },
      consulta
      );
    }
}

</script>
