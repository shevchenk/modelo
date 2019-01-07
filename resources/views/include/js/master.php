<script type="text/javascript">

$(document).ready(function() {
    var opcionesm="<?php echo session('opciones'); ?>";
    var validarutaurlm="<?php echo $valida_ruta_url; ?>";
    var iconom='fa fa-dashboard';
    if( opcionesm.split(validarutaurlm).length>1 ){
      iconom=opcionesm.split(validarutaurlm)[1].split("|")[1];
    }
    else if( validarutaurlm=='secureaccess.myself' ){
      iconom="fa fa-lock";
    }
    $("ol.breadcrumb>li>i").removeClass().addClass("fa "+iconom);

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      $('.selectpicker').selectpicker('mobile');
    }
    
    $('ul.sidebar-menu>li').each(function(indice, elemento) {
        htm=$(elemento).html();
        if(htm.split('<a href="'+validarutaurlm+'"').length>1){
            $(elemento).addClass('active').addClass('menu-open');
            $(elemento).find('li').each(function(ind,ele) {
              htm=$(ele).html();
              if(htm.split('<a href="'+validarutaurlm+'"').length>1){
                $(ele).addClass('active');
              }
            });
        }

        if( "<?php echo $valida_ruta_url; ?>"=="secureaccess.inicio" ){
          msjG.mensaje('success','Bienvenido',3000);
        }
    });
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
            html+=  '<li class="paginate_button previous disabled">'+
                        '<a>Atras</a>'+
                    '</li>';
        }
        else{
            html+=  '<li class="paginate_button previous" onClick="'+ajax+'.Cargar('+HTML+','+(result.current_page-1)+');">'+
                        '<a>Atras</a>'+
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
            html+=  '<li class="paginate_button next disabled">'+
                        '<a>Siguiente</a>'+
                    '</li>';
        }
        else{
            html+=  '<li class="paginate_button next" onClick="'+ajax+'.Cargar('+HTML+','+(result.current_page*1+1)+');">'+
                        '<a>Siguiente</a>'+
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
          if( (valida.length==0 && tecla!=50) || (valida.length==1 && tecla!=48) ){
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
    }
}

var msjG = {
    mensaje: function (tipo, texto, tiempo) {
      var img=tipo;
        if(tipo=="success"){
          img="check";
        }
        else if(tipo=="danger"){
          img="ban";
        }
        if (tipo == 'danger' && texto.length == 0) {
            texto = 'Ocurrio una interrupción en el proceso, favor de intentar nuevamente.';
        }
        etiqueta='msjG';
        $('.'+etiqueta).html('<div class="alert alert-dismissable alert-' + tipo + '">' +
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                '<h4><i class="icon fa fa-'+img+'"> '+texto+'</h4>'+
                '</div>');
        $('.'+etiqueta).slideToggle(500);
        $('.'+etiqueta).fadeOut(tiempo);
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
          closeOnConfirm: true
      },
      consulta
      );
    }
}

</script>
