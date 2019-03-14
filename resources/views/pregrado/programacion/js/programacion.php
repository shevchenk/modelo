<script type="text/javascript">
var ProgramacionG={id:0,estado:1};
var horarioAuxG='';
var horarioG=[]; var horarioIDG=-1;
var diasId=['Lu','Ma','Mi','Ju','Vi','Sa','Do'];
var diasG=['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo'];
var EfectoG=0;
var idDocenteG='';
var DocenteOpciones={
    placeholder: 'Docente',
    url: "AjaxDinamic/Mantenimiento.EmpleadoMA@ListEmpleado",
    listLocation: "data",
    getValue: "empleado",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#TableProgramacion #txt_persona_"+idDocenteG).val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#TableProgramacion #txt_persona_"+idDocenteG).val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#TableProgramacion #txt_persona_"+idDocenteG).getSelectedItemData().id;
            var value2 = $("#TableProgramacion #txt_persona_"+idDocenteG).getSelectedItemData().dni;
            $("#TableProgramacion #txt_persona_id_"+idDocenteG).val(value).trigger("change");
            $("#TableProgramacion #txt_dni_"+idDocenteG).val(value2).trigger("change");
            $("#TableProgramacion #txt_persona_ico_"+idDocenteG).removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#TableProgramacion #txt_persona_ico_"+idDocenteG).removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    template: {
        type: "custom",
        method: function(value, item) {
            return "<img src='" + item.foto + "' style='width:80px;height:80px;' /> " + value + " | " + item.dni;
        }
    },
    adjustWidth:false,
}
var AmbienteOpciones={
    placeholder: 'Laboratorio',
    url: "AjaxDinamic/Mantenimiento.AmbienteMA@ListAmbienteLaboratorio",
    listLocation: "data",
    getValue: "ambiente",
    ajaxSettings: { dataType: "json", method: "POST", data: {},
        success: function(r) {
            if(r.data.length==0){ 
                msjG.mensaje('warning',$("#TableProgramacion #txt_ambiente_"+idDocenteG).val()+' <b>sin resultados</b>',6000);
            }
        }, 
    },
    preparePostData: function(data) {
        data.phrase = $("#TableProgramacion #txt_ambiente_"+idDocenteG).val();
        return data;
    },
    list: {
        onClickEvent: function() {
            var value = $("#TableProgramacion #txt_ambiente_"+idDocenteG).getSelectedItemData().id;
            $("#TableProgramacion #txt_ambiente_id_"+idDocenteG).val(value).trigger("change");
            $("#TableProgramacion #txt_ambiente_ico_"+idDocenteG).removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        onLoadEvent: function() {
            $("#TableProgramacion #txt_ambiente_ico_"+idDocenteG).removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
    },
    template: {
        type: "description",
        fields: {
            description: "detalle"
        }
    },
    adjustWidth:false,
}
$(document).ready(function() {
    var hora='07:00'; var html='';
    html+="<option value=''>.::Seleccione Horario::.</option>";
    while( hora<='22:00' ){
        html+='<option value="'+hora+'">'+hora+'</option>';
        hora=hora.toHHMM(5);
    }
    $('#ProgramacionForm #slct_horario').html(html);
    $('#ProgramacionForm #slct_horario').selectpicker('refresh');

    $("#ProgramacionForm #slct_seccion").change(function(){ RefreshProgramarCurso() });

    $("#ProgramacionForm #txt_ambiente").easyAutocomplete(
        {
            placeholder: 'Aula del Grupo',
            url: "AjaxDinamic/Mantenimiento.AmbienteMA@ListAmbienteAula",
            listLocation: "data",
            getValue: "ambiente",
            ajaxSettings: { dataType: "json", method: "POST", data: {},
                success: function(r) {
                    if(r.data.length==0){ 
                        msjG.mensaje('warning',$("#ProgramacionForm #txt_ambiente").val()+' <b>sin resultados</b>',6000);
                    }
                }, 
            },
            preparePostData: function(data) {
                data.phrase = $("#ProgramacionForm #txt_ambiente").val();
                return data;
            },
            list: {
                onClickEvent: function() {
                    var value = $("#ProgramacionForm #txt_ambiente").getSelectedItemData().id;
                    $("#ProgramacionForm #txt_ambiente_id").val(value).trigger("change");
                    $("#ProgramacionForm #txt_ambiente_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                    var datos={ grupo_academico_id: ProgramacionG.grupo_academico_id, seccion: $("#ProgramacionForm #slct_seccion").val(), ambiente_id_aula:value }
                    AjaxProgramacion.DefinirAula(HTMLDefinirAula,datos);
                },
                onLoadEvent: function() {
                    $("#ProgramacionForm #txt_ambiente_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                },
            },
            template: {
                type: "description",
                fields: {
                    description: "detalle"
                }
            },
            adjustWidth:false,
        }
    );

});

HTMLDefinirAula=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success','Se asignó el Aula: '+$("#ProgramacionForm #txt_ambiente").val(),5000);
    }
    else{
        msjG.mensaje('warning', result.msj, 5000);
        $("#ProgramacionForm #txt_ambiente_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
    }
}

ProgramarCurso=function(id){
    ProgramacionG.grupo_academico_id=id;
    ProgramacionG.local_id=$("#TableGrupoAcademico #trid_"+id+" .local_id").val();
    $("#ProgramacionForm #slct_seccion").val("A");
    $("#ProgramacionForm #slct_seccion").selectpicker("refresh");
    AjaxProgramacion.CargarCurso(SlctCargarCurso);
    $("#ProgramacionForm #txt_local").val( $("#TableGrupoAcademico #trid_"+id+" .local").text() );
    $("#ProgramacionForm #txt_carrera").val( $("#TableGrupoAcademico #trid_"+id+" .carrera").text() );
    $("#ProgramacionForm #txt_plan_estudio").val( $("#TableGrupoAcademico #trid_"+id+" .plan_estudio").text() );
    $("#ProgramacionForm #txt_semestre").val( $("#TableGrupoAcademico #trid_"+id+" .semestre").text() );
    $("#ProgramacionForm #txt_ciclo").val( $("#TableGrupoAcademico #trid_"+id+" .ciclo").text() );
    $("#ProgramacionForm #txt_horario").val( $("#TableGrupoAcademico #trid_"+id+" .frecuencia").text() );
    $("#ProgramacionForm #txt_fechas").val( $("#TableGrupoAcademico #trid_"+id+" .fecha").text() );
    $(".nav.nav-tabs [href='#TABProgramacion']").click();

    RefreshProgramarCurso();
}

GenerarHorarios=function(result){
    horarioG=[];
    horarioIDG=-1;
    $.each(result.data,function(index,r){
        horarioG.push(r.hora_inicio.substr(0,5));
    });
}

RefreshProgramarCurso=function(){
    AjaxProgramacion.CargarHoras(GenerarHorarios, $('#ProgramacionForm #slct_seccion').val() );
    var fechaini= $("#ProgramacionForm #txt_fechas").val().split(" / ")[0];
    var fechafin= $("#ProgramacionForm #txt_fechas").val().split(" / ")[1];

    var horario= $("#ProgramacionForm #txt_horario").val().split(" de ")[0].split(",");
    var horaini= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[0].substr(0,5);
    var horafin= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[1];
    i=0;
    var html=''; var html2='';
    horainiaux=horaini;
    horafinaux='';
    horainiaux_reserva='';
    horarioAuxAct=0;
    horarioIDG=0;
    while( horainiaux<=horafin ){
        if( i==0 ){ html+="<tr>"; html+='<th>HORAS</th>'; }
        else{ 

            if( horarioG.length>0 && horarioIDG<horarioG.length ){
                if( horarioAuxG!='' && horarioAuxG<=horarioG[horarioIDG] && horarioG[horarioIDG]<=horainiaux){
                    horainiaux_reserva= horainiaux;
                    if( horarioAuxG==horainiaux ){
                        if( horarioAuxG==horarioG[horarioIDG] ){
                            horarioIDG++;
                        }
                        horainiaux= horainiaux_reserva;
                        horainiaux_reserva= '';
                        horarioAuxAct= 0;
                        horarioAuxG='';
                    }
                    else{
                        if( horarioAuxG==horarioG[horarioIDG] ){
                            horarioIDG++;
                        }
                        horainiaux= horarioAuxG;
                        horarioAuxAct=1;
                    }
                }
                else if( horarioG[horarioIDG]<=horainiaux ){
                    horainiaux_reserva= horainiaux;
                    if( horarioG[horarioIDG]==horainiaux ){
                        horainiaux= horainiaux_reserva;
                        horainiaux_reserva= '';
                    }
                    else{
                        horainiaux= horarioG[horarioIDG];
                        horarioAuxAct=2;
                    }
                    horarioIDG++;
                }
            }

            if( horarioAuxG!='' && horarioAuxG<=horainiaux && horarioAuxAct==0){
                if( horainiaux_reserva=='' ){
                    horainiaux_reserva= horainiaux;
                }
                if( horarioAuxG==horainiaux ){
                    horainiaux= horainiaux_reserva;
                    horainiaux_reserva= '';
                    horarioAuxAct= 0;
                    horarioAuxG='';
                }
                else{
                    horainiaux= horarioAuxG;
                    horarioAuxAct=1;
                }
            }

            horafinaux=horainiaux.toHHMM(45); 
            html2+="<tr class='H"+horainiaux.replace(":","")+horafinaux.replace(":","")+"'>"; 
            html2+="<td>"+horainiaux; horainiaux=horainiaux.toHHMM(45); html2+=" - "+horainiaux+"</td>";
        }

        for (var j = 1; j <= horario.length; j++) {
            if( i==0 ){
                html+="<th>"+diasG[diasId.indexOf(horario[(j-1)])]+"</th>";
            }
            else{
                html2+="<td class='D"+horario[(j-1)]+"' id='f"+i+"c"+j+"'></td>";
            }
        }
        if( i==0 ){ html+="</tr>"; }
        else{
            html2+="</tr>";
            if( horarioAuxAct==1 ){
                horainiaux= horainiaux_reserva;
                horainiaux_reserva= '';
                horarioAuxAct= 0;
                horarioAuxG='';
            }
            else if( horarioAuxAct==2 ){
                horainiaux= horainiaux_reserva;
                horainiaux_reserva= '';
                horarioAuxAct= 0;
            }
        }
        i++;
    }

    for( x=horarioIDG; x<horarioG.length; x++  ){
        if( horarioAuxG!='' && horarioAuxG<=horarioG[x] ){
            horainiaux= horarioAuxG;
            horafinaux=horainiaux.toHHMM(45); 
            html2+="<tr class='H"+horainiaux.replace(":","")+horafinaux.replace(":","")+"'>"; 
            html2+="<td>"+horainiaux; horainiaux=horainiaux.toHHMM(45); html2+=" - "+horainiaux+"</td>";
            for (var j = 1; j <= horario.length; j++) {
                html2+="<td class='D"+horario[(j-1)]+"' id='f"+i+"c"+j+"'></td>";
            }
            html2+="</tr>";
            if( horarioAuxG<horarioG[x] ){
                x--;
            }
            horainiaux_reserva= '';
            horarioAuxAct= 0;
            horarioAuxG='';
            i++;
        }
        else{
            horainiaux= horarioG[x];
            horafinaux=horainiaux.toHHMM(45); 
            html2+="<tr class='H"+horainiaux.replace(":","")+horafinaux.replace(":","")+"'>"; 
            html2+="<td>"+horainiaux; horainiaux=horainiaux.toHHMM(45); html2+=" - "+horainiaux+"</td>";
            for (var j = 1; j <= horario.length; j++) {
                html2+="<td class='D"+horario[(j-1)]+"' id='f"+i+"c"+j+"'></td>";
            }
            html2+="</tr>";
            i++;
        }
    }
        horarioIDG=-1; //Inicializar valores del arreglo
    if( horarioAuxG!='' ){
        horainiaux= horarioAuxG;
        horafinaux=horainiaux.toHHMM(45); 
        html2+="<tr class='H"+horainiaux.replace(":","")+horafinaux.replace(":","")+"'>"; 
        html2+="<td>"+horainiaux; horainiaux=horainiaux.toHHMM(45); html2+=" - "+horainiaux+"</td>";
        for (var j = 1; j <= horario.length; j++) {
            html2+="<td class='D"+horario[(j-1)]+"' id='f"+i+"c"+j+"'></td>";
        }
        html2+="</tr>";
        horainiaux_reserva= '';
        horarioAuxAct= 0;
        horarioAuxG='';
        i++;
    }

    $("#TableProgramacion thead").html(html);
    $("#TableProgramacion tbody").html(html2);
    
    $('#TableProgramacion tbody tr td').each(function(){
        if( $.trim(this.id)!='' ){
            idDocenteG=this.id;
            $("#TableProgramacion #"+idDocenteG).html( $("#TableProgramacionAux td").html().split("_aux").join("_"+idDocenteG) );
        }
    })
    $("#TableProgramacion select").addClass("selectpicker show-menu-arrow");
    $("#TableProgramacion .selectpicker").selectpicker('refresh');

    AjaxProgramacion.CargarProgramacion(HTMLCargarProgramacion, $('#ProgramacionForm #slct_seccion').val() );
}

String.prototype.toHHMM=function(ad){
    var h= this.split(":")[0]*3600;
    var m= this.split(":")[1]*60;
    var adicional= ad*60;
    var total= h+m+adicional;

    var hours   = Math.floor(total / 3600);
    var minutes = Math.floor((total - (hours * 3600)) / 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    return hours+':'+minutes;
}

SlctCargarCurso=function(result){
    var html="";
    html+="<option value=''>.::Seleccione Curso::.</option>";
    $.each(result.data,function(index,r){
        html+="<option data-plan_estudio_detalle_id="+r.plan_estudio_detalle_id+" value="+r.id+">"+r.curso+"</option>";
    });
    $("#TableProgramacionAux #slct_curso_aux").html(html);
}

PlanEstudioDetalleId=function(t){
    $("#txt_plan_estudio_detalle_id"+t).val( $("#slct_curso"+t+" option:selected").attr("data-plan_estudio_detalle_id") );
}

HTMLCargarProgramacion=function(result){
    var ambiente_id_aula='';
    var aula='';
    $.each(result.data,function(index,r){
        hora= r.hora_inicio.replace(":","").substr(0,4)+r.hora_final.replace(":","").substr(0,4);
        id= $("#TableProgramacion tbody tr.H"+hora+" td.D"+diasId[(r.dia_id-1)]+" div.listarp").attr("id").split("_")[1];
        $("#lbl_plan_estudio_detalle_id_"+id).val(r.plan_estudio_detalle_id);
        $("#lbl_curso_"+id).val(r.curso_id);
        $("#lbl_curso_t_"+id).text(r.curso);
        $("#lbl_persona_id_"+id).val( $.trim(r.empleado_id) );
        $("#lbl_persona_id_t_"+id).text( $.trim(r.persona) );
        
        lab=0;
        labt="No";
        if( $.trim(r.ambiente_id)!='' ){
            lab=1;
            labt="Si =>";
        }

        $("#lbllab_"+id).val(lab);
        $("#lbl_ambiente_id_"+id).val( $.trim(r.ambiente_id) );
        $("#lbllab_t_"+id).text(labt);
        $("#lbl_ambiente_id_t_"+id).text( $.trim(r.ambiente) );

        virt="Presencial";
        if( r.tipo_clase==2 ){
            virt="Virtual";
        }

        $("#lblvir_"+id).val(r.tipo_clase);
        $("#lblvir_t_"+id).text(virt);
        $("#lbl_id_"+id).val(r.id);

        $("#TableProgramacion tbody tr.H"+hora+" td.D"+diasId[(r.dia_id-1)]+" div.crearp").remove();
        $("#TableProgramacion tbody tr.H"+hora+" td.D"+diasId[(r.dia_id-1)]+" div.listarp").addClass("mant").fadeIn(1000);
        ambiente_id_aula= $.trim(r.ambiente_id_aula);
        aula= $.trim(r.aula);
    });

    $("#ProgramacionForm #txt_ambiente_ico").removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
    $("#ProgramacionForm #txt_ambiente_id").val(ambiente_id_aula);
    $("#ProgramacionForm #txt_ambiente").val(aula);
    if( $.trim(ambiente_id_aula)!='' ){
        $("#ProgramacionForm #txt_ambiente_ico").removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
    }
    $("#TableProgramacion tr td div.listarp").not(".mant").remove();

};

AgregarEditarProgramacion=function(btn,curso){
    if( EfectoG==0 ){
        EfectoG=1;
        var horario= $("#ProgramacionForm #txt_horario").val().split(" de ")[0].split(",");
        var horaini= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[0].substr(0,5);
        var horafin= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[1];
        var btns=[];
        var cursos=[];
        $('#TableProgramacion tbody tr td').each(function(){
            if( $.trim(this.id)!='' ){
                idDocenteG=this.id;
                if( $("#editar_"+idDocenteG).is(':visible') ){
                    cursos.push("#editar_"+idDocenteG);
                    btns.push("#crear_"+idDocenteG+",#listar_"+idDocenteG);
                }
            }
        })

        CancelarProgramacion(btns.join(","),cursos.join(","));
        $(btn).addClass("animated zoomOutDown").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){
            $(this).removeClass("animated zoomOutDown");
            $(this).hide();
            $(curso).show();
            idDocenteG= btn.split("_")[1];
            $("#TableProgramacion #txt_persona_"+btn.split("_")[1]).easyAutocomplete(DocenteOpciones);
            $("#TableProgramacion #txt_ambiente_"+btn.split("_")[1]).easyAutocomplete(AmbienteOpciones);
            $(curso).addClass("animated zoomIn").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){ $(this).removeClass("animated zoomIn"); EfectoG=0; 
                if( btn.split("_")[0]=="#listar" ){
                    id= btn.split("_")[1];
                    $("#txt_plan_estudio_detalle_id_"+id).val( $("#lbl_plan_estudio_detalle_id_"+id).val() );
                    $("#slct_curso_"+id).selectpicker( 'val',$("#lbl_curso_"+id).val() );
                    $("#txt_persona_id_"+id).val( $("#lbl_persona_id_"+id).val() );
                    $("#txt_persona_"+id).val( $("#lbl_persona_id_t_"+id).text() );

                    $("#TableProgramacion #txt_persona_ico_"+id).removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');

                    if( $("#lbl_persona_id_"+id).val()!='' ){
                        $("#TableProgramacion #txt_persona_ico_"+id).removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                    }
                    
                    
                    $("#TableProgramacion #checklab_"+id).removeAttr("checked");
                    $("#txt_ambiente_id_"+id).val('');
                    $("#txt_ambiente_"+id).val('');
                    $("#TableProgramacion #txt_ambiente_ico_"+id).removeClass('has-success').addClass("has-error").find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');

                    if( $("#lbllab_"+id).val()==1 ){
                        $("#TableProgramacion #checklab_"+id).click();
                        $("#txt_ambiente_id_"+id).val( $("#lbl_ambiente_id_"+id).val() );
                        $("#txt_ambiente_"+id).val( $("#lbl_ambiente_id_t_"+id).text() );
                        $("#TableProgramacion #txt_ambiente_ico_"+id).removeClass('has-error').addClass("has-success").find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                    }
                    
                    $("#TableProgramacion #checkvir_"+id).removeAttr("checked");
                    if( $("#lblvir_"+id).val()==2 ){
                        $("#TableProgramacion #checkvir_"+id).click();
                    }
                    $("#TableProgramacion #txt_tipo_clase_"+id).val( $("#lblvir_"+id).val() );
                    
                    $("#editar_"+id+" input[type='hidden']").not(".mant").remove();
                    $("#editar_"+id).append("<input type='hidden' id='txt_id_"+id+"' value='"+$("#lbl_id_"+id).val()+"'>");
                }
            });
        });
    }
}

CancelarProgramacion=function(btn,curso){
    $(curso).addClass("animated zoomOutDown").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){
        $(this).removeClass("animated zoomOutDown");
        $(this).hide();
        $(btn).show();
        $(btn).addClass("animated zoomIn").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){ $(this).removeClass("animated zoomIn"); });
    });
}

VisualizaLab=function(t,v){
    $(t).attr("disabled","true");
    if( $(t).is(":checked") ){
        $(v).fadeIn(1000, function(){ $(t).removeAttr("disabled") });
        $("#TableProgramacion #checkvir_"+v.split("_")[3]).removeAttr("checked");
        $("#TableProgramacion #checkvir_"+v.split("_")[3]).attr("disabled","true");
    }
    else{
        $(v).fadeOut(1000, function(){ $(t).removeAttr("disabled") });
        $("#TableProgramacion #checkvir_"+v.split("_")[3]).removeAttr("disabled");
    }
}

ClaseVirtual=function(t,v){
    if( $(t).is(":checked") ){
        $(v).val(2);
    }
    else{
        $(v).val(1);
    }
}

ValidaProgramacion=function(id){
    var r=true;

    if( $("#TableProgramacion #slct_curso"+id).val()=='' ){
        msjG.mensaje('warning','Seleccione Curso',4000);
        r=false;
    }
    else if( $("#TableProgramacion #checklab"+id).is(":checked") && $("#TableProgramacion #txt_ambiente_ico"+id).hasClass("has-error") ){
        msjG.mensaje('warning','Busque y Seleccione Laboratorio',4000);
        r=false;
    }

    return r;
}

GuardarProgramacion=function(id){
    if( ValidaProgramacion(id) ){
        var plan_estudio_detalle_id=$("#TableProgramacion #txt_plan_estudio_detalle_id"+id).val();
        var curso_id=$("#TableProgramacion #slct_curso"+id).val();
        var empleado_id=$("#TableProgramacion #txt_persona_id"+id).val();
        var lab=0; 
        if( $("#checklab"+id).is(":checked") ){ lab=1; }
        var ambiente_id=$("#TableProgramacion #txt_ambiente_id"+id).val();
        var tipo_clase=1;
        if( $("#checkvir"+id).is(":checked") ){ tipo_clase=2; }
        var dia_id = diasId.indexOf($("#"+id.substr(1)).attr("class").substr(1))*1+1;
        var horas = $("#"+id.substr(1)).parent("tr").find("td:eq(0)").text().split(" - ");
        var hora_inicio = horas[0];
        var hora_final = horas[1];
        var seccion = $('#ProgramacionForm #slct_seccion').val();
        var grupo_academico_id = ProgramacionG.grupo_academico_id;
        var local_id = ProgramacionG.local_id;

        var datos={plan_estudio_detalle_id:plan_estudio_detalle_id, curso_id:curso_id, empleado_id:empleado_id, lab:lab, ambiente_id:ambiente_id, tipo_clase:tipo_clase, dia_id:dia_id, hora_inicio:hora_inicio, hora_final:hora_final, seccion:seccion, grupo_academico_id:grupo_academico_id, local_id:local_id};
        
        if( $.trim($("#TableProgramacion #txt_id"+id).val())!="" ){
            var id= $("#TableProgramacion #txt_id"+id).val();

            var datos={plan_estudio_detalle_id:plan_estudio_detalle_id, curso_id:curso_id, empleado_id:empleado_id, lab:lab, ambiente_id:ambiente_id, tipo_clase:tipo_clase, dia_id:dia_id, hora_inicio:hora_inicio, hora_final:hora_final, seccion:seccion, grupo_academico_id:grupo_academico_id, local_id:local_id, id:id};
        }

        AjaxProgramacion.AgregarEditar(HTMLAgregarEditar,datos);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,3000);
        RefreshProgramarCurso();
    }
    else{
        msjG.mensaje('warning', result.msj,3000);
    }
}

EliminarProgramacion=function(id){
    idf=$("#TableProgramacion #lbl_id"+id).val();
    sweetalertG.confirm('Programación de Cursos','Esta seguro de eliminar: '+$("#TableProgramacion #lbl_curso_t"+id).text(), function(){ AjaxProgramacion.Eliminar(HTMLAgregarEditar,idf); });
}

AgregarHorario=function(){
    horarioAuxG= '';
    if( $('#ProgramacionForm #slct_horario').val()!='' ){
        horarioAuxG= $('#ProgramacionForm #slct_horario').val();
        RefreshProgramarCurso();
    }
    else{
        msjG.mensaje('warning','Seleccione horario agregar',3000);
    }
}

</script>
