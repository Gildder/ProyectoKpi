"use strict";

/**
 * Libreria D3JS
 */

function GraficarSupervisor($capa, $data) {
    var chart;

    chart = c3.generate({
        bindto: $capa,
        data: {
            type: 'bar',
            columns: $data
        },
        axis: {
            x: {
                type: 'category',
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            }
        },
        legend: {
            position: 'right'
        }


    });
}