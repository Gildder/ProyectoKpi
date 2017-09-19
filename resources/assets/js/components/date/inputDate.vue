<template>
    <div class="input-group row" style="margin: 10px 5px 15px 0px;">
        <div class="input-group-addon row">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="{{ tipo }}" id="inputdate-{{ nombre }}" value="{{ valor }}"
               readonly="{{ readonly}}"
               placeholder="{{ placeholder }}"
               class="form-control" name="{{ nombre }}" required>
    </div>
</template>

<script>
    var Vue = require('vue');

    var RangeDates = ["12/8/2017, 13/8/2017"];
    var RangeDatesIsDisable = true;

    export default {
        props: {
            tipo:{type: String, required:true},
            nombre: {type: String, required: true},
            fechainicio:{type:String, required: true},
            fechafin:{type:String, required: true},
            placeholder:{type:String, required: true},
            readonly:{type:String, default: false},
            valor:{type:String, required: true},
            diainicio:{type:String, required: true},
            diainicio:{type:String, required: true},
        },
        ready: function () {
            $("#inputdate-"+ this.nombre).datepicker({
                format: 'dd/mm/yyyy',
                changeMonth: true,
                showWeek: false,
                numberOfMonths: this.isSemanaTieneFinMes(),
                firstDay:this.diainicio,
                showButtonPanel: true,
//                beforeShowDay: $.datepicker.noWeekends,php artis
                minDate: this.fechainicio,
                maxDate: this.fechafin,
                selectOtherMonths: true,
                showAnim: 'fadeIn',
                beforeShowDay: false,
            });
            this.DisableDays(new Date());
        },
        methods: {
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
                return [isd];
            },
            isSemanaTieneFinMes: function () {
                var arrayFechaInicio = this.fechainicio.split('/');
                var arrayFechaFin = this.fechafin.split('/');

                var mesInicio = parseInt(arrayFechaInicio[1]);
                var mesFin = parseInt(arrayFechaFin[1]);
                if(mesInicio !== mesFin){
                    return 2;
                }else{
                    return 1;
                }
            },
            validarFecha: function () {

            }

        },

    };




</script>
