/**
 * Created by gildder on 24/06/2017.
 */
module.exports = {
    cargarDato: function (dataChart, idChart, catChart) {
        chart = c3.generate({
            bindto: idChart,
            data:  dataChart,
            bar: {
                width: {
                    ratio: 0.5
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
                    categories: catChart

                }
            },
            legend: {
                position: 'bottom'
            }
        });
    },

    /**
     * Permite guardar datos en el localStorage
     * @param clave: nombre del datos
     * @param valor: dato a guardar
     */
    guardarInStore: function (clave, valor) {
        try{
            localStorage.removeItem(clave);
            localStorage.setItem(clave, JSON.stringify(valor));
        }catch (err){
            console.error('Error: En el metodo guardarInStore, ocurrio: %s.', err );
        }

    },

    /**
     * Devuelve el nombre del mes segun el numero del mes
     * @param mes
     * @returns {*}
     */
    nombreMes: function (mes) {
        switch (mes) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            case 3:
                return 'Marzo';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Mayo';
                break;
            case 6:
                return 'Junio';
                break;
            case 7:
                return 'Julio';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Septiembre';
                break;
            case 10:
                return 'Octubre';
                break;
            case 11:
                return 'Noviembre';
                break;
            case 12:
                return 'Diciembre';
                break;

        }
    },
    mostrarCargando: function (opcion) {
        if(opcion){
            $('#modal-loading').modal('show');
        }else{
            $('#modal-loading').modal('hide');
        }
    },


}
