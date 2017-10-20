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


function cargarFechasDataPicker(fechaInicio, fechaFin,  strIdObject) {
    $("#"+strIdObject).datepicker({
        format: 'dd/mm/yyyy',
        changeMonth: true,
        showWeek: false,
        numberOfMonths: verificarFinSiHayFinMes(fechaInicio,fechaFin),
        firstDay: 1,
        showButtonPanel: true,
        minDate: fechaInicio,
        maxDate: fechaFin,
        selectOtherMonths: true,
        showAnim: 'fadeIn',
        beforeShowDay: false,
    });
}

/* retorna 1 o 2 para la candidad de mes a mostra por el datapícker*/
function verificarFinSiHayFinMes(fechaInicio, fechaFin) {
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
        ocultarrErrorForm(objeto);
        return true;
    }
}

/**
 * Validamos campos vacios
 *
 * @param objeto: elemento del DOM
 */
function validarCampoVacio(objeto) {
    if(objeto.val().trim() !== '')
    {
        return true;
    }else{
        return false;
    }
}

/**
 * Permite ocullar los mensajes de error de input form
 *
 * @param objeto: Elemento del DOM
 * @param mensaje: String del mensaje
 */
function mostrarErrorFormDate( isFin, mensaje){
    let padre;

    if(parseInt(isFin) === 1){
        padre = $('.fechaFinTarea');
    }else{
        padre = $('.fechaInicioTarea');
    }

    let hijo = padre.children('span');

    padre.addClass('has-error');
    hijo.addClass('help-block');
    hijo.html(mensaje);
    hijo.show();
}

function ocultarErrorFormDate(isFin){
    let padre;

    if(parseInt(isFin) === 1){
        padre = $('.fechaFinTarea');
    }else{
        padre = $('.fechaInicioTarea');
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

function ocultarrErrorForm(objeto){
    let padre =objeto.parent('.form-group');
    let hijo = padre.children('span');

    padre.removeClass('has-error');
    hijo.removeClass('help-block');
    hijo.html('');
    hijo.hide();
}

function validarLimiteFechas(fechaInicio, fechaFin, fecha) {
    let inicio = convertDateFormat(fechaInicio);
    let fin = convertDateFormat(fechaFin);
    let actual = convertDateFormat(fecha);

console.log(inicio);
console.log(fin);
console.log(actual);
console.log(moment().isSameOrAfter(inicio));

    if(moment().isSameOrAfter(inicio) && moment(actual).isSameOrBefore(fin)){
        return true;
    }else{
        return false;
    }
}

function convertDateFormat(string) {
    var info = string.split('/').reverse().join('-');
    return info;
}


function validarFechaTarea(objeto, isFin, fechaInicio, fechaFin) {
    let tipo;
    if(parseInt(isFin) === 1){
        tipo = 'fin';
    }else{
        tipo = 'inicio';
    }

    if(validarCampoVacio(objeto)){
        ocultarErrorFormDate(objeto, isFin);
        if(validarFecha(objeto.val())){
            console.log(objeto.val());
            if(existeFecha(objeto.val())) {
                if(validarLimiteFechas(fechaInicio, fechaFin, objeto.val())){
                    ocultarErrorFormDate(objeto, isFin);
                }else{
                    mostrarErrorFormDate( isFin, 'La fecha fuera de la semana');
                }
            }else{
                mostrarErrorFormDate( isFin, 'La fecha no existe');
            }
        }else{
            mostrarErrorFormDate(isFin, 'El formato de la fecha es incorrecta');
        }
    }else{
        mostrarErrorFormDate(isFin, 'La fecha de '+ tipo +' es requerida');
    }
}
/**
 * Valida las exprecion regular de un fecha europea
 *
 * @param fecha: String de la fecha
 * @returns {boolean}
 */
function validarFecha(fecha){
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
