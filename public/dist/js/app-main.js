/**
 * Created by gildder on 15/06/2017.
 */
"use strict";

/**
 * Modulo de Tareas
 * */

/* Crear una Tarea */

/**
 * #modal-nueva-tarea es Id del modal de Nueva Tarea
 * Manejamos el evento de ocultar un modal al hacer
 * click fuera de la ventana
 */


function limpiarFormTarea(objeto) {
    objeto.reset();

    $('input[name="hora"]').val(0);
    $('input[name="minuto"]').val(0);

    //Escondemos todos los avisos.
    $('span.help-block').hide();

    // removemos las alertas de labels
    $('div.has-error').removeClass('has-error');
}


function cargarFechasDataPicker(objetoIdName) {
    let fechaInicio = convertDateFormatEU(sessionStorage.getItem('inicioSemana'));
    let fechaFin = convertDateFormatEU(sessionStorage.getItem('finSemana'));

    $("#"+objetoIdName).datepicker({
        format: 'dd/mm/yyyy',
        changeMonth: true,
        showWeek: false,
        numberOfMonths: verificarFinSiHayFinMes(),
        firstDay: 1,
        showButtonPanel: true,
        minDate: fechaInicio,
        maxDate: fechaFin,
        selectOtherMonths: true,
        showAnim: 'fadeIn',
        beforeShowDay: false,
    });
}


/**
 * DataPicker para Tareas Agendas
 *
 * @param objetoIdName
 */
function cargarFechasDataPickerRefresh(objetoIdName, isFin) {
    // los valores sesionStore se guardaron en la tarea agenda
    let inicioSemana = sessionStorage.getItem('inicioSemana');
    let finSemana = sessionStorage.getItem('finSemana');

    $("#" + objetoIdName).datepicker({
        format: 'dd/mm/yyyy',
        changeMonth: true,
        showWeek: false,
        numberOfMonths: verificarFinSiHayFinMes(),
        firstDay: 1,
        showButtonPanel: true,
        minDate: inicioSemana,
        maxDate: finSemana,
        selectOtherMonths: true,
        showAnim: 'fadeIn',
        beforeShowDay: false,
    }).on('change', function () {
        if(validarFechaTarea($(this), isFin)){
            if(diferenciaDiasFechas() > 7)
                getFechasSemanaAnio($(this));
        }

    }).on('blur', function () {
        if(validarFechaTarea($(this), isFin)){
            if(diferenciaDiasFechas() > 7)
                getFechasSemanaAnio($(this));
        }

    });
}

function getFechasSemanaAnio(objeto) {
    mostrarCargando(true);

    $.ajax({
        url: '/tareas/tareaProgramadas/getSemanaAnioFecha',
        method: 'GET',
        data: { fecha: objeto.val() },
        dataType: 'json',
        success: function (data) {
            sessionStorage.setItem('inicioSemana', data.tarea.fechaInicio);
            sessionStorage.setItem('finSemana', data.tarea.fechaFin);
            actualizarFechasCalendario();
            mostrarCargando(false);
            return true;
        }.bind(this), error: function (data)
        {
            mostrarCargando(false);

            return false;
        }.bind(this)
    })
}



/**
 *
 * @param nameIdObject
 */
function actualizarFechasCalendario() {
    let fechaInicio = sessionStorage.getItem('inicioSemana');
    let fechaFin = sessionStorage.getItem('finSemana');

    $('#limFechaInicio').html(fechaInicio);
    $('#limFechaFin').html(fechaFin);

    $("#fechaInicioTarea").css('readonly', true);
    $("#fechaFinTarea").css('readonly', true);

    $('#fechaInicioTarea').datepicker('option', 'minDate', fechaInicio);
    $('#fechaInicioTarea').datepicker('option', 'maxDate', fechaFin);
    $('#fechaInicioTarea').datepicker( "refresh" );

    $('#fechaFinTarea').datepicker('option', 'minDate', fechaInicio);
    $('#fechaFinTarea').datepicker('option', 'maxDate', fechaFin);
    $('#fechaFinTarea').datepicker( "refresh" );

}






/* retorna 1 o 2 para la candidad de mes a mostra por el datapícker*/
function verificarFinSiHayFinMes() {
    let fechaInicio = sessionStorage.getItem('inicioSemanaFija');
    let fechaFin = sessionStorage.getItem('finSemanaFija');

    if(fechaInicio === undefined || fechaFin === undefined){
        return;
    }

    var arrayFechaInicio = fechaInicio.split('/');
    var arrayFechaFin = fechaFin.split('/');

    var mesInicio = parseInt(arrayFechaInicio[1]);
    var mesFin = parseInt(arrayFechaFin[1]);
    if(mesInicio !== mesFin){
        return 2;
    }else{
        return 1;
    }
}

/**
 * Permite validar el limite de caracteres de elemento Form
 *
 * @param min: valor mimimo de caracteers
 * @param max: valor maximo de caracteres
 * @param objeto: Elemento del DOM
 */
function validarLimitesString(min, max, objeto)
{
    if(objeto.val().length > max){
        mostrarErrorForm(objeto, 'El maximo de caracteres es '+max);
        return false;
    }else if(objeto.val().length < min){
        mostrarErrorForm(objeto, 'El minimo de caracteres es '+min);
        return false;
    }else{
        ocultarErrorForm(objeto);
        return true;
    }
}

/**
 * Validamos campos vacios
 *
 * @param valor: elemento del string
 */
function validarCampoVacio(valor) {

    if($.trim(valor).length === 0)
    {
        return false;
    }else{
        return true;
    }
}

function validarFechaTarea(objeto, isFin) {
    let valor = objeto.val();
    let result = false;

    if(validarCampoVacio(valor)){
        // validar formato de la fecha
        if(validarFormatoFecha(valor)){
            // validar si la fecha existe
            if(existeFecha(valor)) {
                if(validarLimiteFechas(valor)) {
                    ocultarErrorFormDate(isFin);
                    result = true;
                }else{
                    mostrarErrorFormDate(isFin, 'Fecha fuera de rango permitido');
                }
            }else{
                mostrarErrorFormDate( isFin, 'La fecha no existe');
            }
        }else{
            mostrarErrorFormDate(isFin, 'El formato de la fecha es incorrecta');
        }
    }else{
        mostrarErrorFormDate(isFin, 'La fecha es requerida');
    }

    return result;

}


/**
 * Permite ocullar los mensajes de error de input form
 *
 * @param objeto: Elemento del DOM
 * @param mensaje: String del mensaje
 */
function mostrarErrorFormDate(isFin, mensaje){
    let padre;
    if( isFin === 1){
        padre = $("#divFechaFin");
    }else{
        padre = $("#divFechaInicio");
    }

    let hijo = padre.children('span');

    padre.addClass('has-error');
    hijo.addClass('help-block');
    hijo.html(mensaje);
    hijo.show();
}

function ocultarErrorFormDate(isFin){
    let padre;

    if( isFin === 1){
        padre = $("#divFechaFin");
    }else{
        padre = $("#divFechaInicio");
    }
    let hijo = padre.children('span');

    padre.removeClass('has-error');
    hijo.removeClass('help-block');
    hijo.html('');
    hijo.hide();
}


/**
 * Permite ocullar los mensajes de error de input form
 *
 * @param objeto: Elemento del DOM
 * @param mensaje: String del mensaje
 */
function mostrarErrorForm(objeto, mensaje){
    let padre = objeto.parent('div.form-group');
    let hijo = padre.children('span');

    padre.addClass('has-error');
    hijo.addClass('help-block');
    hijo.html(mensaje);
    hijo.show();
}

function ocultarErrorForm(objeto){
    let padre =objeto.parent('.form-group');
    let hijo = padre.children('span');

    padre.removeClass('has-error');
    hijo.removeClass('help-block');
    hijo.html('');
    hijo.hide();
}

function validarLimiteFechas(fecha) {
    let inicio = convertDateFormatDB(sessionStorage.getItem('inicioSemana'));
    let fin = convertDateFormatDB(sessionStorage.getItem('finSemana'));
    let actual = convertDateFormatDB(fecha);
    let formato = "YYYY-MM-DD";

    if(moment(actual, formato).isSameOrAfter(inicio, formato) && moment(actual, formato).isSameOrBefore(fin, formato)){
        return true;
    }else{
        return false;
    }
}

function diferenciaDiasFechas() {
    let inicio = convertDateFormatDB(sessionStorage.getItem('inicioSemana'));
    let fin = convertDateFormatDB(sessionStorage.getItem('finSemana'));
    let formato = "YYYY-MM-DD";

    return moment(fin).diff(inicio, 'days')

}

function validarFechaMayor(fechaInicio, fechaFin) {
    let inicio = convertDateFormatDB(fechaInicio);
    let fin = convertDateFormatDB(fechaFin);
    let formato = "YYYY-MM-DD";

    if(moment(fin, formato).isSameOrAfter(inicio, formato)){
        return true;
    }else{
        return false;
    }
}

function convertDateFormatDB(string) {
    var info = string.split('/').reverse().join('-');
    return info;
}

function convertDateFormatEU(string) {
    var info = string.split('-').reverse().join('/');
    return info;
}



/**
 * Valida las exprecion regular de un fecha europea
 *
 * @param fecha: String de la fecha
 * @returns {boolean}
 */
function validarFormatoFecha(fecha){
    var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
    if ((fecha.match(RegExPattern)) && (fecha!='')) {
        return true;
    } else {
        return false;
    }
}
/**
 * Validar Existencia de Fechas
 * */
function existeFecha(fecha){
    var fechaf = fecha.split("/");
    var day = fechaf[0];
    var month = fechaf[1];
    var year = fechaf[2];
    var date = new Date(year,month,'0');
    if((day-0)>(date.getDate()-0)){
        return false;
    }
    return true;
}

function existeFecha2 (fecha) {
    var fechaf = fecha.split("/");
    var d = fechaf[0];
    var m = fechaf[1];
    var y = fechaf[2];
    return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}


function mostrarCargando(opcion) {
    if(opcion){
        $('#loading').modal('show');
    }else{
        $('#loading').modal('hide');
    }
}
