<template>
    <div class="input-group row" style="margin: 10px 5px 15px 0px;">
        <div class="input-group-addon row">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="{{ tipo }}" id="inputdate-{{ nombre }}" value="{{ valor }}"
               placeholder="{{ placeholder }}" class="form-control" name="{{ nombre }}" required>
    </div>
</template>

<script>
    var Vue = require('vue');
    export default {
        props: {
            tipo:{type: String, required:true},
            nombre: {type: String, required: true},
            fechainicio:{type:String, required: true},
            fechafin:{type:String, required: true},
            placeholder:{type:String, required: true},
            valor:{type:String, required: true},
        },
        ready: function () {
            $("#inputdate-"+ this.nombre).datepicker({
                format: 'dd/mm/yyyy',
                changeMonth: true,
                showWeek: true,
                numberOfMonths: 1,
                showButtonPanel: true,
                beforeShowDay: $.datepicker.noWeekends,
                minDate: this.fechainicio,
                maxDate: this.fechafin,
            });

        },
        methods: {

        },
    };


</script>