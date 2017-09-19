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
            $('#loading').modal('show');
        }else{
            $('#loading').modal('hide');
        }
    },

    DisableDays: function (date) {
        var isd = RangeDatesIsDisable;
        var rd = RangeDates;

        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        for (var i = 0; i < rd.length; i++) {
            var ds = rd[i].split(',');

            var di, df;
            var m1, d1, y1, m2, d2, y2;


            if (ds.length == 1) {
                di = ds[0].split('/');

                m1 = parseInt(di[0]);
                d1 = parseInt(di[1]);
                y1 = parseInt(di[2]);
                if (y1 == y && m1 == (m + 1) && d1 == d) return [!isd];
            } else if (ds.length > 1) {
                di = ds[0].split('/');
                df = ds[1].split('/');
                m1 = parseInt(di[0]);
                d1 = parseInt(di[1]);
                y1 = parseInt(di[2]);
                m2 = parseInt(df[0]);
                d2 = parseInt(df[1]);
                y2 = parseInt(df[2]);

                if (y1 >= y || y <= y2) {
                    if ((m + 1) >= m1 && (m + 1) <= m2) {
                        if (m1 == m2) {
                            if (d >= d1 && d <= d2) return [!isd];
                        } else if (m1 == (m + 1)) {
                            if (d >= d1) return [!isd];
                        } else if (m2 == (m + 1)) {
                            if (d <= d2) return [!isd];
                        } else return [!isd];
                    }
                }
            }
        }
        console.log([isd]);
        return [isd];
    },

}
