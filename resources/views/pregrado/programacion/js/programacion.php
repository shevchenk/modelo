<script type="text/javascript">
var ProgramacionG={id:0,estado:1};
var diasId=['Lu','Ma','Mi','Ju','Vi','Sa','Do'];
var diasG=['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo'];
var EfectoG=0;
var idDocenteG='';
var DocenteOpciones={
    placeholder: 'Docente',
    url: "AjaxDinamic/Mantenimiento.PersonaEM@ListPersona",
    listLocation: "data",
    getValue: "persona",
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
    $("#ProgramacionForm #slct_seccion").change(function(){ AjaxProgramacion.CargarProgramacion(HTMLCargarProgramacion,this.value); });

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
                    msjG.mensaje('info','Falta guardar Selección',5000);
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

ProgramarCurso=function(id){
    ProgramacionG.grupo_academico_id=id;
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

    var fechaini= $("#ProgramacionForm #txt_fechas").val().split(" / ")[0];
    var fechafin= $("#ProgramacionForm #txt_fechas").val().split(" / ")[1];

    var horario= $("#ProgramacionForm #txt_horario").val().split(" de ")[0].split(",");
    var horaini= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[0].substr(0,5);
    var horafin= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[1];
    i=0;
    var html=''; var html2='';
    horainiaux=horaini;
    while( horainiaux<=horafin ){
        
        if( i==0 ){ html+="<tr>"; html+='<th>HORAS</th>'; }
        else{ html2+="<tr class='H"+horainiaux+"'>"; html2+="<td>"+horainiaux; horainiaux=horainiaux.to45HHMM(); html2+=" - "+horainiaux+"</td>" }

        for (var j = 1; j <= horario.length; j++) {
            if( i==0 ){
                html+="<th>"+diasG[diasId.indexOf(horario[(j-1)])]+"</th>";
            }
            else{
                html2+="<td class='D"+horario[(j-1)]+"' id='f"+i+"c"+j+"'></td>";
            }
        }
        if( i==0 ){ html+="</tr>"; }
        html2+="</tr>";
        i++;
    }
    $("#TableProgramacion thead").html(html);
    $("#TableProgramacion tbody").html(html2);
    horainiaux=horaini;
    i=0;
    while( horainiaux<=horafin ){
        i++;
        for (var j = 1; j <= horario.length; j++) {
            idDocenteG="f"+i+"c"+j;
            $("#TableProgramacion #"+idDocenteG).html( $("#TableProgramacionAux td").html().split("_aux").join("_"+idDocenteG) );

        }
        horainiaux=horainiaux.to45HHMM();
    }
    $("#TableProgramacion select").addClass("selectpicker show-menu-arrow");
    $("#TableProgramacion .selectpicker").selectpicker('refresh');

    AjaxProgramacion.CargarProgramacion(HTMLCargarProgramacion,'A');
}

String.prototype.to45HHMM=function(){
    var h= this.split(":")[0]*3600;
    var m= this.split(":")[1]*60;
    var adicional= 45*60;
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
        html+="<option value="+r.id+">"+r.curso+"</option>";
    });
    $("#TableProgramacionAux #slct_curso_aux").html(html);
}

HTMLCargarProgramacion=function(result){
    $.each(result.data,function(index,r){
        
    });
};

AgregarEditarProgramacion=function(btn,curso){
    if( EfectoG==0 ){
        EfectoG=1;
        var horario= $("#ProgramacionForm #txt_horario").val().split(" de ")[0].split(",");
        var horaini= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[0].substr(0,5);
        var horafin= $("#ProgramacionForm #txt_horario").val().split(" de ")[1].split(" a ")[1];
        horainiaux=horaini;
        i=0;
        var btns=[];
        var cursos=[];
        while( horainiaux<=horafin ){
            i++;
            for (var j = 1; j <= horario.length; j++) {
                idDocenteG="f"+i+"c"+j;
                if( $("#editar_"+idDocenteG).is(':visible') ){
                    cursos.push("#editar_"+idDocenteG);
                    btns.push("#crear_"+idDocenteG);
                }
            }
            horainiaux=horainiaux.to45HHMM();
        }

        CancelarProgramacion(btns.join(","),cursos.join(","));
        $(btn).addClass("animated zoomOutDown").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){
            $(this).removeClass("animated zoomOutDown");
            $(this).hide();
            $(curso).show();
            $(curso).addClass("animated zoomIn").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend", function(){ $(this).removeClass("animated zoomIn"); EfectoG=0; 
                idDocenteG= btn.split("_")[1];
                $("#TableProgramacion #txt_persona_"+btn.split("_")[1]).easyAutocomplete(DocenteOpciones);
                $("#TableProgramacion #txt_ambiente_"+btn.split("_")[1]).easyAutocomplete(AmbienteOpciones);
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
        var datos={curso_id:curso_id, empleado_id:empleado_id, lab:lab, ambiente_id:ambiente_id, tipo_clase:tipo_clase, dia_id:dia_id, hora_inicio:hora_inicio, hora_final:hora_final};
        AjaxProgramacion.AgregarEditar(HTMLAgregarEditar,datos);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('info',result.msj,3000);
    }
    else{
        msjG.mensaje('warning', result.msj,3000);
    }
}

</script>
